<?php 
	//Make it a SVG file
	header("Content-type: image/svg+xml");
	if(file_exists('../../../../wp-load.php')) {
		include '../../../../wp-load.php';
	}
	else {
		include '../../../../../wp-load.php';
	}
?>
<svg version="1.0" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
	 width="32px" height="30px" viewBox="0 0 32 30" enable-background="new 0 0 32 30" xml:space="preserve">
<g>
	<rect fill="<?php echo of_get_option('ml_secondary_color','#000000'); ?>" width="32" height="30"/>
</g>
<g>
	<rect x="12.287" y="9.51" fill="<?php echo of_get_option('ml_primary_color','#FFFFFF'); ?>" width="3" height="10"/>
	<rect x="17.287" y="9.51" fill="<?php echo of_get_option('ml_primary_color','#FFFFFF'); ?>" width="3" height="10"/>
</g>
</svg>
