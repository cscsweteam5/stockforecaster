<!DOCTYPE html>
<!--swiping page-->
<?php

$curl = curl_init();
$url = "https://apidojo-yahoo-finance-v1.p.rapidapi.com/market/auto-complete?lang=en&region=US&query=DIS";

curl_setopt_array($curl, array(
	CURLOPT_URL => $url,
	CURLOPT_RETURNTRANSFER => true,
	CURLOPT_FOLLOWLOCATION => true,
	CURLOPT_ENCODING => "",
	CURLOPT_MAXREDIRS => 10,
	CURLOPT_TIMEOUT => 30,
	CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
	CURLOPT_CUSTOMREQUEST => "GET",
	CURLOPT_HTTPHEADER => array(
		"x-rapidapi-host: apidojo-yahoo-finance-v1.p.rapidapi.com",
		"x-rapidapi-key: d390c858damshf58d0da0107a27dp182135jsn25e9eb7b26a5"
	),
));

$response = curl_exec($curl);
$err = curl_error($curl);
curl_close($curl);

if ($err) {
	echo "cURL Error #:" . $err;
} else {
	parse_str($response);
	echo $response;
}

require_once "DB_Functions.php";
$database=new DB_Functions();
$database->connectDB();
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
		   <a href="">Stock Information</a>
		   <a href="">Portfolio</a>
        </div>
        <h1>Welcome to Stockr</h1>
		<fieldset class="leftSide">
		   left arrow
		</fieldset>
		<fieldset class="center">
		   space for stock to be swiped
		</fieldset>
		<fieldset class="rightSide">
		   right arrow
		</fieldset>
    </body>
</html>