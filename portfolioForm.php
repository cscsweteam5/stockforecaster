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
        <title>Stockr: New Portfolio</title>
    </head>
    <body>
	   <form action="Portfolio-Submit.php" method="post">
	     <fieldset>
		    <p>
		       <label class="left">Portfolio Name: </label>
			   <input type="text" name="pname" class="textbox" size="16"/>
		    </p>
			<p>
		       <input type="submit" value="Make New Portfolio">
			</p>
		 </fieldset>
	  </form>
	</body>
</html>