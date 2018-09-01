<?php
	get_header();
	get_template_part('includes/standard_bg');
?>
	<div class="ml_wrapper">
		<div id="ml_all_content" class="ml_with_sidebar ml_blog">
			<section id="ml_404" class="ml_post_content ml_with_padding ml_boxed">
				<h1><?php _e('404 - Not Found', 'meydjer'); ?></h1>
			
				<strong><?php _e('Sorry, no posts matched your criteria.', 'meydjer') ?></strong>
				
				<br /><br />
				
				<p><?php _e('Please try again, re-check your URL or use the menu or search box to find what you were looking for.', 'meydjer') ?></p>
			</section>
		</div>
		<?php get_sidebar(); ?>
<?php get_footer(); ?>