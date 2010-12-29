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

class ProjectTaskUtilities {

    /**
     * Singleton Instance
     * @var utilities
     */
    static protected $instance = null;
    //private $department;

    /**
     * Método para obtener la instancia del catálogo
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
                if($k!=="description")
                    $rows[$key][$k] =$v= strtoupper($v);
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
            case "project_code":
//                $project=SpecificProjectCatalog::getInstance()->getByProjectCode($value);
//                if (preg_match("/^[A-Z0-9]{3,9}+$/", $value) && $project)
                    return true;
//                return false;
                break;
            case "task_code":
                if (!preg_match("/^[A-Z0-9.]{3,8}+$/", $value))
                    return false;
                return true;
                break;
            case "work_authorization_status":
                if (!preg_match("/^[0-9]{1}+$/", $value))
                    return false;
                return true;
                break;
            case "description":
                 if (!preg_match("/^(.*){0,50}+$/", $value))
                    return false;
                return true;
                break;
        }
    }

}

?>