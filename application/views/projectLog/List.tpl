<form action="{url action=create}" method="post" class="validate ajaxForm">
<table class="center">
    <caption>{$i18n->_('ProjectLog')}</caption>
    <tfoot>
        <tr>
            <td colspan="2"><input type="submit" value="{$i18n->_('Save')}" /></td>
        </tr>
    </tfoot>
    <tbody>
        {include file='projectLog/Form.tpl'}
    </tbody>
</table>
</form>
<hr/>


<table class="center">
    <caption>{$i18n->_('List')}</caption>
    <thead>
        <tr>
            <td>{$i18n->_('IdProjectLog')}</td>
            <td>{$i18n->_('IdProject')}</td>
            <td>{$i18n->_('Timestamp')}</td>
            <td colspan="2">{$i18n->_('Actions')}</td>
        </tr>
    </thead>
    <tbody id="ajaxList">
        {foreach $projectLogs as $projectLog}
            <tr class="{$projectLog@iteration|odd}">
                <td>{$projectLog->getIdProjectLog()}</td>
                <td>{$projectLog->getIdProject()}</td>
                <td>{$projectLog->getTimestamp()}</td>
                <td><a href="{url action=edit idProjectLog=$projectLog->getIdProjectLog()}">{icon src=pencil class=tip title=$i18n->_('Edit')}</a></td>
                <td><a href="{url action=delete idProjectLog=$projectLog->getIdProjectLog()}" class="confirm">{icon src=delete class=tip title=$i18n->_('Delete')}</a></td>
            </tr>
        {/foreach}
    </tbody>
</table>

