<tr>
    <th>{$i18n->_('id_project_approvers_list')}</th>
    <td># {$post['id_project_approvers_list']}<input type="hidden" name="id_project_approvers_list" id="id_project_approvers_list" value="{$post['id_project_approvers_list']}" /></td>
</tr>
<tr>
    <th>{$i18n->_('id_project')}</th>
    <td>{html_options name=id_project id=id_project options=$Projects selected=$post['id_project'] }</td>
</tr>
<tr>
    <th>{$i18n->_('id_employee')}</th>
    <td>{html_options name=id_employee id=id_employee options=$Employees selected=$post['id_employee'] }</td>
</tr>
<tr>
    <th>{$i18n->_('is_main')}</th>
    <td><input type="checkbox" name="is_main" id="is_main" value="1" class="" {if $post['is_main']}checked="checked"{/if} /></td>
</tr>
<tr>
    <th>{$i18n->_('level')}</th>
    <td><input type="text" name="level" id="level" value="{$post['level']}" class="number" /></td>
</tr>

<!--
$idProjectApproversList = $this->getRequest()->getParam('id_project_approvers_list');
$idProject = $this->getRequest()->getParam('id_project');
$idEmployee = $this->getRequest()->getParam('id_employee');
$isMain = $this->getRequest()->getParam('is_main', 0);
$level = $this->getRequest()->getParam('level');
-->

<!--
$post = array(
    'id_project_approvers_list' => $projectApproversList->getIdProjectApproversList(),
    'id_project' => $projectApproversList->getIdProject(),
    'id_employee' => $projectApproversList->getIdEmployee(),
    'is_main' => $projectApproversList->getIsMain(),
    'level' => $projectApproversList->getLevel(),
);
-->
