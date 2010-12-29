<form action="{url action=create}" method="post" class="validate ajaxForm">
<table class="center">
    <caption>{$i18n->_('TimetableLogStatuses')}</caption>
    <tfoot>
        <tr>
            <td colspan="2"><input type="submit" value="{$i18n->_('Save')}" /></td>
        </tr>
    </tfoot>
    <tbody>
        {include file='timetableLogStatuses/Form.tpl'}
    </tbody>
</table>
</form>
<hr/>


<table class="center">
    <caption>{$i18n->_('List')}</caption>
    <thead>
        <tr>
            <td>{$i18n->_('IdTimetableLogStatus')}</td>
            <td>{$i18n->_('IdTimetableLog')}</td>
            <td>{$i18n->_('Status')}</td>
            <td colspan="2">{$i18n->_('Actions')}</td>
        </tr>
    </thead>
    <tbody id="ajaxList">
        {foreach $timetableLogStatusess as $timetableLogStatuses}
            <tr class="{$timetableLogStatuses@iteration|odd}">
                <td>{$timetableLogStatuses->getIdTimetableLogStatus()}</td>
                <td>{$timetableLogStatuses->getIdTimetableLog()}</td>
                <td>{$timetableLogStatuses->getStatus()}</td>
                <td><a href="{url action=edit idTimetableLogStatus=$timetableLogStatuses->getIdTimetableLogStatus()}">{icon src=pencil class=tip title=$i18n->_('Edit')}</a></td>
                <td><a href="{url action=delete idTimetableLogStatus=$timetableLogStatuses->getIdTimetableLogStatus()}" class="confirm">{icon src=delete class=tip title=$i18n->_('Delete')}</a></td>
            </tr>
        {/foreach}
    </tbody>
</table>

