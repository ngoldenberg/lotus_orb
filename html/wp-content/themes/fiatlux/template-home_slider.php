<?php
/*
Template Name: Home with slider
*/

get_header();

/*--- autoplay ---*/
if(of_get_option('ml_slider_autoplay')) {
	$ml_slider_autoplay = '1';
} else {
	$ml_slider_autoplay = '0';
}

/*--- random ---*/
if(of_get_option('ml_slider_random')) {
	$ml_slider_random = '1';
} else {
	$ml_slider_random = '0';
}

/*--- slide interval ---*/
$ml_slide_interval = of_get_option('ml_slide_interval','5.5') * 1000;

/*--- transition effect ---*/
$ml_transition = of_get_option('ml_transition','1');

/*--- transition speed ---*/
$ml_transition_speed = of_get_option('ml_transition_speed','1.5') * 1000;

/*--- new window ---*/
if(of_get_option('ml_new_window')) {
	$ml_new_window = '1';
} else {
	$ml_new_window = '0';
}

/*--- pause hover ---*/
if(of_get_option('ml_pause_hover')) {
	$ml_pause_hover = '1';
} else {
	$ml_pause_hover = '0';
}

/*--- keyboard navigation ---*/
if(of_get_option('ml_keyboard_nav')) {
	$ml_keyboard_nav = '1';
} else {
	$ml_keyboard_nav = '0';
}

/*--- image protect ---*/
if(of_get_option('ml_image_protect')) {
	$ml_image_protect = '1';
} else {
	$ml_image_protect = '0';
}

/*--- vertical/horizontal center ---*/
if(of_get_option('ml_vertical_center')) {
	$ml_vertical_center = '1';
} else {
	$ml_vertical_center = '0';
}
if(of_get_option('ml_horizontal_center')) {
	$ml_horizontal_center = '1';
} else {
	$ml_horizontal_center = '0';
}

/*--- fir portrait/landscape ---*/
if(of_get_option('ml_fit_portrait')) {
	$ml_fit_portrait = '1';
} else {
	$ml_fit_portrait = '0';
}
if(of_get_option('ml_fit_landscape')) {
	$ml_fit_landscape = '1';
} else {
	$ml_fit_landscape = '0';
}


$with_thumbnails = NULL;
if(of_get_option('ml_slide_thumbnails')) {
	$with_thumbnails = 'with_thumbnails';
}

$with_nav_items = NULL;
if((of_get_option('ml_nav_buttons')) ||
	 (of_get_option('ml_music_bg_mp3')) ||
	 (of_get_option('ml_music_bg_ogg')) ||
	 (of_get_option('ml_slide_captions'))) {
	$with_nav_items = 'with_nav_items';
}
$thumbnails_size = of_get_option('ml_slide_thumbnails_size','76')
?>

<script type="text/javascript">  
	jQuery(function(jQuery){
		jQuery.supersized({
		
			//Functionality
			slideshow            : 1,    //Slideshow on/off
			autoplay             : <?php echo $ml_slider_autoplay; ?>,    //Slideshow starts playing automatically
			start_slide          : 1,    //Start slide (0 is random)
			random               : <?php echo $ml_slider_random; ?>,    //Randomize slide order (Ignores start slide)
			slide_interval       : <?php echo $ml_slide_interval; ?>, //Length between transitions
			transition           : <?php echo $ml_transition; ?>,    //0-None, 1-Fade, 2-Slide Top, 3-Slide Right, 4-Slide Bottom, 5-Slide Left, 6-Carousel Right, 7-Carousel Left
			transition_speed     : <?php echo $ml_transition_speed; ?>,    //Speed of transition
			new_window           : <?php echo $ml_new_window; ?>,    //Image links open in new window/tab
			pause_hover          : <?php echo $ml_pause_hover; ?>,    //Pause slideshow on hover
			keyboard_nav         : <?php echo $ml_keyboard_nav; ?>,    //Keyboard navigation on/off
			performance          : 1,    //0-Normal, 1-Hybrid speed/quality, 2-Optimizes image quality, 3-Optimizes transition speed // (Only works for Firefox/IE, not Webkit)
			image_protect        : <?php echo $ml_image_protect; ?>,    //Disables image dragging and right click with Javascript
			image_path           : '<?php echo get_template_directory_uri(); ?>/images/', //Default image path
														 
			//Size & Position			 
			min_width            : 0,    //Min width allowed (in pixels)
			min_height           : 0,    //Min height allowed (in pixels)
			vertical_center      : <?php echo $ml_vertical_center; ?>,    //Vertically center background
			horizontal_center    : <?php echo $ml_horizontal_center; ?>,    //Horizontally center background
			fit_portrait         : <?php echo $ml_fit_portrait; ?>,    //Portrait images will not exceed browser height
			fit_landscape        : <?php echo $ml_fit_landscape; ?>,    //Landscape images will not exceed browser width
														 	     
			slides               : [     //Slideshow Images
			<?php /* Call Slide */
				$all_the_slides = NULL;
				
				for ($slide_num = 1; $slide_num <= 10; $slide_num++) {

					/* Call Slide Link for a Post */
					$slider_link = NULL;
					if (of_get_option('ml_slider_'.$slide_num.'_link') == '1') {
						$slider_link = of_get_option( 'ml_slider_'.$slide_num.'_post' );
						$slider_link = 'url		: \'' . get_post_permalink($slider_link) . '\',';
					}
					/* Call Slide Link for a Page */
					if (of_get_option('ml_slider_'.$slide_num.'_link') == '2') {
						$slider_link = of_get_option( 'ml_slider_'.$slide_num.'_pages' );
						$slider_link = 'url		: \'' . get_page_link($slider_link) . '\',';
					}
					/* Call Slide Link for a category */
					if (of_get_option('ml_slider_'.$slide_num.'_link') == '3') {
						$slider_link = of_get_option( 'ml_slider_'.$slide_num.'_categories' );
						$slider_link = 'url		: \'' . get_category_link($slider_link) . '\',';
					}
					/* Call Slide Custom Link */
					if (of_get_option('ml_slider_'.$slide_num.'_link') == '4') {
						$slider_link = 'url		: \'' . of_get_option( 'ml_slider_'.$slide_num.'_custom_link' ) . '\',';
					}
					?>
				
					<?php	/* Call Slide Image */
					if (of_get_option('ml_slider_'.$slide_num.'_img')) {
						$all_the_slides = $all_the_slides . 
						'{' .
						'image : \'' . of_get_option( 'ml_slider_'.$slide_num.'_img' ) . '\',' .
						'thumb : \'' . get_template_directory_uri() . '/includes/timthumb.php?src=' . of_get_option( 'ml_slider_'.$slide_num.'_img' ) . '&h='.$thumbnails_size.'&w='.$thumbnails_size.'&zc=1&q=100\',' .
						'title : \'' . esc_attr(of_get_option( 'ml_slider_'.$slide_num.'_caption' )) . '\',' .
						$slider_link .
						'}' .
						',';
					}
				} ?>
				<?php echo substr($all_the_slides, 0, -1); ?>
			]
										
		});
		
		//preload image button
		var cache = [];
	  jQuery.preLoadImages = function() {
	    var args_len = arguments.length;
	    for (var i = args_len; i--;) {
	      var cacheImage = document.createElement('img');
	      cacheImage.src = arguments[i];
	      cache.push(cacheImage);
	    }
	  }
		jQuery.preLoadImages("<?php echo get_template_directory_uri(); ?>/images/play_dull.svg.php, <?php echo get_template_directory_uri(); ?>/images/music_off.svg.php");
		
		
		
		<?php if(of_get_option('ml_nav_buttons') == '1') { ?>
		/*-------------------------------------------------*/
		/*	Navigation
		/*-------------------------------------------------*/
		//play/pause - if is ie8, load GIF instead of SVG
		if (($.browser.msie  && parseInt($.browser.version) < 9)) {
			jQuery('.ml_prev_pp').click(function(event){
				event.preventDefault();
				api.playToggle();
				if(jQuery(this).is('.ml_slider_paused')) {
					jQuery(this).html('<img src="<?php echo get_template_directory_uri(); ?>/images/pause_dull.gif" alt="Pause Slider" id="pauseplay" />').removeClass('ml_slider_paused');
				} else {
					jQuery(this).html('<img src="<?php echo get_template_directory_uri(); ?>/images/play_dull.gif" alt="Play Slider" id="pauseplay" />').addClass('ml_slider_paused');
				}
			});
		}
		else {
			jQuery('.ml_prev_pp').click(function(event){
				event.preventDefault();
				api.playToggle();
				if(jQuery(this).is('.ml_slider_paused')) {
					jQuery(this).html('<img src="<?php echo get_template_directory_uri(); ?>/images/pause_dull.svg.php" alt="Pause Slider" id="pauseplay" />').removeClass('ml_slider_paused');
				} else {
					jQuery(this).html('<img src="<?php echo get_template_directory_uri(); ?>/images/play_dull.svg.php" alt="Play Slider" id="pauseplay" />').addClass('ml_slider_paused');
				}
			});
	}
		
		//prev
		jQuery('.ml_slider_prev').click(function(event){
			event.preventDefault();
			api.prevSlide();
		});
		//next
		jQuery('.ml_slider_next').click(function(event){
			event.preventDefault();
			api.nextSlide();
		});
		<?php } ?>
  });
	
	
	<?php if(of_get_option('ml_music_bg_mp3') || of_get_option('ml_music_bg_ogg')) {
	if(of_get_option('ml_music_bg_autoplay')) {
		$music_bg_autoplay = '.jPlayer("play")';
	}
	else {
		$music_bg_autoplay = '';
	}
	?>
	/*-------------------------------------------------*/
	/*	Music Background
	/*-------------------------------------------------*/
  jQuery(document).ready(function(){
    jQuery("#jquery_jplayer_1").jPlayer({
      ready: function () {
        jQuery(this).jPlayer("setMedia", {
          mp3: "<?php echo of_get_option('ml_music_bg_mp3'); ?>",
          oga: "<?php echo of_get_option('ml_music_bg_ogg'); ?>"
        })<?php echo $music_bg_autoplay; ?>;
      },
      ended: function (event) {
      	jQuery(this).jPlayer("play");
      },
      swfPath: "<?php echo get_template_directory_uri(); ?>/includes",
      supplied: "mp3, oga"
    });
  });
	<?php } ?>	
</script>
<div class="ml_slider_nav_to bottom <?php echo $with_thumbnails . ' ' . $with_nav_items; ?>">
<div class="ml_nav_box">
	<div class="ml_wrapper ml_buttons">
	<?php if(of_get_option('ml_nav_buttons')) { ?>
		<menu id="ml_slider_nav">
			<li><a href="#" class="ml_slider_prev"><img src="<?php echo get_template_directory_uri(); ?>/images/back_dull.svg.php" alt="Previous Slide" id="prevslide" /></a></li>
			<li><a href="#" class="ml_prev_pp"><img src="<?php echo get_template_directory_uri(); ?>/images/pause_dull.svg.php" alt="Play/Pause Slide" id="pauseplay" /></a></li>
			<li><a href="#" class="ml_slider_next"><img src="<?php echo get_template_directory_uri(); ?>/images/forward_dull.svg.php" alt="Next Slide" id="nextslide" /></a></li>
		</menu>
	<?php } ?>

	<?php if(of_get_option('ml_slide_captions')) { ?>
	<div class="ml_wrapper ml_wrapper_caption">
		<div class="ml_slide_caption">
			<h3 id="slidecaption"><?php _e('Loading...', 'meydjer'); ?></h3>
		</div>
	</div>
	<?php } ?>

	<?php if(of_get_option('ml_slide_thumbnails')) { ?>
	<div class="ml_wrapper">
		<div class="ml_thumb_aligner">
			<div id="thumb-tray" class="load-item"></div>
		</div>
	</div>
	<?php } ?>
	
	<?php if(of_get_option('ml_music_bg_mp3') || of_get_option('ml_music_bg_ogg')) { ?>
	  <div id="jquery_jplayer_1" class="jp-jplayer"></div>
	  <div id="jp_interface_1" class="ml_music_ctrl">
	    <a href="#" class="jp-play" tabindex="1"><img src="<?php echo get_template_directory_uri(); ?>/images/ml_music_off.svg.php" alt="Turn On" /></a>
	    <a href="#" class="jp-pause" tabindex="1"><img src="<?php echo get_template_directory_uri(); ?>/images/ml_music_on.svg.php" alt="Turn Off" /></a>
	  </div>
	<?php } ?>
	</div>
</div>
</div>
<!-- IE<9 and Firefox<4 don't read SVG. Instead, use GIF files -->
<!--[if lt IE 9]>
<script type="text/javascript">
jQuery('.ml_slider_prev').html('<img src="<?php echo get_template_directory_uri(); ?>/images/back_dull.gif" alt="Previous Slide" id="prevslide" />');
jQuery('.ml_prev_pp').html('<img src="<?php echo get_template_directory_uri(); ?>/images/pause_dull.gif" alt="Previous Slide" id="prevslide" />');
jQuery('.ml_slider_next').html('<img src="<?php echo get_template_directory_uri(); ?>/images/forward_dull.gif" alt="Previous Slide" id="prevslide" />');
jQuery('.jp-play').html('<img src="<?php echo get_template_directory_uri(); ?>/images/ml_music_off.gif" alt="Turn On" />');
jQuery('.jp-pause').html('<img src="<?php echo get_template_directory_uri(); ?>/images/ml_music_on.gif" alt="Turn Off" />');
</script>
<![endif]-->
<script type="text/javascript">
if (jQuery.browser.mozilla && parseInt(jQuery.browser.version) < 2) {
	jQuery('.ml_slider_prev').html('<img src="<?php echo get_template_directory_uri(); ?>/images/back_dull.gif" alt="Previous Slide" id="prevslide" />');
	jQuery('.ml_prev_pp').html('<img src="<?php echo get_template_directory_uri(); ?>/images/pause_dull.gif" alt="Previous Slide" id="prevslide" />');
	jQuery('.ml_slider_next').html('<img src="<?php echo get_template_directory_uri(); ?>/images/forward_dull.gif" alt="Previous Slide" id="prevslide" />');
	jQuery('.jp-play').html('<img src="<?php echo get_template_directory_uri(); ?>/images/ml_music_off.gif" alt="Turn On" />');
	jQuery('.jp-pause').html('<img src="<?php echo get_template_directory_uri(); ?>/images/ml_music_on.gif" alt="Turn Off" />');
}
</script>
<?php wp_footer(); ?>
</body>
</html>