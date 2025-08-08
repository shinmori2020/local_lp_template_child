<?php
/**
 * Template Name: GPT-5 Slider Lab 01（スライダー実験テンプレート）
 * Description: GPT-5で作成したスライダー検証用テンプレート（v1）。CSS/JS同梱・バニラJS。
 * Template Post Type: page
 */

if (!defined('ABSPATH')) { exit; }
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
  <meta charset="<?php bloginfo('charset'); ?>" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title><?php bloginfo('name'); ?> | GPT-5 Slider Lab 01</title>
  <?php wp_head(); ?>
  <style>
    :root { --container: 1200px; --gutter: 24px; --radius: 14px; --gap: 12px; }
    .gpt5sl-body { background: #f5f7fa; color: #111; font-family: system-ui, -apple-system, Segoe UI, Roboto, "Helvetica Neue", Arial, "Noto Sans JP", "Hiragino Kaku Gothic ProN", "Yu Gothic", Meiryo, sans-serif; }
    .gpt5sl-container { max-width: var(--container); margin: 0 auto; padding: 0 var(--gutter); }
    .gpt5sl-section { padding: 56px 0; }
    .gpt5sl-title { font-size: 28px; margin: 0 0 16px; font-weight: 800; letter-spacing: .02em; }
    .gpt5sl-desc { color: #a8b0b8; margin: 0 0 24px; }

    /* Slider v1 (gpt5sl1-) - framed, masked, contrasty */
    .gpt5sl1 { position: relative; }
    .gpt5sl1-viewport { position: relative; overflow: hidden; border-radius: var(--radius); background: linear-gradient(180deg, #141a22 0, #0e141a 100%); outline: 1px solid rgba(255,255,255,.06); }
    .gpt5sl1-track { display: flex; will-change: transform; touch-action: pan-y; }
    .gpt5sl1-slide { min-width: 100%; position: relative; padding: 24px; }
    .gpt5sl1-card { position: relative; aspect-ratio: 16/9; border-radius: 12px; overflow: hidden; display: grid; place-items: center; background: radial-gradient(800px 400px at 60% 40%, #1c3e32 0, #12251e 50%, #0f1a16 100%); }
    .gpt5sl1-card::before { content: ""; position: absolute; inset: -20%; background: conic-gradient(from 120deg, rgba(255,255,255,.08), transparent 35% 65%, rgba(255,255,255,.08) 0); filter: blur(12px); mix-blend-mode: overlay; }
    .gpt5sl1-caption { position: absolute; left: 16px; bottom: 16px; background: rgba(0,0,0,.45); color: #fff; padding: 10px 12px; border-radius: 10px; font-weight: 700; backdrop-filter: blur(4px); }

    /* Controls */
    .gpt5sl1-arrows { position: absolute; inset: 0; pointer-events: none; }
    .gpt5sl1-arrowbar { position: absolute; top: 50%; left: 0; right: 0; display: flex; justify-content: space-between; transform: translateY(-50%); padding: 0 8px; }
    .gpt5sl1-iconbtn { pointer-events: auto; width: 44px; height: 44px; border-radius: 10px; border: 1px solid rgba(255,255,255,.15); background: rgba(13,20,28,.7); color: #fff; backdrop-filter: blur(6px); cursor: pointer; position: relative; font-size: 0; line-height: 0; display: grid; place-items: center; }
    .gpt5sl1-iconbtn:hover { background: rgba(13,20,28,.9); }
    .gpt5sl1-iconbtn::before { content: ""; position: absolute; top: 50%; left: 50%; width: 12px; height: 12px; transform: translate(-50%, -50%); background: currentColor; clip-path: polygon(0 0, 100% 50%, 0 100%); }
    [data-gpt5sl1-action="prev"].gpt5sl1-iconbtn::before { transform: translate(-50%, -50%) scaleX(-1); }

    .gpt5sl1-dots { display: flex; gap: 8px; justify-content: center; margin-top: 12px; }
    .gpt5sl1-dot { width: 8px; height: 8px; border-radius: 999px; background: #3a4650; border: 0; cursor: pointer; }
    .gpt5sl1-dot[aria-current="true"] { background: #a6ffcf; }

    .gpt5sl1-viewport:focus { outline: 2px solid #a6ffcf; outline-offset: 2px; }

    /* Responsive */
    @media (max-width: 1024px) { .gpt5sl-section { padding: 48px 0; } }
    @media (max-width: 768px)  { .gpt5sl-section { padding: 40px 0; } }
  </style>
  <style>
    /* Slider v4 (gpt5sl4-) - Split Hero (text left / visual right) */
    .gpt5sl4 { position: relative; margin-top: 64px; }
    .gpt5sl4-viewport { position: relative; overflow: hidden; border-radius: 16px; background: linear-gradient(180deg,#ffffff,#f3f5f8); border: 1px solid #e6e8ea; min-height: clamp(360px, 40vw, 560px); }
    .gpt5sl4-slide { position: absolute; inset: 0; opacity: 0; visibility: hidden; transition: opacity .5s ease, visibility .5s ease; }
    .gpt5sl4-slide[aria-hidden="false"] { opacity: 1; visibility: visible; }
    .gpt5sl4-grid { display: grid; grid-template-columns: 1.1fr 1fr; height: 100%; }
    .gpt5sl4-left { display: grid; align-content: center; gap: 16px; padding: 40px; }
    .gpt5sl4-eyebrow { color: #6b7280; font-weight: 700; letter-spacing: .08em; text-transform: uppercase; font-size: 12px; }
    .gpt5sl4-title { font-size: clamp(28px, 4vw, 44px); line-height: 1.2; margin: 0; }
    .gpt5sl4-desc { color: #4b5563; margin: 0; }
    .gpt5sl4-cta { display:flex; gap:12px; margin-top: 8px; }
    .gpt5sl4-btn { appearance: none; border: 1px solid #e6e8ea; background:#fff; padding: 10px 16px; border-radius: 12px; font-weight:700; cursor:pointer; }
    .gpt5sl4-btn--primary { background:#111; color:#fff; border-color:#111; }
    .gpt5sl4-right { position: relative; }
    .gpt5sl4-visual { position: absolute; inset: 0; background: radial-gradient(600px 320px at 70% 35%, #eaf5ff 0, #dfe7f1 45%, #f3f6fa 100%); }
    .gpt5sl4-blob { position:absolute; width: 56%; aspect-ratio: 1/1; right: -8%; top: 8%; background: radial-gradient(50% 50% at 50% 50%, #c8e7ff, #9fd3ff); filter: blur(8px); border-radius: 48% 52% 45% 55% / 50% 44% 56% 50%; opacity:.65; transform: rotate(8deg); }
    .gpt5sl4-product { position:absolute; right: 10%; bottom: 8%; width: min(44%, 420px); aspect-ratio: 3/4; border-radius: 16px; background: linear-gradient(180deg, #b4c6e7, #8fb0df); box-shadow: 0 10px 30px rgba(30,41,59,.2); }
    /* enter animation */
    .gpt5sl4-slide[aria-hidden="false"] .gpt5sl4-left { animation: gpt5sl4-left-in .6s ease both; }
    .gpt5sl4-slide[aria-hidden="false"] .gpt5sl4-right { animation: gpt5sl4-right-in .6s ease both; }
    @keyframes gpt5sl4-left-in { from { opacity: 0; transform: translateX(-24px); } to { opacity: 1; transform: translateX(0); } }
    @keyframes gpt5sl4-right-in { from { opacity: 0; transform: translateX(24px); } to { opacity: 1; transform: translateX(0); } }
    /* arrows */
    .gpt5sl4-arrows { position: absolute; inset: 0; pointer-events: none; }
    .gpt5sl4-arrowbar { position: absolute; top: 50%; left: 0; right: 0; display: flex; justify-content: space-between; transform: translateY(-50%); padding: 0 8px; }
    .gpt5sl4-iconbtn { pointer-events: auto; width: 44px; height: 44px; border-radius: 12px; border: 1px solid #e6e8ea; background: rgba(255,255,255,.9); color: #111; cursor: pointer; box-shadow: 0 2px 10px rgba(16,24,40,.08); position: relative; font-size:0; line-height:0; display:grid; place-items:center; }
    .gpt5sl4-iconbtn::before { content: ""; position:absolute; top:50%; left:50%; width:12px; height:12px; transform: translate(-50%,-50%); background: currentColor; clip-path: polygon(0 0, 100% 50%, 0 100%); }
    [data-gpt5sl4-action="prev"].gpt5sl4-iconbtn::before { transform: translate(-50%, -50%) scaleX(-1); }
    /* dots */
    .gpt5sl4-dots { display:flex; gap:8px; justify-content:center; margin-top: 12px; }
    .gpt5sl4-dot { width: 8px; height: 8px; border-radius: 999px; background: #d1d5db; border: 0; cursor: pointer; }
    .gpt5sl4-dot[aria-current="true"] { background: #111; }
    /* progress */
    .gpt5sl4-progress { position:absolute; left:0; right:0; top:0; height: 3px; background: rgba(0,0,0,.06); overflow:hidden; }
    .gpt5sl4-progressbar { display:block; width: 0%; height: 100%; background: #111; }
    @media (max-width: 1024px) { .gpt5sl4-grid { grid-template-columns: 1fr; } .gpt5sl4-right { min-height: 260px; } }
  </style>
  <style>
    /* Remove mobile tap highlight/blue background on arrow buttons */
    .gpt5sl-body { -webkit-tap-highlight-color: transparent; }
    .gpt5sl1-iconbtn, .gpt5sl2-iconbtn, .gpt5sl3-iconbtn {
      -webkit-tap-highlight-color: transparent;
      outline: none;
    }
    .gpt5sl1-iconbtn:focus, .gpt5sl2-iconbtn:focus, .gpt5sl3-iconbtn:focus { outline: none; }
    .gpt5sl1-iconbtn:focus-visible { outline: 2px solid #a6ffcf; outline-offset: 2px; }
    .gpt5sl2-iconbtn:focus-visible, .gpt5sl3-iconbtn:focus-visible { outline: 2px solid #111; outline-offset: 2px; }
  </style>
  <style>
    /* Slider v3 (gpt5sl3-) - testimonial fade slider */
    .gpt5sl3 { position: relative; margin-top: 56px; }
    .gpt5sl3-viewport { position: relative; overflow: hidden; border-radius: 12px; background:#ffffff; border: 1px solid #e6e8ea; min-height: clamp(220px, 28vw, 360px); }
    .gpt5sl3-slide { position: absolute; inset: 0; opacity: 0; visibility: hidden; transition: opacity .45s ease, visibility .45s ease; display: grid; place-items: center; padding: 28px; }
    .gpt5sl3-slide[aria-hidden="false"] { opacity: 1; visibility: visible; }
    .gpt5sl3-quote { max-width: 900px; text-align: center; font-size: 20px; line-height: 1.7; color: #111; }
    .gpt5sl3-author { margin-top: 14px; color: #6b7280; font-weight: 600; }
    .gpt5sl3-arrows { position: absolute; inset: 0; pointer-events: none; }
    .gpt5sl3-arrowbar { position: absolute; top: 50%; left: 0; right: 0; display: flex; justify-content: space-between; transform: translateY(-50%); padding: 0 8px; }
    .gpt5sl3-iconbtn { pointer-events: auto; width: 40px; height: 40px; border-radius: 10px; border: 1px solid #e6e8ea; background: rgba(255,255,255,.9); color: #111; cursor: pointer; box-shadow: 0 2px 10px rgba(16,24,40,.08); position: relative; font-size:0; line-height:0; display:grid; place-items:center; }
    .gpt5sl3-iconbtn::before { content: ""; position: absolute; top: 50%; left: 50%; width: 10px; height: 10px; transform: translate(-50%, -50%); background: currentColor; clip-path: polygon(0 0, 100% 50%, 0 100%); }
    [data-gpt5sl3-action="prev"].gpt5sl3-iconbtn::before { transform: translate(-50%, -50%) scaleX(-1); }
    .gpt5sl3-dots { display:flex; gap:8px; justify-content:center; margin-top: 12px; }
    .gpt5sl3-dot { width: 6px; height: 6px; border-radius: 999px; background: #d1d5db; border: 0; cursor: pointer; }
    .gpt5sl3-dot[aria-current="true"] { background: #111; }
  </style>
  <style>
    /* Slider v2 (gpt5sl2-) - minimal neutral, infinite loop */
    .gpt5sl2 { position: relative; margin-top: 56px; }
    .gpt5sl2-viewport { position: relative; overflow: hidden; border-radius: 12px; background:#fafafa; outline: 1px solid rgba(0,0,0,.06); }
    .gpt5sl2-track { display: flex; will-change: transform; touch-action: pan-y; }
    .gpt5sl2-slide { min-width: 100%; padding: 20px; }
    .gpt5sl2-card { aspect-ratio: 16/9; background: linear-gradient(180deg,#f6f7f8,#eef1f4); border-radius: 12px; border: 1px solid #e6e8ea; box-shadow: 0 1px 2px rgba(16,24,40,.04); display: grid; place-items: center; font-weight: 900; font-size: 56px; color:#2b2f33; }
    .gpt5sl2-arrows { position: absolute; inset: 0; pointer-events: none; }
    .gpt5sl2-arrowbar { position: absolute; top: 50%; left: 0; right: 0; display: flex; justify-content: space-between; transform: translateY(-50%); padding: 0 8px; }
    .gpt5sl2-iconbtn { pointer-events: auto; width: 40px; height: 40px; border-radius: 10px; border: 1px solid #e6e8ea; background: rgba(255,255,255,.9); color: #111; cursor: pointer; box-shadow: 0 2px 10px rgba(16,24,40,.08); position: relative; font-size:0; line-height:0; display:grid; place-items:center; }
    .gpt5sl2-dots { display:flex; gap:8px; justify-content:center; margin-top: 12px; }
    .gpt5sl2-dot { width: 6px; height: 6px; border-radius: 999px; background: #d1d5db; border: 0; cursor: pointer; }
    .gpt5sl2-dot[aria-current="true"] { background: #111; }
    .gpt5sl2-iconbtn::before { content: ""; position: absolute; top: 50%; left: 50%; width: 10px; height: 10px; transform: translate(-50%, -50%); background: currentColor; clip-path: polygon(0 0, 100% 50%, 0 100%); }
    [data-gpt5sl2-action="prev"].gpt5sl2-iconbtn::before { transform: translate(-50%, -50%) scaleX(-1); }
  </style>
</head>
<body <?php body_class('gpt5sl-body'); ?>>
  <main class="gpt5sl-container gpt5sl-section">
    <header style="margin-bottom:24px">
      <h1 class="gpt5sl-title">GPT-5 Slider Lab 01</h1>
      <p class="gpt5sl-desc">スライダー実験テンプレート（v1）。以降のバージョンとスタイルが似ないよう、コントラスト強めのフレームド・マスク表現で設計。</p>
    </header>

    <!-- Slider instance: v1 -->
    <section class="gpt5sl1" aria-roledescription="carousel" aria-label="デモスライダーv1" data-gpt5sl1>
      <div class="gpt5sl1-viewport" tabindex="0">
        <div class="gpt5sl1-track js-gpt5sl1-track" role="list">
          <?php for ($i = 1; $i <= 6; $i++): ?>
            <article class="gpt5sl1-slide" role="group" aria-label="スライド <?php echo $i; ?> / 6">
              <div class="gpt5sl1-card">
                <div style="font-size:64px; font-weight:900; color:#eafff4; text-shadow:0 2px 10px rgba(0,0,0,.35)">#<?php echo $i; ?></div>
                <div class="gpt5sl1-caption">Slide <?php echo $i; ?></div>
              </div>
            </article>
          <?php endfor; ?>
        </div>
        <div class="gpt5sl1-arrows" aria-hidden="true">
          <div class="gpt5sl1-arrowbar">
            <button class="gpt5sl1-iconbtn" data-gpt5sl1-action="prev" aria-label="前へ">◀</button>
            <button class="gpt5sl1-iconbtn" data-gpt5sl1-action="next" aria-label="次へ">▶</button>
          </div>
        </div>
      </div>
      <div class="gpt5sl1-dots js-gpt5sl1-dots" aria-label="スライドインジケータ"></div>
    </section>

    <!-- Slider v2: infinite loop -->
    <section class="gpt5sl2" aria-roledescription="carousel" aria-label="デモスライダーv2（無限ループ）" data-gpt5sl2>
      <div class="gpt5sl2-viewport" tabindex="0">
        <div class="gpt5sl2-track js-gpt5sl2-track" role="list">
          <?php for ($i = 1; $i <= 6; $i++): ?>
            <article class="gpt5sl2-slide" role="group" aria-label="スライド <?php echo $i; ?> / 6">
              <div class="gpt5sl2-card">V2-<?php echo $i; ?></div>
            </article>
          <?php endfor; ?>
        </div>
        <div class="gpt5sl2-arrows" aria-hidden="true">
          <div class="gpt5sl2-arrowbar">
            <button class="gpt5sl2-iconbtn" data-gpt5sl2-action="prev" aria-label="前へ">◀</button>
            <button class="gpt5sl2-iconbtn" data-gpt5sl2-action="next" aria-label="次へ">▶</button>
          </div>
        </div>
      </div>
      <div class="gpt5sl2-dots js-gpt5sl2-dots" aria-label="スライドインジケータ"></div>
    </section>

    <!-- Slider v3: testimonial fade (different purpose) -->
    <section class="gpt5sl3" aria-roledescription="carousel" aria-label="お客様の声スライダー" data-gpt5sl3>
      <div class="gpt5sl3-viewport" tabindex="0">
        <?php
          $voices = [
            ['q' => '初めての依頼でしたが、スムーズで安心できました。スタッフの対応がとても丁寧です。', 'a' => '東京都・M様'],
            ['q' => '提示金額に納得。査定から入金までのスピードも早く、またお願いしたいです。', 'a' => '大阪府・K様'],
            ['q' => 'オンラインだけで完結できたのが便利でした。サポートも迅速で助かりました。', 'a' => '福岡県・S様'],
          ];
          foreach ($voices as $i => $v):
        ?>
          <article class="gpt5sl3-slide" role="group" aria-label="スライド <?php echo $i+1; ?> / <?php echo count($voices); ?>" aria-hidden="<?php echo $i===0 ? 'false' : 'true'; ?>">
            <div class="gpt5sl3-quote">
              「<?php echo esc_html($v['q']); ?>」
              <div class="gpt5sl3-author">— <?php echo esc_html($v['a']); ?></div>
            </div>
          </article>
        <?php endforeach; ?>
        <div class="gpt5sl3-arrows" aria-hidden="true">
          <div class="gpt5sl3-arrowbar">
            <button class="gpt5sl3-iconbtn" data-gpt5sl3-action="prev" aria-label="前へ">◀</button>
            <button class="gpt5sl3-iconbtn" data-gpt5sl3-action="next" aria-label="次へ">▶</button>
          </div>
        </div>
      </div>
      <div class="gpt5sl3-dots js-gpt5sl3-dots" aria-label="スライドインジケータ"></div>
    </section>
  </main>

  <script>
  (function(){
    const root = document.querySelector('[data-gpt5sl1]');
    if(!root) return;
    const track = root.querySelector('.js-gpt5sl1-track');
    const slides = Array.from(track.children);
    const prevBtn = root.querySelector('[data-gpt5sl1-action="prev"]');
    const nextBtn = root.querySelector('[data-gpt5sl1-action="next"]');
    const dotsWrap = root.querySelector('.js-gpt5sl1-dots');

    let index = 0;
    let x = 0; let startX = 0; let isDown = false; let trackStartX = 0; let hasMoved = false;

    function update(){
      const w = root.querySelector('.gpt5sl1-viewport').clientWidth;
      x = -index * w; track.style.transition = 'transform .35s ease';
      track.style.transform = `translate3d(${x}px,0,0)`;
      updateDots();
    }
    function clamp(v,min,max){ return Math.max(min, Math.min(max, v)); }
    function go(to){
      const total = slides.length;
      if (to < 0) {
        index = total - 1; // first -> last (wrap)
      } else if (to >= total) {
        index = 0; // last -> first (wrap)
      } else {
        index = to;
      }
      update();
    }
    function makeDots(){
      dotsWrap.innerHTML = '';
      slides.forEach((_,i)=>{
        const b = document.createElement('button');
        b.className = 'gpt5sl1-dot';
        b.type = 'button';
        b.setAttribute('aria-label', `スライド ${i+1} へ`);
        b.addEventListener('click', ()=>{ go(i); });
        dotsWrap.appendChild(b);
      });
      updateDots();
    }
    function updateDots(){
      const dots = dotsWrap.querySelectorAll('.gpt5sl1-dot');
      dots.forEach((d,i)=> d.setAttribute('aria-current', String(i===index)) );
    }

    // Drag / Swipe
    function onDown(e){ isDown = true; hasMoved = false; track.style.transition='none'; startX = ('touches' in e ? e.touches[0].clientX : e.clientX); trackStartX = x; }
    function onMove(e){ if(!isDown) return; const clientX = ('touches' in e ? e.touches[0].clientX : e.clientX); const dx = clientX - startX; if(Math.abs(dx) > 2) hasMoved = true; x = trackStartX + dx; track.style.transform = `translate3d(${x}px,0,0)`; }
    function onUp(){ if(!isDown) return; isDown = false; const w = root.querySelector('.gpt5sl1-viewport').clientWidth; const moved = x - trackStartX; const threshold = w * 0.15; if(moved < -threshold) index++; if(moved > threshold) index--; go(index); }

    const viewport = root.querySelector('.gpt5sl1-viewport');
    viewport.addEventListener('mousedown', onDown); document.addEventListener('mousemove', onMove); document.addEventListener('mouseup', onUp);
    viewport.addEventListener('touchstart', onDown, { passive: true }); document.addEventListener('touchmove', onMove, { passive: true }); document.addEventListener('touchend', onUp);

    // Arrows
    prevBtn.addEventListener('click', ()=> go(index - 1));
    nextBtn.addEventListener('click', ()=> go(index + 1));

    // Keyboard
    viewport.addEventListener('keydown', (e)=>{
      if(e.key === 'ArrowLeft') { e.preventDefault(); go(index - 1); }
      if(e.key === 'ArrowRight'){ e.preventDefault(); go(index + 1); }
    });

    // Resize
    window.addEventListener('resize', ()=>{ update(); });

    // Init
    makeDots();
    update();
  })();

  // Slider v2 (infinite loop with clones)
  (function(){
    const root = document.querySelector('[data-gpt5sl2]');
    if(!root) return;
    const track = root.querySelector('.js-gpt5sl2-track');
    const prevBtn = root.querySelector('[data-gpt5sl2-action="prev"]');
    const nextBtn = root.querySelector('[data-gpt5sl2-action="next"]');
    const dotsWrap = root.querySelector('.js-gpt5sl2-dots');

    // Build clones for seamless loop
    let originals = Array.from(track.children);
    const total = originals.length;
    const firstClone = originals[0].cloneNode(true); firstClone.dataset.clone = 'true';
    const lastClone  = originals[total - 1].cloneNode(true); lastClone.dataset.clone = 'true';
    track.appendChild(firstClone);
    track.insertBefore(lastClone, originals[0]);
    let slides = Array.from(track.children);

    let index = 1; // start at first real slide (after lastClone)
    let x = 0; let startX = 0; let isDown = false; let trackStartX = 0;

    function vw(){ return root.querySelector('.gpt5sl2-viewport').clientWidth; }
    function translate(withAnim){
      track.style.transition = withAnim ? 'transform .35s ease' : 'none';
      x = -index * vw();
      track.style.transform = `translate3d(${x}px,0,0)`;
      updateDots();
    }
    function makeDots(){
      dotsWrap.innerHTML = '';
      for (let i = 0; i < total; i++){
        const b = document.createElement('button'); b.type='button'; b.className='gpt5sl2-dot';
        b.setAttribute('aria-label', `スライド ${i+1} へ`);
        b.addEventListener('click', ()=>{ index = i + 1; translate(true); });
        dotsWrap.appendChild(b);
      }
      updateDots();
    }
    function updateDots(){
      const dots = dotsWrap.querySelectorAll('.gpt5sl2-dot');
      const realIdx = ((index - 1) + total) % total; // 0-based
      dots.forEach((d,i)=> d.setAttribute('aria-current', String(i===realIdx)) );
    }
    function go(delta){ index += delta; translate(true); }

    // On transition end, if at clone, jump to real without animation
    track.addEventListener('transitionend', ()=>{
      const atFirstClone = index === 0; // leftmost clone
      const atLastClone  = index === slides.length - 1; // rightmost clone
      if (atFirstClone) { index = total; translate(false); }
      if (atLastClone)  { index = 1;     translate(false); }
    });

    // Drag / Swipe
    const viewport = root.querySelector('.gpt5sl2-viewport');
    function onDown(e){ isDown = true; track.style.transition='none'; startX = ('touches' in e ? e.touches[0].clientX : e.clientX); trackStartX = x; }
    function onMove(e){ if(!isDown) return; const clientX = ('touches' in e ? e.touches[0].clientX : e.clientX); const dx = clientX - startX; x = trackStartX + dx; track.style.transform = `translate3d(${x}px,0,0)`; }
    function onUp(){ if(!isDown) return; isDown = false; const moved = x - trackStartX; const threshold = vw() * 0.15; if(moved < -threshold) index++; if(moved > threshold) index--; translate(true); }
    viewport.addEventListener('mousedown', onDown); document.addEventListener('mousemove', onMove); document.addEventListener('mouseup', onUp);
    viewport.addEventListener('touchstart', onDown, { passive: true }); document.addEventListener('touchmove', onMove, { passive: true }); document.addEventListener('touchend', onUp);

    // Arrows & Keyboard
    prevBtn.addEventListener('click', ()=> go(-1));
    nextBtn.addEventListener('click', ()=> go(1));
    viewport.addEventListener('keydown', (e)=>{ if(e.key==='ArrowLeft'){e.preventDefault();go(-1);} if(e.key==='ArrowRight'){e.preventDefault();go(1);} });

    // Resize
    window.addEventListener('resize', ()=> translate(false));

    // Init
    makeDots();
    translate(false);
  })();
  </script>

  <script>
  // Slider v3 (fade, testimonial, autoplay with pause)
  (function(){
    const root = document.querySelector('[data-gpt5sl3]');
    if(!root) return;
    const viewport = root.querySelector('.gpt5sl3-viewport');
    const slides = Array.from(root.querySelectorAll('.gpt5sl3-slide'));
    const prevBtn = root.querySelector('[data-gpt5sl3-action="prev"]');
    const nextBtn = root.querySelector('[data-gpt5sl3-action="next"]');
    const dotsWrap = root.querySelector('.js-gpt5sl3-dots');
    let index = 0; let timer = null; const INTERVAL = 4500;

    function show(i){
      index = (i + slides.length) % slides.length;
      slides.forEach((s,si)=> s.setAttribute('aria-hidden', String(si !== index)));
      updateDots();
    }
    function makeDots(){
      dotsWrap.innerHTML = '';
      slides.forEach((_,i)=>{
        const b = document.createElement('button'); b.type='button'; b.className='gpt5sl3-dot';
        b.setAttribute('aria-label', `スライド ${i+1} へ`);
        b.addEventListener('click', ()=>{ stop(); show(i); start(); });
        dotsWrap.appendChild(b);
      });
      updateDots();
    }
    function updateDots(){
      dotsWrap.querySelectorAll('.gpt5sl3-dot').forEach((d,i)=> d.setAttribute('aria-current', String(i===index)) );
    }
    function next(){ show(index + 1); }
    function prev(){ show(index - 1); }
    function start(){ stop(); timer = setInterval(next, INTERVAL); }
    function stop(){ if(timer) { clearInterval(timer); timer = null; } }

    // Events
    nextBtn.addEventListener('click', ()=>{ next(); start(); });
    prevBtn.addEventListener('click', ()=>{ prev(); start(); });
    viewport.addEventListener('mouseenter', stop);
    viewport.addEventListener('mouseleave', start);
    viewport.addEventListener('focusin', stop);
    viewport.addEventListener('focusout', start);
    viewport.addEventListener('keydown', (e)=>{
      if(e.key==='ArrowLeft'){ e.preventDefault(); prev(); start(); }
      if(e.key==='ArrowRight'){ e.preventDefault(); next(); start(); }
    });

    // Init
    makeDots();
    show(0);
    start();
  })();
  </script>

  <?php wp_footer(); ?>
</body>
</html>


