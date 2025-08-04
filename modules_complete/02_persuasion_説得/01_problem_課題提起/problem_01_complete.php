<?php
/**
 * Problem Module 01 - Complete Independent Version
 * ショートコード: [problem_01_module]
 * 
 * 顧客の課題・悩みを3つのカード形式で表示するモジュール
 * Font Awesomeアイコン、レスポンシブ対応、アニメーション付き
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
        'key' => 'group_problem_01_complete',
        'title' => '課題提起モジュール01設定',
        'fields' => array(
            array(
                'key' => 'field_problem_01_section_title',
                'label' => 'セクションタイトル',
                'name' => 'problem_01_section_title',
                'type' => 'text',
                'default_value' => 'こんな課題はありませんか？',
                'instructions' => 'セクションのメインタイトルを入力',
            ),
            array(
                'key' => 'field_problem_01_cards',
                'label' => '課題カード',
                'name' => 'problem_01_cards',
                'type' => 'repeater',
                'sub_fields' => array(
                    array(
                        'key' => 'field_problem_card_icon',
                        'label' => 'アイコン（Font Awesome）',
                        'name' => 'icon',
                        'type' => 'text',
                        'instructions' => 'Font Awesomeクラス名（例: fa-clock, fa-exclamation-triangle, fa-user）',
                        'default_value' => 'fa-clock',
                    ),
                    array(
                        'key' => 'field_problem_card_title',
                        'label' => 'カードタイトル',
                        'name' => 'title',
                        'type' => 'text',
                        'instructions' => '課題のタイトル',
                    ),
                    array(
                        'key' => 'field_problem_card_description',
                        'label' => '説明文',
                        'name' => 'description',
                        'type' => 'textarea',
                        'instructions' => '課題の詳細説明',
                    ),
                ),
                'min' => 1,
                'max' => 6,
                'button_label' => '課題カードを追加',
                'default_value' => array(
                    array(
                        'icon' => 'fa-clock',
                        'title' => '作業に追われる毎日...',
                        'description' => '日々の単純作業に多くの時間を取られ、本来やるべき業務に集中できない',
                    ),
                    array(
                        'icon' => 'fa-exclamation-triangle',
                        'title' => 'ミスが心配...',
                        'description' => '手作業による入力ミスやデータの取り違えが発生するリスクが常にある',
                    ),
                    array(
                        'icon' => 'fa-user',
                        'title' => '業務の属人化',
                        'description' => '特定の担当者しか対応できない業務があり、引き継ぎや休暇対応に苦慮',
                    ),
                ),
            ),
            array(
                'key' => 'field_problem_01_bg_color',
                'label' => '背景色',
                'name' => 'problem_01_bg_color',
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
add_shortcode('problem_01_module', 'render_problem_01_module');

/**
 * Problem Module HTML出力関数
 */
function render_problem_01_module($atts = [], $content = null) {
    // ショートコード属性のデフォルト値
    $atts = shortcode_atts([
        'title' => '',
        'bg_color' => '',
        'post_id' => get_the_ID(),
    ], $atts, 'problem_01_module');

    // 投稿IDが指定されていない場合は現在の投稿IDを使用
    if (empty($atts['post_id'])) {
        $atts['post_id'] = get_the_ID();
    }

    // ACFフィールドから値を取得
    $section_title = $atts['title'] ?: get_field('problem_01_section_title', $atts['post_id']) ?: 'こんな課題はありませんか？';
    $cards = get_field('problem_01_cards', $atts['post_id']);
    $bg_color = $atts['bg_color'] ?: get_field('problem_01_bg_color', $atts['post_id']) ?: '#f8f9fa';

    // デフォルトのカードデータ（ACFデータがない場合）
    if (empty($cards)) {
        $cards = array(
            array(
                'icon' => 'fa-clock',
                'title' => '作業に追われる毎日...',
                'description' => '日々の単純作業に多くの時間を取られ、本来やるべき業務に集中できない',
            ),
            array(
                'icon' => 'fa-exclamation-triangle',
                'title' => 'ミスが心配...',
                'description' => '手作業による入力ミスやデータの取り違えが発生するリスクが常にある',
            ),
            array(
                'icon' => 'fa-user',
                'title' => '業務の属人化',
                'description' => '特定の担当者しか対応できない業務があり、引き継ぎや休暇対応に苦慮',
            ),
        );
    }

    // ユニークIDを生成（複数配置対応）
    $unique_id = 'problem_' . uniqid();

    // HTMLとCSSを出力
    ob_start();
    ?>
    
    <!-- Problem Module CSS -->
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

    .<?php echo $unique_id; ?> .problem-cards {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
        gap: 2rem;
        margin-top: 3rem;
    }

    .<?php echo $unique_id; ?> .problem-card {
        background: #fff;
        border-radius: 12px;
        padding: 2rem;
        text-align: center;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        opacity: 0;
        animation: fadeInUp 0.6s ease-out forwards;
    }

    .<?php echo $unique_id; ?> .problem-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15);
    }

    .<?php echo $unique_id; ?> .problem-icon {
        width: 80px;
        height: 80px;
        margin: 0 auto 1.5rem;
        background-color: #f0f7ff;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        position: relative;
    }

    .<?php echo $unique_id; ?> .problem-icon i {
        font-size: 2rem;
        color: #4A90E2;
    }

    .<?php echo $unique_id; ?> .problem-card h3 {
        font-size: 1.25rem;
        color: #333;
        margin-bottom: 1rem;
        font-weight: 600;
    }

    .<?php echo $unique_id; ?> .problem-card p {
        color: #666;
        line-height: 1.7;
        margin: 0;
        text-align: left;
    }

    /* アニメーション遅延 */
    .<?php echo $unique_id; ?> .problem-card:nth-child(2) {
        animation-delay: 0.2s;
    }

    .<?php echo $unique_id; ?> .problem-card:nth-child(3) {
        animation-delay: 0.4s;
    }

    .<?php echo $unique_id; ?> .problem-card:nth-child(4) {
        animation-delay: 0.6s;
    }

    .<?php echo $unique_id; ?> .problem-card:nth-child(5) {
        animation-delay: 0.8s;
    }

    .<?php echo $unique_id; ?> .problem-card:nth-child(6) {
        animation-delay: 1.0s;
    }

    /* レスポンシブ対応 */
    @media (max-width: 1020px) {
        .<?php echo $unique_id; ?> .section-title {
            font-size: 2.25rem;
        }

        .<?php echo $unique_id; ?> .problem-card h3 {
            font-size: 1.3rem;
        }

        .<?php echo $unique_id; ?> .problem-card p {
            font-size: 1rem;
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

        .<?php echo $unique_id; ?> .problem-cards {
            grid-template-columns: 1fr;
            gap: 1.5rem;
        }

        .<?php echo $unique_id; ?> .problem-card {
            padding: 1.5rem;
        }

        .<?php echo $unique_id; ?> .problem-card h3 {
            font-size: 1.25rem;
            margin: 1rem 0 0.75rem;
        }

        .<?php echo $unique_id; ?> .problem-card p {
            font-size: 0.95rem;
            line-height: 1.6;
        }
    }

    @media (max-width: 414px) {
        .<?php echo $unique_id; ?> .section-title {
            font-size: 1.75rem;
            margin-bottom: 1.75rem;
        }

        .<?php echo $unique_id; ?> .problem-cards {
            gap: 1.25rem;
        }

        .<?php echo $unique_id; ?> .problem-card {
            padding: 1.25rem;
        }

        .<?php echo $unique_id; ?> .problem-icon {
            width: 60px;
            height: 60px;
        }

        .<?php echo $unique_id; ?> .problem-icon i {
            font-size: 1.75rem;
        }

        .<?php echo $unique_id; ?> .problem-card h3 {
            font-size: 1.1rem;
            margin: 0.75rem 0 0.5rem;
        }

        .<?php echo $unique_id; ?> .problem-card p {
            font-size: 0.9rem;
            line-height: 1.6;
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

    <!-- Problem Module HTML -->
    <section class="<?php echo $unique_id; ?>">
        <div class="container">
            <h2 class="section-title"><?php echo esc_html($section_title); ?></h2>
            <div class="problem-cards">
                <?php foreach ($cards as $card): ?>
                    <div class="problem-card">
                        <div class="problem-icon">
                            <i class="fas <?php echo esc_attr($card['icon']); ?>"></i>
                        </div>
                        <h3><?php echo esc_html($card['title']); ?></h3>
                        <p><?php echo esc_html($card['description']); ?></p>
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
    error_log('Problem Module 01 (problem_01_module) loaded successfully');
} 