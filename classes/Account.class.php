<?php
/**
 * class account
 * responsibility for account buying selling stocks
 * @authur Jakob Hallin
 */
class Account  {
  
   	private $con; //connection to database
   	private $id; //int
    private $balance;  //float
    private $holding = []; // array
	/** 
	 * constructor
	 */
    function __construct($id, $balance) {
	    $this->id = $id;          
        $this->balance= $balance;
	    //get all the stocks from the database that are related to this account 
	    $sql = "SELECT * FROM Stock WHERE AccountID= '" .$id ."'";
	    $classSql = new Sql;
	    $stmt = $classSql->execute($sql);
	 		 
	    while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
	      $this->addStock( new Stock($row['StocksID'],  $row["Amount"]));  
        }
    }  
	
    public function getSize(){
		return sizeof($this->holding);
	} 
    public function getStockID($index){
      		return $this->holding[$index]->getID();
    }
    public function getStockAmount($index){
      	return $this->holding[$index]->getAmount();
    }
    public function setBalance($n) {  
       	$this->balance = $n;
    }
       
    public function getID(){
       	return $this->id;
    }
    public function getBalance(){
       return $this->balance;
    }
    public function getHolding(){
     	return $this->holding;
    }
    public function addStock($stock) {  
        array_push($this->holding, $stock);
    }
    /*
	 * add balance to the account
	 * @param float $totalprice
	 */
    public function addBalance($totalprice){ 
     	$this->balance = $this->balance + $totalprice;
     	$accountID = $this->getID();
		//making sure to let the database do de logic of the addion with sql
     	$sql = "UPDATE Accounts SET Balance = (SELECT Balance FROM Accounts WHERE AccountID = $accountID) + $totalprice WHERE AccountID = $accountID"; 
          
      	$classSql = new Sql;
	 	$stmt = $classSql->execute($sql);
    }
          
	/**
	 * remove balance to the account
	 * @param float $totalprice
	 */
    public function removeFromBalance($totalprice){
        $this->balance = $this->balance - $totalprice;
        $accountID = $this->getID();
        //making sure to let the database do de logic of the reduction with sql
        $sql = "UPDATE Accounts SET Balance = (SELECT Balance FROM Accounts WHERE AccountID = $accountID) - $totalprice WHERE AccountID = $accountID"; 
        $classSql = new Sql;
	 	$stmt = $classSql->execute($sql);

    }
	/**
	 * update the sockholding //mabye change name to change
	 * @param int $stockID		
	 * @param int $stockAmount
	 */
    public function updateStockHolding($stockID , $stockAmount){ //deta kanske borde
        $accountID = $this->getID();
		
        $sql = "UPDATE Stock SET Amount = $stockAmount WHERE StocksID = $stockID AND AccountID = $accountID "; 
        $classSql = new Sql;
	 	$stmt = $classSql->execute($sql);
    }
		/**
		 * insert new stock to account
		 * @param int $stockID
		 * @param int $amount
		 */
        public function insertNewStock($StockId, $amount){
            	$sql = "INSERT INTO `Stock`(`StocksID`, `AccountID`, `Amount`) VALUES (?,?,?)";
            	$id = $this->getID();
            
            	$classSql = new Sql;
	 	$stmt = $classSql->insert($sql, $StockId, $id, $amount);
        }            
           public function changeHolding($index, $amount){ //amount can be negativ
           
           	$this->holding[$index]->addAmount($amount); //can add and remove
               	$stockAmount = $this->holding[$index]->getAmount(); 
               	$stockID = $this->holding[$index]->getID();
              
              	$this->updateStockHolding($stockID, $stockAmount);
              
           }
           public function getPrice($StockID){ //tar id kollar får shortname
          
          //fetcha stockförkortning
          	$shortName ='';
          	
		$sql = "SELECT * FROM AllStocks WHERE StocksID= '" .$StockID ."'";
		
		$classSql = new Sql;
		$stmt = $classSql->execute($sql);
	
		while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
			$shortName= $row['Short'];
			
	 	}

		$api = new Api;
		
		return floatval($api->getPrice($shortName));
	
	 }
           //ska ta bort balance efter köp
         public function buyStock($StockId, $amount){ //måste se till att bara mina värden på aktie id
        
        //cheack if it exist
       
                $flag = "false";
                foreach($this->holding as $key => $value) //blir stock 
                {
                	
                    if ($StockId == $value->getID()){ //aktie value är namn
                        
                        $flag = "true";
                        $prep = $this->getPrice($StockId);
                        $prep = $amount * $prep;
                        if($this->getBalance() > $prep){
                       
                    //måste checka om det funkar om balance är störe än prep * amount
                    
                        $this->changeHolding($key, $amount);
                	
                	    /* ta bort balans */
                  		$this->removeFromBalance($prep);
                        
                        }
                    }
                }
                if ($flag == "false"){
                	
                    $prep = $this->getPrice($StockId); //fixa
 			$prep= $amount * $prep;
 			//checkin if balance is bigger then prep
                     if($this->getBalance() >$prep){
                       
                    		$this->balance = $this->balance - $prep;
                   
                    
                    		$stock = new Stock($StockId, $amount);
                    
                    		$this->addStock($stock);
                    	//insert new stock sql
                		$this->insertNewStock($StockId, $amount);
                        //update account balance
                 		$this->removeFromBalance($prep);
                    
                    }
             
                }
           } 
           /**
            *
            **/
            public function sellStock($StockID, $amount){
            //get amount of the stock see if there is not negativ amount
            		//
            	$curentAmount = 0;
            	$id = $this->getID();
				$sql = "SELECT Amount FROM Stock WHERE StocksID= '" .$StockID."' AND AccountID = '" .$id."'"; 
				$classSql = new Sql;
				$stmt = $classSql->execute($sql);			
				//$stmt = parent::execute($sql);
				while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
				$curentAmount = $row['Amount'];
				}
            	if ($curentAmount >= $amount){
            	    //get price
            		$price = $this->getPrice($StockID);     
  					$totalPrice = $price * $amount; 
  			
  			        $this->addBalance($totalPrice);
  			          	 
            	 	//remove ammount of stock from StockID 
            	 	
  			        $newAmount  = $curentAmount - $amount;
            	 	
            	 	$this->updateStockHolding($StockID , $newAmount);
            	 	foreach($this->holding as $key => $value) //blir stock 
                	{
                		if ($StockID == $value->getID()){
                			$value->setAmount($newAmount);
                		}              	
                	}
            	}            	
            }      
}
?>
