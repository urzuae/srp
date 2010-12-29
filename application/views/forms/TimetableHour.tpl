<tr>
    <th>{$i18n->_('id_timetable_hour')}</th>
    <td># {$post['id_timetable_hour']}<input type="hidden" name="id_timetable_hour" id="id_timetable_hour" value="{$post['id_timetable_hour']}" /></td>
</tr>
<tr>
    <th>{$i18n->_('id_timetable')}</th>
    <td>{html_options name=id_timetable id=id_timetable options=$Timetables selected=$post['id_timetable'] }</td>
</tr>
<tr>
    <th>{$i18n->_('id_project_task')}</th>
    <td>{html_options name=id_project_task id=id_project_task options=$ProjectTasks selected=$post['id_project_task'] }</td>
</tr>
<tr>
    <th>{$i18n->_('id_project')}</th>
    <td>{html_options name=id_project id=id_project options=$Projects selected=$post['id_project'] }</td>
</tr>
<tr>
    <th>{$i18n->_('record_date')}</th>
    <td><input type="text" name="record_date" id="record_date" value="{$post['record_date']}" class=" required" /></td>
</tr>
<tr>
    <th>{$i18n->_('description')}</th>
    <td><input type="text" name="description" id="description" value="{$post['description']}" class="" /></td>
</tr>
<tr>
    <th>{$i18n->_('hours')}</th>
    <td><input type="text" name="hours" id="hours" value="{$post['hours']}" class="number required" /></td>
</tr>
<tr>
    <th>{$i18n->_('date_created')}</th>
    <td><input type="text" name="date_created" id="date_created" value="{$post['date_created']}" class=" required" /></td>
</tr>
<tr>
    <th>{$i18n->_('timestamp')}</th>
    <td><input type="text" name="timestamp" id="timestamp" value="{$post['timestamp']}" class="datePicker dateISO required" /></td>
</tr>
<tr>
    <th>{$i18n->_('status')}</th>
    <td><input type="text" name="status" id="status" value="{$post['status']}" class="number required" /></td>
</tr>
<tr>
    <th>{$i18n->_('type')}</th>
    <td><input type="text" name="type" id="type" value="{$post['type']}" class="number required" /></td>
</tr>

<!--
$idTimetableHour = $this->getRequest()->getParam('id_timetable_hour');
$idTimetable = $this->getRequest()->getParam('id_timetable');
$idProjectTask = $this->getRequest()->getParam('id_project_task');
$idProject = $this->getRequest()->getParam('id_project');
$recordDate = $this->getRequest()->getParam('record_date');
$description = $this->getRequest()->getParam('description');
$hours = $this->getRequest()->getParam('hours');
$dateCreated = $this->getRequest()->getParam('date_created');
$timestamp = $this->getRequest()->getParam('timestamp');
$status = $this->getRequest()->getParam('status');
$type = $this->getRequest()->getParam('type');
-->

<!--
$post = array(
    'id_timetable_hour' => $timetableHour->getIdTimetableHour(),
    'id_timetable' => $timetableHour->getIdTimetable(),
    'id_project_task' => $timetableHour->getIdProjectTask(),
    'id_project' => $timetableHour->getIdProject(),
    'record_date' => $timetableHour->getRecordDate(),
    'description' => $timetableHour->getDescription(),
    'hours' => $timetableHour->getHours(),
    'date_created' => $timetableHour->getDateCreated(),
    'timestamp' => $timetableHour->getTimestamp(),
    'status' => $timetableHour->getStatus(),
    'type' => $timetableHour->getType(),
);
-->
