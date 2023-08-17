<?php
/**
 * class Db
 * responsibility for database connection
 * @author Jakob Hallin
 */
class Db{

	
	private $user = "hallin_techwebprojekt";
	private $host = "hallin.tech.mysql";
	private $pass = "DatabasTest";
	private $db = "hallin_techwebprojekt";
	//private $con;
	//private $apikey= "87dc9fae84c01694a27ab719891dce48";
	
	/**
	 * connects to database returns connection
	 * @return PDO
	 */
	public function connect() {
		$con =  new PDO("mysql:host=".$this->host.";dbname=".$this->db, $this->user, $this->pass);
		$con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);	
		
		 return $con;
	
	}
	
}
	
?>
