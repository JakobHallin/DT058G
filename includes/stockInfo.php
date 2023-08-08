
<?php
	
	/*
	 * To show info about allstocks
	 */
	 
	 function StockInfo(){     
    	$sql = "SELECT * FROM AllStocks";
	$classSql = new Sql;
	$result = $classSql->execute($sql);
    	?>
    	<div class="table" id = "table"> 
    		<div class="row">
    			<div class="column">
    			<h4> StockID</h4>
    			</div>
    			<div class="column">
    			<h4> StockName</h4>
    			</div>
    			<div class="column">
    			<h4> Price</h4>
    			</div>
    		</div>
    	<?php 
    	/* PDOStatement::fetch
    	 * Fetches the next row from a result set 
    	 */
    	while($row = $result->fetch(PDO::FETCH_ASSOC)) {
			?> 
			<div class="row">
			<?php
				$stockID= $row['StocksID'];
				$stockName= $row['StockName'];
				$shortName= $row['Short'];
				$api = new Api;
				$price = $api->getPrice($shortName)
				?> 
				<div class="column">
 					<p> <?php echo $stockID ?></p>
 				</div>
 				<div class="column">
					<p> <?php echo $stockName ?></p>
				</div>
				<div class="price" id="<?php echo $shortName; ?>">
					<p> <?php echo $price; ?></p>
				</div>
			</div>
			<?php 
	 	}
	 ?> </div> 
	 
	 <?php		
	 

	}


StockInfo();



?>


