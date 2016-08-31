{block content}

	{* template for page title is in parts/page-title.php *}

	{loop as $post}

		<article {!$post->htmlId} class="content-block">

			<div class="entry-content">
				{!$post->content}
				{!$post->linkPages}
			</div><!-- .entry-content -->

		</article><!-- #post -->
	{/loop}