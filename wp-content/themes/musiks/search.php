<?php
/**
 * The template for displaying search results pages.
 *
 * @package musik
 */

get_header(); ?>
<section class="<?php if( get_theme_mod( 'hide-player' ) == 0 ){ echo "w-f-md";} ?>" id="ajax-container">
    <section class="vbox">
		<section class="scrollable wrapper-lg">
			<div class="row">
				<div class="col-sm-9">

					<header>
						<h1 class="font-thin h2 m-b"><?php printf( esc_html__( 'Search Results for: %s', 'musik' ), '<span class="font-bold">' . get_search_query() . '</span>' ); ?></h1>
					</header><!-- .page-header -->

				<?php if ( have_posts() ) : ?>

					<?php /* Start the Loop */ ?>
					<?php while ( have_posts() ) : the_post(); ?>

						<?php
						/**
						 * Run the loop for the search to output the results.
						 * If you want to overload this in a child theme then include a file
						 * called content-search.php and that will be used instead.
						 */
						get_template_part( 'template-parts/content', 'thumbnail' );
						?>

					<?php endwhile; ?>

					<?php get_template_part( 'template-parts/pagination'); ?>

				<?php else : ?>

					<?php get_template_part( 'template-parts/content', 'none' ); ?>

				<?php endif; ?>
				</div>
				<div class="col-sm-3">
					<?php get_sidebar(); ?>
				</div>
			</div>
		</section>
	</section>
</section>
<?php get_template_part( 'template-parts/player' ); ?>
<?php get_footer(); ?>
