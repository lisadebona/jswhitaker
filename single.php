<?php
/**
 * The template for displaying all single posts.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
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

				<?php $has_image = ( has_post_thumbnail() ) ? 'hasimage':'noimage'; ?>
				<div class="default-content singeposttext <?php echo $has_image ?>"><?php the_content(); ?></div>	

				<?php if (has_post_thumbnail()) { ?>
				<div class="single-imagecol">
					<?php the_post_thumbnail(); ?>
				</div>	
				<?php } ?>

			<?php endwhile;  ?>

	</main><!-- #main -->
</div><!-- #primary -->

<?php
get_footer();
