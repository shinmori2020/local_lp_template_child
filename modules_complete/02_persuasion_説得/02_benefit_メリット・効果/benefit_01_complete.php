<?php
/**
 * Benefit Module 01 - Complete Independent Version
 * ショートコード: [benefit_01_module]
 * 
 * サービス導入後の効果・メリットを3つのカード形式で表示するモジュール
 * アイコン+コンテンツレイアウト、レスポンシブ対応、アニメーション付き
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
        'key' => 'group_benefit_01_complete',
        'title' => 'ベネフィットモジュール01設定',
        'fields' => array(
            array(
                'key' => 'field_benefit_01_section_title',
                'label' => 'セクションタイトル',
                'name' => 'benefit_01_section_title',
                'type' => 'text',
                'default_value' => '導入後、こう変わります',
                'instructions' => 'セクションのメインタイトルを入力',
            ),
            array(
                'key' => 'field_benefit_01_cards',
                'label' => 'ベネフィットカード',
                'name' => 'benefit_01_cards',
                'type' => 'repeater',
                'sub_fields' => array(
                    array(
                        'key' => 'field_benefit_card_icon',
                        'label' => 'アイコン（Font Awesome）',
                        'name' => 'icon',
                        'type' => 'text',
                        'instructions' => 'Font Awesomeクラス名（例: fa-clock, fa-check, fa-users）',
                        'default_value' => 'fa-clock',
                    ),
                    array(
                        'key' => 'field_benefit_card_title',
                        'label' => 'ベネフィットタイトル',
                        'name' => 'title',
                        'type' => 'text',
                        'instructions' => '効果・メリットのタイトル',
                    ),
                    array(
                        'key' => 'field_benefit_card_description',
                        'label' => '説明文',
                        'name' => 'description',
                        'type' => 'textarea',
                        'instructions' => 'ベネフィットの詳細説明',
                    ),
                ),
                'min' => 1,
                'max' => 6,
                'button_label' => 'ベネフィットカードを追加',
                'default_value' => array(
                    array(
                        'icon' => 'fa-clock',
                        'title' => '作業時間を50%削減',
                        'description' => '自動化により単純作業から解放され、より価値の高い業務に時間を使えるように',
                    ),
                    array(
                        'icon' => 'fa-check',
                        'title' => 'ミスのない正確な処理',
                        'description' => 'システムによる自動処理で、人的ミスを完全に防止。データの信頼性が向上',
                    ),
                    array(
                        'icon' => 'fa-users',
                        'title' => 'だれでも簡単に運用可能',
                        'description' => '直感的な操作で誰でも使えるため、特定の担当者に依存せず業務を進められる',
                    ),
                ),
            ),
            array(
                'key' => 'field_benefit_01_bg_color',
                'label' => '背景色',
                'name' => 'benefit_01_bg_color',
                'type' => 'color_picker',
                'default_value' => '#ffffff',
                'instructions' => 'セクションの背景色を選択',
            ),
        ),
        'location' => get_smart_location(),
        'menu_order' => 0,
        'position' => 'normal',
        'style' => 'default',
        'label_placement' => 'top',
        'instruction_placement' => 'label',
    ));
}

/**
 * ショートコード登録
 */
add_shortcode('benefit_01_module', 'render_benefit_01_module');

/**
 * Benefit Module HTML出力関数
 */
function render_benefit_01_module($atts = [], $content = null) {
    // ショートコード属性のデフォルト値
    $atts = shortcode_atts([
        'title' => '',
        'bg_color' => '',
        'post_id' => get_the_ID(),
    ], $atts, 'benefit_01_module');

    // 投稿IDが指定されていない場合は現在の投稿IDを使用
    if (empty($atts['post_id'])) {
        $atts['post_id'] = get_the_ID();
    }

    // ACFフィールドから値を取得
    $section_title = $atts['title'] ?: get_field('benefit_01_section_title', $atts['post_id']) ?: '導入後、こう変わります';
    $cards = get_field('benefit_01_cards', $atts['post_id']);
    $bg_color = $atts['bg_color'] ?: get_field('benefit_01_bg_color', $atts['post_id']) ?: '#ffffff';

    // デフォルトのカードデータ（ACFデータがない場合）
    if (empty($cards)) {
        $cards = array(
            array(
                'icon' => 'fa-clock',
                'title' => '作業時間を50%削減',
                'description' => '自動化により単純作業から解放され、より価値の高い業務に時間を使えるように',
            ),
            array(
                'icon' => 'fa-check',
                'title' => 'ミスのない正確な処理',
                'description' => 'システムによる自動処理で、人的ミスを完全に防止。データの信頼性が向上',
            ),
            array(
                'icon' => 'fa-users',
                'title' => 'だれでも簡単に運用可能',
                'description' => '直感的な操作で誰でも使えるため、特定の担当者に依存せず業務を進められる',
            ),
        );
    }

    // ユニークIDを生成（複数配置対応）
    $unique_id = 'benefit_' . uniqid();

    // HTMLとCSSを出力
    ob_start();
    ?>
    
    <!-- Benefit Module CSS -->
    <style>
    .<?php echo $unique_id; ?> {
        padding: 5rem 0;
        background-color: <?php echo esc_attr($bg_color); ?>;
    }

    .<?php echo $unique_id; ?> .container {
        max-width: 1200px;
        margin: 0 auto;
        padding: 0 20px;
    }

    .<?php echo $unique_id; ?> .section-title {
        text-align: center;
        font-size: 2.5rem;
        margin-bottom: 3rem;
        font-weight: 700;
        position: relative;
        padding-bottom: 1.5rem;
        color: #333;
    }

    .<?php echo $unique_id; ?> .section-title::after {
        content: '';
        position: absolute;
        bottom: 0;
        left: 50%;
        transform: translateX(-50%);
        width: 60px;
        height: 3px;
        background: linear-gradient(90deg, #4A90E2, #67B8E3);
    }

    .<?php echo $unique_id; ?> .benefit-cards {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
        gap: 2rem;
        margin-top: 3rem;
    }

    .<?php echo $unique_id; ?> .benefit-card {
        display: flex;
        align-items: flex-start;
        padding: 2rem;
        background: #ffffff;
        border-radius: 12px;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08);
        transition: all 0.3s ease;
        opacity: 0;
        animation: fadeInUp 0.6s ease-out forwards;
    }

    .<?php echo $unique_id; ?> .benefit-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 6px 20px rgba(0, 0, 0, 0.12);
    }

    .<?php echo $unique_id; ?> .benefit-icon {
        flex-shrink: 0;
        width: 60px;
        height: 60px;
        margin-right: 1.5rem;
        background: linear-gradient(135deg, #4A90E2, #67B8E3);
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-size: 1.5rem;
    }

    .<?php echo $unique_id; ?> .benefit-icon i {
        font-size: 1.5rem;
        color: white;
    }

    .<?php echo $unique_id; ?> .benefit-content {
        flex: 1;
    }

    .<?php echo $unique_id; ?> .benefit-content h3 {
        font-size: 1.3rem;
        margin-bottom: 0.75rem;
        color: #333;
        font-weight: 600;
    }

    .<?php echo $unique_id; ?> .benefit-content p {
        color: #666;
        line-height: 1.7;
        margin: 0;
        text-align: left;
    }

    /* アニメーション遅延 */
    .<?php echo $unique_id; ?> .benefit-card:nth-child(2) {
        animation-delay: 0.2s;
    }

    .<?php echo $unique_id; ?> .benefit-card:nth-child(3) {
        animation-delay: 0.4s;
    }

    .<?php echo $unique_id; ?> .benefit-card:nth-child(4) {
        animation-delay: 0.6s;
    }

    .<?php echo $unique_id; ?> .benefit-card:nth-child(5) {
        animation-delay: 0.8s;
    }

    .<?php echo $unique_id; ?> .benefit-card:nth-child(6) {
        animation-delay: 1.0s;
    }

    /* レスポンシブ対応 */
    @media (max-width: 1020px) and (min-width: 768px) {
        .<?php echo $unique_id; ?> .benefit-card {
            flex-direction: column;
            align-items: center;
            text-align: center;
        }

        .<?php echo $unique_id; ?> .benefit-icon {
            margin: 0 0 1.5rem 0;
        }

        .<?php echo $unique_id; ?> .benefit-content {
            width: 100%;
        }

        .<?php echo $unique_id; ?> .benefit-content h3 {
            text-align: center;
        }
    }

    @media (max-width: 767px) {
        .<?php echo $unique_id; ?> {
            padding: 3rem 0;
        }

        .<?php echo $unique_id; ?> .section-title {
            font-size: 2rem;
            margin-bottom: 2rem;
        }

        .<?php echo $unique_id; ?> .benefit-cards {
            grid-template-columns: 1fr;
            gap: 1.5rem;
        }

        .<?php echo $unique_id; ?> .benefit-card {
            flex-direction: row;
            align-items: flex-start;
            text-align: left;
            padding: 1.5rem;
        }

        .<?php echo $unique_id; ?> .benefit-icon {
            margin-right: 1.5rem;
        }

        .<?php echo $unique_id; ?> .benefit-content h3 {
            text-align: left;
        }

        .<?php echo $unique_id; ?> .benefit-content p {
            text-align: left;
        }
    }

    @media (max-width: 414px) {
        .<?php echo $unique_id; ?> .section-title {
            font-size: 1.75rem;
            margin-bottom: 1.75rem;
        }

        .<?php echo $unique_id; ?> .benefit-cards {
            gap: 1.25rem;
        }

        .<?php echo $unique_id; ?> .benefit-card {
            padding: 1.25rem;
            flex-direction: column;
            align-items: center;
            text-align: center;
        }

        .<?php echo $unique_id; ?> .benefit-icon {
            margin-right: 0;
            margin-bottom: 1rem;
            width: 50px;
            height: 50px;
        }

        .<?php echo $unique_id; ?> .benefit-icon i {
            font-size: 1.25rem;
        }

        .<?php echo $unique_id; ?> .benefit-content {
            width: 100%;
        }

        .<?php echo $unique_id; ?> .benefit-content h3 {
            font-size: 1.1rem;
            margin-bottom: 0.75rem;
            text-align: center;
        }

        .<?php echo $unique_id; ?> .benefit-content p {
            font-size: 0.9rem;
            line-height: 1.6;
            text-align: left;
        }
    }

    /* アニメーション定義 */
    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
    </style>

    <!-- Benefit Module HTML -->
    <section class="<?php echo $unique_id; ?>">
        <div class="container">
            <h2 class="section-title"><?php echo esc_html($section_title); ?></h2>
            <div class="benefit-cards">
                <?php foreach ($cards as $card): ?>
                    <div class="benefit-card">
                        <div class="benefit-icon">
                            <i class="fas <?php echo esc_attr($card['icon']); ?>"></i>
                        </div>
                        <div class="benefit-content">
                            <h3><?php echo esc_html($card['title']); ?></h3>
                            <p><?php echo esc_html($card['description']); ?></p>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <?php
    return ob_get_clean();
}

/**
 * get_smart_location関数が存在しない場合のフォールバック
 */
if (!function_exists('get_smart_location')) {
    function get_smart_location() {
        return array(
            array(
                array(
                    'param' => 'post_type',
                    'operator' => '==',
                    'value' => 'page',
                ),
            ),
        );
    }
}

// モジュールが正常に読み込まれたことをログに記録
if (function_exists('error_log')) {
    error_log('Benefit Module 01 (benefit_01_module) loaded successfully');
} 