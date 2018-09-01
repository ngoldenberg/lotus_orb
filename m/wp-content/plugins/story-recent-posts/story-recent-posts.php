<?php
/*
Plugin Name: Story Recent Posts Widget
Description: Loads the portfolio posts from a selected category
Version: 1.0
Author: Pexeto
Author URI: http://pexetothemes.com
*/


/**
 * Adds Portfolio Items Widget
 */
class Story_Recent_Posts extends WP_Widget {

	private $theme_name = 'Story';
	private $prefix = 'story_';

	/**
	 * Register widget with WordPress.
	 */
	public function __construct() {
		parent::__construct(
	 		$this->prefix.'recent_posts', // Base ID
			$this->theme_name.' Recent Posts', // Name
			array( 'description' => __( 'Recent Posts Widget', 'pexeto' ), ) // Args
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
		$exclude_fromats = array();
		$cat_id = isset($instance['category']) ? $instance['category'] : '-1';

		$post_formats = get_terms(array('post_format'));
		foreach ($post_formats as $format) {
			if(isset($instance['exclude_'.$format->slug])){
				$exclude_fromats[]=$format->slug;
			}
		}
		
		$args=array('showposts' => $number, 'ignore_sticky_posts' => 1, 'suppress_filters' => false);
		$tax_query = array('ralation' => 'AND' );

		if($cat_id!='' && $cat_id!='-1'){
	      	$tax_query[]=array(
				'taxonomy' => 'category',
				'field' => 'id',
				'terms' => array( $cat_id ),
				'operator' => 'IN'
			);
	    }

	    if(!empty($exclude_fromats)){
	    	$tax_query[]=array(
				'taxonomy' => 'post_format',
				'field' => 'slug',
				'terms' => $exclude_fromats,
				'operator' => 'NOT IN'
			);
		}
    
	    $args['tax_query']=$tax_query;


		$posts = get_posts($args); ?>

		<div class="sidebar-latest-posts">
		<?php foreach ($posts as $post) { ?>
			<div class="lp-wrapper">
			<?php
			 if(has_post_thumbnail($post->ID)){ 
			 	$thumb_id = get_post_thumbnail_id($post->ID);
				if(function_exists('pexeto_get_resized_image')){
					$large_image_url = wp_get_attachment_image_src( $thumb_id, 'medium');
					$thumbnail=pexeto_get_resized_image($large_image_url[0], 80, 65);
				}else{
					$thumb_data = wp_get_attachment_image_src($thumb_id, 'thumbnail' );
					$thumbnail = $thumb_data[0];
				}
				$alt = get_post_meta($thumb_id, '_wp_attachment_image_alt', true);
			?>
			<a href="<?php echo get_permalink($post->ID); ?>"> <img src="<?php echo $thumbnail; ?>" alt="<?php echo $alt; ?>" class="alignleft img-frame" width="55"/>
			</a>
			<?php } ?>
			<div class="lp-info-wrapper">
				<span class="lp-title"><a href="<?php echo get_permalink($post->ID); ?>"><?php echo $post->post_title; ?></a></span>
				<span class="lp-post-info"><?php echo get_the_time('M jS, Y', $post); ?> </span>
				<div class="clear"></div>		
			</div>
		    
			<div class="clear"></div>
		    </div>
			
			<?php 
			}?>
		</div>
		<?php
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
		
		<?php $item_num = isset($instance[ 'item_num' ]) ? $instance['item_num']:5; ?>
		<p>
		<label for="<?php echo $this->get_field_id( 'item_num' ); ?>"><?php _e( 'Number of items to show:' ); ?></label> 
		<input size="3" id="<?php echo $this->get_field_id( 'item_num' ); ?>" name="<?php echo $this->get_field_name( 'item_num' ); ?>" type="text" value="<?php echo esc_attr( $item_num ); ?>" />
		</p>

		<p>
		<label for="<?php echo $this->get_field_id( 'category' ); ?>"><?php _e( 'Category:' ); ?></label> 
		<select class="widefat" name="<?php echo $this->get_field_name( 'category' ); ?>" id="<?php echo $this->get_field_id( 'category' ); ?>">
			<option value="-1">ALL</option>
		<?php
		$cats=get_categories();
		foreach ($cats as $cat) {
			if($cat_id==$cat->term_id){
				echo '***';
			}else{
				echo '^^^';
			}
	        $option = '<option';
	        if($cat_id==$cat->term_id){
	            $option.=' selected="selected"';   
	        }
	        $option.=' value="'.$cat->term_id.'">'; 
	        $option .= $cat->name;
	        $option .= '</option>';
	        echo $option;
	    }
	    ?>
			</select>
		</p>
		<p>
			<label><?php _e( 'Exclude Post Formats:' ); ?></label><br/>
		<?php $post_formats = get_terms(array('post_format'));
	foreach ($post_formats as $format) {
		?><input type="checkbox" name="<?php echo $this->get_field_name( 'exclude_'.$format->slug ); ?>"
		id="<?php echo $this->get_field_id( 'exclude_'.$format->slug ); ?>"
		value="<?php echo $format->slug; ?>"
		<?php if(isset($instance['exclude_'.$format->slug])){ ?>
		checked="checked"
		<?php } ?>
		><label><?php echo $format->name; ?></label><br/><?php
	}
	 ?>
		</p>
		<?php
      }



} // class Foo_Widget


function story_register_recent_posts_widget(){
		register_widget("Story_Recent_Posts");
}

add_action('widgets_init', 'story_register_recent_posts_widget');
