<?php
/**
 * Unique Points 01 Module - Complete Version
 * 
 * 選ばれる5つの理由・差別化ポイントセクション
 * 数値付きグリッドレイアウトで企業の強みを訴求
 * 
 * Features:
 * - 5つの差別化ポイント表示
 * - 数値付きデザイン（01-05）
 * - ホバーエフェクト付き
 * - 完全レスポンシブ対応
 * - アニメーション効果
 * 
 * @package Local_LP_Template_Child
 * @version 1.0.0
 */

// 直接アクセスを防ぐ
if (!defined('ABSPATH')) {
    exit;
}

// ACFフィールド定義
function register_unique_points_01_fields() {
    if (function_exists('acf_add_local_field_group')) {
        acf_add_local_field_group(array(
            'key' => 'group_unique_points_01_complete',
            'title' => 'Unique Points 01 Module (差別化ポイント)',
            'fields' => array(
                array(
                    'key' => 'unique_points_01_section_title',
                    'label' => 'セクションタイトル',
                    'name' => 'unique_points_01_section_title',
                    'type' => 'text',
                    'default_value' => '選ばれる5つの理由',
                    'required' => 1,
                ),
                array(
                    'key' => 'unique_points_01_point_1_title',
                    'label' => 'ポイント1 タイトル',
                    'name' => 'unique_points_01_point_1_title',
                    'type' => 'text',
                    'default_value' => '業界最短の導入期間',
                    'required' => 1,
                ),
                array(
                    'key' => 'unique_points_01_point_1_description',
                    'label' => 'ポイント1 説明',
                    'name' => 'unique_points_01_point_1_description',
                    'type' => 'textarea',
                    'default_value' => '申し込みから最短3日で導入完了。専任のサポートスタッフが手厚くサポートします。',
                    'required' => 1,
                ),
                array(
                    'key' => 'unique_points_01_point_2_title',
                    'label' => 'ポイント2 タイトル',
                    'name' => 'unique_points_01_point_2_title',
                    'type' => 'text',
                    'default_value' => '柔軟なカスタマイズ',
                    'required' => 1,
                ),
                array(
                    'key' => 'unique_points_01_point_2_description',
                    'label' => 'ポイント2 説明',
                    'name' => 'unique_points_01_point_2_description',
                    'type' => 'textarea',
                    'default_value' => '業種・規模を問わず、お客様の業務フローに合わせた最適なカスタマイズが可能です。',
                    'required' => 1,
                ),
                array(
                    'key' => 'unique_points_01_point_3_title',
                    'label' => 'ポイント3 タイトル',
                    'name' => 'unique_points_01_point_3_title',
                    'type' => 'text',
                    'default_value' => '手厚いサポート体制',
                    'required' => 1,
                ),
                array(
                    'key' => 'unique_points_01_point_3_description',
                    'label' => 'ポイント3 説明',
                    'name' => 'unique_points_01_point_3_description',
                    'type' => 'textarea',
                    'default_value' => '導入後も専任のサポートチームが継続的にフォロー。平均応答時間30分以内を実現。',
                    'required' => 1,
                ),
                array(
                    'key' => 'unique_points_01_point_4_title',
                    'label' => 'ポイント4 タイトル',
                    'name' => 'unique_points_01_point_4_title',
                    'type' => 'text',
                    'default_value' => '充実した研修プログラム',
                    'required' => 1,
                ),
                array(
                    'key' => 'unique_points_01_point_4_description',
                    'label' => 'ポイント4 説明',
                    'name' => 'unique_points_01_point_4_description',
                    'type' => 'textarea',
                    'default_value' => '初心者でも安心の段階的な研修システム。オンライン・オフライン両方で学習できます。',
                    'required' => 1,
                ),
                array(
                    'key' => 'unique_points_01_point_5_title',
                    'label' => 'ポイント5 タイトル',
                    'name' => 'unique_points_01_point_5_title',
                    'type' => 'text',
                    'default_value' => 'セキュリティ対策',
                    'required' => 1,
                ),
                array(
                    'key' => 'unique_points_01_point_5_description',
                    'label' => 'ポイント5 説明',
                    'name' => 'unique_points_01_point_5_description',
                    'type' => 'textarea',
                    'default_value' => '国際基準に準拠したセキュリティ体制で、お客様の大切なデータを確実に保護します。',
                    'required' => 1,
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
register_unique_points_01_fields();

// ショートコード関数
function render_unique_points_01_module($atts) {
    $atts = shortcode_atts(array(
        'location' => 'auto'
    ), $atts);
    
    // 現在の投稿IDを取得
    $post_id = get_the_ID();
    if (!$post_id) {
        global $post;
        $post_id = $post ? $post->ID : 0;
    }
    
    // ACFフィールドから値を取得
    $section_title = get_field('unique_points_01_section_title', $post_id);
    $point_1_title = get_field('unique_points_01_point_1_title', $post_id);
    $point_1_description = get_field('unique_points_01_point_1_description', $post_id);
    $point_2_title = get_field('unique_points_01_point_2_title', $post_id);
    $point_2_description = get_field('unique_points_01_point_2_description', $post_id);
    $point_3_title = get_field('unique_points_01_point_3_title', $post_id);
    $point_3_description = get_field('unique_points_01_point_3_description', $post_id);
    $point_4_title = get_field('unique_points_01_point_4_title', $post_id);
    $point_4_description = get_field('unique_points_01_point_4_description', $post_id);
    $point_5_title = get_field('unique_points_01_point_5_title', $post_id);
    $point_5_description = get_field('unique_points_01_point_5_description', $post_id);
    
    // 必須フィールドのチェック
    if (!$section_title || !$point_1_title || !$point_1_description || 
        !$point_2_title || !$point_2_description || !$point_3_title || !$point_3_description ||
        !$point_4_title || !$point_4_description || !$point_5_title || !$point_5_description) {
        return '';
    }
    
    // ユニークIDを生成（複数配置対応）
    $unique_id = 'unique_points_01_' . uniqid();
    
    ob_start();
    ?>
    
    <style>
    /* 差別化ポイントセクション */
    #<?php echo $unique_id; ?> {
        padding: 7rem 0;
        background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
        position: relative;
        overflow: hidden;
    }

    #<?php echo $unique_id; ?>::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: linear-gradient(45deg, rgba(74, 144, 226, 0.05) 0%, rgba(103, 184, 227, 0.05) 100%);
    }

    #<?php echo $unique_id; ?> .unique-points {
        position: relative;
        z-index: 1;
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

    #<?php echo $unique_id; ?> .points-grid {
        display: flex;
        flex-wrap: wrap;
        justify-content: center;
        gap: 2rem;
        padding: 2rem;
        max-width: 1200px;
        margin: 0 auto;
    }

    #<?php echo $unique_id; ?> .point-item {
        flex: 0 0 calc(33.333% - 2rem);
        min-width: 300px;
        background: #fff;
        padding: 3rem 2rem;
        position: relative;
        clip-path: polygon(5% 0, 95% 0, 100% 5%, 100% 95%, 95% 100%, 5% 100%, 0 95%, 0 5%);
        transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        cursor: pointer;
        opacity: 0;
        animation: fadeInUp 0.6s ease-out forwards;
    }

    #<?php echo $unique_id; ?> .point-item::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: linear-gradient(135deg, rgba(74, 144, 226, 0.1) 0%, rgba(103, 184, 227, 0.1) 100%);
        opacity: 0;
        transition: opacity 0.4s ease;
    }

    #<?php echo $unique_id; ?> .point-item:hover {
        transform: translateY(-10px) scale(1.02);
        box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
    }

    #<?php echo $unique_id; ?> .point-item:hover::before {
        opacity: 1;
    }

    #<?php echo $unique_id; ?> .point-number {
        font-size: 4rem;
        font-weight: 800;
        background: linear-gradient(135deg, #4A90E2, #67B8E3);
        -webkit-background-clip: text;
        background-clip: text;
        -webkit-text-fill-color: transparent;
        color: transparent;
        display: block;
        margin-bottom: 1.5rem;
        line-height: 1;
        font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif;
        position: relative;
    }

    #<?php echo $unique_id; ?> .point-number::after {
        content: '';
        position: absolute;
        bottom: -0.5rem;
        left: 0;
        width: 40px;
        height: 3px;
        background: linear-gradient(90deg, #4A90E2, #67B8E3);
        border-radius: 1.5px;
    }

    #<?php echo $unique_id; ?> .point-item h4 {
        font-size: 1.5rem;
        margin-bottom: 1.2rem;
        color: #333;
        font-weight: 700;
        position: relative;
    }

    #<?php echo $unique_id; ?> .point-item p {
        color: #666;
        line-height: 1.8;
        font-size: 1.1rem;
        position: relative;
    }

    /* アニメーション */
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

    #<?php echo $unique_id; ?> .point-item:nth-child(2) {
        animation-delay: 0.15s;
    }

    #<?php echo $unique_id; ?> .point-item:nth-child(3) {
        animation-delay: 0.3s;
    }

    #<?php echo $unique_id; ?> .point-item:nth-child(4) {
        animation-delay: 0.45s;
    }

    #<?php echo $unique_id; ?> .point-item:nth-child(5) {
        animation-delay: 0.6s;
    }

    /* レスポンシブ対応 */
    @media (max-width: 1200px) {
        #<?php echo $unique_id; ?> .points-grid {
            padding: 1rem;
        }

        #<?php echo $unique_id; ?> .point-item {
            flex: 0 0 calc(50% - 2rem);
        }
    }

    @media (max-width: 767px) {
        #<?php echo $unique_id; ?> {
            padding: 5rem 0;
        }

        #<?php echo $unique_id; ?> .section-title {
            font-size: 2rem;
            margin-bottom: 3rem;
        }

        #<?php echo $unique_id; ?> .points-grid {
            gap: 1rem;
        }

        #<?php echo $unique_id; ?> .point-item {
            flex: 0 0 100%;
            padding: 2.5rem 1.5rem;
        }

        #<?php echo $unique_id; ?> .point-number {
            font-size: 3.5rem;
        }

        #<?php echo $unique_id; ?> .point-item h4 {
            font-size: 1.3rem;
        }

        #<?php echo $unique_id; ?> .point-item p {
            font-size: 1rem;
        }
    }

    @media (max-width: 414px) {
        #<?php echo $unique_id; ?> {
            padding: 4rem 0;
        }

        #<?php echo $unique_id; ?> .section-title {
            font-size: 1.75rem;
            margin-bottom: 2.5rem;
        }

        #<?php echo $unique_id; ?> .point-item {
            padding: 2rem 1.25rem;
            min-width: auto;
        }

        #<?php echo $unique_id; ?> .point-number {
            font-size: 3rem;
        }

        #<?php echo $unique_id; ?> .point-item h4 {
            font-size: 1.2rem;
            margin-bottom: 1rem;
        }

        #<?php echo $unique_id; ?> .point-item p {
            font-size: 0.95rem;
            line-height: 1.7;
        }
    }
    </style>
    
    <section id="<?php echo $unique_id; ?>" class="unique-points-section">
        <div class="container">
            <div class="unique-points">
                <h2 class="section-title"><?php echo esc_html($section_title); ?></h2>
                <div class="points-grid">
                    <div class="point-item">
                        <span class="point-number">01</span>
                        <h4><?php echo esc_html($point_1_title); ?></h4>
                        <p><?php echo esc_html($point_1_description); ?></p>
                    </div>
                    <div class="point-item">
                        <span class="point-number">02</span>
                        <h4><?php echo esc_html($point_2_title); ?></h4>
                        <p><?php echo esc_html($point_2_description); ?></p>
                    </div>
                    <div class="point-item">
                        <span class="point-number">03</span>
                        <h4><?php echo esc_html($point_3_title); ?></h4>
                        <p><?php echo esc_html($point_3_description); ?></p>
                    </div>
                    <div class="point-item">
                        <span class="point-number">04</span>
                        <h4><?php echo esc_html($point_4_title); ?></h4>
                        <p><?php echo esc_html($point_4_description); ?></p>
                    </div>
                    <div class="point-item">
                        <span class="point-number">05</span>
                        <h4><?php echo esc_html($point_5_title); ?></h4>
                        <p><?php echo esc_html($point_5_description); ?></p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    
    <?php
    return ob_get_clean();
}

// ショートコード登録
add_shortcode('unique_points_01_module', 'render_unique_points_01_module');

// 管理画面でのプレビュー用
if (is_admin()) {
    add_action('admin_head', function() {
        echo '<style>
            .acf-fields .acf-field[data-name*="unique_points_01"] .acf-label label {
                color: #4A90E2;
                font-weight: 600;
            }
        </style>';
    });
}
?> 