<?php
$windowId = $this->scPrefix . esc_attr($attrs->name);
?>

<div class="modal-wrap" style="display: none;">
	<div class="<?php echo $this->htmlClass ?> entry-content" id="<?php echo $windowId ?>">
		<?php echo $this->content($content) ?>
	</div>
</div>