<?php
/*
 * class api
 * responsibility for api
 * @authur Jakob Hallin
 */
class Api{
	private $apikey = "";
	
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

