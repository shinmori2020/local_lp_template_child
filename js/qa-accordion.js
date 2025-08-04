// Q&A アコーディオン JavaScript

document.addEventListener('DOMContentLoaded', function() {
    // 要素の取得
    const qaItems = document.querySelectorAll('.qa-item');
    const searchInput = document.querySelector('.qa-search-input');
    const categoryBtns = document.querySelectorAll('.category-btn');
    
    let activeCategory = 'all';
    
    // アコーディオンの初期化
    initAccordion();
    
    // 検索機能の初期化
    if (searchInput) {
        initSearch();
    }
    
    // カテゴリフィルターの初期化
    if (categoryBtns.length > 0) {
        initCategoryFilter();
    }
    
    // アコーディオン機能
    function initAccordion() {
        qaItems.forEach(item => {
            const question = item.querySelector('.qa-question');
            const answer = item.querySelector('.qa-answer');
            
            if (question && answer) {
                question.addEventListener('click', function() {
                    toggleAccordion(item);
                });
                
                // キーボードアクセシビリティ
                question.addEventListener('keydown', function(e) {
                    if (e.key === 'Enter' || e.key === ' ') {
                        e.preventDefault();
                        toggleAccordion(item);
                    }
                });
                
                // tabindex を設定
                question.setAttribute('tabindex', '0');
                question.setAttribute('role', 'button');
                question.setAttribute('aria-expanded', 'false');
                
                // 回答部分にIDを設定
                const answerId = `answer-${Math.random().toString(36).substr(2, 9)}`;
                answer.setAttribute('id', answerId);
                question.setAttribute('aria-controls', answerId);
            }
        });
    }
    
    // アコーディオンの開閉
    function toggleAccordion(item) {
        const isActive = item.classList.contains('active');
        const question = item.querySelector('.qa-question');
        const answer = item.querySelector('.qa-answer');
        
        if (isActive) {
            // 閉じる
            item.classList.remove('active');
            question.setAttribute('aria-expanded', 'false');
            answer.style.maxHeight = '0';
        } else {
            // 開く
            item.classList.add('active');
            question.setAttribute('aria-expanded', 'true');
            
            // 実際の高さを取得して設定
            const answerContent = answer.querySelector('.qa-answer-content');
            const contentHeight = answerContent.scrollHeight;
            answer.style.maxHeight = contentHeight + 'px';
            
            // スムーズスクロール
            setTimeout(() => {
                item.scrollIntoView({
                    behavior: 'smooth',
                    block: 'start'
                });
            }, 100);
        }
        
        // 統計更新
        updateStats();
    }
    
    // 検索機能
    function initSearch() {
        let searchTimeout;
        
        searchInput.addEventListener('input', function() {
            clearTimeout(searchTimeout);
            searchTimeout = setTimeout(() => {
                performSearch(this.value.trim());
            }, 300);
        });
        
        // 検索クリア
        searchInput.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                this.value = '';
                performSearch('');
            }
        });
    }
    
    // 検索実行
    function performSearch(query) {
        const lowerQuery = query.toLowerCase();
        let visibleCount = 0;
        
        qaItems.forEach(item => {
            const questionText = item.querySelector('.qa-question-text').textContent.toLowerCase();
            const answerText = item.querySelector('.qa-answer-text').textContent.toLowerCase();
            const category = item.getAttribute('data-category') || '';
            
            const matchesSearch = !query || 
                questionText.includes(lowerQuery) || 
                answerText.includes(lowerQuery);
            
            const matchesCategory = activeCategory === 'all' || 
                category === activeCategory;
            
            if (matchesSearch && matchesCategory) {
                item.style.display = 'block';
                item.style.animation = `fadeInUp 0.6s ease-out ${visibleCount * 0.1}s both`;
                visibleCount++;
            } else {
                item.style.display = 'none';
            }
        });
        
        // 検索結果がない場合の表示
        showNoResultsMessage(visibleCount === 0 && (query || activeCategory !== 'all'));
        
        // 統計更新
        updateStats();
    }
    
    // カテゴリフィルター
    function initCategoryFilter() {
        categoryBtns.forEach(btn => {
            btn.addEventListener('click', function() {
                // アクティブ状態の管理
                categoryBtns.forEach(b => b.classList.remove('active'));
                this.classList.add('active');
                
                // カテゴリの更新
                activeCategory = this.getAttribute('data-category') || 'all';
                
                // フィルタリング実行
                const searchQuery = searchInput ? searchInput.value.trim() : '';
                performSearch(searchQuery);
            });
        });
    }
    
    // 結果なしメッセージ
    function showNoResultsMessage(show) {
        let noResultsEl = document.querySelector('.qa-no-results');
        
        if (show && !noResultsEl) {
            noResultsEl = document.createElement('div');
            noResultsEl.className = 'qa-no-results';
            noResultsEl.innerHTML = `
                <div style="text-align: center; padding: 60px 20px; color: #7f8c8d;">
                    <i class="fas fa-search" style="font-size: 3rem; margin-bottom: 20px; opacity: 0.3;"></i>
                    <h3 style="margin: 0 0 10px 0; font-size: 1.5rem;">検索結果が見つかりません</h3>
                    <p style="margin: 0; font-size: 1rem;">別のキーワードで検索するか、カテゴリを変更してお試しください。</p>
                </div>
            `;
            
            const qaList = document.querySelector('.qa-list');
            qaList.appendChild(noResultsEl);
        } else if (!show && noResultsEl) {
            noResultsEl.remove();
        }
    }
    
    // 統計更新
    function updateStats() {
        const totalItems = qaItems.length;
        const visibleItems = Array.from(qaItems).filter(item => 
            item.style.display !== 'none'
        ).length;
        const activeItems = document.querySelectorAll('.qa-item.active').length;
        
        // 統計要素を更新
        updateStatNumber('total-questions', totalItems);
        updateStatNumber('visible-questions', visibleItems);
        updateStatNumber('active-questions', activeItems);
    }
    
    // 統計数値更新
    function updateStatNumber(id, value) {
        const element = document.getElementById(id);
        if (element) {
            animateNumber(element, parseInt(element.textContent) || 0, value);
        }
    }
    
    // 数値アニメーション
    function animateNumber(element, start, end) {
        if (start === end) return;
        
        const duration = 500;
        const startTime = performance.now();
        
        function update(currentTime) {
            const elapsed = currentTime - startTime;
            const progress = Math.min(elapsed / duration, 1);
            
            const current = Math.round(start + (end - start) * easeOutQuart(progress));
            element.textContent = current;
            
            if (progress < 1) {
                requestAnimationFrame(update);
            }
        }
        
        requestAnimationFrame(update);
    }
    
    // イージング関数
    function easeOutQuart(t) {
        return 1 - Math.pow(1 - t, 4);
    }
    
    // 全て開く/閉じる機能
    window.toggleAllAccordions = function(open = null) {
        const visibleItems = Array.from(qaItems).filter(item => 
            item.style.display !== 'none'
        );
        
        visibleItems.forEach((item, index) => {
            const isActive = item.classList.contains('active');
            const shouldOpen = open !== null ? open : !isActive;
            
            if (shouldOpen !== isActive) {
                setTimeout(() => {
                    toggleAccordion(item);
                }, index * 100);
            }
        });
    };
    
    // キーボードショートカット
    document.addEventListener('keydown', function(e) {
        // Ctrl/Cmd + K で検索フォーカス
        if ((e.ctrlKey || e.metaKey) && e.key === 'k') {
            e.preventDefault();
            if (searchInput) {
                searchInput.focus();
                searchInput.select();
            }
        }
        
        // Ctrl/Cmd + Enter で全て開く
        if ((e.ctrlKey || e.metaKey) && e.key === 'Enter') {
            e.preventDefault();
            toggleAllAccordions(true);
        }
        
        // Ctrl/Cmd + Backspace で全て閉じる
        if ((e.ctrlKey || e.metaKey) && e.key === 'Backspace') {
            e.preventDefault();
            toggleAllAccordions(false);
        }
    });
    
    // 初期統計表示
    updateStats();
    
    // リサイズ時の高さ調整
    window.addEventListener('resize', function() {
        const activeItems = document.querySelectorAll('.qa-item.active');
        activeItems.forEach(item => {
            const answer = item.querySelector('.qa-answer');
            const answerContent = answer.querySelector('.qa-answer-content');
            answer.style.maxHeight = answerContent.scrollHeight + 'px';
        });
    });
    
    // インターセクションオブザーバーでアニメーション最適化
    const observerOptions = {
        threshold: 0.1,
        rootMargin: '50px'
    };
    
    const observer = new IntersectionObserver(function(entries) {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.style.animationPlayState = 'running';
            }
        });
    }, observerOptions);
    
    qaItems.forEach(item => {
        item.style.animationPlayState = 'paused';
        observer.observe(item);
    });
}); 