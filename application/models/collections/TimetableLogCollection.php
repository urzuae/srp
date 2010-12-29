<?php
/**
 * SRP
 *
 * SRP INELECTRA
 *
 * @category   lib
 * @package    lib_models
 * @copyright  Copyright (c) 2010 PCSMEXICO
 * @author     <arturo>, $LastChangedBy$
 * @version    1.0.2 SVN: $Id$
 */


require_once "lib/utils/Parser.php";

/**
 * Clase TimetableLogCollection que representa una collección de objetos TimetableLog
 *
 * @category   lib
 * @package    lib_models
 * @subpackage lib_models_collections
 * @copyright  Copyright (c) 2010 PCSMEXICO
 * @copyright  This File has been proudly generated by Bender (http://code.google.com/p/bender-modeler/). <chentepixtol> <zetta>
 * @author     zetta & chentepixtol
 * @version    1.0.2 SVN: $Revision$
 */
class TimetableLogCollection extends ArrayIterator
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
        $this->parser = new Parser('TimetableLog');
        parent::__construct($array);
    }

    /**
     * Appends the value
     * @param TimetableLog $timetableLog
     */
    public function append($timetableLog)
    {
        parent::offsetSet($timetableLog->getIdTimetableLog(), $timetableLog);
        $this->rewind();
    }

    /**
     * Return current array entry
     * @return TimetableLog
     */
    public function current()
    {
        return parent::current();
    }

    /**
     * Return current array entry and 
     * move to next entry
     * @return TimetableLog 
     */
    public function read()
    {
        $timetableLog = $this->current();
        $this->next();
        return $timetableLog;
    }

    /**
     * Get the first array entry
     * if exists or null if not 
     * @return TimetableLog|null 
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
     * Contains one object with $idTimetableLog
     * @param  int $idTimetableLog
     * @return boolean
     */
    public function contains($idTimetableLog)
    {
        return parent::offsetExists($idTimetableLog);
    }
    
    /**
     * Remove one object with $idTimetableLog
     * @param  int $idTimetableLog
     */
    public function remove($idTimetableLog)
    {
        if( $this->contains($idTimetableLog) )
            $this->offsetUnset($idTimetableLog);
    }
    
    /**
     * Merge two Collections
     * @param TimetableLogCollection $timetableLogCollection
     * @return void
     */
    public function merge(TimetableLogCollection $timetableLogCollection)
    {
        $timetableLogCollection->rewind();
        while($timetableLogCollection->valid())
        {
            $timetableLog = $timetableLogCollection->read();
            if( !$this->contains( $timetableLog->getIdTimetableLog() ) )
                $this->append($timetableLog);
        }
        $timetableLogCollection->rewind();
    }
    
    /**
     * Diff two Collections
     * @param TimetableLogCollection $timetableLogCollection
     * @return void
     */
    public function diff(TimetableLogCollection $timetableLogCollection)
    {
        $timetableLogCollection->rewind();
        while($timetableLogCollection->valid())
        {
            $timetableLog = $timetableLogCollection->read();
            if( $this->contains( $timetableLog->getIdTimetableLog() ) )
                $this->remove($timetableLog->getIdTimetableLog());     
        }
        $timetableLogCollection->rewind();
    }
    
    /**
     * Intersect two Collections
     * @param TimetableLogCollection $timetableLogCollection
     * @return TimetableLogCollection
     */
    public function intersect(TimetableLogCollection $timetableLogCollection)
    {
        $newtimetableLogCollection = TimetableLogCollection();
        $timetableLogCollection->rewind();
        while($timetableLogCollection->valid())
        {
            $timetableLog = $timetableLogCollection->read();
            if( $this->contains( $timetableLog->getIdTimetableLog() ) )
                $newtimetableLogCollection->append($timetableLog);
        }
        $timetableLogCollection->rewind();
        return $newtimetableLogCollection;
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
     * Retrieve the TimetableLog with primary key  
     * @param  int $idTimetableLog
     * @return TimetableLog
     */
    public function getByPK($idTimetableLog)
    {
        return $this->contains($idTimetableLog) ? $this[$idTimetableLog] : null;
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
            $timetableLog = $this->read();
            $this->parser->changeBean($timetableLog);
            $array[$timetableLog->getIdTimetableLog()] = $this->parser->toArray();
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
            $timetableLog = $this->read();
            $this->parser->changeBean($timetableLog);
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
    
    /**
     * Is Empty
     * @return boolean
     */
    public function isEmpty()
    {
        return $this->count() == 0;
    }
  
  
}

