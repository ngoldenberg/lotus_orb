<?php
/*-------------------------------------------------*/
/*	Localization
/*-------------------------------------------------*/
load_theme_textdomain('meydjer', get_template_directory() . '/lang');

/*-------------------------------------------------*/
/*	Register and load common JavaScripts
/*-------------------------------------------------*/
function ml_register_js() {
	if (!is_admin()) {
				
		wp_register_script('easing', get_template_directory_uri() . '/js/libs/jquery.easing.min.js', 'jquery');
		wp_register_script('superfish', get_template_directory_uri() . '/js/libs/superfish.js', 'jquery');
		wp_register_script('prettyPhoto', get_template_directory_uri() . '/js/libs/jquery.prettyPhoto.js', 'jquery');
		wp_register_script('supersized', get_template_directory_uri() . '/js/libs/supersized.3.2.4.min.js', 'jquery', '3.2.4');
		wp_register_script('shutter', get_template_directory_uri() . '/js/libs/supersized.shutter.js.php', 'supersized');
		wp_register_script('jplayer', get_template_directory_uri() . '/js/libs/jquery.jplayer.min.js', 'jquery');
		wp_register_script('swfobject', 'http://ajax.googleapis.com/ajax/libs/swfobject/2.2/swfobject.js', '', '3.2.4');
		wp_register_script('metadata', get_template_directory_uri() . '/js/libs/jquery.metadata.js', 'jquery');
		wp_register_script('isotope', get_template_directory_uri() . '/js/libs/jquery.isotope.min.js', 'jquery');
		wp_register_script('masonry', get_template_directory_uri() . '/js/libs/jquery.masonry.min.js', 'jquery');
		wp_register_script('nivo-slider', get_template_directory_uri() . '/js/libs/jquery.nivo.slider.pack.js', 'jquery');
		wp_register_script('ml_plugins', get_template_directory_uri() . '/js/plugins.js.php', 'jquery', '1.0');
		wp_register_script('ml_scripts', get_template_directory_uri() . '/js/scripts.js.php', 'jquery', '1.0');
		
		wp_enqueue_script('jquery');
		wp_enqueue_script('jquery-ui-tabs');
		wp_enqueue_script('easing');
		wp_enqueue_script('superfish');
		wp_enqueue_script('prettyPhoto');
		wp_enqueue_script('supersized');
		wp_enqueue_script('shutter');
		wp_enqueue_script('jplayer');
		wp_enqueue_script('swfobject');
		wp_enqueue_script('metadata');
		wp_enqueue_script('isotope');
/* 		wp_enqueue_script('masonry'); */
		wp_enqueue_script('nivo-slider');
		wp_enqueue_script('ml_plugins');
		wp_enqueue_script('ml_scripts');
		
	}
	
	/* media uploader for the theme options panel */
	if(is_admin()) {
		wp_register_script( 'of-medialibrary-uploader', get_template_directory_uri() .'/admin/js/of-medialibrary-uploader.js', array( 'jquery', 'thickbox' ) );
	}
}
add_action('init', 'ml_register_js');


/*-------------------------------------------------*/
/*	Call Options Framework
/*-------------------------------------------------*/
if ( !function_exists( 'optionsframework_init' ) ) {
	define( 'OPTIONS_FRAMEWORK_DIRECTORY', get_template_directory_uri() . '/admin/' );
	require_once dirname(dirname( __FILE__ )) . '/admin/options-framework.php';
}



/*-------------------------------------------------*/
/*	Minimal Settings
/*-------------------------------------------------*/
/*--- Max Content Width ---*/
if (!isset($content_width)) $content_width = 1920;

/*--- Post and comment RSS feed links to head ---*/
add_theme_support('automatic-feed-links');

/*--- Load single scripts only on single pages ---*/
function ml_single_scripts() {
	if(is_singular()) wp_enqueue_script( 'comment-reply' ); // Visit http://codex.wordpress.org/Migrating_Plugins_and_Themes_to_2.7/Enhanced_Comment_Display for more info
}


/*-------------------------------------------------*/
/*	Custom Login Image
/*-------------------------------------------------*/
function ml_custom_login() {
	/* if you don't have any custom logo, this function will retrieve the theme's logo */
	$theme_logo = get_template_directory_uri() . '/images/fiat_lux-logo.gif';
	echo '<style type="text/css">'; 
	echo '	#login {margin:0 auto 7em auto;}';
	echo '	h1 a {';
	echo '		background:url('.of_get_option('ml_login_image', $theme_logo).') no-repeat center bottom;';
	echo '		height:145px;';
	echo '		margin:20px auto;';
	echo '		padding:0 8px;';
	echo '		width:310px;';
	echo '	}';
	echo '</style>';
}
add_action('login_head', 'ml_custom_login');


/*-------------------------------------------------*/
/*	Main Menu
/*-------------------------------------------------*/
/* This one will replace the Pages List */
function register_my_menus() {
  register_nav_menus(
    array('main-menu' => __('Main Menu','meydjer') )
  );
}
add_action( 'init', 'register_my_menus' );


/*-------------------------------------------------*/
/*	Post Formats
/*-------------------------------------------------*/
add_theme_support( 'post-formats', array( 'aside', 'gallery', 'link', 'image', 'quote', 'status', 'video', 'audio', 'chat' ) );


/*-------------------------------------------------*/
/*	Image Sizes
/*-------------------------------------------------*/

add_theme_support( 'post-thumbnails' );

//portfolios
add_image_size( 'port1col', 420, 420, true);
add_image_size( 'port2cols', 380, 380, true);
add_image_size( 'port3cols', 210, 210, true);
add_image_size( 'port4cols', 125, 125, true);

//galleries
add_image_size( 'gal2cols', 440, 440, true);
add_image_size( 'gal3cols', 290, 290, true);
add_image_size( 'gal4cols', 215, 215, true);
add_image_size( 'gal5cols', 170, 170, true);
add_image_size( 'gal6cols', 140, 140, true);
add_image_size( 'gal7cols', 119, 119, true);
add_image_size( 'gal8cols', 103, 103, true);
add_image_size( 'gal9cols', 90, 90, true);
add_image_size( 'gal10cols', 80, 80, true);

//other sizes
add_image_size( 'featured', 635, 315, true);


/*-------------------------------------------------*/
/*	Excerpts
/*-------------------------------------------------*/

function new_excerpt_more($more) {
	return '...';
}
add_filter('excerpt_more', 'new_excerpt_more');

function new_excerpt_length($length) {
global $post;
/* Standard excerpt */
return 40;
}
add_filter('excerpt_length', 'new_excerpt_length');

//custom excerpt length functions
function ml_custom_excerpt($string, $word_limit)
{
  $words = explode(' ', $string, ($word_limit + 1));
  if(count($words) > $word_limit) {
	  array_pop($words);
	  $words = str_replace('...','',$words);
	  return implode(' ', $words).'...';
  } else {
	  return implode(' ', $words);  
  }
}

?>