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
<path fill="<?php echo of_get_option('ml_primary_color','#FFFFFF'); ?>" d="M21.378,9.524l-0.819,1.18c1.219,1.224,1.973,2.912,1.973,4.777c0,1.902-0.785,3.621-2.047,4.849
	l0.812,1.193c1.524-1.56,2.465-3.689,2.465-6.044C23.761,13.171,22.854,11.073,21.378,9.524z M15.987,11.099h-0.6l-2.557,1.878
	c0,0-0.399,0.639-1.158,0.639h-1.438c0,0-1.238,0.081-1.238,1.278v1.319c0,0-0.16,1.278,1.278,1.278h1.278
	c0,0,0.879,0.159,1.318,0.639l2.518,1.879l0.639,0.08c0,0,0.68,0,0.68-0.641v-7.711C16.706,11.738,16.666,11.099,15.987,11.099z
	 M19.031,12.25l-0.725,1.004c0.625,0.537,1.022,1.333,1.022,2.224c0,0.981-0.56,2.069-1.3,2.6l0.867,0.68
	c0.968-0.865,1.68-2.273,1.68-3.279C20.577,14.359,20.172,13.391,19.031,12.25z"/>
</svg>
