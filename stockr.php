<!DOCTYPE html>
<!--swiping page-->
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
        <title>Stockr</title>
    </head>
    <body>
	    <div class="navbar">
		   <a href="http://localhost/SWE_Spring2020/stockr.php">Stockr</a>
		   <a href="http://localhost/SWE_Spring2020/index.php">Home</a>
		   <div class="dropdown">
              <button class="dropbtn">Assignments
                 <i class="fa fa-caret-down"></i>
              </button>
              <div class="dropdown-content">
              </div>
           </div>
		   <a class="alignRight" href="login.php">Login</a>
           <a class="alignRight" href="signup.php">Sign up</a>
		   <a href="http://localhost/SWE_Spring2020/home.php">login Home</a>
		   <a href="StockInfo.php">Stock Information</a>
		   <a href="profile.php">Profile</a>
        </div>
        <h1>Welcome to Stockr</h1>
		<form action="stockr.php" method="post">
		    <fieldset class="leftSide">
		        <input type="image" src="Arrow.jpg" alt="arrow" class="leftArrow">
		    </fieldset>
		    <fieldset class="center">
		        <div>
		           <?php
			           require_once "DB_Functions.php";
				       $database=new DB_Functions();
		               $database->connectDB();
				       $rand = mt_rand(1,19);
				       $stocks = array("DIS", "NFLX", "AAPL", "MSFT", "IBM", "AMZN", "KO", "MGM", "GME", "ACB",
						                  "ANF", "BAC", "BSX", "CHGG", "COF", "CVS", "DKS", "FDX", "GDDY", "GOOGL");
				       $name = $database->getStockName($stocks[$rand]);
					   $_SESSION['stock_id'] = $database->getID($stocks[$rand]);
				       $exch = $database->getExchange($stocks[$rand]);
				       $price = $database->getPrice($stocks[$rand]);
				       $low = $database->getLow($stocks[$rand]);
				       $high = $database->getHigh($stocks[$rand]);
				       $dc = $database->getD_Change($stocks[$rand]);
				       $wc = $database->getW_Change($stocks[$rand]);
				       $mc = $database->getM_Change($stocks[$rand]);
				       $p = $database->getPrediction($stocks[$rand]);
				   
				       echo "Name: $name" . " || Symbol: $stocks[$rand]" . " || Exchange: $exch"; 
				       echo "<br></br>";
                       echo " Price: $price" . " || Last Year's Low: $low" . " || Last Year's High: $high";
				       echo "<br></br>";
				       echo " Last Year's Daily Change: $dc" . " || Last Year's Weekly Change: $wc" .
   				            " || Last Year's Monthly Change: $mc";
				       echo "<br></br>";
				       echo "Prediction: $p";
			       ?>
		       </div>
		    </fieldset>
		    <fieldset class="rightSide">
			    <div id="addButton">
			        <input type='image' src='Arrow.jpg' alt='arrow' class='rightArrow' 
					       onclick='addToPortfolio()'>
				    <div id="edit"></div>
				</div>
		    </fieldset>
		</form>
		<script>
		    function addToPortfolio() {
				var xhttp = new XMLHttpRequest();
                xhttp.onreadystatechange = function() {
                    if (this.readyState == 4 && this.status == 200) {
                        document.getElementById("edit").innerHTML = this.responseText;
				    }
				};
                xhttp.open("POST", "onClick.php?", true);
                xhttp.send();
			}
		</script>
    </body>
</html>