<?php
/**
 * Bender Modeler
 *
 * Our Simple Models
 *
 * @category   lib
 * @package    lib_models
 * @copyright  Copyright (c) 2008-2010 Bender Modeler (http://www.ctrl-zetta.com/#code)
 * @author     <zetta> <chentepixtol>, $LastChangedBy$
 * @version    1.0.0 SVN: $Id$
 */

/**
 * Dependences
 */
require_once "lib/db/Catalog.php";
require_once "application/models/beans/SecurityController.php";
require_once "application/models/exceptions/SecurityControllerException.php";
require_once "application/models/collections/SecurityControllerCollection.php";
require_once "application/models/factories/SecurityControllerFactory.php";

/**
 * Singleton SecurityControllerCatalog Class
 *
 * @category   lib
 * @package    lib_models
 * @subpackage lib_models_catalogs
 * @copyright  Copyright (c) 2008-2010 Bender Modeler (http://www.ctrl-zetta.com/#code)
 * @copyright  This File as been proudly generated by Bender (http://code.google.com/p/bender-modeler/). <chentepixtol> <zetta>
 * @author     zetta & chentepixtol
 * @version    1.0.0 SVN: $Revision$
 */
class SecurityControllerCatalog extends Catalog
{

    /**
     * Singleton Instance
     * @var SecurityControllerCatalog
     */
    static protected $instance = null;


    /**
     * Método para obtener la instancia del catálogo
     * @return SecurityControllerCatalog
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
     * Constructor de la clase SecurityControllerCatalog
     * @return SecurityControllerCatalog
     */
    protected function SecurityControllerCatalog()
    {
        parent::Catalog();
    }

    /**
     * Metodo para agregar un SecurityController a la base de datos
     * @param SecurityController $securityController Objeto SecurityController
     */
    public function create($securityController)
    {
        if(!($securityController instanceof SecurityController))
            throw new SecurityControllerException("passed parameter isn't a SecurityController instance");
        try
        {
            $data = array(
                'name' => $securityController->getName(),
            );
            $data = array_filter($data, 'Catalog::notNull');
            $this->db->insert(SecurityController::TABLENAME, $data);
            $securityController->setIdController($this->db->lastInsertId());
        }
        catch(Exception $e)
        {
            throw new SecurityControllerException("The SecurityController can't be saved \n" . $e->getMessage());
        }
    }

    /**
     * Metodo para Obtener los datos de un objeto por su llave primaria
     * @param int $idController
     * @return SecurityController|null
     */
    public function getById($idController)
    {
        try
        {
            $criteria = new Criteria();
            $criteria->add(SecurityController::ID_CONTROLLER, $idController, Criteria::EQUAL);
            $newSecurityController = $this->getByCriteria($criteria)->getOne();
        }
        catch(Exception $e)
        {
            throw new SecurityControllerException("Can't obtain the SecurityController \n" . $e->getMessage());
        }
        return $newSecurityController;
    }
    
    /**
     * Metodo para Obtener una colección de objetos por varios ids
     * @param array $ids
     * @return SecurityControllerCollection
     */
    public function getByIds(array $ids)
    {
        if(null == $ids) return new SecurityControllerCollection();
        try
        {
            $criteria = new Criteria();
            $criteria->add(SecurityController::ID_CONTROLLER, $ids, Criteria::IN);
            $securityControllerCollection = $this->getByCriteria($criteria);
        }
        catch(Exception $e)
        {
            throw new SecurityControllerException("SecurityControllerCollection can't be populated\n" . $e->getMessage());
        }
        return $securityControllerCollection;
    }

    /**
     * Metodo para Obtener todos los ids en un arreglo
     * @return array
     */
    public function retrieveAllIds()
    {
        try
        {
            $result = $this->db->fetchCol('SELECT id_controller FROM '.SecurityController::TABLENAME);
        }
        catch(Exception $e)
        {
            throw new SecurityControllerException("Can't obtain the ids\n" . $e->getMessage());
        }
        return $result;
    }

    /**
     * Metodo para actualizar un SecurityController
     * @param SecurityController $securityController 
     */
    public function update($securityController)
    {
        if(!($securityController instanceof SecurityController))
            throw new SecurityControllerException("passed parameter isn't a SecurityController instance");
        try
        {
            $where[] = "id_controller = '{$securityController->getIdController()}'";
            $data = array(
                'name' => $securityController->getName(),
            );
            $data = array_filter($data, 'Catalog::notNull');
            $this->db->update(SecurityController::TABLENAME, $data, $where);
        }
        catch(Exception $e)
        {
            throw new SecurityControllerException("The SecurityController can't be updated \n" . $e->getMessage());
        }
    }
    
    /**
     * Metodo para guardar un securityController
     * @param SecurityController $securityController
     */	
    public function save($securityController)
    {
        if(!($securityController instanceof SecurityController))
            throw new SecurityControllerException("passed parameter isn't a SecurityController instance");
        if(null != $securityController->getIdController())
            $this->update($securityController);
        else
            $this->create($securityController);
    }

    /**
     * Metodo para eliminar un securityController
     * @param SecurityController $securityController
     */
    public function delete($securityController)
    {
        if(!($securityController instanceof SecurityController))
            throw new SecurityControllerException("passed parameter isn't a SecurityController instance");
        $this->deleteById($securityController->getIdController());
    }

    /**
     * Metodo para eliminar un SecurityController a partir de su Id
     * @param int $idController
     */
    public function deleteById($idController)
    {
        try
        {
            $where = array($this->db->quoteInto('id_controller = ?', $idController));
            $this->db->delete(SecurityController::TABLENAME, $where);
        }
        catch(Exception $e)
        {
            throw new SecurityControllerException("The SecurityController can't be deleted\n" . $e->getMessage());
        }
    }
    
    /**
     * Metodo para eliminar varios SecurityController a partir de su Id
     * @param array $ids
     */
    public function deleteByIds(array $ids)
    {
        try
        {
            $criteria = new Criteria();
            $criteria->add(SecurityController::ID_CONTROLLER, $ids, Criteria::IN);
            $this->db->delete(SecurityController::TABLENAME, array($criteria->createSql()));
        }
        catch(Exception $e)
        {
            throw new SecurityControllerException("Can't delete that\n" . $e->getMessage());
        }
    }

    /**
     * Metodo para obtener todos los id de SecurityController por criterio
     * @param Criteria $criteria
     * @return array Array con todos los id de SecurityController que encajen en la busqueda
     */
    public function getIdsByCriteria(Criteria $criteria = null)
    {
        $criteria = (null === $criteria) ? new Criteria() : $criteria;
        try
        {
            $sql = "SELECT id_controller
                    FROM ".SecurityController::TABLENAME."
                    WHERE  " . $criteria->createSql();
            $ids = $this->db->fetchCol($sql);
        } catch(Exception $e)
        {
            throw new SecurityControllerException("Can't obtain SecurityController's id\n" . $e->getMessage());
        }
        return $ids;
    }

    /**
     * Metodo para obtener un campo en particular de un SecurityController dado un criterio
     * @param string $field
     * @param Criteria $criteria
     * @return array Array con el campo de los objetos SecurityController que encajen en la busqueda
     */
    public function getCustomFieldByCriteria($field, Criteria $criteria = null)
    { 
        $criteria = (null === $criteria) ? new Criteria() : $criteria;
        try
        {
            $sql = "SELECT {$field}
                    FROM ".SecurityController::TABLENAME."
                    WHERE  " . $criteria->createSql();
            $result = $this->db->fetchCol($sql);
        } catch(Zend_Db_Exception $e)
        {
            throw new SecurityControllerException("No se pudieron obtener los ids de objetos {$Bean}\n" . $e->getMessage());
        }
        return $result;
    }

    /**
     * Metodo que regresa una coleccion de objetos SecurityController 
     * dependiendo del criterio establecido
     * @param Criteria $criteria
     * @return SecurityControllerCollection $securityControllerCollection
     */
    public function getByCriteria(Criteria $criteria = null)
    {
        $criteria = (null === $criteria) ? new Criteria() : $criteria;
        $this->db->setFetchMode(Zend_Db::FETCH_ASSOC);
        try 
        {
            $sql = "SELECT * FROM ".SecurityController::TABLENAME."
                    WHERE " . $criteria->createSql();
            $securityControllerCollection = new SecurityControllerCollection();
            foreach ($this->db->fetchAll($sql) as $result){
                $securityControllerCollection->append($this->getSecurityControllerInstance($result));
            }
        }
        catch(Zend_Db_Exception $e)
        {
            throw new SecurityControllerException("Cant obtain SecurityControllerCollection\n" . $e->getMessage());
        }
        return $securityControllerCollection;
    }
    
    /**
     * Metodo que cuenta SecurityController 
     * dependiendo del criterio establecido
     * @param Criteria $criteria
     * @param string $field
     * @return int $count
     */
    public function countByCriteria(Criteria $criteria = null, $field = 'id_controller')
    {
        $criteria = (null === $criteria) ? new Criteria() : $criteria;
        try 
        {
            $sql = "SELECT COUNT( $field ) FROM ".SecurityController::TABLENAME."
                    WHERE " . $criteria->createSql();   
            $count = $this->db->fetchOne($sql);
        }
        catch(Zend_Db_Exception $e)
        {
            throw new SecurityControllerException("Cant obtain the count \n" . $e->getMessage());
        }
        return $count;
    }
    
    /**
     * Método que construye un objeto SecurityController y lo rellena con la información del rowset
     * @param array $result El arreglo que devolvió el objeto Zend_Db despues del fetch
     * @return SecurityController 
     */
    private function getSecurityControllerInstance($result)
    {
        return SecurityControllerFactory::createFromArray($result);
    }


} 
 
