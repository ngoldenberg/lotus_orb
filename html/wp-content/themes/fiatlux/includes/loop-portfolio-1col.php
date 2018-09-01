<?php
/* filter portfolio custom post type and show unlimited items */
query_posts( 'post_type=ml_portfolio&posts_per_page=-1');

//get the slides effect options
$latest_n_pictures = of_get_option('ml_latest_n_pictures', '5');
$slides_effect = of_get_option('ml_slides_effect', 'random');
$slides_slices = of_get_option('ml_slides_slices', '4');
$slides_box_cols = of_get_option('ml_slides_box_cols', '4');
$slides_box_rows = of_get_option('ml_slides_box_rows', '4');
$slides_anim_speed = of_get_option('ml_slides_anim_speed', '0.5') * 1000;
$slides_pause_time = of_get_option('ml_slides_pause_time', '2.5') * 1000;
?>


<?php /* filter by skill */ ?>
<section id="portfolio-categories">
	<ul class="ul-portfolio-categories">

		<?php /* button to show all the items */ ?>
		<li class="selected"><a href="#" data-value="all"><?php _e('All', 'meydjer'); ?></a></li>

		<?php /* generate one button per skill */ ?>
		<?php 
		 $terms = get_terms('ml_skill');
		 $count = count($terms);
		 if ( $count > 0 ){
		     foreach ( $terms as $term ) {
		       echo "<li><a href=\"#\">" . $term->name . "</a></li>";
		     }
		 }
		?>

	</ul>
</section><!--END #portfolio-categories-->

<div class="clearfix"></div>

<section id="ml_portfolio" class="ml_with_columns ml_portfolio_masonry">

<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
<?php 
$terms = get_the_terms( $post->ID, 'ml_skill' ); // get an array of all the terms as objects.

$terms_slugs = array();
$portfolio_item = '';

foreach( $terms as $term ) {
    $portfolio_item = $portfolio_item . ' ' . 'skill_' . sanitize_title($term->name) . ' '; // save each sanitized name inside the array and add a 'skill_' prefix to prevent conclicts
}

$portfolio_item = $portfolio_item . 'portfolio-item';
?>
	<?php /* add the skills as classes for each portfolio item */ ?>
	<article id="post-<?php the_ID(); ?>" <?php post_class($portfolio_item . ' ml_one_full ml_with_padding ml_boxed ml_visible'); ?>>
		
		<?php
		global $post;
		
		//featured preview
		$featured_normal = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'full');
		$featured_normal = $featured_normal[0];
		
		//get the featured image description
		$featured_id = get_post_meta($post->ID, '_thumbnail_id', true);
		$featured_attachment = get_post($featured_id);
		$featured_description = $featured_attachment->post_excerpt == "" ? $featured_attachment->post_content : $featured_attachment->post_excerpt;
		//if don't have any description, make it blank
		if (!($featured_description)) {
			$featured_description = ' ';
		}


		//Lightbox - YouTube.
		if(get_post_meta($post->ID, 'ml_fc_featured_content', true) == 'lightbox_youtube') {
			//Video URL
			$featured_content = get_post_meta($post->ID, 'ml_fc_lightbox_youtube', true);
			?>

			<a href="<?php echo $featured_content; ?>" class="featured-image ml_icon_video" data-rel="prettyPhoto[portfolio]" title="<?php echo $featured_description; ?>">
				<img src="<?php echo get_template_directory_uri() . '/includes/timthumb.php?src=' . $featured_content . '&h=256&w=456&zc=1&q=100'; ?>" alt="" width="456" height="256" /></a>
			</a>
			
			<div class="ml_port1col_wrapper">

		<?php }

		
		//Lightbox - Vimeo
		elseif(get_post_meta($post->ID, 'ml_fc_featured_content', true) == 'lightbox_vimeo') {
			//Video URL
			$featured_content = get_post_meta($post->ID, 'ml_fc_lightbox_vimeo', true);
			//Content Poster
			$content_poster = get_post_meta($post->ID, 'ml_fc_embedded_video_poster', true);
			$content_poster = get_template_directory_uri() . '/includes/timthumb.php?src=' . $content_poster . '&w=456&h=256&zc=1&q=100';
			?>

			<a href="<?php echo $featured_content; ?>" class="featured-image ml_icon_video" data-rel="prettyPhoto[portfolio]" title="<?php echo $featured_description; ?>">
				<img src="<?php echo $content_poster; ?>" alt="" width="456" height="256" /></a>
			</a>
			
			<div class="ml_port1col_wrapper">

		<?php }

		
		//Lightbox - QuickTime
		elseif(get_post_meta($post->ID, 'ml_fc_featured_content', true) == 'lightbox_mov') {
			//Video URL
			$featured_content = get_post_meta($post->ID, 'ml_fc_lightbox_mov', true)
			. '?width='
			. get_post_meta($post->ID, 'ml_fc_featured_content_width', true)
			. '&height='
			. get_post_meta($post->ID, 'ml_fc_featured_content_height', true);
			//Content Poster
			$content_poster = get_post_meta($post->ID, 'ml_fc_embedded_video_poster', true);
			$content_poster = get_template_directory_uri() . '/includes/timthumb.php?src=' . $content_poster . '&w=456&h=256&zc=1&q=100';
			?>

			<a href="<?php echo $featured_content; ?>" class="featured-image ml_icon_video" data-rel="prettyPhoto[portfolio]" title="<?php echo $featured_description; ?>">
				<img src="<?php echo $content_poster; ?>" alt="" width="456" height="256" /></a>
			</a>
			
			<div class="ml_port1col_wrapper">

		<?php }

		
		//Lightbox - Flash
		elseif(get_post_meta($post->ID, 'ml_fc_featured_content', true) == 'lightbox_swf') {
			//Video URL
			$featured_content = get_post_meta($post->ID, 'ml_fc_lightbox_swf', true)
			. '?width='
			. get_post_meta($post->ID, 'ml_fc_featured_content_width', true)
			. '&height='
			. get_post_meta($post->ID, 'ml_fc_featured_content_height', true);
			//Content Poster
			$content_poster = get_post_meta($post->ID, 'ml_fc_embedded_video_poster', true);
			$content_poster = get_template_directory_uri() . '/includes/timthumb.php?src=' . $content_poster . '&w=456&h=256&zc=1&q=100';
			?>

			<a href="<?php echo $featured_content; ?>" class="featured-image ml_icon_video" data-rel="prettyPhoto[portfolio]" title="<?php echo $featured_description; ?>">
				<img src="<?php echo $content_poster; ?>" alt="" width="456" height="256" /></a>
			</a>
			
			<div class="ml_port1col_wrapper">

		<?php }

		
		//Lightbox - HTML
		elseif(get_post_meta($post->ID, 'ml_fc_featured_content', true) == 'lightbox_html') {
			$featured_content = '#lightbox_html_'.$post->ID;
			//Content Poster
			$content_poster = get_post_meta($post->ID, 'ml_fc_embedded_video_poster', true);
			$content_poster = get_template_directory_uri() . '/includes/timthumb.php?src=' . $content_poster . '&w=456&h=256&zc=1&q=100';
			?>

			<a href="<?php echo $featured_content; ?>" class="featured-image ml_icon_html" data-rel="prettyPhoto[portfolio]" title="<?php echo $featured_description; ?>">
				<img src="<?php echo $content_poster; ?>" alt="" width="456" height="256" /></a>
			</a>
			
			<div id="<?php echo 'lightbox_html_'.$post->ID?>" class="hidden">
				<?php echo get_post_meta($post->ID, 'ml_fc_html_content', true); ?>
			</div>
			
			<div class="ml_port1col_wrapper">

		<?php }

		
		//Embedded Audio
		elseif(get_post_meta($post->ID, 'ml_fc_featured_content', true) == 'embedded_audio') {
		$embedded_audio_mp3 = get_post_meta($post->ID, 'ml_fc_embedded_audio_mp3', true);
		$embedded_audio_oga = get_post_meta($post->ID, 'ml_fc_embedded_audio_oga', true);
		?>

			<div id="jquery_jplayer_<?php echo $post->ID; ?>" class="jp-jplayer"></div>
	
			<div class="jp-audio">
				<div class="jp-type-single">
					<div id="jp_interface_<?php echo $post->ID; ?>" class="jp-interface">
						<ul class="jp-controls play">
							<li><a href="#" class="jp-play" tabindex="<?php echo $post->ID; ?>"><img src="<?php echo get_template_directory_uri(); ?>/images/play_dull.svg.php" alt="Play" /></a></li>
							<li><a href="#" class="jp-pause" tabindex="<?php echo $post->ID; ?>"><img src="<?php echo get_template_directory_uri(); ?>/images/pause_dull.svg.php" alt="Pause" /></a></li>
						</ul>
						<div class="jp-progress">
							<div class="jp-seek-bar">
								<div class="jp-play-bar"></div>
							</div>
						</div>
						<div class="jp-volume-bar">
							<div class="jp-volume-bar-value"></div>
						</div>
						<ul class="jp-controls volume">
							<li><a href="#" class="jp-mute" tabindex="<?php echo $post->ID; ?>"><img src="<?php echo get_template_directory_uri(); ?>/images/ml_music_on.svg.php" alt="Mute" /></a></li>
							<li><a href="#" class="jp-unmute" tabindex="<?php echo $post->ID; ?>"><img src="<?php echo get_template_directory_uri(); ?>/images/ml_music_off.svg.php" alt="Unmute" /></a></li>
						</ul>
					</div>
				</div>
			</div>
			<script type="text/javascript">
		  jQuery(document).ready(function(){
		    jQuery("#jquery_jplayer_<?php echo $post->ID; ?>").jPlayer({
		      ready: function () {
		        jQuery(this).jPlayer("setMedia", {
		          mp3: "<?php echo $embedded_audio_mp3; ?>",
		          oga: "<?php echo $embedded_audio_oga; ?>"
		        });
		      },
		      swfPath: "<?php echo get_template_directory_uri(); ?>/includes",
		      cssSelectorAncestor: "#jp_interface_<?php echo $post->ID; ?>",
		      supplied: "mp3, oga"
		    });
		  });
			</script>
					
			<div class="ml_port1col_wrapper">

		<?php }

		
		//Embedded - Video
		elseif(get_post_meta($post->ID, 'ml_fc_featured_content', true) == 'embedded_video') {
		$embedded_video_m4v = get_post_meta($post->ID, 'ml_fc_embedded_video_m4v', true);
		$embedded_video_ogv = get_post_meta($post->ID, 'ml_fc_embedded_video_ogv', true);
		$embedded_video_poster = get_post_meta($post->ID, 'ml_fc_embedded_video_poster', true);
		$embedded_video_height = 'style="height:256px;"';
		?>
		<div class="jp-player-all">
			<div id="jquery_jplayer_<?php echo $post->ID; ?>" class="jp-jplayer jp-jplayer-video" <?php echo$embedded_video_height; ?>></div>
	
			<div class="jp-video">
				<div class="jp-type-single">
					<div id="jp_interface_<?php echo $post->ID; ?>" class="jp-interface">
						<div class="jp-video-play"></div>
						<ul class="jp-controls play">
							<li><a href="#" class="jp-play" tabindex="<?php echo $post->ID; ?>"><img src="<?php echo get_template_directory_uri(); ?>/images/play_dull.svg.php" alt="Play" /></a></li>
							<li><a href="#" class="jp-pause" tabindex="<?php echo $post->ID; ?>"><img src="<?php echo get_template_directory_uri(); ?>/images/pause_dull.svg.php" alt="Pause" /></a></li>
						</ul>
						<div class="jp-progress">
							<div class="jp-seek-bar">
								<div class="jp-play-bar"></div>
							</div>
						</div>
						<div class="jp-volume-bar">
							<div class="jp-volume-bar-value"></div>
						</div>
						<ul class="jp-controls volume">
							<li><a href="#" class="jp-mute" tabindex="<?php echo $post->ID; ?>"><img src="<?php echo get_template_directory_uri(); ?>/images/ml_music_on.svg.php" alt="Mute" /></a></li>
							<li><a href="#" class="jp-unmute" tabindex="<?php echo $post->ID; ?>"><img src="<?php echo get_template_directory_uri(); ?>/images/ml_music_off.svg.php" alt="Unmute" /></a></li>
						</ul>
					</div>
				</div>
			</div>
			<script type="text/javascript">
		  jQuery(document).ready(function(){
		    jQuery("#jquery_jplayer_<?php echo $post->ID; ?>").jPlayer({
		      ready: function () {
		        jQuery(this).jPlayer("setMedia", {
		          m4v: "<?php echo $embedded_video_m4v; ?>",
		          ogv: "<?php echo $embedded_video_ogv; ?>",
		          poster: "<?php echo $embedded_video_poster; ?>"
		        });
		      },
		      swfPath: "<?php echo get_template_directory_uri(); ?>/includes",
		      cssSelectorAncestor: "#jp_interface_<?php echo $post->ID; ?>",
		      supplied: "m4v, ogv"
		    });
		  });
			</script>
					
			</div>
			
			<div class="ml_port1col_wrapper">

		<?php }

		
		//Embedded - HTML
		elseif(get_post_meta($post->ID, 'ml_fc_featured_content', true) == 'embedded_html') {
		$embedded_html_poster = get_post_meta($post->ID, 'ml_fc_embedded_video_poster', true);
		$embedded_html_poster = get_template_directory_uri() . '/includes/timthumb.php?src=' . $embedded_html_poster . '&w=456&h=256&zc=1&q=100'
		?>

			<a href="<?php the_permalink(); ?>" class="featured-image ml_icon_html">
				<img src="<?php echo $embedded_html_poster; ?>" alt="HTML" width="456" height="256" />	
			</a>

			<div class="ml_port1col_wrapper">

		<?php 	}
		
	
		//Image Slider
		elseif(get_post_meta($post->ID, 'ml_fc_featured_content', true) == 'slider') { ?>
			
			<div class="ml_nivo-slider">
				<?php	for ($slide_num = 1; $slide_num <= 10; $slide_num++) { 
					$slide = get_post_meta($post->ID, 'ml_fc_image_slider_'.$slide_num, true);
						if($slide) {
							$slide = get_template_directory_uri() . '/includes/timthumb.php?src=' . $slide . '&h=456&w=456&zc=1&q=100';
						?>
							<a href="<?php the_permalink(); ?>">
								<img src="<?php echo $slide; ?>" alt="Slide <?php echo $slide_num; ?>" />
							</a>
						<?php
						}
					} ?>
			</div>
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

			<div class="ml_port1col_wrapper">

		<?php }


		//if don't have a featured content, get tue full image URL
		else {
			//full image URL
			$featured_array = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'full' );
			$featured_image = $featured_array[0];
			//add the picture icon to the background of the featured image
			$featured_class = 'ml_icon_picture';
				//if have featured image, get it and add a content wrapper
				if ( (function_exists('has_post_thumbnail')) && (has_post_thumbnail()) ) { ?>
				<a href="<?php echo $featured_image; ?>" class="featured-image ml_icon_picture" data-rel="prettyPhoto[portfolio]" title="<?php echo $featured_description; ?>">
					<img src="<?php echo get_template_directory_uri() . '/includes/timthumb.php?src=' . $featured_image . '&h=456&w=456&zc=1&q=100'; ?>" alt="" width="456" height="456" /></a>
				</a>
	
				<div class="ml_port1col_wrapper">

				<?php
				}
		} ?>
		
			<a href="<?php the_permalink(); ?>" class="ml_post-title"><h2 class="post-title portfolio-title"><?php the_title(); ?></h2></a>
			<p><?php $excerpt = get_the_excerpt(); echo ml_custom_excerpt($excerpt,30); ?></p>
			<a href="<?php the_permalink(); ?>" class="button read-more"><?php _e('Read More', 'meydjer'); ?></a>

	</div>

</article>

<?php endwhile; ?>

</section>

<!--[if lt IE 9]> <html class="no-js ie6" lang="en">
<script type="text/javascript">
jQuery('.jp-mute').html('<img src="<?php echo get_template_directory_uri(); ?>/images/ml_music_on.gif" alt="Previous Slide" id="prevslide" />');
jQuery('.jp-unmute').html('<img src="<?php echo get_template_directory_uri(); ?>/images/ml_music_off.gif" alt="Previous Slide" id="prevslide" />');
jQuery('.jp-play').html('<img src="<?php echo get_template_directory_uri(); ?>/images/play_dull.gif" alt="Turn On" />');
jQuery('.jp-pause').html('<img src="<?php echo get_template_directory_uri(); ?>/images/pause_dull.gif" alt="Turn Off" />');
</script>
<![endif]-->

<?php else: ?>
	
	<div class="divider"></div><div class="clearfix"></div><!--double line divider-->

	<p><?php _e('Sorry, no posts matched your criteria.', 'meydjer') ?></p>

	<div class="divider"></div><div class="clearfix"></div><!--double line divider-->

<?php endif; ?>

<?php wp_reset_query(); ?>