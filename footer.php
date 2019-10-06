	</div><!-- #content -->
	
	<?php 
		$address = get_field('address','option');
		$phone = get_field('phone','option');
		$email = get_field('email','option'); 
		$social_links = get_social_links(); 
	?>
	<footer id="colophon" class="site-footer" role="contentinfo">
		<div class="wrapper cf">
			<div class="flexrow">
				<div class="col-left">
					<?php if ($address) { ?>
					<div class="info">
						<strong>Location:</strong>
						<div><?php echo $address ?></div>
					</div>
					<?php } ?>

					<?php if ($phone) { ?>
					<div class="info">
						<strong>Phone:</strong>
						<div><a href="tel:<?php echo format_phone_number($phone); ?>"></a><?php echo $phone ?></div>
					</div>
					<?php } ?>

					<?php if ($email) { ?>
					<div class="info">
						<strong>Email:</strong>
						<div><a href="tel:<?php echo antispambot($email,1); ?>"></a><?php echo antispambot($email); ?></div>
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
