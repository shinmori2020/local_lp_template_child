<?php
/**
 * Hero Module 04 - Complete Independent Version
 * ショートコード: [hero_04_module]
 * 
 * 分割レイアウト + 複数写真切り替え付きヒーローセクションモジュール
 * クリエイティブデザインをテーマにした明るく親しみやすいデザイン
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
        'key' => 'group_hero_04_complete',
        'title' => 'ヒーローモジュール04設定',
        'fields' => array(
            array(
                'key' => 'field_hero_04_badge_text',
                'label' => 'バッジテキスト',
                'name' => 'hero_04_badge_text',
                'type' => 'text',
                'default_value' => 'Premium Experience',
            ),
            array(
                'key' => 'field_hero_04_title',
                'label' => 'メインタイトル',
                'name' => 'hero_04_title',
                'type' => 'textarea',
                'default_value' => 'あなたの理想を<span class="title-accent">カタチ</span>にする',
            ),
            array(
                'key' => 'field_hero_04_description',
                'label' => '説明文',
                'name' => 'hero_04_description',
                'type' => 'textarea',
                'default_value' => 'プロフェッショナルなデザインと最新のテクノロジーが融合。<br>あなたのビジョンを現実に変える、<br><span class="accent-text">唯一無二の体験</span>をお届けします。',
            ),
            array(
                'key' => 'field_hero_04_stats',
                'label' => '統計データ',
                'name' => 'hero_04_stats',
                'type' => 'repeater',
                'sub_fields' => array(
                    array(
                        'key' => 'field_hero_04_stat_number',
                        'label' => '数値',
                        'name' => 'number',
                        'type' => 'text',
                    ),
                    array(
                        'key' => 'field_hero_04_stat_label',
                        'label' => 'ラベル',
                        'name' => 'label',
                        'type' => 'text',
                    ),
                ),
                'min' => 1,
                'max' => 5,
            ),
            array(
                'key' => 'field_hero_04_primary_cta_text',
                'label' => 'プライマリCTAテキスト',
                'name' => 'hero_04_primary_cta_text',
                'type' => 'text',
                'default_value' => '今すぐ始める',
            ),
            array(
                'key' => 'field_hero_04_primary_cta_link',
                'label' => 'プライマリCTAリンク',
                'name' => 'hero_04_primary_cta_link',
                'type' => 'text',
                'default_value' => '#start',
            ),
            array(
                'key' => 'field_hero_04_secondary_cta_text',
                'label' => 'セカンダリCTAテキスト',
                'name' => 'hero_04_secondary_cta_text',
                'type' => 'text',
                'default_value' => 'ポートフォリオ',
            ),
            array(
                'key' => 'field_hero_04_secondary_cta_link',
                'label' => 'セカンダリCTAリンク',
                'name' => 'hero_04_secondary_cta_link',
                'type' => 'text',
                'default_value' => '#portfolio',
            ),
            array(
                'key' => 'field_hero_04_trust_text',
                'label' => '信頼指標テキスト',
                'name' => 'hero_04_trust_text',
                'type' => 'text',
                'default_value' => '信頼されています',
            ),
            array(
                'key' => 'field_hero_04_companies',
                'label' => '企業ロゴ',
                'name' => 'hero_04_companies',
                'type' => 'repeater',
                'sub_fields' => array(
                    array(
                        'key' => 'field_hero_04_company_name',
                        'label' => '企業名',
                        'name' => 'name',
                        'type' => 'text',
                    ),
                ),
                'min' => 1,
                'max' => 6,
            ),
            array(
                'key' => 'field_hero_04_photos',
                'label' => 'スライダー写真',
                'name' => 'hero_04_photos',
                'type' => 'repeater',
                'sub_fields' => array(
                    array(
                        'key' => 'field_hero_04_photo_image',
                        'label' => '画像',
                        'name' => 'image',
                        'type' => 'image',
                        'return_format' => 'url',
                    ),
                    array(
                        'key' => 'field_hero_04_photo_title',
                        'label' => 'タイトル',
                        'name' => 'title',
                        'type' => 'text',
                    ),
                    array(
                        'key' => 'field_hero_04_photo_description',
                        'label' => '説明',
                        'name' => 'description',
                        'type' => 'text',
                    ),
                ),
                'min' => 1,
                'max' => 5,
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
add_shortcode('hero_04_module', 'render_hero_04_module');

function render_hero_04_module($atts = [], $content = null) {
    // 属性のデフォルト値
    $atts = shortcode_atts(array(
        'badge_text' => '',
        'title' => '',
        'description' => '',
        'primary_cta_text' => '',
        'primary_cta_link' => '',
        'secondary_cta_text' => '',
        'secondary_cta_link' => '',
        'trust_text' => '',
        'post_id' => get_the_ID(),
    ), $atts);
    
    // ACFフィールドから値を取得（ショートコード属性で上書き可能）
    $post_id = $atts['post_id'];
    $badge_text = $atts['badge_text'] ?: get_field('hero_04_badge_text', $post_id) ?: 'Premium Experience';
    $title = $atts['title'] ?: get_field('hero_04_title', $post_id) ?: 'あなたの理想を<span class="title-accent">カタチ</span>にする';
    $description = $atts['description'] ?: get_field('hero_04_description', $post_id) ?: 'プロフェッショナルなデザインと最新のテクノロジーが融合。<br>あなたのビジョンを現実に変える、<br><span class="accent-text">唯一無二の体験</span>をお届けします。';
    $primary_cta_text = $atts['primary_cta_text'] ?: get_field('hero_04_primary_cta_text', $post_id) ?: '今すぐ始める';
    $primary_cta_link = $atts['primary_cta_link'] ?: get_field('hero_04_primary_cta_link', $post_id) ?: '#start';
    $secondary_cta_text = $atts['secondary_cta_text'] ?: get_field('hero_04_secondary_cta_text', $post_id) ?: 'ポートフォリオ';
    $secondary_cta_link = $atts['secondary_cta_link'] ?: get_field('hero_04_secondary_cta_link', $post_id) ?: '#portfolio';
    $trust_text = $atts['trust_text'] ?: get_field('hero_04_trust_text', $post_id) ?: '信頼されています';
    
    // 統計データ取得
    $stats = get_field('hero_04_stats', $post_id) ?: array(
        array('number' => '500+', 'label' => 'プロジェクト'),
        array('number' => '98%', 'label' => '満足度'),
        array('number' => '24h', 'label' => 'サポート'),
    );
    
    // 企業データ取得
    $companies = get_field('hero_04_companies', $post_id) ?: array(
        array('name' => 'Company A'),
        array('name' => 'Company B'),
        array('name' => 'Company C'),
    );
    
    // 写真データ取得
    $photos = get_field('hero_04_photos', $post_id) ?: array(
        array(
            'image' => 'https://images.unsplash.com/photo-1542744173-8e7e53415bb0?w=800&h=1000&fit=crop&auto=format',
            'title' => 'Creative Design',
            'description' => '革新的なデザイン'
        ),
        array(
            'image' => 'https://images.unsplash.com/photo-1522202176988-66273c2fd55f?w=800&h=1000&fit=crop&auto=format',
            'title' => 'Team Work',
            'description' => 'チーム連携'
        ),
        array(
            'image' => 'https://images.unsplash.com/photo-1560472354-b33ff0c44a43?w=800&h=1000&fit=crop&auto=format',
            'title' => 'Innovation',
            'description' => '技術革新'
        ),
    );
    
    // ユニークID生成（CSS・JSの競合防止）
    $unique_id = 'hero_04_' . uniqid();
    
    // HTMLの出力開始
    ob_start();
    ?>
    
    <style>
    /* ヒーローセクション04 - 分割レイアウト + 複数写真版 */
    .<?php echo $unique_id; ?>.hero-split-photo {
        min-height: 100vh;
        background: linear-gradient(135deg, #f0f9ff 0%, #e0f2fe 50%, #f8fafc 100%);
        position: relative;
        overflow: hidden;
    }
    
    .<?php echo $unique_id; ?> .split-container {
        display: grid;
        grid-template-columns: 1fr 1fr;
        min-height: 100vh;
        max-width: 1400px;
        margin: 0 auto;
    }
    
    /* 左側テキストエリア */
    .<?php echo $unique_id; ?> .hero-left-content {
        display: flex;
        align-items: center;
        padding: 80px 40px 80px 60px;
        position: relative;
    }
    
    .<?php echo $unique_id; ?> .content-wrapper {
        width: 100%;
        max-width: 500px;
        position: relative;
        z-index: 2;
    }
    
    /* フローティング要素 */
    .<?php echo $unique_id; ?> .floating-elements {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        pointer-events: none;
        z-index: 1;
    }
    
    .<?php echo $unique_id; ?> .float-icon {
        position: absolute;
        font-size: 24px;
        opacity: 0.1;
        animation: floatMove-<?php echo $unique_id; ?> 6s ease-in-out infinite;
    }
    
    .<?php echo $unique_id; ?> .float-1 {
        top: 20%;
        right: 10%;
        animation-delay: 0s;
    }
    
    .<?php echo $unique_id; ?> .float-2 {
        top: 60%;
        right: 20%;
        animation-delay: 2s;
    }
    
    .<?php echo $unique_id; ?> .float-3 {
        top: 80%;
        right: 5%;
        animation-delay: 4s;
    }
    
    /* バッジ */
    .<?php echo $unique_id; ?> .hero-badge-04 {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        background: rgba(59, 130, 246, 0.1);
        border: 1px solid rgba(59, 130, 246, 0.2);
        padding: 8px 16px;
        border-radius: 25px;
        font-size: 14px;
        color: #3b82f6;
        margin-bottom: 24px;
        animation: slideInLeft-<?php echo $unique_id; ?> 1s ease-out 0.2s both;
    }
    
    .<?php echo $unique_id; ?> .badge-dot {
        width: 8px;
        height: 8px;
        background: #3b82f6;
        border-radius: 50%;
        animation: pulse-<?php echo $unique_id; ?> 2s ease-in-out infinite;
    }
    
    /* タイトル */
    .<?php echo $unique_id; ?> .hero-title-04 {
        font-size: 40px;
        font-weight: 800;
        line-height: 1.2;
        margin-bottom: 24px;
        color: #1e293b;
    }
    
    .<?php echo $unique_id; ?> .title-main {
        display: inline-block;
        animation: slideInLeft-<?php echo $unique_id; ?> 1s ease-out 0.4s both;
    }
    
    .<?php echo $unique_id; ?> .title-accent {
        display: inline-block;
        background: linear-gradient(135deg, #ec4899 0%, #8b5cf6 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
        animation: slideInLeft-<?php echo $unique_id; ?> 1s ease-out 0.6s both;
    }
    
    /* 説明文 */
    .<?php echo $unique_id; ?> .hero-description-04 {
        font-size: 18px;
        line-height: 1.7;
        color: #64748b;
        margin-bottom: 32px;
        animation: slideInLeft-<?php echo $unique_id; ?> 1s ease-out 0.8s both;
    }
    
    .<?php echo $unique_id; ?> .accent-text {
        color: #ec4899;
        font-weight: 600;
    }
    
    /* 統計データ */
    .<?php echo $unique_id; ?> .hero-stats-04 {
        display: flex;
        gap: 24px;
        margin-bottom: 32px;
        animation: slideInLeft-<?php echo $unique_id; ?> 1s ease-out 1s both;
    }
    
    .<?php echo $unique_id; ?> .stat-box {
        text-align: center;
    }
    
    .<?php echo $unique_id; ?> .stat-number {
        font-size: 32px;
        font-weight: 800;
        color: #1e293b;
        line-height: 1;
        margin-bottom: 4px;
    }
    
    .<?php echo $unique_id; ?> .stat-label {
        font-size: 14px;
        color: #64748b;
        font-weight: 500;
    }
    
    /* CTAセクション */
    .<?php echo $unique_id; ?> .cta-section-04 {
        display: flex;
        gap: 16px;
        margin-bottom: 40px;
        animation: slideInLeft-<?php echo $unique_id; ?> 1s ease-out 1.2s both;
    }
    
    .<?php echo $unique_id; ?> .btn-main-04 {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        background: linear-gradient(135deg, #ec4899 0%, #8b5cf6 100%);
        color: white;
        padding: 16px 24px;
        border-radius: 12px;
        text-decoration: none;
        font-weight: 600;
        font-size: 16px;
        transition: all 0.3s ease;
        box-shadow: 0 8px 32px rgba(236, 72, 153, 0.3);
    }
    
    .<?php echo $unique_id; ?> .btn-main-04:hover {
        transform: translateY(-3px);
        box-shadow: 0 12px 40px rgba(236, 72, 153, 0.4);
        color: white;
        text-decoration: none;
    }
    
    .<?php echo $unique_id; ?> .btn-arrow {
        transition: transform 0.3s ease;
    }
    
    .<?php echo $unique_id; ?> .btn-main-04:hover .btn-arrow {
        transform: translate(2px, -2px);
    }
    
    .<?php echo $unique_id; ?> .btn-outline-04 {
        display: inline-flex;
        align-items: center;
        background: transparent;
        color: #64748b;
        border: 2px solid #e2e8f0;
        padding: 16px 24px;
        border-radius: 12px;
        text-decoration: none;
        font-weight: 600;
        font-size: 16px;
        transition: all 0.3s ease;
    }
    
    .<?php echo $unique_id; ?> .btn-outline-04:hover {
        background: #f8fafc;
        border-color: #cbd5e1;
        color: #475569;
        text-decoration: none;
    }
    
    /* 信頼指標 */
    .<?php echo $unique_id; ?> .trust-indicators {
        animation: slideInLeft-<?php echo $unique_id; ?> 1s ease-out 1.4s both;
    }
    
    .<?php echo $unique_id; ?> .trust-text {
        font-size: 14px;
        color: #94a3b8;
        margin-bottom: 12px;
        font-weight: 500;
    }
    
    .<?php echo $unique_id; ?> .company-logos {
        display: flex;
        gap: 24px;
    }
    
    .<?php echo $unique_id; ?> .logo-item {
        font-size: 14px;
        color: #cbd5e1;
        font-weight: 600;
        padding: 8px 16px;
        background: rgba(203, 213, 225, 0.1);
        border-radius: 6px;
        border: 1px solid rgba(203, 213, 225, 0.2);
    }
    
    /* 右側フォトエリア */
    .<?php echo $unique_id; ?> .hero-right-photo {
        position: relative;
        background: #f8fafc;
        overflow: hidden;
    }
    
    .<?php echo $unique_id; ?> .photo-stack {
        position: relative;
        width: 100%;
        height: 100%;
    }
    
    .<?php echo $unique_id; ?> .photo-item {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        opacity: 0;
        transition: all 0.8s ease-in-out;
        transform: scale(1.1);
    }
    
    .<?php echo $unique_id; ?> .photo-item.active {
        opacity: 1;
        transform: scale(1);
    }
    
    .<?php echo $unique_id; ?> .photo-item img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        object-position: center;
    }
    
    .<?php echo $unique_id; ?> .photo-overlay {
        position: absolute;
        bottom: 0;
        left: 0;
        right: 0;
        background: linear-gradient(transparent, rgba(0, 0, 0, 0.7));
        color: white;
        padding: 60px 40px 40px;
        transform: translateY(20px);
        opacity: 0;
        transition: all 0.5s ease;
    }
    
    .<?php echo $unique_id; ?> .photo-item.active .photo-overlay {
        transform: translateY(0);
        opacity: 1;
    }
    
    .<?php echo $unique_id; ?> .overlay-content h3 {
        font-size: 24px;
        font-weight: 700;
        margin-bottom: 8px;
    }
    
    .<?php echo $unique_id; ?> .overlay-content p {
        font-size: 16px;
        opacity: 0.9;
    }
    
    /* ナビゲーション */
    .<?php echo $unique_id; ?> .photo-navigation {
        position: absolute;
        bottom: 40px;
        right: 40px;
        display: flex;
        gap: 12px;
        z-index: 10;
    }
    
    .<?php echo $unique_id; ?> .nav-dot {
        width: 12px;
        height: 12px;
        border-radius: 50%;
        border: none;
        background: rgba(255, 255, 255, 0.4);
        cursor: pointer;
        transition: all 0.3s ease;
    }
    
    .<?php echo $unique_id; ?> .nav-dot.active {
        background: white;
        transform: scale(1.2);
    }
    
    /* 装飾的な図形 */
    .<?php echo $unique_id; ?> .decorative-shapes {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        pointer-events: none;
        z-index: 5;
    }
    
    .<?php echo $unique_id; ?> .shape-1 {
        position: absolute;
        top: 10%;
        right: 10%;
        width: 100px;
        height: 100px;
        background: linear-gradient(135deg, rgba(236, 72, 153, 0.1) 0%, rgba(139, 92, 246, 0.1) 100%);
        border-radius: 50%;
        animation: floatRotate-<?php echo $unique_id; ?> 8s ease-in-out infinite;
    }
    
    .<?php echo $unique_id; ?> .shape-2 {
        position: absolute;
        bottom: 20%;
        left: 5%;
        width: 60px;
        height: 60px;
        background: rgba(59, 130, 246, 0.1);
        border-radius: 12px;
        transform: rotate(45deg);
        animation: floatMove-<?php echo $unique_id; ?> 6s ease-in-out infinite reverse;
    }
    
    .<?php echo $unique_id; ?> .shape-3 {
        position: absolute;
        top: 50%;
        right: 5%;
        width: 80px;
        height: 80px;
        border: 2px solid rgba(236, 72, 153, 0.2);
        border-radius: 50%;
        animation: floatRotate-<?php echo $unique_id; ?> 10s linear infinite;
    }
    
    /* アニメーション定義 */
    @keyframes slideInLeft-<?php echo $unique_id; ?> {
        from {
            opacity: 0;
            transform: translateX(-30px);
        }
        to {
            opacity: 1;
            transform: translateX(0);
        }
    }
    
    @keyframes floatMove-<?php echo $unique_id; ?> {
        0%, 100% {
            transform: translateY(0px);
        }
        50% {
            transform: translateY(-20px);
        }
    }
    
    @keyframes floatRotate-<?php echo $unique_id; ?> {
        0%, 100% {
            transform: rotate(0deg) translateY(0px);
        }
        50% {
            transform: rotate(180deg) translateY(-15px);
        }
    }
    
    @keyframes pulse-<?php echo $unique_id; ?> {
        0%, 100% {
            opacity: 1;
            transform: scale(1);
        }
        50% {
            opacity: 0.7;
            transform: scale(0.9);
        }
    }
    
    /* レスポンシブ対応 */
    @media (max-width: 1024px) {
        .<?php echo $unique_id; ?> .split-container {
            grid-template-columns: 1fr;
            grid-template-rows: auto 1fr;
        }
        
        .<?php echo $unique_id; ?> .hero-left-content {
            padding: 60px 40px 40px;
        }
        
        .<?php echo $unique_id; ?> .hero-title-04 {
            font-size: 36px;
        }
        
        .<?php echo $unique_id; ?> .hero-stats-04 {
            justify-content: center;
        }
        
        .<?php echo $unique_id; ?> .cta-section-04 {
            justify-content: center;
        }
        
        .<?php echo $unique_id; ?> .trust-indicators {
            text-align: center;
        }
    }
    
    @media (max-width: 768px) {
        .<?php echo $unique_id; ?> .hero-left-content {
            padding: 40px 20px 30px;
        }
        
        .<?php echo $unique_id; ?> .hero-title-04 {
            font-size: 32px;
        }
        
        .<?php echo $unique_id; ?> .hero-description-04 {
            font-size: 16px;
        }
        
        .<?php echo $unique_id; ?> .hero-stats-04 {
            flex-direction: column;
            align-items: center;
            gap: 16px;
        }
        
        .<?php echo $unique_id; ?> .stat-box {
            display: flex;
            align-items: center;
            gap: 12px;
        }
        
        .<?php echo $unique_id; ?> .cta-section-04 {
            flex-direction: column;
        }
        
        .<?php echo $unique_id; ?> .company-logos {
            justify-content: center;
            flex-wrap: wrap;
            gap: 12px;
        }
        
        .<?php echo $unique_id; ?> .photo-navigation {
            bottom: 20px;
            right: 20px;
        }
        
        .<?php echo $unique_id; ?> .floating-elements {
            display: none;
        }
    }
    </style>
    
    <!-- ヒーローセクション04（分割レイアウト + 複数写真版） -->
    <section class="<?php echo $unique_id; ?> hero-split-photo" id="hero-04-module">
        <div class="split-container">
            <!-- 左側テキストエリア -->
            <div class="hero-left-content">
                <div class="content-wrapper">
                    <div class="floating-elements">
                        <div class="float-icon float-1">💡</div>
                        <div class="float-icon float-2">🌟</div>
                        <div class="float-icon float-3">🚀</div>
                    </div>
                    
                    <div class="hero-badge-04">
                        <span class="badge-dot"></span>
                        <span class="badge-text"><?php echo esc_html($badge_text); ?></span>
                    </div>
                    
                    <h1 class="hero-title-04">
                        <?php echo wp_kses_post($title); ?>
                    </h1>
                    
                    <p class="hero-description-04">
                        <?php echo wp_kses_post($description); ?>
                    </p>
                    
                    <div class="hero-stats-04">
                        <?php foreach ($stats as $stat): ?>
                            <div class="stat-box">
                                <div class="stat-number"><?php echo esc_html($stat['number']); ?></div>
                                <div class="stat-label"><?php echo esc_html($stat['label']); ?></div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                    
                    <div class="cta-section-04">
                        <a href="<?php echo esc_url($primary_cta_link); ?>" class="btn-main-04">
                            <span class="btn-text"><?php echo esc_html($primary_cta_text); ?></span>
                            <div class="btn-arrow">
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none">
                                    <path d="M7 17L17 7M17 7H7M17 7V17" stroke="currentColor" stroke-width="2"/>
                                </svg>
                            </div>
                        </a>
                        <a href="<?php echo esc_url($secondary_cta_link); ?>" class="btn-outline-04">
                            <?php echo esc_html($secondary_cta_text); ?>
                        </a>
                    </div>
                    
                    <div class="trust-indicators">
                        <p class="trust-text"><?php echo esc_html($trust_text); ?></p>
                        <div class="company-logos">
                            <?php foreach ($companies as $company): ?>
                                <div class="logo-item"><?php echo esc_html($company['name']); ?></div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- 右側フォトエリア -->
            <div class="hero-right-photo">
                <div class="photo-stack">
                    <?php foreach ($photos as $index => $photo): ?>
                        <div class="photo-item <?php echo $index === 0 ? 'active' : ''; ?>" data-index="<?php echo $index; ?>">
                            <img src="<?php echo esc_url($photo['image']); ?>" alt="<?php echo esc_attr($photo['title']); ?>">
                            <div class="photo-overlay">
                                <div class="overlay-content">
                                    <h3><?php echo esc_html($photo['title']); ?></h3>
                                    <p><?php echo esc_html($photo['description']); ?></p>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
                
                <div class="photo-navigation">
                    <?php foreach ($photos as $index => $photo): ?>
                        <button class="nav-dot <?php echo $index === 0 ? 'active' : ''; ?>" data-target="<?php echo $index; ?>"></button>
                    <?php endforeach; ?>
                </div>
                
                <div class="decorative-shapes">
                    <div class="shape-1"></div>
                    <div class="shape-2"></div>
                    <div class="shape-3"></div>
                </div>
            </div>
        </div>
    </section>

    <script>
    document.addEventListener('DOMContentLoaded', function() {
        // 写真切り替え機能
        const photoItems_<?php echo $unique_id; ?> = document.querySelectorAll('.<?php echo $unique_id; ?> .photo-item');
        const navDots_<?php echo $unique_id; ?> = document.querySelectorAll('.<?php echo $unique_id; ?> .nav-dot');
        let currentPhotoIndex_<?php echo $unique_id; ?> = 0;
        let photoInterval_<?php echo $unique_id; ?>;
        
        function showPhoto_<?php echo $unique_id; ?>(index) {
            // 現在の写真を非表示
            photoItems_<?php echo $unique_id; ?>.forEach(item => item.classList.remove('active'));
            navDots_<?php echo $unique_id; ?>.forEach(dot => dot.classList.remove('active'));
            
            // 指定された写真を表示
            photoItems_<?php echo $unique_id; ?>[index].classList.add('active');
            navDots_<?php echo $unique_id; ?>[index].classList.add('active');
            
            currentPhotoIndex_<?php echo $unique_id; ?> = index;
        }
        
        function nextPhoto_<?php echo $unique_id; ?>() {
            const nextIndex = (currentPhotoIndex_<?php echo $unique_id; ?> + 1) % photoItems_<?php echo $unique_id; ?>.length;
            showPhoto_<?php echo $unique_id; ?>(nextIndex);
        }
        
        // ナビゲーションドットのクリック処理
        navDots_<?php echo $unique_id; ?>.forEach((dot, index) => {
            dot.addEventListener('click', function() {
                showPhoto_<?php echo $unique_id; ?>(index);
                resetAutoSlide_<?php echo $unique_id; ?>();
            });
        });
        
        // 自動切り替え
        function startAutoSlide_<?php echo $unique_id; ?>() {
            photoInterval_<?php echo $unique_id; ?> = setInterval(nextPhoto_<?php echo $unique_id; ?>, 4000);
        }
        
        function stopAutoSlide_<?php echo $unique_id; ?>() {
            if (photoInterval_<?php echo $unique_id; ?>) {
                clearInterval(photoInterval_<?php echo $unique_id; ?>);
            }
        }
        
        function resetAutoSlide_<?php echo $unique_id; ?>() {
            stopAutoSlide_<?php echo $unique_id; ?>();
            startAutoSlide_<?php echo $unique_id; ?>();
        }
        
        // 写真エリアのホバー時は自動切り替えを停止
        const rightPhoto_<?php echo $unique_id; ?> = document.querySelector('.<?php echo $unique_id; ?> .hero-right-photo');
        if (rightPhoto_<?php echo $unique_id; ?>) {
            rightPhoto_<?php echo $unique_id; ?>.addEventListener('mouseenter', stopAutoSlide_<?php echo $unique_id; ?>);
            rightPhoto_<?php echo $unique_id; ?>.addEventListener('mouseleave', startAutoSlide_<?php echo $unique_id; ?>);
        }
        
        // 自動切り替え開始
        startAutoSlide_<?php echo $unique_id; ?>();
        
        // CTAボタンのクリック処理
        const ctaButtons_<?php echo $unique_id; ?> = document.querySelectorAll('.<?php echo $unique_id; ?> .btn-main-04, .<?php echo $unique_id; ?> .btn-outline-04');
        ctaButtons_<?php echo $unique_id; ?>.forEach(button => {
            button.addEventListener('click', function(e) {
                const buttonType = button.classList.contains('btn-main-04') ? 'primary' : 'secondary';
                const buttonText = button.textContent.trim();
                
                // Google Analytics トラッキング
                if (typeof gtag !== 'undefined') {
                    gtag('event', 'hero_04_cta_click', {
                        'event_category': 'engagement',
                        'event_label': buttonType + '_' + buttonText,
                        'section': 'hero_split_photo',
                        'module_id': '<?php echo $unique_id; ?>'
                    });
                }
                
                console.log('Hero 04 Module CTA clicked:', buttonType, buttonText, 'ID:', '<?php echo $unique_id; ?>');
                
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
        
        // フローティング要素のランダム動作
        const floatIcons_<?php echo $unique_id; ?> = document.querySelectorAll('.<?php echo $unique_id; ?> .float-icon');
        floatIcons_<?php echo $unique_id; ?>.forEach((icon, index) => {
            setInterval(() => {
                const randomX = Math.random() * 20 - 10;
                const randomY = Math.random() * 20 - 10;
                icon.style.transform = `translate(${randomX}px, ${randomY}px)`;
            }, 3000 + index * 1000);
        });
        
        console.log('Hero Section 04 Module loaded with photo slider and interactions - ID:', '<?php echo $unique_id; ?>');
    });
    </script>

    <?php
    return ob_get_clean();
}
?> 