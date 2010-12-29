<form action="{url action=create}" method="post" class="validate ajaxForm">
<table class="center">
    <caption>{$i18n->_('DepartmentProjectTask')}</caption>
    <tfoot>
        <tr>
            <td colspan="2"><input type="submit" value="{$i18n->_('Save')}" /></td>
        </tr>
    </tfoot>
    <tbody>
        {include file='departmentProjectTask/Form.tpl'}
    </tbody>
</table>
</form>
<hr/>


<table class="center">
    <caption>{$i18n->_('List')}</caption>
    <thead>
        <tr>
            <td>{$i18n->_('IdDepartmentProjectTask')}</td>
            <td>{$i18n->_('IdProjectTask')}</td>
            <td colspan="2">{$i18n->_('Actions')}</td>
        </tr>
    </thead>
    <tbody id="ajaxList">
        {foreach $departmentProjectTasks as $departmentProjectTask}
            <tr class="{$departmentProjectTask@iteration|odd}">
                <td>{$departmentProjectTask->getIdDepartmentProjectTask()}</td>
                <td>{$departmentProjectTask->getIdProjectTask()}</td>
                <td><a href="{url action=edit idDepartmentProjectTask=$departmentProjectTask->getIdDepartmentProjectTask()}">{icon src=pencil class=tip title=$i18n->_('Edit')}</a></td>
                <td><a href="{url action=delete idDepartmentProjectTask=$departmentProjectTask->getIdDepartmentProjectTask()}" class="confirm">{icon src=delete class=tip title=$i18n->_('Delete')}</a></td>
            </tr>
        {/foreach}
    </tbody>
</table>

