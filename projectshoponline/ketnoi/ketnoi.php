<?php
	$dbHost='localhost';
	$dbUser='root';
	$dbPass='';
	$dbName='vietproshop';
	
	$dbConnect= mysqli_connect($dbHost,$dbUser,$dbPass,$dbName);
	mysqli_query($dbConnect,"SET NAMES 'utf8'");
?>