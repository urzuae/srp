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
 * AccessLogFactory
 */
require_once 'application/models/factories/AccessLogFactory.php';

/**
 * AccessLogCollection
 */
require_once 'application/models/collections/AccessLogCollection.php';

/**
 * Clase AccessLogCatalog
 *
 * @category   Project
 * @package    Project_Db
 * @copyright  ##$COPYRIGHT$##
 * @copyright  ##$COPYRIGHT$##
 * @author     ##$AUTHOR$##, $LastChangedBy$
 * @version    ##$VERSION$##, SVN:  $Id$
 */
class AccessLogCatalog extends Catalog
{
    /**
     * Instancia singleton
     * @var AccessLogCatalog
     */
    static protected $instance   = null;

    /**
     * Método para obtener la instancia del catálogo
     * @return AccessLogCatalog
     */
    public static function getInstance()
    {
        if (!isset(self::$instance))
        {
          self::$instance = new AccessLogCatalog();
        }
        return self::$instance;
    }

    /**
     * Constructor de la clase AccessLogCatalog
     * @return AccessLogCatalog
     */
    private function AccessLogCatalog()
    {
        parent::Catalog();
    }

    /**
     * Metodo para agregar un AccessLog a la base de datos
     * @param AccessLog $accessLog Objeto AccessLog
     */
    public function create($accessLog)
    {
        if(!($accessLog instanceof AccessLog))
            throw new Exception("El parámetro [$accessLog] no es una instancia de AccessLog");
        try
        {
            $data = array(
                'id_person'      => $accessLog->getIdPerson(),
                'id_fingerprint' => $accessLog->getIdFingerprint(),
                'timestamp'      => $accessLog->getTimestamp()->get('YYYY-MM-dd HH:mm:ss'),
                'created'        => $accessLog->getCreated()->get('YYYY-MM-dd HH:mm:ss'),
                'id_event_type'  => $accessLog->getIdEventType(),
                'note'           => $accessLog->getNote(),
            );
            $this->db->insert(AccessLog::TABLENAME, $data);
            $accessLog->setIdAccessLog($this->db->lastInsertId());
        }
        catch(Exception $e)
        {
            throw new Exception("El objeto AccessLog no pudo ser guardado en la base de datos\n" . $e->getMessage());
        }
    }

    /**
     * Metodo para Obtener los datos de un objeto por su llave primaria
     * @param int $idAccessLog
     * @return AccessLog|null Objeto AccessLog si existe, caso contrario retorna null;
     */
    public function getById($idAccessLog)
    {
        try
        {
            $criteria = new Criteria();
            $criteria->add(AccessLog::ID_ACCESS_LOG, $idAccessLog, Criteria::EQUAL);
            $newAccessLog = $this->getByCriteria($criteria)->getOne();
        }
        catch(Exception $e)
        {
            throw new Exception("El objeto AccessLog no pudo ser obtenido\n" . $e->getMessage());
        }
        return $newAccessLog;
    }

    /**
     * Metodo para Obtener todos los ids en un arreglo
     * @return array
     */
    public function retrieveAllIds()
    {
        try
        {
            $result = $this->db->fetchCol('SELECT id_access_log FROM '.AccessLog::TABLENAME);
        }
        catch(Exception $e)
        {
            throw new Exception("No se pudieron obtener los ids\n" . $e->getMessage());
        }
        return $result;
    }

    /**
     * Metodo para actualizar un AccessLog
     * @param AccessLog $AccessLog Objeto AccessLog
     */
    public function update($accessLog)
    {
        if(!($accessLog instanceof AccessLog))
            throw new Exception("El parámetro [$accessLog] no es una instancia de AccessLog");
        try
        {
            $where[] = "id_access_log = '{$accessLog->getIdAccessLog()}'";
            $data = array(
                'id_person'      => $accessLog->getIdPerson(),
                'id_fingerprint' => $accessLog->getIdFingerprint(),
                'timestamp'      => $accessLog->getTimestamp()->get('YYYY-MM-dd HH:mm:ss'),
                'created'        => $accessLog->getCreated()->get('YYYY-MM-dd HH:mm:ss'),
                'id_event_type'  => $accessLog->getIdEventType(),
                'note'           => $accessLog->getNote(),
            );
            $this->db->update(AccessLog::TABLENAME, $data, $where);
        }
        catch(Exception $e)
        {
            throw new Exception("El objeto AccessLog no pudo ser actualizado\n" . $e->getMessage());
        }
    }

    /**
     * Metodo para eliminar un AccessLog
     * @param AccessLog $AccessLog Objeto AccessLog
     */
    public function delete($accessLog)
    {
        if(!($accessLog instanceof AccessLog))
            throw new Exception("El parámetro [$accessLog] no es una instancia de AccessLog");
        try
        {
            $where[] = "id_access_log = '{$accessLog->getIdAccessLog()}'";
            $this->db->delete(AccessLog::TABLENAME, $where);
        }
        catch(Exception $e)
        {
            throw new Exception("El objeto AccessLog no pudo ser eliminado\n" . $e->getMessage());
        }
    }

    /**
     * Metodo para eliminar un AccessLog a partir de su Id
     * @param int $AccessLog
     */
    public function deleteById($idAccessLog)
    {
        try
        {
            $where[] = "id_access_log = '{$idAccessLog}'";
            $this->db->delete(AccessLog::TABLENAME, $where);
        }
        catch(Exception $e)
        {
            throw new Exception("El objeto AccessLog no pudo ser eliminado\n" . $e->getMessage());
        }
    }

    /**
     * Metodo para obtener todos los id de AccessLog por criterio
     * @param Criteria $criteria
     * @return array Array con todos los id de AccessLog que encajen en la busqueda
     */
    public function getIdsByCriteria(Criteria $criteria)
    {
        try
        {
            $sql = "SELECT id_access_log
                    FROM ".AccessLog::TABLENAME."
                    WHERE  " . $criteria->createSql();
            $result = $this->db->fetchCol($sql);
        } catch(Exception $e)
        {
            throw new Exception("No se pudieron obtener los ids de objetos AccessLog\n" . $e->getMessage());
        }
        return $result;
    }

    /**
     * Metodo para obtener un campo en particular de un AccessLog dado un criterio
     * @param Criteria $criteria
     * @param string $field
     * @return array Array con el campo de los objetos AccessLog que encajen en la busqueda
     */
    public function getCustomFieldByCriteria(Criteria $criteria, $field)
    {
        try
        {
            $sql = "SELECT {$field}
                    FROM ".AccessLog::TABLENAME."
                    WHERE  " . $criteria->createSql();
            $result = $this->db->fetchCol($sql);
        } catch(Exception $e)
        {
            throw new Exception("No se pudieron obtener los ids de objetos AccessLog\n" . $e->getMessage());
        }
        return $result;
    }

    /**
     * Metodo que regresa una coleccion de objetos AccessLog
     * dependiendo del criterio establecido
     * @param Criteria $criteria
     * @return AccessLogCollection $objects
     */
    public function getByCriteria(Criteria $criteria)
    {
        try
        {
            $this->db->setFetchMode(Zend_Db::FETCH_ASSOC);
            $sql = "SELECT ".AccessLog::ID_ACCESS_LOG.", ".AccessLog::ID_PERSON.", ".AccessLog::ID_FINGERPRINT.", ".AccessLog::TIMESTAMP.", ".AccessLog::CREATED.", ".AccessLog::ID_EVENT_TYPE.", ".AccessLog::NOTE."
                    FROM ".AccessLog::TABLENAME."
                    WHERE  " . $criteria->createSql();
            $accessLogCollection = new AccessLogCollection();
            foreach ($this->db->fetchAll($sql) as $result){
                $accessLogCollection->append($this->createInternal($result));
            }
        }
        catch(Exception $e)
        {
            throw new Exception("No se pudo obtener la colección de items\n" . $e->getMessage());
        }
        return $accessLogCollection;
    }

    /**
     * Método que manda a llamar a AccessLogFactory para instanciar el objeto
     * @param array $result El arreglo que devolvió el objeto Zend_Db despues del fetch
     * @uses AccessLogFactory::createAccessLogInternal
     * @return AccessLog
     */
    private function createInternal($result)
    {
        return AccessLogFactory::createAccessLogInternal($result['id_access_log'], $result['id_person'], $result['id_fingerprint'], new Zend_Date($result['timestamp'], $this->datePart), new Zend_Date($result['created'], $this->datePart), $result['id_event_type'], $result['note']);
    }


}



