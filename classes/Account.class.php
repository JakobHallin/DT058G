<?php

class Account extends Database {
   
   	private $con;
   	private $id;
    	private $balance;  //float
    	private $holding = []; // array
     	function __construct($id, $balance) { //bra
		$this->id = $id;          
          	$this->balance= $balance; 
            	
           
		$sql = "SELECT * FROM Stock WHERE AccountID= '" .$id ."'";
	
	 	$stmt = parent::executeReturn($sql);
		while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
	
      		$this->addStock( new Stock($row['StocksID'],  $row["Amount"]));
      
    		}
        
        }  
        public function getSize(){
		return sizeof($this->holding);
	} 
      	public function getStockID($index){
      		
      		//echo $index;
      		$var = $this->holding[$index]->getID();
      		//echo "after var". $var;
      		return $this->holding[$index]->getID();
      	}
      	public function getStockAmount($index){
      		return $this->holding[$index]->getAmount();
      	}
        public function setBalance($n) {  // a public function (default)
           	$this->balance = $n;
        }
        public function addStock($stock) {  // a public function (default)
           
            	array_push($this->holding, $stock);
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
          
          public function addBalance($totalprice){ //se till att det bara är posetivt
         //add sql
          $this->balance = $this->balance + $totalprice;
          $accountID = $this->getID();
          $sql = "UPDATE Accounts SET Balance = (SELECT Balance FROM Accounts WHERE AccountID = $accountID) + $totalprice WHERE AccountID = $accountID"; 
          parent::prepareSqlExecte($sql);
          }
          
          
           public function removeFromBalance($totalprice){
           $this->balance = $this->balance - $totalprice;
          	$accountID = $this->getID();
           	$sql = "UPDATE Accounts SET Balance = (SELECT Balance FROM Accounts WHERE AccountID = $accountID) - $totalprice WHERE AccountID = $accountID"; 
                // kanske göra preparemethod prepare($sql){$stmt = con->prepare; stmt->execute();
            	parent::prepareSqlExecte($sql);
                //
            }
     
        public function updateStockHolding($stockID , $stockAmount){
        $accountID = $this->getID();
          $sql = "UPDATE Stock SET Amount = $stockAmount WHERE StocksID = $stockID AND AccountID = $accountID "; 
                    parent::prepareSqlExecte($sql);
        
        }
              public function insertNewStock($StockId, $amount){
               		$sql = "INSERT INTO `Stock`(`StocksID`, `AccountID`, `Amount`) VALUES (?,?,?)";
                    	
                    	$id = $this->getID();
                    	
                    	parent::insertSql($sql, $StockId, $id, $amount);
                
                    }
              
                    
           public function changeHolding($index, $amount){ //bra
           
           $this->holding[$index]->addAmount($amount);
               $stockAmount = $this->holding[$index]->getAmount(); 
               $stockID = $this->holding[$index]->getID();
              
              $this->updateStockHolding($stockID, $stockAmount);
              
           }
           public function getPrice($StockID){ //Lite oäkervart denna funktion bör ligga
          
          //fetcha stockförkortning
          	$shortName ='';
          	
		$sql = "SELECT * FROM AllStocks WHERE StocksID= '" .$StockID ."'";
		$stmt = parent::executeReturn($sql);
	
		while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
			$shortName= $row['Short'];
			//echo $shortName;
	 	}

		
		return floatval(parent::fetchPrice($shortName));
	
	 }
           //ska ta bort balance efter köp
           public function buyStock($StockId, $amount){ //måste se till att bara mina värden på aktie id
        
        //cheack if it exist
           //echo '</br>' . "amount in account=". $amount;
           //echo "flag";
                $flag = "false";
                foreach($this->holding as $key => $value) //blir stock 
                {
                	
                    if ($StockId == $value->getID()){ //aktie value är namn
                        
                        $flag = "true";
                        $prep = $this->getPrice($StockId);
                        $prep = $amount * $prep;
                        if($this->getBalance() > $prep){
                        //echo "biger";
                    //måste checka om det funkar om balance är störe än prep * amount
                    
                        $this->changeHolding($key, $amount);
                	
                	/* updateBalance() */
                  $this->removeFromBalance($prep);
                        
                        }
                        //else echo "</br>". "TO LOW!!!!";
                       
                    }
                    //echo "no";
                }
               // echo "hi"; 
                if ($flag == "false"){
                	
                    $prep = $this->getPrice($StockId);
 			$prep= $amount * $prep;
 			//checkin if balance is bigger then prep
                     if($this->getBalance() >$prep){
                       
                    	$this->balance = $this->balance - $prep;
                   
                    
                    	$stock = new Stock($StockId, $amount);
                    
                    	//echo "new stock AMount =". $amount;
                    	//echo "</br>" . $stock->getAmount();
                    	$this->addStock($stock);
                    	//insert new stock sql
                	$this->insertNewStock($StockId, $amount);
                        //update account balance
                 	$this->removeFromBalance($prep);
                    
                    }
             //       else echo "</br>". "TO LOW!!!!";
                }
           }
            public function sellStock($StockID, $amount){
            //get amount of the stock see if there is not negativ amount
            		//
            		$curentAmount = 0;
            		$id = $this->getID();
            	
		$sql = "SELECT Amount FROM Stock WHERE StocksID= '" .$StockID."' AND AccountID = '" .$id."'";
	 
		$stmt = parent::executeReturn($sql);
		while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
			$curentAmount = $row['Amount'];
		
	 	}
            	
            	if ($curentAmount >= $amount){
            	 
            	// echo "account bigger";
            	 //sql add balance
            	 $price = $this->getPrice($StockID);     //209
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
