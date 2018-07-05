<?php
	header('Content-Type: text/html; charset=utf-8');
	require_once("HungTNCLass/LoadFile.php");
	require_once("HungTNCLass/GetSQLQuery.php");
	$path = 'E:\SQLMain_B421V10';
	
	$loadfile = new LoadFile();
	$getQuery = new GetSQLQuery();
	$query = array();
	$fileArr = array();
	$arr = array();

	$fileArr = $loadfile->scan_file($path);
	$fileName = $loadfile->getAllVBFileName($fileArr);

	echo("<pre>");
		print_r($fileName);
	echo("</pre>");	

	for ($i=0; $i < count($fileArr); $i++) { 
		echo("<pre>");
			//Tạo thư mục
			 mkdir('E:\SQL\\'.$fileName[$i], 0777, true);
			 print_r("FILESAVE: ".'E:\SQL\\'.$fileName[$i]."<br/>");

			 print_r($query = $getQuery->getVBSQLQuery($fileArr[$i]));

			 //Ghi ra File
			 for ($j=0; $j <count($query); $j++) { 
			 	$myfile = fopen('E:\SQL\\'.$fileName[$i].'\\'.$j.".sql", "x+");
			 	if(is_resource($myfile)){
			 		fwrite($myfile, $query[$j]);
			 		fclose($myfile);
			 	}
			 	}
		echo("</pre>");
	 }
?>