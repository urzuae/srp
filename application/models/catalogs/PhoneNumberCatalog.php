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
 * PhoneNumberFactory
 */
require_once 'application/models/factories/PhoneNumberFactory.php';

/**
 * PhoneNumberCollection
 */
require_once 'application/models/collections/PhoneNumberCollection.php';

/**
 * Clase PhoneNumberCatalog
 *
 * @category   Project
 * @package    Project_Db
 * @copyright  ##$COPYRIGHT$##
 * @copyright  ##$COPYRIGHT$##
 * @author     ##$AUTHOR$##, $LastChangedBy$
 * @version    ##$VERSION$##, SVN:  $Id$
 */
class PhoneNumberCatalog extends Catalog
{
    /**
     * Instancia singleton
     * @var PhoneNumberCatalog
     */
    static protected $instance   = null;

    /**
     * Método para obtener la instancia del catálogo
     * @return PhoneNumberCatalog
     */
    public static function getInstance()
    {
        if (!isset(self::$instance))
        {
          self::$instance = new PhoneNumberCatalog();
        }
        return self::$instance;
    }

    /**
     * Constructor de la clase PhoneNumberCatalog
     * @return PhoneNumberCatalog
     */
    private function PhoneNumberCatalog()
    {
        parent::Catalog();
    }

    /**
     * Metodo para agregar un PhoneNumber a la base de datos
     * @param PhoneNumber $phoneNumber Objeto PhoneNumber
     */
    public function create($phoneNumber)
    {
        if(!($phoneNumber instanceof PhoneNumber))
            throw new Exception("El parámetro [$phoneNumber] no es una instancia de PhoneNumber");
        try
        {
            $data = array(
                'id_person' => $phoneNumber->getIdPerson(),
                'area_code' => $phoneNumber->getAreaCode(),
                'number'    => $phoneNumber->getNumber(),
                'id_type'   => $phoneNumber->getIdType(),
            );
            $this->db->insert(PhoneNumber::TABLENAME, $data);
            $phoneNumber->setIdPhoneNumber($this->db->lastInsertId());
        }
        catch(Exception $e)
        {
            throw new Exception("El objeto PhoneNumber no pudo ser guardado en la base de datos\n" . $e->getMessage());
        }
    }

    /**
     * Metodo para Obtener los datos de un objeto por su llave primaria
     * @param int $idPhoneNumber
     * @return PhoneNumber|null Objeto PhoneNumber si existe, caso contrario retorna null;
     */
    public function getById($idPhoneNumber)
    {
        try
        {
            $criteria = new Criteria();
            $criteria->add(PhoneNumber::ID_PHONE_NUMBER, $idPhoneNumber, Criteria::EQUAL);
            $newPhoneNumber = $this->getByCriteria($criteria)->getOne();
        }
        catch(Exception $e)
        {
            throw new Exception("El objeto PhoneNumber no pudo ser obtenido\n" . $e->getMessage());
        }
        return $newPhoneNumber;
    }

    /**
     * Metodo para Obtener todos los ids en un arreglo
     * @return array
     */
    public function retrieveAllIds()
    {
        try
        {
            $result = $this->db->fetchCol('SELECT id_phone_number FROM '.PhoneNumber::TABLENAME);
        }
        catch(Exception $e)
        {
            throw new Exception("No se pudieron obtener los ids\n" . $e->getMessage());
        }
        return $result;
    }

    /**
     * Metodo para actualizar un PhoneNumber
     * @param PhoneNumber $PhoneNumber Objeto PhoneNumber
     */
    public function update($phoneNumber)
    {
        if(!($phoneNumber instanceof PhoneNumber))
            throw new Exception("El parámetro [$phoneNumber] no es una instancia de PhoneNumber");
        try
        {
            $where[] = "id_phone_number = '{$phoneNumber->getIdPhoneNumber()}'";
            $data = array(
                'id_person' => $phoneNumber->getIdPerson(),
                'area_code' => $phoneNumber->getAreaCode(),
                'number'    => $phoneNumber->getNumber(),
                'id_type'   => $phoneNumber->getIdType(),
            );
            $this->db->update(PhoneNumber::TABLENAME, $data, $where);
        }
        catch(Exception $e)
        {
            throw new Exception("El objeto PhoneNumber no pudo ser actualizado\n" . $e->getMessage());
        }
    }

    /**
     * Metodo para eliminar un PhoneNumber
     * @param PhoneNumber $PhoneNumber Objeto PhoneNumber
     */
    public function delete($phoneNumber)
    {
        if(!($phoneNumber instanceof PhoneNumber))
            throw new Exception("El parámetro [$phoneNumber] no es una instancia de PhoneNumber");
        try
        {
            $where[] = "id_phone_number = '{$phoneNumber->getIdPhoneNumber()}'";
            $this->db->delete(PhoneNumber::TABLENAME, $where);
        }
        catch(Exception $e)
        {
            throw new Exception("El objeto PhoneNumber no pudo ser eliminado\n" . $e->getMessage());
        }
    }

    /**
     * Metodo para eliminar un PhoneNumber a partir de su Id
     * @param int $PhoneNumber
     */
    public function deleteById($idPhoneNumber)
    {
        try
        {
            $where[] = "id_phone_number = '{$idPhoneNumber}'";
            $this->db->delete(PhoneNumber::TABLENAME, $where);
        }
        catch(Exception $e)
        {
            throw new Exception("El objeto PhoneNumber no pudo ser eliminado\n" . $e->getMessage());
        }
    }

    /**
     * Metodo para obtener todos los id de PhoneNumber por criterio
     * @param Criteria $criteria
     * @return array Array con todos los id de PhoneNumber que encajen en la busqueda
     */
    public function getIdsByCriteria(Criteria $criteria)
    {
        try
        {
            $sql = "SELECT id_phone_number
                    FROM ".PhoneNumber::TABLENAME."
                    WHERE  " . $criteria->createSql();
            $result = $this->db->fetchCol($sql);
        } catch(Exception $e)
        {
            throw new Exception("No se pudieron obtener los ids de objetos PhoneNumber\n" . $e->getMessage());
        }
        return $result;
    }

    /**
     * Metodo para obtener un campo en particular de un PhoneNumber dado un criterio
     * @param Criteria $criteria
     * @param string $field
     * @return array Array con el campo de los objetos PhoneNumber que encajen en la busqueda
     */
    public function getCustomFieldByCriteria(Criteria $criteria, $field)
    {
        try
        {
            $sql = "SELECT {$field}
                    FROM ".PhoneNumber::TABLENAME."
                    WHERE  " . $criteria->createSql();
            $result = $this->db->fetchCol($sql);
        } catch(Exception $e)
        {
            throw new Exception("No se pudieron obtener los ids de objetos PhoneNumber\n" . $e->getMessage());
        }
        return $result;
    }

    /**
     * Metodo que regresa una coleccion de objetos PhoneNumber
     * dependiendo del criterio establecido
     * @param Criteria $criteria
     * @return PhoneNumberCollection $objects
     */
    public function getByCriteria(Criteria $criteria)
    {
        try
        {
            $this->db->setFetchMode(Zend_Db::FETCH_ASSOC);
            $sql = "SELECT ".PhoneNumber::ID_PHONE_NUMBER.", ".PhoneNumber::ID_PERSON.", ".PhoneNumber::AREA_CODE.", ".PhoneNumber::NUMBER.", ".PhoneNumber::ID_TYPE."
                    FROM ".PhoneNumber::TABLENAME."
                    WHERE  " . $criteria->createSql();
            $phoneNumberCollection = new PhoneNumberCollection();
            foreach ($this->db->fetchAll($sql) as $result){
                $phoneNumberCollection->append($this->createInternal($result));
            }
        }
        catch(Exception $e)
        {
            throw new Exception("No se pudo obtener la colección de items\n" . $e->getMessage());
        }
        return $phoneNumberCollection;
    }

    /**
     * Método que manda a llamar a PhoneNumberFactory para instanciar el objeto
     * @param array $result El arreglo que devolvió el objeto Zend_Db despues del fetch
     * @uses PhoneNumberFactory::createPhoneNumberInternal
     * @return PhoneNumber
     */
    private function createInternal($result)
    {
        return PhoneNumberFactory::createPhoneNumberInternal($result['id_phone_number'], $result['id_person'], $result['area_code'], $result['number'], $result['id_type']);
    }
    
    /**
     * Obtiene un telefono
     * @param $idPerson
     * @return PhoneNumber|null
     */
    public function getByIdPerson($idPerson, $type=1)
    {
    	$criteria = new Criteria();
    	$criteria->add(PhoneNumber::ID_PERSON, $idPerson, Criteria::EQUAL);
    	$criteria->add(PhoneNumber::ID_TYPE, $type, Criteria::EQUAL);
    	$criteria->setLimit(1);
    	return $this->getByCriteria($criteria)->getOne();
    }


}



