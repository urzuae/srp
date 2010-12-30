<?php /* Smarty version 3.0rc1, created on 2010-12-29 15:53:59
         compiled from "application/views/calendar-day/Form.tpl" */ ?>
<?php /*%%SmartyHeaderCode:2436332684d1badf7570bc3-97646889%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '3b5a4fe22a43bd52d77fc969fabb237e8812e2c1' => 
    array (
      0 => 'application/views/calendar-day/Form.tpl',
      1 => 1293492830,
    ),
  ),
  'nocache_hash' => '2436332684d1badf7570bc3-97646889',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<?php if (!is_callable('smarty_function_html_options')) include '/var/www/library/Smarty3/plugins/function.html_options.php';
?>
<script type="text/javascript">
	var no_holidays=<?php echo $_smarty_tpl->getVariable('noHolidays')->value;?>

	var holidays_j=<?php echo $_smarty_tpl->getVariable('holidays')->value;?>

</script>

<script type="text/javascript" src="<?php echo $_smarty_tpl->getVariable('baseUrl')->value;?>
/js/jquery/calendar-day/calendar-day.js"></script>
<link rel="stylesheet" href="<?php echo $_smarty_tpl->getVariable('baseUrl')->value;?>
/css/test.css" type="text/css"/>
<tr>
    <th><?php echo $_smarty_tpl->getVariable('l10n')->value->_('Empleado');?>
</th>
    <!--<td><?php echo smarty_function_html_options(array('name'=>'id_employee','id'=>'id_employee','options'=>$_smarty_tpl->getVariable('Employees')->value,'selected'=>'0'),$_smarty_tpl->smarty,$_smarty_tpl);?>
</td>-->
    <td>
    	<select name="id_employee" id="id_employee">
    		<option value='0'>Todos</option>
    	<?php  $_smarty_tpl->tpl_vars['employee'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('employees')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if (count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['employee']->key => $_smarty_tpl->tpl_vars['employee']->value){
?>
    		<option value=<?php echo $_smarty_tpl->tpl_vars['employee']->value['idEmployee'];?>
><?php echo $_smarty_tpl->tpl_vars['employee']->value['name'];?>
</option>
    	<?php }} ?>
    	</select>	
    </td>
</tr>
<tr>
    <th><?php echo $_smarty_tpl->getVariable('l10n')->value->_('Día');?>
</th>
    <!--<td><input type="text" name="day_date" id="day_date" value="<?php echo $_smarty_tpl->getVariable('post')->value['day_date'];?>
" class="datePicker dateISO required" /></td>-->
    <td><input type="text" name="datepicker" id="datepicker"/></td>
</tr>
<tr>
    <th><?php echo $_smarty_tpl->getVariable('l10n')->value->_('Inhábil');?>
</th>
    <!--<td><input type="checkbox" name="enabled_disabled" id="enabled_disabled" value="1" class=" required" <?php if ($_smarty_tpl->getVariable('post')->value['enabled_disabled']){?>checked="checked"<?php }?> /></td>-->
    <td><input type="checkbox" name="enabled_disabled" id="enabled_disabled" <?php if ($_smarty_tpl->getVariable('post')->value['enabled_disabled']==1){?> checked="checked" <?php }?> value="2" /></td>	
</tr>