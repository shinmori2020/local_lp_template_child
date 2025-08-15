<?php
/**
 * Template Name: GPT-5 Slider Lab 07（ブランドニュース）
 * Description: 全幅表示のカードスライダー。中央寄せ・無限ループ・チラ見せ対応。
 * Template Post Type: page
 */

if (!defined('ABSPATH')) { exit; }
?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GPT5 Slider Lab 07 - Brand News</title>
    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            padding: 0;
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
            background-color: #f8f9fa;
        }

        .gpt5bn-section {
            width: 100vw;
            padding: 60px 0;
            background-color: #f8f9fa;
            overflow: hidden;
            position: relative;
        }

        .gpt5bn-heading {
            text-align: center;
            margin-bottom: 40px;
            position: relative;
        }

        .gpt5bn-heading::before,
        .gpt5bn-heading::after {
            content: '';
            position: absolute;
            top: 50%;
            width: 60px;
            height: 2px;
            background-color: #333;
        }

        .gpt5bn-heading::before {
            left: calc(50% - 150px);
        }

        .gpt5bn-heading::after {
            right: calc(50% - 150px);
        }

        .gpt5bn-title-en {
            font-size: 2.5rem;
            font-weight: bold;
            color: #333;
            margin: 0;
            letter-spacing: 0.1em;
        }

        .gpt5bn-title-ja {
            font-size: 1rem;
            color: #666;
            margin: 8px 0 0 0;
            font-weight: normal;
        }

        .gpt5bn-viewport {
            width: 100vw;
            padding: 0;
            position: relative;
            overflow: hidden;
        }

        .gpt5bn-track {
            display: flex;
            gap: 20px;
            transition: transform 450ms ease-out;
            will-change: transform;
            padding: 0 5vw;
        }

        .gpt5bn-card {
            flex-shrink: 0;
            background: white;
            border-radius: 12px;
            overflow: hidden;
            cursor: pointer;
            transition: transform 300ms ease-out, opacity 300ms ease-out;
            position: relative;
        }

        .gpt5bn-card:hover {
            transform: scale(1.02);
        }

        .gpt5bn-card-image {
            aspect-ratio: 1 / 1;
            width: 100%;
            object-fit: cover;
            border-radius: 8px 8px 0 0;
            background-color: #e9ecef;
            display: block;
        }

        .gpt5bn-card-content {
            padding: 16px;
        }

        .gpt5bn-card-title {
            font-size: 1rem;
            font-weight: 600;
            color: #333;
            margin: 0 0 8px 0;
            line-height: 1.4;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
            min-height: 2.8em;
        }

        .gpt5bn-card-date {
            font-size: 0.875rem;
            color: #666;
            margin-bottom: 4px;
        }

        .gpt5bn-card-brand {
            font-size: 0.875rem;
            color: #999;
            font-weight: 500;
        }

        .gpt5bn-nav {
            position: absolute;
            top: 70px;
            transform: translateY(-50%);
            background: transparent;
            border: none;
            width: 30px;
            height: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all 300ms ease;
            z-index: 10;
        }

        .gpt5bn-nav:hover::before {
            background-color: #555;
        }
        
        .gpt5bn-nav:hover::after {
            border-color: #555;
        }

        .gpt5bn-nav:focus {
            outline: 2px solid #007bff;
            outline-offset: 2px;
        }

        .gpt5bn-nav--prev {
            left: 20px;
        }

        .gpt5bn-nav--next {
            right: 20px;
        }

        .gpt5bn-nav svg {
            display: none;
        }
        
        /* →型の矢印（横線+矢印の組み合わせ） */
        .gpt5bn-nav::before {
            content: '';
            position: absolute;
            width: 62px;
            height: 1px;
            background-color: #333;
            top: 50%;
            transform: translateY(-50%);
            transition: all 300ms ease;
        }
        
        .gpt5bn-nav::after {
            content: '';
            position: absolute;
            width: 20px;
            height: 20px;
            border-top: 1px solid #333;
            top: 50%;
            transition: all 300ms ease;
        }
        
        /* 右向き矢印 → */
        .gpt5bn-nav--next::before {
            left: -30px;
        }
        
        .gpt5bn-nav--next::after {
            right: 0px;
            transform: translateY(-50%) rotate(45deg);
        }
        
        /* 左向き矢印 ← */
        .gpt5bn-nav--prev::before {
            right: -30px;
        }
        
        .gpt5bn-nav--prev::after {
            left: 0px;
            transform: translateY(-50%) rotate(225deg);
        }

        .gpt5bn-controls {
            display: flex;
            justify-content: center;
            align-items: center;
            margin-top: 30px;
            position: relative;
        }

        .gpt5bn-more {
            background: #333;
            color: white;
            border: none;
            padding: 12px 32px;
            font-size: 0.875rem;
            font-weight: 600;
            letter-spacing: 0.05em;
            border-radius: 6px;
            cursor: pointer;
            transition: background-color 300ms ease;
        }

        .gpt5bn-more:hover {
            background: #555;
        }

        .gpt5bn-more:focus {
            outline: 2px solid #007bff;
            outline-offset: 2px;
        }

        .gpt5bn-status {
            position: absolute;
            left: -9999px;
            width: 1px;
            height: 1px;
            overflow: hidden;
        }

        /* Responsive breakpoints */
        @media (max-width: 599px) {
            .gpt5bn-track {
                gap: 16px;
                padding: 0 5vw;
            }

            .gpt5bn-card {
                width: calc(83.33vw - 8px);
            }

            .gpt5bn-title-en {
                font-size: 2rem;
            }

            .gpt5bn-heading::before,
            .gpt5bn-heading::after {
                width: 40px;
            }

            .gpt5bn-heading::before {
                left: calc(50% - 100px);
            }

            .gpt5bn-heading::after {
                right: calc(50% - 100px);
            }
        }

        @media (min-width: 600px) and (max-width: 959px) {
            .gpt5bn-track {
                gap: 20px;
                padding: 0 6vw;
            }

            .gpt5bn-card {
                width: calc((88vw - 40px) / 3);
            }
        }

        @media (min-width: 960px) {
            .gpt5bn-track {
                gap: 24px;
                padding: 0 7vw;
            }

            .gpt5bn-card {
                width: calc((86vw - 96px) / 5);
            }
        }

        @media (prefers-reduced-motion: reduce) {
            .gpt5bn-track,
            .gpt5bn-card,
            .gpt5bn-nav {
                transition: none;
            }
        }
    </style>
</head>

<body>
    <main class="gpt5bn-section" aria-label="ブランドニュース">
        <div class="gpt5bn-heading">
            <h2 class="gpt5bn-title-en">BRAND NEWS</h2>
            <p class="gpt5bn-title-ja">ブランドニュース</p>
        </div>

        <div class="gpt5bn-viewport" id="gpt5bn-viewport">
            <div class="gpt5bn-track" id="gpt5bn-track">
                <!-- Cards will be generated by JavaScript -->
            </div>
        </div>

        <button class="gpt5bn-nav gpt5bn-nav--prev" id="gpt5bn-prev" aria-label="前のニュースを表示" aria-controls="gpt5bn-track">
            <svg viewBox="0 0 24 24">
                <polyline points="15,18 9,12 15,6"></polyline>
            </svg>
        </button>

        <button class="gpt5bn-nav gpt5bn-nav--next" id="gpt5bn-next" aria-label="次のニュースを表示" aria-controls="gpt5bn-track">
            <svg viewBox="0 0 24 24">
                <polyline points="9,18 15,12 9,6"></polyline>
            </svg>
        </button>

        <div class="gpt5bn-controls">
            <button class="gpt5bn-more" id="gpt5bn-more">VIEW MORE</button>
        </div>

        <div id="gpt5bn-status" class="gpt5bn-status" aria-live="polite"></div>
    </main>

    <script>
        (function() {
            'use strict';
            
            const GPT5BN_AUTO_INTERVAL = 3500;
            const GPT5BN_TRANSITION_MS = 450;
            const GPT5BN_SWIPE_THRESHOLD = 0.2;
            let GPT5BN_CLONE_COUNT = 3;
            
            const gpt5bnData = [
                {
                    imageURL: 'https://picsum.photos/400/400?random=1',
                    title: 'New Collection Launch: Sustainable Fashion for Modern Living',
                    date: '2023.09.21',
                    brand: 'ECO FASHION',
                    linkURL: '#'
                },
                {
                    imageURL: 'https://picsum.photos/400/400?random=2',
                    title: 'Tech Innovation Award Winner 2023',
                    date: '2023.09.18',
                    brand: 'TECH SOLUTIONS',
                    linkURL: '#'
                },
                {
                    imageURL: 'https://picsum.photos/400/400?random=3',
                    title: 'Global Partnership Announcement',
                    date: '2023.09.15',
                    brand: 'GLOBAL CORP',
                    linkURL: '#'
                },
                {
                    imageURL: 'https://picsum.photos/400/400?random=4',
                    title: 'Exclusive Interview with CEO',
                    date: '2023.09.12',
                    brand: 'BUSINESS WEEKLY',
                    linkURL: '#'
                },
                {
                    imageURL: 'https://picsum.photos/400/400?random=5',
                    title: 'Annual Report 2023 Released',
                    date: '2023.09.08',
                    brand: 'ANNUAL REPORTS',
                    linkURL: '#'
                }
            ];
            
            const gpt5bnSection = document.querySelector('.gpt5bn-section');
            const gpt5bnTrack = document.getElementById('gpt5bn-track');
            const gpt5bnViewport = document.getElementById('gpt5bn-viewport');
            const gpt5bnPrevBtn = document.getElementById('gpt5bn-prev');
            const gpt5bnNextBtn = document.getElementById('gpt5bn-next');
            const gpt5bnMoreBtn = document.getElementById('gpt5bn-more');
            const gpt5bnStatus = document.getElementById('gpt5bn-status');
            
            let gpt5bnCurrentIndex = 0;
            let gpt5bnTotalCards = gpt5bnData.length;
            let gpt5bnIsAnimating = false;
            let gpt5bnAutoTimer = null;
            let gpt5bnVisibleCount = 1;
            let gpt5bnCardWidth = 0;
            let gpt5bnGap = 0;
            
            let gpt5bnIsDragging = false;
            let gpt5bnStartX = 0;
            let gpt5bnStartTransform = 0;
            const gpt5bnMinDragDistance = 50;
            
            if (!gpt5bnSection || !gpt5bnTrack || !gpt5bnViewport) return;
            
            function gpt5bnInit() {
                gpt5bnRenderCards();
                gpt5bnCreateClones();
                gpt5bnSetupEventListeners();
                
                setTimeout(() => {
                    gpt5bnCalculateLayout();
                    gpt5bnTranslateToIndex(gpt5bnCurrentIndex);
                    gpt5bnUpdateStatus();
                    gpt5bnStartAutoPlay();
                }, 100);
            }

            function gpt5bnRenderCards() {
                const cards = gpt5bnData.map((item, index) => {
                    const isFirst = index < 2;
                    const loading = isFirst ? 'eager' : 'lazy';
                    const fetchPriority = isFirst ? 'high' : 'auto';
                    
                    return `
                        <div class="gpt5bn-card" data-gpt5bn-index="${index}">
                            <img 
                                src="${item.imageURL}" 
                                alt="${item.title}"
                                class="gpt5bn-card-image"
                                loading="${loading}"
                                ${isFirst ? `fetchpriority="${fetchPriority}"` : ''}
                                srcset="${item.imageURL}&w=400 400w, ${item.imageURL}&w=600 600w"
                                sizes="(max-width: 599px) 83vw, (max-width: 959px) 29vw, 17vw"
                                draggable="false"
                            >
                            <div class="gpt5bn-card-content">
                                <h3 class="gpt5bn-card-title">${item.title}</h3>
                                <div class="gpt5bn-card-date">${item.date}</div>
                                <div class="gpt5bn-card-brand">${item.brand}</div>
                            </div>
                        </div>
                    `;
                }).join('');

                gpt5bnTrack.innerHTML = cards;
            }
            
            function gpt5bnCreateClones() {
                const originalCards = Array.from(gpt5bnTrack.children);
                
                GPT5BN_CLONE_COUNT = 3;
                
                for (let i = 0; i < GPT5BN_CLONE_COUNT; i++) {
                    const sourceIndex = gpt5bnTotalCards - GPT5BN_CLONE_COUNT + i;
                    const clone = originalCards[sourceIndex].cloneNode(true);
                    clone.setAttribute('data-gpt5bn-clone', 'leading');
                    clone.removeAttribute('id');
                    gpt5bnTrack.insertBefore(clone, gpt5bnTrack.firstChild);
                }
                
                for (let i = 0; i < GPT5BN_CLONE_COUNT; i++) {
                    const clone = originalCards[i].cloneNode(true);
                    clone.setAttribute('data-gpt5bn-clone', 'trailing');
                    clone.removeAttribute('id');
                    gpt5bnTrack.appendChild(clone);
                }
                
                gpt5bnCurrentIndex = GPT5BN_CLONE_COUNT;
            }

            function gpt5bnSetupEventListeners() {
                gpt5bnPrevBtn.addEventListener('click', gpt5bnPrev);
                gpt5bnNextBtn.addEventListener('click', gpt5bnNext);

                document.addEventListener('keydown', (e) => {
                    if (e.key === 'ArrowLeft') {
                        e.preventDefault();
                        gpt5bnPrev();
                    } else if (e.key === 'ArrowRight') {
                        e.preventDefault();
                        gpt5bnNext();
                    }
                });

                gpt5bnTrack.addEventListener('pointerdown', gpt5bnHandlePointerDown);
                gpt5bnTrack.addEventListener('pointermove', gpt5bnHandlePointerMove);
                gpt5bnTrack.addEventListener('pointerup', gpt5bnHandlePointerUp);
                gpt5bnTrack.addEventListener('pointercancel', gpt5bnHandlePointerUp);

                gpt5bnTrack.addEventListener('selectstart', (e) => {
                    if (gpt5bnIsDragging) e.preventDefault();
                });

                gpt5bnSection.addEventListener('mouseenter', gpt5bnStopAutoPlay);
                gpt5bnSection.addEventListener('mouseleave', gpt5bnStartAutoPlay);
                gpt5bnSection.addEventListener('focusin', gpt5bnStopAutoPlay);
                gpt5bnSection.addEventListener('focusout', gpt5bnStartAutoPlay);

                gpt5bnTrack.addEventListener('transitionend', gpt5bnHandleTransitionEnd);

                window.addEventListener('resize', gpt5bnHandleResize);

                gpt5bnMoreBtn.addEventListener('click', () => {
                    console.log('View more clicked');
                });
            }

            function gpt5bnHandlePointerDown(e) {
                if (gpt5bnIsAnimating) return;
                
                gpt5bnStopAutoPlay();
                gpt5bnIsDragging = true;
                gpt5bnStartX = e.clientX;
                gpt5bnStartTransform = gpt5bnGetCurrentTransform();
                gpt5bnSetTransition(false);
                gpt5bnTrack.setPointerCapture(e.pointerId);
                e.preventDefault();
            }

            function gpt5bnHandlePointerMove(e) {
                if (!gpt5bnIsDragging) return;

                const deltaX = e.clientX - gpt5bnStartX;
                const newTransform = gpt5bnStartTransform + deltaX;
                gpt5bnTrack.style.transform = `translateX(${newTransform}px)`;
                e.preventDefault();
            }

            function gpt5bnHandlePointerUp(e) {
                if (!gpt5bnIsDragging) return;

                const deltaX = e.clientX - gpt5bnStartX;
                const swipeThreshold = gpt5bnCardWidth * GPT5BN_SWIPE_THRESHOLD;

                gpt5bnIsDragging = false;
                gpt5bnSetTransition(true);

                if (Math.abs(deltaX) > swipeThreshold) {
                    if (deltaX > 0) {
                        gpt5bnPrev();
                    } else {
                        gpt5bnNext();
                    }
                } else {
                    gpt5bnTranslateToIndex(gpt5bnCurrentIndex);
                }

                gpt5bnStartAutoPlay();
                e.preventDefault();
            }

            function gpt5bnGetCurrentTransform() {
                const style = window.getComputedStyle(gpt5bnTrack);
                const matrix = style.transform;
                if (matrix === 'none') return 0;
                const values = matrix.split('(')[1].split(')')[0].split(',');
                return parseFloat(values[4]) || 0;
            }

            function gpt5bnNext() {
                if (gpt5bnIsAnimating) return;
                gpt5bnStopAutoPlay();
                gpt5bnCurrentIndex++;
                gpt5bnSetTransition(true);
                gpt5bnTranslateToIndex(gpt5bnCurrentIndex);
                gpt5bnUpdateStatus();
                gpt5bnStartAutoPlay();
            }

            function gpt5bnPrev() {
                if (gpt5bnIsAnimating) return;
                gpt5bnStopAutoPlay();
                gpt5bnCurrentIndex--;
                gpt5bnSetTransition(true);
                gpt5bnTranslateToIndex(gpt5bnCurrentIndex);
                gpt5bnUpdateStatus();
                gpt5bnStartAutoPlay();
            }
            
            function gpt5bnGoTo(realIndex) {
                if (gpt5bnIsAnimating) return;
                gpt5bnStopAutoPlay();
                gpt5bnCurrentIndex = realIndex + GPT5BN_CLONE_COUNT;
                gpt5bnSetTransition(true);
                gpt5bnTranslateToIndex(gpt5bnCurrentIndex);
                gpt5bnUpdateStatus();
                gpt5bnStartAutoPlay();
            }

            function gpt5bnCalculateLayout() {
                const viewportWidth = gpt5bnViewport.offsetWidth;
                const cards = gpt5bnTrack.children;
                if (cards.length === 0) return;

                gpt5bnCardWidth = cards[0].offsetWidth;
                gpt5bnGap = gpt5bnGetGap();
                
                if (window.innerWidth < 600) {
                    gpt5bnVisibleCount = 1.2;
                } else if (window.innerWidth < 960) {
                    gpt5bnVisibleCount = 3;
                } else {
                    gpt5bnVisibleCount = 5;
                }
            }
            
            function gpt5bnTranslateToIndex(index) {
                const viewportWidth = gpt5bnViewport.offsetWidth;
                const totalCardWidth = gpt5bnCardWidth + gpt5bnGap;
                
                const trackStyle = window.getComputedStyle(gpt5bnTrack);
                const trackPaddingLeft = parseFloat(trackStyle.paddingLeft) || 0;
                
                const viewportCenter = viewportWidth / 2;
                const cardCenter = gpt5bnCardWidth / 2;
                
                const cardPositionInTrack = index * totalCardWidth + cardCenter;
                const cardActualPosition = trackPaddingLeft + cardPositionInTrack;
                const transform = viewportCenter - cardActualPosition;
                
                gpt5bnTrack.style.transform = `translateX(${transform}px)`;
            }
            
            function gpt5bnSetTransition(enable) {
                if (window.matchMedia('(prefers-reduced-motion: reduce)').matches) {
                    gpt5bnTrack.style.transition = 'none';
                } else {
                    gpt5bnTrack.style.transition = enable ? `transform ${GPT5BN_TRANSITION_MS}ms ease-out` : 'none';
                }
                gpt5bnIsAnimating = enable;
            }

            function gpt5bnGetGap() {
                const style = window.getComputedStyle(gpt5bnTrack);
                return parseFloat(style.gap) || 20;
            }

            function gpt5bnUpdateStatus() {
                const realIndex = gpt5bnGetRealIndex(gpt5bnCurrentIndex);
                const current = realIndex + 1;
                const total = gpt5bnTotalCards;
                gpt5bnStatus.textContent = `${current} / ${total}`;
            }
            
            function gpt5bnGetRealIndex(index) {
                if (index < GPT5BN_CLONE_COUNT) {
                    return gpt5bnTotalCards - (GPT5BN_CLONE_COUNT - index);
                } else if (index >= GPT5BN_CLONE_COUNT + gpt5bnTotalCards) {
                    return index - GPT5BN_CLONE_COUNT - gpt5bnTotalCards;
                } else {
                    return index - GPT5BN_CLONE_COUNT;
                }
            }
            
            function gpt5bnHandleTransitionEnd() {
                const totalElements = gpt5bnTotalCards + (GPT5BN_CLONE_COUNT * 2);
                
                if (gpt5bnCurrentIndex < GPT5BN_CLONE_COUNT) {
                    gpt5bnCurrentIndex = gpt5bnTotalCards + gpt5bnCurrentIndex;
                    gpt5bnSetTransition(false);
                    gpt5bnTranslateToIndex(gpt5bnCurrentIndex);
                }
                else if (gpt5bnCurrentIndex >= GPT5BN_CLONE_COUNT + gpt5bnTotalCards) {
                    gpt5bnCurrentIndex = gpt5bnCurrentIndex - gpt5bnTotalCards;
                    gpt5bnSetTransition(false);
                    gpt5bnTranslateToIndex(gpt5bnCurrentIndex);
                }
                
                setTimeout(() => {
                    gpt5bnIsAnimating = false;
                }, 50);
            }
            
            function gpt5bnStartAutoPlay() {
                gpt5bnStopAutoPlay();
                if (gpt5bnTotalCards > 1) {
                    gpt5bnAutoTimer = setInterval(gpt5bnNext, GPT5BN_AUTO_INTERVAL);
                }
            }
            
            function gpt5bnStopAutoPlay() {
                if (gpt5bnAutoTimer) {
                    clearInterval(gpt5bnAutoTimer);
                    gpt5bnAutoTimer = null;
                }
            }

            function gpt5bnHandleResize() {
                const realIndex = gpt5bnGetRealIndex(gpt5bnCurrentIndex);
                
                const clones = gpt5bnTrack.querySelectorAll('[data-gpt5bn-clone]');
                clones.forEach(clone => clone.remove());
                
                gpt5bnCreateClones();
                
                gpt5bnCalculateLayout();
                
                gpt5bnCurrentIndex = realIndex + GPT5BN_CLONE_COUNT;
                gpt5bnTranslateToIndex(gpt5bnCurrentIndex);
            }
            
            if (document.readyState === 'loading') {
                document.addEventListener('DOMContentLoaded', gpt5bnInit);
            } else {
                gpt5bnInit();
            }
        })();
    </script>
</body>

<?php get_footer(); ?>