<?php 
	$dbusername = "root";
	$dbpassword = "";
	
	$conn = new PDO('mysql:host=localhost;dbname=usersdb;charset=utf8mb4', $dbusername, $dbpassword);
	$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
?>