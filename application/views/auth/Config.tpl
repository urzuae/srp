<script type="text/javascript" src="{$baseUrl}/js/modules/auth/config.js"></script>
<div class="center">
    <h3>{$l10n->_('Facultades de Usuarios')}</h3>
    <hr/>
    
    <div id="progressbar" ></div>
    
    <table>
        <caption>{$l10n->_('Facultades de Usuario por Grupo de Usuario')}</caption>
        <thead>
            <tr>
                <th>{$l10n->_('Acción/Grupo de Usuario')}</th>
                {assign var=totalRoles value=$accessRoles|count}
            {foreach from=$accessRoles item=accessRole}
                <th>{$accessRole->getName()} <br/>
                  <img src="{$baseUrl}/images/template/icons/tick.png" title="checkAll" class="masterChecker" id="parent_{$accessRole->getIdAccessRole()}"/>
                  <img src="{$baseUrl}/images/template/icons/cross.png" title="uncheckAll" class="masterUnchecker" id="parent_{$accessRole->getIdAccessRole()}"/> 
                </th>
            {/foreach}
            </tr>
        </thead>
        <tbody>
            {foreach from=$controllers item=controller}
                <tr>
                    <th colspan="{$totalRoles+1}">{$controller->getName()}</th>
                </tr>
                  {foreach from=$actions item=action}
                    {if $action->getIdController() == $controller->getIdController()}
                  <tr>
                    <td>{$action->getName()}</td>
                    {foreach from=$accessRoles item=accessRole}
                        <td class="spaced">
                            <input type="checkbox" name="allow[{$action->getIdAction()}][{$accessRole->getIdAccessRole()}]" id="allow_{$action->getIdAction()}_{$accessRole->getIdAccessRole()}"
                            class="ajaxed childOf{$accessRole->getIdAccessRole()}ar "
                            {assign var=idAction value=$action->getIdAction()}
                            {assign var=idAccessRole value=$accessRole->getIdAccessRole()}
                            {if $permissions[$idAction][$idAccessRole] == 1} checked="checked" {/if}
                            value="1"/>
                        </td>
                     {/foreach}
                   </tr>
                    {/if}
                  {/foreach}
                </tr>
            {/foreach}
        </tbody>
    </table>
    
</div>