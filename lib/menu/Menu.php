<?php
/**
 * ##$BRAND_NAME$##
 *
 * ##$DESCRIPTION$##
 *
 * @category   Project
 * @package    Project_Menus
 * @copyright  ##$COPYRIGHT$##
 * @author     ##$AUTHOR$##, $LastChangedBy$
 * @version    ##$VERSION$##, SVN:  $Id$
 */

/**
 * User
 */
require_once 'application/models/catalogs/MenuItemCatalog.php';
require_once 'application/models/catalogs/SecurityActionCatalog.php';
require_once 'application/models/catalogs/SecurityControllerCatalog.php';
require_once 'lib/menu/AbstractMenuRenderer.php';
require_once 'lib/menu/MainMenuRenderer.php';

/**
 * Clase para generar los menus del sistema
 *
 * @category   project
 * @package    Project_Menus
 * @copyright  ##$COPYRIGHT$##
 */
class Menu
{

  /**
   * Arreglo donde se guarda el menu una vez generado
   * @var array
   */
  private $userMenu = null;

  /**
   * Arreglo donde se guarda el menu una vez generado
   * @var array
   */
  private $fullMenu = null;
  
  /**
   * Instancia singleton
   * @var Menu
   */
  private static $instance = null;
  
  /**
   * ACL
   * @var Zend_Acl
   */
  private $acl = null;
  
  /**
   * Role
   * @var string|int
   */
  private $role = null;
  
  /**
   * Zend Cache
   * @var zend_Cache
   */
  private $cache = null;
  
  /**
   * Constructor de la clase
   * @return Menu
   */
  private function Menu()
  {
  }

  /**
   * Obtiene la instancia de la clase
   * @return Menu
   */
  public static function getInstance()
  {
    if(!isset(self::$instance))
      self::$instance = new Menu();
    return self::$instance;
  }

  /**
   * Genera el menu
   */
  public function build()
  {
  	if(is_null($this->role))
      throw new Exception('Necesita especificar un rol de usuario');
      
  	$frontend = array('lifetime' => '86400', 'automatic_serialization' => true);
    $backend = array('cache_dir' => './cache/menu/');
    $this->cache = Zend_Cache::factory('core','File', $frontend, $backend);
  	
    $this->fullMenu = $this->cache->load('menu');
    $this->userMenu = $this->cache->load('menu_'.$this->role);
    if(!$this->fullMenu)
    {
	  	$start = array(array(
	      'order' => -100,
	  	  'idMenuItem' => 0,
	      'label' => 'Home',
	      'controller' => 'index',
	  	  'action' => 'index',
	  	  'resource' => 'index/index'
	    ));
	    $this->fullMenu = $this->getMenuItemsByIdParent(null,$start);
	    $this->cache->save($this->fullMenu,'menu');
    }
    if(!$this->userMenu)
    {
      $this->userMenu = $this->checkPermissions($this->fullMenu);
      $this->cache->save($this->userMenu,'menu_'.$this->role);
    }
    
  }

  /**
   * Render the menu
   * @param array $menu 
   */
  public function render($menu, AbstractMenuRenderer $renderer = null)
  {
    if(is_null($renderer)) $renderer = new MainMenuRenderer();
    return $renderer->render($menu);
  }
  
  
  /**
   * Checa los permisos del usuario para cada item del menu
   * @param array $map
   */
  private function checkPermissions($map)
  {
    $userMap = array();
    foreach ($map as $id =>  $item)
    {
      foreach ($item as $key => $value)
      {
         if($key === 'pages')
          $userMap[$id][$key] = $this->checkPermissions($value);
         else
          $userMap[$id][$key] = $value;
      }
      if(count($userMap[$id]['pages']) === 0 && !isset($userMap[$id]['resource']) )
      {
        unset($userMap[$id]);
      }elseif ( isset($userMap[$id]['resource']) &&  !$this->acl->isAllowed($this->role,$userMap[$id]['resource']) )
      {
        unset($userMap[$id]);
      }
    }
    return $userMap;
  }
  
  /**
   * Obtiene los items 
   * @param int $idParent
   * @param Array $prepend (Un arreglo para agregar antes del resultado )
   * @return Array
   */
  private function getMenuItemsByIdParent($idParent, $prepend = array())
  {
    $return = $prepend;
    $criteria = new Criteria();
    $criteria->addDescendingOrderByColumn(MenuItem::NAME);
    $items = MenuItemCatalog::getInstance()->getByIdParent($idParent,$criteria);
    while($items->valid())
    {
      $item = $items->read();
      $controller = $this->getControllerURI($item->getIdAction());
      $action = $this->getActionURI($item->getIdAction());
      $tmp = array(
        'order'       => $item->getOrder(),
        'label'       => $item->getName(),
        'controller'  => $controller,
        'action'      => $action,
        'idMenuItem'  => $item->getIdMenuItem(),
        'pages'       => $this->getMenuItemsByIdParent($item->getIdMenuItem())
      );
      if($action && $controller)
        $tmp['resource'] = $controller . '/' . $action;
      $return[] = $tmp;
    }
    return $return;
  }

  /**
   * Obtiene el nombre de la action
   * @param int $idAction
   * @param string 
   */
  private function getControllerURI($idAction)
  {
    if(is_null($idAction))
      return '';
    
    $action = SecurityActionCatalog::getInstance()->getById($idAction);
    $controller = SecurityControllerCatalog::getInstance()->getById($action->getIdController());
    return $controller->getName();
  }

  /**
   * Obtiene el nombre de la action
   * @param int $idAction
   * @param string 
   */
  private function getActionURI($idAction)
  {
    if(is_null($idAction))
      return '';
    
    $action = SecurityActionCatalog::getInstance()->getById($idAction);
    return $action->getName();
  }

  /**
   * Enter description here...
   *
   */
  public function setAcl(Zend_Acl $acl)
  {
  	$this->acl = $acl;
  }

  /**
   * Role
   * @param string|int
   */
  public function setRole($role)
  {
  	$this->role = $role;
  }
  
  /**
   * @return array
   */
  public function getFullMenu()
  {
    return $this->fullMenu;
  }
  
  /**
   * @return array
   */
  public function getUserMenu()
  {
    return $this->userMenu;
  }
  

}
