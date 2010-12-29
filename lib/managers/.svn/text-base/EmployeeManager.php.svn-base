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
class EmployeeManager {
    /* Instancia de LockerManager
     *
     * @staticvar LockerManager $instance
     */

    protected static $instance = null;
    /**
     * Catalogo de Usuario
     * @var EmployeeCatalog
     */
    protected $employeeCatalog;

    /**
     * Constructor
     */
    protected function EmployeeManager() {
        $this->employeeCatalog = EmployeeCatalog::getInstance();
    }

    /**
     * Singleton Obtiene una instancia
     * @return EmployeeManager
     */
    public static function getInstance() {
        if (!isset(self::$instance)) {
            self::$instance = new EmployeeManager();
        }
        return self::$instance;
    }

    /**
     * Crea un Lead y genera el log
     * @param array_iterator $employees
     * @throws ManagerException
     */
    public function upload_create($employees) {
        $db_errors = null;
        try {

//die();
            $inserted_rows = 0;
            foreach ($employees as $key => $value) {


                $employee_exists = UserCatalog::getInstance()->getByUsername($employees[$key]["username"]);
                if (!$employee_exists) {
                    $employee_name=EmployeeUtilities::getInstance()->digest_name($employees[$key]["name"]);

                    $employees[$key]["name"] = $employee_name["name"];
                    $employees[$key]["middle_name"] =$employee_name["middle name"];
                    $employees[$key]["last_name"] = $employee_name["last_name"];

                     $bgDate = ($employees[$key]["beginning_date"]) ?
                            new Zend_Date($employees[$key]["beginning_date"] . $employees[$key]["beginning_time"], "DDMMYYYYHHmmss") :
                            new Zend_Date("00000000000000", "DDMMYYYYHHmmss");
                    $endDate = ($employees[$key]["ending_date"]) ?
                            new Zend_Date($employees[$key]["ending_date"] . $employees[$key]["ending_time"], "DDMMYYYYHHmmss") :
                            new Zend_Date("00000000000000", "DDMMYYYYHHmmss");
//                    $bgDate = new Zend_Date($employees[$key]["beginning_date"], "DDMMYYYY");
//                    $endDate = new Zend_Date($employees[$key]["ending_date"], "DDMMYYYY");

                    $employees[$key]["beginning_date"] = $bgDate->toString("YYYY-MM-dd");
                    $employees[$key]["ending_date"] = $endDate->toString("YYYY-MM-dd");

                    

                    $employee = EmployeeFactory::createFromArray($employees[$key]);
                    //var_dump($employee);
                    $employee->setIdAccessRole("1");
                    $employee->setPassword($employee->getUsername());
                    //$employee->setIdDepartment("3");
                    try {
                        $this->employeeCatalog->beginTransaction();
                        EmployeeCatalog::getInstance()->create($employee);
                        $email = EmailFactory::create($employee->getIdPerson(), $employees[$key]["e_mail"], 1);
                        EmailCatalog::getInstance()->create($email);
                        $this->employeeCatalog->commitTransaction();
                        $inserted_rows++;
                    } catch (Exception $e) {
                        if ($e instanceof EmployeeException || $e instanceof EmailException) {
                            $this->employeeCatalog->rollbackTransaction();
                            $db_errors[$key] = $e->getMessage();
                            //print_r($db_errors);
                            //echo $e->getMessage();
                        }
                    }
                } else {
 
                    $employee_exists->setStatus(1);
                    $employee_name=EmployeeUtilities::getInstance()->digest_name($employees[$key]["name"]);

                    $employee_exists->setName($employee_name["name"]);
                    $employee_exists->setMiddleName($employee_name["middle_name"]);
                    $employee_exists->setLastName($employee_name["last_name"]);
                    UserCatalog::getInstance()->update($employee_exists);
                }
            }

            //print_r($employees);

            return array("inserted" => $inserted_rows, "db_errors" => $db_errors);
        } catch (Exception $e) {
            die($e->getMessage());
            //$this->employeeCatalog->rollbackTransaction();
        }
    }

    public function check_employees($employees) {
        $emplo=EmployeeCatalog::getInstance()->getActives();
            //var_dump($emplo);
            //die();
        $employees_db = UserCatalog::getInstance()->getByCriteria()->toKeyValueArray(User::ID_PERSON, User::USERNAME);
        foreach ($employees_db as $id => $username) {
            $on_list = false;
            foreach ($employees as $employee) {
                if ($username == $employee["username"] || $username == "admin") {
                    $on_list = true;
                }
            }
            if (!$on_list) {
                echo $username . ";";
                $user_db = UserCatalog::getInstance ()->getByUsername($username);
                $user_db->setStatus(User::$Status["Inactive"]);
                UserCatalog::getInstance()->update($user_db);
            }
        }
    }

}