<?php 
/**
 * ##$BRAND_NAME$##
 *
 * ##$DESCRIPTION$##
 *
 * @category   Project
 * @package    Project_Views_Smarty
 * @copyright  ##$COPYRIGHT$##
 * @author     ##$AUTHOR$##, $LastChangedBy$
 * @version    ##$VERSION$##, SVN:  $Id$
 */

require_once 'Smarty/Smarty_Compiler.class.php';

/**
 * Clase que extiende el Compilador original del smarty para poder usar los helpers de zend_view
 *
 * @category   project
 * @package    Project_Views
 * @subpackage Project_Views_Smarty
 * @copyright  ##$COPYRIGHT$##
 */
class ProjectSmartyCompiler extends Smarty_Compiler
{
    /**
     * @var Zend_View_Abstract
     */
    private $zendView;

    /**
     * Constructor de la clase
     * @return ProjectSmartyCompiler
     */
    public function ProjectSmartyCompiler()
    {
        $this->Smarty_Compiler();
        $this->zendView = new Zend_View();
    }
    
    
    function _compile_compiler_tag($tagCommand, $tagArgs, &$output)
    {
        //We first try to use Smarty's own functionality to parse the tag
        $found = parent::_compile_compiler_tag($tagCommand,$tagArgs,$output);
        if($found === false)
        {
            try
            {
                //Check if helper exists and create output
                $this->zendView->getHelper($tagCommand);
                $helperArgs = array();
                if($tagArgs !== null)
                {
                    //Start parsing our custom syntax
                    $params = explode(' ',$tagArgs);
                    foreach($params as $p)
                    {
                        //Split each key=value pair to vars
                        list($key,$value) = explode('=',$p,2);
                        $section = '';

                        //If there's a dot in the key, it means we
                        //need to use associative arrays
                        if(strpos('.',$key) != -1)
                          list($key,$section) = explode('.',$key);

                        //Use Smarty's own functions to parse the value
                        //so that if there's a variable, it gets changed to
                        //properly point at a template variable etc.
                        $value = $this->_parse_var_props($value);
             
                        //Put the value into the arg array
                        if($section == '')
                        {
                            if(array_key_exists($key,$helperArgs))
                            {
                                if(is_array($helperArgs[$key]))
                                    $helperArgs[$key][] = $value;
                                else
                                    $helperArgs[$key] = array($helperArgs[$key],$value);
                            }
                            else
                                $helperArgs[$key] = $value;
                        }
                        else
                        {
                            if(!is_array($helperArgs[$key]))
                                $helperArgs[$key] = array();
                            $helperArgs[$key][$section] = $value;
                        }
                    }
                }
                //Save the code to put to the template in the output
                $output = "<?php echo \$this->callViewHelper('$tagCommand',array(".$this->_createParameterCode($helperArgs).")); ?>";
                $found = true;
            }
            catch(Exception $e)
            {
                //Exception means the helper was not found
                $found = false;
                fwrite(fopen('php://stderr','a'),$e->getMessage());
            }
        }
        return $found;
    }
  
  
    /**
     * This function creates the code for the helper params
     *
     * @param array $params
     * @return string
     */
    private function _createParameterCode($params)
    {
        $code = '';
        $i = 1;
        $pCount = count($params);
        foreach($params as $p) {
            if(is_array($p))
            {
                $arrayCode = array();
                foreach ($p as $cle=>$elem) 
                {
                    $arrayCode[] = "'".$cle."' => ".trim($elem);
                }
                $code .= 'array('.(implode(',',$arrayCode)).')';
            } else {
                $code .= $p;
            }
            if($i != $pCount) 
            {
                $code .= ',';
            }
            $i++;
        }
        return $code;
    }
  
    
    
}


