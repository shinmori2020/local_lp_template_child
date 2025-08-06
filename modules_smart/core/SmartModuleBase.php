<?php
/**
 * Smart Module Base Class - 全モジュールの基底クラス
 * 
 * 機能:
 * - ACF設定不要のデフォルト値
 * - 単体完結機能
 * - HTML/CSS/JS統合管理
 * - ACF値による上書き機能
 * 
 * @package SmartModules
 */

// 直接アクセスを防ぐ
if (!defined('ABSPATH')) {
    exit;
}

abstract class SmartModuleBase {
    
    protected $module_name;
    protected $unique_id;
    
    public function __construct() {
        $this->module_name = $this->get_module_name();
        $this->unique_id = $this->generate_unique_id();
        
        // ACFフィールドはSmartModuleLoaderで一括登録するため、ここでは登録しない
        // $this->register_acf_fields();
    }
    
    /**
     * モジュール名を取得（子クラスで実装）
     */
    abstract protected function get_module_name(): string;
    
    /**
     * デフォルト値を取得（子クラスで実装）
     */
    abstract protected function get_defaults(): array;
    
    /**
     * デフォルト値を外部から取得（ACFフィールド登録用）
     */
    public function get_defaults_public(): array {
        return $this->get_defaults();
    }
    
    /**
     * HTMLテンプレートを生成（子クラスで実装）
     */
    abstract protected function generate_html(array $data): string;
    
    /**
     * モジュールをレンダリング
     */
    public function render($atts = []) {
        // デフォルト値を取得
        $defaults = $this->get_defaults();
        
        // ACFの値で上書き
        $acf_values = $this->get_acf_values();
        $data = array_merge($defaults, $acf_values);
        
        // ショートコード属性で最終上書き
        if (!empty($atts)) {
            $data = array_merge($data, $atts);
        }
        
        // アセットを読み込み
        $this->enqueue_assets();
        
        // HTMLを生成
        return $this->generate_html($data);
    }
    
    /**
     * ACF値を取得
     */
    protected function get_acf_values() {
        $values = [];
        $post_id = get_the_ID();
        
        if (!$post_id) {
            error_log("SmartModuleBase: post_id が取得できません - {$this->module_name}");
            return $values;
        }
        
        // デフォルト値のキーに基づいてACF値を取得
        foreach ($this->get_defaults() as $key => $default_value) {
            $acf_key = $this->module_name . '_' . $key;
            $acf_value = get_field($acf_key, $post_id);
            
            if ($acf_value !== null && $acf_value !== '' && $acf_value !== false) {
                $values[$key] = $acf_value;
            }
        }
        
        return $values;
    }
    
    /**
     * ACFフィールドを登録
     */
    protected function register_acf_fields() {
        if (!function_exists('acf_add_local_field_group')) {
            return;
        }
        
        $fields = $this->build_acf_fields();
        
        if (empty($fields)) {
            return;
        }
        
        acf_add_local_field_group([
            'key' => 'group_smart_' . $this->module_name,
            'title' => 'Smart ' . ucfirst($this->module_name) . ' Module',
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
        ]);
        
        error_log("SmartModuleBase: ACFフィールド登録完了 - {$this->module_name}");
    }
    
    /**
     * ACFフィールド配列を構築
     */
    protected function build_acf_fields() {
        $fields = [];
        $defaults = $this->get_defaults();
        
        foreach ($defaults as $key => $default_value) {
            $field_key = 'field_smart_' . $this->module_name . '_' . $key;
            $field_name = $this->module_name . '_' . $key;
            
            // データ型に基づいてフィールドタイプを決定
            $field_type = $this->determine_field_type($default_value);
            
            $field = [
                'key' => $field_key,
                'label' => $this->format_label($key),
                'name' => $field_name,
                'type' => $field_type,
                'default_value' => $default_value,
                'placeholder' => $default_value,
            ];
            
            // テキストエリアの場合の特別設定
            if ($field_type === 'textarea') {
                $field['rows'] = 3;
            }
            
            $fields[] = $field;
        }
        
        return $fields;
    }
    
    /**
     * デフォルト値からフィールドタイプを判定
     */
    protected function determine_field_type($value) {
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
    protected function format_label($key) {
        return ucwords(str_replace('_', ' ', $key));
    }
    
    /**
     * ユニークIDを生成
     */
    protected function generate_unique_id() {
        return 'smart-' . $this->module_name . '-' . uniqid();
    }
    
    /**
     * アセットを読み込み
     */
    protected function enqueue_assets() {
        // 新構造と旧構造の両方に対応
        $asset_paths = $this->get_asset_paths();
        
        // CSS読み込み
        $css_handle = 'smart-' . $this->module_name . '-css';
        error_log("SmartModuleBase: CSS読み込み試行 - {$asset_paths['css_file']}");
        error_log("SmartModuleBase: CSSファイル存在確認 - " . (file_exists($asset_paths['css_file']) ? 'YES' : 'NO'));
        
        if (file_exists($asset_paths['css_file'])) {
            $version = filemtime($asset_paths['css_file']); // キャッシュバスター
            $css_url = $asset_paths['css_url'] . '?v=' . $version;
            error_log("SmartModuleBase: CSS URL - {$css_url}");
            SmartModuleLoader::enqueue_asset($css_handle, $css_url, 'css');
        } else {
            error_log("SmartModuleBase: CSSファイルが見つかりません - {$asset_paths['css_file']}");
        }
        
        // JS読み込み
        if (file_exists($asset_paths['js_file'])) {
            $js_handle = 'smart-' . $this->module_name . '-js';
            $version = filemtime($asset_paths['js_file']); // キャッシュバスター
            $js_url = $asset_paths['js_url'] . '?v=' . $version;
            SmartModuleLoader::enqueue_asset($js_handle, $js_url, 'js');
        }
    }
    
    /**
     * アセットファイルのパスを取得（新旧構造対応）
     */
    private function get_asset_paths() {
        $theme_dir = get_stylesheet_directory();
        $theme_uri = get_stylesheet_directory_uri();
        
        // 新構造を優先して検索 (modules/*module_name/module_name_module_01/assets/)
        // 順序番号付きディレクトリにも対応
        $new_structure_pattern = $theme_dir . '/modules_smart/modules/*' . $this->module_name . '/' . $this->module_name . '_module_*/assets';
        $new_structure_dirs = glob($new_structure_pattern, GLOB_ONLYDIR);
        
        error_log("SmartModuleBase: アセット検索パターン - {$new_structure_pattern}");
        error_log("SmartModuleBase: 検出されたアセットディレクトリ - " . print_r($new_structure_dirs, true));
        
        if (!empty($new_structure_dirs)) {
            // 01バージョンを優先、なければ最初に見つかったもの
            $selected_assets_dir = null;
            foreach ($new_structure_dirs as $assets_dir) {
                $selected_assets_dir = $assets_dir;
                if (strpos($assets_dir, '_module_01/assets') !== false) {
                    break;
                }
            }
            
            $relative_path = str_replace($theme_dir, '', $selected_assets_dir);
            // Windowsのパス区切り文字を統一
            $relative_path = str_replace('\\', '/', $relative_path);
            $asset_paths = [
                'css_file' => $selected_assets_dir . '/css/' . $this->module_name . '.css',
                'css_url' => $theme_uri . $relative_path . '/css/' . $this->module_name . '.css',
                'js_file' => $selected_assets_dir . '/js/' . $this->module_name . '.js',
                'js_url' => $theme_uri . $relative_path . '/js/' . $this->module_name . '.js'
            ];
            
            error_log("SmartModuleBase: 最終アセットパス - " . print_r($asset_paths, true));
            return $asset_paths;
        }
        
        // 旧構造にフォールバック (modules_smart/assets/)
        return [
            'css_file' => $theme_dir . '/modules_smart/assets/css/' . $this->module_name . '.css',
            'css_url' => $theme_uri . '/modules_smart/assets/css/' . $this->module_name . '.css',
            'js_file' => $theme_dir . '/modules_smart/assets/js/' . $this->module_name . '.js',
            'js_url' => $theme_uri . '/modules_smart/assets/js/' . $this->module_name . '.js'
        ];
    }
    
    /**
     * HTMLを安全に出力
     */
    protected function esc_html_with_breaks($text) {
        return nl2br(esc_html($text));
    }
    
    /**
     * HTMLタグを許可して出力（限定的）
     */
    protected function wp_kses_basic($text) {
        $allowed_tags = [
            'br' => [],
            'strong' => [],
            'b' => [],
            'em' => [],
            'i' => [],
            'u' => [],
            'span' => ['class' => []],
        ];
        
        return wp_kses($text, $allowed_tags);
    }
}