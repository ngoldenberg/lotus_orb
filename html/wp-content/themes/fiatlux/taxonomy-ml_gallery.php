<?php
get_header();
get_template_part('includes/gallery_bg');
?>
	<div class="ml_wrapper">
		<div id="ml_all_content" class="ml_with_no_sidebar">
	    <?php get_template_part('includes/loop-pictures'); ?>
		</div>
<?php get_template_part('includes/minimize'); ?>
<?php get_footer(); ?>