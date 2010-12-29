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
class ManagerMenuRenderer extends AbstractMenuRenderer
{
  
  /**
   * Render the menu
   */
  public function render($menu)
  {
    $this->document->appendChild($this->htmlify($menu, 'menuPreview', 'no-style'));
    return $this->document->saveHTML();
  }
  
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
      $id = $item['idMenuItem'];
      if(isset($item['pages']) && $item['pages'])
        $li->appendChild( $this->htmlify($item['pages'],'childs_'.$id) );
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
    $id = $item ['idMenuItem'];
    $li = $this->document->createElement('li');
    $radio = $this->createRadio('parentRadio', 'rd_' . $id, $id);
    $li->appendChild($radio);
    
    $a = $this->createAnchor($this->baseUrl . '/menu/remove-entry/id/' . $id, 'rm_' . $id, 'ajaxedLink');
    $img = $this->createImage($this->baseUrl . '/images/template/icons/cross.png', 'delete');
    
    $a->appendChild($img);
    $li->appendChild($a);
    
    $resource = $item['resource'] ? ' ('. $item['resource'] .')' : '';
    $txt = $this->document->createTextNode( utf8_encode($item['label']) . $resource  );
    
    $li->appendChild($txt);
    return $li;
  }
  
  /**
   * Create Radio Element
   * @param string $radioName
   * @param string $radioId
   * @param string|int $radioValue
   * @return DomElement 
   */
  private function createRadio($radioName, $radioId = '', $radioValue = '')
  {
    $radio = $this->document->createElement('input');
    $type = new DOMAttr('type', 'radio');
    $name = new DOMAttr('name', $radioName);
    $id = new DOMAttr('id', $radioId);
    $value = new DOMAttr('value', $radioValue);
    
    $radio->setAttributeNode($id);
    $radio->setAttributeNode($value);
    $radio->setAttributeNode($name);
    $radio->setAttributeNode($type);
    return $radio;
  }
  
  /**
   * Create Anchor Element
   * @param string $href
   * @param string $id
   * @param string $class
   * @return DomElement
   */
  private function createAnchor($href, $id = '', $class = '')
  {
    $a = $this->document->createElement('a');
    $hrefAttr = new DOMAttr('href', $href);
    $idAttr = new DOMAttr('id', $id);
    $classAttr = new DOMAttr('class', $class);
    $a->setAttributeNode($hrefAttr);
    $a->setAttributeNode($idAttr);
    $a->setAttributeNode($classAttr);
    return $a;
  }
  
  /**
   * Enter description here...
   *
   * @param strin $src
   * @param string $alt
   * @return DomElement
   */
  private function createImage($src, $alt = '')
  {
    $img = $this->document->createElement('img');
    $srcAttr = new DOMAttr('src', $src);
    $altAttr = new DOMAttr('alt', $alt);
    $img->setAttributeNode($altAttr);
    $img->setAttributeNode($srcAttr);
    return $img;
  }

}
