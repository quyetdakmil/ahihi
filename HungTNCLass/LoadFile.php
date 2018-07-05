<?php 

Class LoadFile {
	public $arr = array();

	public function getAllJavaFileInFolder($path){
		//LIST FILE IN FOLDER
		$file = scandir($path);
		$allow = "/^(.java)$/";
		$fileArr = array();
		$j = 0;
		for ($i=0; $i < count($file); $i++) {
				 $ext = substr($file[$i], (strlen($file[$i])-5));
				if(preg_match($allow, $ext))
				{
					$newpath = $path."\\".$file[$i];
					array_push($fileArr, $newpath);
				}
		}
		return($fileArr);
	}

	public function getAllVBFileName($array = array()){
		$fileArr = array();
		for ($i=0; $i < count($array); $i++) {
				$newpath = substr($array[$i], 3);
				array_push($fileArr, $newpath);
		}
		return $fileArr;
	}

	public function getAllVBFileInFolder($path){
		$file = scandir($path);
		$allow = "/^\.vb$/";
		$fileArr = array();

		//Duyệt từng file trong folder
		for ($i=0; $i < count($file); $i++) {

				//Lấy 3 kí tự cuối (đuôi file)
				 $ext = substr($file[$i], (strlen($file[$i])-3));

				 //Nếu 3 kí tự cuối là .vb
				if(preg_match_all($allow, $ext))
				{	
					//Gắn đường dẫn + tên file
					$newpath = $path."\\".$file[$i];
					//Lưu vào mảng
					array_push($fileArr, $newpath);
				}
		}
		return($fileArr);
	}

	public function scan_file($path){
		$scan = scandir($path);
		for ($i=0; $i < count($scan); $i++) { 

			if($this->is_file($path."\\".$scan[$i])){
				array_push($GLOBALS['arr'], $path."\\".$scan[$i]);

			}elseif($this->is_folder($path."\\".$scan[$i])){
				$this->scan_file($path."\\".$scan[$i]);
			}
		}
		return $GLOBALS['arr'];
	}

	public function is_folder($path){
		if(strstr($path, ".")){
			return false;
		}
		return true;
	}

	public function is_file($path){
		$allow = "/^(.vb)$/";
		$ext = substr($path, (strlen($path)-3));
		if(preg_match($allow, $ext))
			{
				return true;
			}
		return false;	
	}
}

 ?>