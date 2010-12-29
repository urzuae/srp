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
 * ZipCode
 */
require_once 'application/models/beans/ZipCode.php';

/**
 * Clase ZipCodeFactory
 *
 * @category   Project
 * @package    Project_Models
 * @subpackage Project_Models_Factories
 * @copyright  ##$COPYRIGHT$##
 * @copyright  ##$COPYRIGHT$##
 * @author     ##$AUTHOR$##, $LastChangedBy$
 * @version    ##$VERSION$##, SVN:  $Id$
 */
class ZipCodeFactory
{
    /**
     * Instancia un nuevo objeto ZipCode
     * @param int $zipCode 
     * @param string $settlement Colonia
     * @param string $district Delegacion o Municipio
     * @param string $state Estado
     * @param string $city Ciudad
     * @param int $mexicoState 
     * @return ZipCode Objeto ZipCode
     */
    public static function createZipCode($zipCode, $settlement, $district, $state, $city, $mexicoState)
    {
        $newZipCode = new ZipCode();
        $newZipCode->setZipCode($zipCode);
        $newZipCode->setSettlement($settlement);
        $newZipCode->setDistrict($district);
        $newZipCode->setState($state);
        $newZipCode->setCity($city);
        $newZipCode->setMexicoState($mexicoState);
        return $newZipCode;
    }

    /**
     * Crea un objeto ZipCode con parametros solo para uso de catalogos
     * @param int $zipCode 
     * @param string $settlement Colonia
     * @param string $district Delegacion o Municipio
     * @param string $state Estado
     * @param string $city Ciudad
     * @param int $mexicoState 
     * @return ZipCode Objeto ZipCode
     */
    public static function createZipCodeInternal($zipCode, $settlement, $district, $state, $city, $mexicoState)
    {
        $newZipCode = ZipCodeFactory::createZipCode($zipCode, $settlement, $district, $state, $city, $mexicoState);
        return $newZipCode;
    }

}



