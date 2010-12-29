<?php
/**
 * ##$BRAND_NAME$##
 *
 * ##$DESCRIPTION$##
 *
 * @category   Project
 * @package    Project_Views
 * @subpackage Project_Views_Smarty
 * @copyright  ##$COPYRIGHT$##
 * @author     ##$AUTHOR$##, $LastChangedBy$
 * @version    ##$VERSION$##, SVN:  $Id$
 */

require_once "Zend/View/Abstract.php";
require_once "lib/smarty/ProjectSmarty.php";
/**
 * Clase que liga Smarty con la vista del ZendFramework
 *
 * @category   project
 * @package    Project_Views
 * @subpackage Project_Views_Smarty
 * @copyright  ##$COPYRIGHT$##
 */
class ZendSmarty extends Zend_View_Abstract
{

	/**
	 * Instancia
	 * @var ZendSmarty
	 */
	private static $instance = null;
	
	/**
	 * Si se salta lo demas
	 */
	const RENDER_NOW = null;
	
    /**
   * @var ProjectSmarty
   */
  private $smarty = null;
  
  /**
   *
   * @var string
   */
  private $layoutFile = 'layout/Layout.tpl';
  
  /**
   * @var string
   */
  private $controller = '';
  
  /**
   * @var string
   */
  private $action = '';
  
  /**
   * Obtiene la instancia
   *
   * @param array [OPTIONAL] $data
   * @return ZendSmarty
   */
  public function getInstance($data = array())
  {
  	if(!isset(self::$instance))
  	   self::$instance = new ZendSmarty($data);
  	return self::$instance;
  }
  
  /**
   * Class Constructor
   *
   * @param array [OPTIONAL] $data
   * @return ZendSmarty
   */
  private function ZendSmarty($data = array())
  {
      parent::__construct($data);
      $registry = Zend_Registry::getInstance();
      $templateDir = $registry->config->smarty->templateDirectory;
      $compileDir = $registry->config->smarty->compileDirectory;
      $configDir = $registry->config->smarty->configDirectory;
      $cacheDir = $registry->config->smarty->cacheDirectory;
      $this->smarty = new ProjectSmarty($templateDir, $compileDir, $configDir, $cacheDir, false);
  }
  
  public function __set($spec, $value)
  {
      $this->assign($spec, $value);
  }
  
  public function assign($spec, $value = null)
  {
      if ($value === null) $this->smarty->assign($spec);
      else $this->smarty->assign($spec, $value);
  }
  
  public function _script($name)
  {
      die($name);
  }
  
  protected function _run()
  {
  }
  
  public function render($name)
  {
      $filePath = explode('/', $name);
      $controller = ($this->controller) ? $this->controller : strtolower($filePath[0]);
      $action = ($this->action) ? $this->action : ucfirst($filePath[1]);
      if($this->layoutFile)
      	$this->smarty->displayInMasterPage($controller . '/' . $action, $this->layoutFile);
     	else
     		$this->smarty->display($controller . '/' . $action);
     		
  }
  
  /**
   * @param string $tplName
   * @return ZendSmarty
   */
  public function setTpl($tplName)
  {
      $this->action = $tplName . '.tpl';
      return $this;
  }
  
  /**
   * @return ProjectSmarty
   */
  public function getEngine()
  {
      return $this->smarty;
  }
  
  /**
   * @return string
   */
  public function getLayoutFile()
  {
      return $this->layoutFile;
  }
  
  /**
   * @param string|boolean $layoutFile
   * @return ZendSmarty
   */
  public function setLayoutFile($layoutFile)
  {
      $this->layoutFile = $layoutFile;
      return $this;
  }

    

}



