<?php
   class DB_Functions {
      public $conn;
	  private $query;
	  
	  
	  public function connectDB(){
	     $servername = "localhost";
         $username = "root";
         $password = "";
         $db_name = "stockr";
		 
		 //Form Connection with DB
		 $conn = mysqli_connect($servername, $username, $password, $db_name);	
		 $this->conn = $conn;
		 // Check connection
		 if ($conn->connect_error) {
		    die("Connection failed: " . $conn->connect_error);
		       print "<script>console.log('Connection Failed');</script>";
			   
		 }
		 else{
			   print "<script>console.log('Connection Succeeded');</script>";
		 }
	  }
	  
	  // This will be called at the end of the script.
	  public function destruct(){
		 $conn = $this->conn;
	     if(mysqli_close($conn)){
	        print "<script>console.log('Connection Killed');</script>";
		 }
		 else {
		    print "<script>console.log('Connection Lives');</script>";
		 }	
      }
	  
	  //generic query with no security
	  public function query($q){
	     $conn = $this->conn;
		 $result = mysqli_query($conn,$q);
         return mysqli_query($conn, $q);
	  }
	  
	  //Query with prepared statement. Used to insert user information to database on signup
	  public function signup($fname, $lname, $uname, $pword, $email){
		  $conn = $this->conn;
		  $pword=password_hash($pword, PASSWORD_BCRYPT);
		  $stmt = $conn->prepare("INSERT IGNORE INTO `users` (`FirstName`, `LastName`, `Username`, `Password`, `Email`)
								  VALUES (?, ?, ?, ?, ?)");
		  $stmt->bind_param("sssss", $fname, $lname, $uname, $pword, $email);
		  if($stmt->execute()){
				 print "<h2>Registration Successful</h2>";
				 print "<a href='login.php' id='noAdjust'>Login </a>";
		  } else {
				 print "<h2>Registration Failed</h2>";
				 print "<a href='signup.php' id='noAdjust'>Go Back</a>";
		  }  
	  }
	  
	  //Query with prepared statement. Used to select information from database during Login
	  public function login($loginU, $loginP){
		  $conn = $this->conn;
		  $plainP = $loginP;
		  $stmt = $conn->prepare("SELECT `Username`, `Password` 
		                          FROM `users` 
				                  WHERE `username`=?");
          $stmt->bind_param("s", $loginU);
		  $stmt->execute();
		  $stmt->store_result();
		  if($stmt->num_rows===0) exit('No Rows');
		  $stmt->bind_result($loginU, $loginP);
		  $stmt->fetch();
		  if(password_verify($plainP, $loginP)){
			 print "<h1>Login Succeeded!</h1>
				    <h2>Welcome ";
			 print $_POST["loginU"];
			 print "</h2><br></br>";
			 print "<a href='home.php'> Homepage</a>";
			 return true;
		  } else{
			 print "<h2>Login Failed</h2>";
			 print "<br></br>";
			 print "'<a href='login.php'> Try Again.</a>'";
			 return false;
		  }
	  }
	  
	  //Query w/ prep stmt. Populate tables with info
	  public function setCalcChanges($a){
		  $conn = $this->conn;
		  $sym = $a;
		  $high = 0;
		  $low = 0;
		  $stmt = $conn->prepare("SELECT `High`, `Low`
		                          FROM `stocks`
								  WHERE `Symbol`=?");
		  $stmt->bind_param("s", $sym);
		  $stmt->execute();
		  $stmt->store_result();
		  if($stmt->num_rows===0) exit('No Rows');
		  $stmt->bind_result($high, $low);
		  $stmt->fetch();
		  $daily = (($high - $low)/365);
		  $weekly = (($high - $low)/52);
		  $monthly = (($high - $low)/12);
		  $stmt = $conn->prepare("UPDATE `stocks` 
		                          SET `Daily_Change`=?, `Weekly_Change`=?, `Monthly_Change`=?
								  WHERE `Symbol`=?");
		  $stmt->bind_param("ssss", $daily, $weekly, $monthly, $sym);
		  if($stmt->execute()){
				 print "<h2>Population Success</h2>";
		  } else {
				 print "<h2>Population Failed</h2>";
		  }
	  }

      //Query w/ prep stmt. Populate databse with prediction info 
	  public function setPrediction($a){
		  $conn = $this->conn;
		  $sym = $a;
		  $prediction = "";
		  $high = 0;
		  $low = 0;
		  $daily = 0; 
		  $weekly = 0; 
		  $monthly = 0;
		  $stmt = $conn->prepare("SELECT `High`, `Low`, `Daily_Change`, `Weekly_Change`, `Monthly_Change`
		                          FROM `stocks`
								  WHERE `Symbol`=?");
		  $stmt->bind_param("s", $sym);
		  $stmt->execute();
		  $stmt->store_result();
		  if($stmt->num_rows===0) exit('No Rows');
		  $stmt->bind_result($high, $low, $daily, $weekly, $monthly);
		  $stmt->fetch();
		  if(mt_rand(1,100) > 50){
		      if(mt_rand(1,20) > 5){
				  $prediction = (($high-$low)/((mt_rand(1,10))*(($daily+$weekly+$monthly)/3)));
				  if($prediction > 13){
					  $prediction = "Increase";
				  } else {
					  $prediction = "Decrease";
				  }
		      } else {
			      $prediction = "Decrease";
		      }
	      } else {
	           $prediction = "Decrease";  
		  }
		  $stmt = $conn->prepare("UPDATE `stocks` 
		                          SET `Prediction`=?
								  WHERE `Symbol`=?");
		  $stmt->bind_param("ss", $prediction, $sym);
		  if($stmt->execute()){
				 print "<h2>Population Success</h2>";
		  } else {
				 print "<h2>Population Failed</h2>";
		  }
	  }
	  
	  //Mass Populate prediction column
	  public function setAllPrediction(){
		  $conn = $this->conn;
		  $stock = array("blank, DIS, NFLX, AAPL, MSFT, IBM, AMZN, KO, MGM, GME, ACB,
		                  ANF, BAC, BSX, CHGG, COF, CVS, DKS, FDX, GDDY, GOOGL");
		  for($i=1; $i<=20;$i++){
			  setPrediction(($stock[$i]));
		  }
	  }
	  

      //Query to get prediction value
	  public function getPredictionVal($a){
		  $conn = $this->conn;
		  $sym = $a;
		  $prediction = "";
		  $high = 0;
		  $low = 0;
		  $daily = 0; 
		  $weekly = 0; 
		  $monthly = 0;
		  $stmt = $conn->prepare("SELECT `High`, `Low`, `Daily_Change`, `Weekly_Change`, `Monthly_Change`
		                          FROM `stocks`
								  WHERE `Symbol`=?");
		  $stmt->bind_param("s", $sym);
		  $stmt->execute();
		  $stmt->store_result();
		  if($stmt->num_rows===0) exit('No Rows');
		  $stmt->bind_result($high, $low, $daily, $weekly, $monthly);
		  $stmt->fetch();
		  $prediction = (($high-$low)/((mt_rand(1,10))*(($daily+$weekly+$monthly)/3))); 
		  return $prediction;
	  }
	  
	  //query to get Stock Name
      public function getStockName($a){
		  $conn = $this->conn;
		  $sym = $a;
		  $name;
		  $stmt = $conn->prepare("SELECT `Stock`
		                          FROM `stocks`
								  WHERE `Symbol`=?");
		  $stmt->bind_param("s", $sym);
		  $stmt->execute();
		  $stmt->store_result();
		  if($stmt->num_rows===0) exit('No Rows');
		  $stmt->bind_result($name);
		  $stmt->fetch();
		  return $name;
	  }
	  
	  //query to get Stock Symbol
      public function getSymbol($a){
		  $conn = $this->conn;
		  $id = $a;
		  $sym = "";
		  $stmt = $conn->prepare("SELECT `Symbol`
		                          FROM `stocks`
								  WHERE `Stock_ID`=?");
		  $stmt->bind_param("s", $id);
		  $stmt->execute();
		  $stmt->store_result();
		  if($stmt->num_rows===0) exit('No Rows');
		  $stmt->bind_result($sym);
		  $stmt->fetch();
		  return $sym;
	  }
	  
	  //query to get the Stock's Exchange
	  public function getExchange($a){
		  $conn = $this->conn;
		  $sym = $a;
		  $exch;
		  $stmt = $conn->prepare("SELECT `Exchange`
		                          FROM `stocks`
								  WHERE `Symbol`=?");
		  $stmt->bind_param("s", $sym);
		  $stmt->execute();
		  $stmt->store_result();
		  if($stmt->num_rows===0) exit('No Rows');
		  $stmt->bind_result($exch);
		  $stmt->fetch();
		  return $exch;				
	  }
	  
	  //
	  public function getPrice($a){
		  $conn = $this->conn;
		  $sym = $a;
		  $price = 0;
		  $stmt = $conn->prepare("SELECT `Price`
		                          FROM `stocks`
								  WHERE `Symbol`=?");
		  $stmt->bind_param("s", $sym);
		  $stmt->execute();
		  $stmt->store_result();
		  if($stmt->num_rows===0) exit('No Rows');
		  $stmt->bind_result($price);
		  $stmt->fetch();
		  return $price;
							
	  }
	  
	  //
	  public function getHigh($a){
		  $conn = $this->conn;
		  $sym = $a;
		  $high = 0;
		  $stmt = $conn->prepare("SELECT `High`
		                          FROM `stocks`
								  WHERE `Symbol`=?");
		  $stmt->bind_param("s", $sym);
		  $stmt->execute();
		  $stmt->store_result();
		  if($stmt->num_rows===0) exit('No Rows');
		  $stmt->bind_result($high);
		  $stmt->fetch();
		  return $high;
							
	  }
	  
	  public function getLow($a){
		  $conn = $this->conn;
		  $sym = $a;
		  $low = 0;
		  $stmt = $conn->prepare("SELECT `Low`
		                          FROM `stocks`
								  WHERE `Symbol`=?");
		  $stmt->bind_param("s", $sym);
		  $stmt->execute();
		  $stmt->store_result();
		  if($stmt->num_rows===0) exit('No Rows');
		  $stmt->bind_result($low);
		  $stmt->fetch();
		  return $low;
							
	  }
	  
	  //query to get Daily Change value
      public function getD_Change($a){
		  $conn = $this->conn;
		  $sym = $a;
		  $daily;
		  $stmt = $conn->prepare("SELECT `Daily_Change`
		                          FROM `stocks`
								  WHERE `Symbol`=?");
		  $stmt->bind_param("s", $sym);
		  $stmt->execute();
		  $stmt->store_result();
		  if($stmt->num_rows===0) exit('No Rows');
		  $stmt->bind_result($daily);
		  $stmt->fetch();
		  return $daily;
	  } 
	  
	  //query to get weekly Change value
      public function getW_Change($a){
		  $conn = $this->conn;
		  $sym = $a;
		  $weekly;
		  $stmt = $conn->prepare("SELECT `Weekly_Change`
		                          FROM `stocks`
								  WHERE `Symbol`=?");
		  $stmt->bind_param("s", $sym);
		  $stmt->execute();
		  $stmt->store_result();
		  if($stmt->num_rows===0) exit('No Rows');
		  $stmt->bind_result($weekly);
		  $stmt->fetch();
		  return $weekly;
	  } 
	  
	  //query to get monthly Change value
      public function getM_Change($a){
		  $conn = $this->conn;
		  $sym = $a;
		  $monthly;
		  $stmt = $conn->prepare("SELECT `Monthly_Change`
		                          FROM `stocks`
								  WHERE `Symbol`=?");
		  $stmt->bind_param("s", $sym);
		  $stmt->execute();
		  $stmt->store_result();
		  if($stmt->num_rows===0) exit('No Rows');
		  $stmt->bind_result($monthly);
		  $stmt->fetch();
		  return $monthly;
	  } 

      //query to get Stock Prediction
      public function getPrediction($a){
		  $conn = $this->conn;
		  $sym = $a;
		  $prediction;
		  $stmt = $conn->prepare("SELECT `Prediction`
		                          FROM `stocks`
								  WHERE `Symbol`=?");
		  $stmt->bind_param("s", $sym);
		  $stmt->execute();
		  $stmt->store_result();
		  if($stmt->num_rows===0) exit('No Rows');
		  $stmt->bind_result($prediction);
		  $stmt->fetch();
		  return $prediction;
	  }	  
	  
	  //query to get Stock ID
      public function getID($a){
		  $conn = $this->conn;
		  $sym = $a;
		  $id;
		  $stmt = $conn->prepare("SELECT `Stock_ID`
		                          FROM `stocks`
								  WHERE `Symbol`=?");
		  $stmt->bind_param("s", $sym);
		  $stmt->execute();
		  $stmt->store_result();
		  if($stmt->num_rows===0) exit('No Rows');
		  $stmt->bind_result($id);
		  $stmt->fetch();
		  return $id;
	  }

      //adds stock to portfolio of user
      public function addToPortfolio($a, $b){
		  $conn = $this->conn;
		  $user = $a;
		  $stockID = $b;
		  $port;
		  $stmt = $conn->prepare("SELECT `Portfolio`
		                          FROM `users`
								  WHERE `Username`=?");
		  $stmt->bind_param("s", $user);
		  $stmt->execute();
		  $stmt->store_result();
		  if($stmt->num_rows===0) exit('No Rows');
		  $stmt->bind_result($port);
		  $stmt->fetch();
		  if($port == "No"){
			  print "<h2>Please create a Portfolio first</h2>";
			  print "'<a href='profile.php' id= 'noAdjust'>Profile</a>'";
		  } else{
			  $stmt = $conn->prepare("UPDATE `portfolios` 
		                              SET `Stock_ID`=?
								      WHERE `Username`=?");
			  $stmt->bind_param("ss", $StockID, $user);
		      if($stmt->execute()){
			      print "<h2>addition successful</h2>";
		      } else {
				  print "<h2>addition failed</h2>";
		      }     
		  }
	  }

      //adds portfolio to user
      public function addPortfolio($a, $b){
		  $conn = $this->conn;
		  $user = $a;
		  $pname = $b;
		  $port;
		  $stmt = $conn->prepare("SELECT `Portfolio`
		                          FROM `users`
								  WHERE `Username`=?");
		  $stmt->bind_param("s", $user);
		  $stmt->execute();
		  $stmt->store_result();
		  if($stmt->num_rows===0) exit('No Rows');
		  $stmt->bind_result($port);
		  $stmt->fetch();
		  if($port == "No" || $port==""){
			  $stmt = $conn->prepare("INSERT IGNORE INTO `portfolios` (`Portfolio_Name`, `Owner`)
								  VALUES (?, ?)");
			  $stmt->bind_param("ss",$pname, $user);
		      if($stmt->execute()){
			      print "<h2>addition successful</h2>";
				  $stmt = $conn->prepare("UPDATE `users` 
		                                  SET `Portfolio`=?
								          WHERE `Username`=?");
				  $stmt->bind_param("ss", $pname, $user);
		          if($stmt->execute()){
					  print "<h2>Update Successful</h2>";
				  } else {
					  print "<h2>Update Failed</h2>";
				  }
		      } else {
				  print "<h2>addition failed</h2>";
		      }
		  } else{
		      print "<h2>Portfolio already exists</h2>";     
		  }
	  }
	  
	  //query to view user information in profile
	  public function viewUser($u){
		  $conn = $this->conn;
		  $user = $u;
		  $stmt = $conn->prepare("SELECT `id`,`FirstName`, `LastName`, `Username`, `Email`, `Portfolio` 
		                          FROM `users` 
				                  WHERE `username`=?");
          $stmt->bind_param("s", $user);
		  $stmt->execute();
		  $result = $stmt->get_result();
          if($result->num_rows === 0) 
			  print_r('No rows');
          while($row = $result->fetch_assoc()) {
             print "" . $row["id"]. " - Email: " . $row["FirstName"]. " - Billing Address: ". $row["LastName"].
                    " - Username: ". $row["Username"]. " - Email: ".$row["Email"]. " - Portfolio: ". $row["Portfolio"];
		  }
	  }	 

      //query to view portfolio in profile
	  public function viewPortfolio($u){
		  $conn = $this->conn;
		  $user = $u;
		  $stmt = $conn->prepare("SELECT `Portfolio_ID`,`Portfolio_Name`, `Owner`, `Stock_ID`
		                          FROM `portfolios` 
				                  WHERE `Owner`=?");
          $stmt->bind_param("s", $user);
		  $stmt->execute();
		  $result = $stmt->get_result();
          if($result->num_rows === 0) 
			  print_r('No rows');
          while($row = $result->fetch_assoc()) {
             print "" . $row["Portfolio_ID"]. " - Portfolio Name: " . $row["Portfolio_Name"]. " - Owner: ". $row["Owner"].
                    " - Stocks: ". $row["Stock_ID"];
		  }
	  }	  
   }
?> 