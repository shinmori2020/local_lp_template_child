<?php
/**
 * Firstview Module v2 - Complete Independent Version
 * ショートコード: [firstview_02_module]
 * 
 * 完全独立型モジュール：
 * - 高品質デザインのファーストビューセクション
 * - パーティクル・パララックス・タイピング効果
 * - グラスモーフィズム・フローティングエレメント
 * - ACFフィールド自動登録
 * - CSS・JavaScript内蔵
 * - 完全レスポンシブ対応
 * 
 * @package Local_LP_Template_Child
 */

// 直接アクセスを防ぐ
if (!defined('ABSPATH')) {
    exit;
}

/**
 * ACFフィールドグループの自動登録（新方式 - 簡単1行記述）
 */
if (function_exists('acf_add_local_field_group')) {
    acf_add_local_field_group(array(
        'key' => 'group_firstview_02_complete',
        'title' => 'ファーストビューモジュール v2 設定',
        'fields' => array(
            array(
                'key' => 'field_firstview_02_main_title',
                'label' => 'メインタイトル',
                'name' => 'firstview_02_main_title',
                'type' => 'textarea',
                'default_value' => '未来を変える',
                'instructions' => 'メインタイトルを入力（HTMLタグ使用可能）',
                'rows' => 2,
            ),
            array(
                'key' => 'field_firstview_02_sub_title',
                'label' => 'サブタイトル',
                'name' => 'firstview_02_sub_title',
                'type' => 'text',
                'default_value' => '革新的なソリューション',
                'instructions' => 'サブタイトルを入力',
            ),
            array(
                'key' => 'field_firstview_02_description',
                'label' => '説明文',
                'name' => 'firstview_02_description',
                'type' => 'textarea',
                'default_value' => 'あなたのビジネスを次のレベルへ。<br>最先端の技術で、効率化と成長を実現します。',
                'instructions' => '説明文を入力（改行は<br>タグを使用）',
                'rows' => 3,
            ),
            array(
                'key' => 'field_firstview_02_primary_cta_text',
                'label' => 'プライマリCTAテキスト',
                'name' => 'firstview_02_primary_cta_text',
                'type' => 'text',
                'default_value' => '無料相談を始める',
                'instructions' => 'メインのCTAボタンテキスト',
            ),
            array(
                'key' => 'field_firstview_02_primary_cta_link',
                'label' => 'プライマリCTAリンク',
                'name' => 'firstview_02_primary_cta_link',
                'type' => 'text',
                'default_value' => '#contact',
                'instructions' => 'メインCTAのリンク先（#contact等）',
            ),
            array(
                'key' => 'field_firstview_02_secondary_cta_text',
                'label' => 'セカンダリCTAテキスト',
                'name' => 'firstview_02_secondary_cta_text',
                'type' => 'text',
                'default_value' => '詳しく見る',
                'instructions' => 'サブのCTAボタンテキスト',
            ),
            array(
                'key' => 'field_firstview_02_secondary_cta_link',
                'label' => 'セカンダリCTAリンク',
                'name' => 'firstview_02_secondary_cta_link',
                'type' => 'text',
                'default_value' => '#features',
                'instructions' => 'サブCTAのリンク先',
            ),
            array(
                'key' => 'field_firstview_02_bg_style',
                'label' => '背景スタイル',
                'name' => 'firstview_02_bg_style',
                'type' => 'select',
                'choices' => array(
                    'gradient-blue-purple' => 'ブルー→パープル グラデーション',
                    'gradient-orange-red' => 'オレンジ→レッド グラデーション',
                    'gradient-green-blue' => 'グリーン→ブルー グラデーション',
                    'gradient-purple-pink' => 'パープル→ピンク グラデーション',
                    'solid-dark' => 'ダークカラー',
                ),
                'default_value' => 'gradient-blue-purple',
            ),
            array(
                'key' => 'field_firstview_02_bg_image',
                'label' => '背景画像（オプション）',
                'name' => 'firstview_02_bg_image',
                'type' => 'image',
                'instructions' => '背景画像を設定（オプション）。グラデーションの上に重なります。',
                'return_format' => 'url',
            ),
            array(
                'key' => 'field_firstview_02_enable_particles',
                'label' => 'パーティクル効果',
                'name' => 'firstview_02_enable_particles',
                'type' => 'true_false',
                'default_value' => 1,
                'instructions' => 'パーティクル（浮遊する小さな粒子）を表示するか',
                'ui' => 1,
            ),
            array(
                'key' => 'field_firstview_02_enable_typing',
                'label' => 'タイピング効果',
                'name' => 'firstview_02_enable_typing',
                'type' => 'true_false',
                'default_value' => 1,
                'instructions' => 'タイトルのタイピング効果を有効にするか',
                'ui' => 1,
            ),
            array(
                'key' => 'field_firstview_02_text_color',
                'label' => 'テキストカラー',
                'name' => 'firstview_02_text_color',
                'type' => 'select',
                'choices' => array(
                    'white' => '白色（推奨）',
                    'dark' => '濃色',
                    'custom' => 'カスタム色',
                ),
                'default_value' => 'white',
            ),
            array(
                'key' => 'field_firstview_02_custom_text_color',
                'label' => 'カスタムテキスト色',
                'name' => 'firstview_02_custom_text_color',
                'type' => 'color_picker',
                'default_value' => '#ffffff',
                'conditional_logic' => array(
                    array(
                        array(
                            'field' => 'field_firstview_02_text_color',
                            'operator' => '==',
                            'value' => 'custom',
                        ),
                    ),
                ),
            ),
        ),
        // 新方式：この1行のみでOK！
        'location' => get_smart_location(),
    ));
}

/**
 * ショートコード登録
 */
add_shortcode('firstview_02_module', 'render_firstview_02_module');

/**
 * モジュールのレンダリング関数
 */
function render_firstview_02_module($atts = array(), $content = null) {
    // ユニークIDを生成（CSSの名前空間として使用）
    $unique_id = 'firstview_02_' . uniqid();
    
    // ショートコード属性のデフォルト値
    $default_atts = array(
        'main_title' => '',
        'sub_title' => '',
        'description' => '',
        'primary_cta_text' => '',
        'primary_cta_link' => '',
        'secondary_cta_text' => '',
        'secondary_cta_link' => '',
        'bg_style' => '',
        'post_id' => get_the_ID(),
    );
    
    // 属性をマージ
    $atts = shortcode_atts($default_atts, $atts);
    
    // ACFフィールドから値を取得（属性で上書き可能）
    $post_id = intval($atts['post_id']);
    $main_title = !empty($atts['main_title']) ? $atts['main_title'] : get_field('firstview_02_main_title', $post_id);
    $sub_title = !empty($atts['sub_title']) ? $atts['sub_title'] : get_field('firstview_02_sub_title', $post_id);
    $description = !empty($atts['description']) ? $atts['description'] : get_field('firstview_02_description', $post_id);
    $primary_cta_text = !empty($atts['primary_cta_text']) ? $atts['primary_cta_text'] : get_field('firstview_02_primary_cta_text', $post_id);
    $primary_cta_link = !empty($atts['primary_cta_link']) ? $atts['primary_cta_link'] : get_field('firstview_02_primary_cta_link', $post_id);
    $secondary_cta_text = !empty($atts['secondary_cta_text']) ? $atts['secondary_cta_text'] : get_field('firstview_02_secondary_cta_text', $post_id);
    $secondary_cta_link = !empty($atts['secondary_cta_link']) ? $atts['secondary_cta_link'] : get_field('firstview_02_secondary_cta_link', $post_id);
    $bg_style = !empty($atts['bg_style']) ? $atts['bg_style'] : get_field('firstview_02_bg_style', $post_id);
    $bg_image = get_field('firstview_02_bg_image', $post_id);
    $enable_particles = get_field('firstview_02_enable_particles', $post_id);
    $enable_typing = get_field('firstview_02_enable_typing', $post_id);
    $text_color = get_field('firstview_02_text_color', $post_id);
    $custom_text_color = get_field('firstview_02_custom_text_color', $post_id);
    
    // デフォルト値（ACFフィールドが空の場合）
    if (empty($main_title)) $main_title = '未来を変える';
    if (empty($sub_title)) $sub_title = '革新的なソリューション';
    if (empty($description)) $description = 'あなたのビジネスを次のレベルへ。<br>最先端の技術で、効率化と成長を実現します。';
    if (empty($primary_cta_text)) $primary_cta_text = '無料相談を始める';
    if (empty($primary_cta_link)) $primary_cta_link = '#contact';
    if (empty($secondary_cta_text)) $secondary_cta_text = '詳しく見る';
    if (empty($secondary_cta_link)) $secondary_cta_link = '#features';
    if (empty($bg_style)) $bg_style = 'gradient-blue-purple';
    if ($enable_particles === null) $enable_particles = true;
    if ($enable_typing === null) $enable_typing = true;
    if (empty($text_color)) $text_color = 'white';
    if (empty($custom_text_color)) $custom_text_color = '#ffffff';
    
    // 背景スタイルの決定
    $background_css = '';
    switch ($bg_style) {
        case 'gradient-orange-red':
            $background_css = 'linear-gradient(135deg, #ff9a56 0%, #ffad56 100%)';
            break;
        case 'gradient-green-blue':
            $background_css = 'linear-gradient(135deg, #4ecdc4 0%, #44a08d 100%)';
            break;
        case 'gradient-purple-pink':
            $background_css = 'linear-gradient(135deg, #a8edea 0%, #fed6e3 100%)';
            break;
        case 'solid-dark':
            $background_css = 'linear-gradient(135deg, #2c3e50 0%, #34495e 100%)';
            break;
        default: // gradient-blue-purple
            $background_css = 'linear-gradient(135deg, #667eea 0%, #764ba2 100%)';
    }
    
    // テキストカラーの決定
    $text_color_css = '#ffffff';
    if ($text_color === 'dark') {
        $text_color_css = '#333333';
    } elseif ($text_color === 'custom') {
        $text_color_css = $custom_text_color;
    }
    
    // HTMLの出力
    ob_start();
    ?>
    <section id="<?php echo esc_attr($unique_id); ?>" class="firstview-02-section">
        <div class="firstview-02-background">
            <div class="firstview-02-overlay"></div>
            <?php if ($enable_particles): ?>
                <div class="firstview-02-particles"></div>
            <?php endif; ?>
        </div>
        
        <div class="firstview-02-content">
            <div class="firstview-02-container">
                <div class="firstview-02-text">
                    <h1 class="firstview-02-title">
                        <span class="firstview-02-title-main"><?php echo wp_kses_post($main_title); ?></span>
                        <span class="firstview-02-title-sub"><?php echo esc_html($sub_title); ?></span>
                    </h1>
                    <p class="firstview-02-description">
                        <?php echo wp_kses_post($description); ?>
                    </p>
                    <div class="firstview-02-buttons">
                        <a href="<?php echo esc_url($primary_cta_link); ?>" class="firstview-02-btn firstview-02-btn-primary">
                            <span><?php echo esc_html($primary_cta_text); ?></span>
                            <i class="fas fa-arrow-right"></i>
                        </a>
                        <a href="<?php echo esc_url($secondary_cta_link); ?>" class="firstview-02-btn firstview-02-btn-secondary">
                            <span><?php echo esc_html($secondary_cta_text); ?></span>
                            <i class="fas fa-play"></i>
                        </a>
                    </div>
                </div>
                
                <div class="firstview-02-visual">
                    <div class="firstview-02-image">
                        <div class="firstview-02-floating-elements">
                            <div class="firstview-02-floating-element firstview-02-element-1"></div>
                            <div class="firstview-02-floating-element firstview-02-element-2"></div>
                            <div class="firstview-02-floating-element firstview-02-element-3"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="firstview-02-scroll-indicator">
            <div class="firstview-02-scroll-line"></div>
            <span class="firstview-02-scroll-text">SCROLL</span>
        </div>
    </section>

    <style>
        /* ファーストビューv2専用スタイル */
        #<?php echo esc_attr($unique_id); ?> {
            position: relative;
            height: 100vh;
            min-height: 600px;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
            background: <?php echo $background_css; ?>;
            <?php if ($bg_image): ?>
                background-image: url('<?php echo esc_url($bg_image); ?>');
                background-size: cover;
                background-position: center;
                background-blend-mode: overlay;
            <?php endif; ?>
        }

        #<?php echo esc_attr($unique_id); ?> .firstview-02-background {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: 1;
        }

        #<?php echo esc_attr($unique_id); ?> .firstview-02-overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.3);
            z-index: 2;
        }

        #<?php echo esc_attr($unique_id); ?> .firstview-02-particles {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: 3;
            pointer-events: none;
        }

        #<?php echo esc_attr($unique_id); ?> .firstview-02-content {
            position: relative;
            z-index: 4;
            width: 100%;
            padding: 0 20px;
        }

        #<?php echo esc_attr($unique_id); ?> .firstview-02-container {
            max-width: 1200px;
            margin: 0 auto;
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 60px;
            align-items: center;
        }

        #<?php echo esc_attr($unique_id); ?> .firstview-02-text {
            color: <?php echo esc_attr($text_color_css); ?>;
            animation: fadeInUp 1s ease-out;
        }

        #<?php echo esc_attr($unique_id); ?> .firstview-02-title {
            font-size: 4rem;
            font-weight: 900;
            line-height: 1.3;
            margin-bottom: 32px;
            text-shadow: 3px 3px 8px rgba(0, 0, 0, 0.5);
            letter-spacing: -0.02em;
        }

        #<?php echo esc_attr($unique_id); ?> .firstview-02-title-main {
            display: block;
            color: <?php echo esc_attr($text_color_css); ?>;
            text-shadow: 3px 3px 8px rgba(0, 0, 0, 0.6);
            font-weight: 900;
        }

        #<?php echo esc_attr($unique_id); ?> .firstview-02-title-sub {
            display: block;
            color: #64b5f6;
            text-shadow: 2px 2px 6px rgba(0, 0, 0, 0.7);
            font-size: 0.75em;
            margin-top: 12px;
            font-weight: 700;
            letter-spacing: 0.01em;
        }

        #<?php echo esc_attr($unique_id); ?> .firstview-02-description {
            font-size: 1.4rem;
            line-height: 1.8;
            margin-bottom: 48px;
            color: <?php echo esc_attr($text_color_css); ?>;
            font-weight: 400;
            text-shadow: 2px 2px 6px rgba(0, 0, 0, 0.5);
            max-width: 90%;
            letter-spacing: 0.01em;
        }

        #<?php echo esc_attr($unique_id); ?> .firstview-02-buttons {
            display: flex;
            gap: 20px;
            flex-wrap: wrap;
        }

        #<?php echo esc_attr($unique_id); ?> .firstview-02-btn {
            display: inline-flex;
            align-items: center;
            gap: 12px;
            padding: 18px 36px;
            text-decoration: none;
            border-radius: 50px;
            font-weight: 700;
            font-size: 1.2rem;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
            letter-spacing: 0.5px;
            text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.3);
        }

        #<?php echo esc_attr($unique_id); ?> .firstview-02-btn::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
            transition: left 0.5s ease;
        }

        #<?php echo esc_attr($unique_id); ?> .firstview-02-btn:hover::before {
            left: 100%;
        }

        #<?php echo esc_attr($unique_id); ?> .firstview-02-btn-primary {
            background: linear-gradient(45deg, #ff6b6b, #ff5252);
            color: white;
            box-shadow: 0 8px 24px rgba(255, 107, 107, 0.4);
        }

        #<?php echo esc_attr($unique_id); ?> .firstview-02-btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 12px 32px rgba(255, 107, 107, 0.6);
        }

        #<?php echo esc_attr($unique_id); ?> .firstview-02-btn-secondary {
            background: rgba(255, 255, 255, 0.1);
            color: <?php echo esc_attr($text_color_css); ?>;
            border: 2px solid rgba(255, 255, 255, 0.3);
            backdrop-filter: blur(10px);
        }

        #<?php echo esc_attr($unique_id); ?> .firstview-02-btn-secondary:hover {
            background: rgba(255, 255, 255, 0.2);
            border-color: rgba(255, 255, 255, 0.5);
            transform: translateY(-2px);
        }

        #<?php echo esc_attr($unique_id); ?> .firstview-02-visual {
            position: relative;
            height: 500px;
            animation: fadeInRight 1s ease-out 0.3s both;
        }

        #<?php echo esc_attr($unique_id); ?> .firstview-02-image {
            position: relative;
            width: 100%;
            height: 100%;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 20px;
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
            display: flex;
            align-items: center;
            justify-content: center;
        }

        #<?php echo esc_attr($unique_id); ?> .firstview-02-floating-elements {
            position: relative;
            width: 80%;
            height: 80%;
        }

        #<?php echo esc_attr($unique_id); ?> .firstview-02-floating-element {
            position: absolute;
            border-radius: 50%;
            background: linear-gradient(45deg, rgba(255, 255, 255, 0.2), rgba(255, 255, 255, 0.1));
            backdrop-filter: blur(20px);
            animation: float 6s ease-in-out infinite;
        }

        #<?php echo esc_attr($unique_id); ?> .firstview-02-element-1 {
            width: 120px;
            height: 120px;
            top: 20%;
            left: 20%;
            animation-delay: 0s;
        }

        #<?php echo esc_attr($unique_id); ?> .firstview-02-element-2 {
            width: 80px;
            height: 80px;
            top: 60%;
            right: 20%;
            animation-delay: 2s;
        }

        #<?php echo esc_attr($unique_id); ?> .firstview-02-element-3 {
            width: 60px;
            height: 60px;
            top: 40%;
            left: 60%;
            animation-delay: 4s;
        }

        #<?php echo esc_attr($unique_id); ?> .firstview-02-scroll-indicator {
            position: absolute;
            bottom: 40px;
            left: 50%;
            transform: translateX(-50%);
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 12px;
            z-index: 5;
            color: <?php echo esc_attr($text_color_css); ?>;
            opacity: 0.7;
            cursor: pointer;
        }

        #<?php echo esc_attr($unique_id); ?> .firstview-02-scroll-line {
            width: 2px;
            height: 40px;
            background: linear-gradient(to bottom, transparent, <?php echo esc_attr($text_color_css); ?>, transparent);
            animation: scrollPulse 2s ease-in-out infinite;
        }

        #<?php echo esc_attr($unique_id); ?> .firstview-02-scroll-text {
            font-size: 0.9rem;
            font-weight: 700;
            letter-spacing: 3px;
            text-shadow: 1px 1px 3px rgba(0, 0, 0, 0.5);
            color: <?php echo esc_attr($text_color_css); ?>;
        }

        /* パーティクルスタイル */
        #<?php echo esc_attr($unique_id); ?> .firstview-02-particle {
            position: absolute;
            width: 4px;
            height: 4px;
            background: rgba(255, 255, 255, 0.6);
            border-radius: 50%;
            animation: particleFloat 8s linear infinite;
        }

        /* アニメーション */
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

        @keyframes float {
            0%, 100% {
                transform: translateY(0px) rotate(0deg);
            }
            50% {
                transform: translateY(-20px) rotate(180deg);
            }
        }

        @keyframes scrollPulse {
            0%, 100% {
                opacity: 0.3;
            }
            50% {
                opacity: 1;
            }
        }

        @keyframes particleFloat {
            0% {
                transform: translateY(100vh) rotate(0deg);
                opacity: 0;
            }
            10% {
                opacity: 1;
            }
            90% {
                opacity: 1;
            }
            100% {
                transform: translateY(-100px) rotate(360deg);
                opacity: 0;
            }
        }

        /* レスポンシブデザイン */
        @media (max-width: 768px) {
            #<?php echo esc_attr($unique_id); ?> .firstview-02-container {
                grid-template-columns: 1fr;
                gap: 40px;
                text-align: center;
            }

            #<?php echo esc_attr($unique_id); ?> .firstview-02-title {
                font-size: 3rem;
                line-height: 1.2;
            }

            #<?php echo esc_attr($unique_id); ?> .firstview-02-description {
                font-size: 1.3rem;
                line-height: 1.7;
                max-width: 100%;
            }

            #<?php echo esc_attr($unique_id); ?> .firstview-02-buttons {
                justify-content: center;
            }

            #<?php echo esc_attr($unique_id); ?> .firstview-02-btn {
                font-size: 1.1rem;
                padding: 16px 32px;
            }

            #<?php echo esc_attr($unique_id); ?> .firstview-02-visual {
                height: 300px;
            }

            #<?php echo esc_attr($unique_id); ?> {
                min-height: 500px;
            }
        }

        @media (max-width: 480px) {
            #<?php echo esc_attr($unique_id); ?> .firstview-02-title {
                font-size: 2.4rem;
                line-height: 1.3;
                margin-bottom: 24px;
            }

            #<?php echo esc_attr($unique_id); ?> .firstview-02-title-sub {
                font-size: 0.7em;
                margin-top: 8px;
            }

            #<?php echo esc_attr($unique_id); ?> .firstview-02-description {
                font-size: 1.2rem;
                line-height: 1.6;
                margin-bottom: 36px;
            }

            #<?php echo esc_attr($unique_id); ?> .firstview-02-buttons {
                flex-direction: column;
                align-items: center;
            }

            #<?php echo esc_attr($unique_id); ?> .firstview-02-btn {
                width: 100%;
                max-width: 300px;
                justify-content: center;
                font-size: 1.1rem;
                padding: 16px 32px;
            }

            #<?php echo esc_attr($unique_id); ?> .firstview-02-scroll-text {
                font-size: 0.8rem;
                letter-spacing: 2px;
            }
        }
    </style>

    <script>
        // ファーストビューv2専用JavaScript
        document.addEventListener('DOMContentLoaded', function() {
            const firstviewModule = document.getElementById('<?php echo esc_js($unique_id); ?>');
            
            if (!firstviewModule) return;

            // パーティクル生成
            <?php if ($enable_particles): ?>
            function createParticles() {
                const particlesContainer = firstviewModule.querySelector('.firstview-02-particles');
                if (!particlesContainer) return;
                
                const particleCount = 50;

                for (let i = 0; i < particleCount; i++) {
                    const particle = document.createElement('div');
                    particle.className = 'firstview-02-particle';
                    particle.style.left = Math.random() * 100 + '%';
                    particle.style.animationDelay = Math.random() * 8 + 's';
                    particle.style.animationDuration = (Math.random() * 10 + 5) + 's';
                    particlesContainer.appendChild(particle);
                }
            }
            createParticles();
            <?php endif; ?>

            // パララックス効果
            function initParallax() {
                const content = firstviewModule.querySelector('.firstview-02-content');
                const floatingElements = firstviewModule.querySelectorAll('.firstview-02-floating-element');

                window.addEventListener('scroll', function() {
                    const scrollY = window.pageYOffset;
                    const rate = scrollY * -0.5;

                    if (content) {
                        content.style.transform = `translateY(${rate}px)`;
                    }

                    floatingElements.forEach((element, index) => {
                        const speed = 0.2 + (index * 0.1);
                        element.style.transform = `translateY(${scrollY * speed}px)`;
                    });
                });
            }

            // スムーススクロール
            function initSmoothScroll() {
                const scrollIndicator = firstviewModule.querySelector('.firstview-02-scroll-indicator');
                const buttons = firstviewModule.querySelectorAll('.firstview-02-btn[href^="#"]');

                function smoothScrollTo(target) {
                    const targetElement = document.querySelector(target);
                    if (targetElement) {
                        targetElement.scrollIntoView({
                            behavior: 'smooth',
                            block: 'start'
                        });
                    }
                }

                buttons.forEach(button => {
                    button.addEventListener('click', function(e) {
                        e.preventDefault();
                        const target = this.getAttribute('href');
                        smoothScrollTo(target);
                    });
                });

                if (scrollIndicator) {
                    scrollIndicator.addEventListener('click', function() {
                        window.scrollTo({
                            top: window.innerHeight,
                            behavior: 'smooth'
                        });
                    });
                }
            }

            // タイピング効果
            <?php if ($enable_typing): ?>
            function initTypingEffect() {
                const titleMain = firstviewModule.querySelector('.firstview-02-title-main');
                const titleSub = firstviewModule.querySelector('.firstview-02-title-sub');
                
                if (titleMain && titleSub) {
                    const mainText = titleMain.textContent;
                    const subText = titleSub.textContent;
                    
                    titleMain.textContent = '';
                    titleSub.textContent = '';
                    
                    let i = 0;
                    const typeSpeed = 100;
                    
                    function typeMainText() {
                        if (i < mainText.length) {
                            titleMain.textContent += mainText.charAt(i);
                            i++;
                            setTimeout(typeMainText, typeSpeed);
                        } else {
                            setTimeout(typeSubText, 500);
                        }
                    }
                    
                    let j = 0;
                    function typeSubText() {
                        if (j < subText.length) {
                            titleSub.textContent += subText.charAt(j);
                            j++;
                            setTimeout(typeSubText, typeSpeed);
                        }
                    }
                    
                    setTimeout(typeMainText, 500);
                }
            }
            initTypingEffect();
            <?php endif; ?>

            // ボタンホバー効果
            function initButtonEffects() {
                const buttons = firstviewModule.querySelectorAll('.firstview-02-btn');
                
                buttons.forEach(button => {
                    button.addEventListener('mouseenter', function() {
                        this.style.transform = 'translateY(-2px) scale(1.05)';
                    });
                    
                    button.addEventListener('mouseleave', function() {
                        this.style.transform = 'translateY(0) scale(1)';
                    });
                });
            }

            // 初期化
            initParallax();
            initSmoothScroll();
            initButtonEffects();

            // Intersection Observer でスクロール時のアニメーション
            const observer = new IntersectionObserver(function(entries) {
                entries.forEach(function(entry) {
                    if (entry.isIntersecting) {
                        entry.target.style.opacity = '1';
                        entry.target.style.transform = 'translateY(0)';
                    }
                });
            });

            observer.observe(firstviewModule);
        });
    </script>

    <?php
    return ob_get_clean();
}

// 管理画面でのプレビュー機能（オプション）
if (is_admin()) {
    add_action('admin_footer', function() {
        if (get_current_screen()->id === 'page') {
            ?>
            <script>
                console.log('Firstview 02 Module loaded in admin');
            </script>
            <?php
        }
    });
}

// Font Awesome のエンキュー（必要に応じて）
add_action('wp_enqueue_scripts', function() {
    if (!wp_style_is('font-awesome', 'enqueued')) {
        wp_enqueue_style('font-awesome', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css');
    }
});
?> 