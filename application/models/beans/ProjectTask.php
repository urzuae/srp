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
 * Clase ProjectTask
 *
 * @category   lib
 * @package    lib_models
 * @subpackage lib_models_beans
 * @copyright  Copyright (c) 2010 PCSMEXICO 
 * @copyright  This File has been proudly generated by Bender (http://code.google.com/p/bender-modeler/). <chentepixtol> <zetta>
 * @author     <zetta> & <chentepixtol>
 * @version    1.0.2 SVN: $Revision$
 */
class ProjectTask
{
    /**
     * Constante que contiene el nombre de la tabla 
     * @static TABLENAME
     */
    const TABLENAME = "pcs_srp_core_projects_tasks";
    const TABLENAME_PROJECT_TASK_PROJECT = 'pcs_srp_core_projects_projects_tasks';

    /**
     * Constantes para los nombres de los campos
     */
    const ID_PROJECT_TASK = "pcs_srp_core_projects_tasks.id_project_task";
    const TASK_CODE = "pcs_srp_core_projects_tasks.task_code";
    const DESCRIPTION = "pcs_srp_core_projects_tasks.description";
    const TYPE = "pcs_srp_core_projects_tasks.type";
    const STATUS = "pcs_srp_core_projects_tasks.status";
    

    /**
     * $idProjectTask 
     * 
     * @var int $idProjectTask
     */
    private $idProjectTask;
    

    /**
     * $taskCode 
     * 
     * @var string $taskCode
     */
    private $taskCode;
    

    /**
     * $description 
     * 
     * @var string $description
     */
    private $description;
    

    /**
     * $type 
     * 1=>specific,
2=>department

     * @var int $type
     */
    private $type;
    

    /**
     * $status 
     * 1=>free,
2=>locked,
3=>released,
4=>finalized,
5=>closed
     * @var int $status
     */
    private $status;

    /**
     * Set the idProjectTask value
     * 
     * @param int idProjectTask
     * @return ProjectTask $projectTask
     */
    public function setIdProjectTask($idProjectTask)
    {
        $this->idProjectTask = $idProjectTask;
        return $this;
    }

    /**
     * Return the idProjectTask value
     * 
     * @return int
     */
    public function getIdProjectTask()
    {
        return $this->idProjectTask;
    }

    /**
     * Set the taskCode value
     * 
     * @param string taskCode
     * @return ProjectTask $projectTask
     */
    public function setTaskCode($taskCode)
    {
        $this->taskCode = $taskCode;
        return $this;
    }

    /**
     * Return the taskCode value
     * 
     * @return string
     */
    public function getTaskCode()
    {
        return $this->taskCode;
    }

    /**
     * Set the description value
     * 
     * @param string description
     * @return ProjectTask $projectTask
     */
    public function setDescription($description)
    {
        $this->description = $description;
        return $this;
    }

    /**
     * Return the description value
     * 
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set the type value
     * 1=>specific,
2=>department

     * @param int type
     * @return ProjectTask $projectTask
     */
    public function setType($type)
    {
        $this->type = $type;
        return $this;
    }

    /**
     * Return the type value
     * 1=>specific,
2=>department

     * @return int
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Set the status value
     * 1=>free,
2=>locked,
3=>released,
4=>finalized,
5=>closed
     * @param int status
     * @return ProjectTask $projectTask
     */
    public function setStatus($status)
    {
        $this->status = $status;
        return $this;
    }

    /**
     * Return the status value
     * 1=>free,
2=>locked,
3=>released,
4=>finalized,
5=>closed
     * @return int
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Status
     * @var Array
     */
    public static $Status = array(
        'Active' => 1,
        'Inactive' => 2,
    );
    
    /**
     * Status Labels
     * @var Array
     */
    public static $StatusLabel = array(
        1 => 'Activo',
        2 => 'Inactivo',
    );
}
