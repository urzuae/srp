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
 * MexicoStateFactory
 */
require_once 'application/models/factories/MexicoStateFactory.php';

/**
 * MexicoStateCollection
 */
require_once 'application/models/collections/MexicoStateCollection.php';

/**
 * Clase MexicoStateCatalog
 *
 * @category   Project
 * @package    Project_Db
 * @copyright  ##$COPYRIGHT$##
 * @copyright  ##$COPYRIGHT$##
 * @author     ##$AUTHOR$##, $LastChangedBy$
 * @version    ##$VERSION$##, SVN:  $Id$
 */
class MexicoStateCatalog extends Catalog
{
    /**
     * Instancia singleton
     * @var MexicoStateCatalog
     */
    static protected $instance   = null;

    /**
     * Método para obtener la instancia del catálogo
     * @return MexicoStateCatalog
     */
    public static function getInstance()
    {
        if (!isset(self::$instance))
        {
          self::$instance = new MexicoStateCatalog();
        }
        return self::$instance;
    }

    /**
     * Constructor de la clase MexicoStateCatalog
     * @return MexicoStateCatalog
     */
    private function MexicoStateCatalog()
    {
        parent::Catalog();
    }

    /**
     * Metodo para agregar un MexicoState a la base de datos
     * @param MexicoState $mexicoState Objeto MexicoState
     */
    public function create($mexicoState)
    {
        if(!($mexicoState instanceof MexicoState))
            throw new Exception("El parámetro [$mexicoState] no es una instancia de MexicoState");
        try
        {
            $data = array(
                'name' => $mexicoState->getName(),
            );
            $this->db->insert(MexicoState::TABLENAME, $data);
            $mexicoState->setIdMexicoState($this->db->lastInsertId());
        }
        catch(Exception $e)
        {
            throw new Exception("El objeto MexicoState no pudo ser guardado en la base de datos\n" . $e->getMessage());
        }
    }

    /**
     * Metodo para Obtener los datos de un objeto por su llave primaria
     * @param int $idMexicoState
     * @return MexicoState|null Objeto MexicoState si existe, caso contrario retorna null;
     */
    public function getById($idMexicoState)
    {
        try
        {
            $criteria = new Criteria();
            $criteria->add(MexicoState::ID_MEXICO_STATE, $idMexicoState, Criteria::EQUAL);
            $newMexicoState = $this->getByCriteria($criteria)->getOne();
        }
        catch(Exception $e)
        {
            throw new Exception("El objeto MexicoState no pudo ser obtenido\n" . $e->getMessage());
        }
        return $newMexicoState;
    }

    /**
     * Metodo para Obtener todos los ids en un arreglo
     * @return array
     */
    public function retrieveAllIds()
    {
        try
        {
            $result = $this->db->fetchCol('SELECT id_mexico_state FROM '.MexicoState::TABLENAME);
        }
        catch(Exception $e)
        {
            throw new Exception("No se pudieron obtener los ids\n" . $e->getMessage());
        }
        return $result;
    }

    /**
     * Metodo para actualizar un MexicoState
     * @param MexicoState $MexicoState Objeto MexicoState
     */
    public function update($mexicoState)
    {
        if(!($mexicoState instanceof MexicoState))
            throw new Exception("El parámetro [$mexicoState] no es una instancia de MexicoState");
        try
        {
            $where[] = "id_mexico_state = '{$mexicoState->getIdMexicoState()}'";
            $data = array(
                'name' => $mexicoState->getName(),
            );
            $this->db->update(MexicoState::TABLENAME, $data, $where);
        }
        catch(Exception $e)
        {
            throw new Exception("El objeto MexicoState no pudo ser actualizado\n" . $e->getMessage());
        }
    }

    /**
     * Metodo para eliminar un MexicoState
     * @param MexicoState $MexicoState Objeto MexicoState
     */
    public function delete($mexicoState)
    {
        if(!($mexicoState instanceof MexicoState))
            throw new Exception("El parámetro [$mexicoState] no es una instancia de MexicoState");
        try
        {
            $where[] = "id_mexico_state = '{$mexicoState->getIdMexicoState()}'";
            $this->db->delete(MexicoState::TABLENAME, $where);
        }
        catch(Exception $e)
        {
            throw new Exception("El objeto MexicoState no pudo ser eliminado\n" . $e->getMessage());
        }
    }

    /**
     * Metodo para eliminar un MexicoState a partir de su Id
     * @param int $MexicoState
     */
    public function deleteById($idMexicoState)
    {
        try
        {
            $where[] = "id_mexico_state = '{$idMexicoState}'";
            $this->db->delete(MexicoState::TABLENAME, $where);
        }
        catch(Exception $e)
        {
            throw new Exception("El objeto MexicoState no pudo ser eliminado\n" . $e->getMessage());
        }
    }

    /**
     * Metodo para obtener todos los id de MexicoState por criterio
     * @param Criteria $criteria
     * @return array Array con todos los id de MexicoState que encajen en la busqueda
     */
    public function getIdsByCriteria(Criteria $criteria)
    {
        try
        {
            $sql = "SELECT id_mexico_state
                    FROM ".MexicoState::TABLENAME."
                    WHERE  " . $criteria->createSql();
            $result = $this->db->fetchCol($sql);
        } catch(Exception $e)
        {
            throw new Exception("No se pudieron obtener los ids de objetos MexicoState\n" . $e->getMessage());
        }
        return $result;
    }

    /**
     * Metodo para obtener un campo en particular de un MexicoState dado un criterio
     * @param Criteria $criteria
     * @param string $field
     * @return array Array con el campo de los objetos MexicoState que encajen en la busqueda
     */
    public function getCustomFieldByCriteria(Criteria $criteria, $field)
    {
        try
        {
            $sql = "SELECT {$field}
                    FROM ".MexicoState::TABLENAME."
                    WHERE  " . $criteria->createSql();
            $result = $this->db->fetchCol($sql);
        } catch(Exception $e)
        {
            throw new Exception("No se pudieron obtener los ids de objetos MexicoState\n" . $e->getMessage());
        }
        return $result;
    }

    /**
     * Metodo que regresa una coleccion de objetos MexicoState
     * dependiendo del criterio establecido
     * @param Criteria $criteria
     * @return MexicoStateCollection $objects
     */
    public function getByCriteria(Criteria $criteria)
    {
        try
        {
            $this->db->setFetchMode(Zend_Db::FETCH_ASSOC);
            $sql = "SELECT ".MexicoState::ID_MEXICO_STATE.", ".MexicoState::NAME."
                    FROM ".MexicoState::TABLENAME."
                    WHERE  " . $criteria->createSql();
            $mexicoStateCollection = new MexicoStateCollection();
            foreach ($this->db->fetchAll($sql) as $result){
                $mexicoStateCollection->append($this->createInternal($result));
            }
        }
        catch(Exception $e)
        {
            throw new Exception("No se pudo obtener la colección de items\n" . $e->getMessage());
        }
        return $mexicoStateCollection;
    }

    /**
     * Método que manda a llamar a MexicoStateFactory para instanciar el objeto
     * @param array $result El arreglo que devolvió el objeto Zend_Db despues del fetch
     * @uses MexicoStateFactory::createMexicoStateInternal
     * @return MexicoState
     */
    private function createInternal($result)
    {
        return MexicoStateFactory::createMexicoStateInternal($result['id_mexico_state'], $result['name']);
    }


}



