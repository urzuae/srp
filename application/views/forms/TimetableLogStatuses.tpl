<tr>
    <th>{$i18n->_('id_timetable_log_status')}</th>
    <td># {$post['id_timetable_log_status']}<input type="hidden" name="id_timetable_log_status" id="id_timetable_log_status" value="{$post['id_timetable_log_status']}" /></td>
</tr>
<tr>
    <th>{$i18n->_('id_timetable_log')}</th>
    <td>{html_options name=id_timetable_log id=id_timetable_log options=$TimetableLogs selected=$post['id_timetable_log'] }</td>
</tr>
<tr>
    <th>{$i18n->_('status')}</th>
    <td><input type="text" name="status" id="status" value="{$post['status']}" class="number required" /></td>
</tr>

<!--
$idTimetableLogStatus = $this->getRequest()->getParam('id_timetable_log_status');
$idTimetableLog = $this->getRequest()->getParam('id_timetable_log');
$status = $this->getRequest()->getParam('status');
-->

<!--
$post = array(
    'id_timetable_log_status' => $timetableLogStatuses->getIdTimetableLogStatus(),
    'id_timetable_log' => $timetableLogStatuses->getIdTimetableLog(),
    'status' => $timetableLogStatuses->getStatus(),
);
-->
