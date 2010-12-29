<?php /* Smarty version 3.0rc1, created on 2010-12-27 18:07:05
         compiled from "application/views/layout/Messages.tpl" */ ?>
<?php /*%%SmartyHeaderCode:817416194d192a2a00cde2-23191702%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '9205cccd8bdc363711e5f99c75529723b3403868' => 
    array (
      0 => 'application/views/layout/Messages.tpl',
      1 => 1293492830,
    ),
  ),
  'nocache_hash' => '817416194d192a2a00cde2-23191702',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_smarty_tpl->getVariable('ok')->value){?><div class="ok"><p><?php echo $_smarty_tpl->getVariable('ok')->value;?>
</p></div><?php }?>
<?php if ($_smarty_tpl->getVariable('error')->value){?><div class="error"><p><?php echo $_smarty_tpl->getVariable('error')->value;?>
</p></div><?php }?>
<?php if ($_smarty_tpl->getVariable('notice')->value){?><div class="notice"><p><?php echo $_smarty_tpl->getVariable('notice')->value;?>
</p></div><?php }?>
<?php if ($_smarty_tpl->getVariable('alert')->value){?><div class="alert"><p><?php echo $_smarty_tpl->getVariable('alert')->value;?>
</p></div><?php }?>
<?php if ($_smarty_tpl->getVariable('warning')->value){?><div class="warning"><p><?php echo $_smarty_tpl->getVariable('warning')->value;?>
</p></div><?php }?>
<?php if ($_smarty_tpl->getVariable('note')->value){?><div class="note"><p><?php echo $_smarty_tpl->getVariable('note')->value;?>
</p></div><?php }?>