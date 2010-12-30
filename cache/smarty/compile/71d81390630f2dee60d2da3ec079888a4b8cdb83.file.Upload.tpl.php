<?php /* Smarty version 3.0rc1, created on 2010-12-29 17:30:23
         compiled from "application/views/specific-project-task/Upload.tpl" */ ?>
<?php /*%%SmartyHeaderCode:18047327354d1bc48f6107f9-76664017%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '71d81390630f2dee60d2da3ec079888a4b8cdb83' => 
    array (
      0 => 'application/views/specific-project-task/Upload.tpl',
      1 => 1293492830,
    ),
  ),
  'nocache_hash' => '18047327354d1bc48f6107f9-76664017',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_smarty_tpl->getVariable('warning_files')->value!=''){?>
    <b> AVISO: <?php echo $_smarty_tpl->getVariable('warning_files')->value;?>
<b><br/>
 <?php }?>
<h3><?php echo $_smarty_tpl->getVariable('ok_rows_count')->value;?>
 <?php if ($_smarty_tpl->getVariable('ok_rows_count')->value>1){?> registros procesados<?php }else{ ?> registro procesado<?php }?> de <?php echo $_smarty_tpl->getVariable('rows_count')->value;?>
</h3><br/>
<b>Errores (<?php echo $_smarty_tpl->getVariable('reported_rows_count')->value;?>
)</b>
<?php if ($_smarty_tpl->getVariable('reported_rows_count')->value>0){?>
<table id="errors" class="center costum_form" style="width:100%;">
    <thead>
        <tr>
            <td>Linea</td>
            <td>Error</td>
        </tr>
    </thead>
    <tbody>
    <?php  $_smarty_tpl->tpl_vars['i'] = new Smarty_Variable;
 $_smarty_tpl->tpl_vars['myId'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('reported_rows')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if (count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['i']->key => $_smarty_tpl->tpl_vars['i']->value){
 $_smarty_tpl->tpl_vars['myId']->value = $_smarty_tpl->tpl_vars['i']->key;
?>
        <tr>
            <td style="vertical-align: top">
                <?php echo $_smarty_tpl->tpl_vars['myId']->value;?>

            </td>
            <td>
                <?php echo $_smarty_tpl->tpl_vars['i']->value['ERROR'];?>

            </td>
        </tr>
    <?php }} ?>
    </tbody>
<?php }?>
</table>
<br/>
<b>Avisos (<?php echo $_smarty_tpl->getVariable('db_errors_count')->value;?>
)</b>
<?php if ($_smarty_tpl->getVariable('db_errors')->value>0){?>
<table id="warnings" class="center costum_form" style="width:100%;">
    <thead>
        <tr>
            <td>Linea</td>
            <td>Aviso</td>
        </tr>
    </thead>
    <tbody>
    <?php  $_smarty_tpl->tpl_vars['i'] = new Smarty_Variable;
 $_smarty_tpl->tpl_vars['myId'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('db_errors')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if (count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['i']->key => $_smarty_tpl->tpl_vars['i']->value){
 $_smarty_tpl->tpl_vars['myId']->value = $_smarty_tpl->tpl_vars['i']->key;
?>
        <tr>
            <td style="vertical-align: top">
                <?php echo $_smarty_tpl->tpl_vars['myId']->value;?>

            </td>
            <td>
                <?php echo $_smarty_tpl->tpl_vars['i']->value;?>

            </td>
        </tr>
    <?php }} ?>
    </tbody>
<?php }?>
</table>
<br/>
<br/>
<b>Formato CSV(Líneas incorrectas)</b>
<?php if ($_smarty_tpl->getVariable('csv_lines')->value>0){?>
<table id="warnings" class="center costum_form" style="width:100%;">
    <thead>
        <tr>
            <td>Linea</td>
        </tr>
    </thead>
    <tbody>
    <?php  $_smarty_tpl->tpl_vars['i'] = new Smarty_Variable;
 $_smarty_tpl->tpl_vars['myId'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('csv_lines')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if (count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['i']->key => $_smarty_tpl->tpl_vars['i']->value){
 $_smarty_tpl->tpl_vars['myId']->value = $_smarty_tpl->tpl_vars['i']->key;
?>
        <tr>
            <td>
                <?php echo $_smarty_tpl->tpl_vars['i']->value;?>

            </td>
        </tr>
    <?php }} ?>
    </tbody>
<?php }?>
</table>