<?php

class User extends Database{
   
    private $Accounts = []; // array av accounts
        
        public function __construct($userID) { //bra
      
      
            
	$sql = "SELECT * FROM Accounts WHERE UserID = '" .$userID ."'";

	$stmt = parent::execute($sql);
	
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
		
		$this->Accounts[$AccountIndex]->sellStock($StockIndex, $amount);

	}
	 
	       
           public function addAccount($Add) {  // a public function (default)

            array_push($this->Accounts, $Add);
    
           }
         
       
 	   public function getAccounts(){
            return $this->Accounts;
           }
            public function changeBalance($index, $amount){ //bra
           
            $this->Accounts[$index]->addBalance($amount);
            
            }
            public function getAccountID($index){ //bra
           
            return $this->Accounts[$index]->getID();
           
            }
             public function getBalance($index){ //bra
           
            return $this->Accounts[$index]->getBalance();
           
            }
      	//kolla om stockIndex finns
  	public function stockExist($id){
  		$sql = "Select * FROM AllStocks WHERE StocksID= $id";
  		
                $stmt = parent::execute($sql);
                
  		$count = $stmt->rowCount();

	if ($count == 1){

	 return true;
  	}    
  	else {
 
  	 	return false;
  	 }
	
	//return $count;
	}  	     
          
          
}

?>
