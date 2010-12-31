<form action="{url action=create}" method="post" class="validate ajaxForm">
<table class="center">
    <caption>{$l10n->_('User')}</caption>
    <tfoot>
        <tr>
            <td colspan="2"><input type="submit" value="{$l10n->_('Save')}" /></td>
        </tr>
    </tfoot>
    <tbody>
        {include file='user/Form.tpl'}
    </tbody>
</table>
</form>
<hr/>


<table class="center">
    <caption>{$l10n->_('List')}</caption>
    <thead>
        <tr>
            <td>{$l10n->_('IdUser')}</td>
            <td>{$l10n->_('Username')}</td>
            <td>{$l10n->_('Password')}</td>
            <td>{$l10n->_('Status')}</td>
            <td>{$l10n->_('IdAccessRole')}</td>
            <td>{$l10n->_('IdPerson')}</td>
            <td>{$l10n->_('System')}</td>
            <td colspan="2">{$l10n->_('Actions')}</td>
        </tr>
    </thead>
    <tbody id="ajaxList">
        {foreach $users as $user}
            <tr class="{$user@iteration|odd}">
                <td>{$user->getIdUser()}</td>
                <td>{$user->getUsername()}</td>
                <td>{$user->getPassword()}</td>
                <td>{$user->getStatus()}</td>
                <td>{$user->getIdAccessRole()}</td>
                <td>{$user->getIdPerson()}</td>
                <td>{$user->getSystem()}</td>
                <td><a href="{url action=edit idUser=$user->getIdUser()}">{icon src=pencil class=tip title=$l10n->_('Edit')}</a></td>
                <td><a href="{url action=delete idUser=$user->getIdUser()}" class="confirm">{icon src=delete class=tip title=$l10n->_('Delete')}</a></td>
            </tr>
        {/foreach}
    </tbody>
</table>

