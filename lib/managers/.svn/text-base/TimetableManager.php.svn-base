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
require_once "application/models/catalogs/SpecificProjectCatalog.php";
require_once "application/models/catalogs/ProjectTaskCatalog.php";
require_once "application/models/catalogs/TimetableCatalog.php";
require_once "application/models/catalogs/TimetableLogCatalog.php";
require_once "application/models/catalogs/TimetableLogApproverCatalog.php";
require_once "application/models/catalogs/TimetableLogStatusesCatalog.php";
require_once "application/models/catalogs/TimetableHourCatalog.php";
require_once "application/models/catalogs/ProjectApproversListCatalog.php";
require_once "application/models/catalogs/DepartmentProjectCatalog.php";
require_once "lib/managers/CalendarDayManager.php";
require_once "application/models/catalogs/CalendarDayCatalog.php";

/**
 * Clase abstracta de la que extenderan nuestros controladores, para agrupar instrucciones comunes
 *
 * @category   project
 * @package    Project_Controllers
 * @copyright  ##$COPYRIGHT$##
 */
class TimetableManager {
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
    protected function TimetableManager() {
        $this->timetableCatalog = TimetableCatalog::getInstance();
    }

    /**
     * Singleton Obtiene una instancia
     * @return TimetableManager
     */
    public static function getInstance() {
        if (!isset(self::$instance)) {
            self::$instance = new TimetableManager();
        }
        return self::$instance;
    }

    /**
     * Creates TimetableHour
     * @param array_iterator $rows
     * @param String $beginningWeekDate
     * @param int $idEmployee
     * @return String Json
     * @throws ManagerException
     * @author Arturo
     */
    public function createTimetable($idEmployee, $beginningWeekDate, $status,$rowsLocal=array(),$rowsDb=array()) {
        $date=new Zend_Date($beginningWeekDate, "d/MM/YYYY");
        $days=array("monday"=>$date->toString("YYYY-MM-dd"),"tuesday"=>$date->addDay(1)->toString("YYYY-MM-dd"),"wednesday"=>$date->addDay(1)->toString("YYYY-MM-dd"),"thursday"=>$date->addDay(1)->toString("YYYY-MM-dd"),"friday"=>$date->addDay(1)->toString("YYYY-MM-dd"),"saturday"=>$date->addDay(1)->toString("YYYY-MM-dd"),"sunday"=>$date->addDay(1)->toString("YYYY-MM-dd"));
//        $days_backwards=array_flip($days);
//        print_r($rows_local);
//        die();
        try {
            $formatted_date = New Zend_Date($beginningWeekDate, "YYYY-M-d H:mm:ss");
            $now = new Zend_Date();
            $this->timetableCatalog->beginTransaction();
            foreach($rowsLocal as $row){
                $idProject_type=explode("_",$row["id_project"]);
                $row["id_project"]=$idProject_type["1"];
                $row["type"]=$idProject_type["0"];
                $approverLevel1=ProjectCatalog::getInstance()->getApproverLevel1($row["id_project"]);
                $approverLevel2=ProjectCatalog::getInstance()->getApproverLevel2($row["id_project"]);
                //die(print_r($approvers));
                $timetable = TimetableFactory::create($idEmployee,$row["id_project"],$row["id_project_task"], $approverLevel1, $approverLevel2, $approverLevel1,$row["description"],$row["attendance_type"] ,$formatted_date->get('YYYY-MM-dd'),$status);

                //var_dump($timetable);
                $this->timetableCatalog->create($timetable);

                $timetableLog=TimetableLogFactory::create($timetable->getIdTimetable(), $now->get('YYYY-MM-dd HH:mm:ss'), $idEmployee, TimetableLog::$Type["create"]);
                TimetableLogCatalog::getInstance()->create($timetableLog);
                foreach($days as $day=>$dayDate){
                    if($row[$day]){
                        $timetableHour = TimetableHourFactory::create($timetable->getIdTimetable(),$dayDate, $row[$day], $now->get('YYYY-MM-dd HH:mm:ss'), $now->get('YYYY-MM-dd HH:mm:ss'));
                        TimetableHourCatalog::getInstance()->create($timetableHour);
                        
                        //echo $day;
                    }
                    
                }
                $timetable->setIdTimetable(null);
            }
            foreach($rowsDb as $row){
                $idProject_type = explode("_", $row["id_project"]);
                $row["id_project"] = $idProject_type["1"];

                $timetable=$this->timetableCatalog->getById($row["id_timetable"]);
                $timetable->setDescription($row["description"]);
                $timetable->setIdProject($row["id_project"]);
                $timetable->setIdProjectTask($row["id_projcet_task"]);
                $timetable->setAttendanceType($row["attendance_type"]);
                $this->timetableCatalog->update($timetable);

                foreach($days as $day=>$dayDate){

                    $criteria=new Criteria();
                    $criteria->add(TimetableHour::ID_TIMETABLE, $row["id_timetable"], Criteria::EQUAL);
                    $criteria->add(TimetableHour::RECORD_DATE, $dayDate, Criteria::EQUAL);

                    $timetableHour=TimetableHourCatalog::getInstance()->getByCriteria($criteria)->getOne();

                    if(!$timetableHour && $row[$day]>0){
                        $timetableHour = TimetableHourFactory::create( $row["id_timetable"], $dayDate, $row[$day], $now->get('YYYY-MM-dd HH:mm:ss'), $now->get('YYYY-MM-dd HH:mm:ss'));
                        TimetableHourCatalog::getInstance()->create($timetableHour);
                    }
                    else if($timetableHour){
                        if($row[$day]==0)
                            TimetableHourCatalog::getInstance()->delete($timetableHour);
                        else{
                            $timetableHour->setHours($row[$day]);
                            $timetableHour->setTimestamp($now->get('YYYY-MM-dd HH:mm:ss'));
                            TimetableHourCatalog::getInstance()->update($timetableHour);
                        }
                    }
                }
            }
            $this->timetableCatalog->commitTransaction();
            return array("ok" => "ok");
        } catch (Exception $e) {
            $this->timetableCatalog->rollbackTransaction();
            return array("error" => $e->getMessage());
        }
    }

    /**
     * Releases Timetable
     * @param array_iterator $timeTableHour
     * @return String Json
     * @throws ManagerException
     * @author Arturo
     */
    public function releaseTimetable($rowsDb, $idEmployee) {
        try {
            $now = new Zend_Date();
            $this->timetableCatalog->beginTransaction();
            foreach ($rowsDb as $row){
                $timetable=$this->timetableCatalog->getById($row["id_timetable"]);
                $timetable->setStatus(Timetable::$Status["released"]);
                if($timetable){
                    $this->timetableCatalog->update($timetable);
                    $timetableLogStatuses=TimetableLogStatusesFactory::create(Timetable::$Status["released"], $timetable->getIdTimetable(), $now->get('YYYY-MM-dd HH:mm:ss'), $idEmployee, TimetableLog::$Type["status"]);
                    TimetableLogStatusesCatalog::getInstance()->create($timetableLogStatuses);
                }
            }
            $this->timetableCatalog->commitTransaction();
            return array("ok" => "ok");
        } catch (Exception $e) {
            $this->timetableCatalog->rollbackTransaction();
            return array("error" => $e->getMessage());
        }
    }

    /**
     * Delete Timetable
     * @param array_iterator $rowsDb
     * @return array_iterator
     * @throws ManagerException
     * @author Arturo
     */
    public function deleteTimetable($rowsDb) {
        try {
            $now = new Zend_Date();
            $this->timetableCatalog->beginTransaction();
            foreach ($rowsDb as $row){
                $timetable=$this->timetableCatalog->getById($row["id_timetable"]);
                if($timetable){
                    $this->timetableCatalog->delete($timetable);
                }
            }
            $this->timetableCatalog->commitTransaction();
            return array("ok" => "ok");
        } catch (Exception $e) {
            $this->timetableCatalog->rollbackTransaction();
            return array("error" => $e->getMessage());
        }
    }

    /**
     * Delete Timetable
     * @param array_iterator $rowsDb
     * @param int $idEmployee
     * @return array_iterator
     * @throws ManagerException
     * @author Arturo
     */
    public function approveTimetable($rowsDb, $idEmployee) {
        try {
            $now = new Zend_Date();
            $this->timetableCatalog->beginTransaction();
            
            foreach ($rowsDb as $row){

                $timetable=$this->timetableCatalog->getById($row);
                $approver1=$timetable->getIdApprover1();
                $approver2=$timetable->getIdApprover2();

                if($idEmployee!=$approver1&&$idEmployee!=$approver2){
                    if($timetable->getStatus()==Timetable::$Status["released"]){
                        $approver1=ProjectCatalog::getInstance()->getApproverLevel12($timetable->getIdProject());
                    }else if($timetable->getStatus()==Timetable::$Status["released"]){
                        $approver2=ProjectCatalog::getInstance()->getApproverLevel22($timetable->getIdProject());
                    }
                }

                if(($idEmployee == $approver1 && $approver2 == null) || $idEmployee == $approver2) {
                    $timetable->setStatus(Timetable::$Status["approved"]);
                    $this->timetableCatalog->update($timetable);

                    $timetableLogStatuses = TimetableLogStatusesFactory::create(Timetable::$Status["approved"], $timetable->getIdTimetable(), $now->get('YYYY-MM-dd HH:mm:ss'), $idEmployee, TimetableLog::$Type["status"]);
                    TimetableLogStatusesCatalog::getInstance()->create($timetableLogStatuses);
                } else {
                    $timetableLogApprover = TimetableLogApproverFactory::create($timetable->getIdApprover2(), $timetable->getIdCurrentApprover(), $timetable->getIdTimetable(), $now->get('YYYY-MM-dd HH:mm:ss'), $idEmployee, TimetableLog::$Type["approver"]);

                    $timetable->setStatus(Timetable::$Status["process"]);
                    $timetable->setIdCurrentApprover($timetable->getIdApprover2());
                    $this->timetableCatalog->update($timetable);

                    TimetableLogApproverCatalog::getInstance()->create($timetableLogApprover);

                    $timetableLogStatuses = TimetableLogStatusesFactory::create(Timetable::$Status["process"], $timetable->getIdTimetable(), $now->get('YYYY-MM-dd HH:mm:ss'), $idEmployee, TimetableLog::$Type["status"]);
                    TimetableLogStatusesCatalog::getInstance()->create($timetableLogStatuses);
                }
            }
            $this->timetableCatalog->commitTransaction();
            return array("ok" => "ok");
        } catch (Exception $e) {
            $this->timetableCatalog->rollbackTransaction();
            return array("error" => $e->getMessage());
        }
    }

//    /**
//     * Updates TimetableHour
//     * @param array_iterator $data
//     * @param Employee $employee
//     * @return String Json
//     * @throws ManagerException
//     * @author Arturo
//     */
//    public function updateTimetableHour($data, $employee) {
//        $db_errors = null;
//        //die (print_r($data));
//        try {
//            $formatted_date = New Zend_Date($data["date"], "YYYY-M-d H:mm:ss");
//            $criteria = new Criteria();
//            $criteria->add(Timetable::DATE, $formatted_date->get('YYYY-MM-dd'), Criteria::EQUAL);
//            $timetable = TimetableCatalog::getInstance()->getByCriteria($criteria)->getOne();
//            $this->timetableCatalog->beginTransaction();
//            if (!$timetable) {
//
//                $timetable = TimetableFactory::create($employee->getIdEmployee(), $formatted_date->get('YYYY-MM-dd'), null, null, null, Timetable::$Status["draft"]);
//                //die(var_dump($timetable));
//                TimetableCatalog::getInstance ()->create($timetable);
//            }
//            $now = new Zend_Date();
//            $timetableHour = TimetableHourCatalog::getInstance()->getById($data["id"]);
//            $currentTimetable = $timetableHour->getIdTimetable();
//            $timetableHour->setIdTimetable($timetable->getIdTimetable());
//            $timetableHour->setRecordDate($formatted_date->get('YYYY-MM-dd HH:mm:ss'));
//            $timetableHour->setHours($data["hours"]);
//            TimetableHourCatalog::getInstance()->update($timetableHour);
//            if (!TimetableHourCatalog::getInstance()->checkHours($currentTimetable))
//                $this->timetableCatalog->deleteById($currentTimetable);
//            $this->timetableCatalog->commitTransaction();
//            return json_encode(array("ok" => "ok", "id" => $timetableHour->getIdTimetableHour()));
//        } catch (Exception $e) {
//            //echo($e->getMessage());
//            $this->timetableCatalog->rollbackTransaction();
//            return json_encode(array("error" => $e->getMessage()));
//        }
//    }

    

    /**
     * Releases Timetable
     * @param Int $isEmployee
     * @return String Json
     * @throws ManagerException
     * @author Arturo
     */
    public function checkTimetableByEmployee($idEmployee) {
        $calendarDays = CalendarDayManager::getInstance ()->getWeekDaysByEmployee($idEmployee);
        $criteria = new Criteria();
        $dayWOTimetable = array();
        $date = new Zend_date();
        foreach ($calendarDays as $calendarDay) {
            $criteria->add(Timetable::DATE, $calendarDay, Criteria::EQUAL);
            $timetable = $this->timetableCatalog->getByCriteria($criteria)->getOne();
            if (!$timetable) {
                $dayWOTimetable[$calendarDay] = $date->setDate($calendarDay, "YYYY-MM-dd")->toString("d 'de' MMMM 'de' YYYY");
            }
            $criteria->remove(Timetable::DATE);
        }
        //die(print_r($dayWOTimetable));
        return $dayWOTimetable;
    }

    public function getTimetablesHours($idEmployee, $beginningWeekDate){
        $timetables=TimetableHourCatalog::getInstance()->getHours($idEmployee,$beginningWeekDate);
        $digested_timetables=array();
        $days=array("monday"=>0,"tuesday"=>0,"wednesday"=>0,"thursday"=>0,"friday"=>0,"saturday"=>0,"sunday"=>0);

        if(!empty ($timetables)){
            $current_timetable=null;
            foreach ($timetables as $timetable){
                if(!$current_timetable || $current_timetable!=$timetable["id_timetable"]){
                    $digested_timetables[$timetable["id_timetable"]]=array_merge($timetable,$days);
                    $digested_timetables[$timetable["id_timetable"]]["status"]=  Timetable::$StatusLabel[$digested_timetables[$timetable["id_timetable"]]["status"]];
                    $digested_timetables[$timetable["id_timetable"]]["attendance_label"]=  utf8_encode(Timetable::$AttendanceTypeLabel[$digested_timetables[$timetable["id_timetable"]]["attendance_type"]]);
                    //die(Timetable::$AttendanceTypeLabel[5]);
                    $digested_timetables[$timetable["id_timetable"]][strtolower($timetable["day"])]=$timetable["hours"];
                    $digested_timetables[$timetable["id_timetable"]]["hours"]=$timetable["hours"];
                    //echo $digested_timetables["hours"];
                }else
                    if($current_timetable==$timetable["id_timetable"]){
                        $digested_timetables[$timetable["id_timetable"]][strtolower($timetable["day"])]=$timetable["hours"];
                        $digested_timetables[$timetable["id_timetable"]]["hours"]+=$timetable["hours"];
                        //echo $digested_timetables["hours"];
                    }
                $current_timetable=$timetable["id_timetable"];
            }
        }
        //die(print_r($digested_timetables));
        $i=0;
        foreach($digested_timetables as $row){
        	$rows[$i]['id']=$i;
        	$rows[$i]['cell']=array($row["id_timetable"],$row["id_project"],$row["project_code"],$row["id_project_task"],$row["task_code"],$row["description"],$row["attendance_label"],$row["attendance_type"],$row["monday"],$row["tuesday"], $row["wednesday"],$row["thursday"],$row["friday"],$row["saturday"],$row["sunday"],$row["hours"],$row["status"]);
        	$i++;
        }
        if(!empty($rows))
        	$response["rows"]=$rows;
        return $response;
    }

    public function getEmployeesTimetables($idEmployee,$startDate,$endDate){
        $count = 0;
        $timetables = $this->timetableCatalog->getTimeTablesGeneralByDate($idEmployee, $startDate);
        foreach ($timetables as $timetable) {
            /*             * *Employee Data** */
            $idTimetable=$timetable['id_timetable'];
            $employee = EmployeeCatalog::getInstance()->getById($timetable['id_employee']);
            $username = $employee->getUsername();
            $person = PersonCatalog::getInstance()->getById($employee->getIdPerson());
            $employeeName = $person->getName() . " " . $person->getMiddleName() . " " . $person->getLastName();

            /*             * *Week** */
            $week = $startDate . " -- " . $endDate;

            $attendance = utf8_encode(Timetable::$AttendanceTypeLabel[$timetable['attendance_type']]);

            /*             * *Project Data** */
            $specificProject = SpecificProjectCatalog::getInstance()->getByIdProjectObject($timetable['id_project']);
            if ($specificProject == null) {
                $departmentProject = DepartmentProjectCatalog::getInstance()->getByIdProjectObject($timetable['id_project']);
                $department = DepartmentCatalog::getInstance()->getById($departmentProject->getIdDepartment());
                $projectName = $department->getDepartmentCode();
                $idProject= $departmentProject->getIdProject();
            }
            else{
                $projectName = $specificProject->getProjectCode();
                $idProject=$specificProject->getIdProject();
            }

            $task=ProjectTaskCatalog::getInstance()->getById($timetable["id_project_task"]);
            $task_code = $task->getTaskCode();

            /*             * *Type Home** */

            $home = $this->timetableCatalog->getTypeHome($timetable['id_timetable']);
            if ($home == 1) {
                $origen = "<img src='../images/template/icons/link.png'>";
            }
            if ($home == 2) {
                $origen = "<img src='../images/template/icons/arrow_up.png'>";
            }
            if ($home == 3) {
                $origen = "<img src='../images/template/icons/arrow_right.png'>";
            }
            if ($home == 4) {
                $origen = "<img src='../images/template/icons/arrow_undo.png'>";
            }

            /*             * *Hours Sum by IdProjectTask** */
            $sumHour = TimetableHourCatalog::getInstance()->getSumHoursByIdProjectTask($timetable['id_timetable']);

            /*             * *Hours Day** */
            $dayHours = TimetableHourCatalog::getInstance()->getDayHoursByIdProjectTask($timetable['id_timetable']);
            foreach ($dayHours as $dayHour) {
                list($dateCreated, $timeCreated) = explode(" ", $dayHour['record_date']);
                $dDateCreated = explode('-', $dateCreated);
                $yearDateCreated = $dDateCreated[0];
                $monthDateCreated = $dDateCreated[1];
                $monthDateCreated = (string) (int) $monthDateCreated;
                $dayDateCreated = $dDateCreated[2];
                $dayDateCreated = (string) (int) $dayDateCreated;
                $dayWeek = date("w", mktime(0, 0, 0, $monthDateCreated, $dayDateCreated, $yearDateCreated));

                if ($dayWeek == '1') {
                    $m = $dayHour['hours'];
                }
                if ($dayWeek == '2') {
                    $tu = $dayHour['hours'];
                }
                if ($dayWeek == '3') {
                    $w = $dayHour['hours'];
                }
                if ($dayWeek == '4') {
                    $th = $dayHour['hours'];
                }
                if ($dayWeek == '5') {
                    $f = $dayHour['hours'];
                }
                if ($dayWeek == '6') {
                    $sa = $dayHour['hours'];
                }
                if ($dayWeek == '0') {
                    $su = $dayHour['hours'];
                }
            }
            $a[$count]["id"] = $count;
            $a[$count]['cell'] = array(
                $idTimetable,
                $employeeName,
                $week,
                $attendance,
                $projectName,
                $task_code,
                $m,
                $tu,
                $w,
                $th,
                $f,
                $sa,
                $su,
                $sumHour,
                $origen
            );
            $count++;
            $m = " ";
            $tu = " ";
            $w = " ";
            $th = " ";
            $f = " ";
            $sa = " ";
            $su = " ";
            $origen = " ";
        }
        $tasks["rows"] = $a;
        return json_encode($tasks);
    }

}
