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
 * Clase MaritalStatusCollection que representa una collección de objetos MaritalStatus
 *
 * @category   Project
 * @package    Project_Models
 * @subpackage Project_Models_Collections
 * @copyright  ##$COPYRIGHT$##
 * @copyright  ##$COPYRIGHT$##
 * @author     ##$AUTHOR$##, $LastChangedBy$
 * @version    ##$VERSION$##, SVN:  $Id$
 */
class MaritalStatusCollection extends ArrayIterator
{
	/**
     * Appends the value
     * @param MaritalStatus $maritalStatus
     */
    public function append($maritalStatus)
    {
        parent::append($maritalStatus);
    }

    /**
     * Return current array entry
     * @return MaritalStatus
     */
    public function current()
    {
        return parent::current();
    }

    /**
     * Return current array entry and
     * move to next entry
     * @return MaritalStatus
     */
    public function read()
    {
        $maritalStatus = $this->current();
        $this->next();
        return $maritalStatus;
    }

    /**
     * Get the first array entry
     * if exists or null if not
     * @return MaritalStatus|null
     */
    public function getOne()
    {
        if ($this->count() > 0)
        {
            $this->seek(0);
            return $this->current();
        } else
            return null;
    }
    
    /**
     * Genera un arreglo a partir de la colección
     * @return Array
     */
    public function toArray()
    {
    	$array = array();
    	while($this->valid())
    	{
    		$object = $this->read();
    		$array[$object->getIdMaritalStatus()] = $object->getName();
    	}
    	return $array;
    }
}




