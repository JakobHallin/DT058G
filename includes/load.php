<?php
/**
 *make sure that user is valid and remove session when requested
 */
function load(){
    ini_set('display_errors', 1);
	ini_set('display_startup_errors', 1);
	error_reporting(E_ALL);

    session_start();
    
    if(isset($_REQUEST["leave"])){
        unset($_SESSION["valid_user"]);
        unset($_SESSION["user"]);
        session_destroy();
        header("Location: login.php");
        exit;
    }
    //checks if sesion i defined
    if (isset ($_SESSION["valid_user"])){
        
        //cheaks if user is valid
        if($_SESSION["valid_user"] != session_id()){
            header("Location: login.php");
            exit;
        }
     
        
    }
    else {
       
        header("Location: login.php");
        exit;
        
    }

    
    
}
load();

