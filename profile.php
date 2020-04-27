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
        <title>Stockr: Profile</title>
    </head>
    <body>
        <h1>Stockr</h1>
        <h2>User Profile</h2>
        <div id="box">
		   <p>
               <h3>Name</h3>
			   <p>
			      <?php
	                 require_once "DB_Functions.php";
		             $database=new DB_Functions();
		             $database->connectDB();
		             $database->viewUser($_SESSION['user_id']);
			      ?> 
			   </p>
		   </p>
		   <p>
               <h3>Portfolio</h3>
			   <p>
			      <?php
		             $database->viewPortfolio($_SESSION['user_id']);
			      ?> 
				  <p>
				      <form action="portfolioForm.php">
				          <button type="submit" value="New Portfolio">New Portfolio</button>
					  </form>
				  </p>
			   </p>
		   </p>
        </div>
    </body>
</html>