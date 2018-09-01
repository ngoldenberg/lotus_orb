<?php
/*-------------------------------------------------*/
/*	Convert HEX to RGB
/*	http://snipplr.com/view/4621/convert-hex-to-rgb--rgb-to-hex/
/*-------------------------------------------------*/
function HexToRGB($hex) {
	$hex = ereg_replace("#", "", $hex);
	$color = array();
	
	if(strlen($hex) == 3) {
		$color['r'] = hexdec(substr($hex, 0, 1) . $r);
		$color['g'] = hexdec(substr($hex, 1, 1) . $g);
		$color['b'] = hexdec(substr($hex, 2, 1) . $b);
	}
	else if(strlen($hex) == 6) {
		$color['r'] = hexdec(substr($hex, 0, 2));
		$color['g'] = hexdec(substr($hex, 2, 2));
		$color['b'] = hexdec(substr($hex, 4, 2));
	}
	
	return $color;
}


/*-------------------------------------------------*/
/*	Get Youtube ID
/*	http://snipplr.com/view.php?codeview&id=19232
/*-------------------------------------------------*/
/* 
 * Retrieve the video ID from a YouTube video URL
 * @param $ytURL The full YouTube URL from which the ID will be extracted
 * @return $ytvID The YouTube video ID string
 */
function getYTid($ytURL) {
	
	$ytvIDlen = 11;	// This is the length of YouTube's video IDs
	
	// The ID string starts after "v=", which is usually right after 
	// "youtube.com/watch?" in the URL
	$idStarts = strpos($ytURL, "?v=");
	
	// In case the "v=" is NOT right after the "?" (not likely, but I like to keep my 
	// bases covered), it will be after an "&":
	if($idStarts === FALSE)
		$idStarts = strpos($ytURL, "&v=");
	// If still FALSE, URL doesn't have a vid ID
	if($idStarts === FALSE)
		die(__('YouTube video ID not found. Please double-check your URL.', 'meydjer'));
	
	// Offset the start location to match the beginning of the ID string
	$idStarts +=3;
	
	// Get the ID string and return it
	$ytvID = substr($ytURL, $idStarts, $ytvIDlen);
	
	return $ytvID;
	
}


/*-------------------------------------------------*/
/*	add_rel_lightbox
/*-------------------------------------------------*/
/*
Plugin Name: add_rel_lightbox
Description: Add rel="lightbox[this_page]" to &lt;a&gt; wrapped image links in the content, and include captions for lightbox/slimbox
Version: 0.1
Author: Patrick Fenner (Def-Proc.co.uk)
Author URI: http://www.deferredprocrastination.co.uk/
License: Licensed under the MIT License - http://www.opensource.org/licenses/mit-license.php
*/

function add_rel_lightbox($content)
{

	/* Find internal links */

	//Check the page for link images direct to image (no trailing attributes)
	$string = '/<a href="(.*?).(jpg|jpeg|png|gif|bmp|ico)"><img(.*?)class="(.*?)wp-image-(.*?)" \/><\/a>/i';
	preg_match_all( $string, $content, $matches, PREG_SET_ORDER);

	//Check which attachment is referenced
	foreach ($matches as $val)
	{
		$slimbox_caption = '';

		$post = get_post($val[5]);
		$slimbox_caption = esc_attr( $post->post_content );

		//Replace the instance with the lightbox and title(caption) references. Won't fail if caption is empty.
		$string = '<a href="' . $val[1] . '.' . $val[2] . '"><img' . $val[3] . 'class="' . $val[4] . 'wp-image-' . $val[5] . '" /></a>';
		$replace = '<a href="' . $val[1] . '.' . $val[2] . '" data-rel="prettyPhoto" title="' . $slimbox_caption . '"><img' . $val[3] . 'class="' . $val[4] . 'wp-image-' . $val[5] . '" /></a>';
		$content = str_replace( $string, $replace, $content);
	}

	return $content;
}
/* Filter Hook */
add_filter('the_content', 'add_rel_lightbox', 2);
?>