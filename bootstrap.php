<?php
$ms = microtime(true);
try 
{
    //Por si requieren un autoloader =D
    //require_once("lib/autoloader/ProjectAutoloader.php");
    //$autoloader = ProjectAutoloader::getInstance('Cache/Autoloader/autoload.dat');
    //$autoloader->register();

    //creamos el registry
    require_once "Zend/Registry.php";
    $registry = new Zend_Registry(array(), ArrayObject::ARRAY_AS_PROPS);
    Zend_Registry::setInstance($registry);

    //obtenemos la informacion del webconfig y rellenamos el registry
    require_once "Zend/Config/Xml.php";
    $config = new Zend_Config_Xml('data/webconfig.xml', 'project');
    $registry->config = $config;

    //iniciamos la base de datos
    require_once "lib/db/DBAO.php";
    DBAO::$config = $registry->config->database;    
    
    //iniciamos el locale
    require_once "Zend/Locale.php";
    Zend_Locale::setDefault('es_MX');
    $locale = new Zend_Locale('es_MX');
    $registry->set('Zend_Locale', $locale);
    
    //generamos el cache de zend_date
    require_once "Zend/Cache.php";
    require_once "Zend/Date.php";
    $adapter = Zend_Cache::factory('Output','File',array('write_control' => true ),array('cache_dir' => 'cache/dates'));
    Zend_Date::setOptions(array('cache' => $adapter));

    //iniciamos el front
    require_once "Zend/Controller/Front.php";
    $front = Zend_Controller_Front::getInstance();
    $front->setControllerDirectory('application/controllers');
    $front->setParam('noViewRenderer', false);
    $front->throwExceptions(false);    

    //instanciamos el smarty (ZendSmarty)
    require_once "lib/smarty/ZendSmarty.php";
    require_once "Zend/Controller/Action/Helper/ViewRenderer.php";
    $view =  ZendSmarty::getInstance(array('scriptPath' => 'application/views/'));
    $view->getEngine()->setZendView($view);
    $viewHelper = new Zend_Controller_Action_Helper_ViewRenderer($view);
    $viewHelper->setViewSuffix('tpl');
    Zend_Controller_Action_HelperBroker::addHelper($viewHelper);
   
    if((bool) $registry->config->database->params->profiler)
    {
	    require_once 'Zend/Db/Profiler/Firebug.php';
	    $profiler = new Zend_Db_Profiler_Firebug('All DB querys');
	    $profiler->setEnabled(true);
	    DBAO::Database()->setProfiler($profiler);
    }
    //Corremos el Front
    $front->dispatch();
}
catch (Exception $e)
{
    //si algo deberas no pitufó
    die('<pre>'.$e.'</pre>');
}
//
//
//
//
//echo '<!-- ', number_format(microtime(true)-$ms,3),' -->';
