<span class="author vcard">

	{capture $authorlink}
		<span class="auth-links">
			<a class="url fn n" href="{$post->author->postsUrl}" title="{__ 'View all posts by %s'|printf: $post->author}" rel="author">{$post->author}</a>
		</span>
	{/capture}
	{!__ 'Posted by %s'|printf:$authorlink}

</span>