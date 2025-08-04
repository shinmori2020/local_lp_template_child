<?php
/**
 * Benefit Module - Complete Independent Version
 * ショートコード: [benefit_module]
 */

if (!defined('ABSPATH')) {
    exit;
}

/**
 * ACFフィールドグループの自動登録（即座実行）
 */
if (function_exists('acf_add_local_field_group')) {
    acf_add_local_field_group(array(
            'key' => 'group_benefit_complete',
            'title' => 'ベネフィットモジュール設定',
            'fields' => array(
                array(
                    'key' => 'field_benefit_title',
                    'label' => 'セクションタイトル',
                    'name' => 'benefit_title',
                    'type' => 'text',
                    'default_value' => '導入で得られる効果',
                ),
                array(
                    'key' => 'field_benefit_items',
                    'label' => 'ベネフィット項目',
                    'name' => 'benefit_items',
                    'type' => 'repeater',
                    'sub_fields' => array(
                        array(
                            'key' => 'field_benefit_item_title',
                            'label' => 'タイトル',
                            'name' => 'title',
                            'type' => 'text',
                        ),
                        array(
                            'key' => 'field_benefit_item_description',
                            'label' => '説明',
                            'name' => 'description',
                            'type' => 'textarea',
                        ),
                        array(
                            'key' => 'field_benefit_item_icon',
                            'label' => 'アイコン',
                            'name' => 'icon',
                            'type' => 'select',
                            'choices' => array(
                                'fas fa-chart-line' => '成長・向上',
                                'fas fa-clock' => '時間短縮',
                                'fas fa-dollar-sign' => 'コスト削減',
                                'fas fa-users' => 'チーム効率',
                                'fas fa-shield-alt' => 'セキュリティ',
                                'fas fa-lightbulb' => 'イノベーション',
                            ),
                            'default_value' => 'fas fa-chart-line',
                        ),
                    ),
                    'min' => 1,
                    'max' => 6,
                ),
            ),
            'location' => get_smart_location(), // 最小記述方式（1行のみ）
    ));
}

add_shortcode('benefit_module', 'render_benefit_module');

function render_benefit_module($atts = [], $content = null) {
    $atts = shortcode_atts(array(
        'title' => '',
        'style' => 'default',
        'post_id' => get_the_ID(),
    ), $atts);
    
    $post_id = $atts['post_id'];
    $title = $atts['title'] ?: get_field('benefit_title', $post_id) ?: '導入で得られる効果';
    
    $items = get_field('benefit_items', $post_id) ?: array(
        array('title' => '業務効率50%向上', 'description' => '自動化により作業時間を大幅に短縮', 'icon' => 'fas fa-clock'),
        array('title' => 'コスト30%削減', 'description' => '人件費と運用コストを効率的に削減', 'icon' => 'fas fa-dollar-sign'),
        array('title' => '品質向上', 'description' => 'ヒューマンエラーを削減し品質を向上', 'icon' => 'fas fa-chart-line'),
    );
    
    $unique_id = 'benefit_' . uniqid();
    
    ob_start();
    ?>
    
    <style>
    .<?php echo $unique_id; ?> {
        padding: 80px 0;
        background: white;
    }
    
    .<?php echo $unique_id; ?> .container {
        max-width: 1200px;
        margin: 0 auto;
        padding: 0 20px;
    }
    
    .<?php echo $unique_id; ?> .section-title {
        font-size: 2.5rem;
        text-align: center;
        margin-bottom: 60px;
        color: #2c3e50;
        font-weight: bold;
    }
    
    .<?php echo $unique_id; ?> .benefit-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(350px, 1fr));
        gap: 40px;
    }
    
    .<?php echo $unique_id; ?> .benefit-item {
        text-align: center;
        padding: 40px 30px;
        border-radius: 15px;
        background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
        transition: all 0.3s ease;
        position: relative;
        overflow: hidden;
    }
    
    .<?php echo $unique_id; ?> .benefit-item::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: linear-gradient(135deg, #28a745 0%, #20c997 100%);
        opacity: 0;
        transition: opacity 0.3s ease;
    }
    
    .<?php echo $unique_id; ?> .benefit-item:hover::before {
        opacity: 0.1;
    }
    
    .<?php echo $unique_id; ?> .benefit-item:hover {
        transform: translateY(-10px);
        box-shadow: 0 20px 40px rgba(40, 167, 69, 0.2);
    }
    
    .<?php echo $unique_id; ?> .benefit-icon {
        width: 80px;
        height: 80px;
        margin: 0 auto 20px;
        background: linear-gradient(135deg, #28a745, #20c997);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-size: 32px;
        position: relative;
        z-index: 2;
        animation: benefitBounce 2s infinite;
    }
    
    .<?php echo $unique_id; ?> .benefit-title {
        font-size: 1.4rem;
        font-weight: 600;
        margin-bottom: 15px;
        color: #2c3e50;
        position: relative;
        z-index: 2;
    }
    
    .<?php echo $unique_id; ?> .benefit-description {
        color: #6c757d;
        line-height: 1.6;
        position: relative;
        z-index: 2;
    }
    
    @keyframes benefitBounce {
        0%, 100% { transform: translateY(0); }
        50% { transform: translateY(-5px); }
    }
    
    @media (max-width: 768px) {
        .<?php echo $unique_id; ?> {
            padding: 60px 0;
        }
        
        .<?php echo $unique_id; ?> .benefit-grid {
            grid-template-columns: 1fr;
            gap: 30px;
        }
        
        .<?php echo $unique_id; ?> .section-title {
            font-size: 2rem;
        }
    }
    </style>
    
    <section class="<?php echo $unique_id; ?>" id="benefit-module">
        <div class="container">
            <h2 class="section-title"><?php echo esc_html($title); ?></h2>
            
            <div class="benefit-grid">
                <?php foreach ($items as $item): ?>
                    <div class="benefit-item">
                        <div class="benefit-icon">
                            <i class="<?php echo esc_attr($item['icon']); ?>"></i>
                        </div>
                        <h3 class="benefit-title"><?php echo esc_html($item['title']); ?></h3>
                        <p class="benefit-description"><?php echo esc_html($item['description']); ?></p>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>
    
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        console.log('Benefit Module Loaded: <?php echo $unique_id; ?>');
        
        // IntersectionObserver for animations
        if ('IntersectionObserver' in window) {
            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.style.animationPlayState = 'running';
                    }
                });
            }, { threshold: 0.1 });
            
            document.querySelectorAll('.<?php echo $unique_id; ?> .benefit-item').forEach(item => {
                observer.observe(item);
            });
        }
    });
    </script>
    
    <?php
    return ob_get_clean();
}
?> 