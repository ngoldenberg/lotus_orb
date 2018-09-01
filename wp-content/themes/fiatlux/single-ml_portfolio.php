<?php
get_header();
get_template_part('includes/standard_bg');
?>
	<div class="ml_wrapper">
		<section id="ml_all_content" class="ml_with_sidebar">
	    <?php get_template_part('includes/loop-single-portfolio'); ?>
		</section>
		<?php get_sidebar(); ?>
<?php get_footer(); ?>