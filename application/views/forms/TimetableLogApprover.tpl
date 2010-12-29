<tr>
    <th>{$i18n->_('id_timetable_log_approver')}</th>
    <td># {$post['id_timetable_log_approver']}<input type="hidden" name="id_timetable_log_approver" id="id_timetable_log_approver" value="{$post['id_timetable_log_approver']}" /></td>
</tr>
<tr>
    <th>{$i18n->_('id_timetable_log')}</th>
    <td>{html_options name=id_timetable_log id=id_timetable_log options=$TimetableLogs selected=$post['id_timetable_log'] }</td>
</tr>
<tr>
    <th>{$i18n->_('id_current_approver')}</th>
    <td>{html_options name=id_current_approver id=id_current_approver options=$CurrentApprovers selected=$post['id_current_approver'] }</td>
</tr>
<tr>
    <th>{$i18n->_('id_former_approver')}</th>
    <td>{html_options name=id_former_approver id=id_former_approver options=$FormerApprovers selected=$post['id_former_approver'] }</td>
</tr>

<!--
$idTimetableLogApprover = $this->getRequest()->getParam('id_timetable_log_approver');
$idTimetableLog = $this->getRequest()->getParam('id_timetable_log');
$idCurrentApprover = $this->getRequest()->getParam('id_current_approver');
$idFormerApprover = $this->getRequest()->getParam('id_former_approver');
-->

<!--
$post = array(
    'id_timetable_log_approver' => $timetableLogApprover->getIdTimetableLogApprover(),
    'id_timetable_log' => $timetableLogApprover->getIdTimetableLog(),
    'id_current_approver' => $timetableLogApprover->getIdCurrentApprover(),
    'id_former_approver' => $timetableLogApprover->getIdFormerApprover(),
);
-->
