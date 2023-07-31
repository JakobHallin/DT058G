<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
spl_autoload_register(function ($class) {
    include 'classes/' . $class . '.class.php';
});
error_reporting(E_ALL);

	session_start();
	

	if(isset($_REQUEST["go"])){
	
		
		$username = $_REQUEST["user"];
		$pass = $_REQUEST["pass"];
	
	$db = new Database();
	

	
	$sql ="SELECT * FROM User WHERE UserID = '".$username. "' AND Password = '" .$pass."';";
	$result = $db->executeReturn($sql);
    		
    		
	//print_r ($sql);
	
	
	$count = $result->rowCount() ;
//	echo $count;
	if ($count == 1){
//	echo "finns";
	$_SESSION["valid_user"] = session_id();
	$_SESSION["user"]  = $username;
			header("Location: index.php");
			exit();
	}
	
	
	
	}
?>
<!DOCTYPE html>
<html lang="sv">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Document</title>
</head>
<body>
	<form id="formid" method="post" action="<?=$_SERVER['PHP_SELF'];?>">
		Användare:
		<input type="text" name="user" id="user" autocomplete="off" placeholder="Ange användarnamn" >
		<br>
		Lösenord: 
		<input type="password" name="pass" id="pass" placeholder="Ange lösenord" >
		<br>
		<input type="submit" name="go" id="go" value ="Logg in" >
	</form>

	<script>
		//
    	// Create eventlistener for 'formid' submit to check for empty fields
    	document.getElementById("formid").addEventListener("submit", (e) => {
			if(document.getElementById("user").value == "" || document.getElementById("pass").value == ""){
				e.preventDefault();
				return false;
			}
        	return true;
    	}) 
	</script>
</body>
</html>

