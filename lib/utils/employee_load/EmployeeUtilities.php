<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of utilities
 *
 * @author arturo
 */
class EmployeeUtilities {

    /**
     * Singleton Instance
     * @var utilities
     */
    static protected $instance = null;
    private $department;

    /**
     * Mιtodo para obtener la instancia del catαlogo
     * @return utilities
     */
    public static function getInstance() {
        if (!isset(self::$instance)) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    public function validateRowFields($rows) {
        $reported_rows = array();
        $ok_rows = array();
        foreach ($rows as $key => $value) {
            foreach ($rows[$key] as $k => $v) {
                $v = strtoupper($v);
                if (!$this->validateField($k, $v)) {
                    if (!$reported_rows[$key])
                        $reported_rows[$key] = $rows[$key];
                    $reported_rows[$key]["ERROR"].= ( $reported_rows[$key]["ERROR"]) ? $rows[$key]["ERROR"] . ", $k" : $k;
                    //unset($rows[$key]);
                }
            }
            if (!$reported_rows[$key]) {
                $rows[$key]["id_department"] = $this->department;
                $ok_rows[$key] = $rows[$key];
            }
        }
        return array("ok_rows" => $ok_rows, "reported_rows" => $reported_rows);
    }

    public function validateField($field, $value) {
        switch ($field) {
            case "username":
                if (!preg_match("/^[A-Z0-9a-z]{3,11}+$/", $value))
                    return false;
                return true;
                break;
            case "name":
                if (!preg_match("/^[A-Za-z, αινσϊΑΙΝΣΪόά]+$/", $value))
                    return false;
                return true;
                break;
            case "e_mail":
                if (!preg_match("/\b[a-zA-Z0-9._%-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}\b/", $value) && !empty($value))
                    return false;
                return true;
                break;
            case "beginning_date":case "ending_date":
                if (!preg_match("/^[0-9]{8}+$/", $value) && !empty($value))
                    return false;
                return true;
                break;
            case "schedule_type":
                if (!preg_match("/^[A-Z0-9]{1,4}+$/", $value))
                    return false;
                return true;
                break;
            case "approver":
                if (!preg_match("/^[0-1]{1}$/", $value))
                    return false;
                return true;
                break;
            case "department_code":
                require_once 'application/models/catalogs/DepartmentCatalog.php';
                $department = DepartmentCatalog::getInstance()->getByDepartmentCode($value)->getOne();
                if ($department && preg_match("/^[A-Z0-9]+$/", $value)) {
                    $this->department = $department->getIdDepartment();
                    return true;
                }
                else
                    return false;
                break;
        }
    }

    public function digest_name($name) {
        if (strpos($name, " ") !== false) {
            $employee_fullname = explode(" ", $name);
            switch (count($employee_fullname)) {
                case 2:
                    $fullname["name"] = $employee_fullname[1];
                    $fullname["middle_name"] = "";
                    $fullname["last_name"] = $employee_fullname[0];
                    break;
                case 3:
                    $fullname["name"] = $employee_fullname[2];
                    $fullname["middle_name"] = $employee_fullname[1];
                    $fullname["last_name"] = $employee_fullname[0];
                    break;
                default :
                    $fullname["middle_name"] = $employee_fullname[1];
                    $fullname["last_name"] = $employee_fullname[0];
                    unset($employee_fullname[1]);
                    unset($employee_fullname[0]);
                    $fullname["name"] = implode(" ", $employee_fullname);
                    break;
            }
        } else {
            $fullname["name"] = $name;
            $fullname["middle_name"] = "";
            $fullname["last_name"] = "";
        }
        return $fullname;
    }

}

?>