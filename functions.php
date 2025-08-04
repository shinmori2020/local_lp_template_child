<?php
/**
 * Local LP Template Child functions and definitions
 *
 * @package Local_LP_Template_Child
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}

/**
 * 子テーマの初期設定
 */
function local_lp_template_child_setup() {
    // 翻訳ファイルのサポート
    load_child_theme_textdomain( 
        'local-lp-template-child', 
        get_stylesheet_directory() . '/languages' 
    );
}
add_action( 'after_setup_theme', 'local_lp_template_child_setup' );

/**
 * 子テーマのスタイルとスクリプトの読み込み
 */
function local_lp_template_child_enqueue_styles() {
    // 親テーマのスタイルは style.css の @import で読み込み済み
    
    // カスタムCSSの読み込み
    wp_enqueue_style(
        'local-lp-template-child-custom',
        get_stylesheet_directory_uri() . '/css/style.css',
        array(),
        wp_get_theme()->get( 'Version' )
    );

    // カスタムJavaScriptの読み込み
    // wp_enqueue_script(
    //     'local-lp-template-child-custom',
    //     get_stylesheet_directory_uri() . '/js/custom.js',
    //     array('jquery'),
    //     wp_get_theme()->get( 'Version' ),
    //     true
    // );
}
add_action( 'wp_enqueue_scripts', 'local_lp_template_child_enqueue_styles' );

/**
 * カスタムスクリプトの読み込み
 */
function local_lp_template_child_scripts() {
    // jQueryを依存関係として登録
    wp_enqueue_script(
        'local-lp-template-child-custom',
        get_stylesheet_directory_uri() . '/js/custom.js',
        array('jquery'),
        '1.0.0',
        true
    );
}
add_action('wp_enqueue_scripts', 'local_lp_template_child_scripts');

/**
 * Complete Independent Modules System - 一時無効化中
 * 完全独立型モジュールシステム（Smart Modules テスト中のため無効化）
 * 
 * 再有効化する場合は下記のコメントアウトを解除してください
 */
/*
if (file_exists(get_stylesheet_directory() . '/modules_complete/module_loader.php')) {
    require_once get_stylesheet_directory() . '/modules_complete/module_loader.php';
    
    // モジュールシステム有効化ログ
    add_action('init', function() {
        if (current_user_can('manage_options')) {
            add_action('admin_notices', function() {
                echo '<div class="notice notice-success is-dismissible">';
                echo '<p><strong>Complete Modules System</strong> が正常に読み込まれました。';
                echo '<a href="' . admin_url('themes.php?page=complete-modules') . '">モジュール管理画面</a>で確認できます。</p>';
                echo '</div>';
            });
        }
    });
    
} else {
    // モジュールローダーが見つからない場合の警告
    add_action('admin_notices', function() {
        if (current_user_can('manage_options')) {
            echo '<div class="notice notice-warning">';
            echo '<p><strong>注意:</strong> Complete Modules Systemのファイルが見つかりません。';
            echo '<code>modules_complete/module_loader.php</code> が正しく配置されているか確認してください。</p>';
            echo '</div>';
        }
    });
}
*/

/**
 * Smart Modules System - テスト中
 * 効率的な遅延読み込み型モジュールシステム
 */
require_once get_stylesheet_directory() . '/modules_smart/smart_modules_loader.php';
?>