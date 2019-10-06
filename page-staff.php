<?php
/**
 * Template Name: Staff page
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

			<?php while ( have_posts() ) : the_post(); ?>
				
				<header class="pageheader cf">
					<div class="wrapper cf">
						<h1><span><?php the_title(); ?></span></h1>
					</div>
				</header>
				<?php if ( get_the_content() ) { ?>
				<div class="page-content"><?php the_content(); ?></div>	
				<?php } ?>

			<?php endwhile;  ?>
			

			<?php
			$args = array(
				'posts_per_page'   => -1,
				'post_type'        => 'staff',
				'post_status'      => 'publish'
			);
			$items = new WP_Query($args);
			if ( $items->have_posts() ) { ?>
			<div class="team-list clear">
				<div class="flexrow clear">
					<?php while ( $items->have_posts() ) : $items->the_post();
						$job_title = get_field('job_title'); 
						$pronunciation = get_field('pronunciation'); 
						$team_name = get_the_title();
						$team_link = get_permalink();
						$thumbId = get_post_thumbnail_id();
						$photoImg = wp_get_attachment_image_src($thumbId,'large');
						$photo = ($photoImg) ? $photoImg[0] : '';
						$px = get_bloginfo('template_url') . '/images/square.png';
						$styleImg = ($photo) ? ' style="background-image:url('.$photo.')"':'';
						$description = (get_the_content()) ? strip_tags(get_the_content()) : '';
						?>
						<div id="team_<?php the_ID();?>" data-url="<?php echo $team_link; ?>" data-id="<?php the_ID();?>" class="team <?php echo ($photo) ? 'has-photo':'no-photo';?>">
							<div class="inside cf">
								<div class="photo"<?php echo $styleImg ?>>
									<img src="<?php echo $px; ?>" alt="" aria-hidden="true" />
								</div>
								<div class="info">
									<div class="staff-header">
										<h3><?php echo $team_name; ?></h3>
										<?php if($pronunciation) { ?>
										<div class="pronunciation">(<?php echo $pronunciation; ?>)</div>
										<?php } ?>
										<?php if($job_title) { ?>
										<div class="jobtitle"><?php echo $job_title; ?></div>
										<?php } ?>
									</div>
									

									<?php if ($description) { ?>
									<div class="staff-text">
										<div class="excerpt"><?php echo shortenText($description,200,' ',',..'); ?></div>

										<div class="buttondiv">
											<a href="<?php echo $team_link ?>" class="pagelink">Read More</a>
										</div>
									</div>
									<?php } ?>
								</div>
							</div>
						</div>
					<?php endwhile; wp_reset_postdata(); ?>
				</div>
			</div>
			<?php } ?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_footer();
