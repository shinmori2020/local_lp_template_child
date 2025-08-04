// お問い合わせフォーム Style 5 - ダークテーマ・クリエイティブ JavaScript

document.addEventListener('DOMContentLoaded', function() {
    // フォーム要素の取得
    const formInputs = document.querySelectorAll('.contact-style5 .form-input, .contact-style5 .form-textarea, .contact-style5 .form-select');
    const interestCheckboxes = document.querySelectorAll('.contact-style5 .interest-checkbox');
    const privacyCheckbox = document.querySelector('.contact-style5 .privacy-checkbox');
    const submitBtn = document.querySelector('.contact-style5 .submit-btn');
    const form = document.querySelector('.contact-style5 .contact-form');

    // 入力フィールドのフォーカス効果
    formInputs.forEach(input => {
        // フォーカス時のエフェクト
        input.addEventListener('focus', function() {
            this.parentElement.classList.add('focused');
            createFocusRipple(this);
        });

        // フォーカス解除時のエフェクト
        input.addEventListener('blur', function() {
            this.parentElement.classList.remove('focused');
        });

        // 入力時のリアルタイム効果
        input.addEventListener('input', function() {
            if (this.value.length > 0) {
                this.parentElement.classList.add('has-content');
            } else {
                this.parentElement.classList.remove('has-content');
            }
        });
    });

    // フォーカス時のリップル効果
    function createFocusRipple(element) {
        const ripple = document.createElement('div');
        ripple.className = 'focus-ripple';
        ripple.style.cssText = `
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            border-radius: 15px;
            background: radial-gradient(circle, rgba(0, 212, 255, 0.3) 0%, transparent 70%);
            pointer-events: none;
            z-index: -1;
            animation: focusRipple 0.6s ease-out;
        `;
        
        element.parentElement.appendChild(ripple);
        
        setTimeout(() => {
            if (ripple.parentElement) {
                ripple.parentElement.removeChild(ripple);
            }
        }, 600);
    }

    // 興味分野チェックボックスの管理
    interestCheckboxes.forEach(checkbox => {
        checkbox.addEventListener('change', function() {
            const label = this.nextElementSibling;
            if (this.checked) {
                label.style.animation = 'pulseGlow 0.5s ease-out';
                createCheckEffect(label);
            } else {
                label.style.animation = '';
            }
        });

        // ラベルクリックでチェックボックスを切り替え
        const label = checkbox.nextElementSibling;
        if (label) {
            label.addEventListener('click', function(e) {
                e.preventDefault();
                checkbox.checked = !checkbox.checked;
                checkbox.dispatchEvent(new Event('change'));
            });
        }
    });

    // チェック時のエフェクト
    function createCheckEffect(element) {
        const particles = document.createElement('div');
        particles.className = 'check-particles';
        particles.innerHTML = '✨';
        particles.style.cssText = `
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            color: #00d4ff;
            font-size: 1.5rem;
            pointer-events: none;
            z-index: 100;
            animation: particlesBurst 1s ease-out forwards;
        `;
        
        element.style.position = 'relative';
        element.appendChild(particles);
        
        setTimeout(() => {
            if (particles.parentElement) {
                particles.parentElement.removeChild(particles);
            }
        }, 1000);
    }

    // プライバシーチェックボックスの管理
    if (privacyCheckbox) {
        const customCheckbox = privacyCheckbox.nextElementSibling;
        
        // カスタムチェックボックスのクリックイベント
        customCheckbox.addEventListener('click', function() {
            privacyCheckbox.checked = !privacyCheckbox.checked;
            privacyCheckbox.dispatchEvent(new Event('change'));
        });

        privacyCheckbox.addEventListener('change', function() {
            if (this.checked) {
                customCheckbox.style.animation = 'checkboxGlow 0.5s ease-out';
            }
            validateForm();
        });
    }

    // 文字数カウンターとリアルタイム検証
    const textarea = document.querySelector('.contact-style5 #message5');
    if (textarea) {
        const counter = document.createElement('div');
        counter.className = 'char-counter';
        counter.style.cssText = `
            position: absolute;
            bottom: 10px;
            right: 15px;
            color: #9ca3af;
            font-size: 0.85rem;
            font-weight: 600;
            pointer-events: none;
        `;
        
        textarea.parentElement.style.position = 'relative';
        textarea.parentElement.appendChild(counter);
        
        textarea.addEventListener('input', function() {
            const length = this.value.length;
            const maxLength = 1000;
            
            counter.textContent = `${length}/${maxLength}`;
            
            if (length > maxLength * 0.9) {
                counter.style.color = '#ff006e';
                counter.style.textShadow = '0 0 5px rgba(255, 0, 110, 0.5)';
            } else if (length > maxLength * 0.7) {
                counter.style.color = '#ff9f00';
                counter.style.textShadow = '0 0 5px rgba(255, 159, 0, 0.3)';
            } else {
                counter.style.color = '#00d4ff';
                counter.style.textShadow = '0 0 5px rgba(0, 212, 255, 0.3)';
            }
        });
        
        // 初期表示
        textarea.dispatchEvent(new Event('input'));
    }

    // フォーム検証
    function validateForm() {
        const requiredFields = document.querySelectorAll('.contact-style5 [required]');
        let isValid = true;
        
        requiredFields.forEach(field => {
            if (!field.value.trim() && field.type !== 'checkbox') {
                isValid = false;
            } else if (field.type === 'checkbox' && !field.checked) {
                isValid = false;
            }
        });
        
        // 送信ボタンの状態更新
        if (submitBtn) {
            if (isValid) {
                submitBtn.disabled = false;
                submitBtn.style.opacity = '1';
                submitBtn.style.cursor = 'pointer';
            } else {
                submitBtn.disabled = true;
                submitBtn.style.opacity = '0.6';
                submitBtn.style.cursor = 'not-allowed';
            }
        }
        
        return isValid;
    }

    // 全ての入力フィールドで検証を実行
    const allFormFields = document.querySelectorAll('.contact-style5 input, .contact-style5 textarea, .contact-style5 select');
    allFormFields.forEach(field => {
        field.addEventListener('input', validateForm);
        field.addEventListener('change', validateForm);
    });

    // 初期検証
    validateForm();

    // フォーム送信時のアニメーション
    if (form) {
        form.addEventListener('submit', function(e) {
            e.preventDefault();
            
            if (!validateForm()) {
                showNotification('必須項目を入力してください', 'error');
                return;
            }
            
            // 送信アニメーション
            submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> 送信中...';
            submitBtn.disabled = true;
            
            // グロー效果
            submitBtn.style.animation = 'submitGlow 2s ease-in-out infinite';
            
            // 模擬送信処理
            setTimeout(() => {
                showNotification('お問い合わせを受け付けました！', 'success');
                
                // フォームリセット
                form.reset();
                
                // 送信ボタン復元
                submitBtn.innerHTML = '<i class="fas fa-paper-plane"></i> 送信する';
                submitBtn.style.animation = '';
                
                // 全てのエフェクトをリセット
                document.querySelectorAll('.contact-style5 .has-content').forEach(el => {
                    el.classList.remove('has-content');
                });
                
                validateForm();
            }, 2000);
        });
    }

    // 通知システム
    function showNotification(message, type = 'info') {
        const notification = document.createElement('div');
        notification.className = `notification ${type}`;
        notification.textContent = message;
        notification.style.cssText = `
            position: fixed;
            top: 30px;
            right: 30px;
            padding: 15px 25px;
            border-radius: 10px;
            color: white;
            font-weight: 600;
            z-index: 1000;
            transform: translateX(400px);
            transition: transform 0.3s ease-out;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3);
        `;
        
        if (type === 'success') {
            notification.style.background = 'linear-gradient(135deg, #00d4ff, #8338ec)';
        } else if (type === 'error') {
            notification.style.background = 'linear-gradient(135deg, #ff006e, #ff4757)';
        }
        
        document.body.appendChild(notification);
        
        // アニメーション表示
        setTimeout(() => {
            notification.style.transform = 'translateX(0)';
        }, 100);
        
        // 自動削除
        setTimeout(() => {
            notification.style.transform = 'translateX(400px)';
            setTimeout(() => {
                if (notification.parentElement) {
                    notification.parentElement.removeChild(notification);
                }
            }, 300);
        }, 4000);
    }

    // 動的CSSアニメーションの追加
    const style = document.createElement('style');
    style.textContent = `
        @keyframes focusRipple {
            0% { transform: scale(0.8); opacity: 1; }
            100% { transform: scale(1.2); opacity: 0; }
        }
        
        @keyframes pulseGlow {
            0% { box-shadow: 0 0 5px rgba(0, 212, 255, 0.3); }
            50% { box-shadow: 0 0 20px rgba(0, 212, 255, 0.8), 0 0 30px rgba(0, 212, 255, 0.4); }
            100% { box-shadow: 0 0 5px rgba(0, 212, 255, 0.3); }
        }
        
        @keyframes particlesBurst {
            0% { transform: translate(-50%, -50%) scale(0); opacity: 1; }
            50% { transform: translate(-50%, -50%) scale(1.5); opacity: 0.8; }
            100% { transform: translate(-50%, -50%) scale(2) rotate(180deg); opacity: 0; }
        }
        
        @keyframes checkboxGlow {
            0% { box-shadow: 0 0 0 rgba(0, 212, 255, 0.5); }
            50% { box-shadow: 0 0 20px rgba(0, 212, 255, 0.8); }
            100% { box-shadow: 0 0 15px rgba(0, 212, 255, 0.5); }
        }
        
        @keyframes submitGlow {
            0%, 100% { box-shadow: 0 10px 30px rgba(0, 212, 255, 0.4); }
            50% { box-shadow: 0 15px 40px rgba(0, 212, 255, 0.8), 0 0 30px rgba(255, 0, 110, 0.6); }
        }
    `;
    document.head.appendChild(style);
}); 