_row.tpl

<tr>
    <td>{$projectLog->getIdProjectLog()}</td>
    <td>{$projectLog->getIdProject()}</td>
    <td>{$projectLog->getTimestamp()}</td>
    <td><a href="{url action=edit idProjectLog=$projectLog->getIdProjectLog()}">{icon src=pencil class=tip title=$i18n->_('Edit')}</a></td>
    <td><a href="{url action=delete idProjectLog=$projectLog->getIdProjectLog()}" class="confirm">{icon src=delete class=tip title=$i18n->_('Delete')}</a></td>
</tr>
