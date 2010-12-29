<form action="{url action=create}" method="post" class="validate ajaxForm">
<table class="center">
    <caption>{$i18n->_('ProjectTaskLog')}</caption>
    <tfoot>
        <tr>
            <td colspan="2"><input type="submit" value="{$i18n->_('Save')}" /></td>
        </tr>
    </tfoot>
    <tbody>
        {include file='projectTaskLog/Form.tpl'}
    </tbody>
</table>
</form>
<hr/>


<table class="center">
    <caption>{$i18n->_('List')}</caption>
    <thead>
        <tr>
            <td>{$i18n->_('IdProjectTaskLog')}</td>
            <td>{$i18n->_('IdProjectTask')}</td>
            <td>{$i18n->_('Timestamp')}</td>
            <td colspan="2">{$i18n->_('Actions')}</td>
        </tr>
    </thead>
    <tbody id="ajaxList">
        {foreach $projectTaskLogs as $projectTaskLog}
            <tr class="{$projectTaskLog@iteration|odd}">
                <td>{$projectTaskLog->getIdProjectTaskLog()}</td>
                <td>{$projectTaskLog->getIdProjectTask()}</td>
                <td>{$projectTaskLog->getTimestamp()}</td>
                <td><a href="{url action=edit idProjectTaskLog=$projectTaskLog->getIdProjectTaskLog()}">{icon src=pencil class=tip title=$i18n->_('Edit')}</a></td>
                <td><a href="{url action=delete idProjectTaskLog=$projectTaskLog->getIdProjectTaskLog()}" class="confirm">{icon src=delete class=tip title=$i18n->_('Delete')}</a></td>
            </tr>
        {/foreach}
    </tbody>
</table>

