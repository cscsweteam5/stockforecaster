<?php
    session_start();
    if(empty($_SESSION['user_id'])){
	   print "Please log in";
	   header("Location:login.php");
    }
?>
<?php
    $conn;
    $query;
	$servername = "localhost";
    $username = "root";
    $password = "";
    $db_name = "stockr";
		 
	//Form Connection with DB
	$conn = mysqli_connect($servername, $username, $password, $db_name);	
	if($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
		print "<script>console.log('Connection Failed');</script>";
			   
	} else {
	    print "<script>console.log('Connection Succeeded');</script>";
    }
	
	$user = $_SESSION['user_id'];
	$stockID = $_SESSION['stock_id'];
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
	    $stmt = $conn->prepare("INSERT IGNORE INTO `portfolios` (`Owner`, `Stock_ID`)
								  VALUES (?, ?,)");
		$stmt->bind_param("ss", $user, $StockID);
		if($stmt->execute()){
	        print "<h2>addition successful</h2>";
		    $stmt->close();
		} else {
		    print "<h2>addition failed</h2>";
		}     
	}
?>