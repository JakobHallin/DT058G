<?php
/**
 *make sure that user is valid and remove session when requested
 */
function load(){
    	ini_set('display_errors', 1);
	ini_set('display_startup_errors', 1);
	error_reporting(E_ALL);

    session_start();
    
    if($_SESSION["valid_user"] != session_id()){
        header("Location: login.php");
        exit;
    }

    if(isset($_REQUEST["leave"])){
        unset($_SESSION["valid_user"]);
        unset($_SESSION["user"]);
        session_destroy();
        header("Location: login.php");
        exit;
    }
}
load();

