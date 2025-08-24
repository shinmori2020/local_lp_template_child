<?php
/**
 * Template Name: GPT-5 Slider Lab 06（タイムライン/ステップ連動）
 * Description: ステップインジケータとスライドを同期。スクロール進行やクリックでジャンプ。
 * Template Post Type: page
 */

if (!defined('ABSPATH')) { exit; }
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
  <meta charset="<?php bloginfo('charset'); ?>" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title><?php bloginfo('name'); ?> | GPT-5 Slider Lab 06</title>
  <?php wp_head(); ?>
  <link rel="preconnect" href="https://picsum.photos" crossorigin>
  <link rel="dns-prefetch" href="https://picsum.photos">
  <style>
    /* ECサイト風全幅スライダー (gpt5c-*) */
    :root {
      --gpt5c-bg: #ffffff;
      --gpt5c-text: #111111;
      --gpt5c-ui-muted: #a3a3a3;
      --gpt5c-ui-hover: #6b7280;
      --gpt5c-primary: #16a34a;
      --gpt5c-primary-hover: #15803d;
      --gpt5c-focus: 0 0 0 3px rgba(59,130,246,0.45);
      --gpt5c-shadow: 0 4px 16px rgba(0,0,0,0.1);
      --gpt5c-transition: 350ms ease-out;
    }

    @media (prefers-reduced-motion: reduce) {
      :root { --gpt5c-transition: 0ms; }
    }

    .gpt5c-slider {
      position: relative;
      background: var(--gpt5c-bg);
      color: var(--gpt5c-text);
      width: 100%;
      margin: 40px auto;
      padding: 32px;
      box-sizing: border-box;
      border-radius: 0;
    }

    .gpt5c-slider:focus-visible {
      outline: none;
      box-shadow: var(--gpt5c-focus);
    }

    .gpt5c-viewport {
      overflow: hidden;
      position: relative;
      border-radius: 8px;
    }

    .gpt5c-track {
      display: flex;
      will-change: transform;
      touch-action: pan-y;
      -webkit-user-select: none;
      user-select: none;
      transform: translate3d(0,0,0);
      transition: transform var(--gpt5c-transition);
      margin: 0;
      padding: 0;
      list-style: none;
    }

    .gpt5c-card {
      position: relative;
      background: var(--gpt5c-bg);
      border-radius: 0;
      overflow: hidden;
      flex: 0 0 auto;
    }

    .gpt5c-image {
      width: 100%;
      aspect-ratio: 3 / 4;
      background: #f8fafc;
      position: relative;
      overflow: hidden;
    }

    .gpt5c-image img {
      width: 100%;
      height: 100%;
      object-fit: cover;
      display: block;
      border-radius: 0;
      -webkit-user-drag: none;
      user-drag: none;
      pointer-events: none;
    }

    .gpt5c-badge {
      position: absolute;
      top: 12px;
      right: 12px;
      background: var(--gpt5c-primary);
      color: white;
      padding: 4px 8px;
      font-size: 0.75rem;
      font-weight: 700;
      border-radius: 4px;
      z-index: 2;
    }

    .gpt5c-caption {
      padding: 12px 0;
      text-align: left;
    }

    .gpt5c-subtitle {
      font-size: 0.875rem;
      color: #6b7280;
      margin: 0 0 4px 0;
      line-height: 1.5;
    }

    .gpt5c-title {
      font-size: 1.125rem;
      font-weight: 600;
      margin: 0;
      line-height: 1.4;
      color: var(--gpt5c-text);
    }

    /* Navigation arrows */
    .gpt5c-nav {
      position: absolute;
      top: 50%;
      transform: translateY(-50%);
      width: 48px;
      height: 48px;
      border-radius: 50%;
      background: rgba(255,255,255,0.95);
      border: 1px solid #e5e7eb;
      color: var(--gpt5c-ui-muted);
      display: flex;
      align-items: center;
      justify-content: center;
      cursor: pointer;
      transition: all var(--gpt5c-transition);
      z-index: 10;
      box-shadow: var(--gpt5c-shadow);
    }

    .gpt5c-nav:hover,
    .gpt5c-nav:focus-visible {
      background: rgba(255,255,255,1);
      color: var(--gpt5c-ui-hover);
      border-color: #d1d5db;
      outline: none;
      transform: translateY(-50%) scale(1.05);
    }

    .gpt5c-nav--prev { left: 16px; }
    .gpt5c-nav--next { right: 16px; }

    /* Pagination dots */
    .gpt5c-pagination {
      display: flex;
      gap: 10px;
      justify-content: center;
      align-items: center;
      margin-top: 20px;
    }

    .gpt5c-dot {
      width: 10px;
      height: 10px;
      border-radius: 50%;
      background: var(--gpt5c-ui-muted);
      border: none;
      padding: 0;
      cursor: pointer;
      transition: all var(--gpt5c-transition);
      opacity: 0.5;
    }

    .gpt5c-dot:hover,
    .gpt5c-dot:focus-visible {
      opacity: 0.8;
      outline: none;
      box-shadow: var(--gpt5c-focus);
    }

    .gpt5c-dot[aria-selected="true"] {
      background: var(--gpt5c-primary);
      opacity: 1;
      transform: scale(1.2);
    }

    /* Status for screen readers */
    .gpt5c-sr-only {
      position: absolute !important;
      width: 1px;
      height: 1px;
      padding: 0;
      margin: -1px;
      overflow: hidden;
      clip: rect(0,0,0,0);
      white-space: nowrap;
      border: 0;
    }

    /* Edge case: Few items centering */
    .gpt5c-track[data-gpt5c-few-items="true"] {
      justify-content: center;
    }

    .gpt5c-track[data-gpt5c-few-items="true"] .gpt5c-card {
      flex-shrink: 0;
    }

    /* Hide navigation when not needed */
    .gpt5c-slider[data-gpt5c-hide-nav="true"] .gpt5c-nav,
    .gpt5c-slider[data-gpt5c-hide-nav="true"] .gpt5c-pagination {
      display: none;
    }

    /* Responsive layout - CSS managed in JS for dynamic calculation */

    .gpt5sl-slider {
      position: relative;
      background: var(--slider-bg);
      color: var(--slider-fg);
      max-width: 1200px;
      margin: 0 auto;
      padding: 12px;
      box-sizing: border-box;
    }

    .gpt5sl-slider:focus {
      outline: none;
      box-shadow: var(--focus-ring);
      border-radius: 8px;
    }

    .gpt5sl-viewport {
      overflow: hidden;
      border-radius: 0;
      position: relative;
    }

    .gpt5sl-track {
      display: flex;
      will-change: transform;
      touch-action: pan-y;
      -webkit-user-select: none;
      user-select: none;
      transform: translate3d(0,0,0);
      transition: transform var(--transition-ms) ease-out;
      margin: 0;
      padding: 0;
      list-style: none;
    }

    .gpt5sl-slide {
      flex: 0 0 100%;
      min-width: 100%;
      display: flex;
      flex-direction: column;
      position: relative;
      background: #fff;
    }

    /* Media area with responsive aspect ratio */
    .gpt5sl-media {
      width: 100%;
      aspect-ratio: 4 / 3;
      background: #f3f4f6;
      position: relative;
      overflow: hidden;
    }
    .gpt5sl-media img {
      width: 100%;
      height: 100%;
      object-fit: cover;
      display: block;
      -webkit-user-drag: none;
      user-drag: none;
      pointer-events: none;
      border-radius: 0;
    }

    .gpt5sl-content {
      position: relative;
      padding: 20px;
      display: grid;
      gap: 8px;
      background: #ffffff;
      color: #111111;
      border-radius: 0;
    }
    .gpt5sl-title {
      font-size: 1.125rem;
      margin: 0;
      line-height: 1.3;
    }
    .gpt5sl-desc {
      margin: 0;
      color: #374151;
      line-height: 1.6;
    }
    .gpt5sl-btn {
      display: inline-block;
      padding: 10px 16px;
      background: var(--gpt5c-primary);
      color: white;
      text-decoration: none;
      border-radius: 4px;
      border: none;
      transition: background 160ms ease-out, transform 160ms ease-out;
      width: fit-content;
      font-weight: 600;
      justify-self: start;
    }
    .gpt5sl-btn:hover,
    .gpt5sl-btn:focus-visible {
      background: var(--gpt5c-primary-hover);
      transform: translateY(-1px);
      outline: none;
      box-shadow: 0 4px 8px rgba(0,0,0,0.15);
    }

    /* Nav buttons */
    .gpt5sl-nav {
      position: absolute;
      top: 50%;
      transform: translateY(-50%);
      width: 56px;
      height: 56px;
      border-radius: 9999px;
      background: rgba(255,255,255,0.9);
      border: 1px solid #e5e7eb;
      color: var(--ui-muted);
      display: grid;
      place-items: center;
      cursor: pointer;
      transition: color 160ms ease-out, background 160ms ease-out, border-color 160ms ease-out;
      z-index: 5;
    }

    .gpt5sl-nav--prev { left: 8px; }
    .gpt5sl-nav--next { right: 8px; }

    /* Pagination dots */
    .gpt5sl-pagination {
      display: flex;
      gap: 8px;
      justify-content: center;
      align-items: center;
      margin-top: 12px;
    }
    .gpt5sl-dot {
      width: 8px;
      height: 8px;
      border-radius: 9999px;
      background: var(--ui-muted);
      opacity: 0.6;
      border: none;
      padding: 0;
      cursor: pointer;
      transition: opacity 160ms ease-out, background 160ms ease-out, transform 160ms ease-out;
    }
    .gpt5sl-dot[aria-selected="true"] {
      background: var(--dot-active);
      opacity: 1;
      transform: scale(1.1);
    }
    .gpt5sl-dot:focus-visible { box-shadow: var(--focus-ring); outline: none; }

    .visually-hidden {
      position: absolute !important;
      height: 1px; width: 1px;
      overflow: hidden;
      clip: rect(1px, 1px, 1px, 1px);
      white-space: nowrap;
    }

    /* Responsive tweaks */
    @media (min-width: 640px) {
      .gpt5sl-slider {
        padding: 20px;
      }
      
      .gpt5sl-media {
        aspect-ratio: 16 / 10;
      }
      
      .gpt5sl-content {
        padding: 24px;
        gap: 10px;
        display: grid;
        grid-template-columns: 1fr auto;
        grid-template-areas: 
          "title title"
          "desc desc"
          "button .";
        align-items: end;
      }
      
      .gpt5sl-title { 
        font-size: 1.375rem;
        grid-area: title;
      }
      
      .gpt5sl-desc {
        grid-area: desc;
      }
      
      .gpt5sl-btn { 
        padding: 12px 18px;
        grid-area: button;
      }
      
      .gpt5sl-nav--prev { left: 12px; }
      .gpt5sl-nav--next { right: 12px; }
    }
    
    @media (min-width: 1024px) {
      .gpt5sl-slider {
        padding: 32px;
      }
      
      .gpt5sl-slide {
        display: block;
      }
      
      .gpt5sl-media {
        aspect-ratio: 16 / 9;
      }
      
      .gpt5sl-content {
        position: absolute;
        left: 40px;
        right: 40px;
        bottom: 40px;
        padding: 32px;
        gap: 16px;
        display: grid;
        grid-template-columns: 1fr auto;
        grid-template-areas: 
          "title button"
          "desc button";
        align-items: center;
        background: rgba(255,255,255,0.4);
        box-shadow: 0 4px 16px rgba(0,0,0,0.1);
      }
      
      .gpt5sl-title { 
        font-size: 1.5rem;
        grid-area: title;
        align-self: end;
      }
      
      .gpt5sl-desc {
        font-size: 1rem;
        grid-area: desc;
        align-self: start;
      }
      
      .gpt5sl-btn { 
        padding: 14px 20px; 
        font-size: 1rem;
        grid-area: button;
        align-self: center;
      }
      
      .gpt5sl-nav--prev { left: 20px; }
      .gpt5sl-nav--next { right: 20px; }
    }

    /* ============================= */
    /* Hero-style slider (gpt5hs-*)  */
    /* ============================= */
    .gpt5hs-section {
      margin: 80px auto;
      padding: 0 40px;
      box-sizing: border-box;
    }
    .gpt5hs-grid {
      display: grid;
      grid-template-columns: 1fr;
      gap: 24px;
      align-items: center;
    }
    @media (min-width: 1024px) {
      .gpt5hs-grid { grid-template-columns: 1fr 1.2fr; }
    }

    .gpt5hs-copy { color: #111111; align-self: center; }
    .gpt5hs-eyebrow {
      color: #16a34a;
      font-weight: 800;
      letter-spacing: 0.06em;
      margin: 0 0 10px 0;
    }
    .gpt5hs-headline {
      font-size: clamp(1.8rem, 2.8vw + 1rem, 3rem);
      line-height: 1.15;
      margin: 0 0 8px 0;
      color: #0f172a;
      font-weight: 800;
      position: relative;
    }
    .gpt5hs-headline::after {
      content: "";
      display: block;
      width: 64px;
      height: 4px;
      background: #16a34a;
      margin-top: 12px;
      border-radius: 2px;
    }
    .gpt5hs-body { color: #111111; line-height: 1.9; margin: 10px 0 0 0; font-weight: 600; }

    .gpt5hs-slider { position: relative; padding-bottom: 88px; }
    .gpt5hs-viewport {
      overflow: hidden;
      position: relative;
      border-radius: 24px;
    }
    .gpt5hs-track {
      display: flex;
      will-change: transform;
      touch-action: pan-y;
      -webkit-user-select: none;
      user-select: none;
      transform: translate3d(0,0,0);
      transition: transform 450ms ease-out;
      margin: 0;
      padding: 0;
      list-style: none;
    }
    .gpt5hs-slide { flex: 0 0 100%; min-width: 100%; }
    .gpt5hs-media { width: 100%; aspect-ratio: 16 / 9; background: #f3f4f6; }
    .gpt5hs-media img {
      width: 100%; height: 100%; object-fit: cover; display: block; border-radius: 24px;
      -webkit-user-drag: none; user-drag: none; pointer-events: none;
    }

    /* Nav buttons outside image bottom-right of slider */
    .gpt5hs-nav {
      position: absolute;
      bottom: 16px;
      width: 56px; height: 56px; border-radius: 9999px;
      background: #16a34a;
      border: none;
      color: #ffffff;
      display: grid; place-items: center;
      cursor: pointer;
      z-index: 5;
    }
    .gpt5hs-nav:hover,
    .gpt5hs-nav:focus-visible {
      background: #15803d;
      outline: none;
      box-shadow: none;
    }
    .gpt5hs-nav--next { right: 16px; }
    .gpt5hs-nav--prev { right: 88px; }

    /* Bottom-left caption outside image (no overlay box) */
    .gpt5hs-caption {
      position: absolute; left: 16px; bottom: 16px; z-index: 3;
      color: #111111;
      text-shadow: none;
    }
    .gpt5hs-cap-eyebrow { font-weight: 800; letter-spacing: .08em; font-size: .9rem; color: #16a34a; }
    .gpt5hs-cap-title { font-size: 1.25rem; font-weight: 800; margin-top: 4px; color: #0f172a; }
  </style>
</head>
<body <?php body_class('gpt5tls-body'); ?>>

  <!-- ECサイト風全幅スライダー -->
  <section class="gpt5c-slider" role="region" aria-label="商品カルーセル" tabindex="0">
    <div class="gpt5c-viewport" id="gpt5c-viewport">
      <div class="gpt5c-track" id="gpt5c-track">
        
        <article class="gpt5c-card">
          <div class="gpt5c-image">
            <img src="https://picsum.photos/id/1/400/300" alt="ワイヤレスヘッドホン" loading="eager" fetchpriority="high">
            <div class="gpt5c-badge">NEW</div>
          </div>
          <div class="gpt5c-caption">
            <p class="gpt5c-subtitle">高音質・ノイズキャンセリング搭載</p>
            <h3 class="gpt5c-title">ワイヤレスヘッドホン</h3>
          </div>
        </article>

        <article class="gpt5c-card">
          <div class="gpt5c-image">
            <img src="https://picsum.photos/id/2/400/300" alt="スマートウォッチ" loading="lazy">
          </div>
          <div class="gpt5c-caption">
            <p class="gpt5c-subtitle">健康管理・フィットネス機能充実</p>
            <h3 class="gpt5c-title">スマートウォッチ</h3>
          </div>
        </article>

        <article class="gpt5c-card">
          <div class="gpt5c-image">
            <img src="https://picsum.photos/id/3/400/300" alt="ワイヤレス充電器" loading="lazy">
          </div>
          <div class="gpt5c-caption">
            <p class="gpt5c-subtitle">Qi対応・高速充電</p>
            <h3 class="gpt5c-title">ワイヤレス充電器</h3>
          </div>
        </article>

        <article class="gpt5c-card">
          <div class="gpt5c-image">
            <img src="https://picsum.photos/id/4/400/300" alt="Bluetoothスピーカー" loading="lazy">
          </div>
          <div class="gpt5c-caption">
            <p class="gpt5c-subtitle">360度サウンド・防水仕様</p>
            <h3 class="gpt5c-title">Bluetoothスピーカー</h3>
          </div>
        </article>

        <article class="gpt5c-card">
          <div class="gpt5c-image">
            <img src="https://picsum.photos/id/5/400/300" alt="モバイルバッテリー" loading="lazy">
            <div class="gpt5c-badge">NEW</div>
          </div>
          <div class="gpt5c-caption">
            <p class="gpt5c-subtitle">大容量10000mAh・急速充電対応</p>
            <h3 class="gpt5c-title">モバイルバッテリー</h3>
          </div>
        </article>

        <article class="gpt5c-card">
          <div class="gpt5c-image">
            <img src="https://picsum.photos/id/6/400/300" alt="Webカメラ" loading="lazy">
          </div>
          <div class="gpt5c-caption">
            <p class="gpt5c-subtitle">4K画質・オートフォーカス機能</p>
            <h3 class="gpt5c-title">Webカメラ</h3>
          </div>
        </article>

        <article class="gpt5c-card">
          <div class="gpt5c-image">
            <img src="https://picsum.photos/id/7/400/300" alt="タブレット" loading="lazy">
            <div class="gpt5c-badge">NEW</div>
          </div>
          <div class="gpt5c-caption">
            <p class="gpt5c-subtitle">10.9インチ・高解像度ディスプレイ</p>
            <h3 class="gpt5c-title">タブレット</h3>
          </div>
        </article>

        <article class="gpt5c-card">
          <div class="gpt5c-image">
            <img src="https://picsum.photos/id/8/400/300" alt="キーボード" loading="lazy">
          </div>
          <div class="gpt5c-caption">
            <p class="gpt5c-subtitle">バックライト搭載・静音設計</p>
            <h3 class="gpt5c-title">ワイヤレスキーボード</h3>
          </div>
        </article>

        <article class="gpt5c-card">
          <div class="gpt5c-image">
            <img src="https://picsum.photos/id/9/400/300" alt="マウス" loading="lazy">
          </div>
          <div class="gpt5c-caption">
            <p class="gpt5c-subtitle">疲労軽減・高精度センサー</p>
            <h3 class="gpt5c-title">エルゴノミクスマウス</h3>
          </div>
        </article>

        <article class="gpt5c-card">
          <div class="gpt5c-image">
            <img src="https://picsum.photos/id/10/400/300" alt="モニター" loading="lazy">
          </div>
          <div class="gpt5c-caption">
            <p class="gpt5c-subtitle">27インチ・HDR対応</p>
            <h3 class="gpt5c-title">4Kモニター</h3>
          </div>
        </article>

        <article class="gpt5c-card">
          <div class="gpt5c-image">
            <img src="https://picsum.photos/id/11/400/300" alt="プリンター" loading="lazy">
            <div class="gpt5c-badge">NEW</div>
          </div>
          <div class="gpt5c-caption">
            <p class="gpt5c-subtitle">Wi-Fi対応・自動両面印刷</p>
            <h3 class="gpt5c-title">多機能プリンター</h3>
          </div>
        </article>

        <article class="gpt5c-card">
          <div class="gpt5c-image">
            <img src="https://picsum.photos/id/12/400/300" alt="外付けSSD" loading="lazy">
          </div>
          <div class="gpt5c-caption">
            <p class="gpt5c-subtitle">1TB・超高速転送</p>
            <h3 class="gpt5c-title">ポータブルSSD</h3>
          </div>
        </article>

      </div>
    </div>

    <button class="gpt5c-nav gpt5c-nav--prev" type="button" aria-label="前のスライド" aria-controls="gpt5c-track">
      <svg width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
        <path d="M15 19L8 12L15 5" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
      </svg>
    </button>
    
    <button class="gpt5c-nav gpt5c-nav--next" type="button" aria-label="次のスライド" aria-controls="gpt5c-track">
      <svg width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
        <path d="M9 5L16 12L9 19" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
      </svg>
    </button>

    <div class="gpt5c-pagination" role="tablist" aria-label="スライドページネーション" id="gpt5c-pagination"></div>
    
    <div class="gpt5c-sr-only" aria-live="polite" id="gpt5c-status" aria-atomic="true"></div>
  </section>

  <main class="gpt5sl-slider" role="region" aria-roledescription="carousel" aria-label="プロモーションスライダー" aria-live="off" tabindex="0">
    <div class="gpt5sl-viewport" id="gpt5sl-viewport">
      <ul class="gpt5sl-track" id="gpt5sl-track" aria-atomic="false" aria-live="off">
        <li class="gpt5sl-slide" data-real-index="0" id="gpt5sl-slide-1" role="group" aria-roledescription="slide" aria-label="1 / 3">
          <div class="gpt5sl-media" aria-hidden="true">
            <img src="https://picsum.photos/id/1015/1280/720" alt="商品A" loading="eager" fetchpriority="high" />
          </div>
          <div class="gpt5sl-content">
            <h3 class="gpt5sl-title">商品A</h3>
            <p class="gpt5sl-desc">最新のデザインと機能性を両立した商品です。</p>
            <a class="gpt5sl-btn" href="#">詳しく見る</a>
          </div>
        </li>
        <li class="gpt5sl-slide" data-real-index="1" id="gpt5sl-slide-2" role="group" aria-roledescription="slide" aria-label="2 / 3">
          <div class="gpt5sl-media" aria-hidden="true">
            <img src="https://picsum.photos/id/1025/1280/720" alt="サービスB" loading="lazy" />
          </div>
          <div class="gpt5sl-content">
            <h3 class="gpt5sl-title">サービスB</h3>
            <p class="gpt5sl-desc">お客様の課題を解決する、革新的なソリューションをご提供します。</p>
            <a class="gpt5sl-btn" href="#">サービス詳細へ</a>
          </div>
        </li>
        <li class="gpt5sl-slide" data-real-index="2" id="gpt5sl-slide-3" role="group" aria-roledescription="slide" aria-label="3 / 3">
          <div class="gpt5sl-media" aria-hidden="true">
            <img src="https://picsum.photos/id/1005/1280/720" alt="お知らせC" loading="lazy" />
          </div>
          <div class="gpt5sl-content">
            <h3 class="gpt5sl-title">お知らせC</h3>
            <p class="gpt5sl-desc">期間限定のキャンペーンを実施中です。詳細はこちらから。</p>
            <a class="gpt5sl-btn" href="#">キャンペーンページへ</a>
          </div>
        </li>
      </ul>
    </div>

    <button class="gpt5sl-nav gpt5sl-nav--prev" type="button" aria-label="前のスライド" aria-controls="gpt5sl-track" data-action="prev" title="前へ">
      <svg width="18" height="18" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" aria-hidden="true"><path d="M15 19L8 12L15 5" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
    </button>
    <button class="gpt5sl-nav gpt5sl-nav--next" type="button" aria-label="次のスライド" aria-controls="gpt5sl-track" data-action="next" title="次へ">
      <svg width="18" height="18" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" aria-hidden="true"><path d="M9 5L16 12L9 19" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
    </button>

    <div class="gpt5sl-pagination" role="tablist" aria-label="スライドのページネーション" id="gpt5sl-pagination"></div>
    <p class="visually-hidden" aria-live="polite" id="gpt5sl-status" aria-atomic="true"></p>
  </main>

  <section class="gpt5hs-section" aria-label="ヒーロースライダーセクション">
    <div class="gpt5hs-grid">
      <div class="gpt5hs-copy">
        <p class="gpt5hs-eyebrow">RECOMMEND</p>
        <h2 class="gpt5hs-headline">地域と住環境</h2>
        <p class="gpt5hs-body">成長に合わせて暮らしをつくる。家も街も、これからが楽しみ。</p>
      </div>
      <div class="gpt5hs-slider" role="region" aria-roledescription="carousel" aria-label="ヒーロースライダー" aria-live="off" tabindex="0">
        <div class="gpt5hs-viewport" id="gpt5hs-viewport">
          <ul class="gpt5hs-track" id="gpt5hs-track" aria-atomic="false" aria-live="off">
            <li class="gpt5hs-slide" aria-roledescription="slide" aria-label="1 / 3" data-eyebrow="RECOMMEND" data-title="移住ステップ">
              <div class="gpt5hs-media"><img src="https://picsum.photos/seed/house-1/1280/720" alt="住宅街の風景1" loading="eager" fetchpriority="high" referrerpolicy="no-referrer"></div>
            </li>
            <li class="gpt5hs-slide" aria-roledescription="slide" aria-label="2 / 3" data-eyebrow="NEWS" data-title="新プロジェクト">
              <div class="gpt5hs-media"><img src="https://picsum.photos/seed/house-2/1280/720" alt="住宅街の風景2" loading="lazy" referrerpolicy="no-referrer"></div>
            </li>
            <li class="gpt5hs-slide" aria-roledescription="slide" aria-label="3 / 3" data-eyebrow="COLUMN" data-title="住まいの知恵">
              <div class="gpt5hs-media"><img src="https://picsum.photos/seed/house-3/1280/720" alt="住宅街の風景3" loading="lazy" referrerpolicy="no-referrer"></div>
            </li>
          </ul>
        </div>
        <button class="gpt5hs-nav gpt5hs-nav--prev" type="button" aria-label="前のスライド" aria-controls="gpt5hs-track">
          <svg width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" aria-hidden="true"><path d="M15 19L8 12L15 5" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
        </button>
        <button class="gpt5hs-nav gpt5hs-nav--next" type="button" aria-label="次のスライド" aria-controls="gpt5hs-track">
          <svg width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" aria-hidden="true"><path d="M9 5L16 12L9 19" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
        </button>
        <div class="gpt5hs-caption" id="gpt5hs-caption" aria-hidden="true">
          <div class="gpt5hs-cap-eyebrow">RECOMMEND</div>
          <div class="gpt5hs-cap-title">移住ステップ</div>
        </div>
        <p class="visually-hidden" aria-live="polite" id="gpt5hs-status" aria-atomic="true"></p>
      </div>
    </div>
  </section>

  <!-- ECサイト風スライダーJS -->
  <script>
    (function() {
      'use strict';

      const GPT5C_AUTO_INTERVAL = 3500;
      const GPT5C_TRANSITION_MS = 350;
      const GPT5C_SWIPE_THRESHOLD = 0.2;

      const gpt5cSlider = document.querySelector('.gpt5c-slider');
      const gpt5cViewport = document.getElementById('gpt5c-viewport');
      const gpt5cTrack = document.getElementById('gpt5c-track');
      const gpt5cPrevBtn = document.querySelector('.gpt5c-nav--prev');
      const gpt5cNextBtn = document.querySelector('.gpt5c-nav--next');
      const gpt5cPagination = document.getElementById('gpt5c-pagination');
      const gpt5cStatus = document.getElementById('gpt5c-status');

      if (!gpt5cSlider || !gpt5cViewport || !gpt5cTrack) return;

      const gpt5cOriginalCards = Array.from(gpt5cTrack.children);
      const gpt5cTotalCards = gpt5cOriginalCards.length;
      
      if (gpt5cTotalCards === 0) return;

      gpt5cOriginalCards.forEach(card => {
        const img = card.querySelector('img');
        if (img) {
          img.setAttribute('draggable', 'false');
          img.style.pointerEvents = 'none';
        }
      });

      // Create multiple clones based on max visible count (PC: 4, TB: 2, SP: 1)
      const gpt5cMaxVisibleCount = 4; // Maximum cards that can be visible at once
      
      // Create leading clones (last cards at beginning)
      for (let i = 0; i < gpt5cMaxVisibleCount; i++) {
        const sourceIndex = gpt5cTotalCards - gpt5cMaxVisibleCount + i;
        const clone = gpt5cOriginalCards[sourceIndex].cloneNode(true);
        clone.setAttribute('data-gpt5c-clone', 'leading');
        clone.removeAttribute('id');
        gpt5cTrack.insertBefore(clone, gpt5cTrack.firstChild);
      }
      
      // Create trailing clones (first cards at end)
      for (let i = 0; i < gpt5cMaxVisibleCount; i++) {
        const clone = gpt5cOriginalCards[i].cloneNode(true);
        clone.setAttribute('data-gpt5c-clone', 'trailing');
        clone.removeAttribute('id');
        gpt5cTrack.appendChild(clone);
      }

      let gpt5cCurrentIndex = gpt5cMaxVisibleCount; // Start after leading clones
      let gpt5cIsAnimating = false;
      let gpt5cAutoTimer = null;
      let gpt5cVisibleCount = 1;
      let gpt5cCardWidth = 0;
      let gpt5cGap = 0;

      function gpt5cCalculateLayout() {
        const viewportRect = gpt5cViewport.getBoundingClientRect();
        const viewportWidth = viewportRect.width;

        if (viewportWidth < 600) {
          gpt5cVisibleCount = 1;
          gpt5cGap = 16;
        } else if (viewportWidth < 960) {
          gpt5cVisibleCount = 2;
          gpt5cGap = 20;
        } else {
          gpt5cVisibleCount = 4;
          gpt5cGap = 24;
        }

        // Edge case: Few items handling
        const shouldHideNav = gpt5cTotalCards <= 1;
        const shouldCenterFewItems = gpt5cTotalCards < gpt5cVisibleCount;

        gpt5cSlider.setAttribute('data-gpt5c-hide-nav', shouldHideNav.toString());
        gpt5cTrack.setAttribute('data-gpt5c-few-items', shouldCenterFewItems.toString());

        const totalGapWidth = (gpt5cVisibleCount - 1) * gpt5cGap;
        const peekWidth = viewportWidth >= 960 && !shouldCenterFewItems ? 40 : 0;
        gpt5cCardWidth = (viewportWidth - totalGapWidth - peekWidth) / gpt5cVisibleCount;

        const allCards = gpt5cTrack.children;
        for (let i = 0; i < allCards.length; i++) {
          allCards[i].style.width = gpt5cCardWidth + 'px';
          allCards[i].style.marginRight = (i === allCards.length - 1) ? '0' : gpt5cGap + 'px';
        }
      }

      function gpt5cBuildPagination() {
        gpt5cPagination.innerHTML = '';
        
        if (gpt5cTotalCards <= 1) return;

        for (let i = 0; i < gpt5cTotalCards; i++) {
          const dot = document.createElement('button');
          dot.type = 'button';
          dot.className = 'gpt5c-dot';
          dot.setAttribute('role', 'tab');
          dot.setAttribute('aria-label', `${i + 1}番目のアイテムへ移動`);
          dot.setAttribute('aria-selected', i === 0 ? 'true' : 'false');
          dot.addEventListener('click', () => gpt5cGoTo(i + gpt5cMaxVisibleCount));
          gpt5cPagination.appendChild(dot);
        }
      }

      function gpt5cUpdateUI() {
        const realIndex = gpt5cGetRealIndex(gpt5cCurrentIndex);
        
        // Ensure realIndex is valid (0-11 for 12 cards)
        const validRealIndex = Math.max(0, Math.min(realIndex, gpt5cTotalCards - 1));
        
        const dots = gpt5cPagination.querySelectorAll('.gpt5c-dot');
        dots.forEach((dot, i) => {
          dot.setAttribute('aria-selected', i === validRealIndex ? 'true' : 'false');
        });

        gpt5cStatus.textContent = `${validRealIndex + 1} / ${gpt5cTotalCards}`;
      }

      function gpt5cGetRealIndex(index) {
        // Convert absolute index to real card index (0-based)
        const realIndex = index - gpt5cMaxVisibleCount;
        
        // Handle boundary cases for seamless loop
        if (realIndex < 0) {
          return gpt5cTotalCards + realIndex; // negative offset from end
        } else if (realIndex >= gpt5cTotalCards) {
          return realIndex - gpt5cTotalCards; // positive offset from start
        }
        
        return realIndex;
      }

      function gpt5cSetTransition(enabled) {
        const prefersReduced = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
        const duration = prefersReduced ? 0 : (enabled ? GPT5C_TRANSITION_MS : 0);
        gpt5cTrack.style.transition = `transform ${duration}ms ease-out`;
      }

      function gpt5cTranslateToIndex(index) {
        const offset = -(index * (gpt5cCardWidth + gpt5cGap));
        gpt5cTrack.style.transform = `translate3d(${offset}px, 0, 0)`;
      }

      function gpt5cGoTo(index) {
        if (gpt5cIsAnimating) return;
        
        gpt5cIsAnimating = true;
        gpt5cCurrentIndex = index;
        gpt5cSetTransition(true);
        gpt5cTranslateToIndex(gpt5cCurrentIndex);
      }

      function gpt5cNext() {
        const maxIndex = gpt5cMaxVisibleCount + gpt5cTotalCards + gpt5cMaxVisibleCount - 1;
        if (gpt5cCurrentIndex < maxIndex) {
          gpt5cGoTo(gpt5cCurrentIndex + 1);
        }
      }

      function gpt5cPrev() {
        if (gpt5cCurrentIndex > 0) {
          gpt5cGoTo(gpt5cCurrentIndex - 1);
        }
      }

      function gpt5cStartAutoPlay() {
        gpt5cStopAutoPlay();
        if (gpt5cTotalCards > 1) {
          gpt5cAutoTimer = setInterval(gpt5cNext, GPT5C_AUTO_INTERVAL);
        }
      }

      function gpt5cStopAutoPlay() {
        if (gpt5cAutoTimer) {
          clearInterval(gpt5cAutoTimer);
          gpt5cAutoTimer = null;
        }
      }

      function gpt5cHandleTransitionEnd() {
        const totalElements = gpt5cTotalCards + (gpt5cMaxVisibleCount * 2);
        
        // If we're in the leading clone area (before real cards)
        if (gpt5cCurrentIndex < gpt5cMaxVisibleCount) {
          gpt5cCurrentIndex = gpt5cTotalCards + gpt5cCurrentIndex;
          gpt5cSetTransition(false);
          gpt5cTranslateToIndex(gpt5cCurrentIndex);
        }
        // If we're in the trailing clone area (after real cards)
        else if (gpt5cCurrentIndex >= gpt5cMaxVisibleCount + gpt5cTotalCards) {
          gpt5cCurrentIndex = gpt5cCurrentIndex - gpt5cTotalCards;
          gpt5cSetTransition(false);
          gpt5cTranslateToIndex(gpt5cCurrentIndex);
        }
        
        gpt5cIsAnimating = false;
        gpt5cUpdateUI();
      }

      function gpt5cInit() {
        gpt5cCalculateLayout();
        gpt5cBuildPagination();
        gpt5cSetTransition(false);
        gpt5cTranslateToIndex(gpt5cCurrentIndex);
        gpt5cUpdateUI();
        
        const firstImg = gpt5cOriginalCards[0]?.querySelector('img');
        const imgReady = firstImg && firstImg.decode ? 
          firstImg.decode().catch(() => {}) : Promise.resolve();
        
        const windowReady = new Promise(resolve => {
          if (document.readyState === 'complete') {
            resolve();
          } else {
            window.addEventListener('load', resolve, { once: true });
          }
        });

        Promise.all([imgReady, windowReady]).then(() => {
          gpt5cStartAutoPlay();
        });
      }

      gpt5cTrack.addEventListener('transitionend', gpt5cHandleTransitionEnd);

      if (gpt5cPrevBtn) {
        gpt5cPrevBtn.addEventListener('click', () => {
          gpt5cStopAutoPlay();
          gpt5cPrev();
          gpt5cStartAutoPlay();
        });
      }

      if (gpt5cNextBtn) {
        gpt5cNextBtn.addEventListener('click', () => {
          gpt5cStopAutoPlay();
          gpt5cNext();
          gpt5cStartAutoPlay();
        });
      }

      gpt5cSlider.addEventListener('mouseenter', gpt5cStopAutoPlay);
      gpt5cSlider.addEventListener('mouseleave', gpt5cStartAutoPlay);

      gpt5cSlider.addEventListener('keydown', (e) => {
        if (e.key === 'ArrowRight') {
          e.preventDefault();
          gpt5cStopAutoPlay();
          gpt5cNext();
          gpt5cStartAutoPlay();
        } else if (e.key === 'ArrowLeft') {
          e.preventDefault();
          gpt5cStopAutoPlay();
          gpt5cPrev();
          gpt5cStartAutoPlay();
        }
      });

      let gpt5cIsDragging = false;
      let gpt5cDragStartX = 0;
      let gpt5cDragStartTransform = 0;

      function gpt5cGetCurrentTransform() {
        return -(gpt5cCurrentIndex * (gpt5cCardWidth + gpt5cGap));
      }

      gpt5cViewport.addEventListener('pointerdown', (e) => {
        if (e.pointerType === 'mouse' && e.button !== 0) return;
        
        gpt5cIsDragging = true;
        gpt5cStopAutoPlay();
        gpt5cSetTransition(false);
        gpt5cDragStartX = e.clientX;
        gpt5cDragStartTransform = gpt5cGetCurrentTransform();
        gpt5cViewport.setPointerCapture(e.pointerId);
      });

      window.addEventListener('pointermove', (e) => {
        if (!gpt5cIsDragging) return;
        
        const deltaX = e.clientX - gpt5cDragStartX;
        const newTransform = gpt5cDragStartTransform + deltaX;
        gpt5cTrack.style.transform = `translate3d(${newTransform}px, 0, 0)`;
      });

      window.addEventListener('pointerup', (e) => {
        if (!gpt5cIsDragging) return;
        
        gpt5cIsDragging = false;
        
        try {
          gpt5cViewport.releasePointerCapture(e.pointerId);
        } catch (ex) {
          // Ignore capture release errors during rapid interactions
        }
        
        const deltaX = e.clientX - gpt5cDragStartX;
        const threshold = gpt5cCardWidth * GPT5C_SWIPE_THRESHOLD;
        
        if (Math.abs(deltaX) < 5) {
          // Treat as click, not swipe
          gpt5cSetTransition(true);
          gpt5cTranslateToIndex(gpt5cCurrentIndex);
          gpt5cIsAnimating = false;
        } else if (deltaX < -threshold) {
          gpt5cNext();
        } else if (deltaX > threshold) {
          gpt5cPrev();
        } else {
          gpt5cSetTransition(true);
          gpt5cTranslateToIndex(gpt5cCurrentIndex);
          gpt5cIsAnimating = false;
        }
        
        gpt5cStartAutoPlay();
      });

      let gpt5cResizeTimeout;
      window.addEventListener('resize', () => {
        clearTimeout(gpt5cResizeTimeout);
        gpt5cResizeTimeout = setTimeout(() => {
          gpt5cCalculateLayout();
          gpt5cSetTransition(false);
          gpt5cTranslateToIndex(gpt5cCurrentIndex);
        }, 100);
      });

      gpt5cInit();
    })();
  </script>

  <script>
    (function() {
      'use strict';

      const AUTO_PLAY_INTERVAL_MS = 3000;
      const TRANSITION_MS = 450;

      const root = document.querySelector('.gpt5sl-slider');
      const viewport = document.getElementById('gpt5sl-viewport');
      const track = document.getElementById('gpt5sl-track');
      const status = document.getElementById('gpt5sl-status');
      const pagination = document.getElementById('gpt5sl-pagination');
      const prevBtn = document.querySelector('.gpt5sl-nav--prev');
      const nextBtn = document.querySelector('.gpt5sl-nav--next');

      if (!root || !viewport || !track) { return; }

      // Prepare slides and clones for seamless loop
      const originalSlides = Array.from(track.children);
      const numRealSlides = originalSlides.length;
      if (numRealSlides === 0) { return; }

      // Disable image drag ghost
      originalSlides.forEach(slide => {
        const img = slide.querySelector('img');
        if (img) { img.setAttribute('draggable', 'false'); }
      });

      const firstClone = originalSlides[0].cloneNode(true);
      const lastClone = originalSlides[numRealSlides - 1].cloneNode(true);
      firstClone.setAttribute('data-clone', 'true');
      lastClone.setAttribute('data-clone', 'true');
      // Avoid duplicate IDs from clones
      firstClone.removeAttribute('id');
      lastClone.removeAttribute('id');

      track.insertBefore(lastClone, originalSlides[0]);
      track.appendChild(firstClone);

      let currentIndex = 1; // start at first real slide (after lastClone)
      let isAnimating = false;
      let autoTimer = null;

      // Build pagination dots
      const dots = [];
      for (let i = 0; i < numRealSlides; i++) {
        const dot = document.createElement('button');
        dot.type = 'button';
        dot.className = 'gpt5sl-dot';
        dot.setAttribute('role', 'tab');
        dot.setAttribute('aria-label', (i + 1) + '枚目へ');
        dot.setAttribute('aria-selected', i === 0 ? 'true' : 'false');
        dot.addEventListener('click', () => goTo(i + 1));
        pagination.appendChild(dot);
        dots.push(dot);
      }

      function announce(index) {
        const realIndex = realIndexFrom(index);
        status.textContent = (realIndex + 1) + ' / ' + numRealSlides + ' を表示中';
      }

      function realIndexFrom(index) {
        // index includes clones at 0 and numRealSlides+1
        if (index === 0) return numRealSlides - 1;
        if (index === numRealSlides + 1) return 0;
        return index - 1;
      }

      function setTransition(enabled) {
        track.style.transition = enabled ? 'transform ' + TRANSITION_MS + 'ms ease-out' : 'none';
      }

      function updateDots(index) {
        const ri = realIndexFrom(index);
        dots.forEach((d, i) => d.setAttribute('aria-selected', i === ri ? 'true' : 'false'));
      }

      function getViewportWidth() {
        // Use fractional width to avoid sub-pixel rounding that shows next slide
        const rect = viewport.getBoundingClientRect();
        return rect.width;
      }

      function translateToIndex(index, withTransition) {
        const width = getViewportWidth();
        setTransition(!!withTransition);
        track.style.transform = 'translate3d(' + (-index * width) + 'px, 0, 0)';
      }

      function handleBoundaryAfterTransition() {
        // Jump seamlessly if we are on a clone
        if (currentIndex === 0) {
          currentIndex = numRealSlides;
          translateToIndex(currentIndex, false);
        } else if (currentIndex === numRealSlides + 1) {
          currentIndex = 1;
          translateToIndex(currentIndex, false);
        }
        isAnimating = false;
        updateDots(currentIndex);
        announce(currentIndex);
      }

      function goTo(index) {
        if (isAnimating) return;
        isAnimating = true;
        currentIndex = index;
        translateToIndex(currentIndex, true);
      }

      function next() { goTo(currentIndex + 1); }
      function prev() { goTo(currentIndex - 1); }

      function startAuto() {
        stopAuto();
        autoTimer = setInterval(next, AUTO_PLAY_INTERVAL_MS);
      }
      function stopAuto() {
        if (autoTimer) { clearInterval(autoTimer); autoTimer = null; }
      }

      // Initialize starting position
      translateToIndex(currentIndex, false);
      updateDots(currentIndex);
      announce(currentIndex);
      // Start autoplay only after first image and window are fully ready
      (function waitForFirstImageThenStart(){
        const firstImg = originalSlides[0] && originalSlides[0].querySelector('img');
        const imgReady = firstImg && firstImg.decode ? firstImg.decode().catch(()=>{}) : Promise.resolve();
        const winReady = new Promise((res)=>{
          if (document.readyState === 'complete') { res(); }
          else { window.addEventListener('load', res, { once: true }); }
        });
        Promise.all([imgReady, winReady]).then(() => {
          setTransition(false);
          translateToIndex(currentIndex, false);
          startAuto();
        });
      })();

      // Event wiring
      track.addEventListener('transitionend', handleBoundaryAfterTransition);
      nextBtn.addEventListener('click', () => { stopAuto(); next(); startAuto(); });
      prevBtn.addEventListener('click', () => { stopAuto(); prev(); startAuto(); });

      // Pause on hover/focus
      root.addEventListener('mouseenter', stopAuto);
      root.addEventListener('mouseleave', startAuto);
      root.addEventListener('focusin', stopAuto);
      root.addEventListener('focusout', startAuto);

      // Keyboard support
      root.addEventListener('keydown', (e) => {
        if (e.key === 'ArrowRight') { e.preventDefault(); stopAuto(); next(); startAuto(); }
        if (e.key === 'ArrowLeft') { e.preventDefault(); stopAuto(); prev(); startAuto(); }
      });

      // Drag/Swipe support via Pointer Events
      let isDragging = false;
      let dragStartX = 0;
      let dragStartTranslate = 0;

      function currentTranslatePx() {
        const width = getViewportWidth();
        return -currentIndex * width;
      }

      function onPointerDown(e) {
        if (e.pointerType === 'mouse' && e.button !== 0) return; // left click only
        isDragging = true;
        stopAuto();
        setTransition(false);
        dragStartX = e.clientX;
        dragStartTranslate = currentTranslatePx();
        track.setPointerCapture(e.pointerId);
      }

      function onPointerMove(e) {
        if (!isDragging) return;
        const delta = e.clientX - dragStartX;
        track.style.transform = 'translate3d(' + (dragStartTranslate + delta) + 'px, 0, 0)';
      }

      function onPointerUp(e) {
        if (!isDragging) return;
        isDragging = false;
        track.releasePointerCapture(e.pointerId);
        const delta = e.clientX - dragStartX;
        const threshold = getViewportWidth() * 0.2;
        if (delta < -threshold) { next(); }
        else if (delta > threshold) { prev(); }
        else { translateToIndex(currentIndex, true); isAnimating = false; }
        startAuto();
      }

      viewport.addEventListener('pointerdown', onPointerDown);
      window.addEventListener('pointermove', onPointerMove);
      window.addEventListener('pointerup', onPointerUp);

      // Resize recalculation keeps position consistent
      window.addEventListener('resize', () => {
        setTransition(false);
        translateToIndex(currentIndex, false);
      });
    })();
  </script>

  <script>
    (function() {
      'use strict';

      const AUTO_MS = 3000;
      const root = document.querySelector('.gpt5hs-slider');
      const viewport = document.getElementById('gpt5hs-viewport');
      const track = document.getElementById('gpt5hs-track');
      const pagination = null; // pagination disabled
      const status = document.getElementById('gpt5hs-status');
      const prevBtn = document.querySelector('.gpt5hs-nav--prev');
      const nextBtn = document.querySelector('.gpt5hs-nav--next');
      if (!root || !viewport || !track) return;

      const originalSlides = Array.from(track.children);
      const count = originalSlides.length;
      if (!count) return;

      // Prevent image drag ghost
      originalSlides.forEach(s => { const i = s.querySelector('img'); if (i) i.setAttribute('draggable','false'); });

      // Seamless clones
      const firstClone = originalSlides[0].cloneNode(true); firstClone.removeAttribute('id');
      const lastClone = originalSlides[count - 1].cloneNode(true); lastClone.removeAttribute('id');
      track.insertBefore(lastClone, originalSlides[0]);
      track.appendChild(firstClone);

      let index = 1;
      let isAnimating = false;
      let timer = null;

      const dots = [];

      function viewportWidth() { return viewport.getBoundingClientRect().width; }
      function setTransition(on) { track.style.transition = on ? 'transform 450ms ease-out' : 'none'; }
      function translate() { track.style.transform = 'translate3d(' + (-index * viewportWidth()) + 'px,0,0)'; }
      function real(i){ if(i===0) return count-1; if(i===count+1) return 0; return i-1; }
      function updateUI(){
        // caption
        const cap = document.getElementById('gpt5hs-caption');
        const ri = real(index);
        const slide = originalSlides[ri];
        if (cap && slide) {
          const eyebrow = slide.getAttribute('data-eyebrow') || '';
          const title = slide.getAttribute('data-title') || '';
          cap.querySelector('.gpt5hs-cap-eyebrow').textContent = eyebrow;
          cap.querySelector('.gpt5hs-cap-title').textContent = title;
        }
        status.textContent = (ri+1)+' / '+count+' を表示中';
      }

      function goTo(i){ if(isAnimating) return; isAnimating = true; index = i; setTransition(true); translate(); }
      function next(){ goTo(index+1); }
      function prev(){ goTo(index-1); }
      function start(){ stop(); timer = setInterval(next, AUTO_MS); }
      function stop(){ if(timer){ clearInterval(timer); timer=null; } }

      track.addEventListener('transitionend', ()=>{
        if(index===0){ index = count; setTransition(false); translate(); }
        else if(index===count+1){ index = 1; setTransition(false); translate(); }
        isAnimating = false; updateUI();
      });

      // Init: start only after first image is ready and window loaded
      setTransition(false); translate(); updateUI();
      (function waitForFirstImageThenStart(){
        const first = originalSlides[0] && originalSlides[0].querySelector('img');
        const imgReady = first && first.decode ? first.decode().catch(()=>{}) : Promise.resolve();
        const winReady = new Promise((res)=>{
          if (document.readyState === 'complete') { res(); }
          else { window.addEventListener('load', res, { once: true }); }
        });
        Promise.all([imgReady, winReady]).then(()=>{ setTransition(false); translate(); start(); });
      })();

      // Controls
      nextBtn.addEventListener('click', ()=>{ stop(); next(); start(); });
      prevBtn.addEventListener('click', ()=>{ stop(); prev(); start(); });
      root.addEventListener('mouseenter', stop);
      root.addEventListener('mouseleave', start);
      root.addEventListener('focusin', stop);
      root.addEventListener('focusout', start);
      root.addEventListener('keydown', (e)=>{
        if(e.key==='ArrowRight'){ e.preventDefault(); stop(); next(); start(); }
        else if(e.key==='ArrowLeft'){ e.preventDefault(); stop(); prev(); start(); }
      });

      // Drag/swipe
      let dragging=false, startX=0, startTx=0;
      function currentTx(){ return -index * viewportWidth(); }
      viewport.addEventListener('pointerdown', (e)=>{
        if(e.pointerType==='mouse' && e.button!==0) return;
        dragging=true; stop(); setTransition(false); startX=e.clientX; startTx=currentTx(); viewport.setPointerCapture(e.pointerId);
      });
      window.addEventListener('pointermove', (e)=>{ if(!dragging) return; const dx=e.clientX-startX; track.style.transform='translate3d('+(startTx+dx)+'px,0,0)'; });
      window.addEventListener('pointerup', (e)=>{
        if(!dragging) return; dragging=false; viewport.releasePointerCapture(e.pointerId);
        const dx=e.clientX-startX; const th=viewportWidth()*0.2;
        if(dx<-th) next(); else if(dx>th) prev(); else { setTransition(true); translate(); isAnimating=false; }
        start();
      });

      // Resize keep position
      window.addEventListener('resize', ()=>{ setTransition(false); translate(); });
    })();
  </script>

  <?php wp_footer(); ?>
</body>
</html>


