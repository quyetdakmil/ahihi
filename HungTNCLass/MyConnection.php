<?php 

Class MyConnection{

	public function getPostgreCon(){
		$conn_string = "host=192.168.25.100 port=1521 dbname=THEATRE user=lsg password=gsl9981";
		$conn = pg_connect($conn_string);	
		//$dsn = "pgsql:host=192.168.25.100;port=1521;dbname=THEATRE;user=lsg;password=gsl9981";
		//$conn = new PDO($dsn);
		return $conn;
}}
?>