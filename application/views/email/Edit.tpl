<form action="{url action=update}" method="post" class="validate">
    <input type="hidden" name="idEmail" value="{$post['id_email']}">
    <table class="center">
        <caption>{$i18n->_('Edit')}</caption>
        <tfoot>
            <tr>
                <td colspan="2">
                    <input type="submit" value="{$i18n->_('Save')}" />
                    <input type="button" value="{$i18n->_('Back')}" class="back" />
                </td>
            </tr>
        </tfoot>
        <tbody>
            {include file='email/Form.tpl'}
        </tbody>
    </table>
</form>
