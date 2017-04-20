<?php 
	session_start();
	if (!isset($_SESSION['logged_in']))
    	header("Location: index.php");
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
			<div class="col-xs-2 col-xs-offset-2 containers left-container text-center">
				<div class="panel-one">
					<div>
						Username
						<img class="img-responsive profile-avatar" src="https://scontent-arn2-1.xx.fbcdn.net/v/t1.0-9/11896180_1008851132488645_373543554735047172_n.jpg?oh=97ede1c71c529e5209a0650929e56def&oe=592B8476">
					</div>
					<div>
						<div>
							<button class="btn btn-default add-user">Add User</button>
							<div class="new-user"> 
								Add the new user : <input class="form-control" type="text" name="new-user"> 
							</div>
						</div>
						<div>
							<button class="btn btn-default edit-room">Room Settings</button>
							<div class="room-settings"> 
								<button class="btn btn-danger">Delete conversation</button>
							</div>
						</div>
					</div>
				</div>
				<div class="panel-two text-center">
					<div>Room Members
						<ul class="room-users">
							<li>BoBo <button class="btn btn-danger btn-xs">Kick</button></li> 
							<li>Caty <button class="btn btn-danger btn-xs">Kick</button></li>
							<li>Stefan <button class="btn btn-danger btn-xs">Kick</button></li>
							<li>RadaRada <button class="btn btn-danger btn-xs">Kick</button></li>
							<li>RadaRada <button class="btn btn-danger btn-xs">Kick</button></li>
							<li>RadaRada <button class="btn btn-danger btn-xs">Kick</button></li>
							<li>RadaRada <button class="btn btn-danger btn-xs">Kick</button></li>
							<li>RadaRada <button class="btn btn-danger btn-xs">Kick</button></li>
							<li>RadaRada <button class="btn btn-danger btn-xs">Kick</button></li>
							<li>RadaRada <button class="btn btn-danger btn-xs">Kick</button></li>
							<li>RadaRada <button class="btn btn-danger btn-xs">Kick</button></li>

						</ul>
					</div>
				</div>


			</div>
			<div class="col-xs-6 containers right-container">
				<h2>Room conversation</h2>
				<div class="chat">
					<div class="messages-container">
						<div class="message-box">
							<div>
								<img class="img-responsive message-avatar" src="https://scontent-arn2-1.xx.fbcdn.net/v/t1.0-9/11896180_1008851132488645_373543554735047172_n.jpg?oh=97ede1c71c529e5209a0650929e56def&oe=592B8476">
							</div>
							<div>
								<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec non urna nec ligula suscipit scelerisque. Phasellus ex augue, bibendum eu consectetur a, ultrices ut leo. Etiam porta, orci sit amet viverra consequat, erat diam tincidunt leo, sed hendrerit dolor nunc quis ipsum. Aliquam sed hendrerit purus. Interdum et malesuada fames ac ante ipsum primis in faucibus. Duis ac malesuada mi. Etiam pellentesque erat nulla, id facilisis dolor faucibus eget. Pellentesque sed lobortis ex. Suspendisse interdum facilisis orci non feugiat. Fusce molestie elementum posuere. Mauris in lectus quis orci vehicula varius a nec massa. Nulla eu elementum massa.</p>
							</div>
						</div>

						<div class="message-box second-message">
							<div>
								<img class="img-responsive message-avatar" src="https://scontent-arn2-1.xx.fbcdn.net/v/t1.0-1/15697827_1410961632269833_1915917803688311831_n.jpg?oh=a6494de17146d58f39ab962c0a4de25f&oe=59627540">
							</div>
							<div>
								<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec non urna nec ligula suscipit scelerisque. Phasellus ex augue, bibendum eu consectetur a, ultrices ut leo. Etiam porta, orci sit amet viverra consequat, erat diam tincidunt leo, sed hendrerit dolor nunc quis ipsum. Aliquam sed hendrerit purus. Interdum et malesuada fames ac ante ipsum primis in faucibus. Duis ac malesuada mi. Etiam pellentesque erat nulla, id facilisis dolor faucibus eget. Pellentesque sed lobortis ex. Suspendisse interdum facilisis orci non feugiat. Fusce molestie elementum posuere. Mauris in lectus quis orci vehicula varius a nec massa. Nulla eu elementum massa.</p>
							</div>
						</div>

						<div class="message-box third-message">
							<div>
								<img class="img-responsive message-avatar" src="https://scontent-arn2-1.xx.fbcdn.net/v/t1.0-9/12239618_891378390945998_2731618798855523386_n.jpg?oh=ab62db8bc58c703ad7d72a86dfb9f70a&oe=59592E6B">
							</div>
							<div>
								<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec non urna nec ligula suscipit scelerisque. Phasellus ex augue, bibendum eu consectetur a, ultrices ut leo. Etiam porta, orci sit amet viverra consequat, erat diam tincidunt leo, sed hendrerit dolor nunc quis ipsum. Aliquam sed hendrerit purus. Interdum et malesuada fames ac ante ipsum primis in faucibus. Duis ac malesuada mi. Etiam pellentesque erat nulla, id facilisis dolor faucibus eget. Pellentesque sed lobortis ex. Suspendisse interdum facilisis orci non feugiat. Fusce molestie elementum posuere. Mauris in lectus quis orci vehicula varius a nec massa. Nulla eu elementum massa.</p>
							</div>
						</div>

						<div class="message-box">
							<div>
								<img class="img-responsive message-avatar" src="https://scontent-arn2-1.xx.fbcdn.net/v/t1.0-9/11896180_1008851132488645_373543554735047172_n.jpg?oh=97ede1c71c529e5209a0650929e56def&oe=592B8476">
							</div>
							<div>
								<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec non urna nec ligula suscipit scelerisque. Phasellus ex augue, bibendum eu consectetur a, ultrices ut leo. Etiam porta, orci sit amet viverra consequat, erat diam tincidunt leo, sed hendrerit dolor nunc quis ipsum. Aliquam sed hendrerit purus. Interdum et malesuada fames ac ante ipsum primis in faucibus. Duis ac malesuada mi. Etiam pellentesque erat nulla, id facilisis dolor faucibus eget. Pellentesque sed lobortis ex. Suspendisse interdum facilisis orci non feugiat. Fusce molestie elementum posuere. Mauris in lectus quis orci vehicula varius a nec massa. Nulla eu elementum massa.</p>
							</div>
						</div>

						<div class="message-box second-message">
							<div>
								<img class="img-responsive message-avatar" src="https://scontent-arn2-1.xx.fbcdn.net/v/t1.0-1/15697827_1410961632269833_1915917803688311831_n.jpg?oh=a6494de17146d58f39ab962c0a4de25f&oe=59627540">
							</div>
							<div>
								<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec non urna nec ligula suscipit scelerisque. Phasellus ex augue, bibendum eu consectetur a, ultrices ut leo. Etiam porta, orci sit amet viverra consequat, erat diam tincidunt leo, sed hendrerit dolor nunc quis ipsum. Aliquam sed hendrerit purus. Interdum et malesuada fames ac ante ipsum primis in faucibus. Duis ac malesuada mi. Etiam pellentesque erat nulla, id facilisis dolor faucibus eget. Pellentesque sed lobortis ex. Suspendisse interdum facilisis orci non feugiat. Fusce molestie elementum posuere. Mauris in lectus quis orci vehicula varius a nec massa. Nulla eu elementum massa.</p>
							</div>
						</div>
						</div>
					</div>
					<div class="input-container">
						<input type="text" class="form-control input-message pull-left" placeholder="Enter your message...">
						<button class="btn btn-info btn-send pull-right" type="button">Send</button>
					</div>
			</div>
		</div>
	</div>
</body>
</html>
