
	{if !$wp->isSingular}

		{if $wp->isSearch}

			{*** SEARCH RESULTS ONLY ***}

			<article {!$post->htmlId} {!$post->htmlClass}>
				<header class="entry-header">

					<div class="entry-title">
						<div class="entry-title-wrap">

							<h2><a href="{$post->permalink}">{!$post->title}</a></h2>

							<div class="entry-data">
								{includePart parts/entry-date}
								{if $post->isInAnyCategory}
									{includePart parts/entry-categories}
								{/if}
							</div>

						</div><!-- /.entry-title-wrap -->
					</div><!-- /.entry-title -->
				</header><!-- /.entry-header -->

				<div class="entry-content loop">
					{!$post->excerpt}
				</div><!-- .entry-content -->

				<footer class="entry-footer">
					<a href="{$post->permalink}" class="more">{!__ '%s Continue reading ...'|printf: '<span class="meta-nav">&rarr;</span>'}</a>
				</footer><!-- /.entry-footer -->
			</article>

		{else}

			{*** STANDARD LOOP ***}

			<article {!$post->htmlId} n:class="$post->imageUrl ? $post->htmlClass('', false) : $post->htmlClass('no-post-thumbnail',false)">

				<div class="entry-thumbnail">
					{if $post->hasImage}
						<div class="entry-thumbnail-wrap entry-content">
							<a href="{$post->permalink}" class="thumb-link">
								<span class="entry-thumbnail-icon">
									<img src="{imageUrl $post->imageUrl, width => 640, height => 420, crop => 1}">
								</span>
							</a>
						</div>
					{/if}

				</div>

				<header class="entry-header {if !$post->hasImage}nothumbnail{/if}">

					<div class="entry-title">
						<div class="entry-title-wrap">

							<h2><a href="{$post->permalink}">{!$post->title}</a></h2>

							<div class="entry-data">
								{includePart parts/entry-date}
								{if $post->type == post}
									{includePart parts/entry-author}
								{/if}
								{includePart parts/comments-link}
							</div>

						</div><!-- /.entry-title-wrap -->
					</div><!-- /.entry-title -->


				</header><!-- /.entry-header -->

				<div class="entry-content loop">
					{if $post->hasContent}
						{!$post->excerpt}
					{else}
						{!$post->content}
					{/if}
				</div><!-- .entry-content -->

				<footer class="entry-footer">
					<a href="{$post->permalink}" class="more">{!__ '%s Continue reading ...'|printf: '<span class="meta-nav">&rarr;</span>'}</a>

					<div class="entry-meta">
						{if $post->isSticky and !$wp->isPaged and $wp->isHome}
							<span class="featured-post">{__ 'Featured post'}</span>
						{/if}

						{capture $editLinkLabel}<span class="edit-link">{!__ 'Edit'}</span>{/capture}
						{!$post->editLink($editLinkLabel)}
					</div><!-- /.entry-meta -->

					{if $post->isInAnyCategory}
						{includePart parts/entry-categories}
					{/if}

				</footer><!-- .entry-footer -->
			</article>
		{/if}

	{else}

		{*** POST DETAIL ***}

		<article {!$post->htmlId} class="content-block">

			{if $post->imageUrl}
				<div class="entry-thumbnail">
					<div class="entry-thumbnail-wrap">
						<a href="{$post->imageUrl}" class="thumb-link">
							<span class="entry-thumbnail-icon">
								<img src="{imageUrl $post->imageUrl, width => 1000, height => 500, crop => 1}" alt="{$titleName}">
							</span>
						</a>
					</div>
				</div>
			{/if}

			<div class="entry-data">
				<div class="entry-data-left">
					{includePart parts/entry-date}
					{includePart parts/entry-author}
					{includePart parts/comments-link}
				</div>
				<div class="entry-data-right">
					{includePart parts/entry-categories}
				</div>
			</div>

			<div class="entry-content">
				{!$post->content}
				{!$post->linkPages}
			</div><!-- .entry-content -->

			<footer class="entry-footer">
				{if $wp->isSingle and $post->author->bio and $post->author->isMulti}
					{includePart parts/author-bio}
				{/if}
			</footer><!-- .entry-footer -->
		</article>

	{/if}
