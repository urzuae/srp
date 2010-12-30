<?php /* Smarty version 3.0rc1, created on 2010-12-29 15:53:51
         compiled from "application/views/specific-project/Edit.tpl" */ ?>
<?php /*%%SmartyHeaderCode:2332370424d1badef883977-28833684%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '86a72ef461dd0f1a0b587a2a9aea955756a7e74e' => 
    array (
      0 => 'application/views/specific-project/Edit.tpl',
      1 => 1293492830,
    ),
  ),
  'nocache_hash' => '2332370424d1badef883977-28833684',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<?php if (!is_callable('smarty_function_url')) include 'lib/smarty/plugins/function.url.php';
?><form action="<?php echo smarty_function_url(array('action'=>'update'),$_smarty_tpl->smarty,$_smarty_tpl);?>
" method="post" class="validate">
    <input type="hidden" name="idSpecificProject" value="<?php echo $_smarty_tpl->getVariable('post')->value['id_specific_project'];?>
">
    <table class="center">
        <caption><?php echo $_smarty_tpl->getVariable('i18n')->value->_('Edit');?>
</caption>
        <tfoot>
            <tr>
                <td colspan="2">
                    <input type="submit" value="<?php echo $_smarty_tpl->getVariable('i18n')->value->_('Save');?>
" />
                    <input type="button" value="<?php echo $_smarty_tpl->getVariable('i18n')->value->_('Back');?>
" class="back" />
                </td>
            </tr>
        </tfoot>
        <tbody>
            <?php $_template = new Smarty_Internal_Template('specificProject/Form.tpl', $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate();?><?php $_template->updateParentVariables(0);?><?php unset($_template);?>

        </tbody>
    </table>
</form>
