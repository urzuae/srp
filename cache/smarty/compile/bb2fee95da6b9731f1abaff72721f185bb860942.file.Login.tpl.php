<?php /* Smarty version 3.0rc1, created on 2010-12-27 18:07:05
         compiled from "application/views/auth/Login.tpl" */ ?>
<?php /*%%SmartyHeaderCode:16195769444d192a29e0d866-70958015%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'bb2fee95da6b9731f1abaff72721f185bb860942' => 
    array (
      0 => 'application/views/auth/Login.tpl',
      1 => 1293492830,
    ),
  ),
  'nocache_hash' => '16195769444d192a29e0d866-70958015',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<script type="text/javascript" src="<?php echo $_smarty_tpl->getVariable('baseUrl')->value;?>
/js/modules/auth/login.js"></script>
<div id="loginFormContainer">
	<?php if ($_smarty_tpl->getVariable('errorMessage')->value){?>
		<div class="error"><?php echo $_smarty_tpl->getVariable('errorMessage')->value;?>
</div><br />
	<?php }else{ ?>
		<br/><br/>
	<?php }?>
	<form action="<?php echo $_smarty_tpl->getVariable('baseUrl')->value;?>
/auth/login" method="post" id="loginForm">
		<table>
			<caption><?php echo $_smarty_tpl->getVariable('l10n')->value->_('Iniciar Sesión');?>
</caption>
			<tfoot>
				<tr>
					<td colspan="2"><input type="submit" value="<?php echo $_smarty_tpl->getVariable('l10n')->value->_('Iniciar Sesión');?>
"/></td>
				</tr>
			</tfoot>
			<tbody>
				<tr>
					<td><label for="username"><?php echo $_smarty_tpl->getVariable('l10n')->value->_('Usuario');?>
:</label></td>
					<td><input type="text" name="username" id="username" value="<?php echo $_smarty_tpl->getVariable('post')->value['username'];?>
"/></td>
				</tr>
				<tr>
					<td><label for="password"><?php echo $_smarty_tpl->getVariable('l10n')->value->_('Contraseña');?>
:</label></td>
					<td><input type="password" name="password" id="password" value=""/></td>
				</tr>
			</tbody>
		</table>
	</form>
</div>