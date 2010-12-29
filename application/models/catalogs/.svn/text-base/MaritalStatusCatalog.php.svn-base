<?php
/**
 * ##$BRAND_NAME$## 
 *
 * ##$DESCRIPTION$##
 *
 * @category   Project
 * @package    Project_Models
 * @copyright  ##$COPYRIGHT$##
 * @author     ##$AUTHOR$##, $LastChangedBy$
 * @version    ##$VERSION$##, SVN:  $Id$
 */

/**
 * Catalog
 */
require_once 'lib/db/Catalog.php';

/**
 * MaritalStatusFactory
 */
require_once 'application/models/factories/MaritalStatusFactory.php';

/**
 * MaritalStatusCollection
 */
require_once 'application/models/collections/MaritalStatusCollection.php';

/**
 * Clase MaritalStatusCatalog
 *
 * @category   Project
 * @package    Project_Db
 * @copyright  ##$COPYRIGHT$##
 * @copyright  ##$COPYRIGHT$##
 * @author     ##$AUTHOR$##, $LastChangedBy$
 * @version    ##$VERSION$##, SVN:  $Id$
 */
class MaritalStatusCatalog extends Catalog
{
    /**
     * Instancia singleton
     * @var MaritalStatusCatalog
     */
    static protected $instance   = null;

    /**
     * Método para obtener la instancia del catálogo
     * @return MaritalStatusCatalog
     */
    public static function getInstance()
    {
        if (!isset(self::$instance))
        {
          self::$instance = new MaritalStatusCatalog();
        }
        return self::$instance;
    }

    /**
     * Constructor de la clase MaritalStatusCatalog
     * @return MaritalStatusCatalog
     */
    private function MaritalStatusCatalog()
    {
        parent::Catalog();
    }

    /**
     * Metodo para agregar un MaritalStatus a la base de datos
     * @param MaritalStatus $maritalStatus Objeto MaritalStatus
     */
    public function create($maritalStatus)
    {
        if(!($maritalStatus instanceof MaritalStatus))
            throw new Exception("El parámetro [$maritalStatus] no es una instancia de MaritalStatus");
        try
        {
            $data = array(
                'name' => $maritalStatus->getName(),
            );
            $this->db->insert(MaritalStatus::TABLENAME, $data);
            $maritalStatus->setIdMaritalStatus($this->db->lastInsertId());
        }
        catch(Exception $e)
        {
            throw new Exception("El objeto MaritalStatus no pudo ser guardado en la base de datos\n" . $e->getMessage());
        }
    }

    /**
     * Metodo para Obtener los datos de un objeto por su llave primaria
     * @param int $idMaritalStatus
     * @return MaritalStatus|null Objeto MaritalStatus si existe, caso contrario retorna null;
     */
    public function getById($idMaritalStatus)
    {
        try
        {
            $criteria = new Criteria();
            $criteria->add(MaritalStatus::ID_MARITAL_STATUS, $idMaritalStatus, Criteria::EQUAL);
            $newMaritalStatus = $this->getByCriteria($criteria)->getOne();
        }
        catch(Exception $e)
        {
            throw new Exception("El objeto MaritalStatus no pudo ser obtenido\n" . $e->getMessage());
        }
        return $newMaritalStatus;
    }

    /**
     * Metodo para Obtener todos los ids en un arreglo
     * @return array
     */
    public function retrieveAllIds()
    {
        try
        {
            $result = $this->db->fetchCol('SELECT id_marital_status FROM '.MaritalStatus::TABLENAME);
        }
        catch(Exception $e)
        {
            throw new Exception("No se pudieron obtener los ids\n" . $e->getMessage());
        }
        return $result;
    }

    /**
     * Metodo para actualizar un MaritalStatus
     * @param MaritalStatus $MaritalStatus Objeto MaritalStatus
     */
    public function update($maritalStatus)
    {
        if(!($maritalStatus instanceof MaritalStatus))
            throw new Exception("El parámetro [$maritalStatus] no es una instancia de MaritalStatus");
        try
        {
            $where[] = "id_marital_status = '{$maritalStatus->getIdMaritalStatus()}'";
            $data = array(
                'name' => $maritalStatus->getName(),
            );
            $this->db->update(MaritalStatus::TABLENAME, $data, $where);
        }
        catch(Exception $e)
        {
            throw new Exception("El objeto MaritalStatus no pudo ser actualizado\n" . $e->getMessage());
        }
    }

    /**
     * Metodo para eliminar un MaritalStatus
     * @param MaritalStatus $MaritalStatus Objeto MaritalStatus
     */
    public function delete($maritalStatus)
    {
        if(!($maritalStatus instanceof MaritalStatus))
            throw new Exception("El parámetro [$maritalStatus] no es una instancia de MaritalStatus");
        try
        {
            $where[] = "id_marital_status = '{$maritalStatus->getIdMaritalStatus()}'";
            $this->db->delete(MaritalStatus::TABLENAME, $where);
        }
        catch(Exception $e)
        {
            throw new Exception("El objeto MaritalStatus no pudo ser eliminado\n" . $e->getMessage());
        }
    }

    /**
     * Metodo para eliminar un MaritalStatus a partir de su Id
     * @param int $MaritalStatus
     */
    public function deleteById($idMaritalStatus)
    {
        try
        {
            $where[] = "id_marital_status = '{$idMaritalStatus}'";
            $this->db->delete(MaritalStatus::TABLENAME, $where);
        }
        catch(Exception $e)
        {
            throw new Exception("El objeto MaritalStatus no pudo ser eliminado\n" . $e->getMessage());
        }
    }

    /**
     * Metodo para obtener todos los id de MaritalStatus por criterio
     * @param Criteria $criteria
     * @return array Array con todos los id de MaritalStatus que encajen en la busqueda
     */
    public function getIdsByCriteria(Criteria $criteria)
    {
        try
        {
            $sql = "SELECT id_marital_status
                    FROM ".MaritalStatus::TABLENAME."
                    WHERE  " . $criteria->createSql();
            $result = $this->db->fetchCol($sql);
        } catch(Exception $e)
        {
            throw new Exception("No se pudieron obtener los ids de objetos MaritalStatus\n" . $e->getMessage());
        }
        return $result;
    }

    /**
     * Metodo para obtener un campo en particular de un MaritalStatus dado un criterio
     * @param Criteria $criteria
     * @param string $field
     * @return array Array con el campo de los objetos MaritalStatus que encajen en la busqueda
     */
    public function getCustomFieldByCriteria(Criteria $criteria, $field)
    {
        try
        {
            $sql = "SELECT {$field}
                    FROM ".MaritalStatus::TABLENAME."
                    WHERE  " . $criteria->createSql();
            $result = $this->db->fetchCol($sql);
        } catch(Exception $e)
        {
            throw new Exception("No se pudieron obtener los ids de objetos MaritalStatus\n" . $e->getMessage());
        }
        return $result;
    }

    /**
     * Metodo que regresa una coleccion de objetos MaritalStatus
     * dependiendo del criterio establecido
     * @param Criteria $criteria
     * @return MaritalStatusCollection $objects
     */
    public function getByCriteria(Criteria $criteria)
    {
        try
        {
            $this->db->setFetchMode(Zend_Db::FETCH_ASSOC);
            $sql = "SELECT ".MaritalStatus::ID_MARITAL_STATUS.", ".MaritalStatus::NAME."
                    FROM ".MaritalStatus::TABLENAME."
                    WHERE  " . $criteria->createSql();
            $maritalStatusCollection = new MaritalStatusCollection();
            foreach ($this->db->fetchAll($sql) as $result){
                $maritalStatusCollection->append($this->createInternal($result));
            }
        }
        catch(Exception $e)
        {
            throw new Exception("No se pudo obtener la colección de items\n" . $e->getMessage());
        }
        return $maritalStatusCollection;
    }

    /**
     * Método que manda a llamar a MaritalStatusFactory para instanciar el objeto
     * @param array $result El arreglo que devolvió el objeto Zend_Db despues del fetch
     * @uses MaritalStatusFactory::createMaritalStatusInternal
     * @return MaritalStatus
     */
    private function createInternal($result)
    {
        return MaritalStatusFactory::createMaritalStatusInternal($result['id_marital_status'], $result['name']);
    }


}



