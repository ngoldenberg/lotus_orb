<?php
/* Sidebars (Widget Areas) */
register_sidebar( array(
	'name'          => __('General', 'meydjer'),
	'id'            => 'general',
	'description'   => __('Widgets that will appear in every page/post/portfolio', 'meydjer'),
	'before_widget' => '<li id="%1$s" class="widget %2$s">',
	'after_widget'  => '</li>',
	'before_title'  => '<h3 class="widgettitle">',
	'after_title'   => '</h3>'
) );
register_sidebar( array(
	'name'          => __('For All Categories', 'meydjer'),
	'id'            => 'all-categories',
	'description'   => __('Widgets that will appear in every page', 'meydjer'),
	'before_widget' => '<li id="%1$s" class="widget %2$s">',
	'after_widget'  => '</li>',
	'before_title'  => '<h3 class="widgettitle">',
	'after_title'   => '</h3>'
) );
register_sidebar( array(
	'name'          => __('For All Pages', 'meydjer'),
	'id'            => 'all-pages',
	'description'   => __('Widgets that will appear in every page', 'meydjer'),
	'before_widget' => '<li id="%1$s" class="widget %2$s">',
	'after_widget'  => '</li>',
	'before_title'  => '<h3 class="widgettitle">',
	'after_title'   => '</h3>'
) );

/*--- Footer Widget Areas ---*/
/* get the columns number defined on theme options panel */
$footer_col = of_get_option('ml_footer_columns');

/* Generate Footer Widget areas based on $footer_col (above) */
if($footer_col >= '1') {
	register_sidebar( array(
		'name'          => __('Footer - One', 'meydjer'),
		'id'            => 'footer-one',
		'description'   => __('Widgets that will appear in footer first column.', 'meydjer'),
		'before_widget' => '<li id="%1$s" class="widget %2$s">',
		'after_widget'  => '</li>',
		'before_title'  => '<h3 class="widgettitle">',
		'after_title'   => '</h3>'
	) );
}
if($footer_col >= '2') {
	register_sidebar( array(
		'name'          => __('Footer - Two', 'meydjer'),
		'id'            => 'footer-two',
		'description'   => __('Widgets that will appear in footer second column.', 'meydjer'),
		'before_widget' => '<li id="%1$s" class="widget %2$s">',
		'after_widget'  => '</li>',
		'before_title'  => '<h3 class="widgettitle">',
		'after_title'   => '</h3>'
	) );
}
if($footer_col >= '3') {
	register_sidebar( array(
		'name'          => __('Footer - Three', 'meydjer'),
		'id'            => 'footer-three',
		'description'   => __('Widgets that will appear in footer third column.', 'meydjer'),
		'before_widget' => '<li id="%1$s" class="widget %2$s">',
		'after_widget'  => '</li>',
		'before_title'  => '<h3 class="widgettitle">',
		'after_title'   => '</h3>'
	) );
}
if($footer_col == '4') {
	register_sidebar( array(
		'name'          => __('Footer - Four', 'meydjer'),
		'id'            => 'footer-four',
		'description'   => __('Widgets that will appear in footer fourth column.', 'meydjer'),
		'before_widget' => '<li id="%1$s" class="widget %2$s">',
		'after_widget'  => '</li>',
		'before_title'  => '<h3 class="widgettitle">',
		'after_title'   => '</h3>'
	) );
}

/*--- Extra Sidebars in EACH Category ---*/
/* only if enabled in theme options panel */
if (of_get_option('ml_widget_for_categories') == '1') {
	$sidebar_categories = array();  
	$sidebar_categories_obj = get_categories();
	foreach ($sidebar_categories_obj as $category) {
		$cat_name = $category->cat_name;
		$cat_id = sanitize_title($category->cat_name);
		$cat_id = strtolower($cat_id);
		$cat_id = str_replace(" ","-",$cat_id);
		register_sidebar( array(
			'name'          => __('Category - '.$cat_name, 'meydjer'),
			'id'            => 'category-'.$cat_id,
			'description'   => sprintf(__('Widgets that will appear in the "%s" category.', 'meydjer'), $cat_name),
			'before_widget' => '<li id="%1$s" class="widget %2$s">',
			'after_widget'  => '</li>',
			'before_title'  => '<h3 class="widgettitle">',
			'after_title'   => '</h3>'
		) );
	}
}

/*--- Extra Sidebars in EACH Page ---*/
/* only if enabled in theme options panel */
if (of_get_option('ml_widget_for_pages') == '1') {
	$sidebar_pages = array();  
	$sidebar_pages_obj = get_pages();
	foreach ($sidebar_pages_obj as $page) {
	 	$page_title = $page->post_title;
		$page_id = sanitize_title($page->post_title);
		$page_id = strtolower($page_id);
		$page_id = str_replace(" ","-",$page_id);
		register_sidebar( array(
			'name'          => __('Page - '.$page_title, 'meydjer'),
			'id'            => 'page-'.$page_id,
			'description'   => sprintf(__('Widgets that will appear in the "%s" page.', 'meydjer'), $page_title),
			'before_widget' => '<li id="%1$s" class="widget %2$s">',
			'after_widget'  => '</li>',
			'before_title'  => '<h3 class="widgettitle">',
			'after_title'   => '</h3>'
		) );
	}
}
?>