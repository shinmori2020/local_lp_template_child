<?php
/**
 * Pricing Module - Complete Independent Version
 * ショートコード: [pricing_module]
 */

if (!defined('ABSPATH')) {
    exit;
}

/**
 * ACFフィールドグループの自動登録（即座実行）
 */
if (function_exists('acf_add_local_field_group')) {
    acf_add_local_field_group(array(
            'key' => 'group_pricing_complete',
            'title' => '料金モジュール設定',
            'fields' => array(
                array(
                    'key' => 'field_pricing_title',
                    'label' => 'セクションタイトル',
                    'name' => 'pricing_title',
                    'type' => 'text',
                    'default_value' => '料金プラン',
                ),
                array(
                    'key' => 'field_pricing_plans',
                    'label' => '料金プラン',
                    'name' => 'pricing_plans',
                    'type' => 'repeater',
                    'sub_fields' => array(
                        array(
                            'key' => 'field_plan_name',
                            'label' => 'プラン名',
                            'name' => 'name',
                            'type' => 'text',
                        ),
                        array(
                            'key' => 'field_plan_price',
                            'label' => '価格',
                            'name' => 'price',
                            'type' => 'text',
                        ),
                        array(
                            'key' => 'field_plan_period',
                            'label' => '期間',
                            'name' => 'period',
                            'type' => 'text',
                            'default_value' => '月額',
                        ),
                        array(
                            'key' => 'field_plan_features',
                            'label' => '機能（1行ずつ）',
                            'name' => 'features',
                            'type' => 'textarea',
                        ),
                        array(
                            'key' => 'field_plan_recommended',
                            'label' => 'おすすめプラン',
                            'name' => 'recommended',
                            'type' => 'true_false',
                        ),
                    ),
                    'min' => 1,
                    'max' => 4,
                ),
            ),
            'location' => get_smart_location(), // 最小記述方式（1行のみ）
        ));
}

add_shortcode('pricing_module', 'render_pricing_module');

function render_pricing_module($atts = [], $content = null) {
    $atts = shortcode_atts(array(
        'title' => '',
        'style' => 'default',
        'post_id' => get_the_ID(),
    ), $atts);
    
    $post_id = $atts['post_id'];
    $title = $atts['title'] ?: get_field('pricing_title', $post_id) ?: '料金プラン';
    
    $plans = get_field('pricing_plans', $post_id) ?: array(
        array(
            'name' => 'スタータープラン',
            'price' => '¥10,000',
            'period' => '月額',
            'features' => "基本機能\nメールサポート\n月次レポート",
            'recommended' => false
        ),
        array(
            'name' => 'ビジネスプラン',
            'price' => '¥25,000',
            'period' => '月額',
            'features' => "全機能利用可能\n電話サポート\n週次レポート\nカスタマイズ対応",
            'recommended' => true
        ),
        array(
            'name' => 'エンタープライズ',
            'price' => 'お問い合わせ',
            'period' => '',
            'features' => "無制限利用\n専任サポート\nオンサイト対応\n完全カスタマイズ",
            'recommended' => false
        ),
    );
    
    $unique_id = 'pricing_' . uniqid();
    
    ob_start();
    ?>
    
    <style>
    .<?php echo $unique_id; ?> {
        padding: 80px 0;
        background: #f8f9fa;
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
    
    .<?php echo $unique_id; ?> .pricing-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
        gap: 30px;
        justify-items: center;
    }
    
    .<?php echo $unique_id; ?> .pricing-card {
        background: white;
        border-radius: 15px;
        padding: 40px 30px;
        text-align: center;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        transition: all 0.3s ease;
        position: relative;
        max-width: 350px;
        width: 100%;
        border: 3px solid transparent;
    }
    
    .<?php echo $unique_id; ?> .pricing-card.recommended {
        border-color: #007bff;
        transform: scale(1.05);
        background: linear-gradient(135deg, #ffffff 0%, #f8f9ff 100%);
    }
    
    .<?php echo $unique_id; ?> .pricing-card.recommended::before {
        content: 'おすすめ';
        position: absolute;
        top: -15px;
        left: 50%;
        transform: translateX(-50%);
        background: #007bff;
        color: white;
        padding: 8px 20px;
        border-radius: 20px;
        font-size: 0.9rem;
        font-weight: 600;
    }
    
    .<?php echo $unique_id; ?> .pricing-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 20px 40px rgba(0, 0, 0, 0.15);
    }
    
    .<?php echo $unique_id; ?> .pricing-card.recommended:hover {
        transform: scale(1.05) translateY(-10px);
    }
    
    .<?php echo $unique_id; ?> .plan-name {
        font-size: 1.4rem;
        font-weight: 600;
        margin-bottom: 20px;
        color: #2c3e50;
    }
    
    .<?php echo $unique_id; ?> .plan-price {
        font-size: 3rem;
        font-weight: bold;
        color: #007bff;
        margin-bottom: 5px;
    }
    
    .<?php echo $unique_id; ?> .plan-period {
        color: #6c757d;
        margin-bottom: 30px;
        font-size: 1rem;
    }
    
    .<?php echo $unique_id; ?> .plan-features {
        text-align: left;
        margin-bottom: 30px;
    }
    
    .<?php echo $unique_id; ?> .plan-features ul {
        list-style: none;
        padding: 0;
        margin: 0;
    }
    
    .<?php echo $unique_id; ?> .plan-features li {
        padding: 8px 0;
        border-bottom: 1px solid #e9ecef;
        color: #495057;
        position: relative;
        padding-left: 25px;
    }
    
    .<?php echo $unique_id; ?> .plan-features li::before {
        content: '✓';
        position: absolute;
        left: 0;
        color: #28a745;
        font-weight: bold;
    }
    
    .<?php echo $unique_id; ?> .plan-features li:last-child {
        border-bottom: none;
    }
    
    .<?php echo $unique_id; ?> .plan-button {
        display: block;
        width: 100%;
        padding: 15px 30px;
        background: #007bff;
        color: white;
        text-decoration: none;
        border-radius: 8px;
        font-weight: 600;
        transition: all 0.3s ease;
        border: none;
        cursor: pointer;
    }
    
    .<?php echo $unique_id; ?> .plan-button:hover {
        background: #0056b3;
        transform: translateY(-2px);
    }
    
    .<?php echo $unique_id; ?> .pricing-card.recommended .plan-button {
        background: linear-gradient(135deg, #007bff, #0056b3);
        box-shadow: 0 5px 15px rgba(0, 123, 255, 0.3);
    }
    
    @media (max-width: 768px) {
        .<?php echo $unique_id; ?> {
            padding: 60px 0;
        }
        
        .<?php echo $unique_id; ?> .pricing-grid {
            grid-template-columns: 1fr;
            gap: 30px;
        }
        
        .<?php echo $unique_id; ?> .pricing-card.recommended {
            transform: none;
        }
        
        .<?php echo $unique_id; ?> .pricing-card.recommended:hover {
            transform: translateY(-10px);
        }
        
        .<?php echo $unique_id; ?> .section-title {
            font-size: 2rem;
        }
    }
    </style>
    
    <section class="<?php echo $unique_id; ?>" id="pricing-module">
        <div class="container">
            <h2 class="section-title"><?php echo esc_html($title); ?></h2>
            
            <div class="pricing-grid">
                <?php foreach ($plans as $plan): ?>
                    <div class="pricing-card <?php echo $plan['recommended'] ? 'recommended' : ''; ?>">
                        <h3 class="plan-name"><?php echo esc_html($plan['name']); ?></h3>
                        <div class="plan-price"><?php echo esc_html($plan['price']); ?></div>
                        <?php if ($plan['period']): ?>
                            <div class="plan-period"><?php echo esc_html($plan['period']); ?></div>
                        <?php endif; ?>
                        
                        <div class="plan-features">
                            <ul>
                                <?php 
                                $features = explode("\n", $plan['features']);
                                foreach ($features as $feature): 
                                    if (trim($feature)):
                                ?>
                                    <li><?php echo esc_html(trim($feature)); ?></li>
                                <?php 
                                    endif;
                                endforeach; 
                                ?>
                            </ul>
                        </div>
                        
                        <a href="#contact" class="plan-button" onclick="pricingClick_<?php echo $unique_id; ?>(event, '<?php echo esc_js($plan['name']); ?>')">
                            <?php echo strpos($plan['price'], 'お問い合わせ') !== false ? 'お問い合わせ' : '今すぐ始める'; ?>
                        </a>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>
    
    <script>
    function pricingClick_<?php echo $unique_id; ?>(event, planName) {
        // Google Analytics トラッキング
        if (typeof gtag !== 'undefined') {
            gtag('event', 'pricing_plan_click', {
                'event_category': 'engagement',
                'event_label': planName,
                'module_id': '<?php echo $unique_id; ?>'
            });
        }
        
        console.log('Pricing plan clicked:', planName);
        
        // スムーススクロール
        const href = event.target.getAttribute('href');
        if (href.startsWith('#')) {
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
        console.log('Pricing Module Loaded: <?php echo $unique_id; ?>');
    });
    </script>
    
    <?php
    return ob_get_clean();
}
?> 