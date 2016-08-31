<?php
$windowId = $this->scPrefix . esc_attr($attrs->name);
$type =  $attrs->type != 'link' ? ' ' . $this->htmlClass . '-' . $attrs->type : '';
?>

<script type="text/javascript">
(function($){
	$(function(){
		jQuery('a#<?php echo $this->htmlId ?>').colorbox({inline:true, href: $('#<?php echo $windowId ?>'), width: <?php echo esc_js($attrs->width) ?>, height: <?php echo esc_js($attrs->height) ?>});
	});
})(jQuery);
</script>

<?php
$data = $this->content($content);
preg_match("/<a[^>]*>/", $data, $matches);
if(!empty($matches)){
	$result = preg_replace("@(https?://([-\w\.]+)+(:\d+)?(/([\w/_\.]*(\?\S+)?)?)?)@", "#".$windowId, $matches[0]);
	$result = preg_replace('/id="(.*)"/', 'id="'.$this->htmlId.'"', $result);
	echo str_replace($matches[0], $result, $data);
}else{
?>
<a class="<?php echo $this->htmlClass . $type ?>" id="<?php echo $this->htmlId ?>" href="#<?php echo $windowId ?>">
	<?php echo $this->content($content) ?>
</a>
<?php } ?>