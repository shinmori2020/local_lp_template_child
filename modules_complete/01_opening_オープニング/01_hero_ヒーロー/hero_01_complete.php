<?php
/**
 * Hero Module 01 - Complete Independent Version
 * ショートコード: [hero_01_module]
 * 
 * スライダー機能付きヒーローセクションモジュール
 * 業務効率化をテーマにしたサービス紹介用
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
        'key' => 'group_hero_01_complete',
        'title' => 'ヒーローモジュール01設定',
        'fields' => array(
            array(
                'key' => 'field_hero_01_badge_icon',
                'label' => 'バッジアイコン',
                'name' => 'hero_01_badge_icon',
                'type' => 'text',
                'default_value' => '🚀',
            ),
            array(
                'key' => 'field_hero_01_badge_text',
                'label' => 'バッジテキスト',
                'name' => 'hero_01_badge_text',
                'type' => 'text',
                'default_value' => 'AI自動化ツール',
            ),
            array(
                'key' => 'field_hero_01_title',
                'label' => 'メインタイトル',
                'name' => 'hero_01_title',
                'type' => 'textarea',
                'default_value' => '業務効率を<span class="title-highlight">3倍向上</span>',
                'instructions' => 'HTML可。ハイライト部分は<span class="title-highlight">で囲む',
            ),
            array(
                'key' => 'field_hero_01_description',
                'label' => '説明文',
                'name' => 'hero_01_description',
                'type' => 'textarea',
                'default_value' => '手作業を自動化して<strong>初月から効果実感</strong>',
                'instructions' => 'HTML可',
            ),
            array(
                'key' => 'field_hero_01_features',
                'label' => '機能特徴',
                'name' => 'hero_01_features',
                'type' => 'repeater',
                'sub_fields' => array(
                    array(
                        'key' => 'field_feature_icon',
                        'label' => 'アイコン',
                        'name' => 'icon',
                        'type' => 'text',
                        'instructions' => '例: ⚡, 💰, 📈',
                    ),
                    array(
                        'key' => 'field_feature_text',
                        'label' => 'テキスト',
                        'name' => 'text',
                        'type' => 'text',
                    ),
                ),
                'min' => 0,
                'max' => 4,
                'button_label' => '機能を追加',
            ),
            array(
                'key' => 'field_hero_01_cta_text',
                'label' => 'CTAボタンテキスト',
                'name' => 'hero_01_cta_text',
                'type' => 'text',
                'default_value' => '無料デモを見る',
            ),
            array(
                'key' => 'field_hero_01_cta_link',
                'label' => 'CTAリンク先',
                'name' => 'hero_01_cta_link',
                'type' => 'text',
                'default_value' => '#demo',
            ),
            array(
                'key' => 'field_hero_01_slides',
                'label' => 'スライダー画像',
                'name' => 'hero_01_slides',
                'type' => 'repeater',
                'sub_fields' => array(
                    array(
                        'key' => 'field_slide_image',
                        'label' => 'スライド画像',
                        'name' => 'image',
                        'type' => 'image',
                        'return_format' => 'array',
                    ),
                    array(
                        'key' => 'field_slide_title',
                        'label' => 'スライドタイトル',
                        'name' => 'title',
                        'type' => 'text',
                    ),
                    array(
                        'key' => 'field_slide_description',
                        'label' => 'スライド説明',
                        'name' => 'description',
                        'type' => 'text',
                    ),
                ),
                'min' => 1,
                'max' => 5,
                'button_label' => 'スライドを追加',
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

/**
 * ショートコード登録
 */
add_shortcode('hero_01_module', 'render_hero_01_module');

function render_hero_01_module($atts = [], $content = null) {
    // 属性のデフォルト値
    $atts = shortcode_atts(array(
        'badge_icon' => '',
        'badge_text' => '',
        'title' => '',
        'description' => '',
        'cta_text' => '',
        'cta_link' => '',
        'post_id' => get_the_ID(),
    ), $atts);
    
    // ACFフィールドから値を取得（ショートコード属性で上書き可能）
    $post_id = $atts['post_id'];
    $badge_icon = $atts['badge_icon'] ?: get_field('hero_01_badge_icon', $post_id) ?: '🚀';
    $badge_text = $atts['badge_text'] ?: get_field('hero_01_badge_text', $post_id) ?: 'AI自動化ツール';
    $title = $atts['title'] ?: get_field('hero_01_title', $post_id) ?: '業務効率を<span class="title-highlight">3倍向上</span>';
    $description = $atts['description'] ?: get_field('hero_01_description', $post_id) ?: '手作業を自動化して<strong>初月から効果実感</strong>';
    $cta_text = $atts['cta_text'] ?: get_field('hero_01_cta_text', $post_id) ?: '無料デモを見る';
    $cta_link = $atts['cta_link'] ?: get_field('hero_01_cta_link', $post_id) ?: '#demo';
    
    // 機能特徴データ取得
    $features = get_field('hero_01_features', $post_id) ?: array(
        array('icon' => '⚡', 'text' => '即日導入'),
        array('icon' => '💰', 'text' => 'コスト削減'),
        array('icon' => '📈', 'text' => '生産性UP'),
    );
    
    // スライダー画像データ取得
    $slides = get_field('hero_01_slides', $post_id) ?: array(
        array(
            'image' => array(
                'url' => 'https://images.unsplash.com/photo-1551434678-e076c223a692?w=600&h=400&fit=crop&auto=format',
                'alt' => 'AI自動化ダッシュボード'
            ),
            'title' => 'AI分析ダッシュボード',
            'description' => 'リアルタイムデータ可視化'
        ),
        array(
            'image' => array(
                'url' => 'https://images.unsplash.com/photo-1460925895917-afdab827c52f?w=600&h=400&fit=crop&auto=format',
                'alt' => '業務効率化'
            ),
            'title' => '業務効率化',
            'description' => '作業時間を大幅削減'
        ),
        array(
            'image' => array(
                'url' => 'https://images.unsplash.com/photo-1551288049-bebda4e38f71?w=600&h=400&fit=crop&auto=format',
                'alt' => '売上向上'
            ),
            'title' => '売上向上',
            'description' => 'パフォーマンス最適化'
        ),
    );
    
    // ユニークIDを生成（複数モジュール対応）
    $unique_id = 'hero_01_' . uniqid();
    
    ob_start();
    ?>
    
    <style>
    /* ヒーローセクション専用スタイル */
    .<?php echo $unique_id; ?> {
        background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 50%, #f1f5f9 100%);
        padding: 100px 0;
        position: relative;
        overflow: hidden;
        min-height: 100vh;
        display: flex;
        align-items: center;
    }
    
    .<?php echo $unique_id; ?>::before {
        content: '';
        position: absolute;
        top: 0;
        right: 0;
        width: 45.5%;
        height: 100%;
        background: linear-gradient(135deg, rgba(59, 130, 246, 0.03) 0%, rgba(147, 51, 234, 0.05) 50%, rgba(236, 72, 153, 0.03) 100%);
        z-index: 1;
        backdrop-filter: blur(1px);
    }
    
    .<?php echo $unique_id; ?> .hero-container {
        max-width: 1200px;
        margin: 0 auto;
        padding: 0 40px;
        position: relative;
        z-index: 2;
    }
    
    .<?php echo $unique_id; ?> .hero-content-wrapper {
        display: grid;
        grid-template-columns: 1.2fr 1fr;
        gap: 40px;
        align-items: center;
        margin-bottom: 80px;
    }
    
    .<?php echo $unique_id; ?> .hero-left {
        padding-right: 20px;
    }
    
    /* バッジスタイル */
    .<?php echo $unique_id; ?> .hero-badge {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        background: rgba(59, 130, 246, 0.1);
        color: #3b82f6;
        padding: 8px 16px;
        border-radius: 20px;
        font-size: 14px;
        font-weight: 600;
        margin-bottom: 20px;
        animation: slideInLeft 0.8s ease-out;
    }
    
    /* タイトルスタイル */
    .<?php echo $unique_id; ?> .hero-title {
        font-size: 42px;
        font-weight: 700;
        line-height: 1.2;
        margin-bottom: 20px;
        color: #0f172a;
        animation: slideInLeft 0.8s ease-out 0.2s both;
    }
    
    .<?php echo $unique_id; ?> .title-highlight {
        background: linear-gradient(135deg, #3b82f6 0%, #8b5cf6 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
    }
    
    /* 説明文スタイル */
    .<?php echo $unique_id; ?> .hero-description {
        font-size: 18px;
        line-height: 1.6;
        color: #64748b;
        margin-bottom: 30px;
        animation: slideInLeft 0.8s ease-out 0.4s both;
    }
    
    /* 機能リストスタイル */
    .<?php echo $unique_id; ?> .hero-features {
        display: flex;
        gap: 20px;
        margin-bottom: 30px;
        animation: slideInLeft 0.8s ease-out 0.6s both;
    }
    
    .<?php echo $unique_id; ?> .feature-item {
        font-size: 14px;
        color: #64748b;
        font-weight: 500;
        padding: 8px 12px;
        background: rgba(59, 130, 246, 0.05);
        border-radius: 20px;
        transition: all 0.3s ease;
    }
    
    .<?php echo $unique_id; ?> .feature-item:hover {
        background: rgba(59, 130, 246, 0.1);
        color: #3b82f6;
    }
    
    /* CTAボタンスタイル */
    .<?php echo $unique_id; ?> .hero-cta {
        animation: slideInLeft 0.8s ease-out 0.8s both;
    }
    
    .<?php echo $unique_id; ?> .cta-primary {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        background: linear-gradient(135deg, #3b82f6 0%, #8b5cf6 100%);
        color: white;
        padding: 16px 32px;
        border-radius: 12px;
        text-decoration: none;
        font-weight: 600;
        font-size: 16px;
        transition: all 0.3s ease;
        box-shadow: 0 4px 16px rgba(59, 130, 246, 0.3);
    }
    
    .<?php echo $unique_id; ?> .cta-primary:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 24px rgba(59, 130, 246, 0.4);
        color: white;
        text-decoration: none;
    }
    
    /* 右側スライダー */
    .<?php echo $unique_id; ?> .hero-right {
        display: flex;
        justify-content: center;
        align-items: center;
    }
    
    .<?php echo $unique_id; ?> .hero-slider {
        position: relative;
        width: 600px;
        height: 400px;
        animation: slideInRight 0.8s ease-out 0.4s both;
    }
    
    .<?php echo $unique_id; ?> .slider-container {
        position: relative;
        width: 100%;
        height: 100%;
        border-radius: 20px;
        overflow: hidden;
        box-shadow: 0 20px 60px rgba(0, 0, 0, 0.1);
    }
    
    .<?php echo $unique_id; ?> .slide {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        opacity: 0;
        transition: opacity 0.5s ease-in-out;
    }
    
    .<?php echo $unique_id; ?> .slide.active {
        opacity: 1;
    }
    
    .<?php echo $unique_id; ?> .slide img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }
    
    .<?php echo $unique_id; ?> .slide-overlay {
        position: absolute;
        bottom: 0;
        left: 0;
        right: 0;
        background: linear-gradient(transparent, rgba(0, 0, 0, 0.8));
        color: white;
        padding: 30px 20px 20px;
    }
    
    .<?php echo $unique_id; ?> .slide-overlay h3 {
        font-size: 20px;
        font-weight: 600;
        margin-bottom: 8px;
    }
    
    .<?php echo $unique_id; ?> .slide-overlay p {
        font-size: 14px;
        opacity: 0.9;
    }
    
    .<?php echo $unique_id; ?> .slider-controls {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-top: 20px;
    }
    
    .<?php echo $unique_id; ?> .slider-btn {
        width: 40px;
        height: 40px;
        border: none;
        border-radius: 50%;
        background: rgba(59, 130, 246, 0.1);
        color: #3b82f6;
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 20px;
        transition: all 0.3s ease;
    }
    
    .<?php echo $unique_id; ?> .slider-btn:hover {
        background: #3b82f6;
        color: white;
    }
    
    .<?php echo $unique_id; ?> .slider-dots {
        display: flex;
        gap: 8px;
    }
    
    .<?php echo $unique_id; ?> .dot {
        width: 10px;
        height: 10px;
        border-radius: 50%;
        background: rgba(59, 130, 246, 0.3);
        cursor: pointer;
        transition: all 0.3s ease;
    }
    
    .<?php echo $unique_id; ?> .dot.active {
        background: #3b82f6;
    }
    
    /* アニメーション */
    @keyframes slideInLeft {
        from {
            opacity: 0;
            transform: translateX(-40px);
        }
        to {
            opacity: 1;
            transform: translateX(0);
        }
    }
    
    @keyframes slideInRight {
        from {
            opacity: 0;
            transform: translateX(40px);
        }
        to {
            opacity: 1;
            transform: translateX(0);
        }
    }
    
    /* レスポンシブ対応 */
    @media (max-width: 1024px) {
        .<?php echo $unique_id; ?> .hero-content-wrapper {
            grid-template-columns: 1fr;
            gap: 30px;
            text-align: center;
        }
        
        .<?php echo $unique_id; ?> .hero-left {
            padding-right: 0;
        }
        
        .<?php echo $unique_id; ?> .hero-title {
            font-size: 36px;
        }
        
        .<?php echo $unique_id; ?> .hero-features {
            justify-content: center;
            flex-wrap: wrap;
        }
        
        .<?php echo $unique_id; ?> .hero-slider {
            width: 480px;
            height: 320px;
        }
    }
    
    @media (max-width: 768px) {
        .<?php echo $unique_id; ?> .hero-container {
            padding: 0 20px;
        }
        
        .<?php echo $unique_id; ?> .hero-title {
            font-size: 32px;
        }
        
        .<?php echo $unique_id; ?> .hero-features {
            justify-content: center;
            flex-wrap: wrap;
            gap: 12px;
        }
        
        .<?php echo $unique_id; ?> .hero-slider {
            width: 340px;
            height: 240px;
        }
    }
    </style>
    
    <section class="<?php echo $unique_id; ?>" id="hero-01-module">
        <div class="hero-container">
            <div class="hero-content-wrapper">
                <div class="hero-left">
                    <div class="hero-badge">
                        <span class="badge-icon"><?php echo esc_html($badge_icon); ?></span>
                        <span class="badge-text"><?php echo esc_html($badge_text); ?></span>
                    </div>
                    
                    <h2 class="hero-title">
                        <?php echo wp_kses_post($title); ?>
                    </h2>
                    
                    <p class="hero-description">
                        <?php echo wp_kses_post($description); ?>
                    </p>
                    
                    <?php if (!empty($features)): ?>
                    <div class="hero-features">
                        <?php foreach ($features as $feature): ?>
                            <div class="feature-item"><?php echo esc_html($feature['icon']); ?> <?php echo esc_html($feature['text']); ?></div>
                        <?php endforeach; ?>
                    </div>
                    <?php endif; ?>
                    
                    <div class="hero-cta">
                        <a href="<?php echo esc_url($cta_link); ?>" class="cta-primary" onclick="heroClick_<?php echo $unique_id; ?>(event)">
                            <span class="cta-text"><?php echo esc_html($cta_text); ?></span>
                            <span class="cta-arrow">→</span>
                        </a>
                    </div>
                </div>
                
                <div class="hero-right">
                    <div class="hero-slider">
                        <div class="slider-container">
                            <?php foreach ($slides as $index => $slide): ?>
                            <div class="slide <?php echo $index === 0 ? 'active' : ''; ?>">
                                <?php if (!empty($slide['image'])): ?>
                                    <img src="<?php echo esc_url($slide['image']['url']); ?>" alt="<?php echo esc_attr($slide['image']['alt']); ?>">
                                <?php endif; ?>
                                <div class="slide-overlay">
                                    <h3><?php echo esc_html($slide['title']); ?></h3>
                                    <p><?php echo esc_html($slide['description']); ?></p>
                                </div>
                            </div>
                            <?php endforeach; ?>
                        </div>
                        
                        <!-- スライダーコントロール -->
                        <div class="slider-controls">
                            <button class="slider-btn prev" onclick="heroSlider_<?php echo $unique_id; ?>.previousSlide()">‹</button>
                            <div class="slider-dots">
                                <?php foreach ($slides as $index => $slide): ?>
                                    <span class="dot <?php echo $index === 0 ? 'active' : ''; ?>" onclick="heroSlider_<?php echo $unique_id; ?>.currentSlide(<?php echo $index + 1; ?>)"></span>
                                <?php endforeach; ?>
                            </div>
                            <button class="slider-btn next" onclick="heroSlider_<?php echo $unique_id; ?>.nextSlide()">›</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    
    <script>
    // ヒーロースライダーコントローラー
    window.heroSlider_<?php echo $unique_id; ?> = (function() {
        let currentSlideIndex = 0;
        const slides = document.querySelectorAll('.<?php echo $unique_id; ?> .slide');
        const dots = document.querySelectorAll('.<?php echo $unique_id; ?> .dot');
        const totalSlides = slides.length;
        let slideInterval;
        
        function showSlide(index) {
            slides.forEach(slide => slide.classList.remove('active'));
            dots.forEach(dot => dot.classList.remove('active'));
            
            slides[index].classList.add('active');
            dots[index].classList.add('active');
            
            currentSlideIndex = index;
        }
        
        function nextSlide() {
            const nextIndex = (currentSlideIndex + 1) % totalSlides;
            showSlide(nextIndex);
        }
        
        function previousSlide() {
            const prevIndex = (currentSlideIndex - 1 + totalSlides) % totalSlides;
            showSlide(prevIndex);
        }
        
        function currentSlide(index) {
            showSlide(index - 1);
        }
        
        function startAutoSlide() {
            slideInterval = setInterval(nextSlide, 5000);
        }
        
        function stopAutoSlide() {
            if (slideInterval) {
                clearInterval(slideInterval);
            }
        }
        
        // 初期化
        document.addEventListener('DOMContentLoaded', function() {
            const sliderContainer = document.querySelector('.<?php echo $unique_id; ?> .hero-slider');
            if (sliderContainer) {
                sliderContainer.addEventListener('mouseenter', stopAutoSlide);
                sliderContainer.addEventListener('mouseleave', startAutoSlide);
                startAutoSlide();
            }
            
            console.log('Hero Module 01 Slider Loaded: <?php echo $unique_id; ?>');
        });
        
        return {
            nextSlide: nextSlide,
            previousSlide: previousSlide,
            currentSlide: currentSlide
        };
    })();
    
    // CTAクリック処理
    function heroClick_<?php echo $unique_id; ?>(event) {
        // Google Analytics トラッキング
        if (typeof gtag !== 'undefined') {
            gtag('event', 'hero_cta_click', {
                'event_category': 'engagement',
                'event_label': '<?php echo esc_js($cta_text); ?>',
                'module_id': '<?php echo $unique_id; ?>'
            });
        }
        
        console.log('Hero CTA clicked:', '<?php echo esc_js($cta_text); ?>');
        
        // スムーススクロール
        const href = event.target.closest('a').getAttribute('href');
        if (href && href.startsWith('#')) {
            event.preventDefault();
            const target = document.querySelector(href);
            if (target) {
                target.scrollIntoView({
                    behavior: 'smooth',
                    block: 'start'
                });
            }
        }
    }
    </script>
    
    <?php
    return ob_get_clean();
}
?> 