<form action="{url action=update}" method="post" class="validate">
    <input type="hidden" name="idDepartmentProject" value="{$post['id_department_project']}">
    <table class="center">
        <caption>{$l10n->_('Edit')}</caption>
        <tfoot>
            <tr>
                <td colspan="2">
                    <input type="submit" value="{$l10n->_('Save')}" />
                    <input type="button" value="{$l10n->_('Back')}" class="back" />
                </td>
            </tr>
        </tfoot>
        <tbody>
            {include file='department-project/Form.tpl'}
        </tbody>
    </table>
</form>
