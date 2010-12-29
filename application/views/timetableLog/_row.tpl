_row.tpl

<tr>
    <td>{$timetableLog->getIdTimetableLog()}</td>
    <td>{$timetableLog->getIdTimetable()}</td>
    <td>{$timetableLog->getTimestamp()}</td>
    <td>{$timetableLog->getIdEmployee()}</td>
    <td>{$timetableLog->getType()}</td>
    <td><a href="{url action=edit idTimetableLog=$timetableLog->getIdTimetableLog()}">{icon src=pencil class=tip title=$i18n->_('Edit')}</a></td>
    <td><a href="{url action=delete idTimetableLog=$timetableLog->getIdTimetableLog()}" class="confirm">{icon src=delete class=tip title=$i18n->_('Delete')}</a></td>
</tr>
