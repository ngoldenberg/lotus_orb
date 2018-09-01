<?php
/*
Template Name: Page Full Width
*/

get_header();
get_template_part('includes/standard_bg');
?>
	<div class="ml_wrapper">
		<div id="ml_all_content" class="ml_with_no_sidebar ml_blog_single">
	    <?php get_template_part('includes/loop-page'); ?>
		</div>
<?php get_footer(); ?>