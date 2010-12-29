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
 * Clase AddressCollection que representa una collección de objetos Address
 *
 * @category   Project
 * @package    Project_Models
 * @subpackage Project_Models_Collections
 * @copyright  ##$COPYRIGHT$##
 * @copyright  ##$COPYRIGHT$##
 * @author     ##$AUTHOR$##, $LastChangedBy$
 * @version    ##$VERSION$##, SVN:  $Id$
 */
class AddressCollection extends ArrayIterator
{
	/**
     * Appends the value
     * @param Address $address
     */
    public function append($address)
    {
        parent::append($address);
    }

    /**
     * Return current array entry
     * @return Address
     */
    public function current()
    {
        return parent::current();
    }

    /**
     * Return current array entry and
     * move to next entry
     * @return Address
     */
    public function read()
    {
        $address = $this->current();
        $this->next();
        return $address;
    }

    /**
     * Get the first array entry
     * if exists or null if not
     * @return Address|null
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
    		$array[$object->getIdAddress()] = $object->getStreet();
    	}
    	return $array;
    }
}




