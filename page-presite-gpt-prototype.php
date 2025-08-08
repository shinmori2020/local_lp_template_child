<?php
/**
 * Template Name: プレサイト（GPT試作）テンプレート
 * Description: レイアウト再現のためのプレサイト用カスタムテンプレート（CSS/JS同梱・バニラJS）
 * Template Post Type: page
 */

if (!defined('ABSPATH')) {
    exit;
}
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
  <meta charset="<?php bloginfo('charset'); ?>" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title><?php bloginfo('name'); ?></title>
  <?php wp_head(); ?>
  <style>
  :root {
    --container: 1200px;
    --gutter: 24px;
    --gap: 16px;
    --bg-muted: #f6f6f6;
  }
  .presite-body { background:#fff; }
  .skip-link { position:absolute; left:-9999px; top:auto; width:1px; height:1px; overflow:hidden; }
  .skip-link:focus { position: fixed; left: 16px; top: 16px; width:auto; height:auto; padding:10px 14px; background:#000; color:#fff; border-radius:8px; z-index:1000; }
  .presite {
    font-family: system-ui, -apple-system, Segoe UI, Roboto, "Helvetica Neue", Arial, "Noto Sans JP", "Hiragino Kaku Gothic ProN", "Yu Gothic", Meiryo, sans-serif;
    line-height: 1.6;
  }
  .presite .container { max-width: var(--container); margin: 0 auto; padding: 0 var(--gutter); }
  .presite section { padding: 56px 0; }
  .presite h2 { font-size: 28px; margin: 0 0 24px; }
  .presite .muted { background: var(--bg-muted); }

  /* Header */
  .ps-header { position: sticky; top: 0; background: transparent; z-index: 100; padding: 8px 0; }
  .ps-header__surface { max-width: var(--container); margin: 0 auto; padding: 0 var(--gutter); }
  .ps-header__bar { display: flex; align-items: center; justify-content: space-between; min-height: 64px; background:#fff; border: 1px solid #eaeaea; border-radius: 12px; padding-inline: 12px; box-shadow: 0 4px 20px rgba(0,0,0,.04); }
  .ps-brand { display: inline-flex; align-items: center; gap: 12px; font-weight: 800; color: #0d3a2b; text-decoration: none; }
  .ps-brand__logo { width: 28px; height: 28px; background: #0d3a2b; border-radius: 6px; }
  .ps-nav { display: flex; align-items: center; gap: 20px; }
  .ps-nav a { color: #222; text-decoration: none; font-weight: 600; }
  .ps-header__actions { display: flex; align-items: center; gap: 8px; }
  .ps-burger { display: none; width: 44px; height: 44px; border: 1px solid #e0e0e0; border-radius: 8px; background: #fff; cursor: pointer; }

  /* Hero */
  .ps-hero { position: relative; padding: 72px 0; background: linear-gradient(180deg, #0d3a2b 0%, #0b2f24 100%); color: #fff; overflow: hidden; }
  .ps-hero__inner { display: grid; grid-template-columns: 1.2fr 1fr; gap: 32px; align-items: center; }
  .ps-hero__title { font-size: 40px; line-height: 1.2; }
  .ps-hero__cta { margin-top: 20px; display: flex; gap: 12px; flex-wrap: wrap; }
  .ps-btn { appearance: none; border: 0; padding: 12px 18px; border-radius: 999px; background: #fff; color: #0d3a2b; font-weight: 700; cursor: pointer; }
  .ps-btn--ghost { background: transparent; color: #fff; outline: 2px solid #fff; }

  /* News */
  .ps-news__list { display: grid; gap: 12px; }
  .ps-news__item { display: grid; grid-template-columns: 120px 1fr; gap: 12px; padding: 12px 0; border-bottom: 1px solid #e5e5e5; }
  .ps-news__date { color: #666; }

  /* Carousel (Purchases) */
  .ps-carousel { position: relative; }
  .ps-carousel__track { display: grid; grid-auto-flow: column; grid-auto-columns: calc((100% - (var(--gap) * 3)) / 4); gap: var(--gap); overflow: hidden; scroll-behavior: smooth; scroll-snap-type: x mandatory; }
  .ps-card { background: #fff; border: 1px solid #eee; border-radius: 12px; padding: 12px; display: grid; gap: 8px; scroll-snap-align: start; }
  .ps-carousel__nav { position: absolute; inset: 0; pointer-events: none; }
  .ps-carousel__buttons { position: absolute; top: 50%; left: 0; right: 0; display: flex; justify-content: space-between; transform: translateY(-50%); padding: 0 8px; }
  .ps-iconbtn { pointer-events: auto; width: 40px; height: 40px; border-radius: 50%; border: 0; background: rgba(0,0,0,.6); color: #fff; cursor: pointer; }

  /* Reason (3 col) */
  .ps-grid-3 { display: grid; grid-template-columns: repeat(3, 1fr); gap: 24px; }
  .ps-feature { background: #fff; border: 1px solid #eee; border-radius: 12px; padding: 20px; }

  /* Catalog */
  .ps-catalog { position: relative; background: radial-gradient(1200px 600px at 50% 30%, #235740 0, #0b2f24 60%, #0a281e 100%); color: #fff; }
  .ps-catalog__panel { background: #fff; color: #222; border-radius: 16px; padding: 20px; width: min(420px, 100%); }
  .ps-catalog__list { margin-top: 16px; display: grid; grid-template-columns: repeat(2, 1fr); gap: 12px; }

  /* Category */
  .ps-grid-6 { display: grid; grid-template-columns: repeat(6, 1fr); gap: 16px; }
  .ps-cat { background: #fff; border: 1px solid #eee; border-radius: 12px; padding: 16px; text-align: center; }

  /* FAQ */
  .ps-accordion { display: grid; gap: 8px; }
  .ps-accordion__item { background: #fff; border-radius: 12px; border: 1px solid #eee; overflow: hidden; }
  .ps-accordion__head { width: 100%; text-align: left; font-weight: 700; padding: 14px 16px; background: #f9f9f9; border: 0; cursor: pointer; }
  .ps-accordion__panel { display: grid; grid-template-rows: 0fr; transition: grid-template-rows .25s ease; }
  .ps-accordion__panel[aria-hidden="false"] { grid-template-rows: 1fr; }
  .ps-accordion__panel-inner { overflow: hidden; padding: 0; }
  .ps-accordion__panel[aria-hidden="false"] .ps-accordion__panel-inner { padding: 0 16px 16px; }

  /* CTA */
  .ps-cta { background: #f1c40f; }
  .ps-cta__box { display: grid; gap: 12px; align-items: center; grid-template-columns: 1fr auto; }
  
  /* Footer */
  .ps-footer { background: #111; color: #ddd; }
  .ps-footer a { color: inherit; text-decoration: none; }
  .ps-footer .container { max-width: var(--container); margin: 0 auto; padding: 0 var(--gutter); }
  .ps-footer__surface { background: transparent; border: none; border-radius: 0; padding: 32px 0; }
  .ps-footer__grid { display: grid; grid-template-columns: 2fr 1fr 1fr 1fr; gap: 24px; }
  .ps-footer__bottom { border-top: 1px solid #222; padding-top: 12px; margin-top: 24px; display: flex; align-items: center; justify-content: space-between; }

  /* Responsive */
  @media (max-width: 1024px) {
    .ps-burger { display: inline-block; }
    .ps-nav { position: fixed; inset: 64px 0 auto 0; background:#fff; border-top:1px solid #eee; display: grid; gap: 0; padding: 8px 16px; transform: translateY(-8px); opacity: 0; pointer-events: none; transition: opacity .2s ease; }
    .ps-header[data-open="true"] .ps-nav { opacity: 1; pointer-events: auto; }
    .ps-hero__inner { grid-template-columns: 1fr; }
    .ps-carousel__track { grid-auto-columns: calc((100% - (var(--gap) * 2)) / 3); }
    .ps-grid-6 { grid-template-columns: repeat(4, 1fr); }
    .ps-footer__grid { grid-template-columns: 1fr 1fr; }
  }
  @media (max-width: 768px) {
    .presite section { padding: 40px 0; }
    .ps-hero { padding: 56px 0; }
    .ps-hero__title { font-size: 30px; }
    .ps-carousel__track { grid-auto-columns: calc((100% - var(--gap)) / 2); }
    .ps-grid-3 { grid-template-columns: 1fr; }
    .ps-grid-6 { grid-template-columns: repeat(3, 1fr); }
    .ps-cta__box { grid-template-columns: 1fr; }
    .ps-footer__grid { grid-template-columns: 1fr; }
  }
</style>
</head>
<body <?php body_class('presite-body'); ?>>
<a class="skip-link" href="#main">本文へスキップ</a>
<header class="ps-header" data-open="false" role="banner">
  <div class="ps-header__surface">
    <div class="ps-header__bar">
      <a class="ps-brand" href="<?php echo esc_url( home_url('/') ); ?>">
        <span class="ps-brand__logo" aria-hidden="true"></span>
        <span><?php bloginfo('name'); ?></span>
      </a>
      <nav id="global-nav" class="ps-nav" aria-label="メインナビゲーション">
        <a href="#ps-news">News</a>
        <a href="#ps-purchases">Purchases</a>
        <a href="#ps-reason">Reason</a>
        <a href="#ps-catalog">Catalog</a>
        <a href="#ps-category">Category</a>
        <a href="#ps-faq">FAQ</a>
      </nav>
      <div class="ps-header__actions">
        <button class="ps-btn" type="button" onclick="document.querySelector('#ps-cta')?.scrollIntoView({behavior:'smooth'});">無料査定</button>
        <button class="ps-burger" type="button" aria-label="メニュー" aria-expanded="false" aria-controls="global-nav">≡</button>
      </div>
    </div>
  </div>
</header>

<main id="main" class="presite">
  <!-- Hero -->
  <section class="ps-hero" aria-label="Hero">
    <div class="container">
      <div class="ps-hero__inner">
        <div>
          <h1 class="ps-hero__title">キービジュアル見出しが入ります</h1>
          <p>説明テキストが2〜3行入ります。レイアウト検証用のダミーテキストです。</p>
          <div class="ps-hero__cta">
            <button class="ps-btn">無料査定をはじめる</button>
            <button class="ps-btn ps-btn--ghost">詳しく見る</button>
          </div>
        </div>
        <div aria-hidden="true" style="min-height:220px;background:rgba(255,255,255,.1);border-radius:16px"></div>
      </div>
    </div>
  </section>

  <!-- News -->
  <section class="muted" aria-labelledby="ps-news">
    <div class="container">
      <h2 id="ps-news">News</h2>
      <div class="ps-news__list">
        <div class="ps-news__item"><span class="ps-news__date">2025-01-01</span><span>お知らせダミー1</span></div>
        <div class="ps-news__item"><span class="ps-news__date">2025-01-02</span><span>お知らせダミー2</span></div>
        <div class="ps-news__item"><span class="ps-news__date">2025-01-03</span><span>お知らせダミー3</span></div>
      </div>
    </div>
  </section>

  <!-- Purchases (Carousel) -->
  <section aria-labelledby="ps-purchases">
    <div class="container ps-carousel" data-carousel>
      <h2 id="ps-purchases">Purchases</h2>
      <div class="ps-carousel__track js-carousel-track" role="list">
        <?php for ($i = 1; $i <= 12; $i++): ?>
          <article class="ps-card" role="listitem">
            <div style="aspect-ratio: 4/3; background:#ddd; border-radius:8px"></div>
            <div>
              <strong>商品タイトル <?php echo $i; ?></strong>
              <div style="color:#666">¥<?php echo number_format(5000 + $i * 1000); ?></div>
            </div>
          </article>
        <?php endfor; ?>
      </div>
      <div class="ps-carousel__nav" aria-hidden="true">
        <div class="ps-carousel__buttons">
          <button class="ps-iconbtn" data-action="prev" aria-label="前へ">◀</button>
          <button class="ps-iconbtn" data-action="next" aria-label="次へ">▶</button>
        </div>
      </div>
    </div>
  </section>

  <!-- Reason (3 features) -->
  <section class="muted" aria-labelledby="ps-reason">
    <div class="container">
      <h2 id="ps-reason">選ばれる理由</h2>
      <div class="ps-grid-3">
        <?php for ($i = 1; $i <= 3; $i++): ?>
          <div class="ps-feature">
            <div style="aspect-ratio: 4/3; background:#eee; border-radius:8px; margin-bottom:8px"></div>
            <strong>理由タイトル 0<?php echo $i; ?></strong>
            <p>説明文ダミー。レイアウト確認のためのテキストです。</p>
          </div>
        <?php endfor; ?>
      </div>
    </div>
  </section>

  <!-- Catalog (search + list) -->
  <section class="ps-catalog" aria-labelledby="ps-catalog">
    <div class="container" style="display:grid; grid-template-columns: 1fr auto; gap:32px; align-items:center;">
      <div></div>
      <div class="ps-catalog__panel">
        <h2 id="ps-catalog">Catalog</h2>
        <form class="js-catalog-form" aria-label="簡易検索フォーム">
          <div style="display:grid; grid-template-columns: 1fr 1fr; gap: 8px;">
            <label>カテゴリ<select><option>ワイン</option><option>ウイスキー</option></select></label>
            <label>価格<select><option>〜5,000</option><option>〜10,000</option></select></label>
          </div>
          <button class="ps-btn" type="submit" style="margin-top:12px">検索</button>
        </form>
        <div class="ps-catalog__list js-catalog-list">
          <?php for ($i = 1; $i <= 6; $i++): ?>
            <div class="ps-card">
              <div style="aspect-ratio: 1/1; background:#ddd; border-radius:8px"></div>
              <div>商品<?php echo $i; ?></div>
            </div>
          <?php endfor; ?>
        </div>
      </div>
    </div>
  </section>

  <!-- Category grid -->
  <section class="muted" aria-labelledby="ps-category">
    <div class="container">
      <h2 id="ps-category">Category</h2>
      <div class="ps-grid-6">
        <?php for ($i = 1; $i <= 12; $i++): ?>
          <a href="#" class="ps-cat">カテゴリ<?php echo $i; ?></a>
        <?php endfor; ?>
      </div>
    </div>
  </section>

  <!-- FAQ -->
  <section aria-labelledby="ps-faq">
    <div class="container">
      <h2 id="ps-faq">よくあるご質問</h2>
      <div class="ps-accordion js-accordion" data-accordion>
        <?php for ($i = 1; $i <= 4; $i++): ?>
          <div class="ps-accordion__item">
            <button class="ps-accordion__head" aria-expanded="false" aria-controls="faq-panel-<?php echo $i; ?>" id="faq-head-<?php echo $i; ?>">
              Q<?php echo $i; ?>. 質問ダミーですか？
            </button>
            <div id="faq-panel-<?php echo $i; ?>" class="ps-accordion__panel" role="region" aria-labelledby="faq-head-<?php echo $i; ?>" aria-hidden="true">
              <div class="ps-accordion__panel-inner">
                A. はい。回答のダミーです。レイアウト検証用テキスト。
              </div>
            </div>
          </div>
        <?php endfor; ?>
      </div>
    </div>
  </section>

  <!-- CTA -->
  <section class="ps-cta" aria-labelledby="ps-cta">
    <div class="container ps-cta__box">
      <h2 id="ps-cta" style="margin:0">まずは無料査定</h2>
      <div style="display:flex; gap:12px; flex-wrap:wrap">
        <button class="ps-btn">LINEで相談</button>
        <button class="ps-btn ps-btn--ghost">メールで相談</button>
      </div>
    </div>
  </section>
</main>

<footer class="ps-footer" role="contentinfo">
  <div class="container">
    <div class="ps-footer__surface">
      <div class="ps-footer__grid">
        <div>
          <h3 style="margin:0 0 12px">サイト名（ダミー）</h3>
          <p style="margin:0 0 6px">〒000-0000 東京都〇〇区〇〇0-0-0</p>
          <p style="margin:0 0 6px">TEL 00-0000-0000（10:00-19:00）</p>
          <p style="margin:0">特商法/プライバシーポリシー等のリンク想定</p>
        </div>
        <div>
          <strong>買取</strong>
          <ul style="list-style:none; padding:0; margin:8px 0 0; display:grid; gap:6px">
            <li><a href="#">宅配買取</a></li>
            <li><a href="#">店頭買取</a></li>
            <li><a href="#">出張買取</a></li>
          </ul>
        </div>
        <div>
          <strong>カテゴリ</strong>
          <ul style="list-style:none; padding:0; margin:8px 0 0; display:grid; gap:6px">
            <li><a href="#">ワイン</a></li>
            <li><a href="#">ウイスキー</a></li>
            <li><a href="#">ブランデー</a></li>
            <li><a href="#">ビール</a></li>
          </ul>
        </div>
        <div>
          <strong>会社情報</strong>
          <ul style="list-style:none; padding:0; margin:8px 0 0; display:grid; gap:6px">
            <li><a href="#">会社概要</a></li>
            <li><a href="#">店舗一覧</a></li>
            <li><a href="#">採用情報</a></li>
            <li><a href="#">お問い合わせ</a></li>
          </ul>
        </div>
      </div>
      <div class="ps-footer__bottom">
        <small>© <?php echo date('Y'); ?> <?php bloginfo('name'); ?>.</small>
        <div style="display:flex; gap:10px">
          <a href="#" aria-label="X">X</a>
          <a href="#" aria-label="Instagram">Instagram</a>
        </div>
      </div>
    </div>
  </div>
</footer>

<script>
  // Carousel (vanilla JS; no library)
  (function(){
    const root = document.querySelector('[data-carousel]');
    if(!root) return;
    const track = root.querySelector('.js-carousel-track');
    const prev = root.querySelector('[data-action="prev"]');
    const next = root.querySelector('[data-action="next"]');
    const scrollByCard = () => {
      const card = track.querySelector('.ps-card');
      const gap = parseFloat(getComputedStyle(track).gap || 0);
      const amount = (card ? card.getBoundingClientRect().width : root.clientWidth * 0.8) + gap;
      return Math.max(1, amount);
    };
    prev?.addEventListener('click', () => track.scrollBy({ left: -scrollByCard(), behavior: 'smooth' }));
    next?.addEventListener('click', () => track.scrollBy({ left:  scrollByCard(), behavior: 'smooth' }));
  })();

  // Accordion (accessible toggles)
  (function(){
    document.querySelectorAll('[data-accordion] .ps-accordion__item').forEach(function(item){
      const head = item.querySelector('.ps-accordion__head');
      const panel = item.querySelector('.ps-accordion__panel');
      if(!head || !panel) return;
      // 初期は完全クローズ（CSSでpadding 0、内容はmeasureしない）
      panel.setAttribute('aria-hidden', 'true');
      head.setAttribute('aria-expanded', 'false');
      head.addEventListener('click', function(){
        const expanded = head.getAttribute('aria-expanded') === 'true';
        head.setAttribute('aria-expanded', String(!expanded));
        panel.setAttribute('aria-hidden', String(expanded));
      });
    });
  })();

  // Catalog filter (mock; prevents navigation)
  (function(){
    const form = document.querySelector('.js-catalog-form');
    if(!form) return;
    form.addEventListener('submit', function(e){
      e.preventDefault();
      // ダミー: フィルター時の見た目変化
      const list = document.querySelector('.js-catalog-list');
      if(!list) return;
      list.querySelectorAll('.ps-card').forEach(function(card, idx){
        card.style.opacity = (idx % 2 === 0) ? '1' : '.6';
      });
    });
  })();

  // Header navigation toggle and shadow
  (function(){
    const header = document.querySelector('.ps-header');
    if(!header) return;
    const burger = header.querySelector('.ps-burger');
    burger?.addEventListener('click', function(){
      const open = header.getAttribute('data-open') === 'true';
      header.setAttribute('data-open', String(!open));
      burger.setAttribute('aria-expanded', String(!open));
    });
    const onScroll = () => {
      header.style.boxShadow = window.scrollY > 8 ? '0 2px 16px rgba(0,0,0,.06)' : 'none';
    };
    window.addEventListener('scroll', onScroll, { passive: true });
    onScroll();
  })();
</script>

<?php wp_footer(); ?>
</body>
</html>
