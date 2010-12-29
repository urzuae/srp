<form action="{url action=create}" method="post" class="validate ajaxForm">
<table class="center">
    <caption>{$i18n->_('SpecificProjectTask')}</caption>
    <tfoot>
        <tr>
            <td colspan="2"><input type="submit" value="{$i18n->_('Save')}" /></td>
        </tr>
    </tfoot>
    <tbody>
        {include file='specificProjectTask/Form.tpl'}
    </tbody>
</table>
</form>
<hr/>


<table class="center">
    <caption>{$i18n->_('List')}</caption>
    <thead>
        <tr>
            <td>{$i18n->_('IdSpecificProjectTask')}</td>
            <td>{$i18n->_('IdProjectTask')}</td>
            <td>{$i18n->_('WorkAuthorizationStatus')}</td>
            <td colspan="2">{$i18n->_('Actions')}</td>
        </tr>
    </thead>
    <tbody id="ajaxList">
        {foreach $specificProjectTasks as $specificProjectTask}
            <tr class="{$specificProjectTask@iteration|odd}">
                <td>{$specificProjectTask->getIdSpecificProjectTask()}</td>
                <td>{$specificProjectTask->getIdProjectTask()}</td>
                <td>{$specificProjectTask->getWorkAuthorizationStatus()}</td>
                <td><a href="{url action=edit idSpecificProjectTask=$specificProjectTask->getIdSpecificProjectTask()}">{icon src=pencil class=tip title=$i18n->_('Edit')}</a></td>
                <td><a href="{url action=delete idSpecificProjectTask=$specificProjectTask->getIdSpecificProjectTask()}" class="confirm">{icon src=delete class=tip title=$i18n->_('Delete')}</a></td>
            </tr>
        {/foreach}
    </tbody>
</table>

