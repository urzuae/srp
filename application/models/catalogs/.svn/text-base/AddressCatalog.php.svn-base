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
 * AddressFactory
 */
require_once 'application/models/factories/AddressFactory.php';

/**
 * AddressCollection
 */
require_once 'application/models/collections/AddressCollection.php';

/**
 * Clase AddressCatalog
 *
 * @category   Project
 * @package    Project_Db
 * @copyright  ##$COPYRIGHT$##
 * @copyright  ##$COPYRIGHT$##
 * @author     ##$AUTHOR$##, $LastChangedBy$
 * @version    ##$VERSION$##, SVN:  $Id$
 */
class AddressCatalog extends Catalog
{

    /**
     * Instancia singleton
     * @var AddressCatalog
     */
    static protected $instance   = null;

    /**
     * Método para obtener la instancia del catálogo
     * @return AddressCatalog
     */
    public static function getInstance()
    {
        if (!isset(self::$instance))
        {
          self::$instance = new AddressCatalog();
        }
        return self::$instance;
    }

    /**
     * Constructor de la clase AddressCatalog
     * @return AddressCatalog
     */
    private function AddressCatalog()
    {
        parent::Catalog();
    }

    /**
     * Metodo para agregar un Address a la base de datos
     * @param Address $address Objeto Address
     */
    public function create($address)
    {
        if(!($address instanceof Address))
            throw new Exception("El parámetro [$address] no es una instancia de Address");
        try
        {
            $data = array(
                'id_mexico_state' => $address->getIdMexicoState(),
                'street'          => $address->getStreet(),
                'settlement'      => $address->getSettlement(),
                'district'        => $address->getDistrict(),
                'city'            => $address->getCity(),
                'zip_code'        => $address->getZipCode(),
                'country'         => $address->getCountry(),
            );
            $this->db->insert(Address::TABLENAME, $data);
            $address->setIdAddress($this->db->lastInsertId());
        }
        catch(Exception $e)
        {
            throw new Exception("El objeto Address no pudo ser guardado en la base de datos\n" . $e->getMessage());
        }
    }

    /**
     * Metodo para Obtener los datos de un objeto por su llave primaria
     * @param int $idAddress
     * @return Address|null Objeto Address si existe, caso contrario retorna null;
     */
    public function getById($idAddress)
    {
        try
        {
            $criteria = new Criteria();
            $criteria->add(Address::ID_ADDRESS, $idAddress, Criteria::EQUAL);
            $newAddress = $this->getByCriteria($criteria)->getOne();
        }
        catch(Exception $e)
        {
            throw new Exception("El objeto Address no pudo ser obtenido\n" . $e->getMessage());
        }
        return $newAddress;
    }

    /**
     * Metodo para Obtener todos los ids en un arreglo
     * @return array
     */
    public function retrieveAllIds()
    {
        try
        {
            $result = $this->db->fetchCol('SELECT id_address FROM '.Address::TABLENAME);
        }
        catch(Exception $e)
        {
            throw new Exception("No se pudieron obtener los ids\n" . $e->getMessage());
        }
        return $result;
    }

    /**
     * Metodo para actualizar un Address
     * @param Address $Address Objeto Address
     */
    public function update($address)
    {
        if(!($address instanceof Address))
            throw new Exception("El parámetro [$address] no es una instancia de Address");
        try
        {
            $where[] = "id_address = '{$address->getIdAddress()}'";
            $data = array(
                'id_mexico_state' => $address->getIdMexicoState(),
                'street'          => $address->getStreet(),
                'settlement'      => $address->getSettlement(),
                'district'        => $address->getDistrict(),
                'city'            => $address->getCity(),
                'zip_code'        => $address->getZipCode(),
                'country'         => $address->getCountry(),
            );
            $this->db->update(Address::TABLENAME, $data, $where);
        }
        catch(Exception $e)
        {
            throw new Exception("El objeto Address no pudo ser actualizado\n" . $e->getMessage());
        }
    }

    /**
     * Metodo para eliminar un Address
     * @param Address $Address Objeto Address
     */
    public function delete($address)
    {
        if(!($address instanceof Address))
            throw new Exception("El parámetro [$address] no es una instancia de Address");
        try
        {
            $where[] = "id_address = '{$address->getIdAddress()}'";
            $this->db->delete(Address::TABLENAME, $where);
        }
        catch(Exception $e)
        {
            throw new Exception("El objeto Address no pudo ser eliminado\n" . $e->getMessage());
        }
    }

    /**
     * Metodo para eliminar un Address a partir de su Id
     * @param int $Address
     */
    public function deleteById($idAddress)
    {
        try
        {
            $where[] = "id_address = '{$idAddress}'";
            $this->db->delete(Address::TABLENAME, $where);
        }
        catch(Exception $e)
        {
            throw new Exception("El objeto Address no pudo ser eliminado\n" . $e->getMessage());
        }
    }

    /**
     * Metodo para obtener todos los id de Address por criterio
     * @param Criteria $criteria
     * @return array Array con todos los id de Address que encajen en la busqueda
     */
    public function getIdsByCriteria(Criteria $criteria)
    {
        try
        {
            $sql = "SELECT id_address
                    FROM ".Address::TABLENAME."
                    WHERE  " . $criteria->createSql();
            $result = $this->db->fetchCol($sql);
        } catch(Exception $e)
        {
            throw new Exception("No se pudieron obtener los ids de objetos Address\n" . $e->getMessage());
        }
        return $result;
    }

    /**
     * Metodo para obtener un campo en particular de un Address dado un criterio
     * @param Criteria $criteria
     * @param string $field
     * @return array Array con el campo de los objetos Address que encajen en la busqueda
     */
    public function getCustomFieldByCriteria(Criteria $criteria, $field)
    {
        try
        {
            $sql = "SELECT {$field}
                    FROM ".Address::TABLENAME."
                    WHERE  " . $criteria->createSql();
            $result = $this->db->fetchCol($sql);
        } catch(Exception $e)
        {
            throw new Exception("No se pudieron obtener los ids de objetos Address\n" . $e->getMessage());
        }
        return $result;
    }

    /**
     * Metodo que regresa una coleccion de objetos Address
     * dependiendo del criterio establecido
     * @param Criteria $criteria
     * @return AddressCollection $objects
     */
    public function getByCriteria(Criteria $criteria)
    {
        try
        {
            $this->db->setFetchMode(Zend_Db::FETCH_ASSOC);
            $sql = "SELECT ".Address::ID_ADDRESS.", ".Address::ID_MEXICO_STATE.", ".Address::STREET.", ".Address::SETTLEMENT.", ".Address::DISTRICT.", ".Address::CITY.", ".Address::ZIP_CODE.", ".Address::COUNTRY."
                    FROM ".Address::TABLENAME."
                    WHERE  " . $criteria->createSql();
            $addressCollection = new AddressCollection();
            foreach ($this->db->fetchAll($sql) as $result){
                $addressCollection->append($this->createInternal($result));
            }
        }
        catch(Exception $e)
        {
            throw new Exception("No se pudo obtener la colección de items\n" . $e->getMessage());
        }
        return $addressCollection;
    }

    /**
     * Método que manda a llamar a AddressFactory para instanciar el objeto
     * @param array $result El arreglo que devolvió el objeto Zend_Db despues del fetch
     * @uses AddressFactory::createAddressInternal
     * @return Address
     */
    private function createInternal($result)
    {
        return AddressFactory::createAddressInternal($result['id_address'], $result['id_mexico_state'], $result['street'], $result['settlement'], $result['district'], $result['city'], $result['zip_code'], $result['country']);
    }

    /**
     * Obtiene una dirección Primaria dependiendo de un idPerson
     * @param int $idPerson
     * @return Address
     */
    public function getByIdPerson($idPerson)
    {
    	$idAddress = $this->getIdAddress($idPerson);
    	return $this->getById($idAddress);
    }
    
    /**
     * Obtine el Id de la dirección asociada a una persona
     * @param int $idPerson
     * @param int $idType
     * @return int
     */
    protected function getIdAddress($idPerson, $idType = 1)
    {
    	try
        {
        	$criteria = new Criteria();
        	$criteria->add('id_person', $idPerson, Criteria::EQUAL);
        	$criteria->add('type_address', $idType, Criteria::EQUAL);
        	$criteria->setLimit(1);
            $sql = "SELECT *
                    FROM ".Address::ADDRESS_PERSON_TABLE."
                    WHERE  " . $criteria->createSql();
            $result = $this->db->fetchOne($sql);
        }
        catch(Exception $e)
        {
            throw new Exception("No se pudo obtener la colección de items\n" . $e->getMessage());
        }
        return $result;
    }
    
    /**
     * Crea una relacion entre direccion y persona
     *
     * @param Address $address
     * @param Person $person
     * @param int [optional] Type Address
     */
    public function setAddressToPerson(Address $address, Person $person, $typeAddress = 1)
    {
        try
        {
            $data = array('id_address'=>$address->getIdAddress(), 'id_person'=>$person->getIdPerson(),'type_address' => $typeAddress);
            $this->db->insert(Address::ADDRESS_PERSON_TABLE, $data);
        }
        catch(Zend_Exception $e)
        {
            throw new Exception("No se pudo crear la relacion Direccion->Persona " . $e->getMessage());
        }
    
    }

    /**
     * Otiene la direccion primaria de una persona
     *
     * @param Person $person
     * @return Address 
     */
    public function getPrimaryAddressByPerson(Person $person)
    {
        try
        {
            $sql = 'select id_address FROM '.Address::ADDRESS_PERSON_TABLE.' where type_address = ? and id_person = ?';
            $result = $this->db->fetchRow($sql, array(1, $person->getIdPerson()));
        }
        catch(Zend_Exception $e)
        {
            throw new Exception("No se pudo obtener la direccion primaria de la persona " . $e->getMessage());
        }
        return $this->getById($result['id_address']);
    }

}



