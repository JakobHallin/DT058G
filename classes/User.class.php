<?php

class User extends Database{
   
    private $Accounts = []; // array av accounts
        
        public function __construct($userID) { //bra
      //  echo "hi";
      
	$con = parent::connect();
            
	$sql = "SELECT * FROM Accounts WHERE UserID = '" .$userID ."'";

	$stmt = $con->query($sql);
	
	while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {

     		$this->addAccount(new Account($row['AccountID'], $row['Balance']));    
    		}
        }  
    
        
      
	public function getSize(){
		return sizeof($this->Accounts);
	} 
	public function getAmountStocks($AccountIndex){
		return $this->Accounts[$AccountIndex]->getSize();
	}
	public function getAccountsStockID($AccountIndex, $stockIndex){
		return $this->Accounts[$AccountIndex]->getStockID($stockIndex);
	}
	public function getAccountsStockAmount($AccountIndex, $stockIndex){
		return $this->Accounts[$AccountIndex]->getStockAmount($stockIndex);
	}
	
	public function buyFromAccountStockAmount($AccountIndex, $StockIndex, $amount){
		
		$this->Accounts[$AccountIndex]->buyStock($StockIndex, $amount);
	
	}
	public function sellFromAccountStockAmount($AccountIndex, $StockIndex, $amount){
		echo "amount is =". $amount;
		$this->Accounts[$AccountIndex]->sellStock($StockIndex, $amount);

	}
	 
	       
           public function addAccount($Add) {  // a public function (default)

            array_push($this->Accounts, $Add);
    
           }
         
       
 	   public function getAccounts(){
            return $this->Accounts;
           }
            public function changeBalance($index, $amount){ //bra
            //echo "change";
            //echo $index;
           // echo $amount;
            $this->Accounts[$index]->addBalance($amount);
            echo "done";
            }
            public function getAccountID($index){ //bra
            //echo "change";
            //echo $index;
           // echo $amount;
            return $this->Accounts[$index]->getID();
            //echo "done";
            }
             public function getBalance($index){ //bra
           
            return $this->Accounts[$index]->getBalance();
            //echo "done";
            }
      	//kolla om stockIndex finns
  	public function stockExist($id){
  		$sql = "Select * FROM AllStocks WHERE StocksID= $id";
  		$con = parent::connect();
                $stmt = $con->query($sql);
                //$result = $stmt->execute();
  		$count = $stmt->rowCount();
	echo "amount EXIST = $count" ;
	
	if ($count == 1){
	 echo "EXIST";
	 return true;
  	}    
  	else {
  		echo "EMPTY";
  	 	return false;
  	 }
	
	//return $count;
	}  	     
          
          
}

?>
