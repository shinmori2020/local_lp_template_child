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
    :root {
      --slider-bg: #ffffff;
      --slider-fg: #111111;
      --ui-muted: #a3a3a3;
      --ui-muted-hover: #6b7280;
      --dot-active: #4b5563;
      --focus-ring: 0 0 0 3px rgba(59,130,246,0.45);
      --transition-ms: 450ms;
    }

    .gpt5sl-slider {
      position: relative;
      background: var(--slider-bg);
      color: var(--slider-fg);
      max-width: 1200px;
      margin: 0 auto;
      padding: 16px;
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
      display: block;
      position: relative;
      background: #fff;
    }

    /* Media area with 16:9 aspect ratio */
    .gpt5sl-media {
      width: 100%;
      aspect-ratio: 16 / 9;
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
      position: absolute;
      left: 30px;
      bottom: 30px;
      z-index: 2;
      padding: 30px 30px;
      display: grid;
      gap: 10px;
      max-width: min(90%, 560px);
      background: rgba(255,255,255,0.6);
      color: #111111;
      border-radius: 0;
      box-shadow: 0 4px 16px rgba(0,0,0,0.05);
    }
    .gpt5sl-title {
      font-size: 1.375rem;
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
      background: rgba(255,255,255,0.8);
      color: #111827;
      text-decoration: none;
      border-radius: 0;
      border: 1px solid #6b7280;
      transition: background 160ms ease-out, color 160ms ease-out, border-color 160ms ease-out;
      width: fit-content;
    }
    .gpt5sl-btn:hover,
    .gpt5sl-btn:focus-visible {
      background: rgba(255,255,255,0.9);
      border-color: #4b5563;
      outline: none;
      box-shadow: none;
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

    .gpt5sl-nav--prev { left: 16px; }
    .gpt5sl-nav--next { right: 16px; }

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
      .gpt5sl-title { font-size: 1.5rem; }
      .gpt5sl-btn { padding: 12px 18px; }
    }
    @media (min-width: 1024px) {
      .gpt5sl-title { font-size: 1.75rem; }
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


