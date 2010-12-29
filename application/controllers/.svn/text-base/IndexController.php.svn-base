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

require_once "lib/controller/BaseController.php";
require_once "lib/managers/TimetableManager.php";

/**
 * Clase IndexController que representa el controller para la ruta default
 *
 * @category   Project
 * @package    Project_Controllers
 * @copyright  ##$COPYRIGHT$##
 */
class IndexController extends BaseController
{
    /**
     * Pantalla para despues del inicio de sesi�n
     */
    public function indexAction()
    {
    	/*$this->setFlash('notice', 'notice');
    	$this->setFlash('warning', 'warning');
    	$this->setFlash('alert', 'alert');
    	$this->setFlash('error', 'error');
    	$this->setFlash('ok', 'ok');
    	$this->setFlash('note', 'note');*/
        $this->view->contentTitle = 'Home';
        
        if($this->getUser()->getAccessRole()==1){
            $date=new Zend_Date();
            $lastDay=CalendarDayManager::getInstance()->lastday($date->getMonth()->toString("MM"),$date->getYear()->toString("yyyy"));
//            $lastDay->addMonth(1);
//            $lastDay->addDay(-1);
            //die($lastDay);
            if($date->get(Zend_Date::WEEKDAY_DIGIT)==5 || $date->getDay()->toString("dd")==$lastDay){
                $timetables=TimetableManager::getInstance ()->checkTimetableByEmployee ($this->getUser ()->getBeanEmployee ()->getIdEmployee ());
                if(!empty($timetables)){
                    $this->view->popup=true;
                    $this->view->popup_dates=$timetables;
                }
            }
        }
        $this->view->setTpl('Home');
    }
}


