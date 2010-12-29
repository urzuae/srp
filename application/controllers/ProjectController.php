<?php
/**
 * SRP
 *
 * SRP INELECTRA
 *
 * @category   Application
 * @package    Application_Controllers
 * @copyright  Copyright (c) 2010 PCSMEXICO
 * @author     <arturo>, $LastChangedBy$
 * @version    1.0.2 SVN: $Id$
 */

/**
 * Dependences
 */
require_once "lib/controller/CrudController.php";
require_once "lib/managers/TimetableManager.php";
require_once "Zend/Json/Encoder.php";
require_once "application/models/catalogs/ProjectCatalog.php";
require_once "application/models/beans/Department.php";
require_once "application/models/catalogs/SpecificProjectCatalog.php";
require_once "application/models/catalogs/DepartmentProjectCatalog.php";

/**
 * ProjectController (CRUD for the Project Objects)
 *
 * @category   Project
 * @package    Project_Controllers
 * @copyright  Copyright (c) 2010 PCSMEXICO
 * @copyright  This File has been proudly generated by Bender (http://code.google.com/p/bender-modeler/). <chentepixtol> <zetta>
 * @author     <zetta> & <chentepixtol>
 * @version    1.0.2 SVN: $Revision$
 */
class ProjectController extends CrudController
{

    /**
     * alias for the list action
     */
    public function indexAction()
    {
        $this->_forward('list');
    }

    /**
     * List the objects Project actives
     */
    public function listAction()
    {
        $this->view->projects = ProjectCatalog::getInstance()->getActives();
        $this->setTitle('List the Project');
    }

    /**
     * delete an Project
     */
    public function deleteAction()
    {
        $projectCatalog = ProjectCatalog::getInstance();
        $idProject = $this->getRequest()->getParam('idProject');
        $project = $projectCatalog->getById($idProject);
        $projectCatalog->deactivate($project);
        $this->setFlash('ok','Successfully removed the Project');
        $this->_redirect('project/list');
    }

    /**
     * Form for edit an Project
     */
    public function editAction()
    {
        $projectCatalog = ProjectCatalog::getInstance();
        $idProject = $this->getRequest()->getParam('idProject');
        $project = $projectCatalog->getById($idProject);
        $post = array(
            'id_project' => $project->getIdProject(),
            'type' => $project->getType(),
            'status' => $project->getStatus(),
        );
        $this->view->post = $post;
        $this->setTitle('Edit Project');
    }

    /**
     * Create an Project
     */
    public function createAction()
    {
        $projectCatalog = ProjectCatalog::getInstance();
        $type = utf8_decode($this->getRequest()->getParam('type'));
        $status = utf8_decode($this->getRequest()->getParam('status'));
        $project = ProjectFactory::create($type, $status);
        $projectCatalog->create($project);
        $this->view->setTpl('_row');
        $this->view->setLayoutFile(false);
        $this->view->project = $project;
    }

    /**
     * Update an Project
     */
    public function updateAction()
    {
        $projectCatalog = ProjectCatalog::getInstance();
        $idProject = $this->getRequest()->getParam('idProject');
        $project = $projectCatalog->getById($idProject);
        $project->setType($this->getRequest()->getParam('type'));
        $project->setStatus($this->getRequest()->getParam('status'));
        $projectCatalog->update($project);
        $this->setFlash('ok','Successfully edited the Project');
        $this->_redirect('project/list');
    }

    public function getProjectsAction(){
        $this->noRender();
        $date=new Zend_Date($this->getRequest()->getParam("beginning"),"d/MM/YYYY");
        $projects=SpecificProjectCatalog::getInstance()->getActives()->toKeyValueArray(SpecificProject::ID_PROJECT, SpecificProject::PROJECT_CODE);
        $departments=ProjectCatalog::getInstance()->getActivesDepartments();
        $timetables=TimetableManager::getInstance()->getTimetablesHours($this->getUser()->getBeanEmployee()->getIdEmployee(), $date->toString("YYYY-MM-dd"));
        foreach ($departments as $department)
            $projects[$department["id_project"]]=array("department"=>$department["department_name"]);

        //Zend_Json::$useBuiltinEncoderDecoder = false;
        echo Zend_Json_Encoder::encode((array("projects"=>$projects,"hours"=>$timetables)));
    }

}