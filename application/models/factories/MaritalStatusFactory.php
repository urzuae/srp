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
 * MaritalStatus
 */
require_once 'application/models/beans/MaritalStatus.php';

/**
 * Clase MaritalStatusFactory
 *
 * @category   Project
 * @package    Project_Models
 * @subpackage Project_Models_Factories
 * @copyright  ##$COPYRIGHT$##
 * @copyright  ##$COPYRIGHT$##
 * @author     ##$AUTHOR$##, $LastChangedBy$
 * @version    ##$VERSION$##, SVN:  $Id$
 */
class MaritalStatusFactory
{
    /**
     * Instancia un nuevo objeto MaritalStatus
     * @param string $name 
     * @return MaritalStatus Objeto MaritalStatus
     */
    public static function createMaritalStatus($name)
    {
        $newMaritalStatus = new MaritalStatus();
        $newMaritalStatus->setName($name);
        return $newMaritalStatus;
    }

    /**
     * Crea un objeto MaritalStatus con parametros solo para uso de catalogos
     * @param int $idMaritalStatus 
     * @param string $name 
     * @return MaritalStatus Objeto MaritalStatus
     */
    public static function createMaritalStatusInternal($idMaritalStatus, $name)
    {
        $newMaritalStatus = MaritalStatusFactory::createMaritalStatus($name);
        $newMaritalStatus->setIdMaritalStatus($idMaritalStatus);
        return $newMaritalStatus;
    }

}



