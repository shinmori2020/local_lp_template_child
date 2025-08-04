<?php
/**
 * Main Features Module 01 - Complete Independent Version
 * ショートコード: [main_features_01_module]
 * 
 * 商品・サービスの主要機能を3つのカード形式で表示するモジュール
 * 複雑なホバーエフェクト、アニメーション、機能リスト付き
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
        'key' => 'group_main_features_01_complete',
        'title' => '主要機能モジュール01設定',
        'fields' => array(
            array(
                'key' => 'field_main_features_01_section_title',
                'label' => 'セクションタイトル',
                'name' => 'main_features_01_section_title',
                'type' => 'text',
                'default_value' => '充実の機能で業務改善をサポート',
                'instructions' => 'セクションのメインタイトルを入力',
            ),
            array(
                'key' => 'field_main_features_01_cards',
                'label' => '機能カード',
                'name' => 'main_features_01_cards',
                'type' => 'repeater',
                'sub_fields' => array(
                    array(
                        'key' => 'field_feature_card_icon',
                        'label' => 'アイコン（Font Awesome）',
                        'name' => 'icon',
                        'type' => 'text',
                        'instructions' => 'Font Awesomeクラス名（例: fa-robot, fa-shield-alt, fa-chart-bar）',
                        'default_value' => 'fa-robot',
                    ),
                    array(
                        'key' => 'field_feature_card_title',
                        'label' => '機能タイトル',
                        'name' => 'title',
                        'type' => 'text',
                        'instructions' => '機能・サービスのタイトル',
                    ),
                    array(
                        'key' => 'field_feature_card_description',
                        'label' => '説明文',
                        'name' => 'description',
                        'type' => 'textarea',
                        'instructions' => '機能の詳細説明',
                    ),
                    array(
                        'key' => 'field_feature_card_list',
                        'label' => '機能リスト',
                        'name' => 'feature_list',
                        'type' => 'repeater',
                        'sub_fields' => array(
                            array(
                                'key' => 'field_feature_list_item',
                                'label' => '機能項目',
                                'name' => 'item',
                                'type' => 'text',
                                'instructions' => '個別の機能項目',
                            ),
                        ),
                        'min' => 1,
                        'max' => 5,
                        'button_label' => '機能項目を追加',
                        'default_value' => array(
                            array('item' => '業務フローの自動分析'),
                            array('item' => 'カスタマイズ可能なルール設定'),
                            array('item' => 'リアルタイムの最適化提案'),
                        ),
                    ),
                ),
                'min' => 1,
                'max' => 6,
                'button_label' => '機能カードを追加',
                'default_value' => array(
                    array(
                        'icon' => 'fa-robot',
                        'title' => 'AIによる自動化',
                        'description' => '独自開発のAIエンジンが業務フローを学習し、最適な自動化を提案。導入後すぐに効果を実感できます。',
                        'feature_list' => array(
                            array('item' => '業務フローの自動分析'),
                            array('item' => 'カスタマイズ可能なルール設定'),
                            array('item' => 'リアルタイムの最適化提案'),
                        ),
                    ),
                    array(
                        'icon' => 'fa-shield-alt',
                        'title' => '強固なセキュリティ',
                        'description' => '国際基準に準拠したセキュリティ体制で、お客様の大切なデータを確実に保護します。',
                        'feature_list' => array(
                            array('item' => 'ISO27001認証取得'),
                            array('item' => 'エンドツーエンドの暗号化'),
                            array('item' => '多要素認証対応'),
                        ),
                    ),
                    array(
                        'icon' => 'fa-chart-bar',
                        'title' => '詳細な分析レポート',
                        'description' => '業務効率化の成果を可視化し、さらなる改善のヒントを提供します。',
                        'feature_list' => array(
                            array('item' => 'カスタマイズ可能なダッシュボード'),
                            array('item' => 'PDF/Excel形式でのレポート出力'),
                            array('item' => 'トレンド分析と予測'),
                        ),
                    ),
                ),
            ),
            array(
                'key' => 'field_main_features_01_bg_color',
                'label' => '背景色',
                'name' => 'main_features_01_bg_color',
                'type' => 'color_picker',
                'default_value' => '#f8f9fa',
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
add_shortcode('main_features_01_module', 'render_main_features_01_module');

/**
 * Main Features Module HTML出力関数
 */
function render_main_features_01_module($atts = [], $content = null) {
    // ショートコード属性のデフォルト値
    $atts = shortcode_atts([
        'title' => '',
        'bg_color' => '',
        'post_id' => get_the_ID(),
    ], $atts, 'main_features_01_module');

    // 投稿IDが指定されていない場合は現在の投稿IDを使用
    if (empty($atts['post_id'])) {
        $atts['post_id'] = get_the_ID();
    }

    // ACFフィールドから値を取得
    $section_title = $atts['title'] ?: get_field('main_features_01_section_title', $atts['post_id']) ?: '充実の機能で業務改善をサポート';
    $cards = get_field('main_features_01_cards', $atts['post_id']);
    $bg_color = $atts['bg_color'] ?: get_field('main_features_01_bg_color', $atts['post_id']) ?: '#f8f9fa';

    // デフォルトのカードデータ（ACFデータがない場合）
    if (empty($cards)) {
        $cards = array(
            array(
                'icon' => 'fa-robot',
                'title' => 'AIによる自動化',
                'description' => '独自開発のAIエンジンが業務フローを学習し、最適な自動化を提案。導入後すぐに効果を実感できます。',
                'feature_list' => array(
                    array('item' => '業務フローの自動分析'),
                    array('item' => 'カスタマイズ可能なルール設定'),
                    array('item' => 'リアルタイムの最適化提案'),
                ),
            ),
            array(
                'icon' => 'fa-shield-alt',
                'title' => '強固なセキュリティ',
                'description' => '国際基準に準拠したセキュリティ体制で、お客様の大切なデータを確実に保護します。',
                'feature_list' => array(
                    array('item' => 'ISO27001認証取得'),
                    array('item' => 'エンドツーエンドの暗号化'),
                    array('item' => '多要素認証対応'),
                ),
            ),
            array(
                'icon' => 'fa-chart-bar',
                'title' => '詳細な分析レポート',
                'description' => '業務効率化の成果を可視化し、さらなる改善のヒントを提供します。',
                'feature_list' => array(
                    array('item' => 'カスタマイズ可能なダッシュボード'),
                    array('item' => 'PDF/Excel形式でのレポート出力'),
                    array('item' => 'トレンド分析と予測'),
                ),
            ),
        );
    }

    // ユニークIDを生成（複数配置対応）
    $unique_id = 'main_features_' . uniqid();

    // HTMLとCSSを出力
    ob_start();
    ?>
    
    <!-- Main Features Module CSS -->
    <style>
    .<?php echo $unique_id; ?> {
        padding: 8rem 0;
        background: linear-gradient(135deg, <?php echo esc_attr($bg_color); ?> 0%, #e9ecef 100%);
        position: relative;
        overflow: hidden;
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

    .<?php echo $unique_id; ?> .features-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
        gap: 2rem;
        padding: 2rem 0;
        position: relative;
    }

    .<?php echo $unique_id; ?> .feature-card {
        background: #fff;
        border-radius: 24px;
        padding: 2rem;
        position: relative;
        overflow: hidden;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        transition: all 0.4s ease;
        z-index: 1;
        opacity: 0;
        animation: slideInUp 0.6s ease forwards;
    }

    .<?php echo $unique_id; ?> .feature-card:nth-child(2) {
        animation-delay: 0.2s;
    }

    .<?php echo $unique_id; ?> .feature-card:nth-child(3) {
        animation-delay: 0.4s;
    }

    .<?php echo $unique_id; ?> .feature-card:nth-child(4) {
        animation-delay: 0.6s;
    }

    .<?php echo $unique_id; ?> .feature-card:nth-child(5) {
        animation-delay: 0.8s;
    }

    .<?php echo $unique_id; ?> .feature-card:nth-child(6) {
        animation-delay: 1.0s;
    }

    .<?php echo $unique_id; ?> .feature-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: linear-gradient(135deg, #4A90E2 0%, #67B8E3 100%);
        opacity: 0;
        transition: opacity 0.4s ease;
        z-index: -1;
    }

    .<?php echo $unique_id; ?> .feature-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 20px 40px rgba(74, 144, 226, 0.2);
    }

    .<?php echo $unique_id; ?> .feature-card:hover::before {
        opacity: 1;
    }

    .<?php echo $unique_id; ?> .feature-card:hover * {
        color: #fff !important;
    }

    .<?php echo $unique_id; ?> .feature-icon {
        width: 80px;
        height: 80px;
        background: linear-gradient(135deg, #4A90E2 0%, #67B8E3 100%);
        border-radius: 20px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-bottom: 2rem;
        position: relative;
        transform: rotate(-15deg);
        transition: all 0.4s ease;
    }

    .<?php echo $unique_id; ?> .feature-card:hover .feature-icon {
        background: #fff;
        transform: rotate(0deg);
    }

    .<?php echo $unique_id; ?> .feature-icon i {
        font-size: 2.5rem;
        color: #fff;
        transition: all 0.4s ease;
    }

    .<?php echo $unique_id; ?> .feature-card:hover .feature-icon i {
        color: #4A90E2 !important;
    }

    .<?php echo $unique_id; ?> .feature-card h3 {
        font-size: 1.8rem;
        margin-bottom: 1.5rem;
        color: #333;
        position: relative;
        padding-bottom: 1rem;
        transition: all 0.4s ease;
    }

    .<?php echo $unique_id; ?> .feature-card h3::after {
        content: '';
        position: absolute;
        bottom: 0;
        left: 0;
        width: 50px;
        height: 3px;
        background: linear-gradient(90deg, #4A90E2, #67B8E3);
        transition: all 0.4s ease;
    }

    .<?php echo $unique_id; ?> .feature-card:hover h3::after {
        width: 100px;
        background: #fff;
    }

    .<?php echo $unique_id; ?> .feature-card p {
        color: #666;
        line-height: 1.8;
        margin-bottom: 2rem;
        transition: all 0.4s ease;
        font-size: 1.1rem;
    }

    .<?php echo $unique_id; ?> .feature-list {
        list-style: none;
        padding: 0;
        margin: 0;
    }

    .<?php echo $unique_id; ?> .feature-list li {
        color: #666;
        margin-bottom: 1rem;
        padding-left: 2rem;
        position: relative;
        transition: all 0.4s ease;
        font-size: 1rem;
    }

    .<?php echo $unique_id; ?> .feature-list li::before {
        content: '';
        position: absolute;
        left: 0;
        top: 50%;
        transform: translateY(-50%);
        width: 8px;
        height: 8px;
        background: #4A90E2;
        border-radius: 2px;
        transition: all 0.4s ease;
    }

    .<?php echo $unique_id; ?> .feature-card:hover .feature-list li::before {
        background: #fff;
        transform: translateY(-50%) rotate(45deg);
    }

    /* レスポンシブ対応 */
    @media (max-width: 900px) {
        .<?php echo $unique_id; ?> {
            padding: 5rem 0;
        }

        .<?php echo $unique_id; ?> .features-grid {
            grid-template-columns: 1fr;
            gap: 2rem;
            padding: 1rem 0;
        }

        .<?php echo $unique_id; ?> .feature-card {
            padding: 1.5rem;
            display: grid;
            grid-template-columns: auto 1fr;
            grid-template-areas: 
                "icon title"
                "content content"
                "list list";
            align-items: center;
            gap: 1.5rem;
        }

        .<?php echo $unique_id; ?> .feature-icon {
            grid-area: icon;
            width: 60px;
            height: 60px;
            margin-bottom: 0;
        }

        .<?php echo $unique_id; ?> .feature-card h3 {
            grid-area: title;
            font-size: 1.4rem;
            margin-bottom: 0;
            padding-bottom: 0;
        }

        .<?php echo $unique_id; ?> .feature-card h3::after {
            display: none;
        }

        .<?php echo $unique_id; ?> .feature-card p {
            grid-area: content;
            font-size: 1rem;
            margin-bottom: 1.5rem;
        }

        .<?php echo $unique_id; ?> .feature-list {
            grid-area: list;
        }

        .<?php echo $unique_id; ?> .feature-list li {
            font-size: 0.9rem;
            margin-bottom: 0.8rem;
        }

        .<?php echo $unique_id; ?> .feature-icon i {
            font-size: 1.8rem;
        }
    }

    @media (max-width: 414px) {
        .<?php echo $unique_id; ?> .feature-card {
            grid-template-columns: 1fr;
            grid-template-areas: 
                "icon"
                "title"
                "content"
                "list";
            text-align: center;
            gap: 1rem;
        }

        .<?php echo $unique_id; ?> .feature-icon {
            justify-self: center;
            margin-bottom: 0.5rem;
        }

        .<?php echo $unique_id; ?> .feature-card h3 {
            text-align: center;
            font-size: 1.3rem;
        }

        .<?php echo $unique_id; ?> .feature-card p {
            text-align: left;
            font-size: 0.95rem;
        }

        .<?php echo $unique_id; ?> .feature-list {
            text-align: left;
        }

        .<?php echo $unique_id; ?> .feature-list li {
            font-size: 0.85rem;
        }
    }

    /* アニメーション定義 */
    @keyframes slideInUp {
        from {
            opacity: 0;
            transform: translateY(30px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
    </style>

    <!-- Main Features Module HTML -->
    <section class="<?php echo $unique_id; ?>">
        <div class="container">
            <h2 class="section-title"><?php echo esc_html($section_title); ?></h2>
            <div class="features-grid">
                <?php foreach ($cards as $card): ?>
                    <div class="feature-card">
                        <div class="feature-icon">
                            <i class="fas <?php echo esc_attr($card['icon']); ?>"></i>
                        </div>
                        <h3><?php echo esc_html($card['title']); ?></h3>
                        <p><?php echo esc_html($card['description']); ?></p>
                        <?php if (!empty($card['feature_list'])): ?>
                            <ul class="feature-list">
                                <?php foreach ($card['feature_list'] as $list_item): ?>
                                    <li><?php echo esc_html($list_item['item']); ?></li>
                                <?php endforeach; ?>
                            </ul>
                        <?php endif; ?>
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
    error_log('Main Features Module 01 (main_features_01_module) loaded successfully');
} 