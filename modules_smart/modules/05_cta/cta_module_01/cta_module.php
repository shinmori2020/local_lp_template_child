<?php
/**
 * Smart CTA Module - コールトゥアクション（行動喚起）セクション
 * 
 * 特徴:
 * - ACF設定不要（デフォルト値内蔵）
 * - 複数のCTAボタン対応
 * - 電話番号・メール表示
 * - インパクトのあるデザイン
 * - レスポンシブ対応
 * 
 * ショートコード: [cta_smart_module]
 * 
 * @package SmartModules
 */

// 直接アクセスを防ぐ
if (!defined('ABSPATH')) {
    exit;
}

// ベースクラスを読み込み
require_once get_stylesheet_directory() . '/modules_smart/core/SmartModuleBase.php';

class SmartCtaModule extends SmartModuleBase {
    
    /**
     * モジュール名を取得
     */
    protected function get_module_name(): string {
        return 'cta';
    }
    
    /**
     * デフォルト値を定義
     */
    protected function get_defaults(): array {
        return [
            'title' => '今すぐお問い合わせください',
            'subtitle' => 'お客様の課題解決のため、まずはお気軽にご相談ください。専門スタッフが丁寧にサポートいたします。',
            'bg_color' => '#667eea',
            'text_color' => '#ffffff',
            
            // メインCTAボタン
            'main_cta_text' => '無料相談はこちら',
            'main_cta_link' => '#contact',
            'main_cta_bg_color' => '#ffffff',
            'main_cta_text_color' => '#667eea',
            
            // サブCTAボタン
            'sub_cta_text' => '資料ダウンロード',
            'sub_cta_link' => '#download',
            'sub_cta_bg_color' => 'transparent',
            'sub_cta_text_color' => '#ffffff',
            
            // 電話番号
            'phone_display' => true,
            'phone_number' => '03-1234-5678',
            'phone_hours' => '平日 9:00-18:00',
            
            // メールアドレス
            'email_display' => true,
            'email_address' => 'info@example.com',
            
            // 緊急性・限定性
            'urgency_text' => '今月末までの期間限定',
            'urgency_display' => false,
            
            // 安心要素
            'trust_text' => '✓ 相談無料 ✓ 秘密厳守 ✓ 24時間以内に回答',
            'trust_display' => true,
        ];
    }
    
    /**
     * HTMLを生成
     */
    protected function generate_html(array $data): string {
        ob_start();
        ?>
        <section id="<?php echo esc_attr($this->unique_id); ?>" class="smart-cta-module" 
                 style="background-color: <?php echo esc_attr($data['bg_color']); ?>; color: <?php echo esc_attr($data['text_color']); ?>;">
            <div class="container">
                
                <!-- メインコンテンツ - 横長レイアウト -->
                <div class="cta-content">
                    
                    <!-- 左側：情報エリア -->
                    <div class="cta-info" data-aos="fade-right">
                        
                        <!-- ヘッダー部分 -->
                        <div class="cta-header">
                            <h2 class="cta-title"><?php echo wp_kses_post($data['title']); ?></h2>
                            <p class="cta-subtitle"><?php echo esc_html($data['subtitle']); ?></p>
                        </div>
                        
                        <!-- 緊急性・限定性テキスト -->
                        <?php if ($data['urgency_display']): ?>
                        <div class="cta-urgency">
                            <span class="urgency-badge"><?php echo esc_html($data['urgency_text']); ?></span>
                        </div>
                        <?php endif; ?>
                        
                        <!-- 安心要素 -->
                        <?php if ($data['trust_display']): ?>
                        <div class="cta-trust">
                            <p class="trust-text"><?php echo wp_kses_post($data['trust_text']); ?></p>
                        </div>
                        <?php endif; ?>
                        
                    </div>
                    
                    <!-- 右側：アクションエリア -->
                    <div class="cta-action" data-aos="fade-left">
                        
                        <!-- CTAボタン群 -->
                        <div class="cta-buttons">
                            
                            <!-- メインCTAボタン -->
                            <a href="<?php echo esc_url($data['main_cta_link']); ?>" 
                               class="cta-button cta-button-main"
                               style="background-color: <?php echo esc_attr($data['main_cta_bg_color']); ?>; color: <?php echo esc_attr($data['main_cta_text_color']); ?>;">
                                <?php echo esc_html($data['main_cta_text']); ?>
                                <i class="fas fa-arrow-right"></i>
                            </a>
                            
                            <!-- サブCTAボタン -->
                            <a href="<?php echo esc_url($data['sub_cta_link']); ?>" 
                               class="cta-button cta-button-sub"
                               style="background-color: <?php echo esc_attr($data['sub_cta_bg_color']); ?>; color: <?php echo esc_attr($data['sub_cta_text_color']); ?>; border-color: <?php echo esc_attr($data['sub_cta_text_color']); ?>;">
                                <?php echo esc_html($data['sub_cta_text']); ?>
                                <i class="fas fa-download"></i>
                            </a>
                            
                        </div>
                        
                        <!-- 連絡先情報 -->
                        <div class="cta-contact">
                            
                            <!-- 電話番号 -->
                            <?php if ($data['phone_display']): ?>
                            <div class="contact-item contact-phone">
                                <div class="contact-icon">
                                    <i class="fas fa-phone"></i>
                                </div>
                                <div class="contact-info">
                                    <div class="contact-value">
                                        <a href="tel:<?php echo esc_attr(preg_replace('/[^0-9]/', '', $data['phone_number'])); ?>">
                                            <?php echo esc_html($data['phone_number']); ?>
                                        </a>
                                    </div>
                                    <div class="contact-desc"><?php echo esc_html($data['phone_hours']); ?></div>
                                </div>
                            </div>
                            <?php endif; ?>
                            
                            <!-- メールアドレス -->
                            <?php if ($data['email_display']): ?>
                            <div class="contact-item contact-email">
                                <div class="contact-icon">
                                    <i class="fas fa-envelope"></i>
                                </div>
                                <div class="contact-info">
                                    <div class="contact-value">
                                        <a href="mailto:<?php echo esc_attr($data['email_address']); ?>">
                                            <?php echo esc_html($data['email_address']); ?>
                                        </a>
                                    </div>
                                    <div class="contact-desc">24時間受付</div>
                                </div>
                            </div>
                            <?php endif; ?>
                            
                        </div>
                        
                    </div>
                    
                </div>
                
            </div>
        </section>
        <?php
        return ob_get_clean();
    }
}