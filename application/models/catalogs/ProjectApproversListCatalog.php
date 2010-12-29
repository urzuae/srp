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
require_once "application/models/beans/ProjectApproversList.php";
require_once "application/models/exceptions/ProjectApproversListException.php";
require_once "application/models/collections/ProjectApproversListCollection.php";
require_once "application/models/factories/ProjectApproversListFactory.php";

/**
 * Singleton ProjectApproversListCatalog Class
 *
 * @category   lib
 * @package    lib_models
 * @subpackage lib_models_catalogs
 * @copyright  Copyright (c) 2010 PCSMEXICO
 * @copyright  This File has been proudly generated by Bender (http://code.google.com/p/bender-modeler/). <chentepixtol> <zetta>
 * @author     zetta & chentepixtol
 * @version    1.0.2 SVN: $Revision$
 */
class ProjectApproversListCatalog extends Catalog
{

    /**
     * Singleton Instance
     * @var ProjectApproversListCatalog
     */
    static protected $instance = null;


    /**
     * M�todo para obtener la instancia del cat�logo
     * @return ProjectApproversListCatalog
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
     * Constructor de la clase ProjectApproversListCatalog
     * @return ProjectApproversListCatalog
     */
    protected function ProjectApproversListCatalog()
    {
        parent::Catalog();
    }

    /**
     * Metodo para agregar un ProjectApproversList a la base de datos
     * @param ProjectApproversList $projectApproversList Objeto ProjectApproversList
     */
    public function create($projectApproversList)
    {
        if(!($projectApproversList instanceof ProjectApproversList))
            throw new ProjectApproversListException("passed parameter isn't a ProjectApproversList instance");
        try
        {
            $data = array(
                'id_project' => $projectApproversList->getIdProject(),
                'id_employee' => $projectApproversList->getIdEmployee(),
                'is_main' => $projectApproversList->getIsMain(),
                'level' => $projectApproversList->getLevel(),
            );
            $data = array_filter($data, 'Catalog::notNull');
            $this->db->insert(ProjectApproversList::TABLENAME, $data);
            $projectApproversList->setIdProjectApproversList($this->db->lastInsertId());
        }
        catch(Exception $e)
        {
            throw new ProjectApproversListException("The ProjectApproversList can't be saved \n" . $e->getMessage());
        }
    }

    /**
     * Metodo para Obtener los datos de un objeto por su llave primaria
     * @param int $idProjectApproversList
     * @param boolean $throw
     * @return ProjectApproversList|null
     */
    public function getById($idProjectApproversList, $throw = false)
    {
        try
        {
            $criteria = new Criteria();
            $criteria->add(ProjectApproversList::ID_PROJECT_APPROVERS_LIST, $idProjectApproversList, Criteria::EQUAL);
            $newProjectApproversList = $this->getByCriteria($criteria)->getOne();
        }
        catch(Exception $e)
        {
            throw new ProjectApproversListException("Can't obtain the ProjectApproversList \n" . $e->getMessage());
        }
        if($throw && null == $newProjectApproversList)
            throw new ProjectApproversListException("The ProjectApproversList at $idProjectApproversList not exists ");
        return $newProjectApproversList;
    }
    
    /**
     * Metodo para Obtener una colecci�n de objetos por varios ids
     * @param array $ids
     * @return ProjectApproversListCollection
     */
    public function getByIds(array $ids)
    {
        if(null == $ids) return new ProjectApproversListCollection();
        try
        {
            $criteria = new Criteria();
            $criteria->add(ProjectApproversList::ID_PROJECT_APPROVERS_LIST, $ids, Criteria::IN);
            $projectApproversListCollection = $this->getByCriteria($criteria);
        }
        catch(Exception $e)
        {
            throw new ProjectApproversListException("ProjectApproversListCollection can't be populated\n" . $e->getMessage());
        }
        return $projectApproversListCollection;
    }

    /**
     * Metodo para actualizar un ProjectApproversList
     * @param ProjectApproversList $projectApproversList 
     */
    public function update($projectApproversList)
    {
        if(!($projectApproversList instanceof ProjectApproversList))
            throw new ProjectApproversListException("passed parameter isn't a ProjectApproversList instance");
        try
        {
            $where[] = "id_project_approvers_list = '{$projectApproversList->getIdProjectApproversList()}'";
            $data = array(
                'id_project' => $projectApproversList->getIdProject(),
                'id_employee' => $projectApproversList->getIdEmployee(),
                'is_main' => $projectApproversList->getIsMain(),
                'level' => $projectApproversList->getLevel(),
            );
            $data = array_filter($data, 'Catalog::notNull');
            $this->db->update(ProjectApproversList::TABLENAME, $data, $where);
        }
        catch(Exception $e)
        {
            throw new ProjectApproversListException("The ProjectApproversList can't be updated \n" . $e->getMessage());
        }
    }
    
    /**
     * Metodo para guardar un projectApproversList
     * @param ProjectApproversList $projectApproversList
     */	
    public function save($projectApproversList)
    {
        if(!($projectApproversList instanceof ProjectApproversList))
            throw new ProjectApproversListException("passed parameter isn't a ProjectApproversList instance");
        if(null != $projectApproversList->getIdProjectApproversList())
            $this->update($projectApproversList);
        else
            $this->create($projectApproversList);
    }

    /**
     * Metodo para eliminar un projectApproversList
     * @param ProjectApproversList $projectApproversList
     */
    public function delete($projectApproversList)
    {
        if(!($projectApproversList instanceof ProjectApproversList))
            throw new ProjectApproversListException("passed parameter isn't a ProjectApproversList instance");
        $this->deleteById($projectApproversList->getIdProjectApproversList());
    }

    /**
     * Metodo para eliminar un ProjectApproversList a partir de su Id
     * @param int $idProjectApproversList
     */
    public function deleteById($idProjectApproversList)
    {
        try
        {
            $where = array($this->db->quoteInto('id_project_approvers_list = ?', $idProjectApproversList));
            $this->db->delete(ProjectApproversList::TABLENAME, $where);
        }
        catch(Exception $e)
        {
            throw new ProjectApproversListException("The ProjectApproversList can't be deleted\n" . $e->getMessage());
        }
    }
    
    /**
     * Metodo para eliminar varios ProjectApproversList a partir de su Id
     * @param array $ids
     */
    public function deleteByIds(array $ids)
    {
        try
        {
            $criteria = new Criteria();
            $criteria->add(ProjectApproversList::ID_PROJECT_APPROVERS_LIST, $ids, Criteria::IN);
            $this->db->delete(ProjectApproversList::TABLENAME, array($criteria->createSql()));
        }
        catch(Exception $e)
        {
            throw new ProjectApproversListException("Can't delete that\n" . $e->getMessage());
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
     * Metodo para obtener todos los id de ProjectApproversList por criterio
     * @param Criteria $criteria
     * @return array Array con todos los id de ProjectApproversList que encajen en la busqueda
     */
    public function getIdsByCriteria(Criteria $criteria = null)
    {
        $criteria = (null === $criteria) ? new Criteria() : $criteria;
        return $this->getCustomFieldByCriteria(ProjectApproversList::ID_PROJECT_APPROVERS_LIST, $criteria);
    }

    /**
     * Metodo para obtener un campo en particular de un ProjectApproversList dado un criterio
     * @param string $field
     * @param Criteria $criteria
     * @param $distinct
     * @return array Array con el campo de los objetos ProjectApproversList que encajen en la busqueda
     */
    public function getCustomFieldByCriteria($field, Criteria $criteria = null, $distinct = false)
    { 
        $criteria = (null === $criteria) ? new Criteria() : $criteria;
        $distinct = $distinct ? 'DISTINCT' : '';
        try
        {
            $sql = "SELECT {$distinct} {$field}
                    FROM ".ProjectApproversList::TABLENAME."
                    WHERE  " . $criteria->createSql();
            $result = $this->db->fetchCol($sql);
        } catch(Zend_Db_Exception $e)
        {
            throw new ProjectApproversListException("No se pudieron obtener los fields de objetos ProjectApproversList\n" . $e->getMessage());
        }
        return $result;
    }

    /**
     * Metodo que regresa una coleccion de objetos ProjectApproversList 
     * dependiendo del criterio establecido
     * @param Criteria $criteria
     * @return ProjectApproversListCollection $projectApproversListCollection
     */
    public function getByCriteria(Criteria $criteria = null)
    {
        $criteria = (null === $criteria) ? new Criteria() : $criteria;
        $this->db->setFetchMode(Zend_Db::FETCH_ASSOC);
        try 
        {
            $sql = "SELECT * FROM ".ProjectApproversList::TABLENAME."
                    WHERE " . $criteria->createSql();
            $projectApproversListCollection = new ProjectApproversListCollection();
            foreach ($this->db->fetchAll($sql) as $result){
                $projectApproversListCollection->append($this->getProjectApproversListInstance($result));
            }
        }
        catch(Zend_Db_Exception $e)
        {
            throw new ProjectApproversListException("Cant obtain ProjectApproversListCollection\n" . $e->getMessage());
        }
        return $projectApproversListCollection;
    }
    
    /**
     * Metodo que cuenta ProjectApproversList 
     * dependiendo del criterio establecido
     * @param Criteria $criteria
     * @param string $field
     * @return int $count
     */
    public function countByCriteria(Criteria $criteria = null, $field = 'id_project_approvers_list')
    {
        $criteria = (null === $criteria) ? new Criteria() : $criteria;
        try 
        {
            $sql = "SELECT COUNT( $field ) FROM ".ProjectApproversList::TABLENAME."
                    WHERE " . $criteria->createSql();   
            $count = $this->db->fetchOne($sql);
        }
        catch(Zend_Db_Exception $e)
        {
            throw new ProjectApproversListException("Cant obtain the count \n" . $e->getMessage());
        }
        return $count;
    }
    
    /**
     * M�todo que construye un objeto ProjectApproversList y lo rellena con la informaci�n del rowset
     * @param array $result El arreglo que devolvi� el objeto Zend_Db despues del fetch
     * @return ProjectApproversList 
     */
    private function getProjectApproversListInstance($result)
    {
        return ProjectApproversListFactory::createFromArray($result);
    }
  
    /**
     * Obtiene un ProjectApproversListCollection  dependiendo del idProject
     * @param int $idProject  
     * @return ProjectApproversListCollection 
     */
    public function getByIdProject($idProject)
    {
        $criteria = new Criteria();
        $criteria->add(ProjectApproversList::ID_PROJECT, $idProject, Criteria::EQUAL);
        $projectApproversListCollection = $this->getByCriteria($criteria);
        return $projectApproversListCollection;
    }
  
    /**
     * Obtiene un ProjectApproversListCollection  dependiendo del idEmployee
     * @param int $idEmployee  
     * @return ProjectApproversListCollection 
     */
    public function getByIdEmployee($idEmployee)
    {
        $criteria = new Criteria();
        $criteria->add(ProjectApproversList::ID_EMPLOYEE, $idEmployee, Criteria::EQUAL);
        $projectApproversListCollection = $this->getByCriteria($criteria);
        return $projectApproversListCollection;
    }


} 
 
