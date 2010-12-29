<form action="{url action=create}" method="post" class="validate ajaxForm">
<table class="center">
    <caption>{$i18n->_('DepartmentProject')}</caption>
    <tfoot>
        <tr>
            <td colspan="2"><input type="submit" value="{$i18n->_('Save')}" /></td>
        </tr>
    </tfoot>
    <tbody>
        {include file='departmentProject/Form.tpl'}
    </tbody>
</table>
</form>
<hr/>


<table class="center">
    <caption>{$i18n->_('List')}</caption>
    <thead>
        <tr>
            <td>{$i18n->_('IdDepartmentProject')}</td>
            <td>{$i18n->_('IdProject')}</td>
            <td>{$i18n->_('IdDepartment')}</td>
            <td colspan="2">{$i18n->_('Actions')}</td>
        </tr>
    </thead>
    <tbody id="ajaxList">
        {foreach $departmentProjects as $departmentProject}
            <tr class="{$departmentProject@iteration|odd}">
                <td>{$departmentProject->getIdDepartmentProject()}</td>
                <td>{$departmentProject->getIdProject()}</td>
                <td>{$departmentProject->getIdDepartment()}</td>
                <td><a href="{url action=edit idDepartmentProject=$departmentProject->getIdDepartmentProject()}">{icon src=pencil class=tip title=$i18n->_('Edit')}</a></td>
                <td><a href="{url action=delete idDepartmentProject=$departmentProject->getIdDepartmentProject()}" class="confirm">{icon src=delete class=tip title=$i18n->_('Delete')}</a></td>
            </tr>
        {/foreach}
    </tbody>
</table>

