<?php 
//Make it a CSS file
header("Content-type: text/css");
if(file_exists('../../../../wp-load.php')) {
	include '../../../../wp-load.php';
}
else {
	include '../../../../../wp-load.php';
}

$primary_color = of_get_option('ml_primary_color','#ffffff');

$box_opacity = of_get_option('ml_box_opacity') / 100;
$secondary_color = of_get_option('ml_secondary_color','#000000');
$secondary_color_rgb = HexToRGB($secondary_color);
$secondary_color_rgba = 'rgba('.$secondary_color_rgb['r'].','.$secondary_color_rgb['g'].','.$secondary_color_rgb['b'].','.$box_opacity.')';

$text_color = of_get_option('ml_text_color','#ffffff');


$text_logo = of_get_option('ml_text_logo_style');

if ((of_get_option('ml_logo_text_or_image') == 'image') && (of_get_option('ml_logo_image'))) {	$logo_height = getimagesize(of_get_option('ml_logo_image'));
	$logo_height = $logo_height[1];
}

$google_font_css_key = of_get_option('ml_google_font_css_key','Open Sans Condensed');
$google_font_text_transform = of_get_option('ml_google_font_text_transform','uppercase');

?>
/*-------------------------------------------------*/
/*	Primary Color
/*-------------------------------------------------*/
::-moz-selection{
	background: <?php echo $primary_color; ?>;
}
::selection {
	background: <?php echo $primary_color; ?>;
}
a,
h1, h2, h3, h4, h5, h6,
.sf-menu li a,
.sf-menu > li.current-menu-item > a,
.sf-menu > li.current-menu-ancestor > a,
.sf-menu > li.current-menu-parent > a,
.ml_minimize,
.ml_minimize a span,
.nav-next a:hover,
.nav-prev a:hover,
a .ml_content_title:hover,
.widgettitle,
button:hover,
.button:hover,
.wpcf7-submit:hover,
.comment-reply-link:hover,
.ml_post-title h2,
.ul-portfolio-categories a,
.input-text:hover,
.wpcf7-text:hover,
textarea:hover,
.input-text:focus,
.wpcf7-text:focus,
textarea:focus,
#searchform .input-text,
#searchform .input-submit,
#slidecaption,
.widget_calendar div table td a:hover,
#posts-combo .ui-tabs-nav li a,
#posts-combo .combo-list li h6,
.ml_ui_tabs.shortcode > ul > li > a,
.ml_toggle > h3 > a,
#posts-combo > h3 > a,
blockquote,
.ml_post_content.status .ml_post_format p,
.ml_quote_author,
.ml_post_content.chat .ml_chat_text {
	color: <?php echo $primary_color; ?>;
}
.sf-menu > li > a:hover,
.sf-menu > li.sfHover > a,
.sf-menu ul li:hover,
.sf-menu ul li.sfHover,
.nav-next a,
.nav-prev a,
.post-title,
button,
.button,
.wpcf7-submit,
.comment-reply-link,
.ul-portfolio-categories li.selected a,
.ul-portfolio-categories a:hover,
#searchform .input-text:focus,
#searchform .input-submit:hover,
.widget_archive ul li a:hover,
.widget_nav_menu div ul li a:hover,
.widget_pages ul li a:hover,
.widget_links ul li a:hover,
.widget_categories ul li a:hover,
.widget_meta ul li a:hover,
.widget_recent_entries ul li a:hover,
.widget_rss ul li a:hover,
.widget_calendar div table td a,
#posts-combo .ui-tabs-nav .ui-state-active a,
#posts-combo .ui-tabs-nav li a:hover,
#posts-combo .combo-list li a:hover,
#posts-combo-tags a:hover,
.jp-play-bar,
.jp-volume-bar-value,
.ml_ui_tabs.shortcode > ul > li > a:hover,
.ml_ui_tabs.shortcode > ul > li.ui-state-active > a,
.ml_toggle > h3:hover,
.ml_toggle > h3.ml_toggle_active,
.ml_toggle > h3.ml_toggle_active > a,
.ml_multitple_columns .ml_post-title h2:hover,
#posts-combo > h3:hover {
	background-color: <?php echo $primary_color; ?>;
}
h1, h2, h3, h4, h5, h6,
.sf-menu > li.current-menu-item > a,
.sf-menu > li.current-menu-ancestor > a,
.sf-menu > li.current-menu-parent > a,
.sf-menu > li.current_page_parent > a,
.sf-menu > li.current_page_ancestor > a.ml_minimize,
.sf-menu ul li a,
.ml_minimize,
.wp-caption,
.featured-image,
#slidecaption,
#thumb-list li.current-thumb img,
#thumb-list li img:hover,
.widgettitle,
.ml_thumb_aligner,
.ul-portfolio-categories a,
.comment_box,
.children .comment_box,
.input-text,
.wpcf7-text,
textarea,
#searchform:hover,
#ml_pictures .featured-image:hover,
.post-info,
.widget_archive ul li a ,
.widget_nav_menu div ul li a,
.widget_pages ul li a,
.widget_recent_comments ul li,
.widget_links ul li a,
.widget_categories ul li a,
.widget_meta ul li a,
.widget_recent_entries ul li a,
.widget_rss ul li a,
.widget_calendar div table th,
.widget_calendar div table td,
#posts-combo .ui-tabs-nav li a,
.posts-combo-border,
.jp-interface,
.jp-seek-bar,
.jp-volume-bar,
.jp-controls.play,
.jp-controls.volume,
.jp-jplayer-video,
.nivo-controlNav a.active,
.nivo-controlNav a:hover,
blockquote,
.quote_align_right blockquote,
.ml_post_content.status .ml_post_format p,
.ml_quote_author,
.quote_align_right .ml_quote_author,
.ml_post_content.chat .ml_chat_text,
.ml_ui_tabs_contents,
.ml_ui_tabs.shortcode > ul > li > a,
.ml_toggle > h3,
.ml_toggle > div,
#ml_slider_nav,
.ml_music_ctrl,
#posts-combo > h3,
#posts-combo > div,
button,
.button,
.wpcf7-submit,
.comment-reply-link,
#ml_jflickrfeed li a:hover {
	border-color: <?php echo $primary_color; ?>;
}
.ml_nivo-slider,
.single.ml_nivo-slider:hover {
	border-color: <?php echo $primary_color; ?> !important;
}

/*-------------------------------------------------*/
/*	Secondary Color
/*-------------------------------------------------*/
::-moz-selection{
	color: <?php echo $secondary_color; ?>;
}
::selection {
	color: <?php echo $secondary_color; ?>;
}
::-webkit-input-placeholder {
	color: <?php echo $secondary_color; ?>;
}
:-moz-placeholder {
	color: <?php echo $secondary_color; ?>;
}
.sf-menu > li > a:hover,
.sf-menu > li.sfHover > a,
.sf-menu ul li:hover > a,
.sf-menu ul li.sfHover > a,
.nav-next a,
.nav-prev a,
.post-title,
button,
.button,
.wpcf7-submit,
.comment-reply-link,
.ul-portfolio-categories li.selected a,
.ul-portfolio-categories a:hover,
.input-text,
.wpcf7-text,
textarea,
#searchform .input-text:focus,
#searchform .input-submit:hover,
.widget_archive ul li a:hover,
.widget_nav_menu div ul li a:hover,
.widget_pages ul li a:hover,
.widget_links ul li a:hover,
.widget_categories ul li a:hover,
.widget_meta ul li a:hover,
.widget_recent_entries ul li a:hover,
.widget_calendar div table td a,
#posts-combo .ui-tabs-nav .ui-state-active a,
#posts-combo .ui-tabs-nav li a:hover,
#posts-combo .combo-list li a:hover,
#posts-combo .combo-list li a:hover h6,
#posts-combo-tags a:hover,
.ml_ui_tabs.shortcode > ul > li > a:hover,
.ml_ui_tabs.shortcode > ul > li.ui-state-active > a,
.ml_toggle > h3:hover > a,
.ml_toggle > h3.ml_toggle_active > a,
.ml_multitple_columns .ml_post-title h2:hover,
#posts-combo > h3:hover > a {
	color: <?php echo $secondary_color; ?>;
}
body,
.ml_header_bg,
.sf-menu ul,
.ml_minimize,
.ml_content_inside,
.nav-next a:hover,
.nav-prev a:hover,
a .ml_content_title:hover,
#ml_sidebar > ul > li,
.ml_boxed,
.widget,
.ul-portfolio-categories,
button:hover,
.button:hover,
.wpcf7-submit:hover,
.comment-reply-link:hover,
.input-text:hover,
.wpcf7-text:hover,
textarea:hover,
.input-text:focus,
.wpcf7-text:focus,
textarea:focus,
#searchform .input-text,
#searchform .input-submit,
.widget_calendar div table td a:hover,
#posts-combo .ui-tabs-nav li a,
.jp-interface,
.jp-seek-bar,
.jp-volume-bar,
.ml_ui_tabs_contents,
.ml_ui_tabs.shortcode > ul > li > a,
.ml_toggle > h3,
.ml_toggle > div,
#slidecaption,
#posts-combo > div,
#ml_jflickrfeed li a {
	background-color: <?php echo $secondary_color; ?>;
}
.ml_header_bg,
.sf-menu ul,
.ml_content_inside,
#ml_sidebar > ul > li,
.ml_boxed,
.widget,
.ul-portfolio-categories,
.ul-portfolio-categories a,
#slidecaption,
#posts-combo > h3 {
	background-color: <?php echo $secondary_color_rgba; ?>;
}
.featured-image:hover,
#ml_slider_nav img:hover,
#jp_interface_1 a img:hover,
#thumb-list li img,
#searchform,
#ml_pictures .featured-image,
#posts-combo .combo-list a:hover img,
.nivo-controlNav a,
.nav-next a,
.nav-prev a,
.ml_one_full .ml_post-title h2:hover {
	border-color: <?php echo $secondary_color; ?>;
}
.ml_nivo-slider:hover {
	border-color: <?php echo $secondary_color; ?> !important;
}


/*-------------------------------------------------*/
/*	Text Color
/*-------------------------------------------------*/
body,
.comment-author,
.comment-author a {
	color: <?php echo $text_color; ?>;
}
.input-text,
.wpcf7-text,
textarea,
pre, code, kbd, samp {
	border-color: rgba(85, 72, 72, 0.76);
}
.input-text,
.wpcf7-text,
textarea {
	background-color: rgba(148, 144, 144, 0.31);
}



/*-------------------------------------------------*/
/*	Text Logo
/*-------------------------------------------------*/
.ml_logo_a .text_logo {
	color: <?php echo $text_logo['color']; ?>;
	font-size: <?php echo $text_logo['size']; ?>;
}


/*-------------------------------------------------*/
/*	Sidebar Position
/*-------------------------------------------------*/
<?php if(of_get_option('ml_sidebar_position') == 'sidebar_left') { ?>
#ml_all_content {
	float: right;
}
#ml_sidebar {
	float: left;
}
<?php } ?>


/*-------------------------------------------------*/
/*	Header Height
/*-------------------------------------------------*/
<?php if ((of_get_option('ml_logo_text_or_image') == 'image') && (of_get_option('ml_logo_image'))) { ?>
/* logo height = <?php echo $logo_height; ?>px */
.ml_logo_a img {
	margin-top: -<?php echo $logo_height; ?>px;
}
.sf-menu li a {
	height: <?php echo $logo_height; ?>px;
}
.sf-menu li a,
.sf-menu > li.current-menu-item > a {
	line-height: <?php echo $logo_height; ?>px;
}
.sf-menu > li.current-menu-item > a {
	height: <?php echo $logo_height - 10; ?>px; /*total height minus 10px of border-bottom*/
}
.sf-menu ul {
	top: <?php echo $logo_height; ?>px;
}
header #ml_logo .ml_logo_arrow {
	margin-top: -<?php echo ((($logo_height - 40) / 2) + 40); ?>px;
}



<?php } ?>


/*-------------------------------------------------*/
/*	Google Font
/*-------------------------------------------------*/
.sf-menu li a,
.nav-next a,
.nav-prev a,
.comment-author,
.comment-author a,
button,
.button,
.wpcf7-submit,
.comment-reply-link,
h1, h2, h3, h4, h5, h6,
#slidecaption,
.ul-portfolio-categories a,
#posts-combo .ui-tabs-nav li a,
.widget_calendar div table caption,
.ml_ui_tabs.shortcode > ul > li > a {
	font-family: '<?php echo $google_font_css_key; ?>', Helvetica, Arial, Clean, sans-serif;
	text-transform: <?php echo $google_font_text_transform; ?>;
}

/*-------------------------------------------------*/
/*	Custom CSS
/*-------------------------------------------------*/
<?php echo of_get_option('ml_custom_css'); ?>















#post-646 .ml_column {
	background: transparent url(../images/ml_chess_bg.png) !important;
	text-align: center !important;
	margin-bottom: 40px !important;
}
