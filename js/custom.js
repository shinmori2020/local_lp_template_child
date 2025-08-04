/**
 * Local LP Template Child Theme Custom Scripts
 *
 * @package Local_LP_Template_Child
 */

// DOMの準備完了時に実行する関数
document.addEventListener('DOMContentLoaded', function() {
    // ハンバーガーメニューの制御
    const hamburger = document.querySelector('.hamburger-menu');
    const mobileMenu = document.querySelector('.mobile-menu');
    const body = document.body;

    if (hamburger && mobileMenu) {
        hamburger.addEventListener('click', function() {
            this.classList.toggle('active');
            mobileMenu.classList.toggle('active');
            body.style.overflow = body.style.overflow === 'hidden' ? '' : 'hidden';
        });

        // メニューリンクをクリックしたときにメニューを閉じる
        const menuLinks = document.querySelectorAll('.mobile-menu-items a');
        menuLinks.forEach(link => {
            link.addEventListener('click', function() {
                hamburger.classList.remove('active');
                mobileMenu.classList.remove('active');
                body.style.overflow = '';
            });
        });
    }

    // スクロールアニメーション
    const animateOnScroll = () => {
        const elements = document.querySelectorAll('.feature-card, .point-item');
        elements.forEach(element => {
            const elementTop = element.getBoundingClientRect().top;
            const elementBottom = element.getBoundingClientRect().bottom;
            const windowHeight = window.innerHeight;

            if (elementTop < windowHeight * 0.9 && elementBottom > 0) {
                element.style.opacity = '1';
                element.style.transform = 'translateY(0)';
            }
        });
    };

    // 初期表示時のアニメーション
    window.addEventListener('load', animateOnScroll);

    // スクロール時のアニメーション
    let scrollTimer;
    window.addEventListener('scroll', () => {
        if (scrollTimer) {
            clearTimeout(scrollTimer);
        }
        scrollTimer = setTimeout(animateOnScroll, 50);
    });

    // リサイズ時の処理
    let resizeTimer;
    window.addEventListener('resize', () => {
        clearTimeout(resizeTimer);
        resizeTimer = setTimeout(() => {
            // リサイズ完了時の処理が必要な場合はここに記述
        }, 200);
    });

    // スムーズスクロール
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function(e) {
            e.preventDefault();
            const targetId = this.getAttribute('href');
            if (targetId === '#') return;
            
            const targetElement = document.querySelector(targetId);
            if (targetElement) {
                targetElement.scrollIntoView({
                    behavior: 'smooth',
                    block: 'start'
                });
            }
        });
    });
}); 