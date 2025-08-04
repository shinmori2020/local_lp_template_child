<?php
/**
 * Problem Module - Complete Independent Version
 * ショートコード: [problem_module]
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
            'key' => 'group_problem_complete',
            'title' => '課題モジュール設定',
            'fields' => array(
                array(
                    'key' => 'field_problem_title',
                    'label' => 'セクションタイトル',
                    'name' => 'problem_title',
                    'type' => 'text',
                    'default_value' => 'こんな課題はありませんか？',
                ),
                array(
                    'key' => 'field_problem_subtitle',
                    'label' => 'サブタイトル',
                    'name' => 'problem_subtitle',
                    'type' => 'text',
                    'default_value' => '多くの企業が抱える共通の悩みです',
                ),
                array(
                    'key' => 'field_problem_cards',
                    'label' => '課題カード',
                    'name' => 'problem_cards',
                    'type' => 'repeater',
                    'sub_fields' => array(
                        array(
                            'key' => 'field_problem_card_title',
                            'label' => 'タイトル',
                            'name' => 'title',
                            'type' => 'text',
                        ),
                        array(
                            'key' => 'field_problem_card_description',
                            'label' => '説明',
                            'name' => 'description',
                            'type' => 'textarea',
                        ),
                    ),
                    'min' => 1,
                    'max' => 6,
                ),
                array(
                    'key' => 'field_problem_style',
                    'label' => 'デザインスタイル',
                    'name' => 'problem_style',
                    'type' => 'select',
                    'choices' => array(
                        'cards' => 'カードスタイル',
                        'minimal' => 'ミニマルスタイル',
                        'dark' => 'ダークスタイル',
                    ),
                    'default_value' => 'cards',
                ),
            ),
            'location' => get_smart_location(), // 最小記述方式（1行のみ）
        ));
}

/**
 * ショートコード登録
 */
add_shortcode('problem_module', 'render_problem_module');

function render_problem_module($atts = [], $content = null) {
    // 属性のデフォルト値
    $atts = shortcode_atts(array(
        'title' => '',
        'subtitle' => '',
        'style' => '',
        'post_id' => get_the_ID(),
    ), $atts);
    
    // ACFフィールドから値を取得
    $post_id = $atts['post_id'];
    $title = $atts['title'] ?: get_field('problem_title', $post_id) ?: 'こんな課題はありませんか？';
    $subtitle = $atts['subtitle'] ?: get_field('problem_subtitle', $post_id) ?: '多くの企業が抱える共通の悩みです';
    $style = $atts['style'] ?: get_field('problem_style', $post_id) ?: 'cards';
    
    // 課題カードデータ取得
    $cards = get_field('problem_cards', $post_id) ?: array(
        array('title' => '時間がかかりすぎる', 'description' => '手作業による非効率な業務'),
        array('title' => 'ミスが頻発する', 'description' => '人的ミスによるトラブル'),
        array('title' => 'コストが削減できない', 'description' => '無駄なコストが削減できない'),
    );
    
    // ユニークIDを生成
    $unique_id = 'problem_' . uniqid();
    
    ob_start();
    ?>
    
    <!-- CSS（モジュール内完結） -->
    <style>
    .<?php echo $unique_id; ?> {
        padding: 80px 0;
        background: #f8f9fa;
    }
    
    .<?php echo $unique_id; ?>.dark {
        background: #2c3e50;
        color: white;
    }
    
    .<?php echo $unique_id; ?>.minimal {
        background: white;
        border-top: 1px solid #e9ecef;
        border-bottom: 1px solid #e9ecef;
    }
    
    .<?php echo $unique_id; ?> .container {
        max-width: 1200px;
        margin: 0 auto;
        padding: 0 20px;
    }
    
    .<?php echo $unique_id; ?> .section-header {
        text-align: center;
        margin-bottom: 60px;
    }
    
    .<?php echo $unique_id; ?> .section-title {
        font-size: 2.5rem;
        text-align: center;
        margin-bottom: 50px;
        color: #2c3e50;
    }
    
    .<?php echo $unique_id; ?>.dark .section-title {
        color: white;
    }
    
    .<?php echo $unique_id; ?> .section-subtitle {
        font-size: 1.1rem;
        color: #6c757d;
        max-width: 600px;
        margin: 0 auto;
    }
    
    .<?php echo $unique_id; ?>.dark .section-subtitle {
        color: #bdc3c7;
    }
    
    .<?php echo $unique_id; ?> .problem-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
        gap: 30px;
    }
    
    .<?php echo $unique_id; ?> .problem-card {
        background: white;
        padding: 30px;
        border-radius: 10px;
        box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        border-top: 4px solid #e74c3c;
        transition: transform 0.3s ease;
    }
    
    .<?php echo $unique_id; ?> .problem-card:hover {
        transform: translateY(-5px);
    }
    
    .<?php echo $unique_id; ?> .problem-title {
        font-size: 1.3rem;
        font-weight: 600;
        margin-bottom: 15px;
        color: #2c3e50;
    }
    
    .<?php echo $unique_id; ?> .problem-description {
        color: #6c757d;
        line-height: 1.6;
    }
    
    /* レスポンシブ */
    @media (max-width: 768px) {
        .<?php echo $unique_id; ?> {
            padding: 60px 0;
        }
        
        .<?php echo $unique_id; ?> .problem-grid {
            grid-template-columns: 1fr;
            gap: 20px;
        }
    }
    </style>
    
    <!-- HTML構造 -->
    <section class="<?php echo $unique_id; ?> <?php echo esc_attr($style); ?>" id="problem-module">
        <div class="container">
            <div class="section-header">
                <h2 class="section-title"><?php echo esc_html($title); ?></h2>
                <?php if ($subtitle): ?>
                    <p class="section-subtitle"><?php echo esc_html($subtitle); ?></p>
                <?php endif; ?>
            </div>
            
            <div class="problem-grid">
                <?php foreach ($cards as $card): ?>
                    <div class="problem-card">
                        <h3 class="problem-title"><?php echo esc_html($card['title']); ?></h3>
                        <p class="problem-description"><?php echo esc_html($card['description']); ?></p>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>
    
    <!-- JavaScript（モジュール内完結） -->
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        console.log('Problem Module Loaded: <?php echo $unique_id; ?>');
    });
    </script>
    
    <?php
    return ob_get_clean();
}

/**
 * 使用方法：
 * 
 * ショートコード:
 * [problem_module]
 * [problem_module title="お困りごとはありませんか？" style="dark"]
 * [problem_module subtitle="解決策をご提案します"]
 * 
 * PHP:
 * echo do_shortcode('[problem_module]');
 * 
 * ACF管理画面:
 * 「課題モジュール設定」でコンテンツ編集可能
 */
?> 