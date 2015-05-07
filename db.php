<?php

class DB_Settings_API {

private static $instance = null;
public $conn = null;

public static function instance() {
		if (is_null(self::$instance)) {
			self::$instance = new DB_Settings_API();
		}
		return self::$instance;
	}
	
private function __construct() {
	$this->conn = mysqli_connect('localhost','root','','test') or die('Unable to connect '.mysqli_connect_error());
}
	
public function connect(){

	return $this->conn;
}	

}
?>
