<?php
declare(strict_types=1); // Check for type cast problems
error_reporting(E_ALL); // Report and exit for all errors
require ("includes/load.php");
$title = "hem";

$username = $_SESSION["user"];
spl_autoload_register(function ($class) {
    include 'classes/' . $class . '.class.php';
});

?>
<html>
	<?php include("includes/head.php"); //head ?>
    	<?php include("includes/header.php"); //header ?>
        
        <?php include ("includes/UserContent.php"); //content ?>
  	<?php  include ("includes/stockInfo.php"); //content ?>
 	
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
    	
    	
    	<?php include("includes/footer.php"); //footer ?>
</html>
