<?php
/**
 * Template Name: GPT-5 Slider Lab 05（可変幅カード：フリーモード＋スナップ）
 * Description: 大小混在のスライドをフリックで自由にスクロール、指を離すと最寄りにスナップ（タグ/チップ/ロゴ向け）。
 * Template Post Type: page
 */

if (!defined('ABSPATH')) { exit; }
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
  <meta charset="<?php bloginfo('charset'); ?>" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title><?php bloginfo('name'); ?> | GPT-5 Slider Lab 05</title>
  <?php wp_head(); ?>
  <style>
    :root {
      --container: 1200px;
      --gutter: 24px;
      --radius: 14px;
      --border: #e5e7eb;
      --text: #111827;
      --muted: #6b7280;
      --shadow: 0 6px 20px rgba(2, 6, 23, 0.06);
      --accent-1: #2563eb;
      --accent-2: #0ea5e9;
      --accent-3: #22c55e;
      --chip-bg: #f8fafc;
      --chip-bg-strong: #eef2ff;
    }
    .gpt5svs-body { background:#ffffff; color:var(--text); font-family: system-ui, -apple-system, Segoe UI, Roboto, "Helvetica Neue", Arial, "Noto Sans JP", "Hiragino Kaku Gothic ProN", "Yu Gothic", Meiryo, sans-serif; -webkit-tap-highlight-color: transparent; }
    .gpt5svs-container { max-width: var(--container); margin: 0 auto; padding: 0 var(--gutter); }
    .gpt5svs-section { padding: 56px 0; }
    .gpt5svs-title { font-size: 28px; margin: 0 0 8px; font-weight: 900; letter-spacing: .01em; }
    .gpt5svs-desc { color: var(--muted); margin: 0 0 24px; }

    /* Variable-width Free Slider (gpt5svs-) */
    .gpt5svs { position: relative; margin-top: 8px; }
    .gpt5svs-viewport { position: relative; overflow: hidden; border-radius: var(--radius); border: 1px solid var(--border); background: linear-gradient(180deg, #ffffff, #f8fafc); box-shadow: var(--shadow); }
    .gpt5svs-header { display:flex; align-items:center; justify-content: space-between; padding: 14px var(--gutter); border-bottom: 1px solid var(--border); }
    .gpt5svs-header h2 { font-size: 16px; font-weight: 800; margin: 0; letter-spacing: .02em; }
    .gpt5svs-ctrls { display:inline-flex; gap:8px; }
    .gpt5svs-btn { appearance:none; border:1px solid var(--border); background:#fff; color:var(--text); padding:6px 10px; border-radius:10px; cursor:pointer; font-weight:700; }
    .gpt5svs-btn:hover { background:#f3f4f6; }
    .gpt5svs-btn[disabled] { opacity:.5; cursor: default; }

    .gpt5svs-body { padding: 16px 0; }
    .gpt5svs-scroller { position: relative; overflow: hidden; }
    .gpt5svs-track { display: inline-flex; align-items: stretch; gap: 10px; padding: 0 var(--gutter); will-change: transform; }

    /* Chips / variable-width cards */
    .gpt5svs-chip { flex: 0 0 auto; display: inline-flex; align-items: center; gap: 10px; padding: 10px 14px; border-radius: 9999px; border: 1px solid var(--border); background: var(--chip-bg); white-space: nowrap; box-shadow: 0 2px 6px rgba(2,6,23,.04); transition: transform .2s ease, background .2s ease, border-color .2s ease; }
    .gpt5svs-chip:hover { transform: translateY(-1px); background: #fff; }
    .gpt5svs-chip.-a { border-color: rgba(37,99,235,.35); background: linear-gradient(180deg, #ffffff, #f1f5ff); }
    .gpt5svs-chip.-b { border-color: rgba(14,165,233,.35); background: linear-gradient(180deg, #ffffff, #effafd); }
    .gpt5svs-chip.-c { border-color: rgba(34,197,94,.35); background: linear-gradient(180deg, #ffffff, #f0fdf4); }
    .gpt5svs-chip-badge { display:inline-grid; place-items:center; width: 20px; height: 20px; border-radius: 9999px; color:#fff; font-size: 12px; font-weight: 900; }
    .gpt5svs-chip-badge.-a { background: var(--accent-1); }
    .gpt5svs-chip-badge.-b { background: var(--accent-2); }
    .gpt5svs-chip-badge.-c { background: var(--accent-3); }
    .gpt5svs-chip-label { font-size: 14px; font-weight: 800; letter-spacing: .01em; color: var(--text); }
    .gpt5svs-chip-sub { font-size: 12px; color: var(--muted); }

    .gpt5svs-dots { display:flex; gap:6px; justify-content:center; padding: 12px 0 4px; }
    .gpt5svs-dot { width: 6px; height: 6px; border-radius: 9999px; background: #e5e7eb; }
    .gpt5svs-dot[aria-current="true"] { background: #111827; }

    /* Reduced motion */
    @media (prefers-reduced-motion: reduce) {
      .gpt5svs-track { transition: none !important; }
    }
  </style>
</head>
<body <?php body_class('gpt5svs-body'); ?>>
  <main class="gpt5svs-container gpt5svs-section">
    <header style="margin-bottom:24px">
      <h1 class="gpt5svs-title">GPT-5 Slider Lab 05</h1>
      <p class="gpt5svs-desc">可変幅カード（フリーモード＋スナップ）。大小混在のスライドを自由にフリック、途中スナップで整列。</p>
    </header>

    <section class="gpt5svs" aria-label="可変幅フリースライダー" data-gpt5svs>
      <div class="gpt5svs-viewport">
        <div class="gpt5svs-header">
          <h2>トレンドタグ</h2>
          <div class="gpt5svs-ctrls">
            <button type="button" class="gpt5svs-btn js-gpt5svs-prev" aria-label="前へ">Prev</button>
            <button type="button" class="gpt5svs-btn js-gpt5svs-next" aria-label="次へ">Next</button>
          </div>
        </div>
        <div class="gpt5svs-body">
          <div class="gpt5svs-scroller">
            <div class="gpt5svs-track js-gpt5svs-track" aria-label="タグ一覧" role="list"></div>
          </div>
          <div class="gpt5svs-dots js-gpt5svs-dots" aria-hidden="true"></div>
        </div>
      </div>
    </section>
  </main>

  <script>
  // Variable-width free slider with momentum + center snapping
  (function(){
    const roots = Array.from(document.querySelectorAll('[data-gpt5svs]'));
    if(!roots.length) return;

    roots.forEach((root) => {
      const scroller = root.querySelector('.gpt5svs-scroller');
      const track = root.querySelector('.js-gpt5svs-track');
      const btnPrev = root.querySelector('.js-gpt5svs-prev');
      const btnNext = root.querySelector('.js-gpt5svs-next');
      const dotsWrap = root.querySelector('.js-gpt5svs-dots');

      const prefersReduced = window.matchMedia && window.matchMedia('(prefers-reduced-motion: reduce)').matches;

      // Dummy chip data (variable-length labels)
      const labels = [
        'AI', 'デザイン', 'マーケティング', 'SEO', 'JavaScript', 'TypeScript', 'アクセシビリティ', 'UX', 'UI', 'フロントエンド',
        'バックエンド', 'クラウド', 'セキュリティ', 'データ分析', 'プロトタイピング', 'Figma', 'React', 'Next.js', 'WordPress', 'Shopify',
        'SaaS', 'MLOps', 'LLM', 'モバイル', 'iOS', 'Android', 'WebGL', 'Three.js', 'D3.js', 'Webアクセラレーション', 'CDN', 'CI/CD'
      ];

      function createChip(label, i){
        const chip = document.createElement('button');
        chip.type = 'button';
        chip.className = `gpt5svs-chip ${i%3===0?'-a':i%3===1?'-b':'-c'}`;
        chip.setAttribute('role','listitem');
        chip.innerHTML = `
          <span class="gpt5svs-chip-badge ${i%3===0?'-a':i%3===1?'-b':'-c'}">${(i%26+10).toString(36).toUpperCase()}</span>
          <span class="gpt5svs-chip-label">${label}</span>
          <span class="gpt5svs-chip-sub">${Math.floor(Math.random()*90)+10}k</span>`;
        chip.addEventListener('click', ()=> centerOn(chip, 300));
        return chip;
      }

      // Build track
      function build(){
        track.innerHTML = '';
        labels.forEach((lb, i) => track.appendChild(createChip(lb, i)));
        updateDots();
        requestAnimationFrame(()=> snapToNearest(0));
      }

      // Snap helpers
      function getItemCenters(){
        const items = Array.from(track.children);
        const rect = scroller.getBoundingClientRect();
        return items.map(el => {
          const r = el.getBoundingClientRect();
          const centerInViewport = (r.left + r.width/2);
          const centerInScroller = centerInViewport - rect.left + scroller.scrollLeft;
          return { el, center: centerInScroller };
        });
      }

      function centerOn(el, duration=380){
        const rect = scroller.getBoundingClientRect();
        const targetCenter = el.offsetLeft + (el.offsetWidth/2);
        const targetScroll = targetCenter - (rect.width/2);
        animateScrollTo(targetScroll, duration);
      }

      function snapToNearest(duration=320){
        const centers = getItemCenters();
        const currentCenter = scroller.scrollLeft + (scroller.clientWidth/2);
        let nearest = centers[0];
        let minDist = Math.abs(nearest.center - currentCenter);
        for(const c of centers){
          const d = Math.abs(c.center - currentCenter);
          if(d < minDist){ minDist = d; nearest = c; }
        }
        const targetScroll = nearest.center - (scroller.clientWidth/2);
        animateScrollTo(targetScroll, duration);
      }

      // Smooth scrollLeft animation (easeOutCubic)
      function animateScrollTo(target, duration){
        target = Math.max(0, Math.min(target, scroller.scrollWidth - scroller.clientWidth));
        if(prefersReduced || duration <= 0){ scroller.scrollLeft = target; return; }
        const start = scroller.scrollLeft;
        const dist = target - start;
        const t0 = performance.now();
        function easeOutCubic(x){ return 1 - Math.pow(1 - x, 3); }
        function tick(now){
          const t = Math.min(1, (now - t0) / duration);
          scroller.scrollLeft = start + dist * easeOutCubic(t);
          if(t < 1) requestAnimationFrame(tick);
        }
        requestAnimationFrame(tick);
      }

      // Momentum on release
      let isDown = false, startX = 0, startScroll = 0;
      let lastX = 0, lastT = 0, velocity = 0;
      function onDown(e){
        isDown = true; wasDragged = false;
        startX = ('touches' in e) ? e.touches[0].clientX : e.clientX;
        startScroll = scroller.scrollLeft;
        lastX = startX; lastT = performance.now(); velocity = 0;
      }
      function onMove(e){
        if(!isDown) return;
        const x = ('touches' in e) ? e.touches[0].clientX : e.clientX;
        const dx = x - startX;
        const now = performance.now();
        const dt = now - lastT;
        scroller.scrollLeft = startScroll - dx;
        if(dt > 16){ velocity = (x - lastX) / dt; lastX = x; lastT = now; }
        if(Math.abs(dx) > 4) wasDragged = true;
        e.preventDefault();
      }
      function onUp(){
        if(!isDown) return; isDown = false;
        if(prefersReduced){ snapToNearest(0); return; }
        // momentum
        let v = velocity * 1000; // px/s
        const sign = Math.sign(v);
        v = Math.min(3000, Math.max(-3000, v));
        const friction = 0.92;
        function step(){
          v *= friction;
          scroller.scrollLeft -= v * (1/60);
          if(Math.abs(v) > 25){ requestAnimationFrame(step); }
          else { snapToNearest(320); }
        }
        if(Math.abs(v) > 40){ requestAnimationFrame(step); } else { snapToNearest(260); }
      }

      // Click to center, ignore if it was a drag
      let wasDragged = false;
      track.addEventListener('click', (e)=>{
        const el = e.target.closest('.gpt5svs-chip');
        if(!el) return;
        if(wasDragged) { wasDragged = false; return; }
        centerOn(el, 320);
      });

      // Controls
      function neighbors(){
        const centers = getItemCenters();
        const currentCenter = scroller.scrollLeft + (scroller.clientWidth/2);
        const sorted = centers.slice().sort((a,b)=> a.center - b.center);
        let idx = sorted.findIndex(c => c.center >= currentCenter - 1 && c.center <= currentCenter + 1);
        if(idx === -1){
          // find nearest index
          let nearestI = 0, nearestD = Infinity;
          sorted.forEach((c,i)=>{ const d = Math.abs(c.center - currentCenter); if(d<nearestD){ nearestD=d; nearestI=i; } });
          idx = nearestI;
        }
        return { sorted, idx };
      }
      function prev(){ const {sorted, idx} = neighbors(); const i = Math.max(0, idx - 1); animateScrollTo(sorted[i].center - (scroller.clientWidth/2), 360); }
      function next(){ const {sorted, idx} = neighbors(); const i = Math.min(sorted.length-1, idx + 1); animateScrollTo(sorted[i].center - (scroller.clientWidth/2), 360); }

      btnPrev.addEventListener('click', prev);
      btnNext.addEventListener('click', next);

      // Pointer events
      scroller.addEventListener('mousedown', onDown);
      window.addEventListener('mousemove', onMove, { passive: false });
      window.addEventListener('mouseup', onUp);
      scroller.addEventListener('touchstart', onDown, { passive: false });
      window.addEventListener('touchmove', onMove, { passive: false });
      window.addEventListener('touchend', onUp);

      // Wheel horizontal
      scroller.addEventListener('wheel', (e)=>{
        const dx = Math.abs(e.deltaX) > Math.abs(e.deltaY) ? e.deltaX : (e.deltaY * 1);
        scroller.scrollLeft += dx;
        e.preventDefault();
        clearTimeout(wheelT);
        wheelT = setTimeout(()=> snapToNearest(280), 140);
      }, { passive: false });
      let wheelT = null;

      // Keyboard
      scroller.setAttribute('tabindex','0');
      scroller.addEventListener('keydown', (e)=>{
        if(e.key === 'ArrowLeft'){ e.preventDefault(); prev(); }
        if(e.key === 'ArrowRight'){ e.preventDefault(); next(); }
        if(e.key === 'Home'){ e.preventDefault(); animateScrollTo(0, 320); }
        if(e.key === 'End'){ e.preventDefault(); animateScrollTo(scroller.scrollWidth - scroller.clientWidth, 420); }
      });

      function updateDots(){
        // Use coarse dots: approx number of viewports across content
        const pages = Math.max(1, Math.round(track.scrollWidth / scroller.clientWidth));
        dotsWrap.innerHTML = '';
        for(let i=0;i<pages;i++){
          const d = document.createElement('span');
          d.className = 'gpt5svs-dot';
          d.addEventListener('click', ()=>{
            const target = (i / pages) * (scroller.scrollWidth - scroller.clientWidth);
            animateScrollTo(target, 420);
          });
          dotsWrap.appendChild(d);
        }
        // set current on scroll
        onScroll();
      }

      function onScroll(){
        const max = scroller.scrollWidth - scroller.clientWidth;
        const ratio = max <= 0 ? 0 : scroller.scrollLeft / max;
        const dots = Array.from(dotsWrap.children);
        const idx = Math.max(0, Math.min(dots.length-1, Math.round(ratio * (dots.length-1))));
        dots.forEach((el, i)=>{ if(i===idx) el.setAttribute('aria-current','true'); else el.removeAttribute('aria-current'); });
      }
      scroller.addEventListener('scroll', onScroll);

      // Init
      build();
      window.addEventListener('resize', ()=>{ updateDots(); snapToNearest(0); });
    });
  })();
  </script>

  <?php wp_footer(); ?>
</body>
</html>


