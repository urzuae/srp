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
 * Dependencias
 */
require_once 'application/models/catalogs/AccessRoleCatalog.php';
require_once 'lib/security/Authentication.php';
require_once 'lib/security/AuthException.php';
require_once 'lib/security/ManagerAcl.php';
require_once 'lib/menu/Menu.php';
require_once 'Zend/Translate.php';                
require_once 'Zend/Controller/Action.php';
require_once 'Zend/Date.php';

/**
 * Clase abstracta de la que extenderan nuestros controladores, para agrupar instrucciones comunes
 *
 * @category   project
 * @package    Project_Controllers
 * @copyright  ##$COPYRIGHT$##
 */
abstract class BaseController extends Zend_Controller_Action
{

    /**
     * Menu
     * @var Menu $menu
     */
    public $menu;

    /**
     * ZendSmarty
     * @var ZendSmarty
     */
    public $view;
    
    /**
     * Locale
     * 
     * @var Zend_Locale $locale
     */
    public $locale;

    /**
     * Zend_Registry
     *
     * @var Zend_Registry
     */
    protected $registry = null;

     /**
     * l10n
     * @var Zend_Translate $locale
     */
    public $l10n;
    
    /**
     * Class constructor
     *
     *
     * @param Zend_Controller_Request_Abstract $request
     * @param Zend_Controller_Response_Abstract $response
     * @param array $invokeArgs Any additional invocation arguments
     * @return void
     */
    public function BaseController(Zend_Controller_Request_Abstract $request, Zend_Controller_Response_Abstract $response, array $invokeArgs = array())
    {
    	if($request->isXmlHttpRequest())
    	{
    		$response->setHeader('content-type','application/x-www-form-urlencoded; charset=iso-8859-1',true);
    	}
    	parent::__construct($request, $response, $invokeArgs);
    }
    
    /**
     * Funcion Init que inicializa los valores similares para todos las acciones del controlador
     */
    public function init()
    {
        if($this->getUser()->getBean() == null)
          $this->_redirect('auth/view-login');
          
        $managerAcl = ManagerAcl::getInstance();
        #if (!$managerAcl->getAcl()->isAllowed($this->getUser()->getAccessRole()->getIdAccessRole(), $this->getRequest()->getControllerName().'/'.$this->getRequest()->getActionName()) )
        #    throw new AuthException('Acceso Restringido');

    	$this->l10n = new Zend_Translate('gettext', 'data/locale/base.mo', 'es');
        $this->view->l10n = $this->l10n;
        
        $this->locale = $this->getRegistry()->get('Zend_Locale');
        
        $menu = Menu::getInstance();
        $menu->setAcl($managerAcl->getAcl());
        $menu->setRole($this->getUser()->getAccessRole()->getIdAccessRole());
        $menu->build();
        $this->view->menu = $menu->render($menu->getUserMenu());
        
        $this->toView();
    }
    
    /**
     * Variable globales a smarty
     */
    private function toView()
    {
    	$this->view->systemUser = $this->getUser()->getBean();
        $this->view->systemAccessRole = $this->getUser()->getAccessRole();
    	
        // Si se envian parametros que los pase a la vista
        if($this->getRequest()->isPost())
            $this->view->post = $this->getRequest()->getParams();
            
        $this->view->controller = $this->getRequest()->getControllerName();
        $this->view->action = $this->getRequest()->getActionName();
        $this->view->baseUrl = $this->getRequest()->getBaseUrl();
        $this->view->ok = $this->getFlash('ok');
        $this->view->error = $this->getFlash('error');
        $this->view->notice = $this->getFlash('notice');
        $this->view->warning = $this->getFlash('warning');
        $this->view->note = $this->getFlash('note');
        
        $this->view->contentTitle = $this->getRegistry()->config->appSettings->titulo; 
        $this->view->systemTitle =  $this->getRegistry()->config->appSettings->titulo;
    }

    /**
     * Guarda una variable "flash", una variable que al ser utilizada es destruida
     * @param string $varName
     * @param int|string $value
     */
    protected function setFlash($varName, $value)
    {
        $this->getUser()->setFlash($varName, $value);
    }

    /**
     * Obtiene una variable "flash" y al ser leida esta se destruye
     * @param string $varName
     * @return int|string $value
     */
    protected function getFlash($varName, $default = null)
    {
    	return $this->getUser()->getFlash($varName, $default);
    }
    
    /**
     * Pone el titulo de la pagina
     * @param string $title
     */
    protected function setTitle($title)
    {
    	$this->view->contentTitle = $this->l10n->_($title);
    }
    
    /**
     * Obtiene la sesion del usuario
     * @return UserSession
     */
    public function getUser()
    {
    	require_once 'lib/security/UserSession.php';
    	return UserSession::getInstance();
    }
    
    /**
     * Obtiene la Lista de control de accesso
     * @return Zend_Acl
     */
    public function getAcl()
    {
    	return ManagerAcl::getInstance()->getAcl();
    }
    
    /**
     * No render
     */
    protected function noRender()
    {
    	$this->getHelper('viewRenderer')->setNoRender();
    }
    
    /**
     * Obtiene el registry
     * @return Zend_Registry
     */
    protected function getRegistry()
    {
    	if(null == $this->registry)
    	   $this->registry = Zend_Registry::getInstance();
    	return $this->registry;
    }
}














