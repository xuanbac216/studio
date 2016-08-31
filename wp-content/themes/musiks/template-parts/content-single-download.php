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
				<div class="panel wrapper-md">
					<div itemscope="" itemtype="http://schema.org/Product">
					    <div class="row">
							<div class="col-sm-4">
								<?php 
									$list = function_exists('edd_get_bundled_products') ? edd_get_bundled_products( $post->ID ) : array();
									if ( has_post_thumbnail() ): ?>
							    <?php the_post_thumbnail( 'medium', array( 'class' => 'm-b img-full' ) ); ?>
								<?php else: ?>
								    <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/default_300_300.jpg" alt="<?php the_title_attribute(); ?>" class="img-full m-b"/>
								<?php endif ?>
							</div>
							<div class="col-sm-8">
								<?php the_title( '<h1 class="m-t-xs m-b-sm entry-title text-black"><span itemprop="name">', '</span></h1>' ); ?>
								<div class="entry-meta clearfix m-b">
								  <?php
								        echo get_the_term_list( $post->ID, 'download_artist', '<span class="m-r">'.esc_html__( 'Artist', 'musik' ).': ', ', ' , '</span>'); 
								        $year = get_post_meta( get_the_ID(), 'year', true );
								        if ( $year ) {
								            echo '<span class="m-r">'.esc_html__( 'Publish', 'musik' ). ': '.esc_html( $year ).'</span>';
								        }
								        echo get_the_term_list( $post->ID, 'download_category', '<span class="m-r">'.__( 'in', 'musik' ).': ', ', ' , '</span>'); 
								    ?>
								</div>
						        <?php if( get_theme_mod( 'show-author-detail' ) ){
						            $user_id = $post->post_author;
						            echo get_user_link($user_id, 36);
						          }
						        ?>
								<div class="m-b-lg m-t-md">
									<?php 
						            if( show_play($post->ID) ){
						            ?>
									  <a href="javascript:;" data-id="<?php echo $post->ID; ?>" class="play-me btn btn-default btn-icon">
									    <i class="fa fa-play text"></i>
									    <i class="fa fa-pause text-active"></i>
									  </a>
									<?php } 
									if(empty( $list ) && get_theme_mod( 'show-playlist' ) ){
									?>
									<a href="javascript:;" data-c-id="<?php echo $post->ID; ?>" data-toggle="tooltip" title="<?php esc_html_e('Add to playlist', 'musik'); ?>" class="playlist-me btn btn-default btn-icon">
									    <i class="icon-playlist"></i>
									</a>
								  <?php }
								  	$itunes = get_post_meta( get_the_ID(), 'itunes', true );
								  	$googleplay = get_post_meta( get_the_ID(), 'googleplay', true );
								  	if ( $itunes ) {
								  	?>
							        	<a href="<?php echo esc_url( $itunes ); ?>" target="_blank" class="btn btn-default btn-itunes"><?php esc_html_e('iTunes', 'musik'); ?></a>
							        <?php }
							        if ( $googleplay ) {
								  	?>
							        	<a href="<?php echo esc_url( $googleplay ); ?>" target="_blank" class="btn btn-default btn-googleplay"><?php esc_html_e('Google Play', 'musik'); ?></a>
							        <?php }

							       $links = get_post_meta($post->ID, 'links', true);
							        if($links && !empty($links)){
										foreach($links['link_text'] as $key=>$value){
											if($value){
											?>
												<a href="<?php echo esc_url( $links['link_url'][$key] ); ?>" target="_blank" class="btn btn-default <?php echo 'btn-'.str_replace(' ', '-', esc_attr($value)) ?>"><?php echo esc_html( $value ); ?></a>
											<?php }
										}
									}
									
									if( get_theme_mod( 'hide-share' ) == 0 ){
							        	echo musik_share(get_the_title( $post->ID ), get_permalink( $post->ID ));
							        }
							        if( get_theme_mod( 'show-likes' ) ){
							        	if (function_exists('the_favorites_button')) { the_favorites_button($post->ID);}
							        }
							        if( get_theme_mod( 'show-plays' ) ){
								        $plays = get_post_meta( $post->ID, 'plays', true );
								        if($plays){
								        	echo '<span class="text-muted m-l-sm"><i class="fa fa-caret-right text-xs m-r-xs"></i>'.$plays.'</span>';
								        }
								    }
								    
								  ?>
								</div>
								<div class="m-b-lg clearfix">
									<?php $download = get_post_meta( $post->ID, 'download', true );
							        if($download){ 
							            $preview = get_preview($post->ID);
							            ?>
							          <a href="<?php echo admin_url('admin-ajax.php').'?action=download&file='.esc_url( reset($preview) ); ?>" class="btn pull-left btn-downlo m-r <?php echo get_theme_mod( 'btn-bg-color' ); ?>">
							            <i class="icon-arrow-down m-r-sm"></i> <?php esc_html_e('Download', 'musik'); ?>
							          </a>
							        <?php } ?>
									<?php 
									if( show_purchase($post->ID) ){ 
									?>
										<div class="pull-left">
										<?php  echo do_shortcode('[purchase_link id="'.$post->ID.'" text="Add to Cart" style="btn '.get_theme_mod( 'btn-bg-color' ).'"]') ?>
										</div>
									<?php } ?>
						        </div>
							</div>
					    </div>
					</div>
					<div class="m-t">
						<?php the_content(); ?>
						<?php echo get_the_term_list( $post->ID, 'download_tag', '<div><span class="badge text-u-c">'.esc_html__( 'Tag', 'musik' ).'</span> ', ', ' , '</div>'); ?>
					</div>
				</div>
		        <?php
		        if ( ! empty( $list ) ){
		        	?>
		        	<h3 class="m-b"><?php echo get_theme_mod( 'title-music', esc_html__('Music', 'musik') ); ?></h3>
		        	<div class="list-group list-group-lg">
		        		<?php
		        			$args = array(
		        				'posts_per_page'   => -1,
                                'post_type'        => 'download',
							    'post__in' 		   => $list,
							    'orderby' 		   => 'post__in'
                            );
							$posts = get_posts($args);
		        			foreach ( $posts as $post ) : setup_postdata( $post );
								?>
								<div class="list-group-item">
		                    	<?php get_template_part( 'template-parts/content', 'download-list' ); ?>
		                    	</div>
		                    <?php endforeach;
	                        wp_reset_postdata();
		        		?>
		        	</div>
			    <?php } ?>

			    <div>
			    	<?php
                        the_widget( 
                        	'music_post_widget',
                        	array(
                        		'count'   => 6,
                        		'orderby' => 'date',
                        		'related' => true,
                        		'type' 	  => empty( $list ) ? 'single' : 'bundle',
                        		'title'   => get_theme_mod( 'title-related', esc_html__('Related music', 'musik') )
                        	),
                        	array(
                        		'before_title'=>'<h3 class="m-b">', 
                        		'after_title'=>'</h3>'
                        	)
                        );
                    ?>
			    </div>

		        <?php
					// If comments are open or we have at least one comment, load up the comment template.
					if ( comments_open() || get_comments_number() ) :
						comments_template();
					endif;
				?>

		    </div>
		    <div class="col-sm-3">
		      <?php dynamic_sidebar( 'music-sidebar' ); ?>
		    </div>
		  </div>
	  </section>
  	</section>
</section>
<?php get_template_part( 'template-parts/player' ); ?>
