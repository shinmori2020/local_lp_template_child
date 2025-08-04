<?php
/**
 * Sample Module Template - 新モジュール作成テンプレート
 * ショートコード: [sample_module]
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
 * ACFフィールドグループの自動登録（新方式 - 簡単1行記述）
 */
if (function_exists('acf_add_local_field_group')) {
    acf_add_local_field_group(array(
        'key' => 'group_sample_complete',
        'title' => 'サンプルモジュール設定',
        'fields' => array(
            array(
                'key' => 'field_sample_title',
                'label' => 'タイトル',
                'name' => 'sample_title',
                'type' => 'text',
                'default_value' => 'サンプルタイトル',
                'instructions' => 'モジュールのメインタイトルを入力',
            ),
            array(
                'key' => 'field_sample_description',
                'label' => '説明文',
                'name' => 'sample_description',
                'type' => 'textarea',
                'default_value' => 'ここに説明文を入力してください。',
                'instructions' => 'モジュールの説明文を入力',
            ),
            array(
                'key' => 'field_sample_color',
                'label' => '背景色',
                'name' => 'sample_color',
                'type' => 'select',
                'choices' => array(
                    'blue' => 'ブルー',
                    'green' => 'グリーン',
                    'red' => 'レッド',
                    'purple' => 'パープル',
                ),
                'default_value' => 'blue',
            ),
        ),
        // 新方式：この1行のみでOK！
        'location' => get_smart_location(),
        
        // 古い方式（複雑・使用禁止）：
        // 'location' => array(
        //     array(
        //         array('param' => 'post_type', 'operator' => '==', 'value' => 'page'),
        //         array('param' => 'page_template', 'operator' => '==', 'value' => 'template.php'),
        //     ),
        // ),
    ));
}

/**
 * ショートコード登録
 */
add_shortcode('sample_module', 'render_sample_module');

/**
 * モジュールのレンダリング関数
 */
function render_sample_module($atts = array(), $content = null) {
    // ユニークIDを生成（CSSの名前空間として使用）
    $unique_id = 'sample_' . uniqid();
    
    // ショートコード属性のデフォルト値
    $default_atts = array(
        'title' => '',
        'description' => '',
        'color' => '',
        'post_id' => get_the_ID(), // 現在のページIDを取得
    );
    
    // 属性をマージ
    $atts = shortcode_atts($default_atts, $atts);
    
    // ACFフィールドから値を取得（属性で上書き可能）
    $post_id = intval($atts['post_id']);
    $title = !empty($atts['title']) ? $atts['title'] : get_field('sample_title', $post_id);
    $description = !empty($atts['description']) ? $atts['description'] : get_field('sample_description', $post_id);
    $color = !empty($atts['color']) ? $atts['color'] : get_field('sample_color', $post_id);
    
    // デフォルト値（ACFフィールドが空の場合）
    if (empty($title)) $title = 'サンプルタイトル';
    if (empty($description)) $description = 'ここに説明文を入力してください。';
    if (empty($color)) $color = 'blue';
    
    // セキュリティ対策：HTMLエスケープ
    $title = esc_html($title);
    $description = esc_html($description);
    $color = esc_attr($color);
    
    // HTMLの出力
    ob_start();
    ?>
    <div id="<?php echo esc_attr($unique_id); ?>" class="sample-module-container">
        <div class="sample-content bg-<?php echo $color; ?>">
            <h2 class="sample-title"><?php echo $title; ?></h2>
            <p class="sample-description"><?php echo $description; ?></p>
            <div class="sample-action">
                <button class="sample-btn">アクションボタン</button>
            </div>
        </div>
    </div>

    <style>
        /* モジュール専用CSS - ユニークIDで名前空間を作成 */
        #<?php echo esc_attr($unique_id); ?> {
            padding: 60px 0;
            background: #f8f9fa;
        }
        
        #<?php echo esc_attr($unique_id); ?> .sample-content {
            max-width: 1200px;
            margin: 0 auto;
            padding: 40px;
            border-radius: 12px;
            text-align: center;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        
        #<?php echo esc_attr($unique_id); ?> .sample-content.bg-blue {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
        }
        
        #<?php echo esc_attr($unique_id); ?> .sample-content.bg-green {
            background: linear-gradient(135deg, #4ecdc4 0%, #44a08d 100%);
            color: white;
        }
        
        #<?php echo esc_attr($unique_id); ?> .sample-content.bg-red {
            background: linear-gradient(135deg, #ff6b6b 0%, #ee5a24 100%);
            color: white;
        }
        
        #<?php echo esc_attr($unique_id); ?> .sample-content.bg-purple {
            background: linear-gradient(135deg, #a8edea 0%, #fed6e3 100%);
            color: #333;
        }
        
        #<?php echo esc_attr($unique_id); ?> .sample-title {
            font-size: 2.5rem;
            font-weight: 700;
            margin-bottom: 20px;
            line-height: 1.3;
        }
        
        #<?php echo esc_attr($unique_id); ?> .sample-description {
            font-size: 1.2rem;
            line-height: 1.6;
            margin-bottom: 30px;
            opacity: 0.9;
        }
        
        #<?php echo esc_attr($unique_id); ?> .sample-btn {
            background: rgba(255, 255, 255, 0.2);
            border: 2px solid rgba(255, 255, 255, 0.5);
            color: inherit;
            padding: 12px 30px;
            border-radius: 25px;
            font-size: 1rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
        }
        
        #<?php echo esc_attr($unique_id); ?> .sample-btn:hover {
            background: rgba(255, 255, 255, 0.3);
            border-color: rgba(255, 255, 255, 0.8);
            transform: translateY(-2px);
        }
        
        /* レスポンシブ対応 */
        @media (max-width: 768px) {
            #<?php echo esc_attr($unique_id); ?> {
                padding: 40px 0;
            }
            
            #<?php echo esc_attr($unique_id); ?> .sample-content {
                padding: 30px 20px;
                margin: 0 15px;
            }
            
            #<?php echo esc_attr($unique_id); ?> .sample-title {
                font-size: 2rem;
            }
            
            #<?php echo esc_attr($unique_id); ?> .sample-description {
                font-size: 1rem;
            }
        }
    </style>

    <script>
        // モジュール専用JavaScript
        document.addEventListener('DOMContentLoaded', function() {
            // ユニークIDを使ってこのモジュールのみに適用
            const sampleModule = document.getElementById('<?php echo esc_js($unique_id); ?>');
            
            if (sampleModule) {
                const btn = sampleModule.querySelector('.sample-btn');
                
                if (btn) {
                    btn.addEventListener('click', function() {
                        alert('サンプルボタンがクリックされました！');
                        // ここに実際の処理を追加
                    });
                }
                
                // アニメーション効果（例）
                const observer = new IntersectionObserver(function(entries) {
                    entries.forEach(function(entry) {
                        if (entry.isIntersecting) {
                            entry.target.style.opacity = '1';
                            entry.target.style.transform = 'translateY(0)';
                        }
                    });
                });
                
                sampleModule.style.opacity = '0';
                sampleModule.style.transform = 'translateY(20px)';
                sampleModule.style.transition = 'all 0.6s ease';
                
                observer.observe(sampleModule);
            }
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
                // 管理画面でのリアルタイムプレビュー機能を追加可能
                console.log('Sample Module loaded in admin');
            </script>
            <?php
        }
    });
}
?> 