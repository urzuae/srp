_row.tpl

<tr>
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
