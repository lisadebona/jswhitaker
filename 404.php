<?php
/**
 * The template for displaying 404 pages (not found).
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package jspine
 */

get_header(); ?>

<div id="primary" class="content-area defaulttemplate error-404 cf">
	<main id="main" class="site-main wrapper text-center cf" role="main">
		<header class="pageheader cf">
			<h1 class="pagetitle text-center"><span>404 Page Not Found!</span></h1>
		</header>
		
		<div class="default-content">
			<p><?php esc_html_e( 'It looks like nothing was found at this location.', 'jspine' ); ?></p>
		</div>	

	</main><!-- #main -->
</div><!-- #primary -->

<?php
get_footer();
