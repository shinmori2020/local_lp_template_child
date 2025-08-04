<?php
/**
 * Problem Module 05 - Design案4（写真＋キャプション型グリッド）完全独立型
 * ショートコード: [problem_05_module]
 *
 * 写真＋キャプション型グリッド課題提起（6項目、写真URL、キャッチ、説明、グリッド、アニメーション）
 *
 * @package Local_LP_Template_Child
 */

if (!defined('ABSPATH')) {
    exit;
}

// ACFフィールドグループ登録
if (function_exists('acf_add_local_field_group')) {
    acf_add_local_field_group(array(
        'key' => 'group_problem_05_complete',
        'title' => '課題提起モジュール05（デザイン案4写真グリッド）',
        'fields' => array(
            array(
                'key' => 'field_problem_05_items',
                'label' => '写真課題項目',
                'name' => 'problem_05_items',
                'type' => 'repeater',
                'sub_fields' => array(
                    array(
                        'key' => 'field_problem_05_item_img',
                        'label' => '写真URL',
                        'name' => 'img',
                        'type' => 'text',
                        'default_value' => '',
                    ),
                    array(
                        'key' => 'field_problem_05_item_catch',
                        'label' => 'キャッチコピー',
                        'name' => 'catch',
                        'type' => 'text',
                    ),
                    array(
                        'key' => 'field_problem_05_item_desc',
                        'label' => '説明文',
                        'name' => 'desc',
                        'type' => 'textarea',
                    ),
                ),
                'min' => 1,
                'max' => 6,
                'button_label' => '写真課題項目を追加',
                'default_value' => array(
                    array('img'=>'https://images.unsplash.com/photo-1519125323398-675f0ddb6308?auto=format&fit=crop&w=600&q=80','catch'=>'時間が足りない','desc'=>'毎日忙しくて、重要な業務に集中する時間が取れない'),
                    array('img'=>'https://images.unsplash.com/photo-1465101046530-73398c7f28ca?auto=format&fit=crop&w=600&q=80','catch'=>'効率が上がらない','desc'=>'同じ作業を繰り返しているのに、なかなか効率化が進まない'),
                    array('img'=>'https://images.unsplash.com/photo-1506744038136-46273834b3fb?auto=format&fit=crop&w=600&q=80','catch'=>'人手不足','desc'=>'チーム全体のリソースが不足しており、一人当たりの負担が大きい'),
                    array('img'=>'https://images.unsplash.com/photo-1515378791036-0648a3ef77b2?auto=format&fit=crop&w=600&q=80','catch'=>'システムの複雑さ','desc'=>'現在使用しているシステムが複雑で、操作に時間がかかる'),
                    array('img'=>'https://images.unsplash.com/photo-1464983953574-0892a716854b?auto=format&fit=crop&w=600&q=80','catch'=>'ミスが多発','desc'=>'手作業が多く、ヒューマンエラーによる問題が頻発'),
                    array('img'=>'https://images.unsplash.com/photo-1465101178521-c1a9136a3c8b?auto=format&fit=crop&w=600&q=80','catch'=>'コストの増大','desc'=>'非効率な業務により、必要以上にコストがかかっている'),
                ),
            ),
        ),
        'location' => get_smart_location(),
    ));
}

add_shortcode('problem_05_module', 'render_problem_05_module');

function render_problem_05_module($atts = [], $content = null) {
    $atts = shortcode_atts([
        'post_id' => get_the_ID(),
    ], $atts, 'problem_05_module');

    if (empty($atts['post_id'])) {
        $atts['post_id'] = get_the_ID();
    }

    $items = get_field('problem_05_items', $atts['post_id']);
    if (empty($items)) {
        $items = array(
            array('img'=>'https://images.unsplash.com/photo-1519125323398-675f0ddb6308?auto=format&fit=crop&w=600&q=80','catch'=>'時間が足りない','desc'=>'毎日忙しくて、重要な業務に集中する時間が取れない'),
            array('img'=>'https://images.unsplash.com/photo-1465101046530-73398c7f28ca?auto=format&fit=crop&w=600&q=80','catch'=>'効率が上がらない','desc'=>'同じ作業を繰り返しているのに、なかなか効率化が進まない'),
            array('img'=>'https://images.unsplash.com/photo-1506744038136-46273834b3fb?auto=format&fit=crop&w=600&q=80','catch'=>'人手不足','desc'=>'チーム全体のリソースが不足しており、一人当たりの負担が大きい'),
            array('img'=>'https://images.unsplash.com/photo-1515378791036-0648a3ef77b2?auto=format&fit=crop&w=600&q=80','catch'=>'システムの複雑さ','desc'=>'現在使用しているシステムが複雑で、操作に時間がかかる'),
            array('img'=>'https://images.unsplash.com/photo-1464983953574-0892a716854b?auto=format&fit=crop&w=600&q=80','catch'=>'ミスが多発','desc'=>'手作業が多く、ヒューマンエラーによる問題が頻発'),
            array('img'=>'https://images.unsplash.com/photo-1465101178521-c1a9136a3c8b?auto=format&fit=crop&w=600&q=80','catch'=>'コストの増大','desc'=>'非効率な業務により、必要以上にコストがかかっている'),
        );
    }
    $unique_id = 'problem05_' . uniqid();
    ob_start();
    ?>
    <style>
    .<?php echo $unique_id; ?> {
        background: linear-gradient(120deg, #232526 0%, #414345 100%);
        padding: 90px 0 70px 0;
    }
    .<?php echo $unique_id; ?> .photo-grid-container {
        max-width: 1100px;
        margin: 0 auto;
        padding: 0 20px;
    }
    .<?php echo $unique_id; ?> .photo-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 36px 32px;
        overflow: visible;
    }
    .<?php echo $unique_id; ?> .photo-grid-item {
        background: #18191a;
        border-radius: 18px;
        box-shadow: 0 6px 24px rgba(0,0,0,0.13);
        overflow: hidden;
        display: flex;
        flex-direction: column;
        transition: box-shadow 0.2s;
    }
    .<?php echo $unique_id; ?> .photo-grid-item:hover {
        box-shadow: 0 16px 40px rgba(60, 72, 88, 0.22);
    }
    .<?php echo $unique_id; ?> .photo-grid-img {
        width: 100%;
        height: 220px;
        background-size: cover;
        background-position: center;
        transition: filter 0.3s, transform 0.3s;
    }
    .<?php echo $unique_id; ?> .photo-grid-item:hover .photo-grid-img {
        filter: brightness(1.15) saturate(1.1);
        transform: scale(1.08);
        z-index: 2;
    }
    .<?php echo $unique_id; ?> .photo-grid-caption {
        background: rgba(0,0,0,0.55);
        color: #fff;
        padding: 22px 18px 16px 18px;
        text-align: left;
        border-radius: 0 0 18px 18px;
    }
    .<?php echo $unique_id; ?> .photo-grid-catch {
        font-size: 1.15rem;
        font-weight: 600;
        margin-bottom: 8px;
        letter-spacing: 0.03em;
        text-align: left;
    }
    .<?php echo $unique_id; ?> .photo-grid-desc {
        font-size: 0.98rem;
        font-weight: 400;
        opacity: 0.92;
        text-align: left;
    }
    @media (max-width: 900px) {
        .<?php echo $unique_id; ?> .photo-grid {
            grid-template-columns: repeat(2, 1fr);
            gap: 24px 16px;
        }
        .<?php echo $unique_id; ?> .photo-grid-img {
            height: 160px;
        }
    }
    @media (max-width: 600px) {
        .<?php echo $unique_id; ?> .photo-grid {
            grid-template-columns: 1fr;
            gap: 16px;
        }
        .<?php echo $unique_id; ?> .photo-grid-img {
            height: 120px;
        }
    }
    </style>
    <section class="<?php echo $unique_id; ?>">
        <div class="photo-grid-container">
            <div class="photo-grid">
                <?php foreach ($items as $item): ?>
                    <div class="photo-grid-item">
                        <div class="photo-grid-img" style="background-image: url('<?php echo esc_url($item['img']); ?>');"></div>
                        <div class="photo-grid-caption">
                            <div class="photo-grid-catch"><?php echo esc_html($item['catch']); ?></div>
                            <div class="photo-grid-desc"><?php echo esc_html($item['desc']); ?></div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>
    <?php
    return ob_get_clean();
} 