<?php 
$username = $_SESSION["user"];
$user = new User($username);
if(isset($_REQUEST["addstock"])){
		$StockId = $_REQUEST["InputStockID"];
		$amount = $_REQUEST["InputStockAmount"];
		$accountIndex = $_REQUEST["accountIndex"];
		if ($user->stockExist($StockId) == true){		
		$user->buyFromAccountStockAmount($accountIndex, $StockId, $amount);
		}
		else {	
		}
}
if(isset($_REQUEST["sellstock"])){
	$StockId = $_REQUEST["InputStockID"];
		$amount = $_REQUEST["InputStockAmount"];
		$accountIndex = $_REQUEST["accountIndex"];
		if ($amount > 0){
		$user->sellFromAccountStockAmount($accountIndex, $StockId, $amount);		
		}
}
$size = $user->getSize();
?> 
<div class="user">
<h1> <?php echo $username ?>  </h1>
<h2> <?php echo "Number of accounts " .$size; ?> </h2>
<br>
<?php
for ($i=0; $i<$size; $i++){
	
	?>
		<div id="accountBox" name="<?php echo "Account " . $i+1;?>" >
        <button type="button" class="collapsible"> 
        <?php
        $acountID = $user->getAccountID($i);    	
		$acountinfo = "AccountID: ". $acountID. " Balance: ". $user->getBalance($i);
		$stockSize = $user->getAmountStocks($i);
		$amountStock = " Amount of diffrent stocks:". $stockSize;
		?>  
		<h3> <?php  echo $acountinfo?> </h3>
		<h4> <?php echo $amountStock ?> </h4> 
		</button> 
		<div class="contentHolding">
			<?php	
			for ($x =0; $x<$stockSize; $x++){
		 		$stockID = "stockID: ". $user->getAccountsStockID($i, $x);
				$stockAmount = " stockAmount: ". $user->getAccountsStockAmount($i, $x);
				?> 
				<p> <?php echo $stockID . " ". $stockAmount; ?> </p> 
				<?php
			}
			?>
			<form id="acount" method="post" action="<?=$_SERVER['PHP_SELF'];?>"> 
				<label for="InputStockID"> buy stock id: </label>
				<input type='number' name='InputStockID' id='InputStockID'> 
				<label for="amount"> amount: </label> 
				<input type='number' name='InputStockAmount' id='InputStockAmount'></p> 
	 			<input type='hidden' id='accountIndex' name='accountIndex' value = <?php echo $i; ?>>	
	 			<input type='submit' name='addstock' id=addstock value=Buy> 
	 			<input type='submit' name='sellstock' id=sellstock value=Sell> 
	 			
	 		</form> 	
    		</div>	
    		</div>
    	
    	<?php 
}
?>
</div>
<script src="js/userContent.js">
/* Loop through all dropdown buttons to toggle between hiding and showing its dropdown content */

</script>
