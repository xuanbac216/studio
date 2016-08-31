{if $options->theme->social->enableSocialIcons}
<div class="social-icons">
	<ul><!--
		{foreach $options->theme->social->socIcons as $icon}
			--><li>
				<a href="{$icon->url}" {if $options->theme->social->socIconsNewWindow}target="_blank"{/if}>
					{if $icon->icon}<img src="{$icon->icon}" class="s-icon s-icon-light" alt="icon">{/if}
					{if $icon->iconDark}<img src="{$icon->iconDark}" class="s-icon s-icon-dark" alt="icon">{/if}
					<span class="s-title">{$icon->title}</span>
				</a>
			</li><!--
		{/foreach}
	--></ul>
</div>
{/if}
