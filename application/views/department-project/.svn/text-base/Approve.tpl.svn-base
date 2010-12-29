<script type="text/javascript" src="{$baseUrl}/js/modules/department-project/approved.js"></script>
<h1>Aprobar Proyecto</h1>
<form action="{url action='approved-user'}" method="post" enctype="multipart/form-data">
	<input type="hidden" name="idDepartmentProject" value="{$idDepartmentProject}">
    	<table class="center">
        	<caption>{$l10n->_('Proyecto')}</caption>        
        	<tfoot>
            	<tr>
                	<td colspan="2">
                    	<input type="button" value="{$l10n->_('Regresar')}" class="back" />
                	</td>
            	</tr>
        	</tfoot>
        	<tbody>
            	<tr>
    				<th>{$l10n->_('Nombre')}</th>
    				<td><input type="text" name="name" id="name" value="{$post['name']}" readonly="readonly" /></td>
				</tr>				
        	</tbody>
    	</table>


	<br><br><br>


	<table class="center">
    	<caption>{$l10n->_('Lista Usuarios')}</caption>
    	<thead>
        	<tr>
            	<td>{$l10n->_('Nombre')}</td>
            	<td>{$l10n->_('Jefe')}</td>
            	<td>{$l10n->_('Aprobador')}</td>              
        	</tr>
    	</thead>
    	<tbody id="ajaxList">
    		{foreach from=$employees item=employee}
            	<tr class="{$project@iteration|odd}">
                	<td>{$employee.name}{$l10n->_(' ')}
                	{$employee.middleName}{$l10n->_(' ')}
                	{$employee.lastName}</td>
                	
                	<td  class="center">
                		<input type="checkbox" name="allow[{$employee.idEmployee}][{$idDepartmentProject}][{$levelOne}][{$isMainOne}]" 
                			id="allow_{$employee.idEmployee}_{$idDepartmentProject}_{$levelOne}_{$isMainOne}"
                            class="ajaxed childOf{$idDepartmentProject}ar "
                            {assign var=idEmployee value=$employee.idEmployee}
                            {assign var=level value=$levelOne}
                            {assign var=isMain value=$isMainOne}
                            {if $permissions[$idEmployee][$idDepartmentProject]== 1} checked="checked" {/if}
                         	value="1"/>
                    </td>
                    
                    <td  class="center">
                		<input type="checkbox" name="allow[{$employee.idEmployee}][{$idDepartmentProject}][{$levelTwo}][{$isMainOne}]" 
                			id="allow_{$employee.idEmployee}_{$idDepartmentProject}_{$levelTwo}_{$isMainOne}"
                            class="ajaxed childOf{$idDepartmentProject}ar "
                            {assign var=idEmployee value=$employee.idEmployee}
                            {assign var=level value=$levelTwo}
                            {assign var=isMain value=$isMainOne}
                            {if $permissions[$idEmployee][$idDepartmentProject]== 3} checked="checked" {/if}
                         	value="1"/>
                    </td>
                                   
            	</tr>
        	{/foreach}
    	</tbody>
	</table>
</form>