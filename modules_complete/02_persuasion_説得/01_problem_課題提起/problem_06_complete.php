<?php
/**
 * Problem Module 06 - Design案5（雑誌風・見開きレイアウト型）完全独立型
 * ショートコード: [problem_06_module]
 *
 * 雑誌風・見開きレイアウト型課題提起（左キャッチ・サブ、右リスト、6項目、アニメーション）
 *
 * @package Local_LP_Template_Child
 */

if (!defined('ABSPATH')) {
    exit;
}

// ACFフィールドグループ登録
if (function_exists('acf_add_local_field_group')) {
    acf_add_local_field_group(array(
        'key' => 'group_problem_06_complete',
        'title' => '課題提起モジュール06（デザイン案5雑誌風）',
        'fields' => array(
            array(
                'key' => 'field_problem_06_left_catch',
                'label' => '左キャッチコピー',
                'name' => 'problem_06_left_catch',
                'type' => 'textarea',
                'default_value' => 'あなたの現場にも、<br>こんな“壁”ありませんか？',
            ),
            array(
                'key' => 'field_problem_06_left_sub',
                'label' => '左サブテキスト',
                'name' => 'problem_06_left_sub',
                'type' => 'textarea',
                'default_value' => '現場のリアルな悩みを、<br>一度に見直してみましょう。',
            ),
            array(
                'key' => 'field_problem_06_items',
                'label' => '右リスト項目',
                'name' => 'problem_06_items',
                'type' => 'repeater',
                'sub_fields' => array(
                    array(
                        'key' => 'field_problem_06_item_title',
                        'label' => 'タイトル',
                        'name' => 'title',
                        'type' => 'text',
                    ),
                    array(
                        'key' => 'field_problem_06_item_desc',
                        'label' => '説明文',
                        'name' => 'desc',
                        'type' => 'textarea',
                    ),
                ),
                'min' => 1,
                'max' => 6,
                'button_label' => 'リスト項目を追加',
                'default_value' => array(
                    array('title'=>'時間が足りない','desc'=>'重要な業務に集中する時間が取れない'),
                    array('title'=>'効率が上がらない','desc'=>'効率化がなかなか進まない'),
                    array('title'=>'人手不足','desc'=>'一人当たりの負担が大きい'),
                    array('title'=>'システムの複雑さ','desc'=>'操作に時間がかかる'),
                    array('title'=>'ミスが多発','desc'=>'ヒューマンエラーが頻発'),
                    array('title'=>'コストの増大','desc'=>'コストがかかりすぎている'),
                ),
            ),
        ),
        'location' => get_smart_location(),
    ));
}

add_shortcode('problem_06_module', 'render_problem_06_module');

function render_problem_06_module($atts = [], $content = null) {
    $atts = shortcode_atts([
        'left_catch' => '',
        'left_sub' => '',
        'post_id' => get_the_ID(),
    ], $atts, 'problem_06_module');

    if (empty($atts['post_id'])) {
        $atts['post_id'] = get_the_ID();
    }

    $left_catch = $atts['left_catch'] ?: get_field('problem_06_left_catch', $atts['post_id']) ?: 'あなたの現場にも、<br>こんな“壁”ありませんか？';
    $left_sub = $atts['left_sub'] ?: get_field('problem_06_left_sub', $atts['post_id']) ?: '現場のリアルな悩みを、<br>一度に見直してみましょう。';
    $items = get_field('problem_06_items', $atts['post_id']);
    if (empty($items)) {
        $items = array(
            array('title'=>'時間が足りない','desc'=>'重要な業務に集中する時間が取れない'),
            array('title'=>'効率が上がらない','desc'=>'効率化がなかなか進まない'),
            array('title'=>'人手不足','desc'=>'一人当たりの負担が大きい'),
            array('title'=>'システムの複雑さ','desc'=>'操作に時間がかかる'),
            array('title'=>'ミスが多発','desc'=>'ヒューマンエラーが頻発'),
            array('title'=>'コストの増大','desc'=>'コストがかかりすぎている'),
        );
    }
    $unique_id = 'problem06_' . uniqid();
    ob_start();
    ?>
    <style>
    .<?php echo $unique_id; ?> {
        position: relative;
        background: #f7f7fa;
        padding: 100px 0 80px 0;
        overflow: hidden;
    }
    .<?php echo $unique_id; ?> .magazine-bg {
        position: absolute;
        top: 0; left: 0; right: 0; bottom: 0;
        background: repeating-linear-gradient(120deg, #e0e7ef 0 2px, transparent 2px 40px);
        opacity: 0.25;
        z-index: 0;
    }
    .<?php echo $unique_id; ?> .magazine-container {
        position: relative;
        z-index: 1;
        max-width: 1400px;
        margin: 0 auto;
        display: flex;
        gap: 60px;
        padding: 0 40px;
    }
    .<?php echo $unique_id; ?> .magazine-left {
        flex: 1 1 60%;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: flex-start;
        min-width: 260px;
    }
    .<?php echo $unique_id; ?> .magazine-catch {
        font-size: 2.6rem;
        font-weight: 800;
        color: #232526;
        line-height: 1.2;
        margin-bottom: 32px;
        letter-spacing: 0.01em;
    }
    .<?php echo $unique_id; ?> .magazine-sub {
        font-size: 1.25rem;
        color: #7b8794;
        font-weight: 500;
        line-height: 1.7;
    }
    .<?php echo $unique_id; ?> .magazine-right {
        flex: 1 1 40%;
        display: flex;
        align-items: center;
    }
    .<?php echo $unique_id; ?> .magazine-list {
        width: 100%;
        display: flex;
        flex-direction: column;
        gap: 32px;
    }
    .<?php echo $unique_id; ?> .magazine-item {
        padding-bottom: 18px;
        border-bottom: 1.5px solid #e0e7ef;
    }
    .<?php echo $unique_id; ?> .magazine-item:last-child {
        border-bottom: none;
    }
    .<?php echo $unique_id; ?> .magazine-title {
        font-size: 1.35rem;
        font-weight: 700;
        color: #232526;
        margin-bottom: 6px;
        letter-spacing: 0.01em;
    }
    .<?php echo $unique_id; ?> .magazine-desc {
        font-size: 1.05rem;
        color: #4a5568;
        font-weight: 400;
        line-height: 1.6;
    }
    @media (max-width: 900px) {
        .<?php echo $unique_id; ?> .magazine-container {
            flex-direction: column;
            gap: 36px;
            padding: 0 12px;
        }
        .<?php echo $unique_id; ?> .magazine-left, .<?php echo $unique_id; ?> .magazine-right {
            flex: 1 1 100%;
            min-width: 0;
        }
        .<?php echo $unique_id; ?> .magazine-catch {
            font-size: 1.6rem;
            margin-bottom: 18px;
        }
        .<?php echo $unique_id; ?> .magazine-sub {
            font-size: 1rem;
        }
        .<?php echo $unique_id; ?> .magazine-list {
            gap: 18px;
        }
        .<?php echo $unique_id; ?> .magazine-title {
            font-size: 1.1rem;
        }
        .<?php echo $unique_id; ?> .magazine-desc {
            font-size: 0.95rem;
        }
    }
    @media (max-width: 600px) {
        .<?php echo $unique_id; ?> {
            padding: 48px 0 32px 0;
        }
        .<?php echo $unique_id; ?> .magazine-catch {
            font-size: 1.1rem;
        }
        .<?php echo $unique_id; ?> .magazine-sub {
            font-size: 0.9rem;
        }
        .<?php echo $unique_id; ?> .magazine-title {
            font-size: 0.98rem;
        }
        .<?php echo $unique_id; ?> .magazine-desc {
            font-size: 0.82rem;
        }
    }
    </style>
    <section class="<?php echo $unique_id; ?>">
        <div class="magazine-bg"></div>
        <div class="magazine-container">
            <div class="magazine-left">
                <h2 class="magazine-catch"><?php echo $left_catch; ?></h2>
                <div class="magazine-sub"><?php echo $left_sub; ?></div>
            </div>
            <div class="magazine-right">
                <div class="magazine-list">
                    <?php foreach ($items as $item): ?>
                        <div class="magazine-item">
                            <div class="magazine-title"><?php echo esc_html($item['title']); ?></div>
                            <div class="magazine-desc"><?php echo esc_html($item['desc']); ?></div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </section>
    <?php
    return ob_get_clean();
} 