# Complete Independent Modules System

完全独立型モジュールシステム - WordPress ランディングページ用

## 🚀 概要

各モジュールがCSS、JavaScript、ACFフィールド、ショートコードをすべて内包した完全独立型設計のモジュールシステムです。

### 特徴

- ✅ **完全独立** - 各モジュールが他のファイルに依存しない
- ✅ **ショートコード対応** - `[hero_module]` のように簡単呼び出し
- ✅ **ACF自動登録** - カスタムフィールドが自動で作成される
- ✅ **動的ACF表示制御** - 使用するモジュールのフィールドのみ表示（NEW!）
- ✅ **レスポンシブ対応** - モバイルファーストデザイン
- ✅ **パフォーマンス最適化** - 必要なモジュールのみ読み込み
- ✅ **カスタマイズ可能** - 属性やACFで簡単編集

## 📁 ファイル構成

```
modules_complete/
├── firstview/
│   └── firstview_01_complete.php  # ファーストビューセクション（NEW!）
├── hero_complete.php       # ヒーローセクション
├── problem_complete.php    # 課題セクション  
├── benefit_complete.php    # ベネフィットセクション
├── pricing_complete.php    # 料金セクション
├── contact_complete.php    # お問い合わせセクション
├── module_loader.php       # モジュールローダー（動的ACF制御対応）
├── demo_page.php          # デモページテンプレート
└── README.md              # このファイル
```

## ⚡ クイックスタート

### 1. システム有効化

`functions.php` に以下を追加（既に追加済み）:

```php
if (file_exists(get_stylesheet_directory() . '/modules_complete/module_loader.php')) {
    require_once get_stylesheet_directory() . '/modules_complete/module_loader.php';
}
```

### 2. 基本的な使用方法

固定ページまたは投稿に以下のショートコードを貼り付け:

```
[firstview_01_module]
[hero_module]
[problem_module]
[benefit_module]
[pricing_module]
[contact_module]
```

### 3. カスタマイズ

WordPress管理画面のカスタムフィールドで内容を編集、またはショートコード属性で直接指定:

```
[hero_module title="カスタムタイトル" cta_text="今すぐ始める"]
[problem_module title="お困りごとはありませんか？"]
[contact_module email="info@yoursite.com"]
```

## 🎯 各モジュール詳細

### Firstview Module (`[firstview_01_module]`) - NEW!

**機能**: メインビジュアル・キャッチコピー・CTA・実績数値・メディア掲載
**属性**: `main_catch`, `sub_catch`, `cta_main`, `cta_sub`, `cta_link`, `bg_color`, `post_id`

```
[firstview_01_module main_catch="毎日の業務を<br>もっとスマートに" cta_main="無料デモを試す"]
```

### Hero Module (`[hero_module]`)

**機能**: メインビジュアル・キャッチコピー・CTAボタン
**属性**: `title`, `subtitle`, `cta_text`, `cta_link`, `post_id`

```
[hero_module title="あなたのビジネスを次のレベルへ" cta_text="無料相談申込"]
```

### Problem Module (`[problem_module]`)

**機能**: 顧客の課題・悩みをカード形式で表示
**属性**: `title`, `post_id`

```
[problem_module title="こんな課題はありませんか？"]
```

### Benefit Module (`[benefit_module]`)

**機能**: サービスの利益・効果をアイコン付きで表示
**属性**: `title`, `style`, `post_id`

```
[benefit_module title="導入で得られる効果"]
```

### Pricing Module (`[pricing_module]`)

**機能**: 料金プランの比較表示
**属性**: `title`, `style`, `post_id`

```
[pricing_module title="シンプルな料金体系"]
```

### Contact Module (`[contact_module]`)

**機能**: お問い合わせフォーム
**属性**: `title`, `subtitle`, `email`, `post_id`

```
[contact_module title="お問い合わせ" email="info@example.com"]
```

## 🎛️ 動的ACF表示制御システム（NEW!）

### 概要

使用するモジュールを手動選択することで、必要なACFフィールドのみを表示するシステムです。全モジュールのフィールドが表示されることによる混乱を解消し、効率的なページ編集を実現します。

### 🚀 使用方法

#### ステップ1: モジュール選択
1. **WordPress管理画面** → **ページ編集**
2. **右側サイドバーの「🔧 使用するモジュールを選択」メタボックス**
3. **必要なモジュールにチェックマークを付ける**

#### ステップ2: ACFフィールド編集
1. **ページ下部に選択したモジュールのACFフィールドのみが表示**
2. **不要なフィールドは非表示になるため、迷わず編集可能**
3. **リアルタイムで表示/非表示が切り替わる**

#### ステップ3: ショートコード配置
1. **ページコンテンツに対応するショートコードを追加**
2. **保存・公開**

### 🔧 開発者向け情報

#### 簡単ACF設定（1行記述）

新しいモジュールを作成する際は、ACFのlocation設定で以下の1行のみ記述：

```php
acf_add_local_field_group(array(
    'key' => 'group_your_module',
    'title' => 'Your Module',
    'fields' => array(
        // フィールド定義
    ),
    'location' => get_smart_location(), // この1行のみ！
));
```

#### 従来の複雑な記述は不要

```php
// ❌ 従来の複雑な記述（不要）
'location' => array(
    array(
        array(
            'param' => 'post_type',
            'operator' => '==',
            'value' => 'page',
        ),
        array(
            'param' => 'page_template',
            'operator' => '==',
            'value' => 'template-name.php',
        ),
        // さらに複雑な条件...
    ),
),

// ✅ 新方式（シンプル）
'location' => get_smart_location(), // 1行のみ！
```

### 🎯 システムの利点

- ✅ **直感的操作** - チェックボックスで簡単選択
- ✅ **混乱防止** - 必要なフィールドのみ表示
- ✅ **リアルタイム** - 選択と同時に表示切替
- ✅ **状態保存** - ページ保存時に選択状態を記録
- ✅ **開発効率** - `get_smart_location()` 1行記述

### 🔄 動作フロー

```
ページ編集開始
    ↓
右側メタボックスでモジュール選択
    ↓
選択したモジュールのACFフィールドのみ表示
    ↓
フィールド編集 + ショートコード配置
    ↓
保存・公開
```

## 🔧 管理画面

WordPress管理画面 → **外観** → **モジュール管理** で以下が確認できます:

- 読み込み済みモジュール一覧
- 利用可能なショートコード
- 使用方法ガイド
- 完全ランディングページの例

### 🎛️ ページ編集画面の新機能

**右側サイドバー**:
- **「🔧 使用するモジュールを選択」メタボックス** - 使用するモジュールをチェックボックスで選択

**動作**:
- チェックしたモジュールのACFフィールドのみがページ下部に表示
- リアルタイムで表示/非表示が切り替わる
- 選択状態はページ保存時に自動記録

## 📱 デモページ

`demo_page.php` をテンプレートとして使用可能:

1. WordPress管理画面で新規固定ページ作成
2. ページ属性で「Complete Modules Demo Page」選択
3. 公開してデモを確認

## 🎨 カスタマイズガイド

### テーマカラーの変更

各モジュールのCSSセクションで色を調整:

```css
/* ヒーローモジュールの背景色変更例 */
.hero_xxxxx {
    background: linear-gradient(135deg, #your-color1, #your-color2);
}
```

### 新しいモジュール追加

1. `modules_complete/new_module_complete.php` を作成
2. 既存モジュールを参考に構造を作成
3. `add_shortcode('new_module', 'render_new_module')` でショートコード登録

### ACFフィールドのカスタマイズ

各モジュールファイル内の `acf_add_local_field_group()` 部分を編集:

```php
array(
    'key' => 'field_custom_field',
    'label' => 'カスタムフィールド',
    'name' => 'custom_field',
    'type' => 'text',
    'default_value' => 'デフォルト値',
),
```

## 🚀 パフォーマンス最適化

### 不要なモジュールの無効化

特定のモジュールを読み込まない場合:

```php
// module_loader.php 内で除外
if ($filename === 'unwanted_module_complete.php') {
    continue;
}
```

### CDN対応

Font Awesome など外部リソースをCDNに変更:

```php
wp_enqueue_style(
    'font-awesome',
    'https://your-cdn.com/font-awesome.css'
);
```

## 🔄 移行ガイド

### 既存システムからの移行

1. 既存のモジュール化システムをバックアップ
2. Complete Modules Systemを有効化
3. ショートコードを段階的に置き換え
4. ACFフィールドの内容を移行

### 従来のテンプレートファイルとの併用

```php
// 既存テンプレートと新システムの併用例
if (function_exists('render_hero_module')) {
    echo do_shortcode('[hero_module]');
} else {
    include 'legacy/hero.php';
}
```

## 🛠️ トラブルシューティング

### よくある問題

**Q: ショートコードが表示されない**
A: ACFプラグインが有効か、モジュールローダーが正しく読み込まれているか確認

**Q: カスタムフィールドが表示されない**  
A: ページの権限設定、ACFのロケーション設定を確認

**Q: CSSが適用されない**
A: ブラウザキャッシュをクリア、CSSセレクタの優先度を確認

### デバッグ方法

```php
// 読み込み済みモジュール確認
if (function_exists('get_complete_modules')) {
    var_dump(get_complete_modules());
}

// モジュール利用可能性確認
if (is_complete_module_available('hero_complete')) {
    echo 'Hero module is available';
}
```

## 📈 応用例

### マルチサイト対応

```php
// ネットワーク全体で有効化
add_action('network_admin_menu', array($this, 'add_network_admin_menu'));
```

### 多言語対応

```php
// WPML/Polylang対応
$title = function_exists('pll__') ? pll__($title) : $title;
```

### カスタム投稿タイプ対応

```php
// 特定の投稿タイプでのみ有効化
'location' => array(
    array(
        array(
            'param' => 'post_type',
            'operator' => '==',
            'value' => 'your_custom_post_type',
        ),
    ),
),
```

### レスポンシブ対応

- モバイル（768px以下）では自動的に全幅になります
- パディングは15pxに調整されます

### 🛠️ WordPressのGutenbergレイアウト制約への対応

WordPressのGutenbergエディターやテーマによって以下のクラスが適用され、横幅制限が発生する場合があります：

- `.is-layout-constrained`
- `.has-global-padding`

これらの影響を無効化するため、以下の対策を実装：

#### 1. CSS変数の上書き
```css
--wp--style--global--content-size: 100% !important;
--wp--style--global--wide-size: 100% !important;
--wp--style--root--padding-left: 0 !important;
--wp--style--root--padding-right: 0 !important;
```

#### 2. 特定クラスの強制上書き
```css
.complete-modules-container.full-width .is-layout-constrained {
    max-width: 100% !important;
}
```

#### 3. JavaScript による動的制約解除
ページ読み込み時に自動的にGutenbergの制約を無効化します。

#### トラブルシューティング
もし横幅制限が残る場合：

1. ブラウザの開発者ツールで適用されているCSSを確認
2. 特定のクラスが追加で影響している場合は、以下のCSSを追加：
```css
.your-specific-class {
    max-width: 100% !important;
    padding-left: 0 !important;
    padding-right: 0 !important;
}
```

## 📐 レイアウトオプション（NEW!）

横余白を調整できる5つのレイアウトオプションを提供：

### 使用方法

#### 1. PHP関数を使用する場合

```php
// 全幅レイアウト（横余白なし）
create_simple_landing_page(null, 'full-width');

// 超全幅レイアウト（パディングも含めて完全全幅）
create_simple_landing_page(null, 'no-padding');

// 大幅レイアウト（1400px）
create_simple_landing_page(null, 'wide');

// 中幅レイアウト（1000px）
create_simple_landing_page(null, 'narrow');

// デフォルト（1200px）
create_simple_landing_page(null, 'default');
```

#### 2. HTMLコンテナを使用する場合

```html
<!-- 全幅レイアウト -->
<div class="complete-modules-container full-width">
    [hero_module]
    [problem_module]
    [benefit_module]
</div>

<!-- 超全幅レイアウト -->
<div class="complete-modules-container no-padding">
    [hero_module]
    [problem_module]
</div>

<!-- 大幅レイアウト -->
<div class="complete-modules-container wide">
    [hero_module]
    [problem_module]
</div>
```

### レイアウト種類

| オプション | 説明 | 最大幅 | パディング |
|-----------|------|--------|-----------|
| `default` | 標準レイアウト | 1200px | 20px |
| `full-width` | 画面幅いっぱい | 100% | 20px |
| `no-padding` | 完全全幅 | 100% | 0px |
| `wide` | 大幅レイアウト | 1400px | 20px |
| `narrow` | 中幅レイアウト | 1000px | 20px |

### レスポンシブ対応

- モバイル（768px以下）では自動的に全幅になります
- パディングは15pxに調整されます

### 🛠️ WordPressのGutenbergレイアウト制約への対応

WordPressのGutenbergエディターやテーマによって以下のクラスが適用され、横幅制限が発生する場合があります：

- `.is-layout-constrained`
- `.has-global-padding`

これらの影響を無効化するため、以下の対策を実装：

#### 1. CSS変数の上書き
```css
--wp--style--global--content-size: 100% !important;
--wp--style--global--wide-size: 100% !important;
--wp--style--root--padding-left: 0 !important;
--wp--style--root--padding-right: 0 !important;
```

#### 2. 特定クラスの強制上書き
```css
.complete-modules-container.full-width .is-layout-constrained {
    max-width: 100% !important;
}
```

#### 3. JavaScript による動的制約解除
ページ読み込み時に自動的にGutenbergの制約を無効化します。

#### トラブルシューティング
もし横幅制限が残る場合：

1. ブラウザの開発者ツールで適用されているCSSを確認
2. 特定のクラスが追加で影響している場合は、以下のCSSを追加：
```css
.your-specific-class {
    max-width: 100% !important;
    padding-left: 0 !important;
    padding-right: 0 !important;
}
```

## 📞 サポート

システムに関する質問や改善要望がございましたら、お気軽にお問い合わせください。

## 📝 更新履歴

- **v1.1** - 動的ACF表示制御システム追加
  - 🎛️ **モジュール選択式ACF表示制御** - 使用するモジュールのフィールドのみ表示
  - 🔧 **右側メタボックス** - チェックボックスによる直感的なモジュール選択
  - ⚡ **リアルタイム切替** - 選択と同時にACFフィールドの表示/非表示
  - 📝 **簡単記述方式** - `get_smart_location()` による1行ACF設定
  - 💾 **状態保存** - ページ保存時に選択状態を自動記録
  - 🚀 **使いやすさ向上** - 不要なフィールドの非表示で混乱を解消

- **v1.0** - 初期リリース
  - Hero, Problem, Benefit, Pricing, Contact モジュール
  - 完全独立型設計
  - ショートコードシステム
  - ACF自動登録
  - 管理画面
  - デモページ

---

**Complete Independent Modules System** - WordPress ランディングページ最適化ソリューション 