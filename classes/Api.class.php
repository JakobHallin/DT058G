<?php
/*
 * resposnibale for sql execution
 */
class Api{
	private $apikey = "87dc9fae84c01694a27ab719891dce48";
	//private $price;
	
	public function getPrice($shortName){
		/*financialmodelingprep */
		 $data =file_get_contents("https://financialmodelingprep.com/api/v3/quote-short/$shortName?apikey=$this->apikey");
		 
		
			$array = json_decode($data);
	
			$obj = $array[0];
		
			$price = $obj->price;
	
			return $price;
	
	}
	

	
	
}
?>

