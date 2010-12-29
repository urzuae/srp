<table class="center">
    <caption>{$l10n->_('Listado de Proyectos')}</caption>
    <thead>
        <tr>
            <td>{$l10n->_('Nombre')}</td>
            <td>{$l10n->_('Fecha de Inicio')}</td>
            <td>{$l10n->_('Fecha de fin')}</td>
            <td colspan="2">{$l10n->_('Acciones')}</td>
        </tr>
    </thead>
    <tbody id="ajaxList">
        {foreach $specificProjects as $specificProject}
            <tr class="{$specificProject@iteration|odd}">
                <td>{$specificProject->getProjectName()}</td>
                <td>{$specificProject->getBeginningDate()}</td>
                <td>{$specificProject->getEndingDate()}</td>
                <!--<td><a href="{url action=edit idSpecificProject=$specificProject->getIdSpecificProject()}">{icon src=pencil class=tip title=$l10n->_('Edit')}</a></td>
                <td><a href="{url action=delete idSpecificProject=$specificProject->getIdSpecificProject()}" class="confirm">{icon src=delete class=tip title=$l10n->_('Delete')}</a></td>-->
                <td align="center"><a href="{url action=approve idSpecificProject=$specificProject->getIdProject()}">{icon src=user_go class=tip title=$l10n->_('Aprobar')}</a></td>
            </tr>
        {/foreach}
    </tbody>
</table>

