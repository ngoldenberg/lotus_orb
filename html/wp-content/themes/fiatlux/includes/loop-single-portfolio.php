<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
<?php 

//get the slides effect options
$latest_n_pictures = of_get_option('ml_latest_n_pictures', '5');
$slides_effect = of_get_option('ml_slides_effect', 'random');
$slides_slices = of_get_option('ml_slides_slices', '4');
$slides_box_cols = of_get_option('ml_slides_box_cols', '4');
$slides_box_rows = of_get_option('ml_slides_box_rows', '4');
$slides_anim_speed = of_get_option('ml_slides_anim_speed', '0.5') * 1000;
$slides_pause_time = of_get_option('ml_slides_pause_time', '2.5') * 1000;
?>
	<article id="post-<?php the_ID(); ?>" <?php post_class('ml_post_content ml_with_padding ml_boxed'); ?>>

		<?php
		global $post;
		
		//featured preview
		$featured_normal = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'featured');
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
			$featured_link = get_post_meta($post->ID, 'ml_fc_lightbox_youtube', true);
			?>

			<a href="<?php echo $featured_link; ?>" class="featured-image ml_icon_video" data-rel="prettyPhoto[portfolio]" title="<?php echo $featured_description; ?>">
				<img src="<?php echo get_template_directory_uri() . '/includes/timthumb.php?src=' . $featured_link . '&w=671&h=360&zc=1&q=80'; ?>" alt="<?php the_title(); ?>" />
			</a>
			
		<?php }

		
		//Lightbox - Vimeo
		elseif(get_post_meta($post->ID, 'ml_fc_featured_content', true) == 'lightbox_vimeo') {
			//Video URL
			$featured_content = get_post_meta($post->ID, 'ml_fc_lightbox_vimeo', true);
			//Content Poster
			$content_poster = get_post_meta($post->ID, 'ml_fc_embedded_video_poster', true);
			$content_poster = get_template_directory_uri() . '/includes/timthumb.php?src=' . $content_poster . '&w=671&h=360&zc=1&q=80';
			?>

			<a href="<?php echo $featured_content; ?>" class="featured-image ml_icon_video" data-rel="prettyPhoto[portfolio]" title="<?php echo $featured_description; ?>">
				<img src="<?php echo $content_poster; ?>" alt="<?php the_title(); ?>" width="671" height="360" /></a>
			</a>
			
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
			$content_poster = get_template_directory_uri() . '/includes/timthumb.php?src=' . $content_poster . '&w=671&h=360&zc=1&q=80';
			?>

			<a href="<?php echo $featured_content; ?>" class="featured-image ml_icon_video" data-rel="prettyPhoto[portfolio]" title="<?php echo $featured_description; ?>">
				<img src="<?php echo $content_poster; ?>" alt="" width="671" height="360" /></a>
			</a>
			
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
			$content_poster = get_template_directory_uri() . '/includes/timthumb.php?src=' . $content_poster . '&w=671&h=360&zc=1&q=80';
			?>

			<a href="<?php echo $featured_content; ?>" class="featured-image ml_icon_video" data-rel="prettyPhoto[portfolio]" title="<?php echo $featured_description; ?>">
				<img src="<?php echo $content_poster; ?>" alt="" width="671" height="360" /></a>
			</a>
			
		<?php }

		
		//Lightbox - HTML
		elseif(get_post_meta($post->ID, 'ml_fc_featured_content', true) == 'lightbox_html') {
			$featured_content = '#lightbox_html_'.$post->ID;
			//Content Poster
			$content_poster = get_post_meta($post->ID, 'ml_fc_embedded_video_poster', true);
			$content_poster = get_template_directory_uri() . '/includes/timthumb.php?src=' . $content_poster . '&w=671&h=360&zc=1&q=80';
			?>

			<a href="<?php echo $featured_content; ?>" class="featured-image ml_icon_html" data-rel="prettyPhoto[portfolio]" title="<?php echo $featured_description; ?>">
				<img src="<?php echo $content_poster; ?>" alt="" width="671" height="360" /></a>
			</a>
			
			<div id="<?php echo 'lightbox_html_'.$post->ID?>" class="hidden">
				<?php echo get_post_meta($post->ID, 'ml_fc_html_content', true); ?>
			</div>
			
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
					
		<?php }

		
		//Embedded - Video
		elseif(get_post_meta($post->ID, 'ml_fc_featured_content', true) == 'embedded_video') {
		$embedded_video_m4v = get_post_meta($post->ID, 'ml_fc_embedded_video_m4v', true);
		$embedded_video_ogv = get_post_meta($post->ID, 'ml_fc_embedded_video_ogv', true);
		$embedded_video_poster = get_post_meta($post->ID, 'ml_fc_embedded_video_poster', true);
		$embedded_video_height = 'style="height:'.get_post_meta($post->ID, 'ml_fc_featured_content_height', true).'px;"';
		?>

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
					
		<?php }

		
		//Embedded - HTML
		elseif(get_post_meta($post->ID, 'ml_fc_featured_content', true) == 'embedded_html') {
		$embedded_html = get_post_meta($post->ID, 'ml_fc_html_content', true);
			
			echo $embedded_html;
		
		}

		
		//Image Slider
		elseif(get_post_meta($post->ID, 'ml_fc_featured_content', true) == 'slider') {
		$slider_height = of_get_option('ml_slider_height', '377');
		?>
			
		<div class="ml_nivo-slider single" <?php echo 'style="height:'.$slider_height.'px;"'; ?>>
			<?php	for ($slide_num = 1; $slide_num <= 10; $slide_num++) { 
				$slide = get_post_meta($post->ID, 'ml_fc_image_slider_'.$slide_num, true);
				$title = get_post_meta($post->ID, 'ml_fc_image_slider_'.$slide_num.'_title', true);
				$caption = get_post_meta($post->ID, 'ml_fc_image_slider_'.$slide_num.'_caption', true);
					if($slide) {
						$slide_thumb = get_template_directory_uri() . '/includes/timthumb.php?src=' . $slide . '&h=46&w=46&zc=1&q=80';
						$slide = get_template_directory_uri() . '/includes/timthumb.php?src=' . $slide . '&h='.$slider_height.'&w=671&zc=1&q=80';
					?>
						<a href="<?php echo get_post_meta($post->ID, 'ml_fc_image_slider_'.$slide_num, true); ?>" data-rel="prettyPhoto[image_slider]" title="<?php echo $caption; ?>">
							<img src="<?php echo $slide; ?>" alt="<?php echo $title; ?>" rel="<?php echo $slide_thumb; ?>" />
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
	        controlNav:true, // 1,2,3... navigation
	        controlNavThumbs:true, // Use thumbnails for Control Nav
	        controlNavThumbsFromRel:true, // Use image rel for thumbs
	        controlNavThumbsSearch: '', // Replace this with...
	        controlNavThumbsReplace: '', // ...this in thumb Image src
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
		<?php } else {


		//if don't have a featured content, get tue full image URL
		$featured_array = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'full' );
		$featured_image = $featured_array[0];
		//add the picture icon to the background of the featured image
		$featured_class = 'ml_icon_picture';
			//if have featured image, get it and add a content wrapper
			if ( (function_exists('has_post_thumbnail')) && (has_post_thumbnail()) ) { ?>
			<a href="<?php echo $featured_image; ?>" class="featured-image ml_icon_picture" data-rel="prettyPhoto[portfolio]" title="<?php echo $featured_description; ?>">
				<img src="<?php echo get_template_directory_uri() . '/includes/timthumb.php?src=' . $featured_image . '&w=671&h=360&zc=1&q=80'; ?>" alt="" width="671" height="360" /></a>
			</a>
		<?php	} 
		}
		?>

		<h2 class="single-title"><?php the_title(); ?></h2>
		<?php the_content(); ?>

<?php endwhile; ?>

	<?php comments_template('', true); ?>
	</article>

  <div class="nav-next"><?php previous_post_link('%link','&lt; '.'%title') ?></div>
  <div class="nav-prev"><?php next_post_link('%link','%title'.' &gt;') ?></div>
	
<?php else: ?>
	

	<p><?php _e('Sorry, no posts matched your criteria.', 'meydjer') ?></p>

<?php endif; ?>

<?php wp_reset_query(); ?>