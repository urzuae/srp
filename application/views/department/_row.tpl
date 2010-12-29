_row.tpl

<tr>
    <td>{$department->getIdDepartment()}</td>
    <td>{$department->getIdDepartmentHead()}</td>
    <td>{$department->getDepartmentCode()}</td>
    <td>{$department->getDepartmentName()}</td>
    <td>{$department->getStatus()}</td>
    <td><a href="{url action=edit idDepartment=$department->getIdDepartment()}">{icon src=pencil class=tip title=$i18n->_('Edit')}</a></td>
    <td><a href="{url action=delete idDepartment=$department->getIdDepartment()}" class="confirm">{icon src=delete class=tip title=$i18n->_('Delete')}</a></td>
</tr>
