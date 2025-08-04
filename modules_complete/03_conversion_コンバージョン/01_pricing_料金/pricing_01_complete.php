<?php
/**
 * Pricing 01 Module - Complete Version
 * 
 * 料金プランセクション
 * 3つのプランを表示し、各プランに価格、機能、CTAボタンを配置
 * 
 * Features:
 * - 3つの料金プラン（ベーシック、スタンダード、プレミアム）
 * - 人気プラン・おすすめプランのバッジ表示
 * - 各プランの詳細機能リスト
 * - CTAボタンとトライアル情報
 * - 注意事項セクション
 * - 完全レスポンシブ対応
 * 
 * @package Local_LP_Template_Child
 * @version 1.0.0
 */

// 直接アクセスを防ぐ
if (!defined('ABSPATH')) {
    exit;
}

// ACFフィールド定義
function register_pricing_01_fields() {
    if (function_exists('acf_add_local_field_group')) {
        acf_add_local_field_group(array(
            'key' => 'group_pricing_01_complete',
            'title' => 'Pricing 01 Module (料金プラン)',
            'fields' => array(
                array(
                    'key' => 'pricing_01_section_title',
                    'label' => 'セクションタイトル',
                    'name' => 'pricing_01_section_title',
                    'type' => 'text',
                    'default_value' => '料金プラン',
                    'required' => 1,
                ),
                array(
                    'key' => 'pricing_01_section_subtitle',
                    'label' => 'サブタイトル',
                    'name' => 'pricing_01_section_subtitle',
                    'type' => 'text',
                    'default_value' => 'お客様のニーズに合わせた柔軟なプランをご用意',
                    'required' => 1,
                ),
                array(
                    'key' => 'pricing_01_plans',
                    'label' => '料金プラン',
                    'name' => 'pricing_01_plans',
                    'type' => 'repeater',
                    'sub_fields' => array(
                        array(
                            'key' => 'pricing_01_plan_name',
                            'label' => 'プラン名',
                            'name' => 'plan_name',
                            'type' => 'text',
                            'required' => 1,
                        ),
                        array(
                            'key' => 'pricing_01_plan_price',
                            'label' => '価格',
                            'name' => 'plan_price',
                            'type' => 'text',
                            'placeholder' => '¥29,800',
                            'required' => 1,
                        ),
                        array(
                            'key' => 'pricing_01_plan_period',
                            'label' => '期間',
                            'name' => 'plan_period',
                            'type' => 'text',
                            'default_value' => '/月',
                            'required' => 1,
                        ),
                        array(
                            'key' => 'pricing_01_plan_description',
                            'label' => 'プラン説明',
                            'name' => 'plan_description',
                            'type' => 'text',
                            'required' => 1,
                        ),
                        array(
                            'key' => 'pricing_01_plan_badge',
                            'label' => 'バッジ',
                            'name' => 'plan_badge',
                            'type' => 'select',
                            'choices' => array(
                                '' => 'バッジなし',
                                'popular' => '人気No.1',
                                'recommended' => 'おすすめ',
                            ),
                            'default_value' => '',
                            'allow_null' => 1,
                        ),
                        array(
                            'key' => 'pricing_01_plan_features',
                            'label' => '機能リスト',
                            'name' => 'plan_features',
                            'type' => 'repeater',
                            'sub_fields' => array(
                                array(
                                    'key' => 'pricing_01_feature_text',
                                    'label' => '機能名',
                                    'name' => 'feature_text',
                                    'type' => 'text',
                                    'required' => 1,
                                ),
                            ),
                            'min' => 1,
                            'layout' => 'table',
                            'button_label' => '機能を追加',
                        ),
                        array(
                            'key' => 'pricing_01_plan_cta_text',
                            'label' => 'CTAボタンテキスト',
                            'name' => 'plan_cta_text',
                            'type' => 'text',
                            'default_value' => '無料で始める',
                            'required' => 1,
                        ),
                        array(
                            'key' => 'pricing_01_plan_cta_url',
                            'label' => 'CTAボタンURL',
                            'name' => 'plan_cta_url',
                            'type' => 'url',
                            'default_value' => '#contact',
                            'required' => 1,
                        ),
                        array(
                            'key' => 'pricing_01_plan_trial_note',
                            'label' => 'トライアル情報',
                            'name' => 'plan_trial_note',
                            'type' => 'text',
                            'default_value' => '30日間無料トライアル',
                        ),
                    ),
                    'min' => 1,
                    'max' => 5,
                    'layout' => 'block',
                    'button_label' => 'プランを追加',
                ),
                array(
                    'key' => 'pricing_01_notes',
                    'label' => '注意事項',
                    'name' => 'pricing_01_notes',
                    'type' => 'repeater',
                    'sub_fields' => array(
                        array(
                            'key' => 'pricing_01_note_icon',
                            'label' => 'アイコン（FontAwesome）',
                            'name' => 'note_icon',
                            'type' => 'text',
                            'placeholder' => 'fa-info-circle',
                            'required' => 1,
                        ),
                        array(
                            'key' => 'pricing_01_note_text',
                            'label' => '注意事項テキスト',
                            'name' => 'note_text',
                            'type' => 'text',
                            'required' => 1,
                        ),
                    ),
                    'min' => 0,
                    'layout' => 'table',
                    'button_label' => '注意事項を追加',
                ),
            ),
            'location' => array(
                array(
                    array(
                        'param' => 'post_type',
                        'operator' => '==',
                        'value' => 'page',
                    ),
                ),
            ),
            'menu_order' => 0,
            'position' => 'normal',
            'style' => 'default',
            'label_placement' => 'top',
            'instruction_placement' => 'label',
            'hide_on_screen' => '',
        ));
    }
}
// 即座実行でACFフィールドを登録
register_pricing_01_fields();

// ショートコード関数
function render_pricing_01_module($atts) {
    $atts = shortcode_atts(array(
        'post_id' => 0
    ), $atts);
    
    // 投稿IDが指定されていない場合は現在の投稿IDを使用
    if (empty($atts['post_id'])) {
        $atts['post_id'] = get_the_ID();
        if (!$atts['post_id']) {
            global $post;
            $atts['post_id'] = $post ? $post->ID : 0;
        }
    }
    
    // ACFフィールドから値を取得
    $section_title = get_field('pricing_01_section_title', $atts['post_id']);
    $section_subtitle = get_field('pricing_01_section_subtitle', $atts['post_id']);
    $plans = get_field('pricing_01_plans', $atts['post_id']);
    $notes = get_field('pricing_01_notes', $atts['post_id']);
    
    // デフォルトデータ（ACFデータがない場合）
    if (empty($section_title)) {
        $section_title = '料金プラン';
    }
    if (empty($section_subtitle)) {
        $section_subtitle = 'お客様のニーズに合わせた柔軟なプランをご用意';
    }
    if (empty($plans)) {
        $plans = array(
            array(
                'plan_name' => 'ベーシック',
                'plan_price' => '¥29,800',
                'plan_period' => '/月',
                'plan_description' => '小規模チーム向けの基本機能',
                'plan_badge' => '',
                'plan_features' => array(
                    array('feature_text' => '自動化ワークフロー（5個まで）'),
                    array('feature_text' => 'データ連携（3サービス）'),
                    array('feature_text' => '基本レポート機能'),
                    array('feature_text' => 'メールサポート'),
                    array('feature_text' => 'ユーザー数：5名まで'),
                ),
                'plan_cta_text' => '無料で始める',
                'plan_cta_url' => '#contact',
                'plan_trial_note' => '30日間無料トライアル',
            ),
            array(
                'plan_name' => 'スタンダード',
                'plan_price' => '¥59,800',
                'plan_period' => '/月',
                'plan_description' => '中規模企業に最適な充実機能',
                'plan_badge' => 'popular',
                'plan_features' => array(
                    array('feature_text' => '自動化ワークフロー（無制限）'),
                    array('feature_text' => 'データ連携（10サービス）'),
                    array('feature_text' => '高度な分析レポート'),
                    array('feature_text' => '電話・チャットサポート'),
                    array('feature_text' => 'ユーザー数：20名まで'),
                    array('feature_text' => 'カスタマイズ機能'),
                    array('feature_text' => 'API連携'),
                ),
                'plan_cta_text' => '無料で始める',
                'plan_cta_url' => '#contact',
                'plan_trial_note' => '30日間無料トライアル',
            ),
            array(
                'plan_name' => 'プレミアム',
                'plan_price' => '¥99,800',
                'plan_period' => '/月',
                'plan_description' => '大企業向けフル機能プラン',
                'plan_badge' => 'recommended',
                'plan_features' => array(
                    array('feature_text' => 'すべての機能が利用可能'),
                    array('feature_text' => 'データ連携（無制限）'),
                    array('feature_text' => 'カスタムダッシュボード'),
                    array('feature_text' => '専任サポート担当'),
                    array('feature_text' => 'ユーザー数：無制限'),
                    array('feature_text' => 'オンサイト研修'),
                    array('feature_text' => 'SLA保証'),
                    array('feature_text' => '優先サポート'),
                ),
                'plan_cta_text' => 'お問い合わせ',
                'plan_cta_url' => '#contact',
                'plan_trial_note' => 'カスタマイズ対応可能',
            ),
        );
    }
    if (empty($notes)) {
        $notes = array(
            array(
                'note_icon' => 'fa-info-circle',
                'note_text' => 'すべてのプランに30日間の無料トライアル期間が含まれます'
            ),
            array(
                'note_icon' => 'fa-credit-card',
                'note_text' => 'お支払いは月額または年額（10%割引）からお選びいただけます'
            ),
            array(
                'note_icon' => 'fa-phone',
                'note_text' => '詳細やカスタマイズについては、お気軽にお問い合わせください'
            ),
        );
    }
    
    // 必須フィールドのチェック
    if (!$section_title || !$plans) {
        return '';
    }
    
    // ユニークIDを生成（複数配置対応）
    $unique_id = 'pricing_01_' . uniqid();
    
    ob_start();
    ?>
    
    <style>
    /* 料金・プランセクション */
    #<?php echo $unique_id; ?> {
        padding: 6rem 0;
        background: linear-gradient(135deg, #f8f9ff 0%, #ffffff 100%);
        position: relative;
        overflow: hidden;
    }

    #<?php echo $unique_id; ?>::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><defs><pattern id="pattern" x="0" y="0" width="100" height="100" patternUnits="userSpaceOnUse"><circle cx="50" cy="50" r="0.8" fill="%23007bff" opacity="0.03"/></pattern></defs><rect width="100" height="100" fill="url(%23pattern)"/></svg>');
        pointer-events: none;
    }

    #<?php echo $unique_id; ?> .section-title {
        font-size: 2.5rem;
        text-align: center;
        margin-bottom: 4rem;
        color: #333;
        position: relative;
        padding-bottom: 1.5rem;
    }

    #<?php echo $unique_id; ?> .section-title::after {
        content: '';
        position: absolute;
        bottom: 0;
        left: 50%;
        transform: translateX(-50%);
        width: 100px;
        height: 4px;
        background: linear-gradient(90deg, #4A90E2, #67B8E3);
        border-radius: 2px;
    }

    #<?php echo $unique_id; ?> .section-subtitle {
        text-align: center;
        font-size: 1.2rem;
        color: #666;
        margin-bottom: 3rem;
        margin-top: -1rem;
    }

    #<?php echo $unique_id; ?> .pricing-plans {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
        gap: 2rem;
        max-width: 1200px;
        margin: 0 auto;
        position: relative;
        z-index: 1;
    }

    #<?php echo $unique_id; ?> .pricing-card {
        background: #fff;
        border-radius: 20px;
        padding: 2.5rem;
        box-shadow: 0 8px 30px rgba(0, 123, 255, 0.08);
        border: 1px solid rgba(0, 123, 255, 0.1);
        transition: all 0.3s ease;
        position: relative;
        display: flex;
        flex-direction: column;
        height: 100%;
    }

    #<?php echo $unique_id; ?> .pricing-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 20px 50px rgba(0, 123, 255, 0.15);
    }

    /* 人気・おすすめバッジ */
    #<?php echo $unique_id; ?> .plan-badge {
        position: absolute;
        top: -12px;
        left: 50%;
        transform: translateX(-50%);
        background: linear-gradient(135deg, #007bff, #00d4ff);
        color: white;
        padding: 0.5rem 1.5rem;
        border-radius: 20px;
        font-size: 0.85rem;
        font-weight: 600;
        letter-spacing: 0.5px;
        box-shadow: 0 4px 12px rgba(0, 123, 255, 0.3);
    }

    #<?php echo $unique_id; ?> .plan-badge.recommended {
        background: linear-gradient(135deg, #28a745, #20c997);
        box-shadow: 0 4px 12px rgba(40, 167, 69, 0.3);
    }

    /* 人気プランのスタイル */
    #<?php echo $unique_id; ?> .pricing-card.popular {
        border: 2px solid #007bff;
        transform: scale(1.05);
        box-shadow: 0 15px 40px rgba(0, 123, 255, 0.2);
    }

    #<?php echo $unique_id; ?> .pricing-card.popular:hover {
        transform: scale(1.05) translateY(-8px);
    }

    /* プランヘッダー */
    #<?php echo $unique_id; ?> .plan-header {
        text-align: center;
        margin-bottom: 2rem;
        padding-bottom: 1.5rem;
        border-bottom: 1px solid #f0f0f0;
    }

    #<?php echo $unique_id; ?> .plan-name {
        font-size: 1.5rem;
        font-weight: 700;
        color: #1a1a1a;
        margin-bottom: 1rem;
    }

    #<?php echo $unique_id; ?> .plan-price {
        margin-bottom: 0.8rem;
    }

    #<?php echo $unique_id; ?> .price-amount {
        font-size: 2.5rem;
        font-weight: 700;
        color: #007bff;
        line-height: 1;
    }

    #<?php echo $unique_id; ?> .price-period {
        font-size: 1rem;
        color: #666;
        font-weight: 500;
    }

    #<?php echo $unique_id; ?> .plan-description {
        color: #666;
        font-size: 0.95rem;
        line-height: 1.4;
        margin: 0;
    }

    /* プラン機能 */
    #<?php echo $unique_id; ?> .plan-features {
        flex-grow: 1;
        margin-bottom: 2rem;
        text-align: center;
    }

    #<?php echo $unique_id; ?> .plan-features h4 {
        font-size: 1.1rem;
        font-weight: 600;
        color: #333;
        margin-bottom: 1.5rem;
        border-bottom: 2px solid #f8f9fa;
        padding-bottom: 0.5rem;
        text-align: center;
    }

    #<?php echo $unique_id; ?> .features-list {
        list-style: none;
        padding: 0;
        margin: 0;
        display: inline-block;
        text-align: left;
    }

    #<?php echo $unique_id; ?> .features-list li {
        display: flex;
        align-items: center;
        padding: 0.6rem 0;
        color: #555;
        font-size: 0.95rem;
        line-height: 1.4;
        justify-content: flex-start;
    }

    #<?php echo $unique_id; ?> .features-list li i {
        color: #28a745;
        margin-right: 0.8rem;
        font-size: 0.9rem;
        width: 16px;
        flex-shrink: 0;
    }

    /* CTA部分 */
    #<?php echo $unique_id; ?> .plan-cta {
        text-align: center;
        margin-top: auto;
    }

    #<?php echo $unique_id; ?> .cta-btn {
        display: inline-block;
        padding: 1rem 2rem;
        background: linear-gradient(135deg, #6c757d, #495057);
        color: white;
        text-decoration: none;
        border-radius: 50px;
        font-weight: 600;
        font-size: 1rem;
        transition: all 0.3s ease;
        box-shadow: 0 4px 15px rgba(108, 117, 125, 0.3);
        margin-bottom: 0.8rem;
        min-width: 160px;
    }

    #<?php echo $unique_id; ?> .cta-btn:hover {
        background: linear-gradient(135deg, #495057, #343a40);
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(108, 117, 125, 0.4);
        color: white;
        text-decoration: none;
    }

    #<?php echo $unique_id; ?> .cta-btn.primary {
        background: linear-gradient(135deg, #007bff, #0056b3);
        box-shadow: 0 4px 15px rgba(0, 123, 255, 0.3);
    }

    #<?php echo $unique_id; ?> .cta-btn.primary:hover {
        background: linear-gradient(135deg, #0056b3, #004085);
        box-shadow: 0 8px 25px rgba(0, 123, 255, 0.4);
        color: white;
    }

    #<?php echo $unique_id; ?> .trial-note {
        color: #666;
        font-size: 0.85rem;
        margin: 0;
        font-style: italic;
    }

    /* 注意事項 */
    #<?php echo $unique_id; ?> .pricing-notes {
        text-align: center;
        max-width: 500px;
        margin: 0 auto;
        margin-top: 3rem;
        padding-top: 2rem;
        border-top: 1px solid #e9ecef;
    }

    #<?php echo $unique_id; ?> .pricing-notes p {
        color: #666;
        margin: 0 auto;
        font-size: 0.9rem;
        margin: 0.8rem 0;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 0.5rem;
        text-align: left;
    }

    #<?php echo $unique_id; ?> .pricing-notes i {
        color: #007bff;
        font-size: 0.9rem;
    }

    /* レスポンシブ対応 */
    @media (max-width: 1200px) {
        #<?php echo $unique_id; ?> {
            padding: 5rem 0;
        }
        
        #<?php echo $unique_id; ?> .pricing-plans {
            gap: 1.5rem;
            max-width: 100%;
            padding: 0 1rem;
        }
        
        #<?php echo $unique_id; ?> .pricing-card {
            padding: 2rem;
        }
    }

    @media (max-width: 992px) {
        #<?php echo $unique_id; ?> .pricing-plans {
            grid-template-columns: 1fr;
            max-width: 100%;
            gap: 2rem;
        }
        
        #<?php echo $unique_id; ?> .pricing-card {
            width: 100%;
            max-width: none;
        }
        
        #<?php echo $unique_id; ?> .pricing-card.popular {
            transform: none;
        }
        
        #<?php echo $unique_id; ?> .pricing-card.popular:hover {
            transform: translateY(-8px);
        }
    }

    @media (max-width: 768px) {
        #<?php echo $unique_id; ?> {
            padding: 4rem 0;
        }
        
        #<?php echo $unique_id; ?> .section-title {
            font-size: 2rem;
        }
        
        #<?php echo $unique_id; ?> .section-subtitle {
            font-size: 1.1rem;
            margin-bottom: 2rem;
        }
        
        #<?php echo $unique_id; ?> .pricing-plans {
            max-width: 100%;
            padding: 0;
        }
        
        #<?php echo $unique_id; ?> .pricing-card {
            padding: 2rem 1.5rem;
            width: 100%;
            max-width: none;
        }
        
        #<?php echo $unique_id; ?> .plan-name {
            font-size: 1.3rem;
        }
        
        #<?php echo $unique_id; ?> .price-amount {
            font-size: 2.2rem;
        }
        
        #<?php echo $unique_id; ?> .features-list li {
            font-size: 0.9rem;
            padding: 0.5rem 0;
        }
        
        #<?php echo $unique_id; ?> .cta-btn {
            padding: 0.9rem 1.8rem;
            font-size: 0.95rem;
        }
        
        #<?php echo $unique_id; ?> .pricing-notes {
            margin-top: 2rem;
        }
        
        #<?php echo $unique_id; ?> .pricing-notes p {
            flex-direction: row;
            gap: 0.5rem;
            margin: 1rem 0;
            flex-wrap: wrap;
            text-align: left;
        }
    }

    @media (max-width: 480px) {
        #<?php echo $unique_id; ?> {
            padding: 3rem 0;
        }
        
        #<?php echo $unique_id; ?> .pricing-plans {
            padding: 0;
            max-width: 100%;
        }
        
        #<?php echo $unique_id; ?> .pricing-card {
            padding: 1.5rem 1rem;
            width: 100%;
            max-width: none;
        }
        
        #<?php echo $unique_id; ?> .plan-badge {
            font-size: 0.8rem;
            padding: 0.4rem 1.2rem;
        }
        
        #<?php echo $unique_id; ?> .plan-name {
            font-size: 1.2rem;
        }
        
        #<?php echo $unique_id; ?> .price-amount {
            font-size: 2rem;
        }
        
        #<?php echo $unique_id; ?> .plan-features h4 {
            font-size: 1rem;
        }
        
        #<?php echo $unique_id; ?> .features-list li {
            font-size: 0.85rem;
        }
        
        #<?php echo $unique_id; ?> .cta-btn {
            padding: 0.8rem 1.5rem;
            font-size: 0.9rem;
            min-width: 140px;
        }
        
        #<?php echo $unique_id; ?> .pricing-notes p {
            font-size: 0.85rem;
        }
    }
    </style>
    
    <section id="<?php echo $unique_id; ?>" class="pricing-section">
        <div class="container">
            <h2 class="section-title"><?php echo esc_html($section_title); ?></h2>
            <?php if ($section_subtitle): ?>
                <p class="section-subtitle"><?php echo esc_html($section_subtitle); ?></p>
            <?php endif; ?>
            
            <div class="pricing-plans">
                <?php foreach ($plans as $plan): ?>
                    <div class="pricing-card <?php echo $plan['plan_badge'] === 'popular' ? 'popular' : ''; ?>">
                        <?php if ($plan['plan_badge']): ?>
                            <div class="plan-badge <?php echo $plan['plan_badge'] === 'recommended' ? 'recommended' : ''; ?>">
                                <?php echo $plan['plan_badge'] === 'popular' ? '人気No.1' : 'おすすめ'; ?>
                            </div>
                        <?php endif; ?>
                        
                        <div class="plan-header">
                            <h3 class="plan-name"><?php echo esc_html($plan['plan_name']); ?></h3>
                            <div class="plan-price">
                                <span class="price-amount"><?php echo esc_html($plan['plan_price']); ?></span>
                                <span class="price-period"><?php echo esc_html($plan['plan_period']); ?></span>
                            </div>
                            <p class="plan-description"><?php echo esc_html($plan['plan_description']); ?></p>
                        </div>
                        
                        <div class="plan-features">
                            <h4>含まれる機能</h4>
                            <ul class="features-list">
                                <?php foreach ($plan['plan_features'] as $feature): ?>
                                    <li><i class="fas fa-check"></i><?php echo esc_html($feature['feature_text']); ?></li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                        
                        <div class="plan-cta">
                            <a href="<?php echo esc_url($plan['plan_cta_url']); ?>" 
                               class="cta-btn <?php echo $plan['plan_badge'] === 'popular' ? 'primary' : ''; ?>">
                                <?php echo esc_html($plan['plan_cta_text']); ?>
                            </a>
                            <?php if ($plan['plan_trial_note']): ?>
                                <p class="trial-note"><?php echo esc_html($plan['plan_trial_note']); ?></p>
                            <?php endif; ?>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
            
            <?php if ($notes): ?>
                <div class="pricing-notes">
                    <?php foreach ($notes as $note): ?>
                        <p><i class="fas <?php echo esc_attr($note['note_icon']); ?>"></i> <?php echo esc_html($note['note_text']); ?></p>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
        </div>
    </section>
    
    <?php
    return ob_get_clean();
}

// ショートコード登録
add_shortcode('pricing_01_module', 'render_pricing_01_module');

// 管理画面でのプレビュー用
if (is_admin()) {
    add_action('admin_head', function() {
        echo '<style>
            .acf-fields .acf-field[data-name*="pricing_01"] .acf-label label {
                color: #007bff;
                font-weight: 600;
            }
        </style>';
    });
}
?> 