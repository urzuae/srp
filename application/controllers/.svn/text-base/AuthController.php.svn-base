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

/**
 * UserLogCatalog
 */
require_once 'application/models/catalogs/UserLogCatalog.php';

/**
 * EmployeeCatalog
 */
require_once 'application/models/catalogs/EmployeeCatalog.php';

/**
 * BaseController
 */
require_once 'lib/controller/BaseController.php';

/**
 * AccessRoleCatalog
 */
require_once 'application/models/catalogs/AccessRoleCatalog.php';

/**
 * Clase AuthController que representa el controlador para las acciones de login/logout
 *
 * @category   project
 * @package    Project_Controllers
 * @copyright  ##$COPYRIGHT$##
 */
class AuthController extends BaseController
{

    /**
     * Sobrecargamos el metodo init
     */
    public function init()
    {
        $registry = Zend_Registry::getInstance();
        $this->view->moduleName = $this->getRequest()->getModuleName();
        $this->view->controllerName = $this->getRequest()->getControllerName();
        $this->view->actionName = $this->getRequest()->getActionName();
        $this->view->baseUrl = $this->getRequest()->getBaseUrl();
        $this->view->systemTitle = utf8_decode($registry->config->appSettings->titulo);
        $this->view->l10n = new Zend_Translate('gettext', 'data/locale/base.mo', 'es');
    }
    
    /**
     * 
     */
    public function configAction()
    {
    	require_once 'application/models/catalogs/SecurityActionCatalog.php';
    	require_once 'application/models/catalogs/SecurityControllerCatalog.php';
        parent::init();
        $this->setTitle('Configuración de Facultades');
        $this->view->accessRoles = AccessRoleCatalog::getInstance()->getActives(new Criteria());
        $this->view->actions = SecurityActionCatalog::getInstance()->getByCriteria(new Criteria());
        $this->view->controllers = SecurityControllerCatalog::getInstance()->getByCriteria(new Criteria());
        $this->view->permissions = AccessRoleCatalog::getInstance()->getAllPermissions();
    }
    
    /**
     * Agrega/Elimina un permiso en la base de datos de facultades
     */
    public function setPermissionAction()
    {
        require_once 'lib/security/SecurityInspector.php';
        parent::init();
        $securityInspector = new SecurityInspector();
        $securityInspector->setPermission($this->getRequest()->getParam('value'),$this->getRequest()->getParam('idAction'),$this->getRequest()->getParam('idAccessRole'));
        die($this->getRequest()->getParam('value'));
    }
    
    /**
     * Inspecciona Todos los controllers y las actions, las agrega a la base de datos, y eso
     */
    public function inspectAction()
    {
    	require_once 'lib/security/SecurityInspector.php';
    	parent::init();
    	$securityInspector = new SecurityInspector();
    	$securityInspector->analizeWorkspace();
    	$this->setFlash('ok','Workspace analizado');
    	$this->_redirect('auth/config');
    }
    
    /**
     * Accion para la pantalla de Login
     */
    public function viewLoginAction()
    {
        $this->view->contentTitle = 'Iniciar Sesión';
        $this->view->setTpl('Login');
    }

    /*
     * Inicio de Sesión
     */
    public function loginAction()
    {
        $username = $this->getRequest()->getParam('username');
        $password = $this->getRequest()->getParam('password');
        try
        {
            if($username == null || $password == null)
                throw new AuthException('Debe especificar Usuario y contraseña');
           $user = Authentication::authenticate($username, $password);
           $this->getUser()->setBean($user);
           if($user->getIdAccessRole()==2 || $user->getIdAccessRole()==3){
                   $employee= EmployeeCatalog::getInstance()->getByIdUser($user->getIdUser())->getOne();
                   $this->getUser()->setBeanEmployee($employee);
                   //die(var_dump($employee));
           }
           $this->getUser()->setAccessRole(AccessRoleCatalog::getInstance()->getById($user->getIdAccessRole()));
           $this->_redirect('/');
        }
        catch(AuthException $e)
        {
            $this->view->errorMessage = $e->getMessage();
            $this->view->contentTitle = 'Iniciar Sesión';
        }
    }

    /**
     * Accion que hace logout.
     */
    public function logoutAction()
    {
    	$this->getUser()->shutdown();
    	$this->_redirect('/');
    }
    
    /**
     * Acción para autorizar descuentos
     * @return unknown_type
     */
    public function autorizedAction()
    {
    	$username = $this->getRequest()->getParam('username');
        $password = $this->getRequest()->getParam('password');
        try
        {
           if($username == null || $password == null)
                throw new AuthException('Debe especificar Usuario y contraseña');
           $user = Authentication::authenticateAs($username, $password, AccessRole::$AccessRoles['Gerente']); 
           $this->getUser()->setAttribute('discounts', true, 'authorized');
        }
        catch(AuthException $e)
        {
            throw new Exception($e->getMessage());
        }
        $this->view->setLayoutFile(false);
        
        die();
    }
}
