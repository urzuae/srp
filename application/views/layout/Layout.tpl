<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="es" lang="es">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1"/> 
	<meta http-equiv="Pragma" content="no-cache"/>
	<meta http-equiv="Expires" content="-1"/>
	<title>{$systemTitle} | {$contentTitle}</title>
	<link rel="stylesheet" href="{$baseUrl}/css/style.css" type="text/css" />
	<!--[if IE]><link href="{$baseUrl}/css/style-ie.css" rel="stylesheet" type="text/css" /><![endif]-->
	{include file="layout/Scripts.tpl"}
</head>
<body class="wrapper">
	<div id="header">
            <div>{if $systemUser}{$l10n->_('Bienvenido')} <strong>{$systemUser->getUsername()}</strong><label id="type_user"> ({$systemAccessRole->getName()})</label> | <a href="{$baseUrl}/auth/logout">{$l10n->_('Cerrar Sesión')}</a>{/if}</div>
        <span class="title"></span>	
    </div>
	
	<div class="clear"></div>
          <div class="content" id="content">
          	<div class="subHeader"><div>{$systemTitle} &raquo; {$contentTitle}</div></div>
			<div id="menuBar">{include file='layout/Menu.tpl'}</div>
			<div class="clear"></div>
          	<div class="contentPanel container_12" id="contentPanel">
          	     {include file="layout/Messages.tpl"}
          	     {$contentPlaceHolder}</div>
          	</div>
          <div class="clear"></div>
          {include file="layout/Modals.tpl"}
	<div id="footer">&copy; PCS</div>
</body>
</html>
