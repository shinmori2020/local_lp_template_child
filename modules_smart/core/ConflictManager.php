<?php
/**
 * Conflict Manager - 既存システムとの競合を防ぐ安全機構
 * 
 * modules_complete との共存を安全に行うための管理クラス
 * 
 * @package SmartModules
 */

// 直接アクセスを防ぐ
if (!defined('ABSPATH')) {
    exit;
}

class SmartConflictManager {
    
    private static $instance = null;
    private $existing_shortcodes = [];
    private $existing_acf_groups = [];
    private $existing_assets = [];
    
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
     * 競合チェック初期化
     */
    public function init() {
        // 既存システムの検出
        add_action('init', [$this, 'detect_existing_systems'], 5);
        
        // 競合警告
        add_action('admin_notices', [$this, 'show_conflict_warnings']);
        
        // アセット重複防止
        add_action('wp_enqueue_scripts', [$this, 'prevent_asset_conflicts'], 5);
        
        error_log('SmartConflictManager: 競合管理システム初期化');
    }
    
    /**
     * 既存システムを検出
     */
    public function detect_existing_systems() {
        // modules_complete システムの検出
        if (class_exists('CompleteModuleLoader')) {
            $this->log_conflict('CompleteModuleLoader クラスが検出されました');
            
            // 既存ショートコードを記録
            $this->detect_existing_shortcodes();
        }
        
        // 既存ACFグループを検出
        $this->detect_existing_acf_groups();
        
        // 既存アセットを検出
        $this->detect_existing_assets();
    }
    
    /**
     * 既存ショートコードを検出
     */
    private function detect_existing_shortcodes() {
        global $shortcode_tags;
        
        $conflicting_shortcodes = [
            'hero_module',
            'problem_module',
            'benefit_module',
            'pricing_module',
            'contact_module'
        ];
        
        foreach ($conflicting_shortcodes as $shortcode) {
            if (isset($shortcode_tags[$shortcode])) {
                $this->existing_shortcodes[] = $shortcode;
                $this->log_conflict("既存ショートコード検出: [{$shortcode}]");
            }
        }
    }
    
    /**
     * 既存ACFグループを検出
     */
    private function detect_existing_acf_groups() {
        if (!function_exists('acf_get_field_groups')) {
            return;
        }
        
        $field_groups = acf_get_field_groups();
        
        foreach ($field_groups as $group) {
            if (strpos($group['key'], 'group_hero_complete') !== false ||
                strpos($group['key'], 'group_problem_complete') !== false) {
                $this->existing_acf_groups[] = $group['key'];
                $this->log_conflict("既存ACFグループ検出: {$group['key']}");
            }
        }
    }
    
    /**
     * 既存アセットを検出
     */
    private function detect_existing_assets() {
        // wp_enqueue_scripts で実行される想定
        add_action('wp_enqueue_scripts', function() {
            global $wp_styles, $wp_scripts;
            
            if (isset($wp_styles->registered['font-awesome'])) {
                $this->existing_assets[] = 'font-awesome';
                $this->log_conflict('既存 Font Awesome 検出');
            }
        }, 20);
    }
    
    /**
     * ショートコード競合をチェック
     */
    public function check_shortcode_conflict($shortcode_name) {
        global $shortcode_tags;
        
        if (isset($shortcode_tags[$shortcode_name])) {
            $this->log_conflict("ショートコード競合: [{$shortcode_name}] は既に登録済み");
            return true;
        }
        
        return false;
    }
    
    /**
     * 安全なショートコード登録
     */
    public function safe_register_shortcode($shortcode_name, $callback) {
        if ($this->check_shortcode_conflict($shortcode_name)) {
            // 競合がある場合は別名で登録
            $safe_name = 'smart_' . $shortcode_name;
            add_shortcode($safe_name, $callback);
            $this->log_conflict("安全な別名で登録: [{$safe_name}]");
            return $safe_name;
        } else {
            add_shortcode($shortcode_name, $callback);
            return $shortcode_name;
        }
    }
    
    /**
     * アセット重複を防止
     */
    public function prevent_asset_conflicts() {
        // Font Awesome の重複チェック
        if (wp_style_is('font-awesome', 'enqueued') || 
            wp_style_is('fontawesome', 'enqueued')) {
            
            // Smart Modules の Font Awesome を無効化
            wp_dequeue_style('font-awesome-smart');
            $this->log_conflict('Font Awesome 重複防止: Smart Modules版を無効化');
        }
    }
    
    /**
     * 管理画面に競合警告を表示
     */
    public function show_conflict_warnings() {
        if (!current_user_can('administrator')) {
            return;
        }
        
        $conflicts = $this->get_active_conflicts();
        
        if (!empty($conflicts)) {
            echo '<div class="notice notice-warning is-dismissible">';
            echo '<h3>⚠️ Smart Modules: システム競合の警告</h3>';
            echo '<p><strong>modules_complete システムとの競合が検出されました：</strong></p>';
            echo '<ul>';
            foreach ($conflicts as $conflict) {
                echo '<li>' . esc_html($conflict) . '</li>';
            }
            echo '</ul>';
            echo '<p><strong>推奨対応：</strong> 段階的移行を行い、最終的に一方のシステムを無効化してください。</p>';
            echo '</div>';
        }
    }
    
    /**
     * アクティブな競合を取得
     */
    private function get_active_conflicts() {
        $conflicts = [];
        
        // ショートコード競合
        if (!empty($this->existing_shortcodes)) {
            $conflicts[] = 'ショートコード競合: ' . implode(', ', $this->existing_shortcodes);
        }
        
        // ACF競合
        if (!empty($this->existing_acf_groups)) {
            $conflicts[] = 'ACFグループ競合: ' . count($this->existing_acf_groups) . '個';
        }
        
        // CompleteModuleLoader との同時動作
        if (class_exists('CompleteModuleLoader')) {
            $conflicts[] = 'modules_complete システムが同時動作中（メモリ使用量増加）';
        }
        
        return $conflicts;
    }
    
    /**
     * 移行モードを有効化
     */
    public function enable_migration_mode() {
        update_option('smart_modules_migration_mode', true);
        
        // 既存システムの一部機能を無効化
        add_action('init', function() {
            if (class_exists('CompleteModuleLoader')) {
                // 既存システムのショートコードを一時的に無効化
                remove_shortcode('hero_module');
                remove_shortcode('problem_module');
                
                $this->log_conflict('移行モード: 既存ショートコードを無効化');
            }
        }, 99);
    }
    
    /**
     * 競合ログを記録
     */
    private function log_conflict($message) {
        if (defined('WP_DEBUG') && WP_DEBUG) {
            error_log("SmartConflictManager: {$message}");
        }
    }
    
    /**
     * システム統計を取得
     */
    public function get_conflict_stats() {
        return [
            'shortcode_conflicts' => count($this->existing_shortcodes),
            'acf_conflicts' => count($this->existing_acf_groups),
            'asset_conflicts' => count($this->existing_assets),
            'migration_mode' => get_option('smart_modules_migration_mode', false)
        ];
    }
    
    /**
     * 安全な無効化
     */
    public function safe_deactivate() {
        // Smart Modules のショートコードを削除
        remove_shortcode('hero_smart_module');
        remove_shortcode('problem_smart_module');
        
        // アセットをdequeue
        wp_dequeue_style('smart-modules-common');
        
        delete_option('smart_modules_migration_mode');
        
        $this->log_conflict('Smart Modules: 安全に無効化完了');
    }
}