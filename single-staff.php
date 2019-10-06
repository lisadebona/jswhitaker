<?php
/**
 * The template for displaying staff details
 */

get_header(); ?>

	<div id="primary" class="content-area singlepage cf">
		<main id="main" class="site-main wrapper" role="main">

		<?php while ( have_posts() ) : the_post(); ?>

			<div class="wrapper infowrapper cf">

				<?php if( has_post_thumbnail() ) { ?>
				<div class="imagecol">
					<div class="frame"><?php the_post_thumbnail('large'); ?></div>
				</div>
				<?php } ?>

				<div class="textcol <?php echo ( has_post_thumbnail() ) ? 'hasimage': 'noimage'; ?>">

					<?php  
						$job_title = get_field('job_title'); 
						$pronunciation = get_field('pronunciation'); 
						$team_name = get_the_title();
						$thumbId = get_post_thumbnail_id();
					?>
					<header class="pageheader cf">
						<h1 class="pagetitle"><?php echo $team_name; ?></h1>
						<?php if($pronunciation) { ?>
						<div class="pronunciation">(<?php echo $pronunciation; ?>)</div>
						<?php } ?>
						<?php if($job_title) { ?>
						<div class="jobtitle"><?php echo $job_title; ?></div>
						<?php } ?>
					</header>

					<div class="entry-content">
						<?php the_content(); ?>
					</div>
				</div>
				

			</div>
			
			

		<?php endwhile; ?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_footer();
