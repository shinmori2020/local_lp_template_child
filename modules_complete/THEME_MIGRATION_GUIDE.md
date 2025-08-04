# 🚀 テーマ移植ガイド（簡潔版）

**最低限のファイルで他テーマにモジュールを移植する方法**

---

## 📦 **最低限必要なファイル（2個だけ）**

```
✅ modules_complete/module_loader.php     ← システムコア（必須）
✅ 使いたいモジュール_complete.php        ← 個別モジュール
```

---

## 🎯 **3ステップ移植手順**

### **Step 1: ファイルをコピー**
```bash
# 新しいテーマに移植
新テーマ/modules_complete/module_loader.php          ← コピー
新テーマ/modules_complete/hero_complete.php          ← 使いたいモジュール
```

### **Step 2: functions.phpに追加**
```php
// 新テーマの functions.php の最後に追加
if (file_exists(get_stylesheet_directory() . '/modules_complete/module_loader.php')) {
    require_once get_stylesheet_directory() . '/modules_complete/module_loader.php';
}
```

### **Step 3: 動作確認**
```
1. WordPressサイトをリロード
2. 管理画面 → 固定ページ → 編集
3. ACFフィールドが表示されればOK
4. ショートコード [hero_module] をテスト
```

---

## 📂 **ファイル構造例**

### **移植前（元テーマ）**
```
元テーマ/
└── modules_complete/
    ├── module_loader.php        ← これをコピー
    ├── hero_complete.php        ← これをコピー  
    ├── pricing_complete.php     ← 必要に応じて
    └── contact_complete.php     ← 必要に応じて
```

### **移植後（新テーマ）**
```
新テーマ/
├── functions.php               ← 読み込みコード追加
└── modules_complete/
    ├── module_loader.php       ← コピー済み
    └── hero_complete.php       ← コピー済み
```

---

## ✅ **移植後チェックリスト**

```
□ サイトが正常に表示される
□ PHPエラーが出ていない
□ 管理画面でACFフィールドが表示される
□ ショートコードが動作する
```

---

## 🔧 **トラブル対処法**

### **問題1: ACFフィールドが表示されない**
```
原因: ACFプラグインが無効
解決: ACFプラグインを有効化
```

### **問題2: PHPエラーが出る**
```
原因: functions.php の記述ミス
解決: コードを再確認（セミコロン、括弧など）
```

### **問題3: ショートコードが効かない**
```
原因: module_loader.php がない
解決: ファイルパスを確認
```

---

## 📋 **よく使うファイル一覧**

| ファイル名 | 用途 | 重要度 |
|-----------|------|--------|
| `module_loader.php` | システムコア | ★★★ 必須 |
| `hero_complete.php` | ヒーローセクション | ★★☆ |
| `pricing_complete.php` | 料金表 | ★★☆ |
| `contact_complete.php` | お問い合わせ | ★★☆ |
| `problem_complete.php` | 問題提起 | ★☆☆ |
| `benefit_complete.php` | メリット紹介 | ★☆☆ |

---

## 🎁 **管理画面付き構成（推奨）**

管理画面でモジュールを切り替えたい場合：

### **追加ファイル**
```
✅ modules_complete/module_selector_admin.php  ← 管理画面
```

### **functions.phpに追加**
```php
// module_loader.php の後に追加
if (file_exists(get_stylesheet_directory() . '/modules_complete/module_selector_admin.php')) {
    require_once get_stylesheet_directory() . '/modules_complete/module_selector_admin.php';
}
```

### **アクセス方法**
```
WordPress管理画面 → 外観 → モジュール管理
```

---

## 💡 **移植のコツ**

### **✅ DO（推奨）**
- 小さく始める（1-2個のモジュールから）
- テスト環境で先に確認
- バックアップを取ってから実行

### **❌ DON'T（避ける）**
- 一度に全モジュールを移植
- 本番環境でいきなり作業
- ファイル名を勝手に変更

---

## 🚨 **緊急時の対処**

### **サイトが表示されなくなった場合**
```php
// functions.php の追加コードをコメントアウト
/*
if (file_exists(get_stylesheet_directory() . '/modules_complete/module_loader.php')) {
    require_once get_stylesheet_directory() . '/modules_complete/module_loader.php';
}
*/
```

### **元に戻す手順**
```
1. 追加したコードを削除
2. modules_complete フォルダを削除
3. サイトが正常に戻ることを確認
```

---

## 📞 **サポート情報**

### **必要な環境**
- WordPress 5.0+
- ACF プラグイン
- PHP 7.4+

### **確認コマンド**
```php
// PHPエラーを確認
ini_set('display_errors', 1);
error_reporting(E_ALL);
```

---

**🎯 このガイドで、最小限のファイルで確実に移植できます！** 