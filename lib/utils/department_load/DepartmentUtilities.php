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

class DepartmentUtilities {

    /**
     * Singleton Instance
     * @var utilities
     */
    static protected $instance = null;

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
        //print_r($rows);
        $reported_rows=array();
        $ok_rows=array();
        foreach ($rows as $key=>$value) {
            foreach ($rows[$key] as $k => $v){
                //echo $v;
                if(!$this->validateField($k, $v)){
                    if(!$reported_rows[$key])
                        $reported_rows[$key]=$rows[$key];
                    $reported_rows[$key]["ERROR"].=($reported_rows[$key]["ERROR"])?$rows[$key]["ERROR"].", $k":$k;
                    //unset($rows[$key]);
                }
            }
            if(!$reported_rows[$key]){
                $ok_rows[$key]=$rows[$key];
            }
        }
        return array("ok_rows"=>$ok_rows,"reported_rows"=>$reported_rows);
    }

    public function validateField($field, $value) {
        switch ($field) {
            case "department_code":
                if (!preg_match("/^[A-Z0-9]{3,6}+$/", $value))
                        return false;
                return true;
                break;
            case "department_name":
                if (!preg_match("/^[a-zA-Z0-9 αινσϊΑΙΝΣΪόά]{3,30}+$/", $value))
                    
                    return false;
                return true;
                break;
        }
    }

}

?>