<?php /* Smarty version 3.0rc1, created on 2010-12-27 18:07:05
         compiled from "application/views/layout/Layout.tpl" */ ?>
<?php /*%%SmartyHeaderCode:20028704794d192a29e8b5d5-72754577%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '34d2b9b1f5ac7952390dca06a210675566752a75' => 
    array (
      0 => 'application/views/layout/Layout.tpl',
      1 => 1293494346,
    ),
  ),
  'nocache_hash' => '20028704794d192a29e8b5d5-72754577',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="es" lang="es">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1"/> 
	<meta http-equiv="Pragma" content="no-cache"/>
	<meta http-equiv="Expires" content="-1"/>
	<title><?php echo $_smarty_tpl->getVariable('systemTitle')->value;?>
 | <?php echo $_smarty_tpl->getVariable('contentTitle')->value;?>
</title>
	<link rel="stylesheet" href="<?php echo $_smarty_tpl->getVariable('baseUrl')->value;?>
/css/style.css" type="text/css" />
	<!--[if IE]><link href="<?php echo $_smarty_tpl->getVariable('baseUrl')->value;?>
/css/style-ie.css" rel="stylesheet" type="text/css" /><![endif]-->
	<?php $_template = new Smarty_Internal_Template("layout/Scripts.tpl", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate();?><?php $_template->updateParentVariables(0);?><?php unset($_template);?>

</head>
<body class="wrapper">
	<div id="header">
            <div><?php if ($_smarty_tpl->getVariable('systemUser')->value){?><?php echo $_smarty_tpl->getVariable('l10n')->value->_('Bienvenido');?>
 <strong><?php echo $_smarty_tpl->getVariable('systemUser')->value->getUsername();?>
</strong><label id="type_user"> (<?php echo $_smarty_tpl->getVariable('systemAccessRole')->value->getName();?>
)</label> | <a href="<?php echo $_smarty_tpl->getVariable('baseUrl')->value;?>
/auth/logout"><?php echo $_smarty_tpl->getVariable('l10n')->value->_('Cerrar Sesión');?>
</a><?php }?></div>
        <span class="title"></span>	
    </div>
	
	<div class="clear"></div>
          <div class="content" id="content">
          	<div class="subHeader"><div><?php echo $_smarty_tpl->getVariable('systemTitle')->value;?>
 &raquo; <?php echo $_smarty_tpl->getVariable('contentTitle')->value;?>
</div></div>
			<div id="menuBar"><?php $_template = new Smarty_Internal_Template('layout/Menu.tpl', $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate();?><?php $_template->updateParentVariables(0);?><?php unset($_template);?>
</div>
			<div class="clear"></div>
          	<div class="contentPanel container_12" id="contentPanel">
          	     <?php $_template = new Smarty_Internal_Template("layout/Messages.tpl", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate();?><?php $_template->updateParentVariables(0);?><?php unset($_template);?>

          	     <?php echo $_smarty_tpl->getVariable('contentPlaceHolder')->value;?>
</div>
          	</div>
          <div class="clear"></div>
          <?php $_template = new Smarty_Internal_Template("layout/Modals.tpl", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate();?><?php $_template->updateParentVariables(0);?><?php unset($_template);?>

	<div id="footer">&copy; PCS</div>
</body>
</html>
