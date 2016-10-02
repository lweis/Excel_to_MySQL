<?php
	include_once('config.php');
	mysql_connect($mysql_server, $mysql_user, $mysql_pw); 
	function read_File($fileName){

		$file_name = fopen ($fileName, "r"); 
		$sum = count($file_name);
		$counter = 0;
		while ($line = fgets ($file_name, 4096 )){
			if($counter == 0){
				 $head = explode(';', $line);
				return $head;
			}
			$counter++;
		}
		 
		fclose($file_name);		
	}
	
	function createTable($table_name, $db_name){
		$headLine = read_File($table_name);
		$headCount = count($headLine);
		$TABLE = '';
		for($i=0;$i<=$headCount-1;$i++){
			if($i==$headCount-1){
				$TABLE .= $headLine[$i]." TEXT CHARACTER SET utf8 COLLATE utf8_general_ci\n";
			}else{
				$TABLE .= $headLine[$i]." TEXT CHARACTER SET utf8 COLLATE utf8_general_ci,\n";
			}			
		}
		
		mysql_select_db($db_name) or die("MySQL Fehler");
		$TABLE_NAME = str_replace('.csv', '', $table_name);
		$CREATE = "CREATE TABLE $TABLE_NAME (
						id_$TABLE_NAME INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
						$TABLE
					)";
		echo $CREATE;
		mysql_query($CREATE);
		
	}

	#createTable('temper.csv', 'FUBAR');

?>