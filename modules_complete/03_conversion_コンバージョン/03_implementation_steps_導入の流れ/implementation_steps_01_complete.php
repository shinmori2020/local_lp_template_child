<?php
/**
 * Implementation Steps Module 01 - Complete Independent Version
 * ショートコード: [implementation_steps_01_module]
 * 
 * 導入の流れを段階的に表示するモジュール
 * 5つのステップ、サポート体制、CTAセクションを含む
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
        'key' => 'group_implementation_steps_01_complete',
        'title' => '導入の流れモジュール01設定',
        'fields' => array(
            array(
                'key' => 'field_impl_steps_01_title',
                'label' => 'セクションタイトル',
                'name' => 'impl_steps_01_title',
                'type' => 'text',
                'default_value' => '導入の流れ',
            ),
            array(
                'key' => 'field_impl_steps_01_subtitle',
                'label' => 'セクションサブタイトル',
                'name' => 'impl_steps_01_subtitle',
                'type' => 'text',
                'default_value' => 'お申し込みから運用開始まで、専任チームが丁寧にサポートします',
            ),
            array(
                'key' => 'field_impl_steps_01_steps',
                'label' => '導入ステップ',
                'name' => 'impl_steps_01_steps',
                'type' => 'repeater',
                'sub_fields' => array(
                    array(
                        'key' => 'field_step_number',
                        'label' => 'ステップ番号',
                        'name' => 'step_number',
                        'type' => 'text',
                        'default_value' => '01',
                    ),
                    array(
                        'key' => 'field_step_title',
                        'label' => 'ステップタイトル',
                        'name' => 'step_title',
                        'type' => 'text',
                        'default_value' => 'お問い合わせ・ヒアリング',
                    ),
                    array(
                        'key' => 'field_step_description',
                        'label' => 'ステップ説明',
                        'name' => 'step_description',
                        'type' => 'textarea',
                        'default_value' => 'お客様のご要望や現在の業務フローについて詳しくお聞かせください。最適なプランをご提案いたします。',
                    ),
                    array(
                        'key' => 'field_step_icon',
                        'label' => 'アイコン（Font Awesome）',
                        'name' => 'step_icon',
                        'type' => 'text',
                        'default_value' => 'fas fa-comments',
                        'instructions' => 'Font Awesomeのクラス名を入力（例: fas fa-comments）',
                    ),
                    array(
                        'key' => 'field_step_duration',
                        'label' => '所要時間',
                        'name' => 'step_duration',
                        'type' => 'text',
                        'default_value' => '1〜2時間',
                    ),
                    array(
                        'key' => 'field_step_support',
                        'label' => '担当者',
                        'name' => 'step_support',
                        'type' => 'text',
                        'default_value' => '専任コンサルタントが対応',
                    ),
                ),
                'min' => 1,
                'max' => 10,
                'button_label' => 'ステップを追加',
            ),
            array(
                'key' => 'field_impl_steps_01_support_title',
                'label' => 'サポート概要タイトル',
                'name' => 'impl_steps_01_support_title',
                'type' => 'text',
                'default_value' => '充実のサポート体制',
            ),
            array(
                'key' => 'field_impl_steps_01_support_items',
                'label' => 'サポート項目',
                'name' => 'impl_steps_01_support_items',
                'type' => 'repeater',
                'sub_fields' => array(
                    array(
                        'key' => 'field_support_icon',
                        'label' => 'アイコン（Font Awesome）',
                        'name' => 'support_icon',
                        'type' => 'text',
                        'default_value' => 'fas fa-phone-alt',
                    ),
                    array(
                        'key' => 'field_support_title',
                        'label' => 'サポートタイトル',
                        'name' => 'support_title',
                        'type' => 'text',
                        'default_value' => '電話サポート',
                    ),
                    array(
                        'key' => 'field_support_description',
                        'label' => 'サポート説明',
                        'name' => 'support_description',
                        'type' => 'textarea',
                        'default_value' => '平日9:00-18:00<br>お電話でのお問い合わせ対応',
                    ),
                ),
                'min' => 1,
                'max' => 8,
                'button_label' => 'サポート項目を追加',
            ),
            array(
                'key' => 'field_impl_steps_01_cta_title',
                'label' => 'CTAタイトル',
                'name' => 'impl_steps_01_cta_title',
                'type' => 'text',
                'default_value' => 'まずはお気軽にご相談ください',
            ),
            array(
                'key' => 'field_impl_steps_01_cta_description',
                'label' => 'CTA説明',
                'name' => 'impl_steps_01_cta_description',
                'type' => 'text',
                'default_value' => '導入についてのご質問やご不明点がございましたら、いつでもお問い合わせください。',
            ),
            array(
                'key' => 'field_impl_steps_01_cta_button_main',
                'label' => 'CTAボタンメインテキスト',
                'name' => 'impl_steps_01_cta_button_main',
                'type' => 'text',
                'default_value' => '無料相談を申し込む',
            ),
            array(
                'key' => 'field_impl_steps_01_cta_button_sub',
                'label' => 'CTAボタンサブテキスト',
                'name' => 'impl_steps_01_cta_button_sub',
                'type' => 'text',
                'default_value' => '専任コンサルタントがお答えします',
            ),
            array(
                'key' => 'field_impl_steps_01_cta_link',
                'label' => 'CTAリンク先',
                'name' => 'impl_steps_01_cta_link',
                'type' => 'text',
                'default_value' => '#contact',
            ),
            array(
                'key' => 'field_impl_steps_01_bg_color',
                'label' => '背景色',
                'name' => 'impl_steps_01_bg_color',
                'type' => 'select',
                'choices' => array(
                    'light-gradient' => 'ライトグラデーション（デフォルト）',
                    'white' => '白色',
                    'light-gray' => 'ライトグレー',
                    'blue-gradient' => 'ブルーグラデーション',
                ),
                'default_value' => 'light-gradient',
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
 * Implementation Steps 01 ショートコード
 */
function implementation_steps_01_shortcode($atts, $content = null) {
    // ショートコード属性の設定
    $atts = shortcode_atts(array(
        'title' => '',
        'subtitle' => '',
        'cta_title' => '',
        'cta_description' => '',
        'cta_button_main' => '',
        'cta_button_sub' => '',
        'cta_link' => '',
        'bg_color' => '',
        'post_id' => get_the_ID(),
    ), $atts);

    $post_id = $atts['post_id'];
    
    // ACFフィールドからデータを取得
    $title = $atts['title'] ?: get_field('impl_steps_01_title', $post_id) ?: '導入の流れ';
    $subtitle = $atts['subtitle'] ?: get_field('impl_steps_01_subtitle', $post_id) ?: 'お申し込みから運用開始まで、専任チームが丁寧にサポートします';
    $steps = get_field('impl_steps_01_steps', $post_id) ?: array();
    $support_title = get_field('impl_steps_01_support_title', $post_id) ?: '充実のサポート体制';
    $support_items = get_field('impl_steps_01_support_items', $post_id) ?: array();
    $cta_title = $atts['cta_title'] ?: get_field('impl_steps_01_cta_title', $post_id) ?: 'まずはお気軽にご相談ください';
    $cta_description = $atts['cta_description'] ?: get_field('impl_steps_01_cta_description', $post_id) ?: '導入についてのご質問やご不明点がございましたら、いつでもお問い合わせください。';
    $cta_button_main = $atts['cta_button_main'] ?: get_field('impl_steps_01_cta_button_main', $post_id) ?: '無料相談を申し込む';
    $cta_button_sub = $atts['cta_button_sub'] ?: get_field('impl_steps_01_cta_button_sub', $post_id) ?: '専任コンサルタントがお答えします';
    $cta_link = $atts['cta_link'] ?: get_field('impl_steps_01_cta_link', $post_id) ?: '#contact';
    $bg_color = $atts['bg_color'] ?: get_field('impl_steps_01_bg_color', $post_id) ?: 'light-gradient';

    // デフォルトデータ（ACFフィールドが空の場合）
    if (empty($steps)) {
        $steps = array(
            array(
                'step_number' => '01',
                'step_title' => 'お問い合わせ・ヒアリング',
                'step_description' => 'お客様のご要望や現在の業務フローについて詳しくお聞かせください。最適なプランをご提案いたします。',
                'step_icon' => 'fas fa-comments',
                'step_duration' => '1〜2時間',
                'step_support' => '専任コンサルタントが対応',
            ),
            array(
                'step_number' => '02',
                'step_title' => 'お見積もり・ご契約',
                'step_description' => 'ヒアリング内容を基に詳細なお見積もりを作成。内容にご納得いただけましたら、ご契約手続きを進めさせていただきます。',
                'step_icon' => 'fas fa-file-contract',
                'step_duration' => '3〜5営業日',
                'step_support' => '営業担当がサポート',
            ),
            array(
                'step_number' => '03',
                'step_title' => '環境構築・初期設定',
                'step_description' => 'お客様専用の環境を構築し、ご要望に応じたカスタマイズを実施。既存システムとの連携設定も行います。',
                'step_icon' => 'fas fa-cogs',
                'step_duration' => '3〜7営業日',
                'step_support' => '技術チームが対応',
            ),
            array(
                'step_number' => '04',
                'step_title' => '研修・トレーニング',
                'step_description' => '操作方法から活用法まで、実際の業務に即した研修を実施。全スタッフがスムーズに使えるようサポートします。',
                'step_icon' => 'fas fa-graduation-cap',
                'step_duration' => '2〜3営業日',
                'step_support' => '専任トレーナーが指導',
            ),
            array(
                'step_number' => '05',
                'step_title' => '運用開始・継続サポート',
                'step_description' => '本格運用開始後も、定期的なフォローアップと継続的なサポートで、効果的な活用をお手伝いします。',
                'step_icon' => 'fas fa-rocket',
                'step_duration' => '継続的にサポート',
                'step_support' => 'サポートチームが対応',
            ),
        );
    }

    if (empty($support_items)) {
        $support_items = array(
            array(
                'support_icon' => 'fas fa-phone-alt',
                'support_title' => '電話サポート',
                'support_description' => '平日9:00-18:00<br>お電話でのお問い合わせ対応',
            ),
            array(
                'support_icon' => 'fas fa-comments',
                'support_title' => 'チャットサポート',
                'support_description' => 'リアルタイムでの<br>迅速なサポート対応',
            ),
            array(
                'support_icon' => 'fas fa-envelope',
                'support_title' => 'メールサポート',
                'support_description' => '24時間受付<br>詳細なご質問にも対応',
            ),
            array(
                'support_icon' => 'fas fa-video',
                'support_title' => 'リモートサポート',
                'support_description' => '画面共有による<br>直接的なサポート',
            ),
        );
    }

    // ユニークIDの生成
    $unique_id = 'impl_steps_01_' . uniqid();

    // HTML出力の構築
    ob_start();
    ?>
    
    <style>
    /* 導入の流れ・ステップセクション */
    #<?php echo $unique_id; ?> {
        padding: 6rem 0;
        background: linear-gradient(135deg, #ffffff 0%, #f8f9ff 100%);
        position: relative;
        overflow: hidden;
    }

    /* セクションタイトル */
    #<?php echo $unique_id; ?> .section-title {
        font-size: 2.5rem;
        text-align: center;
        margin-bottom: 3rem;
        font-weight: bold;
        color: #333;
    }

    /* セクションサブタイトル */
    #<?php echo $unique_id; ?> .section-subtitle {
        text-align: center;
        font-size: 1.2rem;
        color: #666;
        margin-bottom: 3rem;
        margin-top: -1rem;
    }

    #<?php echo $unique_id; ?>::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><defs><pattern id="pattern" x="0" y="0" width="100" height="100" patternUnits="userSpaceOnUse"><circle cx="50" cy="50" r="0.5" fill="%23007bff" opacity="0.04"/></pattern></defs><rect width="100" height="100" fill="url(%23pattern)"/></svg>');
        pointer-events: none;
    }

    /* ステップコンテナ */
    #<?php echo $unique_id; ?> .steps-container {
        max-width: 1200px;
        margin: 0 auto 4rem;
        position: relative;
        z-index: 1;
    }

    /* ステップアイテム */
    #<?php echo $unique_id; ?> .step-item {
        display: flex;
        align-items: center;
        margin-bottom: 4rem;
        position: relative;
        width: 100%;
    }

    #<?php echo $unique_id; ?> .step-item:last-child {
        margin-bottom: 0;
    }

    /* 奇数番目のステップ（左側配置） */
    #<?php echo $unique_id; ?> .step-item:nth-child(odd) {
        justify-content: flex-start;
    }

    #<?php echo $unique_id; ?> .step-item:nth-child(odd) .step-content {
        margin-left: 0;
        margin-right: auto;
    }

    /* 偶数番目のステップ（右側配置） */
    #<?php echo $unique_id; ?> .step-item:nth-child(even) {
        justify-content: flex-end;
    }

    #<?php echo $unique_id; ?> .step-item:nth-child(even) .step-content {
        margin-left: auto;
        margin-right: 0;
    }

    /* ステップ番号 */
    #<?php echo $unique_id; ?> .step-number {
        width: 90px;
        height: 90px;
        background: linear-gradient(135deg, #007bff, #0056b3);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
        position: absolute;
        left: 50%;
        transform: translateX(-50%);
        z-index: 3;
        transition: all 0.3s ease;
    }

    #<?php echo $unique_id; ?> .step-number:hover {
        /* ホバーエフェクトを削除 */
    }

    #<?php echo $unique_id; ?> .step-number span {
        font-size: 1.6rem;
        font-weight: 700;
        color: white;
    }

    /* 中央線の配置 */
    #<?php echo $unique_id; ?> .steps-container::before {
        content: '';
        position: absolute;
        left: 50%;
        top: 45px;
        bottom: 45px;
        width: 2px;
        background: linear-gradient(180deg, #007bff 0%, #e9ecef 50%, #007bff 100%);
        transform: translateX(-50%);
        z-index: 1;
    }

    /* ステップコンテンツ */
    #<?php echo $unique_id; ?> .step-content {
        background: #f1f3f4;
        border-radius: 20px;
        padding: 2.5rem;
        width: calc(50% - 45px);
        max-width: 480px;
        transition: all 0.3s ease;
        position: relative;
        z-index: 2;
    }

    #<?php echo $unique_id; ?> .step-content:hover {
        transform: translateY(-8px);
    }

    /* コンテンツの三角形装飾 */
    #<?php echo $unique_id; ?> .step-item:nth-child(odd) .step-content::before {
        content: '';
        position: absolute;
        right: -15px;
        top: 50%;
        transform: translateY(-50%);
        width: 0;
        height: 0;
        border-top: 15px solid transparent;
        border-bottom: 15px solid transparent;
        border-left: 15px solid #f1f3f4;
        z-index: -1;
    }

    #<?php echo $unique_id; ?> .step-item:nth-child(even) .step-content::before {
        content: '';
        position: absolute;
        left: -15px;
        top: 50%;
        transform: translateY(-50%);
        width: 0;
        height: 0;
        border-top: 15px solid transparent;
        border-bottom: 15px solid transparent;
        border-right: 15px solid #f1f3f4;
        z-index: -1;
    }

    /* ステップ見出しとアイコンのコンテナ */
    #<?php echo $unique_id; ?> .step-header {
        display: flex;
        align-items: center;
        margin-bottom: 1rem;
        gap: 1rem;
    }

    /* ステップアイコン */
    #<?php echo $unique_id; ?> .step-icon {
        width: 50px;
        height: 50px;
        background: linear-gradient(135deg, #6c757d, #495057);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
        transition: all 0.3s ease;
        order: 1;
    }

    #<?php echo $unique_id; ?> .step-icon i {
        font-size: 1.3rem;
        color: white;
    }

    #<?php echo $unique_id; ?> .step-content:hover .step-icon {
        transform: scale(1.1);
        background: linear-gradient(135deg, #007bff, #0056b3);
    }

    /* ステップ見出し */
    #<?php echo $unique_id; ?> .step-content h3 {
        font-size: 1.4rem;
        font-weight: 700;
        color: #1a1a1a;
        margin: 0;
        order: 2;
    }

    #<?php echo $unique_id; ?> .step-description {
        color: #555;
        line-height: 1.6;
        margin-bottom: 1.5rem;
        font-size: 0.95rem;
    }

    /* ステップ詳細 */
    #<?php echo $unique_id; ?> .step-details {
        display: flex;
        flex-direction: column;
        gap: 0.8rem;
        align-items: flex-start;
        text-align: left;
    }

    #<?php echo $unique_id; ?> .step-duration,
    #<?php echo $unique_id; ?> .step-support {
        display: flex;
        align-items: center;
        font-size: 0.9rem;
        color: #666;
        text-align: left;
        padding: 0;
    }

    #<?php echo $unique_id; ?> .step-duration i,
    #<?php echo $unique_id; ?> .step-support i {
        margin-right: 0.5rem;
        color: #007bff;
        width: 16px;
    }

    /* サポート概要 */
    #<?php echo $unique_id; ?> .support-summary {
        background: #fff;
        border-radius: 20px;
        padding: 3rem;
        border: 1px solid rgba(0, 123, 255, 0.1);
        margin-bottom: 3rem;
        text-align: center;
        position: relative;
        z-index: 1;
    }

    #<?php echo $unique_id; ?> .support-summary h3 {
        font-size: 1.8rem;
        font-weight: 700;
        color: #1a1a1a;
        margin-bottom: 2rem;
    }

    #<?php echo $unique_id; ?> .support-grid {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 2rem;
        margin-top: 2rem;
    }

    #<?php echo $unique_id; ?> .support-item {
        text-align: center;
        padding: 1.5rem;
        background: linear-gradient(135deg, #f8f9ff 0%, #ffffff 100%);
        border-radius: 15px;
        transition: all 0.3s ease;
        border: 1px solid rgba(0, 123, 255, 0.05);
    }

    #<?php echo $unique_id; ?> .support-item:hover {
        transform: translateY(-5px);
    }

    #<?php echo $unique_id; ?> .support-item i {
        font-size: 2rem;
        color: #007bff;
        margin-bottom: 1rem;
    }

    #<?php echo $unique_id; ?> .support-item h4 {
        font-size: 1.1rem;
        font-weight: 600;
        color: #1a1a1a;
        margin-bottom: 0.8rem;
    }

    #<?php echo $unique_id; ?> .support-item p {
        color: #666;
        font-size: 0.9rem;
        line-height: 1.4;
        margin: 0;
    }

    /* ステップセクション専用CTA部分 */
    #<?php echo $unique_id; ?> .steps-cta-container {
        display: flex;
        align-items: center;
        gap: 3rem;
        background: linear-gradient(135deg, #007bff, #0056b3);
        border-radius: 20px;
        padding: 3rem;
        color: white;
        position: relative;
        z-index: 1;
    }

    #<?php echo $unique_id; ?> .steps-cta-text {
        flex: 1;
        text-align: left;
    }

    #<?php echo $unique_id; ?> .steps-cta-text h3 {
        font-size: 1.6rem;
        font-weight: 700;
        margin-bottom: 1rem;
        color: white;
    }

    #<?php echo $unique_id; ?> .steps-cta-text p {
        font-size: 1rem;
        margin-bottom: 0;
        opacity: 0.9;
        color: white;
    }

    #<?php echo $unique_id; ?> .steps-cta-button-wrapper {
        flex-shrink: 0;
    }

    #<?php echo $unique_id; ?> .steps-cta-button {
        display: inline-flex;
        flex-direction: column;
        align-items: center;
        padding: 1.5rem 3rem;
        background: #fff;
        color: #007bff;
        text-decoration: none;
        border-radius: 50px;
        font-weight: 600;
        transition: all 0.3s ease;
    }

    #<?php echo $unique_id; ?> .steps-cta-button:hover {
        transform: translateY(-3px);
        color: #0056b3;
        text-decoration: none;
    }

    #<?php echo $unique_id; ?> .steps-cta-main {
        font-size: 1.1rem;
        font-weight: 700;
    }

    #<?php echo $unique_id; ?> .steps-cta-sub {
        font-size: 0.9rem;
        margin-top: 0.3rem;
        opacity: 0.8;
    }

    /* レスポンシブ対応 */
    @media (max-width: 1200px) {
        #<?php echo $unique_id; ?> {
            padding: 5rem 0;
        }
        
        #<?php echo $unique_id; ?> .step-content {
            padding: 2rem;
        }
    }

    /* タブレット用レスポンシブ対応（1020px以下） */
    @media (max-width: 1020px) {
        #<?php echo $unique_id; ?> .section-title {
            font-size: 2.25rem;
            margin-bottom: 2.5rem;
        }
    }

    @media (max-width: 992px) {
        #<?php echo $unique_id; ?> .steps-container::before {
            display: none;
        }

        #<?php echo $unique_id; ?> .step-item {
            flex-direction: column !important;
            align-items: center;
            text-align: center;
            margin-bottom: 3rem;
            justify-content: center !important;
            position: relative;
        }

        #<?php echo $unique_id; ?> .step-item:nth-child(odd),
        #<?php echo $unique_id; ?> .step-item:nth-child(even) {
            justify-content: center !important;
        }

        #<?php echo $unique_id; ?> .step-number {
            position: relative;
            left: auto;
            transform: none;
            margin-bottom: 1.5rem;
            order: 1;
        }

        #<?php echo $unique_id; ?> .step-content {
            max-width: 100%;
            width: 100%;
            margin-left: 0 !important;
            margin-right: 0 !important;
            order: 2;
            text-align: center;
        }

        #<?php echo $unique_id; ?> .step-header {
            justify-content: center;
            text-align: center;
        }

        #<?php echo $unique_id; ?> .step-details {
            align-items: center;
            text-align: center;
        }

        #<?php echo $unique_id; ?> .step-content::before {
            display: none;
        }

        /* モバイル用の接続線 */
        #<?php echo $unique_id; ?> .step-item:not(:last-child)::after {
            content: '';
            position: absolute;
            left: 50%;
            top: 45px;
            width: 2px;
            height: calc(100% - 45px + 3rem);
            background: linear-gradient(180deg, #007bff, #e9ecef);
            transform: translateX(-50%);
            z-index: 0;
        }

        #<?php echo $unique_id; ?> .support-grid {
            grid-template-columns: repeat(2, 1fr);
            gap: 1.5rem;
        }
    }

    @media (max-width: 768px) {
        #<?php echo $unique_id; ?> {
            padding: 4rem 0;
        }
        
        #<?php echo $unique_id; ?> .section-title {
            font-size: 2rem;
            margin-bottom: 2rem;
        }
        
        #<?php echo $unique_id; ?> .step-item {
            margin-bottom: 2.5rem;
        }

        #<?php echo $unique_id; ?> .step-item:not(:last-child)::after {
            top: 35px;
            height: calc(100% - 35px + 2.5rem);
        }
        
        #<?php echo $unique_id; ?> .step-number {
            width: 70px;
            height: 70px;
        }
        
        #<?php echo $unique_id; ?> .step-number span {
            font-size: 1.3rem;
        }
        
        #<?php echo $unique_id; ?> .step-content {
            padding: 2rem;
            max-width: none;
            border-radius: 15px;
        }
        
        #<?php echo $unique_id; ?> .step-content h3 {
            font-size: 1.3rem;
        }
        
        #<?php echo $unique_id; ?> .step-description {
            font-size: 0.95rem;
            margin-bottom: 1.2rem;
        }
        
        #<?php echo $unique_id; ?> .step-details {
            gap: 0.8rem;
        }
        
        #<?php echo $unique_id; ?> .step-duration,
        #<?php echo $unique_id; ?> .step-support {
            font-size: 0.9rem;
        }

        #<?php echo $unique_id; ?> .step-header {
            margin-bottom: 0.8rem;
            gap: 0.8rem;
            justify-content: center;
            align-items: center;
        }

        #<?php echo $unique_id; ?> .step-details {
            align-items: center;
            text-align: center;
        }

        #<?php echo $unique_id; ?> .step-icon {
            width: 45px;
            height: 45px;
        }

        #<?php echo $unique_id; ?> .step-icon i {
            font-size: 1.1rem;
        }
        
        #<?php echo $unique_id; ?> .support-summary {
            padding: 2.5rem;
            border-radius: 15px;
        }
        
        #<?php echo $unique_id; ?> .support-summary h3 {
            font-size: 1.6rem;
            margin-bottom: 1.8rem;
        }
        
        #<?php echo $unique_id; ?> .support-grid {
            grid-template-columns: 1fr;
            gap: 1.2rem;
        }
        
        #<?php echo $unique_id; ?> .support-item {
            padding: 1.5rem;
            border-radius: 12px;
        }

        #<?php echo $unique_id; ?> .support-item i {
            font-size: 1.8rem;
            margin-bottom: 1rem;
        }

        #<?php echo $unique_id; ?> .support-item h4 {
            font-size: 1.1rem;
            margin-bottom: 0.8rem;
        }

        #<?php echo $unique_id; ?> .support-item p {
            font-size: 0.9rem;
        }
        
        #<?php echo $unique_id; ?> .steps-cta-container {
            flex-direction: column;
            text-align: center;
            gap: 2rem;
            padding: 2.5rem;
            border-radius: 15px;
        }

        #<?php echo $unique_id; ?> .steps-cta-text {
            text-align: center;
        }
        
        #<?php echo $unique_id; ?> .steps-cta-text h3 {
            font-size: 1.5rem;
            margin-bottom: 1rem;
        }

        #<?php echo $unique_id; ?> .steps-cta-text p {
            font-size: 0.95rem;
            margin-bottom: 1.5rem;
        }
        
        #<?php echo $unique_id; ?> .steps-cta-button {
            flex-direction: row;
            align-items: center;
            gap: 1rem;
            padding: 1.2rem 2.5rem;
            font-size: 1rem;
        }

        #<?php echo $unique_id; ?> .steps-cta-main {
            margin: 0;
        }

        #<?php echo $unique_id; ?> .steps-cta-sub {
            margin: 0;
        }
    }

    /* スマートフォン（600px以下） */
    @media (max-width: 600px) {
        #<?php echo $unique_id; ?> .steps-cta-button {
            flex-direction: column;
            align-items: center;
            gap: 0.5rem;
        }

        #<?php echo $unique_id; ?> .steps-cta-main {
            margin-bottom: 0.25rem;
        }

        #<?php echo $unique_id; ?> .steps-cta-sub {
            margin-top: 0;
        }
    }

    @media (max-width: 480px) {
        #<?php echo $unique_id; ?> {
            padding: 3rem 0;
        }
        
        #<?php echo $unique_id; ?> .section-title {
            font-size: 1.75rem;
            margin-bottom: 1.75rem;
            line-height: 1.4;
        }
        
        #<?php echo $unique_id; ?> .step-item {
            margin-bottom: 2rem;
        }

        #<?php echo $unique_id; ?> .step-item:not(:last-child)::after {
            top: 30px;
            height: calc(100% - 30px + 2rem);
        }
        
        #<?php echo $unique_id; ?> .step-number {
            width: 60px;
            height: 60px;
            margin-bottom: 1rem;
            order: 1;
        }
        
        #<?php echo $unique_id; ?> .step-number span {
            font-size: 1.1rem;
        }
        
        #<?php echo $unique_id; ?> .step-content {
            padding: 1.5rem;
            border-radius: 12px;
            order: 2;
        }
        
        #<?php echo $unique_id; ?> .step-header {
            margin-bottom: 0.6rem;
            gap: 0.6rem;
            justify-content: center;
        }

        #<?php echo $unique_id; ?> .step-details {
            align-items: center;
            text-align: center;
        }

        #<?php echo $unique_id; ?> .step-icon {
            width: 40px;
            height: 40px;
        }
        
        #<?php echo $unique_id; ?> .step-icon i {
            font-size: 1rem;
        }
        
        #<?php echo $unique_id; ?> .step-content h3 {
            font-size: 1.2rem;
            margin-bottom: 0.8rem;
        }
        
        #<?php echo $unique_id; ?> .step-description {
            font-size: 0.9rem;
            margin-bottom: 1rem;
        }

        #<?php echo $unique_id; ?> .step-details {
            gap: 0.6rem;
        }

        #<?php echo $unique_id; ?> .step-duration,
        #<?php echo $unique_id; ?> .step-support {
            font-size: 0.85rem;
        }
        
        #<?php echo $unique_id; ?> .support-summary {
            padding: 2rem;
            border-radius: 12px;
        }
        
        #<?php echo $unique_id; ?> .support-summary h3 {
            font-size: 1.4rem;
            margin-bottom: 1.5rem;
        }
        
        #<?php echo $unique_id; ?> .support-item {
            padding: 1.2rem;
            border-radius: 10px;
        }
        
        #<?php echo $unique_id; ?> .support-item i {
            font-size: 1.6rem;
            margin-bottom: 0.8rem;
        }
        
        #<?php echo $unique_id; ?> .support-item h4 {
            font-size: 1rem;
            margin-bottom: 0.6rem;
        }
        
        #<?php echo $unique_id; ?> .support-item p {
            font-size: 0.85rem;
            line-height: 1.4;
        }

        #<?php echo $unique_id; ?> .steps-cta-container {
            flex-direction: column;
            text-align: center;
            gap: 1.5rem;
            padding: 2rem;
            border-radius: 12px;
        }

        #<?php echo $unique_id; ?> .steps-cta-text {
            text-align: center;
        }

        #<?php echo $unique_id; ?> .steps-cta-text h3 {
            font-size: 1.3rem;
            margin-bottom: 0.8rem;
        }

        #<?php echo $unique_id; ?> .steps-cta-text p {
            font-size: 0.9rem;
            margin-bottom: 0;
        }

        #<?php echo $unique_id; ?> .steps-cta-button {
            flex-direction: column;
            align-items: center;
            gap: 0.5rem;
            padding: 1rem 2rem;
            font-size: 0.95rem;
            border-radius: 40px;
        }

        #<?php echo $unique_id; ?> .steps-cta-main {
            font-size: 1rem;
        }

        #<?php echo $unique_id; ?> .steps-cta-sub {
            font-size: 0.8rem;
        }
    }
    </style>
    
    <section id="<?php echo esc_attr($unique_id); ?>">
        <div class="container">
            <h2 class="section-title"><?php echo esc_html($title); ?></h2>
            <p class="section-subtitle"><?php echo esc_html($subtitle); ?></p>
                
                <div class="steps-container">
                    <?php foreach ($steps as $index => $step): ?>
                        <div class="step-item">
                            <div class="step-number">
                                <span><?php echo esc_html($step['step_number']); ?></span>
                            </div>
                            <div class="step-content">
                                <div class="step-header">
                                    <div class="step-icon">
                                        <i class="<?php echo esc_attr($step['step_icon']); ?>"></i>
                                    </div>
                                    <h3><?php echo esc_html($step['step_title']); ?></h3>
                                </div>
                                <p class="step-description"><?php echo esc_html($step['step_description']); ?></p>
                                <div class="step-details">
                                    <div class="step-duration">
                                        <i class="fas fa-clock"></i>
                                        <span>所要時間：<?php echo esc_html($step['step_duration']); ?></span>
                                    </div>
                                    <div class="step-support">
                                        <i class="fas fa-user-tie"></i>
                                        <span><?php echo esc_html($step['step_support']); ?></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>

                <div class="support-summary">
                    <h3><?php echo esc_html($support_title); ?></h3>
                    <div class="support-grid">
                        <?php foreach ($support_items as $item): ?>
                            <div class="support-item">
                                <i class="<?php echo esc_attr($item['support_icon']); ?>"></i>
                                <h4><?php echo esc_html($item['support_title']); ?></h4>
                                <p><?php echo wp_kses_post($item['support_description']); ?></p>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>

                <div class="steps-cta-container">
                    <div class="steps-cta-text">
                        <h3><?php echo esc_html($cta_title); ?></h3>
                        <p><?php echo esc_html($cta_description); ?></p>
                    </div>
                    <div class="steps-cta-button-wrapper">
                        <a href="<?php echo esc_url($cta_link); ?>" class="steps-cta-button">
                            <span class="steps-cta-main"><?php echo esc_html($cta_button_main); ?></span>
                            <span class="steps-cta-sub"><?php echo esc_html($cta_button_sub); ?></span>
                        </a>
                    </div>
                </div>
            </div>
        </section>
    <?php
    
    return ob_get_clean();
}

// ショートコードを登録
add_shortcode('implementation_steps_01_module', 'implementation_steps_01_shortcode');

// 使用状況をログに記録
if (!is_admin()) {
    error_log('Implementation Steps 01 Module loaded successfully');
} 