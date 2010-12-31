
<div>
	<h4>Filtro de consulta</h4>
	<form method="post">
	<table class="report_form_filtro">
		<tr>
			<th>Empleado o unidad organizacional:</th>
			<td>
				<select name="filtro[empleado_unidad]">
				</select>
			</td>
		</tr>
		<tr>
			<th>Proyecto:</th>
			<td>
				<select name="filtro[proyecto]"></select>
			</td>
		</tr>
		<tr>
			<th>Estatus:</th>
			<td>
				<select name="filtro[estatus]"></select>
			</td>
		</tr>
		<tr>
			<th>Presencia:</th>
			<td>
				<input type="checkbox" name="filtro[presencia]" checked="checked"/>
			</td>
		</tr>
		<tr>
			<th>Periodo:</th>
			<td>
				<input type="text" name="filtro[desde]"/>
				<span>&nbsp;-&nbsp;</span>
				<input type="text" name="filtro[hasta]"/>
			</td>
		</tr>
		<tr>
			<td>
				<input type="submit" value="Consultar" name="action"/> 
			</td>
		</tr>
	</table>
	</form>
</div>