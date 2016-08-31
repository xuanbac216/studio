{if $dateIcon}

	{var $rawDate = $dateIcon} {* better variable name*}

	{var $dayFormat = ''}
	{var $dayFormatSuffix = ''}
	{var $monthFormat = ''}
	{var $yearFormat = ''}


	<span class="entry-date updated {if $dateShort == 'yes'}short-date{/if}">

		{capture $dayFormat}{_x 'j', 'day date format'}{/capture}
		{capture $dayFormatSuffix}{if $currentLang->slug == 'en'}{_x 'S', 'english ordinal suffix for the day'}{else}.{/if}{/capture}

		{if $dateShort == 'yes'}	{capture $monthFormat}{_x 'M', 'month date short format'}{/capture}
		{else}						{capture $monthFormat}{_x 'F', 'month date long format'}{/capture} {/if}

		{capture $yearFormat}{_x 'Y',  'year date format'}{/capture}

		{if $dateLinks == 'yes'}

			<time class="date" datetime="{$rawDate|date: 'c'}">
				<a class="link-day" href="{$post->dayArchiveUrl}" title="{__ 'Link to daily archives: %s'}{$rawDate|dateI18n}">
					{$rawDate|dateI18n: $dayFormat}{if !empty($dayFormatSuffix)}<small>{$rawDate|dateI18n: $dayFormatSuffix}</small>{/if}
				</a>
				<a class="link-month" href="{$post->monthArchiveUrl}" title="{__ 'Link to monthly archives: %s'}{$rawDate|dateI18n: $monthFormat}">
					{$rawDate|dateI18n: $monthFormat}
				</a>
				<a class="link-year" href="{$post->yearArchiveUrl}" title="{__ 'Link to yearly archives: %s'}{$rawDate|dateI18n: $yearFormat}">
					{$rawDate|dateI18n: $yearFormat}
				</a>
			</time>

		{else}

			<time class="date" datetime="{$rawDate|date: 'c'}">
				<span class="link-day">
					{$rawDate|dateI18n: $dayFormat}{if !empty($dayFormatSuffix)}<small>{$rawDate|dateI18n: $dayFormatSuffix}</small>{/if}
				</span>
				<span class="link-month">
					{$rawDate|dateI18n: $monthFormat}
				</span>
				<span class="link-year">
					{$rawDate|dateI18n: $yearFormat}
				</span>
			</time>

		{/if}

	</span>

{/if}
