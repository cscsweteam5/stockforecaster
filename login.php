<!DOCTYPE html>
<!--first home page-->
<html lang="en" xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta charset="utf-8" />
        <link rel="icon" type="image/png" href="wcwd.png" />
        <link rel="stylesheet" type="text/css" href="stockStyle.css" />
        <title>Stockr</title>
    </head>
    <body>
	   <form action="login-submit.php" method="post">
	     <fieldset>
		    <p>
		       <label class="left">Username: </label>
			   <input type="text" name="loginU" class="textbox" size="16"/>
		    </p>
			<p>
			   <label class="left">Password: </label>
			   <input type="password" name="loginP" class="textbox" size="16" id="hide"/>
			   <br><br>
			   <input type="checkbox" onclick="myFunction()">Show Password

               <script>
                  function myFunction() {
                     var x = document.getElementById("hide");
                     if (x.type === "password") {
                        x.type = "text";
                     } else {
                        x.type = "password";
                     }
                  }
               </script>
			</p>
			<p>
		       <input type="submit" value="Login">
			   <button onclick="location.href='http://localhost/final/signup.php'" type="button">
			      Sign-up
			   </button>
			</p>
		 </fieldset>
	  </form>
	</body>
</html>