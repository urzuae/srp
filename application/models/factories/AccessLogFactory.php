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
 * AccessLog
 */
require_once 'application/models/beans/AccessLog.php';

/**
 * Clase AccessLogFactory
 *
 * @category   Project
 * @package    Project_Models
 * @subpackage Project_Models_Factories
 * @copyright  ##$COPYRIGHT$##
 * @copyright  ##$COPYRIGHT$##
 * @author     ##$AUTHOR$##, $LastChangedBy$
 * @version    ##$VERSION$##, SVN:  $Id$
 */
class AccessLogFactory
{
    /**
     * Instancia un nuevo objeto AccessLog
     * @param int $idPerson 
     * @param int $idFingerprint 
     * @param Zend_Date $timestamp 
     * @param Zend_Date $created 
     * @param int $idEventType 
     * @param string $note 
     * @return AccessLog Objeto AccessLog
     */
    public static function createAccessLog($idPerson, $idFingerprint, Zend_Date $timestamp, Zend_Date $created, $idEventType, $note)
    {
        $newAccessLog = new AccessLog();
        $newAccessLog->setIdPerson($idPerson);
        $newAccessLog->setIdFingerprint($idFingerprint);
        $newAccessLog->setTimestamp($timestamp);
        $newAccessLog->setCreated($created);
        $newAccessLog->setIdEventType($idEventType);
        $newAccessLog->setNote($note);
        return $newAccessLog;
    }

    /**
     * Crea un objeto AccessLog con parametros solo para uso de catalogos
     * @param int $idAccessLog 
     * @param int $idPerson 
     * @param int $idFingerprint 
     * @param Zend_Date $timestamp 
     * @param Zend_Date $created 
     * @param int $idEventType 
     * @param string $note 
     * @return AccessLog Objeto AccessLog
     */
    public static function createAccessLogInternal($idAccessLog, $idPerson, $idFingerprint, Zend_Date $timestamp, Zend_Date $created, $idEventType, $note)
    {
        $newAccessLog = AccessLogFactory::createAccessLog($idPerson, $idFingerprint, $timestamp, $created, $idEventType, $note);
        $newAccessLog->setIdAccessLog($idAccessLog);
        return $newAccessLog;
    }

}



