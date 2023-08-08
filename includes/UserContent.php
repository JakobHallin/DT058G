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
<h1> <?php echo $username ?> </h1>
<h2> <?php echo "Number of accounts " .$size ."</br>"; ?> </h2> 
<?php
for ($i=0; $i<$size; $i++){
	?>
		<div id="accountBox">
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
				<p> buy stock id: <input type='number' name='InputStockID' id='InputStockID'> 
				amount: <input type='number' name='InputStockAmount' id='InputStockAmount'></p> 
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
<script>
/* Loop through all dropdown buttons to toggle between hiding and showing its dropdown content */
var i;
/* making sure if javascript run it starts as hiden */
var content2 = document.getElementsByClassName("contentHolding");
     for (i = 0; i < content2.length; i++){
     content2[i].style.display = "none";
     }
var coll = document.getElementsByClassName("collapsible");

for (i = 0; i < coll.length; i++) {
  coll[i].addEventListener("click", function() {
    this.classList.toggle("active");
    var content = this.nextElementSibling;
    if (content.style.display === "block") {
      content.style.display = "none";
    } else {
      content.style.display = "block";
    }
  });
}/*

*/
</script>
