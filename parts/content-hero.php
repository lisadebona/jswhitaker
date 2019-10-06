<?php  
if( is_front_page() ) {
	$slides = get_field("slider");
	if($slides) { ?>
	<div class="slideshow">
		<div class="swiper-container">
			<div class="swiper-wrapper">
			<?php $i=1; foreach ($slides as $s) { 
				$img = $s['image'];
				$caption = $s['caption'];
				$button_name = $s['button_name'];
				$button_link = $s['button_link'];
				$position = $s['text_position'];
				$position = ($position) ? $position : 'left';

				if($img) { ?>
				<div id="slide<?php echo $i;?>" class="swiper-slide slide-item <?php echo $position ?>">
					<div class="slide-image">
						<img class="image" src="<?php echo $img['url'] ?>" alt="<?php echo $img['title'] ?>">
						<div class="caption">
							<div class="wrapper flexrow">
								<?php if ($caption) { ?>
								<div class="slide-caption">
									<div class="text"><?php echo $caption ?></div>

									<?php if ($button_name && $button_link) { ?>
									<div class="slide-button">
										<a href="<?php echo $button_link ?>" class="slideBtn"><?php echo $button_name ?> &raquo;</a>
									</div>	
									<?php } ?>
								</div>
								<?php } ?>
							</div>
						</div>
					</div>
				</div>
				<?php } ?>
			
			<?php $i++; } ?>
			</div>
		</div>
		
		<div class="swiper-pagination"></div>
		<div class="swiper-button-next"></div>
		<div class="swiper-button-prev"></div>
	</div>
	<?php } ?>

<?php } ?>