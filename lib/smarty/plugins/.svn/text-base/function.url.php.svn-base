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
 * print an url
 * @param unknown_type $params
 * @param Smarty $smarty
 * @param unknown_type $template
 * @return string
 */
function smarty_function_url($params, $smarty, $template)
{
	$action = isset($params['action']) ? $params['action'] : $smarty->getTemplateVars('action');
	$controller = isset($params['controller']) ? $params['controller'] : $smarty->getTemplateVars('controller');
	unset($params['action']);
	unset($params['controller']);
	$extra = '';
	foreach ($params as $key => $param){
		$extra .= '/'. $key .'/'. $param; 
	}
	return "{$smarty->getTemplateVars('baseUrl')}/{$controller}/{$action}{$extra}"; 
}

?>
