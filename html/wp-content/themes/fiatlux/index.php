<?php
get_header();
get_template_part('includes/standard_bg');
?>
	<div class="ml_wrapper">
		<div id="ml_all_content" class="ml_with_sidebar ml_blog">
	    <?php get_template_part('includes/loop'); ?>
		</div>
		<?php get_sidebar(); ?>
<?php get_footer(); ?>