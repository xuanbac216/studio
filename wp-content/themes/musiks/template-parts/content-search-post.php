<?php
/**
 * Partial: Content Download
*/
?>
<a href="<?php the_permalink(); ?>" id="post-<?php the_ID(); ?>" class="text-ellipsis list-group-item">
	<?php if ( has_post_thumbnail() ){?>
        <span class="thumb-xs m-r-xs"><?php the_post_thumbnail( 'thumbnail', array( 'class' => 'r img-full' ) ); ?></span>
    <?php } ?>
	<span><?php the_title(); ?></span>
</a>
