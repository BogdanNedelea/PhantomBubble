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

			$secretKey="ThisIsASecretKey12345678";
			// Based65 just for now !!
			$encrypt_pass=base64_encode(mcrypt_encrypt('tripledes',$secretKey,$pass,'ecb'));

			$query = $conn->prepare("INSERT INTO users (username, password) 
									 VALUES (:username, :password)");
			$query->bindParam(":username", $user);
			$query->bindParam(":password", $encrypt_pass);
			$query->execute();

			$response = "Account_Created";
		} else {	
			$response = "Duplicate";
		}
	}
	echo json_encode($response);
?>