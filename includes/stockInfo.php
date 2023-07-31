<?php
	

	 function StockInfo(){     
    	$db = new Database();
    	$sql = "SELECT * FROM AllStocks";
	
	$result  = $db->executeReturn($sql);
    	?>
    	<div class="table" id = "table"> 
    		<div class="row">
    			<div class="column">
    			<p> StockID</p>
    			</div>
    			<div class="column">
    			<p> StockName</p>
    			</div>
    			<div class="column">
    			<p> Price</p>
    			</div>
    	<?php
    	while($row = $result->fetch(PDO::FETCH_ASSOC)) {
			?> <div class="row">
			<?php
			
			$stockID= $row['StocksID'];
			
			$stockName= $row['StockName'];
			$shortName= $row['Short'];
			
			$price = $db->fetchPrice($shortName)
					
			?>
			<div class="column">
 			<p> <?php echo $stockID ?></p>
 			</div>
 			<div class="column">
			<p> <?php echo $stockName ?></p>
			</div>
			<div class="column">
			<p> <?php echo $price ?></p>
			</div>
			<?php
	//		echo $stockID. $stockName. $shortName. "</br>";
	 	}
	 ?> </div> 
	 <?php		

	}

StockInfo();



?>


