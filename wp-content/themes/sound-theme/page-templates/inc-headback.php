<?php $soundtheme_head_backimage = esc_url( get_field('soundtheme_head_backimage')); ?>
<?php if ($soundtheme_head_backimage) : ?>
	<style type="text/css">
		.soundtheme-head-wall {
		background: url(<?php echo esc_url($soundtheme_head_backimage); ?>) no-repeat center center;
		background-color:#24252A;
		  -webkit-background-size: cover;
		  -moz-background-size: cover;
		  -o-background-size: cover;
		  background-size: cover; 
		  filter: progid:DXImageTransform.Microsoft.AlphaImageLoader(src='<?php echo esc_url($soundtheme_head_backimage); ?>', sizingMethod='scale');
		  -ms-filter: "progid:DXImageTransform.Microsoft.AlphaImageLoader(src='<?php echo esc_url($soundtheme_head_backimage); ?>', sizingMethod='scale')";
		}
	</style>
<?php endif; ?>