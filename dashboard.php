<?php 
	session_start();
	if (!isset($_SESSION['logged_in']))
    	header("Location: index.php");
    include 'db.php';
?>

<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html" charset="utf-8">
	<title>Welcome</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
	<link rel="stylesheet" type="text/css" href="assets/css/style.css">

	<script src="assets/js/sweetalert.min.js"></script>
	<link rel="stylesheet" type="text/css" href="assets/css/sweetalert.css">

	<script>
		$(document).ready(function(){
			$(".new-room").hide();
			$(".add-room").click(function(){
			    $(".new-room").slideToggle();

			});
		});
	</script>
</head>
<body>
	<?php
		if(isset($_COOKIE["lockout"])) {
		echo "You are locked out";
			exit;
		}
	?>
	<div class="content">
		<div class="inner-content">
			<div class="logo-container">
				<img class="img-responsive" id="page-logo" src="assets/images/logo.png">
			</div>
			<div class="general-panel">
				<div id="welcome-user"><?php print 'Welcome '.$_SESSION['username'].' !' ?></div>
				<?php
					$tempuserid= $_SESSION['user_id'];
					$query = $conn->prepare("
							SELECT rooms.id, rooms.name
							FROM rooms inner join rooms_users
							ON rooms_users.room_id=rooms.id
							WHERE rooms_users.user_id=:temp_userid
					");

					$query->bindParam(":temp_userid", $tempuserid);
					$query->execute();

				    while ($result = $query->fetch(PDO::FETCH_ASSOC)) { ?>
					<br><button class="btn btn-info enter-room" 
							id="<?php echo $result['id'];?>">
								<?php echo $result['name'];?>
						</button><br>
				    <?php }
				?>
				<br><br><br>

				<div class="new-room-container">
					<button class="btn btn-default add-room">Add room</button>
					<div class="new-room"> 
						Room name <input class="form-control" type="text" name="room-name" id="room-name">
						<button class="btn btn-success create-room"> Create </button>	
					</div>
				</div>
				<!-- <a href="room.php"><button class="btn btn-primary"> Go to your room</button> </a> -->
				<a href="logout.php"><button class="btn btn-danger">Logout</button> </a>
			</div>
		</div>
	</div>
	<script src="assets/js/main.js"></script>
</body>
</html>
