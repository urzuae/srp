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

/**
 * Zend_Acl
 */
require_once 'Zend/Acl.php';
require_once 'Zend/Acl/Resource.php';
require_once 'Zend/Acl/Role.php';

/**
 * Clase para manejar roles y permisos de los usuarios
 *
 * @category   Lib
 * @package    Lib_Security
 * @copyright  ##$COPYRIGHT$##
 */
class ManagerAcl
{
    /**
     * Lista de control de acceso
     * @var Zend_Acl $acl
     */
	protected $acl;
	
	/**
	 * Instancia del singleton
	 * @staticvar $instance
	 */
	protected static $instance = null;
	
	/**
	 * Determina si se utiliza cache o no
	 * @var bool
	 */
	protected $enableCache = true;
	
	/**
	 * Cache
	 * @var Zend_Cache
	 */
	protected $cache;
	
	/**
	 * Constructor
	 */
	private function __construct()
	{	
	    $this->mi = microtime(true);
		if($this->enableCache)
		{
			require_once 'Zend/Cache.php';
			$frontend = array('lifetime' => '86400', 'automatic_serialization' => true);
			$backend = array('cache_dir' => './cache/acl/');
			$this->cache = Zend_Cache::factory('core','File', $frontend, $backend);
			
			$this->acl = $this->cache->load('acl');
			if(!$this->acl) $this->createAcl(); 
		}
		else
		{
			$this->createAcl();
		}
		$this->mf = microtime(true);
	}
	
	/**
	 * Genera la Lista de control de acceso
	 */
	protected function createAcl()
	{
		$this->acl = new Zend_Acl();
		$accessRoles = $this->getAccessRolesFromDatabase();
		$securityActions = $this->getSecurityActionsFromDatabase();
		$this->addAccessRoles($accessRoles);
		$this->addSecurityActions($securityActions);
		$this->grantPermissions();
		if($this->enableCache) $this->cache->save($this->acl, 'acl');
	}
	
	/**
	 * Obtiene los AccessRole de la Base de Datos
	 * @return array
	 */
	protected function getAccessRolesFromDatabase()
	{
	    require_once 'application/models/catalogs/AccessRoleCatalog.php';
	    $criteria = new Criteria();
	    $criteria->add(AccessRole::STATUS, AccessRole::$Status['Active'], Criteria::EQUAL );
	    $accessRoleCatalog = AccessRoleCatalog::getInstance();
	    return $accessRoleCatalog->getIdsByCriteria($criteria);
	}
	
	/**
	 * Obtiene las SecurityActions de la base de datos
	 * @return array
	 */
	protected function getSecurityActionsFromDatabase()
	{
	    require_once 'application/models/catalogs/SecurityActionCatalog.php';
	    require_once 'application/models/catalogs/SecurityControllerCatalog.php';
	    
	    $securityActionsCatalog = SecurityActionCatalog::getInstance();
	    $controllerCatalog = SecurityControllerCatalog::getInstance();
	    
	    $securityActionCollection = $securityActionsCatalog->getByCriteria();
	    
	    $securityActions = array();
	    while($securityActionCollection->valid())
	    {
	        $securityAction = $securityActionCollection->read();
	        $controller = $controllerCatalog->getById($securityAction->getIdController());
	        $controllerName = $controller->getName();
	        $actionName = $securityAction->getName();
	        $securityActions[$securityAction->getIdAction()] = $controllerName . '/' . $actionName;
	    }
	    return $securityActions;
	}
	
	/**
	 * Obtiene la relacion entre access role y security actions
	 * @return array
	 */
	protected function grantPermissions()
	{
	    require_once 'application/models/catalogs/AccessRoleCatalog.php';
	    $allPermissions = AccessRoleCatalog::getInstance()->getAllPermissions();
	    $actions = $this->getSecurityActionsFromDatabase();
	    

	    foreach ($allPermissions as $idAction => $accessRoles)
	    {
	    	foreach (array_keys($accessRoles) as $idAccessRole)
	    	{
 	    		$this->acl->allow($idAccessRole, $actions[$idAction]);
	    	}
	    }
	}

	
	/**
	 * Elimina el cache
	 * @return unknown_type
	 */
	public function clearCache()
	{
		$this->cache->remove('acl');
	}
	
	/**
	 * Obtiene la instancia
	 * @return ManagerAcl
	 */
	public static function getInstance()
	{
		if(!isset(self::$instance))
        {
            self::$instance = new ManagerAcl();
        }
        return self::$instance;
	}
	
	/**
	 * Tiempos de construccion
	 * @return number
	 */
	public function getTimeProcessing()
	{
	    return $this->mf - $this->mi;
	}
	
	/**
	 * Agregar los accessRoles
	 * @param array $accessRoles
	 */
	public function addAccessRoles($accessRoles)
	{
		foreach($accessRoles as $accessRole)
		{
			$this->acl->addRole(new Zend_Acl_Role($accessRole));
		}
	}
	
	/**
	 * Agrega las security Actions
	 * @param array $securityActions
	 */
	public function addSecurityActions($securityActions)
	{
		foreach($securityActions as $securityAction)
		{
			$this->acl->add(new Zend_Acl_Resource($securityAction));
		}
	}
	

	
	/**
	 * Obtiene la Lista de control de acceso
	 * @return Zend_Acl
	 */
	public function getAcl()
	{
		return $this->acl;
	}
	
}
