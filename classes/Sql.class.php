<?php
/*
 * resposnibale for sql quarys
 */
class Sql{


	
	public function execute($sql){
			//$con = $this->con;
			$db = new Db;
			$con = $db->connect();
			$stmt = $con->prepare($sql);
			$stmt ->execute();
			return $stmt;
			}	
		
	public function insert($sql, $arg1, $arg2, $arg3){
		$db = new Db;
		$con = $db->connect();
                $stmt = $con->prepare($sql);
                $stmt->execute([$arg1, $arg2, $arg3]);
		
	}
}
?>

