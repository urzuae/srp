<?php
/**
 * ##$BRAND_NAME$##
 *
 * ##$DESCRIPTION$##
 *
 * @category   Project
 * @package    Project_Controllers
 * @copyright  ##$COPYRIGHT$##
 * @author     ##$AUTHOR$##, $LastChangedBy$
 * @version    ##$VERSION$##, SVN:  $Id$
 */

/**
 * BaseController
 */
require_once "lib/controller/BaseController.php";

/**
 * BankCatalog
 */
//require_once 'application/models/catalogs/ZipCodeCatalog.php';

/**
 * Clase IndexController que representa el controller para los codigos postales
 *
 * @category   Project
 * @package    Project_Controllers
 * @copyright  ##$COPYRIGHT$##
 */
class AddressController extends BaseController
{
    /**
     * regresa la información de un codigo postal
     */
    /*public function getJsonByZipCodeAction()
    {
    	try
        {
            require_once 'Zend/Json.php';
            $zipCode = $this->getRequest()->getParam('value');
            $zipCodes = ZipCodeCatalog::getInstance()->getByZipCode($zipCode)->prepareToJson();
            die(Zend_Json::encode($zipCodes));
        }
        catch(Exception $e)
        {
            throw new Exception("Error al buscar el codigo postal\n".$e->getMessage());
        }
    }
    */

    
    
}




