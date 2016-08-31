<?php
/**
 * Template part for displaying posts.
 *
 * @package musik
 */

$colors = array(
	'primary',
	'info',
	'success',
	'danger',
	'warning'
);

$index =  rand(0, 4);

?>
<article id="post-<?php the_ID(); ?>" <?php post_class(array( 'item', 'dker bg-'.$colors[$index] )); ?>  
	<?php if ( has_post_thumbnail() ): ?>
		style="background:url(<?php $photo = wp_get_attachment_image_src( get_post_thumbnail_id(), 'md', true ); echo $photo[0] ?>) center center; background-size:cover;"
    <?php endif; ?>
    >
	<div class="wrapper <?php if( has_post_thumbnail() ){ echo('bottom gd'); } else{ echo('text-center m-t');} ?>">
		<header class="entry-header post-title m-b-n-xs">
			<?php the_title( sprintf( '<a href="%s" class="h4 text-lt text-u-c font-bold">', esc_url( get_permalink() ) ), '</a>' ); ?>
		</header><!-- .entry-header -->
		<span class="padder inline b-b <?php echo 'b-'.$colors[$index]; ?> "></span>
		<div class="hidden-xs text-muted">
			<?php
				echo ( content_limit(get_the_excerpt(), 8) );
				/* translators: %s: Name of current post */
				// the_content( sprintf(
				// 	wp_kses( __( 'Continue reading %s <span class="meta-nav">&rarr;</span>', 'musik' ), array( 'span' => array( 'class' => array() ) ) ),
				// 	the_title( '<span class="screen-reader-text">"', '"</span>', false )
				// ) );
			?>
		</div><!-- .entry-content -->
	</div>
</article><!-- #post-## -->
