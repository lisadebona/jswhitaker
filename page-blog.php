<?php
/**
 * Template Name: Blog
 *
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

		<?php  
		$perpage = (get_field('pagenum','option')) ? get_field('pagenum','option') : 2;
		$paged = ( get_query_var( 'pg' ) ) ? absint( get_query_var( 'pg' ) ) : 1;
		$args = array(
			'posts_per_page'=> $perpage,
			'post_type'		=> 'post',
			'post_status'	=> 'publish',
			'paged'			=> $paged
		);
		$blogs = new WP_Query($args);
		if ( $blogs->have_posts() ) { ?>
		<div class="blog-wrapper cf">
			<div class="news-items cf">
				<?php while ( $blogs->have_posts() ) : $blogs->the_post(); 
					$thumbId = get_post_thumbnail_id();
					$img = wp_get_attachment_image_src($thumbId,'medium');
				?>
				<article class="article postcol">
					<div class="inner clear">
						<h3 class="post-title"><?php the_title(); ?></h3>
						<div class="post-excerpt cf">
							<?php if ($img) { ?>
								<div class="postthumb"><img src="<?php echo $img[0] ?>" alt="<?php echo get_the_title(); ?>" /></div>
							<?php } ?>
							<?php if ($content = get_the_content()) {
								$s_content = strip_shortcodes($content);
								$s_content = strip_tags($s_content); ?>
								<?php echo shortenText($s_content,300,' ',',..'); ?>
							<?php } ?>
							
						</div>
						<div class="post-link cf"><a href="<?php echo get_permalink()?>">Continue Reading <span>&rarr;</span></a></div>
					</div>
				</article>
				<?php endwhile; wp_reset_postdata(); ?>
			</div>
		</div>
		<?php } ?>

	
		
		<?php
			$total_pages = $blogs->max_num_pages;
		    if ($total_pages > 1){ ?>

		        <div id="pagination" class="pagination cf">
			        <?php
					    $pagination = array(
					        'base' => @add_query_arg('pg','%#%'),
					        'format' => '?paged=%#%',
					        'mid-size' => 1,
					        'current' => $paged,
					        'total' => $total_pages,
					        'prev_next' => True,
					        'prev_text' => __( '<span class="fa fa-arrow-left"></span>' ),
					        'next_text' => __( '<span class="fa fa-arrow-right"></span>' )
					    );
					    echo paginate_links($pagination);
					?>
				</div>
				<?php
		    }
		?>

	
	</main><!-- #main -->
</div><!-- #primary -->

<?php
get_footer();
