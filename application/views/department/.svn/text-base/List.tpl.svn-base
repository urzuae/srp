<form action="{url action=create}" method="post" class="validate ajaxForm">
<table class="center">
    <caption>{$i18n->_('Department')}</caption>
    <tfoot>
        <tr>
            <td colspan="2"><input type="submit" value="{$i18n->_('Save')}" /></td>
        </tr>
    </tfoot>
    <tbody>
        {include file='department/Form.tpl'}
    </tbody>
</table>
</form>
<hr/>


<table class="center">
    <caption>{$i18n->_('List')}</caption>
    <thead>
        <tr>
            <td>{$i18n->_('IdDepartment')}</td>
            <td>{$i18n->_('IdDepartmentHead')}</td>
            <td>{$i18n->_('DepartmentCode')}</td>
            <td>{$i18n->_('DepartmentName')}</td>
            <td>{$i18n->_('Status')}</td>
            <td colspan="2">{$i18n->_('Actions')}</td>
        </tr>
    </thead>
    <tbody id="ajaxList">
        {foreach $departments as $department}
            <tr class="{$department@iteration|odd}">
                <td>{$department->getIdDepartment()}</td>
                <td>{$department->getIdDepartmentHead()}</td>
                <td>{$department->getDepartmentCode()}</td>
                <td>{$department->getDepartmentName()}</td>
                <td>{$department->getStatus()}</td>
                <td><a href="{url action=edit idDepartment=$department->getIdDepartment()}">{icon src=pencil class=tip title=$i18n->_('Edit')}</a></td>
                <td><a href="{url action=delete idDepartment=$department->getIdDepartment()}" class="confirm">{icon src=delete class=tip title=$i18n->_('Delete')}</a></td>
            </tr>
        {/foreach}
    </tbody>
</table>

