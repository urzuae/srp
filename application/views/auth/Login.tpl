<script type="text/javascript" src="{$baseUrl}/js/modules/auth/login.js"></script>
<div id="loginFormContainer">
	{if $errorMessage}
		<div class="error">{$errorMessage}</div><br />
	{else}
		<br/><br/>
	{/if}
	<form action="{$baseUrl}/auth/login" method="post" id="loginForm">
		<table>
			<caption>{$l10n->_('Iniciar Sesión')}</caption>
			<tfoot>
				<tr>
					<td colspan="2"><input type="submit" value="{$l10n->_('Iniciar Sesión')}"/></td>
				</tr>
			</tfoot>
			<tbody>
				<tr>
					<td><label for="username">{$l10n->_('Usuario')}:</label></td>
					<td><input type="text" name="username" id="username" value="{$post.username}"/></td>
				</tr>
				<tr>
					<td><label for="password">{$l10n->_('Contraseña')}:</label></td>
					<td><input type="password" name="password" id="password" value=""/></td>
				</tr>
			</tbody>
		</table>
	</form>
</div>