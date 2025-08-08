<?php
/**
 * Smart Features Module - 詳細機能説明セクション
 * 
 * 特徴:
 * - ACF設定不要（デフォルト値内蔵）
 * - 6つの機能をグリッド表示
 * - アイコン付きカード形式
 * - レスポンシブ対応
 * 
 * ショートコード: [features_smart_module]
 * 
 * @package SmartModules
 */

// 直接アクセスを防ぐ
if (!defined('ABSPATH')) {
    exit;
}

// ベースクラスを読み込み
require_once get_stylesheet_directory() . '/modules_smart/core/SmartModuleBase.php';

class SmartFeaturesModule extends SmartModuleBase {
    
    /**
     * モジュール名を取得
     */
    protected function get_module_name(): string {
        return 'features';
    }
    
    /**
     * デフォルト値を定義
     */
    protected function get_defaults(): array {
        return [
            'title' => '選ばれる理由',
            'subtitle' => '私たちのサービスが多くの企業様に選ばれる4つの特徴をご紹介します',
            'bg_color' => '#f8f9fa',
            'text_color' => '#333333',
            
            // 機能1
            'feature1_title' => '高速処理技術',
            'feature1_description' => '最新技術により従来比3倍の処理速度を実現。業務効率を大幅に向上させ、生産性の向上に貢献します。',
            'feature1_image' => 'https://via.placeholder.com/500x300/667eea/ffffff?text=高速処理技術',
            'feature1_link' => '#speed-technology',
            'feature1_link_text' => '詳細を見る',
            
            // 機能2
            'feature2_title' => '強固なセキュリティ',
            'feature2_description' => '業界最高水準の暗号化技術で大切なデータを保護。多層防御システムで安心してご利用いただけます。',
            'feature2_image' => 'https://via.placeholder.com/500x300/764ba2/ffffff?text=セキュリティ',
            'feature2_link' => '#security',
            'feature2_link_text' => 'セキュリティ詳細',
            
            // 機能3
            'feature3_title' => '完全レスポンシブ対応',
            'feature3_description' => 'PC、タブレット、スマートフォンすべてのデバイスで最適な表示を実現。どこからでも快適にアクセスできます。',
            'feature3_image' => 'https://via.placeholder.com/500x300/4facfe/ffffff?text=レスポンシブ',
            'feature3_link' => '#responsive',
            'feature3_link_text' => '対応デバイス確認',
            
            // 機能4
            'feature4_title' => '24時間サポート体制',
            'feature4_description' => '専門スタッフが24時間365日対応。トラブル時も迅速にサポートし、安心してご利用いただけます。',
            'feature4_image' => 'https://via.placeholder.com/500x300/00d4aa/ffffff?text=24時間サポート',
            'feature4_link' => '#support',
            'feature4_link_text' => 'サポート詳細',
        ];
    }
    
    /**
     * HTMLを生成
     */
    protected function generate_html(array $data): string {
        ob_start();
        ?>
        <section id="<?php echo esc_attr($this->unique_id); ?>" class="smart-features-module" 
                 style="background-color: <?php echo esc_attr($data['bg_color']); ?>; color: <?php echo esc_attr($data['text_color']); ?>;">
            <div class="container">
                <!-- ヘッダー部分 -->
                <div class="features-header" data-aos="fade-up">
                    <h2 class="features-title"><?php echo wp_kses_post($data['title']); ?></h2>
                    <p class="features-subtitle"><?php echo esc_html($data['subtitle']); ?></p>
                </div>
                
                <!-- 機能リスト -->
                <div class="features-list">
                    <?php for ($i = 1; $i <= 4; $i++): 
                        $is_even = ($i % 2 === 0);
                        $aos_effect = $is_even ? 'fade-left' : 'fade-right';
                        $delay = ($i * 200);
                    ?>
                        <div class="feature-item <?php echo $is_even ? 'reverse' : ''; ?>" data-aos="<?php echo $aos_effect; ?>" data-aos-delay="<?php echo $delay; ?>">
                            <!-- テキスト部分 -->
                            <div class="feature-content">
                                <h3 class="feature-title"><?php echo esc_html($data["feature{$i}_title"]); ?></h3>
                                <p class="feature-description"><?php echo esc_html($data["feature{$i}_description"]); ?></p>
                                <a href="<?php echo esc_url($data["feature{$i}_link"]); ?>" class="feature-link">
                                    <?php echo esc_html($data["feature{$i}_link_text"]); ?>
                                    <i class="fas fa-arrow-right"></i>
                                </a>
                            </div>
                            
                            <!-- 画像部分 -->
                            <div class="feature-image">
                                <img src="<?php echo esc_url($data["feature{$i}_image"]); ?>" 
                                     alt="<?php echo esc_attr($data["feature{$i}_title"]); ?>"
                                     loading="lazy">
                            </div>
                        </div>
                    <?php endfor; ?>
                </div>
            </div>
        </section>
        <?php
        return ob_get_clean();
    }
}