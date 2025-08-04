<?php
/**
 * Problem Module 03 - Design案2（タイムライン型）完全独立型
 * ショートコード: [problem_03_module]
 *
 * タイムライン型課題提起（6ステップ、サブタイトル、フッター、アニメーション）
 *
 * @package Local_LP_Template_Child
 */

if (!defined('ABSPATH')) {
    exit;
}

// ACFフィールドグループ登録
if (function_exists('acf_add_local_field_group')) {
    acf_add_local_field_group(array(
        'key' => 'group_problem_03_complete',
        'title' => '課題提起モジュール03（デザイン案2タイムライン）',
        'fields' => array(
            array(
                'key' => 'field_problem_03_section_title',
                'label' => 'セクションタイトル',
                'name' => 'problem_03_section_title',
                'type' => 'text',
                'default_value' => '問題の連鎖が始まっています',
            ),
            array(
                'key' => 'field_problem_03_section_subtitle',
                'label' => 'サブタイトル',
                'name' => 'problem_03_section_subtitle',
                'type' => 'text',
                'default_value' => '一つの問題が次の問題を引き起こし、悪循環が続く...',
            ),
            array(
                'key' => 'field_problem_03_timeline',
                'label' => 'タイムライン項目',
                'name' => 'problem_03_timeline',
                'type' => 'repeater',
                'sub_fields' => array(
                    array(
                        'key' => 'field_problem_03_step_icon',
                        'label' => 'アイコン（Font Awesome）',
                        'name' => 'icon',
                        'type' => 'text',
                        'default_value' => 'fa-clock',
                    ),
                    array(
                        'key' => 'field_problem_03_step_title',
                        'label' => 'タイトル',
                        'name' => 'title',
                        'type' => 'text',
                    ),
                    array(
                        'key' => 'field_problem_03_step_text',
                        'label' => '説明文',
                        'name' => 'text',
                        'type' => 'textarea',
                    ),
                ),
                'min' => 1,
                'max' => 6,
                'button_label' => 'タイムライン項目を追加',
                'default_value' => array(
                    array('icon'=>'fa-clock','title'=>'時間が足りない','text'=>'毎日忙しくて、重要な業務に集中する時間が取れない状況が続いている'),
                    array('icon'=>'fa-chart-line','title'=>'効率が上がらない','text'=>'同じ作業を繰り返しているのに、なかなか効率化が進まない'),
                    array('icon'=>'fa-users','title'=>'人手不足','text'=>'チーム全体のリソースが不足しており、一人当たりの負担が大きすぎる'),
                    array('icon'=>'fa-cog','title'=>'システムの複雑さ','text'=>'現在使用しているシステムが複雑で、操作に時間がかかってしまう'),
                    array('icon'=>'fa-exclamation-triangle','title'=>'ミスが多発','text'=>'手作業が多く、ヒューマンエラーによる問題が頻繁に発生している'),
                    array('icon'=>'fa-money-bill-wave','title'=>'コストの増大','text'=>'非効率な業務により、必要以上にコストがかかっている状況'),
                ),
            ),
            array(
                'key' => 'field_problem_03_footer_text',
                'label' => 'フッターテキスト',
                'name' => 'problem_03_footer_text',
                'type' => 'text',
                'default_value' => 'この悪循環を断ち切る方法があります',
            ),
            array(
                'key' => 'field_problem_03_footer_arrow_text',
                'label' => 'フッター矢印テキスト',
                'name' => 'problem_03_footer_arrow_text',
                'type' => 'text',
                'default_value' => '解決策へ',
            ),
            array(
                'key' => 'field_problem_03_bg_color',
                'label' => '背景色',
                'name' => 'problem_03_bg_color',
                'type' => 'color_picker',
                'default_value' => '#ff9a56',
            ),
        ),
        'location' => get_smart_location(),
    ));
}

add_shortcode('problem_03_module', 'render_problem_03_module');

function render_problem_03_module($atts = [], $content = null) {
    $atts = shortcode_atts([
        'title' => '',
        'subtitle' => '',
        'footer' => '',
        'footer_arrow' => '',
        'bg_color' => '',
        'post_id' => get_the_ID(),
    ], $atts, 'problem_03_module');

    if (empty($atts['post_id'])) {
        $atts['post_id'] = get_the_ID();
    }

    $section_title = $atts['title'] ?: get_field('problem_03_section_title', $atts['post_id']) ?: '問題の連鎖が始まっています';
    $section_subtitle = $atts['subtitle'] ?: get_field('problem_03_section_subtitle', $atts['post_id']) ?: '一つの問題が次の問題を引き起こし、悪循環が続く...';
    $timeline = get_field('problem_03_timeline', $atts['post_id']);
    $footer_text = $atts['footer'] ?: get_field('problem_03_footer_text', $atts['post_id']) ?: 'この悪循環を断ち切る方法があります';
    $footer_arrow_text = $atts['footer_arrow'] ?: get_field('problem_03_footer_arrow_text', $atts['post_id']) ?: '解決策へ';
    $bg_color = $atts['bg_color'] ?: get_field('problem_03_bg_color', $atts['post_id']) ?: '#ff9a56';

    if (empty($timeline)) {
        $timeline = array(
            array('icon'=>'fa-clock','title'=>'時間が足りない','text'=>'毎日忙しくて、重要な業務に集中する時間が取れない状況が続いている'),
            array('icon'=>'fa-chart-line','title'=>'効率が上がらない','text'=>'同じ作業を繰り返しているのに、なかなか効率化が進まない'),
            array('icon'=>'fa-users','title'=>'人手不足','text'=>'チーム全体のリソースが不足しており、一人当たりの負担が大きすぎる'),
            array('icon'=>'fa-cog','title'=>'システムの複雑さ','text'=>'現在使用しているシステムが複雑で、操作に時間がかかってしまう'),
            array('icon'=>'fa-exclamation-triangle','title'=>'ミスが多発','text'=>'手作業が多く、ヒューマンエラーによる問題が頻繁に発生している'),
            array('icon'=>'fa-money-bill-wave','title'=>'コストの増大','text'=>'非効率な業務により、必要以上にコストがかかっている状況'),
        );
    }

    $unique_id = 'problem03_' . uniqid();
    ob_start();
    ?>
    <style>
    .<?php echo $unique_id; ?> {
        background: linear-gradient(135deg, #ff9a56 0%, #ff6b6b 50%, #ee5a24 100%);
        padding: 100px 0;
        position: relative;
        overflow: hidden;
    }
    .<?php echo $unique_id; ?> .timeline-container {
        max-width: 1000px;
        margin: 0 auto;
        padding: 0 20px;
        position: relative;
        z-index: 1;
    }
    .<?php echo $unique_id; ?> .timeline-header {
        text-align: center;
        margin-bottom: 80px;
    }
    .<?php echo $unique_id; ?> .timeline-title {
        font-size: 3rem;
        font-weight: 800;
        color: white;
        margin-bottom: 16px;
        line-height: 1.2;
        text-shadow: 0 2px 4px rgba(0, 0, 0, 0.3);
    }
    .<?php echo $unique_id; ?> .timeline-subtitle {
        font-size: 1.3rem;
        color: rgba(255, 255, 255, 0.9);
        line-height: 1.5;
    }
    .<?php echo $unique_id; ?> .timeline-wrapper {
        position: relative;
        padding: 40px 0;
    }
    .<?php echo $unique_id; ?> .timeline-line {
        position: absolute;
        left: 50%;
        top: 0;
        bottom: 0;
        width: 4px;
        background: linear-gradient(180deg, transparent 0%, white 20%, white 80%, transparent 100%);
        transform: translateX(-50%);
        opacity: 0.8;
    }
    .<?php echo $unique_id; ?> .timeline-item {
        position: relative;
        margin-bottom: 80px;
        opacity: 0;
        transform: translateY(50px);
        transition: all 0.8s cubic-bezier(0.4, 0, 0.2, 1);
    }
    .<?php echo $unique_id; ?> .timeline-item.animate {
        opacity: 1;
        transform: translateY(0);
    }
    .<?php echo $unique_id; ?> .timeline-item.left {
        margin-right: 50%;
        padding-right: 60px;
    }
    .<?php echo $unique_id; ?> .timeline-item.right {
        margin-left: 50%;
        padding-left: 60px;
    }
    .<?php echo $unique_id; ?> .timeline-content {
        background: rgba(255, 255, 255, 0.95);
        padding: 30px;
        border-radius: 20px;
        box-shadow: 0 15px 35px rgba(0, 0, 0, 0.2);
        position: relative;
        backdrop-filter: blur(10px);
        border: 2px solid rgba(255, 255, 255, 0.3);
    }
    .<?php echo $unique_id; ?> .step-number {
        position: absolute;
        top: -32px;
        right: -32px;
        width: 64px;
        height: 64px;
        background: linear-gradient(135deg, #ff6b6b, #ee5a24);
        color: white;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: 400;
        font-size: 2rem;
        box-shadow: 0 6px 18px rgba(238, 90, 36, 0.25);
        border: 4px solid #fff3e0;
        z-index: 3;
        transition: all 0.2s;
    }
    .<?php echo $unique_id; ?> .problem-icon-timeline {
        width: 60px;
        height: 60px;
        background: linear-gradient(135deg, #ff6b6b, #ee5a24);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-bottom: 20px;
        position: relative;
        overflow: hidden;
    }
    .<?php echo $unique_id; ?> .problem-icon-timeline::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.5), transparent);
        border-radius: 50%;
        transition: left 0.6s ease;
    }
    .<?php echo $unique_id; ?> .timeline-content:hover .problem-icon-timeline::before {
        left: 100%;
    }
    .<?php echo $unique_id; ?> .problem-icon-timeline i {
        font-size: 1.5rem;
        color: white;
        z-index: 1;
        position: relative;
    }
    .<?php echo $unique_id; ?> .timeline-problem-title {
        font-size: 1.4rem;
        font-weight: 700;
        color: #2d3748;
        margin-bottom: 12px;
        line-height: 1.3;
    }
    .<?php echo $unique_id; ?> .timeline-problem-text {
        font-size: 1rem;
        color: #4a5568;
        line-height: 1.6;
        margin-bottom: 20px;
    }
    .<?php echo $unique_id; ?> .timeline-arrow-right,
    .<?php echo $unique_id; ?> .timeline-arrow-left {
        position: absolute;
        top: 50%;
        transform: translateY(-50%);
        font-size: 1.4rem;
        color: white;
        text-shadow: 0 2px 4px rgba(0, 0, 0, 0.3);
        animation: pulse-arrow 2s infinite;
        z-index: 2;
    }
    .<?php echo $unique_id; ?> .timeline-arrow-right {
        right: -45px;
    }
    .<?php echo $unique_id; ?> .timeline-arrow-left {
        left: -45px;
    }
    .<?php echo $unique_id; ?> .timeline-footer {
        text-align: center;
        margin-top: 60px;
    }
    .<?php echo $unique_id; ?> .timeline-warning {
        display: inline-flex;
        align-items: center;
        gap: 12px;
        background: rgba(255, 255, 255, 0.2);
        padding: 16px 30px;
        border-radius: 50px;
        color: white;
        font-size: 1.2rem;
        font-weight: 600;
        margin-bottom: 30px;
        backdrop-filter: blur(10px);
        border: 1px solid rgba(255, 255, 255, 0.3);
    }
    .<?php echo $unique_id; ?> .timeline-warning i {
        font-size: 1.3rem;
        color: #ffd700;
    }
    .<?php echo $unique_id; ?> .timeline-warning strong {
        color: #ffd700;
    }
    .<?php echo $unique_id; ?> .timeline-solution-arrow {
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 8px;
        color: white;
        font-size: 1.5rem;
        animation: bounce-timeline 2s infinite;
    }
    .<?php echo $unique_id; ?> .timeline-solution-arrow span {
        font-size: 1rem;
        font-weight: 600;
    }
    @keyframes pulse-arrow {
        0%, 100% { opacity: 0.6; transform: translateY(-50%) scale(1); }
        50% { opacity: 1; transform: translateY(-50%) scale(1.1); }
    }
    @keyframes bounce-timeline {
        0%, 20%, 50%, 80%, 100% { transform: translateY(0); }
        40% { transform: translateY(-10px); }
        60% { transform: translateY(-5px); }
    }
    @media (max-width: 768px) {
        .<?php echo $unique_id; ?> {
            padding: 60px 0;
        }
        .<?php echo $unique_id; ?> .timeline-container {
            padding: 0 15px;
        }
        .<?php echo $unique_id; ?> .timeline-title {
            font-size: 2.2rem;
        }
        .<?php echo $unique_id; ?> .timeline-subtitle {
            font-size: 1.1rem;
        }
        .<?php echo $unique_id; ?> .timeline-line {
            left: 30px;
        }
        .<?php echo $unique_id; ?> .timeline-item.left,
        .<?php echo $unique_id; ?> .timeline-item.right {
            margin-left: 0;
            margin-right: 0;
            padding-left: 80px;
            padding-right: 20px;
        }
        .<?php echo $unique_id; ?> .timeline-arrow-right,
        .<?php echo $unique_id; ?> .timeline-arrow-left {
            display: none;
        }
        .<?php echo $unique_id; ?> .timeline-content {
            padding: 24px 20px;
        }
        .<?php echo $unique_id; ?> .step-number {
            top: -24px;
            right: -24px;
            width: 48px;
            height: 48px;
            font-size: 1.3rem;
            border-width: 3px;
        }
        .<?php echo $unique_id; ?> .timeline-item {
            margin-bottom: 50px;
        }
    }
    @media (max-width: 480px) {
        .<?php echo $unique_id; ?> .timeline-title {
            font-size: 1.8rem;
        }
        .<?php echo $unique_id; ?> .timeline-content {
            padding: 20px 16px;
        }
        .<?php echo $unique_id; ?> .step-number {
            top: -16px;
            right: -16px;
            width: 36px;
            height: 36px;
            font-size: 1rem;
            border-width: 2px;
        }
    }
    </style>
    <section class="<?php echo $unique_id; ?>">
        <div class="timeline-container">
            <div class="timeline-header">
                <h2 class="timeline-title"><?php echo esc_html($section_title); ?></h2>
                <p class="timeline-subtitle"><?php echo esc_html($section_subtitle); ?></p>
            </div>
            <div class="timeline-wrapper">
                <div class="timeline-line"></div>
                <?php foreach ($timeline as $i => $item): ?>
                    <div class="timeline-item <?php echo ($i % 2 === 0) ? 'left' : 'right'; ?>" data-step="<?php echo ($i+1); ?>">
                        <div class="timeline-content">
                            <div class="step-number"><?php echo sprintf('%02d', $i+1); ?></div>
                            <div class="problem-icon-timeline">
                                <i class="fas <?php echo esc_attr($item['icon']); ?>"></i>
                            </div>
                            <h3 class="timeline-problem-title"><?php echo esc_html($item['title']); ?></h3>
                            <p class="timeline-problem-text"><?php echo esc_html($item['text']); ?></p>
                            <?php if ($i < count($timeline)-1): ?>
                                <div class="timeline-arrow-<?php echo ($i % 2 === 0) ? 'right' : 'left'; ?>">
                                    <i class="fas fa-arrow-<?php echo ($i % 2 === 0) ? 'right' : 'left'; ?>"></i>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
            <div class="timeline-footer">
                <div class="timeline-warning">
                    <i class="fas fa-exclamation-circle"></i>
                    <span><?php echo esc_html($footer_text); ?></span>
                </div>
                <div class="timeline-solution-arrow">
                    <i class="fas fa-arrow-down"></i>
                    <span><?php echo esc_html($footer_arrow_text); ?></span>
                </div>
            </div>
        </div>
    </section>
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        // タイムライン要素のアニメーション
        const timelineItems = document.querySelectorAll('.<?php echo $unique_id; ?> .timeline-item');
        const timelineObserver = new IntersectionObserver(function(entries) {
            entries.forEach(function(entry) {
                if (entry.isIntersecting) {
                    setTimeout(function() {
                        entry.target.classList.add('animate');
                    }, parseInt(entry.target.dataset.step) * 200);
                }
            });
        }, {
            threshold: 0.3,
            rootMargin: '0px 0px -50px 0px'
        });
        timelineItems.forEach(function(item) {
            timelineObserver.observe(item);
        });
        // タイムラインラインの段階的表示
        const timelineLine = document.querySelector('.<?php echo $unique_id; ?> .timeline-line');
        if (timelineLine) {
            const lineObserver = new IntersectionObserver(function(entries) {
                entries.forEach(function(entry) {
                    if (entry.isIntersecting) {
                        timelineLine.style.animation = 'drawLine 3s ease-in-out forwards';
                    }
                });
            }, { threshold: 0.1 });
            lineObserver.observe(timelineLine);
        }
        // ホバーエフェクト強化
        const timelineContents = document.querySelectorAll('.<?php echo $unique_id; ?> .timeline-content');
        timelineContents.forEach(function(content) {
            content.addEventListener('mouseenter', function() {
                this.style.transform = 'scale(1.02)';
                this.style.boxShadow = '0 20px 45px rgba(0, 0, 0, 0.25)';
            });
            content.addEventListener('mouseleave', function() {
                this.style.transform = 'scale(1)';
                this.style.boxShadow = '0 15px 35px rgba(0, 0, 0, 0.2)';
            });
        });
    });
    // ライン描画アニメーション
    const style = document.createElement('style');
    style.textContent = `
        @keyframes drawLine {
            0% {
                background: linear-gradient(180deg, transparent 0%, transparent 100%);
            }
            100% {
                background: linear-gradient(180deg, transparent 0%, white 20%, white 80%, transparent 100%);
            }
        }
    `;
    document.head.appendChild(style);
    </script>
    <?php
    return ob_get_clean();
} 