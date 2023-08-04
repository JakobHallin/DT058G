
<?php
	

	 function StockInfo(){     
    	//$db = new Database();
    	$sql = "SELECT * FROM AllStocks";
	$classSql = new Sql;
	$result = $classSql->execute($sql);
	//$result  = $db->execute($sql);
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
    	while($row = $result->fetch(PDO::FETCH_ASSOC)) {
			?> 
			<div class="row">
			<?php
			
				$stockID= $row['StocksID'];
			
				$stockName= $row['StockName'];
				$shortName= $row['Short'];
			$api = new Api;
			$price = $api->getPrice($shortName)
					// id Id="<?php echo $shortName;
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
			
			<?php //echoPrice //göra javascript på column id shortname
	
	 	}
	 ?> </div> 
	 
	 <?php		
	 

	}


StockInfo();



?>


