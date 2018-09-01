<?php
/* get the number of columns selected in the theme panel and set the proper class */
$footer_col = of_get_option('ml_footer_columns');
if($footer_col == '1') {
	$footer_class = 'ml_one_full';
}
if($footer_col == '2') {
	$footer_class = 'ml_one_half';
}
if($footer_col == '3') {
	$footer_class = 'ml_one_third';
}
if($footer_col == '4') {
	$footer_class = 'ml_one_fourth';
}
?>
	<div class="clearfix"></div>
	
	<!--BEGIN Footer-->
	<footer id="footer">
		<div class="ml_wrapper ml_with_columns">

		<?php if($footer_col != '1') { ?>
		<div class="ml_centering">
		<?php } ?>

		<?php /*--- Footer One Column ---*/ ?>
		<?php if($footer_col >= '1') { ?>
		<section class="<?php echo $footer_class; ?> ml_footer_one">
			<ul>
				<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar(__('Footer - One', 'meydjer')) ) ?>
			</ul>
		</section>
		<?php } ?>

		<?php /*--- Footer Two Columns ---*/ ?>
		<?php if($footer_col >= '2') { ?>
		<section class="<?php echo $footer_class; ?> ml_footer_two">
			<ul>
				<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar(__('Footer - Two', 'meydjer')) ) ?>
			</ul>
		</section>
		<?php } ?>

		<?php /*--- Footer Three Columns ---*/ ?>
		<?php if($footer_col >= '3') { ?>
		<section class="<?php echo $footer_class; ?> ml_footer_three">
			<ul>
				<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar(__('Footer - Three', 'meydjer')) ) ?>
			</ul>
		</section>
		<?php } ?>
		
		<?php /*--- Footer Four Columns ---*/ ?>
		<?php if($footer_col == '4') { ?>
		<section class="<?php echo $footer_class; ?> ml_footer_four">
			<ul>
				<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar(__('Footer - Four', 'meydjer')) ) ?>
			</ul>
		</section>
		<?php } ?>

		<?php if($footer_col != '1') { ?>
		</div><!-- END div.centering -->
		<?php } ?>
		
		<?php /*--- Copyright Message ---*/
		if(of_get_option('ml_copyright_text')) {
		?>
		<section id="copyright" class="ml_one_full ml_with_padding ml_boxed">
			<?php echo of_get_option('ml_copyright_text', '&copy; Copyright 2011 - <a href="http://meydjer.com/">Meydjer Luzzoli</a>. All rights reserved.'); ?>
		</section>
		<?php } ?>
		</div>
	</footer>
	<div class="clearfix"></div>
	<!--END Footer-->


	<!--BEGIN Texture, Pattern and Gradient effect-->
	<div class="footer-gradient"></div>
	<div class="footer-pattern"></div>
	<div class="footer-texture"></div>
	<!--END Texture, Pattern and Gradient effect-->
	
	<script type="text/javascript">
	<?php
	/* get the Tracking Code (e.g. Google Analytics) and the custom js scripts */
	echo of_get_option('ml_custom_js');
	?>
	</script>

	<!--[if lt IE 9]>
	<script type="text/javascript">
	jQuery('.jp-play').html('<img src="<?php echo get_template_directory_uri(); ?>/images/play_dull.gif" alt="Play" />');
	jQuery('.jp-pause').html('<img src="<?php echo get_template_directory_uri(); ?>/images/pause_dull.gif" alt="Pause" />');
	jQuery('.jp-unmute').html('<img src="<?php echo get_template_directory_uri(); ?>/images/ml_music_off.gif" alt="Unmute" />');
	jQuery('.jp-mute').html('<img src="<?php echo get_template_directory_uri(); ?>/images/ml_music_on.gif" alt="Mute" />');
	</script>
	<![endif]-->
	
	<script type="text/javascript">
	if (jQuery.browser.mozilla && parseInt(jQuery.browser.version) < 2) {
		jQuery('.jp-play').html('<img src="<?php echo get_template_directory_uri(); ?>/images/play_dull.gif" alt="Play" />');
		jQuery('.jp-pause').html('<img src="<?php echo get_template_directory_uri(); ?>/images/pause_dull.gif" alt="Pause" />');
		jQuery('.jp-unmute').html('<img src="<?php echo get_template_directory_uri(); ?>/images/ml_music_off.gif" alt="Unmute" />');
		jQuery('.jp-mute').html('<img src="<?php echo get_template_directory_uri(); ?>/images/ml_music_on.gif" alt="Mute" />');
	}
	</script>

	<?php wp_footer(); ?>
</body>
</html>