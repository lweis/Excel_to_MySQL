<?php

function convertExcel($excelFile){
	$excel_readers = array(
		'Excel5' , 
		'Excel2003XML' , 
		'Excel2007'
	);
	require_once('PHPExcel/Classes/PHPExcel.php');

	$type = explode('.', $_FILES['filename']['name']);
	$fileType = $type[1];
	if($fileType=='application/vnd.ms-office'){
		$type = 'Excel5';
	}elseif($fileType == 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'){
		$type = 'Excel2007';
	}else{		
		die("Unsupported filetype ($fileType) only use XLS oder XLSX");
	}
	 
	$reader = PHPExcel_IOFactory::createReader($type);
	$reader->setReadDataOnly(true);
	 
	$path = $excelFile;
	$excel = $reader->load($path);
	 
	$writer = PHPExcel_IOFactory::createWriter($excel, 'CSV');
	$newFilename = hash_file('sha512', $excelFile);
	$writer->save("outputfile/$newFilename.csv");	
	return $newFilename;
}
?>