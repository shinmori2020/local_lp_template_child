<?php
/**
 * Template Name: 前に作成したLPパーツをモジュール化して配置する用テンプレート
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

    <!-- メインコンテンツ -->
    <main>
        <?php echo do_shortcode('[firstview_01_module]'); ?>
        <?php echo do_shortcode('[problem_01_module]'); ?>
        <?php echo do_shortcode('[benefit_01_module]'); ?>
        <?php echo do_shortcode('[achievement_01_module]'); ?>
        <?php echo do_shortcode('[main_features_01_module]'); ?>
        <?php echo do_shortcode('[unique_points_01_module]'); ?>
        <?php echo do_shortcode('[pricing_01_module]'); ?>
        <?php echo do_shortcode('[implementation_steps_01_module]'); ?>

    </main>


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