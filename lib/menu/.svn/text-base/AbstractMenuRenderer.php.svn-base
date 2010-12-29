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
 * Clase para generar los menus del sistema
 *
 * @category   project
 * @package    Project_Menus
 * @copyright  ##$COPYRIGHT$##
 */
abstract class AbstractMenuRenderer
{
  
  /**
   * Constructor
   * @return AbstractMenuRenderer
   */
  public function AbstractMenuRenderer()
  {
    $this->document = new DOMDocument(); 
    $this->baseUrl = Zend_Controller_Front::getInstance()->getBaseUrl();
  }
  
  /**
   * BaseUrl
   * @var string
   */
  protected $baseUrl = '';
  
  /**
   * Menu
   * @var array
   */
  protected $menu = array();
  
  /**
   * Ul Id
   * @var string
   */
  protected $ulId = 'nav';
  
  /**
   * Document
   * @var DOMDocument
   */
  protected $document = null;
  
  /**
   * Ul Class
   * @var string
   */
  protected $ulClass = 'navigation';
  
  /**
   * Render the menu
   */
  abstract public function render($menu);
  
  
  /**
   * MenuArray -> HTML
   * @param array
   * @param string $id
   * @param string $class
   * @return DomElement
   */
  protected function htmlify($menu, $id = '', $class = '')
  {
    $ul = $this->document->createElement('ul');
    if($class)
    {
      $classAttr = new DOMAttr('class',$class);
      $ul->setAttributeNode($classAttr);
    }
    if($id)
    {
      $idAttr = new DOMAttr('id',$id);
      $ul->setAttributeNode($idAttr);  
    }
    
    
    foreach ($menu as $item)
    {
      $li = $this->addLiElement($item);
      if(isset($item['pages']) && $item['pages'])
        $li->appendChild( $this->htmlify($item['pages']) );
      $ul->appendChild($li);
    }
    return $ul;
  }
  
  /**
   * Add li Element
   * @param array $item
   * @return DomElement
   */
  protected function addLiElement($item)
  {
      $li = $this->document->createElement('li');
      $a =  $this->document->createElement('a',utf8_encode($item['label']));
      if($item['controller'] && $item['action'])
      {
        $href = new DOMAttr('href', implode('/',array(Zend_Controller_Front::getInstance()->getBaseUrl(), $item['controller'],$item['action'])));
        $a->setAttributeNode($href);
      }
      $li->appendChild($a);
      return $li;
  }
  
  /**
   * @return string
   */
  public function getUlClass()
  {
    return $this->ulClass;
  }
  
  /**
   * @return string
   */
  public function getUlId()
  {
    return $this->ulId;
  }
  
  /**
   * @param string $ulClass
   */
  public function setUlClass($ulClass)
  {
    $this->ulClass = $ulClass;
  }
  
  /**
   * @param string $ulId
   */
  public function setUlId($ulId)
  {
    $this->ulId = $ulId;
  }

  
}
