<div class="soundtheme-mini-share">
	<ul>
		<li><a href="#soundtheme-mini-modal" class="soundtheme-mini-link"><?php _e( 'Share', 'sound-theme' ); ?> <i class="fa fa-share-alt"></i></a></li>
	</ul>
	<div class="clearfix"></div>
	<div id="soundtheme-mini-modal" class="soundtheme-mini-popup mfp-hide">
	  	<ul>
	  		<!-- FACEBOOK -->
	  		<li>
				<button onclick="location.href='http://www.facebook.com/share.php?u=<?php echo get_post_permalink(); ?>&title=<?php echo get_the_title(); ?>'" formtarget="_blank">
						<i class="fa fa-facebook"></i>
					</button>
	  		</li>
	  		<!-- TWITTER -->
	  		<li>
				<button onclick="location.href='http://twitter.com/intent/tweet?status=<?php echo get_the_title(); ?> /+ <?php echo get_post_permalink(); ?>'" formtarget="_blank">
						<i class="fa fa-twitter"></i>
					</button>
	  		</li>
	  		<!-- GOOGLE -->
	  		<li>
				<button onclick="location.href='https://plus.google.com/share?url=<?php echo get_post_permalink(); ?>'" formtarget="_blank">
						<i class="fa fa-google-plus"></i>
					</button>
	  		</li>
	  		<!-- LINKEDIN -->
	  		<li>
				<button onclick="location.href='http://www.linkedin.com/shareArticle?mini=true&url=<?php echo get_post_permalink(); ?>&title=<?php echo get_the_title(); ?>'" formtarget="_blank">
						<i class="fa fa-linkedin"></i>
					</button>
	  		</li>
	  		<!-- TUMBLR -->
	  		<li>
				<button onclick="location.href='http://www.tumblr.com/share?v=3&u=<?php echo get_post_permalink(); ?>&t=<?php echo get_the_title(); ?>'" formtarget="_blank">
						<i class="fa fa-tumblr"></i>
					</button>
	  		</li>
	  		<!-- REDDIT -->
	  		<li>
				<button onclick="location.href='http://www.reddit.com/submit?url=<?php echo get_post_permalink(); ?>&title=<?php echo get_the_title(); ?>'" formtarget="_blank">
						<i class="fa fa-reddit"></i>
					</button>
	  		</li>
	  		<!-- DELICISIUS -->
	  		<li>
				<button onclick="location.href='http://del.icio.us/post?url=<?php echo get_post_permalink(); ?>&title=<?php echo get_the_title(); ?>&notes=<?php echo get_the_title(); ?>'" formtarget="_blank">
						<i class="fa fa-delicious"></i>
					</button>
	  		</li>
	  		<!-- STUMB -->
	  		<li>
				<button onclick="location.href='http://www.stumbleupon.com/submit?url=<?php echo get_post_permalink(); ?>&title=<?php echo get_the_title(); ?>'" formtarget="_blank">
						<i class="fa fa-stumbleupon"></i>
					</button>
	  		</li>
	  	</ul>
	  	<div class="clearfix"></div>
	</div>
</div>