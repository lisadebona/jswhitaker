<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
<link href="https://fonts.googleapis.com/css?family=Roboto:100,100i,300,300i,400,400i,500,500i,700,700i,900,900i&display=swap" rel="stylesheet">
<script defer src="<?php bloginfo( 'template_url' ); ?>/assets/svg-with-js/js/fontawesome-all.js"></script>
<?php wp_head(); ?>

<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-149477041-1"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());
  gtag('config', 'UA-149477041-1');
</script>

<?php 
	// if( isset($_GET['copyreviews']) && $_GET['copyreviews']==99 ) {
	// 	$result = copy_site_reviews();
	// }
?>
</head>

<body <?php body_class(); ?>>
<div id="page" class="site cf">
	<a class="skip-link sr" href="#content"><?php esc_html_e( 'Skip to content', 'jspine' ); ?></a>

	<?php
		$address = get_field('address','option');
		$phone = get_field('phone','option');
		$email = get_field('email','option');
	?>
	<header id="masthead" class="site-header cf" role="banner">
		<div id="topmenu" class="wrapper cf">
			<div class="flexrow">
				<?php if( get_custom_logo() ) { ?>
		            <div class="logo">
		            	<?php the_custom_logo(); ?>
		            </div>
		        <?php } else { ?>
		            <h1 class="logo">
			            <a href="<?php bloginfo('url'); ?>"><?php bloginfo('name'); ?></a>
		            </h1>
		        <?php } ?>

		        <?php if ($phone) { ?>
		        <div class="contact-info">
		        	<span class="lbl">Call Us Today!</span> <a href="tel:<?php echo format_phone_number($phone); ?>"><strong><?php echo $phone ?></strong></a>
		        </div>
		        <?php } ?>
	        </div>
	    </div>

		<nav id="site-navigation" class="main-navigation cf" role="navigation">
			<button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false"><span><i class="bar"></i>Menu</span></button>
			<div class="wrapper primarymenu">
				<?php wp_nav_menu( array( 'theme_location' => 'primary', 'menu_id' => 'primary-menu','container_class'=>'menu-wrapper' ) ); ?>
				<?php wp_nav_menu( array( 'theme_location' => 'secondary', 'menu_id' => 'right-menu','container_class'=>'right-menu-wrapper' ) ); ?>
			</div>
		</nav><!-- #site-navigation -->
	</header><!-- #masthead -->

	<?php get_template_part('parts/content','hero'); ?>

	<div id="content" class="site-content wrapper">
