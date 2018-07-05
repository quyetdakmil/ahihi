<?php 

Class SQLObject{

	public $loc;
	public $sql;

	public function __construct($loc, $sql){
		$this->$loc = $loc;
		$this->$sql = $sql;
	}
}



 ?>