<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html" charset="utf-8">
	<title>Welcome</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
	<link rel="stylesheet" type="text/css" href="assets/css/style.css">
	
	<script src="assets/js/sweetalert.min.js"></script>
	<link rel="stylesheet" type="text/css" href="assets/css/sweetalert.css">
</head>
<body>
	<div class="content">
		<div class="inner-content">
			<!-- <form method="post" action="login.php" id="login-form" class="text-center"> -->
			<div class="text-center" id="login-form"> 
				<img class="img-responsive" id="logo" src="assets/images/logo.png">
				<?php
					if(isset($_COOKIE["lockout"])) {
						echo "You are locked out";
						exit;
					}
				?>
				<div class="form-group">
					<label>Username</label>
					<input type="text" name="user" class="form-control" id="username" />
				</div>
				<div class="form-group">
					<label>Password</label>
					<input class="form-control" type="password" name="pass" id="password" />
				</div>
				<input class="btn btn-default" name="submit" id="submit" value="Log in"/>
			</div>
	<!-- 		</form> -->
		</div>
	</div>
	<script src="assets/js/main.js"></script>
</body>
</html>
