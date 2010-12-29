<form action="{url action=create}" method="post" class="validate ajaxForm">
<table class="center">
    <caption>{$l10n->_('Registro de Días hábiles / inhábiles')}</caption>
    <tfoot>
        <tr>
            <td colspan="2"><input type="submit"  value="{$l10n->_('Guardar')}" /></td>
        </tr>
    </tfoot>
    <tbody>
        {include file='calendar-day/Form.tpl'}
    </tbody>
</table>
</form>
<hr/>

<form action="{url action=list}" method="post">
	<table class="center"">
		<caption>{$l10n->_('Búsqueda de Empleado')}</caption>
		<tr>
    		<th>{$l10n->_('Nombre')}</th>
			<td><input name="name" type="text" size="40" id="name" value="{$name}"/></td> 			  
    		<tfoot>
	        	<tr>
    	        	<td colspan="4"><input type="submit" value="{$l10n->_('Buscar')}" /></td>
        		</tr>
    		</tfoot>
		</tr>
	</table>
</form>

<br><br><br>


<table class="center">
    <caption>{$l10n->_('Listado de Días hábiles / inhábiles')}</caption>
    <thead>
        <tr>
            <td>{$l10n->_('Empleado')}</td>
            <td>{$l10n->_('Calendario')}</td>
        </tr>
    </thead>
    <tbody id="ajaxList">
    	<tr class="{$calendarDay@iteration|odd}">
			<td>{$l10n->_('Todos')}</td>
            <td class="center"><a href="{url action=view idEmployee=0}">{icon src=date_go class=tip title=$l10n->_('Ver Calendario')}</a></td>
        </tr>
        {foreach $employees as $employee}
            <tr class="{$calendarDay@iteration|odd}">
                <td>{$employee.name}</td>
                <td class="center"><a href="{url action=view idEmployee=$employee.idEmployee}">{icon src=date_go class=tip title=$l10n->_('Ver Calendario')}</a></td>
            </tr>
        {/foreach}        
    </tbody>
</table>