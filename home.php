<!DOCTYPE html>
<!--this is after log in-->
<?php
   session_start();
?>
<html lang="en" xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta charset="utf-8" />
        <link rel="icon" type="image/png" href="wcwd.png" />
        <link rel="stylesheet" type="text/css" href="stockStyle.css" />
        <title>Stockr</title>
    </head>
    <body>
	    <div class="stockBar">
		   <fieldset>
		      <script src="JS_Functions.js"></script>
		      <div id="marqueeborder" onmouseover="pxptick=0" onmouseout="pxptick=scrollspeed">
                  <div id="marqueecontent">
				      <!--<?/*php
					      require_once "DB_Functions.php";
						  $database=new DB_Functions();
		                  $database->connectDB();
						  $stocks = array("DIS", "NFLX", "AAPL", "MSFT", "IBM", "AMZN", "KO", "MGM", "GME", "ACB",
						                  "ANF", "BAC", "BSX", "CHGG", "COF", "CVS", "DKS", "FDX", "GDDY", "GOOGL");
						  $change = array();
						  $predictions = array();
						  $length = count($stocks);
						  for($x = 1; $x <20; $x++){
							  echo "$stocks[$x]";
							  $change[$x] = $database->getD_Change($stocks[$x]);
							  /*$predictions[$x] = $database->getPrediction($stocks[$x]);*/
							  
						  /*}
						  for($y = 1; $y <20; $y++){
							  /*echo "$stocks[$y]";*//*
							  echo "$change[$y]";
						  }
					  */?>-->
                  </div>
              </div>
		   </fieldset>
		</div>
	    <div class="navbar">
		   <a href="http://localhost/SWE_Spring2020/stockr.php">Stockr</a>
		   <a href="http://localhost/SWE_Spring2020/index.php">Home</a>
		   <a href="http://localhost/SWE_Spring2020/profile.php">Profile</a>
		   <a href="http://localhost/SWE_Spring2020/StockInfo.php">Stock Information<a/>
		   <a href="http://localhost/SWE_Spring2020/signout.php">Sign-out<a/>
        </div>
		<div>
		   <br></br>
		</div>
		<fieldset class="leftSide">
		   <table class = "leftTable">
		       <tr>
                   <th>Stock</th>
                   <th>Symbol</th>
                   <th>Number</th>
               </tr>
			   <?php
			      require_once "DB_Functions.php";
			      $database=new DB_Functions();
		          $database->connectDB();
				  $stock; $id;
				  $sym = array();
				  for($i = 1; $i <= 8; $i++){
					  $sym[$i] = $database->getSymbol($i);
				  }
			      for($x = 1; $x <= 8; $x++){
					  $stock = $database->getStockName($sym[$x]);
					  $id = $database->getID($sym[$x]); 
					  echo '<tr>';
					  echo "<td>$stock</td>";
					  echo "<td>$sym[$x]</td>";
					  echo "<td>$id</td>";
					  echo '</tr>';
				  }
			   ?>
           </table>
		</fieldset>
		<fieldset class="rightSide">
		   <table class = "rightTable">
		       <tr>
                   <th>Stock</th>
                   <th>Symbol</th>
                   <th>Prediction</th>
               </tr>
			   <?php
			      require_once "DB_Functions.php";
			      $database=new DB_Functions();
		          $database->connectDB();
				  $stock; $predict;
				  $sym = array();
				  $p = array();
				  $count = 1;
				  for($i = 1; $i <= 20; $i++){
					  $sym[$i] = $database->getSymbol($i);
					  if($database->getPrediction($sym[$i]) == "Increase"){
						  $p[$count] = $sym[$i];
						  $count++;
					  }
				  }
				  $length = count($p);
			      for($x = 1; $x <= $length; $x++){
					  $stock = $database->getStockName($p[$x]);
					  $predict = $database->getD_Change($p[$x]); 
					  echo '<tr>';
					  echo "<td>$stock</td>";
					  echo "<td>$p[$x]</td>";
					  echo "<td>$predict</td>";
					  echo '</tr>';
				  }
			   ?>
           </table>
		</fieldset>
    </body>
</html>