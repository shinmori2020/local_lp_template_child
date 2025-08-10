<?php
/**
 * Template Name: GPT-5 Slider Lab 03（縦型スライダー）
 * Description: ニュース/ブログ一覧向けの縦方向スライダー。ホイール/スワイプ/キーボード対応・アクセシブル・バニラJS。
 * Template Post Type: page
 */

if (!defined('ABSPATH')) { exit; }
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
  <meta charset="<?php bloginfo('charset'); ?>" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title><?php bloginfo('name'); ?> | GPT-5 Slider Lab 03</title>
  <?php wp_head(); ?>
  <style>
    :root { --container: 1200px; --gutter: 24px; --radius: 14px; --gap: 16px; --border: #e6e8ea; --text: #222; --muted: #6b7280; }
    .gpt5slv-body { background:#ffffff; color: var(--text); font-family: system-ui, -apple-system, Segoe UI, Roboto, "Helvetica Neue", Arial, "Noto Sans JP", "Hiragino Kaku Gothic ProN", "Yu Gothic", Meiryo, sans-serif; -webkit-tap-highlight-color: transparent; }
    .gpt5slv-container { max-width: var(--container); margin: 0 auto; padding: 0 var(--gutter); }
    .gpt5slv-section { padding: 56px 0; }
    .gpt5slv-title { font-size: 28px; margin: 0 0 8px; font-weight: 800; letter-spacing: .01em; }
    .gpt5slv-desc { color: var(--muted); margin: 0 0 24px; }

    /* Vertical Slider (gpt5slv-) */
    .gpt5slv { position: relative; }
    .gpt5slv-viewport { position: relative; overflow: hidden; border-radius: 16px; background:#fff; border: 1px solid var(--border); height: clamp(440px, 80vh, 820px); contain: layout paint size; }
    .gpt5slv-track { position: relative; will-change: transform; touch-action: pan-y; /* allow vertical pan */ transform: translate3d(0,0,0); }
    .gpt5slv-slide { height: 100%; box-sizing: border-box; display: grid; align-items: center; padding: 16px; overflow: hidden; }

    .gpt5slv-card { background:#fff; border:1px solid var(--border); border-radius: 14px; overflow: hidden; box-shadow: 0 1px 2px rgba(16,24,40,.04); display: grid; grid-template-rows: auto 1fr auto; height: 100%; margin: 0; min-height: 0; }
    .gpt5slv-media { height: clamp(180px, 58vh, 550px); background: linear-gradient(180deg,#f6f7f8,#eef1f4); border-bottom: 1px solid var(--border); }
    .gpt5slv-content { padding: 14px 16px; display: grid; gap: 8px; min-height: 0; overflow: hidden; }
    .gpt5slv-eyebrow { color: var(--muted); font-weight: 800; letter-spacing: .08em; font-size: 12px; text-transform: uppercase; margin: 0; }
    .gpt5slv-cardtitle { margin: 0; font-size: 18px; font-weight: 800; }
    .gpt5slv-meta { color: var(--muted); font-size: 12px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; }
    .gpt5slv-cardtitle { display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden; }
    .gpt5slv-slide.is-compact .gpt5slv-content { padding: 10px 12px; }
    
    .gpt5slv-actions { display:flex; justify-content: space-between; align-items:center; gap: 8px; border-top: 1px solid var(--border); padding: 10px 12px; }
    .gpt5slv-btn { appearance:none; border-radius: 10px; border:1px solid var(--border); background:#fff; padding:8px 12px; font-weight:700; cursor:pointer; }
    .gpt5slv-btn:hover { background:#f8fafc; }

    /* Controls */
    .gpt5slv-arrows { position: absolute; inset: 0; pointer-events: none; }
    .gpt5slv-arrowcol { position: absolute; left: 50%; top: 0; bottom: 0; display: grid; grid-template-rows: 1fr 1fr; align-items: center; transform: translateX(-50%); padding: 8px 0; gap: calc(100% - 96px); }
    .gpt5slv-iconbtn { pointer-events: auto; width: 44px; height: 44px; border-radius: 12px; border: 1px solid var(--border); background: rgba(255,255,255,.95); color:#111; cursor:pointer; box-shadow:0 2px 10px rgba(16,24,40,.08); position:relative; font-size:0; line-height:0; display:grid; place-items:center; }
    .gpt5slv-iconbtn::before { content:""; width: 12px; height: 12px; background: currentColor; clip-path: polygon(50% 0, 0 100%, 100% 100%); /* triangle up */ }
    [data-gpt5slv-action="down"].gpt5slv-iconbtn::before { transform: rotate(180deg); }

    /* Dots (vertical) */
    .gpt5slv-dots { position: absolute; right: 10px; top: 50%; transform: translateY(-50%); display: grid; gap: 8px; }
    .gpt5slv-dot { width: 6px; height: 6px; border-radius: 999px; background: #d1d5db; border: 0; cursor: pointer; }
    .gpt5slv-dot[aria-current="true"] { background: #111; }

    .gpt5slv-viewport:focus { outline: none; }
    .gpt5slv-viewport:focus-visible { outline: 2px solid #111; outline-offset: 2px; }

    @media (max-width: 1024px) { .gpt5slv-section { padding: 48px 0; } }
    @media (max-width: 768px)  { .gpt5slv-section { padding: 40px 0; } }

    @media (prefers-reduced-motion: reduce) {
      .gpt5slv-track { transition: none !important; }
    }
  </style>
  <style>
    /* Marquee Slider (gpt5slm1-) - continuous right->left flow */
    .gpt5slm1 { position: relative; margin-top: 56px; margin-left: calc(50% - 50vw); margin-right: calc(50% - 50vw); }
    .gpt5slm1-viewport { position: relative; overflow: hidden; border: 0; background: transparent; }
    .gpt5slm1-track { display: flex; align-items: center; gap: 24px; will-change: transform; touch-action: pan-y; }
    .gpt5slm1-item { flex: 0 0 auto; }
    .gpt5slm1-card { height: 84px; min-width: 160px; padding: 12px 16px; border-radius: 12px; background:#fff; border:1px solid var(--border); box-shadow: 0 1px 2px rgba(16,24,40,.06); display:flex; align-items:center; justify-content:center; font-weight:800; color:#2b2f33; }
    @media (min-width: 768px){ .gpt5slm1-card { height: 96px; min-width: 200px; } }
    @media (min-width: 1024px){ .gpt5slm1-card { height: 110px; min-width: 240px; } }
  </style>
  <style>
    /* Center Coverflow Slider (gpt5slc1-) */
    .gpt5slc1 { position: relative; margin-top: 56px; padding-left: var(--gutter); padding-right: var(--gutter); }
    .gpt5slc1-viewport { position: relative; overflow: hidden; border-radius: 0; background: transparent; border: 0; }
    .gpt5slc1-track { display: flex; align-items: stretch; gap: 16px; will-change: transform; touch-action: pan-y; }
    .gpt5slc1-slide { flex: 0 0 auto; min-width: 80%; /* mobile default to show peeking sides */ }
    @media (min-width: 768px){ .gpt5slc1-slide { min-width: calc((100% - 16px) / 2); } }
    @media (min-width: 1024px){ .gpt5slc1-slide { min-width: calc((100% - 32px) / 3); } }

    .gpt5slc1-card { height: 100%; background:#fff; border:1px solid var(--border); border-radius: 14px; overflow: hidden; box-shadow: 0 1px 2px rgba(16,24,40,.04); display: grid; grid-template-rows: auto 1fr auto; transform-origin: center center; transition: transform .35s ease, filter .35s ease, opacity .35s ease; }
    .gpt5slc1-media { aspect-ratio: 4/3; background: linear-gradient(180deg,#f6f7f8,#eef1f4); border-bottom: 1px solid var(--border); }
    .gpt5slc1-content { padding: 12px 14px; display: grid; gap: 6px; min-height: 0; }
    .gpt5slc1-title { font-size: 15px; font-weight: 800; margin: 0; display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden; }
    .gpt5slc1-meta { color: var(--muted); font-size: 12px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; }
    .gpt5slc1-actions { display:flex; justify-content: space-between; align-items:center; gap: 8px; border-top: 1px solid var(--border); padding: 10px 12px; }
    .gpt5slc1-btn { appearance:none; border-radius: 10px; border:1px solid var(--border); background:#fff; padding:8px 12px; font-weight:700; cursor:pointer; }
    .gpt5slc1-btn:hover { background:#f8fafc; }

    /* Center emphasis */
    .gpt5slc1-slide[data-active="false"] .gpt5slc1-card { transform: scale(.86); filter: blur(1.2px); opacity: .88; }
    .gpt5slc1-slide[data-active="true"] .gpt5slc1-card { transform: scale(1); filter: none; opacity: 1; }

    /* Controls */
    .gpt5slc1-arrows { position: absolute; inset: 0; pointer-events: none; z-index: 3; }
    .gpt5slc1-arrowbar { position: absolute; top: 50%; left: 0; right: 0; display: flex; justify-content: space-between; transform: translateY(-50%); padding: 0 8px; }
    .gpt5slc1-iconbtn { -webkit-tap-highlight-color: transparent; outline: none; pointer-events: auto; width: 44px; height: 44px; border-radius: 12px; border: 1px solid var(--border); background: rgba(255,255,255,.95); color:#111; cursor:pointer; box-shadow:0 2px 10px rgba(16,24,40,.08); position:relative; font-size:0; line-height:0; display:grid; place-items:center; z-index: 4; }
    .gpt5slc1-iconbtn:focus { outline: none; }
    .gpt5slc1-iconbtn:focus-visible { outline: 2px solid #111; outline-offset: 2px; }
    .gpt5slc1-iconbtn::before { content:""; position:absolute; top:50%; left:50%; width:12px; height:12px; transform: translate(-50%,-50%); background: currentColor; clip-path: polygon(0 0, 100% 50%, 0 100%); }
    [data-gpt5slc1-action="prev"].gpt5slc1-iconbtn::before { transform: translate(-50%,-50%) scaleX(-1); }
    .gpt5slc1-dots { display:flex; gap:8px; justify-content:center; margin-top: 12px; }
    .gpt5slc1-dot { width: 6px; height: 6px; border-radius: 999px; background: #d1d5db; border: 0; cursor: pointer; }
    .gpt5slc1-dot[aria-current="true"] { background: #111; }

    .gpt5slc1-viewport:focus { outline: none; }
    .gpt5slc1-viewport:focus-visible { outline: 2px solid #111; outline-offset: 2px; }
    @media (prefers-reduced-motion: reduce) { .gpt5slc1-track { transition: none !important; } .gpt5slc1-card { transition: none !important; } }
  </style>
</head>
<body <?php body_class('gpt5slv-body'); ?>>
  <main class="gpt5slv-container gpt5slv-section">
    <header style="margin-bottom:24px">
      <h1 class="gpt5slv-title">GPT-5 Slider Lab 03</h1>
      <p class="gpt5slv-desc">縦方向スライダー（ニュース/ブログ一覧向け）。ホイール/スワイプ/上下キー対応、アクセシブル、バニラJS。</p>
    </header>

    <section class="gpt5slv" aria-roledescription="carousel" aria-label="縦型スライダー" data-gpt5slv>
      <div class="gpt5slv-viewport" tabindex="0">
        <div class="gpt5slv-track js-gpt5slv-track" role="list">
          <?php
            // 仮データ（ダミー）：実装後にWPループ/ACFに置換可
            $items = [];
            for ($i = 1; $i <= 8; $i++) {
              $items[] = [
                'eyebrow' => 'NEWS',
                'title'   => '見出し ' . $i,
                'date'    => date('Y-m-d', strtotime("-{$i} day")),
                'cat'     => 'カテゴリ',
                // 'excerpt' は削除（カードをコンパクト化）
                'url'     => '#'
              ];
            }
            $total = count($items);
            foreach ($items as $idx => $it):
          ?>
          <article class="gpt5slv-slide" role="group" aria-label="スライド <?php echo $idx+1; ?> / <?php echo $total; ?>" data-gpt5slv-index="<?php echo $idx; ?>">
            <div class="gpt5slv-card">
              <div class="gpt5slv-media"></div>
              <div class="gpt5slv-content">
                <p class="gpt5slv-eyebrow"><?php echo esc_html($it['eyebrow']); ?></p>
                <h2 class="gpt5slv-cardtitle"><?php echo esc_html($it['title']); ?></h2>
                <div class="gpt5slv-meta"><?php echo esc_html($it['date']); ?> ・ <?php echo esc_html($it['cat']); ?></div>
              </div>
              <div class="gpt5slv-actions">
                <a class="gpt5slv-btn" href="<?php echo esc_url($it['url']); ?>">続きを読む</a>
                <span class="gpt5slv-meta">#<?php echo $idx+1; ?></span>
              </div>
            </div>
          </article>
          <?php endforeach; ?>
        </div>

        <div class="gpt5slv-arrows" aria-hidden="true">
          <div class="gpt5slv-arrowcol">
            <button class="gpt5slv-iconbtn" data-gpt5slv-action="up" aria-label="前へ"></button>
            <button class="gpt5slv-iconbtn" data-gpt5slv-action="down" aria-label="次へ"></button>
          </div>
        </div>

        <div class="gpt5slv-dots js-gpt5slv-dots" aria-label="スライドインジケータ"></div>
      </div>
    </section>
  </main>

  <!-- Center Coverflow Slider: gpt5slc1 (autoplay + loop + dots/arrows) -->
  <section class="gpt5slc1 gpt5slv-container gpt5slv-section" aria-roledescription="carousel" aria-label="センターモード・カバーフロー" data-gpt5slc1>
    <h2 class="gpt5slv-title" style="margin-bottom:8px">Center Coverflow</h2>
    <p class="gpt5slv-desc">中央強調・左右プレビュー、スケール/ブラー演出。自動再生・無限ループ対応。</p>
    <div class="gpt5slc1-viewport" tabindex="0">
      <div class="gpt5slc1-track js-gpt5slc1-track" role="list">
        <?php for ($i = 1; $i <= 9; $i++): ?>
          <article class="gpt5slc1-slide" role="group" aria-label="スライド <?php echo $i; ?> / 9" data-active="<?php echo $i===1 ? 'true' : 'false'; ?>">
            <div class="gpt5slc1-card">
              <div class="gpt5slc1-media"></div>
              <div class="gpt5slc1-content">
                <h3 class="gpt5slc1-title">カード <?php echo $i; ?></h3>
                <div class="gpt5slc1-meta">カテゴリ ・ #<?php echo $i; ?></div>
              </div>
              <div class="gpt5slc1-actions">
                <button class="gpt5slc1-btn" type="button">詳しく</button>
                <span class="gpt5slc1-meta">ID: <?php echo $i; ?></span>
              </div>
            </div>
          </article>
        <?php endfor; ?>
      </div>
      <div class="gpt5slc1-arrows" aria-hidden="true">
        <div class="gpt5slc1-arrowbar">
          <button class="gpt5slc1-iconbtn" data-gpt5slc1-action="prev" aria-label="前へ">◀</button>
          <button class="gpt5slc1-iconbtn" data-gpt5slc1-action="next" aria-label="次へ">▶</button>
        </div>
      </div>
    </div>
    <div class="gpt5slc1-dots js-gpt5slc1-dots" aria-label="スライドインジケータ"></div>
  </section>

  <script>
  // Vertical Slider (wheel + swipe + keys). No external libs
  (function(){
    const root = document.querySelector('[data-gpt5slv]');
    if(!root) return;
    const viewport = root.querySelector('.gpt5slv-viewport');
    const track = root.querySelector('.js-gpt5slv-track');
    const slides = Array.from(track.children);
    const upBtn = root.querySelector('[data-gpt5slv-action="up"]');
    const downBtn = root.querySelector('[data-gpt5slv-action="down"]');
    const dotsWrap = root.querySelector('.js-gpt5slv-dots');

    let index = 0; let y = 0; let startY = 0; let isDown = false; let trackStartY = 0; let isAnimating = false; let lastWheelTs = 0;

    function vh(){ return viewport.clientHeight; }
    function layoutSlidesHeight(){
      const h = vh();
      slides.forEach(sl => { sl.style.height = h + 'px'; });
    }
    function targetY(i){ return -Math.round(slides[i].offsetTop); }
    function translate(withAnim){
      track.style.transition = withAnim ? 'transform .45s ease' : 'none';
      y = targetY(index);
      track.style.transform = `translate3d(0, ${y}px, 0)`;
      updateDots();
    }
    function clamp(v,min,max){ return Math.max(min, Math.min(max, v)); }
    function go(to){
      const next = clamp(to, 0, slides.length - 1);
      if(next === index) { translate(true); return; }
      index = next; isAnimating = true; translate(true);
    }
    function next(){ go(index + 1); }
    function prev(){ go(index - 1); }

    function makeDots(){
      dotsWrap.innerHTML = '';
      slides.forEach((_,i)=>{
        const b = document.createElement('button'); b.type='button'; b.className='gpt5slv-dot';
        b.setAttribute('aria-label', `スライド ${i+1} へ`);
        b.addEventListener('click', ()=>{ index = i; translate(true); });
        dotsWrap.appendChild(b);
      });
      updateDots();
    }
    function updateDots(){
      const dots = dotsWrap.querySelectorAll('.gpt5slv-dot');
      dots.forEach((d,i)=> d.setAttribute('aria-current', String(i===index)) );
    }

    // Transition end unlock
    track.addEventListener('transitionend', ()=>{ isAnimating = false; y = targetY(index); track.style.transform = `translate3d(0, ${y}px, 0)`; });

    // Wheel (throttled per step)
    viewport.addEventListener('wheel', (e)=>{
      e.preventDefault();
      const now = performance.now();
      if(isAnimating || (now - lastWheelTs) < 420) return;
      lastWheelTs = now;
      if(e.deltaY > 0) next(); else if(e.deltaY < 0) prev();
    }, { passive: false });

    // Drag / Swipe (vertical)
    function onDown(e){ isDown = true; isAnimating = false; track.style.transition='none'; startY = ('touches' in e ? e.touches[0].clientY : e.clientY); trackStartY = y; }
    function onMove(e){ if(!isDown) return; const clientY = ('touches' in e ? e.touches[0].clientY : e.clientY); const dy = clientY - startY; y = trackStartY + dy; track.style.transform = `translate3d(0, ${y}px, 0)`; }
    function onUp(){ if(!isDown) return; isDown = false; const moved = y - trackStartY; const threshold = vh() * 0.12; if(moved < -threshold) index++; if(moved > threshold) index--; go(index); }
    viewport.addEventListener('mousedown', onDown); document.addEventListener('mousemove', onMove); document.addEventListener('mouseup', onUp);
    viewport.addEventListener('touchstart', onDown, { passive: true }); document.addEventListener('touchmove', onMove, { passive: true }); document.addEventListener('touchend', onUp);
    // prevent unwanted text selection during drag
    viewport.addEventListener('dragstart', (e)=> e.preventDefault());

    // Arrows & Keyboard
    upBtn.addEventListener('click', prev);
    downBtn.addEventListener('click', next);
    viewport.addEventListener('keydown', (e)=>{
      if(e.key==='ArrowUp'){ e.preventDefault(); prev(); }
      if(e.key==='ArrowDown'){ e.preventDefault(); next(); }
      if(e.key==='PageUp'){ e.preventDefault(); prev(); }
      if(e.key==='PageDown'){ e.preventDefault(); next(); }
      if(e.key==='Home'){ e.preventDefault(); index = 0; translate(true); }
      if(e.key==='End'){ e.preventDefault(); index = slides.length - 1; translate(true); }
    });

    // Resize
    window.addEventListener('resize', ()=> {
      // 高さが小さい画面では内容圧縮クラスを付与
      slides.forEach(sl => sl.classList.toggle('is-compact', viewport.clientHeight < 520));
      layoutSlidesHeight();
      translate(false);
    });

    // Init
    makeDots();
    layoutSlidesHeight();
    slides.forEach(sl => sl.classList.toggle('is-compact', viewport.clientHeight < 520));
    translate(false);
  })();
  </script>

  <script>
  // Center Coverflow (autoplay + loop + dots/arrows), isolated by [data-gpt5slc1]
  (function(){
    const root = document.querySelector('[data-gpt5slc1]');
    if(!root) return;
    const viewport = root.querySelector('.gpt5slc1-viewport');
    const track = root.querySelector('.js-gpt5slc1-track');
    let slides = Array.from(track.children);
    const prevBtn = root.querySelector('[data-gpt5slc1-action="prev"]');
    const nextBtn = root.querySelector('[data-gpt5slc1-action="next"]');
    const dotsWrap = root.querySelector('.js-gpt5slc1-dots');

    const AUTOPLAY_MS = 5000;
    let index = 0; let x = 0; let startX = 0; let isDown = false; let trackStartX = 0; let timer = null; let isAnimating = false; let animTimer = null;

    // Infinite: clone head/tail (2 items each to keep neighbors visible at edges)
    const CLONE_COUNT = 4;
    (function initClones(){
      const originals = slides.slice();
      const firstN = originals.slice(0, CLONE_COUNT).map(n=>{ const c=n.cloneNode(true); c.dataset.clone='true'; return c; });
      const lastN  = originals.slice(-CLONE_COUNT).map(n=>{ const c=n.cloneNode(true); c.dataset.clone='true'; return c; });
      // prepend lastN
      lastN.forEach(n=> track.insertBefore(n, track.firstChild));
      // append firstN
      firstN.forEach(n=> track.appendChild(n));
      slides = Array.from(track.children);
      index = CLONE_COUNT; // start at first real
      markActive();
    })();

    function vw(){ return viewport.clientWidth; }
    function unit(){ return slides[0].offsetWidth + gap(); }
    function gap(){
      const cs = getComputedStyle(track);
      const g = parseFloat(cs.columnGap || cs.gap || '16');
      return isNaN(g) ? 16 : g;
    }

    function translate(withAnim){
      track.style.transition = withAnim ? 'transform .35s ease' : 'none';
      const cardWidth = slides[0].offsetWidth; // layout width (ignores CSS transform scale)
      const step = cardWidth + gap();
      const centerOffset = (viewport.clientWidth - cardWidth) / 2;
      x = -index * step + centerOffset;
      track.style.transform = `translate3d(${x}px,0,0)`;
      markActive();
      updateDots();
      if(withAnim){
        isAnimating = true;
        if(animTimer) clearTimeout(animTimer);
        animTimer = setTimeout(()=>{ isAnimating = false; }, 400);
      } else {
        isAnimating = false;
      }
    }
    function go(delta){
      if(isAnimating) return;
      index += delta;
      // allow temporary overrun to trigger seamless snap in transitionend
      const max = slides.length - 1; // last is clone
      if(index < 0) index = 0;
      if(index > max) index = max;
      translate(true);
    }

    // Snap active
    function markActive(){
      const realCount = slides.length - (CLONE_COUNT * 2);
      slides.forEach((s,si)=> s.setAttribute('data-active', String(si===index)) );
    }

    // Transition edge handling
    track.addEventListener('transitionend', ()=>{
      const realCount = slides.length - (CLONE_COUNT * 2);
      if (index < CLONE_COUNT) { index += realCount; translate(false); }
      if (index >= CLONE_COUNT + realCount) { index -= realCount; translate(false); }
      markActive();
      if(animTimer) clearTimeout(animTimer);
      isAnimating = false;
    });

    // Dots
    function makeDots(){
      dotsWrap.innerHTML = '';
      const realCount = slides.length - (CLONE_COUNT * 2);
      for(let i=0;i<realCount;i++){
        const b = document.createElement('button'); b.type='button'; b.className='gpt5slc1-dot';
        b.setAttribute('aria-label', `スライド ${i+1} へ`);
        b.addEventListener('click', ()=>{ if(isAnimating) return; index = i + CLONE_COUNT; translate(true); resetAutoplay(); });
        dotsWrap.appendChild(b);
      }
      updateDots();
    }
    function updateDots(){
      const dots = dotsWrap.querySelectorAll('.gpt5slc1-dot');
      const realCount = slides.length - (CLONE_COUNT * 2);
      const realIdx = ((index - CLONE_COUNT) % realCount + realCount) % realCount;
      dots.forEach((d,i)=> d.setAttribute('aria-current', String(i===realIdx)) );
    }

    const INTERACTIVE_SELECTOR = '[data-gpt5slc1-action], .gpt5slc1-iconbtn, button, a, input, select, textarea';
    function isInteractiveEventTarget(e){ return e.target && e.target.closest(INTERACTIVE_SELECTOR); }

    // Drag / Swipe
    function onDown(e){
      // Ignore drags starting from interactive controls (arrows, buttons, links, form fields)
      if(isInteractiveEventTarget(e)) return;
      isDown = true; stopAutoplay(); isAnimating = false; track.style.transition='none'; startX = ('touches' in e ? e.touches[0].clientX : e.clientX); trackStartX = x;
    }
    function onMove(e){ if(!isDown) return; const clientX = ('touches' in e ? e.touches[0].clientX : e.clientX); const dx = clientX - startX; x = trackStartX + dx; track.style.transform = `translate3d(${x}px,0,0)`; }
    function onUp(){
      if(!isDown) return;
      isDown = false;
      const moved = x - trackStartX;
      const cardWidth = slides[0].offsetWidth;
      const threshold = Math.max(40, cardWidth * 0.18);
      if(moved < -threshold) index++;
      if(moved > threshold) index--;
      translate(true);
      resetAutoplay();
    }
    viewport.addEventListener('mousedown', onDown); document.addEventListener('mousemove', onMove); document.addEventListener('mouseup', onUp);
    viewport.addEventListener('touchstart', onDown, { passive: true }); document.addEventListener('touchmove', onMove, { passive: true }); document.addEventListener('touchend', onUp);

    // Arrows & Keyboard
    prevBtn.addEventListener('click', (e)=>{ e.preventDefault(); e.stopPropagation(); isDown = false; go(-1); resetAutoplay(); });
    nextBtn.addEventListener('click', (e)=>{ e.preventDefault(); e.stopPropagation(); isDown = false; go(1); resetAutoplay(); });
    // Prevent mousedown/touchstart from reaching viewport (which would start a drag)
    prevBtn.addEventListener('mousedown', (e)=>{ e.preventDefault(); e.stopPropagation(); });
    nextBtn.addEventListener('mousedown', (e)=>{ e.preventDefault(); e.stopPropagation(); });
    prevBtn.addEventListener('touchstart', (e)=>{ e.preventDefault(); e.stopPropagation(); }, { passive: false });
    nextBtn.addEventListener('touchstart', (e)=>{ e.preventDefault(); e.stopPropagation(); }, { passive: false });
    // Fallback: delegated handler (in case overlay captures or DOM changes)
    root.addEventListener('click', (e)=>{
      const btn = e.target.closest('[data-gpt5slc1-action]');
      if(!btn) return;
      e.preventDefault();
      if(btn.getAttribute('data-gpt5slc1-action') === 'prev') go(-1); else go(1);
      resetAutoplay();
    });
    viewport.addEventListener('keydown', (e)=>{ if(e.key==='ArrowLeft'){ e.preventDefault(); go(-1); resetAutoplay(); } if(e.key==='ArrowRight'){ e.preventDefault(); go(1); resetAutoplay(); } });

    // Resize
    window.addEventListener('resize', ()=> translate(false));
    new ResizeObserver(()=> translate(false)).observe(viewport);

    // Autoplay
    function startAutoplay(){ stopAutoplay(); timer = setInterval(()=> go(1), AUTOPLAY_MS); }
    function stopAutoplay(){ if(timer){ clearInterval(timer); timer = null; } }
    function resetAutoplay(){ stopAutoplay(); startAutoplay(); }

    // Init
    makeDots();
    translate(false);
    startAutoplay();

    // Pause on hover/focus for accessibility
    viewport.addEventListener('mouseenter', stopAutoplay);
    viewport.addEventListener('mouseleave', startAutoplay);
    viewport.addEventListener('focusin', stopAutoplay);
    viewport.addEventListener('focusout', startAutoplay);
  })();
  </script>

  <?php wp_footer(); ?>
</body>
</html>


