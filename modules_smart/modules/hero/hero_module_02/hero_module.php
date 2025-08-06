<?php
/**
 * Smart Hero Module - 効率的なヒーローセクション
 * 
 * 特徴:
 * - ACF設定不要（デフォルト値内蔵）
 * - 単体完結機能
 * - レスポンシブ対応
 * - カスタマイズ可能
 * 
 * ショートコード: [hero_smart_module]
 * 
 * @package SmartModules
 */

// 直接アクセスを防ぐ
if (!defined('ABSPATH')) {
    exit;
}

// ベースクラスを読み込み
require_once get_stylesheet_directory() . '/modules_smart/core/SmartModuleBase.php';

class SmartHeroModuleV02 extends SmartModuleBase {
    
    /**
     * モジュール名を取得
     */
    protected function get_module_name(): string {
        return 'hero';
    }
    
    /**
     * デフォルト値を定義
     */
    protected function get_defaults(): array {
        return [
            'title' => '【バージョン02】あなたのビジネスを<br>さらなる高みへ',
            'subtitle' => '【v02テスト】革新的技術で業務を劇的に改善し、業界トップに躍り出ましょう。導入企業の98%が大幅改善を実感！',
            'cta_text' => '無料相談を申し込む',
            'cta_link' => '#contact',
            'cta_sub' => '初回相談無料・オンライン対応',
            'bg_color' => '#E74C3C',
            'text_color' => '#ffffff',
            'show_stats' => true,
            'stat1_number' => '98%',
            'stat1_label' => '大幅改善',
            'stat2_number' => '2000+',
            'stat2_label' => '成功企業',
            'stat3_number' => '24h',
            'stat3_label' => 'サポート対応'
        ];
    }
    
    /**
     * HTMLテンプレートを生成
     */
    protected function generate_html(array $data): string {
        ob_start();
        ?>
        <section id="<?php echo esc_attr($this->unique_id); ?>" class="smart-hero-module" 
                 style="background-color: <?php echo esc_attr($data['bg_color']); ?>; color: <?php echo esc_attr($data['text_color']); ?>;">
            
            <?php if (current_user_can('administrator')): ?>
                <!-- キャッシュ確認用（一時的） -->
                <div style="font-size: 10px; color: #ccc; position: absolute; top: 0; right: 0; background: rgba(0,0,0,0.5); padding: 2px 5px;">
                    <?php echo date('H:i:s'); ?> | ID:<?php echo get_the_ID(); ?> | <?php echo $data['title']; ?>
                </div>
            <?php endif; ?>
            
            <!-- 背景装飾 -->
            <div class="hero-bg-decoration">
                <div class="bg-circle bg-circle-1"></div>
                <div class="bg-circle bg-circle-2"></div>
                <div class="bg-circle bg-circle-3"></div>
            </div>
            
            <div class="hero-container">
                <div class="hero-content">
                    
                    <!-- メインコンテンツ -->
                    <div class="hero-main">
                        <h1 class="hero-title">
                            <?php echo $this->wp_kses_basic($data['title']); ?>
                        </h1>
                        
                        <p class="hero-subtitle">
                            <?php echo esc_html($data['subtitle']); ?>
                        </p>
                        
                        <div class="hero-cta">
                            <a href="<?php echo esc_url($data['cta_link']); ?>" class="cta-button">
                                <i class="fas fa-rocket"></i>
                                <?php echo esc_html($data['cta_text']); ?>
                            </a>
                            
                            <?php if (!empty($data['cta_sub'])): ?>
                                <p class="cta-sub">
                                    <?php echo esc_html($data['cta_sub']); ?>
                                </p>
                            <?php endif; ?>
                        </div>
                    </div>
                    
                    <!-- 統計情報 -->
                    <?php if ($data['show_stats']): ?>
                        <div class="hero-stats">
                            <div class="stat-item">
                                <div class="stat-number"><?php echo esc_html($data['stat1_number']); ?></div>
                                <div class="stat-label"><?php echo esc_html($data['stat1_label']); ?></div>
                            </div>
                            <div class="stat-item">
                                <div class="stat-number"><?php echo esc_html($data['stat2_number']); ?></div>
                                <div class="stat-label"><?php echo esc_html($data['stat2_label']); ?></div>
                            </div>
                            <div class="stat-item">
                                <div class="stat-number"><?php echo esc_html($data['stat3_number']); ?></div>
                                <div class="stat-label"><?php echo esc_html($data['stat3_label']); ?></div>
                            </div>
                        </div>
                    <?php endif; ?>
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
            if ($field['name'] === 'hero_bg_color') {
                $field['type'] = 'color_picker';
                $field['default_value'] = '#4A90E2';
            } elseif ($field['name'] === 'hero_text_color') {
                $field['type'] = 'color_picker';
                $field['default_value'] = '#ffffff';
            } elseif ($field['name'] === 'hero_show_stats') {
                $field['type'] = 'true_false';
                $field['default_value'] = 1;
                $field['ui'] = 1;
            }
        }
        
        return $fields;
    }
}