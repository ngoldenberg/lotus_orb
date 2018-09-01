<?php
/*
Plugin Name: Story Portfolio Items
Description: Loads the portfolio posts from a selected category
Version: 1.0
Author: Pexeto
Author URI: http://pexetothemes.com
*/


/**
 * Adds Portfolio Items Widget
 */
class Story_Portfolio_Items extends WP_Widget {

	private $theme_name = 'Story';
	private $prefix = 'story_';

	/**
	 * Register widget with WordPress.
	 */
	public function __construct() {
		parent::__construct(
	 		$this->prefix.'portfolio_items', // Base ID
			$this->theme_name.' Portfolio Items', // Name
			array( 'description' => __( 'Portfolio Items Widget', 'pexeto' ), ) // Args
		);
	}

	/**
	 * Front-end display of widget.
	 *
	 * @see WP_Widget::widget()
	 *
	 * @param array $args     Widget arguments.
	 * @param array $instance Saved values from database.
	 */
	public function widget( $args, $instance ) {
		extract( $args );
		$title = apply_filters( 'widget_title', $instance['title'] );

		echo $before_widget;
		if ( ! empty( $title ) ){
			echo $before_title . $title . $after_title;
		}
		$this->print_widget_body($instance);
		echo $after_widget;
	}

	private function print_widget_body($instance){
		$number = isset($instance['item_num']) ? intval($instance['item_num']) : 8;
		$cat_id = $instance['category'];
			
			$args= array(
		         'posts_per_page' =>$number, 
				 'post_type' => PEXETO_PORTFOLIO_POST_TYPE,
		         'post_status' => 'publish',
		         'suppress_filters' => false	 
			);
			

			if($cat_id!='0'){
				$args['tax_query'] = array(
					array(
						'taxonomy' => PEXETO_PORTFOLIO_TAXONOMY,
						'field' => 'id',
						'terms' => array($cat_id)
					)
				);
			}
			
			$posts = get_posts($args);
			?>
		 <ul class="portfolio-items-widget">
		 
		<?php 
			foreach ($posts as $post) {
				echo '<li>'.$this->build_thumbnail_html($post, 84, 74, false, '').'</li>';
				}
		?></ul><?php 
	}



	private function build_thumbnail_html($post, $width, $height, $showTitle=false, $groupName='group'){
		$post_id=$post->ID;
		$preview=pexeto_get_portfolio_preview_img($post_id);

		$settings = pexeto_get_post_meta( $post->ID, array( 'type', 'crop', 'custom_link'), PEXETO_PORTFOLIO_POST_TYPE);



		$thumbnail = pexeto_get_portfolio_preview_img($post_id);
		$thumbnail = pexeto_get_resized_image($thumbnail['img'], 
													90, 
													90, 
													$settings['crop']);

		$type=$settings['type'];

		//set the link of the image depending on the action selected
		

		switch ($type) {
			case 'smallslider':
			case 'fullslider':
			case 'standard':
			case 'fullvideo':
			case 'smallvideo':
			case 'lightbox':
				$openLink='<a href="'.get_permalink($post_id).'">';
				$closeLink='</a>';
				break;
			case 'custom':
				$openLink='<a href="'.$settings['custom_link'].'">';
				$closeLink='</a>';
				break;
		}
		

		return $openLink.'<img src="'.$thumbnail.'" class="img-frame" alt="'.esc_attr($post->post_title).'"/>'.$closeLink;
	}

	/**
	 * Sanitize widget form values as they are saved.
	 *
	 * @see WP_Widget::update()
	 *
	 * @param array $new_instance Values just sent to be saved.
	 * @param array $old_instance Previously saved values from database.
	 *
	 * @return array Updated safe values to be saved.
	 */
	public function update( $new_instance, $old_instance ) {
		$instance = $new_instance;

		return $instance;
	}

	/**
	 * Back-end widget form.
	 *
	 * @see WP_Widget::form()
	 *
	 * @param array $instance Previously saved values from database.
	 */
	public function form( $instance ) {
		$title = isset($instance[ 'title' ]) ? $instance['title']:'';
		$cat_id = isset($instance['category']) ? $instance['category']:'-1';
		?>
		<p>
		<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' ); ?></label> 
		<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
		</p>
		<p>
		<label for="<?php echo $this->get_field_id( 'category' ); ?>"><?php _e( 'Portfolio Category:' ); ?></label> 
		<select class="widefat" name="<?php echo $this->get_field_name( 'category' ); ?>" id="<?php echo $this->get_field_id( 'category' ); ?>">
			<option value="0">ALL</option>
		<?php
		$cats=get_terms(PEXETO_PORTFOLIO_TAXONOMY);
		foreach ($cats as $cat) {
	        $option = '<option';
	        if($cat_id==$cat->term_id){
	            $option.=' selected';   
	        }
	        $option.=' value="'.$cat->term_id.'">'; 
	        $option .= $cat->name;
	        $option .= '</option>';
	        echo $option;
	    }
	    ?>
			</select>
		</p>
		<?php $item_num = isset($instance[ 'item_num' ]) ? $instance['item_num']:8; ?>
		<p>
		<label for="<?php echo $this->get_field_id( 'item_num' ); ?>"><?php _e( 'Number of items to show:' ); ?></label> 
		<input size="3" id="<?php echo $this->get_field_id( 'item_num' ); ?>" name="<?php echo $this->get_field_name( 'item_num' ); ?>" type="text" value="<?php echo esc_attr( $item_num ); ?>" />
		</p>
		<?php
      }



} // class Foo_Widget


function pexeto_register_port_items_widget(){
	if(defined('PEXETO_PORTFOLIO_TAXONOMY') && defined('PEXETO_PORTFOLIO_POST_TYPE')){
		register_widget("Story_Portfolio_Items");
	}
}

add_action('widgets_init', 'pexeto_register_port_items_widget');
