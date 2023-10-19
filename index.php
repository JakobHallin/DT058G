<?php
/*
 * @authorJakob Hallin
 * Kurs: DT058G, Webbprogrammering
 * Projekt: Hemsida med simulering av handel med aktier
 * @brief Index sidan
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
    <!--head-->
	<?php include("includes/head.php"); ?>
    <!--body-->
        <!--header-->
        <?php include("includes/header.php"); //header ?>
        <!--content usercontent-->
        
        
        <?php include ("includes/UserContent.php"); //content ?>
        <!--content stockifo-->
  	    <?php  include ("includes/stockInfo.php"); //content ?>
 	
	
    	
    	
    	<?php include("includes/footer.php"); //footer ?>
</html>
