<?php

/**
 * class User
 * responsibility for accounts
 * @author Jakob Hallin
 */
class User{
   
    private $Accounts = []; // array av accounts
        
        public function __construct($userID) { //bra
      
      
            
	$sql = "SELECT * FROM Accounts WHERE UserID = '" .$userID ."'";
	$classSql = new Sql;
	$stmt = $classSql->execute($sql);
	//$stmt = parent::execute($sql);
	
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
	public function getAccountID($index){ //bra
           
            return $this->Accounts[$index]->getID();
           
    }
    public function getBalance($index){ //bra
           
            return $this->Accounts[$index]->getBalance();
           
    }
	
	/** 
	 * buys from account with index $AccountIndex with stockid $StockID and amount 
	 * @param int $AccountIndex
	 * @param int $StockID
	 * @param int $amount
	 */
	public function buyFromAccountStockAmount($AccountIndex, $StockID, $amount){ //bör vara stock ID
		
		$this->Accounts[$AccountIndex]->buyStock($StockId, $amount);
	
	}
	/** 
	 * sell from account with index $AccountIndex with stockid $StockID and amount 
	 * @param int $AccountIndex
	 * @param int $StockID
	 * @param int $amount
	 */
	public function sellFromAccountStockAmount($AccountIndex, $StockID, $amount){
		
		$this->Accounts[$AccountIndex]->sellStock($StockID, $amount);

	}
	 
	/**
	 * add account to this user
	 * $paragram Account
	 */
    public function addAccount($Add) {  // a public function (default)

        array_push($this->Accounts, $Add);
    
    }
         
       
 	public function getAccounts(){
        return $this->Accounts;
    }
    /**
     * change balance of account
     * @param int $index
     * @param int $amount
     */
    public function changeBalance($index, $amount){ //rename to setbalance
           
        $this->Accounts[$index]->addBalance($amount);
            
    }
      
  	/*
  	 *the user want to see if the stock exist
  	 */    	
  	public function stockExist($id){
  		$sql = "Select * FROM AllStocks WHERE StocksID= $id";
  		$classSql = new Sql;
		$stmt = $classSql->execute($sql);
                //$stmt = parent::execute($sql);
                
  		$count = $stmt->rowCount();

	if ($count == 1){

	 return true;
  	}    
  	else {
 
  	 	return false;
  	 }
	
	}  	     
          
          
}

?>
