<tr>
    <th>{$i18n->_('id_project')}</th>
    <td># {$post['id_project']}<input type="hidden" name="id_project" id="id_project" value="{$post['id_project']}" /></td>
</tr>
<tr>
    <th>{$i18n->_('type')}</th>
    <td><input type="text" name="type" id="type" value="{$post['type']}" class="number required" /></td>
</tr>
<tr>
    <th>{$i18n->_('status')}</th>
    <td><input type="text" name="status" id="status" value="{$post['status']}" class="number required" /></td>
</tr>

<!--
$idProject = $this->getRequest()->getParam('id_project');
$type = $this->getRequest()->getParam('type');
$status = $this->getRequest()->getParam('status');
-->

<!--
$post = array(
    'id_project' => $project->getIdProject(),
    'type' => $project->getType(),
    'status' => $project->getStatus(),
);
-->
