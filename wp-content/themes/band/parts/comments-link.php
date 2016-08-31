{if $post->hasCommentsOpen}
	<div class="comments-link">
		<a href="{$post->commentsUrl}" title="{__ 'Comments on %s'|printf: $post->title}">
			{if $post->commentsNumber > 1}
				<span class="comments-count" title="{__ '%d Comments'|printf: $post->commentsNumber}">
					<span class="comments-text">{__ 'Comments:'}</span> {$post->commentsNumber}
				</span>
			{elseif $post->commentsNumber == 0}
				<span class="comments-count" title="{__ 'Leave a comment'}">
					<span class="comments-text">{__ 'Comments:'}</span> 0
				</span>
			{else}
				<span class="comments-count" title="{__ '1 Comment'}">
					<span class="comments-text">{__ 'Comments:'}</span> 1
				</span>
			{/if}
		</a>
	</div><!-- .comments-link -->
{/if}
