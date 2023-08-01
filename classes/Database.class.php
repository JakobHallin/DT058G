<?php

class Database{

	private $user = "root";
	private $host = "localhost";
	private $pass = "";
	private $db = "SlutProjekt";
	
	private $apikey= "87dc9fae84c01694a27ab719891dce48";
	
	public function connect() {
		$con =  new PDO("mysql:host=".$this->host.";dbname=".$this->db, $this->user, $this->pass);
		$con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);	
		
		 return $con;
	
	}
	//update
	
	public function execute($sql){
			$con = $this->connect();
			$stmt = $con->prepare($sql);
			$stmt ->execute();
			return $stmt;
			}	
		
	public function insert($sql, $arg1, $arg2, $arg3){
		$con = $this->connect();
                $stmt = $con->prepare($sql);
                $stmt->execute([$arg1, $arg2, $arg3]);
		
	}
	public function fetchPrice($shortName){
		/*financialmodelingprep */
		 $data =file_get_contents("https://financialmodelingprep.com/api/v3/quote-short/$shortName?apikey=$this->apikey");
		 
		
			$array = json_decode($data);
	
			$obj = $array[0];
		
			$price = $obj->price;
	
		return $obj->price;
		/* quary2 finance yahoo *Stoped working around 11 jul
		 
		$data = file_get_contents('https://query2.finance.yahoo.com/v10/finance/quoteSummary/'.$shortName.'?modules=financialData');//string
	
		$data= strstr($data,"targetHighPrice", true);
		$data= strstr($data,"fmt");
		$data = strstr($data,":");
		$data = strstr($data,'"');
		$data = strstr($data,"}", true);
		$data = str_replace('"',"",$data);
	
		return floatval($data);
		*/
		}	
}

?>
