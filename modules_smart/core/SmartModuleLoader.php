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
        add_action('acf/init', [$this, 'register_all_acf_fields']);
        add_action('init', [$this, 'register_all_acf_fields']);
        add_action('wp_loaded', [$this, 'register_all_acf_fields']);
        
        // AOS初期化
        add_action('wp_footer', [$this, 'init_aos']);
        
        // デバッグ情報（常に表示）
        add_action('wp_footer', [$this, 'debug_info']);
        
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
        
        // 強制的にheroとproblemを準備（テスト用）
        $this->prepare_module('hero');
        $this->prepare_module('problem');
        
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
        // 初回読み込み時のみ実際にモジュールを読み込み
        if (!isset(self::$loaded_modules[$module_name])) {
            $this->load_module($module_name);
        }
        
        // モジュールクラスを取得してレンダリング
        $module_class = 'Smart' . ucfirst($module_name) . 'Module';
        
        if (class_exists($module_class)) {
            $module = new $module_class();
            return $module->render($atts);
        }
        
        return '<!-- Smart Module Error: ' . $module_name . ' not found -->';
    }
    
    /**
     * モジュールファイルを実際に読み込み
     */
    private function load_module($module_name) {
        $module_path = get_stylesheet_directory() . "/modules_smart/modules/{$module_name}/{$module_name}_module.php";
        
        if (file_exists($module_path)) {
            require_once $module_path;
            self::$loaded_modules[$module_name] = true;
            error_log("SmartModuleLoader: モジュール読み込み完了 - {$module_name}");
        } else {
            error_log("SmartModuleLoader: モジュールファイルが見つかりません - {$module_path}");
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
            self::enqueue_asset(
                'smart-modules-common',
                get_stylesheet_directory_uri() . '/modules_smart/assets/css/common.css',
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
            $module_dirs = glob($modules_dir . '/*', GLOB_ONLYDIR);
            foreach ($module_dirs as $dir) {
                $module_name = basename($dir);
                $module_file = $dir . '/' . $module_name . '_module.php';
                
                if (file_exists($module_file)) {
                    $modules[] = $module_name;
                }
            }
        }
        
        return $modules;
    }
    
    /**
     * 特定モジュールのACFフィールドを登録
     */
    private function register_module_acf_fields($module_name) {
        $module_path = get_stylesheet_directory() . "/modules_smart/modules/{$module_name}/{$module_name}_module.php";
        
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
                            'param' => 'post_type',
                            'operator' => '==',
                            'value' => 'page',
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
                echo "<li>{$group_key} - Smart " . ucfirst($module_name) . " Module</li>";
            }
            echo '</ul>';
        }
        
        echo '</div>';
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