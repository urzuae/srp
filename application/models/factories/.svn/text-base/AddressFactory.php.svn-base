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
 * Address
 */
require_once 'application/models/beans/Address.php';

/**
 * Clase AddressFactory
 *
 * @category   Project
 * @package    Project_Models
 * @subpackage Project_Models_Factories
 * @copyright  ##$COPYRIGHT$##
 * @copyright  ##$COPYRIGHT$##
 * @author     ##$AUTHOR$##, $LastChangedBy$
 * @version    ##$VERSION$##, SVN:  $Id$
 */
class AddressFactory
{
    /**
     * Instancia un nuevo objeto Address
     * @param int $idMexicoState 
     * @param string $street Calle y numero
     * @param string $settlement Colonia

     * @param string $district Delegacion o municipio
     * @param string $city Ciudad
     * @param int $zipCode Codigo postal
     * @param string $country Pais
     * @return Address Objeto Address
     */
    public static function createAddress($idMexicoState, $street, $settlement, $district, $city, $zipCode, $country)
    {
        $newAddress = new Address();
        $newAddress->setIdMexicoState($idMexicoState);
        $newAddress->setStreet($street);
        $newAddress->setSettlement($settlement);
        $newAddress->setDistrict($district);
        $newAddress->setCity($city);
        $newAddress->setZipCode($zipCode);
        $newAddress->setCountry($country);
        return $newAddress;
    }

    /**
     * Crea un objeto Address con parametros solo para uso de catalogos
     * @param int $idAddress 
     * @param int $idMexicoState 
     * @param string $street Calle y numero
     * @param string $settlement Colonia

     * @param string $district Delegacion o municipio
     * @param string $city Ciudad
     * @param int $zipCode Codigo postal
     * @param string $country Pais
     * @return Address Objeto Address
     */
    public static function createAddressInternal($idAddress, $idMexicoState, $street, $settlement, $district, $city, $zipCode, $country)
    {
        $newAddress = AddressFactory::createAddress($idMexicoState, $street, $settlement, $district, $city, $zipCode, $country);
        $newAddress->setIdAddress($idAddress);
        return $newAddress;
    }

}



