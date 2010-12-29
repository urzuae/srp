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
require_once "application/models/catalogs/DepartmentProjectCatalog.php";
require_once "application/models/catalogs/DepartmentCatalog.php";
require_once "application/models/catalogs/ProjectCatalog.php";
require_once "application/models/catalogs/UserCatalog.php";
require_once "application/models/catalogs/EmployeeCatalog.php";

/**
 * DepartmentProjectController (CRUD for the DepartmentProject Objects)
 *
 * @category   Project
 * @package    Project_Controllers
 * @copyright  Copyright (c) 2010 PCSMEXICO 
 * @copyright  This File has been proudly generated by Bender (http://code.google.com/p/bender-modeler/). <chentepixtol> <zetta>
 * @author     <zetta> & <chentepixtol>
 * @version    1.0.2 SVN: $Revision$
 */
class DepartmentProjectController extends CrudController
{
    
    /**
     * alias for the list action
     */
    public function indexAction()
    {
        $this->_forward('list');
    }
    
    /**
     * List the objects DepartmentProject actives
     */
    public function listAction()
    {
        //$this->view->departmentProjects = DepartmentProjectCatalog::getInstance()->getActives();
		$departmentProjects = DepartmentProjectCatalog::getInstance()->getActives();
		$a = array();
        while($departmentProjects->valid())
        {
        	$departmentProject = $departmentProjects->read();
         	$department = DepartmentCatalog::getInstance()->getById($departmentProject->getIdDepartment());
			$a[] = array(
				'idDepartmentProject' => $departmentProject->getIdProject(),
				'department' => $department->getDepartmentName()
        	);
        }
		$this->view->departmentProjects= $a;
		$this->setTitle('Listado de Proyectos Departamentales');
    }
    
    /**
     * delete an DepartmentProject
     */
    public function deleteAction()
    {
        $departmentProjectCatalog = DepartmentProjectCatalog::getInstance();
        $idDepartmentProject = $this->getRequest()->getParam('idDepartmentProject');
        $departmentProject = $departmentProjectCatalog->getById($idDepartmentProject);
        $departmentProjectCatalog->deactivate($departmentProject);
        $this->setFlash('ok','El proyecto ha sido eliminado');
        $this->_redirect('department-project/list');
    }
    
    /**
     * Form for edit an DepartmentProject
     */
    public function editAction()
    {
        $departmentProjectCatalog = DepartmentProjectCatalog::getInstance();
        $idDepartmentProject = $this->getRequest()->getParam('idDepartmentProject');
        $departmentProject = $departmentProjectCatalog->getById($idDepartmentProject);
        $post = array(
            'id_department_project' => $departmentProject->getIdDepartmentProject(),
            'id_project' => $departmentProject->getIdProject(),
            'id_department' => $departmentProject->getIdDepartment(),
        );
        $this->view->post = $post;
        $this->setTitle('Edit DepartmentProject');
    }
    
    /**
     * Create an DepartmentProject
     */
    public function createAction()
    {   
        $departmentProjectCatalog = DepartmentProjectCatalog::getInstance();
        $idProject = utf8_decode($this->getRequest()->getParam('id_project'));
        $idDepartment = utf8_decode($this->getRequest()->getParam('id_department'));
        $departmentProject = DepartmentProjectFactory::create($idProject, $idDepartment);
        $departmentProjectCatalog->create($departmentProject);  
        $this->view->setTpl('_row');
        $this->view->setLayoutFile(false);
        $this->view->departmentProject = $departmentProject;
    }
    
    /**
     * Update an DepartmentProject
     */
    public function updateAction()
    {
        $departmentProjectCatalog = DepartmentProjectCatalog::getInstance();
        $idDepartmentProject = $this->getRequest()->getParam('idDepartmentProject');
        $departmentProject = $departmentProjectCatalog->getById($idDepartmentProject);
        $departmentProject->setIdProject($this->getRequest()->getParam('id_project'));
        $departmentProject->setIdDepartment($this->getRequest()->getParam('id_department'));
        $departmentProjectCatalog->update($departmentProject);
        $this->setFlash('ok','El proyecto ha sido modificado');
        $this->_redirect('department-project/list');
    }
    
     /**
     * Approve an DepartmentProject
     */
    public function approveAction()
    {
        //$this->view->employees = EmployeeCatalog::getInstance()->getActives();      
        $employees = EmployeeCatalog::getInstance()->getActives();
        while ($employees->valid())
        {
        	$employee = $employees->read();
        	$person = PersonCatalog::getInstance()->getById($employee->getIdPerson());
        	$employeesArray[] = array (
        		'idEmployee'=> $employee->getIdEmployee(),
        		'name'=> $person-> getName(),
        		'middleName'=> $person->getMiddleName(),
        		'lastName'=> $person->getLastName()
        	); 
        }  
        $this->view->employees = $employeesArray;   
       	$departmentProjectCatalog = DepartmentProjectCatalog::getInstance();
        $idDepartmentProject = $this->getRequest()->getParam('idDepartmentProject');
        $this->view->idDepartmentProject = $idDepartmentProject;
        $this->view->permissions = ProjectCatalog::getInstance()->getAllPermissions();
        $departmentProject = $departmentProjectCatalog->getByIdProjectObject($idDepartmentProject);
        $department = DepartmentCatalog::getInstance()->getById($departmentProject->getIdDepartment());
		$post = array(
			'idDepartmentProject' => $departmentProject->getIdProject(),
			'name' => $department->getDepartmentName()
        	);
        $this->view->post = $post;  
        $this->view->levelOne = 1;
        $this->view->levelTwo = 2; 
        $this->view->isMainOne = 1;  
        $this->view->isMainZero = 0;          
        $this->setTitle('Aprobar Proyecto');
    }
    
    /**
     * Approve user
     */   
	public function approvedUserAction()
    {   
    	$this->view->Projects = ProjectCatalog::getInstance()->getByCriteria(new Criteria());        
        $this->view->employees = EmployeeCatalog::getInstance()->getByCriteria(new Criteria());        
        $operation = $this->getRequest()->getParam('value');
        $idEmployee = $this->getRequest()->getParam('idEmployee');
        $idProject = $this->getRequest()->getParam('idDepartmentProject');
        $level = $this->getRequest()->getParam('level');
        $isMain = $this->getRequest()->getParam('isMain');
        if( $operation )
        {
        	ProjectCatalog::getInstance()->unlinkFromEmployee($idProject, $idEmployee);
		   	ProjectCatalog::getInstance()->linkToEmployee($idProject, $idEmployee, $isMain, $level);
        }
		else  
		   	ProjectCatalog::getInstance()->unlinkFromEmployee($idProject, $idEmployee);
		   
	$this->noRender();		   	
    }

    public function getDepartmentsProjectsAction(){
        $this->noRender();
        echo(json_encode(DepartmentProjectCatalog::getInstance()->getActivesDepartments()));
    }
	   
}
