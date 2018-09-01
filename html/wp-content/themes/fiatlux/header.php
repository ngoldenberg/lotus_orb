<?php

$google_font_link = of_get_option("ml_google_font_link","<link href='http://fonts.googleapis.com/css?family=Open+Sans+Condensed:300&v2' rel='stylesheet' type='text/css'>");

?>
<!doctype html>
<!-- paulirish.com/2008/conditional-stylesheets-vs-css-hacks-answer-neither/ -->
<!--[if lt IE 7]> <html class="no-js ie6" lang="en"> <![endif]-->
<!--[if IE 7]>    <html class="no-js ie7" lang="en"> <![endif]-->
<!--[if IE 8]>    <html class="no-js ie8" lang="en"> <![endif]-->
<!--[if gt IE 8]><!-->  <html class="no-js" lang="en"> <!--<![endif]-->
<html <?php language_attributes(); ?>>
<head>
	<!-- GOOGLE ANALYTICS -->
<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-66078679-1', 'auto');
  ga('send', 'pageview');

</script>
	<!-- Fin de Google Analytics -->
	
<link href='http://fonts.googleapis.com/css?family=Open+Sans:700,600,400' rel='stylesheet' type='text/css'>
	<meta charset="UTF-8">
	
	<title><?php wp_title('-', true, 'right'); ?><?php bloginfo('name'); ?></title>

	
	
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	
	<?php
	/* get the favicon */
	if (of_get_option('ml_icon_favicon'))
	{ ?>
		<link rel="shortcut icon" href="<?php echo of_get_option('ml_icon_favicon'); ?>">
	<?php } ?>

	<?php
	/* get the mobile icon */
	if (of_get_option('ml_mobile_icon_favicon'))
	{ ?>
		<link rel="apple-touch-icon" href="<?php echo of_get_option('ml_mobile_icon_favicon'); ?>">
	<?php } ?>
	
	<?php /*--- CSS ---*/ ?>
<link rel="stylesheet" type="text/css" href="<?php echo get_template_directory_uri(); ?>/css/jplayer.css" media="all" />
	<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/prettyPhoto.css">
	<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/supersized.css">
	<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/nivo-slider.css">
	<?php echo $google_font_link; ?>
	<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/style.css?v=2">
	<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/custom_options.css.php">
	<link rel="stylesheet" media="handheld" href="<?php echo get_template_directory_uri(); ?>/css/handheld.css?v=2">

	<!--[if lt IE 9]>
	<script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
	<![endif]-->

	<?php wp_head(); ?>
	<script type="text/javascript">
	<?php if(!is_page_template('template-home_video.php')) { ?>
	jQuery(document).ready(function() { 
		jQuery('ul.sf-menu').superfish({ 
	    delay:       500,                            // one second delay on mouseout 
	    animation:   {opacity:'show',height:'show'},  // fade-in and slide-down animation 
	    speed:       400,                          // faster animation speed 
	    autoArrows:  false,                           // disable generation of arrow mark-up 
	    dropShadows: false                            // disable drop shadows 
		}); 
	});
	<?php } else { ?>
	jQuery(document).ready(function() { 
		jQuery('ul.sf-menu').superfish({ 
	    delay:       500,                            // one second delay on mouseout 
	    animation:   {opacity:'',height:'show'},  // fade-in and slide-down animation 
	    speed:       0,                          // faster animation speed 
	    autoArrows:  false,                           // disable generation of arrow mark-up 
	    dropShadows: false                            // disable drop shadows 
		}); 
	});
	<?php } ?>
	</script>
	
	
	<!--Start of Zopim Live Chat Script-->
<script type="text/javascript">
window.$zopim||(function(d,s){var z=$zopim=function(c){z._.push(c)},$=z.s=
d.createElement(s),e=d.getElementsByTagName(s)[0];z.set=function(o){z.set.
_.push(o)};z._=[];z.set._=[];$.async=!0;$.setAttribute("charset","utf-8");
$.src="//v2.zopim.com/?34vUP41oJGFoMDQh35KX07KyFkZF8PCg";z.t=+new Date;$.
type="text/javascript";e.parentNode.insertBefore($,e)})(document,"script");
</script>
<!--End of Zopim Live Chat Script-->
	
</head>
<body <?php body_class(); ?>>
	<!--BEGIN Header-->
	<header id="header" class="ml_menu_top">
		
		<div class="ml_header_bg">
		<div class="ml_wrapper">
	
			<!--BEGIN menu-->
			<section id="ml_menu">
				<?php 
				/* Custom menu (Main Menu) */
				if ( has_nav_menu( 'main-menu' ) )
				{ ?>
				<?php wp_nav_menu( array( 'theme_location' => 'main-menu', 'container' => false,  'menu_class' => 'sf-menu ml_hide' ) ); ?>
				<?php } 
				
				/* dont'have a custom menu? so, list the WP Pages :( */
				else { ?>
					<?php
						/* the theme menu options */
						$exclude_items = '';
						if(of_get_option('ml_menu_exclude') && get_pages()) {
							$all_pages = of_get_option('ml_menu_exclude');
							$exclude_items = implode(',',array_keys($all_pages, 1));
						} else {
							$exclude_items = '';
						}
						
						$main_menu_order = of_get_option('ml_menu_order_by');
					?>
					<ul class="sf-menu">
						<li class="page_item page-item-home"><a href="<?php echo home_url(); ?>"><?php _e('Home', 'meydjer'); ?></a></li>
					  <?php wp_list_pages( array( 'exclude' => $exclude_items, 'title_li' => '', 'sort_column' => $main_menu_order)); ?>
				  </ul>
			<?php } ?>
			</section>
			<!--END menu-->
						
		</div>
		</div>

		<div class="ml_wrapper">
			<section id="ml_logo">
				<a href="<?php echo home_url(); ?>" class="ml_logo_a">
					<?php
					/* text logo */
					if (of_get_option('ml_logo_text_or_image') == "text") { ?>
						<h1 class="text_logo"><?php echo of_get_option('ml_logo_text'); ?></h1>
						<?php if(of_get_option('ml_logo_text_sub')) { ?>
							<span class="text_logo_sub"><?php echo of_get_option('ml_logo_text_sub'); ?></span>
						<?php } ?>
					<?php }
			
					/* custom logo image */
					elseif (of_get_option('ml_logo_image')) { ?>
						<img src="<?php echo of_get_option('ml_logo_image'); ?>" alt="<?php bloginfo('name'); ?> - <?php bloginfo('description'); ?>" />
					<?php }
					
					/* no logo? so, get the themes's logo */
					else { ?>
						<img src="<?php echo get_template_directory_uri(); ?>/images/fiat_lux-logo.gif" alt="FIAT LUX" />
					<?php } ?>
				</a>
			</section>
		</div>
	</header>
	<!--END Header-->	
