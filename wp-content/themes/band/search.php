{block content}

	{* template for page title is in parts/page-title.php *}

	{if $wp->havePosts}
		{includePart parts/pagination, location => pagination-above}

		{loop as $post}
			{includePart parts/post-content}
		{/loop}

		{includePart parts/pagination, location => pagination-below}

	{else}

		{includePart parts/none, message => nothing-found}

	{/if}
