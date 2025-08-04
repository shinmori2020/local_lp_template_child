<?php
/**
 * Template Name: カスタムテンプレート　お問合せフォーム
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
    <link rel="stylesheet" href="<?php echo get_stylesheet_directory_uri(); ?>/css/firstview.css">
    <link rel="stylesheet" href="<?php echo get_stylesheet_directory_uri(); ?>/contact_form/contact-form-style1.css">
    <link rel="stylesheet" href="<?php echo get_stylesheet_directory_uri(); ?>/contact_form/contact-form-style2.css">
    <link rel="stylesheet" href="<?php echo get_stylesheet_directory_uri(); ?>/contact_form/contact-form-style3.css">
    <link rel="stylesheet" href="<?php echo get_stylesheet_directory_uri(); ?>/contact_form/contact-form-style4.css">
    <link rel="stylesheet" href="<?php echo get_stylesheet_directory_uri(); ?>/contact_form/contact-form-style5.css">

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

    <!-- メインコンテンツ -->
    <main class="main-content">
        <!-- お問い合わせフォーム スタイル1 (モダン・ミニマル) -->
        <section class="contact-section contact-style1" id="contact-form-1">
            <div class="container">
                <div class="section-header">
                    <h2 class="section-title">お問い合わせ - Style 1</h2>
                    <p class="section-description">モダンでミニマルなデザインのお問い合わせフォームです。</p>
                </div>
                <div class="contact-form-wrapper">
                    <form class="contact-form" action="#" method="post">
                        <div class="form-group">
                            <label for="name1" class="form-label">お名前 <span class="required">*</span></label>
                            <input type="text" id="name1" name="name1" class="form-input" required>
                        </div>
                        <div class="form-group">
                            <label for="email1" class="form-label">メールアドレス <span class="required">*</span></label>
                            <input type="email" id="email1" name="email1" class="form-input" required>
                        </div>
                        <div class="form-group">
                            <label for="phone1" class="form-label">電話番号</label>
                            <input type="tel" id="phone1" name="phone1" class="form-input">
                        </div>
                        <div class="form-group">
                            <label for="company1" class="form-label">会社名</label>
                            <input type="text" id="company1" name="company1" class="form-input">
                        </div>
                        <div class="form-group">
                            <label for="subject1" class="form-label">件名 <span class="required">*</span></label>
                            <select id="subject1" name="subject1" class="form-select" required>
                                <option value="">選択してください</option>
                                <option value="inquiry">お問い合わせ</option>
                                <option value="consultation">ご相談</option>
                                <option value="support">サポート</option>
                                <option value="other">その他</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="message1" class="form-label">メッセージ <span class="required">*</span></label>
                            <textarea id="message1" name="message1" class="form-textarea" rows="6" required></textarea>
                        </div>
                        <div class="form-group">
                            <label class="checkbox-wrapper">
                                <input type="checkbox" name="privacy1" required>
                                <span class="checkmark"></span>
                                <span class="checkbox-text">プライバシーポリシーに同意します <span class="required">*</span></span>
                            </label>
                        </div>
                        <div class="form-submit">
                            <button type="submit" class="submit-btn">送信する</button>
                        </div>
                    </form>
                </div>
            </div>
        </section>

        <!-- お問い合わせフォーム スタイル2 (落ち着いた色・モダン) -->
        <section class="contact-section contact-style2" id="contact-form-2">
            <div class="container">
                <div class="section-header">
                    <h2 class="section-title">お問い合わせ - Style 2</h2>
                    <p class="section-description">落ち着いた色合いでモダンなデザインのお問い合わせフォームです。</p>
                </div>
                <div class="contact-form-wrapper">
                    <div class="form-card">
                        <div class="form-card-header">
                            <h3>お気軽にお問い合わせください！</h3>
                            <p>24時間以内にご返信いたします</p>
                        </div>
                        <form class="contact-form" action="#" method="post">
                            <div class="form-row">
                                <div class="form-group half">
                                    <label for="name2" class="form-label">
                                        <i class="fas fa-user"></i>
                                        お名前 <span class="required">*</span>
                                    </label>
                                    <input type="text" id="name2" name="name2" class="form-input" placeholder="山田太郎" required>
                                </div>
                                <div class="form-group half">
                                    <label for="email2" class="form-label">
                                        <i class="fas fa-envelope"></i>
                                        メールアドレス <span class="required">*</span>
                                    </label>
                                    <input type="email" id="email2" name="email2" class="form-input" placeholder="example@email.com" required>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group half">
                                    <label for="phone2" class="form-label">
                                        <i class="fas fa-phone"></i>
                                        電話番号
                                    </label>
                                    <input type="tel" id="phone2" name="phone2" class="form-input" placeholder="090-0000-0000">
                                </div>
                                <div class="form-group half">
                                    <label for="company2" class="form-label">
                                        <i class="fas fa-building"></i>
                                        会社名
                                    </label>
                                    <input type="text" id="company2" name="company2" class="form-input" placeholder="株式会社○○">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="subject2" class="form-label">
                                    <i class="fas fa-tag"></i>
                                    お問い合わせ種別 <span class="required">*</span>
                                </label>
                                <div class="radio-group">
                                    <label class="radio-option">
                                        <input type="radio" name="subject2" value="inquiry" required>
                                        <span class="radio-button"></span>
                                        <span class="radio-text">一般のお問い合わせ</span>
                                    </label>
                                    <label class="radio-option">
                                        <input type="radio" name="subject2" value="consultation" required>
                                        <span class="radio-button"></span>
                                        <span class="radio-text">ご相談・お見積り</span>
                                    </label>
                                    <label class="radio-option">
                                        <input type="radio" name="subject2" value="support" required>
                                        <span class="radio-button"></span>
                                        <span class="radio-text">サポート</span>
                                    </label>
                                    <label class="radio-option">
                                        <input type="radio" name="subject2" value="other" required>
                                        <span class="radio-button"></span>
                                        <span class="radio-text">その他</span>
                                    </label>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="message2" class="form-label">
                                    <i class="fas fa-comment"></i>
                                    メッセージ <span class="required">*</span>
                                </label>
                                <textarea id="message2" name="message2" class="form-textarea" rows="5" placeholder="お問い合わせ内容をお書きください..." required></textarea>
                                <div class="char-count">
                                    <span id="char-counter">0</span>/500文字
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="checkbox-wrapper fancy">
                                    <input type="checkbox" name="privacy2" required>
                                    <span class="fancy-checkbox">
                                        <i class="fas fa-check"></i>
                                    </span>
                                    <span class="checkbox-text">
                                        <a href="#" target="_blank">プライバシーポリシー</a>に同意します <span class="required">*</span>
                                    </span>
                                </label>
                            </div>
                            <div class="form-submit">
                                <button type="submit" class="submit-btn">
                                    <i class="fas fa-paper-plane"></i>
                                    送信する
                                </button>
                                <p class="submit-note">送信後、確認メールをお送りします</p>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>

        <!-- お問い合わせフォーム スタイル3 (温かみのある・親しみやすい) -->
        <section class="contact-section contact-style3" id="contact-form-3">
            <div class="container">
                <div class="section-header">
                    <div class="header-icon">
                        <i class="fas fa-envelope-open"></i>
                    </div>
                    <h2 class="section-title">お問い合わせ - Style 3</h2>
                    <p class="section-description">温かみのある親しみやすいデザインのお問い合わせフォームです。</p>
                </div>
                <div class="contact-form-container">
                    <div class="form-steps">
                        <div class="step active" data-step="1">
                            <span class="step-number">1</span>
                            <span class="step-text">基本情報</span>
                        </div>
                        <div class="step" data-step="2">
                            <span class="step-number">2</span>
                            <span class="step-text">お問い合わせ内容</span>
                        </div>
                        <div class="step" data-step="3">
                            <span class="step-number">3</span>
                            <span class="step-text">確認・送信</span>
                        </div>
                    </div>
                    
                    <div class="form-wrapper">
                        <form class="contact-form" action="#" method="post">
                            <!-- Step 1: 基本情報 -->
                            <div class="form-step active" data-step="1">
                                <div class="step-header">
                                    <h3><i class="fas fa-user-circle"></i> 基本情報を入力してください</h3>
                                    <p>まずはあなたの基本情報を教えてください</p>
                                </div>
                                <div class="form-grid">
                                    <div class="form-group">
                                        <div class="input-wrapper">
                                            <i class="fas fa-user input-icon"></i>
                                            <input type="text" id="name3" name="name3" class="form-input" required>
                                            <label for="name3" class="floating-label">お名前 <span class="required">*</span></label>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="input-wrapper">
                                            <i class="fas fa-at input-icon"></i>
                                            <input type="email" id="email3" name="email3" class="form-input" required>
                                            <label for="email3" class="floating-label">メールアドレス <span class="required">*</span></label>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="input-wrapper">
                                            <i class="fas fa-phone input-icon"></i>
                                            <input type="tel" id="phone3" name="phone3" class="form-input">
                                            <label for="phone3" class="floating-label">電話番号</label>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="input-wrapper">
                                            <i class="fas fa-building input-icon"></i>
                                            <input type="text" id="company3" name="company3" class="form-input">
                                            <label for="company3" class="floating-label">会社名</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="step-actions">
                                    <button type="button" class="next-btn" data-next="2">
                                        次へ進む <i class="fas fa-arrow-right"></i>
                                    </button>
                                </div>
                            </div>

                            <!-- Step 2: お問い合わせ内容 -->
                            <div class="form-step" data-step="2">
                                <div class="step-header">
                                    <h3><i class="fas fa-comment-dots"></i> お問い合わせ内容</h3>
                                    <p>どのようなことでお問い合わせでしょうか？</p>
                                </div>
                                
                                <div class="form-group">
                                    <label class="section-label">
                                        <i class="fas fa-tags"></i>
                                        お問い合わせの種類 <span class="required">*</span>
                                    </label>
                                    <div class="category-grid">
                                        <label class="category-card">
                                            <input type="radio" name="category3" value="general" required>
                                            <div class="card-content">
                                                <i class="fas fa-question-circle"></i>
                                                <span class="card-title">一般的なお問い合わせ</span>
                                                <span class="card-desc">サービスについて知りたい</span>
                                            </div>
                                        </label>
                                        <label class="category-card">
                                            <input type="radio" name="category3" value="quote" required>
                                            <div class="card-content">
                                                <i class="fas fa-calculator"></i>
                                                <span class="card-title">お見積り依頼</span>
                                                <span class="card-desc">料金を知りたい</span>
                                            </div>
                                        </label>
                                        <label class="category-card">
                                            <input type="radio" name="category3" value="support" required>
                                            <div class="card-content">
                                                <i class="fas fa-life-ring"></i>
                                                <span class="card-title">サポート</span>
                                                <span class="card-desc">困っていることがある</span>
                                            </div>
                                        </label>
                                        <label class="category-card">
                                            <input type="radio" name="category3" value="partnership" required>
                                            <div class="card-content">
                                                <i class="fas fa-handshake"></i>
                                                <span class="card-title">提携・協業</span>
                                                <span class="card-desc">一緒に仕事をしたい</span>
                                            </div>
                                        </label>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="section-label">
                                        <i class="fas fa-edit"></i>
                                        詳細メッセージ <span class="required">*</span>
                                    </label>
                                    <div class="textarea-wrapper">
                                        <textarea id="message3" name="message3" class="form-textarea" rows="6" required></textarea>
                                        <div class="textarea-footer">
                                            <span class="char-count">
                                                <span id="char-counter3">0</span>/1000文字
                                            </span>
                                            <span class="emoji-hint">😊 お気軽にお書きください</span>
                                        </div>
                                    </div>
                                </div>

                                <div class="step-actions">
                                    <button type="button" class="prev-btn" data-prev="1">
                                        <i class="fas fa-arrow-left"></i> 戻る
                                    </button>
                                    <button type="button" class="next-btn" data-next="3">
                                        確認画面へ <i class="fas fa-arrow-right"></i>
                                    </button>
                                </div>
                            </div>

                            <!-- Step 3: 確認・送信 -->
                            <div class="form-step" data-step="3">
                                <div class="step-header">
                                    <h3><i class="fas fa-check-circle"></i> 入力内容の確認</h3>
                                    <p>以下の内容でお間違いありませんか？</p>
                                </div>

                                <div class="confirmation-card">
                                    <div class="confirm-section">
                                        <h4><i class="fas fa-user"></i> 基本情報</h4>
                                        <div class="confirm-grid">
                                            <div class="confirm-item">
                                                <span class="confirm-label">お名前</span>
                                                <span class="confirm-value" id="confirm-name">-</span>
                                            </div>
                                            <div class="confirm-item">
                                                <span class="confirm-label">メールアドレス</span>
                                                <span class="confirm-value" id="confirm-email">-</span>
                                            </div>
                                            <div class="confirm-item">
                                                <span class="confirm-label">電話番号</span>
                                                <span class="confirm-value" id="confirm-phone">-</span>
                                            </div>
                                            <div class="confirm-item">
                                                <span class="confirm-label">会社名</span>
                                                <span class="confirm-value" id="confirm-company">-</span>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="confirm-section">
                                        <h4><i class="fas fa-comment"></i> お問い合わせ内容</h4>
                                        <div class="confirm-item">
                                            <span class="confirm-label">種類</span>
                                            <span class="confirm-value" id="confirm-category">-</span>
                                        </div>
                                        <div class="confirm-item">
                                            <span class="confirm-label">メッセージ</span>
                                            <span class="confirm-value" id="confirm-message">-</span>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="checkbox-wrapper">
                                        <input type="checkbox" name="privacy3" required>
                                        <span class="custom-checkbox">
                                            <i class="fas fa-check"></i>
                                        </span>
                                        <span class="checkbox-text">
                                            <a href="#" target="_blank">プライバシーポリシー</a>に同意し、入力内容を送信します <span class="required">*</span>
                                        </span>
                                    </label>
                                </div>

                                <div class="step-actions">
                                    <button type="button" class="prev-btn" data-prev="2">
                                        <i class="fas fa-arrow-left"></i> 戻って修正
                                    </button>
                                    <button type="submit" class="submit-btn">
                                        <i class="fas fa-paper-plane"></i>
                                        送信する
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>

        <!-- お問い合わせフォーム スタイル4 (エレガント・プロフェッショナル) -->
        <section class="contact-section contact-style4" id="contact-form-4">
            <div class="container">
                <div class="section-header">
                    <h2 class="section-title">お問い合わせ - Style 4</h2>
                    <p class="section-description">エレガントでプロフェッショナルなデザインのお問い合わせフォームです。グラデーション背景と美しいアニメーション効果で、洗練された印象を与えます。</p>
                </div>
                
                <div class="form-container">
                    <div class="form-card">
                        <div class="form-header">
                            <h3>お気軽にご相談ください</h3>
                            <p>プロフェッショナルなサポートをご提供いたします</p>
                        </div>
                        
                        <form class="contact-form" action="#" method="post">
                            <div class="form-grid">
                                <div class="form-group">
                                    <label for="name4" class="form-label">お名前 <span class="required">*</span></label>
                                    <div class="input-container">
                                        <input type="text" id="name4" name="name4" class="form-input" required>
                                    </div>
                                </div>
                                
                                <div class="form-group">
                                    <label for="email4" class="form-label">メールアドレス <span class="required">*</span></label>
                                    <div class="input-container">
                                        <input type="email" id="email4" name="email4" class="form-input" required>
                                    </div>
                                </div>
                                
                                <div class="form-group">
                                    <label for="phone4" class="form-label">電話番号</label>
                                    <div class="input-container">
                                        <input type="tel" id="phone4" name="phone4" class="form-input">
                                    </div>
                                </div>
                                
                                <div class="form-group">
                                    <label for="company4" class="form-label">会社名・組織名</label>
                                    <div class="input-container">
                                        <input type="text" id="company4" name="company4" class="form-input">
                                    </div>
                                </div>
                                
                                <div class="form-group">
                                    <label for="position4" class="form-label">役職・部署</label>
                                    <div class="input-container">
                                        <input type="text" id="position4" name="position4" class="form-input">
                                    </div>
                                </div>
                                
                                <div class="form-group">
                                    <label for="budget4" class="form-label">ご予算</label>
                                    <div class="input-container">
                                        <select id="budget4" name="budget4" class="form-select">
                                            <option value="">選択してください</option>
                                            <option value="under-100k">10万円未満</option>
                                            <option value="100k-500k">10万円〜50万円</option>
                                            <option value="500k-1m">50万円〜100万円</option>
                                            <option value="1m-5m">100万円〜500万円</option>
                                            <option value="over-5m">500万円以上</option>
                                            <option value="consultation">要相談</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="priority-section">
                                <label class="form-label">
                                    お問い合わせの優先度 <span class="required">*</span>
                                </label>
                                <div class="priority-options">
                                    <div class="priority-option">
                                        <label class="priority-card">
                                            <input type="radio" name="priority4" value="urgent" required>
                                            <span class="priority-icon">🔥</span>
                                            <span class="priority-text">緊急</span>
                                        </label>
                                    </div>
                                    <div class="priority-option">
                                        <label class="priority-card">
                                            <input type="radio" name="priority4" value="high" required>
                                            <span class="priority-icon">⚡</span>
                                            <span class="priority-text">高</span>
                                        </label>
                                    </div>
                                    <div class="priority-option">
                                        <label class="priority-card">
                                            <input type="radio" name="priority4" value="normal" required>
                                            <span class="priority-icon">📝</span>
                                            <span class="priority-text">通常</span>
                                        </label>
                                    </div>
                                    <div class="priority-option">
                                        <label class="priority-card">
                                            <input type="radio" name="priority4" value="low" required>
                                            <span class="priority-icon">📅</span>
                                            <span class="priority-text">低</span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="form-group full-width">
                                <label for="message4" class="form-label">お問い合わせ内容 <span class="required">*</span></label>
                                <div class="input-container">
                                    <textarea id="message4" name="message4" class="form-textarea" rows="6" required></textarea>
                                </div>
                            </div>
                            
                            <div class="checkbox-group">
                                <label class="custom-checkbox-wrapper">
                                    <div class="custom-checkbox">
                                        <input type="checkbox" name="privacy4" required>
                                        <span class="checkmark">
                                            <i class="fas fa-check"></i>
                                        </span>
                                    </div>
                                    <span class="checkbox-text">
                                        <a href="#" target="_blank">プライバシーポリシー</a>および<a href="#" target="_blank">利用規約</a>に同意します <span class="required">*</span>
                                    </span>
                                </label>
                            </div>
                            
                            <div class="checkbox-group">
                                <label class="custom-checkbox-wrapper">
                                    <div class="custom-checkbox">
                                        <input type="checkbox" name="newsletter4">
                                        <span class="checkmark">
                                            <i class="fas fa-check"></i>
                                        </span>
                                    </div>
                                    <span class="checkbox-text">
                                        メールマガジンの配信を希望します（サービス情報や優待情報をお届けします）
                                    </span>
                                </label>
                            </div>
                            
                            <div class="submit-section">
                                <button type="submit" class="submit-btn">
                                    <i class="fas fa-paper-plane"></i>
                                    送信する
                                </button>
                                <p class="submit-note">通常24時間以内にご返信いたします</p>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>

        <!-- お問い合わせフォーム スタイル5 (ダークテーマ・クリエイティブ) -->
        <section class="contact-section contact-style5" id="contact-form-5">
            <div class="container">
                <div class="section-header">
                    <h2 class="section-title">お問い合わせ - Style 5</h2>
                    <p class="section-description">ダークテーマとネオン効果で未来的な印象を与える、クリエイティブなお問い合わせフォームです。動的なアニメーションと美しいグラデーションで、印象的なユーザー体験を提供します。</p>
                </div>
                
                <div class="form-container">
                    <div class="form-wrapper">
                        <div class="form-header">
                            <h3>未来へのメッセージ</h3>
                            <p>革新的なソリューションをお探しですか？お気軽にご相談ください。</p>
                        </div>
                        
                        <form class="contact-form" action="#" method="post">
                            <div class="form-layout">
                                <div class="form-group">
                                    <label for="name5" class="form-label">お名前 <span class="required">*</span></label>
                                    <div class="input-wrapper">
                                        <input type="text" id="name5" name="name5" class="form-input" required>
                                    </div>
                                </div>
                                
                                <div class="form-group">
                                    <label for="email5" class="form-label">メールアドレス <span class="required">*</span></label>
                                    <div class="input-wrapper">
                                        <input type="email" id="email5" name="email5" class="form-input" required>
                                    </div>
                                </div>
                                
                                <div class="form-group">
                                    <label for="phone5" class="form-label">電話番号</label>
                                    <div class="input-wrapper">
                                        <input type="tel" id="phone5" name="phone5" class="form-input">
                                    </div>
                                </div>
                                
                                <div class="form-group">
                                    <label for="company5" class="form-label">会社名・組織名</label>
                                    <div class="input-wrapper">
                                        <input type="text" id="company5" name="company5" class="form-input">
                                    </div>
                                </div>
                                
                                <div class="form-group">
                                    <label for="position5" class="form-label">役職・職種</label>
                                    <div class="input-wrapper">
                                        <input type="text" id="position5" name="position5" class="form-input">
                                    </div>
                                </div>
                                
                                <div class="form-group">
                                    <label for="industry5" class="form-label">業界・分野</label>
                                    <div class="input-wrapper">
                                        <select id="industry5" name="industry5" class="form-select">
                                            <option value="">選択してください</option>
                                            <option value="tech">IT・テクノロジー</option>
                                            <option value="finance">金融・保険</option>
                                            <option value="healthcare">医療・ヘルスケア</option>
                                            <option value="education">教育・研修</option>
                                            <option value="retail">小売・EC</option>
                                            <option value="manufacturing">製造業</option>
                                            <option value="consulting">コンサルティング</option>
                                            <option value="media">メディア・広告</option>
                                            <option value="government">官公庁・自治体</option>
                                            <option value="nonprofit">非営利団体</option>
                                            <option value="other">その他</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="interest-section">
                                <label class="form-label">興味のある分野 <span class="required">*</span></label>
                                <div class="interest-grid">
                                    <div class="interest-item">
                                        <input type="checkbox" id="ai" name="interests[]" value="ai" class="interest-checkbox" required>
                                        <label for="ai" class="interest-label">
                                            <span class="interest-icon">🤖</span>
                                            AI・機械学習
                                        </label>
                                    </div>
                                    <div class="interest-item">
                                        <input type="checkbox" id="blockchain" name="interests[]" value="blockchain" class="interest-checkbox">
                                        <label for="blockchain" class="interest-label">
                                            <span class="interest-icon">⛓️</span>
                                            ブロックチェーン
                                        </label>
                                    </div>
                                    <div class="interest-item">
                                        <input type="checkbox" id="iot" name="interests[]" value="iot" class="interest-checkbox">
                                        <label for="iot" class="interest-label">
                                            <span class="interest-icon">🌐</span>
                                            IoT・スマートデバイス
                                        </label>
                                    </div>
                                    <div class="interest-item">
                                        <input type="checkbox" id="cloud" name="interests[]" value="cloud" class="interest-checkbox">
                                        <label for="cloud" class="interest-label">
                                            <span class="interest-icon">☁️</span>
                                            クラウドソリューション
                                        </label>
                                    </div>
                                    <div class="interest-item">
                                        <input type="checkbox" id="security" name="interests[]" value="security" class="interest-checkbox">
                                        <label for="security" class="interest-label">
                                            <span class="interest-icon">🔒</span>
                                            サイバーセキュリティ
                                        </label>
                                    </div>
                                    <div class="interest-item">
                                        <input type="checkbox" id="ar-vr" name="interests[]" value="ar-vr" class="interest-checkbox">
                                        <label for="ar-vr" class="interest-label">
                                            <span class="interest-icon">🥽</span>
                                            AR・VR・メタバース
                                        </label>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="form-group full-width">
                                <label for="message5" class="form-label">お問い合わせ内容 <span class="required">*</span></label>
                                <div class="input-wrapper">
                                    <textarea id="message5" name="message5" class="form-textarea" rows="6" required></textarea>
                                </div>
                            </div>
                            
                            <div class="privacy-section">
                                <label class="custom-checkbox-container">
                                    <input type="checkbox" name="privacy5" class="privacy-checkbox" required>
                                    <div class="custom-checkbox">
                                        <i class="fas fa-check check-icon"></i>
                                    </div>
                                    <span class="privacy-text">
                                        <a href="#" target="_blank">プライバシーポリシー</a>および<a href="#" target="_blank">利用規約</a>に同意し、入力された情報の取り扱いについて承諾します <span class="required">*</span>
                                    </span>
                                </label>
                            </div>
                            
                            <div class="submit-section">
                                <button type="submit" class="submit-btn">
                                    <i class="fas fa-paper-plane"></i>
                                    送信する
                                </button>
                                <p class="submit-info">通常、24時間以内にご返信いたします</p>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>
    </main>

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

    <script src="<?php echo get_stylesheet_directory_uri(); ?>/contact_form/contact-form.js"></script>
    <script src="<?php echo get_stylesheet_directory_uri(); ?>/contact_form/contact-form-style4.js"></script>
    <script src="<?php echo get_stylesheet_directory_uri(); ?>/contact_form/contact-form-style5.js"></script>
    <?php wp_footer(); ?>

</body>
</html>