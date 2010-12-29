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

require_once 'lib/controller/BaseController.php';
require_once 'lib/error/ErrorManager.php';

/**
 * Clase ErrorController, que se encarga de mostrar los errores en pantalla
 *
 * @category   project
 * @package    Project_Controllers
 * @copyright  ##$COPYRIGHT$##
 */
class ErrorController extends BaseController
{
    /**
     * Sobrecargamos la función init para que no pida autentificación
     */
    public function init()
    {
        $registry = Zend_Registry::getInstance();
        $this->view->moduleName = $this->getRequest()->getModuleName();
        $this->view->controllerName = $this->getRequest()->getControllerName();
        $this->view->actionName = $this->getRequest()->getActionName();
        $this->view->baseUrl = $this->getRequest()->getBaseUrl();
        $this->view->systemTitle = utf8_decode($registry->config->appSettings->titulo);
        $this->view->l10n = new Zend_Translate('gettext', 'data/locale/base.mo', 'es');
    }

    /**
     * Muestra el Error
     */
    public function errorAction()
    {
    	$errorManager = new ErrorManager($this->view);
    	$errorManager->dispatch();
    }
}
