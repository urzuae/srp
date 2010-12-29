_row.tpl

<tr>
    <td>{$project->getIdProject()}</td>
    <td>{$project->getType()}</td>
    <td>{$project->getStatus()}</td>
    <td><a href="{url action=edit idProject=$project->getIdProject()}">{icon src=pencil class=tip title=$i18n->_('Edit')}</a></td>
    <td><a href="{url action=delete idProject=$project->getIdProject()}" class="confirm">{icon src=delete class=tip title=$i18n->_('Delete')}</a></td>
</tr>
