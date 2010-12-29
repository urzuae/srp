_row.tpl

<tr>
    <td>{$projectTask->getIdProjectTask()}</td>
    <td>{$projectTask->getTaskCode()}</td>
    <td>{$projectTask->getDescription()}</td>
    <td>{$projectTask->getType()}</td>
    <td>{$projectTask->getStatus()}</td>
    <td><a href="{url action=edit idProjectTask=$projectTask->getIdProjectTask()}">{icon src=pencil class=tip title=$i18n->_('Edit')}</a></td>
    <td><a href="{url action=delete idProjectTask=$projectTask->getIdProjectTask()}" class="confirm">{icon src=delete class=tip title=$i18n->_('Delete')}</a></td>
</tr>
