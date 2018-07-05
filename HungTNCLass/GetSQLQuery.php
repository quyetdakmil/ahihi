<?php 

Class GetSQLQuery {

	public $filter1 = '/query\.append\("(.+)\"\);/';	
	public $filter2= '/( SELECT |INSERT|UPDATE|DELETE)(.*)( INSERT | UPDATE | SELECT )/i';	
	public $sqlStr = '';
	public $sqlCheck = array('SELECT, INSERT, UPDATE, DELETE, select, insert, update, delete');
	public $sqlPattern = '/^( SELECT| INSERT| DELETE| UPDATE |INSERT|UPDATE|SELECT)/';

	public function getJavaSQLQuery($path){	
		$sqlStr = '';
		$filter1 = '/\.append\(\"(.+)\"\);/';
		$sqlPattern = '/( SELECT| INSERT| DELETE| UPDATE |INSERT|UPDATE|SELECT|DELETE)/i';	
		$sqlArray = array();
		$content = file_get_contents($path);

		//Get All SQL Query
		preg_match_all($filter1, $content, $sql);


		//Print All SQL Query can get
		// echo"<pre>";
		// 	print_r($sql);
		// echo"</pre>";

		//Compare if String contain Select, insert,...
		//if not contain combine string
		//if contain, set first string is compare string and add old string to array
		for ($i=0; $i < count($sql[1]); $i++) { 
			if(!preg_match_all($sqlPattern, $sql[1][$i])){
				$sqlStr = $sqlStr."\n".$sql[1][$i];
			}else{
				array_push($sqlArray, $sqlStr);
				$sqlStr = '';
				$sqlStr =$sqlStr."\n".$sql[1][$i];
			}
			if(count($sql[1])-1==$i){
				array_push($sqlArray, $sqlStr);
			}
		}
		return $sqlArray;
	}

	public function getVBSQLQuery($path){	
		$sqlStr = '';
		$filter1 = '/(\.append\(\"|\.AppendFormat\(\"|cmSQL = \"|cmSQL \+= \" |cmSQL =)(.+)(\"\)|\)|\")/i';
		$filter2 = '/(= \"|\+= \")(.+)(\"\)|\))/i';
		$filter3 = '/\n\'(.)+/';
		$sqlPattern = '/( \bSELECT\b| \bINSERT\b| \bDELETE\b| \bUPDATE\b |\bINSERT\b|\bUPDATE\b|\bSELECT\b|\bDELETE\b)/i';	
		$sqlArray = array();
		$sqlArray2 = array();
		$content = file_get_contents($path);

		$content = preg_replace($filter3,"", $content);
		//Get All SQL Query
		preg_match_all($filter1, $content, $sql1);
		preg_match_all($filter2, $content, $sql2);
		
		$sql = array_merge($sql1, $sql2);
		
		
		//Print All SQL Query can get
		// echo"<pre>";
		// 	print_r($sql1);
		// echo"</pre>";

		//Compare if String contain Select, insert,...
		//if not contain combine string
		//if contain, set first string is compare string and add old string to array
		for ($i=0; $i < count($sql[2]); $i++) { 
			if(!preg_match_all($sqlPattern, $sql[2][$i])){
				$sqlStr = $sqlStr."\n".$sql[2][$i];
			}else{
				$replace = $this->cutDQuotation(str_replace('""', '"', $sqlStr));
				array_push($sqlArray, $replace);
				$sqlStr = '';
				$sqlStr =$sqlStr."\n".$sql[2][$i];						
			}

			//Nếu là phần tử cuối, thì add vào mảng luôn
			if($i == (count($sql[2])-1) ){				
				$replace = $this->cutDQuotation(str_replace('""', '"', $sqlStr));
				array_push($sqlArray, $replace);
				$sqlStr = '';
			}		
		}
		
		//Lọc lần thứ 2, xác định nếu cuối mỗi phần tử trong mảng (tương ứng 1 câu sql) là dấu '('
		//hoặc đầu phần tử tiếp theo là dấu '(' 
		//nếu đúng, ghép 2 phần tử lại, tạo thành 1 phần tử mới
		//nếu không đúng, giữ nguyên phần tử
		for ($i=0; $i < count($sqlArray) ; $i++) { 
			if(
				(isset($sqlArray[$i]) && $this->getEndWord($sqlArray[$i]) =='(' )
				|| 
				(isset($sqlArray[$i+1]) && $this->getStartWord($sqlArray[$i+1]) =='(')
			){

				$sqlArray[$i+1] = $sqlArray[$i].$sqlArray[$i+1];
				array_push($sqlArray2, $sqlStr);
				$sqlStr = '';
			}else{
				if(!empty($sqlArray[$i])){
					array_push($sqlArray2, $sqlArray[$i]);	
			
			}
		}}
		return $sqlArray2;
	}


	//If the last word of string is "(Double Quotation), then cut this
	public function cutDQuotation($string){
		if(substr($string, strlen($string)-1) == '"'){
			$replace = str_replace('"', '', $string);
			return $replace;
		}
		return $string;
	}

	//Lấy kí tự đầu trong chuỗi
	public function getEndWord($string){
		$line = trim($this->cutDQuotation(str_replace('""', '"', $string)));
		return substr($line, strlen($line)-1);
	}

	//Lấy kí tự cuối trong chuỗi
	public function getStartWord($string){
		$line = trim($this->cutDQuotation(str_replace('""', '"', $string)));
		return substr($line, 0,1);
	}

	public function pr($arr){
		echo "<pre>";
 		print_r($arr);
		echo "</pre>";
	}
}

 ?>