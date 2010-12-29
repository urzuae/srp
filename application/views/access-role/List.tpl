
<form action="{url action=create}" method="post" class="validate ajaxForm">
<table class="center">
	<caption>{$l10n->_('Guardar nuevo Grupo de Usuario')}</caption>
	<tfoot>
		<tr>
			<td colspan="2"><input type="submit" value="{$l10n->_('Guardar')}" /></td>
		</tr>
	</tfoot>
	<tbody>
		<tr>
			<th>{$l10n->_('Nombre')}</th>
			<th><input type="text" id="name" name="name" class="required"/></th>
		</tr>
	</tbody>
</table>
</form>
<hr/>


<table class="center">
	<caption>{$l10n->_('Lista de Grupos de Usuario')}</caption>
	<thead>
		<tr>
			<td>#</td>
			<td>{$l10n->_('Nombre')}</td>
			<td colspan="2">{$l10n->_('Acciones')}</td>
		</tr>
	</thead>
	<tbody id="ajaxList">
		{foreach $accessRoles as $accessRole}
			<tr class="{$accessRole@iteration|odd}">
				<td>{$accessRole->getIdAccessRole()}</td>
				<td>{$accessRole->getName()}</td>
				<td><a href="{url action=edit id=$accessRole->getIdAccessRole()}">{icon src=pencil class=tip title=Editar}</a></td>
				<td><a href="{url action=delete id=$accessRole->getIdAccessRole()}" class="confirm">{icon src=delete class=tip title=Borrar}</a></td>
			</tr>
		{/foreach}
	</tbody>
</table>