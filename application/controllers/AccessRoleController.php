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
 * Dependences
 */
require_once "lib/controller/CrudController.php";
require_once 'application/models/catalogs/AccessRoleCatalog.php';

/**
 * AccessRoleController (CRUD for the AccessRole Objects)
 *
 * @category   Project
 * @package    Project_Controllers
 * @copyright  ##$COPYRIGHT$##
 */
class AccessRoleController extends CrudController
{
	
    /**
     * alias for the list action
     */
    public function indexAction()
    {
        $this->_forward('list');
    }
    
    /**
     * List the objects AccessRole actives
     */
    public function listAction()
    {
    	$this->view->accessRoles = AccessRoleCatalog::getInstance()->getActives();
    	$this->setTitle('Lista de Grupos de Usuario');
    }
    
    /**
     * delete an AccessRole
     */
    public function deleteAction()
    {
    	$accessRoleCatalog = AccessRoleCatalog::getInstance();
    	$idAccessRole = $this->getRequest()->getParam('id');
    	$accessRole = $accessRoleCatalog->getById($idAccessRole);
    	$accessRoleCatalog->deactivate($accessRole);
    	$this->_redirect('access-role/list');
    }
    
    /**
     * Form for edit an AccessRole
     */
    public function editAction()
    {
    	$accessRoleCatalog = AccessRoleCatalog::getInstance();
    	$idAccessRole = $this->getRequest()->getParam('id');
    	$accessRole = $accessRoleCatalog->getById($idAccessRole);
    	$this->view->accessRole = $accessRole;
    	$this->setTitle('Editar Grupo de Usuario');
    }
    
    /**
     * Create an AccessRole
     */
    public function createAction()
    {
    	$name = utf8_decode($this->getRequest()->getParam('name'));
    	$accessRoleCatalog = AccessRoleCatalog::getInstance();
    	$accessRole = $accessRoleCatalog->getOrCreateByName($name);
    	$accessRoleCatalog->activate($accessRole);
    	$this->view->setTpl('_row');
    	$this->view->setLayoutFile(false);
    	$this->view->accessRole = $accessRole;
    }
    
    /**
     * Update an AccessRole
     */
    public function updateAction()
    {
    	$accessRoleCatalog = AccessRoleCatalog::getInstance();
    	$idAccessRole = $this->getRequest()->getParam('id');
    	$accessRole = $accessRoleCatalog->getById($idAccessRole);
    	$accessRole->setName($this->getRequest()->getParam('name'));
    	$accessRoleCatalog->update($accessRole);
    	$this->setFlash('ok','Se edito correctamente el grupo de usuario');
    	$this->_redirect('access-role/list');
    }
    
}




