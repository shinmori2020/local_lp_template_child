# Smart Modules トラブルシューティングガイド 🔧

Smart Modulesシステムで発生した問題とその解決方法を記録したガイドです。

---

## 📋 目次

1. [ACFフィールド変更が反映されない問題](#acf-field-issue)
2. [その他のよくある問題](#common-issues)
3. [デバッグ方法](#debugging-methods)
4. [予防策](#prevention-tips)

---

## 🚨 ACFフィールド変更が反映されない問題 {#acf-field-issue}

### 問題の症状
- 固定ページのSmart Hero ModuleのACFフィールド（Title, Subtitle, Cta Text, Cta Link）で変更した内容がフロントエンドに反映されない
- デフォルト値や古い値が表示され続ける
- 一部のフィールドのみ反映される、または全て反映されない

### 🔍 原因分析

#### **根本原因1: ショートコード属性による上書き**

**問題のコード例:**
```php
// page-smart-test.php または投稿・固定ページ内
do_shortcode('[hero_smart_module title="固定値" subtitle="固定値" cta_text="固定値"]');
```

**データ優先順位:**
```
1. デフォルト値（最低優先度）
2. ACFフィールド値（中優先度）
3. ショートコード属性（最高優先度） ← これが問題
```

**影響:**
- ショートコード属性がACFフィールドの値を常に上書きする
- ACFで変更しても属性値が優先される

#### **根本原因2: ACFフィールドの場所設定問題**

**問題のコード:**
```php
// SmartModuleLoader.php 内
'location' => [
    [
        [
            'param' => 'post_type',
            'operator' => '==',
            'value' => 'page', // 全ての固定ページに表示
        ],
    ],
],
```

**影響:**
- 全ての固定ページでSmart Modulesフィールドが表示される
- 複数のページで同じフィールドを編集できてしまう
- ページ間での値の競合が発生
- 意図しないページでフィールドが表示される

### ✅ 解決方法

#### **解決策1: ショートコード属性を削除**

**修正前:**
```php
<?php echo do_shortcode('[hero_smart_module title="Smart Modules テスト" subtitle="新しいモジュールシステムの動作確認中" cta_text="テスト実行中"]'); ?>
```

**修正後:**
```php
<?php echo do_shortcode('[hero_smart_module]'); ?>
```

**効果:**
- ACFフィールドの値が正しく適用される
- 必要に応じてショートコード属性で個別上書き可能

#### **解決策2: ACFフィールドの場所設定を制限**

**修正前:**
```php
'location' => [
    [
        [
            'param' => 'post_type',
            'operator' => '==',
            'value' => 'page',
        ],
    ],
],
```

**修正後:**
```php
'location' => [
    [
        [
            'param' => 'page_template',
            'operator' => '==',
            'value' => 'page-smart-test.php',
        ],
    ],
    [
        [
            'param' => 'page_template',
            'operator' => '==',
            'value' => 'custom_template.php',
        ],
    ],
    [
        [
            'param' => 'page_template',
            'operator' => '==',
            'value' => 'custom_template_site.php',
        ],
    ],
],
```

**効果:**
- 特定のページテンプレートでのみフィールドが表示される
- 他のページには影響しない
- 値の競合が解消される

#### **解決策3: デバッグ機能の追加**

**一時的なデバッグコード:**
```php
// SmartModuleBase.php のget_acf_values()メソッドに追加
if (current_user_can('administrator')) {
    error_log("=== ACF Debug ({$this->module_name}) ===");
    error_log("Post ID: {$post_id}");
    foreach ($this->get_defaults() as $key => $default_value) {
        $acf_key = $this->module_name . '_' . $key;
        $acf_value = get_field($acf_key, $post_id);
        error_log("Field: {$acf_key} -> Value: " . var_export($acf_value, true));
    }
}
```

**フロントエンドデバッグ表示:**
```php
// hero_module.php のgenerate_html()メソッドに追加
<?php if (current_user_can('administrator') && isset($_GET['debug'])): ?>
    <div style="background: #f0f0f0; color: #000; padding: 10px; margin: 10px; font-size: 12px;">
        <strong>Hero Module Debug Info:</strong><br>
        <strong>Data Array:</strong><br>
        <?php foreach ($data as $key => $value): ?>
            <strong><?php echo esc_html($key); ?>:</strong> <?php echo esc_html($value); ?><br>
        <?php endforeach; ?>
        <br>
        <strong>ACF get_field Tests:</strong><br>
        hero_title: <?php echo esc_html(get_field('hero_title', get_the_ID())); ?><br>
        hero_subtitle: <?php echo esc_html(get_field('hero_subtitle', get_the_ID())); ?><br>
    </div>
<?php endif; ?>
```

### 🔍 デバッグ手順

1. **フロントエンドデバッグの確認**
   - ページURL に `?debug=1` を追加
   - Data Array と ACF get_field Tests の値を比較

2. **ショートコードの確認**
   - ページテンプレートファイルでショートコード使用箇所を検索
   - 属性指定がないか確認

3. **ACFフィールド登録の確認**
   - WordPress管理画面でSmart Modules Debug Infoをチェック
   - フィールドグループの場所設定を確認

4. **WordPressエラーログの確認**
   - `/wp-content/debug.log` でACF値取得プロセスを確認

### 📝 予防策

1. **ショートコード使用のベストプラクティス**
   ```php
   // 推奨：属性なし（ACFフィールド値を使用）
   [hero_smart_module]
   
   // 一時的な上書きが必要な場合のみ
   [hero_smart_module title="特別なタイトル"]
   ```

2. **ACFフィールドの場所設定**
   - 特定のページテンプレートに限定する
   - 全ページ表示（`post_type = page`）は避ける

3. **デバッグ機能の活用**
   - 開発中は `?debug=1` で定期的に確認
   - WordPressのWP_DEBUGを有効にしてログ監視

---

## 🔧 その他のよくある問題 {#common-issues}

### 問題1: CSSスタイルが適用されない

**症状:** モジュールは表示されるがスタイルが反映されない

**原因:**
- CSSファイルが見つからない
- ブラウザキャッシュ

**解決方法:**
1. `modules_smart/assets/css/` にCSSファイルがあるか確認
2. ブラウザキャッシュをクリア（Ctrl+F5）
3. WordPress管理画面で設定を一度保存

### 問題2: ショートコードが文字として表示される

**症状:** `[hero_smart_module]` がそのまま表示される

**原因:**
- Smart Modulesシステムが読み込まれていない

**解決方法:**
1. `functions.php` に以下が記述されているか確認:
   ```php
   require_once get_stylesheet_directory() . '/modules_smart/smart_modules_loader.php';
   ```
2. `modules_smart` フォルダが正しい場所にあるか確認

### 問題3: ACFフィールドが表示されない

**症状:** 固定ページ編集画面でSmart Modulesフィールドが表示されない

**原因:**
- ACFプラグインが無効
- フィールドグループの場所設定

**解決方法:**
1. Advanced Custom Fieldsプラグインが有効か確認
2. 正しいページテンプレートが選択されているか確認
3. 管理画面のSmart Modules Debug Infoを確認

---

## 🐛 デバッグ方法 {#debugging-methods}

### フロントエンドデバッグ

**使用方法:**
```
https://yoursite.com/page/?debug=1
```

**表示される情報:**
- Data Array: 実際にモジュールに渡されるデータ
- ACF get_field Tests: ACFから直接取得される値
- Current Post ID: 現在のページID

### WordPressエラーログ

**ログファイル場所:**
```
/wp-content/debug.log
```

**wp-config.php設定:**
```php
define('WP_DEBUG', true);
define('WP_DEBUG_LOG', true);
```

**ログで確認できる情報:**
- ACFフィールド登録プロセス
- 値取得プロセス
- データマージプロセス

### 管理画面デバッグ情報

**場所:** WordPress管理画面の通知エリア

**表示される情報:**
- ACFプラグインの有効状態
- 検出されたモジュール一覧
- 登録済みACFフィールドグループ
- 各フィールドの詳細情報

---

## 🛡️ 予防策とベストプラクティス {#prevention-tips}

### 1. ショートコード使用時の注意点

```php
// ✅ 推奨：ACFフィールドを活用
[hero_smart_module]

// ⚠️ 必要時のみ：特定の属性のみ上書き
[hero_smart_module cta_text="特別なCTA"]

// ❌ 非推奨：全属性を指定（ACFの意味がない）
[hero_smart_module title="..." subtitle="..." cta_text="..."]
```

### 2. ACFフィールド設定のベストプラクティス

```php
// ✅ 推奨：特定テンプレートに限定
'location' => [
    [['param' => 'page_template', 'operator' => '==', 'value' => 'page-smart-test.php']],
]

// ❌ 非推奨：全ページに表示
'location' => [
    [['param' => 'post_type', 'operator' => '==', 'value' => 'page']],
]
```

### 3. 開発時のデバッグ習慣

1. **定期的な動作確認**
   - `?debug=1` での値確認
   - 管理画面デバッグ情報の確認

2. **エラーログの監視**
   - WP_DEBUGを有効にする
   - 定期的にログをチェック

3. **段階的な実装**
   - 一つずつモジュールを追加
   - 各段階で動作確認

### 4. 本番環境での注意点

1. **デバッグ機能の無効化**
   ```php
   // 本番環境では必ずfalseに
   define('WP_DEBUG', false);
   ```

2. **不要なデバッグコードの削除**
   - `?debug=1` 関連のコード
   - error_log() 出力

3. **キャッシュ対策**
   - ブラウザキャッシュ設定
   - WordPressキャッシュプラグイン対応

---

## 📞 サポート情報

### システム要件
- WordPress 5.0以上
- PHP 7.4以上
- ACF（Advanced Custom Fields）プラグイン（無料版でOK）

### 関連ファイル
- `modules_smart/core/SmartModuleLoader.php` - システム本体
- `modules_smart/core/SmartModuleBase.php` - 基底クラス
- `modules_smart/modules/hero/hero_module.php` - Heroモジュール
- `page-smart-test.php` - テスト用ページテンプレート

### 追加リソース
- `README.md` - システム全体の説明
- `THEME_CREATION_GUIDE.md` - テーマ作成ガイド
- `QUICK_REFERENCE.md` - 開発者向けリファレンス

---

*このトラブルシューティングガイドは実際に発生した問題と解決方法を基に作成されています。新しい問題や解決方法があれば、このファイルを更新してください。*

**最終更新日:** 2025年8月5日  
**作成者:** Claude Code Assistant  
**バージョン:** Smart Modules v1.0.0