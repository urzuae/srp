<?php

/**
 * ##$BRAND_NAME$##
 *
 * ##$DESCRIPTION$##
 *
 * @category   Project
 * @package    Project_Controllers
 * @copyright  ##$COPYRIGHT$##
 * @author     ##$AUTHOR$##, $LastChangedBy$
 * @version    ##$VERSION$##, SVN:  $Id$
 */

require_once 'application/models/catalogs/UserCatalog.php';
require_once 'application/models/catalogs/UserLogCatalog.php';
require_once 'application/models/catalogs/AccessRoleCatalog.php';
require_once 'lib/managers/ManagerException.php';

/**
 * Clase abstracta de la que extenderan nuestros controladores, para agrupar instrucciones comunes
 *
 * @category   project
 * @package    Project_Controllers
 * @copyright  ##$COPYRIGHT$##
 */
 class UserManager 
 {
 	
 	/* Instancia de LockerManager
 	 * 
 	 * @staticvar LockerManager $instance
 	 */
 	protected static $instance = null;
 	
 	/**
 	 * Catalogo de Usuario
 	 * @var UserCatalog
 	 */
 	protected $userCatalog;
 	
 	/**
 	 * Catalogo de Log de Usuario
 	 * @var UserLogCatalog
 	 */
 	protected $userLogCatalog;
 	
 	/**
 	 * Constructor
 	 */
 	protected function UserManager()
 	{
 		$this->userCatalog = UserCatalog::getInstance();
 		$this->userLogCatalog = UserLogCatalog::getInstance();
 	}
 	
 	/**
 	 * Singleton Obtiene una instancia
 	 * @return UserManager
 	 */
 	public static function getInstance()
 	{
 		if (!isset(self::$instance))
        {
          self::$instance = new UserManager();
        }
        return self::$instance;
 	}
 	
 	/**
     * Crea un Usuario y genera el log
     * @param Zend_Controller_Request_Abstract $request
     * @param int $idUser que esta realizando la acción
     * @throws ManagerException
     */
    public function create(Zend_Controller_Request_Abstract $request, $idUser)
    {
    	$name = $request->getParam('name');
        $username = $request->getParam('username');
        $middlename = $request->getParam('middlename');
        $lastname = $request->getParam('lastname');
        $password = $request->getParam('password');
        $passwordConfirm = $request->getParam('passwordConfirm');
        $accessRole = $request->getParam('accessRole');
    	$maritalStatus = $request->getParam('maritalStatus');
    	$group = AccessRoleCatalog::getInstance()->getById($accessRole);
    	
    	if($password != $passwordConfirm) 
    	   throw new ManagerException('Las contrasñas no coinciden');
    	
        $userCriteria = new Criteria();
        $userCriteria->add('LOWER(username)', $username, Criteria::EQUAL, Criteria::LOWER);
        $userCriteria->setLimit(1);
        $user = $this->userCatalog->getByCriteria($userCriteria)->getOne();
        if($user instanceof User)
            throw new ManagerException('El nombre de usuario especificado ya está siendo usado');
        
   		$user = UserFactory::create($accessRole, $username, $password, User::$Status['Active'], $name, $middlename, $lastname, null, 1, $maritalStatus, '');
    	$this->userCatalog->create($user);
    	
    	$userLog = UserLogFactory::create($user->getIdUser(), UserLog::CREATE, $request->getServer('REMOTE_ADDR'), $idUser, null, 'Alta de Usuario '.$user->getUsername());
    	$this->userLogCatalog->create($userLog);
    	
    }
    
    /**
     * Obtiene los parámetros del objeto para poder mostrarlo en un formulario
     * @param int $idUser
     */
    public function getInfoForm($idUser)
    {
    	if ($idUser == NULL)
    	   throw new ManagerException('No se encontró el usuario a editar');
    	   
    	$user = $this->userCatalog->getById($idUser);
    	if(!($user instanceof User ))
    	   throw new ManagerException('El usuario especificado no existe');
    	$post = array(
    	   'name' => $user->getName(),
    	   'id' => $user->getIdUser(),
    	   'middlename' => $user->getMiddleName(),
    	   'lastname' => $user->getLastName(),
    	   'username' => $user->getUsername(),
    	   'maritalStatus' => $user->getMaritalStatus(),
    	   'accessRole' => $user->getIdAccessRole()
     	);

    	return $post;
    }
    
    /**
     * Actualiza el Usuario y genera el Log
     * @param int $idUser
     * @param Zend_Controller_Request_Abstract $request
     * @param int $idUser que esta realizando la acción
     * @throws ManagerException
     */
    public function update($idUser, Zend_Controller_Request_Abstract $request, $idResponsible)
    {
    	if ($idUser == NULL)
           throw new ManagerException('No se encontró el usuario a editar');
    	
        $user = $this->userCatalog->getById($idUser);
    	
        $name = $request->getParam('name');
        $middlename = $request->getParam('middlename');
        $lastname = $request->getParam('lastname');
        $password = $request->getParam('password');
        $passwordConfirm = $request->getParam('passwordConfirm');
        $accessRole = $request->getParam('accessRole');
        $maritalStatus = $request->getParam('maritalStatus');
        
        if($password != $passwordConfirm)
            throw new Exception($this->translate->_('Los passwords proporcionados no coinciden'));
        
        $user->setName($name);
        $user->setMiddleName($middlename);
        $user->setLastName($lastname);
        $user->setPassword($password);
        $user->setIdAccessRole($accessRole);
        $user->setMaritalStatus($maritalStatus);
        
        $this->userCatalog->update($user);
        
        $userLog = UserLogFactory::create($user->getIdUser(), UserLog::EDIT, $request->getServer("REMOTE_ADDR"), $idResponsible, null, 'Edición de Usuario '.$user->getName());
        $this->userLogCatalog->create($userLog);
    }
    
    /**
     * Elimina un usuario
     *
     * @param int $idUser
     * @param int $idResponsible
     */
    public function delete($idUser, $idResponsible)
    {
    	if ($idUser == NULL)
           throw new ManagerException('No se encontró el usuario a eliminar');
           
    	$user = $this->userCatalog->getById($idUser);
        $this->userCatalog->deactivate($user);
        
        $request = new Zend_Controller_Request_Http();
        
        $userLog = UserLogFactory::create($user->getIdUser(), UserLog::DEACTIVATE, $request->getServer("REMOTE_ADDR"), $idResponsible, null,'Desactivación de Usuario '.$user->getName());
        $this->userLogCatalog->create($userLog);
    }
    
 }