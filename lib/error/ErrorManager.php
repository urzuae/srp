<?php
/**
 * ##$BRAND_NAME$##
 *
 * ##$DESCRIPTION$##
 *
 * @category   Project
 * @package    Lib_Error
 * @copyright  ##$COPYRIGHT$##
 * @author     ##$AUTHOR$##, $LastChangedBy$
 * @version    ##$VERSION$##, SVN:  $Id$
 */

/**
 * Clase ErrorManager 
 *
 * @category   Project
 * @package    Lib_Error
 * @copyright  ##$COPYRIGHT$##
 */
class ErrorManager 
{
  /**
   * ZendSmarty
   * @var ZendSmarty
   */
  private $view;
	
	/**
	 * Exception
	 * @var Exception
	 */
	private $exception;
	
	/**
	 * ArrayObject
	 * @var ArrayObject
	 */
	private $errorHandler;
	
	/**
	 * Class Constructor
	 * @param ZendSmarty $view
	 * @return ErrorManager
	 */
	public function ErrorManager(ZendSmarty $view)
	{
	   $this->view = $view;
	   $this->errorHandler = Zend_Controller_Front::getInstance()->getRequest()->getParam('error_handler');
	   $this->exception = $this->errorHandler->exception;
	}
  
  private function setRawHeader($header)
  {
    Zend_Controller_Front::getInstance()->getResponse()->setRawHeader($header);
  }
  
  /**
   * Despliega la página de 404 documento no encontrado
   */
  private function displayNotFound()
  {
    $this->setRawHeader('HTTP/1.1 404 Not Found');
    $this->view->setTpl('NotFound');
    $this->view->contentTitle = 'Not Found';
    $this->view->message = $this->exception->getMessage();
  }

  /**
   * Despliega la página de Forbidden
   */
  private function displayUnauthorized()
  {
    $this->setRawHeader('HTTP/1.1 401 Unauthorized');
    $this->view->setTpl('Unauthorized');
    $this->view->contentTitle = 'Unauthorized';
    $this->view->message = $this->exception->getMessage();
  }

  /**
   * Despliega la página de Error de Servidor
   */
  private function displayInternalServerError()
  {
    $request = Zend_Controller_Front::getInstance()->getRequest();
    $this->view->contentTitle = 'Internal Server Error';
    $this->setRawHeader('HTTP/1.1 500 Internal Server Error');
	  if($request->isXmlHttpRequest())
    {
      $this->view->setTpl('_error')->setLayoutFile(false);
      $this->view->message = $this->exception->getMessage();
    }else
    {
      $this->view->message = $this->exception->getMessage();
      $this->view->trace = $this->getFormatedTrace($this->exception->getTraceAsString());
      $this->view->type = get_class($this->exception);
      
      $file = $this->exception->getFile();
	    $line = $this->exception->getLine();
	    $this->view->file = $file;
	    $this->view->line = $line;
      $source = $this->getCode($file,$line);
      $this->view->source = $source;
    }
  }

  /**
   * Obtiene el codigo de un archivo
   * @param string $file
   * @param int $line
   * @param int $lines
   */
  private function getCode($file,$line,$lines = 10)
  {
    $fileContent = highlight_file($file, true);
    $fileContent = str_replace('<br />', "<br />\n", $fileContent);
    $fileContent = explode("\n", $fileContent);

    $startsOn = (($line - $lines) < 0) ? 0 : ($line - $lines);
    $endsOn = $line + $lines;

    $content = "";
    for($i = $startsOn; $i <= $endsOn; $i++)
    {
      if ($line == $i) 
        $content .= '<div style="background-color:#FFdd00;width:100%;">' . $i . ' ' . $fileContent[$i] . "</div>";
      else $content .= $i . ' ' . $fileContent[$i];
      if ($i == count($fileContent) - 1) break;
    }
    return $content;
  }

  /**
   * Obtiene el trace 
   */
  private function getFormatedTrace($trace)
  {
    return nl2br($trace);
  }

	/**
	 * Muestra el mensaje de error
	 */
  public function dispatch()
  {
	  $this->view->setTpl('Error');
    $this->view->contentTitle = 'Error';
    
    switch($this->errorHandler->type)
    {
      case Zend_Controller_Plugin_ErrorHandler::EXCEPTION_NO_CONTROLLER:
      case Zend_Controller_Plugin_ErrorHandler::EXCEPTION_NO_ACTION:
        $this->displayNotFound();
        break;
      default:
        if( $this->errorHandler->exception instanceof AuthException )
          $this->displayUnauthorized();
        else if( $this->errorHandler->exception instanceof Zend_Acl_Exception )
          $this->displayNotFound();
        else
          $this->displayInternalServerError();
        break;
    }
  }
  
}
