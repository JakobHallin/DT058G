<?php
/*
 * class api
 * responsibility for api
 * @authur Jakob Hallin
 */
class Api{
	private $apikey = "87dc9fae84c01694a27ab719891dce48";
	
	/**
	 * get the value of the stock and returns it
	 * @paragram string $shorname
	 * $return float
	 */
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

