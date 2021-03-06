<?php
/**
 * SRP
 *
 * SRP INELECTRA
 *
 * @category   lib
 * @package    lib_models
 * @copyright  Copyright (c) 2010 PCSMEXICO
 * @author     <arturo>, $LastChangedBy$
 * @version    1.0.2 SVN: $Id$
 */

/**
 * Dependences
 */
require_once "lib/db/Catalog.php";
require_once "application/models/beans/TimetableHour.php";
require_once "application/models/beans/ProjectTask.php";
require_once "application/models/exceptions/TimetableHourException.php";
require_once "application/models/collections/TimetableHourCollection.php";
require_once "application/models/factories/TimetableHourFactory.php";

/**
 * Singleton TimetableHourCatalog Class
 *
 * @category   lib
 * @package    lib_models
 * @subpackage lib_models_catalogs
 * @copyright  Copyright (c) 2010 PCSMEXICO
 * @copyright  This File has been proudly generated by Bender (http://code.google.com/p/bender-modeler/). <chentepixtol> <zetta>
 * @author     zetta & chentepixtol
 * @version    1.0.2 SVN: $Revision$
 */
class TimetableHourCatalog extends Catalog
{

    /**
     * Singleton Instance
     * @var TimetableHourCatalog
     */
    static protected $instance = null;


    /**
     * M�todo para obtener la instancia del cat�logo
     * @return TimetableHourCatalog
     */
    public static function getInstance()
    {
        if (!isset(self::$instance))
        {
          self::$instance = new self();
        }
        return self::$instance;
    }

    /**
     * Constructor de la clase TimetableHourCatalog
     * @return TimetableHourCatalog
     */
    protected function TimetableHourCatalog()
    {
        parent::Catalog();
    }

    /**
     * Metodo para agregar un TimetableHour a la base de datos
     * @param TimetableHour $timetableHour Objeto TimetableHour
     */
    public function create($timetableHour)
    {
        if(!($timetableHour instanceof TimetableHour))
            throw new TimetableHourException("passed parameter isn't a TimetableHour instance");
        try
        {
            $data = array(
                'id_timetable' => $timetableHour->getIdTimetable(),
                'record_date' => $timetableHour->getRecordDate(),
                'hours' => $timetableHour->getHours(),
                'date_created' => $timetableHour->getDateCreated(),
                'timestamp' => $timetableHour->getTimestamp(),
            );
            $data = array_filter($data, 'Catalog::notNull');
            $this->db->insert(TimetableHour::TABLENAME, $data);
            $timetableHour->setIdTimetableHour($this->db->lastInsertId());
        }
        catch(Exception $e)
        {
            throw new TimetableHourException("The TimetableHour can't be saved \n" . $e->getMessage());
        }
    }

    /**
     * Metodo para Obtener los datos de un objeto por su llave primaria
     * @param int $idTimetableHour
     * @param boolean $throw
     * @return TimetableHour|null
     */
    public function getById($idTimetableHour, $throw = false)
    {
        try
        {
            $criteria = new Criteria();
            $criteria->add(TimetableHour::ID_TIMETABLE_HOUR, $idTimetableHour, Criteria::EQUAL);
            $newTimetableHour = $this->getByCriteria($criteria)->getOne();
        }
        catch(Exception $e)
        {
            throw new TimetableHourException("Can't obtain the TimetableHour \n" . $e->getMessage());
        }
        if($throw && null == $newTimetableHour)
            throw new TimetableHourException("The TimetableHour at $idTimetableHour not exists ");
        return $newTimetableHour;
    }

    /**
     * Metodo para Obtener una colecci�n de objetos por varios ids
     * @param array $ids
     * @return TimetableHourCollection
     */
    public function getByIds(array $ids)
    {
        if(null == $ids) return new TimetableHourCollection();
        try
        {
            $criteria = new Criteria();
            $criteria->add(TimetableHour::ID_TIMETABLE_HOUR, $ids, Criteria::IN);
            $timetableHourCollection = $this->getByCriteria($criteria);
        }
        catch(Exception $e)
        {
            throw new TimetableHourException("TimetableHourCollection can't be populated\n" . $e->getMessage());
        }
        return $timetableHourCollection;
    }

    /**
     * Metodo para actualizar un TimetableHour
     * @param TimetableHour $timetableHour
     */
    public function update($timetableHour)
    {
        if(!($timetableHour instanceof TimetableHour))
            throw new TimetableHourException("passed parameter isn't a TimetableHour instance");
        try
        {
            $where[] = "id_timetable_hour = '{$timetableHour->getIdTimetableHour()}'";
            $data = array(
                'id_timetable' => $timetableHour->getIdTimetable(),
                'record_date' => $timetableHour->getRecordDate(),
                'hours' => $timetableHour->getHours(),
                'date_created' => $timetableHour->getDateCreated(),
                'timestamp' => $timetableHour->getTimestamp(),
            );
            $data = array_filter($data, 'Catalog::notNull');
            $this->db->update(TimetableHour::TABLENAME, $data, $where);
        }
        catch(Exception $e)
        {
            throw new TimetableHourException("The TimetableHour can't be updated \n" . $e->getMessage());
        }
    }

    /**
     * Metodo para guardar un timetableHour
     * @param TimetableHour $timetableHour
     */
    public function save($timetableHour)
    {
        if(!($timetableHour instanceof TimetableHour))
            throw new TimetableHourException("passed parameter isn't a TimetableHour instance");
        if(null != $timetableHour->getIdTimetableHour())
            $this->update($timetableHour);
        else
            $this->create($timetableHour);
    }

    /**
     * Metodo para eliminar un timetableHour
     * @param TimetableHour $timetableHour
     */
    public function delete($timetableHour)
    {
        if(!($timetableHour instanceof TimetableHour))
            throw new TimetableHourException("passed parameter isn't a TimetableHour instance");
        $this->deleteById($timetableHour->getIdTimetableHour());
    }

    /**
     * Metodo para eliminar un TimetableHour a partir de su Id
     * @param int $idTimetableHour
     */
    public function deleteById($idTimetableHour)
    {
        try
        {
            $where = array($this->db->quoteInto('id_timetable_hour = ?', $idTimetableHour));
            $this->db->delete(TimetableHour::TABLENAME, $where);
        }
        catch(Exception $e)
        {
            throw new TimetableHourException("The TimetableHour can't be deleted\n" . $e->getMessage());
        }
    }

    /**
     * Metodo para eliminar varios TimetableHour a partir de su Id
     * @param array $ids
     */
    public function deleteByIds(array $ids)
    {
        try
        {
            $criteria = new Criteria();
            $criteria->add(TimetableHour::ID_TIMETABLE_HOUR, $ids, Criteria::IN);
            $this->db->delete(TimetableHour::TABLENAME, array($criteria->createSql()));
        }
        catch(Exception $e)
        {
            throw new TimetableHourException("Can't delete that\n" . $e->getMessage());
        }
    }

    /**
     * Metodo para Obtener todos los ids en un arreglo
     * @return array
     */
    public function retrieveAllIds()
    {
        return $this->getIdsByCriteria(new Criteria());
    }

    /**
     * Metodo para obtener todos los id de TimetableHour por criterio
     * @param Criteria $criteria
     * @return array Array con todos los id de TimetableHour que encajen en la busqueda
     */
    public function getIdsByCriteria(Criteria $criteria = null)
    {
        $criteria = (null === $criteria) ? new Criteria() : $criteria;
        return $this->getCustomFieldByCriteria(TimetableHour::ID_TIMETABLE_HOUR, $criteria);
    }

    /**
     * Metodo para obtener un campo en particular de un TimetableHour dado un criterio
     * @param string $field
     * @param Criteria $criteria
     * @param $distinct
     * @return array Array con el campo de los objetos TimetableHour que encajen en la busqueda
     */
    public function getCustomFieldByCriteria($field, Criteria $criteria = null, $distinct = false)
    {
        $criteria = (null === $criteria) ? new Criteria() : $criteria;
        $distinct = $distinct ? 'DISTINCT' : '';
        try
        {
            $sql = "SELECT {$distinct} {$field}
                    FROM ".TimetableHour::TABLENAME."
                    WHERE  " . $criteria->createSql();
            $result = $this->db->fetchCol($sql);
        } catch(Zend_Db_Exception $e)
        {
            throw new TimetableHourException("No se pudieron obtener los fields de objetos TimetableHour\n" . $e->getMessage());
        }
        return $result;
    }

    /**
     * Metodo que regresa una coleccion de objetos TimetableHour
     * dependiendo del criterio establecido
     * @param Criteria $criteria
     * @return TimetableHourCollection $timetableHourCollection
     */
    public function getByCriteria(Criteria $criteria = null)
    {
        $criteria = (null === $criteria) ? new Criteria() : $criteria;
        $this->db->setFetchMode(Zend_Db::FETCH_ASSOC);
        try
        {
            $sql = "SELECT * FROM ".TimetableHour::TABLENAME."
                    WHERE " . $criteria->createSql();
            $timetableHourCollection = new TimetableHourCollection();
            foreach ($this->db->fetchAll($sql) as $result){
                $timetableHourCollection->append($this->getTimetableHourInstance($result));
            }
        }
        catch(Zend_Db_Exception $e)
        {
            throw new TimetableHourException("Cant obtain TimetableHourCollection\n" . $e->getMessage());
        }
        return $timetableHourCollection;
    }

    /**
     * Metodo que cuenta TimetableHour
     * dependiendo del criterio establecido
     * @param Criteria $criteria
     * @param string $field
     * @return int $count
     */
    public function countByCriteria(Criteria $criteria = null, $field = 'id_timetable_hour')
    {
        $criteria = (null === $criteria) ? new Criteria() : $criteria;
        try
        {
            $sql = "SELECT COUNT( $field ) FROM ".TimetableHour::TABLENAME."
                    WHERE " . $criteria->createSql();
            $count = $this->db->fetchOne($sql);
        }
        catch(Zend_Db_Exception $e)
        {
            throw new TimetableHourException("Cant obtain the count \n" . $e->getMessage());
        }
        return $count;
    }

    /**
     * M�todo que construye un objeto TimetableHour y lo rellena con la informaci�n del rowset
     * @param array $result El arreglo que devolvi� el objeto Zend_Db despues del fetch
     * @return TimetableHour
     */
    private function getTimetableHourInstance($result)
    {
        return TimetableHourFactory::createFromArray($result);
    }

    /**
     * Obtiene un TimetableHourCollection  dependiendo del idTimetable
     * @param int $idTimetable
     * @return TimetableHourCollection
     */
    public function getByIdTimetable($idTimetable)
    {
        $criteria = new Criteria();
        $criteria->add(TimetableHour::ID_TIMETABLE, $idTimetable, Criteria::EQUAL);
        $timetableHourCollection = $this->getByCriteria($criteria);
        return $timetableHourCollection;
    }

    public function checkHours($idTimetable){
        $criteria=new Criteria();
        $criteria->add(TimetableHour::ID_TIMETABLE,$idTimetable,  Criteria::EQUAL);
        $hours=TimetableHourCatalog::getInstance()->getByCriteria($criteria)->toArray();
        if(empty($hours))
            return false;
        else
            return true;
    }

    public function releaseHour($idTimetableHour){
        $criteria=new Criteria();
        $criteria->add(TimetableHour::ID_TIMETABLE_HOUR,$idTimetableHour,  Criteria::EQUAL);
        $timetableHour=TimetableHourCatalog::getInstance()->getByCriteria($criteria)->getOne();
        if($timetableHour){
            $timetableHour->setStatus(TimetableHour::$Status["released"]);
            TimetableHourCatalog::getInstance ()->update ($timetableHour);
            return json_encode(array("ok" => "ok"));
        }
        else
            return json_encode(array("error" => "No se ha podido liberar la actividad indicada"));
    }

    public function getHours($idEmployee,$beginningDateWeek){
        $select=$this->db->select();
        $select->from(Timetable::TABLENAME,array(Timetable::DATE,  Timetable::STATUS, Timetable::ID_EMPLOYEE,  Timetable::ID_TIMETABLE, Timetable::ATTENDANCE_TYPE,Timetable::ID_PROJECT_TASK,Timetable::DESCRIPTION,Timetable::ID_PROJECT,))
                ->join(TimetableHour::TABLENAME, Timetable::ID_TIMETABLE."=".TimetableHour::ID_TIMETABLE, array(TimetableHour::RECORD_DATE,TimetableHour::HOURS, "day"=>"LOWER(DAYNAME(".TimetableHour::RECORD_DATE."))"))
                ->join(Project::TABLENAME, Timetable::ID_PROJECT."=".Project::ID_PROJECT,"")
                ->join(ProjectTask::TABLENAME, Timetable::ID_PROJECT_TASK."=".ProjectTask::ID_PROJECT_TASK,  ProjectTask::TASK_CODE)
                ->joinLeft(SpecificProject::TABLENAME, Project::ID_PROJECT."=".SpecificProject::ID_PROJECT, SpecificProject::PROJECT_CODE)
                ->joinLeft(DepartmentProject::TABLENAME, Project::ID_PROJECT."=".DepartmentProject::ID_PROJECT,"")
                ->joinLeft(Department::TABLENAME, DepartmentProject::ID_DEPARTMENT."=".Department::ID_DEPARTMENT, Department::DEPARTMENT_CODE)
                ->where(Timetable::ID_EMPLOYEE."=$idEmployee AND ".Timetable::DATE."='$beginningDateWeek'");
        //die($select->__toString());
        return $result=$this->db->fetchAll($select);
    }

    public function getHoursGroupByStatus($idTimetable){
        $select=$this->db->select();
        $select->from(Timetable::TABLENAME,array("count_hours"=>"COUNT(".TimetableHour::ID_TIMETABLE_HOUR.")",  TimetableHour::STATUS))
                ->join(TimetableHour::TABLENAME, Timetable::ID_TIMETABLE."=".TimetableHour::ID_TIMETABLE, "")
                ->where(Timetable::ID_TIMETABLE."=$idTimetable")
                ->group(TimetableHour::STATUS);
        //echo $select->__toString();
        return $this->db->fetchAll($select);
    }
    
    /**     
     * @param $projects
     * @param $date
     * @return TimetableHourCollection
     */
	public function getTaskByProjectAndDate($projects, $date)
    {
        try 
        {
            $sql = "SELECT *
            		FROM ".TimetableHour::TABLENAME."
                    WHERE id_project IN (".$projects.") 
                    AND date_created BETWEEN '".$date." 00:00:00' AND '".$date." 23:59:59' ORDER BY status";
            //echo $sql;
            $timetableHourCollection = new TimetableHourCollection();
            foreach ($this->db->fetchAll($sql) as $result){
                $timetableHourCollection->append($this->getTimetableHourInstance($result));
            }
        }
        catch(Zend_Db_Exception $e)
        {
            throw new TimetableHourException("Cant obtain TimetableHourCollection\n" . $e->getMessage());
        }
        return $timetableHourCollection;
         
    }
    
    /*
     * 
     */
   /* public function getIdProjectsByTimetable($idTimetable)
    {
    	try 
        {
            $sql = "SELECT DISTINCT id_project FROM ".TimetableHour::TABLENAME."
                    WHERE id_timetable = ".$idTimetable;
            $result = $this->db->fetchAll($sql);
        } catch (Exception $e) {
            throw new TimetableHourException("Can't obtain idProjects\n" . $e->getMessage());
        }
        return $result;
    }*/
    
    /*****
     * 
     *****/
   /* public function getIdProjectTasksByIdProject($idProject, $idTimetable)
    {
    	try 
        {
            $sql = "SELECT DISTINCT id_project_task FROM ".TimetableHour::TABLENAME."
                    WHERE status = 2 
                    AND id_project = ".$idProject." 
                    AND id_timetable = ".$idTimetable;
            $result = $this->db->fetchAll($sql);
        } catch (Exception $e) {
            throw new TimetableHourException("Can't obtain idProjectTasks\n" . $e->getMessage());
        }
        return $result;
    }*/
    
    /*
     * 
     */
    public function getSumHoursByIdProject($idTimetable)
    {
    	try 
        {
            $sql = "SELECT SUM(hours) as sum FROM ".TimetableHour::TABLENAME."
                    WHERE id_timetable = ".$idTimetable;
            list($sum) = $this->db->fetchCol($sql);
            $result = $sum;
        } catch (Exception $e) {
            throw new TimetableHourException("Can't obtain idProjectTasks\n" . $e->getMessage());
        }
        return $result;
    }
    
    /*****
     * 
     *****/
    public function getSumHoursByIdProjectTask($idTimetable)
    {
    	try 
        {
            $sql = "SELECT SUM(hours) as sum FROM ".TimetableHour::TABLENAME."
                    WHERE id_timetable = ".$idTimetable;
            list($sum) = $this->db->fetchCol($sql);
            $result = $sum;
        } catch (Exception $e) {
            throw new TimetableHourException("Can't obtain hours amount\n" . $e->getMessage().$sql);
        }
        return $result;
    }
    
	/*****
     * 
     *****/
    public function getDayHoursByIdProjectTask($idTimetable)
    {
    	try 
        {
            $sql = "SELECT record_date,hours FROM ".TimetableHour::TABLENAME."
                    WHERE id_timetable = ".$idTimetable;
            $result = $this->db->fetchAll($sql);
        } catch (Exception $e) {
            throw new TimetableHourException("Can't obtain hours amount\n" . $e->getMessage().$sql);
        }
        return $result;
    }
} 
