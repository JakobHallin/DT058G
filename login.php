<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
spl_autoload_register(function ($class) {
    include 'classes/' . $class . '.class.php';
   
});

$title = "login";

error_reporting(E_ALL);
 //$db = new Db;
	session_start();
	

	if(isset($_REQUEST["go"])){
	
		
		$username = $_REQUEST["user"];
		$pass = $_REQUEST["pass"];
		
		$hashpass = hash("ripemd160", $pass);
		// "test" "123" is the difrent password
	//$db = new Database();
	

	
	$sql ="SELECT * FROM User WHERE UserID = '".$username. "' AND Password = '" .$hashpass."';";
	$classSql = new Sql;
	echo "test";
	$result = $classSql->execute($sql);
	//$result = $db->execute($sql);
    		
    		
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
<?php include("includes/head.php"); ?>

<?php include("includes/header.php"); ?>
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
	<?php include("includes/footer.php"); ?>
</html>

