<?php  
	session_start();
	include 'db.php';

	if (!isset($_SESSION['logged_in']))
		header("Location: index.php");

	if(isset($_POST["roomId"]) && $_POST["roomId"]) {
		$roomId = $_POST["roomId"];
		$userId= $_SESSION['user_id'];

		$query = $conn->prepare("
				SELECT room_id
				FROM rooms_users 
				WHERE user_id=:temp_userid
		");
		$query->bindParam(":temp_userid", $userId);
		$query->execute();

		while ($result = $query->fetch(PDO::FETCH_ASSOC)) {
			$result_room = $result['room_id'];

			if($roomId == $result_room) {
				$_SESSION['room_number'] = $result_room;
				$response = "Advance";
			}
			
			if(empty($result)){
				$response = "Invalid_room";
			}
		}
		echo json_encode($response);
	}
?>