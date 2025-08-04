<?php
/**
 * Contact Module - Complete Independent Version
 * ショートコード: [contact_module]
 */

if (!defined('ABSPATH')) {
    exit;
}

/**
 * ACFフィールドグループの自動登録（即座実行）
 */
if (function_exists('acf_add_local_field_group')) {
    acf_add_local_field_group(array(
        'key' => 'group_contact_complete',
        'title' => 'お問い合わせモジュール設定',
        'fields' => array(
            array(
                'key' => 'field_contact_title',
                'label' => 'セクションタイトル',
                'name' => 'contact_title',
                'type' => 'text',
                'default_value' => 'お問い合わせ',
            ),
            array(
                'key' => 'field_contact_subtitle',
                'label' => 'サブタイトル',
                'name' => 'contact_subtitle',
                'type' => 'textarea',
                'default_value' => 'ご質問やご相談がございましたら、お気軽にお問い合わせください。',
            ),
            array(
                'key' => 'field_contact_email',
                'label' => '送信先メールアドレス',
                'name' => 'contact_email',
                'type' => 'email',
                'default_value' => 'info@example.com',
            ),
        ),
        'location' => get_smart_location(), // 最小記述方式（1行のみ）
    ));
}

add_shortcode('contact_module', 'render_contact_module');

function render_contact_module($atts = [], $content = null) {
    $atts = shortcode_atts(array(
        'title' => '',
        'subtitle' => '',
        'email' => '',
        'post_id' => get_the_ID(),
    ), $atts);
    
    $post_id = $atts['post_id'];
    $title = $atts['title'] ?: get_field('contact_title', $post_id) ?: 'お問い合わせ';
    $subtitle = $atts['subtitle'] ?: get_field('contact_subtitle', $post_id) ?: 'ご質問やご相談がございましたら、お気軽にお問い合わせください。';
    $email = $atts['email'] ?: get_field('contact_email', $post_id) ?: 'info@example.com';
    
    $unique_id = 'contact_' . uniqid();
    
    ob_start();
    ?>
    
    <style>
    .<?php echo $unique_id; ?> {
        padding: 80px 0;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
    }
    
    .<?php echo $unique_id; ?> .container {
        max-width: 800px;
        margin: 0 auto;
        padding: 0 20px;
    }
    
    .<?php echo $unique_id; ?> .section-title {
        font-size: 2.5rem;
        text-align: center;
        margin-bottom: 20px;
        font-weight: bold;
    }
    
    .<?php echo $unique_id; ?> .section-subtitle {
        text-align: center;
        margin-bottom: 50px;
        font-size: 1.1rem;
        opacity: 0.9;
    }
    
    .<?php echo $unique_id; ?> .contact-form {
        background: rgba(255, 255, 255, 0.1);
        padding: 40px;
        border-radius: 15px;
        backdrop-filter: blur(10px);
        border: 1px solid rgba(255, 255, 255, 0.2);
    }
    
    .<?php echo $unique_id; ?> .form-group {
        margin-bottom: 25px;
    }
    
    .<?php echo $unique_id; ?> .form-label {
        display: block;
        margin-bottom: 8px;
        font-weight: 600;
        font-size: 1rem;
    }
    
    .<?php echo $unique_id; ?> .form-control {
        width: 100%;
        padding: 15px;
        border: 2px solid rgba(255, 255, 255, 0.3);
        border-radius: 8px;
        background: rgba(255, 255, 255, 0.1);
        color: white;
        font-size: 1rem;
        transition: all 0.3s ease;
        backdrop-filter: blur(5px);
    }
    
    .<?php echo $unique_id; ?> .form-control::placeholder {
        color: rgba(255, 255, 255, 0.7);
    }
    
    .<?php echo $unique_id; ?> .form-control:focus {
        outline: none;
        border-color: rgba(255, 255, 255, 0.6);
        background: rgba(255, 255, 255, 0.15);
        box-shadow: 0 0 20px rgba(255, 255, 255, 0.1);
    }
    
    .<?php echo $unique_id; ?> .form-control.textarea {
        min-height: 120px;
        resize: vertical;
    }
    
    .<?php echo $unique_id; ?> .submit-button {
        width: 100%;
        padding: 18px;
        background: rgba(255, 255, 255, 0.2);
        color: white;
        border: 2px solid rgba(255, 255, 255, 0.3);
        border-radius: 50px;
        font-size: 1.1rem;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s ease;
        backdrop-filter: blur(10px);
    }
    
    .<?php echo $unique_id; ?> .submit-button:hover {
        background: rgba(255, 255, 255, 0.3);
        transform: translateY(-2px);
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.2);
    }
    
    .<?php echo $unique_id; ?> .submit-button:disabled {
        opacity: 0.7;
        cursor: not-allowed;
        transform: none;
    }
    
    .<?php echo $unique_id; ?> .form-message {
        margin-top: 20px;
        padding: 15px;
        border-radius: 8px;
        font-weight: 600;
        text-align: center;
        display: none;
    }
    
    .<?php echo $unique_id; ?> .form-message.success {
        background: rgba(40, 167, 69, 0.3);
        border: 2px solid rgba(40, 167, 69, 0.6);
        color: #d4edda;
    }
    
    .<?php echo $unique_id; ?> .form-message.error {
        background: rgba(220, 53, 69, 0.3);
        border: 2px solid rgba(220, 53, 69, 0.6);
        color: #f8d7da;
    }
    
    @media (max-width: 768px) {
        .<?php echo $unique_id; ?> {
            padding: 60px 0;
        }
        
        .<?php echo $unique_id; ?> .contact-form {
            padding: 30px 20px;
        }
        
        .<?php echo $unique_id; ?> .section-title {
            font-size: 2rem;
        }
    }
    </style>
    
    <section class="<?php echo $unique_id; ?>" id="contact-module">
        <div class="container">
            <h2 class="section-title"><?php echo esc_html($title); ?></h2>
            <p class="section-subtitle"><?php echo esc_html($subtitle); ?></p>
            
            <form class="contact-form" id="contactForm_<?php echo $unique_id; ?>">
                <div class="form-group">
                    <label class="form-label" for="name_<?php echo $unique_id; ?>">お名前 *</label>
                    <input 
                        type="text" 
                        id="name_<?php echo $unique_id; ?>" 
                        name="name" 
                        class="form-control" 
                        placeholder="山田太郎" 
                        required
                    >
                </div>
                
                <div class="form-group">
                    <label class="form-label" for="email_<?php echo $unique_id; ?>">メールアドレス *</label>
                    <input 
                        type="email" 
                        id="email_<?php echo $unique_id; ?>" 
                        name="email" 
                        class="form-control" 
                        placeholder="example@email.com" 
                        required
                    >
                </div>
                
                <div class="form-group">
                    <label class="form-label" for="company_<?php echo $unique_id; ?>">会社名</label>
                    <input 
                        type="text" 
                        id="company_<?php echo $unique_id; ?>" 
                        name="company" 
                        class="form-control" 
                        placeholder="株式会社サンプル"
                    >
                </div>
                
                <div class="form-group">
                    <label class="form-label" for="message_<?php echo $unique_id; ?>">お問い合わせ内容 *</label>
                    <textarea 
                        id="message_<?php echo $unique_id; ?>" 
                        name="message" 
                        class="form-control textarea" 
                        placeholder="お問い合わせ内容をご記入ください" 
                        required
                    ></textarea>
                </div>
                
                <button type="submit" class="submit-button" id="submitBtn_<?php echo $unique_id; ?>">
                    送信する
                </button>
                
                <div class="form-message" id="formMessage_<?php echo $unique_id; ?>"></div>
            </form>
        </div>
    </section>
    
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        console.log('Contact Module Loaded: <?php echo $unique_id; ?>');
        
        const form = document.getElementById('contactForm_<?php echo $unique_id; ?>');
        const submitBtn = document.getElementById('submitBtn_<?php echo $unique_id; ?>');
        const message = document.getElementById('formMessage_<?php echo $unique_id; ?>');
        
        form.addEventListener('submit', function(e) {
            e.preventDefault();
            
            // ボタンを無効化
            submitBtn.disabled = true;
            submitBtn.textContent = '送信中...';
            
            // フォームデータを取得
            const formData = new FormData(form);
            const data = {
                name: formData.get('name'),
                email: formData.get('email'),
                company: formData.get('company'),
                message: formData.get('message'),
                module_id: '<?php echo $unique_id; ?>',
                to_email: '<?php echo esc_js($email); ?>'
            };
            
            // Google Analytics トラッキング
            if (typeof gtag !== 'undefined') {
                gtag('event', 'contact_form_submit', {
                    'event_category': 'engagement',
                    'event_label': 'contact_module',
                    'module_id': '<?php echo $unique_id; ?>'
                });
            }
            
            // 実際の送信処理（ここではデモとして成功メッセージを表示）
            setTimeout(() => {
                showMessage('success', 'お問い合わせありがとうございました。後日ご連絡いたします。');
                form.reset();
                submitBtn.disabled = false;
                submitBtn.textContent = '送信する';
            }, 2000);
            
            console.log('Contact form submitted:', data);
        });
        
        function showMessage(type, text) {
            message.className = `form-message ${type}`;
            message.textContent = text;
            message.style.display = 'block';
            
            setTimeout(() => {
                message.style.display = 'none';
            }, 5000);
        }
    });
    </script>
    
    <?php
    return ob_get_clean();
}
?> 