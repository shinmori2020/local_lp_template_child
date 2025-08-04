// お問い合わせフォーム用JavaScript

document.addEventListener('DOMContentLoaded', function() {
    // 文字数カウンター (Style 2)
    const messageTextarea = document.getElementById('message2');
    const charCounter = document.getElementById('char-counter');
    
    if (messageTextarea && charCounter) {
        messageTextarea.addEventListener('input', function() {
            const currentLength = this.value.length;
            charCounter.textContent = currentLength;
            
            if (currentLength > 500) {
                charCounter.style.color = '#ff4757';
            } else if (currentLength > 400) {
                charCounter.style.color = '#ffa502';
            } else {
                charCounter.style.color = '#555';
            }
        });
    }
    
    // 文字数カウンター (Style 3)
    const messageTextarea3 = document.getElementById('message3');
    const charCounter3 = document.getElementById('char-counter3');
    
    if (messageTextarea3 && charCounter3) {
        messageTextarea3.addEventListener('input', function() {
            const currentLength = this.value.length;
            charCounter3.textContent = currentLength;
            
            if (currentLength > 1000) {
                charCounter3.style.color = '#F57C00';
            } else if (currentLength > 800) {
                charCounter3.style.color = '#FF8F00';
            } else {
                charCounter3.style.color = '#81C784';
            }
        });
    }
    
    // Style 3 ステップフォーム機能
    let currentStep = 1;
    const steps = document.querySelectorAll('.contact-style3 .step');
    const formSteps = document.querySelectorAll('.contact-style3 .form-step');
    const nextBtns = document.querySelectorAll('.contact-style3 .next-btn');
    const prevBtns = document.querySelectorAll('.contact-style3 .prev-btn');
    
    function updateStepIndicator(step) {
        steps.forEach((stepEl, index) => {
            stepEl.classList.toggle('active', index + 1 <= step);
        });
    }
    
    function showStep(step) {
        formSteps.forEach((stepEl, index) => {
            stepEl.classList.toggle('active', index + 1 === step);
        });
        updateStepIndicator(step);
        currentStep = step;
    }
    
    function validateStep(step) {
        const currentFormStep = document.querySelector(`.contact-style3 .form-step[data-step="${step}"]`);
        const requiredFields = currentFormStep.querySelectorAll('[required]');
        let isValid = true;
        
        requiredFields.forEach(field => {
            if (field.type === 'radio') {
                const radioGroup = currentFormStep.querySelectorAll(`[name="${field.name}"]`);
                const isChecked = Array.from(radioGroup).some(radio => radio.checked);
                if (!isChecked) {
                    isValid = false;
                    // ラジオボタンのエラー表示
                    radioGroup[0].closest('.form-group').classList.add('error');
                } else {
                    radioGroup[0].closest('.form-group').classList.remove('error');
                }
            } else if (!field.value.trim()) {
                isValid = false;
                field.classList.add('error');
            } else {
                field.classList.remove('error');
            }
        });
        
        return isValid;
    }
    
    function updateConfirmation() {
        // 基本情報の確認表示
        document.getElementById('confirm-name').textContent = 
            document.getElementById('name3').value || '-';
        document.getElementById('confirm-email').textContent = 
            document.getElementById('email3').value || '-';
        document.getElementById('confirm-phone').textContent = 
            document.getElementById('phone3').value || '-';
        document.getElementById('confirm-company').textContent = 
            document.getElementById('company3').value || '-';
        
        // カテゴリーの確認表示
        const selectedCategory = document.querySelector('input[name="category3"]:checked');
        if (selectedCategory) {
            const categoryCard = selectedCategory.closest('.category-card');
            const categoryTitle = categoryCard.querySelector('.card-title').textContent;
            document.getElementById('confirm-category').textContent = categoryTitle;
        } else {
            document.getElementById('confirm-category').textContent = '-';
        }
        
        // メッセージの確認表示
        const messageValue = document.getElementById('message3').value;
        document.getElementById('confirm-message').textContent = 
            messageValue.length > 100 ? messageValue.substring(0, 100) + '...' : messageValue || '-';
    }
    
    nextBtns.forEach(btn => {
        btn.addEventListener('click', function() {
            const nextStep = parseInt(this.dataset.next);
            
            if (validateStep(currentStep)) {
                if (nextStep === 3) {
                    updateConfirmation();
                }
                showStep(nextStep);
            } else {
                alert('必須項目を入力してください。');
            }
        });
    });
    
    prevBtns.forEach(btn => {
        btn.addEventListener('click', function() {
            const prevStep = parseInt(this.dataset.prev);
            showStep(prevStep);
        });
    });
    
    // ステップインジケーターのクリック機能
    steps.forEach((step, index) => {
        step.addEventListener('click', function() {
            const stepNum = index + 1;
            if (stepNum <= currentStep || validateStep(currentStep)) {
                if (stepNum === 3) {
                    updateConfirmation();
                }
                showStep(stepNum);
            }
        });
    });
    
    // フォーム送信処理
    const forms = document.querySelectorAll('.contact-form');
    forms.forEach(form => {
        form.addEventListener('submit', function(e) {
            e.preventDefault();
            
            // バリデーション
            const requiredFields = form.querySelectorAll('[required]');
            let isValid = true;
            
            requiredFields.forEach(field => {
                if (!field.value.trim()) {
                    isValid = false;
                    field.classList.add('error');
                } else {
                    field.classList.remove('error');
                }
            });
            
            if (isValid) {
                // 送信成功のメッセージ（実際のフォーム送信処理はここに実装）
                alert('お問い合わせを受け付けました。ありがとうございます！');
                form.reset();
                if (charCounter) {
                    charCounter.textContent = '0';
                }
            } else {
                alert('必須項目を入力してください。');
            }
        });
    });
    
    // エラースタイルをクリア
    const inputs = document.querySelectorAll('.form-input, .form-textarea, .form-select');
    inputs.forEach(input => {
        input.addEventListener('focus', function() {
            this.classList.remove('error');
        });
    });
}); 