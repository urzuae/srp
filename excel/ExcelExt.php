<?php
require_once 'excel/xlsStream.php';
class ExcelExt extends xlsStream 
{
	function createExcel($filename, $arraydata) {
		$excelfile = "xlsfile:/".getcwd().'/data/update/'.$filename;
		$fp = fopen($excelfile, "wb");  
		if (!is_resource($fp)) {  
			die("Error al crear $excelfile");  
		}  
		fwrite($fp, serialize($arraydata)); 		
		fclose($fp);
		header ("Expires: Mon, 26 Jul 1997 05:00:00 GMT");  
		header ("Last-Modified: " . gmdate("D,d M YH:i:s") . " GMT");  
		header ("Cache-Control: no-cache, must-revalidate");  
		header ("Pragma: no-cache");  
		header ("Content-type: application/x-msexcel");  
		header ("Content-Disposition: attachment; filename=\"" . $filename . "\"" );
		readfile($excelfile);  
	}
}
?>