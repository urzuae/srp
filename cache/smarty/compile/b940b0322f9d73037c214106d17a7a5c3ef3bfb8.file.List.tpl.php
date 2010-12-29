<?php /* Smarty version 3.0rc1, created on 2010-12-27 18:14:09
         compiled from "application/views/user/List.tpl" */ ?>
<?php /*%%SmartyHeaderCode:9169599664d192bd125cba0-60916683%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'b940b0322f9d73037c214106d17a7a5c3ef3bfb8' => 
    array (
      0 => 'application/views/user/List.tpl',
      1 => 1293492830,
    ),
  ),
  'nocache_hash' => '9169599664d192bd125cba0-60916683',
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
    <caption><?php echo $_smarty_tpl->getVariable('i18n')->value->_('User');?>
</caption>
    <tfoot>
        <tr>
            <td colspan="2"><input type="submit" value="<?php echo $_smarty_tpl->getVariable('i18n')->value->_('Save');?>
" /></td>
        </tr>
    </tfoot>
    <tbody>
        <?php $_template = new Smarty_Internal_Template('user/Form.tpl', $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate();?><?php $_template->updateParentVariables(0);?><?php unset($_template);?>

    </tbody>
</table>
</form>
<hr/>


<table class="center">
    <caption><?php echo $_smarty_tpl->getVariable('i18n')->value->_('List');?>
</caption>
    <thead>
        <tr>
            <td><?php echo $_smarty_tpl->getVariable('i18n')->value->_('IdUser');?>
</td>
            <td><?php echo $_smarty_tpl->getVariable('i18n')->value->_('Username');?>
</td>
            <td><?php echo $_smarty_tpl->getVariable('i18n')->value->_('Password');?>
</td>
            <td><?php echo $_smarty_tpl->getVariable('i18n')->value->_('Status');?>
</td>
            <td><?php echo $_smarty_tpl->getVariable('i18n')->value->_('IdAccessRole');?>
</td>
            <td><?php echo $_smarty_tpl->getVariable('i18n')->value->_('IdPerson');?>
</td>
            <td><?php echo $_smarty_tpl->getVariable('i18n')->value->_('System');?>
</td>
            <td colspan="2"><?php echo $_smarty_tpl->getVariable('i18n')->value->_('Actions');?>
</td>
        </tr>
    </thead>
    <tbody id="ajaxList">
        <?php  $_smarty_tpl->tpl_vars['user'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('users')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
 $_smarty_tpl->tpl_vars['user']->iteration=0;
if (count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['user']->key => $_smarty_tpl->tpl_vars['user']->value){
 $_smarty_tpl->tpl_vars['user']->iteration++;
?>
            <tr class="<?php echo smarty_modifier_odd($_smarty_tpl->tpl_vars['user']->iteration);?>
">
                <td><?php echo $_smarty_tpl->getVariable('user')->value->getIdUser();?>
</td>
                <td><?php echo $_smarty_tpl->getVariable('user')->value->getUsername();?>
</td>
                <td><?php echo $_smarty_tpl->getVariable('user')->value->getPassword();?>
</td>
                <td><?php echo $_smarty_tpl->getVariable('user')->value->getStatus();?>
</td>
                <td><?php echo $_smarty_tpl->getVariable('user')->value->getIdAccessRole();?>
</td>
                <td><?php echo $_smarty_tpl->getVariable('user')->value->getIdPerson();?>
</td>
                <td><?php echo $_smarty_tpl->getVariable('user')->value->getSystem();?>
</td>
                <td><a href="<?php echo smarty_function_url(array('action'=>'edit','idUser'=>$_smarty_tpl->getVariable('user')->value->getIdUser()),$_smarty_tpl->smarty,$_smarty_tpl);?>
"><?php echo smarty_function_icon(array('src'=>'pencil','class'=>'tip','title'=>$_smarty_tpl->getVariable('i18n')->value->_('Edit')),$_smarty_tpl->smarty,$_smarty_tpl);?>
</a></td>
                <td><a href="<?php echo smarty_function_url(array('action'=>'delete','idUser'=>$_smarty_tpl->getVariable('user')->value->getIdUser()),$_smarty_tpl->smarty,$_smarty_tpl);?>
" class="confirm"><?php echo smarty_function_icon(array('src'=>'delete','class'=>'tip','title'=>$_smarty_tpl->getVariable('i18n')->value->_('Delete')),$_smarty_tpl->smarty,$_smarty_tpl);?>
</a></td>
            </tr>
        <?php }} ?>
    </tbody>
</table>

