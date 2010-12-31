<div>
	<div>
		{include file="report/Form.tpl"}
	</div>
	<div>
		{if is_array($baan_report)}
			<table>
				<tr>
					<th>C&oacute;digo de empleado</th>
					<th>Fecha registro</th>
					<th>C&oacute;digo proyecto</th>
					<th>C&oacute;digo actividad</th>
					<th>C&oacute;digo departamento</th>
					<th>C&oacute;digo tarea</th> 
					<th>Descripci&oacute;n</th>
					<th>Horas</th>
					<th>Texto por d&iacute;a</th>
				</tr>
				{foreach $baan_report as $rbr}
					<tr>
					{foreach $rbr as $fbr}
						<td>{$fbr}</td>
					{/foreach}
					</tr>
				{/foreach}
			</table>
		{else}
			<p>Seleccione el filtro deseado y de click en "Consultar"</p>
		{/if}
	</div>
</div>