<?php

/**
 * Clase para la lógica de reportes
 *
 * @category   reports
 * @package    managers/reports
 * @copyright  ##$COPYRIGHT$##
 */

require_once "application/models/catalogs/TimetableCatalog.php";
require_once "application/models/catalogs/DepartmentCatalog.php";
require_once "application/models/catalogs/EmployeeCatalog.php";
require_once "application/models/catalogs/ProjectCatalog.php";
require_once "application/models/catalogs/ProjectTaskCatalog.php";
require_once "application/models/catalogs/SpecificProjectCatalog.php";
require_once "application/models/catalogs/DepartmentProjectCatalog.php";
require_once "application/models/catalogs/TimetableHourCatalog.php";

class ReportManager {
	private $file_path="./data/update/";
	private $file_name=NULL;
	private $file_handler=null;
	
	public function __construct(){
		$this->file_name="baan-".date("Y-m-d_Gi").".txt";
	}
	
	public function getBannReportWeek($params=null,$target="file")
	{
		$timetable_row=null;
		list($date_year,$date_month,$date_day)=explode("-",$params['date']);
    	$date=mktime(0,0,0,$date_month,$date_day,$date_year);
    	$date_start=date("N",$date)!=1?date("Y-m-d",strtotime("previous Monday",$date)):date("Y-m-d",$date);
		$date_end=date("N",$date)!=7?date("Y-m-d",strtotime("next Sunday",$date)):date("Y-m-d",$date);
		
    	$TimetableCollection=TimetableCatalog::getInstance()->getTimetablesBetweenDate($date_start,$date_end);
    	
    	$report=array();
    	
    	$ids_employees=array();
    	$ids_timetable=array();
    	$ids_project=array();
    	$ids_project_task=array();
    	$ids_department=array();
    	
    	$ids_users=array();
    	
    	if(count($TimetableCollection)){
	    	foreach ($TimetableCollection as $rttc=>$ttc){
	    		$ids_employees[]=$ttc->getIdEmployee();
	    		$ids_timetable[]=$ttc->getIdTimeTable();
		    	$ids_project[]=$ttc->getIdProject();
		    	$ids_project_task[]=$ttc->getIdProjectTask();
	    	}
	    	
	    	$employeeCollection = EmployeeCatalog::getInstance()->getByIds($ids_employees);
	    	$projectCollection=ProjectCatalog::getInstance()->getByIds($ids_project);
	    	$projectTaskCollection=ProjectTaskCatalog::getInstance()->getByIds($ids_project_task);
	    	$specificProjectCollection=SpecificProjectCatalog::getInstance()->getByIds($ids_project);
	    	$departmentProjectCollection=DepartmentProjectCatalog::getInstance()->getByIds($ids_project);
	    		
	    	foreach($employeeCollection as $employee)
	    		$id_users[]=$employee->getIdUser();
	    	
	    	$userCollection=UserCatalog::getInstance()->getByIds($id_users);
	    	
	    	foreach ($TimetableCollection as $ttc) {
	    		
	    		$timetable_row[]=array(
	    				'employee_code'=>self::valueBySubIndex($userCollection, array('IdUser'=>self::valueBySubIndex($employeeCollection, array('IdEmployee'=>$ttc->getIdEmployee()), "IdUser")), "Username"),
	    				'date'=>substr($ttc->getDate(), 0,10),
	    				'project_code'=>self::valueBySubIndex($specificProjectCollection, array('IdProject'=>$ttc->getIdProject()),"ProjectCode"),	//Specific Project
	    				'activity_code'=>self::valueBySubIndex($specificProjectCollection, array('IdProject'=>$ttc->getIdProject()),"ProjectCode")?self::valueBySubIndex($projectTaskCollection, array('IdProjectTask'=>$ttc->getIdProjectTask()),"TaskCode"):null, //Specific Project
	    				'department_code'=>self::valueBySubIndex($departmentProjectCollection, array('IdProject'=>$ttc->getIdProject()),"ProjectCode"), //Department Project
	    				'task_code'=>self::valueBySubIndex($departmentProjectCollection, array('IdProject'=>$ttc->getIdProject()),"ProjectCode")?self::valueBySubIndex($projectTaskCollection, array('IdProjectTask'=>$ttc->getIdProjectTask()),"TaskCode"):null, //Department Project
	    				'description'=>$ttc->getDescription(),
	    				'hours'=>TimetableHourCatalog::getInstance()->getSumHoursByIdProject($ttc->getIdTimetable()),
	    				'text_day'=>'',
	    			);
	    	}
    	}
    	return $timetable_row;
	}
	
	public static function getBannReportDay($params=null){
		$starting=$params['starting'];
		$ending=$params['ending'];

		$TimetableCollection=TimetableCatalog::getInstance()->getTimetablesBetweenHours($starting,$ending);
    	
    	$report=array();
    	
    	$ids_employees=array();
    	$ids_timetable=array();
    	$ids_project=array();
    	$ids_project_task=array();
    	$ids_department=array();
    	
    	$ids_users=array();
    	
    	if(count($TimetableCollection)){
	    	foreach ($TimetableCollection as $rttc=>$ttc){
	    		$ids_employees[]=$ttc->getIdEmployee();
	    		$ids_timetable[]=$ttc->getIdTimeTable();
		    	$ids_project[]=$ttc->getIdProject();
		    	$ids_project_task[]=$ttc->getIdProjectTask();
	    	}
	    	
	    	$employeeCollection = EmployeeCatalog::getInstance()->getByIds($ids_employees);
	    	$projectCollection=ProjectCatalog::getInstance()->getByIds($ids_project);
	    	$projectTaskCollection=ProjectTaskCatalog::getInstance()->getByIds($ids_project_task);
	    	$specificProjectCollection=SpecificProjectCatalog::getInstance()->getByIds($ids_project);
	    	$departmentProjectCollection=DepartmentProjectCatalog::getInstance()->getByIds($ids_project);
	    		
	    	foreach($employeeCollection as $employee)
	    		$id_users[]=$employee->getIdUser();
	    	
	    	$userCollection=UserCatalog::getInstance()->getByIds($id_users);
	    	
	    	foreach ($TimetableCollection as $ttc) {
	    		
	    		$timetable_row=array(
	    				'employee_code'=>self::valueBySubIndex($userCollection, array('IdUser'=>self::valueBySubIndex($employeeCollection, array('IdEmployee'=>$ttc->getIdEmployee()), "IdUser")), "Username"),
	    				'date'=>substr($ttc->getDate(), 0,10),
	    				'project_code'=>self::valueBySubIndex($specificProjectCollection, array('IdProject'=>$ttc->getIdProject()),"ProjectCode"),	//Specific Project
	    				'activity_code'=>self::valueBySubIndex($specificProjectCollection, array('IdProject'=>$ttc->getIdProject()),"ProjectCode")?self::valueBySubIndex($projectTaskCollection, array('IdProjectTask'=>$ttc->getIdProjectTask()),"TaskCode"):null, //Specific Project
	    				'department_code'=>self::valueBySubIndex($departmentProjectCollection, array('IdProject'=>$ttc->getIdProject()),"ProjectCode"), //Department Project
	    				'task_code'=>self::valueBySubIndex($departmentProjectCollection, array('IdProject'=>$ttc->getIdProject()),"ProjectCode")?self::valueBySubIndex($projectTaskCollection, array('IdProjectTask'=>$ttc->getIdProjectTask()),"TaskCode"):null, //Department Project
	    				'description'=>$ttc->getDescription(),
	    				'hours'=>TimetableHourCatalog::getInstance()->getSumHoursByIdProject($ttc->getIdTimetable()),
	    				'text_day'=>'',
	    			);
	    			print_r($timetable_row);
	    		$this->_store(implode("|", $timetable_row));
	    	}
    	}
    	
		echo count($TimetableCollection)>0?"1":"0";
	}
	
	/*
	 Report to get planillas faltantes
	*/
	
	public function getMissing($params=null)
	{
		
		$startDate = $params['startDate'];
		$endDate = $params['endDate'];
		$idEmp = $params['idEmp'];
		$idDepartment = $params['idDepartment'];
		$export = array();
		if (!$startDate)
		{
			$startWeek = mktime();
			while(date("w",$startWeek)!=1)
			{
				$startWeek -= 3600;
			}
			$startDate = date("Y-m-d",$startWeek);
		}
		else
			$startDate = date('Y-m-d', strtotime($startDate));
		if (!$endDate)
		{
			$endWeek = mktime();
			while(date("w",$endWeek)!=0)
			{
				$endWeek += 3600;
			}
			$endDate = date("Y-m-d",$endWeek);
		}
		else
			$endDate = date('Y-m-d', strtotime($endDate));
		
		$timetables = TimetableCatalog::getInstance()->getTimeTablesGeneralByDate($startDate, $endDate);
		if(is_numeric($idEmp))
		{
			$timetablesByEmp = TimeTableCatalog::getInstance()->getByIdEmployee($idEmp)->toarray();
			$timetablesByEmp = array_intersect($timetables, $timetablesByEmp);
			if(empty($timetablesByEmp))
			{
				$employee = EmployeeCatalog::getInstance()->getById($idEmp);
				$username = $employee->getUsername();	
				$person = PersonCatalog::getInstance()->getById($employee->getIdPerson());
				$nameEmployee = $person->getName()." ".$person->getMiddleName()." ".$person->getLastName();
				$department = DepartmentCatalog::getInstance()->getById($employee->getIdDepartment());
				$departmentEmployee = $department->getDepartmentCode();
				$export[] = array(
				    "ID Empleado" => $username,
				    "Nombre Empleaso" => $nameEmployee,
				    "Departamento" => $departmentEmployee
				);
	
			}
			else
			{
				print("Employee has submitted task for that period");
				die();
			}
		}
		else
		{
			$idEmployees = is_numeric($idDepartment) ?
				EmployeeCatalog::getInstance()->getIdsByDepartment($idDepartment) :
				EmployeeCatalog::getInstance()->retrieveAllIds();
			if (!empty($timetables)){
				foreach($timetables as $timetable)
					$submitedEmployees[] = $timetable['id_employee'];
				$idEmployees = array_diff($idEmployees, $submitedEmployees);
			}
			
			foreach ($idEmployees as $idEmployee)
			{
				//Employee information
				$employee = EmployeeCatalog::getInstance()->getById($idEmployee);
				$username = $employee->getUsername();	
				$person = PersonCatalog::getInstance()->getById($employee->getIdPerson());
				$nameEmployee = $person->getName()." ".$person->getMiddleName()." ".$person->getLastName();
				$department = DepartmentCatalog::getInstance()->getById($employee->getIdDepartment());
				$departmentEmployee = $department->getDepartmentCode();
				$export[] = array(
				    "ID Empleado" => $username,
				    "Nombre Empleaso" => $nameEmployee,
				    "Departamento" => $departmentEmployee
				);
			}	
		}
		return $export;
	}
	
	
	private function _display($string){
		printf($string);
	}
	
	private function _store($string){
		if(!$this->file_handler)
			$this->_open("w");
		try{
			fwrite($this->file_handler, $string,strlen($string));
		}catch (Exception $e){
			throw new Exception("Error al escribir en el archivo [{$this->file_path}{$this->file_name}]");
		}
	}
	
	/**
	 * 
	 * Inicializa el handler para el archivo de reporte a generar
	 * @param string $mode modo de apertura del archivo w,x,r,a...
	 * @access private
	 */
	private function _open($mode="w"){
		$this->file_handler=fopen($this->file_path.$this->file_name, $mode);
		
		if(!$this->file_handler)
			throw new Exception("Error al abrir el archivo de reporte [{$this->file_path}{$this->file_name}]");
	}
	
	/**
	 * 
	 * Revisa si ya existe un archivo creado ese día, hora o mes
	 * @param string $date_pattern 'Y-mm[-dd[ hh]]]'
	 * @access private
	 * @return bool
	 */
	private function _exists($date_pattern){
		$files=glob($this->file_path."baan-".$date_pattern."*");
		return count($files)>0;
	}
	
	/**
	 * 
	 * Cierra el handler del archivo de reporte
	 * @throws Exception
	 * @access private
	 */
	private function _close(){
		if($this->file_handler)
			fclose($this->file_handler);
		else
			throw new Exception("No se ha inicializado el archivo [{$this->file_path}{$this->file_name}]");
	}
	
	private static function valueBySubIndex($array,$subindex_pair,$index_result){
		$result=null;
		if(count($array))
		foreach($array as $r){
			$class_methods=get_class_methods($r);
			if(in_array("get".key($subindex_pair), $class_methods) && in_array("get".$index_result, $class_methods)){
				$result=$r->{"get".$index_result}();
				break;
			}else 
				throw new Exception("Los indices no son válidos");
		}
		return $result;
	}
}