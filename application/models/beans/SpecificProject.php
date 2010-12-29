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
require_once "application/models/beans/Project.php";

/**
 * Clase SpecificProject
 *
 * @category   lib
 * @package    lib_models
 * @subpackage lib_models_beans
 * @copyright  Copyright (c) 2010 PCSMEXICO 
 * @copyright  This File has been proudly generated by Bender (http://code.google.com/p/bender-modeler/). <chentepixtol> <zetta>
 * @author     <zetta> & <chentepixtol>
 * @version    1.0.2 SVN: $Revision$
 */
class SpecificProject extends Project 
{
    /**
     * Constante que contiene el nombre de la tabla 
     * @static TABLENAME
     */
    const TABLENAME = "pcs_srp_core_specifics_projects";

    /**
     * Constantes para los nombres de los campos
     */
    const ID_SPECIFIC_PROJECT = "pcs_srp_core_specifics_projects.id_specific_project";
    const ID_PROJECT = "pcs_srp_core_specifics_projects.id_project";
    const PROJECT_CODE = "pcs_srp_core_specifics_projects.project_code";
    const PROJECT_NAME = "pcs_srp_core_specifics_projects.project_name";
    const BEGINNING_DATE = "pcs_srp_core_specifics_projects.beginning_date";
    const ENDING_DATE = "pcs_srp_core_specifics_projects.ending_date";
    

    /**
     * $idSpecificProject 
     * 
     * @var int $idSpecificProject
     */
    private $idSpecificProject;
    

    /**
     * $idProject 
     * 
     * @var int $idProject
     */
    private $idProject;
    

    /**
     * $projectCode 
     * 
     * @var string $projectCode
     */
    private $projectCode;
    

    /**
     * $projectName 
     * 
     * @var string $projectName
     */
    private $projectName;
    

    /**
     * $beginningDate 
     * 
     * @var datetime $beginningDate
     */
    private $beginningDate;
    

    /**
     * $endingDate 
     * 
     * @var datetime $endingDate
     */
    private $endingDate;

    /**
     * Set the idSpecificProject value
     * 
     * @param int idSpecificProject
     * @return SpecificProject $specificProject
     */
    public function setIdSpecificProject($idSpecificProject)
    {
        $this->idSpecificProject = $idSpecificProject;
        return $this;
    }

    /**
     * Return the idSpecificProject value
     * 
     * @return int
     */
    public function getIdSpecificProject()
    {
        return $this->idSpecificProject;
    }

    /**
     * Set the idProject value
     * 
     * @param int idProject
     * @return SpecificProject $specificProject
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
     * Set the projectCode value
     * 
     * @param string projectCode
     * @return SpecificProject $specificProject
     */
    public function setProjectCode($projectCode)
    {
        $this->projectCode = $projectCode;
        return $this;
    }

    /**
     * Return the projectCode value
     * 
     * @return string
     */
    public function getProjectCode()
    {
        return $this->projectCode;
    }

    /**
     * Set the projectName value
     * 
     * @param string projectName
     * @return SpecificProject $specificProject
     */
    public function setProjectName($projectName)
    {
        $this->projectName = $projectName;
        return $this;
    }

    /**
     * Return the projectName value
     * 
     * @return string
     */
    public function getProjectName()
    {
        return $this->projectName;
    }

    /**
     * Set the beginningDate value
     * 
     * @param datetime beginningDate
     * @return SpecificProject $specificProject
     */
    public function setBeginningDate($beginningDate)
    {
        $this->beginningDate = $beginningDate;
        return $this;
    }

    /**
     * Return the beginningDate value
     * 
     * @return datetime
     */
    public function getBeginningDate()
    {
        return $this->beginningDate;
    }

    /**
     * Set the endingDate value
     * 
     * @param datetime endingDate
     * @return SpecificProject $specificProject
     */
    public function setEndingDate($endingDate)
    {
        $this->endingDate = $endingDate;
        return $this;
    }

    /**
     * Return the endingDate value
     * 
     * @return datetime
     */
    public function getEndingDate()
    {
        return $this->endingDate;
    }

}
