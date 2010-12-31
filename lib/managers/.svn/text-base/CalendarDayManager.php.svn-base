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
class CalendarDayManager {
    /* Instancia de LockerManager
     *
     * @staticvar LockerManager $instance
     */

    protected static $instance = null;
    /**
     * Catalogo de Departamento
     * @var CalendarDayCatalog
     */
    protected $calendarDayCatalog;

    /**
     * Constructor
     */
    protected function CalendarDayManager() {
        $this->calendarDayCatalog = CalendarDayCatalog::getInstance();
    }

    /**
     * Singleton Obtiene una instancia
     * @return CalendarDayManager
     */
    public static function getInstance() {
        if (!isset(self::$instance)) {
            self::$instance = new CalendarDayManager();
        }
        return self::$instance;
    }
    
    /*
     * Get EnableDays
     */
    public function getEnableDays($idEmployee){
    	$criteria = new Criteria();
    	$criteria1 = new Criteria();
    	$criteria2 = new Criteria();
    	$criteria3 = new Criteria();
    	$criteria4 = new Criteria();
    	if($idEmployee == 0)
    		$criteria3->add(CalendarDay::ID_EMPLOYEE, 'NULL', Criteria::IS_NULL);
    	else
    	{
        	$criteria1->add(CalendarDay::ID_EMPLOYEE, $idEmployee, Criteria::EQUAL);
        	$criteria2->add(CalendarDay::ID_EMPLOYEE, 'NULL', Criteria::IS_NULL);
        	$criteria3->addOr($criteria1, $criteria2);
    	}
        $criteria4->add(CalendarDay::ENABLED_DISABLED, 1, Criteria::EQUAL);        	
        $criteria->addAnd($criteria3, $criteria4);
    	$calendarDay = $this->calendarDayCatalog->getDayDateByCriteria($criteria);
       	asort($calendarDay);
        foreach ($calendarDay as $key => $CalendarDate)
        {
        	$date = explode('-', $CalendarDate);
        	$year = $date[0];
        	$month = $date[1];
        	$month=(string)(int)$month;
        	$day = $date[2];
        	$day=(string)(int)$day;
        	
        	if ($month == '1')
        	{
        	 	$dayArray1[] = $day;  
        	 	$monthArray[$month]= $dayArray1; 
        	 	//$monthArray = $monthArray1;
        	}      	
        	if ($month == '2')
        	{
        	 	$dayArray2[] = $day;   
        	 	$monthArray[$month]= $dayArray2;   
        	}   	
        	if ($month == '3')
        	{
        	 	$dayArray3[] = $day;    
        	 	$monthArray[$month]= $dayArray3;   
        	}  	
        	if ($month == '4')
        	{
        	 	$dayArray4[] = $day;
        	 	$monthArray[$month]= $dayArray4;  
        	}       	 
        	if ($month == '5')
        	{
        	 	$dayArray5[] = $day; 
        	 	$monthArray5[$month]= $dayArray5;
        	}
        	if ($month == '6')
        	{
        	 	$dayArray6[] = $day; 
        	 	$monthArray[$month]= $dayArray6;
        	}
        	if ($month == '7')
        	{
        	 	$dayArray7[] = $day;
        	 	$monthArray[$month]= $dayArray7;
        	} 
        	if ($month == '8')
        	{
        	 	$dayArray8[] = $day; 
        	 	$monthArray[$month]= $dayArray8;
        	}
        	if ($month == '9'){
        	 	$dayArray9[] = $day; 
        	 	$monthArray[$month]= $dayArray9;
        	 	//$monthArray = $monthArray9;
        	}
        	if ($month == '10')
        	{
        	 	$dayArray10[] = $day; 
        	 	$monthArray[$month]= $dayArray10;
        	}
        	if ($month == '11')
        	{
        	 	$dayArray11[] = $day; 
        	 	$monthArray[$month]= $dayArray11;
        	}
        	if ($month == '12')
        	{
        		$dayArray12[] = $day;  
        		$monthArray[$month]= $dayArray12;
        	 	//$monthArray = $monthArray12; 
        	}
        }
        $dates_enables[$year] =$monthArray;
        return $dates_enables;
    }
    /*
     * Get DisableDays
     */    
	public function getDisableDays($idEmployee){
    	$criteria = new Criteria();
    	$criteria1 = new Criteria();
    	$criteria2 = new Criteria();
    	$criteria3 = new Criteria();
    	$criteria4 = new Criteria();
    	if($idEmployee == 0)
    		$criteria3->add(CalendarDay::ID_EMPLOYEE, 'NULL', Criteria::IS_NULL);
    	else
    	{
        	$criteria1->add(CalendarDay::ID_EMPLOYEE, $idEmployee, Criteria::EQUAL);
        	$criteria2->add(CalendarDay::ID_EMPLOYEE, 'NULL', Criteria::IS_NULL);
        	$criteria3->addOr($criteria1, $criteria2);
    	}
        $criteria4->add(CalendarDay::ENABLED_DISABLED, 2, Criteria::EQUAL);        	
        $criteria->addAnd($criteria3, $criteria4);
    	$calendarDay = $this->calendarDayCatalog->getDayDateByCriteria($criteria);
       	asort($calendarDay);
        foreach ($calendarDay as $key => $CalendarDate)
        {
        	$date = explode('-', $CalendarDate);
        	$year = $date[0];
        	$month = $date[1];
        	$month=(string)(int)$month;
        	$day = $date[2];
        	$day=(string)(int)$day;
        	
        	if ($month == '1')
        	{
        	 	$dayArray1[] = $day;  
        	 	$monthArray[$month]= $dayArray1; 
        	}      	
        	if ($month == '2')
        	{
        	 	$dayArray2[] = $day;   
        	 	$monthArray[$month]= $dayArray2;   
        	}   	
        	if ($month == '3')
        	{
        	 	$dayArray3[] = $day;    
        	 	$monthArray[$month]= $dayArray3;   
        	}  	
        	if ($month == '4')
        	{
        	 	$dayArray4[] = $day;
        	 	$monthArray[$month]= $dayArray4;  
        	}       	 
        	if ($month == '5')
        	{
        	 	$dayArray5[] = $day; 
        	 	$monthArray5[$month]= $dayArray5;
        	}
        	if ($month == '6')
        	{
        	 	$dayArray6[] = $day; 
        	 	$monthArray[$month]= $dayArray6;
        	}
        	if ($month == '7')
        	{
        	 	$dayArray7[] = $day;
        	 	$monthArray[$month]= $dayArray7;
        	} 
        	if ($month == '8')
        	{
        	 	$dayArray8[] = $day; 
        	 	$monthArray[$month]= $dayArray8;
        	}
        	if ($month == '9'){
        	 	$dayArray9[] = $day; 
        	 	$monthArray[$month]= $dayArray9;
        	}
        	if ($month == '10')
        	{
        	 	$dayArray10[] = $day; 
        	 	$monthArray[$month]= $dayArray10;
        	}
        	if ($month == '11')
        	{
        	 	$dayArray11[] = $day; 
        	 	$monthArray[$month]= $dayArray11;
        	}
        	if ($month == '12')
        	{
        		$dayArray12[] = $day;  
        		$monthArray[$month]= $dayArray12;
        	}
        }
        $dates_disable[$year] =$monthArray;
        return $dates_disable;
    }
    
 /*
     * Get Dates
     */
    public function getCalendarDays($dateArray)
    {
    	if ($dateArray != null)
    	{
	        foreach ($dateArray as $key => $date)
	        {
	        	$date = explode('-', $date);
	        	$year = $date[0];
	        	$month = $date[1];
	        	$month=(string)(int)$month;
	        	$day = $date[2];
	        	$day=(string)(int)$day;
	        	
	        	if ($month == '1')
	        	{
	        	 	$dayArray1[] = $day;  
	        	 	$monthArray[$month]= $dayArray1; 
	        	}      	
	        	if ($month == '2')
	        	{
	        	 	$dayArray2[] = $day;   
	        	 	$monthArray[$month]= $dayArray2;   
	        	}   	
	        	if ($month == '3')
	        	{
	        	 	$dayArray3[] = $day;    
	        	 	$monthArray[$month]= $dayArray3;   
	        	}  	
	        	if ($month == '4')
	        	{
	        	 	$dayArray4[] = $day;
	        	 	$monthArray[$month]= $dayArray4;  
	        	}       	 
	        	if ($month == '5')
	        	{
	        	 	$dayArray5[] = $day; 
	        	 	$monthArray5[$month]= $dayArray5;
	        	}
	        	if ($month == '6')
	        	{
	        	 	$dayArray6[] = $day; 
	        	 	$monthArray[$month]= $dayArray6;
	        	}
	        	if ($month == '7')
	        	{
	        	 	$dayArray7[] = $day;
	        	 	$monthArray[$month]= $dayArray7;
	        	} 
	        	if ($month == '8')
	        	{
	        	 	$dayArray8[] = $day; 
	        	 	$monthArray[$month]= $dayArray8;
	        	}
	        	if ($month == '9'){
	        	 	$dayArray9[] = $day; 
	        	 	$monthArray[$month]= $dayArray9;
	        	}
	        	if ($month == '10')
	        	{
	        	 	$dayArray10[] = $day; 
	        	 	$monthArray[$month]= $dayArray10;
	        	}
	        	if ($month == '11')
	        	{
	        	 	$dayArray11[] = $day; 
	        	 	$monthArray[$month]= $dayArray11;
	        	}
	        	if ($month == '12')
	        	{
	        		$dayArray12[] = $day;  
	        		$monthArray[$month]= $dayArray12;
	        	}
	        }
    	}
        $dates[$year] =$monthArray;
        return $dates;
    }

    /**
     * Gets the timetables weekdays to check-down
     * @param Integer $idEmployee
     * @return ArrayIterator
     * @throws ManagerException
     * @author Arturo
     */
    public function getWeekDaysByEmployee($idEmployee) {
        require_once 'application/models/catalogs/CalendarDayCatalog.php';
        $toDate = new Zend_Date();
        //$toDate = $date->toString("MM/dd/YYYY");
        $toDate->addDay("-14");
        $fromDate = new Zend_Date($toDate);
        $toDate->addDay("14");

        $dateMonthYearArr = array();

        $fromDateTS = $fromDate->getTimestamp();
        $toDateTS = $toDate->getTimestamp();

        //die($fromDateTS." ".$toDateTS);
        for ($currentDateTS = $fromDateTS; $currentDateTS <= $toDateTS; $currentDateTS = $fromDate->addDay(1)->getTimestamp()) {
;
            //echo $fromDate->get(Zend_Date::WEEKDAY_DIGIT)."\n";
            if ($fromDate->get(Zend_Date::WEEKDAY_DIGIT) != 0 && $fromDate->get(Zend_Date::WEEKDAY_DIGIT) != 6)
                $dateMonthYearArr[] = $fromDate->toString("YYYY-MM-dd");
        }
        $calendarDays = CalendarDayCatalog::getInstance()->getByIdEmployeeAndDate($idEmployee, $toDate->toString("YYYY-MM-dd"), $toDate->addDay("-14")->toString("YYYY-MM-dd"));

        foreach ($calendarDays as $calendarDay) {
            if ($calendarDay->getEnabledDisabled($enabledDisabled) == 1) {
                $key = array_search($calendarDay->getDayDate(), $dateMonthYearArr);
                if (!$key)
                    $dateMonthYearArr[] = $calendarDay->getDayDate();
            }
            else if ($calendarDay->getEnabledDisabled($enabledDisabled) == 2) {
                $key = array_search($calendarDay->getDayDate(), $dateMonthYearArr);
                unset($dateMonthYearArr[$key]);
            }
        }
        return $dateMonthYearArr;
    }

    function lastday($month = '', $year = '') {
        if (empty($month)) {
            $month = date('m');
        }
        if (empty($year)) {
            $year = date('Y');
        }
        $result = strtotime("{$year}-{$month}-01");
        $result = strtotime('-1 second', strtotime('+1 month', $result));
        return date('d', $result);
    }

    function getDayStatus($projects, $idEmployee) {
        foreach ($projects as $project) {
            $tmp[] = $project['id_project'];
        }
        $stringProjects = implode(",", $tmp);
        $strProjects = '"';
        $strProjects.= implode(",", $tmp);
        $strProjects.='"';
        $dates = TimetableCatalog::getInstance()->getDisctinctDateByIdProjects($stringProjects, $idEmployee);
        foreach ($dates as $date) {
            if ($date['status'] == 2)
                $dateArray2[] = $date['date'];
            if ($date['status'] == 3)
                $dateArray3[] = $date['date'];
            if ($date['status'] == 4)
                $dateArray4[] = $date['date'];
            if ($date['status'] == 1)
                $dateArray1[] = $date['date'];
        }
        $daysStatuses["daysStatuses2"] = CalendarDayManager::getInstance()->getCalendarDays($dateArray2);
        $daysStatuses["daysStatuses3"] = CalendarDayManager::getInstance()->getCalendarDays($dateArray3);
        $daysStatuses["daysStatuses4"] = CalendarDayManager::getInstance()->getCalendarDays($dateArray4);
        $daysStatuses["daysStatuses1"] = CalendarDayManager::getInstance()->getCalendarDays($dateArray1);
        $daysStatuses["strProjects"] = $strProjects;
        return $daysStatuses;
    }

}