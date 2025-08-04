# 📚 完全独立型モジュールシステム 操作マニュアル

**最終更新日**: 2024年12月

---

## 📑 目次

1. [ファイル移動・名前変更の安全性](#1-ファイル移動名前変更の安全性)
2. [カテゴリ別モジュール整理](#2-カテゴリ別モジュール整理)
3. [他テーマへの移植手順](#3-他テーマへの移植手順)
4. [モジュール管理システム](#4-モジュール管理システム)
5. [トラブルシューティング](#5-トラブルシューティング)

---

## 1. ファイル移動・名前変更の安全性

### 🟢 **安全な操作**（エラーなし）

#### ✅ ファイル名変更（`modules_complete/`内）
```bash
# 例: お客様の声モジュールの名前変更
testimonial_complete.php → customer_voice_complete.php
```
**条件**: `_complete.php` で終わる限り自動検出される

#### ✅ サブフォルダーでの整理
```
modules_complete/
├── hero/
│   ├── hero_style1_complete.php
│   └── hero_style2_complete.php
└── content/
    ├── problem_basic_complete.php
    └── benefit_cards_complete.php
```
**結果**: サブフォルダー内でも自動検出される

#### ✅ ファイル内容の編集
```php
// CSS、HTML、ACFフィールドの変更
// ショートコード名の変更
```
**結果**: リアルタイムで反映

### 🟡 **注意が必要な操作**

#### ⚠️ 他フォルダーへの移動
```bash
# modules_complete外への移動
modules_complete/hero_complete.php → custom_modules/hero_complete.php
```
**結果**: 自動読み込みされなくなる  
**対処**: 手動で`require_once`が必要

#### ⚠️ ファイル名の根本変更
```php
// ACFキーとショートコード名も同時変更が必要
'key' => 'group_hero_complete'        → 'group_landing_complete'
add_shortcode('hero_module', ...)     → add_shortcode('landing_module', ...)
```

### 🔴 **避けるべき操作**（エラーの原因）

#### ❌ 拡張子の変更
```bash
hero_complete.php → hero_complete.inc  # 検出されない
```

#### ❌ キーやショートコード名の重複
```php
// 複数ファイルで同じ名前を使用
'key' => 'group_hero_complete'  # 重複エラー
add_shortcode('hero_module', ...)   # 衝突エラー
```

---

## 2. カテゴリ別モジュール整理

### 📂 **推奨フォルダー構造**

```
modules_complete/
├── module_loader.php                 ← システムコア
├── module_selector_admin.php         ← 管理画面
├── AI_AGENT_GUIDE.md                ← 開発ガイド
├── OPERATION_MANUAL.md              ← このマニュアル
│
├── hero/                            ← ヒーローセクション
│   ├── hero_style1_complete.php         ・シンプル
│   ├── hero_style2_complete.php         ・動画背景
│   ├── hero_video_complete.php          ・フルスクリーン動画
│   └── hero_minimal_complete.php        ・ミニマル
│
├── content/                         ← コンテンツセクション
│   ├── problem_basic_complete.php       ・基本的な問題提起
│   ├── problem_advanced_complete.php    ・詳細な問題分析
│   ├── benefit_cards_complete.php       ・カード形式のメリット
│   ├── benefit_timeline_complete.php    ・タイムライン形式
│   └── features_grid_complete.php       ・機能一覧グリッド
│
├── social_proof/                    ← 社会的証明
│   ├── testimonial_cards_complete.php   ・お客様の声（カード）
│   ├── testimonial_slider_complete.php  ・お客様の声（スライダー）
│   ├── trust_logos_complete.php         ・信頼できる企業ロゴ
│   └── reviews_complete.php             ・レビュー表示
│
├── conversion/                      ← コンバージョン
│   ├── pricing_table_complete.php       ・料金表（テーブル）
│   ├── pricing_toggle_complete.php      ・料金表（切り替え）
│   ├── contact_form1_complete.php       ・お問い合わせフォーム1
│   ├── contact_form2_complete.php       ・お問い合わせフォーム2
│   └── cta_buttons_complete.php         ・CTA ボタン集
│
├── navigation/                      ← ナビゲーション
│   ├── header_nav_complete.php          ・ヘッダーナビ
│   ├── footer_complete.php              ・フッター
│   └── breadcrumb_complete.php          ・パンくずリスト
│
└── utility/                        ← ユーティリティ
    ├── qa_accordion_complete.php        ・FAQ（アコーディオン）
    ├── progress_bar_complete.php        ・プログレスバー
    ├── counter_complete.php             ・カウンター
    └── modal_popup_complete.php         ・モーダルポップアップ
```

### 🎨 **命名規則**

#### **ファイル名の構成**
```
[カテゴリ]_[用途]_[スタイル]_complete.php

例:
hero_video_fullscreen_complete.php    ← ヒーロー_動画_フルスクリーン
pricing_table_modern_complete.php     ← 料金_テーブル_モダン
testimonial_slider_minimal_complete.php ← お客様の声_スライダー_ミニマル
```

#### **ACFキーの構成**
```php
'key' => 'group_[カテゴリ]_[用途]_[スタイル]_complete'

例:
'key' => 'group_hero_video_fullscreen_complete'
'key' => 'group_pricing_table_modern_complete'
```

#### **ショートコード名の構成**
```php
add_shortcode('[カテゴリ]_[用途]_[スタイル]_module', ...)

例:
[hero_video_fullscreen_module]
[pricing_table_modern_module]
```

---

## 3. 他テーマへの移植手順

### 📦 **最小移植パッケージ**（2ファイルのみ）

#### **必須ファイル**
```
modules_complete/module_loader.php    ← システムコア（7KB）
使いたいモジュール_complete.php      ← 個別モジュール
```

#### **移植手順**
```bash
# Step 1: ディレクトリ作成
新テーマ/modules_complete/

# Step 2: コアファイルをコピー
cp module_loader.php → 新テーマ/modules_complete/

# Step 3: functions.phpに3行追加
if (file_exists(get_stylesheet_directory() . '/modules_complete/module_loader.php')) {
    require_once get_stylesheet_directory() . '/modules_complete/module_loader.php';
}

# Step 4: 使いたいモジュールをコピー
cp hero_style1_complete.php → 新テーマ/modules_complete/hero/
```

### 🎁 **推奨移植パッケージ**（管理機能付き）

#### **推奨ファイル**
```
modules_complete/
├── module_loader.php                 ← システムコア
├── module_selector_admin.php         ← 管理画面
├── AI_AGENT_GUIDE.md                ← 開発ガイド
├── OPERATION_MANUAL.md              ← このマニュアル
└── 必要なモジュールファイル           ← 選択してコピー
```

#### **管理画面の追加**
```php
// functions.phpに追加（module_loader.phpの後）
if (file_exists(get_stylesheet_directory() . '/modules_complete/module_selector_admin.php')) {
    require_once get_stylesheet_directory() . '/modules_complete/module_selector_admin.php';
}
```

### 🔍 **移植後の確認**

#### **チェックリスト**
- [ ] WordPressサイトが正常に表示される
- [ ] 管理画面 → 外観 → モジュール管理 が表示される
- [ ] 固定ページでACFフィールドが表示される
- [ ] ショートコードが正常に動作する
- [ ] エラーログにPHPエラーが出ていない

#### **確認コマンド**
```bash
# エラーログ確認（Linux/Mac）
tail -f /var/log/apache2/error.log

# エラーログ確認（Windows XAMPP）
tail -f C:\xampp\apache\logs\error.log
```

---

## 4. モジュール管理システム

### 🎮 **管理画面の使い方**

#### **アクセス方法**
```
WordPress管理画面 → 外観 → モジュール管理
```

#### **主な機能**
- ✅ **カテゴリ別表示**: モジュールをカテゴリ分けして表示
- ✅ **ワンクリック切り替え**: チェックボックスで有効/無効
- ✅ **リアルタイム更新**: AJAX で即座に反映
- ✅ **統計表示**: アクティブ数/全体数を表示
- ✅ **視覚的ステータス**: 色分けで状態を確認

#### **操作方法**
```
1. カテゴリからモジュールを探す
2. 使いたいモジュールにチェックを入れる
3. 自動で有効/無効が切り替わる
4. 固定ページでショートコードが利用可能になる
```

### 📊 **統計とモニタリング**

#### **表示される情報**
```
各カテゴリ: (アクティブ数/総数)
例: Hero (2/4 アクティブ)
```

#### **色分け**
- 🟢 **緑**: アクティブなモジュール
- 🔴 **赤**: 無効なモジュール

---

## 5. トラブルシューティング

### 🚨 **よくある問題と解決法**

#### **問題1: モジュールが管理画面に表示されない**
```
原因: ファイル名が _complete.php で終わっていない
解決: ファイル名を [name]_complete.php に変更
```

#### **問題2: ACFフィールドが表示されない**
```
原因: add_action('acf/init', function() { が残っている
解決: if (function_exists('acf_add_local_field_group')) { に変更
```

#### **問題3: ショートコードが動作しない**
```
原因1: モジュールが無効になっている
解決: 管理画面でモジュールを有効化

原因2: ショートコード名が間違っている
解決: [モジュール名_module] の形式で記述
```

#### **問題4: Parse Error が発生**
```
原因: 括弧の対応が正しくない
解決: エディタの括弧マッチング機能で確認
対策: 変更前にバックアップを取る
```

#### **問題5: CSSが適用されない**
```
原因: ユニークIDが正しく生成されていない
解決: $unique_id の使用方法を確認
確認: ブラウザの開発者ツールでCSSセレクタをチェック
```

### 🔧 **デバッグ方法**

#### **エラー確認**
```php
// WordPress のデバッグモードを有効化
define('WP_DEBUG', true);
define('WP_DEBUG_LOG', true);
define('WP_DEBUG_DISPLAY', false);
```

#### **モジュール読み込み確認**
```php
// functions.phpに追加して確認
add_action('wp_footer', function() {
    if (current_user_can('administrator')) {
        $loaded_modules = complete_get_loaded_modules();
        echo '<script>console.log("Loaded modules:", ' . json_encode($loaded_modules) . ');</script>';
    }
});
```

### 📞 **サポート情報**

#### **必要な前提条件**
- WordPress 5.0+
- ACF Pro（または無料版）
- PHP 7.4+
- モダンブラウザ（IE11+）

#### **互換性**
- ✅ WordPress 5.0～6.4+
- ✅ PHP 7.4～8.2
- ✅ 主要テーマ（Genesis, Astra, OceanWP等）
- ✅ Page Builder（Elementor, Gutenberg等）

---

## 📋 **チェックシート**

### **新モジュール作成時**
- [ ] ファイル名が `_complete.php` で終わっている
- [ ] ACFキーがユニーク
- [ ] ショートコード名がユニーク
- [ ] デフォルト値が設定されている
- [ ] レスポンシブ対応済み
- [ ] セキュリティ対策済み（エスケープ処理）

### **移植時**
- [ ] module_loader.php をコピー済み
- [ ] functions.php に読み込みコード追加済み
- [ ] 必要なモジュールをコピー済み
- [ ] 管理画面でモジュールが表示される
- [ ] ショートコードが動作する
- [ ] エラーログにエラーが出ていない

### **運用時**
- [ ] 定期的なバックアップ
- [ ] テスト環境での事前確認
- [ ] モジュールの有効/無効管理
- [ ] パフォーマンス監視
- [ ] セキュリティアップデート

---

**📝 このマニュアルを参照することで、安全で効率的なモジュール管理が可能です。**

**🔄 定期的にこのマニュアルを更新し、最新の情報を保持してください。** 