<tr>
    <th>{$i18n->_('id_department_project_task')}</th>
    <td># {$post['id_department_project_task']}<input type="hidden" name="id_department_project_task" id="id_department_project_task" value="{$post['id_department_project_task']}" /></td>
</tr>
<tr>
    <th>{$i18n->_('id_project_task')}</th>
    <td>{html_options name=id_project_task id=id_project_task options=$ProjectTasks selected=$post['id_project_task'] }</td>
</tr>

<!--
$idDepartmentProjectTask = $this->getRequest()->getParam('id_department_project_task');
$idProjectTask = $this->getRequest()->getParam('id_project_task');
-->

<!--
$post = array(
    'id_department_project_task' => $departmentProjectTask->getIdDepartmentProjectTask(),
    'id_project_task' => $departmentProjectTask->getIdProjectTask(),
);
-->
