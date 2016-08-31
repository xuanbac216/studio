<?php
/**
 * Plugin Name: Goodlayers Album Widget
 * Plugin URI: http://goodlayers.com/
 * Description: A widget that show album.
 * Version: 1.0
 * Author: Goodlayers
 * Author URI: http://www.goodlayers.com
 *
 */

add_action( 'widgets_init', 'gdlr_album_widget' );
if( !function_exists('gdlr_album_widget') ){
	function gdlr_album_widget() {
		register_widget( 'Goodlayers_Song_Album' );
	}
}

if( !class_exists('Goodlayers_Song_Album') ){
	class Goodlayers_Song_Album extends WP_Widget{

		// Initialize the widget
		function __construct() {
			parent::WP_Widget(
				'gdlr-album-widget', 
				__('Goodlayers Album Widget','gdlr_translate'), 
				array('description' => __('A widget that show album list', 'gdlr_translate')));  
		}

		// Output of the widget
		function widget( $args, $instance ) {
			global $theme_option;	
				
			$title = apply_filters( 'widget_title', $instance['title'] );
			$category = $instance['category'];
			$num_fetch = $instance['num_fetch'];
			$thumbnail = $instance['thumbnail'];
			
			// Opening of widget
			echo $args['before_widget'];
			
			// Open of title tag
			if( !empty($title) ){ 
				echo $args['before_title'] . $title . $args['after_title']; 	
			}
				
			echo '<div class="gdlr-shortcode-wrapper">';
			echo '<div class="album-widget-nav gdlr-nav-container">';
			echo '<div class="nav-container style-1" ></div>';	
			echo '</div>';
			
			echo gdlr_print_album_item(array('album'=>$category, 'num-fetch'=>$num_fetch,
				'album-size'=>'1/1', 'album-style'=>'carousel-no-space', 'thumbnail-size'=>$thumbnail), false);
			echo '</div>';
				
			// Closing of widget
			echo $args['after_widget'];	
		}

		// Widget Form
		function form( $instance ) {
			$title = isset($instance['title'])? $instance['title']: '';
			$category = isset($instance['category'])? $instance['category']: '';
			$num_fetch = isset($instance['num_fetch'])? $instance['num_fetch']: 3;
			$thumbnail = isset($instance['thumbnail'])? $instance['thumbnail']: 'thumbnail';
			
			?>

			<!-- Text Input -->
			<p>
				<label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title :', 'gdlr_translate'); ?></label> 
				<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" />
			</p>		

			<!-- Post Category -->
			<p>
				<label for="<?php echo $this->get_field_id('category'); ?>"><?php _e('Category :', 'gdlr_translate'); ?></label>		
				<select class="widefat" name="<?php echo $this->get_field_name('category'); ?>" id="<?php echo $this->get_field_id('category'); ?>">
				<option value="" <?php if(empty($category)) echo ' selected '; ?>><?php _e('All', 'gdlr_translate') ?></option>
				<?php 	
				$category_list = gdlr_get_term_list('album'); 
				foreach($category_list as $cat_slug => $cat_name){ ?>
					<option value="<?php echo $cat_slug; ?>" <?php if ($category == $cat_slug) echo ' selected '; ?>><?php echo $cat_name; ?></option>				
				<?php } ?>	
				</select> 
			</p>
				
			<!-- Show Num --> 
			<p>
				<label for="<?php echo $this->get_field_id('num_fetch'); ?>"><?php _e('Num Fetch :', 'gdlr_translate'); ?></label>
				<input class="widefat" id="<?php echo $this->get_field_id('num_fetch'); ?>" name="<?php echo $this->get_field_name('num_fetch'); ?>" type="text" value="<?php echo $num_fetch; ?>" />
			</p>
			
			<!-- Album Thumbnail -->
			<p>
				<label for="<?php echo $this->get_field_id('thumbnail'); ?>"><?php _e('Thumbnail :', 'gdlr_translate'); ?></label>		
				<select class="widefat" name="<?php echo $this->get_field_name('thumbnail'); ?>" id="<?php echo $this->get_field_id('thumbnail'); ?>">
				<?php 	
				$thumbnail_list = gdlr_get_thumbnail_list();
				foreach($thumbnail_list as $thu_slug => $thu_name){ ?>
					<option value="<?php echo $thu_slug; ?>" <?php if ($thumbnail == $thu_slug) echo ' selected '; ?>><?php echo $thu_name; ?></option>				
				<?php } ?>	
				</select> 
			</p>			

		<?php
		}
		
		// Update the widget
		function update( $new_instance, $old_instance ) {
			$instance = array();
			$instance['title'] = (empty($new_instance['title']))? '': strip_tags($new_instance['title']);
			$instance['category'] = (empty($new_instance['category']))? '': strip_tags($new_instance['category']);
			$instance['num_fetch'] = (empty($new_instance['num_fetch']))? '': strip_tags($new_instance['num_fetch']);
			$instance['thumbnail'] = (empty($new_instance['thumbnail']))? '': strip_tags($new_instance['thumbnail']);

			return $instance;
		}	
	}
}
?>