<?php
/**
 * Hero Module 03 - Complete Independent Version
 * ショートコード: [hero_03_module]
 * 
 * 写真背景付きヒーローセクションモジュール
 * プレミアムワークスペースをテーマにした高級感のあるデザイン
 * 
 * 完全独立型モジュール：
 * - ACFフィールド自動登録
 * - CSS内蔵
 * - JavaScript内蔵
 * - ショートコード対応
 * 
 * @package Local_LP_Template_Child
 */

// 直接アクセスを防ぐ
if (!defined('ABSPATH')) {
    exit;
}

/**
 * ACFフィールドグループの自動登録（即座実行）
 */
if (function_exists('acf_add_local_field_group')) {
    acf_add_local_field_group(array(
        'key' => 'group_hero_03_complete',
        'title' => 'ヒーローモジュール03設定',
        'fields' => array(
            array(
                'key' => 'field_hero_03_tagline_icon',
                'label' => 'タグラインアイコン',
                'name' => 'hero_03_tagline_icon',
                'type' => 'text',
                'default_value' => '✨',
            ),
            array(
                'key' => 'field_hero_03_tagline_text',
                'label' => 'タグラインテキスト',
                'name' => 'hero_03_tagline_text',
                'type' => 'text',
                'default_value' => 'Future of Work',
            ),
            array(
                'key' => 'field_hero_03_title',
                'label' => 'メインタイトル',
                'name' => 'hero_03_title',
                'type' => 'textarea',
                'default_value' => '次世代の<span class="heading-highlight">ワークスペース</span>体験を',
            ),
            array(
                'key' => 'field_hero_03_description',
                'label' => '説明文',
                'name' => 'hero_03_description',
                'type' => 'textarea',
                'default_value' => '最先端のテクノロジーと美しいデザインが融合した、<br>新しい働き方を実現するワークスペース。<br><strong>あなたの創造性を最大限に引き出します。</strong>',
            ),
            array(
                'key' => 'field_hero_03_primary_cta_text',
                'label' => 'プライマリCTAテキスト',
                'name' => 'hero_03_primary_cta_text',
                'type' => 'text',
                'default_value' => '体験予約する',
            ),
            array(
                'key' => 'field_hero_03_primary_cta_link',
                'label' => 'プライマリCTAリンク',
                'name' => 'hero_03_primary_cta_link',
                'type' => 'text',
                'default_value' => '#contact',
            ),
            array(
                'key' => 'field_hero_03_secondary_cta_text',
                'label' => 'セカンダリCTAテキスト',
                'name' => 'hero_03_secondary_cta_text',
                'type' => 'text',
                'default_value' => 'ギャラリーを見る',
            ),
            array(
                'key' => 'field_hero_03_secondary_cta_link',
                'label' => 'セカンダリCTAリンク',
                'name' => 'hero_03_secondary_cta_link',
                'type' => 'text',
                'default_value' => '#gallery',
            ),
            array(
                'key' => 'field_hero_03_background_image',
                'label' => '背景画像',
                'name' => 'hero_03_background_image',
                'type' => 'image',
                'return_format' => 'url',
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
        'menu_order' => 0,
        'position' => 'normal',
        'style' => 'default',
        'label_placement' => 'top',
    ));
}

/**
 * ショートコード登録
 */
add_shortcode('hero_03_module', 'render_hero_03_module');

function render_hero_03_module($atts = [], $content = null) {
    // 属性のデフォルト値
    $atts = shortcode_atts(array(
        'tagline_icon' => '',
        'tagline_text' => '',
        'title' => '',
        'description' => '',
        'primary_cta_text' => '',
        'primary_cta_link' => '',
        'secondary_cta_text' => '',
        'secondary_cta_link' => '',
        'background_image' => '',
        'post_id' => get_the_ID(),
    ), $atts);
    
    // ACFフィールドから値を取得（ショートコード属性で上書き可能）
    $post_id = $atts['post_id'];
    $tagline_icon = $atts['tagline_icon'] ?: get_field('hero_03_tagline_icon', $post_id) ?: '✨';
    $tagline_text = $atts['tagline_text'] ?: get_field('hero_03_tagline_text', $post_id) ?: 'Future of Work';
    $title = $atts['title'] ?: get_field('hero_03_title', $post_id) ?: '次世代の<span class="heading-highlight">ワークスペース</span>体験を';
    $description = $atts['description'] ?: get_field('hero_03_description', $post_id) ?: '最先端のテクノロジーと美しいデザインが融合した、<br>新しい働き方を実現するワークスペース。<br><strong>あなたの創造性を最大限に引き出します。</strong>';
    $primary_cta_text = $atts['primary_cta_text'] ?: get_field('hero_03_primary_cta_text', $post_id) ?: '体験予約する';
    $primary_cta_link = $atts['primary_cta_link'] ?: get_field('hero_03_primary_cta_link', $post_id) ?: '#contact';
    $secondary_cta_text = $atts['secondary_cta_text'] ?: get_field('hero_03_secondary_cta_text', $post_id) ?: 'ギャラリーを見る';
    $secondary_cta_link = $atts['secondary_cta_link'] ?: get_field('hero_03_secondary_cta_link', $post_id) ?: '#gallery';
    $background_image = $atts['background_image'] ?: get_field('hero_03_background_image', $post_id) ?: 'https://images.unsplash.com/photo-1497366754035-f200968a6e72?w=1920&h=1080&fit=crop&auto=format';
    
    // ユニークID生成（CSS・JSの競合防止）
    $unique_id = 'hero_03_' . uniqid();
    
    // HTMLの出力開始
    ob_start();
    ?>
    
    <style>
    /* ヒーローセクション03 - 写真背景版 */
    .<?php echo $unique_id; ?>.hero-photo-version {
        position: relative;
        height: 100vh;
        min-height: 700px;
        overflow: hidden;
        display: flex;
        align-items: center;
        color: white;
    }
    
    /* 背景画像セクション */
    .<?php echo $unique_id; ?> .hero-background {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        z-index: 1;
    }
    
    .<?php echo $unique_id; ?> .hero-image-container {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        overflow: hidden;
    }
    
    .<?php echo $unique_id; ?> .hero-bg-image {
        width: 100%;
        height: 100%;
        object-fit: cover;
        object-position: center;
        transform: scale(1.05);
        animation: heroImageZoom-<?php echo $unique_id; ?> 20s ease-in-out infinite alternate;
    }
    
    .<?php echo $unique_id; ?> .hero-overlay {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: linear-gradient(
            135deg,
            rgba(0, 0, 0, 0.7) 0%,
            rgba(0, 0, 0, 0.4) 50%,
            rgba(0, 0, 0, 0.6) 100%
        );
        z-index: 2;
    }
    
    /* コンテンツエリア */
    .<?php echo $unique_id; ?> .hero-content-03 {
        position: relative;
        z-index: 3;
        width: 100%;
        height: 100%;
        display: flex;
        align-items: center;
    }
    
    .<?php echo $unique_id; ?> .hero-container-03 {
        max-width: 1200px;
        margin: 0 auto;
        padding: 0 40px;
        width: 100%;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }
    
    .<?php echo $unique_id; ?> .hero-text-wrapper {
        flex: 1;
    }
    
    /* タグライン */
    .<?php echo $unique_id; ?> .hero-tagline {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        background: rgba(255, 255, 255, 0.1);
        backdrop-filter: blur(10px);
        border: 1px solid rgba(255, 255, 255, 0.2);
        padding: 8px 20px;
        border-radius: 50px;
        font-size: 14px;
        font-weight: 500;
        margin-bottom: 30px;
        animation: fadeInUp-<?php echo $unique_id; ?> 1s ease-out 0.2s both;
    }
    
    .<?php echo $unique_id; ?> .tagline-icon {
        font-size: 16px;
    }
    
    /* メインヘッディング */
    .<?php echo $unique_id; ?> .hero-main-heading {
        font-size: 64px;
        font-weight: 800;
        line-height: 1.1;
        margin-bottom: 30px;
        letter-spacing: -0.02em;
        animation: fadeInUp-<?php echo $unique_id; ?> 1s ease-out 0.4s both;
    }
    
    .<?php echo $unique_id; ?> .heading-highlight {
        background: linear-gradient(135deg, #fbbf24 0%, #f59e0b 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
    }
    
    /* リードテキスト */
    .<?php echo $unique_id; ?> .hero-lead-text {
        font-size: 20px;
        line-height: 1.6;
        color: rgba(255, 255, 255, 0.9);
        margin-bottom: 40px;
        animation: fadeInUp-<?php echo $unique_id; ?> 1s ease-out 1s both;
    }
    
    .<?php echo $unique_id; ?> .hero-lead-text strong {
        color: #fbbf24;
        font-weight: 600;
    }
    
    /* アクションセクション */
    .<?php echo $unique_id; ?> .hero-action-section {
        animation: fadeInUp-<?php echo $unique_id; ?> 1s ease-out 1.2s both;
    }
    
    .<?php echo $unique_id; ?> .hero-cta-buttons {
        display: flex;
        gap: 20px;
        margin-bottom: 0;
    }
    
    /* プライマリボタン */
    .<?php echo $unique_id; ?> .btn-primary-03 {
        display: inline-flex;
        align-items: center;
        gap: 12px;
        background: linear-gradient(135deg, #fbbf24 0%, #f59e0b 100%);
        color: #000;
        padding: 16px 32px;
        border-radius: 50px;
        text-decoration: none;
        font-weight: 700;
        font-size: 16px;
        transition: all 0.3s ease;
        box-shadow: 0 8px 32px rgba(251, 191, 36, 0.3);
        position: relative;
        overflow: hidden;
    }
    
    .<?php echo $unique_id; ?> .btn-primary-03::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.3), transparent);
        transition: left 0.6s ease;
    }
    
    .<?php echo $unique_id; ?> .btn-primary-03:hover::before {
        left: 100%;
    }
    
    .<?php echo $unique_id; ?> .btn-primary-03:hover {
        transform: translateY(-3px);
        box-shadow: 0 12px 40px rgba(251, 191, 36, 0.4);
        color: #000;
        text-decoration: none;
    }
    
    /* セカンダリボタン */
    .<?php echo $unique_id; ?> .btn-secondary-03 {
        display: inline-flex;
        align-items: center;
        gap: 12px;
        background: rgba(255, 255, 255, 0.1);
        backdrop-filter: blur(10px);
        border: 2px solid rgba(255, 255, 255, 0.3);
        color: white;
        padding: 16px 32px;
        border-radius: 50px;
        text-decoration: none;
        font-weight: 600;
        font-size: 16px;
        transition: all 0.3s ease;
    }
    
    .<?php echo $unique_id; ?> .btn-secondary-03:hover {
        background: rgba(255, 255, 255, 0.2);
        border-color: rgba(255, 255, 255, 0.5);
        transform: translateY(-3px);
        color: white;
        text-decoration: none;
    }
    
    /* ビジュアルインジケーター */
    .<?php echo $unique_id; ?> .hero-visual-indicator {
        position: absolute;
        right: 40px;
        bottom: 40px;
    }
    
    .<?php echo $unique_id; ?> .scroll-indicator {
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 10px;
        animation: fadeInUp-<?php echo $unique_id; ?> 1s ease-out 1.4s both;
    }
    
    .<?php echo $unique_id; ?> .scroll-text {
        font-size: 12px;
        font-weight: 500;
        text-transform: uppercase;
        letter-spacing: 0.1em;
        color: rgba(255, 255, 255, 0.7);
        writing-mode: vertical-lr;
    }
    
    .<?php echo $unique_id; ?> .scroll-line {
        width: 1px;
        height: 60px;
        background: linear-gradient(to bottom, rgba(255, 255, 255, 0.7), transparent);
        position: relative;
    }
    
    .<?php echo $unique_id; ?> .scroll-line::after {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 20px;
        background: #fbbf24;
        animation: scrollLineMove-<?php echo $unique_id; ?> 2s ease-in-out infinite;
    }
    
    /* アニメーション定義 */
    @keyframes fadeInUp-<?php echo $unique_id; ?> {
        from {
            opacity: 0;
            transform: translateY(30px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
    
    @keyframes heroImageZoom-<?php echo $unique_id; ?> {
        0% {
            transform: scale(1.05);
        }
        100% {
            transform: scale(1.1);
        }
    }
    
    @keyframes scrollLineMove-<?php echo $unique_id; ?> {
        0%, 100% {
            transform: translateY(0);
            opacity: 1;
        }
        50% {
            transform: translateY(40px);
            opacity: 0.3;
        }
    }
    
    /* レスポンシブ対応 */
    @media (max-width: 1024px) {
        .<?php echo $unique_id; ?> .hero-container-03 {
            flex-direction: column;
            text-align: center;
            gap: 40px;
        }
        
        .<?php echo $unique_id; ?> .hero-main-heading {
            font-size: 48px;
        }
        
        .<?php echo $unique_id; ?> .hero-visual-indicator {
            position: relative;
            right: auto;
            bottom: auto;
        }
    }
    
    @media (max-width: 768px) {
        .<?php echo $unique_id; ?> .hero-container-03 {
            padding: 0 20px;
        }
        
        .<?php echo $unique_id; ?> .hero-main-heading {
            font-size: 36px;
        }
        
        .<?php echo $unique_id; ?> .hero-lead-text {
            font-size: 18px;
        }
        
        .<?php echo $unique_id; ?> .hero-cta-buttons {
            flex-direction: column;
            align-items: center;
            gap: 15px;
            justify-content: center;
        }
        
        .<?php echo $unique_id; ?> .btn-primary-03,
        .<?php echo $unique_id; ?> .btn-secondary-03 {
            padding: 14px 28px;
            font-size: 15px;
        }
        
        .<?php echo $unique_id; ?> .scroll-indicator {
            display: none;
        }
    }
    </style>
    
    <!-- ヒーローセクション03（写真背景版） -->
    <section class="<?php echo $unique_id; ?> hero-photo-version" id="hero-03-module">
        <div class="hero-background">
            <div class="hero-image-container">
                <img src="<?php echo esc_url($background_image); ?>" alt="現代的なオフィス空間" class="hero-bg-image">
            </div>
            <div class="hero-overlay"></div>
        </div>
        
        <div class="hero-content-03">
            <div class="hero-container-03">
                <div class="hero-text-wrapper">
                    <div class="hero-tagline">
                        <span class="tagline-icon"><?php echo esc_html($tagline_icon); ?></span>
                        <span class="tagline-text"><?php echo esc_html($tagline_text); ?></span>
                    </div>
                    
                    <h1 class="hero-main-heading">
                        <?php echo wp_kses_post($title); ?>
                    </h1>
                    
                    <p class="hero-lead-text">
                        <?php echo wp_kses_post($description); ?>
                    </p>
                    
                    <div class="hero-action-section">
                        <div class="hero-cta-buttons">
                            <a href="<?php echo esc_url($primary_cta_link); ?>" class="btn-primary-03">
                                <span class="btn-text"><?php echo esc_html($primary_cta_text); ?></span>
                                <span class="btn-icon">
                                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none">
                                        <path d="M5 12h14m-7-7l7 7-7 7" stroke="currentColor" stroke-width="2"/>
                                    </svg>
                                </span>
                            </a>
                            <a href="<?php echo esc_url($secondary_cta_link); ?>" class="btn-secondary-03">
                                <span class="btn-icon">
                                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none">
                                        <circle cx="12" cy="12" r="10" stroke="currentColor" stroke-width="2"/>
                                        <polygon points="10,8 16,12 10,16" fill="currentColor"/>
                                    </svg>
                                </span>
                                <span class="btn-text"><?php echo esc_html($secondary_cta_text); ?></span>
                            </a>
                        </div>
                    </div>
                </div>
                
                <div class="hero-visual-indicator">
                    <div class="scroll-indicator">
                        <span class="scroll-text">Scroll</span>
                        <div class="scroll-line"></div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script>
    document.addEventListener('DOMContentLoaded', function() {
        // パララックス効果
        const heroImage_<?php echo $unique_id; ?> = document.querySelector('.<?php echo $unique_id; ?> .hero-bg-image');
        const heroSection_<?php echo $unique_id; ?> = document.querySelector('.<?php echo $unique_id; ?>.hero-photo-version');
        
        if (heroImage_<?php echo $unique_id; ?> && heroSection_<?php echo $unique_id; ?>) {
            window.addEventListener('scroll', function() {
                const scrollTop = window.pageYOffset;
                const sectionHeight = heroSection_<?php echo $unique_id; ?>.offsetHeight;
                const scrollRatio = scrollTop / sectionHeight;
                
                // 背景画像のパララックス効果
                if (scrollRatio <= 1) {
                    const translateY = scrollRatio * 50;
                    heroImage_<?php echo $unique_id; ?>.style.transform = `scale(1.05) translateY(${translateY}px)`;
                }
            });
        }
        
        // CTAボタンのクリック追跡
        const ctaButtons_<?php echo $unique_id; ?> = document.querySelectorAll('.<?php echo $unique_id; ?> .btn-primary-03, .<?php echo $unique_id; ?> .btn-secondary-03');
        ctaButtons_<?php echo $unique_id; ?>.forEach(function(button) {
            button.addEventListener('click', function(e) {
                const buttonType = button.classList.contains('btn-primary-03') ? 'primary' : 'secondary';
                const buttonText = button.querySelector('.btn-text').textContent;
                
                // Google Analytics トラッキング
                if (typeof gtag !== 'undefined') {
                    gtag('event', 'hero_03_cta_click', {
                        'event_category': 'engagement',
                        'event_label': buttonType + '_' + buttonText,
                        'section': 'hero_photo_version',
                        'module_id': '<?php echo $unique_id; ?>'
                    });
                }
                
                console.log('Hero 03 Module CTA clicked:', buttonType, buttonText, 'ID:', '<?php echo $unique_id; ?>');
                
                // スムーススクロール
                const href = button.getAttribute('href');
                if (href && href.startsWith('#')) {
                    e.preventDefault();
                    const target = document.querySelector(href);
                    if (target) {
                        target.scrollIntoView({
                            behavior: 'smooth',
                            block: 'start'
                        });
                    }
                }
            });
        });
        
        console.log('Hero Section 03 Module loaded with parallax and interactions - ID:', '<?php echo $unique_id; ?>');
    });
    </script>

    <?php
    return ob_get_clean();
}
?> 