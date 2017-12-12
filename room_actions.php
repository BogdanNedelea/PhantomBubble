<?php 
	session_start();
	include 'db.php';
	define('AES_256_CBC', 'aes-256-cbc');

	if (!isset($_SESSION['logged_in']))
		header("Location: index.php");

	if(isset($_POST['message']) && $_POST['message']) {

		$userId = $_SESSION["user_id"];
		$username = $_SESSION["username"];
		$roomId = $_SESSION["room_number"];
		$message = $_POST['message'];

		$query = $conn->prepare("
			SELECT room_key, room_iv 
			FROM rooms 
			WHERE id=:room_number
		");
		$room_number = $_SESSION["room_number"];
		$query->bindParam(":room_number", $room_number);
		$query->execute();
		$result = $query->fetch(PDO::FETCH_ASSOC);
		$encryption_key = $result['room_key'];
		$iv = $result['room_iv'];

		$encrypted = openssl_encrypt($message, AES_256_CBC, $encryption_key, 0, $iv);

		$query = $conn->prepare("
			INSERT INTO `messages`(`user_id`, `username`, `room_id`, `message`) 
			VALUES (:user_id, :username, :room_id, :message)
		");

		$query->bindParam(":user_id", $userId);
		$query->bindParam(":username", $username);
		$query->bindParam(":room_id", $roomId);
		$query->bindParam(":message", $encrypted);
		$query->execute();

		if($query->rowCount())
		{
			$response = "Success";
		}else{
			$response = "Error";
		}
	}


	if(isset($_POST['newUser']) && $_POST['newUser']) {

		$newuser = $_POST['newUser'];
		$query = $conn->prepare("
			SELECT id FROM users
			WHERE username=:newuser
		");
		$query->bindParam(":newuser", $newuser);
		$query->execute();

		if($query->rowCount()){
			$result = $query->fetch(PDO::FETCH_ASSOC);
			$userId = $result['id'];
			$roomId = $_SESSION["room_number"];

			$stmt = $conn->prepare("
				SELECT id FROM rooms_users
				WHERE user_id=:user_id AND room_id=:room_id
			");
			$stmt->bindParam(":user_id", $userId);
			$stmt->bindParam(":room_id", $roomId);
			$stmt->execute();

			if($stmt->rowCount()) {
				$response = "Already";
			} else {
				$query->bindParam(":room_id", $roomId);

				$query = $conn->prepare("
					INSERT INTO rooms_users (user_id, room_id) 
					VALUES (:user_id, :room_id)
				");
				$query->bindParam(":user_id", $userId);
				$query->bindParam(":room_id", $roomId);
				if($query->execute()){
					$response = "Success";
				} else {
					$response = "Error";
				}
			}
		} else {
			$response = "No_user";
		}
	}

	
	if(isset($_POST['roomId']) && $_POST['roomId']) {
		$room_id = $_POST['roomId'];
		$query = $conn->prepare("
			DELETE FROM rooms
			WHERE id=:room_number
		");
		$query->bindParam(":room_number", $room_id);
		$query->execute();

		$stmt = $conn->prepare("
			DELETE FROM rooms_users 
			WHERE room_id=:roomId"
		);
		$stmt->bindParam(":roomId", $room_id);
		$stmt->execute();

		
		if($query->rowCount() && $stmt->rowCount())
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

		$query->execute();
		if($query->rowCount())
		{
			$response = "Success";
		}else{
			$response = "Error";
		}
	}

    if(isset($_POST['action']) && $_POST['action'] == 'leave_room') {
        $userId = $_POST['userId'];
        $room_number = $_SESSION["room_number"];

        $query = $conn->prepare("
            DELETE FROM rooms_users 
            WHERE room_id=:room_number and user_id=:user_id
        ");
        $query->bindParam(":user_id", $userId);
        $query->bindParam(":room_number", $room_number);

        $query->execute();
        if($query->rowCount())
        {
            $response = "Success";
            $_SESSION["room_number"] = null;
        }else{
            $response = "Error";
        }
    }

	echo json_encode($response);
?>