<?php
/**
 * ##$BRAND_NAME$##
 *
 * ##$DESCRIPTION$##
 *
 * @category   Smarty
 * @package    Smarty_Plugins
 * @copyright  ##$COPYRIGHT$##
 * @author     ##$AUTHOR$##, $LastChangedBy$
 * @version    ##$VERSION$##, SVN:  $Id$
 */

/**
 * print an icon
 * @param unknown_type $params
 * @param Smarty $smarty
 * @param unknown_type $template
 * @return string
 */
function smarty_function_icon($params, $smarty, $template)
{
	$extra = '';
	$icon_path = 'images/template/icons';
	$name = $params['src'];
	$type = isset($params['type']) ? $params['type']: 'png';
	unset($params['src']);
    unset($params['type']);
	foreach ($params as $key => $value)
	   $extra .= $key ."='{$value}' ";
    return "<img src='{$smarty->getTemplateVars('baseUrl')}/{$icon_path}/{$name}.{$type}' alt='icon' {$extra} />";
    
}

?>
