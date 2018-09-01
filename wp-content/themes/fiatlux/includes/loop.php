<?php

if ( have_posts() ) : while ( have_posts() ) : the_post();

//get the slides effect options
$latest_n_pictures = of_get_option('ml_latest_n_pictures', '5');
$slides_effect = of_get_option('ml_slides_effect', 'random');
$slides_slices = of_get_option('ml_slides_slices', '4');
$slides_box_cols = of_get_option('ml_slides_box_cols', '4');
$slides_box_rows = of_get_option('ml_slides_box_rows', '4');
$slides_anim_speed = of_get_option('ml_slides_anim_speed', '0.5') * 1000;
$slides_pause_time = of_get_option('ml_slides_pause_time', '2.5') * 1000;

global $post;

$featured_array = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'full' );
$featured_link = $featured_array[0];

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
	$featured_image = get_template_directory_uri() . '/includes/timthumb.php?src=' . $featured_link . '&w=671&h=377&zc=1&q=80';
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
?>
	<?php
    if ( has_post_format( 'aside' )) { ?>
		<article id="post-<?php the_ID(); ?>" <?php post_class('ml_post_content ml_with_padding ml_boxed aside'); ?>>
			<div class="ml_post_format">
				<div class="post-info">
					<span><?php _e('By', 'meydjer'); ?></span> <?php the_author_posts_link(); ?>,
					<span><?php _e('In', 'meydjer'); ?></span> <?php the_category(', ') ?> 
					<span><?php _e('With', 'meydjer'); ?></span> <?php comments_popup_link( __('no comments yet', 'meydjer'), __('1 comment', 'meydjer'), __('% comments', 'meydjer'), 'comments-link', '0'); ?>
				</div><br />
				<?php the_content(); ?>
			</div>
			<div class="post-tags"><?php _e('Tags:', 'meydjer'); ?> <?php the_tags('', ', ',''); ?></div>
		</article>
    <?php }


    elseif ( has_post_format( 'chat' )) {
		$chat = nl2br(get_post_meta($post->ID, 'ml_single_chat_text', true));
    ?>
		<article id="post-<?php the_ID(); ?>" <?php post_class('ml_post_content ml_with_padding ml_boxed chat'); ?>>
			<div class="ml_post_format">
				<div class="ml_chat_text"><?php echo $chat; ?></div>
				<div class="post-info">
					<span><?php _e('By', 'meydjer'); ?></span> <?php the_author_posts_link(); ?>,
					<span><?php _e('In', 'meydjer'); ?></span> <?php the_category(', ') ?> 
					<span><?php _e('With', 'meydjer'); ?></span> <?php comments_popup_link( __('no comments yet', 'meydjer'), __('1 comment', 'meydjer'), __('% comments', 'meydjer'), 'comments-link', '0'); ?>
				</div><br />
				<?php the_content(); ?>
			<div class="post-tags"><?php _e('Tags:', 'meydjer'); ?> <?php the_tags('', ', ',''); ?></div>
			</div>
		</article>
    <?php }
    
    
    elseif ( has_post_format( 'gallery' )) {
		$slider_height = of_get_option('ml_slider_height', '315');
		?>
		<article id="post-<?php the_ID(); ?>" <?php post_class('ml_post_content ml_with_padding ml_boxed gallery'); ?>>
			<div class="ml_post_format">
				<div class="ml_nivo-slider single" <?php echo 'style="height:'.$slider_height.'px;"'; ?>>
					<?php	for ($slide_num = 1; $slide_num <= 10; $slide_num++) { 
						$slide = get_post_meta($post->ID, 'ml_single_image_slider_'.$slide_num, true);
						$title = get_post_meta($post->ID, 'ml_single_image_slider_'.$slide_num.'_title', true);
						$caption = get_post_meta($post->ID, 'ml_single_image_slider_'.$slide_num.'_caption', true);
							if($slide) {
								$slide_thumb = get_template_directory_uri() . '/includes/timthumb.php?src=' . $slide . '&h=46&w=46&zc=1&q=80';
								$slide = get_template_directory_uri() . '/includes/timthumb.php?src=' . $slide . '&h='.$slider_height.'&w=671&zc=1&q=80';
							?>
								<a href="<?php echo get_post_meta($post->ID, 'ml_single_image_slider_'.$slide_num, true); ?>" data-rel="prettyPhoto[image_slider]" title="<?php echo $caption; ?>">
									<img src="<?php echo $slide; ?>" alt="<?php echo $title; ?>" rel="<?php echo $slide_thumb; ?>" />
								</a>
							<?php
							}
						} ?>
				</div>
				<div class="post-info">
					<span><?php _e('By', 'meydjer'); ?></span> <?php the_author_posts_link(); ?>,
					<span><?php _e('In', 'meydjer'); ?></span> <?php the_category(', ') ?> 
					<span><?php _e('With', 'meydjer'); ?></span> <?php comments_popup_link( __('no comments yet', 'meydjer'), __('1 comment', 'meydjer'), __('% comments', 'meydjer'), 'comments-link', '0'); ?>
				</div>
				<br />
				<?php the_excerpt(); ?>
				<div class="post-tags"><?php _e('Tags:', 'meydjer'); ?> <?php the_tags('', ', ',''); ?></div>
			</div>
		</article>
		<script type="text/javascript">
		//
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
    <?php }
    elseif ( has_post_format( 'image' )) { ?>
			<article id="post-<?php the_ID(); ?>" <?php post_class('ml_post_content ml_with_padding ml_boxed image'); ?>>
				<div class="ml_post_format">
					<?php
						//if have featured image, get it and add a content wrapper
						if ( (function_exists('has_post_thumbnail')) && (has_post_thumbnail()) ) { ?>
						<a href="<?php echo $featured_link; ?>" class="featured-image <?php echo $featured_class; ?>" data-rel="prettyPhoto[portfolio]" title="<?php echo $featured_description; ?>">
							<img src="<?php echo $featured_image; ?>" alt="<?php the_title(); ?>" width="671" height="377" />
						</a>
					<?php } ?>
					<div class="post-info">
						<span><?php _e('By', 'meydjer'); ?></span> <?php the_author_posts_link(); ?>,
						<span><?php _e('In', 'meydjer'); ?></span> <?php the_category(', ') ?> 
						<span><?php _e('With', 'meydjer'); ?></span> <?php comments_popup_link( __('no comments yet', 'meydjer'), __('1 comment', 'meydjer'), __('% comments', 'meydjer'), 'comments-link', '0'); ?>
					</div>
					<?php the_content(); ?>
					<div class="post-tags"><?php _e('Tags:', 'meydjer'); ?> <?php the_tags('', ', ',''); ?></div>
				</div>
			</article>
    <?php }


    elseif ( has_post_format( 'link' )) {
		$link = get_post_meta($post->ID, 'ml_single_link_url', true);
    ?>
			<article id="post-<?php the_ID(); ?>" <?php post_class('ml_post_content ml_with_padding ml_boxed link'); ?>>
				<div class="ml_post_format">
					<a href="<?php echo $link; ?>" class="ml_post-title" target="_blank"><h2 class="post-title"><?php the_title(); ?></h2></a>
					<div class="post-info">
						<span><?php _e('By', 'meydjer'); ?></span> <?php the_author_posts_link(); ?>,
						<span><?php _e('In', 'meydjer'); ?></span> <?php the_category(', ') ?> 
						<span><?php _e('With', 'meydjer'); ?></span> <?php comments_popup_link( __('no comments yet', 'meydjer'), __('1 comment', 'meydjer'), __('% comments', 'meydjer'), 'comments-link', '0'); ?>
					</div><br />
					<?php the_content(); ?>
					<div class="post-tags"><?php _e('Tags:', 'meydjer'); ?> <?php the_tags('', ', ',''); ?></div>
				</div>
			</article>
    <?php }


    elseif ( has_post_format( 'quote' )) {
		$quote = nl2br(get_post_meta($post->ID, 'ml_single_quote_text', true));
		$quote_author = get_post_meta($post->ID, 'ml_single_quote_author', true);
		if($quote_author) {
			$quote_class = ' class="with_author"';
		}
		else {
			$quote_class = '';
		}
    ?>
		<article id="post-<?php the_ID(); ?>" <?php post_class('ml_post_content ml_with_padding ml_boxed quote'); ?>>
			<div class="ml_post_format">
				<blockquote<?php echo $quote_class; ?>><?php echo $quote; ?></blockquote>
				<div class="ml_quote_author"><?php echo $quote_author; ?></div>
				<div class="post-info">
					<span><?php _e('By', 'meydjer'); ?></span> <?php the_author_posts_link(); ?>,
					<span><?php _e('In', 'meydjer'); ?></span> <?php the_category(', ') ?> 
					<span><?php _e('With', 'meydjer'); ?></span> <?php comments_popup_link( __('no comments yet', 'meydjer'), __('1 comment', 'meydjer'), __('% comments', 'meydjer'), 'comments-link', '0'); ?>
				</div><br />
				<?php the_content(); ?>
				<div class="post-tags"><?php _e('Tags:', 'meydjer'); ?> <?php the_tags('', ', ',''); ?></div>
			</div>
		</article>
    <?php }


    elseif ( has_post_format( 'status' )) { ?>
		<article id="post-<?php the_ID(); ?>" <?php post_class('ml_post_content ml_with_padding ml_boxed status'); ?>>
			<div class="ml_post_format">
				<?php the_content(); ?>
				<div class="post-info">
					<span><?php the_time('F j, Y'); ?> <?php _e('at', 'meydjer'); ?> <?php the_time('g:i a'); ?></span>
					<span><?php _e('By', 'meydjer'); ?></span> <?php the_author_posts_link(); ?>,
					<span><?php _e('In', 'meydjer'); ?></span> <?php the_category(', ') ?> 
					<span><?php _e('With', 'meydjer'); ?></span> <?php comments_popup_link( __('no comments yet', 'meydjer'), __('1 comment', 'meydjer'), __('% comments', 'meydjer'), 'comments-link', '0'); ?>
				</div>
			<div class="post-tags"><?php _e('Tags:', 'meydjer'); ?> <?php the_tags('', ', ',''); ?></div>
			</div>
		</article>
    <?php }


    elseif ( has_post_format( 'video' )) { ?>
		<article id="post-<?php the_ID(); ?>" <?php post_class('ml_post_content ml_with_padding ml_boxed video'); ?>>
			<div class="ml_post_format">
		    <?php if(get_post_meta($post->ID, 'ml_single_embedded_vide_html', true)) { ?>
		    <?php echo get_post_meta($post->ID, 'ml_single_embedded_vide_html', true); ?>
				<div class="post-info">
					<span><?php _e('By', 'meydjer'); ?></span> <?php the_author_posts_link(); ?>,
					<span><?php _e('In', 'meydjer'); ?></span> <?php the_category(', ') ?> 
					<span><?php _e('With', 'meydjer'); ?></span> <?php comments_popup_link( __('no comments yet', 'meydjer'), __('1 comment', 'meydjer'), __('% comments', 'meydjer'), 'comments-link', '0'); ?>
				</div>
				<?php the_content(); ?>
				<div class="post-tags"><?php _e('Tags:', 'meydjer'); ?> <?php the_tags('', ', ',''); ?></div>
			</div>
			</article>
	    <?php } else {
			$embedded_video_m4v = get_post_meta($post->ID, 'ml_single_embedded_video_m4v', true);
			$embedded_video_ogv = get_post_meta($post->ID, 'ml_single_embedded_video_ogv', true);
			$embedded_video_poster = get_post_meta($post->ID, 'ml_single_embedded_video_poster', true);
			$embedded_video_height = 'style="height:'.get_post_meta($post->ID, 'ml_single_embedded_video_height', true).'px;"';
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
			<div class="post-info">
				<span><?php _e('By', 'meydjer'); ?></span> <?php the_author_posts_link(); ?>,
				<span><?php _e('In', 'meydjer'); ?></span> <?php the_category(', ') ?> 
				<span><?php _e('With', 'meydjer'); ?></span> <?php comments_popup_link( __('no comments yet', 'meydjer'), __('1 comment', 'meydjer'), __('% comments', 'meydjer'), 'comments-link', '0'); ?>
			</div>
			<?php the_content(); ?>
		<div class="post-tags"><?php _e('Tags:', 'meydjer'); ?> <?php the_tags('', ', ',''); ?></div>
		</div>
	</article>
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
		<?php } ?>
	<?php }


    elseif ( has_post_format( 'audio' )) {
		$embedded_audio_mp3 = get_post_meta($post->ID, 'ml_single_embedded_audio_mp3', true);
		$embedded_audio_oga = get_post_meta($post->ID, 'ml_single_embedded_audio_oga', true);
		?>
		<article id="post-<?php the_ID(); ?>" <?php post_class('ml_post_content ml_with_padding ml_boxed audio'); ?>>
		<div class="ml_post_format">
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
			<div class="post-info">
				<span><?php _e('By', 'meydjer'); ?></span> <?php the_author_posts_link(); ?>,
				<span><?php _e('In', 'meydjer'); ?></span> <?php the_category(', ') ?> 
				<span><?php _e('With', 'meydjer'); ?></span> <?php comments_popup_link( __('no comments yet', 'meydjer'), __('1 comment', 'meydjer'), __('% comments', 'meydjer'), 'comments-link', '0'); ?>
			</div>
			<?php the_content(); ?>
			<div class="post-tags"><?php _e('Tags:', 'meydjer'); ?> <?php the_tags('', ', ',''); ?></div>
		</div>
		</article>
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
    else { ?>
		
	<article id="post-<?php the_ID(); ?>" <?php post_class('ml_post_content ml_with_padding ml_boxed'); ?>>
		<?php
			//if have featured image, get it and add a content wrapper
			if ( (function_exists('has_post_thumbnail')) && (has_post_thumbnail()) ) { ?>
			<a href="<?php echo $featured_link; ?>" class="featured-image <?php echo $featured_class; ?>" data-rel="prettyPhoto[portfolio]" title="<?php echo $featured_description; ?>">
				<img src="<?php echo $featured_image; ?>" alt="<?php the_title(); ?>" width="671" height="377" />
			</a>
		<?php } ?>
			<a href="<?php the_permalink(); ?>" class="ml_post-title"><h2 class="post-title"><?php the_title(); ?></h2></a>
			<div class="post-info">
				<span><?php _e('By', 'meydjer'); ?></span> <?php the_author_posts_link(); ?>,
				<span><?php _e('In', 'meydjer'); ?></span> <?php the_category(', ') ?> 
				<span><?php _e('With', 'meydjer'); ?></span> <?php comments_popup_link( __('no comments yet', 'meydjer'), __('1 comment', 'meydjer'), __('% comments', 'meydjer'), 'comments-link', '0'); ?>
			</div><br />
			<p><?php $excerpt = get_the_excerpt(); echo ml_custom_excerpt($excerpt,40); ?></p><br />
			<a href="<?php the_permalink(); ?>" class="button read-more"><?php _e('Read More', 'meydjer'); ?></a>
			<div class="post-tags"><?php _e('Tags:', 'meydjer'); ?> <?php the_tags('', ', ',''); ?></div>
		<?php } ?>
	</article>

<?php endwhile; ?>

  <div class="nav-next"><?php next_posts_link(__('&lt; Older Entries', 'meydjer')) ?></div>
  <div class="nav-prev"><?php previous_posts_link(__('Newer Entries &gt;', 'meydjer')) ?></div>
		
<?php else: ?>
	
	<article id="post-none" class="ml_post_content ml_with_padding ml_boxed" >
	<p><?php _e('Sorry, no posts matched your criteria.', 'meydjer') ?></p>
	</article>

<?php endif; ?>

<?php wp_reset_query(); ?>