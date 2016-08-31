<?php
/**
 * The template for displaying the header
 *
 * Displays all of the head element and everything up until the "content" div.
 *
 * @package WordPress
 * @subpackage sound-theme
 * @since sound-theme
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js">
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width">
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

<?php if ( ! class_exists( 'Acf' ) ) : ?>

	<!-- SOUND THEME / SEARH BAR -->
	<div class="soundtheme-top-search">
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<div class="soundtheme-top-search-form">
						<form role="search" method="get" id="searchform" class="soundtheme-search searchform"  action="<?php echo esc_url( home_url( '/' ) ); ?>">
							<input type="text" value="" name="s" id="s" placeholder="<?php _e( 'Type and Press Enter to Search ..', 'sound-theme' ); ?>" onfocus="this.placeholder = ''" onblur="this.placeholder = '<?php _e( 'Type and Press Enter to Search ..', 'sound-theme' ); ?>'" />
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>

	<!-- SOUND THEME / SIDEBAR OPTIONS -->
	<div class="soundtheme-sidebar-menu soundtheme-sidebar-menu-two">
		<!-- TAB MENU -->
		<div class="soundtheme-sidebar-tab">
			<ul>
				<li class="active">
					<a href="#sidebarmenu" data-toggle="tab">
						<span class="soundtheme-btn-tab-sidebar">
							<?php _e( 'Menu', 'sound-theme' ); ?>
						</span>
					</a>
				</li>
				<li>
					<a href="#sidebarwidget" data-toggle="tab">
						<span class="soundtheme-btn-tab-sidebar">
							<?php _e( 'Widget', 'sound-theme' ); ?>
						</span>
					</a>
				</li>
			</ul>
			<div class="clearfix"></div>
			<div class="hidden-sm hidden-md hidden-lg soundtheme-sidebar-closed">
				<span class="btn btn-block btn-lg btn-success">
					<i class="fa fa-times"></i> <?php _e( 'Close', 'sound-theme' ); ?>
				</span>
			</div>
			<div class="clearfix"></div>
		</div>
		<div class="clearfix"></div>

		<!-- TAB CONTENT -->
		<div class="tab-content soundtheme-tab-content">
			<!-- #1 -->
			<div class="tab-pane active" id="sidebarmenu">
				<?php wp_nav_menu( array( 'theme_location'=>'primary', 'menu_class' => 'main-nav' ) ); ?>
			</div>
			<!-- #2 -->
			<div class="tab-pane" id="sidebarwidget">

				<div class="soundtheme-dark-widget">
					<?php if ( is_active_sidebar( 'sidebar-10' ) ) { ?>
						<?php dynamic_sidebar( 'sidebar-10' ); ?>
					<?php } ?>
				</div>
				<div class="clearfix"></div>
				<div class="soundtheme-dark-widget-space"></div>
			</div>
		</div>
	</div>

	<!-- SOUND THEME / TOP NAVIGATION -->
	<div class="container-fluid soundtheme-nav-fixed">
		<div class="container">
			<div class="row">

				<!-- SOUND THEME / LOGO AREA -->
				<div class="col-sm-6 col-md-6">
					<div class="soundtheme-logo hidden-sm hidden-xs">
						<a href="<?php echo esc_url( home_url( '/' ) ); ?>">
							<img src="<?php echo esc_url( get_template_directory_uri() . '/images/sound/logo.png' ); ?>" alt="Logo">
						</a>
					</div>
					<div class="soundtheme-logo hidden-md hidden-lg">
						<a href="<?php echo esc_url( home_url( '/' ) ); ?>">
							<img src="<?php echo esc_url( get_template_directory_uri() . '/images/sound/logo.png' ); ?>" alt="Logo">
						</a>
					</div>
				</div>
				<div class="col-sm-6 col-md-6">
					<div class="soundtheme-menu-icon">
						<ul>
							<li class="hidden-xs hidden-sm">
								<button class="soundtheme-btn-sidebar">
									<i class="fa fa-bars"></i> <?php _e( 'Menu', 'sound-theme' ); ?>
								</button>
							</li>
							<li class="hidden-md hidden-lg">
								<button class="soundtheme-btn-sidebar">
									<i class="fa fa-bars"></i>
								</button>
							</li>
							<li>
								<button class="soundtheme-btn-search">
									<i class="fa fa-search"></i>
								</button>
							</li>
						</ul>
					</div>
					<div class="clearfix"></div>
				</div>
			</div>
		</div>
		<div class="clearfix"></div>
	</div>
	<div class="clearfix"></div>

<?php else: ?>
	<!-- SOUND THEME / SETTINGS -->
	<?php get_template_part( 'inc/soundtheme-css', 'header' ); ?>

	<!-- SOUND THEME / MUSIC PLAYER -->
	<div id="fap">
		<?php if( have_rows('soundtheme_fxpl', 'option') ): $i = 0; ?>
			<?php while( have_rows('soundtheme_fxpl', 'option') ): the_row($i++); 
				$soundtheme_title = esc_attr( get_sub_field('soundtheme_fxpl_subname', 'option'));
				$soundtheme_upload = esc_url( get_sub_field('soundtheme_fxpl_subupload', 'option'));
				$soundtheme_track = esc_url( get_sub_field('soundtheme_fxpl_sublink', 'option'));
			?>
			<a data-music="<?php if (get_sub_field('soundtheme_fxpl_subselect', 'option') == "upload"): ?> <?php echo esc_url( $soundtheme_upload ); ?> <?php elseif (get_sub_field('soundtheme_fxpl_subselect', 'option') == "link"): ?>  <?php echo esc_url( $soundtheme_track ); ?> <?php endif; ?>" title="<?php echo esc_attr( $soundtheme_title); ?>" target="<?php echo esc_url( home_url( '/' ) ); ?>"></a>
			<?php endwhile; ?>
		<?php endif; ?>
	</div>

	<!-- SOUND THEME / SEARH BAR -->
	<div class="soundtheme-top-search">
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<div class="soundtheme-top-search-form">
						<form role="search" method="get" id="searchform" class="soundtheme-search searchform"  action="<?php echo esc_url( home_url( '/' ) ); ?>">
							<input type="text" value="" name="s" id="s" placeholder="<?php _e( 'Type and Press Enter to Search ..', 'sound-theme' ); ?>" onfocus="this.placeholder = ''" onblur="this.placeholder = '<?php _e( 'Type and Press Enter to Search ..', 'sound-theme' ); ?>'" />
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>

	<!-- SOUND THEME / SIDEBAR OPTIONS -->
	<div class="soundtheme-sidebar-menu soundtheme-sidebar-menu-two">
		<!-- TAB MENU -->
		<?php
			$soundtheme_sidebar_tabone = esc_attr( get_field('soundtheme_sidebar_tabone' , 'option'));
			$soundtheme_sidebar_tabtwo = esc_attr( get_field('soundtheme_sidebar_tabtwo' , 'option'));
		?>
		<div class="soundtheme-sidebar-tab">
			<ul>
				<li class="active">
					<a href="#sidebarmenu" data-toggle="tab">
						<span class="soundtheme-btn-tab-sidebar">
							<?php if ($soundtheme_sidebar_tabone) : ?>
								<?php echo esc_attr($soundtheme_sidebar_tabone); ?>
							<?php else: ?>
								<?php _e( 'Menu', 'sound-theme' ); ?>
							<?php endif; ?>
						</span>
					</a>
				</li>
				<li>
					<a href="#sidebarwidget" data-toggle="tab">
						<span class="soundtheme-btn-tab-sidebar">
							<?php if ($soundtheme_sidebar_tabtwo) : ?>
								<?php echo esc_attr($soundtheme_sidebar_tabtwo); ?>
							<?php else: ?>
								<?php _e( 'Widget', 'sound-theme' ); ?>
							<?php endif; ?>
						</span>
					</a>
				</li>
			</ul>
			<div class="clearfix"></div>
			<div class="hidden-sm hidden-md hidden-lg soundtheme-sidebar-closed">
				<span class="btn btn-block btn-lg btn-success">
					<i class="fa fa-times"></i> <?php _e( 'Close', 'sound-theme' ); ?>
				</span>
			</div>
			<div class="clearfix"></div>
		</div>
		<div class="clearfix"></div>

		<!-- TAB CONTENT -->
		<div class="tab-content soundtheme-tab-content">
			<!-- #1 -->
			<div class="tab-pane active" id="sidebarmenu">
				<?php wp_nav_menu( array( 'theme_location'=>'primary', 'menu_class' => 'main-nav' ) ); ?>
			</div>
			<!-- #2 -->
			<div class="tab-pane" id="sidebarwidget">

				<div class="soundtheme-dark-widget">
					<?php if ( is_active_sidebar( 'sidebar-10' ) ) : ?>
						<?php dynamic_sidebar( 'sidebar-10' ); ?>
					<?php endif; ?>
				</div>
				<div class="clearfix"></div>
				<div class="soundtheme-dark-widget-space"></div>
			</div>
		</div>
	</div>

	<!-- SOUND THEME / TOP NAVIGATION -->
	<div class="container-fluid soundtheme-nav-fixed">
		<div class="container">
			<div class="row">

				<!-- SOUND THEME / LOGO AREA -->
				<?php
					$soundtheme_logo = esc_url( get_field('soundtheme_logo' , 'option') );
					$soundtheme_logo_2x = esc_url( get_field('soundtheme_logo_2x' , 'option') );
				?>
				<div class="col-sm-6 col-md-6">
					<div class="soundtheme-logo hidden-sm hidden-xs">
						<a href="<?php echo esc_url( home_url( '/' ) ); ?>">
							<?php if ($soundtheme_logo) : ?>
								<img src="<?php echo esc_url($soundtheme_logo); ?>" alt="Logo">
							<?php else: ?>
								<img src="<?php echo esc_url( get_template_directory_uri() . '/images/sound/logo.png' ); ?>" alt="Logo">
							<?php endif; ?>
						</a>
					</div>
					<div class="soundtheme-logo hidden-md hidden-lg">
						<a href="<?php echo esc_url( home_url( '/' ) ); ?>">
							<?php if ($soundtheme_logo_2x) : ?>
								<img src="<?php echo esc_url($soundtheme_logo_2x); ?>" alt="Logo">
							<?php else: ?>
								<img src="<?php echo esc_url( get_template_directory_uri() . '/images/sound/logo.png' ); ?>" alt="Logo">
							<?php endif; ?>
						</a>
					</div>
				</div>
				<div class="col-sm-6 col-md-6">
					<div class="soundtheme-menu-icon">
						<ul>
							<li class="hidden-xs hidden-sm">
								<button class="soundtheme-btn-sidebar">
									<i class="fa fa-bars"></i> <?php _e( 'Menu', 'sound-theme' ); ?>
								</button>
							</li>
							<li class="hidden-md hidden-lg">
								<button class="soundtheme-btn-sidebar">
									<i class="fa fa-bars"></i>
								</button>
							</li>
							<li>
								<button class="soundtheme-btn-search">
									<i class="fa fa-search"></i>
								</button>
							</li>
						</ul>
					</div>
					<div class="clearfix"></div>
				</div>
			</div>
		</div>
		<div class="clearfix"></div>
	</div>
	<div class="clearfix"></div>
<?php endif; ?>

<!-- SOUND THEME / AJAX CONTENT START -->
<div id="content" class="site-content">