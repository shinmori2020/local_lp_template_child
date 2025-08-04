<?php
/**
 * Template Name: カスタムテンプレート（プレビュー用）
 * Description: カスタムレイアウトのテンプレート
 *
 * @package Local_LP_Template_Child
 */
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php wp_title('|', true, 'right'); ?></title>

    <link rel="stylesheet" href="<?php echo get_stylesheet_directory_uri(); ?>/css/reset.css">
    <link rel="stylesheet" href="<?php echo get_stylesheet_directory_uri(); ?>/css/custom.css">
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <?php wp_head(); ?>
</head>
<body>
    <header class="site-header">
        <div class="container">
            <div class="header-content">
                <div class="site-logo">
                    <a href="<?php echo home_url(); ?>">
                        サイトロゴ
                    </a>
                </div>
                <nav class="global-nav">
                    <ul class="menu-items">
                        <li><a href="#features">機能</a></li>
                        <li><a href="#price">料金</a></li>
                        <li><a href="#case">導入事例</a></li>
                        <li><a href="#contact">お問い合わせ</a></li>
                    </ul>
                </nav>
                <button class="hamburger-menu" aria-label="メニュー">
                    <span class="hamburger-line"></span>
                    <span class="hamburger-line"></span>
                    <span class="hamburger-line"></span>
                </button>
            </div>
        </div>
    </header>

    <div class="mobile-menu">
        <nav>
            <ul class="mobile-menu-items">
                <li><a href="#features">機能</a></li>
                <li><a href="#price">料金</a></li>
                <li><a href="#case">導入事例</a></li>
                <li><a href="#contact">お問い合わせ</a></li>
            </ul>
        </nav>
    </div>

    <!-- モダンスライダーセクション -->
    <?php echo do_shortcode('[slider_01_module]'); ?>

<script>
// モダンスライダー JavaScript
document.addEventListener('DOMContentLoaded', function() {
    const slider = {
        slides: document.querySelectorAll('.slide'),
        indicators: document.querySelectorAll('.indicator'),
        prevBtn: document.querySelector('.prev-btn'),
        nextBtn: document.querySelector('.next-btn'),
        currentSlide: 0,
        isAnimating: false,
        autoPlayInterval: null,
        autoPlayDelay: 4000, // 4秒間隔
        touchStartX: 0,
        touchEndX: 0,
        
        init() {
            if (this.slides.length === 0) return;
            
            this.bindEvents();
            this.startAutoPlay();
            this.addTouchSupport();
        },
        
        bindEvents() {
            // ナビゲーションボタン
            this.nextBtn.addEventListener('click', () => this.nextSlide());
            this.prevBtn.addEventListener('click', () => this.prevSlide());
            
            // インジケーター
            this.indicators.forEach((indicator, index) => {
                indicator.addEventListener('click', () => this.goToSlide(index));
            });
            
            // ホバー時は自動再生停止
            const container = document.querySelector('.slider-hero');
            container.addEventListener('mouseenter', () => this.stopAutoPlay());
            container.addEventListener('mouseleave', () => this.startAutoPlay());
            
            // キーボード操作
            document.addEventListener('keydown', (e) => {
                if (e.key === 'ArrowLeft') this.prevSlide();
                if (e.key === 'ArrowRight') this.nextSlide();
            });
        },
        
        addTouchSupport() {
            const container = document.querySelector('.slider-wrapper');
            
            container.addEventListener('touchstart', (e) => {
                this.touchStartX = e.changedTouches[0].screenX;
            });
            
            container.addEventListener('touchend', (e) => {
                this.touchEndX = e.changedTouches[0].screenX;
                this.handleSwipe();
            });
        },
        
        handleSwipe() {
            const swipeThreshold = 50;
            const diff = this.touchStartX - this.touchEndX;
            
            if (Math.abs(diff) > swipeThreshold) {
                if (diff > 0) {
                    this.nextSlide(); // 左にスワイプ = 次へ
                } else {
                    this.prevSlide(); // 右にスワイプ = 前へ
                }
            }
        },
        
        nextSlide() {
            if (this.isAnimating) return;
            const next = (this.currentSlide + 1) % this.slides.length;
            this.goToSlide(next);
        },
        
        prevSlide() {
            if (this.isAnimating) return;
            const prev = (this.currentSlide - 1 + this.slides.length) % this.slides.length;
            this.goToSlide(prev);
        },
        
        goToSlide(slideIndex) {
            if (this.isAnimating || slideIndex === this.currentSlide) return;
            
            this.isAnimating = true;
            
            // 現在のスライドを非表示
            const currentSlideEl = this.slides[this.currentSlide];
            currentSlideEl.classList.remove('slide-active');
            currentSlideEl.classList.add('slide-exit');
            
            // 新しいスライドを表示
            setTimeout(() => {
                const newSlideEl = this.slides[slideIndex];
                
                // 前のスライドのクラスをクリア
                this.slides.forEach(slide => {
                    slide.classList.remove('slide-active', 'slide-enter', 'slide-exit');
                });
                
                // 新しいスライドをアクティブに
                newSlideEl.classList.add('slide-active', 'slide-enter');
                
                // インジケーター更新
                this.updateIndicators(slideIndex);
                
                this.currentSlide = slideIndex;
                
                // アニメーション完了
                setTimeout(() => {
                    newSlideEl.classList.remove('slide-enter');
                    this.isAnimating = false;
                }, 600);
                
            }, 300);
        },
        
        updateIndicators(activeIndex) {
            this.indicators.forEach((indicator, index) => {
                indicator.classList.toggle('indicator-active', index === activeIndex);
            });
        },
        
        startAutoPlay() {
            this.stopAutoPlay(); // 既存のタイマーをクリア
            this.autoPlayInterval = setInterval(() => {
                this.nextSlide();
            }, this.autoPlayDelay);
        },
        
        stopAutoPlay() {
            if (this.autoPlayInterval) {
                clearInterval(this.autoPlayInterval);
                this.autoPlayInterval = null;
            }
        }
    };
    
    // スライダー初期化
    slider.init();
});
</script>

<style>
/* モダンスライダー - 独自CSSクラス */
.slider-hero {
  position: relative;
  height: 70vh;
  min-height: 500px;
  overflow: hidden;
  background: #000;
}

.slider-container {
  position: relative;
  width: 100%;
  height: 100%;
}

.slider-wrapper {
  position: relative;
  width: 100%;
  height: 100%;
}

.slide {
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  opacity: 0;
  transform: translateX(100%);
  transition: all 0.6s cubic-bezier(0.25, 0.46, 0.45, 0.94);
}

.slide-active {
  opacity: 1;
  transform: translateX(0);
}

.slide-enter {
  animation: slideInRight 0.6s cubic-bezier(0.25, 0.46, 0.45, 0.94) forwards;
}

.slide-exit {
  animation: slideOutLeft 0.6s cubic-bezier(0.25, 0.46, 0.45, 0.94) forwards;
}

.slide-content {
  position: relative;
  width: 100%;
  height: 100%;
  display: flex;
  align-items: center;
  justify-content: center;
}

.slide-content img {
  width: 100%;
  height: 100%;
  object-fit: cover;
  filter: brightness(0.7);
}

.slide-text {
  position: absolute;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
  text-align: center;
  color: white;
  z-index: 2;
  width: 100%;
  max-width: 900px;
  padding: 0 30px;
}

.slide-title {
  font-size: 3.5rem;
  font-weight: 800;
  margin-bottom: 24px;
  line-height: 1.2;
  background: linear-gradient(135deg, #ffffff, #f0f0f0);
  -webkit-background-clip: text;
  -webkit-text-fill-color: transparent;
  background-clip: text;
}

.slide-description {
  font-size: 1.3rem;
  line-height: 1.6;
  font-weight: 400;
  text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.8);
  opacity: 0.95;
}

.slider-controls {
  position: absolute;
  bottom: 40px;
  left: 50%;
  transform: translateX(-50%);
  display: flex;
  align-items: center;
  gap: 30px;
  z-index: 3;
}

.nav-btn {
  width: 45px;
  height: 45px;
  border: none;
  background: rgba(255, 255, 255, 0.2);
  backdrop-filter: blur(10px);
  border-radius: 50%;
  color: white;
  cursor: pointer;
  transition: all 0.3s ease;
  display: flex;
  align-items: center;
  justify-content: center;
  border: 1px solid rgba(255, 255, 255, 0.3);
}

.nav-btn:hover {
  background: rgba(255, 255, 255, 0.3);
  transform: scale(1.1);
  box-shadow: 0 8px 25px rgba(0, 0, 0, 0.3);
}

.nav-btn:active {
  transform: scale(0.95);
}

.slider-indicators {
  display: flex;
  gap: 12px;
  align-items: center;
}

.indicator {
  width: 12px;
  height: 12px;
  border-radius: 50%;
  background: rgba(255, 255, 255, 0.4);
  cursor: pointer;
  transition: all 0.3s ease;
  position: relative;
}

.indicator::before {
  content: '';
  position: absolute;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
  width: 0;
  height: 0;
  background: white;
  border-radius: 50%;
  transition: all 0.3s ease;
}

.indicator-active {
  background: rgba(255, 255, 255, 0.8);
  transform: scale(1.3);
  box-shadow: 0 0 10px rgba(255, 255, 255, 0.5);
}

.indicator-active::before {
  width: 6px;
  height: 6px;
}

.indicator:hover {
  background: rgba(255, 255, 255, 0.6);
  transform: scale(1.2);
}

/* アニメーション */
@keyframes slideInRight {
  from {
    opacity: 0;
    transform: translateX(100%);
  }
  to {
    opacity: 1;
    transform: translateX(0);
  }
}

@keyframes slideOutLeft {
  from {
    opacity: 1;
    transform: translateX(0);
  }
  to {
    opacity: 0;
    transform: translateX(-100%);
  }
}

/* レスポンシブデザイン */
@media (max-width: 768px) {
  .slider-hero {
    height: 60vh;
    min-height: 400px;
  }
  
  .slide-text {
    padding: 0 40px;
  }
  
  .slide-title {
    font-size: 2.5rem;
    margin-bottom: 20px;
  }
  
  .slide-description {
    font-size: 1.1rem;
    line-height: 1.5;
  }
  
  .slider-controls {
    bottom: 30px;
    gap: 20px;
  }
  
  .nav-btn {
    width: 40px;
    height: 40px;
  }
  
  .indicator {
    width: 10px;
    height: 10px;
  }
}

@media (max-width: 480px) {
  .slide-text {
    padding: 0 30px;
  }
  
  .slide-title {
    font-size: 2rem;
  }
  
  .slide-description {
    font-size: 1rem;
  }
  
  .slider-controls {
    gap: 15px;
  }
  
  .nav-btn {
    width: 35px;
    height: 35px;
  }
}

/* アクセシビリティ */
@media (prefers-reduced-motion: reduce) {
  .slide, .slide-enter, .slide-exit {
    transition: none;
    animation: none;
  }
}
</style>

    <!-- フッター -->
    <footer class="site-footer">
        <div class="footer-inner">
            <div class="footer-widgets">
                <div class="footer-widget-area">
                    <h3>会社情報</h3>
                    <ul>
                        <li><a href="#">会社概要</a></li>
                        <li><a href="#">お問い合わせ</a></li>
                        <li><a href="#">プライバシーポリシー</a></li>
                    </ul>
                </div>
                <div class="footer-widget-area">
                    <h3>サービス</h3>
                    <ul>
                        <li><a href="#">サービス1</a></li>
                        <li><a href="#">サービス2</a></li>
                        <li><a href="#">サービス3</a></li>
                    </ul>
                </div>
                <div class="footer-widget-area">
                    <h3>SNS</h3>
                    <ul class="social-links">
                        <li><a href="#" target="_blank">Twitter</a></li>
                        <li><a href="#" target="_blank">Facebook</a></li>
                        <li><a href="#" target="_blank">Instagram</a></li>
                    </ul>
                </div>
            </div>
            <div class="footer-bottom">
                <p class="copyright">&copy; <?php echo date('Y'); ?> サイト名. All rights reserved.</p>
            </div>
        </div>
    </footer>

    <?php wp_footer(); ?>
    

  </body>
</html>