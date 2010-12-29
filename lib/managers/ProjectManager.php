<?php

/**
 * ##$BRAND_NAME$##
 *
 * ##$DESCRIPTION$##
 *
 * @category   Project
 * @package    Project_Controllers
 * @copyright  ##$COPYRIGHT$##
 * @author     ##$AUTHOR$##, $LastChangedBy$
 * @version    ##$VERSION$##, SVN:  $Id$
 */
require_once "Zend/Json/Decoder.php";
require_once "application/models/catalogs/ProjectCatalog.php";
require_once "application/models/catalogs/SpecificProjectCatalog.php";

/**
 * Clase abstracta de la que extenderan nuestros controladores, para agrupar instrucciones comunes
 *
 * @category   project
 * @package    Project_Controllers
 * @copyright  ##$COPYRIGHT$##
 */
class ProjectManager {
    /* Instancia de LockerManager
     *
     * @staticvar LockerManager $instance
     */

    protected static $instance = null;
    /**
     * Catalogo de Departamento
     * @var ProjectCatalog
     */
    protected $projectCatalog;

    /**
     * Constructor
     */
    protected function ProjectManager() {
        $this->projectCatalog = ProjectCatalog::getInstance();
    }

    /**
     * Singleton Obtiene una instancia
     * @return ProjectManager
     */
    public static function getInstance() {
        if (!isset(self::$instance)) {
            self::$instance = new ProjectManager();
        }
        return self::$instance;
    }

    /**
     * Crea un Lead y genera el log
     * @param array_iterator $projects
     * @throws ManagerException
     */
    public function upload_create($projects) {
        $db_errors = null;
        try {
            $inserted_rows = 0;
            foreach ($projects as $key => $value) {
                //echo $projects[$key]["project_code"]."\n";
                $project_exists = SpecificProjectCatalog::getInstance()->getByProjectCode($projects[$key]["project_code"]);
                if (!$project_exists) {
                    $bgDate = ($projects[$key]["beginning_date"]) ?
                            new Zend_Date($projects[$key]["beginning_date"] . $projects[$key]["beginning_time"], "DDMMYYYYHHmmss") :
                            new Zend_Date("00000000000000", "DDMMYYYYHHmmss");
                    $endDate = ($projects[$key]["ending_date"]) ?
                            new Zend_Date($projects[$key]["ending_date"] . $projects[$key]["ending_time"], "DDMMYYYYHHmmss") :
                            new Zend_Date("00000000000000", "DDMMYYYYHHmmss");
                    //$endDate = new Zend_Date($projects[$key]["ending_date"].$projects[$key]["ending_time"], "DDMMYYYYHHmmss");

                    $projects[$key]["beginning_date"] = $bgDate->toString("YYYY-MM-dd HH-mm-ss");
                    $projects[$key]["ending_date"] = $endDate->toString("YYYY-MM-dd HH-mm-ss");
                    $specificProject = SpecificProjectFactory::createFromArray($projects[$key]);
                    $specificProject->setType(SpecificProject::$Type["specific"]);
                    $specificProject->setStatus(SpecificProject::$Status["Active"]);
                    try {
                        $this->projectCatalog->beginTransaction();
                        //$sprecificProject=DepartmentProjectFactory::create($department->getIdDepartment(), DepartmentProject::$Type["department"],  DepartmentProject::$Status["Active"]);
                        SpecificProjectCatalog::getInstance()->create($specificProject);

                        $this->projectCatalog->commitTransaction();
                        $inserted_rows++;
                    } catch (Exception $e) {
                        echo $e->getMessage();
                        if ($e instanceof ProjectException || $e instanceof SpecificProjectException) {
                            $this->projectCatalog->rollbackTransaction();
                            $db_errors[$key] = $e->getMessage();
                            //print_r($db_errors);
                            echo $e->getMessage();
                        }
                    }
                }else {
                    //echo $project_exists->getProjectCode();
                    try{
                        $project = $this->projectCatalog->getById($project_exists->getIdProject());
                        $project->setStatus(Project::$Status["Active"]);
                        $this->projectCatalog->beginTransaction();
                        $this->projectCatalog->update($project);
                        $this->projectCatalog->commitTransaction();
                    }  catch (Exception $e){
                        $this->projectCatalog->rollbackTransaction();
                        $db_errors[$key] = $e->getMessage();
                    }
                }
            }
            return array("inserted" => $inserted_rows, "db_errors" => $db_errors);
        } catch (Exception $e) {
            //$this->projectCatalog->rollbackTransaction();
            die($e->getMessage());
        }
    }

    public function check_projects($projects) {
        $projects_db = SpecificProjectCatalog::getInstance()->getByCriteria();
        foreach ($projects_db as $project_db) {
            $on_list = false;
            foreach ($projects as $project) {
                if ($project_db->getProjectCode() == $project["project_code"]) {
                    $on_list = true;
                }
            }
            if (!$on_list) {
                if ($project_db->getStatus() == 1) {
                    try {
                        //echo $departmen_db->getIdDepartment();
                        $project = $this->projectCatalog->getById($project_db->getIdProject());
                        //var_dump($project);
                        $project->setStatus(Project::$Status["Inactive"]);
                        $this->projectCatalog->beginTransaction();
                        $this->projectCatalog->update($project);
                        $this->projectCatalog->commitTransaction();
                    } catch (Exception $e) {
                        $this->projectCatalog->rollbackTransaction();
                        die($e->getMessage());
                    }
                }
            }
        }
    }

}