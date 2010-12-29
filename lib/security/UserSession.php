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
 * Zend_Session_Namespace
 */
require_once 'Zend/Session/Namespace.php';
require_once 'application/models/beans/Employee.php';

/**
 * Clase para manejar la session del usuario
 *
 * @category   Lib
 * @package    Lib_Security
 * @copyright  ##$COPYRIGHT$##
 */
 class UserSession 
 {
 	
 	/** 
 	 * Instancia de UserSession
 	 * @staticvar UserSession $instance
 	 */
 	protected static $instance = null;
 	
 	/**
 	 * Variable para prevenir colisiones de sesiones 
 	 * @var string
 	 */
 	protected $fingerprint = null;
 	
 	/**
 	 * Constructor
 	 */
 	protected function UserSession()
 	{
 	    $registry = Zend_Registry::getInstance();
 	    $this->fingerprint = 'zf_' . md5($registry->config->database->params->username . '@' . $registry->config->database->params->dbname);
 	}
 	
 	/**
 	 * Singleton Obtiene una instancia
 	 * @return UserSession
 	 */
 	public static function getInstance()
 	{
 		if (!isset(self::$instance))
        {
          self::$instance = new UserSession();
        }
        return self::$instance;
 	}
 	
 	/**
 	 * Guarda un atributo en la sesion del usuario
 	 * @param string $name
 	 * @param mixed $value
 	 * @param string $ns Namespace 
 	 */
    public function setAttribute($name, $value, $ns = 'common')
 	{
 	    $session = new Zend_Session_Namespace($this->fingerprint . '@' . $ns);
 	    $session->{$name} = $value;
 	}
 	
 	/**
 	 * Obtiene un atributo de la sesion del usuario
 	 * @param string $name
 	 * @param mixed $default
 	 * @param string $ns Namespace
 	 * @return mixed
 	 */
 	public function getAttribute($name, $default = null, $ns = 'common')
 	{
 	    $session = new Zend_Session_Namespace($this->fingerprint . '@' . $ns);
 	    return isset($session->{$name}) ? $session->{$name} : $default;
 	}
 	
 	/**
 	 * Pregunta si existe un atributo en la sesion
 	 * @param string $name
 	 * @param string $ns Namespace
 	 * @return bool
 	 */
 	public function hasAttribute($name, $ns = 'common')
 	{
 	    $session = new Zend_Session_Namespace($this->fingerprint . '@' . $ns);
 	    return isset($session->{$name});
 	}
 	
 	/**
 	 * Elimina un atributo de la sesion del usuario
 	 * @param string $name
 	 * @param string $ns
 	 */
 	public function removeAttribute($name, $ns = 'common')
 	{
 	    $session = new Zend_Session_Namespace($this->fingerprint . '@' . $ns);
 	    unset($session->{$name});
 	}
 	
 	/**
 	 * Agrega una variable en sesion que se destruye al ser recuperada
 	 * @param string $name
 	 * @param mixed $value
 	 */
 	public function setFlash($name, $value)
 	{
 	    $this->setAttribute($name, $value, 'flash');
 	}
 	
 	/**
 	 * Obtiene un variable flash y la destruye inmediatamente
 	 * @param string $name
 	 * @param mixed $default
 	 * @return mixed
 	 */
 	public function getFlash($name, $default = null)
 	{
 	    $flash = $this->getAttribute($name, $default, 'flash');
 	    $this->removeAttribute($name, 'flash');
 	    return $flash;
 	}
 	
 	/**
 	 * proxy Obtiene el IdUser
 	 * @return int
 	 */
 	public function getIdUser()
 	{
 	    return $this->getBean()->getIdUser();
 	}
 	
 	/**
 	 * proxy Obtiene el idPerson
 	 * @return int
 	 */
 	public function getIdPerson()
 	{
 	    return $this->getBean()->getIdPerson();
 	}
 	
 	/**
 	 * proxy Obtiene el username
 	 * @return string
 	 */
 	public function getUsername()
 	{
 	    return $this->getBean()->getUsername();
 	}
 	
 	/**
 	 * Retorna el Bean del Usuario
 	 * @return User
 	 */
 	public function getBean()
 	{
 	    require_once 'application/models/beans/User.php';
 	    return $this->getAttribute('user', null, 'bean');
 	}
        /**
 	 * Retorna el Bean del Usuario
 	 * @return Employee
 	 */
 	public function getBeanEmployee()
 	{
 	    
 	    return $this->getAttribute('employee', null, 'bean');
 	}

 	
 	/**
 	 * Asignar el Bean para el usuario que esta en session
 	 * @param User $user
 	 */
 	public function setBean(User $user)
 	{
 	    $this->setAttribute('user', $user, 'bean');
 	}

        /**
 	 * Asignar el Bean para el usuario que esta en session
 	 * @param Employee $employee
 	 */
 	public function setBeanEmployee(Employee $employee)
 	{
 	    $this->setAttribute('employee', $employee, 'bean');
 	}
 	
 	/**
 	 * Asigna el Bean de AccessRole en la sesión
 	 * @param AccessRole $accessRole
 	 */
 	public function setAccessRole(AccessRole $accessRole)
 	{
 		$this->setAttribute('accessrole',$accessRole,'accessrole');
 	}
 	
    /**
     * Retorna el Grupo de Usuario al que pertenece el Usuario
     * @return AccessRole
     */
    public function getAccessRole()
    {
        require_once 'application/models/beans/AccessRole.php';
        return $this->getAttribute('accessrole', null, 'accessrole');
    }
 	
 	/**
 	 * Destruye la sesion del usuario
 	 */
 	public function shutdown()
 	{
 	    require_once 'Zend/Session.php';
 	    Zend_Session::start();
 	    Zend_Session::destroy();
 	}
 	
 }