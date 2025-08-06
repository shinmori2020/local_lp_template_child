<?php
/**
 * Smart Problem Module - 効率的な課題提起セクション
 * 
 * 特徴:
 * - ACF設定不要（デフォルト値内蔵）
 * - カード形式で課題を表示
 * - アニメーション効果
 * - レスポンシブ対応
 * 
 * ショートコード: [problem_smart_module]
 * 
 * @package SmartModules
 */

// 直接アクセスを防ぐ
if (!defined('ABSPATH')) {
    exit;
}

// ベースクラスを読み込み
require_once get_stylesheet_directory() . '/modules_smart/core/SmartModuleBase.php';

class SmartProblemModule extends SmartModuleBase {
    
    /**
     * モジュール名を取得
     */
    protected function get_module_name(): string {
        return 'problem';
    }
    
    /**
     * デフォルト値を定義
     */
    protected function get_defaults(): array {
        return [
            'title' => 'こんな課題を抱えていませんか？',
            'subtitle' => '多くの企業が直面している共通の課題があります',
            'problem1_icon' => 'fas fa-clock',
            'problem1_title' => '時間の無駄が多い',
            'problem1_desc' => '手作業による処理で貴重な時間を浪費している',
            'problem2_icon' => 'fas fa-chart-line',
            'problem2_title' => '効率が上がらない',
            'problem2_desc' => '古いシステムでは限界があり、生産性が向上しない',
            'problem3_icon' => 'fas fa-users',
            'problem3_title' => '人手不足に悩む',
            'problem3_desc' => 'スタッフの負担が増加し、離職率も上昇している',
            'problem4_icon' => 'fas fa-exclamation-triangle',
            'problem4_title' => 'ミスが頻発する',
            'problem4_desc' => '人的エラーによる問題が後を絶たない',
            'problem5_icon' => 'fas fa-cog',
            'problem5_title' => 'システムが複雑',
            'problem5_desc' => '複数のツールを使い分ける必要があり、管理が煩雑',
            'problem6_icon' => 'fas fa-money-bill',
            'problem6_title' => 'コストが増加',
            'problem6_desc' => '非効率な運用により、余計な費用がかかっている',
            'empathy_text' => 'これらの課題、きっとあなたも感じていることでしょう。',
            'empathy_subtext' => 'でも大丈夫です。解決策があります。',
            'show_empathy' => true,
            'bg_color' => '#f8f9fa',
            'text_color' => '#333333',
            'accent_color' => '#e74c3c'
        ];
    }
    
    /**
     * HTMLテンプレートを生成
     */
    protected function generate_html(array $data): string {
        ob_start();
        ?>
        <section id="<?php echo esc_attr($this->unique_id); ?>" class="smart-problem-module" 
                 style="background-color: <?php echo esc_attr($data['bg_color']); ?>; color: <?php echo esc_attr($data['text_color']); ?>;">
            
            <div class="problem-container">
                
                <!-- ヘッダー -->
                <div class="problem-header">
                    <h2 class="problem-title">
                        <?php echo esc_html($data['title']); ?>
                    </h2>
                    
                    <?php if (!empty($data['subtitle'])): ?>
                        <p class="problem-subtitle">
                            <?php echo esc_html($data['subtitle']); ?>
                        </p>
                    <?php endif; ?>
                </div>
                
                <!-- 課題カード -->
                <div class="problem-grid">
                    <?php for ($i = 1; $i <= 6; $i++): 
                        $title_key = "problem{$i}_title";
                        $icon_key = "problem{$i}_icon";
                        $desc_key = "problem{$i}_desc";
                    ?>
                        <div class="problem-card" data-aos="fade-up" data-aos-delay="<?php echo ($i - 1) * 100; ?>">
                            <div class="problem-icon" style="color: <?php echo esc_attr($data['accent_color']); ?>;">
                                <i class="<?php echo esc_attr($data[$icon_key]); ?>"></i>
                            </div>
                            
                            <h3 class="problem-card-title">
                                <?php echo esc_html($data[$title_key]); ?>
                            </h3>
                            
                            <p class="problem-card-desc">
                                <?php echo esc_html($data[$desc_key]); ?>
                            </p>
                        </div>
                    <?php endfor; ?>
                </div>
                
                <!-- 共感セクション -->
                <?php if ($data['show_empathy']): ?>
                    <div class="problem-empathy">
                        <div class="empathy-content">
                            <?php if (!empty($data['empathy_text'])): ?>
                                <p class="empathy-text">
                                    <i class="fas fa-heart" style="color: <?php echo esc_attr($data['accent_color']); ?>;"></i>
                                    <?php echo esc_html($data['empathy_text']); ?>
                                </p>
                            <?php endif; ?>
                            
                            <?php if (!empty($data['empathy_subtext'])): ?>
                                <p class="empathy-subtext">
                                    <?php echo esc_html($data['empathy_subtext']); ?>
                                </p>
                            <?php endif; ?>
                        </div>
                    </div>
                <?php endif; ?>
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
        
        // アイコンフィールドを選択式に変更
        foreach ($fields as &$field) {
            if (strpos($field['name'], '_icon') !== false) {
                $field['type'] = 'select';
                $field['choices'] = [
                    'fas fa-clock' => '⏰ 時計',
                    'fas fa-chart-line' => '📈 グラフ',
                    'fas fa-users' => '👥 ユーザー',
                    'fas fa-exclamation-triangle' => '⚠️ 警告',
                    'fas fa-cog' => '⚙️ 設定',
                    'fas fa-money-bill' => '💰 お金',
                    'fas fa-shield-alt' => '🛡️ セキュリティ',
                    'fas fa-mobile-alt' => '📱 モバイル'
                ];
            } elseif (in_array($field['name'], ['problem_bg_color', 'problem_text_color', 'problem_accent_color'])) {
                $field['type'] = 'color_picker';
            } elseif ($field['name'] === 'problem_show_empathy') {
                $field['type'] = 'true_false';
                $field['default_value'] = 1;
                $field['ui'] = 1;
                $field['label'] = '共感セクションを表示';
            } elseif (in_array($field['name'], ['problem_empathy_text', 'problem_empathy_subtext'])) {
                $field['type'] = 'textarea';
                $field['rows'] = 3;
            }
        }
        
        return $fields;
    }
}