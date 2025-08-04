<?php
/**
 * Module Loader - Complete Independent Modules System
 * 
 * すべての完全独立型モジュールを自動で読み込み、
 * ショートコードシステムを有効化します。
 * 
 * 使用方法: functions.phpに以下を追加
 * require_once get_stylesheet_directory() . '/modules_complete/module_loader.php';
 */

// 直接アクセスを防ぐ
if (!defined('ABSPATH')) {
    exit;
}

/**
 * モジュールローダークラス
 */
class CompleteModuleLoader {
    
    private $modules_directory;
    private $loaded_modules = array();
    
    public function __construct() {
        $this->modules_directory = get_stylesheet_directory() . '/modules_complete/';
        $this->init();
    }
    
    /**
     * 初期化
     */
    private function init() {
        // 🚀 重要: モジュールを即座に読み込み（ACFフィールド登録のため）
        $this->load_all_modules();
        
        // ACF動的表示制御を初期化
        $this->init_dynamic_acf_control();
        

        
        // その他のフックは元のまま
        add_action('wp_enqueue_scripts', array($this, 'enqueue_font_awesome'));
        add_action('wp_head', array($this, 'add_global_styles'));
        
        // 管理画面にモジュール管理を追加
        add_action('admin_menu', array($this, 'add_admin_menu'));
        
        // ショートコード一覧取得用のAJAXエンドポイント
        add_action('wp_ajax_get_module_list', array($this, 'ajax_get_module_list'));
        add_action('wp_ajax_nopriv_get_module_list', array($this, 'ajax_get_module_list'));
    }
    
    /**
     * ACF表示制御を初期化（手動選択方式）
     */
    private function init_dynamic_acf_control() {
        // 手動選択方式：確実で使いやすい
        add_action('add_meta_boxes', array($this, 'add_module_selector_metabox'));
        add_action('save_post', array($this, 'save_module_selection'));
        add_action('admin_footer', array($this, 'add_module_control_script'));
    }

    /**
     * モジュール選択メタボックスを追加
     */
    public function add_module_selector_metabox() {
        add_meta_box(
            'module_selector',
            '🔧 使用するモジュールを選択',
            array($this, 'render_module_selector'),
            'page',
            'side',
            'high'
        );
    }

    /**
     * モジュール選択UI描画
     */
    public function render_module_selector($post) {
        wp_nonce_field('module_selector_nonce', 'module_selector_nonce_field');
        
        $selected_modules = get_post_meta($post->ID, '_selected_modules', true) ?: array();
        
        $available_modules = array(
            'firstview_01_module' => 'Firstview Module 01',
            'firstview_02_module' => 'Firstview Module 02',
            'firstview_03_module' => 'Firstview Module 03',
            'firstview_04_module' => 'Firstview Module 04',
            'firstview_05_module' => 'Firstview Module 05',
            'hero_module' => 'Hero Module',
            'hero_01_module' => 'Hero Module 01',
            'hero_02_module' => 'Hero Module 02',
            'hero_03_module' => 'Hero Module 03',
            'hero_04_module' => 'Hero Module 04',
            'slider_01_module' => 'Slider 01 Module (モダンスライダー)',
            'problem_01_module' => 'Problem 01 Module (課題提起)',
            'problem_02_module' => 'Problem 02 Module (課題提起デザイン案1)',
            'problem_03_module' => 'Problem 03 Module (課題提起デザイン案2)',
            'problem_04_module' => 'Problem 04 Module (課題提起デザイン案3)',
            'problem_05_module' => 'Problem 05 Module (課題提起デザイン案4)',
            'problem_06_module' => 'Problem 06 Module (課題提起デザイン案5)',
            'benefit_01_module' => 'Benefit 01 Module (メリット効果)',
            'main_features_01_module' => 'Main Features 01 Module (主要機能)',
            'achievement_01_module' => 'Achievement 01 Module (導入実績)',
            'unique_points_01_module' => 'Unique Points 01 Module (差別化ポイント)',
            'pricing_01_module' => 'Pricing 01 Module (料金プラン)',
            'implementation_steps_01_module' => 'Implementation Steps 01 Module (導入の流れ)',
            'product_slider_01_module' => 'Product Slider 01 Module (商品スライダー)',
            'minimal_product_slider_01_module' => 'Minimal Product Slider 01 Module (ミニマル商品スライダー)',
            'problem_module' => 'Problem Module (既存)',
            'benefit_module' => 'Benefit Module (既存)', 
            'pricing_module' => 'Pricing Module',
            'contact_module' => 'Contact Module'
        );
        
        echo '<p><strong>このページで使用するモジュールを選択してください：</strong></p>';
        
        foreach ($available_modules as $module_key => $module_name) {
            $checked = in_array($module_key, $selected_modules) ? 'checked' : '';
            echo '<label style="display: block; margin: 8px 0;">';
            echo '<input type="checkbox" name="selected_modules[]" value="' . esc_attr($module_key) . '" ' . $checked . '> ';
            echo esc_html($module_name);
            echo '</label>';
        }
        
        echo '<p><em>💡 選択したモジュールのACFフィールドのみが下部に表示されます</em></p>';
    }

    /**
     * モジュール選択を保存
     */
    public function save_module_selection($post_id) {
        if (!isset($_POST['module_selector_nonce_field']) || 
            !wp_verify_nonce($_POST['module_selector_nonce_field'], 'module_selector_nonce')) {
            return;
        }
        
        if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
            return;
        }
        
        if (!current_user_can('edit_page', $post_id)) {
            return;
        }
        
        $selected_modules = isset($_POST['selected_modules']) ? $_POST['selected_modules'] : array();
        update_post_meta($post_id, '_selected_modules', $selected_modules);
    }

    /**
     * ACFフィールド表示制御スクリプト
     */
    public function add_module_control_script() {
        global $pagenow, $post;
        
        if ($pagenow !== 'post.php' && $pagenow !== 'post-new.php') {
            return;
        }
        
        if (!$post || $post->post_type !== 'page') {
            return;
        }
        
        $selected_modules = get_post_meta($post->ID, '_selected_modules', true) ?: array();
        ?>
        <style>
        /* ACF表示制御用CSS - ACFの内部構造を破壊しない */
        .module-control-hidden {
            display: none !important;
        }
        
        .module-control-visible {
            display: block !important;
        }
        
        /* 初期状態：モジュールが選択されていない場合のみ非表示 */
        body.no-modules-selected .postbox[id*="acf-group"]:not(.non-module-field) {
            display: none !important;
        }
        
        /* デバッグ用：制御されているフィールドに境界線 */
        .module-controlled-field {
            border-left: 3px solid #0073aa;
        }
        </style>
        
        <script>
        jQuery(document).ready(function($) {
            var selectedModules = <?php echo json_encode($selected_modules); ?>;
            
            // モジュールキーマッピング（共通定義）
            var moduleKeyMappings = {
                'firstview_01_module': 'group_firstview_01_complete',
                'firstview_02_module': 'group_firstview_02_complete',
                'firstview_03_module': 'group_firstview_03_complete',
                'firstview_04_module': 'group_firstview_04',
                'firstview_05_module': 'group_firstview_05',
                'hero_module': 'group_hero_complete',
                'hero_01_module': 'group_hero_01_complete',
                'hero_02_module': 'group_hero_02_complete',
                'hero_03_module': 'group_hero_03_complete',
                'hero_04_module': 'group_hero_04_complete',
                'slider_01_module': 'group_slider_01_complete_v2',
                'problem_01_module': 'group_problem_01_complete',
                'problem_02_module': 'group_problem_02_complete',
                'problem_03_module': 'group_problem_03_complete',
                'problem_04_module': 'group_problem_04_complete',
                'problem_05_module': 'group_problem_05_complete',
                'problem_06_module': 'group_problem_06_complete',
                'benefit_01_module': 'group_benefit_01_complete',
                'main_features_01_module': 'group_main_features_01_complete',
                'achievement_01_module': 'group_achievement_01_complete',
                'unique_points_01_module': 'group_unique_points_01_complete',
                'pricing_01_module': 'group_pricing_01_complete',
                'implementation_steps_01_module': 'group_implementation_steps_01_complete',
                'problem_module': 'group_problem_complete',
                'benefit_module': 'group_benefit_complete',
                'pricing_module': 'group_pricing_complete',
                'contact_module': 'group_contact_complete'
            };
            
            function updateFieldVisibility() {
                console.log('🔧 ACF表示制御開始 - CSS方式');
                
                // bodyクラスでグローバル制御
                if (selectedModules.length === 0) {
                    $('body').addClass('no-modules-selected');
                } else {
                    $('body').removeClass('no-modules-selected');
                }
                
                // ACFフィールドボックスを識別・分類
                $('.postbox[id*="acf-group"]').each(function() {
                    var $postbox = $(this);
                    var postboxId = $postbox.attr('id') || '';
                    var postboxText = $postbox.text().toLowerCase();
                    
                    // モジュールフィールドかどうかを判定
                    var isModuleField = false;
                    var belongsToModule = null;
                    
                    Object.keys(moduleKeyMappings).forEach(function(moduleKey) {
                        var expectedGroupKey = moduleKeyMappings[moduleKey];
                        
                        if (postboxId.includes(expectedGroupKey) || 
                            postboxText.includes(expectedGroupKey.toLowerCase())) {
                            isModuleField = true;
                            belongsToModule = moduleKey;
                        }
                    });
                    
                    if (isModuleField) {
                        // モジュールフィールドの制御
                        $postbox.addClass('module-controlled-field');
                        
                        if (selectedModules.length === 0) {
                            // 何も選択されていない → 非表示（CSS制御）
                            $postbox.addClass('module-control-hidden').removeClass('module-control-visible');
                        } else if (selectedModules.includes(belongsToModule)) {
                            // 選択されている → 表示
                            $postbox.addClass('module-control-visible').removeClass('module-control-hidden');
                        } else {
                            // 選択されていない → 非表示
                            $postbox.addClass('module-control-hidden').removeClass('module-control-visible');
                        }
                    } else {
                        // 非モジュールフィールド → 常に表示
                        $postbox.addClass('non-module-field')
                                .removeClass('module-control-hidden module-controlled-field')
                                .addClass('module-control-visible');
                    }
                });
                
                console.log('✅ ACF表示制御完了:', {
                    selectedModules: selectedModules,
                    moduleFields: $('.module-controlled-field').length,
                    nonModuleFields: $('.non-module-field').length
                });
            }
            
            // チェックボックス変更時の処理
            $('input[name="selected_modules[]"]').change(function() {
                selectedModules = [];
                $('input[name="selected_modules[]"]:checked').each(function() {
                    selectedModules.push($(this).val());
                });
                
                console.log('📝 モジュール選択変更:', selectedModules);
                updateFieldVisibility();
            });
            
            // 初期表示（1回のみ、ACF読み込み完了後）
            function initializeVisibility() {
                if ($('.postbox[id*="acf-group"]').length > 0) {
                    updateFieldVisibility();
                    console.log('🚀 ACF表示制御初期化完了');
                } else {
                    // ACFがまだ読み込まれていない場合は少し待つ
                    setTimeout(initializeVisibility, 300);
                }
            }
            
            // DOM完全読み込み後に初期化
            setTimeout(initializeVisibility, 100);
            
            // DOM変更監視（最小限）
            var observer = new MutationObserver(function(mutations) {
                var needsUpdate = false;
                
                mutations.forEach(function(mutation) {
                    if (mutation.addedNodes.length > 0) {
                        for (var i = 0; i < mutation.addedNodes.length; i++) {
                            var node = mutation.addedNodes[i];
                            if (node.nodeType === 1 && 
                                (node.className && node.className.includes('acf') || 
                                 node.id && node.id.includes('acf-group'))) {
                                needsUpdate = true;
                                break;
                            }
                        }
                    }
                });
                
                if (needsUpdate) {
                    clearTimeout(window.acfUpdateTimeout);
                    window.acfUpdateTimeout = setTimeout(updateFieldVisibility, 200);
                }
            });
            
            observer.observe(document.body, {
                childList: true,
                subtree: true
            });
        });
        </script>
        <?php
    }
    

    
    /**
     * カスタムlocation ruleタイプを追加
     */
    public function add_custom_location_rules($choices) {
        $choices['Module']['module_shortcode'] = 'モジュールショートコード';
        return $choices;
    }
    
    /**
     * モジュールショートコードの選択肢を取得
     */
    public function get_module_shortcode_choices($choices) {
        $choices = array();
        
        // 読み込み済みモジュールから自動生成
        foreach ($this->loaded_modules as $module) {
            // ファイル名からショートコード名を推測
            $shortcode = str_replace('_complete', '_module', $module);
            $choices[$shortcode] = $shortcode;
        }
        
        return $choices;
    }
    
    /**
     * モジュールショートコード判定ロジック
     */

    
    /**
     * すべてのモジュールを読み込み
     */
    public function load_all_modules() {
        $module_files = $this->get_module_files();
        
        foreach ($module_files as $file) {
            $this->load_module($file);
        }
        
        // ローダー完了をログに記録
        error_log('Complete Module Loader: Loaded ' . count($this->loaded_modules) . ' modules');
    }
    
    /**
     * モジュールファイル一覧を取得（サブフォルダー対応）
     */
    private function get_module_files() {
        $files = array();
        
        if (!is_dir($this->modules_directory)) {
            return $files;
        }
        
        try {
            // RecursiveDirectoryIterator で再帰検索（サブフォルダー対応）
            $iterator = new RecursiveDirectoryIterator(
                $this->modules_directory, 
                RecursiveDirectoryIterator::SKIP_DOTS
            );
            $recursive = new RecursiveIteratorIterator($iterator);
            
            foreach ($recursive as $file) {
                if ($file->isFile()) {
                    $filename = $file->getFilename();
                    
                    // module_loader.phpは除外
                    if ($filename === 'module_loader.php') {
                        continue;
                    }
                    
                    // _complete.phpで終わるファイルのみを対象
                    if (preg_match('/_complete\.php$/', $filename)) {
                        $files[] = $file->getPathname();
                    }
                }
            }
            
        } catch (Exception $e) {
            // RecursiveDirectoryIteratorでエラーが発生した場合は従来の方法にフォールバック
            error_log('Recursive module search failed, falling back to single directory: ' . $e->getMessage());
            
            $iterator = new DirectoryIterator($this->modules_directory);
            
            foreach ($iterator as $file) {
                if ($file->isDot() || $file->isDir()) {
                    continue;
                }
                
                $filename = $file->getFilename();
                
                // module_loader.phpは除外
                if ($filename === 'module_loader.php') {
                    continue;
                }
                
                // _complete.phpで終わるファイルのみを対象
                if (preg_match('/_complete\.php$/', $filename)) {
                    $files[] = $file->getPathname();
                }
            }
        }
        
        return $files;
    }
    
    /**
     * 個別モジュールを読み込み
     */
    private function load_module($file_path) {
        if (!file_exists($file_path)) {
            return false;
        }
        
        try {
            require_once $file_path;
            
            $module_name = basename($file_path, '.php');
            $this->loaded_modules[] = $module_name;
            
            return true;
            
        } catch (Exception $e) {
            error_log('Module Load Error: ' . $file_path . ' - ' . $e->getMessage());
            return false;
        }
    }
    
    /**
     * Font Awesomeを読み込み
     */
    public function enqueue_font_awesome() {
        wp_enqueue_style(
            'font-awesome',
            'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css',
            array(),
            '6.0.0'
        );
    }
    
    /**
     * グローバルスタイルを追加
     */
    public function add_global_styles() {
        ?>
        <style>
        /* Complete Modules Global Styles - Simplified Version */
        .complete-modules-container {
            max-width: 100%;
            overflow-x: hidden;
        }
        
        .complete-modules-container * {
            box-sizing: border-box;
        }
        
        /* レイアウトクラス */
        .complete-modules-container.full-width .container,
        .complete-modules-container .container.full-width {
            max-width: 100% !important;
            padding: 0 20px !important;
        }
        
        .complete-modules-container.no-padding .container,
        .complete-modules-container .container.no-padding {
            max-width: 100% !important;
            padding: 0 !important;
        }
        
        .complete-modules-container.wide .container,
        .complete-modules-container .container.wide {
            max-width: 1400px !important;
        }
        
        .complete-modules-container.narrow .container,
        .complete-modules-container .container.narrow {
            max-width: 1000px !important;
        }
        
        /* 共通機能 */
        html {
            scroll-behavior: smooth;
        }
        
        .complete-modules-container img {
            max-width: 100%;
            height: auto;
        }
        
        /* アニメーション */
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        
        .fade-in-up {
            animation: fadeInUp 0.6s ease-out;
        }
        
        /* グリッドシステム */
        .module-grid {
            display: grid;
            gap: 30px;
        }
        
        @media (max-width: 768px) {
            .module-grid {
                gap: 20px;
            }
            
            .complete-modules-container .container {
                padding: 0 15px !important;
            }
        }
        </style>
        <?php
    }
    
    /**
     * 管理画面メニューを追加
     */
    public function add_admin_menu() {
        add_theme_page(
            'Complete Modules Manager',
            'モジュール管理',
            'manage_options',
            'complete-modules',
            array($this, 'admin_page')
        );
    }
    
    /**
     * 管理画面ページ
     */
    public function admin_page() {
        ?>
        <div class="wrap">
            <h1>Complete Modules Manager</h1>
            <p>完全独立型モジュールシステムの管理画面です。</p>
            
            <div class="card">
                <h2>読み込み済みモジュール (<?php echo count($this->loaded_modules); ?>個)</h2>
                <ul>
                    <?php foreach ($this->loaded_modules as $module): ?>
                        <li><strong><?php echo esc_html($module); ?></strong></li>
                    <?php endforeach; ?>
                </ul>
            </div>
            
            <div class="card">
                <h2>利用可能なショートコード</h2>
                <table class="wp-list-table widefat fixed striped">
                    <thead>
                        <tr>
                            <th>ショートコード</th>
                            <th>説明</th>
                            <th>使用例</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><code>[hero_module]</code></td>
                            <td>ヒーローセクション</td>
                            <td><code>[hero_module title="カスタムタイトル"]</code></td>
                        </tr>
                        <tr>
                            <td><code>[problem_module]</code></td>
                            <td>課題セクション</td>
                            <td><code>[problem_module title="お困りごと"]</code></td>
                        </tr>
                        <tr>
                            <td><code>[benefit_module]</code></td>
                            <td>ベネフィットセクション</td>
                            <td><code>[benefit_module]</code></td>
                        </tr>
                        <tr>
                            <td><code>[pricing_module]</code></td>
                            <td>料金セクション</td>
                            <td><code>[pricing_module]</code></td>
                        </tr>
                        <tr>
                            <td><code>[contact_module]</code></td>
                            <td>お問い合わせセクション</td>
                            <td><code>[contact_module email="info@example.com"]</code></td>
                        </tr>
                    </tbody>
                </table>
            </div>
            
            <div class="card">
                <h2>使用方法</h2>
                <ol>
                    <li>固定ページまたは投稿の編集画面を開く</li>
                    <li>上記のショートコードをコンテンツエリアに貼り付け</li>
                    <li>ACFのカスタムフィールドでコンテンツを編集</li>
                    <li>プレビューで確認後、公開</li>
                </ol>
                
                <h3>完全ランディングページの例</h3>
                <textarea rows="8" style="width: 100%; font-family: monospace;" readonly>
[hero_module]
[problem_module]
[benefit_module]
[pricing_module]
[contact_module]
                </textarea>
            </div>
        </div>
        
        <style>
        .card {
            background: white;
            border: 1px solid #ccd0d4;
            box-shadow: 0 1px 1px rgba(0,0,0,.04);
            margin: 20px 0;
            padding: 20px;
        }
        .card h2 {
            margin-top: 0;
        }
        </style>
        <?php
    }
    
    /**
     * AJAX: モジュール一覧を取得
     */
    public function ajax_get_module_list() {
        wp_send_json_success(array(
            'loaded_modules' => $this->loaded_modules,
            'total_count' => count($this->loaded_modules)
        ));
    }
    
    /**
     * 読み込み済みモジュール一覧を取得
     */
    public function get_loaded_modules() {
        return $this->loaded_modules;
    }
    
    /**
     * モジュールが読み込まれているかチェック
     */
    public function is_module_loaded($module_name) {
        return in_array($module_name, $this->loaded_modules);
    }


}

/**
 * グローバル関数: モジュールが利用可能かチェック
 */
function is_complete_module_available($module_name) {
    global $complete_module_loader;
    
    if (!$complete_module_loader) {
        return false;
    }
    
    return $complete_module_loader->is_module_loaded($module_name);
}

/**
 * グローバル関数: 読み込み済みモジュール一覧を取得
 */
function get_complete_modules() {
    global $complete_module_loader;
    
    if (!$complete_module_loader) {
        return array();
    }
    
    return $complete_module_loader->get_loaded_modules();
}

/**
 * グローバル関数: ランディングページ用ショートコード一括出力
 */
function render_complete_landing_page($sections = array(), $layout = 'default') {
    $default_sections = array(
        'hero_module',
        'problem_module', 
        'benefit_module',
        'pricing_module',
        'contact_module'
    );
    
    $sections = !empty($sections) ? $sections : $default_sections;
    
    // レイアウトクラスの決定
    $layout_class = '';
    switch ($layout) {
        case 'full-width':
            $layout_class = 'full-width';
            break;
        case 'no-padding':
            $layout_class = 'no-padding';
            break;
        case 'wide':
            $layout_class = 'wide';
            break;
        case 'narrow':
            $layout_class = 'narrow';
            break;
        default:
            $layout_class = '';
    }
    
    echo '<div class="complete-modules-container ' . esc_attr($layout_class) . '">';
    
    foreach ($sections as $section) {
        echo do_shortcode('[' . $section . ']');
    }
    
    echo '</div>';
}

/**
 * 各モジュールで使用する共通関数（1行記述用）
 * シンプル&確実な実装
 */
function get_smart_location() {
    // シンプルな解決策：全ページに表示 + 管理画面でガイド表示
    // メリット：
    // 1. 確実に動作する
    // 2. ACFフィールドエラーが発生しない  
    // 3. ユーザーは必要なフィールドのみ入力すればOK
    // 4. 管理画面で使用中モジュールをガイド表示
    
    return array(
        array(
            array(
                'param' => 'post_type',
                'operator' => '==',
                'value' => 'page',
            ),
        ),
    );
}

// モジュールローダーを初期化
global $complete_module_loader;
$complete_module_loader = new CompleteModuleLoader();

/**
 * 使用方法メモ:
 * 
 * 1. functions.phpに追加:
 *    require_once get_stylesheet_directory() . '/modules_complete/module_loader.php';
 * 
 * 2. 個別ショートコード使用:
 *    [hero_module title="カスタムタイトル"]
 *    [problem_module]
 *    [benefit_module]
 *    [pricing_module]
 *    [contact_module email="info@example.com"]
 * 
 * 3. 一括ランディングページ生成:
 *    <?php render_complete_landing_page(); ?>
 * 
 * 4. 管理画面:
 *    WordPress管理画面 → 外観 → モジュール管理
 * 
 * 5. 各モジュールでの動的ACF表示制御:
 *    'location' => get_smart_location(), // この1行のみ追加
 */
?> 