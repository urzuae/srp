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
 * Clase ZipCodeCollection que representa una collección de objetos ZipCode
 *
 * @category   Project
 * @package    Project_Models
 * @subpackage Project_Models_Collections
 * @copyright  ##$COPYRIGHT$##
 * @copyright  ##$COPYRIGHT$##
 * @author     ##$AUTHOR$##, $LastChangedBy$
 * @version    ##$VERSION$##, SVN:  $Id$
 */
class ZipCodeCollection extends ArrayIterator
{
	/**
     * Appends the value
     * @param ZipCode $zipCode
     */
    public function append($zipCode)
    {
        parent::append($zipCode);
    }

    /**
     * Return current array entry
     * @return ZipCode
     */
    public function current()
    {
        return parent::current();
    }

    /**
     * Return current array entry and
     * move to next entry
     * @return ZipCode
     */
    public function read()
    {
        $zipCode = $this->current();
        $this->next();
        return $zipCode;
    }

    /**
     * Get the first array entry
     * if exists or null if not
     * @return ZipCode|null
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
    		$array[$object->getZipCode()] = $object->getZipCode();
    	}
    	return $array;
    }
    
    /**
     * Obtiene un arreglo formateado de la colección de items que contiene
     */
    public function prepareToJson()
    {
    	$results = array('settlement'=>array(), 'district'=>array(), 'state'=>array(), 'city'=>array(),'mexicoState' => array());
    	while($this->valid())
    	{
    		$object = $this->read();
    		if(!in_array($object->getSettlement(), $results['settlement']))
                $results['settlement'][] = $object->getSettlement();
            if(!in_array($object->getDistrict(), $results['district']))
                $results['district'][] = $object->getDistrict();
            if(!in_array($object->getState(), $results['state']))
                $results['state'][] = $object->getState();
            if(!in_array($object->getCity(), $results['city']))
                $results['city'][] = $object->getCity();
            if(!in_array($object->getMexicoState(), $results['mexicoState']))
                $results['mexicoState'][] = $object->getMexicoState();
    	}
   	    $data = array(
               'settlement'  => $this->parseData($results['settlement']), 
               'district'    => $this->parseData($results['district']), 
               'state'       => $this->parseData($results['state']),
   	    	   'mexicoState' => $this->parseData($results['mexicoState']), 
               'city'        => $this->parseData($results['city'])
   	    );
    	return $data;
    }
    
    /** 
     * Construye los datos que se enviaran dependiendo de los datos que contengan los arreglos
     * @param mixed data
     * @return mixed 
     */
    private function parseData($data)
    {
        if(is_string($data))
        {
            return (str_replace('+', '%20', urlencode($data)));
        }
        else 
            if(count($data) == 1)
            {
                return (str_replace('+', '%20', urlencode($data[0])));
            }
            else
            {
                if(count($data) == 0)
                    return '';
                else
                {
                    foreach($data as $var => $value)
                    {
                        $data[$var] = (str_replace('+', '%20', urlencode($value)));
                    }
                    return $data;
                }
            }
    }
}




