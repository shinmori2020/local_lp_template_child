<?php
/**
 * Firstview Module 01 - Complete Independent Version
 * ショートコード: [firstview_01_module]
 * 
 * WEBサイトのTOPページを彩るメインビジュアルモジュール
 * フルハイト表示、実績数値、メディア掲載実績を含む
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
        'key' => 'group_firstview_01_complete',
        'title' => 'ファーストビューモジュール01設定',
        'fields' => array(
            array(
                'key' => 'field_firstview_01_main_catch',
                'label' => 'メインキャッチコピー',
                'name' => 'firstview_01_main_catch',
                'type' => 'textarea',
                'default_value' => '毎日の業務を<br>もっとスマートに',
                'instructions' => 'HTML可。改行は<br>を使用',
            ),
            array(
                'key' => 'field_firstview_01_sub_catch',
                'label' => 'サブキャッチコピー',
                'name' => 'firstview_01_sub_catch',
                'type' => 'textarea',
                'default_value' => '手作業による単純作業を自動化して、本来の仕事に集中<br>導入企業の93%が「業務改善に効果あり」と実感！',
                'instructions' => 'HTML可。改行は<br>を使用',
            ),
            array(
                'key' => 'field_firstview_01_cta_main',
                'label' => 'CTAメインテキスト',
                'name' => 'firstview_01_cta_main',
                'type' => 'text',
                'default_value' => '無料デモを試す',
            ),
            array(
                'key' => 'field_firstview_01_cta_sub',
                'label' => 'CTAサブテキスト',
                'name' => 'firstview_01_cta_sub',
                'type' => 'text',
                'default_value' => '30日間無料トライアル',
            ),
            array(
                'key' => 'field_firstview_01_cta_link',
                'label' => 'CTAリンク先',
                'name' => 'firstview_01_cta_link',
                'type' => 'text',
                'default_value' => '#contact',
            ),
            array(
                'key' => 'field_firstview_01_achievements',
                'label' => '実績データ',
                'name' => 'firstview_01_achievements',
                'type' => 'repeater',
                'sub_fields' => array(
                    array(
                        'key' => 'field_achievement_number',
                        'label' => '数値',
                        'name' => 'number',
                        'type' => 'text',
                        'instructions' => '例: 1,234 や 97.5% など',
                    ),
                    array(
                        'key' => 'field_achievement_label',
                        'label' => 'ラベル',
                        'name' => 'label',
                        'type' => 'text',
                        'instructions' => '例: 導入実績、満足度など',
                    ),
                ),
                'min' => 0,
                'max' => 4,
                'button_label' => '実績を追加',
            ),
            array(
                'key' => 'field_firstview_01_media_title',
                'label' => 'メディア掲載タイトル',
                'name' => 'firstview_01_media_title',
                'type' => 'text',
                'default_value' => 'メディア掲載実績',
            ),
            array(
                'key' => 'field_firstview_01_media_logos',
                'label' => 'メディアロゴ',
                'name' => 'firstview_01_media_logos',
                'type' => 'repeater',
                'sub_fields' => array(
                    array(
                        'key' => 'field_media_logo_image',
                        'label' => 'ロゴ画像',
                        'name' => 'image',
                        'type' => 'image',
                        'return_format' => 'array',
                    ),
                ),
                'min' => 0,
                'max' => 6,
                'button_label' => 'ロゴを追加',
            ),
            array(
                'key' => 'field_firstview_01_bg_color',
                'label' => '背景色',
                'name' => 'firstview_01_bg_color',
                'type' => 'select',
                'choices' => array(
                    'default' => 'デフォルト（グレー）',
                    'gradient-blue' => 'ブルーグラデーション',
                    'gradient-green' => 'グリーングラデーション',
                    'gradient-purple' => 'パープルグラデーション',
                ),
                'default_value' => 'default',
            ),
        ),
        'location' => get_smart_location(), // 最小記述方式（1行のみ）
    ));
}

/**
 * ショートコード登録
 */
add_shortcode('firstview_01_module', 'render_firstview_01_module');

function render_firstview_01_module($atts = [], $content = null) {
    // 属性のデフォルト値
    $atts = shortcode_atts(array(
        'main_catch' => '',
        'sub_catch' => '',
        'cta_main' => '',
        'cta_sub' => '',
        'cta_link' => '',
        'bg_color' => '',
        'post_id' => get_the_ID(),
    ), $atts);
    
    // ACFフィールドから値を取得（ショートコード属性で上書き可能）
    $post_id = $atts['post_id'];
    $main_catch = $atts['main_catch'] ?: get_field('firstview_01_main_catch', $post_id) ?: '毎日の業務を<br>もっとスマートに';
    $sub_catch = $atts['sub_catch'] ?: get_field('firstview_01_sub_catch', $post_id) ?: '手作業による単純作業を自動化して、本来の仕事に集中<br>導入企業の93%が「業務改善に効果あり」と実感！';
    $cta_main = $atts['cta_main'] ?: get_field('firstview_01_cta_main', $post_id) ?: '無料デモを試す';
    $cta_sub = $atts['cta_sub'] ?: get_field('firstview_01_cta_sub', $post_id) ?: '30日間無料トライアル';
    $cta_link = $atts['cta_link'] ?: get_field('firstview_01_cta_link', $post_id) ?: '#contact';
    $bg_color = $atts['bg_color'] ?: get_field('firstview_01_bg_color', $post_id) ?: 'default';
    
    // 実績データ取得
    $achievements = get_field('firstview_01_achievements', $post_id) ?: array(
        array('number' => '1,234', 'label' => '導入実績'),
        array('number' => '97.5<small>%</small>', 'label' => '継続利用率'),
        array('number' => '4.8<small>/5.0</small>', 'label' => '顧客満足度'),
    );
    
    // メディア関連データ取得
    $media_title = get_field('firstview_01_media_title', $post_id) ?: 'メディア掲載実績';
    $media_logos = get_field('firstview_01_media_logos', $post_id) ?: array();
    
    // ユニークIDを生成（複数モジュール対応）
    $unique_id = 'firstview_01_' . uniqid();
    
    // 背景色クラス設定
    $bg_class = '';
    switch ($bg_color) {
        case 'gradient-blue':
            $bg_class = 'bg-gradient-blue';
            break;
        case 'gradient-green':
            $bg_class = 'bg-gradient-green';
            break;
        case 'gradient-purple':
            $bg_class = 'bg-gradient-purple';
            break;
        default:
            $bg_class = 'bg-default';
    }
    
    ob_start();
    ?>
    
    <style>
    .<?php echo $unique_id; ?> {
        position: relative;
        height: 100vh;
        min-height: 800px;
        overflow: hidden;
    }
    
    .<?php echo $unique_id; ?>.bg-default {
        background: #f5f5f5;
    }
    
    .<?php echo $unique_id; ?>.bg-gradient-blue {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    }
    
    .<?php echo $unique_id; ?>.bg-gradient-green {
        background: linear-gradient(135deg, #11998e 0%, #38ef7d 100%);
    }
    
    .<?php echo $unique_id; ?>.bg-gradient-purple {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    }
    
    .<?php echo $unique_id; ?> .firstview-content {
        width: 100%;
        height: 100vh;
        display: flex;
        align-items: center;
        justify-content: center;
        text-align: center;
        position: relative;
        padding-top: 70px;
    }
    
    .<?php echo $unique_id; ?> .container {
        width: 100%;
        max-width: 1400px;
        margin: 0 auto;
        padding: 0 20px;
    }
    
    .<?php echo $unique_id; ?> .main-catch {
        font-size: 48px;
        font-weight: bold;
        margin-bottom: 24px;
        line-height: 1.4;
        color: #333333;
        letter-spacing: -0.02em;
    }
    
    .<?php echo $unique_id; ?>.bg-gradient-blue .main-catch,
    .<?php echo $unique_id; ?>.bg-gradient-green .main-catch,
    .<?php echo $unique_id; ?>.bg-gradient-purple .main-catch {
        color: #ffffff;
    }
    
    .<?php echo $unique_id; ?> .main-catch .catch-line1 {
        display: block;
        font-size: 0.8em;
        margin-bottom: 15px;
    }
    
    .<?php echo $unique_id; ?> .sub-catch {
        font-size: 24px;
        line-height: 1.6;
        margin-bottom: 40px;
        color: #666666;
        letter-spacing: 0.02em;
    }
    
    .<?php echo $unique_id; ?>.bg-gradient-blue .sub-catch,
    .<?php echo $unique_id; ?>.bg-gradient-green .sub-catch,
    .<?php echo $unique_id; ?>.bg-gradient-purple .sub-catch {
        color: rgba(255, 255, 255, 0.9);
    }
    
    .<?php echo $unique_id; ?> .cta-container {
        margin-top: 40px;
        margin-bottom: 60px;
        display: flex;
        justify-content: center;
    }
    
    .<?php echo $unique_id; ?> .cta-button {
        display: flex;
        flex-direction: row;
        align-items: center;
        justify-content: center;
        width: 480px;
        padding: 24px 40px;
        background: linear-gradient(135deg, #333333 0%, #1a1a1a 100%);
        color: #ffffff;
        text-decoration: none;
        border-radius: 8px;
        transition: all 0.3s ease;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }
    
    .<?php echo $unique_id; ?> .cta-button:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 15px rgba(0, 0, 0, 0.15);
        background: linear-gradient(135deg, #1a1a1a 0%, #000000 100%);
        color: #ffffff;
        text-decoration: none;
    }
    
    .<?php echo $unique_id; ?> .cta-main {
        font-size: 24px;
        font-weight: bold;
        margin-right: 16px;
        letter-spacing: 0.02em;
    }
    
    .<?php echo $unique_id; ?> .cta-sub {
        font-size: 16px;
        opacity: 0.9;
        position: relative;
        padding-left: 16px;
        letter-spacing: 0.01em;
    }
    
    .<?php echo $unique_id; ?> .cta-sub::before {
        content: "";
        position: absolute;
        left: 0;
        top: 50%;
        transform: translateY(-50%);
        width: 1px;
        height: 24px;
        background: rgba(255, 255, 255, 0.3);
    }
    
    .<?php echo $unique_id; ?> .trust-indicators {
        display: flex;
        justify-content: center;
        gap: 60px;
        margin-top: 20px;
    }
    
    .<?php echo $unique_id; ?> .achievement {
        display: flex;
        flex-direction: column;
        align-items: center;
    }
    
    .<?php echo $unique_id; ?> .achievement .number {
        font-size: 36px;
        font-weight: bold;
        color: #333333;
        line-height: 1.2;
        margin-bottom: 8px;
    }
    
    .<?php echo $unique_id; ?>.bg-gradient-blue .achievement .number,
    .<?php echo $unique_id; ?>.bg-gradient-green .achievement .number,
    .<?php echo $unique_id; ?>.bg-gradient-purple .achievement .number {
        color: #ffffff;
    }
    
    .<?php echo $unique_id; ?> .achievement .number small {
        font-size: 18px;
        margin-left: 2px;
    }
    
    .<?php echo $unique_id; ?> .achievement .label {
        font-size: 14px;
        color: #666666;
        letter-spacing: 0.05em;
    }
    
    .<?php echo $unique_id; ?>.bg-gradient-blue .achievement .label,
    .<?php echo $unique_id; ?>.bg-gradient-green .achievement .label,
    .<?php echo $unique_id; ?>.bg-gradient-purple .achievement .label {
        color: rgba(255, 255, 255, 0.8);
    }
    
    .<?php echo $unique_id; ?> .media-logos {
        margin-top: 60px;
    }
    
    .<?php echo $unique_id; ?> .media-title {
        font-size: 16px;
        font-weight: bold;
        color: #666666;
        margin-bottom: 20px;
        letter-spacing: 0.05em;
    }
    
    .<?php echo $unique_id; ?>.bg-gradient-blue .media-title,
    .<?php echo $unique_id; ?>.bg-gradient-green .media-title,
    .<?php echo $unique_id; ?>.bg-gradient-purple .media-title {
        color: rgba(255, 255, 255, 0.8);
    }
    
    .<?php echo $unique_id; ?> .logo-container {
        display: flex;
        justify-content: center;
        gap: 40px;
        align-items: center;
        flex-wrap: wrap;
    }
    
    .<?php echo $unique_id; ?> .logo-container img {
        width: 160px;
        height: 60px;
        object-fit: contain;
        background: rgba(224, 224, 224, 0.5);
        border-radius: 4px;
        padding: 10px;
    }
    
    /* タブレット用メディアクエリ */
    @media screen and (max-width: 767px) {
        .<?php echo $unique_id; ?> .firstview-content {
            padding-top: 60px;
        }
        
        .<?php echo $unique_id; ?> .container {
            width: 95%;
            padding: 0 20px;
        }
        
        .<?php echo $unique_id; ?> .main-catch {
            font-size: 36px;
        }
        
        .<?php echo $unique_id; ?> .sub-catch {
            font-size: 18px;
        }
        
        .<?php echo $unique_id; ?> .cta-container {
            margin-bottom: 60px;
        }
        
        .<?php echo $unique_id; ?> .trust-indicators {
            gap: 30px;
            margin-top: 40px;
        }
        
        .<?php echo $unique_id; ?> .achievement .number {
            font-size: 24px;
        }
        
        .<?php echo $unique_id; ?> .achievement .number small {
            font-size: 14px;
        }
        
        .<?php echo $unique_id; ?> .achievement .label {
            font-size: 12px;
        }
        
        .<?php echo $unique_id; ?> .media-logos {
            margin-top: 40px;
        }
        
        .<?php echo $unique_id; ?> .logo-container {
            gap: 20px;
        }
        
        .<?php echo $unique_id; ?> .logo-container img {
            width: 120px;
            height: 45px;
        }
        
        .<?php echo $unique_id; ?> .cta-button {
            padding: 20px 32px;
        }
        
        .<?php echo $unique_id; ?> .cta-main {
            font-size: 20px;
            margin-right: 16px;
        }
        
        .<?php echo $unique_id; ?> .cta-sub {
            font-size: 14px;
        }
        
        .<?php echo $unique_id; ?> .media-title {
            font-size: 15px;
        }
    }
    
    /* スマートフォン用メディアクエリ */
    @media screen and (max-width: 414px) {
        .<?php echo $unique_id; ?> .container {
            width: 100%;
            padding: 0 15px;
        }
        
        .<?php echo $unique_id; ?> .main-catch {
            font-size: 28px;
        }
        
        .<?php echo $unique_id; ?> .sub-catch {
            font-size: 16px;
            margin-bottom: 20px;
        }
        
        .<?php echo $unique_id; ?> .cta-container {
            margin-top: 20px;
            margin-bottom: 20px;
        }
        
        .<?php echo $unique_id; ?> .trust-indicators {
            gap: 15px;
            margin-top: 30px;
            padding: 0 10px;
        }
        
        .<?php echo $unique_id; ?> .achievement {
            flex: 1;
        }
        
        .<?php echo $unique_id; ?> .achievement .number {
            font-size: 28px;
        }
        
        .<?php echo $unique_id; ?> .achievement .number small {
            font-size: 16px;
        }
        
        .<?php echo $unique_id; ?> .achievement .label {
            font-size: 13px;
        }
        
        .<?php echo $unique_id; ?> .media-logos {
            margin-top: 30px;
        }
        
        .<?php echo $unique_id; ?> .logo-container {
            gap: 15px;
        }
        
        .<?php echo $unique_id; ?> .logo-container img {
            width: 100px;
            height: 38px;
        }
        
        .<?php echo $unique_id; ?> .cta-button {
            width: 280px;
            padding: 10px 14px;
            flex-direction: column;
            align-items: center;
        }
        
        .<?php echo $unique_id; ?> .cta-main {
            font-size: 18px;
            margin-right: 0;
            margin-bottom: 5px;
        }
        
        .<?php echo $unique_id; ?> .cta-sub {
            font-size: 12px;
            padding-left: 0;
        }
        
        .<?php echo $unique_id; ?> .cta-sub::before {
            display: none;
        }
        
        .<?php echo $unique_id; ?> .media-title {
            font-size: 14px;
        }
    }
    </style>
    
    <section class="<?php echo $unique_id; ?> <?php echo $bg_class; ?>" id="firstview-01-module">
        <div class="firstview-content">
            <div class="container">
                <h1 class="main-catch">
                    <span class="catch-line1"><?php echo wp_kses_post($main_catch); ?></span>
                </h1>
                <p class="sub-catch"><?php echo wp_kses_post($sub_catch); ?></p>

                <div class="cta-container">
                    <a href="<?php echo esc_url($cta_link); ?>" class="cta-button" onclick="firstviewClick_<?php echo $unique_id; ?>(event)">
                        <span class="cta-main"><?php echo esc_html($cta_main); ?></span>
                        <span class="cta-sub"><?php echo esc_html($cta_sub); ?></span>
                    </a>
                </div>

                <?php if (!empty($achievements)): ?>
                <div class="trust-indicators">
                    <?php foreach ($achievements as $achievement): ?>
                        <div class="achievement">
                            <span class="number"><?php echo wp_kses_post($achievement['number']); ?></span>
                            <span class="label"><?php echo esc_html($achievement['label']); ?></span>
                        </div>
                    <?php endforeach; ?>
                </div>
                <?php endif; ?>

                <?php if (!empty($media_logos)): ?>
                <div class="media-logos">
                    <p class="media-title"><?php echo esc_html($media_title); ?></p>
                    <div class="logo-container">
                        <?php foreach ($media_logos as $logo): ?>
                            <?php if (!empty($logo['image'])): ?>
                                <img src="<?php echo esc_url($logo['image']['url']); ?>" alt="<?php echo esc_attr($logo['image']['alt']); ?>">
                            <?php endif; ?>
                        <?php endforeach; ?>
                    </div>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </section>
    
    <script>
    function firstviewClick_<?php echo $unique_id; ?>(event) {
        // Google Analytics トラッキング
        if (typeof gtag !== 'undefined') {
            gtag('event', 'firstview_cta_click', {
                'event_category': 'engagement',
                'event_label': '<?php echo esc_js($cta_main); ?>',
                'module_id': '<?php echo $unique_id; ?>'
            });
        }
        
        console.log('Firstview CTA clicked:', '<?php echo esc_js($cta_main); ?>');
        
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
    
    document.addEventListener('DOMContentLoaded', function() {
        console.log('Firstview Module 01 Loaded: <?php echo $unique_id; ?>');
        
        // フェードインアニメーション
        const section = document.querySelector('.<?php echo $unique_id; ?>');
        if (section) {
            section.style.opacity = '0';
            setTimeout(() => {
                section.style.transition = 'opacity 1s ease-in-out';
                section.style.opacity = '1';
            }, 100);
        }
    });
    </script>
    
    <?php
    return ob_get_clean();
}
?> 