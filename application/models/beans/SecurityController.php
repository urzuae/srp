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
 * Clase SecurityController
 *
 * @category   Project
 * @package    Project_Models
 * @subpackage Project_Models_Beans
 * @copyright  ##$COPYRIGHT$##
 * @copyright  ##$COPYRIGHT$##
 * @author     ##$AUTHOR$##, $LastChangedBy$
 * @version    ##$VERSION$##, SVN:  $Id$
 */
class SecurityController
{
    /**
     * Constante que contiene el nombre de la tabla
     * @static TABLENAME
     */
    const TABLENAME = "pcs_common_security_controllers";
    const ID_CONTROLLER = "pcs_common_security_controllers.id_controller";
    const NAME = "pcs_common_security_controllers.name";

    /**
     * $idController
     * 
     * @var int $idController
     */
    private $idController;

    /**
     * $name
     * 
     * @var string $name
     */
    private $name;

    /**
     * Set the idController value
     * 
     * @param int $idController
     */
    public function setIdController($idController)
    {
        $this->idController = $idController;
    }

    /**
     * Return the idController value
     * 
     * @return int
     */
    public function getIdController()
    {
        return $this->idController;
    }

    /**
     * Set the name value
     * 
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * Return the name value
     * 
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }


}

