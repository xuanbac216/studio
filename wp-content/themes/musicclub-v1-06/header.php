<!DOCTYPE html>
<!--[if IE 7]><html class="ie ie7 ltie8 ltie9" <?php language_attributes(); ?>><![endif]-->
<!--[if IE 8]><html class="ie ie8 ltie9" <?php language_attributes(); ?>><![endif]-->
<!--[if !(IE 7) | !(IE 8)  ]><!-->
<html <?php language_attributes(); ?>>
<!--<![endif]-->

<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>" />
	<meta name="viewport" content="width=device-width" />
	<title><?php bloginfo('name'); ?>  <?php wp_title(); ?></title>
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
		
	<?php 
		global $theme_option, $gdlr_post_option;
		if( !empty($gdlr_post_option) ){ $gdlr_post_option = json_decode($gdlr_post_option, true); }
		
		wp_head(); 
	?>
</head>

<body <?php body_class(); ?>>
<?php
	$body_wrapper = '';
	if($theme_option['enable-boxed-style'] == 'boxed-style'){
		$body_wrapper = 'gdlr-boxed-style';
		if( !empty($theme_option['boxed-background-image']) && is_numeric($theme_option['boxed-background-image']) ){
			$alt_text = get_post_meta($theme_option['boxed-background-image'] , '_wp_attachment_image_alt', true);	
			$image_src = wp_get_attachment_image_src($theme_option['boxed-background-image'], 'full');
			echo '<img class="gdlr-full-boxed-background" src="' . $image_src[0] . '" alt="' . $alt_text . '" />';
		}else if( !empty($theme_option['boxed-background-image']) ){
			echo '<img class="gdlr-full-boxed-background" src="' . $theme_option['boxed-background-image'] . '" />';
		}
	}
?>
<div class="body-wrapper <?php echo $body_wrapper; ?>">
	<div class="body-overlay"></div>
	<?php 
		// page style
		if( empty($gdlr_post_option) || empty($gdlr_post_option['page-style']) ||
			  $gdlr_post_option['page-style'] == 'normal' || 
			  $gdlr_post_option['page-style'] == 'no-footer'){ 
			  
		$header_class  = ($theme_option['enable-float-menu'] != 'disable')? ' float-menu': '';
		if( empty($gdlr_post_option['no-height-nav']) ){
			$header_class .= ($theme_option['default-transparent-navigation'] == 'enable')? ' gdlr-no-height': '';
		}else{
			$header_class .= ($gdlr_post_option['no-height-nav'] == 'enable')? ' gdlr-no-height': '';
		}
		
	?>
	<header class="gdlr-header-wrapper <?php echo $header_class; ?>">
		
		<div class="gdlr-header-substitute">
			<div class="gdlr-header-inner">
				<div class="gdlr-header-overlay"></div>
				<div class="gdlr-header-top-gimmick"></div>
				<div class="gdlr-header-container container">
					<!-- logo -->
					<div class="gdlr-logo">
						<?php echo (is_front_page())? '<h1>':''; ?>
						<a href="<?php echo home_url(); ?>" >
							<?php 
								if(empty($theme_option['logo-id'])){ 
									echo gdlr_get_image(GDLR_PATH . '/images/logo.png');
								}else{
									echo gdlr_get_image($theme_option['logo-id']);
								}
							?>						
						</a>
						<?php echo (is_front_page())? '</h1>':''; ?>
					</div>

					<?php 
						// main navigation
						get_template_part( 'header', 'nav' ); 
						
						// mobile navigation
						if( class_exists('gdlr_dlmenu_walker') && ( empty($theme_option['enable-responsive-mode']) || $theme_option['enable-responsive-mode'] == 'enable' ) ){
							echo '<div class="gdlr-responsive-navigation dl-menuwrapper" id="gdlr-responsive-navigation" >';
							echo '<button class="dl-trigger">Open Menu</button>';
							wp_nav_menu( array(
								'theme_location'=>'main_menu', 
								'container'=> '', 
								'menu_class'=> 'dl-menu gdlr-main-mobile-menu',
								'walker'=> new gdlr_dlmenu_walker() 
							) );						
							echo '</div>';
						}						
					?>
					<div class="clear"></div>
				</div>
				<div class="gdlr-header-bottom-gimmick"></div>
			</div>
		</div>
		<div class="clear"></div>	
		<?php 
			get_template_part( 'header', 'title' ); 
		?>
	</header>
	<?php } // page style ?>
	<div class="content-wrapper">