<h1>{$l10n->_('Error')} {$code}</h1>


<div class="message">{$message}</div>

{if $debugMessage}
	
	<p><strong>{$file}</strong></p>
	<div id="ExceptionDetail">
		{$debugMessage}
	</div>

{/if}