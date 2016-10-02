<?php
	include_once('config.php');
	mysql_connect($mysql_server, $mysql_user, $mysql_pw);   

	function createDatabase($db_name){
		$sql_create = "CREATE DATABASE $db_name";
		mysql_query($sql_create);
	}
	
	//TEST for a create database
	#createDatabase('FUBAR');

?>