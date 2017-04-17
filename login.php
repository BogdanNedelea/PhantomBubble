<?php
	session_start();
	date_default_timezone_set('Europe/Copenhagen');

	include 'db.php';
	# check if a valid login request was made....
	if(isset($_POST["user"]) && $_POST["user"] &&
	   isset($_POST["pass"]) && $_POST["pass"]) {

		$user = $_POST["user"];
		$pass = $_POST["pass"];

		$query = $conn->prepare("SELECT * FROM users WHERE username= :username LIMIT 1");
		$query->bindParam(":username", $user);
		$query->execute();
		
		$result = $query->fetch(PDO::FETCH_ASSOC);
		$password = $result['password'];
		$username = $result['username'];
		
		$check_attempt = $result['attempt'];
		$number_attempts = $check_attempt ? $check_attempt : 0;
		$last_attempt = $result['date'];
		$now = (new DateTime())->format('Y-m-d H:i:s');

		$lastDate=	strtotime($last_attempt);
		$newDate=  strtotime($now);
		$interval = abs($newDate - $lastDate);
		$difference = round($interval/60);
		$time_left = 5-$difference;
		
		function update_db($number_attempts, $username) {
			include 'db.php';

			$attempt_time = (new DateTime())->format('Y-m-d H:i:s');
			$query = $conn->prepare("
				UPDATE users 
				SET `attempt`=:number_attempts , `date`=:attempt_time
				WHERE `username`=:username ");

			$query->bindParam(":number_attempts", $number_attempts);
			$query->bindParam(":attempt_time", $attempt_time);
			$query->bindParam(":username", $username);
			$query->execute();
		}

		if($difference >= 5 || $number_attempts < 3){
			if($password === $pass)
			{
				echo "You have successfully logged in.";
				echo " Welcome $username!";

				$_SESSION["logged_in"] = "true";
				header("Location: dashboard.php");
				exit;
			} elseif ($username === $user && $password != $pass)  {
				if($number_attempts == 2)
				{
					$number_attempts = $number_attempts + 1;
					update_db($number_attempts, $username);
					echo " First if (right account/ wrong pass)";
					echo "You failed to login too many times, the account will be locked for 5 minutes.";
					echo '<a class="btn btn-default back-btn" href="index.php">Go Back</a>';;
					exit;
				} else {
					$difference >= 5 ? $number_attempts = 1 : $number_attempts = $number_attempts + 1;
					update_db($number_attempts, $username);
					echo " Second if (right account/ wrong pass)";
					echo '<p id="error-msg">Invalid login information. Please return to previous page and try again!</p>';
					echo '<a class="btn btn-default back-btn" href="index.php">Go Back</a>';
					exit;
				}	
			} else {
				echo "Wrong !";
			}
		} else {
			echo "You failed to login too many times, you have to wait ".$time_left." minutes !";
			echo '<a class="btn btn-default back-btn" href="index.php">Go Back</a>';
			exit;
		}
	}
?>


<!-- 
		if(count($result) == 1){
			echo "You have successfully logged in.";
			echo " Welcome $username!";

			$_SESSION["logged_in"] = "true";
			header("Location: dashboard.php");
			exit;
		} elseif (count($result) == 0) {
			if($number_attempts == 2)
			{
				$number_attempts = $number_attempts + 1;
				update_db($conn, $number_attempts, $username);
				echo "You failed to login too many times, the account will be locked for 5 minutes.";
				echo '<a class="btn btn-default back-btn" href="index.php">Go Back</a>';;
				exit;
			} else {
				$difference >= 5 ? $number_attempts = 1 : $number_attempts = $number_attempts + 1;
				update_db($conn, $number_attempts, $username);
				echo '<p id="error-msg">Invalid login information. Please return to previous page and try again!</p>';
				echo '<a class="btn btn-default back-btn" href="index.php">Go Back</a>';
				exit;
			}
		}  -->