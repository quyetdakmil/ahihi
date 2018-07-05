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
		echo $rp."<br/>";
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