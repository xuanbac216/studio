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
        <?php if(show_purchase($post->ID)){ ?>
          <div class="pull-right hover-action">
            <?php  
            $text = '';
            $wrap = '%s';
            if(edd_has_variable_prices($post->ID)){
              $text = edd_price_range($post->ID);
              $btn = '';
              if(get_theme_mod('prices-popup')){
                $text = edd_get_option( 'add_to_cart_text', __( 'Purchase', 'musik' ));
                if(!edd_item_in_cart($post->ID)){
                  $class = 'edd-popup';
                  $btn = '<a href="#" class="edd-choose"></a>';
                }
                $wrap = '<div id="edd-modal-'.$post->ID.'" class="edd-popup">'.$btn.'%s</div>';
              }
            }
            echo sprintf($wrap, edd_get_purchase_link(array(
              'download_id' => $post->ID,
              'style' => 'btn btn-xs '.get_theme_mod( 'btn-bg-color' ),
              'text' => $text
            )));
            ?>
          </div>
        <?php } ?>
	    <a href="<?php the_permalink(); ?>" data-pjax title="<?php the_title_attribute(); ?>" class="text-ellipsis font-bold"><?php the_title(); ?></a>
	    <?php
	        $artist = get_the_term_list( $post->ID, 'download_artist', '', ', ', '' );
	        if (!is_wp_error( $artist ) && '' != $artist ) {
	            echo '<div class="text-muted text-sm text-ellipsis">'. esc_html__('by ', 'musik') . $artist .'</div>';
	        }
	    ?>
        <?php

	    if( get_theme_mod( 'show-author' )){
	        $user_id = $post->post_author;
	        echo get_user_link($user_id);
	    }

	    ?>
	</div>
</article>
