<?php
   class DB_Functions {
      public $conn;
	  private $query;
	  
	  
	  public function connectDB(){
	     $servername = "root";
         $username = "dioufism";
         $password = "Kingousmane95";
         $db_name = "sys";
		 
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
	  public function signup($name, $email, $bAddress, $uname, $pword){
		  $conn = $this->conn;
		  $pword=password_hash($pword, PASSWORD_BCRYPT);
		  $stmt = $conn->prepare("INSERT IGNORE INTO `customers` (`Name`, `email`, `bAddress`, `Username`, `Password`)
								  VALUES (?, ?, ?, ?, ?)");
		  $stmt->bind_param("sssss", $name, $email, $bAddress, $uname, $pword);
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
		  $stmt = $conn->prepare("SELECT `username`, `password` 
		                          FROM `customers` 
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
			 print "<a href='main.php'> Plan your TRIP!</a>";
			 return true;
		  } else{
			 print "<h2>Login Failed</h2>";
			 print "<br></br>";
			 print "'<a href='voterLogin.php'> Try Again.</a>'";
			 return false;
		  }
	  }
   }
?>