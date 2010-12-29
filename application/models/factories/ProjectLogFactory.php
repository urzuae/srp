<?php
/**
 * SRP
 *
 * SRP INELECTRA
 *
 * @category   lib
 * @package    lib_models
 * @copyright  Copyright (c) 2010 PCSMEXICO
 * @author     <arturo>, $LastChangedBy$
 * @version    1.0.2 SVN: $Id$
 */
/**
 * Dependences
 */
require_once "application/models/beans/ProjectLog.php";

/**
 * Clase ProjectLogFactory
 *
 * @category   lib
 * @package    lib_models
 * @subpackage lib_models_factories
 * @copyright  Copyright (c) 2010 PCSMEXICO 
 * @copyright  This File has been proudly generated by Bender (http://code.google.com/p/bender-modeler/). <chentepixtol> <zetta>
 * @author     <zetta> & <chentepixtol>
 * @version    1.0.2 SVN: $Revision$
 */
class ProjectLogFactory
{

   /**
    * Create a new ProjectLog instance
    * @param int $idProject
    * @param string $timestamp
    * @return ProjectLog
    */
   public static function create($idProject, $timestamp)
   {
      throw new Exception('Factory Deprecated');
      $newProjectLog = new ProjectLog();
      $newProjectLog
          ->setIdProject($idProject)
          ->setTimestamp($timestamp)
      ;
      return $newProjectLog;
   }
   
    /**
     * Método que construye un objeto ProjectLog y lo rellena con la información del rowset
     * @param array $fields El arreglo que devolvió el objeto Zend_Db despues del fetch
     * @return ProjectLog 
     */
    public static function createFromArray($fields)
    {
        $newProjectLog = new ProjectLog();
        $newProjectLog->setIdProjectLog($fields['id_project_log']);
        $newProjectLog->setIdProject($fields['id_project']);
        $newProjectLog->setTimestamp($fields['timestamp']);
        return $newProjectLog;
    }
   
}
