<?php
	$soundtheme_css = get_field('soundtheme_custom_css' , 'option');
	$soundtheme_google = get_field('soundtheme_google' , 'option');
?>

<?php if ($soundtheme_css) : ?>
	<style type="text/css">
		<?php echo $soundtheme_css; ?>
	</style>
<?php endif; ?>

<?php if ($soundtheme_google) : ?>
	<?php echo $soundtheme_google; ?>
<?php endif; ?>