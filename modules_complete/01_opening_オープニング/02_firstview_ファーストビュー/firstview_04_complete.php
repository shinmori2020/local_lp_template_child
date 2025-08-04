<?php
/**
 * Firstview Module 04 - Light Color Grid Layout with Service Cards
 * ライトカラー・グリッドレイアウト・サービス紹介型ファーストビューモジュール
 * 
 * Features:
 * - Light color theme (white/gray gradient)
 * - Grid layout (1:2 ratio split)
 * - 4 service cards with 3D tilt effect
 * - Intro label, title, description, CTA buttons
 * - Card animations with delay
 * - Responsive design
 * - Independent module (no switching button)
 */

// ACF Field Group Registration
add_action('acf/init', 'register_firstview_04_fields');
function register_firstview_04_fields() {
    acf_add_local_field_group(array(
        'key' => 'group_firstview_04',
        'title' => 'Firstview Module 04 - Light Grid Layout',
        'fields' => array(
            // Basic Content Fields
            array(
                'key' => 'field_firstview_04_intro_label',
                'label' => 'イントロラベル',
                'name' => 'firstview_04_intro_label',
                'type' => 'text',
                'default_value' => 'INNOVATION',
                'instructions' => '上部に表示される小さなラベルテキスト'
            ),
            array(
                'key' => 'field_firstview_04_title_line1',
                'label' => 'タイトル1行目',
                'name' => 'firstview_04_title_line1',
                'type' => 'text',
                'default_value' => 'デジタル変革で',
                'instructions' => 'メインタイトルの1行目'
            ),
            array(
                'key' => 'field_firstview_04_title_line2',
                'label' => 'タイトル2行目（ハイライト）',
                'name' => 'firstview_04_title_line2',
                'type' => 'text',
                'default_value' => '未来を創る',
                'instructions' => 'グラデーションでハイライトされる2行目'
            ),
            array(
                'key' => 'field_firstview_04_description',
                'label' => '説明文',
                'name' => 'firstview_04_description',
                'type' => 'textarea',
                'default_value' => '最新のテクノロジーと創造性を融合し、<br>お客様のビジネスに革新をもたらします',
                'instructions' => 'タイトル下の説明テキスト（HTML可）'
            ),

            // CTA Buttons
            array(
                'key' => 'field_firstview_04_primary_cta_text',
                'label' => 'プライマリCTAテキスト',
                'name' => 'firstview_04_primary_cta_text',
                'type' => 'text',
                'default_value' => '無料相談',
                'instructions' => 'メインCTAボタンのテキスト'
            ),
            array(
                'key' => 'field_firstview_04_primary_cta_link',
                'label' => 'プライマリCTAリンク',
                'name' => 'firstview_04_primary_cta_link',
                'type' => 'url',
                'default_value' => '#',
                'instructions' => 'メインCTAボタンのリンク先'
            ),
            array(
                'key' => 'field_firstview_04_secondary_cta_text',
                'label' => 'セカンダリCTAテキスト',
                'name' => 'firstview_04_secondary_cta_text',
                'type' => 'text',
                'default_value' => '詳しく見る',
                'instructions' => 'サブCTAボタンのテキスト'
            ),
            array(
                'key' => 'field_firstview_04_secondary_cta_link',
                'label' => 'セカンダリCTAリンク',
                'name' => 'firstview_04_secondary_cta_link',
                'type' => 'url',
                'default_value' => '#',
                'instructions' => 'サブCTAボタンのリンク先'
            ),

            // Service Cards (Repeater)
            array(
                'key' => 'field_firstview_04_service_cards',
                'label' => 'サービスカード',
                'name' => 'firstview_04_service_cards',
                'type' => 'repeater',
                'instructions' => '右側に表示される2x2のサービスカード',
                'min' => 4,
                'max' => 4,
                'layout' => 'table',
                'sub_fields' => array(
                    array(
                        'key' => 'field_firstview_04_card_icon',
                        'label' => 'アイコンSVG',
                        'name' => 'icon_svg',
                        'type' => 'textarea',
                        'instructions' => 'SVGコード（pathのみ）'
                    ),
                    array(
                        'key' => 'field_firstview_04_card_icon_unicode',
                        'label' => 'Unicodeアイコン',
                        'name' => 'icon_unicode',
                        'type' => 'text',
                        'instructions' => '絵文字またはUnicodeアイコン（フォールバック用）'
                    ),
                    array(
                        'key' => 'field_firstview_04_card_title',
                        'label' => 'タイトル',
                        'name' => 'title',
                        'type' => 'text',
                        'instructions' => 'カードのタイトル'
                    ),
                    array(
                        'key' => 'field_firstview_04_card_description',
                        'label' => '説明',
                        'name' => 'description',
                        'type' => 'text',
                        'instructions' => 'カードの説明文'
                    ),
                    array(
                        'key' => 'field_firstview_04_card_new_badge',
                        'label' => 'NEWバッジ表示',
                        'name' => 'show_new_badge',
                        'type' => 'true_false',
                        'instructions' => 'NEWバッジを表示するか'
                    ),
                ),
                'default_value' => array(
                    array(
                        'icon_svg' => '<path d="M12 2L2 7V17L12 22L22 17V7L12 2Z" stroke="currentColor" stroke-width="2"/><path d="M12 22V12" stroke="currentColor" stroke-width="2"/><path d="M22 7L12 12L2 7" stroke="currentColor" stroke-width="2"/>',
                        'title' => 'システム開発',
                        'description' => 'スケーラブルで堅牢なシステムを構築',
                        'show_new_badge' => false
                    ),
                    array(
                        'icon_svg' => '<rect x="3" y="3" width="7" height="7" stroke="currentColor" stroke-width="2"/><rect x="14" y="3" width="7" height="7" stroke="currentColor" stroke-width="2"/><rect x="14" y="14" width="7" height="7" stroke="currentColor" stroke-width="2"/><rect x="3" y="14" width="7" height="7" stroke="currentColor" stroke-width="2"/>',
                        'title' => 'UI/UXデザイン',
                        'description' => '直感的なインターフェースを設計',
                        'show_new_badge' => false
                    ),
                    array(
                        'icon_svg' => '<path d="M9 12L11 14L15 10M21 12C21 16.9706 16.9706 21 12 21C7.02944 21 3 16.9706 3 12C3 7.02944 7.02944 3 12 3C16.9706 3 21 7.02944 21 12Z" stroke="currentColor" stroke-width="2"/>',
                        'title' => 'AI・機械学習',
                        'description' => '最先端のAI技術で自動化を実現',
                        'show_new_badge' => true
                    ),
                    array(
                        'icon_svg' => '<path d="M13 2L3 14H12L11 22L21 10H12L13 2Z" stroke="currentColor" stroke-width="2"/>',
                        'title' => '高速配信',
                        'description' => 'CDN技術で全世界へ高速配信',
                        'show_new_badge' => false
                    )
                )
            ),

            // Design Settings
            array(
                'key' => 'field_firstview_04_enable_tilt',
                'label' => 'チルト効果有効',
                'name' => 'firstview_04_enable_tilt',
                'type' => 'true_false',
                'default_value' => 1,
                'instructions' => 'サービスカードの3Dチルト効果を有効にする'
            ),
            array(
                'key' => 'field_firstview_04_enable_delay_animation',
                'label' => '遅延アニメーション有効',
                'name' => 'firstview_04_enable_delay_animation',
                'type' => 'true_false',
                'default_value' => 1,
                'instructions' => 'カードの順次表示アニメーションを有効にする'
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
add_shortcode('firstview_04_module', 'firstview_04_shortcode');
function firstview_04_shortcode($atts) {
    $atts = shortcode_atts(array(
        'module_id' => 'firstview_04_' . uniqid(),
    ), $atts);

    $module_id = $atts['module_id'];

    // Get ACF fields
    $intro_label = get_field('firstview_04_intro_label') ?: 'INNOVATION';
    $title_line1 = get_field('firstview_04_title_line1') ?: 'デジタル変革で';
    $title_line2 = get_field('firstview_04_title_line2') ?: '未来を創る';
    $description = get_field('firstview_04_description') ?: '最新のテクノロジーと創造性を融合し、<br>お客様のビジネスに革新をもたらします';
    $primary_cta_text = get_field('firstview_04_primary_cta_text') ?: '無料相談';
    $primary_cta_link = get_field('firstview_04_primary_cta_link') ?: '#';
    $secondary_cta_text = get_field('firstview_04_secondary_cta_text') ?: '詳しく見る';
    $secondary_cta_link = get_field('firstview_04_secondary_cta_link') ?: '#';
    $service_cards = get_field('firstview_04_service_cards');
    $enable_tilt = get_field('firstview_04_enable_tilt');
    $enable_delay_animation = get_field('firstview_04_enable_delay_animation');
    
    // デフォルトサービスカードデータ
    if (empty($service_cards)) {
        $service_cards = array(
            array(
                'icon_svg' => '<path d="M12 2L2 7V17L12 22L22 17V7L12 2Z" stroke="currentColor" stroke-width="2" fill="none"/><path d="M12 22V12" stroke="currentColor" stroke-width="2"/><path d="M22 7L12 12L2 7" stroke="currentColor" stroke-width="2"/>',
                'icon_unicode' => '⚙️',
                'title' => 'システム開発',
                'description' => 'スケーラブルで堅牢なシステムを構築',
                'show_new_badge' => false
            ),
            array(
                'icon_svg' => '<rect x="3" y="3" width="7" height="7" stroke="currentColor" stroke-width="2" fill="none"/><rect x="14" y="3" width="7" height="7" stroke="currentColor" stroke-width="2" fill="none"/><rect x="14" y="14" width="7" height="7" stroke="currentColor" stroke-width="2" fill="none"/><rect x="3" y="14" width="7" height="7" stroke="currentColor" stroke-width="2" fill="none"/>',
                'icon_unicode' => '🎨',
                'title' => 'UI/UXデザイン',
                'description' => '直感的なインターフェースを設計',
                'show_new_badge' => false
            ),
            array(
                'icon_svg' => '<path d="M9 12L11 14L15 10M21 12C21 16.9706 16.9706 21 12 21C7.02944 21 3 16.9706 3 12C3 7.02944 7.02944 3 12 3C16.9706 3 21 7.02944 21 12Z" stroke="currentColor" stroke-width="2" fill="none"/>',
                'icon_unicode' => '🤖',
                'title' => 'AI・機械学習',
                'description' => '最先端のAI技術で自動化を実現',
                'show_new_badge' => true
            ),
            array(
                'icon_svg' => '<path d="M13 2L3 14H12L11 22L21 10H12L13 2Z" stroke="currentColor" stroke-width="2" fill="currentColor"/>',
                'icon_unicode' => '⚡',
                'title' => '高速配信',
                'description' => 'CDN技術で全世界へ高速配信',
                'show_new_badge' => false
            )
        );
    }

    ob_start();
    ?>

    <!-- Firstview Module 04 - Light Grid Layout -->
    <section class="hero-section-v3" id="<?php echo esc_attr($module_id); ?>">
        <div class="hero-wrapper-v3">
            <div class="hero-container-v3">
                <!-- 左右分割コンテンツ -->
                <div class="hero-split-v3">
                    <!-- 左側：メインコンテンツ -->
                    <div class="hero-left-v3">
                        <span class="intro-label"><?php echo esc_html($intro_label); ?></span>
                        <h1 class="hero-title-v3">
                            <?php echo esc_html($title_line1); ?><br>
                            <span class="title-accent"><?php echo esc_html($title_line2); ?></span>
                        </h1>
                        <p class="hero-desc-v3">
                            <?php echo wp_kses_post($description); ?>
                        </p>

                        <!-- CTAボタン -->
                        <div class="hero-cta-v3">
                            <a href="<?php echo esc_url($primary_cta_link); ?>" class="cta-button-primary-v3">
                                <span><?php echo esc_html($primary_cta_text); ?></span>
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none">
                                    <path d="M5 12H19M12 5L19 12L12 19" stroke="currentColor" stroke-width="2"/>
                                </svg>
                            </a>
                            <a href="<?php echo esc_url($secondary_cta_link); ?>" class="cta-button-secondary-v3">
                                <span><?php echo esc_html($secondary_cta_text); ?></span>
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none">
                                    <path d="M15 10L4 21L10 15L21 4L15 10Z" stroke="currentColor" stroke-width="2"/>
                                </svg>
                            </a>
                        </div>
                    </div>

                    <!-- 右側：サービスカード -->
                    <div class="hero-right-v3">
                        <div class="services-grid-v3">
                            <?php if (!empty($service_cards)) : ?>
                                <?php foreach ($service_cards as $card) : ?>
                                    <div class="service-card-v3" <?php echo $enable_tilt ? 'data-tilt' : ''; ?>>
                                        <?php if (!empty($card['show_new_badge'])) : ?>
                                            <div class="service-badge-v3">NEW</div>
                                        <?php endif; ?>
                                        <div class="service-icon-v3">
                                            <?php 
                                            // 強制Unicodeモード（URLパラメータで制御）
                                            $force_unicode = isset($_GET['force_unicode']) || isset($_GET['unicode_icons']);
                                            
                                            if ($force_unicode && !empty($card['icon_unicode'])) : ?>
                                                <!-- 強制Unicodeモード -->
                                                <div class="unicode-icon" style="font-size: 32px; line-height: 1; color: #667eea;"><?php echo esc_html($card['icon_unicode']); ?></div>
                                                <small style="display: block; font-size: 10px; color: #999; margin-top: 4px;">Unicode</small>
                                            <?php elseif (!empty($card['icon_svg'])) : ?>
                                                <svg width="32" height="32" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="svg-icon" style="display: block;">
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
                                                        'circle' => array(
                                                            'cx' => array(),
                                                            'cy' => array(),
                                                            'r' => array(),
                                                            'stroke' => array(),
                                                            'stroke-width' => array(),
                                                            'fill' => array(),
                                                        ),
                                                    );
                                                    echo wp_kses($card['icon_svg'], $allowed_svg_tags);
                                                    ?>
                                                </svg>
                                                <?php if (!empty($card['icon_unicode'])) : ?>
                                                    <div class="unicode-icon" style="display: none; font-size: 32px; line-height: 1;"><?php echo esc_html($card['icon_unicode']); ?></div>
                                                <?php endif; ?>
                                            <?php elseif (!empty($card['icon_unicode'])) : ?>
                                                <div class="unicode-icon" style="font-size: 32px; line-height: 1;"><?php echo esc_html($card['icon_unicode']); ?></div>
                                            <?php else: ?>
                                                <div class="icon-fallback" style="font-size: 32px; line-height: 1;">📊</div>
                                            <?php endif; ?>
                                        </div>
                                        <h3><?php echo esc_html($card['title']); ?></h3>
                                        <p><?php echo esc_html($card['description']); ?></p>
                                    </div>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <style>
        /* Firstview Module 04 - Light Grid Layout Styles */
        #<?php echo esc_attr($module_id); ?>.hero-section-v3 {
            height: 100vh;
            background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%);
            padding: 40px 0;
            position: relative;
            overflow: hidden;
            display: flex;
            align-items: center;
        }

        #<?php echo esc_attr($module_id); ?> .hero-wrapper-v3 {
            position: relative;
            z-index: 2;
            width: 100%;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        #<?php echo esc_attr($module_id); ?> .hero-container-v3 {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
            height: 100%;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        #<?php echo esc_attr($module_id); ?> .hero-split-v3 {
            display: grid;
            grid-template-columns: 1fr 2fr;
            gap: 60px;
            align-items: center;
            height: 100%;
        }

        #<?php echo esc_attr($module_id); ?> .hero-left-v3 {
            animation: fadeInLeft 0.8s ease-out;
        }

        #<?php echo esc_attr($module_id); ?> .intro-label {
            display: inline-block;
            background: linear-gradient(45deg, #667eea, #764ba2);
            color: white;
            padding: 8px 16px;
            border-radius: 20px;
            font-size: 0.8rem;
            font-weight: 600;
            letter-spacing: 1px;
            margin-bottom: 20px;
        }

        #<?php echo esc_attr($module_id); ?> .hero-title-v3 {
            font-size: 3rem;
            font-weight: 800;
            line-height: 1.2;
            color: #1a202c;
            margin-bottom: 16px;
            letter-spacing: -0.02em;
        }

        #<?php echo esc_attr($module_id); ?> .title-accent {
            background: linear-gradient(45deg, #667eea, #764ba2);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        #<?php echo esc_attr($module_id); ?> .hero-desc-v3 {
            font-size: 1.2rem;
            line-height: 1.6;
            color: #4a5568;
            font-weight: 400;
        }

        #<?php echo esc_attr($module_id); ?> .hero-cta-v3 {
            display: flex;
            gap: 16px;
            margin-top: 32px;
        }

        #<?php echo esc_attr($module_id); ?> .cta-button-primary-v3, 
        #<?php echo esc_attr($module_id); ?> .cta-button-secondary-v3 {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 16px 32px;
            border: none;
            border-radius: 12px;
            font-weight: 600;
            font-size: 1rem;
            cursor: pointer;
            transition: all 0.3s ease;
            text-decoration: none;
        }

        #<?php echo esc_attr($module_id); ?> .cta-button-primary-v3 {
            background: linear-gradient(45deg, #667eea, #764ba2);
            color: white;
            box-shadow: 0 4px 20px rgba(102, 126, 234, 0.3);
        }

        #<?php echo esc_attr($module_id); ?> .cta-button-primary-v3:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 30px rgba(102, 126, 234, 0.4);
        }

        #<?php echo esc_attr($module_id); ?> .cta-button-secondary-v3 {
            background: white;
            color: #667eea;
            border: 1px solid #e2e8f0;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.08);
        }

        #<?php echo esc_attr($module_id); ?> .cta-button-secondary-v3:hover {
            background: #f7fafc;
            transform: translateY(-2px);
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.12);
        }

        #<?php echo esc_attr($module_id); ?> .hero-right-v3 {
            animation: fadeInRight 0.8s ease-out 0.2s both;
        }

        #<?php echo esc_attr($module_id); ?> .services-grid-v3 {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 20px;
        }

        #<?php echo esc_attr($module_id); ?> .service-card-v3 {
            background: white;
            border-radius: 16px;
            padding: 24px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
            transition: all 0.3s ease;
            cursor: pointer;
            position: relative;
            overflow: hidden;
            text-align: center;
            opacity: 1; /* デフォルトで表示 */
            transform: translateY(0); /* デフォルト位置 */
        }

        #<?php echo esc_attr($module_id); ?> .service-card-v3::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(45deg, #667eea, #764ba2);
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        #<?php echo esc_attr($module_id); ?> .service-card-v3:hover::before {
            opacity: 0.05;
        }

        #<?php echo esc_attr($module_id); ?> .service-card-v3:hover {
            transform: translateY(-10px);
            box-shadow: 0 12px 40px rgba(0, 0, 0, 0.15);
        }

        #<?php echo esc_attr($module_id); ?> .service-icon-v3 {
            color: #667eea;
            margin-bottom: 16px;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        #<?php echo esc_attr($module_id); ?> .service-icon-v3 svg {
            width: 32px;
            height: 32px;
            display: block;
            stroke: currentColor;
            fill: none;
        }

        #<?php echo esc_attr($module_id); ?> .service-icon-v3 svg path[fill="currentColor"],
        #<?php echo esc_attr($module_id); ?> .service-icon-v3 svg [fill="currentColor"] {
            fill: currentColor;
        }

        #<?php echo esc_attr($module_id); ?> .service-icon-v3 .icon-fallback,
        #<?php echo esc_attr($module_id); ?> .service-icon-v3 .unicode-icon {
            font-size: 32px;
            line-height: 1;
            text-align: center;
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 32px;
        }

        #<?php echo esc_attr($module_id); ?> .service-card-v3 h3 {
            font-size: 1.2rem;
            font-weight: 700;
            color: #1a202c;
            margin-bottom: 8px;
            line-height: 1.3;
            position: relative;
            z-index: 1;
        }

        #<?php echo esc_attr($module_id); ?> .service-card-v3 p {
            color: #4a5568;
            line-height: 1.5;
            font-size: 0.9rem;
            position: relative;
            z-index: 1;
        }

        #<?php echo esc_attr($module_id); ?> .service-badge-v3 {
            position: absolute;
            top: 12px;
            right: 12px;
            background: #48bb78;
            color: white;
            padding: 4px 12px;
            border-radius: 12px;
            font-size: 0.7rem;
            font-weight: 600;
            z-index: 2;
        }

        /* アニメーション */
        @keyframes fadeInLeft {
            from {
                opacity: 0;
                transform: translateX(-30px);
            }
            to {
                opacity: 1;
                transform: translateX(0);
            }
        }

        @keyframes fadeInRight {
            from {
                opacity: 0;
                transform: translateX(30px);
            }
            to {
                opacity: 1;
                transform: translateX(0);
            }
        }

        /* レスポンシブデザイン */
        @media (max-width: 768px) {
            #<?php echo esc_attr($module_id); ?>.hero-section-v3 {
                padding: 20px 0;
            }

            #<?php echo esc_attr($module_id); ?> .hero-split-v3 {
                grid-template-columns: 1fr;
                gap: 40px;
                text-align: center;
            }

            #<?php echo esc_attr($module_id); ?> .hero-title-v3 {
                font-size: 2.2rem;
            }

            #<?php echo esc_attr($module_id); ?> .services-grid-v3 {
                grid-template-columns: 1fr;
                gap: 16px;
            }

            #<?php echo esc_attr($module_id); ?> .hero-cta-v3 {
                justify-content: center;
            }
        }

        @media (max-width: 480px) {
            #<?php echo esc_attr($module_id); ?>.hero-section-v3 {
                height: auto;
                min-height: 100vh;
                padding: 20px 0;
            }

            #<?php echo esc_attr($module_id); ?> .hero-title-v3 {
                font-size: 1.8rem;
            }

            #<?php echo esc_attr($module_id); ?> .hero-split-v3 {
                gap: 30px;
            }

            #<?php echo esc_attr($module_id); ?> .hero-cta-v3 {
                flex-direction: column;
                align-items: center;
            }

            #<?php echo esc_attr($module_id); ?> .cta-button-primary-v3, 
            #<?php echo esc_attr($module_id); ?> .cta-button-secondary-v3 {
                width: 100%;
                max-width: 300px;
                justify-content: center;
            }

            #<?php echo esc_attr($module_id); ?> .services-grid-v3 {
                gap: 12px;
            }

            #<?php echo esc_attr($module_id); ?> .service-card-v3 {
                padding: 20px;
            }
        }
    </style>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const moduleId = '<?php echo esc_js($module_id); ?>';
            const moduleElement = document.getElementById(moduleId);
            
            if (!moduleElement) return;

            <?php if ($enable_tilt) : ?>
            // チルト効果
            const tiltElements = moduleElement.querySelectorAll('[data-tilt]');
            tiltElements.forEach(element => {
                element.addEventListener('mousemove', function(e) {
                    const rect = element.getBoundingClientRect();
                    const x = e.clientX - rect.left;
                    const y = e.clientY - rect.top;
                    const centerX = rect.width / 2;
                    const centerY = rect.height / 2;
                    const rotateX = (y - centerY) / 10;
                    const rotateY = (centerX - x) / 10;
                    
                    element.style.transform = `perspective(1000px) rotateX(${rotateX}deg) rotateY(${rotateY}deg)`;
                });
                
                element.addEventListener('mouseleave', function() {
                    element.style.transform = 'perspective(1000px) rotateX(0deg) rotateY(0deg)';
                });
            });
            <?php endif; ?>

            <?php if ($enable_delay_animation) : ?>
            // サービスカードの遅延表示
            const serviceCards = moduleElement.querySelectorAll('.service-card-v3');
            if (serviceCards.length > 0) {
                serviceCards.forEach((card, index) => {
                    card.style.opacity = '0';
                    card.style.transform = 'translateY(20px)';
                    setTimeout(() => {
                        card.style.transition = 'all 0.6s ease-out';
                        card.style.opacity = '1';
                        card.style.transform = 'translateY(0)';
                    }, 600 + (index * 100));
                });
            }
            <?php else: ?>
            // 遅延アニメーション無効時は即座に表示
            const serviceCards = moduleElement.querySelectorAll('.service-card-v3');
            serviceCards.forEach((card) => {
                card.style.opacity = '1';
                card.style.transform = 'translateY(0)';
            });
            <?php endif; ?>

            // SVGアイコンの自動フォールバック
            const iconContainers = moduleElement.querySelectorAll('.service-icon-v3');
            iconContainers.forEach((container, index) => {
                const svgIcon = container.querySelector('.svg-icon');
                const unicodeIcon = container.querySelector('.unicode-icon');
                
                if (svgIcon && unicodeIcon) {
                    // SVGが空またはエラーの場合、Unicodeアイコンにフォールバック
                    setTimeout(() => {
                        const svgContent = svgIcon.innerHTML.trim();
                        const svgRect = svgIcon.getBoundingClientRect();
                        
                        if (!svgContent || svgRect.width === 0 || svgRect.height === 0) {
                            console.warn(`Firstview 04 - SVG icon ${index + 1} failed, switching to Unicode`);
                            svgIcon.style.display = 'none';
                            unicodeIcon.style.display = 'block';
                        }
                    }, 100); // 少し遅延させてレンダリング完了を待つ
                }
            });

            // SVGアイコンデバッグ（開発時のみ）
            if (window.location.search.includes('debug_icons')) {
                const svgIcons = moduleElement.querySelectorAll('.service-icon-v3 svg');
                console.log('Firstview 04 - SVG Icons found:', svgIcons.length);
                svgIcons.forEach((svg, index) => {
                    console.log(`Icon ${index + 1}:`, svg);
                    console.log(`Content:`, svg.innerHTML);
                    const rect = svg.getBoundingClientRect();
                    console.log(`Size: ${rect.width}x${rect.height}`);
                    if (!svg.innerHTML.trim()) {
                        console.warn(`Icon ${index + 1} has no content`);
                    }
                });
            }
        });
    </script>

    <?php
    return ob_get_clean();
}

// Admin Preview Script
add_action('admin_footer', 'firstview_04_admin_preview_script');
function firstview_04_admin_preview_script() {
    global $post;
    if (isset($post) && is_admin()) {
        ?>
        <script>
        jQuery(document).ready(function($) {
            // ACF field change handlers for live preview
            $('input[name*="firstview_04"], textarea[name*="firstview_04"]').on('change keyup', function() {
                console.log('Firstview 04 module field updated:', $(this).attr('name'));
                // Here you could add live preview functionality if needed
            });
        });
        </script>
        <?php
    }
}

?> 