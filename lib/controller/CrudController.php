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

/**
 * Clase abstracta para los CRUDS
 *
 * @category   project
 * @package    Project_Controllers
 * @copyright  ##$COPYRIGHT$##
 */
abstract class CrudController extends BaseController
{
	
	/**
	 * list all objects
	 */
	abstract public function listAction();
	
	/**
	 * delete an object
	 */
	abstract public function deleteAction();
	
	/**
	 * Form to edit an object
	 */
	abstract public function editAction();
	
	/**
	 * Create an Object
	 */
	abstract public function createAction();
	
	/**
	 * Update an Object
	 */
	abstract public function updateAction();
	
}














