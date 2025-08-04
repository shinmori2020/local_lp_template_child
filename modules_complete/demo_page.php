<?php
/**
 * Template Name: Complete Modules Demo Page
 * 
 * 完全独立型モジュールシステムのデモページ
 * 
 * 使用方法:
 * 1. このファイルをテーマディレクトリに配置
 * 2. WordPress管理画面で新規固定ページを作成
 * 3. ページ属性で「Complete Modules Demo Page」を選択
 * 4. 公開して確認
 */

get_header(); ?>

<style>
/* デモページ専用スタイル */
.demo-notice {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: white;
    padding: 20px;
    text-align: center;
    margin-bottom: 0;
}

.demo-notice h1 {
    margin: 0 0 10px 0;
    font-size: 2rem;
}

.demo-notice p {
    margin: 0;
    opacity: 0.9;
}

.demo-navigation {
    position: fixed;
    top: 50%;
    right: 20px;
    transform: translateY(-50%);
    z-index: 1000;
    background: rgba(255, 255, 255, 0.9);
    border-radius: 10px;
    padding: 15px;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
    backdrop-filter: blur(10px);
}

.demo-navigation h4 {
    margin: 0 0 15px 0;
    font-size: 0.9rem;
    color: #2c3e50;
    text-align: center;
}

.demo-navigation ul {
    list-style: none;
    margin: 0;
    padding: 0;
}

.demo-navigation li {
    margin: 8px 0;
}

.demo-navigation a {
    display: block;
    padding: 8px 12px;
    color: #495057;
    text-decoration: none;
    border-radius: 5px;
    font-size: 0.85rem;
    transition: all 0.3s ease;
}

.demo-navigation a:hover {
    background: #007bff;
    color: white;
    transform: translateX(-3px);
}

@media (max-width: 768px) {
    .demo-navigation {
        display: none;
    }
}

.demo-section-info {
    position: relative;
    background: rgba(0, 123, 255, 0.1);
    border-left: 4px solid #007bff;
    padding: 15px 20px;
    margin: 20px auto;
    max-width: 1200px;
    border-radius: 0 8px 8px 0;
}

.demo-section-info h3 {
    margin: 0 0 10px 0;
    color: #007bff;
    font-size: 1.1rem;
}

.demo-section-info p {
    margin: 5px 0;
    color: #495057;
    font-size: 0.9rem;
}

.demo-section-info .shortcode {
    background: #f8f9fa;
    padding: 8px 12px;
    border-radius: 4px;
    font-family: monospace;
    font-size: 0.85rem;
    border: 1px solid #dee2e6;
    display: inline-block;
    margin-top: 10px;
}
</style>

<!-- デモページ通知 -->
<div class="demo-notice">
    <h2>Complete Modules System - デモページ</h2>
    <p>各モジュールがCSS、JavaScript、ACFをすべて内包した完全独立型設計のデモンストレーションページです。</p>
    <div class="demo-layout-options">
        <h3>レイアウトオプション</h3>
        <ul>
            <li><strong>デフォルト</strong>: 標準レイアウト（max-width: 1200px）</li>
            <li><strong>全幅</strong>: 画面幅いっぱい（横余白なし）</li>
            <li><strong>超全幅</strong>: パディングも含めて完全全幅</li>
            <li><strong>大幅</strong>: 1400px幅</li>
            <li><strong>中幅</strong>: 1000px幅</li>
        </ul>
        <p>PHP関数使用例: <code>create_simple_landing_page(null, 'full-width');</code></p>
        <p>全体コンテナ使用例: <code>&lt;div class="complete-modules-container full-width"&gt;</code></p>
    </div>
</div>

<!-- ナビゲーション -->
<nav class="demo-navigation">
    <h4>Quick Jump</h4>
    <ul>
        <li><a href="#hero-module">Hero</a></li>
        <li><a href="#problem-module">Problem</a></li>
        <li><a href="#benefit-module">Benefit</a></li>
        <li><a href="#pricing-module">Pricing</a></li>
        <li><a href="#contact-module">Contact</a></li>
    </ul>
</nav>

<main class="complete-modules-container">
    
    <!-- ヒーローモジュール -->
    <div class="demo-section-info">
        <h3>Hero Module - ヒーローセクション</h3>
        <p>メインビジュアルとキャッチコピーを表示するセクションです。ACFでタイトル、サブタイトル、CTAボタンが編集可能。</p>
        <div class="shortcode">[hero_module title="カスタムタイトル" cta_text="今すぐ始める"]</div>
    </div>
    
    <?php echo do_shortcode('[hero_module title="Complete Modules Demo<br>完全独立型モジュール" subtitle="各モジュールがCSS、JavaScript、ACFをすべて内包した完全独立型設計。ショートコード1つで簡単に呼び出せます。" cta_text="デモを見る" cta_link="#problem-module"]'); ?>
    
    <!-- 課題モジュール -->
    <div class="demo-section-info">
        <h3>Problem Module - 課題セクション</h3>
        <p>顧客の課題や悩みを表示するセクションです。カード形式で複数の課題を並べて表示できます。</p>
        <div class="shortcode">[problem_module title="こんな課題はありませんか？"]</div>
    </div>
    
    <?php echo do_shortcode('[problem_module title="従来のモジュール化の課題"]'); ?>
    
    <!-- ベネフィットモジュール -->
    <div class="demo-section-info">
        <h3>Benefit Module - ベネフィットセクション</h3>
        <p>サービス・商品の利益や効果を表示するセクションです。アイコン付きで視覚的に訴求できます。</p>
        <div class="shortcode">[benefit_module title="導入で得られるメリット"]</div>
    </div>
    
    <?php echo do_shortcode('[benefit_module title="Complete Modules の特徴"]'); ?>
    
    <!-- 料金モジュール -->
    <div class="demo-section-info">
        <h3>Pricing Module - 料金セクション</h3>
        <p>料金プランを表示するセクションです。複数プランの比較表示、おすすめプランの強調表示が可能。</p>
        <div class="shortcode">[pricing_module title="料金プラン"]</div>
    </div>
    
    <?php echo do_shortcode('[pricing_module title="シンプルな料金体系"]'); ?>
    
    <!-- お問い合わせモジュール -->
    <div class="demo-section-info">
        <h3>Contact Module - お問い合わせセクション</h3>
        <p>お問い合わせフォームを表示するセクションです。レスポンシブ対応、バリデーション機能付き。</p>
        <div class="shortcode">[contact_module title="お問い合わせ" email="info@example.com"]</div>
    </div>
    
    <?php echo do_shortcode('[contact_module title="デモのお問い合わせ" subtitle="Complete Modules システムについてご質問がございましたら、お気軽にお問い合わせください。" email="demo@example.com"]'); ?>
    
</main>

<!-- デモページ用JavaScript -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    console.log('Complete Modules Demo Page Loaded');
    
    // スムーズスクロールの強化
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function (e) {
            e.preventDefault();
            const target = document.querySelector(this.getAttribute('href'));
            if (target) {
                const offset = 80; // ヘッダーの高さ分オフセット
                const targetPosition = target.offsetTop - offset;
                
                window.scrollTo({
                    top: targetPosition,
                    behavior: 'smooth'
                });
            }
        });
    });
    
    // セクション表示のアニメーション
    const observerOptions = {
        threshold: 0.1,
        rootMargin: '0px 0px -10% 0px'
    };
    
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.style.opacity = '1';
                entry.target.style.transform = 'translateY(0)';
            }
        });
    }, observerOptions);
    
    // すべてのモジュールを監視対象に追加
    document.querySelectorAll('[id$="-module"]').forEach(section => {
        section.style.opacity = '0.3';
        section.style.transform = 'translateY(20px)';
        section.style.transition = 'all 0.6s ease-out';
        observer.observe(section);
    });
    
    // Google Analytics トラッキング（デモ用）
    if (typeof gtag !== 'undefined') {
        gtag('event', 'demo_page_view', {
            'event_category': 'demo',
            'event_label': 'complete_modules_demo',
            'value': 1
        });
    }
});
</script>

<?php get_footer(); ?>

<?php
/**
 * 使用方法ガイド:
 * 
 * 1. このファイルを使用するには:
 *    - ファイルをテーマのルートディレクトリに配置
 *    - WordPress管理画面で新規固定ページ作成
 *    - 「ページ属性」で「Complete Modules Demo Page」を選択
 * 
 * 2. モジュールのカスタマイズ:
 *    - ACFのカスタムフィールドで各モジュールの内容を編集
 *    - ショートコードの属性でリアルタイム調整も可能
 * 
 * 3. 本番サイトでの使用:
 *    - demo-notice、demo-navigation、demo-section-info を削除
 *    - 必要なモジュールのショートコードのみを残す
 * 
 * 4. パフォーマンス最適化:
 *    - 不要なモジュールは読み込まない
 *    - 画像の最適化
 *    - CDNの利用を検討
 */
?> 