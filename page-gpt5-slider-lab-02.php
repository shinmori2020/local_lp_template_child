<?php
/**
 * Template Name: GPT-5 Slider Lab 02（モダン汎用スライダー）
 * Description: GPT-5で作成したスライダー検証用テンプレート（v2）。ミニマル＆汎用、CSS/JS同梱・バニラJS。
 * Template Post Type: page
 */

if (!defined('ABSPATH')) { exit; }
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
  <meta charset="<?php bloginfo('charset'); ?>" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title><?php bloginfo('name'); ?> | GPT-5 Slider Lab 02</title>
  <?php wp_head(); ?>
  <style>
    :root { --container: 1200px; --gutter: 24px; --radius: 14px; --gap: 16px; --border: #e6e8ea; --text: #222; --muted: #6b7280; }
    .gpt5sl2-body { background:#ffffff; color: var(--text); font-family: system-ui, -apple-system, Segoe UI, Roboto, "Helvetica Neue", Arial, "Noto Sans JP", "Hiragino Kaku Gothic ProN", "Yu Gothic", Meiryo, sans-serif; }
    .gpt5sl2-container { max-width: var(--container); margin: 0 auto; padding: 0 var(--gutter); }
    .gpt5sl2-section { padding: 56px 0; }
    .gpt5sl2-title { font-size: 28px; margin: 0 0 8px; font-weight: 800; letter-spacing: .01em; }
    .gpt5sl2-desc { color: var(--muted); margin: 0 0 24px; }

    /* Slider v2 (gpt5sl2-) - minimal, card deck, multi per view */
    .gpt5sl2 { position: relative; }
    .gpt5sl2-viewport { position: relative; overflow: hidden; border-radius: 12px; background:#fafafa; border: 1px solid var(--border); }
    .gpt5sl2-track { display: flex; will-change: transform; touch-action: pan-y; }
    .gpt5sl2-slide { min-width: 100%; padding: 16px; }
    .gpt5sl2-card { height: 100%; background: #fff; border: 1px solid var(--border); border-radius: 12px; display: grid; grid-template-rows: auto 1fr auto; overflow: hidden; box-shadow: 0 1px 2px rgba(16,24,40,.04); }
    .gpt5sl2-media { aspect-ratio: 4 / 3; background: linear-gradient(180deg, #f6f7f8, #eef1f4); border-bottom: 1px solid var(--border); }
    .gpt5sl2-content { padding: 12px 14px; display: grid; gap: 6px; }
    .gpt5sl2-title-sm { font-size: 15px; font-weight: 700; margin: 0; }
    .gpt5sl2-meta { color: var(--muted); font-size: 12px; }
    .gpt5sl2-actions { display: flex; justify-content: space-between; align-items: center; gap: 8px; border-top: 1px solid var(--border); padding: 10px 12px; }
    .gpt5sl2-btn { appearance: none; border-radius: 10px; border: 1px solid var(--border); background: #fff; padding: 8px 12px; font-weight: 600; cursor: pointer; }
    .gpt5sl2-btn:hover { background:#f8fafc; }

    /* Controls */
    .gpt5sl2-arrows { position: absolute; inset: 0; pointer-events: none; }
    .gpt5sl2-arrowbar { position: absolute; top: 50%; left: 0; right: 0; display: flex; justify-content: space-between; transform: translateY(-50%); padding: 0 8px; }
    .gpt5sl2-iconbtn { pointer-events: auto; width: 40px; height: 40px; border-radius: 10px; border: 1px solid var(--border); background: rgba(255,255,255,.9); color: #111; cursor: pointer; box-shadow: 0 2px 10px rgba(16,24,40,.1); }
    .gpt5sl2-iconbtn:hover { background: #fff; }

    .gpt5sl2-dots { display: flex; gap: 8px; justify-content: center; margin-top: 12px; }
    .gpt5sl2-dot { width: 6px; height: 6px; border-radius: 999px; background: #d1d5db; border: 0; cursor: pointer; }
    .gpt5sl2-dot[aria-current="true"] { background: #111; }

    @media (max-width: 1024px) { .gpt5sl2-section { padding: 48px 0; } }
    @media (max-width: 768px)  { .gpt5sl2-section { padding: 40px 0; } }
  </style>
  <style>
    /* Slider Gallery 01 (gpt5slg1-) - main + thumbs sync, lightbox */
    .gpt5slg1 { position: relative; margin-top: 56px; }
    .gpt5slg1-viewport { position: relative; }
    .gpt5slg1-main { position: relative; overflow: hidden; border-radius: 16px; background: #fff; border: 1px solid var(--border); }
    .gpt5slg1-track { display: flex; will-change: transform; touch-action: pan-y; }
    .gpt5slg1-slide { min-width: 100%; }
    .gpt5slg1-figure { margin: 0; }
    .gpt5slg1-media { aspect-ratio: 16/9; display: grid; place-items: center; background: linear-gradient(180deg,#f6f7f8,#eef1f4); }
    .gpt5slg1-media-label { font-size: clamp(20px,3vw,28px); font-weight: 800; color: #2b2f33; text-shadow: 0 1px 2px rgba(16,24,40,.08); user-select: none; }
    .gpt5slg1-caption { display:none; }
    /* arrows */
    .gpt5slg1-arrows { position: absolute; inset: 0; pointer-events: none; }
    .gpt5slg1-arrowbar { position: absolute; top: 50%; left: 0; right: 0; display: flex; justify-content: space-between; transform: translateY(-50%); padding: 0 8px; }
    .gpt5slg1-iconbtn { pointer-events: auto; width: 44px; height: 44px; border-radius: 12px; border: 1px solid var(--border); background: rgba(255,255,255,.95); color:#111; cursor:pointer; box-shadow:0 2px 10px rgba(16,24,40,.08); position:relative; font-size:0; line-height:0; display:grid; place-items:center; }
    .gpt5slg1-iconbtn::before { content:""; position:absolute; top:50%; left:50%; width:12px; height:12px; transform: translate(-50%,-50%); background: currentColor; clip-path: polygon(0 0, 100% 50%, 0 100%); }
    [data-gpt5slg1-action="prev"].gpt5slg1-iconbtn::before { transform: translate(-50%,-50%) scaleX(-1); }
    /* thumbs */
    .gpt5slg1-thumbbar { margin-top: 10px; border: 1px solid var(--border); border-radius: 12px; padding: 8px; background: #fff; }
    .gpt5slg1-thumbs { display: grid; grid-auto-flow: column; grid-auto-columns: minmax(80px, 1fr); gap: 8px; overflow-x: auto; scrollbar-width: none; -ms-overflow-style: none; }
    .gpt5slg1-thumbs::-webkit-scrollbar { display: none; }
    .gpt5slg1-thumb { appearance: none; border: 1px solid var(--border); background: linear-gradient(180deg,#f6f7f8,#eef1f4); border-radius: 10px; padding: 0; width: 100%; aspect-ratio: 4/3; cursor: pointer; position: relative; }
    .gpt5slg1-thumb[aria-current="true"] { outline: 2px solid #111; outline-offset: 2px; }
    .gpt5slg1-thumb::after { content: ""; position:absolute; inset:0; border-radius:inherit; box-shadow: inset 0 0 0 1px rgba(16,24,40,.04); }
    /* lightbox */
    .gpt5slg1-lightbox { position: fixed; inset: 0; display: none; place-items: center; background: rgba(13,20,28,.72); z-index: 1000; padding: 24px; }
    .gpt5slg1-lightbox[aria-hidden="false"] { display: grid; }
    .gpt5slg1-lightbox-figure { margin: 0; max-width: min(1200px, 92vw); width: 100%; }
    .gpt5slg1-lightbox-media { width: 100%; aspect-ratio: 16/9; border-radius: 16px; background: linear-gradient(180deg,#f6f7f8,#eef1f4); box-shadow: 0 10px 30px rgba(0,0,0,.35); }
    .gpt5slg1-lightbox-close { position: absolute; top: 16px; right: 16px; appearance: none; border-radius: 12px; border: 1px solid rgba(255,255,255,.25); background: rgba(255,255,255,.1); color: #fff; padding: 10px 12px; font-weight: 700; cursor: pointer; }
    .gpt5slg1-lightbox-arrows { position: absolute; left: 0; right: 0; display:flex; justify-content: space-between; align-items:center; top: 50%; transform: translateY(-50%); padding: 0 16px; }
    .gpt5slg1-lightbox-btn { width: 48px; height: 48px; border-radius: 14px; border: 1px solid rgba(255,255,255,.25); background: rgba(13,20,28,.6); color:#fff; cursor:pointer; font-size:0; line-height:0; display:grid; place-items:center; }
    .gpt5slg1-lightbox-btn::before { content:""; width:14px; height:14px; background: currentColor; clip-path: polygon(0 0, 100% 50%, 0 100%); }
    [data-gpt5slg1-lb="prev"].gpt5slg1-lightbox-btn::before { transform: scaleX(-1); }
    /* focus */
    .gpt5slg1-main:focus { outline: 2px solid #111; outline-offset: 2px; }
    @media (max-width: 768px) {
      .gpt5slg1-thumbs { grid-auto-columns: minmax(72px, 1fr); }
    }
  </style>
  <style>
    /* Slider Hero 01 (gpt5slh1-) - fullbleed hero with progress bar */
    .gpt5slh1 { position: relative; margin-top: 40px; }
    .gpt5slh1-viewport { position: relative; overflow: hidden; border-radius: 16px; background: linear-gradient(180deg,#0b1220,#0e1628); min-height: clamp(360px, 48vw, 680px); outline: 1px solid rgba(255,255,255,.06); }
    .gpt5slh1-progress { position: absolute; left: 0; right: 0; top: 0; height: 3px; background: rgba(255,255,255,.12); overflow: hidden; z-index: 5; }
    .gpt5slh1-progressbar { display: block; width: 0%; height: 100%; background: linear-gradient(90deg,#76e4c3,#b1f4e1); }
    .gpt5slh1-slide { position: absolute; inset: 0; opacity: 0; visibility: hidden; transition: opacity .5s ease, visibility .5s ease; color: #eaf6ff; }
    .gpt5slh1-slide[aria-hidden="false"] { opacity: 1; visibility: visible; }
    .gpt5slh1-grid { position: relative; display: grid; grid-template-columns: 1.05fr 1fr; height: 100%; }
    .gpt5slh1-left { display: grid; align-content: center; gap: 16px; padding: clamp(20px, 5vw, 48px); z-index: 2; }
    .gpt5slh1-eyebrow { color: #9fb3c8; font-weight: 800; letter-spacing: .08em; text-transform: uppercase; font-size: 12px; margin: 0; }
    .gpt5slh1-title { font-size: clamp(28px, 5vw, 56px); line-height: 1.15; margin: 0; color: #ffffff; text-shadow: 0 2px 10px rgba(0,0,0,.25); }
    .gpt5slh1-desc { color: #c9d7e6; margin: 0; font-size: clamp(14px, 1.4vw, 18px); }
    .gpt5slh1-cta { display: flex; gap: 12px; margin-top: 8px; }
    .gpt5slh1-btn { appearance: none; border: 1px solid rgba(255,255,255,.28); background: rgba(255,255,255,.06); color: #fff; padding: 10px 16px; border-radius: 12px; font-weight: 700; cursor: pointer; text-decoration: none; display: inline-flex; align-items: center; gap: 8px; backdrop-filter: blur(6px); }
    .gpt5slh1-btn--primary { background: #10b981; border-color: #10b981; color: #0b1220; }
    .gpt5slh1-btn:hover { filter: brightness(1.05); }
    .gpt5slh1-right { position: relative; }
    .gpt5slh1-visual { position: absolute; inset: 0; background: radial-gradient(800px 380px at 70% 35%, rgba(38,93,133,.45) 0, rgba(18,36,54,.6) 45%, rgba(12,22,36,1) 100%); }
    .gpt5slh1-blob { position:absolute; width: clamp(240px, 44%, 560px); aspect-ratio: 1/1; right: -6%; top: 10%; background: radial-gradient(50% 50% at 50% 50%, #2cd4b9, #159e84); filter: blur(10px); border-radius: 48% 52% 45% 55% / 50% 44% 56% 50%; opacity:.55; transform: rotate(10deg); }
    .gpt5slh1-product { position:absolute; right: 10%; bottom: 8%; width: min(44%, 460px); aspect-ratio: 3/4; border-radius: 16px; background: linear-gradient(180deg, #b4c6e7, #8fb0df); box-shadow: 0 10px 30px rgba(5,12,24,.35); opacity: .95; }
    /* arrows */
    .gpt5slh1-arrows { position: absolute; inset: 0; pointer-events: none; }
    .gpt5slh1-arrowbar { position: absolute; top: 50%; left: 0; right: 0; display: flex; justify-content: space-between; transform: translateY(-50%); padding: 0 8px; }
    .gpt5slh1-iconbtn { pointer-events: auto; width: 44px; height: 44px; border-radius: 12px; border: 1px solid rgba(255,255,255,.15); background: rgba(13,20,28,.7); color: #fff; cursor: pointer; box-shadow: 0 2px 10px rgba(0,0,0,.25); position: relative; font-size:0; line-height:0; display:grid; place-items:center; }
    .gpt5slh1-iconbtn:hover { background: rgba(13,20,28,.9); }
    .gpt5slh1-iconbtn::before { content: ""; position:absolute; top:50%; left:50%; width:12px; height:12px; transform: translate(-50%,-50%); background: currentColor; clip-path: polygon(0 0, 100% 50%, 0 100%); }
    [data-gpt5slh1-action="prev"].gpt5slh1-iconbtn::before { transform: translate(-50%,-50%) scaleX(-1); }
    /* dots */
    .gpt5slh1-dots { display:flex; gap:8px; justify-content:center; margin-top: 12px; }
    .gpt5slh1-dot { width: 8px; height: 8px; border-radius: 999px; background: #2a3644; border: 0; cursor: pointer; }
    .gpt5slh1-dot[aria-current="true"] { background: #76e4c3; }
    /* focus */
    .gpt5slh1-viewport:focus { outline: 2px solid #76e4c3; outline-offset: 2px; }
    /* responsive */
    @media (max-width: 1024px) { .gpt5slh1-grid { grid-template-columns: 1fr; } .gpt5slh1-right { min-height: 260px; } }
    @media (prefers-reduced-motion: reduce) {
      .gpt5slh1-slide { transition: none; }
    }
  </style>
  <style>
    /* Slider v2-04 (gpt5sl2-04-) - 3-per-view, borderless, CSS arrows, infinite */
    .gpt5sl2-04 { position: relative; margin-top: 56px; }
    .gpt5sl2-04-viewport { position: relative; overflow: hidden; /* borderless */ border-radius: 0; background: transparent; }
    .gpt5sl2-04-track { display: flex; will-change: transform; touch-action: pan-y; }
    .gpt5sl2-04-slide { min-width: 100%; padding: 12px; }
    .gpt5sl2-04-card { height: 100%; background: #fff; border: 1px solid #e6e8ea; border-radius: 12px; display: grid; grid-template-rows: auto 1fr auto; overflow: hidden; box-shadow: 0 1px 2px rgba(16,24,40,.04); }
    .gpt5sl2-04-media { aspect-ratio: 4/3; background: linear-gradient(180deg,#f6f7f8,#eef1f4); border-bottom: 1px solid #e6e8ea; }
    .gpt5sl2-04-content { padding: 12px 14px; display: grid; gap: 6px; }
    .gpt5sl2-04-title { font-size: 15px; font-weight: 700; margin: 0; }
    .gpt5sl2-04-meta { color: #6b7280; font-size: 12px; }
    .gpt5sl2-04-actions { display:flex; justify-content: space-between; align-items: center; gap: 8px; border-top: 1px solid #e6e8ea; padding: 10px 12px; }
    .gpt5sl2-04-btn { appearance:none; border-radius: 10px; border:1px solid #e6e8ea; background:#fff; padding:8px 12px; font-weight:600; cursor:pointer; }

    .gpt5sl2-04-arrows { position: absolute; inset: 0; pointer-events: none; }
    .gpt5sl2-04-arrowbar { position: absolute; top: 50%; left: 0; right: 0; display:flex; justify-content: space-between; transform: translateY(-50%); padding: 0 8px; }
    .gpt5sl2-04-iconbtn { pointer-events:auto; width:44px; height:44px; border-radius: 10px; border:1px solid #e6e8ea; background: rgba(255,255,255,.95); color:#111; cursor:pointer; box-shadow:0 2px 10px rgba(16,24,40,.08); position:relative; font-size:0; line-height:0; display:grid; place-items:center; }
    .gpt5sl2-04-iconbtn::before { content:""; position:absolute; top:50%; left:50%; width:12px; height:12px; transform: translate(-50%,-50%); background: currentColor; clip-path: polygon(0 0, 100% 50%, 0 100%); }
    [data-gpt5sl2-04-action="prev"].gpt5sl2-04-iconbtn::before { transform: translate(-50%,-50%) scaleX(-1); }

    .gpt5sl2-04-dots { display:flex; gap:8px; justify-content:center; margin-top:12px; }
    .gpt5sl2-04-dot { width:6px; height:6px; border-radius:999px; background:#d1d5db; border:0; cursor:pointer; }
    .gpt5sl2-04-dot[aria-current="true"] { background:#111; }
  </style>
</head>
<body <?php body_class('gpt5sl2-body'); ?>>
  <main class="gpt5sl2-container gpt5sl2-section">
    <header style="margin-bottom:24px">
      <h1 class="gpt5sl2-title">GPT-5 Slider Lab 02</h1>
      <p class="gpt5sl2-desc">モダンで汎用的なカードスライダー（複数表示/ミニマル）。どんなサイトにも馴染むニュートラルデザイン。</p>
    </header>

    <!-- Slider Hero 01: fullbleed hero with progress bar (unique prefix: gpt5slh1-) -->
    <section class="gpt5slh1" aria-roledescription="carousel" aria-label="ヒーロースライダー01" data-gpt5slh1>
      <div class="gpt5slh1-viewport" tabindex="0">
        <div class="gpt5slh1-progress" aria-hidden="true"><span class="gpt5slh1-progressbar"></span></div>

        <article class="gpt5slh1-slide" role="group" aria-label="スライド 1 / 3" aria-hidden="false">
          <div class="gpt5slh1-grid">
            <div class="gpt5slh1-left">
              <p class="gpt5slh1-eyebrow">FEATURED</p>
              <h2 class="gpt5slh1-title">より軽快で、よりスマートなスライダー</h2>
              <p class="gpt5slh1-desc">ライブラリ不使用・ミニマル構成。進行状況は上部バーで視覚化され、フォーカスやホバーで一時停止します。</p>
              <div class="gpt5slh1-cta">
                <a href="#" class="gpt5slh1-btn gpt5slh1-btn--primary">今すぐ試す</a>
                <a href="#" class="gpt5slh1-btn">詳しく見る</a>
              </div>
            </div>
            <div class="gpt5slh1-right">
              <div class="gpt5slh1-visual"></div>
              <div class="gpt5slh1-blob"></div>
              <div class="gpt5slh1-product"></div>
            </div>
          </div>
        </article>

        <article class="gpt5slh1-slide" role="group" aria-label="スライド 2 / 3" aria-hidden="true">
          <div class="gpt5slh1-grid">
            <div class="gpt5slh1-left">
              <p class="gpt5slh1-eyebrow">ACCESSIBLE</p>
              <h2 class="gpt5slh1-title">アクセシブルな操作性</h2>
              <p class="gpt5slh1-desc">キーボード操作（左右キー）やスクリーンリーダーに配慮したマークアップ。快適な体験を提供します。</p>
              <div class="gpt5slh1-cta">
                <a href="#" class="gpt5slh1-btn gpt5slh1-btn--primary">ガイドを見る</a>
                <a href="#" class="gpt5slh1-btn">デザイン原則</a>
              </div>
            </div>
            <div class="gpt5slh1-right">
              <div class="gpt5slh1-visual"></div>
              <div class="gpt5slh1-blob" style="right: -10%; top: 18%; transform: rotate(-6deg);"></div>
              <div class="gpt5slh1-product" style="right: 14%; bottom: 10%;"></div>
            </div>
          </div>
        </article>

        <article class="gpt5slh1-slide" role="group" aria-label="スライド 3 / 3" aria-hidden="true">
          <div class="gpt5slh1-grid">
            <div class="gpt5slh1-left">
              <p class="gpt5slh1-eyebrow">PERFORMANCE</p>
              <h2 class="gpt5slh1-title">軽量・高パフォーマンス</h2>
              <p class="gpt5slh1-desc">DOMは最小限、アニメーションはGPUフレンドリー。`prefers-reduced-motion`にも対応。</p>
              <div class="gpt5slh1-cta">
                <a href="#" class="gpt5slh1-btn gpt5slh1-btn--primary">ベンチマーク</a>
                <a href="#" class="gpt5slh1-btn">コードを確認</a>
              </div>
            </div>
            <div class="gpt5slh1-right">
              <div class="gpt5slh1-visual"></div>
              <div class="gpt5slh1-blob" style="right: -4%; top: 12%; opacity:.45"></div>
              <div class="gpt5slh1-product" style="right: 8%; bottom: 6%; width:min(42%,420px)"></div>
            </div>
          </div>
        </article>

        <div class="gpt5slh1-arrows" aria-hidden="true">
          <div class="gpt5slh1-arrowbar">
            <button class="gpt5slh1-iconbtn" data-gpt5slh1-action="prev" aria-label="前へ">◀</button>
            <button class="gpt5slh1-iconbtn" data-gpt5slh1-action="next" aria-label="次へ">▶</button>
          </div>
        </div>
      </div>
      <div class="gpt5slh1-dots js-gpt5slh1-dots" aria-label="スライドインジケータ"></div>
    </section>

  </main>

  <!-- Slider Gallery 01: main + thumbs sync (unique prefix: gpt5slg1-) -->
  <section class="gpt5slg1 gpt5sl2-container gpt5sl2-section" aria-roledescription="carousel" aria-label="ギャラリー スライダー01" data-gpt5slg1>
    <h2 class="gpt5sl2-title" style="margin-bottom:8px">Gallery 01（メイン＋サムネ同期 / ライトボックス）</h2>
    <p class="gpt5sl2-desc">クリック・ドラッグ・キーボード操作に対応。サムネと同期、ライトボックスで拡大表示。</p>
    <div class="gpt5slg1-viewport">
      <div class="gpt5slg1-main" tabindex="0">
        <div class="gpt5slg1-track js-gpt5slg1-track" role="list">
          <?php for ($i = 1; $i <= 8; $i++): ?>
            <figure class="gpt5slg1-slide gpt5slg1-figure" role="group" aria-label="スライド <?php echo $i; ?> / 8">
              <div class="gpt5slg1-media" data-gpt5slg1-media-index="<?php echo $i-1; ?>" data-gpt5slg1-lightbox-trigger>
                <span class="gpt5slg1-media-label">IMAGE <?php echo $i; ?></span>
              </div>
              <figcaption class="gpt5slg1-caption">キャプション <?php echo $i; ?></figcaption>
            </figure>
          <?php endfor; ?>
        </div>
        <div class="gpt5slg1-arrows" aria-hidden="true">
          <div class="gpt5slg1-arrowbar">
            <button class="gpt5slg1-iconbtn" data-gpt5slg1-action="prev" aria-label="前へ">◀</button>
            <button class="gpt5slg1-iconbtn" data-gpt5slg1-action="next" aria-label="次へ">▶</button>
          </div>
        </div>
      </div>
      <div class="gpt5slg1-thumbbar" aria-label="サムネイル" role="tablist">
        <div class="gpt5slg1-thumbs js-gpt5slg1-thumbs">
          <?php for ($i = 1; $i <= 8; $i++): ?>
            <button class="gpt5slg1-thumb" role="tab" aria-label="画像 <?php echo $i; ?>" data-gpt5slg1-thumb-index="<?php echo $i-1; ?>">
            </button>
          <?php endfor; ?>
        </div>
      </div>
    </div>
  </section>

  <!-- Lightbox for Gallery 01 -->
  <div class="gpt5slg1-lightbox" aria-hidden="true" data-gpt5slg1-lightbox>
    <button class="gpt5slg1-lightbox-close" type="button" data-gpt5slg1-lb="close" aria-label="閉じる">閉じる</button>
    <div class="gpt5slg1-lightbox-arrows" aria-hidden="true">
      <button class="gpt5slg1-lightbox-btn" data-gpt5slg1-lb="prev" aria-label="前へ"></button>
      <button class="gpt5slg1-lightbox-btn" data-gpt5slg1-lb="next" aria-label="次へ"></button>
    </div>
    <figure class="gpt5slg1-lightbox-figure">
      <div class="gpt5slg1-lightbox-media" data-gpt5slg1-lb-media></div>
    </figure>
  </div>

  

  <section class="gpt5sl2-container gpt5sl2-section">
    <h2 class="gpt5sl2-title" style="margin-bottom:8px">Slider 04（3-per-view / infinite / borderless）</h2>
    <p class="gpt5sl2-desc">3枚同時表示・3枚単位で循環。枠なし・CSS矢印。</p>
    <div class="gpt5sl2-04" aria-roledescription="carousel" aria-label="スライダー04" data-gpt5sl2-04>
      <div class="gpt5sl2-04-viewport" tabindex="0">
        <div class="gpt5sl2-04-track js-gpt5sl2-04-track" role="list">
          <?php for ($i = 1; $i <= 9; $i++): ?>
            <article class="gpt5sl2-04-slide" role="group" aria-label="スライド <?php echo $i; ?>">
              <div class="gpt5sl2-04-card">
                <div class="gpt5sl2-04-media"></div>
                <div class="gpt5sl2-04-content">
                  <h3 class="gpt5sl2-04-title">カード <?php echo $i; ?></h3>
                  <div class="gpt5sl2-04-meta">ダミー説明</div>
                </div>
                <div class="gpt5sl2-04-actions">
                  <button class="gpt5sl2-04-btn" type="button">詳しく</button>
                  <span class="gpt5sl2-04-meta">#<?php echo $i; ?></span>
                </div>
              </div>
            </article>
          <?php endfor; ?>
        </div>
        <div class="gpt5sl2-04-arrows" aria-hidden="true">
          <div class="gpt5sl2-04-arrowbar">
            <button class="gpt5sl2-04-iconbtn" data-gpt5sl2-04-action="prev" aria-label="前へ">◀</button>
            <button class="gpt5sl2-04-iconbtn" data-gpt5sl2-04-action="next" aria-label="次へ">▶</button>
          </div>
        </div>
      </div>
      <div class="gpt5sl2-04-dots js-gpt5sl2-04-dots" aria-label="スライドインジケータ"></div>
    </div>
  </section>

  <script>
  // Slider 04: 3-per-view, infinite loop (seamless), borderless, CSS arrows
  (function(){
    const root = document.querySelector('[data-gpt5sl2-04]');
    if(!root) return;
    const viewport = root.querySelector('.gpt5sl2-04-viewport');
    const track = root.querySelector('.js-gpt5sl2-04-track');
    const prevBtn = root.querySelector('[data-gpt5sl2-04-action="prev"]');
    const nextBtn = root.querySelector('[data-gpt5sl2-04-action="next"]');
    const dotsWrap = root.querySelector('.js-gpt5sl2-04-dots');

    // Ensure items count is multiple of 3 by cloning
    let originals = Array.from(track.children);
    const need = (3 - (originals.length % 3)) % 3;
    for (let i = 0; i < need; i++) {
      track.appendChild(originals[i % originals.length].cloneNode(true));
    }
    originals = Array.from(track.children);

    // Clone head/tail pages for infinite
    const first3 = originals.slice(0,3).map(n=>n.cloneNode(true));
    const last3  = originals.slice(-3).map(n=>n.cloneNode(true));
    first3.forEach(n=>{ n.dataset.clone='true'; track.appendChild(n); });
    last3.forEach(n=>{ n.dataset.clone='true'; track.insertBefore(n, track.firstChild); });

    let slides = Array.from(track.children);
    const totalReal = originals.length; // multiple of 3
    let pageIndex = 1; // start at first real page (after leading clones)
    let x = 0; let startX = 0; let isDown = false; let trackStartX = 0;

    function layout(){
      const w = viewport.clientWidth;
      const per = (w >= 1024) ? 3 : (w >= 768 ? 2 : 1);
      const slideWidth = w / per;
      slides.forEach(el => { el.style.minWidth = slideWidth + 'px'; });
    }
    function translate(withAnim){
      layout();
      const w = viewport.clientWidth;
      const per = (w >= 1024) ? 3 : (w >= 768 ? 2 : 1);
      const pageWidth = w; // move one viewport per page (3 items on desktop)
      track.style.transition = withAnim ? 'transform .35s ease' : 'none';
      x = -pageIndex * pageWidth;
      track.style.transform = `translate3d(${x}px,0,0)`;
      updateDots();
    }
    function go(delta){ pageIndex += delta; translate(true); }

    function pagesCount(){
      const w = viewport.clientWidth;
      const per = (w >= 1024) ? 3 : (w >= 768 ? 2 : 1);
      return Math.ceil(totalReal / per);
    }
    function makeDots(){
      dotsWrap.innerHTML = '';
      for (let i = 0; i < pagesCount(); i++){
        const b = document.createElement('button'); b.className='gpt5sl2-04-dot'; b.type='button'; b.setAttribute('aria-label', `ページ ${i+1} へ`);
        b.addEventListener('click', ()=>{ pageIndex = i + 1; translate(true); });
        dotsWrap.appendChild(b);
      }
      updateDots();
    }
    function updateDots(){
      const dots = dotsWrap.querySelectorAll('.gpt5sl2-04-dot');
      const count = pagesCount();
      let realPage = pageIndex - 1;
      if(pageIndex <= 0) realPage = count - 1;
      if(pageIndex > count) realPage = 0;
      dots.forEach((d,i)=> d.setAttribute('aria-current', String(i===realPage)) );
    }

    // Transition edge handling
    track.addEventListener('transitionend', ()=>{
      const count = pagesCount();
      if (pageIndex <= 0) { pageIndex = count; translate(false); }
      if (pageIndex > count) { pageIndex = 1; translate(false); }
    });

    // Drag/Swipe (page)
    function onDown(e){ isDown = true; track.style.transition='none'; startX = ('touches' in e ? e.touches[0].clientX : e.clientX); trackStartX = x; }
    function onMove(e){ if(!isDown) return; const clientX = ('touches' in e ? e.touches[0].clientX : e.clientX); const dx = clientX - startX; x = trackStartX + dx; track.style.transform = `translate3d(${x}px,0,0)`; }
    function onUp(){ if(!isDown) return; isDown = false; const moved = x - trackStartX; const threshold = viewport.clientWidth * 0.12; if(moved < -threshold) pageIndex++; if(moved > threshold) pageIndex--; translate(true); }
    viewport.addEventListener('mousedown', onDown); document.addEventListener('mousemove', onMove); document.addEventListener('mouseup', onUp);
    viewport.addEventListener('touchstart', onDown, { passive: true }); document.addEventListener('touchmove', onMove, { passive: true }); document.addEventListener('touchend', onUp);

    // Arrows & Keyboard
    prevBtn.addEventListener('click', ()=> go(-1));
    nextBtn.addEventListener('click', ()=> go(1));
    viewport.addEventListener('keydown', (e)=>{ if(e.key==='ArrowLeft'){e.preventDefault();go(-1);} if(e.key==='ArrowRight'){e.preventDefault();go(1);} });

    // Resize
    window.addEventListener('resize', ()=>{ makeDots(); translate(false); });

    // Init
    makeDots();
    translate(false);
  })();
  </script>

  <script>
  // Slider Gallery 01: main + thumbs sync + lightbox, no external libs
  (function(){
    const root = document.querySelector('[data-gpt5slg1]');
    if(!root) return;
    const viewport = root.querySelector('.gpt5slg1-main');
    const track = root.querySelector('.js-gpt5slg1-track');
    const slides = Array.from(track.children);
    const prevBtn = root.querySelector('[data-gpt5slg1-action="prev"]');
    const nextBtn = root.querySelector('[data-gpt5slg1-action="next"]');
    const thumbsWrap = root.querySelector('.js-gpt5slg1-thumbs');
    const thumbs = Array.from(thumbsWrap.querySelectorAll('[data-gpt5slg1-thumb-index]'));
    const lightbox = document.querySelector('[data-gpt5slg1-lightbox]');
    const lbMedia = lightbox.querySelector('[data-gpt5slg1-lb-media]');
    const lbClose = lightbox.querySelector('[data-gpt5slg1-lb="close"]');
    const lbPrev = lightbox.querySelector('[data-gpt5slg1-lb="prev"]');
    const lbNext = lightbox.querySelector('[data-gpt5slg1-lb="next"]');

    let index = 0; let x = 0; let startX = 0; let isDown = false; let trackStartX = 0;

    function vw(){ return viewport.clientWidth; }
    function translate(withAnim){
      track.style.transition = withAnim ? 'transform .35s ease' : 'none';
      x = -index * vw();
      track.style.transform = `translate3d(${x}px,0,0)`;
      updateThumbs();
    }
    function clamp(v,min,max){ return Math.max(min, Math.min(max, v)); }
    function go(to){ index = clamp(to, 0, slides.length - 1); translate(true); }
    function next(){ go(index + 1); }
    function prev(){ go(index - 1); }

    function updateThumbs(){
      thumbs.forEach((t,i)=> t.setAttribute('aria-current', String(i===index)) );
      // ensure active thumb is visible
      const active = thumbs[index];
      if(active){
        const wrapRect = thumbsWrap.getBoundingClientRect();
        const rect = active.getBoundingClientRect();
        if(rect.left < wrapRect.left) thumbsWrap.scrollBy({ left: rect.left - wrapRect.left - 8, behavior: 'smooth' });
        if(rect.right > wrapRect.right) thumbsWrap.scrollBy({ left: rect.right - wrapRect.right + 8, behavior: 'smooth' });
      }
    }

    // Drag / Swipe on main
    function onDown(e){ isDown = true; track.style.transition='none'; startX = ('touches' in e ? e.touches[0].clientX : e.clientX); trackStartX = x; }
    function onMove(e){ if(!isDown) return; const clientX = ('touches' in e ? e.touches[0].clientX : e.clientX); const dx = clientX - startX; x = trackStartX + dx; track.style.transform = `translate3d(${x}px,0,0)`; }
    function onUp(){ if(!isDown) return; isDown = false; const moved = x - trackStartX; const threshold = vw() * 0.12; if(moved < -threshold) index++; if(moved > threshold) index--; go(index); }
    viewport.addEventListener('mousedown', onDown); document.addEventListener('mousemove', onMove); document.addEventListener('mouseup', onUp);
    viewport.addEventListener('touchstart', onDown, { passive: true }); document.addEventListener('touchmove', onMove, { passive: true }); document.addEventListener('touchend', onUp);

    // Arrows & Keyboard
    prevBtn.addEventListener('click', prev);
    nextBtn.addEventListener('click', next);
    viewport.addEventListener('keydown', (e)=>{ if(e.key==='ArrowLeft'){ e.preventDefault(); prev(); } if(e.key==='ArrowRight'){ e.preventDefault(); next(); } if(e.key==='Enter'){ openLightbox(index); } });

    // Thumbs click
    thumbs.forEach((t)=>{
      t.addEventListener('click', ()=>{ const i = Number(t.dataset.gpt5slg1ThumbIndex); index = i; translate(true); });
    });

    // Lightbox
    function openLightbox(i){
      if(!lightbox) return;
      index = clamp(i, 0, slides.length - 1);
      lightbox.setAttribute('aria-hidden','false');
      updateLightbox();
      document.addEventListener('keydown', onLbKey);
    }
    function closeLightbox(){
      if(!lightbox) return;
      lightbox.setAttribute('aria-hidden','true');
      document.removeEventListener('keydown', onLbKey);
    }
    function updateLightbox(){ if(lbMedia){ lbMedia.textContent = ''; lbMedia.style.background = getComputedStyle(slides[index].querySelector('.gpt5slg1-media')).background; } }
    function onLbKey(e){
      if(e.key==='Escape'){ closeLightbox(); }
      if(e.key==='ArrowLeft'){ e.preventDefault(); prev(); updateLightbox(); }
      if(e.key==='ArrowRight'){ e.preventDefault(); next(); updateLightbox(); }
    }
    lbClose.addEventListener('click', closeLightbox);
    lbPrev.addEventListener('click', ()=>{ prev(); updateLightbox(); });
    lbNext.addEventListener('click', ()=>{ next(); updateLightbox(); });
    lightbox.addEventListener('click', (e)=>{ if(e.target === lightbox) closeLightbox(); });

    // Open lightbox from main media
    root.querySelectorAll('[data-gpt5slg1-lightbox-trigger]').forEach((el)=>{
      el.addEventListener('click', ()=>{ const i = Number(el.dataset.gpt5slg1MediaIndex); openLightbox(i); });
    });

    // Resize
    window.addEventListener('resize', ()=> translate(false));

    // Init
    translate(false);
    updateThumbs();
  })();
  </script>

  <script>
  // Slider Hero 01 (fade + progress bar) - supports multiple instances, no libs
  (function(){
    const roots = document.querySelectorAll('[data-gpt5slh1]');
    if(!roots.length) return;
    const INTERVAL = 5000; // ms per slide

    roots.forEach((root)=>{
      const prefersReducedMotion = window.matchMedia && window.matchMedia('(prefers-reduced-motion: reduce)').matches;
      const viewport = root.querySelector('.gpt5slh1-viewport');
      const slides = Array.from(root.querySelectorAll('.gpt5slh1-slide'));
      const prevBtn = root.querySelector('[data-gpt5slh1-action="prev"]');
      const nextBtn = root.querySelector('[data-gpt5slh1-action="next"]');
      const dotsWrap = root.querySelector('.js-gpt5slh1-dots');
      const bar = root.querySelector('.gpt5slh1-progressbar');

      let index = 0;
      let rafId = null; let startTs = 0; let paused = prefersReducedMotion; let elapsed = 0;

      function show(i){
        index = (i + slides.length) % slides.length;
        slides.forEach((s,si)=> s.setAttribute('aria-hidden', String(si !== index)) );
        updateDots();
      }
      function next(){ show(index + 1); resetProgress(); }
      function prev(){ show(index - 1); resetProgress(); }

      function makeDots(){
        if(!dotsWrap) return;
        dotsWrap.innerHTML = '';
        slides.forEach((_,i)=>{
          const b = document.createElement('button'); b.type='button'; b.className='gpt5slh1-dot';
          b.setAttribute('aria-label', `スライド ${i+1} へ`);
          b.addEventListener('click', ()=>{ show(i); resetProgress(); });
          dotsWrap.appendChild(b);
        });
        updateDots();
      }
      function updateDots(){
        if(!dotsWrap) return;
        dotsWrap.querySelectorAll('.gpt5slh1-dot').forEach((d,i)=> d.setAttribute('aria-current', String(i===index)) );
      }

      function step(ts){
        if(paused){ rafId = requestAnimationFrame(step); return; }
        if(!startTs) startTs = ts;
        const delta = ts - startTs + elapsed;
        const ratio = Math.max(0, Math.min(1, delta / INTERVAL));
        if(bar) bar.style.width = (ratio * 100).toFixed(4) + '%';
        if(ratio >= 1){
          show(index + 1);
          startTs = ts; elapsed = 0;
          if(bar) bar.style.width = '0%';
        }
        rafId = requestAnimationFrame(step);
      }
      function startProgress(){ cancelProgress(); startTs = 0; elapsed = 0; rafId = requestAnimationFrame(step); }
      function cancelProgress(){ if(rafId){ cancelAnimationFrame(rafId); rafId = null; } }
      function resetProgress(){ if(bar) bar.style.width = '0%'; startTs = 0; elapsed = 0; }

      // Events
      if(nextBtn) nextBtn.addEventListener('click', ()=>{ next(); });
      if(prevBtn) prevBtn.addEventListener('click', ()=>{ prev(); });
      viewport.addEventListener('keydown', (e)=>{
        if(e.key==='ArrowLeft'){ e.preventDefault(); prev(); }
        if(e.key==='ArrowRight'){ e.preventDefault(); next(); }
      });
      viewport.addEventListener('mouseenter', ()=>{ paused = true; });
      viewport.addEventListener('mouseleave', ()=>{ paused = false; });
      viewport.addEventListener('focusin', ()=>{ paused = true; });
      viewport.addEventListener('focusout', ()=>{ paused = false; });

      // Init
      makeDots();
      show(0);
      if(!prefersReducedMotion){
        startProgress();
      } else if(bar){
        bar.style.width = '0%';
      }
    });
  })();
  </script>

  <?php wp_footer(); ?>
</body>
</html>


