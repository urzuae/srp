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
require_once "application/models/beans/ProjectTask.php";
require_once "application/models/exceptions/ProjectTaskException.php";
require_once "application/models/collections/ProjectTaskCollection.php";
require_once "application/models/factories/ProjectTaskFactory.php";

/**
 * Singleton ProjectTaskCatalog Class
 *
 * @category   lib
 * @package    lib_models
 * @subpackage lib_models_catalogs
 * @copyright  Copyright (c) 2010 PCSMEXICO
 * @copyright  This File has been proudly generated by Bender (http://code.google.com/p/bender-modeler/). <chentepixtol> <zetta>
 * @author     zetta & chentepixtol
 * @version    1.0.2 SVN: $Revision$
 */
class ProjectTaskCatalog extends Catalog
{

    /**
     * Singleton Instance
     * @var ProjectTaskCatalog
     */
    static protected $instance = null;


    /**
     * M�todo para obtener la instancia del cat�logo
     * @return ProjectTaskCatalog
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
     * Constructor de la clase ProjectTaskCatalog
     * @return ProjectTaskCatalog
     */
    protected function ProjectTaskCatalog()
    {
        parent::Catalog();
    }

    /**
     * Metodo para agregar un ProjectTask a la base de datos
     * @param ProjectTask $projectTask Objeto ProjectTask
     */
    public function create($projectTask)
    {
        if(!($projectTask instanceof ProjectTask))
            throw new ProjectTaskException("passed parameter isn't a ProjectTask instance");
        try
        {
            $data = array(
                'task_code' => $projectTask->getTaskCode(),
                'description' => $projectTask->getDescription(),
                'type' => $projectTask->getType(),
                'status' => $projectTask->getStatus(),
            );
            $data = array_filter($data, 'Catalog::notNull');
            $this->db->insert(ProjectTask::TABLENAME, $data);
            $projectTask->setIdProjectTask($this->db->lastInsertId());
        }
        catch(Exception $e)
        {
            throw new ProjectTaskException("The ProjectTask can't be saved \n" . $e->getMessage());
        }
    }

    /**
     * Metodo para Obtener los datos de un objeto por su llave primaria
     * @param int $idProjectTask
     * @param boolean $throw
     * @return ProjectTask|null
     */
    public function getById($idProjectTask, $throw = false)
    {
        try
        {
            $criteria = new Criteria();
            $criteria->add(ProjectTask::ID_PROJECT_TASK, $idProjectTask, Criteria::EQUAL);
            $newProjectTask = $this->getByCriteria($criteria)->getOne();
        }
        catch(Exception $e)
        {
            throw new ProjectTaskException("Can't obtain the ProjectTask \n" . $e->getMessage());
        }
        if($throw && null == $newProjectTask)
            throw new ProjectTaskException("The ProjectTask at $idProjectTask not exists ");
        return $newProjectTask;
    }
    /**
     * Metodo para Obtener los datos de un objeto por su llave primaria
     * @param int $projectTaskCode
     * @param boolean $throw
     * @return ProjectTask|null
     */
    public function getByTaskCode($taskCode, $throw = false)
    {
        try
        {
            $criteria = new Criteria();
            $criteria->add(ProjectTask::TASK_CODE, $taskCode, Criteria::EQUAL);
            $newProjectTask = $this->getByCriteria($criteria)->getOne();
        }
        catch(Exception $e)
        {
            throw new ProjectTaskException("Can't obtain the ProjectTask \n" . $e->getMessage());
        }
        if($throw && null == $newProjectTask)
            throw new ProjectTaskException("The ProjectTask at $idProjectTask not exists ");
        return $newProjectTask;
    }

    
    /**
     * Metodo para Obtener una colecci�n de objetos por varios ids
     * @param array $ids
     * @return ProjectTaskCollection
     */
    public function getByIds(array $ids)
    {
        if(null == $ids) return new ProjectTaskCollection();
        try
        {
            $criteria = new Criteria();
            $criteria->add(ProjectTask::ID_PROJECT_TASK, $ids, Criteria::IN);
            $projectTaskCollection = $this->getByCriteria($criteria);
        }
        catch(Exception $e)
        {
            throw new ProjectTaskException("ProjectTaskCollection can't be populated\n" . $e->getMessage());
        }
        return $projectTaskCollection;
    }

    /**
     * Metodo para actualizar un ProjectTask
     * @param ProjectTask $projectTask 
     */
    public function update($projectTask)
    {
        if(!($projectTask instanceof ProjectTask))
            throw new ProjectTaskException("passed parameter isn't a ProjectTask instance");
        try
        {
            $where[] = "id_project_task = '{$projectTask->getIdProjectTask()}'";
            $data = array(
                'task_code' => $projectTask->getTaskCode(),
                'description' => $projectTask->getDescription(),
                'type' => $projectTask->getType(),
                'status' => $projectTask->getStatus(),
            );
            $data = array_filter($data, 'Catalog::notNull');
            $this->db->update(ProjectTask::TABLENAME, $data, $where);
        }
        catch(Exception $e)
        {
            throw new ProjectTaskException("The ProjectTask can't be updated \n" . $e->getMessage());
        }
    }
    
    /**
     * Metodo para guardar un projectTask
     * @param ProjectTask $projectTask
     */	
    public function save($projectTask)
    {
        if(!($projectTask instanceof ProjectTask))
            throw new ProjectTaskException("passed parameter isn't a ProjectTask instance");
        if(null != $projectTask->getIdProjectTask())
            $this->update($projectTask);
        else
            $this->create($projectTask);
    }

    /**
     * Metodo para eliminar un projectTask
     * @param ProjectTask $projectTask
     */
    public function delete($projectTask)
    {
        if(!($projectTask instanceof ProjectTask))
            throw new ProjectTaskException("passed parameter isn't a ProjectTask instance");
        $this->deleteById($projectTask->getIdProjectTask());
    }

    /**
     * Metodo para eliminar un ProjectTask a partir de su Id
     * @param int $idProjectTask
     */
    public function deleteById($idProjectTask)
    {
        try
        {
            $where = array($this->db->quoteInto('id_project_task = ?', $idProjectTask));
            $this->db->delete(ProjectTask::TABLENAME, $where);
        }
        catch(Exception $e)
        {
            throw new ProjectTaskException("The ProjectTask can't be deleted\n" . $e->getMessage());
        }
    }
    
    /**
     * Metodo para eliminar varios ProjectTask a partir de su Id
     * @param array $ids
     */
    public function deleteByIds(array $ids)
    {
        try
        {
            $criteria = new Criteria();
            $criteria->add(ProjectTask::ID_PROJECT_TASK, $ids, Criteria::IN);
            $this->db->delete(ProjectTask::TABLENAME, array($criteria->createSql()));
        }
        catch(Exception $e)
        {
            throw new ProjectTaskException("Can't delete that\n" . $e->getMessage());
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
     * Metodo para obtener todos los id de ProjectTask por criterio
     * @param Criteria $criteria
     * @return array Array con todos los id de ProjectTask que encajen en la busqueda
     */
    public function getIdsByCriteria(Criteria $criteria = null)
    {
        $criteria = (null === $criteria) ? new Criteria() : $criteria;
        return $this->getCustomFieldByCriteria(ProjectTask::ID_PROJECT_TASK, $criteria);
    }

    /**
     * Metodo para obtener un campo en particular de un ProjectTask dado un criterio
     * @param string $field
     * @param Criteria $criteria
     * @param $distinct
     * @return array Array con el campo de los objetos ProjectTask que encajen en la busqueda
     */
    public function getCustomFieldByCriteria($field, Criteria $criteria = null, $distinct = false)
    { 
        $criteria = (null === $criteria) ? new Criteria() : $criteria;
        $distinct = $distinct ? 'DISTINCT' : '';
        try
        {
            $sql = "SELECT {$distinct} {$field}
                    FROM ".ProjectTask::TABLENAME."
                    WHERE  " . $criteria->createSql();
            $result = $this->db->fetchCol($sql);
        } catch(Zend_Db_Exception $e)
        {
            throw new ProjectTaskException("No se pudieron obtener los fields de objetos ProjectTask\n" . $e->getMessage());
        }
        return $result;
    }

    /**
     * Metodo que regresa una coleccion de objetos ProjectTask 
     * dependiendo del criterio establecido
     * @param Criteria $criteria
     * @return ProjectTaskCollection $projectTaskCollection
     */
    public function getByCriteria(Criteria $criteria = null)
    {
        $criteria = (null === $criteria) ? new Criteria() : $criteria;
        $this->db->setFetchMode(Zend_Db::FETCH_ASSOC);
        try 
        {
            $sql = "SELECT * FROM ".ProjectTask::TABLENAME."
                    WHERE " . $criteria->createSql();
            $projectTaskCollection = new ProjectTaskCollection();
            foreach ($this->db->fetchAll($sql) as $result){
                $projectTaskCollection->append($this->getProjectTaskInstance($result));
            }
        }
        catch(Zend_Db_Exception $e)
        {
            throw new ProjectTaskException("Cant obtain ProjectTaskCollection\n" . $e->getMessage());
        }
        return $projectTaskCollection;
    }
    
    /**
     * Metodo que cuenta ProjectTask 
     * dependiendo del criterio establecido
     * @param Criteria $criteria
     * @param string $field
     * @return int $count
     */
    public function countByCriteria(Criteria $criteria = null, $field = 'id_project_task')
    {
        $criteria = (null === $criteria) ? new Criteria() : $criteria;
        try 
        {
            $sql = "SELECT COUNT( $field ) FROM ".ProjectTask::TABLENAME."
                    WHERE " . $criteria->createSql();   
            $count = $this->db->fetchOne($sql);
        }
        catch(Zend_Db_Exception $e)
        {
            throw new ProjectTaskException("Cant obtain the count \n" . $e->getMessage());
        }
        return $count;
    }
    
    /**
     * M�todo que construye un objeto ProjectTask y lo rellena con la informaci�n del rowset
     * @param array $result El arreglo que devolvi� el objeto Zend_Db despues del fetch
     * @return ProjectTask 
     */
    private function getProjectTaskInstance($result)
    {
        return ProjectTaskFactory::createFromArray($result);
    }

    /**
     * Metodo que regresa una coleccion de objetos ProjectTask con Status 'Active'
     * dependiendo del criterio establecido
     * @param Criteria $criteria
     * @return ProjectTaskCollection $projectTaskCollection
     */
    public function getActives(Criteria $criteria = null)
    {
        $criteria = (null === $criteria) ? new Criteria() : $criteria;
        $criteria->add(ProjectTask::STATUS, ProjectTask::$Status['Active'], Criteria::EQUAL);
        return $this->getByCriteria($criteria);
    }
    
    /**
     * Metodo que regresa una coleccion de objetos ProjectTask con Status 'Inactive'
     * dependiendo del criterio establecido
     * @param Criteria $criteria
     * @return ProjectTaskCollection $projectTaskCollection
     */
    public function getInactives(Criteria $criteria = null)
    {
        $criteria = (null === $criteria) ? new Criteria() : $criteria;
        $criteria->add(ProjectTask::STATUS, ProjectTask::$Status['Inactive'], Criteria::EQUAL);
        return $this->getByCriteria($criteria);
    }
    
    /**
     * Activate a projectTask
     * @param ProjectTask $projectTask
     */ 
    public function activate($projectTask)
    {
        if(!($projectTask instanceof ProjectTask))
            throw new ProjectTaskException("passed parameter isn't a ProjectTask instance");
        if(ProjectTask::$Status['Active'] != $projectTask->getStatus())
        {
            $projectTask->setStatus(ProjectTask::$Status['Active']);
            $this->save($projectTask);
        }
    }
    
    /**
     * Deactivate a projectTask
     * @param ProjectTask $projectTask
     */ 
    public function deactivate($projectTask)
    {
        if(!($projectTask instanceof ProjectTask))
            throw new ProjectTaskException("passed parameter isn't a ProjectTask instance");
        if(ProjectTask::$Status['Inactive'] != $projectTask->getStatus())
        {
            $projectTask->setStatus(ProjectTask::$Status['Inactive']);
            $this->save($projectTask);
        }
    }

    /**
     * Link a ProjectTask to Project
     * @param int $idProjectTask
     * @param int $idProject
     */
    public function linkToProject($idProjectTask, $idProject)
    {
        try
        {
            $this->unlinkFromProject($idProjectTask, $idProject);
            $data = array(
                'id_project_task' => $idProjectTask,
                'id_project' => $idProject,
            );
            $this->db->insert(ProjectTask::TABLENAME_PROJECT_TASK_PROJECT, $data);
        }
        catch(Exception $e)
        {
            throw new ProjectTaskException("Can't link ProjectTask to Project\n" . $e->getMessage());
        }
    }

    /**
     * Unlink a ProjectTask from Project
     * @param int $idProjectTask
     * @param int $idProject
     */
    public function unlinkFromProject($idProjectTask, $idProject)
    {
        try
        {
            $where = array(
                $this->db->quoteInto('id_project_task = ?', $idProjectTask),
                $this->db->quoteInto('id_project = ?', $idProject),
            );
            $this->db->delete(ProjectTask::TABLENAME_PROJECT_TASK_PROJECT, $where);
        }
        catch(Exception $e)
        {
            throw new ProjectTaskException("Can't unlink ProjectTask to Project\n" . $e->getMessage());
        }
    }

    /**
     * Unlink all Project relations
     * @param int $idProjectTask
     */
    public function unlinkAllProjectRelations($idProjectTask)
    {
        try
        {
            $where = array(
                $this->db->quoteInto('id_project_task = ?', $idProjectTask),
            );
            $this->db->delete(ProjectTask::TABLENAME_PROJECT_TASK_PROJECT, $where);
        }
        catch(Exception $e)
        {
            throw new ProjectTaskException("Can't unlink all Project relations \n" . $e->getMessage());
        }
    }

    /**
     * Get ProjectTask - Project relations by Criteria
     * @param Criteria $criteria
     * @return array
     */
    public function getProjectTaskProjectRelations(Criteria $criteria = null)
    { 
        $criteria = (null === $criteria) ? new Criteria() : $criteria;
        $this->db->setFetchMode(Zend_Db::FETCH_ASSOC);
        try
        {
           $sql = "SELECT * FROM ". ProjectTask::TABLENAME_PROJECT_TASK_PROJECT ."
                   WHERE  " . $criteria->createSql();
           $result = $this->db->fetchAll($sql);
        } catch(Exception $e)
        {
           throw new ProjectTaskException("Can't obtain relations by criteria\n" . $e->getMessage());
        }
        return $result;
    }

    /**
     * Get ProjectTaskCollection by Project
     * @param int $idProject
     * @return ProjectTaskCollection
     */
    public function getByProject($idProject)
    {
        $criteria = new Criteria();
        $criteria->add('id_project', $idProject, Criteria::EQUAL);
        $projectTaskProject = $this->getProjectTaskProjectRelations($criteria);
        $ids = array();
        foreach($projectTaskProject as $rs){
            $ids[] = $rs['id_project_task'];
        }
        return $this->getByIds($ids);
    }


} 
 
