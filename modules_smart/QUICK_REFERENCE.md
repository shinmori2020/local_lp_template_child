# Smart Modules - クイックリファレンス

## 🚀 AIエージェント向け即席ガイド

### 新規モジュール作成 - 5ステップ

1. **フォルダ作成**
```bash
mkdir modules_smart/modules/{MODULE_NAME}
mkdir modules_smart/modules/{MODULE_NAME}/assets/css
```

2. **PHPファイル作成** - `MODULE_TEMPLATE.php`をコピー・編集

3. **置換作業**
```
[MODULE_NAME] → 実際のモジュール名 (例: benefit)
[MODULE_CLASS_NAME] → クラス名 (例: Benefit)  
[MODULE_DESCRIPTION] → 説明文
```

4. **CSSファイル作成** - `STYLE_TEMPLATE.css`をコピー・編集

5. **システム確認** - 自動検出、ACF自動生成

---

## 📁 重要ファイル

| ファイル | 役割 | 重要度 |
|---------|------|--------|
| `SMART_MODULES_SPECIFICATION.md` | 📚 完全仕様書 | ⭐⭐⭐ |
| `MODULE_TEMPLATE.php` | 🧩 PHPテンプレート | ⭐⭐⭐ |
| `STYLE_TEMPLATE.css` | 🎨 CSSテンプレート | ⭐⭐⭐ |
| `core/SmartModuleLoader.php` | 🔧 システム中核 | ⭐⭐ |
| `core/SmartModuleBase.php` | 🏗️ 基底クラス | ⭐⭐ |

---

## 🔧 システム構造

```
📦 modules_smart/
├── 🎯 smart_modules_loader.php        # エントリーポイント
├── 📁 core/
│   ├── SmartModuleLoader.php          # 遅延読み込み制御
│   ├── SmartModuleBase.php            # 抽象基底クラス  
│   └── ConflictManager.php            # 競合管理
├── 📁 modules/
│   ├── hero/hero_module.php           # ヒーロー
│   └── problem/problem_module.php     # 課題提起
└── 📁 assets/css/common.css           # 共通CSS
```

---

## ⚡ ショートコード

| モジュール | ショートコード | 用途 |
|-----------|---------------|------|
| Hero | `[hero_smart_module]` | ヒーローセクション |
| Problem | `[problem_smart_module]` | 課題提起・問題定義 |

---

## 🛠️ 必須メソッド

```php
class SmartNewModule extends SmartModuleBase {
    protected function get_module_name(): string {
        return 'new_module';  // ✅ 必須
    }
    
    protected function get_defaults(): array {
        return [              // ✅ 必須 - ACF自動生成元
            'title' => 'デフォルトタイトル',
            'color' => '#007cba'
        ];
    }
    
    protected function generate_html(array $data): string {
        // ✅ 必須 - HTML出力
        return '<div>' . esc_html($data['title']) . '</div>';
    }
}
```

---

## 🎨 ACF自動生成ルール

| データ型 | ACFフィールドタイプ | 例 |
|---------|-------------------|---|
| 短文字列 (≤50文字) | `text` | `'title' => 'タイトル'` |
| 長文字列 (>50文字) | `textarea` | `'desc' => '長い説明文...'` |
| 数値 | `number` | `'count' => 5` |
| 真偽値 | `true_false` | `'show' => true` |

---

## 🔍 デバッグ方法

### 管理画面確認
- WordPress管理画面上部の **"Smart Modules Debug Info"**
- ACFプラグイン状態・検出モジュール確認

### フロントエンド確認  
- 画面右下のデバッグ情報（管理者のみ）
- ブラウザコンソールで「AOS初期化完了」

---

## ⚠️ よくあるエラーと解決法

| エラー | 原因 | 解決法 |
|-------|------|--------|
| ACFフィールドが見えない | ACF無効/読み込み順序 | プラグイン確認・デバッグ情報確認 |
| ショートコードが文字列表示 | クラス名/ファイル名不一致 | 命名規則確認 |
| CSSが効かない | ファイルパス間違い | パス確認・ファイル存在確認 |
| AOSが動かない | ライブラリ読み込み失敗 | コンソールエラー確認 |

---

## 📈 パフォーマンス指標

| 項目 | 従来システム | Smart Modules | 改善 |
|------|-------------|---------------|------|
| メモリ使用量 | 3.16MB | 120KB | 97%↓ |
| 初期読み込み | 全モジュール | 使用分のみ | 大幅改善 |
| 重複エラー | 頻発 | なし | 100%解決 |

---

## 🎯 開発時チェックリスト

### 新規モジュール作成時
- [ ] フォルダ構造正しい
- [ ] クラス名・ファイル名一致
- [ ] `get_defaults()`でフィールド定義
- [ ] `generate_html()`でHTML実装
- [ ] CSS ファイル作成
- [ ] レスポンシブ対応
- [ ] セキュリティ対策（`esc_html`等）

### テスト項目
- [ ] ショートコード動作
- [ ] ACFフィールド表示
- [ ] デフォルト値表示
- [ ] ACF値上書き動作
- [ ] CSSスタイル適用
- [ ] AOSアニメーション
- [ ] レスポンシブ表示

---

## 🚨 緊急時対応

### システム停止時
1. `functions.php`のSmart Modules読み込み部分をコメントアウト
2. 既存の`modules_complete`システムのコメントアウトを解除

### 競合発生時
1. `ConflictManager.php`の競合検出機能確認
2. 必要に応じて一時的な無効化

---

## 📞 サポート情報

- **メインドキュメント**: `SMART_MODULES_SPECIFICATION.md`
- **テンプレート**: `MODULE_TEMPLATE.php` + `STYLE_TEMPLATE.css`
- **デバッグ**: 管理画面通知 + ブラウザコンソール
- **ログ**: WordPressエラーログ

---

*🤖 このクイックリファレンスでAIエージェントは即座にSmart Modulesシステムを理解し、新規モジュール開発を開始できます。*