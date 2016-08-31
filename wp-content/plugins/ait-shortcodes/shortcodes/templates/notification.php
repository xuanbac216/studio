<div class="<?php echo $this->htmlClass . ' ' . esc_attr($attrs->type) ?>">
	<a href="#" class="close" title="<?php _e('Close notification', 'ait-shortcodes') ?>"><?php _e('close', 'ait-shortcodes') ?></a>
	<div class="notify-wrap">
		<?php $content = '<p>' .  $this->content($content) . '</p>' ?>
 		<?php $content = str_replace('<p></p>', '', $content) ?>
		<?php echo $this->content($content) ?>
	</div>
</div>