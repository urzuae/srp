<?php
/**
 * ##$BRAND_NAME$##
 *
 * ##$DESCRIPTION$##
 *
 * @category   Project
 * @package    Project_Views
 * @subpackage Project_Views_Smarty
 * @copyright  ##$COPYRIGHT$##
 * @author     ##$AUTHOR$##, $LastChangedBy$
 * @version    ##$VERSION$##, SVN:  $Id$
 */

require_once 'Smarty3/Smarty.class.php';
require_once 'lib/smarty/ProjectSmartyCompiler.php';

/**
 * Clase que te permite configurar la clase Smarty y agrega metodos comunmente utilizados en la aplicacion
 *
 * @category   project
 * @package    Project_Views
 * @subpackage Project_Views_Smarty
 * @copyright  ##$COPYRIGHT$##
 */
class ProjectSmarty extends Smarty
{

    /**
     * @var Zend_View_Abstract
     */
    private $zendView;


    /**
     * Constructor de la clase ProjectSmarty
     * @param string $templateDir Directorio donde se encuentran los templates
     * @param string $compileDir Directorio donde se compilan los archivos
     * @param string $configDir Directorio donde se encuentra la configuracion (opcional)
     * @param string $cacheDir Directorio donde se encuentra la carpeta de cache (opcional)
     * @param bool $cachingEnabled Propiedad default false que te da la opcion de tener cache en el sistema.
     */
    function ProjectSmarty($templateDir, $compileDir, $configDir = "", $cacheDir = "", $cachingEnabled = false)
    {
        parent::__construct();
        $this->template_dir = $templateDir;
        $this->config_dir = $configDir;
        $this->cache_dir = $cacheDir;
        $this->compile_dir = $compileDir;
        $this->caching = $cachingEnabled;
        $this->plugins_dir[] = 'lib/smarty/plugins';
        $this->compiler_class = 'ProjectSmartyCompiler';
    }

    /**
     * Propiedad que te despliega un template en un mastertemplate dentro de la propiedad {$contentPlaceHolder}
     * @param string $templateName Nombre del template a desplegar
     * @param string $masterTemplateName Nombre de la master page utilizada
     */
    function displayInMasterPage($templateName, $masterTemplateName)
    {
        $contentPlaceHolder = $this->fetch($templateName, true);
        $this->assign('contentPlaceHolder', $contentPlaceHolder);
        $this->display($masterTemplateName);
    }

    /**
     * Metodo que despliega en el layout los asuntos principales
     *
     * @param string $master el template principal
     * @param string $content el template para el contenido
     * @param string $headers el template para el menu
     * @param string $footer el template para el pie de pagina
     */
    function displayLayOut($master, $content, $headers, $footers = null)
    {
        $contentPlaceHolder = $this->fetch($content, true);
        $this->assign('contentPlaceHolder', $contentPlaceHolder);
        $headersPlaceHolder = $this->fetch($headers, true);
        $this->assign('headersPlaceHolder', $headersPlaceHolder);
        $footersPlaceHolder = $this->fetch($footers, true);
        $this->assign('footersPlaceHolder', $footersPlaceHolder);
        $this->display($master);
    }

    /**
     * @param Zend_View_Abstract $view
     */
    public function setZendView(Zend_View_Abstract $view)
    {
        $this->zendView = $view;
    }
    
    /**
     * @param string $name 
     * @param mixed $args
     * @return mixed The helper return
     */
    public function callViewHelper($name,$args)
    {
        $helper = $this->zendView->getHelper($name);
        return call_user_func_array(array($helper,$name),$args);
    }  
}


