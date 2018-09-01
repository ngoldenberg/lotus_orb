<?php
	/* Get the author data */
	if(get_query_var('author_name')) :
	$curauth = get_userdatabylogin(get_query_var('author_name'));
	else :
	$curauth = get_userdata(get_query_var('author'));
	endif;

	get_header();
	get_template_part('includes/standard_bg');
?>
	<div class="ml_wrapper">
		<div id="ml_all_content" class="ml_with_sidebar ml_blog">
			<section id="ml_archive-info" class="ml_post_content ml_with_padding ml_boxed">
			<h1 class="archive-title"><?php _e("Search Results for '$s'", 'meydjer') ?></h1>
			</section>
	    <?php get_template_part('includes/loop'); ?>
		</div>
		<?php get_sidebar(); ?>
<?php get_footer(); ?>