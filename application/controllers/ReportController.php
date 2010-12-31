<?php

/**
 * Dependences
 */

require_once "lib/managers/ReportManager.php";


class ReportController extends Zend_Controller_Action
{
    public function reportBaanWeekAction(){
    	$params['date']=$this->getRequest()->getParam("date",date("Y-m-d"));
    	$report=new ReportManager();
    	$data=$report->getBannReportWeek($params);
    	print_r($data);
    	exit(0);
    }
    
    public function reportBaanDayAction(){
    	$params['starting']=$this->getRequest()->getParam("start","00:00");
    	$params['ending']=$this->getRequest()->getParam("end","12:00");
    	
    	$report=new ReportManager();
    	$data=$report->getBannReportDay($params);
    	exit(0);
    }
    
    public function missingTimetablesAction()
    {
	
	$this->view->setTpl('Missing-timetables');
	$idDepartments = DepartmentCatalog::getInstance()->retrieveAllIds();
	foreach ($idDepartments as $idDept)
	{
		$department = DepartmentCatalog::getInstance()->getById($idDept);
		$departmentName = $department->getDepartmentName();
		$departments[] = array ('idDept' => $idDept, 'name' => $departmentName);
	}
	$this->view->departments = $departments;
    }

    
    public function missingAction()
    {
	require_once 'excel/ExcelExt.php';
	$params['startDate'] = $this->getRequest()->getParam('startDate');
	$params['endDate'] = $this->getRequest()->getParam('endDate');
	$params['idEmp'] = $this->getRequest()->getParam('idEmp');
	$params['idDepartment'] = $this->getRequest()->getParam('idDept');
	
	$report = new ReportManager();
	$export = $report->getMissing($params);
	
	if(empty($export))
	{
	    print("No data Found");
	    die();
	}
    	$dateExport = str_replace(":","",str_replace("-","",str_replace(" ","",date("Y-m-d H:i"))));
       	$excel=ExcelExt::createExcel("PlanillasFaltantes".$dateExport.".xls", $export);
       	exit(0);
    }

}