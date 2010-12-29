{literal}
<script type="text/javascript">
	var no_holidays={/literal}{$noHolidays}{literal}
	var holidays_j={/literal}{$holidays}{literal}
</script>
{/literal}
<script type="text/javascript" src="{$baseUrl}/js/jquery/calendar-day/calendar-day.js"></script>
<link rel="stylesheet" href="{$baseUrl}/css/test.css" type="text/css"/>
<tr>
    <th>{$l10n->_('Empleado')}</th>
    <!--<td>{html_options name=id_employee id=id_employee options=$Employees selected='0'}</td>-->
    <td>
    	<select name="id_employee" id="id_employee">
    		<option value='0'>Todos</option>
    	{foreach $employees as $employee}
    		<option value={$employee.idEmployee}>{$employee.name}</option>
    	{/foreach}
    	</select>	
    </td>
</tr>
<tr>
    <th>{$l10n->_('Día')}</th>
    <!--<td><input type="text" name="day_date" id="day_date" value="{$post['day_date']}" class="datePicker dateISO required" /></td>-->
    <td><input type="text" name="datepicker" id="datepicker"/></td>
</tr>
<tr>
    <th>{$l10n->_('Inhábil')}</th>
    <!--<td><input type="checkbox" name="enabled_disabled" id="enabled_disabled" value="1" class=" required" {if $post['enabled_disabled']}checked="checked"{/if} /></td>-->
    <td><input type="checkbox" name="enabled_disabled" id="enabled_disabled" {if $post['enabled_disabled']== 1} checked="checked" {/if} value="2" /></td>	
</tr>