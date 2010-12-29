<form action="{url action=create}" method="post" class="validate ajaxForm">
<table class="center">
    <caption>{$i18n->_('ProjectApproversList')}</caption>
    <tfoot>
        <tr>
            <td colspan="2"><input type="submit" value="{$i18n->_('Save')}" /></td>
        </tr>
    </tfoot>
    <tbody>
        {include file='projectApproversList/Form.tpl'}
    </tbody>
</table>
</form>
<hr/>


<table class="center">
    <caption>{$i18n->_('List')}</caption>
    <thead>
        <tr>
            <td>{$i18n->_('IdProjectApproversList')}</td>
            <td>{$i18n->_('IdProject')}</td>
            <td>{$i18n->_('IdEmployee')}</td>
            <td>{$i18n->_('IsMain')}</td>
            <td>{$i18n->_('Level')}</td>
            <td colspan="2">{$i18n->_('Actions')}</td>
        </tr>
    </thead>
    <tbody id="ajaxList">
        {foreach $projectApproversLists as $projectApproversList}
            <tr class="{$projectApproversList@iteration|odd}">
                <td>{$projectApproversList->getIdProjectApproversList()}</td>
                <td>{$projectApproversList->getIdProject()}</td>
                <td>{$projectApproversList->getIdEmployee()}</td>
                <td>{$projectApproversList->getIsMain()}</td>
                <td>{$projectApproversList->getLevel()}</td>
                <td><a href="{url action=edit idProjectApproversList=$projectApproversList->getIdProjectApproversList()}">{icon src=pencil class=tip title=$i18n->_('Edit')}</a></td>
                <td><a href="{url action=delete idProjectApproversList=$projectApproversList->getIdProjectApproversList()}" class="confirm">{icon src=delete class=tip title=$i18n->_('Delete')}</a></td>
            </tr>
        {/foreach}
    </tbody>
</table>

