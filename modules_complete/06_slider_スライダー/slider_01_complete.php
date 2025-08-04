<?php
/**
 * Slider Module 01 - Complete Independent Version
 * ショートコード: [slider_01_module]
 * 
 * モダンスライダーモジュール
 * 画像スライダー機能付きセクション
 * 
 * 完全独立型モジュール：
 * - ACFフィールド自動登録
 * - CSS内蔵
 * - JavaScript内蔵
 * - ショートコード対応
 * 
 * @package Local_LP_Template_Child
 */

// 直接アクセスを防ぐ
if (!defined('ABSPATH')) {
    exit;
}

/**
 * ACFフィールドグループの自動登録
 */
if (function_exists('acf_add_local_field_group')) {
    acf_add_local_field_group(array(
        'key' => 'group_slider_01_complete_v2',
        'title' => 'スライダーモジュール01設定',
        'fields' => array(
            array(
                'key' => 'field_slider01_v2_slide_01_bg_image',
                'label' => 'スライド1 背景画像',
                'name' => 'slider01_v2_slide_01_bg_image',
                'type' => 'image',
                'return_format' => 'array',
                'preview_size' => 'medium',
                'instructions' => '1枚目のスライドの背景画像を選択してください',
                'required' => 0,
            ),
            array(
                'key' => 'field_slider01_v2_slide_01_title',
                'label' => 'スライド1 見出しテキスト',
                'name' => 'slider01_v2_slide_01_title',
                'type' => 'text',
                'instructions' => '1枚目のスライドのタイトルを入力してください',
                'placeholder' => '例: デジタル変革で未来を創る',
                'default_value' => 'デジタル変革で未来を創る',
                'required' => 0,
            ),
            array(
                'key' => 'field_slider01_v2_slide_01_description',
                'label' => 'スライド1 テキスト',
                'name' => 'slider01_v2_slide_01_description',
                'type' => 'textarea',
                'rows' => 3,
                'instructions' => '1枚目のスライドの説明文を入力してください',
                'placeholder' => '例: 最新のテクノロジーを活用して、ビジネスの可能性を無限に広げます。',
                'default_value' => '最新のテクノロジーを活用して、ビジネスの可能性を無限に広げます。私たちと一緒に、デジタル社会の新しい価値を創造しましょう。',
                'required' => 0,
            ),
            array(
                'key' => 'field_slider01_v2_slide_02_bg_image',
                'label' => 'スライド2 背景画像',
                'name' => 'slider01_v2_slide_02_bg_image',
                'type' => 'image',
                'return_format' => 'array',
                'preview_size' => 'medium',
                'instructions' => '2枚目のスライドの背景画像を選択してください',
                'required' => 0,
            ),
            array(
                'key' => 'field_slider01_v2_slide_02_title',
                'label' => 'スライド2 見出しテキスト',
                'name' => 'slider01_v2_slide_02_title',
                'type' => 'text',
                'instructions' => '2枚目のスライドのタイトルを入力してください',
                'placeholder' => '例: 革新的なソリューション',
                'default_value' => '革新的なソリューション',
                'required' => 0,
            ),
            array(
                'key' => 'field_slider01_v2_slide_02_description',
                'label' => 'スライド2 テキスト',
                'name' => 'slider01_v2_slide_02_description',
                'type' => 'textarea',
                'rows' => 3,
                'instructions' => '2枚目のスライドの説明文を入力してください',
                'placeholder' => '例: 従来の枠を超えた画期的なアプローチで、お客様の課題を解決します。',
                'default_value' => '従来の枠を超えた画期的なアプローチで、お客様の課題を解決します。効率性と創造性を両立した、次世代のビジネスモデルを提案いたします。',
                'required' => 0,
            ),
            array(
                'key' => 'field_slider01_v2_slide_03_bg_image',
                'label' => 'スライド3 背景画像',
                'name' => 'slider01_v2_slide_03_bg_image',
                'type' => 'image',
                'return_format' => 'array',
                'preview_size' => 'medium',
                'instructions' => '3枚目のスライドの背景画像を選択してください',
                'required' => 0,
            ),
            array(
                'key' => 'field_slider01_v2_slide_03_title',
                'label' => 'スライド3 見出しテキスト',
                'name' => 'slider01_v2_slide_03_title',
                'type' => 'text',
                'instructions' => '3枚目のスライドのタイトルを入力してください',
                'placeholder' => '例: 持続可能な成長戦略',
                'default_value' => '持続可能な成長戦略',
                'required' => 0,
            ),
            array(
                'key' => 'field_slider01_v2_slide_03_description',
                'label' => 'スライド3 テキスト',
                'name' => 'slider01_v2_slide_03_description',
                'type' => 'textarea',
                'rows' => 3,
                'instructions' => '3枚目のスライドの説明文を入力してください',
                'placeholder' => '例: 環境と社会に配慮した長期的な視点で、企業価値の向上を実現します。',
                'default_value' => '環境と社会に配慮した長期的な視点で、企業価値の向上を実現します。サステナビリティを軸とした戦略で、未来への責任を果たします。',
                'required' => 0,
            ),
            array(
                'key' => 'field_slider_01_v2_auto_play',
                'label' => '自動再生',
                'name' => 'slider_01_v2_auto_play',
                'type' => 'true_false',
                'default_value' => 1,
                'ui' => 1,
                'instructions' => '自動でスライドを切り替える',
            ),
            array(
                'key' => 'field_slider_01_v2_interval',
                'label' => '自動再生間隔（秒）',
                'name' => 'slider_01_v2_interval',
                'type' => 'number',
                'default_value' => 4,
                'min' => 2,
                'max' => 10,
                'instructions' => '自動再生の間隔を秒数で指定',
                'conditional_logic' => array(
                    array(
                        array(
                            'field' => 'field_slider_01_v2_auto_play',
                            'operator' => '==',
                            'value' => '1',
                        ),
                    ),
                ),
            ),
        ),
        'location' => get_smart_location(),
    ));
}

/**
 * ショートコード登録
 */
add_shortcode('slider_01_module', 'render_slider_01_module');

/**
 * モジュールのレンダリング関数
 */
function render_slider_01_module($atts = array(), $content = null) {
    // ユニークIDを生成
    $unique_id = 'slider_01_' . uniqid();
    
    // ショートコード属性のデフォルト値
    $default_atts = array(
        'auto_play' => '',
        'interval' => '',
        'post_id' => get_the_ID(),
    );
    
    // 属性をマージ
    $atts = shortcode_atts($default_atts, $atts);
    
    // ACFフィールドから値を取得
    $post_id = intval($atts['post_id']);
    $auto_play = !empty($atts['auto_play']) ? $atts['auto_play'] : get_field('slider_01_v2_auto_play', $post_id);
    $interval = !empty($atts['interval']) ? intval($atts['interval']) : intval(get_field('slider_01_v2_interval', $post_id));
    
    // 個別スライドデータを取得（常に3スライド分確保）
    $slides = array();
    
    // スライド1（常に表示）
    $slide_01_bg = get_field('slider01_v2_slide_01_bg_image', $post_id);
    $slide_01_title = get_field('slider01_v2_slide_01_title', $post_id);
    $slide_01_desc = get_field('slider01_v2_slide_01_description', $post_id);
    
    $slides[] = array(
        'bg_image' => $slide_01_bg ?: array(
            'url' => 'https://images.unsplash.com/photo-1517134191118-9d595e4c8c2b?w=1200&h=600&fit=crop',
            'alt' => 'デジタル変革'
        ),
        'title' => $slide_01_title ?: 'デジタル変革で未来を創る',
        'description' => $slide_01_desc ?: '最新のテクノロジーを活用して、ビジネスの可能性を無限に広げます。私たちと一緒に、デジタル社会の新しい価値を創造しましょう。'
    );
    
    // スライド2（常に表示）
    $slide_02_bg = get_field('slider01_v2_slide_02_bg_image', $post_id);
    $slide_02_title = get_field('slider01_v2_slide_02_title', $post_id);
    $slide_02_desc = get_field('slider01_v2_slide_02_description', $post_id);
    
    $slides[] = array(
        'bg_image' => $slide_02_bg ?: array(
            'url' => 'https://images.unsplash.com/photo-1522252234503-e356532cafd5?w=1200&h=600&fit=crop',
            'alt' => '革新的なソリューション'
        ),
        'title' => $slide_02_title ?: '革新的なソリューション',
        'description' => $slide_02_desc ?: '従来の枠を超えた画期的なアプローチで、お客様の課題を解決します。効率性と創造性を両立した、次世代のビジネスモデルを提案いたします。'
    );
    
    // スライド3（常に表示）
    $slide_03_bg = get_field('slider01_v2_slide_03_bg_image', $post_id);
    $slide_03_title = get_field('slider01_v2_slide_03_title', $post_id);
    $slide_03_desc = get_field('slider01_v2_slide_03_description', $post_id);
    
    $slides[] = array(
        'bg_image' => $slide_03_bg ?: array(
            'url' => 'https://images.unsplash.com/photo-1551434678-e076c223a692?w=1200&h=600&fit=crop',
            'alt' => '持続可能な成長戦略'
        ),
        'title' => $slide_03_title ?: '持続可能な成長戦略',
        'description' => $slide_03_desc ?: '環境と社会に配慮した長期的な視点で、企業価値の向上を実現します。サステナビリティを軸とした戦略で、未来への責任を果たします。'
    );
    
    // デフォルト値設定
    if ($auto_play === null || $auto_play === '') $auto_play = true;
    if (empty($interval)) $interval = 4;
    
    // 間隔をミリ秒に変換
    $interval_ms = $interval * 1000;
    
    // HTMLの出力
    ob_start();
    ?>
    <section class="slider-hero" id="<?php echo esc_attr($unique_id); ?>">
      <div class="slider-container">
        <div class="slider-wrapper">
          <?php foreach ($slides as $index => $slide): ?>
          <div class="slide <?php echo $index === 0 ? 'slide-active' : ''; ?>">
            <div class="slide-content">
              <img src="<?php echo esc_url($slide['bg_image']['url']); ?>" alt="<?php echo esc_attr($slide['bg_image']['alt'] ?: $slide['title']); ?>">
              <div class="slide-text">
                <h2 class="slide-title"><?php echo esc_html($slide['title']); ?></h2>
                <p class="slide-description"><?php echo esc_html($slide['description']); ?></p>
              </div>
            </div>
          </div>
          <?php endforeach; ?>
        </div>
        
        <div class="slider-controls">
          <button class="nav-btn prev-btn" aria-label="前のスライド">
            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
              <polyline points="15,18 9,12 15,6"></polyline>
            </svg>
          </button>
          
          <div class="slider-indicators">
            <?php foreach ($slides as $index => $slide): ?>
              <span class="indicator <?php echo $index === 0 ? 'indicator-active' : ''; ?>" data-slide="<?php echo $index; ?>"></span>
            <?php endforeach; ?>
          </div>
          
          <button class="nav-btn next-btn" aria-label="次のスライド">
            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
              <polyline points="9,6 15,12 9,18"></polyline>
            </svg>
          </button>
        </div>
      </div>
    </section>

    <style>
        #<?php echo esc_attr($unique_id); ?> {
          position: relative;
          height: 70vh;
          min-height: 500px;
          overflow: hidden;
          background: #000;
        }

        #<?php echo esc_attr($unique_id); ?> .slider-container {
          position: relative;
          width: 100%;
          height: 100%;
        }

        #<?php echo esc_attr($unique_id); ?> .slider-wrapper {
          position: relative;
          width: 100%;
          height: 100%;
        }

        #<?php echo esc_attr($unique_id); ?> .slide {
          position: absolute;
          top: 0;
          left: 0;
          width: 100%;
          height: 100%;
          opacity: 0;
          transform: translateX(100%);
          transition: all 0.6s cubic-bezier(0.25, 0.46, 0.45, 0.94);
        }

        #<?php echo esc_attr($unique_id); ?> .slide-active {
          opacity: 1;
          transform: translateX(0);
        }

        #<?php echo esc_attr($unique_id); ?> .slide-enter {
          animation: slideInRight 0.6s cubic-bezier(0.25, 0.46, 0.45, 0.94) forwards;
        }

        #<?php echo esc_attr($unique_id); ?> .slide-exit {
          animation: slideOutLeft 0.6s cubic-bezier(0.25, 0.46, 0.45, 0.94) forwards;
        }

        #<?php echo esc_attr($unique_id); ?> .slide-content {
          position: relative;
          width: 100%;
          height: 100%;
          display: flex;
          align-items: center;
          justify-content: center;
        }

        #<?php echo esc_attr($unique_id); ?> .slide-content img {
          width: 100%;
          height: 100%;
          object-fit: cover;
          filter: brightness(0.7);
        }

        #<?php echo esc_attr($unique_id); ?> .slide-text {
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

        #<?php echo esc_attr($unique_id); ?> .slide-title {
          font-size: 3.5rem;
          font-weight: 800;
          margin-bottom: 24px;
          line-height: 1.2;
          text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.8);
          background: linear-gradient(135deg, #ffffff, #f0f0f0);
          -webkit-background-clip: text;
          -webkit-text-fill-color: transparent;
          background-clip: text;
        }

        #<?php echo esc_attr($unique_id); ?> .slide-description {
          font-size: 1.3rem;
          line-height: 1.6;
          font-weight: 400;
          text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.8);
          opacity: 0.95;
        }

        #<?php echo esc_attr($unique_id); ?> .slider-controls {
          position: absolute;
          bottom: 40px;
          left: 50%;
          transform: translateX(-50%);
          display: flex;
          align-items: center;
          gap: 30px;
          z-index: 3;
        }

        #<?php echo esc_attr($unique_id); ?> .nav-btn {
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

        #<?php echo esc_attr($unique_id); ?> .nav-btn:hover {
          background: rgba(255, 255, 255, 0.3);
          transform: scale(1.1);
          box-shadow: 0 8px 25px rgba(0, 0, 0, 0.3);
        }

        #<?php echo esc_attr($unique_id); ?> .nav-btn:active {
          transform: scale(0.95);
        }

        #<?php echo esc_attr($unique_id); ?> .slider-indicators {
          display: flex;
          gap: 12px;
          align-items: center;
        }

        #<?php echo esc_attr($unique_id); ?> .indicator {
          width: 12px;
          height: 12px;
          border-radius: 50%;
          background: rgba(255, 255, 255, 0.4);
          cursor: pointer;
          transition: all 0.3s ease;
          position: relative;
        }

        #<?php echo esc_attr($unique_id); ?> .indicator::before {
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

        #<?php echo esc_attr($unique_id); ?> .indicator-active {
          background: rgba(255, 255, 255, 0.8);
          transform: scale(1.3);
          box-shadow: 0 0 10px rgba(255, 255, 255, 0.5);
        }

        #<?php echo esc_attr($unique_id); ?> .indicator-active::before {
          width: 6px;
          height: 6px;
        }

        #<?php echo esc_attr($unique_id); ?> .indicator:hover {
          background: rgba(255, 255, 255, 0.6);
          transform: scale(1.2);
        }

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

        @media (max-width: 768px) {
          #<?php echo esc_attr($unique_id); ?> {
            height: 60vh;
            min-height: 400px;
          }
          
          #<?php echo esc_attr($unique_id); ?> .slide-text {
            padding: 0 40px;
          }
          
          #<?php echo esc_attr($unique_id); ?> .slide-title {
            font-size: 2.5rem;
            margin-bottom: 20px;
          }
          
          #<?php echo esc_attr($unique_id); ?> .slide-description {
            font-size: 1.1rem;
            line-height: 1.5;
          }
          
          #<?php echo esc_attr($unique_id); ?> .slider-controls {
            bottom: 30px;
            gap: 20px;
          }
          
          #<?php echo esc_attr($unique_id); ?> .nav-btn {
            width: 40px;
            height: 40px;
          }
          
          #<?php echo esc_attr($unique_id); ?> .indicator {
            width: 10px;
            height: 10px;
          }
        }

        @media (max-width: 480px) {
          #<?php echo esc_attr($unique_id); ?> .slide-text {
            padding: 0 30px;
          }
          
          #<?php echo esc_attr($unique_id); ?> .slide-title {
            font-size: 2rem;
          }
          
          #<?php echo esc_attr($unique_id); ?> .slide-description {
            font-size: 1rem;
          }
          
          #<?php echo esc_attr($unique_id); ?> .slider-controls {
            gap: 15px;
          }
          
          #<?php echo esc_attr($unique_id); ?> .nav-btn {
            width: 35px;
            height: 35px;
          }
        }

        @media (prefers-reduced-motion: reduce) {
          #<?php echo esc_attr($unique_id); ?> .slide, 
          #<?php echo esc_attr($unique_id); ?> .slide-enter, 
          #<?php echo esc_attr($unique_id); ?> .slide-exit {
            transition: none;
            animation: none;
          }
        }
    </style>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const sliderId = '<?php echo esc_js($unique_id); ?>';
            const sliderContainer = document.getElementById(sliderId);
            
            if (!sliderContainer) {
                return;
            }
            
            const slider = {
                slides: sliderContainer.querySelectorAll('.slide'),
                indicators: sliderContainer.querySelectorAll('.indicator'),
                prevBtn: sliderContainer.querySelector('.prev-btn'),
                nextBtn: sliderContainer.querySelector('.next-btn'),
                currentSlide: 0,
                isAnimating: false,
                autoPlayInterval: null,
                autoPlayDelay: <?php echo esc_js($interval_ms); ?>,
                autoPlayEnabled: <?php echo esc_js($auto_play ? 'true' : 'false'); ?>,
                touchStartX: 0,
                touchEndX: 0,
                
                init() {
                    if (this.slides.length === 0) return;
                    
                    this.bindEvents();
                    if (this.autoPlayEnabled) {
                        this.startAutoPlay();
                    }
                    this.addTouchSupport();
                },
                
                bindEvents() {
                    if (this.nextBtn) {
                        this.nextBtn.addEventListener('click', () => this.nextSlide());
                    }
                    if (this.prevBtn) {
                        this.prevBtn.addEventListener('click', () => this.prevSlide());
                    }
                    
                    this.indicators.forEach((indicator, index) => {
                        indicator.addEventListener('click', () => this.goToSlide(index));
                    });
                    
                    if (this.autoPlayEnabled) {
                        sliderContainer.addEventListener('mouseenter', () => this.stopAutoPlay());
                        sliderContainer.addEventListener('mouseleave', () => this.startAutoPlay());
                    }
                    
                    document.addEventListener('keydown', (e) => {
                        if (this.isInViewport(sliderContainer)) {
                            if (e.key === 'ArrowLeft') this.prevSlide();
                            if (e.key === 'ArrowRight') this.nextSlide();
                        }
                    });
                },
                
                isInViewport(element) {
                    const rect = element.getBoundingClientRect();
                    return (
                        rect.top >= 0 &&
                        rect.left >= 0 &&
                        rect.bottom <= (window.innerHeight || document.documentElement.clientHeight) &&
                        rect.right <= (window.innerWidth || document.documentElement.clientWidth)
                    );
                },
                
                addTouchSupport() {
                    sliderContainer.addEventListener('touchstart', (e) => {
                        this.touchStartX = e.changedTouches[0].screenX;
                    });
                    
                    sliderContainer.addEventListener('touchend', (e) => {
                        this.touchEndX = e.changedTouches[0].screenX;
                        this.handleSwipe();
                    });
                },
                
                handleSwipe() {
                    const swipeThreshold = 50;
                    const diff = this.touchStartX - this.touchEndX;
                    
                    if (Math.abs(diff) > swipeThreshold) {
                        if (diff > 0) {
                            this.nextSlide();
                        } else {
                            this.prevSlide();
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
                    
                    const currentSlideEl = this.slides[this.currentSlide];
                    currentSlideEl.classList.remove('slide-active');
                    currentSlideEl.classList.add('slide-exit');
                    
                    setTimeout(() => {
                        const newSlideEl = this.slides[slideIndex];
                        
                        this.slides.forEach(slide => {
                            slide.classList.remove('slide-active', 'slide-enter', 'slide-exit');
                        });
                        
                        newSlideEl.classList.add('slide-active', 'slide-enter');
                        
                        this.updateIndicators(slideIndex);
                        
                        this.currentSlide = slideIndex;
                        
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
                    if (!this.autoPlayEnabled) return;
                    this.stopAutoPlay();
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
            
            slider.init();
        });
    </script>

    <?php
    return ob_get_clean();
}
?>