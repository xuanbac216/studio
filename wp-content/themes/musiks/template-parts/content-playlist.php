<?php
/**
 * Partial: Content Download
*/
?>
<article id="post-<?php the_ID(); ?>" <?php post_class('item hover m-b-none clearfix'); ?>>
	<div class="pos-rlt pull-left m-r">
		<?php 
		if( show_play($post->ID) ){
        ?>
	    <div class="item-overlay opacity r bg-black">
	        <div class="center text-center m-t-n-sm">
	          <a href="javascript:;" data-id="<?php echo esc_attr( $post->ID ); ?>" class="play-me i-lg">
	            <i class="icon-control-play text"></i>
	            <i class="icon-control-pause text-active"></i>
	          </a>
	        </div>
	    </div>
        <?php } ?>
	    <a href="<?php the_permalink(); ?>" data-pjax title="<?php the_title_attribute(); ?>" class="thumb-md">
	        <?php if ( has_post_thumbnail() ): ?>
	            <?php the_post_thumbnail( 'thumbnail', array( 'class' => 'r img-full' ) ); ?>
	        <?php else: ?>
	            <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/default_300_300.jpg" alt="<?php the_title_attribute(); ?>" class="r img-full"/>
	        <?php endif ?>
	    </a>
	</div>

	<div class="clear">
	    <a href="<?php the_permalink(); ?>" data-pjax title="<?php the_title_attribute(); ?>" class="text-ellipsis font-bold m-b-sm"><?php the_title(); ?></a>
	    <?php 
	    	$tracks = explode(',', get_post_meta( $post->ID, 'tracks', true ) );
	    	echo '<span class="text-muted"><i class="icon-playlist text-xs m-r-xs"></i> '.count($tracks).'</span>';
	    ?>
	</div>
</article>
