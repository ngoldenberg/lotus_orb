<?php
//get the slides effect options
$latest_n_pictures = of_get_option('ml_latest_n_pictures', '5');
$slides_effect = of_get_option('ml_slides_effect', 'random');
$slides_slices = of_get_option('ml_slides_slices', '4');
$slides_box_cols = of_get_option('ml_slides_box_cols', '4');
$slides_box_rows = of_get_option('ml_slides_box_rows', '4');
$slides_anim_speed = of_get_option('ml_slides_anim_speed', '0.5') * 1000;
$slides_pause_time = of_get_option('ml_slides_pause_time', '2.5') * 1000;

//if slides effect is disables, show only the latest picture
if(!of_get_option('ml_enable_slides_effects')) {
	$latest_n_pictures = '1';
}

/* filter pictures custom post type and show unlimited items */
query_posts( 'post_type=ml_pictures&posts_per_page=-1');
?>
<section id="ml_galleries" class="ml_with_columns">
<div class="ml_centering ml_galleries_masonry ml_multitple_columns">

<?php /* filter by gallery */ ?>

		<?php /* generate a box for each gallery */ ?>
		<?php 
		 $terms = get_terms('ml_gallery');
		 arsort($terms);
		 $count = count($terms);
		 if ( $count > 0 ){
		     foreach ( $terms as $term ) { ?>

				<article id="post-<?php the_ID(); ?>" <?php post_class('ml_one_fourth ml_with_padding ml_boxed'); ?>>
					
					<div class="ml_masonry_prevent">
					<?php /* generate the slider filtering by the current gallery */ ?>
					<div class="ml_nivo-slider">
						<?php 
						$args = array(
							'posts_per_page' => $latest_n_pictures,
							'tax_query' => array(
								array(
									'taxonomy' => 'ml_gallery',
									'field' => 'slug',
									'terms' => $term->slug
								)
							)
						);
						$loop = new WP_Query( $args );
						while ( $loop->have_posts() ) : $loop->the_post();
						//full image URL
						$featured_array = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'full' );
						$featured_image = $featured_array[0];
						//add the picture icon to the background of the featured image
						$featured_class = 'ml_icon_picture';
							//if have featured image, get it and add a content wrapper
							if ( (function_exists('has_post_thumbnail')) && (has_post_thumbnail()) ) { ?>
							<a href="<?php echo get_term_link($term->slug, 'ml_gallery'); ?>" class="ml_nivo-slider-link">
								<img src="<?php echo get_template_directory_uri() . '/includes/timthumb.php?src=' . $featured_image . '&h=161&w=161&zc=1&q=100'; ?>" alt="" width="161" height="161" /></a>
							</a>
							<?php }
						endwhile; ?>
					</div>
					</div>

					<?php /* call the nivo slider script, with custom options */ ?>
					<script type="text/javascript">
					jQuery(document).ready(function() {
					    jQuery('.ml_nivo-slider').nivoSlider({
				        effect:'<?php echo $slides_effect; ?>', // Specify sets like: 'fold,fade,sliceDown'
				        slices:<?php echo $slides_slices; ?>, // For slice animations
				        boxCols: <?php echo $slides_box_cols; ?>, // For box animations
				        boxRows: <?php echo $slides_box_rows; ?>, // For box animations
				        animSpeed: <?php echo $slides_anim_speed; ?>, // Slide transition speed
				        pauseTime: <?php echo $slides_pause_time; ?>, // How long each slide will show
				        startSlide:0, // Set starting Slide (0 index)
				        directionNav:false, // Next & Prev navigation
				        directionNavHide:true, // Only show on hover
				        controlNav:false, // 1,2,3... navigation
				        controlNavThumbs:false, // Use thumbnails for Control Nav
				        controlNavThumbsFromRel:false, // Use image rel for thumbs
				        controlNavThumbsSearch: '.jpg', // Replace this with...
				        controlNavThumbsReplace: '_thumb.jpg', // ...this in thumb Image src
				        keyboardNav:true, // Use left & right arrows
				        pauseOnHover:true, // Stop animation while hovering
				        manualAdvance:false, // Force manual transitions
				        captionOpacity:0, // Universal caption opacity
				        prevText: 'Prev', // Prev directionNav text
				        nextText: 'Next', // Next directionNav text
				        beforeChange: function(){}, // Triggers before a slide transition
				        afterChange: function(){}, // Triggers after a slide transition
				        slideshowEnd: function(){}, // Triggers after all slides have been shown
				        lastSlide: function(){}, // Triggers when last slide is shown
				        afterLoad: function(){} // Triggers when slider has loaded
					    });
					});
					</script>
					
					<a href="<?php echo get_term_link($term->slug, 'ml_gallery'); ?>" class="ml_post-title"><h2 class="post-title gallery-title"><?php echo $term->name; ?></h2></a>

					<p><?php echo ml_custom_excerpt($term->description,20); ?></p>

					<a href="<?php echo get_term_link($term->slug, 'ml_gallery'); ?>" class="button read-more"><?php _e('View', 'meydjer'); ?></a>
				</article>

	<?php  }
		 }
		?>

</div>
</section>
	
<?php wp_reset_query(); ?>