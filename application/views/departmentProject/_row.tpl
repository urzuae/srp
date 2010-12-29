_row.tpl

<tr>
    <td>{$departmentProject->getIdDepartmentProject()}</td>
    <td>{$departmentProject->getIdProject()}</td>
    <td>{$departmentProject->getIdDepartment()}</td>
    <td><a href="{url action=edit idDepartmentProject=$departmentProject->getIdDepartmentProject()}">{icon src=pencil class=tip title=$i18n->_('Edit')}</a></td>
    <td><a href="{url action=delete idDepartmentProject=$departmentProject->getIdDepartmentProject()}" class="confirm">{icon src=delete class=tip title=$i18n->_('Delete')}</a></td>
</tr>
