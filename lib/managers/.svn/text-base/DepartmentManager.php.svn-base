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
require_once "application/models/catalogs/DepartmentCatalog.php";
require_once "application/models/catalogs/DepartmentProjectCatalog.php";

/**
 * Clase abstracta de la que extenderan nuestros controladores, para agrupar instrucciones comunes
 *
 * @category   project
 * @package    Project_Controllers
 * @copyright  ##$COPYRIGHT$##
 */
class DepartmentManager {
    /* Instancia de LockerManager
     *
     * @staticvar LockerManager $instance
     */

    protected static $instance = null;
    /**
     * Catalogo de Departamento
     * @var DepartmentCatalog
     */
    protected $departmentCatalog;

    /**
     * Constructor
     */
    protected function DepartmentManager() {
        $this->departmentCatalog = DepartmentCatalog::getInstance();
    }

    /**
     * Singleton Obtiene una instancia
     * @return DepartmentManager
     */
    public static function getInstance() {
        if (!isset(self::$instance)) {
            self::$instance = new DepartmentManager();
        }
        return self::$instance;
    }

    /**
     * Crea un Lead y genera el log
     * @param array_iterator $departments
     * @throws ManagerException
     */
    public function upload_create($departments) {
        $db_errors = null;
        try {
            $inserted_rows = 0;
            foreach ($departments as $key => $value) {
                $department_exists=  DepartmentCatalog::getInstance()->getByDepartmentCode($departments[$key]["department_code"])->getOne();
                if(!$department_exists){
                    $department = DepartmentFactory::createFromArray($departments[$key]);
                    try {
                        $this->departmentCatalog->beginTransaction();

                        $this->departmentCatalog->create($department);

                        $departmentProject=DepartmentProjectFactory::create($department->getIdDepartment(), DepartmentProject::$Type["department"],  DepartmentProject::$Status["Active"]);
                        DepartmentProjectCatalog::getInstance()->create($departmentProject);

                        $this->departmentCatalog->commitTransaction();
                        $inserted_rows++;
                    } catch (Exception $e) {
                        echo $e->getMessage();
                        if ($e instanceof DepartmentException || $e instanceof DepartmentProjectException) {
                            $this->departmentCatalog->rollbackTransaction();
                            $db_errors[$key] = $e->getMessage();
                            //print_r($db_errors);
                            echo $e->getMessage();
                        }
                    }
                } else {
                    try{
                    $this->departmentCatalog->beginTransaction();
                        
                        $department_exists->setStatus(Department::$Status["Active"]);
                        
                        DepartmentCatalog::getInstance()->update($department_exists);
                        $department_project=DepartmentProjectCatalog::getInstance()->getByIdDepartment($department_exists->getIdDepartment())->getOne();
                        $department_project->setStatus(Project::$Status["Active"]);
                        DepartmentProjectCatalog::getInstance()->update($department_project);
                        
                    $this->departmentCatalog->commitTransaction();
                    }  catch (Exception $e){
                        $this->departmentCatalog->rollbackTransaction();
                        $db_errors[$key] = $e->getMessage();
                    }
                }
            }
            return array("inserted" => $inserted_rows, "db_errors" => $db_errors);
        } catch (Exception $e) {
            //$this->departmentCatalog->rollbackTransaction();
            die($e->getMessage());
        }
    }

    public function check_departments($departments) {
        $departments_db = DepartmentCatalog::getInstance()->getByCriteria();
        foreach ($departments_db as $department_db) {
            $on_list = false;
            foreach ($departments as $department) {
                if ($department_db->getDepartmentCode() == $department["department_code"]) {
                    $on_list = true;
                }
            }
            if (!$on_list) {
                if($department_db->getStatus()==1){
                    try{
                        //echo $department_db->getIdDepartment();
                        $this->departmentCatalog->beginTransaction();

                            $department_db->setStatus(Department::$Status["Inactive"]);
                            DepartmentCatalog::getInstance()->update($department_db);
                            $department_project=DepartmentProjectCatalog::getInstance()->getByIdDepartment($department_db->getIdDepartment())->getOne();
                            //var_dump($department_project);
                            if($department_project){
                                $project= ProjectCatalog::getInstance()->getById($department_project->getIdProject());
                                //var_dump($project);
                                $project->setStatus(Project::$Status["Inactive"]);
                                ProjectCatalog::getInstance()->update($project);
                            }
                        $this->departmentCatalog->commitTransaction();
                    }catch (Exception $e){
                        $this->departmentCatalog->rollbackTransaction();
                        die($e->getMessage());
                    }
                }
            }
        }
    }

}