<?php /* Smarty version 3.0rc1, created on 2010-12-27 18:14:16
         compiled from "application/views/specific-project/List.tpl" */ ?>
<?php /*%%SmartyHeaderCode:9959840374d192bd87a1cf3-98895619%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '64000f28476e5859e4ae0c048960031530e78bae' => 
    array (
      0 => 'application/views/specific-project/List.tpl',
      1 => 1293492830,
    ),
  ),
  'nocache_hash' => '9959840374d192bd87a1cf3-98895619',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<?php if (!is_callable('smarty_modifier_odd')) include 'lib/smarty/plugins/modifier.odd.php';
if (!is_callable('smarty_function_url')) include 'lib/smarty/plugins/function.url.php';
if (!is_callable('smarty_function_icon')) include 'lib/smarty/plugins/function.icon.php';
?><table class="center">
    <caption><?php echo $_smarty_tpl->getVariable('l10n')->value->_('Listado de Proyectos');?>
</caption>
    <thead>
        <tr>
            <td><?php echo $_smarty_tpl->getVariable('l10n')->value->_('Nombre');?>
</td>
            <td><?php echo $_smarty_tpl->getVariable('l10n')->value->_('Fecha de Inicio');?>
</td>
            <td><?php echo $_smarty_tpl->getVariable('l10n')->value->_('Fecha de fin');?>
</td>
            <td colspan="2"><?php echo $_smarty_tpl->getVariable('l10n')->value->_('Acciones');?>
</td>
        </tr>
    </thead>
    <tbody id="ajaxList">
        <?php  $_smarty_tpl->tpl_vars['specificProject'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('specificProjects')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
 $_smarty_tpl->tpl_vars['specificProject']->iteration=0;
if (count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['specificProject']->key => $_smarty_tpl->tpl_vars['specificProject']->value){
 $_smarty_tpl->tpl_vars['specificProject']->iteration++;
?>
            <tr class="<?php echo smarty_modifier_odd($_smarty_tpl->tpl_vars['specificProject']->iteration);?>
">
                <td><?php echo $_smarty_tpl->getVariable('specificProject')->value->getProjectName();?>
</td>
                <td><?php echo $_smarty_tpl->getVariable('specificProject')->value->getBeginningDate();?>
</td>
                <td><?php echo $_smarty_tpl->getVariable('specificProject')->value->getEndingDate();?>
</td>
                <!--<td><a href="<?php echo smarty_function_url(array('action'=>'edit','idSpecificProject'=>$_smarty_tpl->getVariable('specificProject')->value->getIdSpecificProject()),$_smarty_tpl->smarty,$_smarty_tpl);?>
"><?php echo smarty_function_icon(array('src'=>'pencil','class'=>'tip','title'=>$_smarty_tpl->getVariable('l10n')->value->_('Edit')),$_smarty_tpl->smarty,$_smarty_tpl);?>
</a></td>
                <td><a href="<?php echo smarty_function_url(array('action'=>'delete','idSpecificProject'=>$_smarty_tpl->getVariable('specificProject')->value->getIdSpecificProject()),$_smarty_tpl->smarty,$_smarty_tpl);?>
" class="confirm"><?php echo smarty_function_icon(array('src'=>'delete','class'=>'tip','title'=>$_smarty_tpl->getVariable('l10n')->value->_('Delete')),$_smarty_tpl->smarty,$_smarty_tpl);?>
</a></td>-->
                <td align="center"><a href="<?php echo smarty_function_url(array('action'=>'approve','idSpecificProject'=>$_smarty_tpl->getVariable('specificProject')->value->getIdProject()),$_smarty_tpl->smarty,$_smarty_tpl);?>
"><?php echo smarty_function_icon(array('src'=>'user_go','class'=>'tip','title'=>$_smarty_tpl->getVariable('l10n')->value->_('Aprobar')),$_smarty_tpl->smarty,$_smarty_tpl);?>
</a></td>
            </tr>
        <?php }} ?>
    </tbody>
</table>

