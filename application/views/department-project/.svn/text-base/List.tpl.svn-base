<table class="center">
    <caption>{$l10n->_('Listado de Proyectos')}</caption>
    <thead>
        <tr>            
            <td>{$l10n->_('Nombre')}</td>            
            <!--<td colspan="2">{$l10n->_('Acciones')}</td>-->
            <td>{$l10n->_('Acciones')}</td>
        </tr>
    </thead>
    <tbody id="ajaxList">
        {foreach $departmentProjects as $departmentProject}
            <tr class="{$departmentProject@iteration|odd}">
               <td>{$departmentProject.department}</td>
                <!--<td><a href="{url action=edit idDepartmentProject=$departmentProject.idDepartmentProject}">{icon src=pencil class=tip title=$l10n->_('Editar')}</a></td>-->
                <!--<td><a href="{url action=delete idDepartmentProject=$departmentProject.idDepartmentProject}" class="confirm">{icon src=delete class=tip title=$l10n->_('Eliminar')}</a></td>-->
                <td align="center"><a href="{url action=approve idDepartmentProject=$departmentProject.idDepartmentProject}">{icon src=user_go class=tip title=$l10n->_('Aprobar')}</a></td>                
            </tr>
        {/foreach}
    </tbody>
</table>

