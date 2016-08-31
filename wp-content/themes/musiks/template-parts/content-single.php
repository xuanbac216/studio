<?php
/**
 * Template part for displaying single posts.
 *
 * @package musik
 */

?>

<section class="<?php if( get_theme_mod( 'hide-player' ) == 0 ){ echo "w-f-md";} ?>" id="ajax-container">
    <section class="vbox">
		<section class="scrollable wrapper-lg">
			<div class="row">
				<div class="col-sm-9">
					<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
						<header class="entry-header m-b">
							<?php the_title( '<h1 class="m-t-none m-b-none text-black">', '</h1>' ); ?>

							<div class="entry-meta padder-v b-b">
								<?php musik_posted_on(); ?>
							</div><!-- .entry-meta -->
						</header><!-- .entry-header -->

						<div class="entry-content padder-v">
							<?php the_content(); ?>
							<?php
								wp_link_pages( array(
									'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'musik' ),
									'after'  => '</div>',
								) );
							?>
						</div><!-- .entry-content -->
						<footer class="entry-footer b-t padder-v">
							<?php musik_entry_footer(); ?>
						</footer><!-- .entry-footer -->
						<?php
							// If comments are open or we have at least one comment, load up the comment template.
							if ( comments_open() || get_comments_number() ) :
								comments_template();
							endif;
						?>
					</article><!-- #post-## -->
				</div>
				<div class="col-sm-3">
					<?php get_sidebar('category');  ?>
				</div>
			</div>
		</section>
  	</section>
</section>
<?php get_template_part( 'template-parts/player' ); ?>
