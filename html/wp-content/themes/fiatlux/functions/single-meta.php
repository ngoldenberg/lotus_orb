<?php
//requires the meta-box script for custom meta fields
require_once ('meta-box.php');

/**
 * Registering meta boxes
 *
 * In this file, I'll show you how to extend the class to add more field type (in this case, the 'taxonomy' type)
 * All the definitions of meta boxes are listed below with comments, please read them carefully.
 * Note that each validation method of the Validation Class MUST return value instead of boolean as before
 *
 * You also should read the changelog to know what has been changed
 *
 * For more information, please visit: http://www.deluxeblogtips.com/2010/04/how-to-create-meta-box-wordpress-post.html
 *
 */

/********************* BEGIN EXTENDING CLASS ***********************/

/**
 * Extend ml_Meta_Box class
 * Add field type: 'taxonomy'
 */
class ml_Meta_Box_Single extends ml_Meta_Box {
	
	function add_missed_values() {
		parent::add_missed_values();
		
		// add 'multiple' option to taxonomy field with checkbox_list type
		foreach ($this->_meta_box['fields'] as $key => $field) {
			if ('taxonomy' == $field['type'] && 'checkbox_list' == $field['options']['type']) {
				$this->_meta_box['fields'][$key]['multiple'] = true;
			}
		}
	}
	
	// show taxonomy list
	function show_field_taxonomy($field, $meta) {
		global $post;
		
		if (!is_array($meta)) $meta = (array) $meta;
		
		$this->show_field_begin($field, $meta);
		
		$options = $field['options'];
		$terms = get_terms($options['taxonomy'], $options['args']);
		
		// checkbox_list
		if ('checkbox_list' == $options['type']) {
			foreach ($terms as $term) {
				echo "<input type='checkbox' name='{$field['id']}[]' value='$term->slug'" . checked(in_array($term->slug, $meta), true, false) . " /> $term->name<br/>";
			}
		}
		// select
		else {
			echo "<select name='{$field['id']}" . ($field['multiple'] ? "[]' multiple='multiple' style='height:auto'" : "'") . ">";
		
			foreach ($terms as $term) {
				echo "<option value='$term->slug'" . selected(in_array($term->slug, $meta), true, false) . ">$term->name</option>";
			}
			echo "</select>";
		}
		
		$this->show_field_end($field, $meta);
	}
}

/********************* END EXTENDING CLASS ***********************/

/********************* BEGIN DEFINITION OF META BOXES ***********************/

// prefix of meta keys, optional
// use underscore (_) at the beginning to make keys hidden, for example $prefix = '_ml_';
// you also can make prefix empty to disable it
$prefix = 'ml_single_';

$meta_boxes = array();

// first meta box
$meta_boxes[] = array(
	'id' => $prefix . 'image_gallery',							// meta box id, unique per meta box
	'title' => __('Image Gallery', 'meydjer'),			// meta box title
	'pages' => array('post'),	// post types, accept custom post types as well, default is array('post'); optional
	'context' => 'normal',						// where the meta box appear: normal (default), advanced, side; optional
	'priority' => 'high',						// order of meta box: high (default), low; optional

	'fields' => array(							// list of meta fields
		array(
			'name' => __('Image #1', 'meydjer'),					// field name
			'id' => $prefix . 'image_slider_1',				// field id, i.e. the meta key
			'type' => 'upload',						// text box
			'std' => '',					// default value, optional
			'style' => ''				// custom style for field, added in v3.1
		),
		array(
			'name' => __('Image #1 Title', 'meydjer'),					// field name
			'id' => $prefix . 'image_slider_1_title',				// field id, i.e. the meta key
			'type' => 'text',						// text box
			'std' => ''					// default value, optional
		),
		array(
			'name' => __('Image #1 Caption', 'meydjer'),					// field name
			'id' => $prefix . 'image_slider_1_caption',				// field id, i.e. the meta key
			'type' => 'text',						// text box
			'std' => ''					// default value, optional
		),
		array(
			'name' => __('Image #2', 'meydjer'),					// field name
			'id' => $prefix . 'image_slider_2',				// field id, i.e. the meta key
			'type' => 'upload',						// text box
			'std' => '',					// default value, optional
			'style' => ''				// custom style for field, added in v3.1
		),
		array(
			'name' => __('Image #2 Title', 'meydjer'),					// field name
			'id' => $prefix . 'image_slider_2_title',				// field id, i.e. the meta key
			'type' => 'text',						// text box
			'std' => ''					// default value, optional
		),
		array(
			'name' => __('Image #2 Caption', 'meydjer'),					// field name
			'id' => $prefix . 'image_slider_2_caption',				// field id, i.e. the meta key
			'type' => 'text',						// text box
			'std' => ''					// default value, optional
		),
		array(
			'name' => __('Image #3', 'meydjer'),					// field name
			'id' => $prefix . 'image_slider_3',				// field id, i.e. the meta key
			'type' => 'upload',						// text box
			'std' => '',					// default value, optional
			'style' => ''				// custom style for field, added in v3.1
		),
		array(
			'name' => __('Image #3 Title', 'meydjer'),					// field name
			'id' => $prefix . 'image_slider_3_title',				// field id, i.e. the meta key
			'type' => 'text',						// text box
			'std' => ''					// default value, optional
		),
		array(
			'name' => __('Image #3 Caption', 'meydjer'),					// field name
			'id' => $prefix . 'image_slider_3_caption',				// field id, i.e. the meta key
			'type' => 'text',						// text box
			'std' => ''					// default value, optional
		),
		array(
			'name' => __('Image #4', 'meydjer'),					// field name
			'id' => $prefix . 'image_slider_4',				// field id, i.e. the meta key
			'type' => 'upload',						// text box
			'std' => '',					// default value, optional
			'style' => ''				// custom style for field, added in v3.1
		),
		array(
			'name' => __('Image #4 Title', 'meydjer'),					// field name
			'id' => $prefix . 'image_slider_4_title',				// field id, i.e. the meta key
			'type' => 'text',						// text box
			'std' => ''					// default value, optional
		),
		array(
			'name' => __('Image #4 Caption', 'meydjer'),					// field name
			'id' => $prefix . 'image_slider_4_caption',				// field id, i.e. the meta key
			'type' => 'text',						// text box
			'std' => ''					// default value, optional
		),
		array(
			'name' => __('Image #5', 'meydjer'),					// field name
			'id' => $prefix . 'image_slider_5',				// field id, i.e. the meta key
			'type' => 'upload',						// text box
			'std' => '',					// default value, optional
			'style' => ''				// custom style for field, added in v3.1
		),
		array(
			'name' => __('Image #5 Title', 'meydjer'),					// field name
			'id' => $prefix . 'image_slider_5_title',				// field id, i.e. the meta key
			'type' => 'text',						// text box
			'std' => ''					// default value, optional
		),
		array(
			'name' => __('Image #5 Caption', 'meydjer'),					// field name
			'id' => $prefix . 'image_slider_5_caption',				// field id, i.e. the meta key
			'type' => 'text',						// text box
			'std' => ''					// default value, optional
		),
		array(
			'name' => __('Image #6', 'meydjer'),					// field name
			'id' => $prefix . 'image_slider_6',				// field id, i.e. the meta key
			'type' => 'upload',						// text box
			'std' => '',					// default value, optional
			'style' => ''				// custom style for field, added in v3.1
		),
		array(
			'name' => __('Image #6 Title', 'meydjer'),					// field name
			'id' => $prefix . 'image_slider_6_title',				// field id, i.e. the meta key
			'type' => 'text',						// text box
			'std' => ''					// default value, optional
		),
		array(
			'name' => __('Image #6 Caption', 'meydjer'),					// field name
			'id' => $prefix . 'image_slider_6_caption',				// field id, i.e. the meta key
			'type' => 'text',						// text box
			'std' => ''					// default value, optional
		),
		array(
			'name' => __('Image #7', 'meydjer'),					// field name
			'id' => $prefix . 'image_slider_7',				// field id, i.e. the meta key
			'type' => 'upload',						// text box
			'std' => '',					// default value, optional
			'style' => ''				// custom style for field, added in v3.1
		),
		array(
			'name' => __('Image #7 Title', 'meydjer'),					// field name
			'id' => $prefix . 'image_slider_7_title',				// field id, i.e. the meta key
			'type' => 'text',						// text box
			'std' => ''					// default value, optional
		),
		array(
			'name' => __('Image #7 Caption', 'meydjer'),					// field name
			'id' => $prefix . 'image_slider_7_caption',				// field id, i.e. the meta key
			'type' => 'text',						// text box
			'std' => ''					// default value, optional
		),
		array(
			'name' => __('Image #8', 'meydjer'),					// field name
			'id' => $prefix . 'image_slider_8',				// field id, i.e. the meta key
			'type' => 'upload',						// text box
			'std' => '',					// default value, optional
			'style' => ''				// custom style for field, added in v3.1
		),
		array(
			'name' => __('Image #8 Title', 'meydjer'),					// field name
			'id' => $prefix . 'image_slider_8_title',				// field id, i.e. the meta key
			'type' => 'text',						// text box
			'std' => ''					// default value, optional
		),
		array(
			'name' => __('Image #8 Caption', 'meydjer'),					// field name
			'id' => $prefix . 'image_slider_8_caption',				// field id, i.e. the meta key
			'type' => 'text',						// text box
			'std' => ''					// default value, optional
		),
		array(
			'name' => __('Image #9', 'meydjer'),					// field name
			'id' => $prefix . 'image_slider_9',				// field id, i.e. the meta key
			'type' => 'upload',						// text box
			'std' => '',					// default value, optional
			'style' => ''				// custom style for field, added in v3.1
		),
		array(
			'name' => __('Image #9 Title', 'meydjer'),					// field name
			'id' => $prefix . 'image_slider_9_title',				// field id, i.e. the meta key
			'type' => 'text',						// text box
			'std' => ''					// default value, optional
		),
		array(
			'name' => __('Image #9 Caption', 'meydjer'),					// field name
			'id' => $prefix . 'image_slider_9_caption',				// field id, i.e. the meta key
			'type' => 'text',						// text box
			'std' => ''					// default value, optional
		),
		array(
			'name' => __('Image #10', 'meydjer'),					// field name
			'id' => $prefix . 'image_slider_10',				// field id, i.e. the meta key
			'type' => 'upload',						// text box
			'std' => '',					// default value, optional
			'style' => ''				// custom style for field, added in v3.1
		),
		array(
			'name' => __('Image #10 Title', 'meydjer'),					// field name
			'id' => $prefix . 'image_slider_10_title',				// field id, i.e. the meta key
			'type' => 'text',						// text box
			'std' => ''					// default value, optional
		),
		array(
			'name' => __('Image #10 Caption', 'meydjer'),					// field name
			'id' => $prefix . 'image_slider_10_caption',				// field id, i.e. the meta key
			'type' => 'text',						// text box
			'std' => ''					// default value, optional
		)
	)
);

$meta_boxes[] = array(
	'id' => $prefix . 'link',							// meta box id, unique per meta box
	'title' => __('Link', 'meydjer'),			// meta box title
	'pages' => array('post'),	// post types, accept custom post types as well, default is array('post'); optional
	'context' => 'normal',						// where the meta box appear: normal (default), advanced, side; optional
	'priority' => 'high',						// order of meta box: high (default), low; optional

	'fields' => array(							// list of meta fields
		array(
			'name' => __('URL', 'meydjer'),					// field name
			'id' => $prefix . 'link_url',				// field id, i.e. the meta key
			'desc' => __('Put your FULL link URL (e.g. http://google.com/)', 'meydjer'),						// text box
			'type' => 'text',						// text box
			'std' => '',					// default value, optional
			'style' => ''				// custom style for field, added in v3.1
		)
	)
);

$meta_boxes[] = array(
	'id' => $prefix . 'quote',							// meta box id, unique per meta box
	'title' => __('Quote', 'meydjer'),			// meta box title
	'pages' => array('post'),	// post types, accept custom post types as well, default is array('post'); optional
	'context' => 'normal',						// where the meta box appear: normal (default), advanced, side; optional
	'priority' => 'high',						// order of meta box: high (default), low; optional

	'fields' => array(							// list of meta fields
		array(
			'name' => __('Quote', 'meydjer'),					// field name
			'id' => $prefix . 'quote_text',				// field id, i.e. the meta key
			'desc' => __('Put your quote here.', 'meydjer'),						// text box
			'type' => 'textarea',						// text box
			'std' => '',					// default value, optional
			'style' => ''				// custom style for field, added in v3.1
		),
		array(
			'name' => __('Quote Author', 'meydjer'),					// field name
			'id' => $prefix . 'quote_author',				// field id, i.e. the meta key
			'desc' => __('The quote author name. You can leave it blank if you want.', 'meydjer'),						// text box
			'type' => 'text',						// text box
			'std' => '',					// default value, optional
			'style' => ''				// custom style for field, added in v3.1
		)
	)
);

$meta_boxes[] = array(
	'id' => $prefix . 'chat',							// meta box id, unique per meta box
	'title' => __('Chat', 'meydjer'),			// meta box title
	'pages' => array('post'),	// post types, accept custom post types as well, default is array('post'); optional
	'context' => 'normal',						// where the meta box appear: normal (default), advanced, side; optional
	'priority' => 'high',						// order of meta box: high (default), low; optional

	'fields' => array(							// list of meta fields
		array(
			'name' => __('Chat', 'meydjer'),					// field name
			'id' => $prefix . 'chat_text',				// field id, i.e. the meta key
			'desc' => __('Put your chat text here.', 'meydjer'),						// text box
			'type' => 'textarea',						// text box
			'std' => '',					// default value, optional
			'style' => ''				// custom style for field, added in v3.1
		)
	)
);

$meta_boxes[] = array(
	'id' => $prefix . 'video',							// meta box id, unique per meta box
	'title' => __('Video', 'meydjer'),			// meta box title
	'pages' => array('post'),	// post types, accept custom post types as well, default is array('post'); optional
	'context' => 'normal',						// where the meta box appear: normal (default), advanced, side; optional
	'priority' => 'high',						// order of meta box: high (default), low; optional

	'fields' => array(							// list of meta fields
		array(
			'name' => __('M4V', 'meydjer'),					// field name
			'desc' => __('Don\'t forget to upload a .OGV file too, so your video will work in all main browsers.', 'meydjer'),	// field description, optional
			'id' => $prefix . 'embedded_video_m4v',				// field id, i.e. the meta key
			'type' => 'upload',						// text box
			'std' => '',					// default value, optional
			'style' => ''				// custom style for field, added in v3.1
		),
		array(
			'name' => __('OGV', 'meydjer'),					// field name
			'desc' => __('Don\'t forget to upload a .M4V file too, so your video will work in all main browsers.', 'meydjer'),	// field description, optional
			'id' => $prefix . 'embedded_video_ogv',				// field id, i.e. the meta key
			'type' => 'upload',						// text box
			'std' => '',					// default value, optional
			'style' => ''				// custom style for field, added in v3.1
		),
		array(
			'name' => __('Poster', 'meydjer'),					// field name
			'desc' => __('Upload a poster for your video/html.', 'meydjer'),	// field description, optional
			'id' => $prefix . 'embedded_video_poster',				// field id, i.e. the meta key
			'type' => 'upload',						// text box
			'std' => '',					// default value, optional
			'style' => ''				// custom style for field, added in v3.1
		),
		array(
			'name' => __('Height', 'meydjer'),					// field name
			'desc' => __('The video height.', 'meydjer'),	// field description, optional
			'id' => $prefix . 'embedded_video_height',				// field id, i.e. the meta key
			'type' => 'text',						// text box
			'std' => '',					// default value, optional
			'style' => 'width:50px;'				// custom style for field, added in v3.1
		),
		array(
			'name' => __('Embedded Video', 'meydjer'),					// field name
			'desc' => __('Put here your embedded video HTML code. If you fill this textarea the fields above will be overwritten.', 'meydjer'),	// field description, optional
			'id' => $prefix . 'embedded_vide_html',				// field id, i.e. the meta key
			'type' => 'textarea',						// text box
			'std' => '',					// default value, optional
			'style' => ''				// custom style for field, added in v3.1
		),
	)
);

$meta_boxes[] = array(
	'id' => $prefix . 'audio',							// meta box id, unique per meta box
	'title' => __('Audio', 'meydjer'),			// meta box title
	'pages' => array('post'),	// post types, accept custom post types as well, default is array('post'); optional
	'context' => 'normal',						// where the meta box appear: normal (default), advanced, side; optional
	'priority' => 'high',						// order of meta box: high (default), low; optional

	'fields' => array(							// list of meta fields
		array(
			'name' => __('MP3', 'meydjer'),					// field name
			'desc' => __('Don\'t forget to upload a .OGG/.OGA file too, so your audio will work in all main browsers.', 'meydjer'),	// field description, optional
			'id' => $prefix . 'embedded_audio_mp3',				// field id, i.e. the meta key
			'type' => 'upload',						// text box
			'std' => '',					// default value, optional
			'style' => ''				// custom style for field, added in v3.1
		),
		array(
			'name' => __('OGG/OGA', 'meydjer'),					// field name
			'desc' => __('Need a tool to convert your MP3 to OGG? Take a look at <a href=\"http://media.io/\" target=\"_blank\">media.io</a>.', 'meydjer'),	// field description, optional
			'id' => $prefix . 'embedded_audio_oga',				// field id, i.e. the meta key
			'type' => 'upload',						// text box
			'std' => '',					// default value, optional
			'style' => ''				// custom style for field, added in v3.1
		)
	)
);

foreach ($meta_boxes as $meta_box) {
	new ml_Meta_Box_Taxonomy($meta_box);
}

/********************* END DEFINITION OF META BOXES ***********************/

/********************* BEGIN VALIDATION ***********************/

/**
 * Validation class
 * Define ALL validation methods inside this class
 * Use the names of these methods in the definition of meta boxes (key 'validate_func' of each field)
 */
class ml_Meta_Box_Validate_Single {
	function check_name($text) {
		if ($text == 'Anh Tran') {
			return 'He is Rilwis';
		}
		return $text;
	}
}

/********************* END VALIDATION ***********************/
?>