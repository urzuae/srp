<?php /* Smarty version 3.0rc1, created on 2010-12-27 18:07:06
         compiled from "application/views/error/Error.tpl" */ ?>
<?php /*%%SmartyHeaderCode:20232499044d192a2a336ad8-89049067%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '0ed99ccfaf9a3fda5a8070048dd27babe7efc404' => 
    array (
      0 => 'application/views/error/Error.tpl',
      1 => 1293492830,
    ),
  ),
  'nocache_hash' => '20232499044d192a2a336ad8-89049067',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<h1 class="center">500 Internal Server Error</h1>
<hr/>
<div class="error"><strong><?php echo $_smarty_tpl->getVariable('type')->value;?>
</strong><p><?php echo $_smarty_tpl->getVariable('message')->value;?>
</p></div>
<div class="note"><?php echo $_smarty_tpl->getVariable('trace')->value;?>
</div>
<div class="code"><strong><?php echo $_smarty_tpl->getVariable('file')->value;?>
 (<?php echo $_smarty_tpl->getVariable('line')->value;?>
)</strong><div class="source"><?php echo $_smarty_tpl->getVariable('source')->value;?>
</div></div>


