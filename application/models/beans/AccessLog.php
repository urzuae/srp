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
 * Clase AccessLog
 *
 * @category   Project
 * @package    Project_Models
 * @subpackage Project_Models_Beans
 * @copyright  ##$COPYRIGHT$##
 * @copyright  ##$COPYRIGHT$##
 * @author     ##$AUTHOR$##, $LastChangedBy$
 * @version    ##$VERSION$##, SVN:  $Id$
 */
class AccessLog
{
    /**
     * Constante que contiene el nombre de la tabla
     * @static TABLENAME
     */
    const TABLENAME = "pcs_scc_core_person_access_logs";
    const ID_ACCESS_LOG = "pcs_scc_core_person_access_logs.id_access_log";
    const ID_PERSON = "pcs_scc_core_person_access_logs.id_person";
    const ID_FINGERPRINT = "pcs_scc_core_person_access_logs.id_fingerprint";
    const TIMESTAMP = "pcs_scc_core_person_access_logs.timestamp";
    const CREATED = "pcs_scc_core_person_access_logs.created";
    const ID_EVENT_TYPE = "pcs_scc_core_person_access_logs.id_event_type";
    const NOTE = "pcs_scc_core_person_access_logs.note";

    /**
     * $idAccessLog
     * 
     * @var int $idAccessLog
     */
    private $idAccessLog;

    /**
     * $idPerson
     * 
     * @var int $idPerson
     */
    private $idPerson;

    /**
     * $idFingerprint
     * 
     * @var int $idFingerprint
     */
    private $idFingerprint;

    /**
     * $timestamp
     * 
     * @var Zend_Date $timestamp
     */
    private $timestamp;

    /**
     * $created
     * 
     * @var Zend_Date $created
     */
    private $created;

    /**
     * $idEventType
     * 
     * @var int $idEventType
     */
    private $idEventType;

    /**
     * $note
     * 
     * @var string $note
     */
    private $note;

    /**
     * Set the idAccessLog value
     * 
     * @param int $idAccessLog
     */
    public function setIdAccessLog($idAccessLog)
    {
        $this->idAccessLog = $idAccessLog;
    }

    /**
     * Return the idAccessLog value
     * 
     * @return int
     */
    public function getIdAccessLog()
    {
        return $this->idAccessLog;
    }

    /**
     * Set the idPerson value
     * 
     * @param int $idPerson
     */
    public function setIdPerson($idPerson)
    {
        $this->idPerson = $idPerson;
    }

    /**
     * Return the idPerson value
     * 
     * @return int
     */
    public function getIdPerson()
    {
        return $this->idPerson;
    }

    /**
     * Set the idFingerprint value
     * 
     * @param int $idFingerprint
     */
    public function setIdFingerprint($idFingerprint)
    {
        $this->idFingerprint = $idFingerprint;
    }

    /**
     * Return the idFingerprint value
     * 
     * @return int
     */
    public function getIdFingerprint()
    {
        return $this->idFingerprint;
    }

    /**
     * Set the timestamp value
     * 
     * @param Zend_Date $timestamp
     */
    public function setTimestamp(Zend_Date $timestamp)
    {
        $this->timestamp = $timestamp;
    }

    /**
     * Return the timestamp value
     * 
     * @return Zend_Date
     */
    public function getTimestamp()
    {
        return $this->timestamp;
    }

    /**
     * Set the created value
     * 
     * @param Zend_Date $created
     */
    public function setCreated(Zend_Date $created)
    {
        $this->created = $created;
    }

    /**
     * Return the created value
     * 
     * @return Zend_Date
     */
    public function getCreated()
    {
        return $this->created;
    }

    /**
     * Set the idEventType value
     * 
     * @param int $idEventType
     */
    public function setIdEventType($idEventType)
    {
        $this->idEventType = $idEventType;
    }

    /**
     * Return the idEventType value
     * 
     * @return int
     */
    public function getIdEventType()
    {
        return $this->idEventType;
    }

    /**
     * Set the note value
     * 
     * @param string $note
     */
    public function setNote($note)
    {
        $this->note = $note;
    }

    /**
     * Return the note value
     * 
     * @return string
     */
    public function getNote()
    {
        return $this->note;
    }


}

