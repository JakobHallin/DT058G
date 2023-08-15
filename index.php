<?php
/*
 *Jakob Hallin, jaha2100, TDATG
 *DT058G, Webbprogrammering
 * description
 */
declare(strict_types=1); // Check for type cast problems
error_reporting(E_ALL); // Report and exit for all errors
require ("includes/load.php");


$username = $_SESSION["user"];
$title = "hem";
spl_autoload_register(function ($class) {
    include 'classes/' . $class . '.class.php';
});

?>
<!DOCTYPE html>
<html>
	<?php include("includes/head.php"); //head ?>
    	<?php include("includes/header.php"); //header ?>
        
        <?php include ("includes/UserContent.php"); //content ?>
  	<?php  include ("includes/stockInfo.php"); //content ?>
 	
	<div class="container"> 	
 		<!--refresh the browser-->
 		<div class= "refreshpage">
 			<button onClick="window.location.reload();">Refresh Page</button>
 		</div>
 		<!--logout the user-->
 		<div class="logout">
 			<form method="post" action="<?=$_SERVER['PHP_SELF'];?>">
        			<input type="submit" name="leave" id="leave" value="Log Out">
    			</form>
    		</div>
    	</div>
    	
    	
    	<?php include("includes/footer.php"); //footer ?>
</html>
