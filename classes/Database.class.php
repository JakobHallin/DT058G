<?php

class Database{

	private $user = "root";
	private $host = "localhost";
	private $pass = "";
	private $db = "SlutProjekt";
	//private $connection;
	public function connect(){
		
		
		$con =  new PDO("mysql:host=".$this->host.";dbname=".$this->db, $this->user, $this->pass);
		$con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);	
		
		return $con;
	
	}
	//update
	public function prepareSqlExecte($sql){
		$connect = $this->connect();
		$stmt = $connect->prepare($sql);
		$stmt ->execute();
		}
	public function executeReturn($sql){
			$connect = $this->connect();
			$stmt = $connect->prepare($sql);
			$stmt ->execute();
			return $stmt;
			}	
		
	public function insertSql($sql, $arg1, $arg2, $arg3){
		$con = $this->connect();
                $stmt = $con->prepare($sql);
                $stmt->execute([$arg1, $arg2, $arg3]);
		
	}
	public function fetchPrice($shortName){
		$data = file_get_contents('https://query2.finance.yahoo.com/v10/finance/quoteSummary/'.$shortName.'?modules=financialData');//string
	
		$data= strstr($data,"targetHighPrice", true);
		$data= strstr($data,"fmt");
		$data = strstr($data,":");
		$data = strstr($data,'"');
		$data = strstr($data,"}", true);
		$data = str_replace('"',"",$data);
	
		return floatval($data);
		}	
}

?>
