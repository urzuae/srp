<?php
/**
 * SRP
 *
 * SRP INELECTRA
 *
 * @category   lib
 * @package    lib_models
 * @copyright  Copyright (c) 2010 PCSMEXICO
 * @author     <arturo>, $LastChangedBy$
 * @version    1.0.2 SVN: $Id$
 */

/**
 * Clase Timetable
 *
 * @category   lib
 * @package    lib_models
 * @subpackage lib_models_beans
 * @copyright  Copyright (c) 2010 PCSMEXICO
 * @copyright  This File has been proudly generated by Bender (http://code.google.com/p/bender-modeler/). <chentepixtol> <zetta>
 * @author     <zetta> & <chentepixtol>
 * @version    1.0.2 SVN: $Revision$
 */
class Timetable
{
    /**
     * Constante que contiene el nombre de la tabla
     * @static TABLENAME
     */
    const TABLENAME = "pcs_srp_core_timetables";

    /**
     * Constantes para los nombres de los campos
     */
    const ID_TIMETABLE = "pcs_srp_core_timetables.id_timetable";
    const ID_EMPLOYEE = "pcs_srp_core_timetables.id_employee";
    const DATE = "pcs_srp_core_timetables.date";
    const ID_APPROVER_1 = "pcs_srp_core_timetables.id_approver_1";
    const ID_APPROVER_2 = "pcs_srp_core_timetables.id_approver_2";
    const ID_CURRENT_APPROVER = "pcs_srp_core_timetables.id_current_approver";
    const ATTENDANCE_TYPE = "pcs_srp_core_timetables.attendance_type";
    const STATUS = "pcs_srp_core_timetables.status";


    /**
     * $idTimetable
     *
     * @var int $idTimetable
     */
    private $idTimetable;


    /**
     * $idEmployee
     *
     * @var int $idEmployee
     */
    private $idEmployee;


    /**
     * $date
     *
     * @var datetime $date
     */
    private $date;


    /**
     * $idApprover1
     *
     * @var int $idApprover1
     */
    private $idApprover1;


    /**
     * $idApprover2
     *
     * @var int $idApprover2
     */
    private $idApprover2;


    /**
     * $idCurrentApprover
     *
     * @var int $idCurrentApprover
     */
    private $idCurrentApprover;


    /**
     * $attendanceType
     *
     * @var int $attendanceType
     */
    private $attendanceType;


    /**
     * $status
     * 1=>draft,
2=>released,
3=>rejected,
4=>approved,
5=>not _registered
     * @var int $status
     */
    private $status;

    /**
     * Set the idTimetable value
     *
     * @param int idTimetable
     * @return Timetable $timetable
     */
    public function setIdTimetable($idTimetable)
    {
        $this->idTimetable = $idTimetable;
        return $this;
    }

    /**
     * Return the idTimetable value
     *
     * @return int
     */
    public function getIdTimetable()
    {
        return $this->idTimetable;
    }

    /**
     * Set the idEmployee value
     *
     * @param int idEmployee
     * @return Timetable $timetable
     */
    public function setIdEmployee($idEmployee)
    {
        $this->idEmployee = $idEmployee;
        return $this;
    }

    /**
     * Return the idEmployee value
     *
     * @return int
     */
    public function getIdEmployee()
    {
        return $this->idEmployee;
    }

    /**
     * Set the date value
     *
     * @param datetime date
     * @return Timetable $timetable
     */
    public function setDate($date)
    {
        $this->date = $date;
        return $this;
    }

    /**
     * Return the date value
     *
     * @return datetime
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * Set the idApprover1 value
     *
     * @param int idApprover1
     * @return Timetable $timetable
     */
    public function setIdApprover1($idApprover1)
    {
        $this->idApprover1 = $idApprover1;
        return $this;
    }

    /**
     * Return the idApprover1 value
     *
     * @return int
     */
    public function getIdApprover1()
    {
        return $this->idApprover1;
    }

    /**
     * Set the idApprover2 value
     *
     * @param int idApprover2
     * @return Timetable $timetable
     */
    public function setIdApprover2($idApprover2)
    {
        $this->idApprover2 = $idApprover2;
        return $this;
    }

    /**
     * Return the idApprover2 value
     *
     * @return int
     */
    public function getIdApprover2()
    {
        return $this->idApprover2;
    }

    /**
     * Set the idCurrentApprover value
     *
     * @param int idCurrentApprover
     * @return Timetable $timetable
     */
    public function setIdCurrentApprover($idCurrentApprover)
    {
        $this->idCurrentApprover = $idCurrentApprover;
        return $this;
    }

    /**
     * Return the idCurrentApprover value
     *
     * @return int
     */
    public function getIdCurrentApprover()
    {
        return $this->idCurrentApprover;
    }

    /**
     * Set the attendanceType value
     *
     * @param int attendanceType
     * @return Timetable $timetable
     */
    public function setAttendanceType($attendanceType)
    {
        $this->attendanceType = $attendanceType;
        return $this;
    }

    /**
     * Return the attendanceType value
     *
     * @return int
     */
    public function getAttendanceType()
    {
        return $this->attendanceType;
    }

    /**
     * Set the status value
     * 1=>draft,
2=>released,
3=>rejected,
4=>approved,
5=>not _registered
     * @param int status
     * @return Timetable $timetable
     */
    public function setStatus($status)
    {
        $this->status = $status;
        return $this;
    }

    /**
     * Return the status value
     * 1=>draft,
2=>released,
3=>rejected,
4=>approved,
5=>not _registered
     * @return int
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Status
     * @var Array
     */
    public static $Status = array(
        "draft"=>1,
        "released"=>2,
        "rejected"=>3,
        "approved"=>4,
        "not_registered"=>5
    );

    /**
     * Status Labels
     * @var Array
     */
    public static $StatusLabel = array(
        1=>"Borrador",
        2=>"Liberada",
        3=>"Rechazada",
        4=>"Aprobada",
        5=>"not_registered"
    );

    /**
     * Status
     * @var Array
     */
    public static $AttendanceType = array(
        "Attendance"=>1,
        "leaveRecoverable"=>2,
        "leaveNoRecoverable"=>3,
        "ExtraHours"=>5,
        "illness"=>4,
        "absenceAuthorized"=>6
    );

//    /**
//     * Status Labels
//     * @var Array
//     */
//    public static $AttendanceTypeLabel = array(
//        1=>"Attendance",
//        2=>"leaveRecoverable",
//        3=>"leaveNoRecoverable",
//        4=>"illness",
//        5=>"ExtraHours",
//        6=>"absenceAuthorized"
//    );

    /**
     * Status Labels
     * @var Array
     */
    public static $AttendanceTypeLabel = array(
        1=>"Presencias reales",
        2=>"Permiso recuperable",
        3=>"Permiso no recuperable",
        4=>"Horas extras",
        5=>"Enfermedad < 4 d�as",
        6=>"Ausencias autorizadas"
    );
}
