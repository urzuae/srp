<tr>
    <th>{$i18n->_('id_specific_project')}</th>
    <td># {$post['id_specific_project']}<input type="hidden" name="id_specific_project" id="id_specific_project" value="{$post['id_specific_project']}" /></td>
</tr>
<tr>
    <th>{$i18n->_('id_project')}</th>
    <td>{html_options name=id_project id=id_project options=$Projects selected=$post['id_project'] }</td>
</tr>
<tr>
    <th>{$i18n->_('project_code')}</th>
    <td><input type="text" name="project_code" id="project_code" value="{$post['project_code']}" class=" required" /></td>
</tr>
<tr>
    <th>{$i18n->_('project_name')}</th>
    <td><input type="text" name="project_name" id="project_name" value="{$post['project_name']}" class=" required" /></td>
</tr>
<tr>
    <th>{$i18n->_('beginning_date')}</th>
    <td><input type="text" name="beginning_date" id="beginning_date" value="{$post['beginning_date']}" class=" required" /></td>
</tr>
<tr>
    <th>{$i18n->_('ending_date')}</th>
    <td><input type="text" name="ending_date" id="ending_date" value="{$post['ending_date']}" class=" required" /></td>
</tr>

<!--
$idSpecificProject = $this->getRequest()->getParam('id_specific_project');
$idProject = $this->getRequest()->getParam('id_project');
$projectCode = $this->getRequest()->getParam('project_code');
$projectName = $this->getRequest()->getParam('project_name');
$beginningDate = $this->getRequest()->getParam('beginning_date');
$endingDate = $this->getRequest()->getParam('ending_date');
-->

<!--
$post = array(
    'id_specific_project' => $specificProject->getIdSpecificProject(),
    'id_project' => $specificProject->getIdProject(),
    'project_code' => $specificProject->getProjectCode(),
    'project_name' => $specificProject->getProjectName(),
    'beginning_date' => $specificProject->getBeginningDate(),
    'ending_date' => $specificProject->getEndingDate(),
);
-->
