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
 * ZipCodeFactory
 */
require_once 'application/models/factories/ZipCodeFactory.php';

/**
 * ZipCodeCollection
 */
require_once 'application/models/collections/ZipCodeCollection.php';

/**
 * Clase ZipCodeCatalog
 *
 * @category   Project
 * @package    Project_Models
 * @subpackage Project_Models_Catalogs
 * @copyright  ##$COPYRIGHT$##
 * @copyright  ##$COPYRIGHT$##
 * @author     ##$AUTHOR$##, $LastChangedBy$
 * @version    ##$VERSION$##, SVN:  $Id$
 */
class ZipCodeCatalog extends Catalog
{
    /**
     * Instancia singleton
     * @var ZipCodeCatalog
     */
    static protected $instance   = null;

    /**
     * Método para obtener la instancia del catálogo
     * @return ZipCodeCatalog
     */
    public static function getInstance()
    {
        if (!isset(self::$instance))
        {
          self::$instance = new ZipCodeCatalog();
        }
        return self::$instance;
    }

    /**
     * Constructor de la clase ZipCodeCatalog
     * @return ZipCodeCatalog
     */
    public function ZipCodeCatalog()
    {
        parent::Catalog();
    }

    /**
     * Metodo para agregar un ZipCode a la base de datos
     * @param ZipCode $zipCode Objeto ZipCode
     */
    public function create($zipCode)
    {
        if(!($zipCode instanceof ZipCode))
            throw new Exception("El parámetro [$zipCode] no es una instancia de ZipCode");
        $this->notifyObservers($zipCode,Catalog::EVENT_CREATE);
        try
        {
            $data = array(
                'zip_code'     => $zipCode->getZipCode(),
                'settlement'   => $zipCode->getSettlement(),
                'district'     => $zipCode->getDistrict(),
                'state'        => $zipCode->getState(),
                'city'         => $zipCode->getCity(),
                'mexico_state' => $zipCode->getMexicoState(),
            );
            $this->db->insert(ZipCode::TABLENAME, $data);
        }
        catch(Exception $e)
        {
            throw new Exception("El objeto ZipCode no pudo ser guardado en la base de datos\n" . $e->getMessage());
        }
    }


    /**
     * Metodo para Obtener todos los ids en un arreglo
     * @return array
     */
    public function retrieveAllIds()
    {
        try
        {
            $result = $this->db->fetchCol('SELECT  FROM '.ZipCode::TABLENAME);
        }
        catch(Exception $e)
        {
            throw new Exception("No se pudieron obtener los ids\n" . $e->getMessage());
        }
        return $result;
    }

    /**
     * Metodo para obtener todos los id de ZipCode por criterio
     * @param Criteria $criteria
     * @return array Array con todos los id de ZipCode que encajen en la busqueda
     */
    public function getIdsByCriteria(Criteria $criteria)
    {
        try
        {
            $sql = "SELECT 
                    FROM ".ZipCode::TABLENAME."
                    WHERE  " . $criteria->createSql();
            $result = $this->db->fetchCol($sql);
        } catch(Exception $e)
        {
            throw new Exception("No se pudieron obtener los ids de objetos ZipCode\n" . $e->getMessage());
        }
        return $result;
    }

    /**
     * Metodo para obtener un campo en particular de un ZipCode dado un criterio
     * @param Criteria $criteria
     * @param string $field
     * @return array Array con el campo de los objetos ZipCode que encajen en la busqueda
     */
    public function getCustomFieldByCriteria(Criteria $criteria, $field)
    {
        try
        {
            $sql = "SELECT {$field}
                    FROM ".ZipCode::TABLENAME."
                    WHERE  " . $criteria->createSql();
            $result = $this->db->fetchCol($sql);
        } catch(Exception $e)
        {
            throw new Exception("No se pudieron obtener los ids de objetos ZipCode\n" . $e->getMessage());
        }
        return $result;
    }

    /**
     * Metodo que regresa una coleccion de objetos ZipCode
     * dependiendo del criterio establecido
     * @param Criteria $criteria
     * @return ZipCodeCollection $objects
     */
    public function getByCriteria(Criteria $criteria)
    {
        try
        {
            $this->db->setFetchMode(Zend_Db::FETCH_ASSOC);
            $sql = "SELECT ".ZipCode::ZIP_CODE.", ".ZipCode::SETTLEMENT.", ".ZipCode::DISTRICT.", ".ZipCode::STATE.", ".ZipCode::CITY.", ".ZipCode::MEXICO_STATE."
                    FROM ".ZipCode::TABLENAME."
                    WHERE  " . $criteria->createSql();
            $zipCodeCollection = new ZipCodeCollection();
            foreach ($this->db->fetchAll($sql) as $result){
                $zipCodeCollection->append($this->createInternal($result));
            }
        }
        catch(Exception $e)
        {
            throw new Exception("No se pudo obtener la colección de items\n" . $e->getMessage());
        }
        return $zipCodeCollection;
    }

    /**
     * Método que manda a llamar a ZipCodeFactory para instanciar el objeto
     * @param array $result El arreglo que devolvió el objeto Zend_Db despues del fetch
     * @uses ZipCodeFactory::createZipCodeInternal
     * @return ZipCode
     */
    private function createInternal($result)
    {
        return ZipCodeFactory::createZipCodeInternal($result['zip_code'], $result['settlement'], $result['district'], $result['state'], $result['city'], $result['mexico_state']);
    }



    /**
     * Busca la información por codigo postal
     * @param int $zipCode
     * @return ZipCodeCollection
     */
    public function getByZipCode($zipCode)
    {
    	$criteria = new Criteria();
    	$criteria->add(ZipCode::ZIP_CODE, $zipCode, Criteria::EQUAL);
    	return $this->getByCriteria($criteria);
    }
    
    
    /**
     * Método no utilizados, pero requeridos por la interface
     */
    public function update($bean){}
    public function deleteById($id){}
    public function getById($id){}
	public function delete($bean){}
}


