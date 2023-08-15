<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
spl_autoload_register(function ($class) {
    include 'classes/' . $class . '.class.php';
   
});



error_reporting(E_ALL);
 //$db = new Db;
session_start();
	

	if(isset($_REQUEST["go"])){
		$username = $_REQUEST["user"];
		$pass = $_REQUEST["pass"];
		$hashpass = hash("ripemd160", $pass);
		// "test" "123" is the difrent password
		$sql ="SELECT * FROM User WHERE UserID = '".$username. "' AND Password = '" .$hashpass."';";
		$classSql = new Sql;
		$result = $classSql->execute($sql);
		$count = $result->rowCount() ;
		if ($count == 1){
		    $_SESSION["valid_user"] = session_id();
		    $_SESSION["user"]  = $username;
			header("Location: index.php");
			exit();
		}
	}
$title = "login";
?>
<!DOCTYPE html>
<html lang="sv">
<?php include("includes/head.php"); ?>

<?php include("includes/header.php"); ?>
	<div class="box">
	<h2> Logga in </h2>
	<?php //echo "test";  can make error message why login dident work?>
	<form id="formid" method="post" name="login" action="<?=$_SERVER['PHP_SELF'];?>">
		<label for="user"> Användare: </label>
		<input type="text" name="user" id="user" autocomplete="off" placeholder="Ange användarnamn" >
		<br>
		<label for="password"> Lösenord: </label>
		<input type="password" name="pass" id="pass" placeholder="Ange lösenord" >
		<br>
		<input type="submit" name="go" id="go" value ="Logg in" >
		
	</form>
	
	</div>
	<script src="js/login.js">
	
	</script>
	<?php include("includes/footer.php"); ?>
</html>

