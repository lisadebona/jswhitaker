<?php
/**
 * Template Name: Reviews
 *
 */

get_header(); ?>

<div id="primary" class="content-area pagereviews  cf">
	<main id="main" class="site-main wrapper cf" role="main">

		<?php while ( have_posts() ) : the_post(); ?>
				
				<header class="pageheader cf">
					<h1 class="pagetitle"><span><?php the_title(); ?></span></h1>
					<a href="<?php echo get_site_url() ?>/review-form/" class="orangeBtn">Leave us a review on our website &raquo;</a>
				</header>
				<div class="default-content cf"><?php the_content(); ?></div>	

			<?php endwhile;  ?>

	</main><!-- #main -->
</div><!-- #primary -->

<?php
get_footer();
