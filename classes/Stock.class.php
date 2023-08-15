<?php
/**
 * class Stock
 * responsibale for stock
 */
class Stock{
	private $amount; //int
	private $id; //int
	/** 
	 * Construct the stock that the account holds
	 * 
	 * @param int $id
	 * @param int $amount 
	 */  
	function __construct($id, $amount) {
		$this->setID($id);
		$this->setAmount($amount);
	
	}  
	/**
	 * Sets the id of the stock
	 * @param int $id
	 */
	public function setID($id) {  // a public function (default)
		$this->id = $id;
	   }
	/**
	 * Sets the amount of the stock
	 * @param int $n
	 */
	public function setAmount($n) {  // a public function (default)
		$this->amount = $n;
	}
	/**
	 * gets the amount of the stock
	 * @return int 
	 */
	public function getAmount(){
	   return $this->amount;
	}
	/**
	 * gets the id of the stock
	 * @return int
	 */  
	public function getID(){
	  return $this->id;
	}
	/**
	 * add number of the stock can also remove if negative
	 * @param int $number
	 */
	public function addAmount($number){
	 $this->amount = $this->amount + $number;
	}
}
?>

