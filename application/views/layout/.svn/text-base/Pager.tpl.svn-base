{if $pager.totalPages gt 1}
	<ul class="pager">
	{foreach from=$pager.pages item=page key=i}
	   <li>
	       {if $page.current == true || $page.url == '#'}
	           <strong>{$page.number}</strong>
	       {else}
	           <a href="{$page.url}">{$page.number}</a>
	       {/if}
	   </li>
	{/foreach}
	</ul>
{/if}