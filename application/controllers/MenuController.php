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
require_once 'lib/controller/BaseController.php';
require_once 'application/models/catalogs/MenuItemCatalog.php';

/**
 * Clase AuthController que representa el controlador para las acciones de login/logout
 *
 * @category   project
 * @package    Project_Controllers
 * @copyright  ##$COPYRIGHT$##
 */
class MenuController extends BaseController
{
	
	/**
	 * 
	 */
    public function init()
    {
        $frontend = array('lifetime' => '86400', 'automatic_serialization' => true);
        $backend = array('cache_dir' => './cache/menu/');
        $cache = Zend_Cache::factory('core','File', $frontend, $backend);
        $cache->clean(Zend_Cache::CLEANING_MODE_ALL);
        parent::init();
   }

	/**
	 * Administra el menï¿½
	 */
	public function manageAction()
	{
		require_once 'lib/menu/ManagerMenuRenderer.php';
        $this->setTitle('Configuración de Facultades');
        $this->view->actions = SecurityActionCatalog::getInstance()->getByCriteria(new Criteria());
        $controllerCriteria = new Criteria();
        $controllerCriteria->addAscendingOrderByColumn(SecurityController::NAME);
        $this->view->controllers = SecurityControllerCatalog::getInstance()->getByCriteria($controllerCriteria);
        $menu = Menu::getInstance();
        $this->view->menuItems = $menu->render($menu->getFullMenu(), new ManagerMenuRenderer() );
	}
	
	/**
	 * Agrega un item al menu
	 */
	public function addEntryAction()
	{
		require_once 'Zend/Json.php';
		$idParent = $this->getRequest()->getParam('idParent');
		$idAction = $this->getRequest()->getParam('idAction');
		$name = $this->getRequest()->getParam('name');
		$order = $this->getRequest()->getParam('order',0);
		$menuItem = MenuItemFactory::create($idAction, $idParent == 0 ? null: $idParent , utf8_decode($name), $order);
		MenuItemCatalog::getInstance()->create($menuItem);
		die(Zend_Json::encode(array('code' => 200, 'id' => $menuItem->getIdMenuItem())));
	}
	
	/**
	 * Elimina una opcion del menu, al igual que sus dependencias
	 */
	public function removeEntryAction()
	{
		require_once 'Zend/Json.php';
		$id = $this->getRequest()->getParam('id');
		MenuItemCatalog::getInstance()->deleteRecursiveById($id);
		if($this->getRequest()->isXmlHttpRequest())
		  die(Zend_Json::encode(array('code' => 200)));
		else
		  $this->_redirect('menu/manage');
	}
	
}
