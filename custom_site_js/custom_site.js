        // グローバル変数

        // DOM読み込み完了後の処理
        document.addEventListener('DOMContentLoaded', function() {
            // ハンバーガーメニューの動作
            const hamburger = document.getElementById('hamburger');
            const navLinks = document.querySelector('.nav-links');

            if (hamburger && navLinks) {
                hamburger.addEventListener('click', function() {
                    navLinks.classList.toggle('active');
                    hamburger.classList.toggle('active');
                });

                // メニューリンクをクリックした時にメニューを閉じる
                document.querySelectorAll('.nav-links a').forEach(link => {
                    link.addEventListener('click', function() {
                        navLinks.classList.remove('active');
                        hamburger.classList.remove('active');
                    });
                });
            }
        });

        // スムーズスクロール
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    target.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                }
            });
        });

        // スクロールプログレスバー
        function updateScrollProgress() {
            const scrollTop = window.pageYOffset;
            const docHeight = document.documentElement.scrollHeight - window.innerHeight;
            const scrollPercent = (scrollTop / docHeight) * 100;
            document.getElementById('scrollProgress').style.width = scrollPercent + '%';
        }

        // パララックス効果
        function handleParallax() {
            const scrolled = window.pageYOffset;
            const parallax = document.getElementById('parallaxBg');
            if (parallax) {
                const speed = scrolled * 0.5;
                parallax.style.transform = `translateY(${speed}px)`;
            }
        }

        // 固定CTAボタンの表示制御
        function handleFloatingCta() {
            const scrolled = window.pageYOffset;
            const floatingCta = document.getElementById('floatingCta');
            
            if (scrolled > 500) {
                floatingCta.classList.add('show');
            } else {
                floatingCta.classList.remove('show');
            }
        }

        // 統合スクロールイベントハンドラー
        window.addEventListener('scroll', function() {
            const header = document.querySelector('header');
            
            // ヘッダー透明度変更
            if (window.scrollY > 100) {
                header.style.background = 'rgba(0, 0, 0, 0.9)';
            } else {
                header.style.background = 'transparent';
            }
            
            // 新しいインタラクティブ機能
            updateScrollProgress();
            handleParallax();
            handleFloatingCta();
        });

        // スクロール時のアニメーション
        const observerOptions = {
            threshold: 0.1,
            rootMargin: '0px 0px -50px 0px'
        };

        const observer = new IntersectionObserver(function(entries) {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.style.opacity = '1';
                    entry.target.style.transform = 'translateY(0)';
                }
            });
        }, observerOptions);

        // アニメーション対象要素を監視
        document.querySelectorAll('.problem-card, .solution-card, .stat-card, .testimonial-card, .process-step').forEach(el => {
            el.style.opacity = '0';
            el.style.transform = 'translateY(30px)';
            el.style.transition = 'all 0.6s ease';
            observer.observe(el);
        });

        // FAQ アコーディオン
        document.querySelectorAll('.faq-question').forEach(question => {
            question.addEventListener('click', function() {
                const answer = this.nextElementSibling;
                const isActive = this.classList.contains('active');
                
                // 全てのQ&Aを閉じる
                document.querySelectorAll('.faq-question').forEach(q => {
                    q.classList.remove('active');
                    q.nextElementSibling.classList.remove('active');
                });
                
                // クリックされた項目のみトグル
                if (!isActive) {
                    this.classList.add('active');
                    answer.classList.add('active');
                }
            });
        });

        // 数字カウントアップアニメーション
        function animateNumbers() {
            document.querySelectorAll('.stat-number').forEach(element => {
                const text = element.textContent;
                const number = parseInt(text.replace(/[^0-9]/g, ''));
                const suffix = text.replace(/[0-9]/g, '');
                
                let current = 0;
                const increment = number / 50;
                const timer = setInterval(() => {
                    current += increment;
                    if (current >= number) {
                        element.textContent = number + suffix;
                        clearInterval(timer);
                    } else {
                        element.textContent = Math.floor(current) + suffix;
                    }
                }, 50);
            });
        }

        // 円グラフアニメーション
function animateCircularProgress() {
    const colors = ['#667eea', '#667eea', '#667eea', '#667eea', '#667eea', '#667eea'];
            
            document.querySelectorAll('.circular-progress').forEach((progressBar, index) => {
                const displayText = progressBar.querySelector('.percentage-text').textContent;
                const circle = progressBar.querySelector('.circle');
                const circumference = 100;
                
                // 数値から進捗率を計算（％記号を取り除いて数値に変換）
                let percentage = parseInt(displayText.replace('%', ''));
                
                // 色と初期状態を設定
                circle.style.stroke = colors[index % colors.length];
                circle.style.strokeDasharray = `0, ${circumference}`;
                circle.style.transition = 'stroke-dasharray 2s ease-in-out';
                
                // アニメーション開始
                setTimeout(() => {
                    circle.style.strokeDasharray = `${percentage}, ${circumference}`;
                }, 500 + (index * 200)); // 各円グラフを少しずつ遅らせる
            });
        }

        // 実績セクションが表示されたときに円グラフアニメーション実行
        const achievementsSection = document.querySelector('.achievements');
        const achievementsObserver = new IntersectionObserver(function(entries) {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    animateCircularProgress();
                    achievementsObserver.unobserve(entry.target);
                }
            });
        }, { threshold: 0.5 });

        if (achievementsSection) {
            achievementsObserver.observe(achievementsSection);
        }

        // ページ読み込み時の初期化
        window.addEventListener('load', function() {
            document.body.style.opacity = '1';
            
            // 初期状態の設定
            updateScrollProgress();
            handleFloatingCta();
        });

        // リサイズ時の処理
        window.addEventListener('resize', function() {
            updateScrollProgress();
        });