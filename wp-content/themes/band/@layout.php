{getHeader}

{if $elements->unsortable[revolution-slider]->display}
	{includeElement $elements->unsortable[revolution-slider]}
{/if}

<div id="main" class="elements">

	{if $elements->unsortable[page-title]->display}
	    {includeElement $elements->unsortable[page-title]}
	{/if}

	{includePart parts/breadcrumbs}


	<div class="main-sections">
	{foreach $elements->sortable as $element}

		{if $element->id == sidebars-boundary-start}

		<div class="elements-with-sidebar">
			<div class="elements-sidebar-wrap">
				{if $wp->hasSidebar(left)}
					{getSidebar left}
				{/if}
				<div class="elements-area">

		{elseif $element->id == sidebars-boundary-end}

				</div><!-- .elements-area -->
				{if $wp->hasSidebar(right)}
					{getSidebar}
				{/if}
				</div><!-- .elements-sidebar-wrap -->
			</div><!-- .elements-with-sidebar -->

		{else}
			{? global $post}
			{if $element->id == 'comments' && $post == null}
				<!-- COMMENTS DISABLED - IS NOT SINGLE PAGE -->
			{elseif $element->id == 'comments' && !comments_open($post->ID) && get_comments_number($post->ID) == 0}
				<!-- COMMENTS DISABLED -->
			{else}
				<section n:if="$element->display" id="{$element->htmlId}-main" class="{$element->htmlClasses}">

					<div class="elm-wrapper {$element->htmlClass}-wrapper">

						{includeElement $element}

					</div><!-- .elm-wrapper -->

				</section>
			{/if}
		{/if}
	{/foreach}
	</div><!-- .main-sections -->
</div><!-- #main .elements -->

{getFooter}
