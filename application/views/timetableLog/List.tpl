<form action="{url action=create}" method="post" class="validate ajaxForm">
<table class="center">
    <caption>{$i18n->_('TimetableLog')}</caption>
    <tfoot>
        <tr>
            <td colspan="2"><input type="submit" value="{$i18n->_('Save')}" /></td>
        </tr>
    </tfoot>
    <tbody>
        {include file='timetableLog/Form.tpl'}
    </tbody>
</table>
</form>
<hr/>


<table class="center">
    <caption>{$i18n->_('List')}</caption>
    <thead>
        <tr>
            <td>{$i18n->_('IdTimetableLog')}</td>
            <td>{$i18n->_('IdTimetable')}</td>
            <td>{$i18n->_('Timestamp')}</td>
            <td>{$i18n->_('IdEmployee')}</td>
            <td>{$i18n->_('Type')}</td>
            <td colspan="2">{$i18n->_('Actions')}</td>
        </tr>
    </thead>
    <tbody id="ajaxList">
        {foreach $timetableLogs as $timetableLog}
            <tr class="{$timetableLog@iteration|odd}">
                <td>{$timetableLog->getIdTimetableLog()}</td>
                <td>{$timetableLog->getIdTimetable()}</td>
                <td>{$timetableLog->getTimestamp()}</td>
                <td>{$timetableLog->getIdEmployee()}</td>
                <td>{$timetableLog->getType()}</td>
                <td><a href="{url action=edit idTimetableLog=$timetableLog->getIdTimetableLog()}">{icon src=pencil class=tip title=$i18n->_('Edit')}</a></td>
                <td><a href="{url action=delete idTimetableLog=$timetableLog->getIdTimetableLog()}" class="confirm">{icon src=delete class=tip title=$i18n->_('Delete')}</a></td>
            </tr>
        {/foreach}
    </tbody>
</table>

