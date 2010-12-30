<?php /* Smarty version 3.0rc1, created on 2010-12-29 15:53:59
         compiled from "application/views/calendar-day/List.tpl" */ ?>
<?php /*%%SmartyHeaderCode:300129714d1badf73d3b98-41904013%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'e55427d461a6cdb002672a9438aacd63703bbba9' => 
    array (
      0 => 'application/views/calendar-day/List.tpl',
      1 => 1293492830,
    ),
  ),
  'nocache_hash' => '300129714d1badf73d3b98-41904013',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<?php if (!is_callable('smarty_function_url')) include 'lib/smarty/plugins/function.url.php';
if (!is_callable('smarty_modifier_odd')) include 'lib/smarty/plugins/modifier.odd.php';
if (!is_callable('smarty_function_icon')) include 'lib/smarty/plugins/function.icon.php';
?><form action="<?php echo smarty_function_url(array('action'=>'create'),$_smarty_tpl->smarty,$_smarty_tpl);?>
" method="post" class="validate ajaxForm">
<table class="center">
    <caption><?php echo $_smarty_tpl->getVariable('l10n')->value->_('Registro de Días hábiles / inhábiles');?>
</caption>
    <tfoot>
        <tr>
            <td colspan="2"><input type="submit"  value="<?php echo $_smarty_tpl->getVariable('l10n')->value->_('Guardar');?>
" /></td>
        </tr>
    </tfoot>
    <tbody>
        <?php $_template = new Smarty_Internal_Template('calendar-day/Form.tpl', $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate();?><?php $_template->updateParentVariables(0);?><?php unset($_template);?>

    </tbody>
</table>
</form>
<hr/>

<form action="<?php echo smarty_function_url(array('action'=>'list'),$_smarty_tpl->smarty,$_smarty_tpl);?>
" method="post">
	<table class="center"">
		<caption><?php echo $_smarty_tpl->getVariable('l10n')->value->_('Búsqueda de Empleado');?>
</caption>
		<tr>
    		<th><?php echo $_smarty_tpl->getVariable('l10n')->value->_('Nombre');?>
</th>
			<td><input name="name" type="text" size="40" id="name" value="<?php echo $_smarty_tpl->getVariable('name')->value;?>
"/></td> 			  
    		<tfoot>
	        	<tr>
    	        	<td colspan="4"><input type="submit" value="<?php echo $_smarty_tpl->getVariable('l10n')->value->_('Buscar');?>
" /></td>
        		</tr>
    		</tfoot>
		</tr>
	</table>
</form>

<br><br><br>


<table class="center">
    <caption><?php echo $_smarty_tpl->getVariable('l10n')->value->_('Listado de Días hábiles / inhábiles');?>
</caption>
    <thead>
        <tr>
            <td><?php echo $_smarty_tpl->getVariable('l10n')->value->_('Empleado');?>
</td>
            <td><?php echo $_smarty_tpl->getVariable('l10n')->value->_('Calendario');?>
</td>
        </tr>
    </thead>
    <tbody id="ajaxList">
    	<tr class="<?php echo smarty_modifier_odd($_smarty_tpl->getVariable('calendarDay')->iteration);?>
">
			<td><?php echo $_smarty_tpl->getVariable('l10n')->value->_('Todos');?>
</td>
            <td class="center"><a href="<?php echo smarty_function_url(array('action'=>'view','idEmployee'=>0),$_smarty_tpl->smarty,$_smarty_tpl);?>
"><?php echo smarty_function_icon(array('src'=>'date_go','class'=>'tip','title'=>$_smarty_tpl->getVariable('l10n')->value->_('Ver Calendario')),$_smarty_tpl->smarty,$_smarty_tpl);?>
</a></td>
        </tr>
        <?php  $_smarty_tpl->tpl_vars['employee'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('employees')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if (count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['employee']->key => $_smarty_tpl->tpl_vars['employee']->value){
?>
            <tr class="<?php echo smarty_modifier_odd($_smarty_tpl->getVariable('calendarDay')->iteration);?>
">
                <td><?php echo $_smarty_tpl->tpl_vars['employee']->value['name'];?>
</td>
                <td class="center"><a href="<?php echo smarty_function_url(array('action'=>'view','idEmployee'=>$_smarty_tpl->tpl_vars['employee']->value['idEmployee']),$_smarty_tpl->smarty,$_smarty_tpl);?>
"><?php echo smarty_function_icon(array('src'=>'date_go','class'=>'tip','title'=>$_smarty_tpl->getVariable('l10n')->value->_('Ver Calendario')),$_smarty_tpl->smarty,$_smarty_tpl);?>
</a></td>
            </tr>
        <?php }} ?>        
    </tbody>
</table>