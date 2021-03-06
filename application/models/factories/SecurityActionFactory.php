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
require_once "application/models/beans/SecurityAction.php";

/**
 * Clase SecurityActionFactory
 *
 * @category   lib
 * @package    lib_models
 * @subpackage lib_models_factories
 * @copyright  Copyright (c) 2008-2010 Bender Modeler (http://www.ctrl-zetta.com/#code) 
 * @copyright  This File as been proudly generated by Bender (http://code.google.com/p/bender-modeler/). <chentepixtol> <zetta>
 * @author     <zetta> & <chentepixtol>
 * @version    1.0.0 SVN: $Revision$
 */
class SecurityActionFactory
{

   /**
    * Create a new SecurityAction instance
    * @param int $idController
    * @param string $name
    * @return SecurityAction
    */
   public static function create($idController, $name)
   {
      $newSecurityAction = new SecurityAction();
      $newSecurityAction->setIdController($idController);
      $newSecurityAction->setName($name);
      return $newSecurityAction;
   }
   
    /**
     * Método que construye un objeto SecurityAction y lo rellena con la información del rowset
     * @param array $fields El arreglo que devolvió el objeto Zend_Db despues del fetch
     * @return SecurityAction 
     */
    public static function createFromArray($fields)
    {
        $newSecurityAction = new SecurityAction();
        $newSecurityAction->setIdAction($fields['id_action']);
        $newSecurityAction->setIdController($fields['id_controller']);
        $newSecurityAction->setName($fields['name']);
        return $newSecurityAction;
    }
   
}
