<?php
/**
 * Smart Benefits Module - メリット・効果セクション
 * 
 * 特徴:
 * - ACF設定不要（デフォルト値内蔵）
 * - カード形式でメリットを表示
 * - アイコン・タイトル・説明文
 * - レスポンシブ対応
 * - AOSアニメーション対応
 * 
 * ショートコード: [benefits_smart_module]
 * 
 * @package SmartModules
 */

// 直接アクセスを防ぐ
if (!defined('ABSPATH')) {
    exit;
}

// ベースクラスを読み込み
require_once get_stylesheet_directory() . '/modules_smart/core/SmartModuleBase.php';

class SmartBenefitsModule extends SmartModuleBase {
    
    /**
     * モジュール名を取得
     */
    protected function get_module_name(): string {
        return 'benefits';
    }
    
    /**
     * デフォルト値を定義
     */
    protected function get_defaults(): array {
        return [
            'section_title' => '選ばれる3つの理由',
            'section_subtitle' => '多くのお客様に支持される理由をご紹介します',
            'bg_color' => '#f8f9fa',
            'text_color' => '#333333',
            'accent_color' => '#4A90E2',
            
            // Benefit 1
            'benefit1_icon' => 'fas fa-rocket',
            'benefit1_title' => '業務効率が大幅向上',
            'benefit1_description' => '従来比300%の処理速度向上を実現。複雑な作業も簡単操作で完了し、生産性が劇的に改善されます。',
            'benefit1_highlight' => '300%向上',
            
            // Benefit 2
            'benefit2_icon' => 'fas fa-shield-alt',
            'benefit2_title' => '安心のセキュリティ',
            'benefit2_description' => '銀行レベルのセキュリティを採用。大切なデータを確実に保護し、安心してご利用いただけます。',
            'benefit2_highlight' => '銀行レベル',
            
            // Benefit 3
            'benefit3_icon' => 'fas fa-headset',
            'benefit3_title' => '24時間サポート体制',
            'benefit3_description' => '専門スタッフが24時間365日対応。困った時はいつでもお気軽にご相談ください。',
            'benefit3_highlight' => '24時間対応',
            
            // オプション設定
            'show_numbers' => true,
            'show_highlights' => true,
            'animation_delay' => 200
        ];
    }
    
    /**
     * HTMLテンプレートを生成
     */
    protected function generate_html(array $data): string {
        ob_start();
        ?>
        <section id="<?php echo esc_attr($this->unique_id); ?>" class="smart-benefits-module" 
                 style="background-color: <?php echo esc_attr($data['bg_color']); ?>; color: <?php echo esc_attr($data['text_color']); ?>;">
            
            <!-- デバッグ情報（管理者のみ） -->
            <?php if (current_user_can('administrator')): ?>
                <div style="font-size: 10px; color: #ccc; position: absolute; top: 0; right: 0; background: rgba(0,0,0,0.5); padding: 2px 5px;">
                    <?php echo date('H:i:s'); ?> | Benefits Module | ID:<?php echo get_the_ID(); ?>
                </div>
            <?php endif; ?>
            
            <div class="benefits-container">
                
                <!-- セクションヘッダー -->
                <div class="benefits-header" data-aos="fade-up">
                    <h2 class="section-title">
                        <?php echo esc_html($data['section_title']); ?>
                    </h2>
                    
                    <?php if (!empty($data['section_subtitle'])): ?>
                        <p class="section-subtitle">
                            <?php echo esc_html($data['section_subtitle']); ?>
                        </p>
                    <?php endif; ?>
                </div>
                
                <!-- メリットカード -->
                <div class="benefits-grid">
                    
                    <!-- Benefit 1 -->
                    <div class="benefit-card" data-aos="fade-up" data-aos-delay="<?php echo esc_attr($data['animation_delay']); ?>">
                        <?php if ($data['show_numbers']): ?>
                            <div class="benefit-number" style="color: <?php echo esc_attr($data['accent_color']); ?>;">01</div>
                        <?php endif; ?>
                        
                        <div class="benefit-icon" style="color: <?php echo esc_attr($data['accent_color']); ?>;">
                            <i class="<?php echo esc_attr($data['benefit1_icon']); ?>"></i>
                        </div>
                        
                        <h3 class="benefit-title">
                            <?php echo esc_html($data['benefit1_title']); ?>
                        </h3>
                        
                        <?php if ($data['show_highlights'] && !empty($data['benefit1_highlight'])): ?>
                            <div class="benefit-highlight" style="color: <?php echo esc_attr($data['accent_color']); ?>;">
                                <?php echo esc_html($data['benefit1_highlight']); ?>
                            </div>
                        <?php endif; ?>
                        
                        <p class="benefit-description">
                            <?php echo esc_html($data['benefit1_description']); ?>
                        </p>
                    </div>
                    
                    <!-- Benefit 2 -->
                    <div class="benefit-card" data-aos="fade-up" data-aos-delay="<?php echo esc_attr($data['animation_delay'] * 2); ?>">
                        <?php if ($data['show_numbers']): ?>
                            <div class="benefit-number" style="color: <?php echo esc_attr($data['accent_color']); ?>;">02</div>
                        <?php endif; ?>
                        
                        <div class="benefit-icon" style="color: <?php echo esc_attr($data['accent_color']); ?>;">
                            <i class="<?php echo esc_attr($data['benefit2_icon']); ?>"></i>
                        </div>
                        
                        <h3 class="benefit-title">
                            <?php echo esc_html($data['benefit2_title']); ?>
                        </h3>
                        
                        <?php if ($data['show_highlights'] && !empty($data['benefit2_highlight'])): ?>
                            <div class="benefit-highlight" style="color: <?php echo esc_attr($data['accent_color']); ?>;">
                                <?php echo esc_html($data['benefit2_highlight']); ?>
                            </div>
                        <?php endif; ?>
                        
                        <p class="benefit-description">
                            <?php echo esc_html($data['benefit2_description']); ?>
                        </p>
                    </div>
                    
                    <!-- Benefit 3 -->
                    <div class="benefit-card" data-aos="fade-up" data-aos-delay="<?php echo esc_attr($data['animation_delay'] * 3); ?>">
                        <?php if ($data['show_numbers']): ?>
                            <div class="benefit-number" style="color: <?php echo esc_attr($data['accent_color']); ?>;">03</div>
                        <?php endif; ?>
                        
                        <div class="benefit-icon" style="color: <?php echo esc_attr($data['accent_color']); ?>;">
                            <i class="<?php echo esc_attr($data['benefit3_icon']); ?>"></i>
                        </div>
                        
                        <h3 class="benefit-title">
                            <?php echo esc_html($data['benefit3_title']); ?>
                        </h3>
                        
                        <?php if ($data['show_highlights'] && !empty($data['benefit3_highlight'])): ?>
                            <div class="benefit-highlight" style="color: <?php echo esc_attr($data['accent_color']); ?>;">
                                <?php echo esc_html($data['benefit3_highlight']); ?>
                            </div>
                        <?php endif; ?>
                        
                        <p class="benefit-description">
                            <?php echo esc_html($data['benefit3_description']); ?>
                        </p>
                    </div>
                    
                </div>
            </div>
        </section>
        <?php
        return ob_get_clean();
    }
    
    /**
     * 追加のACFフィールド設定
     */
    protected function build_acf_fields() {
        $fields = parent::build_acf_fields();
        
        // 色選択フィールドとbooleanフィールドのタイプ調整
        foreach ($fields as &$field) {
            if (strpos($field['name'], '_color') !== false) {
                $field['type'] = 'color_picker';
            } elseif (strpos($field['name'], 'show_') !== false) {
                $field['type'] = 'true_false';
                $field['default_value'] = 1;
                $field['ui'] = 1;
            } elseif ($field['name'] === 'benefits_animation_delay') {
                $field['type'] = 'number';
                $field['min'] = 0;
                $field['max'] = 1000;
                $field['step'] = 50;
            }
        }
        
        return $fields;
    }
}