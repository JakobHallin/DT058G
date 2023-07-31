<?php
declare(strict_types=1); // Check for type cast problems
error_reporting(E_ALL); // Report and exit for all errors
require ("includes/load.php");

$username = $_SESSION["user"];
spl_autoload_register(function ($class) {
    include 'classes/' . $class . '.class.php';
});

?>
<html>
	<head>
	<link rel="stylesheet" href="css/style.css">
    	</head>
    	<body>
    	<header>
    	<h1> Aktier </h1>
    	</header>
        <section>
        <?php include ("includes/UserContent.php"); ?>
  	<?php include ("includes/stockInfo.php");?>
 	
	<div class="container"> 	
 		
 		<div class= "refreshpage">
 			<button onClick="window.location.reload();">Refresh Page</button>
 		</div>
 		<div class="logout">
 			<form method="post" action="<?=$_SERVER['PHP_SELF'];?>">
        			<input type="submit" name="leave" id="leave" value="Log Out">
    			</form>
    		</div>
    	</div>
    	</section>
 	
 	<div class="footer"> 
 	<h2> footer </h2>
 	</div>
 	

</body>
</html>
