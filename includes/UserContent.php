<?php 

$username = $_SESSION["user"];

$user = new User($username);

	
if(isset($_REQUEST["addstock"])){
		
		$StockId = $_REQUEST["t1"];
		$amount = $_REQUEST["t2"];
		$accountIndex = $_REQUEST["accountIndex"];

			if ($user->stockExist($StockId) == true){
		
		
		
			$user->buyFromAccountStockAmount($accountIndex, $StockId, $amount);
		//reload	
			
			}
			else {
			
			}
		//}
}

if(isset($_REQUEST["sellstock"])){
	$StockId = $_REQUEST["t1"];
		$amount = $_REQUEST["t2"];
		$accountIndex = $_REQUEST["accountIndex"];
		
		if ($amount > 0){
//		echo "IM SELLINF TRUCKERS";
		$user->sellFromAccountStockAmount($accountIndex, $StockId, $amount);
		//reloadar sidan har inte så jag ändrar amount stock
		//måste reloada sidan updaterar inte userStock
		}

}

$size = $user->getSize();

?> 
<div class="user">
<h2> <?php echo $username ?> </h2>
<p> <?php echo "Accounts=" .$size ."</br>"; ?> </p> 
<?php

for ($i=0; $i<$size; $i++){
	//vafan gör form
	?>
	<form id="acount" method="post" action="<?=$_SERVER['PHP_SELF'];?>"> 
        
        <?php
        $acountID = $user->getAccountID($i);
	$acountinfo = "AccountID =". $acountID. " Balance= ". $user->getBalance($i);
	$stockSize = $user->getAmountStocks($i);
	$amountStock = " Amount of diffrent stocks:". $stockSize;
	?>  
	
	<p> <?php  echo $acountinfo?> </p>
	<p> <?php echo $amountStock ?> </p> 
	<?php
	
	
	for ($x =0; $x<$stockSize; $x++){
	
		 $stockID = "stockID= ". $user->getAccountsStockID($i, $x);
		$stockAmount = " stockAmount= ". $user->getAccountsStockAmount($i, $x);
		?> 
		<p> <?php echo $stockID . " ". $stockAmount; ?> </p> 
		<?php
	
	}
	?>
	<p> buy stock id: <input type='number' name='t1' id='t1'> 
	amount: <input type='number' name='t2' id='t2'> 
	 <input type='hidden' id='accountIndex' name='accountIndex' value = <?php echo $i; ?>>
	</p>
	 <input type='submit' name='addstock' id=addstock value=Buy> 
	 <input type='submit' name='sellstock' id=sellstock value=Sell>
 	
    		</form> 
    		<?php 

}
?>
</div>

