<?php

/**
 * Handles the WordPress 4.2 Term Splitting:
 * https://make.wordpress.org/core/2015/02/16/taxonomy-term-splitting-in-4-2-a-developer-guide/
 */
class PexetoTermSplitting{

	public function __construct(){

		add_action( 'split_shared_term', array($this, 'split_shared_term'), 10, 4 );
	}

	public function split_shared_term($old_term_id, $new_term_id, $term_taxonomy_id, $taxonomy){

		switch ($taxonomy) {
			case PEXETO_NIVOSLIDER_POSTTYPE.'_category':
				$this->update_header_sliders_ids($old_term_id, $new_term_id, $term_taxonomy_id, $taxonomy, PEXETO_NIVOSLIDER_POSTTYPE);
				break;

			case PEXETO_CONTENTSLIDER_POSTTYPE.'_category':
				$this->update_header_sliders_ids($old_term_id, $new_term_id, $term_taxonomy_id, $taxonomy, PEXETO_CONTENTSLIDER_POSTTYPE);
				break;

			case 'category':
				$this->update_cats_string($old_term_id, $new_term_id, 'pexeto_exclude_cats', 'template-blog.php');
				break;

			case 'portfolio_category':
				$this->update_cats_string($old_term_id, $new_term_id, 'pexeto_pg_filter_cats_cats', 'template-portfolio-gallery.php');
				break;
		}

	}

	protected function update_header_sliders_ids($old_term_id, $new_term_id, $term_taxonomy_id, $taxonomy, $post_type){
		$meta_key = 'pexeto_slider';

		$pages = get_pages(array(
			'meta_key'=>$meta_key,
			'meta_value'=>$post_type.':'.$old_term_id
			));
		
		if(sizeof($pages)>0){
			$new_meta_value = $post_type.':'.$new_term_id;
			foreach ($pages as $page) {
				update_post_meta($page->ID, $meta_key, $new_meta_value);
			}
		}
	}

	protected function update_cats_string($old_term_id, $new_term_id, $meta_key, $page_template){
		$pages = get_pages(array(
			'meta_key' => '_wp_page_template',
			'meta_value' => $page_template
		));

		if(sizeof($pages)>0){
			foreach ($pages as $page) {
				$cats_string = get_post_meta($page->ID, $meta_key, true);
				if(!empty($cats_string)){
					$cats = explode(',', $cats_string);
					$index = array_search($old_term_id, $cats);
					if($index !== false){
						$cats[$index] = $new_term_id;
						$new_cats_string = implode(',', $cats);
						update_post_meta($page->ID, $meta_key, $new_cats_string);
					}
				}
			}
		}
	}

}


new PexetoTermSplitting();

