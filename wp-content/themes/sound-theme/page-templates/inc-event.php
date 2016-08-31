<!-- SOUND THEME / VIDEO LIST -->
<div class="<?php if (get_field('soundtheme_musicshow_info') == "true"): ?> col-md-8 <?php else : ?> col-md-12 <?php endif; ?>	">
	<?php
		$soundtheme_tracklisttitle = esc_attr( get_field('soundtheme_sg_tracktitle'));
	?>
	<div class="soundtheme-single-titles">
		<?php if ($soundtheme_tracklisttitle) : ?>
			<h1><?php echo esc_attr($soundtheme_tracklisttitle); ?></h1>
		<?php else: ?>
			<h1><?php _e( 'Event', 'sound-theme' ); ?></h1>
		<?php endif; ?>
	</div>

	<div class="soundtheme-single-track">
		<?php 
		$location = get_field('soundtheme_embed_map');
		if( !empty($location) ):
		?>
		<div class="acf-map">
			<div class="marker" data-lat="<?php echo $location['lat']; ?>" data-lng="<?php echo $location['lng']; ?>"></div>
		</div>
		<?php endif; ?>
	</div>
</div>

<?php if (esc_attr( get_field('soundtheme_musicshow_info') == "true") ): ?>
<!-- SOUND THEME / INFO -->
<div class="col-md-4">

	<?php
		$soundtheme_sginfotitle = esc_attr( get_field('soundtheme_sg_infotitle'));
	?>
	<div class="soundtheme-single-titles">
		<?php if ($soundtheme_sginfotitle) : ?>
			<h1><?php echo esc_attr($soundtheme_sginfotitle); ?></h1>
		<?php else: ?>
			<h1><?php _e( 'Info', 'sound-theme' ); ?></h1>
		<?php endif; ?>
	</div>

	<?php
		$soundtheme_mininame = esc_attr( get_field('soundtheme_miniartist_name'));
		$soundtheme_miniurl = esc_url( get_field('soundtheme_miniartist_pageurl'));
		$soundtheme_minidate = esc_attr( get_field('soundtheme_minialbum_reldate'));
	?>
	<div class="soundtheme-single-mininfo">
		<ul>
			<!-- # ARTIST NAME -->
			<?php if ($soundtheme_mininame) : ?>
				<li>
					<?php if ($soundtheme_miniurl) : ?>
						<a href="<?php echo esc_url($soundtheme_miniurl); ?>">
							<i class="fa fa-male"></i> <?php echo esc_attr($soundtheme_mininame); ?>
						</a>
					<?php else : ?>
						<i class="fa fa-male"></i> <?php echo esc_attr($soundtheme_mininame); ?>
					<?php endif; ?>
				</li>
			<?php endif; ?>
			<!-- # ALBUM DATE -->
			<?php if ($soundtheme_minidate) : ?>
				<li>
					<i class="fa fa-calendar-check-o"></i> <?php _e( 'Release Date:', 'sound-theme' ); ?> <span><?php echo esc_attr($soundtheme_minidate); ?></span>
				</li>
			<?php endif; ?>
			<!-- # OTHERS -->
			<?php if( have_rows('soundtheme_miniadd_info') ): $i = 0; ?>
				<?php while( have_rows('soundtheme_miniadd_info') ): the_row($i++); 
					$soundtheme_minifa = esc_attr( get_sub_field('soundtheme_minifa_icon'));
					$soundtheme_minititles = esc_attr( get_sub_field('soundtheme_minititle_infos'));
					$soundtheme_minisub = esc_attr( get_sub_field('soundtheme_minititle_sub'));
				?>
				<li>
					<i class="fa <?php echo esc_attr( $soundtheme_minifa); ?>"></i> <?php echo esc_attr( $soundtheme_minititles); ?> <span><?php echo esc_attr( $soundtheme_minisub); ?></span>
				</li>
				<?php endwhile; ?>
			<?php endif; ?>	
		</ul>
	</div>
	<div class="clearfix"></div>

	<!-- SOUND THEME / BUY BUTTONS -->
	<?php if( have_rows('soundtheme_addbuy_albums') ): $i = 0; ?>
		<div class="soundtheme-single-buy">
			
			<?php
				$soundtheme_mainbtn = esc_attr( get_field('soundtheme_main_btntitle'));
			?>
			<a href="#soundtheme-mini-buymodal" class="soundtheme-mini-link btn btn-block btn-success btn-lg">
				<?php if ($soundtheme_mainbtn) : ?> <?php echo esc_attr($soundtheme_mainbtn); ?> <?php else : ?> <?php _e( 'Buy Now', 'sound-theme' ); ?><?php endif; ?>	
			</a>

			<div id="soundtheme-mini-buymodal" class="soundtheme-mini-popup soundtheme-buy-popup mfp-hide">

				<?php while( have_rows('soundtheme_addbuy_albums') ): the_row($i++); 
					$soundtheme_buytitle = esc_attr( get_sub_field('soundtheme_buyalbum_title'));
					$soundtheme_buylink = esc_url( get_sub_field('soundtheme_buybutton_link'));
					$soundtheme_buyicon = esc_attr( get_sub_field('soundtheme_buybutton_icon'));
				?>
					<a href="<?php echo esc_url($soundtheme_buylink); ?>" class="btn btn-block btn-primary btn-lg">
						<i class="fa <?php echo esc_attr( $soundtheme_buyicon); ?>"></i> <?php echo esc_attr($soundtheme_buytitle); ?>
					</a>
				<?php endwhile; ?>

			</div>

		</div>
	<?php endif; ?>	
</div>
<?php endif; ?>	