<?php
/**
 * Problem Module 02 - Design案1 完全独立型
 * ショートコード: [problem_02_module]
 *
 * 6つの課題カード＋サブタイトル＋フッター＋アニメーション
 *
 * @package Local_LP_Template_Child
 */

if (!defined('ABSPATH')) {
    exit;
}

// ACFフィールドグループ登録
if (function_exists('acf_add_local_field_group')) {
    acf_add_local_field_group(array(
        'key' => 'group_problem_02_complete',
        'title' => '課題提起モジュール02（デザイン案1）',
        'fields' => array(
            array(
                'key' => 'field_problem_02_section_title',
                'label' => 'セクションタイトル',
                'name' => 'problem_02_section_title',
                'type' => 'text',
                'default_value' => 'こんなお悩みはありませんか？',
            ),
            array(
                'key' => 'field_problem_02_section_subtitle',
                'label' => 'サブタイトル',
                'name' => 'problem_02_section_subtitle',
                'type' => 'text',
                'default_value' => '多くの方が抱えている課題を解決いたします',
            ),
            array(
                'key' => 'field_problem_02_cards',
                'label' => '課題カード',
                'name' => 'problem_02_cards',
                'type' => 'repeater',
                'sub_fields' => array(
                    array(
                        'key' => 'field_problem_02_card_icon',
                        'label' => 'アイコン（Font Awesome）',
                        'name' => 'icon',
                        'type' => 'text',
                        'default_value' => 'fa-clock',
                    ),
                    array(
                        'key' => 'field_problem_02_card_title',
                        'label' => 'カードタイトル',
                        'name' => 'title',
                        'type' => 'text',
                    ),
                    array(
                        'key' => 'field_problem_02_card_text',
                        'label' => '説明文',
                        'name' => 'text',
                        'type' => 'textarea',
                    ),
                ),
                'min' => 1,
                'max' => 6,
                'button_label' => '課題カードを追加',
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
                'key' => 'field_problem_02_footer_text',
                'label' => 'フッターテキスト',
                'name' => 'problem_02_footer_text',
                'type' => 'text',
                'default_value' => 'これらの課題、まとめて解決できる方法があります',
            ),
            array(
                'key' => 'field_problem_02_bg_color',
                'label' => '背景色',
                'name' => 'problem_02_bg_color',
                'type' => 'color_picker',
                'default_value' => '#f5f7fa',
            ),
        ),
        'location' => get_smart_location(),
    ));
}

add_shortcode('problem_02_module', 'render_problem_02_module');

function render_problem_02_module($atts = [], $content = null) {
    $atts = shortcode_atts([
        'title' => '',
        'subtitle' => '',
        'footer' => '',
        'bg_color' => '',
        'post_id' => get_the_ID(),
    ], $atts, 'problem_02_module');

    if (empty($atts['post_id'])) {
        $atts['post_id'] = get_the_ID();
    }

    $section_title = $atts['title'] ?: get_field('problem_02_section_title', $atts['post_id']) ?: 'こんなお悩みはありませんか？';
    $section_subtitle = $atts['subtitle'] ?: get_field('problem_02_section_subtitle', $atts['post_id']) ?: '多くの方が抱えている課題を解決いたします';
    $cards = get_field('problem_02_cards', $atts['post_id']);
    $footer_text = $atts['footer'] ?: get_field('problem_02_footer_text', $atts['post_id']) ?: 'これらの課題、まとめて解決できる方法があります';
    $bg_color = $atts['bg_color'] ?: get_field('problem_02_bg_color', $atts['post_id']) ?: '#f5f7fa';

    if (empty($cards)) {
        $cards = array(
            array('icon'=>'fa-clock','title'=>'時間が足りない','text'=>'毎日忙しくて、重要な業務に集中する時間が取れない状況が続いている'),
            array('icon'=>'fa-chart-line','title'=>'効率が上がらない','text'=>'同じ作業を繰り返しているのに、なかなか効率化が進まない'),
            array('icon'=>'fa-users','title'=>'人手不足','text'=>'チーム全体のリソースが不足しており、一人当たりの負担が大きすぎる'),
            array('icon'=>'fa-cog','title'=>'システムの複雑さ','text'=>'現在使用しているシステムが複雑で、操作に時間がかかってしまう'),
            array('icon'=>'fa-exclamation-triangle','title'=>'ミスが多発','text'=>'手作業が多く、ヒューマンエラーによる問題が頻繁に発生している'),
            array('icon'=>'fa-money-bill-wave','title'=>'コストの増大','text'=>'非効率な業務により、必要以上にコストがかかっている状況'),
        );
    }

    $unique_id = 'problem02_' . uniqid();
    ob_start();
    ?>
    <style>
    .<?php echo $unique_id; ?> {
        background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
        padding: 80px 0;
        position: relative;
        overflow: hidden;
    }
    .<?php echo $unique_id; ?> .problem-container {
        max-width: 1200px;
        margin: 0 auto;
        padding: 0 20px;
        position: relative;
        z-index: 1;
    }
    .<?php echo $unique_id; ?> .problem-header {
        text-align: center;
        margin-bottom: 60px;
    }
    .<?php echo $unique_id; ?> .problem-title {
        font-size: 2.8rem;
        font-weight: 700;
        color: #2d3748;
        margin-bottom: 16px;
        line-height: 1.3;
        position: relative;
    }
    .<?php echo $unique_id; ?> .problem-title::after {
        content: '';
        position: absolute;
        bottom: -8px;
        left: 50%;
        transform: translateX(-50%);
        width: 60px;
        height: 3px;
        background: linear-gradient(90deg, #667eea, #764ba2);
        border-radius: 2px;
    }
    .<?php echo $unique_id; ?> .problem-subtitle {
        font-size: 1.2rem;
        color: #4a5568;
        line-height: 1.6;
    }
    .<?php echo $unique_id; ?> .problem-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(350px, 1fr));
        gap: 30px;
        margin-bottom: 60px;
    }
    .<?php echo $unique_id; ?> .problem-card {
        background: rgba(255, 255, 255, 0.9);
        padding: 40px 30px;
        border-radius: 16px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        text-align: center;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        border: 1px solid rgba(255, 255, 255, 0.2);
        backdrop-filter: blur(10px);
        position: relative;
        overflow: hidden;
    }
    .<?php echo $unique_id; ?> .problem-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.4), transparent);
        transition: left 0.5s;
    }
    .<?php echo $unique_id; ?> .problem-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 20px 40px rgba(0, 0, 0, 0.15);
    }
    .<?php echo $unique_id; ?> .problem-card:hover::before {
        left: 100%;
    }
    .<?php echo $unique_id; ?> .problem-icon {
        width: 80px;
        height: 80px;
        margin: 0 auto 24px;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        position: relative;
        z-index: 1;
        overflow: hidden;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    }
    .<?php echo $unique_id; ?> .problem-icon::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.6), transparent);
        border-radius: 50%;
        transition: left 0.5s ease;
        z-index: 1;
    }
    .<?php echo $unique_id; ?> .problem-card:hover .problem-icon::before {
        left: 100%;
    }
    .<?php echo $unique_id; ?> .problem-card:hover .problem-icon {
        transform: scale(1.1);
        filter: brightness(1.2) saturate(1.1);
        box-shadow: 0 0 20px rgba(102, 126, 234, 0.3);
    }
    .<?php echo $unique_id; ?> .problem-icon i {
        font-size: 2rem;
        color: white;
        position: relative;
        z-index: 2;
        transition: all 0.3s ease;
    }
    .<?php echo $unique_id; ?> .problem-card:hover .problem-icon i {
        text-shadow: 0 0 10px rgba(255, 255, 255, 0.5);
        transform: scale(1.05);
    }
    .<?php echo $unique_id; ?> .problem-card-title {
        font-size: 1.4rem;
        font-weight: 600;
        color: #2d3748;
        margin-bottom: 16px;
        line-height: 1.4;
    }
    .<?php echo $unique_id; ?> .problem-card-text {
        font-size: 1rem;
        color: #4a5568;
        line-height: 1.6;
        position: relative;
        z-index: 1;
    }
    .<?php echo $unique_id; ?> .problem-footer {
        text-align: center;
        position: relative;
    }
    .<?php echo $unique_id; ?> .problem-footer-text {
        font-size: 1.3rem;
        color: #2d3748;
        margin-bottom: 20px;
        font-weight: 500;
    }
    .<?php echo $unique_id; ?> .problem-footer-text strong {
        color: #667eea;
        font-weight: 700;
    }
    .<?php echo $unique_id; ?> .problem-arrow {
        font-size: 2rem;
        color: #667eea;
        animation: bounce 2s infinite;
    }
    @keyframes bounce {
        0%, 20%, 50%, 80%, 100% {
            transform: translateY(0);
        }
        40% {
            transform: translateY(-10px);
        }
        60% {
            transform: translateY(-5px);
        }
    }
    @media (max-width: 768px) {
        .<?php echo $unique_id; ?> {
            padding: 60px 0;
        }
        .<?php echo $unique_id; ?> .problem-container {
            padding: 0 15px;
        }
        .<?php echo $unique_id; ?> .problem-title {
            font-size: 2.2rem;
        }
        .<?php echo $unique_id; ?> .problem-subtitle {
            font-size: 1.1rem;
        }
        .<?php echo $unique_id; ?> .problem-grid {
            grid-template-columns: 1fr;
            gap: 24px;
            margin-bottom: 40px;
        }
        .<?php echo $unique_id; ?> .problem-card {
            padding: 30px 20px;
        }
        .<?php echo $unique_id; ?> .problem-icon {
            width: 60px;
            height: 60px;
            margin-bottom: 20px;
        }
        .<?php echo $unique_id; ?> .problem-icon i {
            font-size: 1.5rem;
        }
        .<?php echo $unique_id; ?> .problem-card-title {
            font-size: 1.2rem;
        }
        .<?php echo $unique_id; ?> .problem-footer-text {
            font-size: 1.1rem;
        }
    }
    @media (max-width: 480px) {
        .<?php echo $unique_id; ?> .problem-title {
            font-size: 1.8rem;
        }
        .<?php echo $unique_id; ?> .problem-card {
            padding: 24px 16px;
        }
    }
    </style>
    <section class="<?php echo $unique_id; ?>">
        <div class="problem-container">
            <div class="problem-header">
                <h2 class="problem-title"><?php echo esc_html($section_title); ?></h2>
                <p class="problem-subtitle"><?php echo esc_html($section_subtitle); ?></p>
            </div>
            <div class="problem-grid">
                <?php foreach ($cards as $card): ?>
                    <div class="problem-card">
                        <div class="problem-icon">
                            <i class="fas <?php echo esc_attr($card['icon']); ?>"></i>
                        </div>
                        <h3 class="problem-card-title"><?php echo esc_html($card['title']); ?></h3>
                        <p class="problem-card-text"><?php echo esc_html($card['text']); ?></p>
                    </div>
                <?php endforeach; ?>
            </div>
            <div class="problem-footer">
                <p class="problem-footer-text"><?php echo esc_html($footer_text); ?></p>
                <div class="problem-arrow">
                    <i class="fas fa-arrow-down"></i>
                </div>
            </div>
        </div>
    </section>
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        const problemCards = document.querySelectorAll('.<?php echo $unique_id; ?> .problem-card');
        const observerOptions = {
            threshold: 0.1,
            rootMargin: '0px 0px -50px 0px'
        };
        const observer = new IntersectionObserver(function(entries) {
            entries.forEach(function(entry) {
                if (entry.isIntersecting) {
                    entry.target.style.opacity = '1';
                    entry.target.style.transform = 'translateY(0)';
                }
            });
        }, observerOptions);
        problemCards.forEach(function(card, index) {
            card.style.opacity = '0';
            card.style.transform = 'translateY(30px)';
            card.style.transition = 'opacity 0.6s ease ' + (index * 0.1) + 's, transform 0.6s ease ' + (index * 0.1) + 's';
            observer.observe(card);
        });
        problemCards.forEach(function(card) {
            card.addEventListener('mouseenter', function() {
                this.style.borderColor = '#667eea';
            });
            card.addEventListener('mouseleave', function() {
                this.style.borderColor = 'rgba(255, 255, 255, 0.2)';
            });
        });
    });
    </script>
    <?php
    return ob_get_clean();
} 