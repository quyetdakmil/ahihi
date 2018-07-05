<?php 

Class FolderObject{

	public $folderName;
	public $fileInFolder;
	public $folderInFolder;

	public function __construct($name,$file,$folder){
		$this->folderName = $name;
		$this->fileInFolder = $file;
		$this->folderInFolder = $folder;
	}

	public function __construct($name,$file){
		$this->name = $name;
		$this->fileInFolder = $file;
	}

}



 ?>