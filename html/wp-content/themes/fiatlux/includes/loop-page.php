<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
<?php 

global $post;

//if have a special content (YouTube, Vimeo, .MOV or .SWF), generate the link to the content.
if(get_post_meta($post->ID, 'ml_single_special_content', true)) {
	//content URL
	$featured_link = get_post_meta($post->ID, 'ml_single_special_content', true);
	//content width (.MOV and .SWF)
	$featured_width = get_post_meta($post->ID, 'ml_single_special_content_width', true);
	//content height (.MOV and .SWF)
	$featured_height = get_post_meta($post->ID, 'ml_single_special_content_height', true);
	//add width and height to the end of the link
	$featured_link = $featured_link.'?width='.$featured_width.'&height='.$featured_height;
	//add the video icon to the background of the featured image
	$featured_class = 'ml_icon_video';
}
//if don't have a special content, get tue full image URL
else {
	//full image URL
	$featured_array = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'full' );
	$featured_link = $featured_array[0];
	//add the picture icon to the background of the featured image
	$featured_class = 'ml_icon_picture';
}

//get the featured image description
$featured_id = get_post_meta($post->ID, '_thumbnail_id', true);
$featured_attachment = get_post($featured_id);
$featured_description = $featured_attachment->post_excerpt == "" ? $featured_attachment->post_content : $featured_attachment->post_excerpt;
//if don't have any description, make it blank
if (!($featured_description)) {
	$featured_description = ' ';
}

if(is_page_template('template-page-full_width.php')) {
	$page_width = 'ml_one_full';
} else {
	$page_width = 'ml_post_content';
}
?>
	<?php /* add the skills as classes for each portfolio item */ ?>
	<article id="post-<?php the_ID(); ?>" <?php post_class($page_width.' ml_with_padding ml_boxed'); ?>>
		
		<?php
			//if have featured image, get it and add a content wrapper
			if ( (function_exists('has_post_thumbnail')) && (has_post_thumbnail()) ) { ?>
			<a href="<?php echo $featured_link; ?>" class="featured-image <?php echo $featured_class; ?>" data-rel="prettyPhoto[portfolio]" title="<?php echo $featured_description; ?>">
				<?php the_post_thumbnail('featured'); ?></a>
			</a>
		<?php } ?>
			<h1 class="single-title"><?php the_title(); ?></h1>
			<p><?php the_content(); ?></p>

<?php endwhile; ?>

	<?php comments_template('', true); ?>
	</article>
	
<?php else: ?>
	
	<p><?php _e('Sorry, no posts matched your criteria.', 'meydjer') ?></p>

<?php endif; ?>

<?php wp_reset_query(); ?>