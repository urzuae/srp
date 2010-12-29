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
 * Clase PhoneNumberCollection que representa una collección de objetos PhoneNumber
 *
 * @category   Project
 * @package    Project_Models
 * @subpackage Project_Models_Collections
 * @copyright  ##$COPYRIGHT$##
 * @copyright  ##$COPYRIGHT$##
 * @author     ##$AUTHOR$##, $LastChangedBy$
 * @version    ##$VERSION$##, SVN:  $Id$
 */
class PhoneNumberCollection extends ArrayIterator
{
	/**
     * Appends the value
     * @param PhoneNumber $phoneNumber
     */
    public function append($phoneNumber)
    {
        parent::append($phoneNumber);
    }

    /**
     * Return current array entry
     * @return PhoneNumber
     */
    public function current()
    {
        return parent::current();
    }

    /**
     * Return current array entry and
     * move to next entry
     * @return PhoneNumber
     */
    public function read()
    {
        $phoneNumber = $this->current();
        $this->next();
        return $phoneNumber;
    }

    /**
     * Get the first array entry
     * if exists or null if not
     * @return PhoneNumber|null
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
    		$array[$object->getIdPhoneNumber()] = $object->getNumber();
    	}
    	return $array;
    }
}




