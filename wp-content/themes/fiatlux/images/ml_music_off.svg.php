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
	<polyline fill="<?php echo of_get_option('ml_secondary_color','#000000'); ?>" points="32,30 0,30 0,0 32,0 	"/>
</g>
<path fill="<?php echo of_get_option('ml_primary_color','#FFFFFF'); ?>" d="M15.987,11.099h-0.6l-2.557,1.878c0,0-0.399,0.639-1.158,0.639h-1.438c0,0-1.238,0.081-1.238,1.278v1.319
	c0,0-0.16,1.278,1.278,1.278h1.278c0,0,0.879,0.159,1.318,0.639l2.518,1.879l0.639,0.08c0,0,0.68,0,0.68-0.641v-7.711
	C16.706,11.738,16.666,11.099,15.987,11.099z"/>
</svg>