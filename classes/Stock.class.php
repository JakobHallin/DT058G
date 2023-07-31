<?php

class Stock{
//måste see till amount är int
private $amount; //varierar beronde på vilket konto
//kanske bara behöver en ID eller name
private $id;  //alla av samma aktie ska ha samma namn 
//private $aktieID; //alla av samma aktie ska ha denna
	function __construct($id, $amount) {
		$this->setID($id);
		$this->setAmount($amount);
	
	}  
	public function setID($id) {  // a public function (default)
		$this->id = $id;
	   }
	   public function setAmount($n) {  // a public function (default)
		$this->amount = $n;
	   }
	 
	   public function getAmount(){
	   return $this->amount;
	   }
	  
	  public function getID(){
//	  echo "getID";
	  return $this->id;
	  }

	public function addAmount($number){
	 //echo "add amount";
	 $this->amount = $this->amount + $number;
	}
	
}
/*$a1 = new Stock("apple", 3);
echo "hi";
$a1->addAmount(3);
echo $a1->getAmount();
echo "hi";
*/
?>
