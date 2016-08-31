{* ********************************************************* *}
{* COMMON DATA                                               *}
{* ********************************************************* *}

	{capture $navPrevText}{!_x '%s Prev', 'previous' |printf: '<span class="meta-nav">&larr;</span>'}{/capture}
	{capture $navNextText}{!_x 'Next %s', 'next' |printf: '<span class="meta-nav">&rarr;</span>'}{/capture}


	{capture $navPrevText}{!_x '%s Prev', 'previous' |printf: '<span class="meta-nav">&larr;</span>'}{/capture}
	{capture $navNextText}{!_x 'Next %s', 'next' |printf: '<span class="meta-nav">&rarr;</span>'}{/capture}

	{if !isset($location)} {var $location = ''} {/if}
	{if !isset($arrow)} {var $arrow = ''} {/if}

	{var $arrowLeft = ''}
	{var $arrowRight = ''}

{* ********************************************************* *}
{* for ATTACHMENT				                             *}
{* ********************************************************* *}
{if $wp->isAttachment}
	{var $arrowLeft = 'yes'}
	{var $arrowRight = 'yes'}
	{capture $navPrevLink}<span class="nav-previous">{prevImageLink false, $navPrevText}</span>{/capture}
	{capture $navNextLink}<span class="nav-next">{nextImageLink false, $navNextText}</span>{/capture}
{* ********************************************************* *}
{* for POST DETAIL, IMAGE DETAIL and PORTFOLIO DETAIL 		 *}
{* ********************************************************* *}
{elseif $wp->isSingle}
	{if $wp->hasPreviousPost or $wp->hasNextPost}
		{if $wp->hasPreviousPost}
			{var $arrowLeft = 'yes'}
			{capture $navPrevLink}<span class="nav-previous">{prevPostLink $navPrevText}</span>{/capture}
		{/if}
		{if $wp->hasNextPost}
			{var $arrowRight = 'yes'}
			{capture $navNextLink}<span class="nav-next">{nextPostLink $navNextText}</span>{/capture}
		{/if}
	{/if}
{* ********************************************************* *}
{* for OTHER										 		 *}
{* ********************************************************* *}
{else}
	{if $wp->willPaginate}
		{if $wp->hasPreviousPosts}
			{var $arrowLeft = 'yes'}
			{capture $navPrevLink}<span class="nav-previous">{prevPostsLink $navPrevText}</span>{/capture}
		{/if}
		{if $wp->hasNextPosts}
			{var $arrowRight = 'yes'}
			{capture $navNextLink}<span class="nav-next">{nextPostLink $navNextText}</span>{/capture}
		{/if}
	{/if}
{/if}

{* ********************* *}
{* RESULTS               *}
{* ********************* *}
{if $arrow != ''}
	{if $arrow == 'left'}
		{if $arrowLeft == 'yes'}{!$navPrevLink}{/if}
	{else}
		{if $arrowRight == 'yes'}{!$navNextLink}{/if}
	{/if}
{else}
	<nav class="nav-single {$location}" role="navigation">
	{if $arrowLeft == 'yes'}{!$navPrevLink}{/if}
	{if $wp->willPaginate}{if !$wp->isSingular}{pagination}{/if}{/if}
	{if $arrowRight == 'yes'}{!$navNextLink}{/if}
	</nav>
{/if}
