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
 * Clase AccessLogCollection que representa una collección de objetos AccessLog
 *
 * @category   Project
 * @package    Project_Models
 * @subpackage Project_Models_Collections
 * @copyright  ##$COPYRIGHT$##
 * @copyright  ##$COPYRIGHT$##
 * @author     ##$AUTHOR$##, $LastChangedBy$
 * @version    ##$VERSION$##, SVN:  $Id$
 */
class AccessLogCollection extends ArrayIterator
{
	/**
     * Appends the value
     * @param AccessLog $accessLog
     */
    public function append($accessLog)
    {
        parent::append($accessLog);
    }

    /**
     * Return current array entry
     * @return AccessLog
     */
    public function current()
    {
        return parent::current();
    }

    /**
     * Return current array entry and
     * move to next entry
     * @return AccessLog
     */
    public function read()
    {
        $accessLog = $this->current();
        $this->next();
        return $accessLog;
    }

    /**
     * Get the first array entry
     * if exists or null if not
     * @return AccessLog|null
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
}




