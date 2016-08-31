<?php
/**
 * The header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="content">
 *
 * @package musik
 */

?><!DOCTYPE html>
<html <?php language_attributes(); ?> class="app">
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<section class="vbox">
    <header class="header header-md navbar navbar-fixed-top-xs">
      <div class="navbar-header aside <?php echo esc_attr( get_theme_mod( 'logo-bg-color', 'bg-info' ) ); ?>  <?php echo esc_attr( get_theme_mod( 'aside-folded' ) == 1 ? "nav-xs" : ''); ?>">
        <a class="btn btn-link visible-xs" data-toggle="class:nav-off-screen,open" data-target="#nav,html">
          <i class="icon-list"></i>
        </a>
        <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="navbar-brand text-lt" title="<?php echo esc_attr( get_bloginfo( 'description' ) ); ?>">
          <?php
          	$logo = get_theme_mod( 'logo' );
          	if("0" == $logo){ ?>
          		<i class="<?php echo esc_attr( get_theme_mod( 'logo-icon', 'icon-earphones' ) ); ?>"></i>
          		<span class="hidden-nav-xs m-l-sm"><?php bloginfo( 'name' ); ?></span>
          <?php } elseif("1" == $logo){ ?>
          		<img src="<?php echo esc_url( get_theme_mod( 'logo-img-sm' ) ); ?>">
          		<span class="hidden-nav-xs m-l-sm"><?php bloginfo( 'name' ); ?></span>
          <?php } elseif("2" == $logo){ ?>
          		<img class="visible-nav-xs" src="<?php echo esc_url( get_theme_mod( 'logo-img-sm' ) ); ?>">
          		<img class="hidden-nav-xs hidden-xs"  src="<?php echo esc_url( get_theme_mod( 'logo-img' ) ); ?>">
          <?php } ?>
        </a>
        <a class="btn btn-link visible-xs" data-toggle="collapse" data-target="#menu">
          <i class="icon-magnifier"></i>
        </a>
      </div>
      <div id="menu" class="collapse navbar-collapse <?php echo esc_attr( get_theme_mod( 'header-bg-color', 'bg-white' ) ); ?> ">
      	<?php
          if( get_theme_mod( 'hide-folded-btn' ) == 0 ){ ?>
	      	  <ul class="nav navbar-nav hidden-xs">
		        <li>
		          <a href="#nav,.navbar-header" data-toggle="class:nav-xs,nav-xs" class="text-muted">
		            <i class="fa fa-bars"></i>
		          </a>
		        </li>
		      </ul>
		  <?php } ?>
		  <?php if( get_theme_mod( 'hide-search' ) == 0 ){ ?>
		      <form class="navbar-form navbar-left m-t m-l-n-xs" role="search" method="get" action="<?php echo esc_url( home_url( '/' ) ); ?>">
		        <div class="form-group dropdown" id="ajax-search">
		          <div class="input-group">
		            <span class="input-group-btn">
		              <button type="submit" class="btn btn-sm bg-white btn-icon rounded"><i class="fa fa-search"></i></button>
		            </span>
		            <input type="text" value="<?php the_search_query(); ?>" autocomplete="off" class="form-control input-sm no-border rounded" name="s" placeholder="<?php _e('Search...', 'musik'); ?>">
		          </div>
		          <a id="ajax-search-toggle" data-target="#ajax-search" data-toggle="dropdown"></a>
			      <div class="dropdown-menu bg-white">
		        	<div id="ajax-search-loading" class="wrapper text-center"><i class="fa fa-spin icon-refresh"></i></div>
		        	<div id="ajax-search-results" class="list-group">

		        	</div>
			      </div>
		        </div>
		      </form>
	      <?php } ?>
	      <?php if( function_exists('edd_get_cart_quantity') && ( get_theme_mod( 'hide-cart-btn' ) == 0 ) ){ ?>
	      <div class="navbar-right">
	        <ul class="nav navbar-nav">
	          <li id="cart">
	            <a href="#" class="dropdown-toggle lt" data-toggle="dropdown">
	              <i class="icon-basket"></i>
	              <?php $cart_quantity = edd_get_cart_quantity(); ?>
	              <span class="badge badge-sm up bg-danger count edd-cart-quantity"><?php echo esc_html( $cart_quantity ); ?></span>
	              <span class="visible-xs-inline m-l-xs"><?php esc_html_e( 'Your Basket', 'musik' ); ?></span>
	            </a>
	            <section class="dropdown-menu aside-xl animated fadeInUp no-padder bg-white">
	              <?php the_widget( 'edd_cart_widget' ); ?> 
	            </section>
	          </li>
	        </ul>
	      </div>
	      <?php } ?>
	      <?php dynamic_sidebar( 'topbar' ); ?>
      </div>
    </header>
    <section>
		<section class="hbox stretch">
	        <!-- .aside -->
	        <aside id="nav" class="hidden-xs <?php echo esc_attr( get_theme_mod( 'aside-bg-color', 'bg-dark' ) ); ?> dk aside hidden-print <?php echo esc_attr( get_theme_mod( 'aside-folded' ) == 1 ? "nav-xs" : '' ); ?>">          
	          <section class="vbox">
	          	<section class="<?php if( get_theme_mod( 'hide-register-btn' ) == 0 ){ echo "w-f-md";} ?> scrollable hover">
		            <?php 
		            if ( has_nav_menu( 'primary' ) ) {
	                    $arg = array(
							'theme_location'  => 'primary',
							'menu'            => '',
							'container'       => 'nav',
							'container_class' => 'nav-primary bg hidden-xs',
							'menu_class'      => 'nav',
							'a_class'	  	  => 'font-bold',
							'echo'            => true,
							'items_wrap'      => '<ul id="%1$s" class="%2$s">%3$s <li class="m-b hidden-nav-xs"></li></ul>',
							'depth'           => 0,
							'walker'          => class_exists( 'menu_walker' ) ? new menu_walker : new Walker_Nav_Menunew
						);
			            wp_nav_menu( $arg ); 
	                } else {
	                    wp_page_menu();
	                }
		            ?>

		            <?php 
		            if ( has_nav_menu( 'secondary' ) ) {
	                    $arg = array(
							'theme_location'  => 'secondary',
							'container'       => 'nav',
							'container_class' => 'nav-primary hidden-xs',
							'menu_class'      => 'nav',
							'echo'            => true,
							'depth'           => 0,
							'walker'          => class_exists( 'menu_walker' ) ? new menu_walker : new Walker_Nav_Menunew
						);
			            wp_nav_menu( $arg ); 
	                }
	                ?>
		        </section>
		        <?php if( get_theme_mod( 'hide-register-btn' ) == 0 ){ ?>
			        <footer class="footer no-padder text-center-nav-xs">
		              	<div class="bg">
		                  <div class="dropdown dropup wrapper-sm clearfix">
		                    <?php if ( ! is_user_logged_in() ) : ?>
					            <a href="<?php echo esc_url( get_permalink( get_theme_mod( 'login-page') ) ); ?>" class="btn btn-block m-t-xs m-b-xxs">
					            	<i class="icon-user-follow"></i>
					            	<span class="hidden-nav-xs m-l"><?php esc_html_e( 'Login', 'musik' ); ?></span>
					            </a>
				            <?php else : ?>
				            	<a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown">
			                      <span class="thumb-sm avatar pull-left m-l-xs">                       
			                        <?php global $userdata; wp_get_current_user(); echo get_avatar( $userdata->ID, 60 );?>
			                      </span>
			                      <span class="hidden-nav-xs clear">
			                        <span class="block m-l m-t-sm text-ellipsis">
			                          <strong class="font-bold text-lt"><?php echo esc_html( $userdata->display_name ); ?></strong> 
			                          <b class="caret"></b>
			                        </span>
			                      </span>
			                    </a>
			                    <?php 
					            if ( has_nav_menu( 'user' ) ) {
				                    $arg = array(
										'theme_location'  => 'user',
										'menu_class'      => 'dropdown-menu animated fadeInRight aside text-left',
										'container'       => '',
										'echo'            => true
									);
						            wp_nav_menu( $arg ); 
				                }
					            ?>
							<?php endif; ?>
		                  </div>
		                </div>
		            </footer>
	            <?php } ?>
	          </section>
	        </aside>
	        <!-- /.aside -->
	        <section id="content">
	        	<a href="javascript:;" class="hide nav-off-screen-block" data-toggle="class:nav-off-screen,open" data-target="#nav,html"></a>
	        	<section class="vbox">
