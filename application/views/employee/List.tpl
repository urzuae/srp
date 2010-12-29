<form action="{url action=create}" method="post" class="validate ajaxForm">
<table class="center">
    <caption>{$i18n->_('Employee')}</caption>
    <tfoot>
        <tr>
            <td colspan="2"><input type="submit" value="{$i18n->_('Save')}" /></td>
        </tr>
    </tfoot>
    <tbody>
        {include file='employee/Form.tpl'}
    </tbody>
</table>
</form>
<hr/>


<table class="center">
    <caption>{$i18n->_('List')}</caption>
    <thead>
        <tr>
            <td>{$i18n->_('IdEmployee')}</td>
            <td>{$i18n->_('IdUser')}</td>
            <td>{$i18n->_('IdDepartment')}</td>
            <td>{$i18n->_('Type')}</td>
            <td>{$i18n->_('BeginningDate')}</td>
            <td>{$i18n->_('EndingDate')}</td>
            <td>{$i18n->_('ScheduleType')}</td>
            <td colspan="2">{$i18n->_('Actions')}</td>
        </tr>
    </thead>
    <tbody id="ajaxList">
        {foreach $employees as $employee}
            <tr class="{$employee@iteration|odd}">
                <td>{$employee->getIdEmployee()}</td>
                <td>{$employee->getIdUser()}</td>
                <td>{$employee->getIdDepartment()}</td>
                <td>{$employee->getType()}</td>
                <td>{$employee->getBeginningDate()}</td>
                <td>{$employee->getEndingDate()}</td>
                <td>{$employee->getScheduleType()}</td>
                <td><a href="{url action=edit idEmployee=$employee->getIdEmployee()}">{icon src=pencil class=tip title=$i18n->_('Edit')}</a></td>
                <td><a href="{url action=delete idEmployee=$employee->getIdEmployee()}" class="confirm">{icon src=delete class=tip title=$i18n->_('Delete')}</a></td>
            </tr>
        {/foreach}
    </tbody>
</table>

