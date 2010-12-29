<?php /* Smarty version 3.0rc1, created on 2010-12-27 18:07:06
         compiled from "application/views/layout/Modals.tpl" */ ?>
<?php /*%%SmartyHeaderCode:12738739004d192a2a04cc26-03286071%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '0d78aaf2d1252cc12e37c084c8112c7d306f2f12' => 
    array (
      0 => 'application/views/layout/Modals.tpl',
      1 => 1293492830,
    ),
  ),
  'nocache_hash' => '12738739004d192a2a04cc26-03286071',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
  <!-- Modal Confirm -->
  <div id='confirm' style='display:none'>
    <a href='#' title='Close' class='modalCloseX simplemodal-close'>x</a>
    <div class='header'><span><?php echo $_smarty_tpl->getVariable('l10n')->value->_('Confirmar');?>
</span></div>
    <p class='message'></p>
    <div class='buttons'>
        <div class='no simplemodal-close'><?php echo $_smarty_tpl->getVariable('l10n')->value->_('No');?>
</div><div class='yes'><?php echo $_smarty_tpl->getVariable('l10n')->value->_('Si');?>
</div>
    </div>
  </div>
  <!--  Modal Dialog --> 
  <div id='dialog' style='display:none'>
    <a href='#' title='Close' class='modalCloseX simplemodal-close'>x</a>
    <div class='header'><span><?php echo $_smarty_tpl->getVariable('l10n')->value->_('Mensaje');?>
</span></div>
    <p class='message'></p>
    <div class='buttons'>
        <div class='yes'><?php echo $_smarty_tpl->getVariable('l10n')->value->_('Ok');?>
</div>
    </div>
  </div>
  <div id='ajaxLoader' style='display:none'><img src="<?php echo $_smarty_tpl->getVariable('baseUrl')->value;?>
/images/template/basic/ajax-loader.gif" alt="loading..." /></div>