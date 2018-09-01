<?php
/*
Template Name: Portfolio - 3 Cols
*/

get_header();
get_template_part('includes/standard_bg');
?>
	<div class="ml_wrapper">
		<div id="ml_all_content" class="ml_with_no_sidebar">
	    <?php get_template_part('includes/loop-portfolio-3cols'); ?>
		</div>
<?php get_template_part('includes/minimize'); ?>
<?php get_footer(); ?>