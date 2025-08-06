<?php
/**
 * Template Name: Benefits Module Test Page
 * 
 * Benefits Moduleのテスト用ページテンプレート
 */

get_header(); ?>

<main id="primary" class="site-main">
    <div class="container">
        
        <!-- テスト情報 -->
        <div style="padding: 20px; background: #f0f0f0; margin: 20px 0; border-radius: 5px;">
            <h2>Benefits Module テスト</h2>
            <p><strong>ショートコード:</strong> <code>[benefits_smart_module]</code></p>
            <p><strong>作成日時:</strong> <?php echo date('Y-m-d H:i:s'); ?></p>
            <p><strong>テスト項目:</strong> 基本表示、レスポンシブ、ACFフィールド、アニメーション</p>
        </div>
        
        <!-- Benefits Module テスト -->
        <?php echo do_shortcode('[benefits_smart_module]'); ?>
        
        <!-- カスタマイズテスト -->
        <div style="padding: 20px; background: #e8f4f8; margin: 40px 0; border-radius: 5px;">
            <h3>カスタマイズ例</h3>
            <p>ショートコード属性でのカスタマイズ例:</p>
            <?php echo do_shortcode('[benefits_smart_module section_title="カスタムタイトル" accent_color="#FF6B6B" show_numbers="0"]'); ?>
        </div>
        
        <!-- デバッグ情報（管理者のみ） -->
        <?php if (current_user_can('administrator')): ?>
            <div style="padding: 20px; background: #fff3cd; margin: 20px 0; border-radius: 5px; border: 1px solid #ffeaa7;">
                <h3>デバッグ情報</h3>
                <ul>
                    <li><strong>WordPress版:</strong> <?php echo get_bloginfo('version'); ?></li>
                    <li><strong>PHP版:</strong> <?php echo PHP_VERSION; ?></li>
                    <li><strong>テーマ:</strong> <?php echo wp_get_theme()->get('Name'); ?></li>
                    <li><strong>ACFプラグイン:</strong> <?php echo function_exists('acf_add_local_field_group') ? '有効' : '無効'; ?></li>
                    <li><strong>ページID:</strong> <?php echo get_the_ID(); ?></li>
                </ul>
            </div>
        <?php endif; ?>
        
    </div>
</main>

<?php get_footer(); ?>