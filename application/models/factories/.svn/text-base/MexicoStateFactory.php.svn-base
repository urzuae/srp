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
 * MexicoState
 */
require_once 'application/models/beans/MexicoState.php';

/**
 * Clase MexicoStateFactory
 *
 * @category   Project
 * @package    Project_Models
 * @subpackage Project_Models_Factories
 * @copyright  ##$COPYRIGHT$##
 * @copyright  ##$COPYRIGHT$##
 * @author     ##$AUTHOR$##, $LastChangedBy$
 * @version    ##$VERSION$##, SVN:  $Id$
 */
class MexicoStateFactory
{
    /**
     * Instancia un nuevo objeto MexicoState
     * @param string $name 
     * @return MexicoState Objeto MexicoState
     */
    public static function createMexicoState($name)
    {
        $newMexicoState = new MexicoState();
        $newMexicoState->setName($name);
        return $newMexicoState;
    }

    /**
     * Crea un objeto MexicoState con parametros solo para uso de catalogos
     * @param int $idMexicoState 
     * @param string $name 
     * @return MexicoState Objeto MexicoState
     */
    public static function createMexicoStateInternal($idMexicoState, $name)
    {
        $newMexicoState = MexicoStateFactory::createMexicoState($name);
        $newMexicoState->setIdMexicoState($idMexicoState);
        return $newMexicoState;
    }

}



