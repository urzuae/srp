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
require_once "application/models/catalogs/EmployeeCatalog.php";
require_once "application/models/catalogs/EmailCatalog.php";

/**
 * Clase abstracta de la que extenderan nuestros controladores, para agrupar instrucciones comunes
 *
 * @category   project
 * @package    Project_Controllers
 * @copyright  ##$COPYRIGHT$##
 */
class ProjectTaskManager {
    /* Instancia de LockerManager
     *
     * @staticvar LockerManager $instance
     */

    protected static $instance = null;
    /**
     * Catalogo de Usuario
     * @var projectTaskCatalog
     */
    protected $projectTaskCatalog;

    /**
     * Constructor
     */
    protected function ProjectTaskManager() {
        $this->projectTaskCatalog = ProjectTaskCatalog::getInstance();
    }

    /**
     * Singleton Obtiene una instancia
     * @return ProjectTaskManager
     */
    public static function getInstance() {
        if (!isset(self::$instance)) {
            self::$instance = new ProjectTaskManager();
        }
        return self::$instance;
    }

    /**
     * Crea un Lead y genera el log
     * @param array_iterator $employees
     * @throws ManagerException
     */
    public function upload_create($tasks, $type) {
        $db_errors = null;
        try {
            $inserted_rows = 0;
            foreach ($tasks as $key => $value) {
                if ($type == 1) {
                    $projectTask = SpecificProjectTaskFactory::createFromArray($tasks[$key])->setType($type);
                } else if ($type == 2) {
                    $projectTask = DepartmentProjectTaskFactory::createFromArray($tasks[$key])->setType($type);
                }
                $task_exists = ProjectTaskCatalog::getInstance()->getByTaskCode($projectTask->getTaskCode());
                try {
                    if (!$task_exists) {
                        $this->projectTaskCatalog->beginTransaction();
                        if ($type == 1) {
                            SpecificProjectTaskCatalog::getInstance ()->create($projectTask);
                        } else
                        if ($type == 2) {
                            DepartmentProjectTaskCatalog::getInstance ()->create($projectTask);
                        }
                        $this->projectTaskCatalog->commitTransaction();
                        $inserted_rows++;
                    } else {
                        try {
                            $this->projectTaskCatalog->beginTransaction();
                            if ($task_exists->getStatus() == 2)
                                $task_exists->setStatus(ProjectTask::$Status["Active"]);
                            $this->projectTaskCatalog->update($task_exists);
                            $this->projectTaskCatalog->commitTransaction();
                        } catch (Exception $e) {
                            $this->projectTaskCatalog->rollbackTransaction();
                            $db_errors[$key] = $e->getMessage();
                        }
                    }
                } catch (Exception $e) {
                    if ($e instanceof DepartmentProjectTaskException || $e instanceof SpecificProjectTaskException) {
                        $this->projectTaskCatalog->rollbackTransaction();
                        $db_errors[$key] = $e->getMessage();
                    }
                }
                try {
                    if ($type == 1) {
                        $project = SpecificProjectCatalog::getInstance()->getByProjectCode($tasks[$key]["project_code"]);
                        if (!$project)
                            $db_errors[$key] = "El proyecto no existe: " . $tasks[$key]["project_code"];
                        else {
                            if ($task_exists) {
                                $criteria = New Criteria();
                                $criteria->add(ProjectTask::TABLENAME_PROJECT_TASK_PROJECT . ".id_project", $project->getIdProject(), Criteria::EQUAL);
                                $criteria->add(ProjectTask::TABLENAME_PROJECT_TASK_PROJECT . ".id_project_task", $task_exists->getIdProjectTask(), Criteria::EQUAL);
                                $project_projectTask = $this->projectTaskCatalog->getProjectTaskProjectRelations($criteria);
                                if (!$project_projectTask) {
                                    $this->projectTaskCatalog->beginTransaction();
                                    $this->projectTaskCatalog->linkToProject($task_exists->getIdProjectTask(), $project->getIdProject());
                                    $this->projectTaskCatalog->commitTransaction();
                                }
                            } else {
                                $this->projectTaskCatalog->beginTransaction();
                                $this->projectTaskCatalog->linkToProject($task_exists->getIdProjectTask(), $project->getIdProject());
                                $this->projectTaskCatalog->commitTransaction();
                            }
                        }
                    }
                } catch (Exception $e) {
                    if ($e instanceof ProjectTaskException) {
                        $this->projectTaskCatalog->rollbackTransaction();
                        $db_errors[$key] = $e->getMessage();
                    }else
                        $db_errors[$key] = $e->getMessage();
                }
            }
            return array("inserted" => $inserted_rows, "db_errors" => $db_errors);
        } catch (Exception $e) {
            die($e->getMessage());
            //$this->employeeCatalog->rollbackTransaction();
        }
    }

    public function check_projects_tasks($tasks) {
        $tasks_db = ProjectTaskCatalog::getInstance()->getByCriteria();
        foreach ($tasks_db as $task_db) {
            $on_list = false;
            foreach ($tasks as $task) {
                if ($task_db->getTaskCode() == $task["task_code"]) {
                    $on_list = true;
                }
            }
            if (!$on_list) {
                if ($task_db->getStatus() == 1) {
                    try {
                        $this->projectTaskCatalog->beginTransaction();
                        if ($task_exists->getStatus() == 1)
                            $task_exists->setStatus(ProjectTask::$Status["Inactive"]);
                        $this->projectTaskCatalog->update($task_exists);
                        $this->projectTaskCatalog->commitTransaction();
                    } catch (Exception $e) {
                        $this->projectTaskCatalog->rollbackTransaction();
                        die($e->getMessage());
                    }
                }
            }
        }
    }

}