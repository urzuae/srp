<?php
/**
 * SRP
 *
 * Sistema de Registro de Planillas
 *
 * @category   Application
 * @package    Application_Controllers
 * @copyright  Copyright (c) 2010 PCSMEXICO
 * @author     <marlen>, $LastChangedBy$
 * @version    1.0.0 SVN: $Id$
 */

/**
 * Dependences
 */
require_once "lib/controller/CrudController.php";
require_once "lib/managers/CalendarDayManager.php";
require_once "application/models/catalogs/TimetableCatalog.php";
require_once "application/models/catalogs/TimetableHourCatalog.php";
require_once "application/models/catalogs/EmployeeCatalog.php";
require_once "application/models/catalogs/ProjectCatalog.php";
require_once "application/models/catalogs/PersonCatalog.php";
require_once "application/models/catalogs/CalendarDayCatalog.php";
require_once "application/models/catalogs/SpecificProjectCatalog.php";
require_once "application/models/catalogs/DepartmentProjectCatalog.php";
require_once "application/models/catalogs/DepartmentCatalog.php";
require_once "application/models/catalogs/ProjectTaskCatalog.php";

/**
 * EmployeeTaskController (CRUD for the CalendarDay Objects)
 *
 * @category   Project
 * @package    Project_Controllers
 * @copyright  Copyright (c) 2010 PCSMEXICO 
 * @copyright  This File has been proudly generated by Bender (http://code.google.com/p/bender-modeler/). <chentepixtol> <zetta>
 * @author     <zetta> & <chentepixtol>
 * @version    1.0.0 SVN: $Revision$
 */
class EmployeeTaskController extends BaseController
{
    
    /**
     * alias for the list action
     */
    public function indexAction()
    {
        $this->_forward('view');
    }
    
    /**
     * Muestra el calendario de tareas
     */
    public function viewAction()
    {
    	$idEmployee = EmployeeCatalog::getInstance()->getIdEmployeeByIdUser($this->getUser()->getBean()->getIdUser());
    	$projects = ProjectCatalog::getInstance()->getIdProjectByIdEmployee($idEmployee);    	
    	foreach ($projects as $project)
    	{
    		$tmp[]=$project['id_project'];
		}
		$stringProjects = implode(",",$tmp);
		$strProjects='"';	
		$strProjects.= implode(",",$tmp);
		$strProjects.='"';	
		$dates = TimetableHourCatalog::getInstance()->getDisctinctDateByIdProjects($stringProjects);
    	foreach ($dates as $date)
    	{
    		$date = $date['date'];
    		$statusTask= TimetableHourCatalog::getInstance()->getStatusByDate($date);
    		if ($statusTask == 2)
    			$dateArray2[] = $date;
    		if ($statusTask == 3)
    			$dateArray3[] = $date;
    		if ($statusTask == 4)
    			$dateArray4[] = $date;
    		if ($statusTask == 1)
    			$dateArray1[] = $date;
		}		
		$datesStatus2=CalendarDayManager::getInstance()->getCalendarDays($dateArray2);
		$datesStatus3=CalendarDayManager::getInstance()->getCalendarDays($dateArray3);
		$datesStatus4=CalendarDayManager::getInstance()->getCalendarDays($dateArray4);
		$datesStatus1=CalendarDayManager::getInstance()->getCalendarDays($dateArray1);
		$this->view->daysStaus2= json_encode($datesStatus2);
		$this->view->daysStaus3= json_encode($datesStatus3);
		$this->view->daysStaus4= json_encode($datesStatus4);
		$this->view->daysStaus1= json_encode($datesStatus1); 
		$this->view->projects = $strProjects;  		
        $this->setTitle('Calendario de Tareas');
    }

    /*
     * List the tasks by project and date
     */    
	public function findAction()
    {
    	$this->noRender();
    	$projects = $this->getRequest()->getParam('projects');
    	$date_digest=new Zend_Date($this->getRequest()->getParam('dayDate'),"dd/MM/YYYY");
	    $dayDate=$date_digest->toString("YYYY-MM-dd");
	    $startDate = date('Y-m-d', strtotime('last Monday', strtotime($dayDate)));
		$endDate = date('Y-m-d', strtotime('next Sunday', strtotime($dayDate))); 
		$count = 0;
		$timetables = TimetableCatalog::getInstance()->getTimeTablesGeneralByDate($startDate,$endDate);
		foreach ($timetables as $timetable)
    	{
    		$idProjects = TimetableHourCatalog::getInstance()->getIdProjectsByTimetable($timetable['id_timetable']);
    		foreach ($idProjects as $idProject)
    		{
    			$idProjectTasks = TimetableHourCatalog::getInstance()->getIdProjectTasksByIdProject($idProject['id_project'],$timetable['id_timetable']);
    			foreach ($idProjectTasks as $idProjectTask)
    			{
    				/***Employee Data***/
    				$employee = EmployeeCatalog::getInstance()->getById($timetable['id_employee']);
		    		$username = $employee->getUsername();
		    		$person = PersonCatalog::getInstance()->getById($employee->getIdPerson());    	
		    		$employeeName = $person->getName()." ".$person->getMiddleName()." ".$person->getLastName();
		    		
		    		/***Week***/
		    		$week = $startDate." -- ".$endDate;
		    		
		    		/***Project Data***/
		    		$specificProject = SpecificProjectCatalog::getInstance()->getByIdProjectObject($idProject['id_project']);
		        	if ($specificProject == null)
		        	{
		        		$departmentProject = DepartmentProjectCatalog::getInstance()->getByIdProjectObject($idProject['id_project']);
		        		$department = DepartmentCatalog::getInstance()->getById($departmentProject->getIdDepartment());
		        		$projectName = $department->getDepartmentName();
		        	}
		        	else
		        		$projectName = $specificProject->getProjectName();
		        		
		    		/***Hours Sum by IdProjectTask***/
    				$sumHour = TimetableHourCatalog::getInstance()->getSumHoursByIdProjectTask($idProjectTask['id_project_task'], $idProject['id_project'], $timetable['id_timetable']);
    				
    				/***Hours Day***/
    				$dayHours = TimetableHourCatalog::getInstance()->getDayHoursByIdProjectTask($idProjectTask['id_project_task'], $idProject['id_project'], $timetable['id_timetable']);
    				foreach ($dayHours as $dayHour)
    				{
    					list($dateCreated, $timeCreated) = explode(" ",$dayHour['date_created']);
		    			$dDateCreated = explode('-', $dateCreated);
			        	$yearDateCreated = $dDateCreated[0];
			        	$monthDateCreated = $dDateCreated[1];
			        	$monthDateCreated=(string)(int)$monthDateCreated;
			        	$dayDateCreated = $dDateCreated[2];
			        	$dayDateCreated =(string)(int)$dayDateCreated;
			        	$dayWeek = date("w",mktime(0,0,0,$monthDateCreated,$dayDateCreated,$yearDateCreated));
    					
    					if ($dayWeek == '1')
    					{
    						$m = $dayHour['hours'];
    					}
    					if ($dayWeek == '2')
    					{
    						$tu = $dayHour['hours'];
    					}  
    					if ($dayWeek == '3')
    					{
    						$w = $dayHour['hours'];
    					} 
    					if ($dayWeek == '4')
    					{
    						$th = $dayHour['hours'];
    					}	
    					if ($dayWeek == '5')
    					{
    						$f = $dayHour['hours'];
    					}	
    					if ($dayWeek == '6')
    					{
    						$sa = $dayHour['hours'];
    					}
    					if ($dayWeek == '0')
    					{
    						$su = $dayHour['hours'];
    					}			
    				}
    				
    				/*$a[] = array(
						'employee' => $nameEmployee,
						'week' => $week,
						'project' => $projectName,
						'm' => $m,
    					'tu' => $tu,
    					'w' => $w,
    					'th' => $th,
    					'f' => $f,
    					'sa' => $sa,
    					'su' => $su,
						'total' => $sumHour
		        	);*/
    				$a[$count]["id"]=$count;
    				$a[$count]['cell'] = array(
						$employeeName,
						$week,
						$projectName,
						$m,
    					$tu,
    					$w,
    					$th,
    					$f,
    					$sa,
    					$su,
						$sumHour
		        	);
		        	$count++;
    			}
    		}
    	}
    	//die(print_r($a));
		$tasks["rows"]= $a;
	   /* foreach ($tasks as $task)
		{
		    $tmp.= "<tr>
				    <td>".$task['employee']."</td>
				    <td>".$task['week']."</td>
				    <td></td>
				    <td>".$task['project']."</td>
				    <td>".$task[m]."</td>
				    <td>".$task[tu]."</td>
				    <td>".$task[w]."</td>
				    <td>".$task[th]."</td>
				    <td>".$task[f]."</td>
				    <td>".$task[sa]."</td>
				    <td>".$task[su]."</td>
				    <td>".$task[total]."</td>
			    	</tr>";
		}
		die($tmp);*/
		//var_dump($tasks);
		//die($tasks);
		echo json_encode($tasks); 		
		
    }
}
