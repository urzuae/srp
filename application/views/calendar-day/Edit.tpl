<form action="{url action=update}" method="post" class="validate">
    <input type="hidden" name="idDay" value="{$post['id_day']}">
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
            {include file='calendarDay/Form.tpl'}
        </tbody>
    </table>
</form>
