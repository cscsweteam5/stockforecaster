<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

    <title>Stockr - Sign up!</title>
  </head>
  <body>

	<!-- Navbar content -->
	<nav class="navbar navbar-expand-lg navbar-light bg-light">
		<a class="navbar-brand" href="index.php">Stockr</a>
		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
		</button>
		<div class="collapse navbar-collapse" id="navbarNav">
			<ul class="navbar-nav">
			<li class="nav-item active">
				<a class="nav-link" href="index.php">Home <span class="sr-only">(current)</span></a>
			</li>
			<li class="nav-item">
				<a class="nav-link" href="#">Stock Information</a>
			</li>
			<li class="nav-item">
				<a class="nav-link" href="#">Contact</a>
			</li>
			<li class="nav-item">
				<a class="nav-link " href="#" tabindex="-1" aria-disabled="true">About us</a>
			</li>
			</ul>
		</div>
		<ul class="nav justify-content-end">
			<li class="nav-item">
				<a class="nav-link" href="#">Sign Up</a>
			</li>
			<li class="nav-item">
				<a class="nav-link" href="login.php">Log In</a>
			</li>
		</ul>
		</nav>
		<!-- Navbar end ... -->
	
	<div class="container">	

		<br /><br />

		<div class="text-center">
			<img src="lock.png" class="rounded" alt="..."> <br /><br />
			<h3>Welcome to the world of cryptos.</h3>
		</div>
		<br /><br /><br />
		<form method="post" action="./server.php">
			<div class="form-row">
				<div class="form-row col-md-6" style="margin-right: 10px;">
					<label class="inputFirst">First name</label>
					<input type="text" class="form-control" id="inputFirst" placeholder="Enter your first name">
				</div>
				<div class="form-row col-md-6">
					<label class="inputLast">Last name</label>
					<input type="text" class="form-control" id="inputLast" placeholder="Enter your last name">
				</div>
			</div>
			<div class="form-row">
				<div class="form-row col-md-6" style="margin-right: 10px;">
					<label class="inputEmail">Email address</label>
					<input type="email" class="form-control" id="inputEmail" placeholder="Enter your email address">
				</div>
				<div class="form-row col-md-6">
					<label class="inputUser">Username</label>
					<input type="text" class="form-control" id="inputUser" placeholder="Enter your username">
				</div>
			</div>
			<div class="form-row">
				<div class="form-row col-md-4" style="margin-right: 10px;">
					<label class="inputPassword">Password</label>
					<input type="password" class="form-control" id="inputPassword" placeholder="Enter your password">
				</div>
				<div class="form-row col-md-4" style="margin-right: 10px;">
					<label class="inputBirthDate">Birthdate</label>
					<input type="date" class="form-control" id="inputBirthDate" placeholder="Enter your birthdate">
				</div>
				<div class="form-row col-md-4">
					<label class="inputNumber">Phone number</label>
					<input type="text" class="form-control" id="inputNumber" placeholder="Enter your phone number">
				</div>
			</div><br />
			<button type="submit" class="btn btn-primary" id="submit_user">Sign in</button>
		</form>
	</div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
  </body>
</html>