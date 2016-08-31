<?php
/**
 * Template Name: Category Video
*/

get_header('category'); ?>
<section class="<?php if( get_theme_mod( 'hide-player' ) == 0 ){ echo "w-f-md";} ?>" id="ajax-container">
    <section class="vbox">
        <section class="scrollable padder-lg">
			<header>
				<?php
					the_archive_title( '<h1 class="font-thin h2 m-t m-b">', '</h1>' );
					the_archive_description( '<div class="taxonomy-description">', '</div>' );
				?>
			</header><!-- .page-header -->

			<div class="row">
				<?php if ( have_posts() ) : ?>

					<?php /* Start the Loop */ ?>
					<?php while ( have_posts() ) : the_post(); ?>
						<div class="col-md-3 col-sm-6">
							<article id="post-<?php the_ID(); ?>" <?php post_class('item'); ?>>
							    <div class="pos-rlt">
							        <div class="item-overlay opacity r r-2x bg-black">
							            <div class="center text-center m-t-n">
							              <a href="<?php the_permalink(); ?>">
							                <i class="icon-control-play i-2x text"></i>
							                <i class="icon-control-pause i-2x text-active"></i>
							              </a>
							            </div>
							        </div>
							        <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
							            <?php if ( has_post_thumbnail() ): ?>
							                <?php the_post_thumbnail( 'lg', array( 'class' => 'r r-2x img-full' ) ); ?>
							            <?php else: ?>
							                <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/default_16_9.jpg" alt="<?php the_title_attribute(); ?>" class="r img-full"/>
							            <?php endif ?>
							        </a>
							    </div>

							    <div class="m-t-sm m-b-lg item-desc">
							        <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>" class="text-ellipsis"><?php the_title(); ?></a>
							    </div>
							</article>
						</div>
					<?php endwhile; ?>

					<div class="text-center">
						<?php get_template_part( 'template-parts/pagination'); ?>
					</div>
				<?php else : ?>

					<?php get_template_part( 'template-parts/content', 'none' ); ?>

				<?php endif; ?>
			</div>
		</section>
	</section>
</section>
<?php get_template_part( 'template-parts/player' ); ?>
<?php get_footer('category'); ?>
