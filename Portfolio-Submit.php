<!DOCTYPE html>
<?php
   session_start();
   if(empty($_SESSION['user_id'])){
	   print "Please log in";
	   header("Location:login.php");
   }
?>
<html lang="en" xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta charset="utf-8" />
        <link rel="icon" type="image/png" href="wcwd.png" />
        <link rel="stylesheet" type="text/css" href="stockStyle.css" />
        <title>Stockr: Profile-Submit</title>
    </head>
    <body>
	   <!-- call to include DB Functions and connect to DB -->
       <?php
	      require_once "DB_Functions.php";
		  $database=new DB_Functions();
		  $database->connectDB();
		  if(empty($_POST['pname'])){
		     print "One of your fields is empty. Please go back and correct the error.";
		  } else {
		     $database->addPortfolio($_SESSION['user_id'], $_POST['pname']);
		  }
		  $database->destruct();
	   ?>
	</body>
</html>