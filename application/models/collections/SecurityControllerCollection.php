<?php
/**
 * Bender Modeler
 *
 * Our Simple Models
 *
 * @category   lib
 * @package    lib_models
 * @copyright  Copyright (c) 2008-2010 Bender Modeler (http://www.ctrl-zetta.com/#code)
 * @author     <zetta> <chentepixtol>, $LastChangedBy$
 * @version    1.0.0 SVN: $Id$
 */


require_once "lib/utils/Parser.php";

/**
 * Clase SecurityControllerCollection que representa una collección de objetos SecurityController
 *
 * @category   lib
 * @package    lib_models
 * @subpackage lib_models_collections
 * @copyright  Copyright (c) 2008-2010 Bender Modeler (http://www.ctrl-zetta.com/#code)
 * @copyright  This File as been proudly generated by Bender (http://code.google.com/p/bender-modeler/). <chentepixtol> <zetta>
 * @author     zetta & chentepixtol
 * @version    1.0.0 SVN: $Revision$
 */
class SecurityControllerCollection extends ArrayIterator
{

    /**
     * @var Parser
     */
    private $parser;
    
    /**
     * Constructor
     * @param array $array
     * @return void
     */
    public function __construct($array = array())
    {
        $this->parser = new Parser('SecurityController');
        parent::__construct($array);
    }

    /**
     * Appends the value
     * @param SecurityController $securityController
     */
    public function append(SecurityController $securityController)
    {
        parent::offsetSet($securityController->getIdController(), $securityController);
        $this->rewind();
    }

    /**
     * Return current array entry
     * @return SecurityController
     */
    public function current()
    {
        return parent::current();
    }

    /**
     * Return current array entry and 
     * move to next entry
     * @return SecurityController 
     */
    public function read()
    {
        $securityController = $this->current();
        $this->next();
        return $securityController;
    }

    /**
     * Get the first array entry
     * if exists or null if not 
     * @return SecurityController|null 
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
     * Contains one object with $idController
     * @param  int $idController
     * @return boolean
     */
    public function contains($idController)
    {
        return parent::offsetExists($idController);
    }
    
    /**
     * Merge two Collections
     * @param SecurityControllerCollection $securityControllerCollection
     * @return void
     */
    public function merge(SecurityControllerCollection $securityControllerCollection)
    {
        while($securityControllerCollection->valid())
        {
            $securityController = $securityControllerCollection->read();
            if( !$this->contains( $securityController->getIdController() ) )
            {
                $this->append($securityController);
            }             
        }
        $securityControllerCollection->rewind();
    }
    
    /**
     * Retrieve the array with primary keys 
     * @return array
     */
    public function getPrimaryKeys()
    {
        return array_keys($this->getArrayCopy());
    }
    
  
    /**
     * Transforma una collection a un array
     * @return array
     */
    public function toArray()
    {
        $array = array();
        while ($this->valid())
        {
            $securityController = $this->read();
            $this->parser->changeBean($securityController);
            $array[$securityController->getIdController()] = $this->parser->toArray();
        }
        $this->rewind();
        return $array;
    }
    
    /**
     * Crea un array asociativo de $key => $value a partir de las constantes de un bean
     * @param string $ckey
     * @param string $cvalue
     * @return array
     */
    public function toKeyValueArray($ckey, $cvalue)
    {
        $array = array();
        while ($this->valid())
        {
            $securityController = $this->read();
            $this->parser->changeBean($securityController);
            $array += $this->parser->toKeyValueArray($ckey, $cvalue);
        }
        $this->rewind();
        return $array;
    }
    
    /**
     * Retrieve the parser object
     * @return Parser
     */
    public function getParser()
    {
        return $this->parser;
    }
  
  
}

