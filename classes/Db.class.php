<?php
/*
 * resposnibale for sql execution
 */
class Db{

	
	private $user = "root";
	private $host = "localhost";
	private $pass = "";
	private $db = "SlutProjekt";
	//private $con;
	//private $apikey= "87dc9fae84c01694a27ab719891dce48";
	
	
	public function connect() {
		$con =  new PDO("mysql:host=".$this->host.";dbname=".$this->db, $this->user, $this->pass);
		$con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);	
		
		 return $con;
	
	}
}
	
?>
