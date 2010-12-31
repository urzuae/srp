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
require_once "lib/controller/BaseController.php";
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
 * Clase abstracta de la que extenderan nuestros controladores, para agrupar instrucciones comunes
 *
 * @category   project
 * @package    Project_Controllers
 * @copyright  ##$COPYRIGHT$##
 */
class ExportManager {
    /* Instancia de LockerManager
     *
     * @staticvar LockerManager $instance
     */

    protected static $instance = null;
    /**
     * Catalogo de Departamento
     * @var TimetableCatalog
     */
    protected $timetableCatalog;

    /**
     * Constructor
     */
    protected function ExportManager() {
        $this->timetableCatalog = TimetableCatalog::getInstance();
    }

    /**
     * Singleton Obtiene una instancia
     * @return ExportManager
     */
    public static function getInstance() {
        if (!isset(self::$instance)) {
            self::$instance = new ExportManager();
        }
        return self::$instance;
    }

    public function getTimetables($startDate,$endDate) 
    {
    	$export = array();
    	$timetables = TimetableCatalog::getInstance()->getTimeTablesByDate($startDate,$endDate);
    	foreach ($timetables as $timetable)
    	{
    		/***Datos de Empleado***/
    		$employee = EmployeeCatalog::getInstance()->getById($timetable['id_employee']);
	    	$username = $employee->getUsername();
	    	$person = PersonCatalog::getInstance()->getById($employee->getIdPerson());    	
	    	$nameEmployee = $person->getName()." ".$person->getMiddleName()." ".$person->getLastName();
	    	$department = DepartmentCatalog::getInstance()->getById($employee->getIdDepartment());
	    	$departmentEmployee = $department->getDepartmentCode();
	    		
	    	/***Datos de Proyecto***/
	    	$specificProject = SpecificProjectCatalog::getInstance()->getByIdProjectObject($timetable['id_project']);
	        if ($specificProject == null)
	        {
	        	$departmentProject = DepartmentProjectCatalog::getInstance()->getByIdProjectObject($timetable['id_project']);
	        	$department = DepartmentCatalog::getInstance()->getById($departmentProject->getIdDepartment());
	        	$projectName = $department->getDepartmentName();
	        }
	        else
	        	$projectName = $specificProject->getProjectName();
	        	
	        /******************************************************Datos de Planilla************************************************************************/
	    	/***Inicio y Fin de Semana***/
	       	list($paramsDay, $timeparams) = explode(" ",$timetable['date']);
	        $dParamsDay = explode('-', $paramsDay);
	        $yearParamsDay = $dParamsDay[0];
	        $monthParamsDay = $dParamsDay[1];
	        $monthParamsDay=(string)(int)$monthParamsDay;
	        $dayParamsDay = $dParamsDay[2];
	        $dayParamsDay = (string)(int)$dayParamsDay;
	        $dayWeekParamsDay = date("w",mktime(0,0,0,$monthParamsDay,$dayParamsDay,$yearParamsDay));
		    if($dayWeekParamsDay != 1)
		    	$weekBeginning = date('Y-m-d H:i:s', strtotime('last Monday', strtotime($timetable['date'])));
		    else 
		    	$weekBeginning = $timetable['date'];
		    	
			if($dayWeekParamsDay != 6)
		    	$weekEnd = date('Y-m-d H:i:s', strtotime('next Sunday', strtotime($timetable['date']))); 
		    else 
		    	$weekEnd = $timetable['date'];
    		list($dateweekBeginning, $timeweekBeginning) = explode(" ",$weekBeginning);	
    		list($dateweekEnd, $timeweekEnd) = explode(" ",$weekEnd);
    		
    		/***Fecha Actual***/
	    	$dateActually = date('Y-m-d');
    		$dDateActually = explode('-', $dateActually);
	        $yearDateActually = $dDateActually[0];
	        $monthDateActually = $dDateActually[1];
	        $monthDateActually=(string)(int)$monthDateActually;
	        $dayDateActually = $dDateActually[2];
	        $dayDateActually = (string)(int)$dayDateActually;
	        $timestampDateActually = mktime(0,0,0,$monthDateActually,$dayDateActually,$yearDateActually);
	        	
	    	/***Fecha de creación***/
    		list($dateCreated, $timeCreated) = explode(" ",$timetable['date']);
    			
    		$dDateCreated = explode('-', $dateCreated);
	        $yearDateCreated = $dDateCreated[0];
	        $monthDateCreated = $dDateCreated[1];
	        $monthDateCreated=(string)(int)$monthDateCreated;
	        $dayDateCreated = $dDateCreated[2];
	        $dayDateCreated = (string)(int)$dayDateCreated;
	        $timestampDateCreated = mktime(0,0,0,$monthDateCreated,$dayDateCreated,$yearDateCreated);
	        $dayWeekDateCreated = date("w",mktime(0,0,0,$monthDateCreated,$dayDateCreated,$yearDateCreated));
	        	
    		/***Fecha de liberación***/
	        if(($timetable['status'] == 2) || ($timetable['status'] == 3) || ($timetable['status'] == 4) || ($timetable['status'] == 6))
	        {
	    		$dateRelease = TimetableCatalog::getInstance()->getDateReleaseByIdTimetable($timetable['id_timetable']);
		    	list($dateRelease, $timeRelease) = explode(" ",$dateRelease);
	    			
		    	$dRelease = explode('-', $dateRelease);
		        $yearRelease = $dRelease[0];
		        $monthRelease = $dRelease[1];
		        $monthRelease=(string)(int)$monthRelease;
		        $dayRelease = $dRelease[2];
		        $dayRelease =(string)(int)$dayRelease;
		        $timestampDateRelease = mktime(0,0,0,$monthRelease,$dayRelease,$yearRelease);
	        }	
	        
	    	/***Fecha de aprobación***/
	        if(($timetable['status'] == 4) || ($timetable['status'] == 6))
	        {
		    	$dateApproval = TimetableCatalog::getInstance()->getDateApprovalByIdTimetable($timetable['id_timetable']);
		    	list($dateApproval, $timeApproval) = explode(" ",$dateApproval);
	
		    	$dApproval = explode('-', $dateApproval);
		        $yearApproval = $dApproval[0];
		        $monthApproval = $dApproval[1];
		        $monthApproval=(string)(int)$monthApproval;
		        $dayApproval = $dApproval[2];
		        $dayApproval =(string)(int)$dayApproval;
		        $timestampDateApproval = mktime(0,0,0,$monthApproval,$dayApproval,$yearApproval);
	        }
	    		
	    	/***Sumatoria de Horas***/
    		$sumHour = TimetableHourCatalog::getInstance()->getSumHoursByIdProject($timetable['id_timetable']);    			
    			
    		/***Fecha en que se debió liberar***/
    		if($dayWeekDateCreated != '5')
    			$mustDateRelease = date('Y-m-d H:i:s', strtotime('next Friday', strtotime($timetable['date'])));
    		else
    			$mustDateRelease = $timetable['date'];
    				
    		list($dateMustDateRelease, $timeMustDateRelease) = explode(" ",$mustDateRelease);
    			
    		$dMustRelease = explode('-', $dateMustDateRelease);
	        $yearMustRelease = $dMustRelease[0];
	        $monthMustRelease = $dMustRelease[1];
	        $monthMustRelease=(string)(int)$monthMustRelease;
	        $dayMustRelease = $dMustRelease[2];
	        $dayMustRelease =(string)(int)$dayMustRelease;
	        $timestampMustDateRelease = mktime(0,0,0,$monthMustRelease,$dayMustRelease,$yearMustRelease);	        		        		       
	        	
	        /****Datos según estatus****/
	        //Draft
	        if($timetable['status'] == 1)
	        {
	        	$status = "En Borrador";
	        	/***Días en el Status***/
	        	$daysStatus = ($timestampDateActually - $timestampDateCreated)/(60 * 60 * 24);
	        	/***Días trancurridos para Liberación***/
		        $daysRelease = 0;		        	
		        /***Días transcurridos para Aprobación***/
	    		$daysApproval = 0;
	    		/***Días en Proceso***/
	    		$daysProcess = 0;
	        }
    		//Released
	        if($timetable['status'] == 2)
	        {
	        	$status = "Liberada";
	        	/***Días en el Status***/
	        	$daysStatus = ($timestampDateActually - $timestampDateRelease)/(60 * 60 * 24);
	        	/***Días trancurridos para Liberación***/
		        $daysRelease = ($timestampDateRelease - $timestampMustDateRelease)/(60 * 60 * 24);		        	
		        /***Días transcurridos para Aprobación***/
	    		$daysApproval = 0;
	    		/***Días en Proceso***/
	    		$daysProcess = ($timestampDateActually - $timestampDateRelease)/(60 * 60 * 24);
	        }
    		//Rejected
	        if($timetable['status'] == 3)
	        {
	        	/***Fecha de rechazo***/
		    	$dateReject = TimetableCatalog::getInstance()->getDateRejectByIdTimetable($timetable['id_timetable']);
		    	list($dateReject, $timeReject) = explode(" ",$dateReject);
	
		    	$dReject = explode('-', $dateReject);
		        $yearReject = $dReject[0];
		        $monthReject = $dReject[1];
		        $monthReject=(string)(int)$monthReject;
		        $dayReject = $dReject[2];
		        $dayReject =(string)(int)$dayReject;
		        $timestampDateReject = mktime(0,0,0,$monthReject,$dayReject,$yearReject);
		        	
	        	$status = "Rechazada";
	        	/***Días en el Status***/
	        	$daysStatus = ($timestampDateActually - $timestampDateReject)/(60 * 60 * 24);
	        	/***Días trancurridos para Liberación***/
		        $daysRelease = ($timestampDateRelease - $timestampMustDateRelease)/(60 * 60 * 24);		        	
		        /***Días transcurridos para Aprobación***/
	    		$daysApproval = 0;
	    		/***Días en Proceso***/
	    		$daysProcess = ($timestampDateActually - $timestampDateRelease)/(60 * 60 * 24);
	        }
    		//Approved
	        if($timetable['status'] == 4)
	        {
	        	$status = "Aprobada";
	        	/***Días en el Status***/
	        	$daysStatus = 0;
	        	/***Días trancurridos para Liberación***/
		        $daysRelease = ($timestampDateRelease - $timestampMustDateRelease)/(60 * 60 * 24);		        	
		        /***Días transcurridos para Aprobación***/
	    		$daysApproval = ($timestampDateApproval - $timestampDateRelease)/(60 * 60 * 24);
	    		/***Días en Proceso***/
	    		$daysProcess = 0;
	        }
			//Process
			if($timetable['status'] == 6) 
			{
				$status = "En proceso";
	        	/***Días en el Status***/
	        	$daysStatus = ($timestampDateActually - $timestampDateApproval)/(60 * 60 * 24);
	        	/***Días trancurridos para Liberación***/
		        $daysRelease = 0;		        	
		        /***Días transcurridos para Aprobación***/
	    		$daysApproval = ($timestampDateApproval - $timestampDateRelease)/(60 * 60 * 24);
	    		/***Días en Proceso***/
	    		$daysProcess = 0;
			}       	        				
    		/*************************************************************************************************************************************************/
    			
    		/***Datos de Aprobadores***/
    		$approveLevel1 =ProjectCatalog::getInstance()->getApproverLevel1($timetable['id_project']);
    		$approveLevel2 =ProjectCatalog::getInstance()->getApproverLevel2($timetable['id_project']);
    		$approveLevel12 =ProjectCatalog::getInstance()->getApproverLevel12($timetable['id_project']);
    		$approveLevel22 =ProjectCatalog::getInstance()->getApproverLevel22($timetable['id_project']);
    		if($approveLevel1 != null)
    		{
	    		$approver1 = EmployeeCatalog::getInstance()->getById($approveLevel1);
	    		$usernameApprover1 = $approver1->getUsername();
	    		$personApprover1 = PersonCatalog::getInstance()->getById($approver1->getIdPerson());
	    		$nameApprover1 = $personApprover1->getName()." ".$personApprover1->getMiddleName()." ".$personApprover1->getLastName();	    			
    		}
    		if($approveLevel2 != null)
    		{
	    		$approver2 = EmployeeCatalog::getInstance()->getById($approveLevel2);
	    		$usernameApprover2 = $approver2->getUsername();
	    		$personApprover2 = PersonCatalog::getInstance()->getById($approver2->getIdPerson());
	    		$nameApprover2 = $personApprover2->getName()." ".$personApprover2->getMiddleName()." ".$personApprover2->getLastName();
    		}
    			
    		if (($approveLevel1 == $timetable['	id_current_approver']) || ($approveLevel12 == $timetable['	id_current_approver']))
    		{
    			if($timetable['status'] == 1)
	        	{
	    			$approved1 = " ";
	    			$approved2 = " ";
	        	}
    			if($timetable['status'] == 2)
	        	{
	    			$approved1 = " ";
	    			$approved2 = " ";
	        	}
    			if($timetable['status'] == 3)
	        	{
	    			$approved1 = "Rechazó";
	    			$approved2 = " ";
	        	}
    			if($timetable['status'] == 4)
	        	{
	    			$approved1 = "Aprobó";
	    			$approved2 = " ";
	        	}
    			if($timetable['status'] == 6)
	        	{
	    			$approved1 = "Aprobó";
	    			$approved2 = " ";
	        	}
    		}
    		else
    		{
    		if($timetable['status'] == 1)
	        	{
	    			$approved1 = " ";
	    			$approved2 = " ";
	        	}
    			if($timetable['status'] == 2)
	        	{
	    			$approved1 = " ";
	    			$approved2 = " ";
	        	}
    			if($timetable['status'] == 3)
	        	{
	    			$approved1 = " ";
    				$approved2 = "Rechazó";
	        	}
    			if($timetable['status'] == 4)
	        	{
	    			$approved1 = " ";
    				$approved2 = "Aprobó";
	        	}
	        	if($timetable['status'] == 6)
	        	{
	    			$approved1 = "Aprobó";
    				$approved2 = " ";
	        	}     			    			
    		}
    			
    		$export[] = array(
    			'Nro. Empleado' => $username,
    			'Nombre del Empleado' => $nameEmployee,
    			'Departamento' => $departmentEmployee,
    			'Inicio de Semana' => $dateweekBeginning,
    			'Fin de Semana' => $dateweekEnd,
    			'Proyecto' => $projectName,
    			'Horas' => $sumHour,
    			'Fecha de Creación' => $dateCreated,
    			'Hora de Creación' => $timeCreated,
    			'Creado por' => $username,
    			'Fecha Liberación' => $dateRelease,
    			'Hora Liberación' => $timeRelease,
    			'Status Planilla' => $status,
    			'Nro. de Días en el Estatus' => $daysStatus,
    			'Nro. de Días para Liberar' => $daysRelease,
    			'Nro. de Días para Aprobar' => $daysApproval,
    			'Nro. de Días en Proceso' => $daysProcess,
    			'Niv.1-Aprobador' => $usernameApprover1,
    			'Niv.1-Status' => $approved1,
    			'Niv.1-Fecha' => $dateApproval,
    			'Niv.1-Hora' => $timeApproval,
    			'Niv.2-Aprobador' => $usernameApprover2,
    			'Niv.2-Status' => $approved2,
    			'Niv.2-Fecha' => $dateApproval,
    			'Niv.2-Hora' => $timeApproval
    		);
    		$dateRelease = " ";
    		$timeRelease = " ";
    		$status = " ";
	        $daysStatus = " ";
		    $daysRelease = " ";
		    $daysApproval = " ";
		    $daysProcess = " ";
		    $dateApproval = " ";
		    $timeApproval = " ";
    	}
		return $export;
    }
}