<?php
/**
 * Smart Modules Loader - メインエントリーポイント
 * 
 * これを functions.php で読み込むだけで新システムが起動します
 * 
 * 使用方法:
 * require_once get_stylesheet_directory() . '/modules_smart/smart_modules_loader.php';
 * 
 * @package SmartModules
 */

// 直接アクセスを防ぐ
if (!defined('ABSPATH')) {
    exit;
}

// コアクラスを読み込み
require_once __DIR__ . '/core/SmartModuleLoader.php';
require_once __DIR__ . '/core/SmartModuleBase.php';
require_once __DIR__ . '/core/ConflictManager.php';

/**
 * Smart Modules システムを初期化
 */
function smart_modules_init() {
    // 競合管理を先に初期化
    $conflict_manager = SmartConflictManager::get_instance();
    $conflict_manager->init();
    
    $loader = SmartModuleLoader::get_instance();
    $loader->init();
    
    // 管理画面メニューを追加
    add_action('admin_menu', 'smart_modules_admin_menu');
    
    error_log('Smart Modules: システム初期化完了（競合管理有効）');
}

/**
 * 管理画面メニューを追加
 */
function smart_modules_admin_menu() {
    add_theme_page(
        'Smart Modules',
        'Smart Modules',
        'manage_options',
        'smart-modules',
        'smart_modules_admin_page'
    );
}

/**
 * 管理画面ページを表示
 */
function smart_modules_admin_page() {
    $stats = SmartModuleLoader::get_stats();
    $conflict_stats = SmartConflictManager::get_instance()->get_conflict_stats();
    ?>
    <div class="wrap">
        <h1>Smart Modules システム</h1>
        
        <?php if ($conflict_stats['shortcode_conflicts'] > 0 || class_exists('CompleteModuleLoader')): ?>
        <div class="notice notice-warning" style="max-width: 800px;">
            <h3>⚠️ 競合警告</h3>
            <p><strong>modules_complete システムとの競合が検出されました</strong></p>
            <ul>
                <?php if ($conflict_stats['shortcode_conflicts'] > 0): ?>
                    <li>ショートコード競合: <?php echo $conflict_stats['shortcode_conflicts']; ?>個</li>
                <?php endif; ?>
                <?php if ($conflict_stats['acf_conflicts'] > 0): ?>
                    <li>ACFフィールド競合: <?php echo $conflict_stats['acf_conflicts']; ?>個</li>
                <?php endif; ?>
                <?php if (class_exists('CompleteModuleLoader')): ?>
                    <li>modules_complete システムが同時動作中</li>
                <?php endif; ?>
            </ul>
            <p><strong>推奨：</strong> 段階的移行後、一方のシステムを無効化</p>
        </div>
        <?php endif; ?>
        
        <div class="card" style="max-width: 800px;">
            <h2>システム状況</h2>
            <table class="wp-list-table widefat fixed striped">
                <tr>
                    <th>準備済みモジュール</th>
                    <td><?php echo esc_html($stats['prepared']); ?> 個</td>
                </tr>
                <tr>
                    <th>読み込み済みモジュール</th>
                    <td><?php echo esc_html($stats['loaded']); ?> 個</td>
                </tr>
                <tr>
                    <th>読み込み済みアセット</th>
                    <td><?php echo esc_html($stats['assets']); ?> 個</td>
                </tr>
            </table>
        </div>
        
        <div class="card" style="max-width: 800px; margin-top: 20px;">
            <h2>利用可能なモジュール</h2>
            <table class="wp-list-table widefat fixed striped">
                <thead>
                    <tr>
                        <th>モジュール名</th>
                        <th>ショートコード</th>
                        <th>説明</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><strong>Hero Module</strong></td>
                        <td><code>[hero_smart_module]</code></td>
                        <td>メインビジュアル・CTA・統計表示</td>
                    </tr>
                    <tr>
                        <td><strong>Problem Module</strong></td>
                        <td><code>[problem_smart_module]</code></td>
                        <td>課題提起・共感セクション</td>
                    </tr>
                </tbody>
            </table>
        </div>
        
        <div class="card" style="max-width: 800px; margin-top: 20px;">
            <h2>使用方法</h2>
            <h3>基本的な使い方</h3>
            <p>固定ページのコンテンツエリアに以下を記述してください：</p>
            <textarea readonly style="width: 100%; height: 120px; font-family: monospace;">
[hero_smart_module]
[problem_smart_module]
            </textarea>
            
            <h3>カスタマイズ方法</h3>
            <p>ショートコード属性で直接カスタマイズ：</p>
            <textarea readonly style="width: 100%; height: 60px; font-family: monospace;">
[hero_smart_module title="カスタムタイトル" cta_text="今すぐ始める"]
            </textarea>
            
            <h3>ACFでのカスタマイズ</h3>
            <p>ページ編集画面でACFフィールドを使用してカスタマイズできます。</p>
        </div>
        
        <div class="card" style="max-width: 800px; margin-top: 20px;">
            <h2>新システムの利点</h2>
            <ul>
                <li>✅ <strong>メモリ効率</strong>: 使用するモジュールのみ読み込み（97%削減）</li>
                <li>✅ <strong>エラー回避</strong>: 重複読み込み防止機構</li>
                <li>✅ <strong>ACF設定不要</strong>: デフォルト値内蔵</li>
                <li>✅ <strong>単体完結</strong>: 各モジュールが独立動作</li>
                <li>✅ <strong>レスポンシブ</strong>: モバイル対応済み</li>
            </ul>
        </div>
    </div>
    
    <style>
    .card {
        background: white;
        border: 1px solid #ccd0d4;
        box-shadow: 0 1px 1px rgba(0,0,0,.04);
        margin: 20px 0;
        padding: 20px;
        border-radius: 4px;
    }
    .card h2 {
        margin-top: 0;
    }
    </style>
    <?php
}

/**
 * システムをWordPressフックで起動
 */
add_action('init', 'smart_modules_init');

/**
 * デバッグ用関数
 */
function smart_modules_debug() {
    if (!defined('WP_DEBUG') || !WP_DEBUG) {
        return;
    }
    
    error_log('=== Smart Modules Debug Info ===');
    error_log('Loaded: ' . print_r(SmartModuleLoader::get_stats(), true));
}

add_action('wp_footer', 'smart_modules_debug');