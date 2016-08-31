<?php
/*
 * The template for displaying a header title section
 */
	global $theme_option, $gdlr_post_option;
	$header_background = '';
	if( !empty($gdlr_post_option['header-background']) ){
		if( is_numeric($gdlr_post_option['header-background']) ){
			$image_src = wp_get_attachment_image_src($gdlr_post_option['header-background'], 'full');	
			$header_background = ' style="background-image: url(\'' . $image_src[0] . '\');" ';
		}else{
			$header_background = ' style="background-image: url(\'' . $gdlr_post_option['header-background'] . '\');" ';
		}
	}
	
	$header_icon = '';
	$header_icon_class = '';
	if( !empty($gdlr_post_option) && !empty($gdlr_post_option['header-icon']) ){
		$header_icon_class = 'gdlr-with-icon';
		$header_icon = '<div class="gdlr-page-header-icon"><i class="' . $gdlr_post_option['header-icon'] . '"></i></div>';
	}else{
		$icon_class = '';
		if( is_single() && !empty($theme_option[get_post_type() . '-header-icon']) ){
			$icon_class = $theme_option[get_post_type() . '-header-icon'];
		}
		
		if( !empty($icon_class) ){
			$header_icon_class = 'gdlr-with-icon';
			$header_icon = '<div class="gdlr-page-header-icon"><i class="' . $icon_class . '"></i></div>';
		}
	}
?>

	<?php if( is_page() && (empty($gdlr_post_option['show-title']) || $gdlr_post_option['show-title'] != 'disable') ){ ?>
		<div class="gdlr-page-title-wrapper" <?php echo $header_background; ?> >
			<div class="gdlr-page-title-overlay"></div>
			<div class="gdlr-page-title-container container <?php echo $header_icon_class; ?>" >
				<?php echo $header_icon; ?>
				<h1 class="gdlr-page-title"><?php the_title(); ?></h1>
				<?php if( !empty($gdlr_post_option['page-caption']) ){ ?>
				<span class="gdlr-page-caption"><?php echo gdlr_text_filter($gdlr_post_option['page-caption']); ?></span>
				<?php } ?>
			</div>
			<div class="gdlr-header-bottom-gimmick"></div>
		</div>	
	<?php }else if( is_single() && in_array($post->post_type, array('post','event')) ){ 
	
		if( !empty($gdlr_post_option['page-title']) ){
			$page_title = $gdlr_post_option['page-title'];
			$page_caption = $gdlr_post_option['page-caption'];
		}else{
			$page_title = $theme_option[$post->post_type . '-title'];
			$page_caption = $theme_option[$post->post_type . '-caption'];
		} 
	?>
		<div class="gdlr-page-title-wrapper" <?php echo $header_background; ?> >
			<div class="gdlr-page-title-overlay"></div>
			<div class="gdlr-page-title-container container <?php echo $header_icon_class; ?>" >
				<?php echo $header_icon; ?>
				<h3 class="gdlr-page-title"><?php echo gdlr_text_filter($page_title); ?></h3>
				<?php if( !empty($page_caption) ){ ?>
				<span class="gdlr-page-caption"><?php echo gdlr_text_filter($page_caption); ?></span>
				<?php } ?>
			</div>	
			<div class="gdlr-header-bottom-gimmick"></div>
		</div>	
	<?php }else if( is_single() ){ // for custom post type
		
		$page_title = get_the_title();
		if( !empty($gdlr_post_option) && !empty($gdlr_post_option['page-caption']) ){
			$page_caption = $gdlr_post_option['page-caption'];
		}else if($post->post_type == 'portfolio' && !empty($theme_option['page-caption']) ){
			$page_caption = $theme_option['portfolio-caption'];		
		}
	?>
		<div class="gdlr-page-title-wrapper" <?php echo $header_background; ?>  >
			<div class="gdlr-page-title-overlay"></div>
			<div class="gdlr-page-title-container container <?php echo $header_icon_class; ?>" >
				<?php echo $header_icon; ?>
				<h1 class="gdlr-page-title"><?php echo gdlr_text_filter($page_title); ?></h1>
				<?php if( !empty($page_caption) ){ ?>
				<span class="gdlr-page-caption"><?php echo gdlr_text_filter($page_caption); ?></span>
				<?php } ?>
			</div>	
			<div class="gdlr-header-bottom-gimmick"></div>
		</div>	
	<?php }else if( is_404() ){ ?>
		<div class="gdlr-page-title-wrapper" <?php echo $header_background; ?>  >
			<div class="gdlr-page-title-overlay"></div>
			<div class="gdlr-page-title-container container <?php echo $header_icon_class; ?>" >
				<?php echo $header_icon; ?>
				<h1 class="gdlr-page-title"><?php _e('404', 'gdlr_translate'); ?></h1>
				<span class="gdlr-page-caption"><?php _e('Page not found', 'gdlr_translate'); ?></span>
			</div>	
			<div class="gdlr-header-bottom-gimmick"></div>
		</div>		
	<?php }else if( is_archive() && is_tax('album') ){ 
			$title = __('Album','gdlr_translate');
			$caption = single_cat_title('', false);	
	?>
		<div class="gdlr-page-title-wrapper" <?php echo $header_background; ?> >
			<div class="gdlr-page-title-overlay"></div>
			<div class="gdlr-page-title-container container <?php echo $header_icon_class; ?>" >
				<?php echo $header_icon; ?>
				<span class="gdlr-page-title"><?php echo gdlr_text_filter($title); ?></span>
				<?php if( !empty($caption) ){ ?>
				<h1 class="gdlr-page-caption"><?php echo gdlr_text_filter($caption); ?></h1>
				<?php } ?>
			</div>	
			<div class="gdlr-header-bottom-gimmick"></div>
		</div>			
	<?php }else if( is_archive() || is_search() ){
		if( is_search() ){
			$title = __('Search Results', 'gdlr_translate');
			$caption = get_search_query();
		}else if( is_category() || is_tax('portfolio_category') || is_tax('product_cat') ){
			$title = __('Category','gdlr_translate');
			$caption = single_cat_title('', false);
		}else if( is_tag() || is_tax('portfolio_tag') || is_tax('product_tag') ){
			$title = __('Tag','gdlr_translate');
			$caption = single_cat_title('', false);
		}else if( is_day() ){
			$title = __('Day','gdlr_translate');
			$caption = get_the_date('F j, Y');
		}else if( is_month() ){
			$title = __('Month','gdlr_translate');
			$caption = get_the_date('F Y');
		}else if( is_year() ){
			$title = __('Year','gdlr_translate');
			$caption = get_the_date('Y');
		}else if( is_author() ){
			$title = __('By','gdlr_translate');
			
			$author_id = get_query_var('author');
			$author = get_user_by('id', $author_id);
			$caption = $author->display_name;					
		}else if( is_post_type_archive('product') ){
			$title = __('Shop', 'gdlr_translate');
			$caption = '';
		}else{
			$title = get_the_title();
			$caption = '';
		}
	?>
		<div class="gdlr-page-title-wrapper" <?php echo $header_background; ?> >
			<div class="gdlr-page-title-overlay"></div>
			<div class="gdlr-page-title-container container <?php echo $header_icon_class; ?>" >
				<?php echo $header_icon; ?>
				<span class="gdlr-page-title"><?php echo gdlr_text_filter($title); ?></span>
				<?php if( !empty($caption) ){ ?>
				<h1 class="gdlr-page-caption"><?php echo gdlr_text_filter($caption); ?></h1>
				<?php } ?>
			</div>	
			<div class="gdlr-header-bottom-gimmick"></div>
		</div>		
	<?php } ?>
	<!-- is search -->