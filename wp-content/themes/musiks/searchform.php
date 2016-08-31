<form role="search" method="get" id="searchform" class="searchform" action="<?php echo esc_url( home_url( '/' ) ); ?>">
	<div class="input-group">
		<input type="text" value="<?php the_search_query(); ?>" name="s" id="s" class="form-control"/>
		<span class="input-group-btn">
	        <button class="btn btn-default" type="button"><?php esc_html_e( 'Search', 'musik' ); ?></button>
	    </span>
	</div>
</form>
