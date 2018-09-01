<?php
$primary_color = of_get_option('ml_primary_color','#ffffff');
$secondary_color = of_get_option('ml_secondary_color','#000000');


/*-------------------------------------------------*/
/*	Add Shortcodes Button
/*-------------------------------------------------*/

/* button function */
function ml_add_shortcode_button() {
 
   if ( ! current_user_can('edit_posts') && ! current_user_can('edit_pages') ) {
     return;
   }
 
   if ( get_user_option('rich_editing') == 'true' ) {
     add_filter( 'mce_external_plugins', 'add_plugin' );
     add_filter( 'mce_buttons', 'register_button' );
   }
 
}

add_action('init', 'ml_add_shortcode_button');

/* register button */
function register_button( $buttons ) {
 array_push( $buttons, "|", "ml_add_shortcode_button" );
 return $buttons;
}

/* register TinyMCE plugin */
function add_plugin( $plugin_array ) {
   $plugin_array['ml_add_shortcode_button'] = get_template_directory_uri() . '/js/add_shortcode.js.php';
   return $plugin_array;
}





/*
    // ========================================== \\
   ||                                              ||
   ||                  Shortcodes									 ||
   ||                                              ||
    \\ ========================================== //
*/

/*--- Code ---*/
function ml_shortcode_code( $atts, $content ) {

	$out = '<code>' . $content . '</code>';

	return $out;

}

add_shortcode('ml_code', 'ml_shortcode_code');


/*--- Clearfix ---*/
function ml_shortcode_clearfix() {
    return '<div class="clearfix"></div>';
} 
add_shortcode('ml_clearfix', 'ml_shortcode_clearfix');


/*--- Dropcaps ---*/
function ml_shortcode_dropcap( $atts, $content ) {

    extract(shortcode_atts(array(

        'color'      => '',
        'background_color'      => ''

    ), $atts));

	$out = '<span class="ml_dropcap" style="color:'.$color.';background-color:'.$background_color.';">'.do_shortcode($content).'</span>';

	return $out;

}

add_shortcode('ml_dropcap', 'ml_shortcode_dropcap');


/*--- Quote ---*/
function ml_shortcode_quote( $atts, $content ) {

    extract(shortcode_atts(array(

        'author'      => NULL,
        'align'      => NULL

    ), $atts));
	
	//if is aligned
	$quote_align = NULL;

	if($align == 'left') {
		$quote_align = ' quote_align_left';
	}

	else if($align == 'right') {
		$quote_align = ' quote_align_right';
	}

	else {
		$quote_align = NULL;
	}
	

	//have author
	if($author){
	$out = '<div class="ml_quote_wrapper with_author'.$quote_align.'"><blockquote>'.do_shortcode($content).'</blockquote>'.
				 '<div class="ml_quote_author">'.$author.'</div></div>';
	}

	//don't have author
	else {
	$out = '<div class="ml_quote_wrapper'.$quote_align.'"><blockquote>'.do_shortcode($content).'</blockquote></div>';
	}

  return $out;

}

add_shortcode('ml_quote', 'ml_shortcode_quote');


/*--- Highlight ---*/
function ml_shortcode_highlight( $atts, $content ) {

    extract(shortcode_atts(array(

        'color'      => '',
        'background_color'      => ''

    ), $atts));

	$out = '<span style="color:'.$color.';background-color:'.$background_color.';">'.do_shortcode($content).'</span>';

	return $out;

}

add_shortcode('ml_highlight', 'ml_shortcode_highlight');


/*--- Columns ---*/
function ml_shortcode_column( $atts, $content ) {

    extract(shortcode_atts(array(

        'width'      => '',
        'last'      => ''

    ), $atts));
  
  if(($last == 'true') || ($last == 'yes') || ($last == 'last')) {
  	$last_column = ' last';
  }
  else {
  	$last_column = '';
  }

	$out = '<div class="ml_column '.$width.$last_column.'">'.
				 do_shortcode($content).
				 '</div>';

	return $out;

}

add_shortcode('ml_column', 'ml_shortcode_column');


/*--- Allerts ---*/
function ml_shortcode_alert( $atts, $content ) {

    extract(shortcode_atts(array(

        'size'     					=> '',
        'color'      				=> '',
        'background_color'	=> ''

    ), $atts));

	$alert_id = 'alert-id-'.sanitize_title($content);

	$out =	'<style type="text/css">'.

					'#'.$alert_id.'{'.
						'background-color:'.$background_color.';'.
						'border-color:'.$color.';'.
						'color:'.$color.';'.
						'font-size:'.$size.'px;'.
					'}'.

					'</style>'.


					'<div class="ml_alert" id="'.$alert_id.'">'.
					$content.
					'</div>';

	return $out;

}

add_shortcode('ml_alert', 'ml_shortcode_alert');


/*--- Buttons ---*/
function ml_shortcode_button( $atts, $content ) {

    extract(shortcode_atts(array(

        'url'      					=> '',
        'target'   					=> '',
        'size'     					=> '',
        'color'      				=> '',
        'background_color'	=> ''

    ), $atts));

	$button_id = 'button-id-'.sanitize_title($content);

	$out =	'<style type="text/css">'.

					'#'.$button_id.'{'.
						'background-color:'.$background_color.';'.
						'border-color:'.$background_color.';'.
						'color:'.$color.';'.
						'font-size:'.$size.'px;'.
					'}'.

					'#'.$button_id.':hover{'.
						'background-color:'.$color.';'.
						'color:'.$background_color.';'.
					'}'.

					'</style>'.


					'<a href="'.$url.'" target="'.$target.'" class="button" id="'.$button_id.'">'.
					$content.
					'</a>';

	return $out;

}

add_shortcode('ml_button', 'ml_shortcode_button');


/*--- Tabs ---*/
function ml_shortcode_tabsgroup( $atts, $content ){

	wp_enqueue_script('jquery-ui-tabs');

	$GLOBALS['tab_count'] = 1;

	do_shortcode( $content );

	if( is_array( $GLOBALS['tabs'] ) ){
		
		foreach( $GLOBALS['tabs'] as $tabNum => $tab ){

			$tabs[] = '<li><a href="#' . $tab['anchor'] . '" rel="nofollow">' . $tab['title'] . '</a></li>';

		}

		foreach( $GLOBALS['tabs'] as $tabNum => $tab ){

			$panes[] = '<div id="ml_tab_id-'.$tabNum.'">' . $tab['content'] . '</div>';

		}

		$return =	'<div class="ml_ui_tabs shortcode">'.
		
		"\n" . '<ul>' . implode( "\n", $tabs ) . '</ul>' .
		
		'<div class="ml_ui_tabs_contents">'.
		
		"\n" . implode( "\n", $panes) .'' .

		"\n" . '</div>'.
		
		'</div>';

	}

	return $return;

}


function ml_shortcode_tab( $atts, $content ){

	extract(shortcode_atts(array('title' => '%d', 'anchor' => 'ml_tab_id-%d'), $atts));
	
	$curTab = $GLOBALS['tab_count'];
	
	$GLOBALS['tabs'][$curTab] = array( 'title' => sprintf( $title, $curTab ), 'anchor' => sprintf( $anchor, $curTab ), 'content' => $content );
	
	$GLOBALS['tab_count']++;

}

add_shortcode('ml_tabsgroup', 'ml_shortcode_tabsgroup');
add_shortcode('ml_tab', 'ml_shortcode_tab');




/*--- Toggles ---*/

function ml_shortcode_togglesgroup( $atts, $content ){

  extract(shortcode_atts(array(

      'one_visible_allowed'		=> '',
      'open_first'			=> ''

  ), $atts));
	
	if(($one_visible_allowed == 'true')
	|| ($one_visible_allowed == 'yes')
	|| ($one_visible_allowed == 'one') 
	|| ($one_visible_allowed == 'allowed')
	|| ($one_visible_allowed == 'visible')) {
		$one_allowed = ' one_allowed';
	}
	else {
		$one_allowed = '';
	}
			
	if(($open_first == 'true')
	|| ($open_first == 'yes')
	|| ($open_first == 'one') 
	|| ($open_first == 'open')
	|| ($open_first == 'visible')) {
		$toggle_first = ' toggle_first';
	}
	else {
		$toggle_first = '';
	}
			
	wp_enqueue_script('jquery-ui');

	$GLOBALS['toggle_count'] = 1;

	do_shortcode( $content );

	if( is_array( $GLOBALS['toggles'] ) ){
		
		foreach( $GLOBALS['toggles'] as $toggleNum => $toggle ){

			$toggles[] = '<h3><a href="#' . $toggle['anchor'] . '" rel="nofollow">' . '<span>+</span> ' . $toggle['title'] . '</a></h3><div id="ml_toggle_id-'.$toggleNum.'">' . $toggle['content'] . '</div>';

		}

		$return =	'<div class="ml_toggle'.$one_allowed.$toggle_first.'">'.
		
		"\n" . implode( "\n", $toggles ) .

		'</div>';

	}

	return $return;

}


function ml_shortcode_toggle( $atts, $content ){
	
	extract(shortcode_atts(array('title' => '%d', 'anchor' => 'ml_toggle_id-%d'), $atts));
	
	$curtoggle = $GLOBALS['toggle_count'];
	
	$GLOBALS['toggles'][$curtoggle] = array( 'title' => sprintf( $title, $curtoggle ), 'anchor' => sprintf( $anchor, $curtoggle ), 'content' => $content );
	
	$GLOBALS['toggle_count']++;

}

add_shortcode('ml_togglesgroup', 'ml_shortcode_togglesgroup');
add_shortcode('ml_toggle', 'ml_shortcode_toggle');

?>