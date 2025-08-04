<?php
/**
 * Smart [MODULE_NAME] Module - [MODULE_DESCRIPTION]
 * 
 * 特徴:
 * - ACF設定不要（デフォルト値内蔵）
 * - [特徴1]
 * - [特徴2]
 * - レスポンシブ対応
 * 
 * ショートコード: [[MODULE_NAME]_smart_module]
 * 
 * @package SmartModules
 */

// 直接アクセスを防ぐ
if (!defined('ABSPATH')) {
    exit;
}

// ベースクラスを読み込み
require_once get_stylesheet_directory() . '/modules_smart/core/SmartModuleBase.php';

class Smart[MODULE_CLASS_NAME]Module extends SmartModuleBase {
    
    /**
     * モジュール名を取得
     */
    protected function get_module_name(): string {
        return '[MODULE_NAME]';
    }
    
    /**
     * デフォルト値を定義
     * 
     * 注意: ここで定義したキーは自動的にACFフィールドになります
     * - 50文字以下 = text フィールド
     * - 50文字超 or 改行含む = textarea フィールド  
     * - 数値 = number フィールド
     * - boolean = true_false フィールド
     */
    protected function get_defaults(): array {
        return [
            // 基本情報
            'title' => '[デフォルトタイトル]',
            'subtitle' => '[デフォルトサブタイトル]',
            'description' => '[デフォルト説明文（長文の場合）]',
            
            // スタイル関連
            'bg_color' => '#ffffff',
            'text_color' => '#333333',
            'accent_color' => '#007cba',
            
            // コンテンツ関連
            'button_text' => 'ボタンテキスト',
            'button_url' => '#',
            
            // 追加フィールド例
            // 'image_url' => '',
            // 'show_button' => true,
            // 'items_count' => 3,
            
            // ※ 新しいフィールドを追加する場合は、generate_html()でも使用すること
        ];
    }
    
    /**
     * HTMLテンプレートを生成
     * 
     * $data配列にはデフォルト値 + ACF値 + ショートコード属性がマージされて渡される
     */
    protected function generate_html(array $data): string {
        ob_start();
        ?>
        <section id="<?php echo esc_attr($this->unique_id); ?>" class="smart-[MODULE_NAME]-module" 
                 style="background-color: <?php echo esc_attr($data['bg_color']); ?>; color: <?php echo esc_attr($data['text_color']); ?>;">
            
            <div class="[MODULE_NAME]-container">
                
                <!-- ヘッダー -->
                <div class="[MODULE_NAME]-header" data-aos="fade-up">
                    <h2 class="[MODULE_NAME]-title">
                        <?php echo esc_html($data['title']); ?>
                    </h2>
                    
                    <?php if (!empty($data['subtitle'])): ?>
                        <p class="[MODULE_NAME]-subtitle">
                            <?php echo esc_html($data['subtitle']); ?>
                        </p>
                    <?php endif; ?>
                </div>
                
                <!-- メインコンテンツ -->
                <div class="[MODULE_NAME]-content" data-aos="fade-up" data-aos-delay="200">
                    <?php if (!empty($data['description'])): ?>
                        <div class="[MODULE_NAME]-description">
                            <?php echo $this->esc_html_with_breaks($data['description']); ?>
                        </div>
                    <?php endif; ?>
                    
                    <!-- ここに具体的なコンテンツ構造を追加 -->
                    <!-- 例: カード、グリッド、リスト等 -->
                </div>
                
                <!-- アクションボタン（オプション） -->
                <?php if (!empty($data['button_text']) && !empty($data['button_url'])): ?>
                    <div class="[MODULE_NAME]-actions" data-aos="fade-up" data-aos-delay="400">
                        <a href="<?php echo esc_url($data['button_url']); ?>" 
                           class="[MODULE_NAME]-button" 
                           style="background-color: <?php echo esc_attr($data['accent_color']); ?>;">
                            <?php echo esc_html($data['button_text']); ?>
                        </a>
                    </div>
                <?php endif; ?>
                
            </div>
        </section>
        <?php
        return ob_get_clean();
    }
    
    /**
     * 追加のACFフィールド設定（オプション）
     * 
     * デフォルトの自動生成をカスタマイズしたい場合にオーバーライド
     */
    protected function build_acf_fields() {
        $fields = parent::build_acf_fields();
        
        // カスタマイズ例
        foreach ($fields as &$field) {
            // カラーフィールドをカラーピッカーに変更
            if (strpos($field['name'], '_color') !== false) {
                $field['type'] = 'color_picker';
            }
            
            // 画像フィールドを画像選択に変更
            if (strpos($field['name'], '_image') !== false) {
                $field['type'] = 'image';
                $field['return_format'] = 'url';
            }
            
            // URLフィールドをURL型に変更
            if (strpos($field['name'], '_url') !== false) {
                $field['type'] = 'url';
            }
            
            // 選択フィールドの例
            if ($field['name'] === '[MODULE_NAME]_layout_type') {
                $field['type'] = 'select';
                $field['choices'] = [
                    'grid' => 'グリッドレイアウト',
                    'list' => 'リストレイアウト',
                    'carousel' => 'カルーセル'
                ];
            }
        }
        
        return $fields;
    }
}

/* 
使用方法:
1. [MODULE_NAME] を実際のモジュール名に置換（例: benefit, pricing, contact）
2. [MODULE_CLASS_NAME] をクラス名に置換（例: Benefit, Pricing, Contact）
3. [MODULE_DESCRIPTION] を説明に置換
4. get_defaults() でフィールドを定義
5. generate_html() でHTMLテンプレートを作成
6. 対応するCSSファイルを作成: assets/css/[MODULE_NAME].css

自動で利用可能になる機能:
- ACFフィールド自動生成
- ショートコード登録: [[MODULE_NAME]_smart_module]
- アセット自動読み込み
- 遅延読み込み対応
- デバッグ情報対応
- セキュリティ対応（XSS防止）
*/