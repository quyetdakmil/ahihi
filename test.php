<?php 
	header('Content-Type: text/html; charset=utf-8');
	require_once("HungTNCLass/LoadFile.php");
	require_once("HungTNCLass/GetSQLQuery.php");
	$path = 'D:\\SQLMain_B421V10\\GeApp\\Admin';

	$loadfile = new LoadFile();
	$getQuery = new GetSQLQuery();

	//Lấy tất cả file dựa theo path
	$fileArr = $loadfile->getAllVBFileInFolder($path);


	for ($i=0; $i <count($fileArr) ; $i++) { 
		$arr_path = explode('\\', $fileArr[$i]);
		$file_name = $arr_path[count($arr_path)-1];
		//Lấy query dựa theo regex
		$query = $getQuery->getVBSQLQuery($fileArr[$i]);
		file_put_contents('result/'.$file_name.'.txt', implode($query, "\n"));
	}///
	echo "Done";	
	// $test_str = file_get_contents('test.txt');
	// $regex = '/\n\'(.)+/';
	// $result_str = preg_replace($regex,"",$test_str);

	// pr($test_str);
	// echo "<br/><br/>===========<br/><br/>";
	// pr($result_str);

	// function pr($arr){
	// 	echo "<pre>";
 // 		print_r($arr);
	// 	echo "</pre>";
	// }

 ?>