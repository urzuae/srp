<form action="{url action=create}" method="post" class="validate ajaxForm">
<table class="center">
    <caption>{$i18n->_('TimetableHour')}</caption>
    <tfoot>
        <tr>
            <td colspan="2"><input type="submit" value="{$i18n->_('Save')}" /></td>
        </tr>
    </tfoot>
    <tbody>
        {include file='timetableHour/Form.tpl'}
    </tbody>
</table>
</form>
<hr/>


<table class="center">
    <caption>{$i18n->_('List')}</caption>
    <thead>
        <tr>
            <td>{$i18n->_('IdTimetableHour')}</td>
            <td>{$i18n->_('IdTimetable')}</td>
            <td>{$i18n->_('IdProjectTask')}</td>
            <td>{$i18n->_('IdProject')}</td>
            <td>{$i18n->_('RecordDate')}</td>
            <td>{$i18n->_('Description')}</td>
            <td>{$i18n->_('Hours')}</td>
            <td>{$i18n->_('DateCreated')}</td>
            <td>{$i18n->_('Timestamp')}</td>
            <td>{$i18n->_('Status')}</td>
            <td>{$i18n->_('Type')}</td>
            <td colspan="2">{$i18n->_('Actions')}</td>
        </tr>
    </thead>
    <tbody id="ajaxList">
        {foreach $timetableHours as $timetableHour}
            <tr class="{$timetableHour@iteration|odd}">
                <td>{$timetableHour->getIdTimetableHour()}</td>
                <td>{$timetableHour->getIdTimetable()}</td>
                <td>{$timetableHour->getIdProjectTask()}</td>
                <td>{$timetableHour->getIdProject()}</td>
                <td>{$timetableHour->getRecordDate()}</td>
                <td>{$timetableHour->getDescription()}</td>
                <td>{$timetableHour->getHours()}</td>
                <td>{$timetableHour->getDateCreated()}</td>
                <td>{$timetableHour->getTimestamp()}</td>
                <td>{$timetableHour->getStatus()}</td>
                <td>{$timetableHour->getType()}</td>
                <td><a href="{url action=edit idTimetableHour=$timetableHour->getIdTimetableHour()}">{icon src=pencil class=tip title=$i18n->_('Edit')}</a></td>
                <td><a href="{url action=delete idTimetableHour=$timetableHour->getIdTimetableHour()}" class="confirm">{icon src=delete class=tip title=$i18n->_('Delete')}</a></td>
            </tr>
        {/foreach}
    </tbody>
</table>

