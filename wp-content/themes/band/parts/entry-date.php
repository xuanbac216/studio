<span class="entry-date">
		{if $wp->isSingular(event) || $wp->isSingular(job-offer)}

			{if $wp->isSingular(event)}
				{var $meta = $post->meta('event-data')}

				<time class="date" datetime="{$meta->dateFrom|date: 'c'}">
					{capture $dayFormat}{_x 'j', 'day date format'}{/capture}
					{capture $dayFormatSuffix}{_x 'S', 'english ordinal suffix for the day'}{/capture}
					<span class="link-day">
						{$meta->dateFrom|dateI18n: $dayFormat}{if !empty($dayFormatSuffix)}<small>{$meta->dateFrom|dateI18n: $dayFormatSuffix}</small>{/if}
					</span>

					{capture $monthFormat}{_x 'F', 'month date format'}{/capture}
					<span class="link-month">
						{$meta->dateFrom|dateI18n: $monthFormat}
					</span>

					{capture $yearFormat}{_x 'Y',  'year date format'}{/capture}
					<span class="link-year">
						{$meta->dateFrom|dateI18n: $yearFormat}
					</span>
				</time>
			{/if}

			{if $wp->isSingular(job-offer)}
				{var $meta = $post->meta('offer-data')}

				<time class="date" datetime="{$meta->validFrom|date: 'c'}">
		 			{capture $dayFormat}{_x 'j', 'day date format'}{/capture}
		 			{capture $dayFormatSuffix}{_x 'S', 'english ordinal suffix for the day'}{/capture}
					<span class="link-day">
						{$meta->validFrom|dateI18n: $dayFormat}{if !empty($dayFormatSuffix)}<small>{$meta->validFrom|dateI18n: $dayFormatSuffix}</small>{/if}
					</span>

					{capture $monthFormat}{_x 'F', 'month date format'}{/capture}
					<span class="link-month">
						{$meta->validFrom|dateI18n: $monthFormat}
					</span>

					{capture $yearFormat}{_x 'Y',  'year date format'}{/capture}
					<span class="link-year">
						{$meta->validFrom|dateI18n: $yearFormat}
					</span>
				</time>
			{/if}

		{else}

		<time class="date" datetime="{$post->date('c')}">
			{capture $monthFormat}{_x 'F', 'month date format'}{/capture}
			<a class="link-month" href="{$post->monthArchiveUrl}" title="{__ 'Link to monthly archives: %s'|printf:$post->dateI18n($monthFormat)}">
				{$post->dateI18n($monthFormat)}
			</a>

			<a class="link-day" href="{$post->dayArchiveUrl}" title="{__ 'Link to daily archives: %s'|printf:$post->dateI18n}">
				{capture $dayFormat}{_x 'j', 'day date format'}{/capture}
				{$post->dateI18n($dayFormat)}{if !empty($dayFormatSuffix)}{/if},
			</a>

			{capture $yearFormat}{_x 'Y',  'year date format'}{/capture}
			<a class="link-year" href="{$post->yearArchiveUrl}" title="{__ 'Link to yearly archives: %s'|printf:$post->dateI18n($yearFormat)}">
				{$post->dateI18n($yearFormat)}
			</a>
		</time>


		{/if}
</span>
