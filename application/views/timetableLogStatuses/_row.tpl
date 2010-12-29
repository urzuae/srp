_row.tpl

<tr>
    <td>{$timetableLogStatuses->getIdTimetableLogStatus()}</td>
    <td>{$timetableLogStatuses->getIdTimetableLog()}</td>
    <td>{$timetableLogStatuses->getStatus()}</td>
    <td><a href="{url action=edit idTimetableLogStatus=$timetableLogStatuses->getIdTimetableLogStatus()}">{icon src=pencil class=tip title=$i18n->_('Edit')}</a></td>
    <td><a href="{url action=delete idTimetableLogStatus=$timetableLogStatuses->getIdTimetableLogStatus()}" class="confirm">{icon src=delete class=tip title=$i18n->_('Delete')}</a></td>
</tr>
