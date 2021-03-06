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
require_once "application/models/catalogs/ProjectCatalog.php";
require_once "application/models/beans/SpecificProject.php";
require_once "application/models/exceptions/SpecificProjectException.php";
require_once "application/models/collections/SpecificProjectCollection.php";
require_once "application/models/factories/SpecificProjectFactory.php";

/**
 * Singleton SpecificProjectCatalog Class
 *
 * @category   lib
 * @package    lib_models
 * @subpackage lib_models_catalogs
 * @copyright  Copyright (c) 2010 PCSMEXICO
 * @copyright  This File has been proudly generated by Bender (http://code.google.com/p/bender-modeler/). <chentepixtol> <zetta>
 * @author     zetta & chentepixtol
 * @version    1.0.2 SVN: $Revision$
 */
class SpecificProjectCatalog extends ProjectCatalog
{

    /**
     * Singleton Instance
     * @var SpecificProjectCatalog
     */
    static protected $instance = null;


    /**
     * M�todo para obtener la instancia del cat�logo
     * @return SpecificProjectCatalog
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
     * Constructor de la clase SpecificProjectCatalog
     * @return SpecificProjectCatalog
     */
    protected function SpecificProjectCatalog()
    {
        parent::ProjectCatalog();
    }

    /**
     * Metodo para agregar un SpecificProject a la base de datos
     * @param SpecificProject $specificProject Objeto SpecificProject
     */
    public function create($specificProject)
    {
        if(!($specificProject instanceof SpecificProject))
            throw new SpecificProjectException("passed parameter isn't a SpecificProject instance");
        try
        {
            if(!$specificProject->getIdProject())
              parent::create($specificProject);
            $data = array(
                'id_project' => $specificProject->getIdProject(),
                'project_code' => $specificProject->getProjectCode(),
                'project_name' => $specificProject->getProjectName(),
                'beginning_date' => $specificProject->getBeginningDate(),
                'ending_date' => $specificProject->getEndingDate(),
            );
            $data = array_filter($data, 'Catalog::notNull');
            $this->db->insert(SpecificProject::TABLENAME, $data);
            $specificProject->setIdSpecificProject($this->db->lastInsertId());
        }
        catch(Exception $e)
        {
            throw new SpecificProjectException("The SpecificProject can't be saved \n" . $e->getMessage());
        }
    }

    /**
     * Metodo para Obtener los datos de un objeto por su llave primaria
     * @param int $idSpecificProject
     * @param boolean $throw
     * @return SpecificProject|null
     */
    public function getById($idSpecificProject, $throw = false)
    {
        try
        {
            $criteria = new Criteria();
            $criteria->add(SpecificProject::ID_SPECIFIC_PROJECT, $idSpecificProject, Criteria::EQUAL);
            $newSpecificProject = $this->getByCriteria($criteria)->getOne();
        }
        catch(Exception $e)
        {
            throw new SpecificProjectException("Can't obtain the SpecificProject \n" . $e->getMessage());
        }
        if($throw && null == $newSpecificProject)
            throw new SpecificProjectException("The SpecificProject at $idSpecificProject not exists ");
        return $newSpecificProject;
    }

    /**
     * Metodo para Obtener los datos de un objeto por su llave primaria
     * @param int $projectCode
     * @param boolean $throw
     * @return SpecificProject|null
     */
    public function getByProjectCode($projectCode, $throw = false)
    {
        try
        {
            $criteria = new Criteria();
            $criteria->add(SpecificProject::PROJECT_CODE, $projectCode, Criteria::EQUAL);
            $newSpecificProject = $this->getByCriteria($criteria)->getOne();
        }
        catch(Exception $e)
        {
            throw new SpecificProjectException("Can't obtain the SpecificProject \n" . $e->getMessage());
        }
        if($throw && null == $newSpecificProject)
            throw new SpecificProjectException("The SpecificProject at $idSpecificProject not exists ");
        return $newSpecificProject;
    }
    
    /**
     * Metodo para Obtener una colecci�n de objetos por varios ids
     * @param array $ids
     * @return SpecificProjectCollection
     */
    public function getByIds(array $ids)
    {
        if(null == $ids) return new SpecificProjectCollection();
        try
        {
            $criteria = new Criteria();
            $criteria->add(SpecificProject::ID_SPECIFIC_PROJECT, $ids, Criteria::IN);
            $specificProjectCollection = $this->getByCriteria($criteria);
        }
        catch(Exception $e)
        {
            throw new SpecificProjectException("SpecificProjectCollection can't be populated\n" . $e->getMessage());
        }
        return $specificProjectCollection;
    }

    /**
     * Metodo para actualizar un SpecificProject
     * @param SpecificProject $specificProject 
     */
    public function update($specificProject)
    {
        if(!($specificProject instanceof SpecificProject))
            throw new SpecificProjectException("passed parameter isn't a SpecificProject instance");
        try
        {
            $where[] = "id_specific_project = '{$specificProject->getIdSpecificProject()}'";
            $data = array(
                'id_project' => $specificProject->getIdProject(),
                'project_code' => $specificProject->getProjectCode(),
                'project_name' => $specificProject->getProjectName(),
                'beginning_date' => $specificProject->getBeginningDate(),
                'ending_date' => $specificProject->getEndingDate(),
            );
            $data = array_filter($data, 'Catalog::notNull');
            $this->db->update(SpecificProject::TABLENAME, $data, $where);
            parent::update($specificProject);
        }
        catch(Exception $e)
        {
            throw new SpecificProjectException("The SpecificProject can't be updated \n" . $e->getMessage());
        }
    }
    
    /**
     * Metodo para guardar un specificProject
     * @param SpecificProject $specificProject
     */	
    public function save($specificProject)
    {
        if(!($specificProject instanceof SpecificProject))
            throw new SpecificProjectException("passed parameter isn't a SpecificProject instance");
        if(null != $specificProject->getIdSpecificProject())
            $this->update($specificProject);
        else
            $this->create($specificProject);
    }

    /**
     * Metodo para eliminar un specificProject
     * @param SpecificProject $specificProject
     */
    public function delete($specificProject)
    {
        if(!($specificProject instanceof SpecificProject))
            throw new SpecificProjectException("passed parameter isn't a SpecificProject instance");
        $this->deleteById($specificProject->getIdSpecificProject());
        parent::delete($specificProject);
    }

    /**
     * Metodo para eliminar un SpecificProject a partir de su Id
     * @param int $idSpecificProject
     */
    public function deleteById($idSpecificProject)
    {
        try
        {
            $where = array($this->db->quoteInto('id_specific_project = ?', $idSpecificProject));
            $this->db->delete(SpecificProject::TABLENAME, $where);
        }
        catch(Exception $e)
        {
            throw new SpecificProjectException("The SpecificProject can't be deleted\n" . $e->getMessage());
        }
    }
    
    /**
     * Metodo para eliminar varios SpecificProject a partir de su Id
     * @param array $ids
     */
    public function deleteByIds(array $ids)
    {
        try
        {
            $criteria = new Criteria();
            $criteria->add(SpecificProject::ID_SPECIFIC_PROJECT, $ids, Criteria::IN);
            $this->db->delete(SpecificProject::TABLENAME, array($criteria->createSql()));
        }
        catch(Exception $e)
        {
            throw new SpecificProjectException("Can't delete that\n" . $e->getMessage());
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
     * Metodo para obtener todos los id de SpecificProject por criterio
     * @param Criteria $criteria
     * @return array Array con todos los id de SpecificProject que encajen en la busqueda
     */
    public function getIdsByCriteria(Criteria $criteria = null)
    {
        $criteria = (null === $criteria) ? new Criteria() : $criteria;
        return $this->getCustomFieldByCriteria(SpecificProject::ID_SPECIFIC_PROJECT, $criteria);
    }

    /**
     * Metodo para obtener un campo en particular de un SpecificProject dado un criterio
     * @param string $field
     * @param Criteria $criteria
     * @param $distinct
     * @return array Array con el campo de los objetos SpecificProject que encajen en la busqueda
     */
    public function getCustomFieldByCriteria($field, Criteria $criteria = null, $distinct = false)
    { 
        $criteria = (null === $criteria) ? new Criteria() : $criteria;
        $distinct = $distinct ? 'DISTINCT' : '';
        try
        {
            $sql = "SELECT {$distinct} {$field}
                    FROM ".SpecificProject::TABLENAME."
                      INNER JOIN ".Project::TABLENAME." USING ( id_project )
                    WHERE  " . $criteria->createSql();
            $result = $this->db->fetchCol($sql);
        } catch(Zend_Db_Exception $e)
        {
            throw new SpecificProjectException("No se pudieron obtener los fields de objetos SpecificProject\n" . $e->getMessage());
        }
        return $result;
    }

    /**
     * Metodo que regresa una coleccion de objetos SpecificProject 
     * dependiendo del criterio establecido
     * @param Criteria $criteria
     * @return SpecificProjectCollection $specificProjectCollection
     */
    public function getByCriteria(Criteria $criteria = null)
    {
        $criteria = (null === $criteria) ? new Criteria() : $criteria;
        $this->db->setFetchMode(Zend_Db::FETCH_ASSOC);
        try 
        {
            $sql = "SELECT * FROM ".SpecificProject::TABLENAME."
                      INNER JOIN ".Project::TABLENAME." USING ( id_project )
                    WHERE " . $criteria->createSql();
            $specificProjectCollection = new SpecificProjectCollection();
            foreach ($this->db->fetchAll($sql) as $result){
                $specificProjectCollection->append($this->getSpecificProjectInstance($result));
            }
        }
        catch(Zend_Db_Exception $e)
        {
            throw new SpecificProjectException("Cant obtain SpecificProjectCollection\n" . $e->getMessage());
        }
        return $specificProjectCollection;
    }
    
    /**
     * Metodo que cuenta SpecificProject 
     * dependiendo del criterio establecido
     * @param Criteria $criteria
     * @param string $field
     * @return int $count
     */
    public function countByCriteria(Criteria $criteria = null, $field = 'id_specific_project')
    {
        $criteria = (null === $criteria) ? new Criteria() : $criteria;
        try 
        {
            $sql = "SELECT COUNT( $field ) FROM ".SpecificProject::TABLENAME."
                      INNER JOIN ".Project::TABLENAME." USING ( id_project )
                    WHERE " . $criteria->createSql();   
            $count = $this->db->fetchOne($sql);
        }
        catch(Zend_Db_Exception $e)
        {
            throw new SpecificProjectException("Cant obtain the count \n" . $e->getMessage());
        }
        return $count;
    }
    
    /**
     * M�todo que construye un objeto SpecificProject y lo rellena con la informaci�n del rowset
     * @param array $result El arreglo que devolvi� el objeto Zend_Db despues del fetch
     * @return SpecificProject 
     */
    private function getSpecificProjectInstance($result)
    {
        return SpecificProjectFactory::createFromArray($result);
    }
  
    /**
     * Obtiene un SpecificProjectCollection  dependiendo del idProject
     * @param int $idProject  
     * @return SpecificProjectCollection 
     */
    public function getByIdProject($idProject)
    {
        $criteria = new Criteria();
        $criteria->add(SpecificProject::ID_PROJECT, $idProject, Criteria::EQUAL);
        $specificProjectCollection = $this->getByCriteria($criteria);
        return $specificProjectCollection;
    }

	/**
     * Metodo para Obtener los datos de un objeto por idProject
     * @param int $idProject
     * @param boolean $throw
     * @return SpecificProject|null
     */
    public function getByIdProjectObject($idProject, $throw = false)
    {
        try
        {
            $criteria = new Criteria();
            $criteria->add(SpecificProject::ID_PROJECT, $idProject, Criteria::EQUAL);
            $newSpecificProject = $this->getByCriteria($criteria)->getOne();
        }
        catch(Exception $e)
        {
            throw new SpecifictProjectException("Can't obtain the SpecificProject \n" . $e->getMessage());
        }
        if($throw && null == $newDepartmentProject)
            throw new SpecificProjectException("The SpecificProject at $idProject not exists ");
        return $newSpecificProject;
    }
} 
 
