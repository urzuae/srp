<table width="80%" align="center">
	    <caption>{$l10n->_('Listado de Tareas')}</caption>
	    <thead>
	        <tr>
	        	<td>{$l10n->_('Tarea')}</td>
	            <td>{$l10n->_('Proyecto')}</td>
	            <td>{$l10n->_('Estatus')}</td>
	            <td colspan="2">{$l10n->_('Acción')}</td>
	        </tr>
	    </thead>
	    <tbody id="aList">
	    {foreach $tasks as $task}
	    	<tr>
	    		<td>{$task.description}</td>
	    		<td>{$task.project}</td>
	    		{if $task.status == 2}
	    			<td>{icon src=flag_green class=tip title=$l10n->_('Liberada')}</td>
	    		{/if}
	    		{if $task.status == 3}
	    			<td>{icon src=flag_red class=tip title=$l10n->_('Rechazada')}</td>
	    		{/if}
	    		{if $task.status == 4}
	    			<td>{icon src=flag_blue class=tip title=$l10n->_('Aprobada')}</td>
	    		{/if}
	    		{if $task.status == 1}
	    			<td>{icon src=flag_yellow class=tip title=$l10n->_('En Borrador')}</td>
	    		{/if}
	    		<td  class="center">
                		<input type="checkbox" name="approve" 
                			id=""
                            class=""
                            checked=""
                         	value="1"/>
                </td>
	    		<td  class="center">
                		<input type="checkbox" name="reject" 
                			id=""
                            class=""
                            checked=""
                         	value="1"/>
                </td>
	    	</tr>
	    {/foreach}       
	    </tbody>
	</table>