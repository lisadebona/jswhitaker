<?php get_header(); ?>
<div id="primary" class="content-area cf">
	<main id="main" class="site-main cf" role="main">
		<?php while ( have_posts() ) : the_post(); ?>
			
			<?php 
			$announcement = get_field('announcement'); 
			$services = get_field('services'); 
			$service_image = get_field('service_image'); 
			$buttonname = get_field('buttonname'); 
			$buttonlink = get_field('buttonlink'); 
			?>
			
			<?php if ($announcement) { ?>
			<div class="announcement text-center">
				<div class="wrapper"><?php echo $announcement; ?></div>
			</div>
			<?php } ?>

			<?php if ( get_the_content() ) { ?>
			<div class="home-intro">
				<div class="wrapper">
					<?php the_content(); ?>
				</div>
			</div>	
			<?php } ?>

			<?php if ($services) { ?>
			<div class="servicesbox <?php echo ($service_image) ? 'hasimage':'noimage'; ?>">
				<div class="wrapper cf">
					<div class="maintext">
						<?php echo $services ?>

						<?php if ($buttonname && $buttonlink) { ?>
						<div class="buttondiv text-center">
							<a href="<?php echo $buttonlink ?>" class="ctaBtn"><?php echo $buttonname ?> &raquo;</a>
						</div>	
						<?php } ?>
					</div>

					<?php if ($service_image) { ?>
					<div class="service-image">
						<img src="<?php echo $service_image['url'] ?>" alt="<?php echo $service_image['title'] ?>" />
					</div>
					<?php } ?>
				</div>
			</div>	
			<?php } ?>

		<?php endwhile;  ?>
	</main><!-- #main -->
</div><!-- #primary -->
<?php
get_footer();
