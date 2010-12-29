<form action="{url action=create}" method="post" class="validate ajaxForm">
<table class="center">
    <caption>{$i18n->_('Timetable')}</caption>
    <tfoot>
        <tr>
            <td colspan="2"><input type="submit" value="{$i18n->_('Save')}" /></td>
        </tr>
    </tfoot>
    <tbody>
        {include file='timetable/Form.tpl'}
    </tbody>
</table>
</form>
<hr/>


<table class="center">
    <caption>{$i18n->_('List')}</caption>
    <thead>
        <tr>
            <td>{$i18n->_('IdTimetable')}</td>
            <td>{$i18n->_('IdEmployee')}</td>
            <td>{$i18n->_('Date')}</td>
            <td>{$i18n->_('IdApprover1')}</td>
            <td>{$i18n->_('IdApprover2')}</td>
            <td>{$i18n->_('IdCurrentApprover')}</td>
            <td>{$i18n->_('Status')}</td>
            <td colspan="2">{$i18n->_('Actions')}</td>
        </tr>
    </thead>
    <tbody id="ajaxList">
        {foreach $timetables as $timetable}
            <tr class="{$timetable@iteration|odd}">
                <td>{$timetable->getIdTimetable()}</td>
                <td>{$timetable->getIdEmployee()}</td>
                <td>{$timetable->getDate()}</td>
                <td>{$timetable->getIdApprover1()}</td>
                <td>{$timetable->getIdApprover2()}</td>
                <td>{$timetable->getIdCurrentApprover()}</td>
                <td>{$timetable->getStatus()}</td>
                <td><a href="{url action=edit idTimetable=$timetable->getIdTimetable()}">{icon src=pencil class=tip title=$i18n->_('Edit')}</a></td>
                <td><a href="{url action=delete idTimetable=$timetable->getIdTimetable()}" class="confirm">{icon src=delete class=tip title=$i18n->_('Delete')}</a></td>
            </tr>
        {/foreach}
    </tbody>
</table>

