<?php
/**
 * The header file.
 *
 * アンサンブル・フォルテピアノテーマ　ヘッダー
 *
 * @package WordPress
 * @subpackage efp_brass
 * @since efp_brass 3.0
 */
?>
<!-- 
//////////////////////////////////////////////////////

FREE HTML5 TEMPLATE 
DESIGNED & DEVELOPED by FREEHTML5.CO
	
Website: 		http://freehtml5.co/
Email: 			info@freehtml5.co
Twitter: 		http://twitter.com/fh5co
Facebook: 		https://www.facebook.com/fh5co

//////////////////////////////////////////////////////
 -->

<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<!--[if lt IE 8]>
<meta http-equiv="X-UA-Compatible" content="IE=8"/>
<![endif]-->

<title><?php
	/*
	 * Print the <title> tag based on what is being viewed.
	 */
	global $page, $paged;

	wp_title( '|', true, 'right' );

	// Add the blog name.
	bloginfo( 'name' );

	// Add the blog description for the home/front page.
	$site_description = get_bloginfo( 'description', 'display' );
	if ( $site_description && ( is_home() || is_front_page() ) )
		echo " | $site_description";

	// Add a page number if necessary:
	if ( $paged >= 2 || $page >= 2 )
		echo ' | ' . sprintf( __( 'Page %s', 'twentyten' ), max( $paged, $page ) );
?></title>

<?php wp_head(); ?>

	<meta property="og:title" content=""/>
    <meta property="og:type" content="article" />
	<meta property="og:image" content="http://fortepiano.s377.xrea.com/wordpress/wp-content/themes/fortepiano_3.0/images/default.png"/>
	<meta property="og:url" content=""/>
	<meta property="og:site_name" content=""/>
	<meta property="og:description" content=""/>
	<meta name="twitter:card" content="summary" />
	<meta name="twitter:site" content="@efp_brass" />
	<meta name="twitter:title" content="" />
	<meta name="twitter:image" content="" />
	<meta name="twitter:url" content="" />

    <meta property="fb:admins" content="100014282357578" />

	<!-- Place favicon.ico and apple-touch-icon.png in the root directory -->
	<link rel="shortcut icon" href="favicon.ico">

	<!-- Google Webfonts -->
	<link href='http://fonts.googleapis.com/css?family=Roboto:400,300,100,500' rel='stylesheet' type='text/css'>
	<link href='http://fonts.googleapis.com/css?family=Roboto+Slab:400,300,100,500' rel='stylesheet' type='text/css'>
	
	<!-- Animate.css -->
	<link rel="stylesheet" href="<?php bloginfo('template_directory'); ?>/css/animate.css">
	<!-- Icomoon Icon Fonts-->
	<link rel="stylesheet" href="<?php bloginfo('template_directory'); ?>/css/icomoon.css">
	<!-- Simple Line Icons -->
	<link rel="stylesheet" href="<?php bloginfo('template_directory'); ?>/css/simple-line-icons.css">
	<!-- Theme Style -->
	<link rel="stylesheet" href="<?php bloginfo('template_directory'); ?>/style.css">
	<!-- Modernizr JS -->
	<script src="<?php bloginfo('template_directory'); ?>/js/modernizr-2.6.2.min.js"></script>
	<script src="<?php bloginfo('template_directory'); ?>/js/jquery.adaptive-backgrounds.js"></script>
	<!-- FOR IE9 below -->
	<!--[if lt IE 9]>
	<script src="<?php bloginfo('template_directory'); ?>/js/respond.min.js"></script>
	<![endif]-->
	
    <script type="text/javascript" >
        jQuery(document).ready(function($){
            $.adaptiveBackground.run();

            var topBtn = $('#page-top');    
            topBtn.hide();
            //スクロールが100に達したらボタン表示
            $(window).scroll(function () {
                if ($(this).scrollTop() > 100) {
                    topBtn.fadeIn();
                } else {
                    topBtn.fadeOut();
                }
            });
            //スクロールしてトップ
            topBtn.click(function () {
                $('body,html').animate({
                    scrollTop: 0
                }, 500);
                return false;
            });

        });
        
    </script>
	<body>
		
	<header id="fh5co-header" role="banner">
		<nav class="navbar navbar-default <?php if( chk_mobile() ) { echo  "text-center"; } ?> " role="navigation">
			<div class="container">
				<div class="row">
					<div class="col-md-10 col-md-offset-1">
						<div class="navbar-header"> 
						<!-- Mobile Toggle Menu Button -->
						<a href="#" class="js-fh5co-nav-toggle fh5co-nav-toggle visible-xs-block" data-toggle="collapse" data-target="#fh5co-navbar" aria-expanded="false" aria-controls="navbar"><i></i></a>
						<a class="navbar-brand" href="<?php echo site_url(); ?>">EFP</a>
						</div>
						<div id="fh5co-navbar" class="navbar-collapse collapse">
							<ul class="nav navbar-nav navbar-right">
								<li class="active"><a href="<?php echo site_url(); ?>"><span>Home <span class="border"></span></span></a></li>
								<li><a href="<?php echo home_url( '/' );echo '?p=2'; ?>"><span>プロフィール <span class="border"></span></span></a></li>
								<li><a href="<?php bloginfo('url'); ?>?p=522"><span>ブログ <span class="border"></span></span></a></li>
								<li><a href="<?php bloginfo('url'); ?>?post_type=lessons"><span>スケジュール <span class="border"></span></span></a></li>
								<?php if( is_user_logged_in() ) : ?>
									<?php if( is_extra() ) : ?>
										<li class="dropdown">
											<a href="#" class="dropdown-toggle" data-toggle="dropdown">メンバー<strong class="caret"></strong></a>
											<?php wp_nav_menu( array( 'container'=>false,  'menu_class'=>'dropdown-menu', 'theme_location' => 'sub_menu' )); ?>
										</li>
									<?php else : ?>
										<li class="dropdown">
											<a href="#" class="dropdown-toggle" data-toggle="dropdown">メンバー<strong class="caret"></strong></a>
											<?php wp_nav_menu( array( 'container'=>false,  'menu_class'=>'dropdown-menu', 'theme_location' => 'member_menu' )); ?>
										</li>
									<?php endif; ?>
								<?php else: ?>
									<li id="LOGIN"><a href="<?php echo home_url( '/' );echo 'login/'; ?>"><span>ログイン <span class="border"></span></span></a></li>
								<?php endif; ?>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</nav>
	</header>
	<!-- END .header -->
	