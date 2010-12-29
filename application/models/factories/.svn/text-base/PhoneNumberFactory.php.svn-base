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
 * PhoneNumber
 */
require_once 'application/models/beans/PhoneNumber.php';

/**
 * Clase PhoneNumberFactory
 *
 * @category   Project
 * @package    Project_Models
 * @subpackage Project_Models_Factories
 * @copyright  ##$COPYRIGHT$##
 * @copyright  ##$COPYRIGHT$##
 * @author     ##$AUTHOR$##, $LastChangedBy$
 * @version    ##$VERSION$##, SVN:  $Id$
 */
class PhoneNumberFactory
{
    /**
     * Instancia un nuevo objeto PhoneNumber
     * @param int $idPerson 
     * @param string $areaCode 
     * @param string $number 
     * @param int $idType 
     * @return PhoneNumber Objeto PhoneNumber
     */
    public static function createPhoneNumber($idPerson, $areaCode, $number, $idType)
    {
        $newPhoneNumber = new PhoneNumber();
        $newPhoneNumber->setIdPerson($idPerson);
        $newPhoneNumber->setAreaCode($areaCode);
        $newPhoneNumber->setNumber($number);
        $newPhoneNumber->setIdType($idType);
        return $newPhoneNumber;
    }

    /**
     * Crea un objeto PhoneNumber con parametros solo para uso de catalogos
     * @param int $idPhoneNumber 
     * @param int $idPerson 
     * @param string $areaCode 
     * @param string $number 
     * @param int $idType 
     * @return PhoneNumber Objeto PhoneNumber
     */
    public static function createPhoneNumberInternal($idPhoneNumber, $idPerson, $areaCode, $number, $idType)
    {
        $newPhoneNumber = PhoneNumberFactory::createPhoneNumber($idPerson, $areaCode, $number, $idType);
        $newPhoneNumber->setIdPhoneNumber($idPhoneNumber);
        return $newPhoneNumber;
    }

}



