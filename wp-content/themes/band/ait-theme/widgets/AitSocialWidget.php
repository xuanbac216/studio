<?php


class AitSocialWidget extends WP_Widget
{

	function __construct()
	{
		$widget_ops = array('classname' => 'widget_social', 'description' => __( 'Display social icons for current page', 'ait-admin') );
		parent::__construct('ait-social', __('Theme &rarr; Social Icons', 'ait-admin'), $widget_ops);
	}



	function widget( $args, $instance )
	{
		extract( $args );
		$result = '';
		$target = '';
		$themeOptions = aitOptions()->get('theme');
		$locale = AitLangs::getCurrentLocale();

		// WIDGET CONTENT :: START
		$result .= $before_widget;
		$title = '';
		if(isset($instance['title'])){
			$title = apply_filters('widget_title', empty($instance['title']) ? '' : $instance['title'], $instance, $this->id_base);
		}
		$result .= $before_title.$title.$after_title;

		if($themeOptions->social->socIconsNewWindow){$target = 'target = "_blank"';}
		$result .= $instance['show_icon_titles'] ? '<ul><!--' : '<ul class="no-titles"><!--';
		foreach($themeOptions->social->socIcons as $icon){
			$iconLight = $icon->icon != "" ? '<img src="'.$icon->icon.'" class="s-icon s-icon-light" alt="icon">' : '';
			$iconDark = $icon->iconDark != "" ? '<img src="'.$icon->iconDark.'" class="s-icon s-icon-dark" alt="icon">' : '';

			if($instance['show_icon_titles']){
				$iconTitle = (isset($locale) && isset($icon->title->{$locale})) ? $icon->title->{$locale} : '';
				$result .= '--><li><a href="'.$icon->url.'" '.$target.'>'.$iconLight.$iconDark.'<span class="s-title">'. $iconTitle.'</span></a></li><!--';
			} else {
				$result .= '--><li><a href="'.$icon->url.'" '.$target.'>'.$iconLight.$iconDark.'</a></li><!--';
			}
		}
		$result .= '--></ul>';

		$result .= $after_widget;
		// WIDGET CONTENT :: END
		echo($result);
	}



	function update( $new_instance, $old_instance )
	{
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['show_icon_titles'] = $new_instance['show_icon_titles'];
		return $instance;
	}



	function form( $instance )
	{
		$instance = wp_parse_args( (array) $instance, array(
            'title' => '',
            'show_icon_titles' => true
        ) );
    ?>
		<p>
			<label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:', 'ait-admin'); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $instance['title']; ?>" />
		</p>

		<p>
            <?php $checked = ''; if ( $instance['show_icon_titles'] ) $checked = 'checked="checked"'; ?>
			<input type="checkbox" <?php echo $checked; ?> id="<?php echo $this->get_field_id( 'show_icon_titles' ); ?>" name="<?php echo $this->get_field_name( 'show_icon_titles' ); ?>" class="checkbox" />
			<label for="<?php echo $this->get_field_id( 'show_icon_titles' ); ?>"><?php echo __( 'Show icon title', 'ait-admin' ); ?></label>
        </p>
<?php
	}

}
