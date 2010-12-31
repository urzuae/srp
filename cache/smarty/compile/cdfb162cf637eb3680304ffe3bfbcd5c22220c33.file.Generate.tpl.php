<?php /* Smarty version 3.0rc1, created on 2010-12-30 10:14:05
         compiled from "application/views/export/Generate.tpl" */ ?>
<?php /*%%SmartyHeaderCode:14244327884d1cafcd881cc5-21794165%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'cdfb162cf637eb3680304ffe3bfbcd5c22220c33' => 
    array (
      0 => 'application/views/export/Generate.tpl',
      1 => 1293725644,
    ),
  ),
  'nocache_hash' => '14244327884d1cafcd881cc5-21794165',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<?php if (!is_callable('smarty_function_url')) include 'lib/smarty/plugins/function.url.php';
?><h2>Exportar Archivo Baan</h2>
<h3 style="text-align:center;">Criterios de Busqueda</h3>
<br>
<script type="text/javascript" src="<?php echo $_smarty_tpl->getVariable('baseUrl')->value;?>
/js/modules/export/export.js"></script>
<form action="<?php echo smarty_function_url(array('action'=>'missing'),$_smarty_tpl->smarty,$_smarty_tpl);?>
">
	<table class="center">
		<tr>
                    <td>Departamento</td>
                    <td>
                        <select name="idDept" id="idDept">
                            <option value=''>Selecciona un Departamento</option>
                            <?php  $_smarty_tpl->tpl_vars['department'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('departments')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if (count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['department']->key => $_smarty_tpl->tpl_vars['department']->value){
?>
                                <option value=<?php echo $_smarty_tpl->tpl_vars['department']->value['idDept'];?>
><?php echo $_smarty_tpl->tpl_vars['department']->value['name'];?>
</option>
                            <?php }} ?>
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
                    <td><?php echo $_smarty_tpl->getVariable('l10n')->value->_('Inicio');?>
</td>
                    <td><input name="startDate" type="text" size="12" id="startp" class="datePicker" value="<?php echo $_smarty_tpl->getVariable('startDate')->value;?>
"/></td>
                </tr>
                <tr>
                    <td><?php echo $_smarty_tpl->getVariable('l10n')->value->_('Fin');?>
</td>   
                    <td><input name="endDate" type="text" size="12" id="endp" class="datePicker" value="<?php echo $_smarty_tpl->getVariable('endDate')->value;?>
"/></td>
                </tr>
                <tr>
    	            <td colspan="4">
    	        	<input type="submit" value="<?php echo $_smarty_tpl->getVariable('l10n')->value->_('Exportar');?>
" />
    	            </td>
                </tr>
	</table>
</form>