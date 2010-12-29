<?php
/**
 * ##$BRAND_NAME$##
 *
 * ##$DESCRIPTION$##
 *
 * @category   Project
 * @package    Lib_Managers
 * @copyright  ##$COPYRIGHT$##
 * @author     ##$AUTHOR$##, $LastChangedBy$
 * @version    ##$VERSION$##, SVN:  $Id$
 */

/**
 * ImageResizer
 */
require_once 'lib/file/ImageResizer.php';

/**
 * FileException
 */
require_once 'lib/file/FileException.php';

/**
 * Clase para Guardar los archivos que se envien desde un formulario
 *
 */
class FileUploader
{

    /**
     *
     * @var string $name
     */
    private $name;

    /**
     *
     * @var string $fileName
     */
    private $fileName = '';

    /**
     * @var string $path
     */
    private $path;

    /**
     * Dimensiiones del thumbnail que se generará [W,H]
     * @var mixed
     */
    private $dimensions = array();

    /**
     * Constructor de la clase
     * 
     * @param string $formName El nombre de la variable enviada al formulario
     */
    function __construct($formName)
    {
        $this->name = $formName;
    }

    /**
     * Indica si un archivo ha sido enviado al servidor
     * @param string $fileName El nombre de la variable post donde fue enviado el archivo
     * @return Boolean
     */
    public function isUpload()
    {
        if(!isset($_FILES[$this->name]) || !is_uploaded_file($_FILES[$this->name]['tmp_name']))
        {
            return false;
        }
        else
            return true;
    }

    /**
     * Guarda el archivo
     * @param string $path El directorio donde deseamos que se guarde nuestro archivo
     * @param string $resize Hace una copia miniatura del archivo si es una imagen y deja el original con un sufijo ' _o '
     * @return boolean
     * @throws Exception
     */
    public function saveFile($path, $resize = true)
    {
        if(!is_dir($path . $this->path))
        {
            if(!@mkdir($path . $this->path, 0777, true))
                throw new FileException('No se pudo crear el directorio destino, Compruebe que tiene los permisos suficientes en ' . $path .'');
        }
        $name = md5($path . time()) . ($resize ? '_o' : '');
        $this->fileName = $name . '.' . $this->getFileExtension();
        $file = $path . $this->path . '/' . $this->fileName;
        if(!move_uploaded_file($_FILES[$this->name]['tmp_name'], $file))
            throw new FileException('El archivo no se pudo mover a su destino');
        chmod($file, 0777);
        if($resize)
        {
            $imageResize = new ImageResizer($file, str_replace('_o', '', $file), 374, 282);
            $imageResize->getResizedImage();
            $this->fileName = str_replace('_o', '', $this->fileName);
            
            $imageResize = new ImageResizer($file, str_replace('_o', '_mini', $file), 120, 120);
            $imageResize->getResizedImage();
            $this->fileName = str_replace('_o', '', $this->fileName);
        }
        return true;
    }

    /**
     * Obtiene el URI de la imagen para ser almacenado en la base de datos
     *
     * @return string
     */
    public function getFileName()
    {
        return ($this->fileName == '') ? '' : $this->path . '/' . $this->fileName;
    }

    /**
     * Obtiene la extensión del archivo seleccionado
     *
     * @param string $filepath
     * @return string
     */
    private function getFileExtension()
    {
        $info = pathinfo($_FILES[$this->name]['name']);
        return strtolower($info["extension"]);
    }

    /**
     * @param string $path
     */
    public function setPath($path)
    {
        $this->path = $path;
    }

    /**
     * @return mixed
     */
    public function getDimensions()
    {
        return $this->dimensions;
    }

    /**
     * @param mixed $dimensions
     */
    public function setDimensions($dimensions)
    {
        $this->dimensions = $dimensions;
    }

}
