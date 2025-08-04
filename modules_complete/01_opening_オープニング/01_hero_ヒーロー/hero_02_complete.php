<?php
/**
 * Hero Module 02 - Complete Independent Version
 * ショートコード: [hero_02_module]
 * 
 * センター配置・パーティクル背景付きヒーローセクションモジュール
 * ITサービス・テクノロジー系向けダークテーマ
 * 
 * 完全独立型モジュール：
 * - ACFフィールド自動登録
 * - CSS内蔵
 * - JavaScript内蔵（パーティクル・タイピングアニメーション）
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
        'key' => 'group_hero_02_complete',
        'title' => 'ヒーローモジュール02設定',
        'fields' => array(
            array(
                'key' => 'field_hero_02_main_title',
                'label' => 'メインタイトル',
                'name' => 'hero_02_main_title',
                'type' => 'text',
                'default_value' => '革新的なソリューション',
            ),
            array(
                'key' => 'field_hero_02_typing_texts',
                'label' => 'タイピングテキスト',
                'name' => 'hero_02_typing_texts',
                'type' => 'repeater',
                'sub_fields' => array(
                    array(
                        'key' => 'field_typing_text',
                        'label' => 'テキスト',
                        'name' => 'text',
                        'type' => 'text',
                    ),
                ),
                'min' => 1,
                'max' => 5,
                'button_label' => 'テキストを追加',
            ),
            array(
                'key' => 'field_hero_02_subtitle',
                'label' => 'サブタイトル',
                'name' => 'hero_02_subtitle',
                'type' => 'textarea',
                'default_value' => '最先端のテクノロジーで、あなたのビジネスを次のレベルへ。<br>信頼性とイノベーションを両立した、プロフェッショナル向けのソリューション。',
                'instructions' => 'HTML可',
            ),
            array(
                'key' => 'field_hero_02_primary_cta_text',
                'label' => 'プライマリCTAテキスト',
                'name' => 'hero_02_primary_cta_text',
                'type' => 'text',
                'default_value' => '無料トライアル開始',
            ),
            array(
                'key' => 'field_hero_02_primary_cta_link',
                'label' => 'プライマリCTAリンク先',
                'name' => 'hero_02_primary_cta_link',
                'type' => 'text',
                'default_value' => '#trial',
            ),
            array(
                'key' => 'field_hero_02_secondary_cta_text',
                'label' => 'セカンダリCTAテキスト',
                'name' => 'hero_02_secondary_cta_text',
                'type' => 'text',
                'default_value' => 'デモを見る',
            ),
            array(
                'key' => 'field_hero_02_secondary_cta_link',
                'label' => 'セカンダリCTAリンク先',
                'name' => 'hero_02_secondary_cta_link',
                'type' => 'text',
                'default_value' => '#demo',
            ),
            array(
                'key' => 'field_hero_02_stats',
                'label' => '統計データ',
                'name' => 'hero_02_stats',
                'type' => 'repeater',
                'sub_fields' => array(
                    array(
                        'key' => 'field_stat_number',
                        'label' => '数値',
                        'name' => 'number',
                        'type' => 'text',
                        'instructions' => '例: 10,000+',
                    ),
                    array(
                        'key' => 'field_stat_label',
                        'label' => 'ラベル',
                        'name' => 'label',
                        'type' => 'text',
                        'instructions' => '例: 導入企業',
                    ),
                ),
                'min' => 0,
                'max' => 4,
                'button_label' => '統計データを追加',
            ),
            array(
                'key' => 'field_hero_02_theme_color',
                'label' => 'テーマカラー',
                'name' => 'hero_02_theme_color',
                'type' => 'select',
                'choices' => array(
                    'dark-blue' => 'ダークブルー（デフォルト）',
                    'dark-purple' => 'ダークパープル',
                    'dark-green' => 'ダークグリーン',
                    'dark-red' => 'ダークレッド',
                ),
                'default_value' => 'dark-blue',
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
add_shortcode('hero_02_module', 'render_hero_02_module');

function render_hero_02_module($atts = [], $content = null) {
    // 属性のデフォルト値
    $atts = shortcode_atts(array(
        'main_title' => '',
        'subtitle' => '',
        'primary_cta_text' => '',
        'primary_cta_link' => '',
        'secondary_cta_text' => '',
        'secondary_cta_link' => '',
        'theme_color' => '',
        'post_id' => get_the_ID(),
    ), $atts);
    
    // ACFフィールドから値を取得（ショートコード属性で上書き可能）
    $post_id = $atts['post_id'];
    $main_title = $atts['main_title'] ?: get_field('hero_02_main_title', $post_id) ?: '革新的なソリューション';
    $subtitle = $atts['subtitle'] ?: get_field('hero_02_subtitle', $post_id) ?: '最先端のテクノロジーで、あなたのビジネスを次のレベルへ。<br>信頼性とイノベーションを両立した、プロフェッショナル向けのソリューション。';
    $primary_cta_text = $atts['primary_cta_text'] ?: get_field('hero_02_primary_cta_text', $post_id) ?: '無料トライアル開始';
    $primary_cta_link = $atts['primary_cta_link'] ?: get_field('hero_02_primary_cta_link', $post_id) ?: '#trial';
    $secondary_cta_text = $atts['secondary_cta_text'] ?: get_field('hero_02_secondary_cta_text', $post_id) ?: 'デモを見る';
    $secondary_cta_link = $atts['secondary_cta_link'] ?: get_field('hero_02_secondary_cta_link', $post_id) ?: '#demo';
    $theme_color = $atts['theme_color'] ?: get_field('hero_02_theme_color', $post_id) ?: 'dark-blue';
    
    // タイピングテキストデータ取得
    $typing_texts = get_field('hero_02_typing_texts', $post_id) ?: array(
        array('text' => 'デジタル変革'),
        array('text' => '業務最適化'),
        array('text' => 'データ活用'),
        array('text' => 'AI自動化'),
    );
    
    // 統計データ取得
    $stats = get_field('hero_02_stats', $post_id) ?: array(
        array('number' => '10,000+', 'label' => '導入企業'),
        array('number' => '99.9%', 'label' => '稼働率'),
        array('number' => '24/7', 'label' => 'サポート'),
    );
    
    // ユニークIDを生成（複数モジュール対応）
    $unique_id = 'hero_02_' . uniqid();
    
    // テーマカラー設定
    $color_settings = array(
        'dark-blue' => array(
            'primary' => '#1e40af',
            'secondary' => '#3b82f6',
            'accent' => '#60a5fa',
        ),
        'dark-purple' => array(
            'primary' => '#7c3aed',
            'secondary' => '#8b5cf6',
            'accent' => '#a78bfa',
        ),
        'dark-green' => array(
            'primary' => '#059669',
            'secondary' => '#10b981',
            'accent' => '#34d399',
        ),
        'dark-red' => array(
            'primary' => '#dc2626',
            'secondary' => '#ef4444',
            'accent' => '#f87171',
        ),
    );
    
    $colors = $color_settings[$theme_color] ?? $color_settings['dark-blue'];
    
    ob_start();
    ?>
    
    <style>
    /* ヒーローセクション02専用スタイル - ダークテーマ */
    .<?php echo $unique_id; ?> {
        position: relative;
        min-height: 100vh;
        background: linear-gradient(135deg, #0f172a 0%, #1e293b 50%, #334155 100%);
        display: flex;
        align-items: center;
        justify-content: center;
        text-align: center;
        overflow: hidden;
        color: white;
    }
    
    /* パーティクル背景コンテナ */
    .<?php echo $unique_id; ?> .particles-container {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        z-index: 1;
    }
    
    .<?php echo $unique_id; ?> .particle {
        position: absolute;
        background: <?php echo $colors['accent']; ?>;
        border-radius: 50%;
        opacity: 0.6;
        animation: float-particle 20s infinite linear;
    }
    
    /* コンテンツコンテナ */
    .<?php echo $unique_id; ?> .hero-content {
        position: relative;
        z-index: 2;
        max-width: 900px;
        padding: 40px 20px;
        margin: 0 auto;
    }
    
    /* メインタイトル */
    .<?php echo $unique_id; ?> .hero-main-title {
        font-size: 48px;
        font-weight: 800;
        margin-bottom: 20px;
        line-height: 1.2;
        background: linear-gradient(135deg, <?php echo $colors['secondary']; ?> 0%, <?php echo $colors['accent']; ?> 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
        animation: fadeInUp 1s ease-out;
    }
    
    /* タイピングテキストセクション */
    .<?php echo $unique_id; ?> .typing-container {
        margin-bottom: 30px;
        height: 60px;
        display: flex;
        align-items: center;
        justify-content: center;
        animation: fadeInUp 1s ease-out 0.3s both;
    }
    
    .<?php echo $unique_id; ?> .typing-prefix {
        font-size: 32px;
        font-weight: 600;
        color: #e2e8f0;
        margin-right: 15px;
    }
    
    .<?php echo $unique_id; ?> .typing-text {
        font-size: 32px;
        font-weight: 700;
        color: <?php echo $colors['secondary']; ?>;
        border-right: 3px solid <?php echo $colors['accent']; ?>;
        padding-right: 5px;
        animation: blink 1.5s infinite;
    }
    
    /* サブタイトル */
    .<?php echo $unique_id; ?> .hero-subtitle {
        font-size: 20px;
        line-height: 1.6;
        color: #cbd5e1;
        margin-bottom: 40px;
        animation: fadeInUp 1s ease-out 0.6s both;
    }
    
    /* CTAボタンコンテナ */
    .<?php echo $unique_id; ?> .hero-cta-container {
        display: flex;
        gap: 20px;
        justify-content: center;
        margin-bottom: 60px;
        animation: fadeInUp 1s ease-out 0.9s both;
    }
    
    /* プライマリCTA */
    .<?php echo $unique_id; ?> .cta-primary {
        display: inline-flex;
        align-items: center;
        gap: 10px;
        background: linear-gradient(135deg, <?php echo $colors['primary']; ?> 0%, <?php echo $colors['secondary']; ?> 100%);
        color: white;
        padding: 16px 32px;
        border-radius: 50px;
        text-decoration: none;
        font-weight: 600;
        font-size: 16px;
        transition: all 0.3s ease;
        box-shadow: 0 8px 32px rgba(0, 0, 0, 0.3);
        position: relative;
        overflow: hidden;
    }
    
    .<?php echo $unique_id; ?> .cta-primary::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
        transition: left 0.5s ease;
    }
    
    .<?php echo $unique_id; ?> .cta-primary:hover::before {
        left: 100%;
    }
    
    .<?php echo $unique_id; ?> .cta-primary:hover {
        transform: translateY(-3px);
        box-shadow: 0 12px 40px rgba(0, 0, 0, 0.4);
        color: white;
        text-decoration: none;
    }
    
    /* セカンダリCTA */
    .<?php echo $unique_id; ?> .cta-secondary {
        display: inline-flex;
        align-items: center;
        gap: 10px;
        background: transparent;
        color: <?php echo $colors['accent']; ?>;
        border: 2px solid <?php echo $colors['accent']; ?>;
        padding: 16px 32px;
        border-radius: 50px;
        text-decoration: none;
        font-weight: 600;
        font-size: 16px;
        transition: all 0.3s ease;
    }
    
    .<?php echo $unique_id; ?> .cta-secondary:hover {
        background: <?php echo $colors['accent']; ?>;
        color: #0f172a;
        transform: translateY(-3px);
        text-decoration: none;
    }
    
    /* 統計データセクション */
    .<?php echo $unique_id; ?> .hero-stats {
        display: flex;
        justify-content: center;
        gap: 60px;
        animation: fadeInUp 1s ease-out 1.2s both;
    }
    
    .<?php echo $unique_id; ?> .stat-item {
        text-align: center;
    }
    
    .<?php echo $unique_id; ?> .stat-number {
        font-size: 36px;
        font-weight: 800;
        color: <?php echo $colors['accent']; ?>;
        display: block;
        margin-bottom: 8px;
        line-height: 1;
    }
    
    .<?php echo $unique_id; ?> .stat-label {
        font-size: 14px;
        color: #94a3b8;
        text-transform: uppercase;
        letter-spacing: 0.05em;
        font-weight: 500;
    }
    
    /* アニメーション定義 */
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
    
    @keyframes blink {
        0%, 50% { border-right-color: <?php echo $colors['accent']; ?>; }
        51%, 100% { border-right-color: transparent; }
    }
    
    @keyframes float-particle {
        0% {
            transform: translateY(100vh) rotate(0deg);
            opacity: 0;
        }
        10% {
            opacity: 0.6;
        }
        90% {
            opacity: 0.6;
        }
        100% {
            transform: translateY(-100vh) rotate(360deg);
            opacity: 0;
        }
    }
    
    /* レスポンシブ対応 */
    @media (max-width: 1024px) {
        .<?php echo $unique_id; ?> .hero-main-title {
            font-size: 40px;
        }
        
        .<?php echo $unique_id; ?> .typing-prefix,
        .<?php echo $unique_id; ?> .typing-text {
            font-size: 28px;
        }
        
        .<?php echo $unique_id; ?> .hero-stats {
            gap: 40px;
        }
    }
    
    @media (max-width: 768px) {
        .<?php echo $unique_id; ?> .hero-content {
            padding: 20px 15px;
        }
        
        .<?php echo $unique_id; ?> .hero-main-title {
            font-size: 32px;
        }
        
        .<?php echo $unique_id; ?> .typing-prefix,
        .<?php echo $unique_id; ?> .typing-text {
            font-size: 24px;
        }
        
        .<?php echo $unique_id; ?> .hero-subtitle {
            font-size: 18px;
        }
        
        .<?php echo $unique_id; ?> .hero-cta-container {
            flex-direction: column;
            align-items: center;
            gap: 15px;
        }
        
        .<?php echo $unique_id; ?> .cta-primary,
        .<?php echo $unique_id; ?> .cta-secondary {
            padding: 14px 28px;
            font-size: 15px;
        }
        
        .<?php echo $unique_id; ?> .hero-stats {
            flex-wrap: wrap;
            gap: 30px;
        }
        
        .<?php echo $unique_id; ?> .stat-number {
            font-size: 28px;
        }
    }
    </style>
    
    <section class="<?php echo $unique_id; ?>" id="hero-02-module">
        <!-- パーティクル背景 -->
        <div class="particles-container" id="particles-<?php echo $unique_id; ?>"></div>
        
        <div class="hero-content">
            <h1 class="hero-main-title"><?php echo esc_html($main_title); ?></h1>
            
            <div class="typing-container">
                <span class="typing-prefix">実現する</span>
                <span class="typing-text" id="typing-text-<?php echo $unique_id; ?>"></span>
            </div>
            
            <p class="hero-subtitle"><?php echo wp_kses_post($subtitle); ?></p>
            
            <div class="hero-cta-container">
                <a href="<?php echo esc_url($primary_cta_link); ?>" class="cta-primary" onclick="heroCta_<?php echo $unique_id; ?>(event, 'primary')">
                    <span><?php echo esc_html($primary_cta_text); ?></span>
                    <span>→</span>
                </a>
                <a href="<?php echo esc_url($secondary_cta_link); ?>" class="cta-secondary" onclick="heroCta_<?php echo $unique_id; ?>(event, 'secondary')">
                    <span><?php echo esc_html($secondary_cta_text); ?></span>
                    <span>▶</span>
                </a>
            </div>
            
            <?php if (!empty($stats)): ?>
            <div class="hero-stats">
                <?php foreach ($stats as $stat): ?>
                    <div class="stat-item">
                        <span class="stat-number"><?php echo esc_html($stat['number']); ?></span>
                        <span class="stat-label"><?php echo esc_html($stat['label']); ?></span>
                    </div>
                <?php endforeach; ?>
            </div>
            <?php endif; ?>
        </div>
    </section>
    
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        // タイピングアニメーション
        const typingTexts = <?php echo json_encode(array_column($typing_texts, 'text')); ?>;
        const typingElement = document.getElementById('typing-text-<?php echo $unique_id; ?>');
        let currentTextIndex = 0;
        let currentCharIndex = 0;
        let isDeleting = false;
        let typeSpeed = 100;
        
        function typeWriter() {
            const currentText = typingTexts[currentTextIndex];
            
            if (isDeleting) {
                typingElement.textContent = currentText.substring(0, currentCharIndex - 1);
                currentCharIndex--;
                typeSpeed = 50;
                
                if (currentCharIndex === 0) {
                    isDeleting = false;
                    currentTextIndex = (currentTextIndex + 1) % typingTexts.length;
                    typeSpeed = 500; // 次のテキストまでの待機時間
                }
            } else {
                typingElement.textContent = currentText.substring(0, currentCharIndex + 1);
                currentCharIndex++;
                typeSpeed = 100;
                
                if (currentCharIndex === currentText.length) {
                    isDeleting = true;
                    typeSpeed = 2000; // テキスト表示完了後の待機時間
                }
            }
            
            setTimeout(typeWriter, typeSpeed);
        }
        
        // タイピングアニメーション開始
        setTimeout(typeWriter, 1000);
        
        // パーティクル生成
        const particlesContainer = document.getElementById('particles-<?php echo $unique_id; ?>');
        
        function createParticle() {
            const particle = document.createElement('div');
            particle.className = 'particle';
            
            // ランダムなサイズ
            const size = Math.random() * 6 + 2;
            particle.style.width = size + 'px';
            particle.style.height = size + 'px';
            
            // ランダムな位置
            particle.style.left = Math.random() * 100 + '%';
            
            // ランダムなアニメーション時間
            const duration = Math.random() * 10 + 15;
            particle.style.animationDuration = duration + 's';
            
            // ランダムな遅延
            const delay = Math.random() * 5;
            particle.style.animationDelay = delay + 's';
            
            particlesContainer.appendChild(particle);
            
            // アニメーション完了後に要素を削除
            setTimeout(() => {
                if (particle.parentNode) {
                    particle.parentNode.removeChild(particle);
                }
            }, (duration + delay) * 1000);
        }
        
        // パーティクルを定期的に生成
        function generateParticles() {
            createParticle();
            
            // 次のパーティクル生成のタイミング
            const nextGeneration = Math.random() * 500 + 200;
            setTimeout(generateParticles, nextGeneration);
        }
        
        // パーティクル生成開始
        setTimeout(generateParticles, 1000);
        
        console.log('Hero Module 02 loaded with particles and typing animation');
    });
    
    // CTA クリック処理
    function heroCta_<?php echo $unique_id; ?>(event, type) {
        // Google Analytics トラッキング
        if (typeof gtag !== 'undefined') {
            gtag('event', 'hero_02_cta_click', {
                'event_category': 'engagement',
                'event_label': type,
                'module_id': '<?php echo $unique_id; ?>'
            });
        }
        
        console.log('Hero 02 CTA clicked:', type);
        
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