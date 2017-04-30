<?php 
	session_start();
	include 'db.php';

	if (!isset($_SESSION['logged_in']))
		header("Location: index.php");


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