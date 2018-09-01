<?php

/*--- Custom Taxonomy - Skill (For Portfolio) ---*/
add_action( 'init', 'register_taxonomy_ml_skill' );

function register_taxonomy_ml_skill() {

    $labels = array( 
        'name' => __( 'Skills', 'meydjer'),
        'singular_name' => __( 'Skill', 'meydjer'),
        'search_items' => __( 'Search Skills', 'meydjer'),
        'popular_items' => __( 'Popular Skills', 'meydjer'),
        'all_items' => __( 'All Skills', 'meydjer'),
        'parent_item' => __( 'Parent Skill', 'meydjer'),
        'parent_item_colon' => __( 'Parent Skill:', 'meydjer'),
        'edit_item' => __( 'Edit Skill', 'meydjer'),
        'update_item' => __( 'Update Skill', 'meydjer'),
        'add_new_item' => __( 'Add New Skill', 'meydjer'),
        'new_item_name' => __( 'New Skill Name', 'meydjer'),
        'separate_items_with_commas' => __( 'Separate skills with commas', 'meydjer'),
        'add_or_remove_items' => __( 'Add or remove skills', 'meydjer'),
        'choose_from_most_used' => __( 'Choose from the most used skills', 'meydjer'),
        'menu_name' => __( 'Skills', 'meydjer'),
    );

    $args = array( 
        'labels' => $labels,
        'public' => true,
        'show_in_nav_menus' => true,
        'show_ui' => true,
        'show_tagcloud' => true,
        'hierarchical' => true,

        'rewrite' => true,
        'query_var' => true
    );

    register_taxonomy( 'ml_skill', array('ml_portfolio'), $args );
}

/*--- Custom Post Type - Portfolio ---*/
add_action( 'init', 'register_cpt_ml_portfolio' );

function register_cpt_ml_portfolio() {

    $labels = array( 
        'name' => __( 'Portfolio Items', 'meydjer'),
        'singular_name' => __( 'Portfolio Item', 'meydjer'),
        'add_new' => __( 'Add New', 'meydjer'),
        'add_new_item' => __( 'Add New Portfolio Item', 'meydjer'),
        'edit_item' => __( 'Edit Portfolio Item', 'meydjer'),
        'new_item' => __( 'New Portfolio Item', 'meydjer'),
        'view_item' => __( 'View Portfolio Item', 'meydjer'),
        'search_items' => __( 'Search Portfolio Items', 'meydjer'),
        'not_found' => __( 'No portfolio items found', 'meydjer'),
        'not_found_in_trash' => __( 'No portfolio items found in Trash', 'meydjer'),
        'parent_item_colon' => __( 'Parent Portfolio Item:', 'meydjer'),
        'menu_name' => __( 'Portfolio Items', 'meydjer'),
    );

    $args = array( 
        'labels' => $labels,
        'hierarchical' => false,
        
        'supports' => array( 'title', 'editor', 'thumbnail', 'comments' ),
        'taxonomies' => array( 'ml_skill' ),
        'public' => true,
        'show_ui' => true,
        'show_in_menu' => true,
        
        
        'show_in_nav_menus' => true,
        'publicly_queryable' => true,
        'exclude_from_search' => true,
        'has_archive' => false,
        'query_var' => true,
        'can_export' => true,
        'rewrite' => array( 
            'slug' => 'portfolio', 
            'with_front' => true,
            'feeds' => true,
            'pages' => true
        ),
        'capability_type' => 'post'
    );

    register_post_type( 'ml_portfolio', $args );
}


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
class ml_Meta_Box_Taxonomy extends ml_Meta_Box {
	
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
$prefix = 'ml_fc_';

$meta_boxes = array();

// first meta box
$meta_boxes[] = array(
	'id' => 'personal',							// meta box id, unique per meta box
	'title' => __('Featured Content', 'meydjer'),			// meta box title
	'pages' => array('ml_portfolio'),	// post types, accept custom post types as well, default is array('post'); optional
	'context' => 'normal',						// where the meta box appear: normal (default), advanced, side; optional
	'priority' => 'high',						// order of meta box: high (default), low; optional

	'fields' => array(							// list of meta fields
		array(
			'name' => __('Featured Content', 'meydjer'),
			'id' => $prefix . 'featured_content',
			'type' => 'select',						// select box
			'options' => array(						// array of key => value pairs for select box
				'lightbox_image' => __('Lightbox - Featured Image', 'meydjer'),
				'lightbox_youtube' => __('Lightbox - YouTube', 'meydjer'),
				'lightbox_vimeo' => __('Lightbox - Vimeo', 'meydjer'),
				'lightbox_mov' => __('Lightbox - QuickTime', 'meydjer'),
				'lightbox_swf' => __('Lightbox - Flash', 'meydjer'),
				'lightbox_html' => __('Lightbox - HTML', 'meydjer'),
				'embedded_audio' => __('Embedded - Audio', 'meydjer'),
				'embedded_video' => __('Embedded - Video', 'meydjer'),
				'embedded_html' => __('Embedded - HTML', 'meydjer'),
				'slider' => __('Image Slider', 'meydjer')
			),
			'multiple' => false,						// select multiple values, optional. Default is false.
			'std' => array('lightbox_image')
		),
		array(
			'name' => __('YouTube', 'meydjer'),					// field name
			'desc' => __('Put the FULL video url (e.g. http://www.youtube.com/watch?v=E_a2P6uc9Nk)', 'meydjer'),	// field description, optional
			'id' => $prefix . 'lightbox_youtube',				// field id, i.e. the meta key
			'type' => 'text',						// text box
			'std' => '',					// default value, optional
			'style' => ''				// custom style for field, added in v3.1
		),
		array(
			'name' => __('Vimeo', 'meydjer'),					// field name
			'desc' => __('Put the FULL video url (e.g. http://vimeo.com/24900455)', 'meydjer'),	// field description, optional
			'id' => $prefix . 'lightbox_vimeo',				// field id, i.e. the meta key
			'type' => 'text',						// text box
			'std' => '',					// default value, optional
			'style' => ''				// custom style for field, added in v3.1
		),
		array(
			'name' => __('QuickTime Movie', 'meydjer'),					// field name
			'desc' => __('Upload your file and then type the width and height of your file.', 'meydjer'),	// field description, optional
			'id' => $prefix . 'lightbox_mov',				// field id, i.e. the meta key
			'type' => 'upload',						// text box
			'std' => '',					// default value, optional
			'style' => ''				// custom style for field, added in v3.1
		),
		array(
			'name' => __('Flash Animation', 'meydjer'),					// field name
			'desc' => __('Upload your file and then type the width and height of your file.', 'meydjer'),	// field description, optional
			'id' => $prefix . 'lightbox_swf',				// field id, i.e. the meta key
			'type' => 'upload',						// text box
			'std' => '',					// default value, optional
			'style' => ''				// custom style for field, added in v3.1
		),
		array(
			'name' => __('HTML', 'meydjer'),					// field name
			'desc' => __('Here you can put any HTML stuff, like text or embedded videos.', 'meydjer'),	// field description, optional
			'id' => $prefix . 'html_content',				// field id, i.e. the meta key
			'type' => 'textarea',						// text box
			'std' => '',					// default value, optional
			'style' => ''				// custom style for field, added in v3.1
		),
		array(
			'name' => __('Width', 'meydjer'),					// field name
			'desc' => __('The content width.', 'meydjer'),	// field description, optional
			'id' => $prefix . 'featured_content_width',				// field id, i.e. the meta key
			'type' => 'text',						// text box
			'std' => '',					// default value, optional
			'style' => 'width:50px;'				// custom style for field, added in v3.1
		),
		array(
			'name' => __('Height', 'meydjer'),					// field name
			'desc' => __('The content height.', 'meydjer'),	// field description, optional
			'id' => $prefix . 'featured_content_height',				// field id, i.e. the meta key
			'type' => 'text',						// text box
			'std' => '',					// default value, optional
			'style' => 'width:50px;'				// custom style for field, added in v3.1
		),
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
		),
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
			'desc' => __('Need a tool to convert your MP3 to OGG? Take a look at <a href=\"http://media.io/\" target=\"_blank\">media.io</a>.', 'meydjer'),	// field description, optional
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
class ml_Meta_Box_Validate {
	function check_name($text) {
		if ($text == 'Anh Tran') {
			return 'He is Rilwis';
		}
		return $text;
	}
}

/********************* END VALIDATION ***********************/
?>