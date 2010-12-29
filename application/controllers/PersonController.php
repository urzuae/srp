<?php
/**
 * SRP
 *
 * SRP INELECTRA
 *
 * @category   Application
 * @package    Application_Controllers
 * @copyright  Copyright (c) 2010 PCSMEXICO
 * @author     <arturo>, $LastChangedBy$
 * @version    1.0.2 SVN: $Id$
 */

/**
 * Dependences
 */
require_once "lib/controller/CrudController.php";
require_once "application/models/catalogs/PersonCatalog.php";

/**
 * PersonController (CRUD for the Person Objects)
 *
 * @category   Project
 * @package    Project_Controllers
 * @copyright  Copyright (c) 2010 PCSMEXICO 
 * @copyright  This File has been proudly generated by Bender (http://code.google.com/p/bender-modeler/). <chentepixtol> <zetta>
 * @author     <zetta> & <chentepixtol>
 * @version    1.0.2 SVN: $Revision$
 */
class PersonController extends CrudController
{
    
    /**
     * alias for the list action
     */
    public function indexAction()
    {
        $this->_forward('list');
    }
    
    /**
     * List the objects Person actives
     */
    public function listAction()
    {
        $this->view->persons = PersonCatalog::getInstance()->getActives();
        $this->setTitle('List the Person');
    }
    
    /**
     * delete an Person
     */
    public function deleteAction()
    {
        $personCatalog = PersonCatalog::getInstance();
        $idPerson = $this->getRequest()->getParam('idPerson');
        $person = $personCatalog->getById($idPerson);
        $personCatalog->deactivate($person);
        $this->setFlash('ok','Successfully removed the Person');
        $this->_redirect('person/list');
    }
    
    /**
     * Form for edit an Person
     */
    public function editAction()
    {
        $personCatalog = PersonCatalog::getInstance();
        $idPerson = $this->getRequest()->getParam('idPerson');
        $person = $personCatalog->getById($idPerson);
        $post = array(
            'id_person' => $person->getIdPerson(),
            'name' => $person->getName(),
            'middle_name' => $person->getMiddleName(),
            'last_name' => $person->getLastName(),
            'birthdate' => $person->getBirthdate(),
            'ssn' => $person->getSsn(),
            'genre' => $person->getGenre(),
            'marital_status' => $person->getMaritalStatus(),
            'curp' => $person->getCurp(),
            'nationality' => $person->getNationality(),
            'id_fiscal_entity' => $person->getIdFiscalEntity(),
        );
        $this->view->post = $post;
        $this->setTitle('Edit Person');
    }
    
    /**
     * Create an Person
     */
    public function createAction()
    {   
        $personCatalog = PersonCatalog::getInstance();
        $name = utf8_decode($this->getRequest()->getParam('name'));
        $middleName = utf8_decode($this->getRequest()->getParam('middle_name'));
        $lastName = utf8_decode($this->getRequest()->getParam('last_name'));
        $birthdate = utf8_decode($this->getRequest()->getParam('birthdate'));
        $ssn = utf8_decode($this->getRequest()->getParam('ssn'));
        $genre = utf8_decode($this->getRequest()->getParam('genre'));
        $maritalStatus = utf8_decode($this->getRequest()->getParam('marital_status'));
        $curp = utf8_decode($this->getRequest()->getParam('curp'));
        $nationality = utf8_decode($this->getRequest()->getParam('nationality'));
        $idFiscalEntity = utf8_decode($this->getRequest()->getParam('id_fiscal_entity'));
        $person = PersonFactory::create($name, $middleName, $lastName, $birthdate, $ssn, $genre, $maritalStatus, $curp, $nationality, $idFiscalEntity);
        $personCatalog->create($person);  
        $this->view->setTpl('_row');
        $this->view->setLayoutFile(false);
        $this->view->person = $person;
    }
    
    /**
     * Update an Person
     */
    public function updateAction()
    {
        $personCatalog = PersonCatalog::getInstance();
        $idPerson = $this->getRequest()->getParam('idPerson');
        $person = $personCatalog->getById($idPerson);
        $person->setName($this->getRequest()->getParam('name'));
        $person->setMiddleName($this->getRequest()->getParam('middle_name'));
        $person->setLastName($this->getRequest()->getParam('last_name'));
        $person->setBirthdate($this->getRequest()->getParam('birthdate'));
        $person->setSsn($this->getRequest()->getParam('ssn'));
        $person->setGenre($this->getRequest()->getParam('genre'));
        $person->setMaritalStatus($this->getRequest()->getParam('marital_status'));
        $person->setCurp($this->getRequest()->getParam('curp'));
        $person->setNationality($this->getRequest()->getParam('nationality'));
        $person->setIdFiscalEntity($this->getRequest()->getParam('id_fiscal_entity'));
        $personCatalog->update($person);
        $this->setFlash('ok','Successfully edited the Person');
        $this->_redirect('person/list');
    }
    
}
