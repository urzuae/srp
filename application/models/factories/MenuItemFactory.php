<?php
/**
 * Bender Modeler
 *
 * Our Simple Models
 *
 * @category   lib
 * @package    lib_models
 * @copyright  Copyright (c) 2008-2010 Bender Modeler (http://www.ctrl-zetta.com/#code)
 * @author     <zetta> <chentepixtol>, $LastChangedBy$
 * @version    1.0.0 SVN: $Id$
 */
/**
 * Dependences
 */
require_once "application/models/beans/MenuItem.php";

/**
 * Clase MenuItemFactory
 *
 * @category   lib
 * @package    lib_models
 * @subpackage lib_models_factories
 * @copyright  Copyright (c) 2008-2010 Bender Modeler (http://www.ctrl-zetta.com/#code) 
 * @copyright  This File as been proudly generated by Bender (http://code.google.com/p/bender-modeler/). <chentepixtol> <zetta>
 * @author     <zetta> & <chentepixtol>
 * @version    1.0.0 SVN: $Revision$
 */
class MenuItemFactory
{

   /**
    * Create a new MenuItem instance
    * @param int $idAction
    * @param int $idParent
    * @param string $name
    * @param int $order
    * @return MenuItem
    */
   public static function create($idAction, $idParent, $name, $order)
   {
      $newMenuItem = new MenuItem();
      $newMenuItem->setIdAction($idAction);
      $newMenuItem->setIdParent($idParent);
      $newMenuItem->setName($name);
      $newMenuItem->setOrder($order);
      return $newMenuItem;
   }
   
    /**
     * Método que construye un objeto MenuItem y lo rellena con la información del rowset
     * @param array $fields El arreglo que devolvió el objeto Zend_Db despues del fetch
     * @return MenuItem 
     */
    public static function createFromArray($fields)
    {
        $newMenuItem = new MenuItem();
        $newMenuItem->setIdMenuItem($fields['id_menu_item']);
        $newMenuItem->setIdAction($fields['id_action']);
        $newMenuItem->setIdParent($fields['id_parent']);
        $newMenuItem->setName($fields['name']);
        $newMenuItem->setOrder($fields['order']);
        return $newMenuItem;
    }
   
}
