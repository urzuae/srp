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
 * Clase ProjectApproversList
 *
 * @category   lib
 * @package    lib_models
 * @subpackage lib_models_beans
 * @copyright  Copyright (c) 2010 PCSMEXICO 
 * @copyright  This File has been proudly generated by Bender (http://code.google.com/p/bender-modeler/). <chentepixtol> <zetta>
 * @author     <zetta> & <chentepixtol>
 * @version    1.0.2 SVN: $Revision$
 */
class ProjectApproversList
{
    /**
     * Constante que contiene el nombre de la tabla 
     * @static TABLENAME
     */
    const TABLENAME = "pcs_srp_core_projects_approvers_lists";

    /**
     * Constantes para los nombres de los campos
     */
    const ID_PROJECT_APPROVERS_LIST = "pcs_srp_core_projects_approvers_lists.id_project_approvers_list";
    const ID_PROJECT = "pcs_srp_core_projects_approvers_lists.id_project";
    const ID_EMPLOYEE = "pcs_srp_core_projects_approvers_lists.id_employee";
    const IS_MAIN = "pcs_srp_core_projects_approvers_lists.is_main";
    const LEVEL = "pcs_srp_core_projects_approvers_lists.level";
    

    /**
     * $idProjectApproversList 
     * 
     * @var int $idProjectApproversList
     */
    private $idProjectApproversList;
    

    /**
     * $idProject 
     * 
     * @var int $idProject
     */
    private $idProject;
    

    /**
     * $idEmployee 
     * 
     * @var int $idEmployee
     */
    private $idEmployee;
    

    /**
     * $isMain 
     * Define si un aprobador es el mando mas alto en la jerarquia
     * @var int $isMain
     */
    private $isMain;
    

    /**
     * $level 
     * Define el nivel del aprobador en la jerarquia de aprobacion
     * @var int $level
     */
    private $level;

    /**
     * Set the idProjectApproversList value
     * 
     * @param int idProjectApproversList
     * @return ProjectApproversList $projectApproversList
     */
    public function setIdProjectApproversList($idProjectApproversList)
    {
        $this->idProjectApproversList = $idProjectApproversList;
        return $this;
    }

    /**
     * Return the idProjectApproversList value
     * 
     * @return int
     */
    public function getIdProjectApproversList()
    {
        return $this->idProjectApproversList;
    }

    /**
     * Set the idProject value
     * 
     * @param int idProject
     * @return ProjectApproversList $projectApproversList
     */
    public function setIdProject($idProject)
    {
        $this->idProject = $idProject;
        return $this;
    }

    /**
     * Return the idProject value
     * 
     * @return int
     */
    public function getIdProject()
    {
        return $this->idProject;
    }

    /**
     * Set the idEmployee value
     * 
     * @param int idEmployee
     * @return ProjectApproversList $projectApproversList
     */
    public function setIdEmployee($idEmployee)
    {
        $this->idEmployee = $idEmployee;
        return $this;
    }

    /**
     * Return the idEmployee value
     * 
     * @return int
     */
    public function getIdEmployee()
    {
        return $this->idEmployee;
    }

    /**
     * Set the isMain value
     * Define si un aprobador es el mando mas alto en la jerarquia
     * @param int isMain
     * @return ProjectApproversList $projectApproversList
     */
    public function setIsMain($isMain)
    {
        $this->isMain = $isMain;
        return $this;
    }

    /**
     * Return the isMain value
     * Define si un aprobador es el mando mas alto en la jerarquia
     * @return int
     */
    public function getIsMain()
    {
        return $this->isMain;
    }

    /**
     * Set the level value
     * Define el nivel del aprobador en la jerarquia de aprobacion
     * @param int level
     * @return ProjectApproversList $projectApproversList
     */
    public function setLevel($level)
    {
        $this->level = $level;
        return $this;
    }

    /**
     * Return the level value
     * Define el nivel del aprobador en la jerarquia de aprobacion
     * @return int
     */
    public function getLevel()
    {
        return $this->level;
    }

}
