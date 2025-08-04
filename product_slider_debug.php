<?php
/**
 * Product Slider Debug and Fix - 商品スライダー問題解決版
 * 
 * 「全く動かない」問題を解決するためのデバッグ＆修正版
 */

// 直接アクセスを防ぐ
if (!defined('ABSPATH')) {
    exit;
}

/**
 * デバッグ用：商品スライダーの修正版
 */
function render_product_slider_debug($atts = [], $content = null) {
    // 属性のデフォルト値を設定
    $atts = shortcode_atts(array(
        'title' => 'Debug Product Slider',
        'post_id' => get_the_ID(),
    ), $atts, 'product_slider_debug');

    // デフォルトデータ（ACFに依存しない）
    $products = array(
        array(
            'image' => 'https://picsum.photos/400/300?random=1',
            'name' => 'Premium Sneakers',
            'description' => '高品質な素材を使用したスタイリッシュなスニーカー。',
            'price' => '¥24,800',
            'button_text' => '詳細を見る',
            'button_link' => '#',
        ),
        array(
            'image' => 'https://picsum.photos/400/300?random=2',
            'name' => 'Smart Watch',
            'description' => '最新テクノロジーを搭載したスマートウォッチ。',
            'price' => '¥39,900',
            'button_text' => '詳細を見る',
            'button_link' => '#',
        ),
        array(
            'image' => 'https://picsum.photos/400/300?random=3',
            'name' => 'Wireless Headphones',
            'description' => 'ノイズキャンセリング機能付きのワイヤレスヘッドフォン。',
            'price' => '¥18,500',
            'button_text' => '詳細を見る',
            'button_link' => '#',
        ),
    );

    // ユニークIDを生成
    $unique_id = 'debug-product-slider-' . uniqid();

    ob_start();
    ?>
    <!-- デバッグ版商品スライダー -->
    <section class="debug-product-slider-section" id="<?php echo esc_attr($unique_id); ?>">
        <div class="debug-container">
            <h2 class="debug-section-title"><?php echo esc_html($atts['title']); ?></h2>
            <div class="debug-slider-wrapper">
                <div class="debug-slider-container">
                    <?php foreach ($products as $index => $product): ?>
                        <div class="debug-slide <?php echo $index === 0 ? 'active' : ''; ?>">
                            <div class="debug-product-card">
                                <div class="debug-product-image">
                                    <img src="<?php echo esc_url($product['image']); ?>" alt="<?php echo esc_attr($product['name']); ?>">
                                </div>
                                <div class="debug-product-info">
                                    <h3 class="debug-product-name"><?php echo esc_html($product['name']); ?></h3>
                                    <p class="debug-product-description"><?php echo esc_html($product['description']); ?></p>
                                    <div class="debug-product-price"><?php echo esc_html($product['price']); ?></div>
                                    <button class="debug-product-btn" onclick="debugSliderButtonClick('<?php echo esc_url($product['button_link']); ?>')">
                                        <?php echo esc_html($product['button_text']); ?>
                                    </button>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>

                <!-- ナビゲーションボタン -->
                <button class="debug-nav-btn debug-prev-btn" onclick="debugChangeSlide('<?php echo esc_attr($unique_id); ?>', -1)">‹</button>
                <button class="debug-nav-btn debug-next-btn" onclick="debugChangeSlide('<?php echo esc_attr($unique_id); ?>', 1)">›</button>

                <!-- インジケーター -->
                <div class="debug-slider-indicators">
                    <?php foreach ($products as $index => $product): ?>
                        <span class="debug-indicator <?php echo $index === 0 ? 'active' : ''; ?>" onclick="debugCurrentSlide('<?php echo esc_attr($unique_id); ?>', <?php echo $index + 1; ?>)"></span>
                    <?php endforeach; ?>
                </div>
            </div>
            
            <!-- デバッグ情報表示 -->
            <div class="debug-info" style="margin-top: 20px; padding: 10px; background: #f0f0f0; border-radius: 5px;">
                <strong>デバッグ情報:</strong><br>
                Slider ID: <?php echo esc_attr($unique_id); ?><br>
                商品数: <?php echo count($products); ?><br>
                JavaScript初期化: <span id="debug-js-status-<?php echo esc_attr($unique_id); ?>">未実行</span><br>
                現在のスライド: <span id="debug-current-slide-<?php echo esc_attr($unique_id); ?>">1</span>
            </div>
        </div>
    </section>

    <style>
    /* デバッグ用CSS - 確実に動作するよう簡潔に記述 */
    #<?php echo esc_attr($unique_id); ?>.debug-product-slider-section {
        padding: 60px 0;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        position: relative;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }

    #<?php echo esc_attr($unique_id); ?> .debug-container {
        max-width: 1000px;
        margin: 0 auto;
        padding: 0 20px;
        position: relative;
        z-index: 1;
    }

    #<?php echo esc_attr($unique_id); ?> .debug-section-title {
        text-align: center;
        font-size: 2.5rem;
        font-weight: 700;
        color: white;
        margin-bottom: 40px;
        text-shadow: 0 2px 4px rgba(0,0,0,0.3);
    }

    #<?php echo esc_attr($unique_id); ?> .debug-slider-wrapper {
        position: relative;
        max-width: 700px;
        margin: 0 auto;
    }

    #<?php echo esc_attr($unique_id); ?> .debug-slider-container {
        position: relative;
        height: 450px;
        overflow: hidden;
        border-radius: 15px;
        box-shadow: 0 15px 35px rgba(0,0,0,0.3);
        background: white;
    }

    #<?php echo esc_attr($unique_id); ?> .debug-slide {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        opacity: 0;
        transform: translateX(100%);
        transition: all 0.5s ease-in-out;
        background: white;
    }

    #<?php echo esc_attr($unique_id); ?> .debug-slide.active {
        opacity: 1;
        transform: translateX(0);
    }

    #<?php echo esc_attr($unique_id); ?> .debug-product-card {
        display: flex;
        height: 100%;
        align-items: center;
    }

    #<?php echo esc_attr($unique_id); ?> .debug-product-image {
        flex: 1;
        height: 100%;
    }

    #<?php echo esc_attr($unique_id); ?> .debug-product-image img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    #<?php echo esc_attr($unique_id); ?> .debug-product-info {
        flex: 1;
        padding: 40px;
        display: flex;
        flex-direction: column;
        justify-content: center;
    }

    #<?php echo esc_attr($unique_id); ?> .debug-product-name {
        font-size: 1.8rem;
        font-weight: 700;
        color: #2c3e50;
        margin-bottom: 16px;
    }

    #<?php echo esc_attr($unique_id); ?> .debug-product-description {
        color: #6c757d;
        line-height: 1.6;
        margin-bottom: 24px;
        font-size: 1rem;
    }

    #<?php echo esc_attr($unique_id); ?> .debug-product-price {
        font-size: 2rem;
        font-weight: 800;
        color: #e74c3c;
        margin-bottom: 24px;
    }

    #<?php echo esc_attr($unique_id); ?> .debug-product-btn {
        background: #667eea;
        color: white;
        border: none;
        padding: 14px 32px;
        border-radius: 50px;
        font-weight: 600;
        font-size: 1rem;
        cursor: pointer;
        transition: all 0.3s ease;
        align-self: flex-start;
    }

    #<?php echo esc_attr($unique_id); ?> .debug-product-btn:hover {
        background: #5a67d8;
        transform: translateY(-2px);
    }

    #<?php echo esc_attr($unique_id); ?> .debug-nav-btn {
        position: absolute;
        top: 50%;
        transform: translateY(-50%);
        background: rgba(255, 255, 255, 0.9);
        border: none;
        width: 50px;
        height: 50px;
        border-radius: 50%;
        font-size: 1.5rem;
        font-weight: bold;
        color: #333;
        cursor: pointer;
        transition: all 0.3s ease;
        z-index: 10;
    }

    #<?php echo esc_attr($unique_id); ?> .debug-nav-btn:hover {
        background: white;
        transform: translateY(-50%) scale(1.1);
    }

    #<?php echo esc_attr($unique_id); ?> .debug-prev-btn {
        left: -25px;
    }

    #<?php echo esc_attr($unique_id); ?> .debug-next-btn {
        right: -25px;
    }

    #<?php echo esc_attr($unique_id); ?> .debug-slider-indicators {
        display: flex;
        justify-content: center;
        gap: 12px;
        margin-top: 30px;
    }

    #<?php echo esc_attr($unique_id); ?> .debug-indicator {
        width: 12px;
        height: 12px;
        border-radius: 50%;
        background: rgba(255, 255, 255, 0.4);
        cursor: pointer;
        transition: all 0.3s ease;
    }

    #<?php echo esc_attr($unique_id); ?> .debug-indicator.active {
        background: white;
        transform: scale(1.2);
    }

    /* レスポンシブ対応 */
    @media (max-width: 768px) {
        #<?php echo esc_attr($unique_id); ?> .debug-product-card {
            flex-direction: column;
        }
        
        #<?php echo esc_attr($unique_id); ?> .debug-product-image {
            height: 200px;
        }
        
        #<?php echo esc_attr($unique_id); ?> .debug-product-info {
            padding: 20px;
        }
        
        #<?php echo esc_attr($unique_id); ?> .debug-slider-container {
            height: 500px;
        }
    }
    </style>

    <script>
    // グローバル変数を初期化
    window.debugSliders = window.debugSliders || {};
    window.debugSliders['<?php echo esc_attr($unique_id); ?>'] = {
        currentIndex: 0,
        totalSlides: <?php echo count($products); ?>,
        isInitialized: false
    };

    // DOMContentLoaded待機版の初期化
    function initDebugSlider_<?php echo esc_attr($unique_id); ?>() {
        console.log('🔍 デバッグスライダー初期化開始:', '<?php echo esc_attr($unique_id); ?>');
        
        const sliderId = '<?php echo esc_attr($unique_id); ?>';
        const sliderData = window.debugSliders[sliderId];
        
        // DOM要素の存在確認
        const slides = document.querySelectorAll('#' + sliderId + ' .debug-slide');
        const indicators = document.querySelectorAll('#' + sliderId + ' .debug-indicator');
        const statusElement = document.getElementById('debug-js-status-' + sliderId);
        const currentSlideElement = document.getElementById('debug-current-slide-' + sliderId);
        
        if (slides.length === 0) {
            console.error('❌ スライド要素が見つかりません:', sliderId);
            if (statusElement) statusElement.textContent = 'エラー: 要素なし';
            return false;
        }
        
        console.log('✅ スライド要素発見:', slides.length + '個');
        
        // 初期化完了マーク
        sliderData.isInitialized = true;
        if (statusElement) statusElement.textContent = '✅ 初期化完了';
        if (currentSlideElement) currentSlideElement.textContent = '1';
        
        console.log('🎉 デバッグスライダー初期化完了:', sliderId);
        return true;
    }

    // グローバル関数：スライド変更
    function debugChangeSlide(sliderId, direction) {
        console.log('🔄 スライド変更:', sliderId, direction);
        
        const sliderData = window.debugSliders[sliderId];
        if (!sliderData || !sliderData.isInitialized) {
            console.error('❌ スライダーが初期化されていません:', sliderId);
            return;
        }
        
        const slides = document.querySelectorAll('#' + sliderId + ' .debug-slide');
        const indicators = document.querySelectorAll('#' + sliderId + ' .debug-indicator');
        const currentSlideElement = document.getElementById('debug-current-slide-' + sliderId);
        
        // 現在のアクティブを除去
        slides.forEach(slide => slide.classList.remove('active'));
        indicators.forEach(indicator => indicator.classList.remove('active'));
        
        // 新しいインデックス計算
        sliderData.currentIndex += direction;
        
        if (sliderData.currentIndex >= sliderData.totalSlides) {
            sliderData.currentIndex = 0;
        } else if (sliderData.currentIndex < 0) {
            sliderData.currentIndex = sliderData.totalSlides - 1;
        }
        
        // 新しいスライドを表示
        if (slides[sliderData.currentIndex]) {
            slides[sliderData.currentIndex].classList.add('active');
        }
        if (indicators[sliderData.currentIndex]) {
            indicators[sliderData.currentIndex].classList.add('active');
        }
        if (currentSlideElement) {
            currentSlideElement.textContent = sliderData.currentIndex + 1;
        }
        
        console.log('✅ スライド変更完了:', sliderData.currentIndex + 1);
    }

    // グローバル関数：特定スライドに移動
    function debugCurrentSlide(sliderId, slideNumber) {
        const direction = slideNumber - 1 - window.debugSliders[sliderId].currentIndex;
        debugChangeSlide(sliderId, direction);
    }

    // グローバル関数：ボタンクリック
    function debugSliderButtonClick(url) {
        console.log('🔗 ボタンクリック:', url);
        if (url && url !== '#') {
            window.open(url, '_blank');
        } else {
            alert('商品ボタンがクリックされました！\n（デバッグモード）');
        }
    }

    // 初期化実行（DOMContentLoaded待機）
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', function() {
            setTimeout(initDebugSlider_<?php echo esc_attr($unique_id); ?>, 100);
        });
    } else {
        // すでにDOMが読み込まれている場合
        setTimeout(initDebugSlider_<?php echo esc_attr($unique_id); ?>, 100);
    }
    </script>
    <?php
    return ob_get_clean();
}

// デバッグ用ショートコード登録
add_shortcode('product_slider_debug', 'render_product_slider_debug');

/**
 * 使用方法:
 * [product_slider_debug title="テスト商品スライダー"]
 */