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
            return $values;
        }
        
        // デフォルト値のキーに基づいてACF値を取得
        foreach ($this->get_defaults() as $key => $default_value) {
            $acf_key = $this->module_name . '_' . $key;
            $acf_value = get_field($acf_key, $post_id);
            
            if ($acf_value !== null && $acf_value !== '') {
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
        $css_handle = 'smart-' . $this->module_name . '-css';
        $css_file_path = get_stylesheet_directory() . "/modules_smart/assets/css/{$this->module_name}.css";
        
        // CSSファイル存在確認
        if (file_exists($css_file_path)) {
            $css_url = get_stylesheet_directory_uri() . "/modules_smart/assets/css/{$this->module_name}.css";
            SmartModuleLoader::enqueue_asset($css_handle, $css_url, 'css');
        } else {
            error_log("SmartModuleBase: CSSファイルが見つかりません - {$css_file_path}");
        }
        
        // JSファイルがあれば読み込み
        $js_path = get_stylesheet_directory() . "/modules_smart/assets/js/{$this->module_name}.js";
        if (file_exists($js_path)) {
            $js_handle = 'smart-' . $this->module_name . '-js';
            $js_url = get_stylesheet_directory_uri() . "/modules_smart/assets/js/{$this->module_name}.js";
            SmartModuleLoader::enqueue_asset($js_handle, $js_url, 'js');
        }
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