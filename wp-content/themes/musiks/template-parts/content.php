<?php
/**
 * Template part for displaying posts.
 *
 * @package musik
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class('post-item'); ?>>
	<?php if ( has_post_thumbnail() ): ?>
		<div class="post-media">
        	<?php the_post_thumbnail( 'thumb_large', array( 'class' => 'img-full' ) ); ?>
        </div>
    <?php endif; ?>
	<div class="wrapper-lg">
		<header class="entry-header post-title">
			<?php the_title( sprintf( '<h2 class="entry-title m-t-none"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>
			<?php if ( 'post' == get_post_type() ) : ?>
				<div class="entry-meta m-b-md">
					<?php musik_posted_on(); ?>
				</div><!-- .entry-meta -->
			<?php endif; ?>
		</header><!-- .entry-header -->

		<div class="entry-content">
			<?php
				echo ( content_limit(get_the_excerpt(), 50) );
				/* translators: %s: Name of current post */
				// the_content( sprintf(
				// 	wp_kses( __( 'Continue reading %s <span class="meta-nav">&rarr;</span>', 'musik' ), array( 'span' => array( 'class' => array() ) ) ),
				// 	the_title( '<span class="screen-reader-text">"', '"</span>', false )
				// ) );
			?>

			<?php
				wp_link_pages( array(
					'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'musik' ),
					'after'  => '</div>',
				) );
			?>
		</div><!-- .entry-content -->

		<footer class="entry-footer text-muted m-t-md">
			<?php musik_entry_footer(); ?>
		</footer><!-- .entry-footer -->
	</div>
</article><!-- #post-## -->
