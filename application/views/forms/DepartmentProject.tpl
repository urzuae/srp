<tr>
    <th>{$i18n->_('id_department_project')}</th>
    <td># {$post['id_department_project']}<input type="hidden" name="id_department_project" id="id_department_project" value="{$post['id_department_project']}" /></td>
</tr>
<tr>
    <th>{$i18n->_('id_project')}</th>
    <td>{html_options name=id_project id=id_project options=$Projects selected=$post['id_project'] }</td>
</tr>
<tr>
    <th>{$i18n->_('id_department')}</th>
    <td>{html_options name=id_department id=id_department options=$Departments selected=$post['id_department'] }</td>
</tr>

<!--
$idDepartmentProject = $this->getRequest()->getParam('id_department_project');
$idProject = $this->getRequest()->getParam('id_project');
$idDepartment = $this->getRequest()->getParam('id_department');
-->

<!--
$post = array(
    'id_department_project' => $departmentProject->getIdDepartmentProject(),
    'id_project' => $departmentProject->getIdProject(),
    'id_department' => $departmentProject->getIdDepartment(),
);
-->
