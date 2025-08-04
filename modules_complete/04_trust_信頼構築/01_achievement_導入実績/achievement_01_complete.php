<?php
/**
 * Achievement Module 01 - Complete Independent Version
 * ショートコード: [achievement_01_module]
 * 
 * 導入企業の具体的な成果・実績を事例形式で表示するモジュール
 * 統計データ付きカード、ホバーエフェクト、アニメーション付き
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
        'key' => 'group_achievement_01_complete',
        'title' => '導入実績モジュール01設定',
        'fields' => array(
            array(
                'key' => 'field_achievement_01_section_title',
                'label' => 'セクションタイトル',
                'name' => 'achievement_01_section_title',
                'type' => 'text',
                'default_value' => '導入企業様の具体的な成果',
                'instructions' => 'セクションのメインタイトルを入力',
            ),
            array(
                'key' => 'field_achievement_01_cases',
                'label' => '実績事例',
                'name' => 'achievement_01_cases',
                'type' => 'repeater',
                'sub_fields' => array(
                    array(
                        'key' => 'field_achievement_case_icon',
                        'label' => 'アイコン（Font Awesome）',
                        'name' => 'icon',
                        'type' => 'text',
                        'instructions' => 'Font Awesomeクラス名（例: fa-chart-line, fa-check-circle, fa-users）',
                        'default_value' => 'fa-chart-line',
                    ),
                    array(
                        'key' => 'field_achievement_case_title',
                        'label' => '事例タイトル',
                        'name' => 'title',
                        'type' => 'text',
                        'instructions' => '企業名・事例のタイトル',
                    ),
                    array(
                        'key' => 'field_achievement_case_description',
                        'label' => '事例説明',
                        'name' => 'description',
                        'type' => 'textarea',
                        'instructions' => '導入事例の詳細説明',
                    ),
                    array(
                        'key' => 'field_achievement_case_stats',
                        'label' => '統計データ',
                        'name' => 'stats',
                        'type' => 'repeater',
                        'sub_fields' => array(
                            array(
                                'key' => 'field_stat_number',
                                'label' => '数値',
                                'name' => 'number',
                                'type' => 'text',
                                'instructions' => '数値と単位（例: 73%, 25時間/月, 100%）',
                            ),
                            array(
                                'key' => 'field_stat_label',
                                'label' => 'ラベル',
                                'name' => 'label',
                                'type' => 'text',
                                'instructions' => '数値の説明（例: 作業時間削減、満足度）',
                            ),
                        ),
                        'min' => 1,
                        'max' => 3,
                        'button_label' => '統計データを追加',
                        'default_value' => array(
                            array(
                                'number' => '73%',
                                'label' => '作業時間削減',
                            ),
                            array(
                                'number' => '25時間/月',
                                'label' => '残業時間削減',
                            ),
                        ),
                    ),
                ),
                'min' => 1,
                'max' => 6,
                'button_label' => '実績事例を追加',
                'default_value' => array(
                    array(
                        'icon' => 'fa-chart-line',
                        'title' => '大手製造業A社様の事例',
                        'description' => '月次決算業務の自動化により、作業時間を大幅に削減。担当者の残業時間削減と、より戦略的な業務への時間シフトを実現しました。',
                        'stats' => array(
                            array('number' => '73%', 'label' => '作業時間削減'),
                            array('number' => '25時間/月', 'label' => '残業時間削減'),
                        ),
                    ),
                    array(
                        'icon' => 'fa-check-circle',
                        'title' => '中堅商社B社様の事例',
                        'description' => '受発注業務の自動化により、データ入力ミスを完全に排除。顧客満足度の向上と業務効率化を同時に達成しました。',
                        'stats' => array(
                            array('number' => '100%', 'label' => '入力ミス削減'),
                            array('number' => '98%', 'label' => '顧客満足度'),
                        ),
                    ),
                    array(
                        'icon' => 'fa-users',
                        'title' => 'サービス業C社様の事例',
                        'description' => '社内の申請承認フローを完全デジタル化。場所や時間に縛られない柔軟な働き方を実現し、業務効率が大幅に向上しました。',
                        'stats' => array(
                            array('number' => '45%', 'label' => '処理時間短縮'),
                            array('number' => '3日→1時間', 'label' => '承認時間短縮'),
                        ),
                    ),
                    array(
                        'icon' => 'fa-rocket',
                        'title' => 'IT企業D社様の事例',
                        'description' => '人事評価プロセスのデジタル化により、評価の公平性と透明性が向上。社員のモチベーション向上にも貢献しています。',
                        'stats' => array(
                            array('number' => '89%', 'label' => '社員満足度'),
                            array('number' => '60%', 'label' => '工数削減'),
                        ),
                    ),
                ),
            ),
            array(
                'key' => 'field_achievement_01_bg_color',
                'label' => '背景色',
                'name' => 'achievement_01_bg_color',
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
add_shortcode('achievement_01_module', 'render_achievement_01_module');

/**
 * Achievement Module HTML出力関数
 */
function render_achievement_01_module($atts = [], $content = null) {
    // ショートコード属性のデフォルト値
    $atts = shortcode_atts([
        'title' => '',
        'bg_color' => '',
        'post_id' => get_the_ID(),
    ], $atts, 'achievement_01_module');

    // 投稿IDが指定されていない場合は現在の投稿IDを使用
    if (empty($atts['post_id'])) {
        $atts['post_id'] = get_the_ID();
    }

    // ACFフィールドから値を取得
    $section_title = $atts['title'] ?: get_field('achievement_01_section_title', $atts['post_id']) ?: '導入企業様の具体的な成果';
    $cases = get_field('achievement_01_cases', $atts['post_id']);
    $bg_color = $atts['bg_color'] ?: get_field('achievement_01_bg_color', $atts['post_id']) ?: '#f8f9fa';

    // デフォルトの事例データ（ACFデータがない場合）
    if (empty($cases)) {
        $cases = array(
            array(
                'icon' => 'fa-chart-line',
                'title' => '大手製造業A社様の事例',
                'description' => '月次決算業務の自動化により、作業時間を大幅に削減。担当者の残業時間削減と、より戦略的な業務への時間シフトを実現しました。',
                'stats' => array(
                    array('number' => '73%', 'label' => '作業時間削減'),
                    array('number' => '25時間/月', 'label' => '残業時間削減'),
                ),
            ),
            array(
                'icon' => 'fa-check-circle',
                'title' => '中堅商社B社様の事例',
                'description' => '受発注業務の自動化により、データ入力ミスを完全に排除。顧客満足度の向上と業務効率化を同時に達成しました。',
                'stats' => array(
                    array('number' => '100%', 'label' => '入力ミス削減'),
                    array('number' => '98%', 'label' => '顧客満足度'),
                ),
            ),
            array(
                'icon' => 'fa-users',
                'title' => 'サービス業C社様の事例',
                'description' => '社内の申請承認フローを完全デジタル化。場所や時間に縛られない柔軟な働き方を実現し、業務効率が大幅に向上しました。',
                'stats' => array(
                    array('number' => '45%', 'label' => '処理時間短縮'),
                    array('number' => '3日→1時間', 'label' => '承認時間短縮'),
                ),
            ),
            array(
                'icon' => 'fa-rocket',
                'title' => 'IT企業D社様の事例',
                'description' => '人事評価プロセスのデジタル化により、評価の公平性と透明性が向上。社員のモチベーション向上にも貢献しています。',
                'stats' => array(
                    array('number' => '89%', 'label' => '社員満足度'),
                    array('number' => '60%', 'label' => '工数削減'),
                ),
            ),
        );
    }

    // 数値からHTMLエンティティを分離する関数
    function format_stat_number($number) {
        // %、時間、→などの記号をsmallタグで囲む
        $formatted = preg_replace('/([%％]|時間\/月|時間|日|→)/', '<small>$1</small>', $number);
        return $formatted;
    }

    // ユニークIDを生成（複数配置対応）
    $unique_id = 'achievement_' . uniqid();

    // HTMLとCSSを出力
    ob_start();
    ?>
    
    <!-- Achievement Module CSS -->
    <style>
    .<?php echo $unique_id; ?> {
        padding: 5rem 0;
        background: linear-gradient(135deg, <?php echo esc_attr($bg_color); ?> 0%, #e9ecef 100%);
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

    .<?php echo $unique_id; ?> .achievement-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(400px, 1fr));
        gap: 2rem;
        margin-top: 3rem;
    }

    .<?php echo $unique_id; ?> .achievement-item {
        background: white;
        border-radius: 15px;
        padding: 2.5rem;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.05);
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        opacity: 0;
        animation: fadeInUp 0.6s ease-out forwards;
    }

    .<?php echo $unique_id; ?> .achievement-item:nth-child(2) {
        animation-delay: 0.2s;
    }

    .<?php echo $unique_id; ?> .achievement-item:nth-child(3) {
        animation-delay: 0.4s;
    }

    .<?php echo $unique_id; ?> .achievement-item:nth-child(4) {
        animation-delay: 0.6s;
    }

    .<?php echo $unique_id; ?> .achievement-item:nth-child(5) {
        animation-delay: 0.8s;
    }

    .<?php echo $unique_id; ?> .achievement-item:nth-child(6) {
        animation-delay: 1.0s;
    }

    .<?php echo $unique_id; ?> .achievement-item:hover {
        transform: translateY(-5px);
        box-shadow: 0 15px 40px rgba(0, 0, 0, 0.1);
    }

    .<?php echo $unique_id; ?> .achievement-title {
        display: flex;
        align-items: center;
        gap: 1rem;
        font-size: 1.5rem;
        color: #333;
        margin-bottom: 1rem;
        font-weight: 600;
        line-height: 1.3;
    }

    .<?php echo $unique_id; ?> .achievement-icon {
        flex-shrink: 0;
        width: 50px;
        height: 50px;
        background: #f0f7ff;
        border-radius: 15px;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .<?php echo $unique_id; ?> .achievement-icon i {
        font-size: 1.5rem;
        color: #4A90E2;
    }

    .<?php echo $unique_id; ?> .achievement-description {
        color: #666;
        line-height: 1.7;
        margin-bottom: 1.5rem;
        font-size: 1rem;
    }

    .<?php echo $unique_id; ?> .achievement-stats {
        display: flex;
        gap: 2rem;
        padding-top: 1rem;
        border-top: 1px solid #eee;
        text-align: center;
    }

    .<?php echo $unique_id; ?> .stat-item {
        flex: 1;
        text-align: center;
    }

    .<?php echo $unique_id; ?> .stat-number {
        font-size: 2rem;
        font-weight: 700;
        color: #4A90E2;
        margin-bottom: 0.5rem;
        display: flex;
        align-items: baseline;
        justify-content: center;
        line-height: 1;
    }

    .<?php echo $unique_id; ?> .stat-number small {
        font-size: 1rem;
        margin-left: 0.25rem;
        font-weight: 500;
    }

    .<?php echo $unique_id; ?> .stat-label {
        font-size: 0.9rem;
        color: #666;
        text-align: center;
        line-height: 1.3;
    }

    /* レスポンシブ対応 */
    @media (max-width: 1020px) and (min-width: 768px) {
        .<?php echo $unique_id; ?> .achievement-item {
            padding: 2rem;
        }

        .<?php echo $unique_id; ?> .achievement-title {
            font-size: 1.25rem;
        }

        .<?php echo $unique_id; ?> .achievement-grid {
            grid-template-columns: repeat(auto-fit, minmax(350px, 1fr));
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

        .<?php echo $unique_id; ?> .achievement-grid {
            grid-template-columns: 1fr;
            gap: 1.5rem;
        }

        .<?php echo $unique_id; ?> .achievement-item {
            padding: 1.5rem;
        }

        .<?php echo $unique_id; ?> .achievement-title {
            font-size: 1.25rem;
        }

        .<?php echo $unique_id; ?> .achievement-stats {
            flex-direction: row;
            justify-content: space-between;
            gap: 1rem;
            text-align: center;
        }

        .<?php echo $unique_id; ?> .stat-item {
            text-align: center;
            flex: 0 0 calc(50% - 0.5rem);
        }

        .<?php echo $unique_id; ?> .stat-number {
            font-size: 1.75rem;
            justify-content: center;
        }

        .<?php echo $unique_id; ?> .stat-label {
            text-align: center;
        }
    }

    @media (max-width: 414px) {
        .<?php echo $unique_id; ?> .section-title {
            font-size: 1.75rem;
            margin-bottom: 1.75rem;
        }

        .<?php echo $unique_id; ?> .achievement-grid {
            gap: 1.25rem;
        }

        .<?php echo $unique_id; ?> .achievement-item {
            padding: 1.25rem;
        }

        .<?php echo $unique_id; ?> .achievement-title {
            flex-direction: column;
            align-items: center;
            text-align: center;
            font-size: 1.1rem;
            gap: 0.75rem;
        }

        .<?php echo $unique_id; ?> .achievement-icon {
            margin-bottom: 0.75rem;
            width: 60px;
            height: 60px;
        }

        .<?php echo $unique_id; ?> .achievement-icon i {
            font-size: 1.75rem;
        }

        .<?php echo $unique_id; ?> .achievement-description {
            font-size: 0.9rem;
            line-height: 1.6;
            margin-bottom: 1.25rem;
            text-align: left;
        }

        .<?php echo $unique_id; ?> .achievement-stats {
            padding-top: 0.75rem;
        }

        .<?php echo $unique_id; ?> .stat-number {
            font-size: 1.5rem;
        }

        .<?php echo $unique_id; ?> .stat-number small {
            font-size: 0.85rem;
        }

        .<?php echo $unique_id; ?> .stat-label {
            font-size: 0.8rem;
        }
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
    </style>

    <!-- Achievement Module HTML -->
    <section class="<?php echo $unique_id; ?>">
        <div class="container">
            <h2 class="section-title"><?php echo esc_html($section_title); ?></h2>
            <div class="achievement-grid">
                <?php foreach ($cases as $case): ?>
                    <div class="achievement-item">
                        <div class="achievement-content">
                            <h3 class="achievement-title">
                                <div class="achievement-icon">
                                    <i class="fas <?php echo esc_attr($case['icon']); ?>"></i>
                                </div>
                                <?php echo esc_html($case['title']); ?>
                            </h3>
                            <p class="achievement-description"><?php echo esc_html($case['description']); ?></p>
                            <?php if (!empty($case['stats'])): ?>
                                <div class="achievement-stats">
                                    <?php foreach ($case['stats'] as $stat): ?>
                                        <div class="stat-item">
                                            <div class="stat-number"><?php echo format_stat_number(esc_html($stat['number'])); ?></div>
                                            <div class="stat-label"><?php echo esc_html($stat['label']); ?></div>
                                        </div>
                                    <?php endforeach; ?>
                                </div>
                            <?php endif; ?>
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
    error_log('Achievement Module 01 (achievement_01_module) loaded successfully');
} 