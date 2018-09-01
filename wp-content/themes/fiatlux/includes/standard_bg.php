<?php
if((of_get_option('ml_standard_bg') == 'fullscreen_bg') || (has_post_thumbnail())) {
	if(has_post_thumbnail() && (of_get_option('ml_featured_image_as_bg') == '1')){
		$featured_array = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'full' );
		$fullscreen_bg = $featured_array[0];
	} else {
		$fullscreen_bg = of_get_option('ml_fullscreen_bg');
	}
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
	?>
	<script type="text/javascript">
	jQuery(function($){
	$.supersized({
	
		//Functionality
		image_protect        : <?php echo $ml_image_protect; ?>,    //Disables image dragging and right click with Javascript

		//Size & Position			 
		min_width            : 0,    //Min width allowed (in pixels)
		min_height           : 0,    //Min height allowed (in pixels)
		vertical_center      : <?php echo $ml_vertical_center; ?>,    //Vertically center background
		horizontal_center    : <?php echo $ml_horizontal_center; ?>,    //Horizontally center background
		fit_portrait         : <?php echo $ml_fit_portrait; ?>,    //Portrait images will not exceed browser height
		fit_landscape        : <?php echo $ml_fit_landscape; ?>,    //Landscape images will not exceed browser width
													 	     
		slides               : [{image : '<?php echo $fullscreen_bg ?>'}]										
	});
	});
</script>
<div class="ml_pattern_for_fullscreen_bg"></div>
<?php }


else if((of_get_option('ml_standard_bg') == 'pattern_bg')) {
$pattern_bg = of_get_option('ml_pattern_bg');
?>
<style type="text/css">
/*-------------------------------------------------*/
/*	Standard Background
/*-------------------------------------------------*/
body {
	background: url(<?php echo $pattern_bg; ?>);
}
#supersized-loader {
	background: none;
}
</style>
<?php } ?>