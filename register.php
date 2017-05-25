<?php
	session_start();
	date_default_timezone_set('Europe/Copenhagen');
	include 'db.php';

	if(isset($_POST["newuser"]) && $_POST["newuser"] &&
	   isset($_POST["newpass"]) && $_POST["newpass"]) {

		$user = $_POST["newuser"];
		$pass = $_POST["newpass"];

		$query = $conn->prepare("
			SELECT username FROM users
			WHERE username=:newuser
		");
		$query->bindParam(":newuser", $user);
		$query->execute();
		$result = $query->fetch(PDO::FETCH_ASSOC);

		if(!$result){

			$options = ['cost' => 12];
			$hash = password_hash($pass, PASSWORD_BCRYPT, $options);

			$query = $conn->prepare("INSERT INTO users (username, password) 
									 VALUES (:username, :password)");
			$query->bindParam(":username", $user);
			$query->bindParam(":password", $hash);
			$query->execute();

			$response = "Account_Created";
		} else {	
			$response = "Duplicate";
		}
	}
	echo json_encode($response);
?>