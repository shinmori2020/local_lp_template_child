<?php
/**
 * Firstview Module v3 - Business Dashboard Style
 * ショートコード: [firstview_03_module]
 * 
 * 完全独立型モジュール：
 * - ビジネス向けダッシュボード風デザイン
 * - 3Dパースペクティブ・カウントアップアニメーション
 * - 幾何学シェイプ・フィーチャーカード
 * - ACFフィールド自動登録
 * - CSS・JavaScript内蔵
 * - 完全レスポンシブ対応
 * 
 * @package Local_LP_Template_Child
 */

// 直接アクセスを防ぐ
if (!defined('ABSPATH')) {
    exit;
}

/**
 * ACFフィールドグループの自動登録（新方式 - 簡単1行記述）
 */
if (function_exists('acf_add_local_field_group')) {
    acf_add_local_field_group(array(
        'key' => 'group_firstview_03_complete',
        'title' => 'ファーストビューモジュール v3 設定（ビジネス・ダッシュボード）',
        'fields' => array(
            array(
                'key' => 'field_firstview_03_badge_text',
                'label' => 'バッジテキスト',
                'name' => 'firstview_03_badge_text',
                'type' => 'text',
                'default_value' => '新登場',
                'instructions' => 'バッジに表示するテキスト',
            ),
            array(
                'key' => 'field_firstview_03_badge_icon',
                'label' => 'バッジアイコン',
                'name' => 'firstview_03_badge_icon',
                'type' => 'text',
                'default_value' => '✨',
                'instructions' => 'バッジに表示するアイコン（絵文字・FontAwesome等）',
            ),
            array(
                'key' => 'field_firstview_03_title_line1',
                'label' => 'タイトル1行目',
                'name' => 'firstview_03_title_line1',
                'type' => 'text',
                'default_value' => 'ビジネスの',
                'instructions' => 'メインタイトルの1行目',
            ),
            array(
                'key' => 'field_firstview_03_title_line2',
                'label' => 'タイトル2行目（ハイライト）',
                'name' => 'firstview_03_title_line2',
                'type' => 'text',
                'default_value' => '可能性を',
                'instructions' => 'メインタイトルの2行目（青色ハイライト表示）',
            ),
            array(
                'key' => 'field_firstview_03_title_line3',
                'label' => 'タイトル3行目',
                'name' => 'firstview_03_title_line3',
                'type' => 'text',
                'default_value' => '最大化する',
                'instructions' => 'メインタイトルの3行目',
            ),
            array(
                'key' => 'field_firstview_03_subtitle',
                'label' => 'サブタイトル',
                'name' => 'firstview_03_subtitle',
                'type' => 'textarea',
                'default_value' => 'シンプルで強力なソリューションが、<br>あなたの事業を次のステージへと導きます',
                'instructions' => 'サブタイトル・説明文（改行は<br>タグを使用）',
                'rows' => 3,
            ),
            array(
                'key' => 'field_firstview_03_feature_cards',
                'label' => 'フィーチャーカード',
                'name' => 'firstview_03_feature_cards',
                'type' => 'repeater',
                'instructions' => '特徴・機能を表示するカード（推奨：3個）',
                'min' => 1,
                'max' => 6,
                'layout' => 'table',
                'button_label' => 'カードを追加',
                'sub_fields' => array(
                    array(
                        'key' => 'field_firstview_03_feature_icon',
                        'label' => 'アイコン',
                        'name' => 'icon',
                        'type' => 'text',
                        'default_value' => '🚀',
                        'instructions' => '絵文字またはFontAwesomeクラス',
                    ),
                    array(
                        'key' => 'field_firstview_03_feature_title',
                        'label' => 'タイトル',
                        'name' => 'title',
                        'type' => 'text',
                        'default_value' => '高速処理',
                        'instructions' => 'フィーチャーのタイトル',
                    ),
                    array(
                        'key' => 'field_firstview_03_feature_description',
                        'label' => '説明',
                        'name' => 'description',
                        'type' => 'text',
                        'default_value' => '最新技術による超高速処理を実現',
                        'instructions' => 'フィーチャーの説明文',
                    ),
                ),
                'default_value' => array(
                    array(
                        'icon' => '🚀',
                        'title' => '高速処理',
                        'description' => '最新技術による超高速処理を実現'
                    ),
                    array(
                        'icon' => '🔒',
                        'title' => 'セキュリティ',
                        'description' => '企業級のセキュリティで安心・安全'
                    ),
                    array(
                        'icon' => '📊',
                        'title' => '分析機能',
                        'description' => '詳細なデータ分析でビジネスを最適化'
                    ),
                ),
            ),
            array(
                'key' => 'field_firstview_03_primary_cta_text',
                'label' => 'プライマリCTAテキスト',
                'name' => 'firstview_03_primary_cta_text',
                'type' => 'text',
                'default_value' => '今すぐ始める',
                'instructions' => 'メインのCTAボタンテキスト',
            ),
            array(
                'key' => 'field_firstview_03_primary_cta_link',
                'label' => 'プライマリCTAリンク',
                'name' => 'firstview_03_primary_cta_link',
                'type' => 'text',
                'default_value' => '#contact',
                'instructions' => 'メインCTAのリンク先',
            ),
            array(
                'key' => 'field_firstview_03_secondary_cta_text',
                'label' => 'セカンダリCTAテキスト',
                'name' => 'firstview_03_secondary_cta_text',
                'type' => 'text',
                'default_value' => 'デモを見る',
                'instructions' => 'サブのCTAボタンテキスト',
            ),
            array(
                'key' => 'field_firstview_03_secondary_cta_link',
                'label' => 'セカンダリCTAリンク',
                'name' => 'firstview_03_secondary_cta_link',
                'type' => 'text',
                'default_value' => '#demo',
                'instructions' => 'サブCTAのリンク先',
            ),
            array(
                'key' => 'field_firstview_03_stats',
                'label' => 'ダッシュボード統計データ',
                'name' => 'firstview_03_stats',
                'type' => 'repeater',
                'instructions' => 'ダッシュボードに表示する統計データ（推奨：2-3個）',
                'min' => 1,
                'max' => 5,
                'layout' => 'table',
                'button_label' => '統計データを追加',
                'sub_fields' => array(
                    array(
                        'key' => 'field_firstview_03_stat_number',
                        'label' => '数値',
                        'name' => 'number',
                        'type' => 'text',
                        'default_value' => '1,234',
                        'instructions' => '表示する数値（カンマ区切り可）',
                    ),
                    array(
                        'key' => 'field_firstview_03_stat_label',
                        'label' => 'ラベル',
                        'name' => 'label',
                        'type' => 'text',
                        'default_value' => 'アクティブユーザー',
                        'instructions' => '統計データのラベル',
                    ),
                    array(
                        'key' => 'field_firstview_03_stat_trend',
                        'label' => 'トレンド',
                        'name' => 'trend',
                        'type' => 'text',
                        'default_value' => '+12%',
                        'instructions' => '増減率・トレンド（+12%等）',
                    ),
                ),
                'default_value' => array(
                    array(
                        'number' => '1,234',
                        'label' => 'アクティブユーザー',
                        'trend' => '+12%'
                    ),
                    array(
                        'number' => '89%',
                        'label' => '満足度',
                        'trend' => '+5%'
                    ),
                ),
            ),
            array(
                'key' => 'field_firstview_03_bg_style',
                'label' => '背景スタイル',
                'name' => 'firstview_03_bg_style',
                'type' => 'select',
                'choices' => array(
                    'dark-blue' => 'ダークブルー（デフォルト）',
                    'dark-purple' => 'ダークパープル',
                    'dark-green' => 'ダークグリーン',
                    'dark-gray' => 'ダークグレー',
                    'custom' => 'カスタム',
                ),
                'default_value' => 'dark-blue',
            ),
            array(
                'key' => 'field_firstview_03_enable_shapes',
                'label' => '幾何学シェイプ表示',
                'name' => 'firstview_03_enable_shapes',
                'type' => 'true_false',
                'default_value' => 1,
                'instructions' => '浮遊する幾何学的シェイプを表示するか',
                'ui' => 1,
            ),
            array(
                'key' => 'field_firstview_03_enable_animations',
                'label' => 'アニメーション有効',
                'name' => 'firstview_03_enable_animations',
                'type' => 'true_false',
                'default_value' => 1,
                'instructions' => 'カウントアップ・チャート等のアニメーションを有効にするか',
                'ui' => 1,
            ),
        ),
        // 新方式：この1行のみでOK！
        'location' => get_smart_location(),
    ));
}

/**
 * ショートコード登録
 */
add_shortcode('firstview_03_module', 'render_firstview_03_module');

/**
 * モジュールのレンダリング関数
 */
function render_firstview_03_module($atts = array(), $content = null) {
    // ユニークIDを生成（CSSの名前空間として使用）
    $unique_id = 'firstview_03_' . uniqid();
    
    // ショートコード属性のデフォルト値
    $default_atts = array(
        'badge_text' => '',
        'badge_icon' => '',
        'title_line1' => '',
        'title_line2' => '',
        'title_line3' => '',
        'subtitle' => '',
        'primary_cta_text' => '',
        'primary_cta_link' => '',
        'secondary_cta_text' => '',
        'secondary_cta_link' => '',
        'bg_style' => '',
        'post_id' => get_the_ID(),
    );
    
    // 属性をマージ
    $atts = shortcode_atts($default_atts, $atts);
    
    // ACFフィールドから値を取得（属性で上書き可能）
    $post_id = intval($atts['post_id']);
    $badge_text = !empty($atts['badge_text']) ? $atts['badge_text'] : get_field('firstview_03_badge_text', $post_id);
    $badge_icon = !empty($atts['badge_icon']) ? $atts['badge_icon'] : get_field('firstview_03_badge_icon', $post_id);
    $title_line1 = !empty($atts['title_line1']) ? $atts['title_line1'] : get_field('firstview_03_title_line1', $post_id);
    $title_line2 = !empty($atts['title_line2']) ? $atts['title_line2'] : get_field('firstview_03_title_line2', $post_id);
    $title_line3 = !empty($atts['title_line3']) ? $atts['title_line3'] : get_field('firstview_03_title_line3', $post_id);
    $subtitle = !empty($atts['subtitle']) ? $atts['subtitle'] : get_field('firstview_03_subtitle', $post_id);
    $feature_cards = get_field('firstview_03_feature_cards', $post_id);
    $primary_cta_text = !empty($atts['primary_cta_text']) ? $atts['primary_cta_text'] : get_field('firstview_03_primary_cta_text', $post_id);
    $primary_cta_link = !empty($atts['primary_cta_link']) ? $atts['primary_cta_link'] : get_field('firstview_03_primary_cta_link', $post_id);
    $secondary_cta_text = !empty($atts['secondary_cta_text']) ? $atts['secondary_cta_text'] : get_field('firstview_03_secondary_cta_text', $post_id);
    $secondary_cta_link = !empty($atts['secondary_cta_link']) ? $atts['secondary_cta_link'] : get_field('firstview_03_secondary_cta_link', $post_id);
    $stats = get_field('firstview_03_stats', $post_id);
    $bg_style = !empty($atts['bg_style']) ? $atts['bg_style'] : get_field('firstview_03_bg_style', $post_id);
    $enable_shapes = get_field('firstview_03_enable_shapes', $post_id);
    $enable_animations = get_field('firstview_03_enable_animations', $post_id);
    
    // デフォルト値（ACFフィールドが空の場合）
    if (empty($badge_text)) $badge_text = '新登場';
    if (empty($badge_icon)) $badge_icon = '✨';
    if (empty($title_line1)) $title_line1 = 'ビジネスの';
    if (empty($title_line2)) $title_line2 = '可能性を';
    if (empty($title_line3)) $title_line3 = '最大化する';
    if (empty($subtitle)) $subtitle = 'シンプルで強力なソリューションが、<br>あなたの事業を次のステージへと導きます';
    if (empty($primary_cta_text)) $primary_cta_text = '今すぐ始める';
    if (empty($primary_cta_link)) $primary_cta_link = '#contact';
    if (empty($secondary_cta_text)) $secondary_cta_text = 'デモを見る';
    if (empty($secondary_cta_link)) $secondary_cta_link = '#demo';
    if (empty($bg_style)) $bg_style = 'dark-blue';
    if ($enable_shapes === null) $enable_shapes = true;
    if ($enable_animations === null) $enable_animations = true;
    
    // デフォルトのフィーチャーカード
    if (empty($feature_cards)) {
        $feature_cards = array(
            array('icon' => '🚀', 'title' => '高速処理', 'description' => '最新技術による超高速処理を実現'),
            array('icon' => '🔒', 'title' => 'セキュリティ', 'description' => '企業級のセキュリティで安心・安全'),
            array('icon' => '📊', 'title' => '分析機能', 'description' => '詳細なデータ分析でビジネスを最適化'),
        );
    }
    
    // デフォルトの統計データ
    if (empty($stats)) {
        $stats = array(
            array('number' => '1,234', 'label' => 'アクティブユーザー', 'trend' => '+12%'),
            array('number' => '89%', 'label' => '満足度', 'trend' => '+5%'),
        );
    }
    
    // 背景スタイルの決定
    $background_css = '';
    switch ($bg_style) {
        case 'dark-purple':
            $background_css = 'linear-gradient(135deg, #2d1b69 0%, #11004b 50%, #0a0a0a 100%)';
            break;
        case 'dark-green':
            $background_css = 'linear-gradient(135deg, #1a2e1a 0%, #0f2e16 50%, #0a3460 100%)';
            break;
        case 'dark-gray':
            $background_css = 'linear-gradient(135deg, #2c2c2c 0%, #1a1a1a 50%, #0d1117 100%)';
            break;
        default: // dark-blue
            $background_css = 'linear-gradient(135deg, #1a1a2e 0%, #16213e 50%, #0f3460 100%)';
    }
    
    // HTMLの出力
    ob_start();
    ?>
    <section id="<?php echo esc_attr($unique_id); ?>" class="firstview-03-section">
        <div class="firstview-03-bg">
            <?php if ($enable_shapes): ?>
                <div class="firstview-03-geometric-shapes">
                    <div class="firstview-03-shape firstview-03-shape-1"></div>
                    <div class="firstview-03-shape firstview-03-shape-2"></div>
                    <div class="firstview-03-shape firstview-03-shape-3"></div>
                    <div class="firstview-03-shape firstview-03-shape-4"></div>
                </div>
            <?php endif; ?>
        </div>
        
        <div class="firstview-03-container">
            <div class="firstview-03-content">
                <div class="firstview-03-badge">
                    <span class="firstview-03-badge-text"><?php echo esc_html($badge_text); ?></span>
                    <span class="firstview-03-badge-icon"><?php echo esc_html($badge_icon); ?></span>
                </div>
                
                <h1 class="firstview-03-title">
                    <span class="firstview-03-title-line"><?php echo esc_html($title_line1); ?></span>
                    <span class="firstview-03-title-line firstview-03-highlight"><?php echo esc_html($title_line2); ?></span>
                    <span class="firstview-03-title-line"><?php echo esc_html($title_line3); ?></span>
                </h1>
                
                <p class="firstview-03-subtitle">
                    <?php echo wp_kses_post($subtitle); ?>
                </p>
                
                <div class="firstview-03-features">
                    <?php foreach ($feature_cards as $index => $card): ?>
                        <div class="firstview-03-feature-card" data-index="<?php echo esc_attr($index); ?>">
                            <div class="firstview-03-feature-icon"><?php echo esc_html($card['icon']); ?></div>
                            <h3><?php echo esc_html($card['title']); ?></h3>
                            <p><?php echo esc_html($card['description']); ?></p>
                        </div>
                    <?php endforeach; ?>
                </div>
                
                <div class="firstview-03-cta">
                    <a href="<?php echo esc_url($primary_cta_link); ?>" class="firstview-03-cta-primary">
                        <span class="firstview-03-cta-text"><?php echo esc_html($primary_cta_text); ?></span>
                        <span class="firstview-03-cta-arrow">→</span>
                    </a>
                    <a href="<?php echo esc_url($secondary_cta_link); ?>" class="firstview-03-cta-secondary">
                        <span class="firstview-03-cta-text"><?php echo esc_html($secondary_cta_text); ?></span>
                        <span class="firstview-03-cta-play">▶</span>
                    </a>
                </div>
            </div>
            
            <div class="firstview-03-visual">
                <div class="firstview-03-dashboard-mockup">
                    <div class="firstview-03-mockup-header">
                        <div class="firstview-03-mockup-dots">
                            <span class="firstview-03-dot firstview-03-red"></span>
                            <span class="firstview-03-dot firstview-03-yellow"></span>
                            <span class="firstview-03-dot firstview-03-green"></span>
                        </div>
                        <div class="firstview-03-mockup-title">Dashboard</div>
                    </div>
                    <div class="firstview-03-mockup-content">
                        <?php foreach ($stats as $index => $stat): ?>
                            <div class="firstview-03-stat-card" data-index="<?php echo esc_attr($index); ?>">
                                <div class="firstview-03-stat-number" data-target="<?php echo esc_attr(preg_replace('/[^0-9]/', '', $stat['number'])); ?>">
                                    <?php echo esc_html($stat['number']); ?>
                                </div>
                                <div class="firstview-03-stat-label"><?php echo esc_html($stat['label']); ?></div>
                                <div class="firstview-03-stat-trend"><?php echo esc_html($stat['trend']); ?></div>
                            </div>
                        <?php endforeach; ?>
                        
                        <div class="firstview-03-chart-area">
                            <div class="firstview-03-chart-bars">
                                <div class="firstview-03-bar" style="height: 60%"></div>
                                <div class="firstview-03-bar" style="height: 80%"></div>
                                <div class="firstview-03-bar" style="height: 45%"></div>
                                <div class="firstview-03-bar" style="height: 95%"></div>
                                <div class="firstview-03-bar" style="height: 70%"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <style>
        /* ファーストビューv3専用スタイル */
        #<?php echo esc_attr($unique_id); ?> {
            position: relative;
            min-height: 100vh;
            background: <?php echo $background_css; ?>;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
            padding: 80px 0;
        }

        #<?php echo esc_attr($unique_id); ?> .firstview-03-bg {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: 1;
        }

        #<?php echo esc_attr($unique_id); ?> .firstview-03-geometric-shapes {
            position: absolute;
            width: 100%;
            height: 100%;
        }

        #<?php echo esc_attr($unique_id); ?> .firstview-03-shape {
            position: absolute;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.03);
            animation: floatShapes 20s infinite ease-in-out;
        }

        #<?php echo esc_attr($unique_id); ?> .firstview-03-shape-1 {
            width: 300px;
            height: 300px;
            top: 10%;
            left: 10%;
            animation-delay: 0s;
        }

        #<?php echo esc_attr($unique_id); ?> .firstview-03-shape-2 {
            width: 200px;
            height: 200px;
            top: 60%;
            right: 15%;
            animation-delay: 5s;
        }

        #<?php echo esc_attr($unique_id); ?> .firstview-03-shape-3 {
            width: 150px;
            height: 150px;
            bottom: 20%;
            left: 20%;
            animation-delay: 10s;
        }

        #<?php echo esc_attr($unique_id); ?> .firstview-03-shape-4 {
            width: 100px;
            height: 100px;
            top: 30%;
            right: 30%;
            animation-delay: 15s;
        }

        #<?php echo esc_attr($unique_id); ?> .firstview-03-container {
            position: relative;
            z-index: 2;
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 80px;
            align-items: center;
        }

        #<?php echo esc_attr($unique_id); ?> .firstview-03-content {
            color: white;
            animation: slideInLeft 1s ease-out;
        }

        #<?php echo esc_attr($unique_id); ?> .firstview-03-badge {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
            border-radius: 30px;
            padding: 8px 16px;
            margin-bottom: 32px;
            font-size: 0.9rem;
            font-weight: 500;
        }

        #<?php echo esc_attr($unique_id); ?> .firstview-03-title {
            font-size: 3.5rem;
            font-weight: 800;
            line-height: 1.2;
            margin-bottom: 24px;
            letter-spacing: -0.02em;
        }

        #<?php echo esc_attr($unique_id); ?> .firstview-03-title-line {
            display: block;
            opacity: 0;
            transform: translateY(30px);
            animation: fadeInUp 0.8s ease-out forwards;
        }

        #<?php echo esc_attr($unique_id); ?> .firstview-03-title-line:nth-child(1) { animation-delay: 0.2s; }
        #<?php echo esc_attr($unique_id); ?> .firstview-03-title-line:nth-child(2) { animation-delay: 0.4s; }
        #<?php echo esc_attr($unique_id); ?> .firstview-03-title-line:nth-child(3) { animation-delay: 0.6s; }

        #<?php echo esc_attr($unique_id); ?> .firstview-03-highlight {
            background: linear-gradient(45deg, #00d4ff, #0099cc);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        #<?php echo esc_attr($unique_id); ?> .firstview-03-subtitle {
            font-size: 1.2rem;
            line-height: 1.6;
            margin-bottom: 40px;
            opacity: 0.9;
            font-weight: 400;
        }

        #<?php echo esc_attr($unique_id); ?> .firstview-03-features {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 20px;
            margin-bottom: 40px;
        }

        #<?php echo esc_attr($unique_id); ?> .firstview-03-feature-card {
            background: rgba(255, 255, 255, 0.05);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 16px;
            padding: 24px 16px;
            text-align: center;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            opacity: 0;
            transform: translateY(20px);
        }

        #<?php echo esc_attr($unique_id); ?> .firstview-03-feature-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 30px rgba(0, 212, 255, 0.2);
        }

        #<?php echo esc_attr($unique_id); ?> .firstview-03-feature-icon {
            font-size: 2rem;
            margin-bottom: 12px;
        }

        #<?php echo esc_attr($unique_id); ?> .firstview-03-feature-card h3 {
            font-size: 1.1rem;
            font-weight: 600;
            margin-bottom: 8px;
        }

        #<?php echo esc_attr($unique_id); ?> .firstview-03-feature-card p {
            font-size: 0.9rem;
            opacity: 0.8;
            line-height: 1.4;
        }

        #<?php echo esc_attr($unique_id); ?> .firstview-03-cta {
            display: flex;
            gap: 16px;
            flex-wrap: wrap;
        }

        #<?php echo esc_attr($unique_id); ?> .firstview-03-cta-primary,
        #<?php echo esc_attr($unique_id); ?> .firstview-03-cta-secondary {
            display: inline-flex;
            align-items: center;
            gap: 12px;
            padding: 16px 32px;
            border-radius: 12px;
            font-weight: 600;
            font-size: 1.1rem;
            text-decoration: none;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        #<?php echo esc_attr($unique_id); ?> .firstview-03-cta-primary {
            background: linear-gradient(45deg, #00d4ff, #0099cc);
            color: white;
            box-shadow: 0 8px 24px rgba(0, 212, 255, 0.3);
        }

        #<?php echo esc_attr($unique_id); ?> .firstview-03-cta-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 12px 32px rgba(0, 212, 255, 0.4);
        }

        #<?php echo esc_attr($unique_id); ?> .firstview-03-cta-secondary {
            background: rgba(255, 255, 255, 0.1);
            color: white;
            border: 1px solid rgba(255, 255, 255, 0.3);
            backdrop-filter: blur(10px);
        }

        #<?php echo esc_attr($unique_id); ?> .firstview-03-cta-secondary:hover {
            background: rgba(255, 255, 255, 0.2);
            transform: translateY(-2px);
        }

        #<?php echo esc_attr($unique_id); ?> .firstview-03-visual {
            animation: slideInRight 1s ease-out;
        }

        #<?php echo esc_attr($unique_id); ?> .firstview-03-dashboard-mockup {
            background: rgba(255, 255, 255, 0.95);
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
            transform: perspective(1000px) rotateY(-10deg) rotateX(5deg);
            transition: transform 0.3s ease;
        }

        #<?php echo esc_attr($unique_id); ?> .firstview-03-dashboard-mockup:hover {
            transform: perspective(1000px) rotateY(-5deg) rotateX(2deg);
        }

        #<?php echo esc_attr($unique_id); ?> .firstview-03-mockup-header {
            background: #f8f9fa;
            padding: 16px 20px;
            display: flex;
            align-items: center;
            gap: 16px;
            border-bottom: 1px solid #e9ecef;
        }

        #<?php echo esc_attr($unique_id); ?> .firstview-03-mockup-dots {
            display: flex;
            gap: 8px;
        }

        #<?php echo esc_attr($unique_id); ?> .firstview-03-dot {
            width: 12px;
            height: 12px;
            border-radius: 50%;
        }

        #<?php echo esc_attr($unique_id); ?> .firstview-03-dot.firstview-03-red { background: #ff5f56; }
        #<?php echo esc_attr($unique_id); ?> .firstview-03-dot.firstview-03-yellow { background: #ffbd2e; }
        #<?php echo esc_attr($unique_id); ?> .firstview-03-dot.firstview-03-green { background: #27ca3f; }

        #<?php echo esc_attr($unique_id); ?> .firstview-03-mockup-title {
            font-weight: 600;
            color: #495057;
            font-size: 0.9rem;
        }

        #<?php echo esc_attr($unique_id); ?> .firstview-03-mockup-content {
            padding: 24px;
            background: white;
            color: #333;
        }

        #<?php echo esc_attr($unique_id); ?> .firstview-03-stat-card {
            background: #f8f9fa;
            border-radius: 12px;
            padding: 20px;
            margin-bottom: 16px;
            position: relative;
            overflow: hidden;
        }

        #<?php echo esc_attr($unique_id); ?> .firstview-03-stat-number {
            font-size: 2rem;
            font-weight: 800;
            color: #00d4ff;
            margin-bottom: 4px;
        }

        #<?php echo esc_attr($unique_id); ?> .firstview-03-stat-label {
            font-size: 0.9rem;
            color: #6c757d;
            margin-bottom: 8px;
        }

        #<?php echo esc_attr($unique_id); ?> .firstview-03-stat-trend {
            font-size: 0.8rem;
            color: #28a745;
            font-weight: 600;
        }

        #<?php echo esc_attr($unique_id); ?> .firstview-03-chart-area {
            height: 100px;
            background: #f8f9fa;
            border-radius: 12px;
            padding: 16px;
            display: flex;
            align-items: end;
            justify-content: center;
        }

        #<?php echo esc_attr($unique_id); ?> .firstview-03-chart-bars {
            display: flex;
            gap: 8px;
            height: 100%;
            align-items: end;
        }

        #<?php echo esc_attr($unique_id); ?> .firstview-03-bar {
            width: 16px;
            background: linear-gradient(to top, #00d4ff, #0099cc);
            border-radius: 4px 4px 0 0;
            animation: barGrow 2s ease-out;
        }

        /* アニメーション */
        @keyframes floatShapes {
            0%, 100% { transform: translateY(0px) rotate(0deg); }
            50% { transform: translateY(-30px) rotate(180deg); }
        }

        @keyframes slideInLeft {
            from {
                opacity: 0;
                transform: translateX(-50px);
            }
            to {
                opacity: 1;
                transform: translateX(0);
            }
        }

        @keyframes slideInRight {
            from {
                opacity: 0;
                transform: translateX(50px);
            }
            to {
                opacity: 1;
                transform: translateX(0);
            }
        }

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

        @keyframes barGrow {
            from { height: 0; }
            to { height: 100%; }
        }

        /* レスポンシブデザイン */
        @media (max-width: 768px) {
            #<?php echo esc_attr($unique_id); ?> .firstview-03-container {
                grid-template-columns: 1fr;
                gap: 40px;
                text-align: center;
            }

            #<?php echo esc_attr($unique_id); ?> .firstview-03-title {
                font-size: 2.5rem;
            }

            #<?php echo esc_attr($unique_id); ?> .firstview-03-features {
                grid-template-columns: 1fr;
                gap: 16px;
            }

            #<?php echo esc_attr($unique_id); ?> .firstview-03-cta {
                flex-direction: column;
                align-items: center;
            }

            #<?php echo esc_attr($unique_id); ?> .firstview-03-cta-primary,
            #<?php echo esc_attr($unique_id); ?> .firstview-03-cta-secondary {
                width: 100%;
                max-width: 300px;
                justify-content: center;
            }

            #<?php echo esc_attr($unique_id); ?> .firstview-03-dashboard-mockup {
                transform: none;
            }
        }

        @media (max-width: 480px) {
            #<?php echo esc_attr($unique_id); ?> .firstview-03-title {
                font-size: 2rem;
            }

            #<?php echo esc_attr($unique_id); ?> .firstview-03-subtitle {
                font-size: 1.1rem;
            }

            #<?php echo esc_attr($unique_id); ?> .firstview-03-features {
                gap: 12px;
            }

            #<?php echo esc_attr($unique_id); ?> .firstview-03-feature-card {
                padding: 16px 12px;
            }
        }
    </style>

    <script>
        // ファーストビューv3専用JavaScript
        document.addEventListener('DOMContentLoaded', function() {
            const firstviewModule = document.getElementById('<?php echo esc_js($unique_id); ?>');
            
            if (!firstviewModule) return;

            <?php if ($enable_animations): ?>
            // カウントアップアニメーション
            function animateCountUp(element, target, duration = 2000) {
                const start = 0;
                const increment = target / (duration / 16);
                let current = start;
                
                const timer = setInterval(function() {
                    current += increment;
                    if (current >= target) {
                        current = target;
                        clearInterval(timer);
                    }
                    element.textContent = Math.floor(current).toLocaleString();
                }, 16);
            }

            // 統計数値のアニメーション
            const statNumbers = firstviewModule.querySelectorAll('.firstview-03-stat-number');
            statNumbers.forEach((element, index) => {
                const target = parseInt(element.getAttribute('data-target')) || 0;
                if (target > 0) {
                    element.textContent = '0';
                    setTimeout(() => {
                        animateCountUp(element, target);
                    }, 500 + (index * 200));
                }
            });

            // チャートバーのアニメーション
            const bars = firstviewModule.querySelectorAll('.firstview-03-bar');
            bars.forEach((bar, index) => {
                const originalHeight = bar.style.height;
                bar.style.height = '0%';
                setTimeout(() => {
                    bar.style.transition = 'height 1s ease-out';
                    bar.style.height = originalHeight;
                }, 1000 + (index * 200));
            });

            // フィーチャーカードのスタッガードアニメーション
            const featureCards = firstviewModule.querySelectorAll('.firstview-03-feature-card');
            featureCards.forEach((card, index) => {
                setTimeout(() => {
                    card.style.transition = 'all 0.6s ease-out';
                    card.style.opacity = '1';
                    card.style.transform = 'translateY(0)';
                }, 800 + (index * 200));
            });
            <?php endif; ?>

            // ホバーエフェクト
            const ctaButtons = firstviewModule.querySelectorAll('.firstview-03-cta-primary, .firstview-03-cta-secondary');
            ctaButtons.forEach(button => {
                button.addEventListener('mouseenter', function() {
                    this.style.transform = 'translateY(-2px) scale(1.05)';
                });
                
                button.addEventListener('mouseleave', function() {
                    this.style.transform = 'translateY(0) scale(1)';
                });
            });

            // スムーススクロール
            const anchors = firstviewModule.querySelectorAll('a[href^="#"]');
            anchors.forEach(anchor => {
                anchor.addEventListener('click', function(e) {
                    e.preventDefault();
                    const target = document.querySelector(this.getAttribute('href'));
                    if (target) {
                        target.scrollIntoView({
                            behavior: 'smooth',
                            block: 'start'
                        });
                    }
                });
            });
        });
    </script>

    <?php
    return ob_get_clean();
}

// 管理画面でのプレビュー機能（オプション）
if (is_admin()) {
    add_action('admin_footer', function() {
        if (get_current_screen()->id === 'page') {
            ?>
            <script>
                console.log('Firstview 03 Module (Business Dashboard) loaded in admin');
            </script>
            <?php
        }
    });
}
?> 