<?php
/**
 * A unique identifier is defined to store the options in the database and reference them from the theme.
 * By default it uses the theme name, in lowercase and without spaces, but this can be changed if needed.
 * If the identifier changes, it'll appear as if the options have been reset.
 * 
 */

function optionsframework_option_name() {

	// This gets the theme name from the stylesheet
	$themename = get_option( 'stylesheet' );
	$themename = preg_replace("/\W/", "_", strtolower($themename) );

	$optionsframework_settings = get_option( 'optionsframework' );
	$optionsframework_settings['id'] = $themename;
	update_option( 'optionsframework', $optionsframework_settings );

}


/**
 * Defines an array of options that will be used to generate the settings page and be saved in the database.
 * When creating the "id" fields, make sure to use all lowercase and no spaces.
 *  
 */

function optionsframework_options() {
	
	//Theme Shortname
	$shortname = "ml_";
	
	//Blog Info
	$sitename = get_bloginfo('name');
	$sitedescription = get_bloginfo('description');
	
	// Pull all the categories into an array
	$options_categories = array();  
	$options_categories_obj = get_categories();
	foreach ($options_categories_obj as $category) {
    	$options_categories[$category->cat_ID] = $category->cat_name;
	}
	
	// Pull all the pages into an array
	$options_pages = array();  
	$options_pages_obj = get_pages('sort_column=post_parent,menu_order');
	foreach ($options_pages_obj as $page) {
    	$options_pages[$page->ID] = $page->post_title;
	}
		
	// If using image radio buttons, define a directory path
	$imagepath =  get_stylesheet_directory_uri() . '/admin/images/';
		
	$options = array();
	

								

	
	/*
	    // ========================================== \\
	   ||                                              ||
	   ||                 Theme Options								 ||
	   ||                                              ||
	    \\ ========================================== //
	*/
	
	
	/*-------------------------------------------------*/
	/*	Logo and Icons Options
	/*-------------------------------------------------*/
	$options[] = array( "name" => __('Logo and Icons', 'meydjer'),
						"type" => "heading");

	$options[] = array( "name" => __('Logo - Text or Image?', 'meydjer'),
						"desc" => __('Select between Image or Text.', 'meydjer'),
						"id" => $shortname . "logo_text_or_image",
						"std" => "image",
						"type" => "select",
						"class" => "mini", //mini, tiny, small
						"options" => array('image' => __('Image', 'meydjer'), 'text' => __('Text', 'meydjer')));

	$options[] = array( "name" => __('Image Logo', 'meydjer'),
						"desc" => __('Upload here your own logo image. Default height: 82px;', 'meydjer'),
						"id" => $shortname . "logo_image",
						"type" => "upload");

	$options[] = array( "name" => __('Text Logo', 'meydjer'),
						"desc" => '<strong>'.__('WARNING: ','meydjer').'</strong>'.__('If you fill this field, your image logo will be overwritten.','meydjer'),
						"id" => $shortname . "logo_text",
						"type" => "text");

	$options[] = array( "name" => __('Text Logo Styles', 'meydjer'),
						"id" => $shortname . "text_logo_style",
						"std" => array('size' => '42px','color' => '#FFF'),
						"type" => "typography");			

	$options[] = array( "name" => __('Favorites Icon', 'meydjer'),
						"desc" => __('Icon that will appear in the browser bookmarks. (.ICO format)', 'meydjer'),
						"id" => $shortname . "icon_favicon",
						"type" => "upload");

	$options[] = array( "name" => __('Mobile Favorites Icon', 'meydjer'),
						"desc" => __('Icon used by iOS (iPhone, iPod and iPad) and Android (v2.1+). (.PNG format, with recommended size 129x129 pixels)', 'meydjer'),
						"id" => $shortname . "mobile_icon_favicon",
						"type" => "upload");

	
	/*-------------------------------------------------*/
	/*	Footer
	/*-------------------------------------------------*/
	$options[] = array( "name" => __('Footer','meydjer'),
						"type" => "heading");
	
	$options[] = array( "name" => __('Footer Columns', 'meydjer'),
						"desc" => __('How much columns do you need?', 'meydjer'),
						"id" => $shortname . "footer_columns",
						"std" => "4",
						"type" => "images",
						"options" => array(
												'0' => $imagepath . 'footer-no.gif',
												'1' => $imagepath . 'footer-1col.gif',
												'2' => $imagepath . 'footer-2col.gif',
												'3' => $imagepath . 'footer-3col.gif',
												'4' => $imagepath . 'footer-4col.gif'
												)
						);

	$options[] = array( "name" => __('Copyright Text', 'meydjer'),
						"desc" => '<strong>'.__('Tip: ','meydjer').'</strong>'.__('Use "&amp;'.'copy;" (without quotes) to generate the &copy; symbol. Leave it blank if you don\'t want any copyright message.','meydjer'),
						"id" => $shortname . "copyright_text",
						"std" => '&copy; Copyright 2011 - FIAT LUX WordPress Theme. All rights reserved. Designed and developed by <a href="http://meydjer.com/" target="_blank">Meydjer Luzzoli</a>.',
						"type" => "textarea"); 
						

	/*-------------------------------------------------*/
	/*	Sidebar
	/*-------------------------------------------------*/
	$options[] = array( "name" => __('Sidebar','meydjer'),
						"type" => "heading");

	$options[] = array( "name" => __('Sidebar Position', 'meydjer'),
						"desc" => __('Left or right sidebar.', 'meydjer'),
						"id" => $shortname . "sidebar_position",
						"std" => "sidebar_right",
						"type" => "images",
						"options" => array(
												'sidebar_left' => $imagepath . 'page-sidebar_left.png',
												'sidebar_right' => $imagepath . 'page-sidebar_right.png'
												)
						);

	$options[] = array( "name" => __('Widget Area in Each Category?', 'meydjer'),
						"desc" => __('Check if you want a widget area in each category', 'meydjer'),
						"id" => $shortname . "widget_for_categories",
						"std" => "0",
						"type" => "checkbox");

	$options[] = array( "name" => __('Widget Area in Each Page?', 'meydjer'),
						"desc" => __('Check if you want a widget area in each page', 'meydjer'),
						"id" => $shortname . "widget_for_pages",
						"std" => "0",
						"type" => "checkbox");


	/*-------------------------------------------------*/
	/*	Menu
	/*-------------------------------------------------*/
	$options[] = array( "name" => __('Menu','meydjer'),
						"type" => "heading");

	$options[] = array( "name" => "",
						"message" => __("The options below only works if you don't have a custom menu as Main Menu (Appeareance > Menus > Theme Locations. WordPress 3+).",'meydjer'),
						"id" => $shortname . "menu_warning",
						"type" => "note");

	$options[] = array( "name" => __('Exclude Pages', 'meydjer'),
						"desc" => __('IDs of the pages you wish to exclude from menu, separated by commas. (e.g. 12,35,75)', 'meydjer'),
						"id" => $shortname . "menu_exclude",
						"type" => "multicheck",
						"options" => $options_pages);

	$options[] = array( "name" => __('Order By', 'meydjer'),
						"desc" => __('The view order you wish to set for your menu.', 'meydjer'),
						"id" => $shortname . "menu_order_by",
						"std" => "ID",
						"type" => "select",
						"options" => array(
													'ID' => __('By ID', 'meydjer'),
													'post_title' => __('By Post Title', 'meydjer'),
													'menu_order' => __('By Menu Order', 'meydjer')
													)
												);			 


	/*-------------------------------------------------*/
	/*	Styling Options
	/*-------------------------------------------------*/
	$options[] = array( "name" => __('Styling Options','meydjer'),
						"type" => "heading");

	$options[] = array( "name" => __('Primary Color', 'meydjer'),
						"desc" => __('The main color.', 'meydjer'),
						"std" => "#ffffff",
						"id" => $shortname . "primary_color",
						"type" => "color");

	$options[] = array( "name" => __('Secondary Color', 'meydjer'),
						"desc" => __('Contrast for the main color.', 'meydjer'),
						"std" => "#000000",
						"id" => $shortname . "secondary_color",
						"type" => "color");

	$options[] = array( "name" => __('Text Color', 'meydjer'),
						"desc" => __('Color for paragraphs, inputs and textareas.', 'meydjer'),
						"std" => "#ffffff",
						"id" => $shortname . "text_color",
						"type" => "color");

	$options[] = array( "name" => __('Box Opacity', 'meydjer'),
						"desc" => __('The percentage of box opacity (0 to 100).','meydjer'). ' <strong>'.__('Default value: 80','meydjer').'</strong>',
						"id" => $shortname . "box_opacity",
						"std" => "80",
						"class" => "mini",
						"type" => "text");

	$options[] = array( "name" => __('Featured Image as Background', 'meydjer'),
						"desc" => __('If a page/post have a featured image, make it my Fullscreen Image Background.', 'meydjer'),
						"id" => $shortname . "featured_image_as_bg",
						"std" => "1",
						"type" => "checkbox");

	$options[] = array( "name" => __('Standard Background', 'meydjer'),
						"desc" => __('Select between Fullscreen Image Background or Pattern', 'meydjer'),
						"id" => $shortname . "standard_bg",
						"type" => "select",
						"options" => array(
												"fullscreen_bg" => __('Fullscreen Image Background', 'meydjer'),
												"pattern_bg" => __('Pattern', 'meydjer')
												));			 

	$options[] = array( "name" => __('Fullscreen Image Background', 'meydjer'),
						"id" => $shortname . "fullscreen_bg",
						"type" => "upload");

	$options[] = array( "name" => __('Pattern Background', 'meydjer'),
						"id" => $shortname . "pattern_bg",
						"type" => "upload");

	$options[] = array( "name" => __('prettyPhoto Theme', 'meydjer'),
						"desc" => __('Select between Image or Text.', 'meydjer'),
						"id" => $shortname . "prettyphoto_theme",
						"std" => "pp_default",
						"type" => "select",
						"options" => array(
												'pp_default' => __('Default', 'meydjer'),
												'light_rounded' => __('Light Rounded', 'meydjer'),
												'light_square' => __('Light Square', 'meydjer'),
												'dark_rounded' => __('Dark Rounded', 'meydjer'),
												'dark_square' => __('Dark Square', 'meydjer'),
												'facebook' => __('Facebook', 'meydjer')
												));			 

	/*-------------------------------------------------*/
	/*	Google Fonts
	/*-------------------------------------------------*/
	$options[] = array( "name" => __('Google Fonts','meydjer'),
						"type" => "heading");
	
	$options[] = array( "name" => __('Google Font API Link', 'meydjer'),
						"desc" => __('Copy your font link from <a href="http://www.google.com/webfonts" target="_blank">google.com/webfonts</a>. (e.g. &lt;link href=\'http://fonts.googleapis.com/css?family=Open+Sans+Condensed:300\' rel=\'stylesheet\' type=\'text/css\'>)', 'meydjer'),
						"id" => $shortname . "google_font_link",
						"std" => "<link href='http://fonts.googleapis.com/css?family=Open+Sans+Condensed:300' rel='stylesheet' type='text/css'>",
						"type" => "html");

	$options[] = array( "name" => __('Google Font CSS Keyword', 'meydjer'),
						"desc" => __('The Font Family CSS keyword. E.g. If google says your Integrate CSS code is "font-family: "Open Sans Condensed", sans-serif;", paste the "Open Sans Condensed" keyword (without quotes).', 'meydjer'),
						"id" => $shortname . "google_font_css_key",
						"std" => "Open Sans Condensed",
						"type" => "text");

	$options[] = array( "name" => __('Text Transform', 'meydjer'),
						"id" => $shortname . "google_font_text_transform",
						"type" => "select",
						"std" => "uppercase",
						"options" => array(
												"none" => __('None', 'meydjer'),
												"capitalize" => __('Capitalize', 'meydjer'),
												"lowercase" => __('Lowercase', 'meydjer'),
												"uppercase" => __('Uppercase', 'meydjer')
												));			 


	/*-------------------------------------------------*/
	/*	Video Background
	/*-------------------------------------------------*/
	$options[] = array( "name" => __('Video Background','meydjer'),
						"type" => "heading");

	$options[] = array(
		"name"		=> __('M4V video file', 'meydjer'),
		"id"			=> $shortname."m4v",
		"desc"		=> __('<strong>Tip</strong>: You can just change your ".mp4" video extension to ".m4v". <br><br>You will need the ".ogv" version too.', 'meydjer'),
		"type"		=> "upload"
	);

	$options[] = array(
		"name"		=> __('OGV video file', 'meydjer'),
		"id"			=> $shortname."ogv",
		"desc"		=> __('<strong>Tip</strong>: If you need, you can convert your video to ".ogv" at <a href="http://video.online-convert.com/convert-to-ogg" target="_blank">Online-Convert.com</a>. <br><br>You will need the ".m4v" version too.', 'meydjer'),
		"type"		=> "upload"
	);


	/*-------------------------------------------------*/
	/*	Slider Options
	/*-------------------------------------------------*/
	$options[] = array( "name" => __('Slider Background','meydjer'),
						"type" => "heading");

	$options[] = array( "name" => "",
						"message" => __("Need a tool to convert your MP3 to OGG? Take a look at <a href=\"http://media.io/\" target=\"_blank\">media.io</a>","fiatlux"),
						"id" => $shortname . "menu_warning",
						"type" => "note");

	$options[] = array( "name" => __('Music Background - MP3', 'meydjer'),
						"desc" => __('Leave it blank you don\'t want any music background.', 'meydjer'),
						"id" => $shortname . "music_bg_mp3",
						"type" => "upload");

	$options[] = array( "name" => __('Music Background - OGG/OGA', 'meydjer'),
						"desc" => __('Leave it blank you don\'t want any music background.', 'meydjer'),
						"id" => $shortname . "music_bg_ogg",
						"type" => "upload");

	$options[] = array( "name" => __('Autoplay Music', 'meydjer'),
						"desc" => __('Determines whether music begins playing when page is loaded.', 'meydjer'),
						"id" => $shortname . "music_bg_autoplay",
						"std" => "1",
						"type" => "checkbox");
						
	$options[] = array( "name" => __('Navigation Buttons', 'meydjer'),
						"desc" => __('Check to show previous, next and play/pause buttons.', 'meydjer'),
						"id" => $shortname . "nav_buttons",
						"std" => "1",
						"type" => "checkbox");
						
	$options[] = array( "name" => __('Thumbnails', 'meydjer'),
						"desc" => __('Check to show slide thumbnails.', 'meydjer'),
						"id" => $shortname . "slide_thumbnails",
						"std" => "1",
						"type" => "checkbox");
						
	$options[] = array( "name" => __('Thumbnails Size', 'meydjer'),
						"desc" => __('In pixels. Default: 76','meydjer'),
						"id" => $shortname . "slide_thumbnails_size",
						"std" => "76",
						"class" => "mini",						
						"type" => "text");

	$options[] = array( "name" => __('Captions', 'meydjer'),
						"desc" => __('Check to show slide captions.', 'meydjer'),
						"id" => $shortname . "slide_captions",
						"std" => "1",
						"type" => "checkbox");
						
	$options[] = array( "name" => __('Autoplay Slider', 'meydjer'),
						"desc" => __('Determines whether slideshow begins playing when page is loaded.', 'meydjer'),
						"id" => $shortname . "slider_autoplay",
						"std" => "1",
						"type" => "checkbox");
						
	$options[] = array( "name" => __('Random', 'meydjer'),
						"desc" => __('Slides are shown in a random order.', 'meydjer'),
						"id" => $shortname . "slider_random",
						"std" => "0",
						"type" => "checkbox");
						
	$options[] = array( "name" => __('Slide Interval', 'meydjer'),
						"desc" => __('Time between slide changes (in seconds).','meydjer'). ' <strong>'.__('Default value: 5.5','meydjer').'</strong>',
						"id" => $shortname . "slide_interval",
						"std" => "5.5",
						"class" => "mini",
						"type" => "text");
						
	$options[] = array( "name" => __('Transition Effect', 'meydjer'),
						"desc" => __('Controls which effect is used to transition between slides.', 'meydjer'),
						"id" => $shortname . "transition",
						"std" => "1",
						"type" => "select",
						"options" => array(
													__('None', 'meydjer'),
													__('Fade', 'meydjer'),
													__('Slide Top', 'meydjer'),
													__('Slide Right', 'meydjer'),
													__('Slide Bottom', 'meydjer'),
													__('Slide Left', 'meydjer'),
													__('Carousel Right', 'meydjer'),
													__('Carousel Left', 'meydjer')
													)
												);			 

	$options[] = array( "name" => __('Transition Speed', 'meydjer'),
						"desc" => __('Speed of transitions (in seconds).','meydjer'). ' <strong>'.__('Default value: 1.5','meydjer').'</strong>',
						"id" => $shortname . "transition_speed",
						"std" => "1.5",
						"class" => "mini",
						"type" => "text");
						
	$options[] = array( "name" => __('New Window', 'meydjer'),
						"desc" => __('Slide links open in a new window/tab', 'meydjer'),
						"id" => $shortname . "new_window",
						"std" => "0",
						"type" => "checkbox");
						
	$options[] = array( "name" => __('Pause on Hover', 'meydjer'),
						"desc" => __('Pauses slideshow while current image hovered over.', 'meydjer'),
						"id" => $shortname . "pause_hover",
						"std" => "0",
						"type" => "checkbox");
						
	$options[] = array( "name" => __('Keyboard Navigation', 'meydjer'),
						"desc" => __('Allows control via keyboard: ','meydjer'). ' <strong>'.__('Spacebar','meydjer'). ' </strong>'.__(' - Pause or play / ','meydjer'). ' <strong>'.__('Right arrow or Up Arrow','meydjer'). ' </strong>'.__(' - Next slide / ','meydjer'). ' <strong>'.__('Left arrow or Down Arrow','meydjer'). ' </strong>'.__(' - Previous slide', 'meydjer'),
						"id" => $shortname . "keyboard_nav",
						"std" => "0",
						"type" => "checkbox");
						
	$options[] = array( "name" => __('Image Protect', 'meydjer'),
						"desc" => __('Disables right clicking and image dragging to dificult copy.', 'meydjer'),
						"id" => $shortname . "image_protect",
						"std" => "1",
						"type" => "checkbox");
						
	$options[] = array( "name" => __('Vertical Center', 'meydjer'),
						"desc" => __('Centers image vertically. When turned off, the images resize/display from the top of the page.', 'meydjer'),
						"id" => $shortname . "vertical_center",
						"std" => "1",
						"type" => "checkbox");
						
	$options[] = array( "name" => __('Horizontal Center', 'meydjer'),
						"desc" => __('Centers image horizontally. When turned off, the images resize/display from the left of the page.', 'meydjer'),
						"id" => $shortname . "horizontal_center",
						"std" => "1",
						"type" => "checkbox");
						
	$options[] = array( "name" => __('Fit Portrait', 'meydjer'),
						"desc" => __('Prevents the image from being cropped by locking it at 100% height.', 'meydjer'),
						"id" => $shortname . "fit_portrait",
						"std" => "0",
						"type" => "checkbox");
						
	$options[] = array( "name" => __('Fit Landscape', 'meydjer'),
						"desc" => __('Prevents the image from being cropped by locking it at 100% width.', 'meydjer'),
						"id" => $shortname . "fit_landscape",
						"std" => "0",
						"type" => "checkbox");
						

	/*-------------------------------------------------*/
	/*	Slides
	/*-------------------------------------------------*/
	$options[] = array( "name" => __('Slides','meydjer'),
						"type" => "heading");
						
	/* Slides */
	for ($slide_num = 1; $slide_num <= 10; $slide_num++) {
		
		if ($slide_num == 1 || $slide_num == 6) {
			$slide_class = "h-green";
		}
		if ($slide_num == 2 || $slide_num == 7) {
			$slide_class = 'h-red';
		}
		if ($slide_num == 3 || $slide_num == 8) {
			$slide_class = 'h-blue';
		}
		if ($slide_num == 4 || $slide_num == 9) {
			$slide_class = 'h-yellow';
		}
		if ($slide_num == 5 || $slide_num == 10) {
			$slide_class = 'h-pink';
		}
		
		$options[] = array( "name" => __('Slide Image','meydjer')." #".$slide_num,
							"id" => $shortname."slider_".$slide_num."_img",
							"class" => $slide_class,
							"type" => "upload");
							
		$options[] = array( "name" => __('Caption','meydjer')." #".$slide_num,
							"id" => $shortname."slider_".$slide_num."_caption",
							"class" => "small ". $slide_class,
							"type" => "text");
		
		$options[] = array( "name" => __('Slide Link','meydjer')." #".$slide_num,
							"id" => $shortname."slider_".$slide_num."_link",
							"type" => "select",
							"class" => "small ". $slide_class,
							"options" => array(
												__('No link','meydjer'),
												__('Link to a Post/Portfolio Item','meydjer'),
												__('Link to a Page','meydjer'),
												__('Link to a Category','meydjer'),
												__('Custom Link','meydjer')
												)
							);
							
		$options[] = array( "name" => __('Post/Portfolio Item','meydjer')." #".$slide_num,
							"desc" => __('The post/portfolio item ID','meydjer'),
							"id" => $shortname."slider_".$slide_num."_post",
							"class" => "mini ". $slide_class,
							"type" => "text");
							
		$options[] = array( "name" => __('Pages','meydjer')." #".$slide_num,
							"id" => $shortname."slider_".$slide_num."_pages",
							"type" => "select",
							"class" => "small ". $slide_class,
							"options" => $options_pages);
							
		$options[] = array( "name" => __('Categories','meydjer')." #".$slide_num,
							"id" => $shortname."slider_".$slide_num."_categories",
							"type" => "select",
							"class" => "small ". $slide_class,
							"options" => $options_categories);
							
		$options[] = array( "name" => __('Custom Link','meydjer')." #".$slide_num,
							"id" => $shortname."slider_".$slide_num."_custom_link",
							"desc" => __('Full URL (<strong>WITH</strong> "http://")','meydjer'),
							"default" => "http://google.com/",
							"class" => "small ". $slide_class,
							"type" => "text");
	}


	/*-------------------------------------------------*/
	/*	Galleries List
	/*-------------------------------------------------*/
	$options[] = array( "name" => __('Galleries List Page','meydjer'),
						"type" => "heading");

	$options[] = array( "name" => __('Slides Effects?', 'meydjer'),
						"desc" => __('If you disable it the theme will show only the last picture, withour the slides effects', 'meydjer'),
						"id" => $shortname . "enable_slides_effects",
						"std" => "1",
						"type" => "checkbox");

	$options[] = array( "name" => __('Show the latest N pictures', 'meydjer'),
						"desc" => __('Default value: 5', 'meydjer'),
						"id" => $shortname . "latest_n_pictures",
						"std" => "5",
						"class" => "mini ml_if_slides_effects_is_enabled",
						"type" => "text");

	/*-------------------------------------------------*/
	/*	Nivo Slider
	/*-------------------------------------------------*/
	$options[] = array( "name" => __('Nivo Slider','meydjer'),
						"type" => "heading");

	$options[] = array( "name" => __('Slider Height','meydjer'),
						"desc" => __('Only for post/portfolio pages (in pixels). Default: 377','meydjer'),
						"id" => $shortname."slider_height",
						"std" => "377",
						"type" => "text",
						"class" => "mini");
	
	$options[] = array( "name" => __('Effect','meydjer'),
						"id" => $shortname."slides_effect",
						"std" => "random",
						"type" => "select",
						"class" => "ml_if_slides_effects_is_enabled",
						"options" => array(
												"sliceDown" => "sliceDown",
												"sliceDownLeft" => "sliceDownLeft",
												"sliceUp" => "sliceUp",
												"sliceUpLeft" => "sliceUpLeft",
												"sliceUpDown" => "sliceUpDown",
												"sliceUpDownLeft" => "sliceUpDownLeft",
												"fold" => "fold",
												"fade" => "fade",
												"random" => "random",
												"slideInRight" => "slideInRight",
												"slideInLeft" => "slideInLeft",
												"boxRandom" => "boxRandom",
												"boxRain" => "boxRain",
												"boxRainReverse" => "boxRainReverse",
												"boxRainGrow" => "boxRainGrow",
												"boxRainGrowReverse" => "boxRainGrowReverse"
												)
						);
						
	$options[] = array( "name" => __('Slices','meydjer'),
						"desc" => __('Default: 4','meydjer'),
						"id" => $shortname."slides_slices",
						"std" => "4",
						"type" => "text",
						"class" => "mini ml_if_slides_effects_is_enabled");
	
	$options[] = array( "name" => __('Box Columns','meydjer'),
						"desc" => __('Default: 4','meydjer'),
						"id" => $shortname."slides_box_cols",
						"std" => "4",
						"type" => "text",
						"class" => "mini ml_if_slides_effects_is_enabled");
	
	$options[] = array( "name" => __('Box Rows','meydjer'),
						"desc" => __('Default: 4','meydjer'),
						"id" => $shortname."slides_box_rows",
						"std" => "4",
						"type" => "text",
						"class" => "mini ml_if_slides_effects_is_enabled");
						
	$options[] = array( "name" => __('Animation Speed','meydjer'),
						"desc" => __('Slide transition speed (seconds). Default: 0.5','meydjer'),
						"id" => $shortname."slides_anim_speed",
						"std" => "0.5",
						"type" => "text",
						"class" => "mini ml_if_slides_effects_is_enabled");
						
	$options[] = array( "name" => __('Pause Time','meydjer'),
						"desc" => __('How long each slide will show (seconds). Default:2.5','meydjer'),
						"id" => $shortname."slides_pause_time",
						"std" => "2.5",
						"type" => "text",
						"class" => "mini ml_if_slides_effects_is_enabled");
	

	/*-------------------------------------------------*/
	/*	Gallery Page
	/*-------------------------------------------------*/
	$options[] = array( "name" => __('Gallery Page','meydjer'),
						"type" => "heading");

	$options[] = array( "name" => __('Grayscale Effect?', 'meydjer'),
						"desc" => __('If you uncheck it, the grayscale effect will be disabled from the pictures grid.', 'meydjer'),
						"id" => $shortname . "grayscale_effect",
						"std" => "1",
						"type" => "checkbox");
	
	$options[] = array( "name" => __('Grid Columns','meydjer'),
						"desc" => __('How much columns do you want in the pictures grid?', 'meydjer'),
						"id" => $shortname."grid_cols",
						"std" => "5",
						"type" => "select",
						"class" => "mini",
						"options" => array(
												"2" => "2",
												"3" => "3",
												"4" => "4",
												"5" => "5",
												"6" => "6",
												"7" => "7",
												"8" => "8",
												"9" => "9",
												"10" => "10"
												)
						);

	$options[] = array( "name" => __('Gallery Custom Background', 'meydjer'),
						"desc" => __("If you leave it blank, the theme will get your standard background (image or pattern).", 'meydjer'),
						"id" => $shortname . "gallery_custom_bg",
						"type" => "upload");


	/*-------------------------------------------------*/
	/*	Other Settings
	/*-------------------------------------------------*/
	$options[] = array( "name" => __('Other Settings','meydjer'),
						"type" => "heading");
	
	$options[] = array( "name" => __('Custom CSS', 'meydjer'),
						"desc" => __('Add your CSS code easily.', 'meydjer'),
						"id" => $shortname . "custom_css",
						"type" => "textarea"); 

	$options[] = array( "name" => __('Tracking/JavaScript Code', 'meydjer'),
						"desc" => __('Put your Google Analytics (or any other) and Custom Javascript/jQuery code here.', 'meydjer'),
						"id" => $shortname . "custom_js",
						"type" => "textarea"); 

	$options[] = array( "name" => __('Custom Login Image', 'meydjer'),
						"desc" => __("Customize the image of you login screen. (Maximum Size: 310x145 pixels.)", 'meydjer'),
						"id" => $shortname . "login_image",
						"type" => "upload");


	return $options;

}

function optionsframework_custom_scripts() { ?>

<script type="text/javascript">
jQuery(document).ready(function() {
/*--- Logo Options ---*/
jQuery('#ml_logo_text_or_image').change(function() {
	if(jQuery(this).val() == 'image') {
		jQuery('#section-ml_logo_image').fadeIn(400);
		jQuery('#section-ml_logo_text, #section-ml_text_logo_style').hide();
	}
	if(jQuery(this).val() == 'text') {
		jQuery('#section-ml_logo_text, #section-ml_text_logo_style').fadeIn(400);
		jQuery('#section-ml_logo_image').hide();
	}
});
if(jQuery('#ml_logo_text_or_image option:selected').val() == 'image'){
	jQuery('#section-ml_logo_text, #section-ml_text_logo_style').hide();
}
if(jQuery('#ml_logo_text_or_image option:selected').val() == 'text'){
	jQuery('#section-ml_logo_image').hide();
}


/*--- Standard Background Options ---*/
jQuery('#ml_standard_bg').change(function() {
	if(jQuery(this).val() == 'fullscreen_bg') {
		jQuery('#section-ml_fullscreen_bg').fadeIn(400);
		jQuery('#section-ml_pattern_bg').hide();
	}
	if(jQuery(this).val() == 'pattern_bg') {
		jQuery('#section-ml_pattern_bg').fadeIn(400);
		jQuery('#section-ml_fullscreen_bg').hide();
	}
});
if(jQuery('#ml_standard_bg option:selected').val() == 'fullscreen_bg'){
	jQuery('#section-ml_pattern_bg').hide();
}
if(jQuery('#ml_standard_bg option:selected').val() == 'pattern_bg'){
	jQuery('#section-ml_fullscreen_bg').hide();
}


/*--- Header Texture Options ---*/
jQuery('#ml_header_texture_disabled').click(function() {
		jQuery('#section-ml_header_texture').fadeToggle(400);
});

if (jQuery('#ml_header_texture_disabled:checked').val() !== undefined) {
	jQuery('#section-ml_header_texture').hide();
}


/*--- Slider Options ---*/
var slider_effect = jQuery('#ml_slider_effect');
jQuery(slider_effect).change(function() {
	if(jQuery(this).val() == 'sliceDown' || 
		jQuery(this).val() == 'sliceDownLeft' || 
		jQuery(this).val() == 'sliceUp' || 
		jQuery(this).val() == 'sliceUpLeft' || 
		jQuery(this).val() == 'sliceUpDown' || 
		jQuery(this).val() == 'sliceUpDownLeft') {
			jQuery('#section-ml_slider_slices').fadeIn(400);
			jQuery('#section-ml_slider_box_cols, #section-ml_slider_box_rows').hide();
	}
	if(jQuery(this).val() == 'fold' || 
		jQuery(this).val() == 'fade' || 
		jQuery(this).val() == 'random' || 
		jQuery(this).val() == 'slideInRight' || 
		jQuery(this).val() == 'slideInLeft') {
			jQuery('#section-ml_slider_slices, #section-ml_slider_box_cols, #section-ml_slider_box_rows').hide();
	}
	if(jQuery(this).val() == 'boxRandom' || 
		jQuery(this).val() == 'boxRain' || 
		jQuery(this).val() == 'boxRainReverse' || 
		jQuery(this).val() == 'boxRainGrow' || 
		jQuery(this).val() == 'boxRainGrowReverse') {
			jQuery('#section-ml_slider_box_cols, #section-ml_slider_box_rows').fadeIn(400);
			jQuery('#section-ml_slider_slices').hide();
	}
});
if(jQuery('#ml_slider_effect option:selected').val() == 'sliceDown' || 
	jQuery('#ml_slider_effect option:selected').val() == 'sliceDownLeft' || 
	jQuery('#ml_slider_effect option:selected').val() == 'sliceUp' || 
	jQuery('#ml_slider_effect option:selected').val() == 'sliceUpLeft' || 
	jQuery('#ml_slider_effect option:selected').val() == 'sliceUpDown' || 
	jQuery('#ml_slider_effect option:selected').val() == 'sliceUpDownLeft'){
	jQuery('#section-ml_slider_slices').show();
	jQuery('#section-ml_slider_box_cols, #section-ml_slider_box_rows').hide();
}
if(jQuery('#ml_slider_effect option:selected').val() == 'fold' || 
	jQuery('#ml_slider_effect option:selected').val() == 'fade' || 
	jQuery('#ml_slider_effect option:selected').val() == 'random' || 
	jQuery('#ml_slider_effect option:selected').val() == 'slideInRight' || 
	jQuery('#ml_slider_effect option:selected').val() == 'slideInLeft'){
	jQuery('#section-ml_slider_slices, #section-ml_slider_box_cols, #section-ml_slider_box_rows').hide();
}
if(jQuery('#ml_slider_effect option:selected').val() == 'boxRandom' || 
	jQuery('#ml_slider_effect option:selected').val() == 'boxRain' || 
	jQuery('#ml_slider_effect option:selected').val() == 'boxRainReverse' || 
	jQuery('#ml_slider_effect option:selected').val() == 'boxRainGrow' || 
	jQuery('#ml_slider_effect option:selected').val() == 'boxRainGrowReverse'){
	jQuery('#section-ml_slider_box_cols, #section-ml_slider_box_rows').show();
	jQuery('#section-ml_slider_slices').hide();
}


jQuery.each([1,2,3,4,5,6,7,8,9,10], function(index, value) { 
  jQuery('#ml_slider_'+value+'_link').change(function() {
  	if(jQuery(this).val() == '0') {
  		jQuery('#section-ml_slider_'+value+'_post, #section-ml_slider_'+value+'_pages, #section-ml_slider_'+value+'_categories, #section-ml_slider_'+value+'_custom_link').hide();
  	}
  	if(jQuery(this).val() == '1') {
  		jQuery('#section-ml_slider_'+value+'_post').fadeIn(400);
  		jQuery('#section-ml_slider_'+value+'_pages, #section-ml_slider_'+value+'_categories, #section-ml_slider_'+value+'_custom_link').hide();
  	}
  	if(jQuery(this).val() == '2') {
  		jQuery('#section-ml_slider_'+value+'_pages').fadeIn(400);
  		jQuery('#section-ml_slider_'+value+'_post, #section-ml_slider_'+value+'_categories, #section-ml_slider_'+value+'_custom_link').hide();
  	}
  	if(jQuery(this).val() == '3') {
  		jQuery('#section-ml_slider_'+value+'_categories').fadeIn(400);
  		jQuery('#section-ml_slider_'+value+'_post, #section-ml_slider_'+value+'_pages, #section-ml_slider_'+value+'_custom_link').hide();
  	}
  	if(jQuery(this).val() == '4') {
  		jQuery('#section-ml_slider_'+value+'_custom_link').fadeIn(400);
  		jQuery('#section-ml_slider_'+value+'_post, #section-ml_slider_'+value+'_pages, #section-ml_slider_'+value+'_categories').hide();
  	}
  });
  if(jQuery('#ml_slider_'+value+'_link option:selected').val() == '0') {
  	jQuery('#section-ml_slider_'+value+'_post, #section-ml_slider_'+value+'_pages, #section-ml_slider_'+value+'_categories, #section-ml_slider_'+value+'_custom_link').hide();
  }
  if(jQuery('#ml_slider_'+value+'_link option:selected').val() == '1') {
  	jQuery('#section-ml_slider_'+value+'_post').show();
  	jQuery('#section-ml_slider_'+value+'_pages, #section-ml_slider_'+value+'_categories, #section-ml_slider_'+value+'_custom_link').hide();
  }
  if(jQuery('#ml_slider_'+value+'_link option:selected').val() == '2') {
  	jQuery('#section-ml_slider_'+value+'_pages').show();
  	jQuery('#section-ml_slider_'+value+'_post, #section-ml_slider_'+value+'_categories, #section-ml_slider_'+value+'_custom_link').hide();
  }
  if(jQuery('#ml_slider_'+value+'_link option:selected').val() == '3') {
  	jQuery('#section-ml_slider_'+value+'_categories').show();
  	jQuery('#section-ml_slider_'+value+'_post, #section-ml_slider_'+value+'_pages, #section-ml_slider_'+value+'_custom_link').hide();
  }
  if(jQuery('#ml_slider_'+value+'_link option:selected').val() == '4') {
  	jQuery('#section-ml_slider_'+value+'_custom_link').show();
  	jQuery('#section-ml_slider_'+value+'_post, #section-ml_slider_'+value+'_pages, #section-ml_slider_'+value+'_categories').hide();
  }
});});


	
</script>

<style type="text/css">
	.h-green h3 {
		color: #6ca712;
	}
	.h-red h3 {
		color: #db0000;
	}
	.h-blue h3 {
		color: #1280b2;
	}
	.h-yellow h3 {
		color: #d79e13;
	}
	.h-grey h3 {
		color: #444;
	}
	.h-pink h3 {
		color: #9724b1;
	}
	.notes {
		background-color: lightYellow;
		border: 1px solid #E6DB55;
		border-radius: 4px;
			-webkit-border-radius: 4px;
			-moz-border-radius: 4px;
		padding: 0 1em;
		width: 100%;
	}
</style>
<?php }


add_action('optionsframework_custom_scripts', 'optionsframework_custom_scripts');


?>