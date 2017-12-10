<?php 
	session_start();
	if (!isset($_SESSION['logged_in']))
    	header("Location: index.php");
    include 'db.php';
    define('AES_256_CBC', 'aes-256-cbc');

    $isAdmin = false;

    function checkIfAdmin () {
		$user_id = $_SESSION['user_id'];
		$room_number = $_SESSION["room_number"];
		include 'db.php';

		$query = $conn->prepare("
			SELECT created_by
			FROM rooms
			WHERE created_by=:user_id and id=:room_number
		");

		$query->bindParam(":user_id", $user_id);
		$query->bindParam(":room_number", $room_number);
		$query->execute();
		global $isAdmin;
		if($result = $query->fetch(PDO::FETCH_ASSOC)){
			return $isAdmin = true; 
		} else {
			return $isAdmin = false; 
		}
    }

	function renderRoomUsers($username, $user_id, $isAdmin){
		$template = "";
		$template .= "<div class=\"col-xs-12\">";
		$template .= "<div class=\"users-list\">$username</div>";
		if($isAdmin){
			$template .= "<button class=\"btn btn-danger btn-xs kick-btn\" id=\"$user_id\"> Kick </button>";
		}
		$template .= "</div>";
		return $template; 
	}

	function roomSettings() {
		$roomNumber = $_SESSION["room_number"];
		$user_id = $_SESSION['user_id'];

		$template = "";
		$template .= "<button class=\"btn btn-danger leave-btn \" id=\"$user_id\"> Leave room </button> ";

		if(checkIfAdmin()){
			$template .= "<button class=\"btn btn-danger delete-room\" id=\"$roomNumber\"> Delete conversation </button>";
		}

		return $template;					
	}

	function renderMesseges($username, $message){
		$template = "";
		$template .= "<div class=\"message-box\">";
			$template .= "<img class=\"img-responsive message-avatar\" src=\"./assets/images/userlogo.jpeg\">";
			$template .= "<div class=\"text-center\">";
			$template .= "<p>".$username."</p>";
			$template .= "</div>";

			$template .= "<div>";
			$template .= "<p>".$message."</p>";
			$template .= "</div>";
		$template .= "</div>";

		return $template;
	}
?>

<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html" charset="utf-8">
	<title>Phantom Buble</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
	<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.5.2/animate.min.css">
	<link rel="stylesheet" type="text/css" href="assets/css/style.css">

	<script src="assets/js/sweetalert.min.js"></script>
	<link rel="stylesheet" type="text/css" href="assets/css/sweetalert.css">

	<script>
		$(document).ready(function(){
			$(".new-user").hide();
			$(".add-user").click(function(){
			    $(".new-user").slideToggle();

			});

			$(".room-settings").hide();
			$(".edit-room").click(function(){
			    $(".room-settings").slideToggle();
			});
		});
	</script>
</head>
<body>
	<div class="content">
		<div class="inner-content">
			<div class="logo-container">
				<img class="img-responsive" id="page-logo" src="assets/images/logo.png">
			</div>
			<div>
				<a href="./dashboard.php"><div class="back-btn">Back</div></a>
			</div>
			<div class="col-xs-2 col-xs-offset-2 containers left-container text-center">
				<div class="panel-one">
					<div>
						<img class="img-responsive profile-avatar" src="./assets/images/userlogo.jpeg">
					</div>
					<div>
						<div class="col-xs-10 col-xs-offset-1">
							<button class="btn btn-default add-user">Add User</button>
							<div class="new-user"> 
								<input class="form-control" type="text" name="new-user" id="new-user"> 
							</div>
						</div>
						<div>
							<button class="btn btn-default edit-room">Room Settings</button>
							<div class="room-settings">
								<!-- Render room settings  -->
								<?php echo roomSettings($isAdmin) ?>
							</div>
						</div>
					</div>
				</div>
				<div class="panel-two text-center">
					<div><h4>Room Members</h4>
						<div class="room-users">
							<?php 
								// Check if the actual user is the admin
								checkIfAdmin();

								// Display all the members of this room
								$query = $conn->prepare("
									SELECT users.id, users.username
									FROM users inner join rooms_users
									ON rooms_users.user_id=users.id
									WHERE rooms_users.room_id=:room_number
								");
								$room_number = $_SESSION["room_number"];
								$query->bindParam(":room_number", $room_number);
								$query->execute();
								
								while ($result = $query->fetch(PDO::FETCH_ASSOC)) {
									$user_id = $result['id'];
									$username = $result['username'];
									echo renderRoomUsers($username, $user_id, $isAdmin);
								}
							?>
						</div>
					</div>
				</div>


			</div>
			<div class="col-xs-6 containers right-container">
				<h2>Room conversation</h2>
				<div class="chat">
					<div class="messages-container">
						<?php 
							$query = $conn->prepare("
									SELECT username, message 
									FROM messages 
									WHERE room_id=:room_number
							");
							$room_number = $_SESSION["room_number"];
							$query->bindParam(":room_number", $room_number);
							$query->execute();

							$stmt = $conn->prepare("
								SELECT room_key, room_iv 
								FROM rooms 
								WHERE id=:room_number
							");

							$room_number = $_SESSION["room_number"];
							$stmt->bindParam(":room_number", $room_number);
							$stmt->execute();

							$secondResult = $stmt->fetch(PDO::FETCH_ASSOC);
							$encryption_key = $secondResult['room_key'];
							$iv = $secondResult['room_iv'];

							while ($result = $query->fetch(PDO::FETCH_ASSOC)) {
								$username = $result['username'];
								$message = $result['message'];
									
								$decrypt = openssl_decrypt($message, AES_256_CBC, $encryption_key, 0, $iv);
								echo renderMesseges($username, $decrypt);
							}
						?>
					  </div>
					</div>
					<div class="input-container">
						<input type="text" class="form-control input-message pull-left" placeholder="Enter your message...">
						<button class="btn btn-info btn-send pull-right" type="button">Send</button>
					</div>
			</div>
		</div>
	</div>
	<script src="assets/js/main.js"></script>
</body>
</html>
