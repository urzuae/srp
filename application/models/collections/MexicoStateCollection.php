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
 * Clase MexicoStateCollection que representa una collección de objetos MexicoState
 *
 * @category   Project
 * @package    Project_Models
 * @subpackage Project_Models_Collections
 * @copyright  ##$COPYRIGHT$##
 * @copyright  ##$COPYRIGHT$##
 * @author     ##$AUTHOR$##, $LastChangedBy$
 * @version    ##$VERSION$##, SVN:  $Id$
 */
class MexicoStateCollection extends ArrayIterator
{
	/**
     * Appends the value
     * @param MexicoState $mexicoState
     */
    public function append($mexicoState)
    {
        parent::append($mexicoState);
    }

    /**
     * Return current array entry
     * @return MexicoState
     */
    public function current()
    {
        return parent::current();
    }

    /**
     * Return current array entry and
     * move to next entry
     * @return MexicoState
     */
    public function read()
    {
        $mexicoState = $this->current();
        $this->next();
        return $mexicoState;
    }

    /**
     * Get the first array entry
     * if exists or null if not
     * @return MexicoState|null
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
    		$array[$object->getIdMexicoState()] = $object->getName();
    	}
    	return $array;
    }
}




