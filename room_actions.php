<?php 
	session_start();
	include 'db.php';

	if (!isset($_SESSION['logged_in']))
		header("Location: index.php");

	if(isset($_POST['message']) && $_POST['message']) {

		$userId = $_SESSION["user_id"];
		$username = $_SESSION["username"];
		$roomId = $_SESSION["room_number"];
		$message = $_POST['message'];

		$query = $conn->prepare("
			INSERT INTO `messages`(`user_id`, `username`, `room_id`, `message`) 
			VALUES (:user_id, :username, :room_id, :message)
		");

		$query->bindParam(":user_id", $userId);
		$query->bindParam(":username", $username);
		$query->bindParam(":room_id", $roomId);
		$query->bindParam(":message", $message);

		if($query->execute())
		{
			$response = "Success";
		}else{
			$response = "Error";
		}
	}

	if(isset($_POST['action']) && $_POST['action'] == 'kick_user') {
		$userId = $_POST['userId'];
		$room_number = $_SESSION["room_number"];

		$query = $conn->prepare("
			DELETE FROM rooms_users 
			WHERE room_id=:room_number and user_id=:user_id
		");
		$query->bindParam(":user_id", $userId);
		$query->bindParam(":room_number", $room_number);

		if($query->execute())
		{
			$response = "Success";
		}else{
			$response = "Error";
		}
	}

	echo json_encode($response);
?>