
<div class="center">

<form action="{$baseUrl}/user/{if $post.id}update{else}create{/if}/" method="post" class="validate">
<div class="center" align="center">
    <table>
        <caption>{$l10n->_('Guardar nuevo usuario')}</caption>
        <tbody>
            <tr>
                <th><label for="username">{$l10n->_('Usuario')}:</label></th>
                <td><input type="text" name="username" id="username" value="{$post.username}" size="40" class="required" {if $isNew==false}readonly="readonly"{/if} /></td>
                <th><label for="name">{$l10n->_('Nombre')}:</label></th>
                <td><input type="text" name="name" id="name" value="{$post.name}" size="40" class="required"/></td>
            </tr>
            <tr>
                <th><label for="middlename">{$l10n->_('Apellido Paterno')}:</label></th>
                <td><input type="text" name="middlename" id="middlename" value="{$post.middlename}" size="40" class="required"/></td>
                <th><label for="lastname">{$l10n->_('Apellido Materno')}:</label></th>
                <td><input type="text" name="lastname" id="lastname" value="{$post.lastname}" size="40" /></td>
            </tr>
            <tr>
                <th><label for="password">{$l10n->_('Contraseña')}:</label></th>
                <td><input type="password" name="password" id="password" value="" size="40" class="{if $isNew}required{/if}"/></td>
                <th><label for="passwordConfirm">{$l10n->_('Confirmar Contraseña')}:</label></th>
                <td><input type="password" name="passwordConfirm" id="passwordConfirm" value="" size="40"  class="{if $isNew}required{/if}"/></td>
            </tr>
            <tr>
                <th><label for="group">{$l10n->_('Grupo')}:</label></th>
                <td> {html_options name=accessRole id=accessRole options=$accessRoles selected=$post.accessRole class=required} </td>
                <th><label for="group">{$l10n->_('Estado civil')}:</label></th>
                <td> {html_options name=maritalStatus id=maritalStatus options=$maritalStatus selected=$post.maritalStatus} </td>
            </tr>
        </tbody>
        <tfoot>
            <tr>
                <td colspan="4">
                    <input type="reset" value="{$l10n->_('Restablecer')}"/>
                    <input type="submit" value="{$l10n->_('Guardar')}"/>
                    <input type="button" value="{$l10n->_('Cancelar')}"/>
                    <input type="hidden" name="id" value="{$post.id}" id="id" />
                </td>
            </tr>
        </tfoot>
    </table>
</div>

</form>

</div>