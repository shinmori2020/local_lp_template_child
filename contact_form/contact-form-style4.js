// お問い合わせフォーム Style 4 - JavaScript

document.addEventListener('DOMContentLoaded', function() {
    // 優先度カードの選択状態管理
    const priorityCards = document.querySelectorAll('.contact-style4 .priority-card');
    
    priorityCards.forEach(card => {
        const radio = card.querySelector('input[type="radio"]');
        
        // カードクリック時にラジオボタンを選択
        card.addEventListener('click', function() {
            radio.checked = true;
            updatePriorityCards();
        });
        
        // ラジオボタンの変更を監視
        radio.addEventListener('change', updatePriorityCards);
    });
    
    function updatePriorityCards() {
        priorityCards.forEach(card => {
            const radio = card.querySelector('input[type="radio"]');
            if (radio.checked) {
                card.classList.add('selected');
            } else {
                card.classList.remove('selected');
            }
        });
    }
    
    // 初期状態で選択状態を更新
    updatePriorityCards();
    
    // カスタムチェックボックスの管理
    const customCheckboxes = document.querySelectorAll('.contact-style4 .custom-checkbox-wrapper');
    
    customCheckboxes.forEach(wrapper => {
        const checkbox = wrapper.querySelector('input[type="checkbox"]');
        const customCheckbox = wrapper.querySelector('.custom-checkbox');
        
        // ラッパークリック時にチェックボックスの状態を切り替え
        wrapper.addEventListener('click', function(e) {
            if (e.target !== checkbox) {
                e.preventDefault();
                checkbox.checked = !checkbox.checked;
                updateCheckbox(customCheckbox, checkbox.checked);
            }
        });
        
        // チェックボックスの変更を監視
        checkbox.addEventListener('change', function() {
            updateCheckbox(customCheckbox, checkbox.checked);
        });
    });
    
    function updateCheckbox(customCheckbox, isChecked) {
        if (isChecked) {
            customCheckbox.classList.add('checked');
        } else {
            customCheckbox.classList.remove('checked');
        }
    }
    
    // 文字数カウンター（メッセージエリア用）
    const messageTextarea = document.querySelector('#message4');
    if (messageTextarea) {
        const charCountWrapper = document.createElement('div');
        charCountWrapper.className = 'char-count-wrapper';
        charCountWrapper.innerHTML = '<span class="char-count"><span id="char-counter4">0</span>/1000文字</span>';
        messageTextarea.parentElement.appendChild(charCountWrapper);
        
        const charCounter = document.getElementById('char-counter4');
        
        messageTextarea.addEventListener('input', function() {
            const currentLength = this.value.length;
            charCounter.textContent = currentLength;
            
            // 文字数制限の警告
            const charCountElement = charCountWrapper.querySelector('.char-count');
            if (currentLength > 1000) {
                charCountElement.style.color = '#e74c3c';
            } else if (currentLength > 800) {
                charCountElement.style.color = '#f39c12';
            } else {
                charCountElement.style.color = '#666';
            }
        });
    }
}); 