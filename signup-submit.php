<!DOCTYPE html>

<html lang="en" xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta charset="utf-8" />
        <link rel="icon" type="image/png" href="wcwd.png" />
        <link rel="stylesheet" type="text/css" href="stockStyle.css" />
        <title>Stockr: Signup-Submit</title>
    </head>
    <body>
	   <!-- call to include DB Functions and connect to DB -->
       <?php
	      require_once "DB_Functions.php";
		  $database=new DB_Functions();
		  $database->connectDB();
		  if(empty($_POST['fname']) || empty($_POST['lname']) || empty($_POST['uname']) || empty($_POST['pword'])
     			   || empty($_POST['email'])){
		     print "One or more of your fields are empty. Please go back and correct the error.";
		  } else if($_POST['pword'] !== $_POST['pword2']){
			  print "Password does not match";
		  }
		  else {
		     $database->signup($_POST['fname'],$_POST['lname'],$_POST['uname'],$_POST['pword'],$_POST['email']);
		  }
		  $database->destruct();
	   ?>
	</body>
</html>