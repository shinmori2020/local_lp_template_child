<?php
/**
 * Template Name: 一例のLPテンプレート
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
    <link rel="stylesheet" href="<?php echo get_stylesheet_directory_uri(); ?>/custom_site_css/custom_site.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <?php wp_head(); ?>
</head>
<body>
    <!-- スクロールプログレス -->
    <div class="scroll-progress" id="scrollProgress"></div>

    <!-- ヘッダー -->
    <header>
        <div class="container">
            <div class="header-content">
                <div class="logo">WebCraft</div>
                <nav>
                    <ul class="nav-links">
                        <li><a href="#home">ホーム</a></li>
                        <li><a href="#service">サービス</a></li>
                        <li><a href="#portfolio">実績</a></li>
                        <li><a href="#contact">お問い合わせ</a></li>
                    </ul>
                </nav>
                <div class="hamburger" id="hamburger">
                    <span></span>
                    <span></span>
                    <span></span>
                </div>
            </div>
        </div>
    </header>

    <!-- ファーストビュー -->
    <section class="hero parallax-container" id="home">
        <div class="parallax-bg" id="parallaxBg"></div>
        <div class="container">
            <h1 class="hero-title">あなたのビジネスを加速させる<br>プロフェッショナルなWebサイト制作</h1>
            <p class="subtitle">売上向上・集客力アップを実現する、戦略的なWebサイトを制作します</p>
            <p class="description">
                私たちWebCraftは、単なるWebサイト制作会社ではありません。あなたのビジネス目標を達成するためのデジタルパートナーです。
                最新技術と豊富な経験を活かし、成果の出るWebサイトを制作いたします。
            </p>
            <a href="#contact" class="cta-button">無料相談・お見積り</a>
            
            <!-- 特典表示 -->
            <div class="benefits-showcase">
                <div class="benefit-item">
                    <i class="benefit-icon fas fa-bullseye"></i>
                    <span class="benefit-text">高品質・低価格</span>
                </div>
                <div class="benefit-item">
                    <i class="benefit-icon fas fa-bolt"></i>
                    <span class="benefit-text">最短2週間納品</span>
                </div>
                <div class="benefit-item">
                    <i class="benefit-icon fas fa-dollar-sign"></i>
                    <span class="benefit-text">お見積り無料</span>
                </div>
                <div class="benefit-item">
                    <i class="benefit-icon fas fa-shield-alt"></i>
                    <span class="benefit-text">返金保証付き</span>
                </div>
            </div>
        </div>
    </section>

    <!-- 課題提起セクション -->
    <section class="section problems" id="problems">
        <div class="container">
            <h2>こんなお悩みはありませんか？</h2>
            <p>多くの企業が抱えるWebサイトの課題を解決します</p>
            <div class="problems-grid-modern">
                <div class="problem-card-modern">
                    <i class="problem-icon-modern fas fa-frown"></i>
                    <div class="problem-content-modern">
                        <h3>古いサイトで集客できない</h3>
                        <p>何年も前に作ったサイトで、デザインが古く、集客効果がありません。現代のユーザーは第一印象で判断します。</p>
                    </div>
                </div>
                <div class="problem-card-modern">
                    <i class="problem-icon-modern fas fa-mobile-alt"></i>
                    <div class="problem-content-modern">
                        <h3>スマホ対応していない</h3>
                        <p>スマホで見ると表示が崩れて、ユーザーが即座に離脱。モバイル利用者の70%以上を逃しています。</p>
                    </div>
                </div>
                <div class="problem-card-modern">
                    <i class="problem-icon-modern fas fa-search"></i>
                    <div class="problem-content-modern">
                        <h3>検索で上位表示されない</h3>
                        <p>GoogleやYahooで検索されても、自社サイトが見つからず、競合に顧客を奪われ続けています。</p>
                    </div>
                </div>
                <div class="problem-card-modern">
                    <i class="problem-icon-modern fas fa-bolt"></i>
                    <div class="problem-content-modern">
                        <h3>サイトの表示が遅い</h3>
                        <p>ページの読み込みが3秒を超えると、53%のユーザーが離脱。機会損失が日々発生しています。</p>
                    </div>
                </div>
                <div class="problem-card-modern">
                    <i class="problem-icon-modern fas fa-chart-bar"></i>
                    <div class="problem-content-modern">
                        <h3>効果測定ができない</h3>
                        <p>アクセス数や成果が分からず、改善点が見えない。投資対効果が不明で予算を無駄にしています。</p>
                    </div>
                </div>
                <div class="problem-card-modern">
                    <i class="problem-icon-modern fas fa-dollar-sign"></i>
                    <div class="problem-content-modern">
                        <h3>制作費用が高額</h3>
                        <p>他社で見積もりしたら予算オーバーで断念。適正価格でのサイト制作を諦めていませんか？</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- ソリューションセクション -->
    <section class="section section-alt solutions" id="service">
        <div class="container">
            <h2>WebCraftが解決します</h2>
            <p>最新技術と豊富な経験で、あなたのビジネスを成功に導きます</p>
            <div class="solutions-icon-grid">
                <div class="solution-icon-box">
                    <i class="solution-icon-large fas fa-palette"></i>
                    <h3 class="solution-title">現代的なデザイン</h3>
                    <p class="solution-description">最新のデザイントレンドを取り入れた魅力的なWebサイトを制作します。UI/UXを重視した設計で、直感的な操作性と美しいビジュアルを両立させ、企業のブランドイメージを最大限に引き立てます。</p>
                    <div class="solution-benefit">ブランド価値を向上させ、競合他社と差別化</div>
                </div>
                <div class="solution-icon-box">
                    <i class="solution-icon-large fas fa-mobile-alt"></i>
                    <h3 class="solution-title">完全レスポンシブ</h3>
                    <p class="solution-description">デスクトップ、タブレット、スマートフォンのすべてのデバイスで完璧な表示を実現します。モバイルファーストのアプローチで設計し、どの画面サイズでも最適なユーザー体験を提供します。</p>
                    <div class="solution-benefit">モバイルユーザーの70%の取りこぼしを防止</div>
                </div>
                <div class="solution-icon-box">
                    <i class="solution-icon-large fas fa-search"></i>
                    <h3 class="solution-title">SEO対策済み</h3>
                    <p class="solution-description">検索エンジンに最適化された構造とコンテンツで、Google検索での上位表示を狙いやすくします。適切なタイトルタグ、メタディスクリプション、構造化データの設定でSEO効果を最大化します。</p>
                    <div class="solution-benefit">検索流入を3倍増加で集客力大幅アップ</div>
                </div>
                <div class="solution-icon-box">
                    <i class="solution-icon-large fas fa-bolt"></i>
                    <h3 class="solution-title">高速表示</h3>
                    <p class="solution-description">最新の技術とコーディング手法により、ページの読み込み速度を劇的に向上させます。画像の最適化、CSSとJavaScriptの圧縮により、3秒以下の高速表示を実現します。</p>
                    <div class="solution-benefit">離脱率を50%削減し、コンバージョン率向上</div>
                </div>
                <div class="solution-icon-box">
                    <i class="solution-icon-large fas fa-chart-bar"></i>
                    <h3 class="solution-title">アクセス解析</h3>
                    <p class="solution-description">Google AnalyticsやSearch Consoleなどの分析ツールを導入し、サイトのパフォーマンスを詳細に把握できます。データに基づいた改善提案を継続的に行い、サイトの成果を最大化します。</p>
                    <div class="solution-benefit">データ基盤で継続的な成果改善を実現</div>
                </div>
                <div class="solution-icon-box">
                    <i class="solution-icon-large fas fa-dollar-sign"></i>
                    <h3 class="solution-title">適正価格</h3>
                    <p class="solution-description">お客様の予算とニーズに合わせた柔軟な料金体系で、高品質なWebサイトを提供します。無駄なコストを削減しながらも、投資対効果の高いソリューションを実現します。</p>
                    <div class="solution-benefit">ROI300%以上の高いコストパフォーマンス</div>
                </div>
            </div>
        </div>
    </section>

    <!-- 実績セクション -->
    <section class="section achievements" id="portfolio">
        <div class="container">
            <h2>選ばれる理由</h2>
            <p>数字で見るWebCraftの実績</p>
            <div class="achievements-circle-grid">
                <div class="achievement-circle">
                    <div class="circular-progress">
                        <svg class="circular-chart" viewBox="0 0 36 36">
                            <path class="circle-bg" d="M18 2.0845 a 15.9155 15.9155 0 0 1 0 31.831 a 15.9155 15.9155 0 0 1 0 -31.831"/>
                            <path class="circle" d="M18 2.0845 a 15.9155 15.9155 0 0 1 0 31.831 a 15.9155 15.9155 0 0 1 0 -31.831"/>
                        </svg>
                        <div class="percentage-text">95%</div>
                    </div>
                    <h3 class="achievement-title">制作実績達成率</h3>
                    <p class="achievement-subtitle">累計サイト制作数（目標500件）</p>
                    <div class="achievement-highlight">業界トップクラスの豊富な経験</div>
                </div>
                <div class="achievement-circle">
                    <div class="circular-progress">
                        <svg class="circular-chart" viewBox="0 0 36 36">
                            <path class="circle-bg" d="M18 2.0845 a 15.9155 15.9155 0 0 1 0 31.831 a 15.9155 15.9155 0 0 1 0 -31.831"/>
                            <path class="circle" d="M18 2.0845 a 15.9155 15.9155 0 0 1 0 31.831 a 15.9155 15.9155 0 0 1 0 -31.831"/>
                        </svg>
                        <div class="percentage-text">98%</div>
                    </div>
                    <h3 class="achievement-title">顧客満足度</h3>
                    <p class="achievement-subtitle">お客様アンケート結果</p>
                    <div class="achievement-highlight">継続率95%の高い信頼関係</div>
                </div>
                <div class="achievement-circle">
                    <div class="circular-progress">
                        <svg class="circular-chart" viewBox="0 0 36 36">
                            <path class="circle-bg" d="M18 2.0845 a 15.9155 15.9155 0 0 1 0 31.831 a 15.9155 15.9155 0 0 1 0 -31.831"/>
                            <path class="circle" d="M18 2.0845 a 15.9155 15.9155 0 0 1 0 31.831 a 15.9155 15.9155 0 0 1 0 -31.831"/>
                        </svg>
                        <div class="percentage-text">85%</div>
                    </div>
                    <h3 class="achievement-title">CV率向上</h3>
                    <p class="achievement-subtitle">リニューアル後の成果改善率</p>
                    <div class="achievement-highlight">確実な成果向上を実現</div>
                </div>
                <div class="achievement-circle">
                    <div class="circular-progress">
                        <svg class="circular-chart" viewBox="0 0 36 36">
                            <path class="circle-bg" d="M18 2.0845 a 15.9155 15.9155 0 0 1 0 31.831 a 15.9155 15.9155 0 0 1 0 -31.831"/>
                            <path class="circle" d="M18 2.0845 a 15.9155 15.9155 0 0 1 0 31.831 a 15.9155 15.9155 0 0 1 0 -31.831"/>
                        </svg>
                        <div class="percentage-text">83%</div>
                    </div>
                    <h3 class="achievement-title">制作期間効率</h3>
                    <p class="achievement-subtitle">業界平均より短縮（30日/36日）</p>
                    <div class="achievement-highlight">迅速かつ高品質な制作体制</div>
                </div>
                <div class="achievement-circle">
                    <div class="circular-progress">
                        <svg class="circular-chart" viewBox="0 0 36 36">
                            <path class="circle-bg" d="M18 2.0845 a 15.9155 15.9155 0 0 1 0 31.831 a 15.9155 15.9155 0 0 1 0 -31.831"/>
                            <path class="circle" d="M18 2.0845 a 15.9155 15.9155 0 0 1 0 31.831 a 15.9155 15.9155 0 0 1 0 -31.831"/>
                        </svg>
                        <div class="percentage-text">92%</div>
                    </div>
                    <h3 class="achievement-title">リピート率</h3>
                    <p class="achievement-subtitle">継続的なお取引実績</p>
                    <div class="achievement-highlight">長期的なパートナーシップ</div>
                </div>
                <div class="achievement-circle">
                    <div class="circular-progress">
                        <svg class="circular-chart" viewBox="0 0 36 36">
                            <path class="circle-bg" d="M18 2.0845 a 15.9155 15.9155 0 0 1 0 31.831 a 15.9155 15.9155 0 0 1 0 -31.831"/>
                            <path class="circle" d="M18 2.0845 a 15.9155 15.9155 0 0 1 0 31.831 a 15.9155 15.9155 0 0 1 0 -31.831"/>
                        </svg>
                        <div class="percentage-text">96%</div>
                    </div>
                    <h3 class="achievement-title">納期遵守率</h3>
                    <p class="achievement-subtitle">約束した納期の確実な達成</p>
                    <div class="achievement-highlight">信頼できる制作スケジュール</div>
                </div>
            </div>
        </div>
    </section>

    <!-- お客様の声セクション -->
    <section class="section section-alt testimonials">
        <div class="container">
            <h2>お客様の声</h2>
            <p>実際にWebCraftをご利用いただいたお客様の声をご紹介します</p>
            <div class="testimonials-modern-grid">
                <div class="testimonial-modern-card">
                    <div class="testimonial-header">
                        <div class="testimonial-avatar">田</div>
                        <div class="testimonial-info">
                            <h4>田中 太郎様</h4>
                            <p>株式会社ABC商事 代表取締役</p>
                        </div>
                    </div>
                    <div class="testimonial-rating">
                        <span class="star">★</span>
                        <span class="star">★</span>
                        <span class="star">★</span>
                        <span class="star">★</span>
                        <span class="star">★</span>
                    </div>
                    <div class="testimonial-content">
                        新しいサイトにしてから、お問い合わせが3倍に増えました！デザインも素晴らしく、お客様からも好評です。想像以上の成果に満足しています。
                    </div>
                    <div class="testimonial-result">結果: 問い合わせ数300%増加</div>
                </div>
                <div class="testimonial-modern-card">
                    <div class="testimonial-header">
                        <div class="testimonial-avatar">佐</div>
                        <div class="testimonial-info">
                            <h4>佐藤 花子様</h4>
                            <p>美容サロン「Bloom」オーナー</p>
                        </div>
                    </div>
                    <div class="testimonial-rating">
                        <span class="star">★</span>
                        <span class="star">★</span>
                        <span class="star">★</span>
                        <span class="star">★</span>
                        <span class="star">★</span>
                    </div>
                    <div class="testimonial-content">
                        制作過程での細かい要望にも丁寧に対応していただき、理想通りのサイトができました。売上も20%アップしています！
                    </div>
                    <div class="testimonial-result">結果: 売上20%増加、予約数150%向上</div>
                </div>
                <div class="testimonial-modern-card">
                    <div class="testimonial-header">
                        <div class="testimonial-avatar">鈴</div>
                        <div class="testimonial-info">
                            <h4>鈴木 一郎様</h4>
                            <p>鈴木税理士事務所 所長</p>
                        </div>
                    </div>
                    <div class="testimonial-rating">
                        <span class="star">★</span>
                        <span class="star">★</span>
                        <span class="star">★</span>
                        <span class="star">★</span>
                        <span class="star">★</span>
                    </div>
                    <div class="testimonial-content">
                        SEO対策のおかげで、検索順位が大幅に上がりました。アクセス数も5倍になり、集客効果を実感しています。
                    </div>
                    <div class="testimonial-result">結果: 検索順位向上、アクセス数500%増加</div>
                </div>
                <div class="testimonial-modern-card">
                    <div class="testimonial-header">
                        <div class="testimonial-avatar">山</div>
                        <div class="testimonial-info">
                            <h4>山田 美咲様</h4>
                            <p>カフェ&レストラン「Verde」店長</p>
                        </div>
                    </div>
                    <div class="testimonial-rating">
                        <span class="star">★</span>
                        <span class="star">★</span>
                        <span class="star">★</span>
                        <span class="star">★</span>
                        <span class="star">★</span>
                    </div>
                    <div class="testimonial-content">
                        オンライン予約システムの導入で、お客様の利便性が向上しました。リピート率も大幅に上がり、売上が安定しています。
                    </div>
                    <div class="testimonial-result">結果: リピート率40%向上、売上130%増加</div>
                </div>
                <div class="testimonial-modern-card">
                    <div class="testimonial-header">
                        <div class="testimonial-avatar">高</div>
                        <div class="testimonial-info">
                            <h4>高橋 誠様</h4>
                            <p>フィットネスジム「STRONG」経営者</p>
                        </div>
                    </div>
                    <div class="testimonial-rating">
                        <span class="star">★</span>
                        <span class="star">★</span>
                        <span class="star">★</span>
                        <span class="star">★</span>
                        <span class="star">★</span>
                    </div>
                    <div class="testimonial-content">
                        スマホ対応のおかげで、若い世代の会員が大幅に増えました。会員管理システムも使いやすく、業務効率が向上しています。
                    </div>
                    <div class="testimonial-result">結果: 新規会員数200%増加、業務効率50%向上</div>
                </div>
                <div class="testimonial-modern-card">
                    <div class="testimonial-header">
                        <div class="testimonial-avatar">中</div>
                        <div class="testimonial-info">
                            <h4>中村 恵子様</h4>
                            <p>ハンドメイド雑貨「crafty」代表</p>
                        </div>
                    </div>
                    <div class="testimonial-rating">
                        <span class="star">★</span>
                        <span class="star">★</span>
                        <span class="star">★</span>
                        <span class="star">★</span>
                        <span class="star">★</span>
                    </div>
                    <div class="testimonial-content">
                        ECサイトの制作で、全国のお客様に商品をお届けできるようになりました。注文管理も簡単で、事業拡大につながっています。
                    </div>
                    <div class="testimonial-result">結果: オンライン売上600%増加、顧客エリア全国展開</div>
                </div>
            </div>
        </div>
    </section>

    <!-- 制作プロセス -->
    <section class="section process">
        <div class="container">
            <h2>制作の流れ</h2>
            <p>お客様に安心していただける、透明性の高い制作プロセス</p>
            <div class="process-timeline">
                <div class="process-step-timeline">
                    <div class="step-number-timeline">1</div>
                    <div class="step-content">
                        <div class="step-card">
                            <h3 class="step-title-timeline">無料相談</h3>
                            <p class="step-description-timeline">お客様のビジネス目標やターゲット層、現在の課題を詳しくヒアリングいたします。競合分析、市場調査の結果も踏まえ、最適なWebサイト戦略をご提案。プロジェクトの全体像から細かな要件まで、専門スタッフが丁寧にサポートします。ご予算やスケジュールのご相談も可能です。</p>
                            <div class="step-info-tags">
                                <div class="step-duration">所要時間: 1-2時間</div>
                                <div class="step-duration">場所: オンライン/対面</div>
                                <div class="step-duration">担当: 専任コンサルタント</div>
                                <div class="step-duration">成果物: 戦略提案書</div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="process-step-timeline">
                    <div class="step-number-timeline">2</div>
                    <div class="step-content">
                        <div class="step-card">
                            <h3 class="step-title-timeline">企画・提案</h3>
                            <p class="step-description-timeline">ヒアリング内容を基に、詳細な企画書を作成いたします。サイトマップ、機能要件書、デザインコンセプト、技術仕様書を含む包括的な提案書をご提示。お見積もりも詳細項目別に明示し、追加費用の心配がありません。修正やご相談も無料で対応いたします。</p>
                            <div class="step-info-tags">
                                <div class="step-duration">期間: 3-5営業日</div>
                                <div class="step-duration">修正回数: 3回まで無料</div>
                                <div class="step-duration">担当: 企画チーム</div>
                                <div class="step-duration">成果物: 企画書・見積書</div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="process-step-timeline">
                    <div class="step-number-timeline">3</div>
                    <div class="step-content">
                        <div class="step-card">
                            <h3 class="step-title-timeline">デザイン制作</h3>
                            <p class="step-description-timeline">ワイヤーフレーム、モックアップから始まり、ユーザーエクスペリエンスを重視したデザインを制作します。最新のデザイントレンドとお客様のブランドイメージを融合し、ターゲット層に響く魅力的なビジュアルデザインを実現。レスポンシブデザインにも完全対応いたします。</p>
                            <div class="step-info-tags">
                                <div class="step-duration">期間: 7-10営業日</div>
                                <div class="step-duration">修正回数: 5回まで無料</div>
                                <div class="step-duration">担当: UIデザイナー</div>
                                <div class="step-duration">成果物: デザインカンプ</div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="process-step-timeline">
                    <div class="step-number-timeline">4</div>
                    <div class="step-content">
                        <div class="step-card">
                            <h3 class="step-title-timeline">開発・コーディング</h3>
                            <p class="step-description-timeline">最新のWeb技術を使用し、高速・高品質なサイトを構築します。HTML5、CSS3、JavaScriptを駆使したレスポンシブコーディング、SEO内部対策、セキュリティ対策を標準実装。クロスブラウザ対応、アクセシビリティにも配慮した開発を行います。</p>
                            <div class="step-info-tags">
                                <div class="step-duration">期間: 10-14営業日</div>
                                <div class="step-duration">技術: HTML5/CSS3/JS</div>
                                <div class="step-duration">担当: フロントエンドエンジニア</div>
                                <div class="step-duration">対応: SEO・セキュリティ</div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="process-step-timeline">
                    <div class="step-number-timeline">5</div>
                    <div class="step-content">
                        <div class="step-card">
                            <h3 class="step-title-timeline">テスト・納品</h3>
                            <p class="step-description-timeline">各種デバイス・ブラウザでの表示チェック、機能テスト、パフォーマンステストを実施します。SSL証明書設定、Google Analytics・Search Console導入、サーバー設定も含めて完全な状態で納品。操作マニュアルと保守説明書もご提供いたします。</p>
                            <div class="step-info-tags">
                                <div class="step-duration">期間: 3-5営業日</div>
                                <div class="step-duration">テスト項目: 20項目以上</div>
                                <div class="step-duration">担当: QAエンジニア</div>
                                <div class="step-duration">付属物: マニュアル・保守書</div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="process-step-timeline">
                    <div class="step-number-timeline">6</div>
                    <div class="step-content">
                        <div class="step-card">
                            <h3 class="step-title-timeline">運用サポート</h3>
                            <p class="step-description-timeline">サイト公開後も安心の継続サポートをご提供。定期的なバックアップ、セキュリティ更新、アクセス解析レポート提出を実施。コンテンツ更新代行、新機能追加、SEO改善提案など、成果向上のための包括的なサポートを継続的に行います。</p>
                            <div class="step-info-tags">
                                <div class="step-duration">期間: 継続サポート</div>
                                <div class="step-duration">レポート: 月次提供</div>
                                <div class="step-duration">担当: 専任サポート</div>
                                <div class="step-duration">保証: 30日間無料</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Q&Aセクション -->
    <section class="section section-alt faq">
        <div class="container">
            <h2>よくある質問</h2>
            <div class="faq-container">
                <div class="faq-item">
                    <div class="faq-question">
                        <span class="faq-label">Q</span>
                        <span class="faq-text">制作期間はどのくらいかかりますか？</span>
                    </div>
                    <div class="faq-answer">
                        <span class="faq-label">A</span>
                        <span class="faq-text">サイトの規模や機能によって異なりますが、一般的なコーポレートサイトでは3-4週間、ECサイトでは6-8週間程度です。お急ぎの場合は追加費用なしで短縮も可能です。具体的なスケジュールは、企画・提案段階（5日）→デザイン制作（10日）→開発・コーディング（14日）→テスト・調整（5日）となります。制作開始前に詳細なスケジュールをご提示し、進捗を週次でご報告いたします。</span>
                    </div>
                </div>
                <div class="faq-item">
                    <div class="faq-question">
                        <span class="faq-label">Q</span>
                        <span class="faq-text">制作費用はどのくらいですか？</span>
                    </div>
                    <div class="faq-answer">
                        <span class="faq-label">A</span>
                        <span class="faq-text">プロジェクトの規模や要求される機能によって異なります。コーポレートサイトは30万円〜、ECサイトは80万円〜が目安です。料金に含まれるのは、企画・提案、デザイン制作、コーディング、SEO対策、SSL証明書設定、Google Analytics設定、30日間の無料サポートです。追加機能（予約システム、会員機能、決済システム等）は別途お見積りいたします。お客様のご予算に合わせたプランもご提案可能ですので、まずは無料相談をご利用ください。</span>
                    </div>
                </div>
                <div class="faq-item">
                    <div class="faq-question">
                        <span class="faq-label">Q</span>
                        <span class="faq-text">スマホ対応は含まれていますか？</span>
                    </div>
                    <div class="faq-answer">
                        <span class="faq-label">A</span>
                        <span class="faq-text">はい、すべてのプランでレスポンシブデザインを標準対応しております。PC・タブレット・スマートフォンのすべてのデバイスで最適な表示を実現します。モバイルファーストの設計思想に基づき、スマートフォンでの使いやすさを最優先に考えた設計を行います。また、各デバイスでの表示テストを徹底的に行い、iPhone、Android、各種タブレット端末での動作確認を実施いたします。</span>
                    </div>
                </div>
                <div class="faq-item">
                    <div class="faq-question">
                        <span class="faq-label">Q</span>
                        <span class="faq-text">SEO対策は行っていますか？</span>
                    </div>
                    <div class="faq-answer">
                        <span class="faq-label">A</span>
                        <span class="faq-text">基本的なSEO対策（内部対策）は標準で含まれています。具体的には、適切なタイトル設定、メタディスクリプション設定、構造化データの実装、サイトマップ作成、ページ速度の最適化、画像のalt属性設定、内部リンクの最適化などを行います。さらに、検索エンジンに最適化された構造でのコーディング、セマンティックHTMLの使用、パンくずリストの実装も含まれます。本格的なSEO対策やコンテンツマーケティングについては、別途専門プランをご用意しております。</span>
                    </div>
                </div>
                <div class="faq-item">
                    <div class="faq-question">
                        <span class="faq-label">Q</span>
                        <span class="faq-text">公開後のサポートはありますか？</span>
                    </div>
                    <div class="faq-answer">
                        <span class="faq-label">A</span>
                        <span class="faq-text">はい、公開後も安心してご利用いただけるよう、包括的な保守・運用サポートをご提供しています。30日間の無料サポート期間中は、軽微な修正やご質問に無料で対応いたします。その後は月額制のメンテナンスプラン（月額1万円〜）をご用意しており、定期的なバックアップ、セキュリティ更新、コンテンツ更新代行、アクセス解析レポートの提供を行います。緊急時の対応やトラブル解決も迅速に対応いたします。</span>
                    </div>
                </div>
                <div class="faq-item">
                    <div class="faq-question">
                        <span class="faq-label">Q</span>
                        <span class="faq-text">ドメインやサーバーの設定もお願いできますか？</span>
                    </div>
                    <div class="faq-answer">
                        <span class="faq-label">A</span>
                        <span class="faq-text">はい、ドメインの取得からサーバー設定まで、トータルでサポートいたします。お客様のご要望に応じて、適切なドメイン名をご提案し、取得代行を承ります。サーバーについては、高性能で安定したレンタルサーバーをご紹介し、初期設定から SSL証明書の設定、メールアドレスの作成まで一括対応いたします。既存のドメインやサーバーをお持ちの場合も、移管作業や設定変更を安全に行います。技術的な部分はすべてお任せください。</span>
                    </div>
                </div>
                <div class="faq-item">
                    <div class="faq-question">
                        <span class="faq-label">Q</span>
                        <span class="faq-text">コンテンツ（文章や画像）の作成もお願いできますか？</span>
                    </div>
                    <div class="faq-answer">
                        <span class="faq-label">A</span>
                        <span class="faq-text">はい、コンテンツ制作も承っております。経験豊富なライターが、お客様のビジネスに合わせた魅力的な文章を作成いたします。また、プロのフォトグラファーによる商品撮影や企業撮影、グラフィックデザイナーによるオリジナル画像の作成も可能です。既存の素材がない場合や、よりクオリティの高いコンテンツをご希望の場合は、企画段階からご相談いただければ、トータルでサポートいたします。コンテンツ制作は別途料金となりますが、お見積り時に詳しくご説明いたします。</span>
                    </div>
                </div>
                <div class="faq-item">
                    <div class="faq-question">
                        <span class="faq-label">Q</span>
                        <span class="faq-text">既存サイトのリニューアルも対応していますか？</span>
                    </div>
                    <div class="faq-answer">
                        <span class="faq-label">A</span>
                        <span class="faq-text">はい、既存サイトのリニューアルも多数の実績がございます。まず現在のサイトの詳細分析を行い、アクセス解析データの確認、競合他社との比較、ユーザビリティの評価を実施します。その上で、現在の課題を特定し、目標に応じた最適なリニューアル案をご提案いたします。既存のドメインやコンテンツの活用、SEO評価の引き継ぎ、リダイレクト設定など、技術的な配慮も万全です。リニューアル後のアクセス数向上やコンバージョン率改善の実績も多数ございます。</span>
                    </div>
                </div>
                <div class="faq-item">
                    <div class="faq-question">
                        <span class="faq-label">Q</span>
                        <span class="faq-text">WordPressなどのCMSは使用していますか？</span>
                    </div>
                    <div class="faq-answer">
                        <span class="faq-label">A</span>
                        <span class="faq-text">はい、WordPressをはじめとする各種CMSでの制作に対応しております。お客様ご自身でコンテンツを更新したい場合は、WordPress を推奨しており、使いやすい管理画面のカスタマイズ、セキュリティ対策、高速化設定まで行います。納品時には操作マニュアルをご提供し、操作方法の講習も実施いたします。WordPress以外にも、Shopify（ECサイト）、Wix、Squarespace等のプラットフォームでの制作も可能です。お客様のITリテラシーやご希望に応じて、最適なCMSをご提案いたします。</span>
                    </div>
                </div>
                <div class="faq-item">
                    <div class="faq-question">
                        <span class="faq-label">Q</span>
                        <span class="faq-text">制作途中での修正や変更は可能ですか？</span>
                    </div>
                    <div class="faq-answer">
                        <span class="faq-label">A</span>
                        <span class="faq-text">はい、制作途中での修正・変更は可能です。デザイン段階では5回まで、コーディング段階では3回まで無料で修正対応いたします。お客様のご要望を正確に反映するため、各段階で必ず確認・承認をいただいてから次の工程に進みます。大幅な仕様変更や追加機能については、別途お見積りが必要な場合がございますが、事前にご相談いただければ柔軟に対応いたします。お客様にご満足いただけるサイトを制作するため、コミュニケーションを密に取りながら進めさせていただきます。</span>
                    </div>
                </div>
                <div class="faq-item">
                    <div class="faq-question">
                        <span class="faq-label">Q</span>
                        <span class="faq-text">アクセス解析の設定や分析もお願いできますか？</span>
                    </div>
                    <div class="faq-answer">
                        <span class="faq-label">A</span>
                        <span class="faq-text">はい、アクセス解析の設定から継続的な分析・改善提案まで対応しております。Google Analytics、Google Search Console、Google Tag Manager等の設定を行い、適切な目標設定やコンバージョン測定の仕組みを構築いたします。月次レポートでは、アクセス数、ユーザー行動、コンバージョン率等を分析し、サイト改善のための具体的な提案を行います。データに基づいたPDCAサイクルを回すことで、継続的な成果向上を実現します。分析結果の説明やサイト改善のアドバイスも定期的に実施いたします。</span>
                    </div>
                </div>
                <div class="faq-item">
                    <div class="faq-question">
                        <span class="faq-label">Q</span>
                        <span class="faq-text">セキュリティ対策はどのようなものがありますか？</span>
                    </div>
                    <div class="faq-answer">
                        <span class="faq-label">A</span>
                        <span class="faq-text">Webサイトのセキュリティ対策を徹底的に行います。SSL証明書の設定による通信の暗号化、定期的なバックアップ、不正アクセス対策、スパム対策を標準で実装いたします。WordPressを使用する場合は、セキュリティプラグインの設定、定期的なアップデート、脆弱性対策も行います。また、フォームには適切なバリデーション機能を実装し、SQLインジェクションやクロスサイトスクリプティング等の攻撃を防ぎます。お客様の大切な情報と訪問者の個人情報を守るため、最新のセキュリティ基準に準拠した制作を心がけております。</span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- お問い合わせフォームセクション -->
    <section class="section" id="contact">
        <div class="container">
            <h2>お問い合わせ</h2>
            <p>お気軽にお問い合わせください。24時間以内にご返信いたします。</p>
            <div class="contact-form-container">
                <div class="contact-form-card">
                    <div class="form-header">
                        <i class="fas fa-envelope form-header-icon"></i>
                        <h3>無料相談・お見積り</h3>
                        <p>まずはお気軽にご相談ください。専門スタッフが丁寧にお答えいたします。</p>
                    </div>
                    <form class="contact-form">
                        <div class="form-row">
                            <div class="form-group">
                                <label for="company">会社名 <span class="required">*</span></label>
                                <input type="text" id="company" name="company" required>
                            </div>
                            <div class="form-group">
                                <label for="name">お名前 <span class="required">*</span></label>
                                <input type="text" id="name" name="name" required>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group">
                                <label for="email">メールアドレス <span class="required">*</span></label>
                                <input type="email" id="email" name="email" required>
                            </div>
                            <div class="form-group">
                                <label for="phone">電話番号</label>
                                <input type="tel" id="phone" name="phone">
                            </div>
                        </div>
                        <div class="form-group">
                            <label>ご予算</label>
                            <div class="radio-group">
                                <label class="radio-option">
                                    <input type="radio" name="budget" value="~30">
                                    <span class="radio-custom"></span>
                                    30万円以下
                                </label>
                                <label class="radio-option">
                                    <input type="radio" name="budget" value="30-50">
                                    <span class="radio-custom"></span>
                                    30万円〜50万円
                                </label>
                                <label class="radio-option">
                                    <input type="radio" name="budget" value="50-100">
                                    <span class="radio-custom"></span>
                                    50万円〜100万円
                                </label>
                                <label class="radio-option">
                                    <input type="radio" name="budget" value="100-200">
                                    <span class="radio-custom"></span>
                                    100万円〜200万円
                                </label>
                                <label class="radio-option">
                                    <input type="radio" name="budget" value="200~">
                                    <span class="radio-custom"></span>
                                    200万円以上
                                </label>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>プロジェクトタイプ</label>
                            <div class="radio-group">
                                <label class="radio-option">
                                    <input type="radio" name="project-type" value="corporate">
                                    <span class="radio-custom"></span>
                                    コーポレートサイト
                                </label>
                                <label class="radio-option">
                                    <input type="radio" name="project-type" value="ec">
                                    <span class="radio-custom"></span>
                                    ECサイト
                                </label>
                                <label class="radio-option">
                                    <input type="radio" name="project-type" value="lp">
                                    <span class="radio-custom"></span>
                                    ランディングページ
                                </label>
                                <label class="radio-option">
                                    <input type="radio" name="project-type" value="renewal">
                                    <span class="radio-custom"></span>
                                    サイトリニューアル
                                </label>
                                <label class="radio-option">
                                    <input type="radio" name="project-type" value="other">
                                    <span class="radio-custom"></span>
                                    その他
                                </label>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="deadline">希望納期</label>
                            <input type="date" id="deadline" name="deadline">
                        </div>
                        <div class="form-group">
                            <label for="message">お問い合わせ内容 <span class="required">*</span></label>
                            <textarea id="message" name="message" placeholder="プロジェクトの詳細やご要望をお聞かせください" required></textarea>
                        </div>
                        <button type="submit" class="form-submit">
                            <i class="fas fa-paper-plane"></i>
                            お問い合わせを送信
                        </button>
                    </form>
                </div>
                <div class="contact-info-card">
                    <div class="contact-info-header">
                        <i class="fas fa-headset"></i>
                        <h3>お電話でのご相談</h3>
                    </div>
                    <div class="contact-info-content">
                        <div class="contact-info-item">
                            <i class="fas fa-phone"></i>
                            <div>
                                <h4>電話番号</h4>
                                <p>03-1234-5678</p>
                            </div>
                        </div>
                        <div class="contact-info-item">
                            <i class="fas fa-clock"></i>
                            <div>
                                <h4>受付時間</h4>
                                <p>平日 9:00〜18:00</p>
                            </div>
                        </div>
                        <div class="contact-info-item">
                            <i class="fas fa-envelope"></i>
                            <div>
                                <h4>メールアドレス</h4>
                                <p>info@webcraft.com</p>
                            </div>
                        </div>
                    </div>
                    <div class="contact-benefits">
                        <h4>お問い合わせ特典</h4>
                        <ul>
                            <li><i class="fas fa-check"></i>無料相談・お見積り</li>
                            <li><i class="fas fa-check"></i>提案書の無料作成</li>
                            <li><i class="fas fa-check"></i>競合分析レポート</li>
                            <li><i class="fas fa-check"></i>30日間無料サポート</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- CTAセクション -->
    <section class="cta-section">
        <div class="container">
            <h2>今すぐ無料相談を始めませんか？</h2>
            <p>お客様のビジネスを成功に導くWebサイトを一緒に作りましょう</p>
            <p style="margin-top: 1rem; font-size: 0.9rem; opacity: 0.8;">
                30日間の無料サポート付き｜返金保証あり｜お見積り無料
            </p>
        </div>
    </section>

    <!-- 固定CTAボタン -->
    <a href="#contact" class="floating-cta" id="floatingCta">
        無料相談
    </a>

    <!-- フッター -->
    <footer>
        <div class="container">
            <p>&copy; 2024 WebCraft. All rights reserved.</p>
            <p>あなたのビジネスパートナー - プロフェッショナルなWebサイト制作</p>
        </div>
    </footer>

    <?php wp_footer(); ?>
    <script src="<?php echo get_stylesheet_directory_uri(); ?>/custom_site_js/custom_site.js"></script>

</body>
</html>