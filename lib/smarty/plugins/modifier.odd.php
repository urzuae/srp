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
 * 
 * @param int $i
 * @return string
 */
function smarty_modifier_odd($i)
{
	return $i % 2 == 1 ? 'odd': 'even'; 
}

?>
