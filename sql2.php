<?php 
	$line = $_POST['input'];
	$varValue = $_POST['varValue'];
	$filter = '/"(.+)"/';
	$filter1 = '/(\.append\(\"|\."|AppendFormat\(\cmSQL = \"|cmSQL \+= \" | SQL &= \"| SQL = )(.+)/i';
	//$filter2 = '/(= \"|\+= \")(.+)(\"\)|\))/i';
	$content = "";
	$filter3 = '/\n\'(.)+/';
	$filter4 = '/&(.+)&/';
	$strArr = explode("\n", $line);
	$str = "";

	//Lọc Comment
	for ($i=0; $i < count($strArr); $i++) { 
		if(getFirstChar(trim($strArr[$i])) != "'")
		{
			$content .= $strArr[$i]."\n";
		}
	}
	//echo "$content";
	//$content = preg_replace($filter3,"", $line);
	preg_match_all($filter, $content, $sql1);
	//preg_match_all($filter2, $content, $sql2);
	
	$sql = $sql1;//array_merge($sql1, $sql2);

	//pr($sql);

	//Bỏ ", ) 
	for ($i=0; $i < count($sql[1]); $i++) { 
		$rp = $sql[1][$i];
		$e = getEndChar(trim($rp));
		$len = strlen(trim($rp));
		if( $e == ")" && $len>1 ){ 
			$rp = substr($rp, 0, strlen($rp)-1);
		}
		$rp = str_replace("\"", "", $sql[1][$i]);
		$rp = preg_replace($filter4, $varValue, $rp);
		$rp = str_replace('{0}', $varValue, $rp);
		$str .= $rp."\n";
	}

	//If the last word of string is "(Double Quotation), then cut this
	function cutDQuotation($string){
		if(substr($string, strlen($string)-1) == '"'){
			$replace = str_replace('"', '', $string);
			return $replace;
		}
		return $string;
	}

	function getEndChar($string){
		return $line = substr($string, -1);
	}

	function getFirstChar($string){
		return $line = substr($string, 0, 1);
	}

	function pr($string){
		echo "<pre>";
		print_r($string);
		echo "</pre>";
	}

 ?>

 <html>
	<head>
		<title>Index</title>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<!-- Latest compiled and minified CSS -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
		<!-- jQuery library -->
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
		<!-- Latest compiled JavaScript -->
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
		<style type="text/css" media="screen">
			textarea {
			resize: none;
			}
		</style>
	</head>
	<body>
		<div style="padding-top: 80px;" class="container">
			<form class="form-group" action="sql2.php" method="Post">
				<div class="row">
					<div class="col-md-4">
						<textarea rows="7" class="form-control" name="input" style="width: 400px; height: 400px;"><?php echo $line; ?></textarea>
					</div>
					<div class="col-md-2">
						<input class="form-control" value="submit" type="submit">
					</div>
					<div class="col-md-6">
						<textarea rows="7" class="form-control" name="output" style="width: 400px; height: 400px;"><?php echo $str ?></textarea>
					</div>
					<div style="padding-top: 80px" class="col-md-offset-4 col-md-4">
						<input type="text" name="varValue" value="1">
					</div>
				</div>
			</form>
		</div>
		<!-- <form action="readFile.php" method="post" accept-charset="utf-8">
			<input type="file" name="file">
			<input type="submit" name="" value="Upload">
		</form> -->

		<!-- <form action="ConnectPostgre.php" method="POST">
			SQL: <textarea name="sqlQuery" style="width: 800px; height: 500px;"></textarea>
			<input type="Submit" name="" value="Check">
		</form> -->
	</body>
</html>