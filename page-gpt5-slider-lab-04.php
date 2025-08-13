<?php
/**
 * Template Name: GPT-5 Slider Lab 04（ビフォー/アフター比較）
 * Description: 2枚の画像の境界をドラッグして比較するスライダー。マウス/タッチ/キーボード対応・アクセシブル・バニラJS。
 * Template Post Type: page
 */

if (!defined('ABSPATH')) { exit; }
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
  <meta charset="<?php bloginfo('charset'); ?>" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title><?php bloginfo('name'); ?> | GPT-5 Slider Lab 04</title>
  <?php wp_head(); ?>
  <style>
    :root {
      --container: 1200px;
      --gutter: 24px;
      --radius: 16px;
      --border: #e6e8ea;
      --text: #222;
      --muted: #6b7280;
      --shadow: 0 2px 10px rgba(16,24,40,.08);
    }
    .gpt5slba-body {
      background: #ffffff;
      color: var(--text);
      font-family: system-ui, -apple-system, Segoe UI, Roboto, "Helvetica Neue", Arial, "Noto Sans JP", "Hiragino Kaku Gothic ProN", "Yu Gothic", Meiryo, sans-serif;
      -webkit-tap-highlight-color: transparent;
    }
    .gpt5slba-container { max-width: var(--container); margin: 0 auto; padding: 0 var(--gutter); }
    .gpt5slba-section { padding: 56px 0; }
    .gpt5slba-title { font-size: 28px; margin: 0 0 8px; font-weight: 800; letter-spacing: .01em; }
    .gpt5slba-desc { color: var(--muted); margin: 0 0 24px; }

    /* Before/After Slider (gpt5slba-) */
    .gpt5slba { position: relative; }
    .gpt5slba-viewport {
      position: relative;
      overflow: hidden;
      border-radius: var(--radius);
      border: 1px solid var(--border);
      background: #fff;
      box-shadow: 0 1px 2px rgba(16,24,40,.04);
      contain: layout paint size;
      /* Aspect ratio target for demo */
      aspect-ratio: 16/9;
      /* Fallback height when aspect-ratio not supported */
      height: auto;
    }
    .gpt5slba-figure { position: relative; width: 100%; height: 100%; margin: 0; }
    .gpt5slba-figure, .gpt5slba-figure * { user-select: none; -webkit-user-drag: none; }

    .gpt5slba-img { display: block; width: 100%; height: 100%; object-fit: cover; pointer-events: none; }
    .gpt5slba-base { position: absolute; inset: 0; }
    .gpt5slba-overlay { position: absolute; inset: 0; width: calc(var(--pos, 50) * 1%); overflow: hidden; }

    /* (labels removed per spec) */

    /* Handle */
    .gpt5slba-handle {
      position: absolute; top: 0; bottom: 0; left: calc(var(--pos, 50) * 1%);
      transform: translateX(-50%);
      width: 0; /* the bar itself is a pseudo element */
      outline: none;
      cursor: col-resize;
    }
    .gpt5slba-handle::before { /* vertical bar */
      content: ""; position: absolute; top: 0; bottom: 0; left: 50%; transform: translateX(-50%);
      width: 2px; background: rgba(17,17,17,.8);
      box-shadow: 0 0 0 1px rgba(255,255,255,.7);
    }
    .gpt5slba-handle::after { /* knob hidden per spec */
      content: none;
    }
    .gpt5slba-handle .gpt5slba-arrows { display: none; }

    /* Focus style for accessibility */
    .gpt5slba-handle:focus-visible { outline: 2px solid #111; outline-offset: 2px; }

    /* Reduced motion: no easing transition on position updates */
    @media (prefers-reduced-motion: reduce) {
      .gpt5slba-overlay, .gpt5slba-handle { transition: none !important; }
    }

    @media (max-width: 1024px) { .gpt5slba-section { padding: 48px 0; } }
    @media (max-width: 768px)  { .gpt5slba-section { padding: 40px 0; } }
  </style>
  <style>
    /* Multi-line Carousel (gpt5mlc-) */
    .gpt5mlc { position: relative; margin-top: 56px; }
    .gpt5mlc-viewport { position: relative; overflow: hidden; border-radius: 0; border: none; background: transparent; color: inherit; box-shadow: none; }
    .gpt5mlc-header { display: flex; align-items: center; justify-content: space-between; padding: 14px 16px; border-bottom: 1px solid #e5e7eb; background: linear-gradient(180deg, rgba(2,6,23,.02), rgba(2,6,23,0)); }
    .gpt5mlc-title { font-size: 16px; font-weight: 800; letter-spacing: .02em; margin: 0; color: #111827; }
    .gpt5mlc-ctrls { display: inline-flex; gap: 8px; }
    .gpt5mlc-btn { appearance: none; border: 1px solid #e5e7eb; background: #ffffff; color: #111827; padding: 6px 10px; border-radius: 10px; cursor: pointer; font-weight: 700; }
    .gpt5mlc-btn:hover { background: #f3f4f6; }
    .gpt5mlc-btn[disabled] { opacity: .4; cursor: default; }
    .gpt5mlc-body { position: relative; padding: 16px var(--gutter); }
    .gpt5mlc-track { display: flex; width: 100%; will-change: transform; transition: transform .38s cubic-bezier(.22,.61,.36,1); }
    .gpt5mlc-page { flex: 0 0 100%; padding-right: 4px; }
    .gpt5mlc-grid { display: grid; gap: 12px; }
    .gpt5mlc-card { position: relative; background: #ffffff; border: 1px solid #e5e7eb; border-radius: 12px; overflow: hidden; box-shadow: var(--shadow); }
    .gpt5mlc-media { aspect-ratio: 16/10; background: linear-gradient(135deg, #e2e8f0, #f1f5f9); }
    .gpt5mlc-content { padding: 10px 12px; }
    .gpt5mlc-card-title { margin: 0; font-size: 14px; font-weight: 800; color: #111827; }
    .gpt5mlc-card-sub { margin: 4px 0 0; font-size: 12px; color: #6b7280; }
    .gpt5mlc-dots { display: flex; gap: 6px; justify-content: center; padding: 10px 0 2px; }
    .gpt5mlc-dot { width: 6px; height: 6px; border-radius: 9999px; background: #e5e7eb; }
    .gpt5mlc-dot[aria-current="true"] { background: #2563eb; }
    /* Responsive rows/cols via CSS variables; JS syncs these for layout + paging */
    [data-gpt5mlc] { --rows: 2; --cols: 3; }
    @media (max-width: 1024px) { [data-gpt5mlc] { --rows: 2; --cols: 2; } }
    @media (max-width: 640px)  { [data-gpt5mlc] { --rows: 1; --cols: 1; } }
  </style>
  
</head>
<body <?php body_class('gpt5slba-body'); ?>>
  <main class="gpt5slba-container gpt5slba-section">
    <header style="margin-bottom:24px">
      <h1 class="gpt5slba-title">GPT-5 Slider Lab 04</h1>
      <p class="gpt5slba-desc">ビフォー/アフター比較（2枚画像の境界をドラッグ）。マウス/タッチ/キーボード対応、アクセシブル、バニラJS。</p>
    </header>

    <section class="gpt5slba" aria-roledescription="slider" aria-label="ビフォー/アフター比較スライダー" data-gpt5slba>
      <div class="gpt5slba-viewport" tabindex="-1">
        <figure class="gpt5slba-figure" role="group" aria-label="比較画像（自動ワイプ）">
          <!-- Base layer (current image) -->
          <div class="gpt5slba-base" aria-hidden="true">
            <img class="gpt5slba-img js-gpt5slba-img-a" alt="Slide A" src="" />
          </div>

          <!-- Overlay layer (next image, width clips by --pos) -->
          <div class="gpt5slba-overlay" style="--pos: 50" aria-hidden="true">
            <img class="gpt5slba-img js-gpt5slba-img-b" alt="Slide B" src="" />
          </div>

          <!-- Handle (ARIA slider) -->
          <div class="gpt5slba-handle" role="slider" aria-label="比較位置" aria-valuemin="0" aria-valuemax="100" aria-valuenow="50" tabindex="0">
            <div class="gpt5slba-arrows">
              <span class="gpt5slba-arrow gpt5slba-arrow--left"></span>
              <span class="gpt5slba-arrow gpt5slba-arrow--right"></span>
            </div>
          </div>
        </figure>
      </div>
    </section>
  </main>

  <!-- Multi-line Carousel (gpt5mlc) -->
  <section class="gpt5mlc gpt5slba-section" aria-label="マルチ行カルーセル" data-gpt5mlc>
    <div class="gpt5mlc-viewport">
      <div class="gpt5mlc-header">
        <h2 class="gpt5mlc-title">おすすめコンテンツ</h2>
        <div class="gpt5mlc-ctrls">
          <button type="button" class="gpt5mlc-btn js-gpt5mlc-prev" aria-label="前のページへ">Prev</button>
          <button type="button" class="gpt5mlc-btn js-gpt5mlc-next" aria-label="次のページへ">Next</button>
        </div>
      </div>
      <div class="gpt5mlc-body">
        <div class="gpt5mlc-track js-gpt5mlc-track" style="transform: translateX(0)"></div>
        <div class="gpt5mlc-dots js-gpt5mlc-dots" aria-hidden="true"></div>
      </div>
    </div>
  </section>

  


  <script>
  // Before/After Compare Slider (mouse/touch/keyboard), isolated by [data-gpt5slba]
  (function(){
    const roots = Array.from(document.querySelectorAll('[data-gpt5slba]'));
    if(!roots.length) return;

    roots.forEach((root) => {
      /** State */
      let percent = 100; // 0..100 position of wipe (start at right)
      let isDragging = false;
      let rafId = null;
      // Autoplay state
      let rafSweepId = null;
      let autoplayDir = -1; // always sweep right->left
      let isPaused = false;
      let index = 0; // current image index
      let sweepStartTs = null; // timestamp when a sweep starts
      let sweepStartPercent = 100; // percent at sweep start (supports resume mid-way)

      /** Elements */
      const viewport = root.querySelector('.gpt5slba-viewport');
      const figure = root.querySelector('.gpt5slba-figure');
      const overlay = root.querySelector('.gpt5slba-overlay');
      const handle = root.querySelector('.gpt5slba-handle');
      const imgA = root.querySelector('.js-gpt5slba-img-a');
      const imgB = root.querySelector('.js-gpt5slba-img-b');

      function clamp(v, min, max){ return Math.max(min, Math.min(max, v)); }

      function setPercentImmediate(p){
        percent = clamp(p, 0, 100);
        overlay.style.setProperty('--pos', String(percent));
        handle.style.setProperty('--pos', String(percent));
        handle.setAttribute('aria-valuenow', String(percent));
      }

      function scheduleRender(p){
        percent = clamp(p, 0, 100);
        if(rafId) return; // throttle to next frame
        rafId = requestAnimationFrame(() => {
          overlay.style.setProperty('--pos', String(percent));
          handle.style.setProperty('--pos', String(percent));
          handle.setAttribute('aria-valuenow', String(Math.round(percent)));
          rafId = null;
        });
      }

      function pointToPercent(clientX){
        const rect = figure.getBoundingClientRect();
        const x = clamp(clientX - rect.left, 0, rect.width);
        return rect.width === 0 ? percent : (x / rect.width) * 100;
      }

      // Pointer interactions
      function onDown(e){
        isDragging = true;
        pauseAutoplay();
        const cx = ('touches' in e) ? e.touches[0].clientX : e.clientX;
        scheduleRender(pointToPercent(cx));
        // Prevent text selection / page scroll during drag
        e.preventDefault();
      }
      function onMove(e){
        if(!isDragging) return;
        const cx = ('touches' in e) ? e.touches[0].clientX : e.clientX;
        scheduleRender(pointToPercent(cx));
      }
      function onUp(){
        if(!isDragging) return;
        isDragging = false;
        resumeAutoplaySoon();
      }

      // Click to jump
      function onClick(e){
        // Ignore clicks originating from the knob itself to avoid double-processing
        if(e.target === handle || handle.contains(e.target)) return;
        const cx = e.clientX;
        setPercentImmediate(pointToPercent(cx));
        pauseAutoplay();
        resumeAutoplaySoon();
      }

      // Keyboard interactions on handle
      function onKey(e){
        const stepSmall = e.shiftKey ? 5 : 1;
        const stepLarge = 10;
        let next = percent;
        if(e.key === 'ArrowLeft'){ e.preventDefault(); next -= stepSmall; }
        if(e.key === 'ArrowRight'){ e.preventDefault(); next += stepSmall; }
        if(e.key === 'PageDown'){ e.preventDefault(); next -= stepLarge; }
        if(e.key === 'PageUp'){ e.preventDefault(); next += stepLarge; }
        if(e.key === 'Home'){ e.preventDefault(); next = 0; }
        if(e.key === 'End'){ e.preventDefault(); next = 100; }
        if(next !== percent){ setPercentImmediate(next); pauseAutoplay(); resumeAutoplaySoon(); }
      }

      // Events
      handle.addEventListener('mousedown', onDown);
      figure.addEventListener('mousedown', onDown);
      document.addEventListener('mousemove', onMove);
      document.addEventListener('mouseup', onUp);
      handle.addEventListener('touchstart', onDown, { passive: false });
      figure.addEventListener('touchstart', onDown, { passive: false });
      document.addEventListener('touchmove', onMove, { passive: false });
      document.addEventListener('touchend', onUp);
      figure.addEventListener('click', onClick);
      handle.addEventListener('keydown', onKey);

      // Autoplay (auto wipe and image cycling)
      const INITIAL_DELAY_MS = 4000; // wait before first sweep
      const SWEEP_DURATION_MS = 1500; // 1.5s per sweep (within 1-2s spec)
      const EDGE_HOLD_MS = 4000; // hold at left edge
      const RESTART_DELAY_AFTER_INTERACTION_MS = 1600; // after user interaction

      const slides = (function(){
        // 6 dummy images (SVG gradients with numbers)
        const colors = [
          ['#60A5FA', '#2563EB'],
          ['#F59E0B', '#D97706'],
          ['#34D399', '#059669'],
          ['#F472B6', '#DB2777'],
          ['#A78BFA', '#7C3AED'],
          ['#F87171', '#DC2626']
        ];
        return colors.map((pair, i) => (
          'data:image/svg+xml;utf8,' + encodeURIComponent(
            `<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1200 675">`+
            `<defs><linearGradient id="g${i}" x1="0" x2="1"><stop stop-color="${pair[0]}"/><stop offset="1" stop-color="${pair[1]}"/></linearGradient></defs>`+
            `<rect fill="url(#g${i})" width="1200" height="675"/>`+
            `<g fill="white" font-family="system-ui, -apple-system, Segoe UI, Roboto, Arial" text-anchor="middle">`+
            `<text x="600" y="350" font-size="72" font-weight="700">SLIDE ${i+1}</text>`+
            `<text x="600" y="420" font-size="28" fill="rgba(255,255,255,.85)">ダミー画像</text>`+
            `</g></svg>`
          )
        ));
      })();

      function setImages(currIdx, nextIdx){
        // Base shows NEXT image; Overlay shows CURRENT image.
        // As percent decreases (right->left), overlay shrinks and reveals base from the right.
        const c = ((currIdx % slides.length) + slides.length) % slides.length;
        const n = ((nextIdx % slides.length) + slides.length) % slides.length;
        imgA.src = slides[n]; // base = next
        imgB.src = slides[c]; // overlay = current
      }

      function easeInOutCubic(x){ return x < 0.5 ? 4*x*x*x : 1 - Math.pow(-2*x + 2, 3) / 2; }

      function cancelSweep(){ if(rafSweepId){ cancelAnimationFrame(rafSweepId); rafSweepId = null; } }

      function startSweep(){
        cancelSweep();
        // initialize sweep from current percent down to 0
        sweepStartPercent = percent;
        sweepStartTs = performance.now();
        const tick = () => {
          if(isPaused){ rafSweepId = null; return; }
          const now = performance.now();
          const t = Math.min(1, Math.max(0, (now - sweepStartTs) / SWEEP_DURATION_MS));
          const eased = easeInOutCubic(t);
          const p = sweepStartPercent * (1 - eased); // decrease toward 0
          setPercentImmediate(p);
          if(t < 1){
            rafSweepId = requestAnimationFrame(tick);
          } else {
            onSweepEnd();
          }
        };
        rafSweepId = requestAnimationFrame(tick);
      }

      let initialDelayTimer = null;
      function startAutoplay(){
        if (window.matchMedia && window.matchMedia('(prefers-reduced-motion: reduce)').matches) return;
        isPaused = false;
        cancelSweep();
        if(initialDelayTimer) clearTimeout(initialDelayTimer);
        initialDelayTimer = setTimeout(()=>{ if(!isPaused) startSweep(); }, INITIAL_DELAY_MS);
      }
      function stopAutoplay(){ cancelSweep(); if(initialDelayTimer){ clearTimeout(initialDelayTimer); initialDelayTimer = null; } }
      function pauseAutoplay(){ isPaused = true; }
      function resumeAutoplay(){
        if(!isPaused) return;
        isPaused = false;
        // ensure any stale animation frame is cleared before starting
        cancelSweep();
        startSweep();
      }
      let resumeTimer = null;
      function resumeAutoplaySoon(){ if(resumeTimer) clearTimeout(resumeTimer); resumeTimer = setTimeout(()=>{ resumeAutoplay(); }, RESTART_DELAY_AFTER_INTERACTION_MS); }

      let edgeHoldTimer = null;
      function onSweepEnd(){
        // reached left edge
        // mark current sweep as finished to allow restart later
        rafSweepId = null;
        index = (index + 1) % slides.length;
        setImages(index, index + 1);
        setPercentImmediate(100); // reset to right edge
        // hold, then start next sweep
        pauseAutoplay();
        if(edgeHoldTimer) clearTimeout(edgeHoldTimer);
        edgeHoldTimer = setTimeout(()=>{ resumeAutoplay(); }, EDGE_HOLD_MS);
      }

      // Pause on hover/focus for accessibility
      viewport.addEventListener('mouseenter', pauseAutoplay);
      viewport.addEventListener('mouseleave', resumeAutoplaySoon);
      viewport.addEventListener('focusin', pauseAutoplay);
      viewport.addEventListener('focusout', resumeAutoplaySoon);

      // Resize: maintain percentage naturally via CSS variable
      window.addEventListener('resize', () => setPercentImmediate(percent));

      // Init
      index = 0;
      setImages(index, index + 1);
      setPercentImmediate(percent);
      startAutoplay();
    });
  })();
  </script>

  <script>
  // Multi-line Carousel (grid pages), isolated by [data-gpt5mlc]
  (function(){
    const roots = Array.from(document.querySelectorAll('[data-gpt5mlc]'));
    if(!roots.length) return;

    roots.forEach((root) => {
      const viewport = root.querySelector('.gpt5mlc-viewport');
      const track = root.querySelector('.js-gpt5mlc-track');
      const btnPrev = root.querySelector('.js-gpt5mlc-prev');
      const btnNext = root.querySelector('.js-gpt5mlc-next');
      const dotsWrap = root.querySelector('.js-gpt5mlc-dots');

      let pageIndex = 0;
      let pageCount = 0;
      let rows = 2, cols = 3;
      let pointerStartX = 0, pointerDeltaX = 0, isDragging = false, wasDragged = false;

      const prefersReduced = window.matchMedia && window.matchMedia('(prefers-reduced-motion: reduce)').matches;

      function getGridSpec(){
        const w = window.innerWidth || document.documentElement.clientWidth;
        if(w <= 640) return { rows: 1, cols: 1 };
        if(w <= 1024) return { rows: 2, cols: 2 };
        return { rows: 2, cols: 3 };
      }

      const data = Array.from({length: 24}).map((_, i) => ({
        id: i+1,
        title: `おすすめ #${i+1}`,
        sub: 'ダミー画像',
        // neutral gradients
        gradient: i % 3 === 0 ? 'linear-gradient(135deg,#e2e8f0,#f1f5f9)' : i % 3 === 1 ? 'linear-gradient(135deg,#e5e7eb,#f3f4f6)' : 'linear-gradient(135deg,#f1f5f9,#ffffff)'
      }));

      function chunk(arr, size){
        const res = [];
        for(let i=0;i<arr.length;i+=size){ res.push(arr.slice(i, i+size)); }
        return res;
      }

      function createCard(item){
        const card = document.createElement('article');
        card.className = 'gpt5mlc-card';
        card.innerHTML = `
          <div class="gpt5mlc-media" style="background:${item.gradient}"></div>
          <div class="gpt5mlc-content">
            <h3 class="gpt5mlc-card-title">${item.title}</h3>
            <p class="gpt5mlc-card-sub">${item.sub}</p>
          </div>`;
        return card;
      }

      function renderDots(){
        dotsWrap.innerHTML = '';
        for(let i=0;i<pageCount;i++){
          const dot = document.createElement('span');
          dot.className = 'gpt5mlc-dot';
          dot.setAttribute('role','button');
          dot.setAttribute('aria-label', `ページ ${i+1}`);
          if(i === pageIndex) dot.setAttribute('aria-current','true');
          dot.addEventListener('click', ()=>{ goTo(i); });
          dotsWrap.appendChild(dot);
        }
      }

      function build(){
        const spec = getGridSpec();
        rows = spec.rows; cols = spec.cols;
        root.style.setProperty('--rows', String(rows));
        root.style.setProperty('--cols', String(cols));

        const perPage = rows * cols;
        const pages = chunk(data, perPage);
        pageCount = pages.length || 1;
        pageIndex = Math.max(0, Math.min(pageIndex, pageCount - 1));

        track.innerHTML = '';
        pages.forEach((items) => {
          const page = document.createElement('div');
          page.className = 'gpt5mlc-page';
          const grid = document.createElement('div');
          grid.className = 'gpt5mlc-grid';
          grid.style.gridTemplateColumns = `repeat(${cols}, minmax(0, 1fr))`;
          grid.style.gridTemplateRows = `repeat(${rows}, 1fr)`;
          items.forEach(it => grid.appendChild(createCard(it)));
          page.appendChild(grid);
          track.appendChild(page);
        });

        renderDots();
        update();
      }

      function update(){
        const x = -pageIndex * 100;
        track.style.transition = prefersReduced ? 'none' : '';
        track.style.transform = `translateX(${x}%)`;
        btnPrev.disabled = (pageIndex <= 0);
        btnNext.disabled = (pageIndex >= pageCount - 1);
        Array.from(dotsWrap.children).forEach((d, i) => {
          if(i === pageIndex) d.setAttribute('aria-current','true'); else d.removeAttribute('aria-current');
        });
      }

      function goTo(i){ pageIndex = Math.max(0, Math.min(i, pageCount - 1)); update(); }
      function prev(){ goTo(pageIndex - 1); }
      function next(){ goTo(pageIndex + 1); }

      // Pointer swipe
      function onDown(e){
        isDragging = true; wasDragged = false; pointerDeltaX = 0;
        pointerStartX = ('touches' in e) ? e.touches[0].clientX : e.clientX;
      }
      function onMove(e){
        if(!isDragging) return;
        const cx = ('touches' in e) ? e.touches[0].clientX : e.clientX;
        pointerDeltaX = cx - pointerStartX;
        const width = viewport.getBoundingClientRect().width || 1;
        const offsetPct = (pointerDeltaX / width) * 100;
        track.style.transition = 'none';
        track.style.transform = `translateX(${(-pageIndex*100) + offsetPct}%)`;
        if(Math.abs(pointerDeltaX) > 6) wasDragged = true;
      }
      function onUp(){
        if(!isDragging) return;
        isDragging = false;
        const width = viewport.getBoundingClientRect().width || 1;
        const threshold = width * 0.16; // 16% swipe
        if(pointerDeltaX > threshold) prev();
        else if(pointerDeltaX < -threshold) next();
        else update();
      }

      // Events
      btnPrev.addEventListener('click', prev);
      btnNext.addEventListener('click', next);
      viewport.addEventListener('mousedown', onDown);
      window.addEventListener('mousemove', onMove);
      window.addEventListener('mouseup', onUp);
      viewport.addEventListener('touchstart', onDown, { passive: true });
      window.addEventListener('touchmove', onMove, { passive: true });
      window.addEventListener('touchend', onUp);

      // Keyboard navigation
      viewport.setAttribute('tabindex','0');
      viewport.addEventListener('keydown', (e)=>{
        if(e.key === 'ArrowLeft'){ e.preventDefault(); prev(); }
        if(e.key === 'ArrowRight'){ e.preventDefault(); next(); }
        if(e.key === 'Home'){ e.preventDefault(); goTo(0); }
        if(e.key === 'End'){ e.preventDefault(); goTo(pageCount-1); }
      });

      // Rebuild on resize when grid spec changes
      let lastSpec = JSON.stringify(getGridSpec());
      function onResize(){
        const spec = JSON.stringify(getGridSpec());
        if(spec !== lastSpec){ lastSpec = spec; build(); }
      }
      window.addEventListener('resize', onResize);

      // Init
      build();
    });
  })();
  </script>

  

  <?php wp_footer(); ?>
</body>
</html>


