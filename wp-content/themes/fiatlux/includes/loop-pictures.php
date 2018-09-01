<?php

$term = get_term_by('slug', get_query_var('term'), get_query_var('taxonomy'));

$grid_cols = of_get_option('ml_grid_cols','5');

if ($grid_cols == '2') {
	$grid_px = '461';
}
if ($grid_cols == '3') {
	$grid_px = '306';
}
if ($grid_cols == '4') {
	$grid_px = '228';
}
if ($grid_cols == '5') {
	$grid_px = '182';
}
if ($grid_cols == '6') {
	$grid_px = '151';
}
if ($grid_cols == '7') {
	$grid_px = '128';
}
if ($grid_cols == '8') {
	$grid_px = '112';
}
if ($grid_cols == '9') {
	$grid_px = '99';
}
if ($grid_cols == '10') {
	$grid_px = '89';
}


?>
<section id="ml_pictures">
	<article id="post-<?php the_ID(); ?>" <?php post_class('ml_one_full ml_with_padding ml_boxed'); ?>>
		
		<h2><?php echo $term->name; ?></h2>
		<p><?php echo $term->description; ?></p>
		
	  <?php if (have_posts()) :
	  
		$args = array('posts_per_page' => -1,
									'tax_query' => array(
										array(
											'taxonomy' => 'ml_gallery',
											'field' => 'id',
											'terms' => $term->term_id
											)
										)
									);
		$loop = new WP_Query( $args );
		while ( $loop->have_posts() ) : $loop->the_post();
						
			global $post;

			//full image URL
			$featured_array = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'full' );
			$featured_image = $featured_array[0];
			//add the picture icon to the background of the featured image
			
			//get the featured image description
			$featured_id = get_post_meta($post->ID, '_thumbnail_id', true);
			$featured_attachment = get_post($featured_id);
			$featured_description = $featured_attachment->post_excerpt == "" ? $featured_attachment->post_content : $featured_attachment->post_excerpt;
			//if don't have any description, make it blank
			if (!($featured_description)) {
				$featured_description = ' ';
			}
			
			if(of_get_option('ml_grayscale_effect')) {
				$colored_picture = get_template_directory_uri() . '/includes/timthumb.php?src='.$featured_image.'&w='.$grid_px.'&h='.$grid_px;
				$colored_bg = 'style="background: #000 url('.$colored_picture.') no-repeat center center"';
				$ml_grayscale_thumb = 'ml_grayscale_thumb';
				$picture_thumbnail = get_template_directory_uri() . '/includes/timthumb.php?src='.$featured_image.'&w='.$grid_px.'&h='.$grid_px.'&f=2';
			} else {
				$colored_picture = get_template_directory_uri() . '/includes/timthumb.php?src='.$featured_image.'&w='.$grid_px.'&h='.$grid_px;
				$colored_bg = 'style="background: #000 url('.$colored_picture.') no-repeat center center"';
				$ml_grayscale_thumb = 'ml_grayscale_thumb';
				$picture_thumbnail = get_template_directory_uri() . '/includes/timthumb.php?src='.$featured_image.'&w='.$grid_px.'&h='.$grid_px;
			}

	
				//if have featured image, get it
				if ( (function_exists('has_post_thumbnail')) && (has_post_thumbnail()) ) { ?>
				<a href="<?php echo $featured_image; ?>" class="featured-image <?php echo $ml_grayscale_thumb; ?>" data-rel="prettyPhoto[pictures]" title="<?php echo $featured_description; ?>" <?php echo $colored_bg; ?> >
					<img src="<?php echo $picture_thumbnail; ?>" alt="<?php the_title(); ?>" width="<?php echo$grid_px.'px' ?>" height="<?php echo$grid_px.'px' ?>" />
				</a>
			<?php } ?>
	
	    <?php endwhile; ?>
	  <?php endif; ?>
		
	</article>

</section>