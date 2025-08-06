<?php
/**
 * Smart Module Loader - 効率的な遅延読み込みシステム
 * 
 * 特徴:
 * - 使用時のみモジュール読み込み
 * - 重複防止機構
 * - メモリ効率化
 * - エラー回避
 * 
 * @package SmartModules
 */

// 直接アクセスを防ぐ
if (!defined('ABSPATH')) {
    exit;
}

class SmartModuleLoader {
    
    private static $instance = null;
    private static $prepared_modules = [];
    private static $loaded_modules = [];
    private static $assets_enqueued = [];
    private static $acf_fields_registered = false;
    
    /**
     * シングルトンインスタンス取得
     */
    public static function get_instance() {
        if (self::$instance === null) {
            self::$instance = new self();
        }
        return self::$instance;
    }
    
    /**
     * システム初期化
     */
    public function init() {
        // ページ解析フック
        add_action('wp', [$this, 'analyze_page_content']);
        
        // アセット管理
        add_action('wp_enqueue_scripts', [$this, 'enqueue_global_assets']);
        
        // ACFフィールド登録（複数のタイミングで試行）
        add_action('acf/init', [$this, 'register_all_acf_fields'], 10);
        add_action('init', [$this, 'register_all_acf_fields'], 20);
        add_action('wp_loaded', [$this, 'register_all_acf_fields'], 30);
        add_action('admin_init', [$this, 'register_all_acf_fields'], 40);
        
        // AOS初期化
        add_action('wp_footer', [$this, 'init_aos']);
        
        // デバッグ情報（開発時のみ表示）
        if (defined('WP_DEBUG') && WP_DEBUG) {
            add_action('wp_footer', [$this, 'debug_info']);
        }
        
        // 管理画面でのACF情報表示
        add_action('admin_notices', [$this, 'admin_debug_info']);
        
        error_log('SmartModuleLoader: システム初期化完了');
    }
    
    /**
     * ページコンテンツを解析して使用モジュールを検出
     */
    public function analyze_page_content() {
        global $post;
        
        if (!$post) {
            return;
        }
        
        $content = $post->post_content;
        $detected_modules = $this->detect_modules_in_content($content);
        
        // 強制的に既存モジュールを準備（テスト用）
        $this->prepare_module('hero');
        $this->prepare_module('problem');
        $this->prepare_module('benefits');
        
        if (!empty($detected_modules)) {
            error_log('SmartModuleLoader: 検出されたモジュール - ' . implode(', ', $detected_modules));
            
            foreach ($detected_modules as $module_name) {
                $this->prepare_module($module_name);
            }
        }
    }
    
    /**
     * コンテンツ内のモジュールを検出
     */
    private function detect_modules_in_content($content) {
        $modules = [];
        
        // ショートコードパターンをマッチ
        $pattern = '/\[(\w+)_smart_module[^\]]*\]/';
        if (preg_match_all($pattern, $content, $matches)) {
            $modules = array_merge($modules, $matches[1]);
        }
        
        // ACF選択も確認
        $selected_modules = get_field('smart_selected_modules', get_the_ID());
        if ($selected_modules && is_array($selected_modules)) {
            $modules = array_merge($modules, $selected_modules);
        }
        
        return array_unique($modules);
    }
    
    /**
     * モジュールを事前準備（軽量）
     */
    public function prepare_module($module_name) {
        if (isset(self::$prepared_modules[$module_name])) {
            return; // 既に準備済み
        }
        
        // ショートコードを登録（軽量操作）
        $shortcode_name = $module_name . '_smart_module';
        add_shortcode($shortcode_name, function($atts) use ($module_name) {
            // 属性のデフォルト値を設定
            $atts = shortcode_atts([
                'version' => '01', // デフォルトは01
            ], $atts);
            
            $loader = SmartModuleLoader::get_instance();
            return $loader->render_module($module_name, $atts);
        });
        
        self::$prepared_modules[$module_name] = true;
        error_log("SmartModuleLoader: モジュール準備完了 - {$module_name} -> [{$shortcode_name}]");
    }
    
    /**
     * モジュールをレンダリング（実際の読み込み時）
     */
    public function render_module($module_name, $atts = []) {
        // version属性を取得（デフォルト01）
        $version = isset($atts['version']) ? $atts['version'] : '01';
        
        // バージョン指定でのモジュール情報取得
        $module_info = $this->get_module_path($module_name, $version);
        
        if (!$module_info) {
            error_log("SmartModuleLoader: 指定されたバージョンのモジュールが見つかりません - {$module_name} version:{$version}");
            return '<!-- Smart Module Error: ' . $module_name . ' version:' . $version . ' not found -->';
        }
        
        // 初回読み込み時のみ実際にモジュールを読み込み
        $module_key = $module_name . '_' . $version;
        if (!isset(self::$loaded_modules[$module_key])) {
            $this->load_module($module_name, $version);
        }
        
        // モジュールクラスを取得してレンダリング
        // バージョンに応じてクラス名を調整
        if ($version === '01') {
            $module_class = 'Smart' . ucfirst($module_name) . 'Module';
        } else {
            $module_class = 'Smart' . ucfirst($module_name) . 'ModuleV' . $version;
        }
        
        if (class_exists($module_class)) {
            $module = new $module_class();
            error_log("SmartModuleLoader: レンダリング実行 - {$module_name} version:{$version} class:{$module_class}");
            return $module->render($atts);
        } else {
            error_log("SmartModuleLoader: クラスが見つかりません - {$module_class}");
        }
        
        return '<!-- Smart Module Error: ' . $module_name . ' not found -->';
    }
    
    /**
     * モジュールファイルを実際に読み込み
     */
    private function load_module($module_name, $version = '01') {
        $module_info = $this->get_module_path($module_name, $version);
        
        if ($module_info && file_exists($module_info['module_file'])) {
            require_once $module_info['module_file'];
            
            // バージョン別にキャッシュ（同じクラス名でも異なるファイルの場合があるため）
            $module_key = $module_name . '_' . $version;
            self::$loaded_modules[$module_key] = $module_info;
            
            error_log("SmartModuleLoader: モジュール読み込み完了 - {$module_name} (version: {$module_info['version']})");
        } else {
            error_log("SmartModuleLoader: モジュールファイルが見つかりません - {$module_name} version:{$version}");
        }
    }
    
    /**
     * アセットを重複なく読み込み
     */
    public static function enqueue_asset($handle, $src, $type = 'css') {
        if (isset(self::$assets_enqueued[$handle])) {
            return; // 既に読み込み済み
        }
        
        if ($type === 'css') {
            wp_enqueue_style($handle, $src);
        } elseif ($type === 'js') {
            wp_enqueue_script($handle, $src, [], null, true);
        }
        
        self::$assets_enqueued[$handle] = true;
        error_log("SmartModuleLoader: アセット読み込み - {$handle}");
    }
    
    /**
     * グローバルアセットの読み込み
     */
    public function enqueue_global_assets() {
        // Font Awesome（共通で使用）
        self::enqueue_asset(
            'font-awesome-smart',
            'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css',
            'css'
        );
        
        // AOS（Animate On Scroll）ライブラリ
        self::enqueue_asset(
            'aos-css',
            'https://unpkg.com/aos@2.3.1/dist/aos.css',
            'css'
        );
        
        self::enqueue_asset(
            'aos-js',
            'https://unpkg.com/aos@2.3.1/dist/aos.js',
            'js'
        );
        
        // 共通スタイル（ファイル存在確認付き）
        $common_css_path = get_stylesheet_directory() . '/modules_smart/assets/css/common.css';
        if (file_exists($common_css_path)) {
            $version = filemtime($common_css_path); // キャッシュバスター
            self::enqueue_asset(
                'smart-modules-common',
                get_stylesheet_directory_uri() . '/modules_smart/assets/css/common.css?v=' . $version,
                'css'
            );
        } else {
            error_log('SmartModuleLoader: common.css が見つかりません - ' . $common_css_path);
        }
    }
    
    /**
     * 全モジュールのACFフィールドを登録
     */
    public function register_all_acf_fields() {
        // 重複登録を防ぐ
        if (self::$acf_fields_registered) {
            return;
        }
        
        // 既存のACFフィールドグループをクリア（開発中のみ）
        if (current_user_can('administrator') && defined('WP_DEBUG') && WP_DEBUG) {
            $this->clear_existing_field_groups();
        }
        
        error_log('SmartModuleLoader: ACFフィールド登録開始');
        
        if (!function_exists('acf_add_local_field_group')) {
            error_log('SmartModuleLoader: ACFプラグインが見つかりません - function_exists(acf_add_local_field_group) = false');
            return;
        }
        
        error_log('SmartModuleLoader: ACFプラグイン確認完了');
        
        // 利用可能なモジュールを取得
        $available_modules = $this->get_available_modules();
        error_log('SmartModuleLoader: 検出されたモジュール - ' . print_r($available_modules, true));
        
        if (empty($available_modules)) {
            error_log('SmartModuleLoader: 利用可能なモジュールが見つかりません');
            return;
        }
        
        foreach ($available_modules as $module_name) {
            error_log("SmartModuleLoader: {$module_name} モジュールのACFフィールド登録中...");
            $this->register_module_acf_fields($module_name);
        }
        
        error_log('SmartModuleLoader: ACFフィールド登録完了 - ' . implode(', ', $available_modules));
        
        // 登録完了フラグを設定
        self::$acf_fields_registered = true;
    }
    
    /**
     * 利用可能なモジュール一覧を取得
     */
    private function get_available_modules() {
        $modules_dir = get_stylesheet_directory() . '/modules_smart/modules';
        $modules = [];
        
        if (is_dir($modules_dir)) {
            $module_type_dirs = glob($modules_dir . '/*', GLOB_ONLYDIR);
            foreach ($module_type_dirs as $type_dir) {
                $dir_name = basename($type_dir);
                // 順序番号付きディレクトリ名から実際のモジュール名を抽出 (例: 01_hero -> hero)
                $module_type = preg_replace('/^[0-9]+_/', '', $dir_name);
                
                // ナンバリングフォルダを検索 (例: hero_module_01)
                $version_dirs = glob($type_dir . '/' . $module_type . '_module_*', GLOB_ONLYDIR);
                
                if (!empty($version_dirs)) {
                    // デフォルトは01を使用、存在しない場合は最初に見つかったものを使用
                    $default_version_dir = null;
                    $fallback_version_dir = null;
                    
                    foreach ($version_dirs as $version_dir) {
                        $module_file = $version_dir . '/' . $module_type . '_module.php';
                        if (file_exists($module_file)) {
                            if (!$fallback_version_dir) {
                                $fallback_version_dir = $version_dir;
                            }
                            if (strpos(basename($version_dir), '_module_01') !== false) {
                                $default_version_dir = $version_dir;
                                break;
                            }
                        }
                    }
                    
                    if ($default_version_dir || $fallback_version_dir) {
                        $modules[] = $module_type;
                    }
                }
            }
        }
        
        return $modules;
    }
    
    /**
     * モジュールのファイルパスを取得（ナンバリング対応）
     */
    private function get_module_path($module_name, $version = '01') {
        $modules_dir = get_stylesheet_directory() . '/modules_smart/modules';
        
        // 順序番号付きディレクトリを検索 (例: 01_hero, hero)
        $type_dir = null;
        $possible_dirs = glob($modules_dir . '/*' . $module_name, GLOB_ONLYDIR);
        foreach ($possible_dirs as $dir) {
            $dir_name = basename($dir);
            if ($dir_name === $module_name || preg_match('/^[0-9]+_' . preg_quote($module_name, '/') . '$/', $dir_name)) {
                $type_dir = $dir;
                break;
            }
        }
        
        if (!$type_dir) {
            return null;
        }
        
        // 指定されたバージョンを試行
        $version_dir = $type_dir . '/' . $module_name . '_module_' . $version;
        $module_file = $version_dir . '/' . $module_name . '_module.php';
        
        if (file_exists($module_file)) {
            return [
                'module_file' => $module_file,
                'module_dir' => $version_dir,
                'assets_dir' => $version_dir . '/assets',
                'version' => $version
            ];
        }
        
        // 指定バージョンが存在しない場合、利用可能な最初のバージョンを使用
        $version_dirs = glob($type_dir . '/' . $module_name . '_module_*', GLOB_ONLYDIR);
        foreach ($version_dirs as $version_dir) {
            $module_file = $version_dir . '/' . $module_name . '_module.php';
            if (file_exists($module_file)) {
                $version = str_replace($module_name . '_module_', '', basename($version_dir));
                return [
                    'module_file' => $module_file,
                    'module_dir' => $version_dir,
                    'assets_dir' => $version_dir . '/assets',
                    'version' => $version
                ];
            }
        }
        
        return null;
    }
    
    /**
     * 特定モジュールのACFフィールドを登録
     */
    private function register_module_acf_fields($module_name) {
        $module_info = $this->get_module_path($module_name);
        
        if (!$module_info) {
            error_log("SmartModuleLoader: モジュールが見つかりません - {$module_name}");
            return;
        }
        
        $module_path = $module_info['module_file'];
        
        if (!file_exists($module_path)) {
            error_log("SmartModuleLoader: モジュールファイルが見つかりません - {$module_path}");
            return;
        }
        
        error_log("SmartModuleLoader: モジュールファイル読み込み - {$module_path}");
        
        // モジュールファイルを読み込み
        require_once $module_path;
        
        // モジュールクラスを作成
        $module_class = 'Smart' . ucfirst($module_name) . 'Module';
        error_log("SmartModuleLoader: モジュールクラス名 - {$module_class}");
        
        if (class_exists($module_class)) {
            error_log("SmartModuleLoader: クラス存在確認OK - {$module_class}");
            $module = new $module_class();
            // ACFフィールドを直接登録（コンストラクタ内のregister_acf_fields()を回避）
            $this->force_register_acf_fields($module, $module_name);
        } else {
            error_log("SmartModuleLoader: クラスが見つかりません - {$module_class}");
        }
    }
    
    /**
     * ACFフィールドを強制登録
     */
    private function force_register_acf_fields($module, $module_name) {
        $defaults = $module->get_defaults_public();
        error_log("SmartModuleLoader: {$module_name} のデフォルト値 - " . print_r($defaults, true));
        
        $fields = [];
        
        foreach ($defaults as $key => $default_value) {
            $field_key = 'field_smart_' . $module_name . '_' . $key;
            $field_name = $module_name . '_' . $key;
            
            $field_type = $this->determine_field_type($default_value);
            
            $field = [
                'key' => $field_key,
                'label' => $this->format_label($key),
                'name' => $field_name,
                'type' => $field_type,
                'default_value' => $default_value,
                'placeholder' => $default_value,
            ];
            
            if ($field_type === 'textarea') {
                $field['rows'] = 3;
            }
            
            $fields[] = $field;
            error_log("SmartModuleLoader: フィールド追加 - {$field_name} ({$field_type})");
        }
        
        if (!empty($fields)) {
            $field_group = [
                'key' => 'group_smart_' . $module_name,
                'title' => 'Smart ' . ucfirst($module_name) . ' Module',
                'fields' => $fields,
                'location' => [
                    [
                        [
                            'param' => 'page_template',
                            'operator' => '==',
                            'value' => 'page-smart-test.php',
                        ],
                    ],
                    [
                        [
                            'param' => 'page_template',
                            'operator' => '==',
                            'value' => 'custom_template.php',
                        ],
                    ],
                    [
                        [
                            'param' => 'page_template',
                            'operator' => '==',
                            'value' => 'custom_template_site.php',
                        ],
                    ],
                ],
                'menu_order' => 0,
                'position' => 'normal',
                'style' => 'default',
            ];
            
            error_log("SmartModuleLoader: ACFフィールドグループ登録中 - group_smart_{$module_name}");
            error_log("SmartModuleLoader: フィールドグループ詳細 - " . print_r($field_group, true));
            
            acf_add_local_field_group($field_group);
            
            error_log("SmartModuleLoader: ACFフィールドグループ登録完了 - group_smart_{$module_name}");
        } else {
            error_log("SmartModuleLoader: {$module_name} にはフィールドがありません");
        }
    }
    
    /**
     * フィールドタイプを判定
     */
    private function determine_field_type($value) {
        if (is_bool($value)) {
            return 'true_false';
        } elseif (is_numeric($value)) {
            return 'number';
        } elseif (strlen($value) > 50 || strpos($value, "\n") !== false) {
            return 'textarea';
        } else {
            return 'text';
        }
    }
    
    /**
     * ラベルをフォーマット
     */
    private function format_label($key) {
        return ucwords(str_replace('_', ' ', $key));
    }
    
    /**
     * AOS（Animate On Scroll）を初期化
     */
    public function init_aos() {
        ?>
        <script>
        document.addEventListener('DOMContentLoaded', function() {
            if (typeof AOS !== 'undefined') {
                AOS.init({
                    duration: 600,
                    easing: 'ease-out-cubic',
                    once: true,
                    offset: 100
                });
                console.log('SmartModules: AOS初期化完了');
            } else {
                console.warn('SmartModules: AOSライブラリが見つかりません');
            }
        });
        </script>
        <?php
    }
    
    /**
     * デバッグ情報を表示
     */
    public function debug_info() {
        if (!current_user_can('administrator')) {
            return;
        }
        
        echo '<div style="position:fixed;bottom:10px;right:10px;background:#333;color:#fff;padding:10px;font-size:12px;z-index:9999;">';
        echo '<strong>Smart Modules Debug:</strong><br>';
        echo '準備済み: ' . implode(', ', array_keys(self::$prepared_modules)) . '<br>';
        echo '読み込み済み: ' . implode(', ', array_keys(self::$loaded_modules)) . '<br>';
        echo 'アセット: ' . count(self::$assets_enqueued) . '個';
        echo '</div>';
    }
    
    /**
     * 管理画面でのデバッグ情報表示
     */
    public function admin_debug_info() {
        if (!current_user_can('administrator')) {
            return;
        }
        
        $acf_exists = function_exists('acf_add_local_field_group');
        $available_modules = $this->get_available_modules();
        
        echo '<div class="notice notice-info">';
        echo '<h3>Smart Modules Debug Info</h3>';
        echo '<p><strong>ACFプラグイン:</strong> ' . ($acf_exists ? '✅ 有効' : '❌ 無効') . '</p>';
        echo '<p><strong>検出されたモジュール:</strong> ' . (empty($available_modules) ? '❌ なし' : '✅ ' . implode(', ', $available_modules)) . '</p>';
        
        if ($acf_exists) {
            echo '<p><strong>登録済みACFグループ:</strong></p>';
            echo '<ul>';
            foreach ($available_modules as $module_name) {
                $group_key = 'group_smart_' . $module_name;
                $group_exists = function_exists('acf_get_field_group') ? acf_get_field_group($group_key) : null;
                $status = $group_exists ? '✅' : '❌';
                echo "<li>{$status} {$group_key} - Smart " . ucfirst($module_name) . " Module</li>";
                
                // フィールド詳細を表示
                if ($group_exists && function_exists('acf_get_fields')) {
                    $fields = acf_get_fields($group_key);
                    if ($fields) {
                        echo '<ul style="margin-left: 20px;">';
                        foreach ($fields as $field) {
                            echo "<li>Field: {$field['name']} ({$field['type']})</li>";
                        }
                        echo '</ul>';
                    }
                }
            }
            echo '</ul>';
        }
        
        echo '</div>';
    }
    
    /**
     * 既存のACFフィールドグループをクリア（開発用）
     */
    private function clear_existing_field_groups() {
        if (!function_exists('acf_remove_local_field_group')) {
            return;
        }
        
        $available_modules = $this->get_available_modules();
        foreach ($available_modules as $module_name) {
            $group_key = 'group_smart_' . $module_name;
            if (acf_get_field_group($group_key)) {
                acf_remove_local_field_group($group_key);
                error_log("SmartModuleLoader: 既存フィールドグループを削除 - {$group_key}");
            }
        }
    }
    
    /**
     * 統計情報を取得
     */
    public static function get_stats() {
        return [
            'prepared' => count(self::$prepared_modules),
            'loaded' => count(self::$loaded_modules),
            'assets' => count(self::$assets_enqueued)
        ];
    }
}