
<script type="text/javascript" src="{$baseUrl}/js/modules/menu/manage.js"></script>
<div class="center">
    <h3>{$l10n->_('Menú de Usuario')}</h3>
   
    <hr/>
    <div class="container_12">
    <div class="grid_6">
    <table class="wide">
        <caption>{$l10n->_('Acciones Disponibles')}</caption>
        <tbody>
            {foreach from=$controllers item=controller}
                <tr>
                    <td><img src="{$baseUrl}/images/template/icons/magnifier.png" alt="toggle" id="parent_{$controller->getIdController()}" class="parentMenu" /></td>
                    <th>{$controller->getName()}</th>
                    <th>(0)</th>
                </tr>
                  {foreach from=$actions item=action}
                    {if $action->getIdController() == $controller->getIdController()}
                  <tr class="child childOf{$controller->getIdController()}" id="action_item_{$action->getIdAction()}">
                    <td></td>
                    <td>{$action->getName()}</td>
                    <td>
                        <img src="{$baseUrl}/images/template/icons/add.png" alt="add" id="add_child_{$action->getIdAction()}" class="moveItem" />
                    </td>
            
                   </tr>
                    {/if}
                  {/foreach}
            {/foreach}
        </tbody>
    </table>
    </div>
    <div class="grid_6">
       <table>
        <caption>{$l10n->_('Agregar un Item')}</caption>
        <tbody>
            <tr>
                <th><label for="name">{$l10n->_('Nombre')}</label></th>
                <td><input id="name" name="name" value=""></td>
            </tr>
        </tbody>
        </table>
        
         
        
        <div class="clear"></div>
        <hr/>
        
      <div class="grid_6">
       
       <div class="content"><div class="subHeader"><div>{$l10n->_('Resultado de Menú')}</div></div>
        <div class="contentPanel">
            {$menuItems}
         </div>
       </div>
    </div>
    </div>
    <div class="clear"></div>
    </div>
</div>
