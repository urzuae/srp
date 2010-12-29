_row.tpl

<tr>
    <td>{$specificProject->getIdSpecificProject()}</td>
    <td>{$specificProject->getIdProject()}</td>
    <td>{$specificProject->getProjectCode()}</td>
    <td>{$specificProject->getProjectName()}</td>
    <td>{$specificProject->getBeginningDate()}</td>
    <td>{$specificProject->getEndingDate()}</td>
    <td><a href="{url action=edit idSpecificProject=$specificProject->getIdSpecificProject()}">{icon src=pencil class=tip title=$i18n->_('Edit')}</a></td>
    <td><a href="{url action=delete idSpecificProject=$specificProject->getIdSpecificProject()}" class="confirm">{icon src=delete class=tip title=$i18n->_('Delete')}</a></td>
</tr>
