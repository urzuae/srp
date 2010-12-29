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
require_once "application/models/beans/SpecificProjectTask.php";

/**
 * Clase SpecificProjectTaskFactory
 *
 * @category   lib
 * @package    lib_models
 * @subpackage lib_models_factories
 * @copyright  Copyright (c) 2010 PCSMEXICO 
 * @copyright  This File has been proudly generated by Bender (http://code.google.com/p/bender-modeler/). <chentepixtol> <zetta>
 * @author     <zetta> & <chentepixtol>
 * @version    1.0.2 SVN: $Revision$
 */
class SpecificProjectTaskFactory
{

   /**
    * Create a new SpecificProjectTask instance
    * @param int $workAuthorizationStatus
    * @param string $taskCode
    * @param string $description
    * @param int $type
    * @param int $status
    * @return SpecificProjectTask
    */
   public static function create($workAuthorizationStatus, $taskCode, $description, $type, $status)
   {
      //throw new Exception('Factory Deprecated');
      $newSpecificProjectTask = new SpecificProjectTask();
      $newSpecificProjectTask
          ->setWorkAuthorizationStatus($workAuthorizationStatus)
          ->setTaskCode($taskCode)
          ->setDescription($description)
          ->setType($type)
          ->setStatus($status)
      ;
      return $newSpecificProjectTask;
   }
   
    /**
     * Método que construye un objeto SpecificProjectTask y lo rellena con la información del rowset
     * @param array $fields El arreglo que devolvió el objeto Zend_Db despues del fetch
     * @return SpecificProjectTask 
     */
    public static function createFromArray($fields)
    {
        $newSpecificProjectTask = new SpecificProjectTask();
        $newSpecificProjectTask->setIdSpecificProjectTask($fields['id_specific_project_task']);
        $newSpecificProjectTask->setIdProjectTask($fields['id_project_task']);
        $newSpecificProjectTask->setWorkAuthorizationStatus($fields['work_authorization_status']);
        $newSpecificProjectTask->setTaskCode($fields['task_code']);
        $newSpecificProjectTask->setDescription($fields['description']);
        $newSpecificProjectTask->setType($fields['type']);
        $newSpecificProjectTask->setStatus($fields['status']);
        return $newSpecificProjectTask;
    }
   
}
