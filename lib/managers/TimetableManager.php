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
require_once "application/models/catalogs/TimetableCatalog.php";
require_once "application/models/catalogs/TimetableLogCatalog.php";
require_once "application/models/catalogs/TimetableHourCatalog.php";
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
    public function createTimetable($rows,$beginningWeekDate, $idEmployee) {
        $date=new Zend_Date($beginningWeekDate, "d/MM/YYYY");
        $days=array("monday"=>$date->toString("YYYY-MM-dd"),"tuesday"=>$date->addDay(1)->toString("YYYY-MM-dd"),"wednesday"=>$date->addDay(1)->toString("YYYY-MM-dd"),"thursday"=>$date->addDay(1)->toString("YYYY-MM-dd"),"friday"=>$date->addDay(1)->toString("YYYY-MM-dd"),"saturday"=>$date->addDay(1)->toString("YYYY-MM-dd"),"sunday"=>$date->addDay(1)->toString("YYYY-MM-dd"));

        try {
            $formatted_date = New Zend_Date($beginningWeekDate, "YYYY-M-d H:mm:ss");

            $this->timetableCatalog->beginTransaction();
            foreach($rows as $row){
                
                $timetable = TimetableFactory::create($idEmployee, $formatted_date->get('YYYY-MM-dd'), null, null, null,$row["attendance_type"] ,Timetable::$Status["draft"]);
                TimetableCatalog::getInstance ()->create($timetable);
                //var_dump($timetable);
                $idProject_type=explode("_",$row["id_project"]);
                $row["id_project"]=$idProject_type["1"];
                $row["type"]=$idProject_type["0"];
                $now = new Zend_Date();

                $timetableLog=TimetableLogFactory::create($timetable->getIdTimetable(), $now->get('YYYY-MM-dd HH:mm:ss'), $idEmployee, TimetableLog::$Type["create"]);
                TimetableLogCatalog::getInstance()->create($timetableLog);
                foreach($days as $day=>$dayDate){
                    if($row[$day]){
                        $timetableHour = TimetableHourFactory::create($timetable->getIdTimetable(), $row["id_project_task"], $row["id_project"],$dayDate, $row["description"], $row[$day], $now->get('YYYY-MM-dd HH:mm:ss'), $now->get('YYYY-MM-dd HH:mm:ss'), TimetableHour::$Status["draft"], $row["type"]);
                        //var_dump($timetableHour);
                        TimetableHourCatalog::getInstance()->create($timetableHour);
                        //echo $day;
                    }
                }
                $timetable->setIdTimetable(null);
            }
            $this->timetableCatalog->commitTransaction();
            return json_encode(array("ok" => "ok"));
        } catch (Exception $e) {
            //echo($e->getMessage());
            $this->timetableCatalog->rollbackTransaction();
            return json_encode(array("error" => $e->getMessage()));
        }
    }

    /**
     * Updates TimetableHour
     * @param array_iterator $data
     * @param Employee $employee
     * @return String Json
     * @throws ManagerException
     * @author Arturo
     */
    public function updateTimetableHour($data, $employee) {
        $db_errors = null;
        //die (print_r($data));
        try {
            $formatted_date = New Zend_Date($data["date"], "YYYY-M-d H:mm:ss");
            $criteria = new Criteria();
            $criteria->add(Timetable::DATE, $formatted_date->get('YYYY-MM-dd'), Criteria::EQUAL);
            $timetable = TimetableCatalog::getInstance()->getByCriteria($criteria)->getOne();
            $this->timetableCatalog->beginTransaction();
            if (!$timetable) {

                $timetable = TimetableFactory::create($employee->getIdEmployee(), $formatted_date->get('YYYY-MM-dd'), null, null, null, Timetable::$Status["draft"]);
                //die(var_dump($timetable));
                TimetableCatalog::getInstance ()->create($timetable);
            }
            $now = new Zend_Date();
            $timetableHour = TimetableHourCatalog::getInstance()->getById($data["id"]);
            $currentTimetable = $timetableHour->getIdTimetable();
            $timetableHour->setIdTimetable($timetable->getIdTimetable());
            $timetableHour->setRecordDate($formatted_date->get('YYYY-MM-dd HH:mm:ss'));
            $timetableHour->setHours($data["hours"]);
            TimetableHourCatalog::getInstance()->update($timetableHour);
            if (!TimetableHourCatalog::getInstance()->checkHours($currentTimetable))
                $this->timetableCatalog->deleteById($currentTimetable);
            $this->timetableCatalog->commitTransaction();
            return json_encode(array("ok" => "ok", "id" => $timetableHour->getIdTimetableHour()));
        } catch (Exception $e) {
            //echo($e->getMessage());
            $this->timetableCatalog->rollbackTransaction();
            return json_encode(array("error" => $e->getMessage()));
        }
    }

    /**
     * Releases Timetable
     * @param array_iterator $timeTableHours
     * @return String Json
     * @throws ManagerException
     * @author Arturo
     */
    public function releaseTimetable($timeTableHours) {
        try {
            $criteria = new Criteria();
            $this->timetableCatalog->beginTransaction();
            foreach ($timeTableHours as $k => $v) {
                $criteria->add(TimetableHour::ID_TIMETABLE_HOUR, $k, Criteria::EQUAL);
                $timetableHour = TimetableHourCatalog::getInstance()->getByCriteria($criteria)->getOne();
                if ($timetableHour) {
                    $timetableHour->setStatus(TimetableHour::$Status["released"]);
                    TimetableHourCatalog::getInstance ()->update($timetableHour);
                }
                $criteria->remove(TimetableHour::ID_TIMETABLE_HOUR);
            }
            $statusTimetable = TimetableHourCatalog::getInstance()->getHoursGroupByStatus($timetableHour->getIdTimetable());
            $timetable = $this->timetableCatalog->getById($timetableHour->getIdTimetable());
            $countStatuses = count($statusTimetable);
            foreach ($statusTimetable as $status) {
                if ($countStatuses == 1 && $status["status"] > 1) {
                    $timetable->setStatus($status["status"]);
                    $this->timetableCatalog->update($timetable);
                    break;
                }
                if ($status["status"] == 3) {
                    $timetable->setStatus($status["status"]);
                    $this->timetableCatalog->update($timetable);
                    break;
                }
            }
            $this->timetableCatalog->commitTransaction();
            return json_encode(array("ok" => "ok"));
        } catch (Exception $e) {
            $this->timetableCatalog->rollbackTransaction();
            return json_encode(array("error" => $e->getMessage()));
        }
    }

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

}
