<?php 
require_once("HungTNCLass/MyConnection.php");

Class CheckQuery{

	public function checkSelectQuery($query){
		try {
			$myConnection = new MyConnection();
			$con = $myConnection->getPostgreCon();
			//$result = $con->exec('SET search_path TO lsg, public');
			//$result = $con->query($query);
			$stat = pg_connection_status($con);
			//pg_query($con, 'SET search_path to lsg');
			$setSPath = pg_query($con,  'SHOW search_path');
			$search_path = pg_fetch_array($setSPath);
			var_dump($search_path);
			echo $query."\n";
			pg_query($con, $query);

			// echo $result;
			// if (!$result) {
			//   echo "An error occurred.\n";
			//   exit;
			// }else{
			// 	echo "Query Success!";
			// }
		} catch (Exception $e) {
			echo "Error : " . $e->getMessage() . "<br/>";
			die();
		}finally{
			pg_close($con);
		}
	}

}



 ?>