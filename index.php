<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html" charset="utf-8">
	<title>Welcome</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
	<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css">
	<link rel="stylesheet" type="text/css" href="public/css/style.css">
</head>
<body>
	<div class="content">
		<div class="inner-content">
			<form method="post" action="error_page.php" id="login-form" class="text-center">
				<img class="img-responsive" id="logo" src="public/images/logo.png">
				<div class="form-group">
					<i class="fa fa-user" aria-hidden="true"></i>
					<label>RADA</label>
					<input type="text" name="username" class="form-control" id="username" />
				</div>
				<div class="form-group">
					<label>Password</label>
					<input class="form-control" type="password" name="password" id="password" />
				</div>
				<input class="btn btn-default" type="submit" name="submit" id="submit" value="Log in"/>
			</form>
		</div>
	</div>
</body>
</html>
