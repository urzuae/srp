{literal}
<script type="text/javascript">
	var no_holidays={/literal}{$noHolidays}{literal}
	var holidays_j={/literal}{$holidays}{literal}
	var idEmployee={/literal}{$idEmployee}{literal}
</script>
{/literal}
<script type="text/javascript" src="{$baseUrl}/js/jquery/calendar-day/calendar-day-modify.js"></script>
<link rel="stylesheet" href="{$baseUrl}/css/test.css" type="text/css" />
<h2>{$name}</h2>
<form action="{url action=update}" method="post" class="validate">
    <!--<input type="hidden" name="idDay" value="{$post['id_day']}">-->
    <input type="hidden" name="idEmployee" value="{$idEmployee}">
    <table class="center">
        <caption>{$l10n->_('Días hábiles / inhábiles')}</caption>
        <tfoot>
            <tr>
                <td colspan="2">
                    <!--<input type="submit" value="{$l10n->_('Save')}" />-->
                    <input type="button" value="{$l10n->_('Regresar')}" class="back" />
                </td>
            </tr>
        </tfoot>
        <tbody>
        	<tr>
                <td>
        			<div type="text" id="datepicker"></div>
        		</td>
        		<td>
        			<div id="mensaje"></div>
        		</td>
            </tr>
        </tbody>
    </table>
</form>