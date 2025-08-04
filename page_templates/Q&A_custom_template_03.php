<?php
/**
 * Template Name: カスタムテンプレート　Q&Aフォーム
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
    <link rel="stylesheet" href="<?php echo get_stylesheet_directory_uri(); ?>/css/qa-accordion.css">

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
        <!-- Q&A セクション -->
        <section class="qa-section" id="qa">
            <div class="qa-container">
                <div class="qa-header">
                    <h1 class="qa-title">よくある質問</h1>
                    <p class="qa-subtitle">お客様からよくいただく質問とその回答をまとめました。こちらで解決しない場合は、お気軽にお問い合わせください。</p>
                </div>
                
                <div class="qa-controls">
                    <div class="qa-search">
                        <input type="text" class="qa-search-input" placeholder="質問を検索... (Ctrl+K)">
                        <i class="fas fa-search qa-search-icon"></i>
                    </div>
                    <div class="qa-category-filter">
                        <button class="category-btn active" data-category="all">すべて</button>
                        <button class="category-btn" data-category="service">サービス</button>
                        <button class="category-btn" data-category="pricing">料金</button>
                        <button class="category-btn" data-category="technical">技術</button>
                        <button class="category-btn" data-category="support">サポート</button>
                    </div>
                </div>
                
                <div class="qa-list">
                    <!-- Q&A アイテム 1 -->
                    <div class="qa-item" data-category="service">
                        <button class="qa-question">
                            <div class="qa-question-content">
                                <span class="qa-category-tag">サービス</span>
                                <span class="qa-question-text">御社のサービスはどのような特徴がありますか？</span>
                            </div>
                            <i class="fas fa-chevron-down qa-icon"></i>
                        </button>
                        <div class="qa-answer">
                            <div class="qa-answer-content">
                                <div class="qa-answer-text">
                                    <p>弊社のサービスには以下のような特徴があります：</p>
                                    <ul>
                                        <li><strong>高い品質</strong>：業界標準を上回る品質管理システム</li>
                                        <li><strong>迅速な対応</strong>：24時間以内のレスポンス保証</li>
                                        <li><strong>コスト効率</strong>：競合他社と比較して最大30%のコスト削減</li>
                                        <li><strong>カスタマイズ対応</strong>：お客様のニーズに合わせた柔軟なサービス提供</li>
                                    </ul>
                                    <p>詳細については、<a href="#contact">お問い合わせ</a>いただければ、担当者が丁寧にご説明いたします。</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Q&A アイテム 2 -->
                    <div class="qa-item" data-category="pricing">
                        <button class="qa-question">
                            <div class="qa-question-content">
                                <span class="qa-category-tag">料金</span>
                                <span class="qa-question-text">料金体系について教えてください。</span>
                            </div>
                            <i class="fas fa-chevron-down qa-icon"></i>
                        </button>
                        <div class="qa-answer">
                            <div class="qa-answer-content">
                                <div class="qa-answer-text">
                                    <p>料金体系は以下の通りです：</p>
                                    <ol>
                                        <li><strong>ベーシックプラン</strong>：月額10,000円〜</li>
                                        <li><strong>スタンダードプラン</strong>：月額25,000円〜</li>
                                        <li><strong>プレミアムプラン</strong>：月額50,000円〜</li>
                                        <li><strong>エンタープライズプラン</strong>：お見積もり</li>
                                    </ol>
                                    <p>初期費用は一切かかりません。また、年間契約をいただくと最大20%の割引が適用されます。詳細な見積もりが必要な場合は、お気軽にご相談ください。</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Q&A アイテム 3 -->
                    <div class="qa-item" data-category="technical">
                        <button class="qa-question">
                            <div class="qa-question-content">
                                <span class="qa-category-tag">技術</span>
                                <span class="qa-question-text">システムの導入にはどのくらいの期間が必要ですか？</span>
                            </div>
                            <i class="fas fa-chevron-down qa-icon"></i>
                        </button>
                        <div class="qa-answer">
                            <div class="qa-answer-content">
                                <div class="qa-answer-text">
                                    <p>システム導入期間は、プランと規模により異なります：</p>
                                    <ul>
                                        <li><strong>ベーシックプラン</strong>：1〜2週間</li>
                                        <li><strong>スタンダードプラン</strong>：2〜4週間</li>
                                        <li><strong>プレミアムプラン</strong>：4〜8週間</li>
                                        <li><strong>エンタープライズプラン</strong>：2〜6ヶ月</li>
                                    </ul>
                                    <p>導入プロセスには、要件定義、システム設定、データ移行、テスト、研修が含まれます。専任のプロジェクトマネージャーが導入をサポートいたします。</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Q&A アイテム 4 -->
                    <div class="qa-item" data-category="support">
                        <button class="qa-question">
                            <div class="qa-question-content">
                                <span class="qa-category-tag">サポート</span>
                                <span class="qa-question-text">サポート体制はどうなっていますか？</span>
                            </div>
                            <i class="fas fa-chevron-down qa-icon"></i>
                        </button>
                        <div class="qa-answer">
                            <div class="qa-answer-content">
                                <div class="qa-answer-text">
                                    <p>充実したサポート体制をご用意しています：</p>
                                    <ul>
                                        <li><strong>メールサポート</strong>：全プラン対応（24時間受付）</li>
                                        <li><strong>電話サポート</strong>：平日9:00-18:00（スタンダード以上）</li>
                                        <li><strong>チャットサポート</strong>：平日9:00-21:00（プレミアム以上）</li>
                                        <li><strong>専任サポート</strong>：営業時間内対応（エンタープライズ）</li>
                                    </ul>
                                    <p>また、オンライン知識ベース、動画チュートリアル、定期的なWebセミナーも提供しております。</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Q&A アイテム 5 -->
                    <div class="qa-item" data-category="service">
                        <button class="qa-question">
                            <div class="qa-question-content">
                                <span class="qa-category-tag">サービス</span>
                                <span class="qa-question-text">無料トライアルはありますか？</span>
                            </div>
                            <i class="fas fa-chevron-down qa-icon"></i>
                        </button>
                        <div class="qa-answer">
                            <div class="qa-answer-content">
                                <div class="qa-answer-text">
                                    <p>はい、<strong>14日間の無料トライアル</strong>をご利用いただけます。</p>
                                    <p>トライアル期間中は以下が利用可能です：</p>
                                    <ul>
                                        <li>すべての基本機能へのアクセス</li>
                                        <li>サンプルデータでの動作確認</li>
                                        <li>メールサポート</li>
                                        <li>導入支援（オンラインミーティング）</li>
                                    </ul>
                                    <p>トライアル期間終了後、自動的に課金されることはありません。継続をご希望の場合のみ、プラン選択をしていただきます。</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Q&A アイテム 6 -->
                    <div class="qa-item" data-category="technical">
                        <button class="qa-question">
                            <div class="qa-question-content">
                                <span class="qa-category-tag">技術</span>
                                <span class="qa-question-text">既存システムとの連携は可能ですか？</span>
                            </div>
                            <i class="fas fa-chevron-down qa-icon"></i>
                        </button>
                        <div class="qa-answer">
                            <div class="qa-answer-content">
                                <div class="qa-answer-text">
                                    <p>はい、多くの既存システムとの連携が可能です：</p>
                                    <ul>
                                        <li><strong>CRM連携</strong>：Salesforce、HubSpot、Dynamics 365</li>
                                        <li><strong>会計システム</strong>：freee、MoneyForward、弥生会計</li>
                                        <li><strong>BI/分析ツール</strong>：Tableau、Power BI、Google Analytics</li>
                                        <li><strong>コミュニケーション</strong>：Slack、Teams、Chatwork</li>
                                    </ul>
                                    <p>標準的なAPI連携のほか、カスタム連携も承っております。既存システムの詳細をお聞かせいただければ、連携可能性を検討いたします。</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Q&A アイテム 7 -->
                    <div class="qa-item" data-category="pricing">
                        <button class="qa-question">
                            <div class="qa-question-content">
                                <span class="qa-category-tag">料金</span>
                                <span class="qa-question-text">解約時の手続きや違約金について教えてください。</span>
                            </div>
                            <i class="fas fa-chevron-down qa-icon"></i>
                        </button>
                        <div class="qa-answer">
                            <div class="qa-answer-content">
                                <div class="qa-answer-text">
                                    <p>解約に関する条件は以下の通りです：</p>
                                    <ul>
                                        <li><strong>月額契約</strong>：前月末までのお申し出で翌月末解約</li>
                                        <li><strong>年額契約</strong>：契約期間満了時に解約可能</li>
                                        <li><strong>違約金</strong>：基本的に発生しません</li>
                                        <li><strong>データエクスポート</strong>：解約前に全データの出力が可能</li>
                                    </ul>
                                    <p>解約手続きは管理画面から簡単に行えます。データの移行支援も無償で行っておりますので、ご安心ください。</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Q&A アイテム 8 -->
                    <div class="qa-item" data-category="support">
                        <button class="qa-question">
                            <div class="qa-question-content">
                                <span class="qa-category-tag">サポート</span>
                                <span class="qa-question-text">研修やオンボーディングのサポートはありますか？</span>
                            </div>
                            <i class="fas fa-chevron-down qa-icon"></i>
                        </button>
                        <div class="qa-answer">
                            <div class="qa-answer-content">
                                <div class="qa-answer-text">
                                    <p>包括的な研修プログラムをご用意しています：</p>
                                    <ol>
                                        <li><strong>初期設定サポート</strong>：専任スタッフによる設定支援</li>
                                        <li><strong>基本操作研修</strong>：オンライン/オンサイトでの実践的研修</li>
                                        <li><strong>管理者向け研修</strong>：高度な機能の活用方法</li>
                                        <li><strong>定期フォローアップ</strong>：導入後3ヶ月間の継続サポート</li>
                                    </ol>
                                    <p>また、学習教材として動画コンテンツ、操作マニュアル、FAQサイトもご利用いただけます。お客様の習熟度に合わせたカスタマイズ研修も可能です。</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="qa-stats">
                    <h3>Q&A統計</h3>
                    <div class="qa-stats-grid">
                        <div class="qa-stat-item">
                            <span class="qa-stat-number" id="total-questions">8</span>
                            <span class="qa-stat-label">総質問数</span>
                        </div>
                        <div class="qa-stat-item">
                            <span class="qa-stat-number" id="visible-questions">8</span>
                            <span class="qa-stat-label">表示中</span>
                        </div>
                        <div class="qa-stat-item">
                            <span class="qa-stat-number" id="active-questions">0</span>
                            <span class="qa-stat-label">開いている質問</span>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <!-- フッター -->
    <footer class="site-footer">
        <div class="footer-inner">
            <div class="footer-widgets">
                <div class="footer-widget-area"></div>
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

    <script src="<?php echo get_stylesheet_directory_uri(); ?>/js/qa-accordion.js"></script>
    <?php wp_footer(); ?>

</body>
</html>