<h2>Exportar Archivo Baan</h2>
<br><br>
<script type="text/javascript" src="{$baseUrl}/js/modules/export/export.js"></script>
<form action="{url action=missing}" method="post">
	<table class="center">
		<caption>{$l10n->_('Criterios de Busqueda')}</caption>
		<tr>
                    <td>Departamento</td>
                    <td>
                        <select name="idDept" id="idDept">
                            <option value='0'>Selecciona un Departamento</option>
                            {foreach $departments as $department}
                                <option value={$department.idDept}>{$department.name}</option>
                            {/foreach}
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>Empleado: </td>
                    <td>
                        <select name="idEmp" id="idEmp">
                            <option>Departamento no Seleccionado</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>{$l10n->_('Inicio')}</td>
                    <td><input name="startp" type="text" size="12" id="startp" class="datePicker" value="{$startDate}"/></td>
                </tr>
                <tr>
                    <td>{$l10n->_('Fin')}</td>   
                    <td><input name="endp" type="text" size="12" id="endp" class="datePicker" value="{$endDate}"/></td>
                </tr>
                <tr>
    	            <td colspan="4">
    	        	<input type="submit" value="{$l10n->_('Exportar')}" />
    	            </td>
                </tr>
	</table>
</form>