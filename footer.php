	</div><!-- #content -->
	
	<?php 
		$address = get_field('address','option');
		$phone = get_field('phone','option');
		$email = get_field('email','option'); 
		$social_links = get_social_links(); 
		$googlemap = get_field('googlemap','option'); 
		$map_link_before = '';
		$map_link_after = '';
		if($googlemap) {
			$map_link_before = '<a href="'.$googlemap.'" target="_blank">';
			$map_link_after = '</a>';
		}
	?>
	<footer id="colophon" class="site-footer" role="contentinfo">
		<div class="wrapper cf">
			<div class="flexrow">
				<div class="col-left">
					<?php if ($address) { ?>
					<div class="info">
						<strong>Location:</strong>
						<div><?php echo $map_link_before ?><?php echo $address ?><?php echo $map_link_after ?></div>
					</div>
					<?php } ?>

					<?php if ($phone) { ?>
					<div class="info">
						<strong>Phone:</strong>
						<div><a href="tel:<?php echo format_phone_number($phone); ?>"><?php echo $phone ?></a></div>
					</div>
					<?php } ?>

					<?php if ($email) { ?>
					<div class="info">
						<strong>Email:</strong>
						<div><a href="mailto:<?php echo antispambot($email,1); ?>?subject=<?php echo get_bloginfo('name') ?> - Inquiry"><?php echo antispambot($email); ?></a></div>
					</div>
					<?php } ?>
				</div>

				<?php if ($social_links) { ?>
				<div class="col-right social-media">
					<span class="txt">Connect with us</span>
					<?php foreach ($social_links as $k) { 
						$link = $k['link'];
						$icon = $k['icon'];
						$name = $k['name'];
						if($link) { ?>
						<a href="<?php echo $link ?>" target="_blank" class="<?php echo $name ?>"><i class="<?php echo $icon ?>" aria-hidden="true"></i><span class="sr"><?php echo $name ?></span></a>
						<?php } ?>
					<?php } ?>
				</div>
				<?php } ?>
			</div>
		</div><!-- wrapper -->
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
