<?php
/**
 * Module Selector Admin Panel
 * モジュール選択・入れ替え管理システム
 */

// 直接アクセスを防ぐ
if (!defined('ABSPATH')) {
    exit;
}

/**
 * モジュール管理クラス
 */
class ModuleSelectorAdmin {
    
    public function __construct() {
        add_action('admin_menu', array($this, 'add_admin_menu'));
        add_action('admin_init', array($this, 'register_settings'));
        add_action('wp_ajax_toggle_module', array($this, 'handle_module_toggle'));
    }

    /**
     * 管理メニューに追加
     */
    public function add_admin_menu() {
        add_theme_page(
            'モジュール管理',
            'モジュール管理',
            'manage_options',
            'module-selector',
            array($this, 'admin_page')
        );
    }

    /**
     * 設定を登録
     */
    public function register_settings() {
        register_setting('module_selector_settings', 'active_modules');
        register_setting('module_selector_settings', 'module_categories');
    }

    /**
     * 利用可能なモジュールを取得
     */
    public function get_available_modules() {
        $modules_dir = get_stylesheet_directory() . '/modules_complete/';
        $categories = array();
        
        // カテゴリ別にスキャン
        $category_dirs = array('hero', 'content', 'social_proof', 'conversion', 'navigation', 'utility');
        
        foreach ($category_dirs as $category) {
            $category_path = $modules_dir . $category . '/';
            if (is_dir($category_path)) {
                $files = glob($category_path . '*_complete.php');
                foreach ($files as $file) {
                    $filename = basename($file, '.php');
                    $display_name = $this->get_module_display_name($file);
                    
                    $categories[$category][] = array(
                        'file' => $filename,
                        'path' => $file,
                        'name' => $display_name,
                        'active' => $this->is_module_active($filename)
                    );
                }
            }
        }
        
        // ルートディレクトリのモジュール
        $root_files = glob($modules_dir . '*_complete.php');
        foreach ($root_files as $file) {
            $filename = basename($file, '.php');
            $display_name = $this->get_module_display_name($file);
            
            $categories['その他'][] = array(
                'file' => $filename,
                'path' => $file,
                'name' => $display_name,
                'active' => $this->is_module_active($filename)
            );
        }
        
        return $categories;
    }

    /**
     * モジュールの表示名を取得
     */
    private function get_module_display_name($file_path) {
        $content = file_get_contents($file_path);
        
        // コメントから表示名を抽出
        if (preg_match('/\* (.+) Module/i', $content, $matches)) {
            return $matches[1];
        }
        
        // ファイル名から推測
        $filename = basename($file_path, '_complete.php');
        return ucfirst(str_replace('_', ' ', $filename));
    }

    /**
     * モジュールがアクティブかチェック
     */
    private function is_module_active($module_file) {
        $active_modules = get_option('active_modules', array());
        return in_array($module_file, $active_modules);
    }

    /**
     * モジュールの有効/無効を切り替え
     */
    public function handle_module_toggle() {
        if (!current_user_can('manage_options')) {
            wp_die('Unauthorized');
        }
        
        check_ajax_referer('module_toggle_nonce', 'nonce');
        
        $module_file = sanitize_text_field($_POST['module']);
        $action = sanitize_text_field($_POST['action_type']);
        
        $active_modules = get_option('active_modules', array());
        
        if ($action === 'activate') {
            if (!in_array($module_file, $active_modules)) {
                $active_modules[] = $module_file;
            }
        } else {
            $active_modules = array_diff($active_modules, array($module_file));
        }
        
        update_option('active_modules', array_values($active_modules));
        
        wp_send_json_success(array(
            'message' => 'モジュールの状態を更新しました',
            'active' => $action === 'activate'
        ));
    }

    /**
     * 管理画面のHTML
     */
    public function admin_page() {
        $modules = $this->get_available_modules();
        ?>
        <div class="wrap">
            <h1>モジュール管理</h1>
            <p>使用するモジュールを選択してください。チェックを入れたモジュールのみがサイトで利用可能になります。</p>
            
            <style>
            .module-category {
                margin-bottom: 30px;
                border: 1px solid #ddd;
                border-radius: 5px;
            }
            .category-header {
                background: #f8f9fa;
                padding: 15px;
                border-bottom: 1px solid #ddd;
                font-weight: bold;
                font-size: 16px;
            }
            .module-list {
                padding: 15px;
            }
            .module-item {
                display: flex;
                align-items: center;
                padding: 10px 0;
                border-bottom: 1px solid #eee;
            }
            .module-item:last-child {
                border-bottom: none;
            }
            .module-toggle {
                margin-right: 15px;
            }
            .module-info {
                flex-grow: 1;
            }
            .module-name {
                font-weight: 600;
                color: #2c3e50;
            }
            .module-file {
                font-size: 12px;
                color: #666;
                font-family: monospace;
            }
            .module-status {
                padding: 4px 8px;
                border-radius: 3px;
                font-size: 12px;
                font-weight: bold;
            }
            .status-active {
                background: #d4edda;
                color: #155724;
            }
            .status-inactive {
                background: #f8d7da;
                color: #721c24;
            }
            .category-stats {
                font-size: 14px;
                color: #666;
                margin-left: 10px;
            }
            </style>

            <div id="module-manager">
                <?php foreach ($modules as $category => $module_list): ?>
                    <?php 
                    $active_count = count(array_filter($module_list, function($m) { return $m['active']; }));
                    $total_count = count($module_list);
                    ?>
                    <div class="module-category">
                        <div class="category-header">
                            <?php echo esc_html($category); ?>
                            <span class="category-stats">(<?php echo $active_count; ?>/<?php echo $total_count; ?> アクティブ)</span>
                        </div>
                        <div class="module-list">
                            <?php foreach ($module_list as $module): ?>
                                <div class="module-item">
                                    <label class="module-toggle">
                                        <input type="checkbox" 
                                               class="module-checkbox" 
                                               data-module="<?php echo esc_attr($module['file']); ?>"
                                               <?php checked($module['active']); ?>>
                                    </label>
                                    <div class="module-info">
                                        <div class="module-name"><?php echo esc_html($module['name']); ?></div>
                                        <div class="module-file"><?php echo esc_html($module['file']); ?>.php</div>
                                    </div>
                                    <div class="module-status <?php echo $module['active'] ? 'status-active' : 'status-inactive'; ?>">
                                        <?php echo $module['active'] ? 'アクティブ' : '無効'; ?>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>

            <script>
            jQuery(document).ready(function($) {
                $('.module-checkbox').on('change', function() {
                    const $checkbox = $(this);
                    const module = $checkbox.data('module');
                    const isChecked = $checkbox.is(':checked');
                    const $item = $checkbox.closest('.module-item');
                    const $status = $item.find('.module-status');
                    
                    // UI即座更新
                    if (isChecked) {
                        $status.removeClass('status-inactive').addClass('status-active').text('アクティブ');
                    } else {
                        $status.removeClass('status-active').addClass('status-inactive').text('無効');
                    }
                    
                    // AJAX でサーバー更新
                    $.ajax({
                        url: ajaxurl,
                        type: 'POST',
                        data: {
                            action: 'toggle_module',
                            module: module,
                            action_type: isChecked ? 'activate' : 'deactivate',
                            nonce: '<?php echo wp_create_nonce('module_toggle_nonce'); ?>'
                        },
                        success: function(response) {
                            if (response.success) {
                                console.log('モジュール更新成功: ' + module);
                                // カテゴリ統計更新
                                updateCategoryStats();
                            } else {
                                console.error('モジュール更新失敗: ' + module);
                                // エラー時は元に戻す
                                $checkbox.prop('checked', !isChecked);
                            }
                        },
                        error: function() {
                            console.error('通信エラー');
                            // エラー時は元に戻す
                            $checkbox.prop('checked', !isChecked);
                        }
                    });
                });
                
                function updateCategoryStats() {
                    $('.module-category').each(function() {
                        const $category = $(this);
                        const $checkboxes = $category.find('.module-checkbox');
                        const total = $checkboxes.length;
                        const active = $checkboxes.filter(':checked').length;
                        $category.find('.category-stats').text(`(${active}/${total} アクティブ)`);
                    });
                }
            });
            </script>
        </div>
        <?php
    }
}

// 管理画面を初期化
if (is_admin()) {
    new ModuleSelectorAdmin();
}
?> 