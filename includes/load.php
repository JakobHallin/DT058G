<?php //vill göra dena till en function så den kan kallas i alla sidor därmed undvika kod
//echo "hi";
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

