<?php
/**
 * Hero Module - Complete Independent Version
 * ショートコード: [hero_module]
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
            'key' => 'group_hero_complete',
            'title' => 'ヒーローモジュール設定',
            'fields' => array(
                array(
                    'key' => 'field_hero_main_title',
                    'label' => 'メインタイトル',
                    'name' => 'hero_main_title',
                    'type' => 'textarea',
                    'default_value' => 'あなたのビジネスを<br>次のレベルへ',
                    'instructions' => 'HTML可。改行は<br>を使用',
                ),
                array(
                    'key' => 'field_hero_subtitle',
                    'label' => 'サブタイトル',
                    'name' => 'hero_subtitle',
                    'type' => 'textarea',
                    'default_value' => '最新技術で業務を効率化し、競合他社に差をつけましょう。導入企業の95%が効果を実感！',
                ),
                array(
                    'key' => 'field_hero_cta_text',
                    'label' => 'CTAボタンテキスト',
                    'name' => 'hero_cta_text',
                    'type' => 'text',
                    'default_value' => '無料相談を申し込む',
                ),
                array(
                    'key' => 'field_hero_cta_sub',
                    'label' => 'CTAサブテキスト',
                    'name' => 'hero_cta_sub',
                    'type' => 'text',
                    'default_value' => '初回相談無料・オンライン対応',
                ),
                array(
                    'key' => 'field_hero_cta_link',
                    'label' => 'CTAリンク先',
                    'name' => 'hero_cta_link',
                    'type' => 'text',
                    'default_value' => '#contact',
                ),
                array(
                    'key' => 'field_hero_bg_color',
                    'label' => '背景色',
                    'name' => 'hero_bg_color',
                    'type' => 'select',
                    'choices' => array(
                        'gradient-blue' => 'ブルーグラデーション',
                        'gradient-purple' => 'パープルグラデーション',
                        'gradient-green' => 'グリーングラデーション',
                        'solid-dark' => 'ダークカラー',
                    ),
                    'default_value' => 'gradient-blue',
                ),
                array(
                    'key' => 'field_hero_bg_image',
                    'label' => '背景画像',
                    'name' => 'hero_bg_image',
                    'type' => 'image',
                    'instructions' => '背景画像を設定（オプション）。設定すると背景色の上に重なります。',
                    'return_format' => 'url',
                ),
                array(
                    'key' => 'field_hero_text_color',
                    'label' => 'テキストカラー',
                    'name' => 'hero_text_color',
                    'type' => 'select',
                    'choices' => array(
                        'white' => '白色',
                        'dark' => '濃色',
                        'custom' => 'カスタム色',
                    ),
                    'default_value' => 'white',
                ),
                array(
                    'key' => 'field_hero_custom_color',
                    'label' => 'カスタムテキスト色',
                    'name' => 'hero_custom_color',
                    'type' => 'color_picker',
                    'conditional_logic' => array(
                        array(
                            array(
                                'field' => 'field_hero_text_color',
                                'operator' => '==',
                                'value' => 'custom',
                            ),
                        ),
                    ),
                ),
                array(
                    'key' => 'field_hero_animation',
                    'label' => 'アニメーション',
                    'name' => 'hero_animation',
                    'type' => 'select',
                    'choices' => array(
                        'fade-up' => 'フェードアップ',
                        'fade-in' => 'フェードイン',
                        'slide-left' => '左からスライド',
                        'slide-right' => '右からスライド',
                        'none' => 'アニメーションなし',
                    ),
                    'default_value' => 'fade-up',
                ),
                array(
                    'key' => 'field_hero_achievements',
                    'label' => '実績データ',
                    'name' => 'hero_achievements',
                    'type' => 'repeater',
                    'sub_fields' => array(
                        array(
                            'key' => 'field_achievement_number',
                            'label' => '数値',
                            'name' => 'number',
                            'type' => 'text',
                        ),
                        array(
                            'key' => 'field_achievement_label',
                            'label' => 'ラベル',
                            'name' => 'label',
                            'type' => 'text',
                        ),
                    ),
                    'min' => 0,
                    'max' => 4,
                    'button_label' => '実績を追加',
                ),
            ),
            'location' => get_smart_location(), // 最小記述方式（1行のみ）
        ));
}

/**
 * ショートコード登録
 */
add_shortcode('hero_module', 'render_hero_module');

function render_hero_module($atts = [], $content = null) {
    // 属性のデフォルト値
    $atts = shortcode_atts(array(
        'title' => '',
        'subtitle' => '',
        'cta_text' => '',
        'cta_link' => '',
        'bg_color' => '',
        'post_id' => get_the_ID(),
    ), $atts);
    
    // ACFフィールドから値を取得（ショートコード属性で上書き可能）
    $post_id = $atts['post_id'];
    $main_title = $atts['title'] ?: get_field('hero_main_title', $post_id) ?: 'あなたのビジネスを<br>次のレベルへ';
    $subtitle = $atts['subtitle'] ?: get_field('hero_subtitle', $post_id) ?: '最新技術で業務を効率化し、競合他社に差をつけましょう。';
    $cta_text = $atts['cta_text'] ?: get_field('hero_cta_text', $post_id) ?: '無料相談を申し込む';
    $cta_sub = get_field('hero_cta_sub', $post_id) ?: '初回相談無料・オンライン対応';
    $cta_link = $atts['cta_link'] ?: get_field('hero_cta_link', $post_id) ?: '#contact';
    $bg_color = $atts['bg_color'] ?: get_field('hero_bg_color', $post_id) ?: 'gradient-blue';
    
    // 新しく追加したフィールド
    $bg_image = get_field('hero_bg_image', $post_id);
    $text_color = get_field('hero_text_color', $post_id) ?: 'white';
    $custom_color = get_field('hero_custom_color', $post_id);
    $animation = get_field('hero_animation', $post_id) ?: 'fade-up';
    
    // 実績データ取得
    $achievements = get_field('hero_achievements', $post_id) ?: array(
        array('number' => '1,000+', 'label' => '導入実績'),
        array('number' => '98%', 'label' => '満足度'),
        array('number' => '24h', 'label' => 'サポート'),
    );
    
    // ユニークIDを生成（複数モジュール対応）
    $unique_id = 'hero_' . uniqid();
    
    ob_start();
    ?>
    
    <!-- CSS（モジュール内完結） -->
    <style>
    .<?php echo $unique_id; ?> {
        position: relative;
        padding: 100px 0;
        text-align: center;
        color: <?php echo $text_color === 'dark' ? '#333' : ($text_color === 'custom' && $custom_color ? $custom_color : 'white'); ?>;
        overflow: hidden;
        min-height: 600px;
        display: flex;
        align-items: center;
        <?php if ($bg_image): ?>
        background-image: url('<?php echo esc_url($bg_image); ?>');
        background-size: cover;
        background-position: center;
        background-repeat: no-repeat;
        <?php endif; ?>
    }
    
    /* 背景色バリエーション */
    .<?php echo $unique_id; ?>.gradient-blue {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    }
    .<?php echo $unique_id; ?>.gradient-purple {
        background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
    }
    .<?php echo $unique_id; ?>.gradient-green {
        background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
    }
    .<?php echo $unique_id; ?>.solid-dark {
        background: linear-gradient(135deg, #2c3e50 0%, #34495e 100%);
    }
    
    .<?php echo $unique_id; ?>::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1000 1000"><polygon fill="rgba(255,255,255,0.1)" points="0,1000 1000,0 1000,1000"/></svg>');
        pointer-events: none;
    }
    
    .<?php echo $unique_id; ?> .container {
        max-width: 1200px;
        margin: 0 auto;
        padding: 0 20px;
        position: relative;
        z-index: 2;
    }
    
    .<?php echo $unique_id; ?> .main-title {
        font-size: clamp(2.5rem, 5vw, 4rem);
        font-weight: bold;
        margin-bottom: 20px;
        line-height: 1.2;
        animation: heroFadeInUp 1s ease-out;
    }
    
    .<?php echo $unique_id; ?> .subtitle {
        font-size: clamp(1.1rem, 2vw, 1.3rem);
        margin-bottom: 40px;
        opacity: 0.95;
        max-width: 600px;
        margin-left: auto;
        margin-right: auto;
        line-height: 1.6;
        animation: heroFadeInUp 1s ease-out 0.2s both;
    }
    
    .<?php echo $unique_id; ?> .cta-container {
        margin-bottom: 50px;
        animation: heroFadeInUp 1s ease-out 0.4s both;
    }
    
    .<?php echo $unique_id; ?> .cta-button {
        display: inline-block;
        background: rgba(255, 255, 255, 0.2);
        color: white;
        padding: 18px 40px;
        text-decoration: none;
        border-radius: 50px;
        font-size: 1.1rem;
        font-weight: 600;
        border: 2px solid rgba(255, 255, 255, 0.3);
        transition: all 0.3s ease;
        backdrop-filter: blur(10px);
        cursor: pointer;
        position: relative;
        overflow: hidden;
    }
    
    .<?php echo $unique_id; ?> .cta-button:hover {
        background: rgba(255, 255, 255, 0.3);
        transform: translateY(-2px);
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.2);
    }
    
    .<?php echo $unique_id; ?> .cta-button::before {
        content: '';
        position: absolute;
        top: 50%;
        left: 50%;
        width: 0;
        height: 0;
        background: rgba(255, 255, 255, 0.1);
        border-radius: 50%;
        transform: translate(-50%, -50%);
        transition: all 0.5s ease;
    }
    
    .<?php echo $unique_id; ?> .cta-button:hover::before {
        width: 300px;
        height: 300px;
    }
    
    .<?php echo $unique_id; ?> .cta-main {
        display: block;
        font-size: 1.1rem;
        margin-bottom: 4px;
    }
    
    .<?php echo $unique_id; ?> .cta-sub {
        display: block;
        font-size: 0.9rem;
        opacity: 0.8;
    }
    
    .<?php echo $unique_id; ?> .achievements {
        display: flex;
        justify-content: center;
        gap: 60px;
        animation: heroFadeInUp 1s ease-out 0.6s both;
        flex-wrap: wrap;
    }
    
    .<?php echo $unique_id; ?> .achievement-item {
        text-align: center;
        min-width: 120px;
    }
    
    .<?php echo $unique_id; ?> .achievement-number {
        display: block;
        font-size: 2.5rem;
        font-weight: bold;
        margin-bottom: 8px;
        background: linear-gradient(45deg, rgba(255,255,255,1), rgba(255,255,255,0.7));
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
    }
    
    .<?php echo $unique_id; ?> .achievement-label {
        display: block;
        font-size: 0.9rem;
        opacity: 0.8;
        text-transform: uppercase;
        letter-spacing: 1px;
    }
    
    /* アニメーション */
    @keyframes heroFadeInUp {
        from {
            opacity: 0;
            transform: translateY(30px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
    
    @keyframes heroFadeIn {
        from {
            opacity: 0;
        }
        to {
            opacity: 1;
        }
    }
    
    @keyframes heroSlideLeft {
        from {
            opacity: 0;
            transform: translateX(-50px);
        }
        to {
            opacity: 1;
            transform: translateX(0);
        }
    }
    
    @keyframes heroSlideRight {
        from {
            opacity: 0;
            transform: translateX(50px);
        }
        to {
            opacity: 1;
            transform: translateX(0);
        }
    }
    
    /* アニメーションクラス */
    .<?php echo $unique_id; ?>.fade-up .main-title,
    .<?php echo $unique_id; ?>.fade-up .subtitle,
    .<?php echo $unique_id; ?>.fade-up .cta-container,
    .<?php echo $unique_id; ?>.fade-up .achievements {
        animation-name: heroFadeInUp;
    }
    
    .<?php echo $unique_id; ?>.fade-in .main-title,
    .<?php echo $unique_id; ?>.fade-in .subtitle,
    .<?php echo $unique_id; ?>.fade-in .cta-container,
    .<?php echo $unique_id; ?>.fade-in .achievements {
        animation-name: heroFadeIn;
    }
    
    .<?php echo $unique_id; ?>.slide-left .main-title,
    .<?php echo $unique_id; ?>.slide-left .subtitle,
    .<?php echo $unique_id; ?>.slide-left .cta-container,
    .<?php echo $unique_id; ?>.slide-left .achievements {
        animation-name: heroSlideLeft;
    }
    
    .<?php echo $unique_id; ?>.slide-right .main-title,
    .<?php echo $unique_id; ?>.slide-right .subtitle,
    .<?php echo $unique_id; ?>.slide-right .cta-container,
    .<?php echo $unique_id; ?>.slide-right .achievements {
        animation-name: heroSlideRight;
    }
    
    .<?php echo $unique_id; ?>.none .main-title,
    .<?php echo $unique_id; ?>.none .subtitle,
    .<?php echo $unique_id; ?>.none .cta-container,
    .<?php echo $unique_id; ?>.none .achievements {
        animation: none;
    }
    
    /* レスポンシブ */
    @media (max-width: 768px) {
        .<?php echo $unique_id; ?> {
            padding: 80px 0;
            min-height: 500px;
        }
        
        .<?php echo $unique_id; ?> .achievements {
            gap: 40px;
        }
        
        .<?php echo $unique_id; ?> .achievement-number {
            font-size: 2rem;
        }
    }
    </style>
    
    <!-- HTML構造 -->
    <section class="<?php echo $unique_id; ?> <?php echo esc_attr($bg_color); ?> <?php echo esc_attr($animation); ?>" id="hero-module">
        <div class="container">
            <h1 class="main-title"><?php echo $main_title; ?></h1>
            <p class="subtitle"><?php echo esc_html($subtitle); ?></p>
            
            <div class="cta-container">
                <a href="<?php echo esc_attr($cta_link); ?>" class="cta-button" onclick="heroCtaClick_<?php echo $unique_id; ?>(event)">
                    <span class="cta-main"><?php echo esc_html($cta_text); ?></span>
                    <span class="cta-sub"><?php echo esc_html($cta_sub); ?></span>
                </a>
            </div>
            
            <?php if (!empty($achievements) && is_array($achievements)): ?>
            <div class="achievements">
                <?php foreach ($achievements as $achievement): ?>
                    <div class="achievement-item">
                        <span class="achievement-number"><?php echo esc_html($achievement['number']); ?></span>
                        <span class="achievement-label"><?php echo esc_html($achievement['label']); ?></span>
                    </div>
                <?php endforeach; ?>
            </div>
            <?php endif; ?>
        </div>
    </section>
    
    <!-- JavaScript（モジュール内完結） -->
    <script>
    function heroCtaClick_<?php echo $unique_id; ?>(event) {
        const btn = event.target.closest('.cta-button');
        
        // クリックエフェクト
        btn.style.transform = 'translateY(-2px) scale(0.98)';
        setTimeout(() => {
            btn.style.transform = 'translateY(-2px) scale(1)';
        }, 150);
        
        // Google Analytics トラッキング
        if (typeof gtag !== 'undefined') {
            gtag('event', 'hero_cta_click', {
                'event_category': 'engagement',
                'event_label': 'hero_module',
                'module_id': '<?php echo $unique_id; ?>'
            });
        }
        
        // スムーススクロール（内部リンクの場合）
        const href = btn.getAttribute('href');
        if (href.startsWith('#')) {
            event.preventDefault();
            const target = document.querySelector(href);
            if (target) {
                target.scrollIntoView({
                    behavior: 'smooth',
                    block: 'start'
                });
            }
        }
        
        console.log('Hero CTA clicked:', '<?php echo $unique_id; ?>');
    }
    
    // モジュール初期化
    document.addEventListener('DOMContentLoaded', function() {
        console.log('Hero Module Loaded: <?php echo $unique_id; ?>');
        
        // 交差観測による要素の表示アニメーション
        const heroElement = document.querySelector('.<?php echo $unique_id; ?>');
        if (heroElement && 'IntersectionObserver' in window) {
            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.style.animationPlayState = 'running';
                    }
                });
            }, { threshold: 0.1 });
            
            observer.observe(heroElement);
        }
    });
    </script>
    
    <?php
    return ob_get_clean();
}

/**
 * 使用方法：
 * 
 * ショートコード:
 * [hero_module]
 * [hero_module title="カスタムタイトル" cta_text="今すぐ始める"]
 * [hero_module bg_color="gradient-purple"]
 * 
 * PHP:
 * echo do_shortcode('[hero_module]');
 * 
 * ACF管理画面:
 * 「ヒーローモジュール設定」でコンテンツ編集可能
 */
?> 