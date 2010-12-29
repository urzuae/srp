<form action="{url action=create}" method="post" class="validate ajaxForm">
<table class="center">
    <caption>{$i18n->_('ProjectTask')}</caption>
    <tfoot>
        <tr>
            <td colspan="2"><input type="submit" value="{$i18n->_('Save')}" /></td>
        </tr>
    </tfoot>
    <tbody>
        {include file='projectTask/Form.tpl'}
    </tbody>
</table>
</form>
<hr/>


<table class="center">
    <caption>{$i18n->_('List')}</caption>
    <thead>
        <tr>
            <td>{$i18n->_('IdProjectTask')}</td>
            <td>{$i18n->_('TaskCode')}</td>
            <td>{$i18n->_('Description')}</td>
            <td>{$i18n->_('Type')}</td>
            <td>{$i18n->_('Status')}</td>
            <td colspan="2">{$i18n->_('Actions')}</td>
        </tr>
    </thead>
    <tbody id="ajaxList">
        {foreach $projectTasks as $projectTask}
            <tr class="{$projectTask@iteration|odd}">
                <td>{$projectTask->getIdProjectTask()}</td>
                <td>{$projectTask->getTaskCode()}</td>
                <td>{$projectTask->getDescription()}</td>
                <td>{$projectTask->getType()}</td>
                <td>{$projectTask->getStatus()}</td>
                <td><a href="{url action=edit idProjectTask=$projectTask->getIdProjectTask()}">{icon src=pencil class=tip title=$i18n->_('Edit')}</a></td>
                <td><a href="{url action=delete idProjectTask=$projectTask->getIdProjectTask()}" class="confirm">{icon src=delete class=tip title=$i18n->_('Delete')}</a></td>
            </tr>
        {/foreach}
    </tbody>
</table>

