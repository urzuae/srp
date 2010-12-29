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

class ProjectUtilities {

    /**
     * Singleton Instance
     * @var utilities
     */
    static protected $instance = null;
    //private $department;

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
        $reported_rows=array();
        $ok_rows=array();
        foreach ($rows as $key=>$value) {
            foreach ($rows[$key] as $k => $v){
                if(!$this->validateField($k, $v)){
                    if(!$reported_rows[$key])
                        $reported_rows[$key]=$rows[$key];
                    $reported_rows[$key]["ERROR"].=($reported_rows[$key]["ERROR"])?$rows[$key]["ERROR"].", $k":$k;
                    //unset($rows[$key]);
                }
            }
            if(!$reported_rows[$key]){
//                $rows[$key]["id_department"]=$this->department;
                $ok_rows[$key]=$rows[$key];
            }
        }
        return array("ok_rows"=>$ok_rows,"reported_rows"=>$reported_rows);
    }

    public function validateField($field, $value) {
        switch ($field) {
            case "project_name":
                if (!preg_match("/^[A-Z0-9a-z αινσϊΑΙΝΣΪόά_\/\(\)-]{1,30}+$/", $value)&& !empty($value))
                        return false;
                return true;
                break;
            case "project_code":
                if (!preg_match("/^[A-Za-z0-9]{3,9}+$/", $value))
                    return false;
                return true;
                break;
            case "status":
                if (!preg_match("/^[1-2]{1}+$/", $value)&& !empty($value))
                    return false;
                return true;
                break;
            case "beginning_date":case "ending_date":
                if (!preg_match("/^[0-9]{8}+$/", $value)&& !empty($value))
                    return false;
                return true;
                break;
            case "beginning_time":case "ending_time":
                if (!preg_match("/^[0-9]{6}+$/", $value)&& !empty($value))
                    return false;
                return true;
                break;
        }
    }

}

?>