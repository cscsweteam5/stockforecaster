<!DOCTYPE html>
<?php
   session_start();
   header("X-XSS-Protection: 1; mode: block");
   // time in seconds
   if (isset($_SESSION["Last_Activity"]) && (time() - $_SESSION["Last_Activity"] > 1800)){
      session_unset();
	  session_destroy();
	  header("Location:login.php");
   }
   $_SESSION["Last_Activity"] = time();
?>
<html lang="en" xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta charset="utf-8" />
        <link rel="icon" type="image/png" href="wcwd.png" />
        <link rel="stylesheet" type="text/css" href="stockStyle.css" />
        <title>Stockr: Login-Submit</title>
    </head>
    <body>
	   <?php
	      require_once "DB_Functions.php";
		  $database=new DB_Functions();
		  $database->connectDB();
		  if(empty($_POST['loginU']) || empty($_POST['loginP'])){
		     print "One or more of your fields are empty. Please go back and correct the error.";
		  } else {
			 if($database->login($_POST['loginU'], $_POST['loginP'])== true){
				 $_SESSION['user_id'] = $_POST['loginU'];
			 } else{
				header("Location:login.php");
			 }
		  }
		  $database->destruct();
	   ?>
	</body>
</html>