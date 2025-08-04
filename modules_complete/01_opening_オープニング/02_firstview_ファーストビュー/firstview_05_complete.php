<?php
/**
 * Firstview Module 05 - Orange Gradient Center Design
 * オレンジ系グラデーション・中央揃えデザインファーストビューモジュール
 * 
 * Features:
 * - Orange gradient background (warm colors)
 * - Center-aligned design
 * - Animated background shapes
 * - Word-by-word title animation
 * - 3 feature items with icons
 * - Dual CTA buttons
 * - Scroll indicator
 * - Independent module (no switching button)
 */

// ACF Field Group Registration
add_action('acf/init', 'register_firstview_05_fields');
function register_firstview_05_fields() {
    acf_add_local_field_group(array(
        'key' => 'group_firstview_05',
        'title' => 'Firstview Module 05 - Orange Center Design',
        'fields' => array(
            // Basic Content Fields
            array(
                'key' => 'field_firstview_05_tagline',
                'label' => 'タグライン',
                'name' => 'firstview_05_tagline',
                'type' => 'text',
                'default_value' => 'CREATIVE SOLUTIONS',
                'instructions' => 'タイトル上の小さなタグライン'
            ),
            array(
                'key' => 'field_firstview_05_title_words',
                'label' => 'タイトル（単語リスト）',
                'name' => 'firstview_05_title_words',
                'type' => 'textarea',
                'default_value' => "あなたの\nアイデア\nを\n現実に",
                'instructions' => '各行に1つの単語を入力（2行目がハイライトされます）'
            ),
            array(
                'key' => 'field_firstview_05_subtitle',
                'label' => 'サブタイトル',
                'name' => 'firstview_05_subtitle',
                'type' => 'textarea',
                'default_value' => 'クリエイティブな発想と最新技術で、<br>想像を超えた価値を創造します',
                'instructions' => 'タイトル下の説明テキスト（HTML可）'
            ),

            // Feature Items (Repeater)
            array(
                'key' => 'field_firstview_05_features',
                'label' => 'フィーチャーアイテム',
                'name' => 'firstview_05_features',
                'type' => 'repeater',
                'instructions' => '特徴を表すアイテム（3つ推奨）',
                'min' => 3,
                'max' => 3,
                'layout' => 'table',
                'sub_fields' => array(
                    array(
                        'key' => 'field_firstview_05_feature_icon',
                        'label' => 'アイコンSVG',
                        'name' => 'icon_svg',
                        'type' => 'textarea',
                        'instructions' => 'SVGコード（pathのみ）'
                    ),
                    array(
                        'key' => 'field_firstview_05_feature_icon_unicode',
                        'label' => 'Unicodeアイコン',
                        'name' => 'icon_unicode',
                        'type' => 'text',
                        'instructions' => '絵文字またはUnicodeアイコン（フォールバック用）'
                    ),
                    array(
                        'key' => 'field_firstview_05_feature_text',
                        'label' => 'テキスト',
                        'name' => 'text',
                        'type' => 'text',
                        'instructions' => 'フィーチャーの説明文'
                    ),
                ),
                'default_value' => array(
                    array(
                        'icon_svg' => '<path d="M12 2L15.09 8.26L22 9L17 14.14L18.18 21.02L12 17.77L5.82 21.02L7 14.14L2 9L8.91 8.26L12 2Z" stroke="currentColor" stroke-width="2" fill="currentColor"/>',
                        'icon_unicode' => '⭐',
                        'text' => '高品質な成果物'
                    ),
                    array(
                        'icon_svg' => '<path d="M13 2L3 14H12L11 22L21 10H12L13 2Z" stroke="currentColor" stroke-width="2" fill="currentColor"/>',
                        'icon_unicode' => '⚡',
                        'text' => '迅速な対応'
                    ),
                    array(
                        'icon_svg' => '<path d="M17 21V19C17 17.9391 16.5786 16.9217 15.8284 16.1716C15.0783 15.4214 14.0609 15 13 15H5C3.93913 15 2.92172 15.4214 2.17157 16.1716C1.42143 16.9217 1 17.9391 1 19V21M23 21V19C22.9993 18.1137 22.7044 17.2528 22.1614 16.5523C21.6184 15.8519 20.8581 15.3516 20 15.13M16 3.13C16.8604 3.35031 17.623 3.85071 18.1676 4.55232C18.7122 5.25392 19.0078 6.11683 19.0078 7.005C19.0078 7.89318 18.7122 8.75608 18.1676 9.45769C17.623 10.1593 16.8604 10.6597 16 10.88M13 7C13 9.20914 11.2091 11 9 11C6.79086 11 5 9.20914 5 7C5 4.79086 6.79086 3 9 3C11.2091 3 13 4.79086 13 7Z" stroke="currentColor" stroke-width="2"/>',
                        'icon_unicode' => '👥',
                        'text' => '専門チーム'
                    )
                )
            ),

            // CTA Buttons
            array(
                'key' => 'field_firstview_05_primary_cta_text',
                'label' => 'プライマリCTAテキスト',
                'name' => 'firstview_05_primary_cta_text',
                'type' => 'text',
                'default_value' => 'プロジェクトを始める',
                'instructions' => 'メインCTAボタンのテキスト'
            ),
            array(
                'key' => 'field_firstview_05_primary_cta_link',
                'label' => 'プライマリCTAリンク',
                'name' => 'firstview_05_primary_cta_link',
                'type' => 'url',
                'default_value' => '#',
                'instructions' => 'メインCTAボタンのリンク先'
            ),
            array(
                'key' => 'field_firstview_05_secondary_cta_text',
                'label' => 'セカンダリCTAテキスト',
                'name' => 'firstview_05_secondary_cta_text',
                'type' => 'text',
                'default_value' => 'ポートフォリオを見る',
                'instructions' => 'サブCTAボタンのテキスト'
            ),
            array(
                'key' => 'field_firstview_05_secondary_cta_link',
                'label' => 'セカンダリCTAリンク',
                'name' => 'firstview_05_secondary_cta_link',
                'type' => 'url',
                'default_value' => '#',
                'instructions' => 'サブCTAボタンのリンク先'
            ),

            // Design Settings
            array(
                'key' => 'field_firstview_05_enable_background_shapes',
                'label' => '背景シェイプ有効',
                'name' => 'firstview_05_enable_background_shapes',
                'type' => 'true_false',
                'default_value' => 1,
                'instructions' => '背景のアニメーションシェイプを表示する'
            ),
            array(
                'key' => 'field_firstview_05_enable_word_animation',
                'label' => 'タイトルアニメーション有効',
                'name' => 'firstview_05_enable_word_animation',
                'type' => 'true_false',
                'default_value' => 1,
                'instructions' => 'タイトルの単語別アニメーションを有効にする'
            ),
            array(
                'key' => 'field_firstview_05_show_scroll_indicator',
                'label' => 'スクロールインジケーター表示',
                'name' => 'firstview_05_show_scroll_indicator',
                'type' => 'true_false',
                'default_value' => 1,
                'instructions' => '下矢印のスクロールインジケーターを表示する'
            ),
        ),
        'location' => array(
            array(
                array(
                    'param' => 'post_type',
                    'operator' => '==',
                    'value' => 'page',
                ),
            ),
        ),
    ));
}

// Shortcode Registration
add_shortcode('firstview_05_module', 'firstview_05_shortcode');
function firstview_05_shortcode($atts) {
    $atts = shortcode_atts(array(
        'module_id' => 'firstview_05_' . uniqid(),
    ), $atts);

    $module_id = $atts['module_id'];

    // Get ACF fields
    $tagline = get_field('firstview_05_tagline') ?: 'CREATIVE SOLUTIONS';
    $title_words = get_field('firstview_05_title_words') ?: "あなたの\nアイデア\nを\n現実に";
    $subtitle = get_field('firstview_05_subtitle') ?: 'クリエイティブな発想と最新技術で、<br>想像を超えた価値を創造します';
    $features = get_field('firstview_05_features');
    $primary_cta_text = get_field('firstview_05_primary_cta_text') ?: 'プロジェクトを始める';
    $primary_cta_link = get_field('firstview_05_primary_cta_link') ?: '#';
    $secondary_cta_text = get_field('firstview_05_secondary_cta_text') ?: 'ポートフォリオを見る';
    $secondary_cta_link = get_field('firstview_05_secondary_cta_link') ?: '#';
    $enable_background_shapes = get_field('firstview_05_enable_background_shapes');
    $enable_word_animation = get_field('firstview_05_enable_word_animation');
    $show_scroll_indicator = get_field('firstview_05_show_scroll_indicator');

    // デフォルトフィーチャーデータ
    if (empty($features)) {
        $features = array(
            array(
                'icon_svg' => '<path d="M12 2L15.09 8.26L22 9L17 14.14L18.18 21.02L12 17.77L5.82 21.02L7 14.14L2 9L8.91 8.26L12 2Z" stroke="currentColor" stroke-width="2" fill="currentColor"/>',
                'icon_unicode' => '⭐',
                'text' => '高品質な成果物'
            ),
            array(
                'icon_svg' => '<path d="M13 2L3 14H12L11 22L21 10H12L13 2Z" stroke="currentColor" stroke-width="2" fill="currentColor"/>',
                'icon_unicode' => '⚡',
                'text' => '迅速な対応'
            ),
            array(
                'icon_svg' => '<path d="M17 21V19C17 17.9391 16.5786 16.9217 15.8284 16.1716C15.0783 15.4214 14.0609 15 13 15H5C3.93913 15 2.92172 15.4214 2.17157 16.1716C1.42143 16.9217 1 17.9391 1 19V21M23 21V19C22.9993 18.1137 22.7044 17.2528 22.1614 16.5523C21.6184 15.8519 20.8581 15.3516 20 15.13M16 3.13C16.8604 3.35031 17.623 3.85071 18.1676 4.55232C18.7122 5.25392 19.0078 6.11683 19.0078 7.005C19.0078 7.89318 18.7122 8.75608 18.1676 9.45769C17.623 10.1593 16.8604 10.6597 16 10.88M13 7C13 9.20914 11.2091 11 9 11C6.79086 11 5 9.20914 5 7C5 4.79086 6.79086 3 9 3C11.2091 3 13 4.79086 13 7Z" stroke="currentColor" stroke-width="2"/>',
                'icon_unicode' => '👥',
                'text' => '専門チーム'
            )
        );
    }

    // タイトル単語の処理
    $title_words_array = array_filter(explode("\n", $title_words));

    ob_start();
    ?>

    <!-- Firstview Module 05 - Orange Center Design -->
    <section class="hero-section-v4" id="<?php echo esc_attr($module_id); ?>">
        <?php if ($enable_background_shapes) : ?>
        <div class="hero-background-v4">
            <div class="bg-shapes-v4">
                <div class="shape-v4 shape-1-v4"></div>
                <div class="shape-v4 shape-2-v4"></div>
                <div class="shape-v4 shape-3-v4"></div>
            </div>
        </div>
        <?php endif; ?>
        
        <div class="hero-container-v4">
            <div class="hero-content-v4">
                <div class="hero-tagline-v4">
                    <span class="tagline-text-v4"><?php echo esc_html($tagline); ?></span>
                </div>
                
                <h1 class="hero-title-v4">
                    <?php if (!empty($title_words_array)) : ?>
                        <?php foreach ($title_words_array as $index => $word) : ?>
                            <span class="title-word-v4 <?php echo $index === 1 ? 'accent-word-v4' : ''; ?>"><?php echo esc_html(trim($word)); ?></span>
                        <?php endforeach; ?>
                    <?php else : ?>
                        <span class="title-word-v4">あなたの</span>
                        <span class="title-word-v4 accent-word-v4">アイデア</span>
                        <span class="title-word-v4">を</span>
                        <span class="title-word-v4">現実に</span>
                    <?php endif; ?>
                </h1>
                
                <p class="hero-subtitle-v4">
                    <?php echo wp_kses_post($subtitle); ?>
                </p>
                
                <?php if (!empty($features)) : ?>
                <div class="hero-features-v4">
                    <?php foreach ($features as $feature) : ?>
                        <div class="feature-item-v4">
                            <div class="feature-icon-v4">
                                <?php 
                                // 強制Unicodeモード（URLパラメータで制御）
                                $force_unicode = isset($_GET['force_unicode']) || isset($_GET['unicode_icons']);
                                
                                if ($force_unicode && !empty($feature['icon_unicode'])) : ?>
                                    <span style="font-size: 24px;"><?php echo esc_html($feature['icon_unicode']); ?></span>
                                <?php elseif (!empty($feature['icon_svg'])) : ?>
                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" class="svg-icon" style="display: block;">
                                        <?php 
                                        // SVG専用のkses設定
                                        $allowed_svg_tags = array(
                                            'path' => array(
                                                'd' => array(),
                                                'stroke' => array(),
                                                'stroke-width' => array(),
                                                'fill' => array(),
                                            ),
                                            'rect' => array(
                                                'x' => array(),
                                                'y' => array(),
                                                'width' => array(),
                                                'height' => array(),
                                                'stroke' => array(),
                                                'stroke-width' => array(),
                                                'fill' => array(),
                                            ),
                                        );
                                        echo wp_kses($feature['icon_svg'], $allowed_svg_tags);
                                        ?>
                                    </svg>
                                    <?php if (!empty($feature['icon_unicode'])) : ?>
                                        <span class="unicode-icon" style="display: none; font-size: 24px;"><?php echo esc_html($feature['icon_unicode']); ?></span>
                                    <?php endif; ?>
                                <?php elseif (!empty($feature['icon_unicode'])) : ?>
                                    <span class="unicode-icon" style="font-size: 24px;"><?php echo esc_html($feature['icon_unicode']); ?></span>
                                <?php else: ?>
                                    <span class="icon-fallback" style="font-size: 24px;">⭐</span>
                                <?php endif; ?>
                            </div>
                            <span class="feature-text-v4"><?php echo esc_html($feature['text']); ?></span>
                        </div>
                    <?php endforeach; ?>
                </div>
                <?php endif; ?>
                
                <div class="hero-action-v4">
                    <a href="<?php echo esc_url($primary_cta_link); ?>" class="primary-btn-v4">
                        <span><?php echo esc_html($primary_cta_text); ?></span>
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none">
                            <path d="M5 12H19M12 5L19 12L12 19" stroke="currentColor" stroke-width="2"/>
                        </svg>
                    </a>
                    
                    <a href="<?php echo esc_url($secondary_cta_link); ?>" class="secondary-btn-v4">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none">
                            <path d="M15 10L4 21L10 15L21 4L15 10Z" stroke="currentColor" stroke-width="2"/>
                        </svg>
                        <span><?php echo esc_html($secondary_cta_text); ?></span>
                    </a>
                </div>
            </div>
        </div>
        
        <?php if ($show_scroll_indicator) : ?>
        <div class="hero-scroll-v4">
            <div class="scroll-icon-v4">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none">
                    <path d="M7 13L12 18L17 13" stroke="currentColor" stroke-width="2"/>
                    <path d="M7 6L12 11L17 6" stroke="currentColor" stroke-width="2"/>
                </svg>
            </div>
        </div>
        <?php endif; ?>
    </section>

    <style>
        /* Firstview Module 05 - Orange Center Design Styles */
        #<?php echo esc_attr($module_id); ?>.hero-section-v4 {
            height: 100vh;
            background: linear-gradient(135deg, #ffeaa7 0%, #fab1a0 50%, #fdcb6e 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
            overflow: hidden;
        }

        #<?php echo esc_attr($module_id); ?> .hero-background-v4 {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: 1;
        }

        #<?php echo esc_attr($module_id); ?> .bg-shapes-v4 {
            position: absolute;
            width: 100%;
            height: 100%;
        }

        #<?php echo esc_attr($module_id); ?> .shape-v4 {
            position: absolute;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.1);
            animation: floatShapes 15s ease-in-out infinite;
        }

        #<?php echo esc_attr($module_id); ?> .shape-1-v4 {
            width: 200px;
            height: 200px;
            top: 20%;
            left: 15%;
            animation-delay: 0s;
        }

        #<?php echo esc_attr($module_id); ?> .shape-2-v4 {
            width: 300px;
            height: 300px;
            top: 60%;
            right: 10%;
            animation-delay: 5s;
        }

        #<?php echo esc_attr($module_id); ?> .shape-3-v4 {
            width: 150px;
            height: 150px;
            top: 10%;
            right: 30%;
            animation-delay: 10s;
        }

        #<?php echo esc_attr($module_id); ?> .hero-container-v4 {
            position: relative;
            z-index: 2;
            max-width: 1000px;
            margin: 0 auto;
            padding: 0 20px;
            text-align: center;
        }

        #<?php echo esc_attr($module_id); ?> .hero-content-v4 {
            animation: fadeInUp 1s ease-out;
        }

        #<?php echo esc_attr($module_id); ?> .hero-tagline-v4 {
            margin-bottom: 24px;
        }

        #<?php echo esc_attr($module_id); ?> .tagline-text-v4 {
            background: rgba(255, 255, 255, 0.9);
            color: #fdcb6e;
            padding: 8px 20px;
            border-radius: 30px;
            font-size: 0.9rem;
            font-weight: 600;
            letter-spacing: 2px;
            box-shadow: 0 4px 15px rgba(253, 203, 110, 0.2);
        }

        #<?php echo esc_attr($module_id); ?> .hero-title-v4 {
            font-size: 4rem;
            font-weight: 800;
            line-height: 1.2;
            margin-bottom: 32px;
            color: #fff;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.1);
        }

        #<?php echo esc_attr($module_id); ?> .title-word-v4 {
            display: inline-block;
            margin: 0 1px;
            <?php if ($enable_word_animation) : ?>
            animation: slideInWord 0.8s ease-out forwards;
            opacity: 0;
            transform: translateY(30px);
            <?php endif; ?>
        }

        <?php if ($enable_word_animation) : ?>
        #<?php echo esc_attr($module_id); ?> .title-word-v4:nth-child(1) { animation-delay: 0.2s; }
        #<?php echo esc_attr($module_id); ?> .title-word-v4:nth-child(2) { animation-delay: 0.4s; }
        #<?php echo esc_attr($module_id); ?> .title-word-v4:nth-child(3) { animation-delay: 0.6s; }
        #<?php echo esc_attr($module_id); ?> .title-word-v4:nth-child(4) { animation-delay: 0.8s; }
        #<?php echo esc_attr($module_id); ?> .title-word-v4:nth-child(5) { animation-delay: 1.0s; }
        #<?php echo esc_attr($module_id); ?> .title-word-v4:nth-child(6) { animation-delay: 1.2s; }
        <?php endif; ?>

        #<?php echo esc_attr($module_id); ?> .accent-word-v4 {
            background: linear-gradient(45deg, #fdcb6e, #ffeaa7);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            text-shadow: none;
        }

        #<?php echo esc_attr($module_id); ?> .hero-subtitle-v4 {
            font-size: 1.3rem;
            line-height: 1.6;
            color: rgba(255, 255, 255, 0.9);
            margin-bottom: 48px;
            font-weight: 300;
        }

        #<?php echo esc_attr($module_id); ?> .hero-features-v4 {
            display: flex;
            justify-content: center;
            gap: 24px;
            margin-bottom: 48px;
            flex-wrap: nowrap;
        }

        #<?php echo esc_attr($module_id); ?> .feature-item-v4 {
            display: flex;
            align-items: center;
            gap: 10px;
            background: rgba(255, 255, 255, 0.15);
            padding: 14px 20px;
            border-radius: 40px;
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
            transition: all 0.3s ease;
            flex: 1;
            min-width: 0;
        }

        #<?php echo esc_attr($module_id); ?> .feature-item-v4:hover {
            background: rgba(255, 255, 255, 0.25);
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(253, 203, 110, 0.2);
        }

        #<?php echo esc_attr($module_id); ?> .feature-icon-v4 {
            color: #fdcb6e;
            background: rgba(255, 255, 255, 0.9);
            width: 36px;
            height: 36px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }

        #<?php echo esc_attr($module_id); ?> .feature-text-v4 {
            color: white;
            font-weight: 500;
            font-size: 0.85rem;
            white-space: nowrap;
        }

        #<?php echo esc_attr($module_id); ?> .hero-action-v4 {
            display: flex;
            justify-content: center;
            gap: 20px;
        }

        #<?php echo esc_attr($module_id); ?> .primary-btn-v4, 
        #<?php echo esc_attr($module_id); ?> .secondary-btn-v4 {
            display: inline-flex;
            align-items: center;
            gap: 12px;
            padding: 18px 36px;
            border-radius: 50px;
            font-weight: 600;
            font-size: 1.1rem;
            border: none;
            cursor: pointer;
            transition: all 0.3s ease;
            text-decoration: none;
            position: relative;
            overflow: hidden;
        }

        #<?php echo esc_attr($module_id); ?> .primary-btn-v4 {
            background: linear-gradient(45deg, #fdcb6e, #ffeaa7);
            color: white;
            box-shadow: 0 8px 25px rgba(253, 203, 110, 0.4);
        }

        #<?php echo esc_attr($module_id); ?> .primary-btn-v4:hover {
            transform: translateY(-3px);
            box-shadow: 0 12px 35px rgba(253, 203, 110, 0.6);
        }

        #<?php echo esc_attr($module_id); ?> .secondary-btn-v4 {
            background: rgba(255, 255, 255, 0.9);
            color: #fdcb6e;
            box-shadow: 0 8px 25px rgba(255, 255, 255, 0.2);
        }

        #<?php echo esc_attr($module_id); ?> .secondary-btn-v4:hover {
            background: white;
            transform: translateY(-3px);
            box-shadow: 0 12px 35px rgba(255, 255, 255, 0.3);
        }

        #<?php echo esc_attr($module_id); ?> .hero-scroll-v4 {
            position: absolute;
            bottom: 30px;
            left: 50%;
            transform: translateX(-50%);
            z-index: 5;
            cursor: pointer;
        }

        #<?php echo esc_attr($module_id); ?> .scroll-icon-v4 {
            color: rgba(255, 255, 255, 0.7);
            animation: bounceScroll 2s ease-in-out infinite;
        }

        /* アニメーション */
        @keyframes floatShapes {
            0%, 100% { 
                transform: translateY(0px) rotate(0deg);
            }
            50% { 
                transform: translateY(-30px) rotate(180deg);
            }
        }

        @keyframes slideInWord {
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes bounceScroll {
            0%, 20%, 50%, 80%, 100% {
                transform: translateY(0);
            }
            40% {
                transform: translateY(-10px);
            }
            60% {
                transform: translateY(-5px);
            }
        }

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

        @keyframes ripple {
            to {
                transform: scale(4);
                opacity: 0;
            }
        }

        /* レスポンシブデザイン */
        @media (max-width: 768px) {
            #<?php echo esc_attr($module_id); ?> .hero-title-v4 {
                font-size: 2.5rem;
            }

            #<?php echo esc_attr($module_id); ?> .hero-subtitle-v4 {
                font-size: 1.1rem;
            }

            #<?php echo esc_attr($module_id); ?> .hero-features-v4 {
                gap: 16px;
                justify-content: center;
            }

            #<?php echo esc_attr($module_id); ?> .feature-item-v4 {
                flex: 1;
                min-width: 0;
                max-width: 180px;
                justify-content: center;
                padding: 10px 14px;
            }

            #<?php echo esc_attr($module_id); ?> .feature-text-v4 {
                font-size: 0.8rem;
            }

            #<?php echo esc_attr($module_id); ?> .hero-action-v4 {
                flex-direction: column;
                align-items: center;
            }

            #<?php echo esc_attr($module_id); ?> .primary-btn-v4, 
            #<?php echo esc_attr($module_id); ?> .secondary-btn-v4 {
                width: 100%;
                max-width: 280px;
                justify-content: center;
            }
        }

        @media (max-width: 480px) {
            #<?php echo esc_attr($module_id); ?> .hero-title-v4 {
                font-size: 2rem;
            }

            #<?php echo esc_attr($module_id); ?> .title-word-v4 {
                margin: 0 2px;
            }

            #<?php echo esc_attr($module_id); ?> .hero-subtitle-v4 {
                font-size: 1rem;
            }

            #<?php echo esc_attr($module_id); ?> .hero-features-v4 {
                margin-bottom: 32px;
                gap: 12px;
            }

            #<?php echo esc_attr($module_id); ?> .feature-item-v4 {
                padding: 8px 10px;
                max-width: 110px;
            }

            #<?php echo esc_attr($module_id); ?> .feature-text-v4 {
                font-size: 0.75rem;
            }

            #<?php echo esc_attr($module_id); ?> .feature-icon-v4 {
                width: 28px;
                height: 28px;
            }

            #<?php echo esc_attr($module_id); ?> .primary-btn-v4, 
            #<?php echo esc_attr($module_id); ?> .secondary-btn-v4 {
                padding: 16px 32px;
                font-size: 1rem;
            }
        }
    </style>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const moduleId = '<?php echo esc_js($module_id); ?>';
            const moduleElement = document.getElementById(moduleId);
            
            if (!moduleElement) return;

            <?php if ($enable_word_animation) : ?>
            // タイトルワードのアニメーション設定
            const titleWords = moduleElement.querySelectorAll('.title-word-v4');
            titleWords.forEach((word, index) => {
                word.style.animationDelay = `${0.2 + (index * 0.2)}s`;
            });
            <?php endif; ?>

            <?php if ($show_scroll_indicator) : ?>
            // スクロールインジケーターのクリック
            const scrollIcon = moduleElement.querySelector('.hero-scroll-v4');
            if (scrollIcon) {
                scrollIcon.addEventListener('click', function() {
                    window.scrollTo({
                        top: window.innerHeight,
                        behavior: 'smooth'
                    });
                });
            }
            <?php endif; ?>

            // フィーチャーアイテムのホバー効果
            const featureItems = moduleElement.querySelectorAll('.feature-item-v4');
            featureItems.forEach(item => {
                item.addEventListener('mouseenter', function() {
                    this.style.transform = 'translateY(-5px) scale(1.05)';
                });
                
                item.addEventListener('mouseleave', function() {
                    this.style.transform = 'translateY(-2px) scale(1)';
                });
            });

            // ボタンの波紋効果
            const buttons = moduleElement.querySelectorAll('.primary-btn-v4, .secondary-btn-v4');
            buttons.forEach(button => {
                button.addEventListener('click', function(e) {
                    const ripple = document.createElement('span');
                    const rect = this.getBoundingClientRect();
                    const size = Math.max(rect.width, rect.height);
                    const x = e.clientX - rect.left - size / 2;
                    const y = e.clientY - rect.top - size / 2;
                    
                    ripple.style.cssText = `
                        position: absolute;
                        width: ${size}px;
                        height: ${size}px;
                        left: ${x}px;
                        top: ${y}px;
                        background: rgba(255, 255, 255, 0.3);
                        border-radius: 50%;
                        transform: scale(0);
                        animation: ripple 0.6s ease-out;
                        pointer-events: none;
                    `;
                    
                    this.appendChild(ripple);
                    setTimeout(() => ripple.remove(), 600);
                });
            });

            <?php if ($enable_background_shapes) : ?>
            // 背景シェイプの色変更アニメーション
            const shapes = moduleElement.querySelectorAll('.shape-v4');
            if (shapes.length > 0) {
                setInterval(() => {
                    shapes.forEach(shape => {
                        const hue = Math.random() * 60 + 30; // 黄色系の色相
                        shape.style.background = `hsla(${hue}, 70%, 85%, 0.1)`;
                    });
                }, 5000);
            }
            <?php endif; ?>

            // SVGアイコンの自動フォールバック
            const iconContainers = moduleElement.querySelectorAll('.feature-icon-v4');
            iconContainers.forEach((container, index) => {
                const svgIcon = container.querySelector('.svg-icon');
                const unicodeIcon = container.querySelector('.unicode-icon');
                
                if (svgIcon && unicodeIcon) {
                    setTimeout(() => {
                        const svgContent = svgIcon.innerHTML.trim();
                        const svgRect = svgIcon.getBoundingClientRect();
                        
                        if (!svgContent || svgRect.width === 0 || svgRect.height === 0) {
                            console.warn(`Firstview 05 - SVG icon ${index + 1} failed, switching to Unicode`);
                            svgIcon.style.display = 'none';
                            unicodeIcon.style.display = 'block';
                        }
                    }, 100);
                }
            });
        });
    </script>

    <?php
    return ob_get_clean();
}

// Admin Preview Script
add_action('admin_footer', 'firstview_05_admin_preview_script');
function firstview_05_admin_preview_script() {
    global $post;
    if (isset($post) && is_admin()) {
        ?>
        <script>
        jQuery(document).ready(function($) {
            // ACF field change handlers for live preview
            $('input[name*="firstview_05"], textarea[name*="firstview_05"]').on('change keyup', function() {
                console.log('Firstview 05 module field updated:', $(this).attr('name'));
                // Here you could add live preview functionality if needed
            });
        });
        </script>
        <?php
    }
}

?> 