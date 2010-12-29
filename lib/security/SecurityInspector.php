<?php
/**
 * ##$BRAND_NAME$##
 *
 * ##$DESCRIPTION$##
 *
 * @category   Lib
 * @package    Lib_Security
 * @copyright  ##$COPYRIGHT$##
 * @author     ##$AUTHOR$##, $LastChangedBy$
 * @version    ##$VERSION$##, SVN:  $Id$
 */

require_once 'application/models/catalogs/SecurityControllerCatalog.php';
require_once 'application/models/catalogs/SecurityActionCatalog.php';
require_once 'application/models/catalogs/AccessRoleCatalog.php';
require_once 'lib/security/ManagerAcl.php';

/**
 * Clase que inspecciona nuestro ambiente de trabajo 
 *
 * @category   Lib
 * @package    Lib_Security
 * @copyright  ##$COPYRIGHT$##
 */
class SecurityInspector 
{

	/**
	 * Controladores
	 * @var array
	 */
	public $controllers = array();
	
	/**
	 * Class Constructor
	 *
	 * @return SecurityInspector
	 */
	public function SecurityInspector()
	{
		$this->seekControllers();
	}
	
	/**
	 * Analiza nuestro workspace, lee los controllers, sus actions, las agrega a la base de datos
	 */
	public function analizeWorkspace()
	{		
		foreach (array_keys($this->controllers) as $baseControllerName)
		{
			$controllerName = $this->underscore(substr($baseControllerName, 0, -10));
			$criteria = new Criteria();
			$criteria->add(SecurityController::NAME, $controllerName, Criteria::EQUAL);
			$criteria->setLimit(1);
			
			$controller = SecurityControllerCatalog::getInstance()->getByCriteria($criteria)->getOne();
			if (!($controller instanceof SecurityController ))
			{
			   $controller = SecurityControllerFactory::create($controllerName);
			   SecurityControllerCatalog::getInstance()->create($controller);
			}   
			
			foreach ($this->getActionsByController($baseControllerName) as $actionName)
			{
				$actionName = $this->underscore(substr($actionName,0,-6));
				$criteria = new Criteria();
				$criteria->add(SecurityAction::NAME,$actionName,Criteria::EQUAL);
				$criteria->add(SecurityAction::ID_CONTROLLER,$controller->getIdController(),Criteria::EQUAL);
				$criteria->setLimit(1);
				$action = SecurityActionCatalog::getInstance()->getByCriteria($criteria)->getOne();
				
				if (!($action instanceof SecurityAction ))
				{
					$action = SecurityActionFactory::create($controller->getIdController(), $actionName);
					SecurityActionCatalog::getInstance()->create($action);
				}
			}
		}
		ManagerAcl::getInstance()->clearCache();
	}
	
	
	/**
	 * Obtiene las acciones de un controllador
	 *
	 * @param string $controllerName
	 * @return array
	 */
	private function getActionsByController($controllerName)
	{
		if(!array_key_exists($controllerName,$this->controllers))
		  throw new Exception('No existe el controller '.$controllerName);
		 
		require_once $this->controllers[$controllerName]['path'];
		
		$actions = array();
		$reflection = new ReflectionClass($controllerName);
        foreach ($reflection->getMethods() as $method)
        {
        	if(preg_match('/Action$/i',$method->getName()))
                $actions[] = $method->getName();
        }
		return $actions;
	}
	
	
	/**
	 * Agrega/Elimina un permiso en la base de datos de facultades
	 *
	 * @param int $operation
	 * @param int $idAction
	 * @param int $idAccessRole
	 */
	public function setPermission($operation, $idAction, $idAccessRole)
	{
		if( $operation )
		   AccessRoleCatalog::getInstance()->linkToSecurityAction($idAccessRole, $idAction);
		else  
		   AccessRoleCatalog::getInstance()->unlinkFromSecurityAction($idAccessRole, $idAction);
		ManagerAcl::getInstance()->clearCache();
	}
	
	/**
     * M�todo que regresa una arreglo con la lista de controlladores del sistema
     * @return array
     */
    private function seekControllers()
    {
    	$front = Zend_Controller_Front::getInstance();
        $controllers = array();
        foreach ($front->getControllerDirectory() as $controllerPath){
	        if(false != ($handle = opendir($controllerPath)))
	        {
	            while ( false !== ($file = readdir($handle)) )
	            {
	                if(preg_match("/controller\\.php/i", $file))
	                    $controllers[basename($file,'.php')] = array(
	                        'file' => $file, 
	                        'path' => $controllerPath .'/'. $file);
	            }
	            closedir($handle);
	        }
        }
        $this->controllers = $controllers;
    }

	 /**
	 * Translates a camel case string into a string with underscores (e.g. firstName -&gt; first_name)
	 * @param    string   $str    String in camel case format
	 * @return    string            $str Translated into underscore format
	 */
	function underscore($str)
	{
		$str[0] = strtolower($str[0]);
		$func = create_function('$c', 'return "-" . strtolower($c[1]);');
		return preg_replace_callback('/([A-Z])/', $func, $str);
	}
    
	
}