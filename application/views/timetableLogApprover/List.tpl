<form action="{url action=create}" method="post" class="validate ajaxForm">
<table class="center">
    <caption>{$i18n->_('TimetableLogApprover')}</caption>
    <tfoot>
        <tr>
            <td colspan="2"><input type="submit" value="{$i18n->_('Save')}" /></td>
        </tr>
    </tfoot>
    <tbody>
        {include file='timetableLogApprover/Form.tpl'}
    </tbody>
</table>
</form>
<hr/>


<table class="center">
    <caption>{$i18n->_('List')}</caption>
    <thead>
        <tr>
            <td>{$i18n->_('IdTimetableLogApprover')}</td>
            <td>{$i18n->_('IdTimetableLog')}</td>
            <td>{$i18n->_('IdCurrentApprover')}</td>
            <td>{$i18n->_('IdFormerApprover')}</td>
            <td colspan="2">{$i18n->_('Actions')}</td>
        </tr>
    </thead>
    <tbody id="ajaxList">
        {foreach $timetableLogApprovers as $timetableLogApprover}
            <tr class="{$timetableLogApprover@iteration|odd}">
                <td>{$timetableLogApprover->getIdTimetableLogApprover()}</td>
                <td>{$timetableLogApprover->getIdTimetableLog()}</td>
                <td>{$timetableLogApprover->getIdCurrentApprover()}</td>
                <td>{$timetableLogApprover->getIdFormerApprover()}</td>
                <td><a href="{url action=edit idTimetableLogApprover=$timetableLogApprover->getIdTimetableLogApprover()}">{icon src=pencil class=tip title=$i18n->_('Edit')}</a></td>
                <td><a href="{url action=delete idTimetableLogApprover=$timetableLogApprover->getIdTimetableLogApprover()}" class="confirm">{icon src=delete class=tip title=$i18n->_('Delete')}</a></td>
            </tr>
        {/foreach}
    </tbody>
</table>

