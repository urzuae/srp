<form action="{url action=create}" method="post" class="validate ajaxForm">
<table class="center">
    <caption>{$i18n->_('Email')}</caption>
    <tfoot>
        <tr>
            <td colspan="2"><input type="submit" value="{$i18n->_('Save')}" /></td>
        </tr>
    </tfoot>
    <tbody>
        {include file='email/Form.tpl'}
    </tbody>
</table>
</form>
<hr/>


<table class="center">
    <caption>{$i18n->_('List')}</caption>
    <thead>
        <tr>
            <td>{$i18n->_('IdEmail')}</td>
            <td>{$i18n->_('IdPerson')}</td>
            <td>{$i18n->_('Email')}</td>
            <td>{$i18n->_('Type')}</td>
            <td colspan="2">{$i18n->_('Actions')}</td>
        </tr>
    </thead>
    <tbody id="ajaxList">
        {foreach $emails as $email}
            <tr class="{$email@iteration|odd}">
                <td>{$email->getIdEmail()}</td>
                <td>{$email->getIdPerson()}</td>
                <td>{$email->getEmail()}</td>
                <td>{$email->getType()}</td>
                <td><a href="{url action=edit idEmail=$email->getIdEmail()}">{icon src=pencil class=tip title=$i18n->_('Edit')}</a></td>
                <td><a href="{url action=delete idEmail=$email->getIdEmail()}" class="confirm">{icon src=delete class=tip title=$i18n->_('Delete')}</a></td>
            </tr>
        {/foreach}
    </tbody>
</table>

