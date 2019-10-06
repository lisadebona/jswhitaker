<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package jspine
 */

get_header(); ?>

<div id="primary" class="content-area defaulttemplate  cf">
	<main id="main" class="site-main wrapper cf" role="main">

		<?php while ( have_posts() ) : the_post(); ?>
				
				<header class="pageheader cf">
					<h1 class="pagetitle"><span><?php the_title(); ?></span></h1>
				</header>
				<div class="default-content"><?php the_content(); ?></div>	

			<?php endwhile;  ?>

	</main><!-- #main -->
</div><!-- #primary -->

<?php
get_footer();
