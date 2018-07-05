<?php 
	require_once("HungTNCLass/MyConnection.php");
	require_once("HungTNCLass/CheckQuery.php");
	

	$check = new CheckQuery();
	$query = $_POST['sqlQuery'];

	$check->checkSelectQuery($query);
 ?>