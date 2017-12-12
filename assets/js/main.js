$('#register').click(function(){
	signup();
});

$('#submit').click(function(){
	login();
});

$('.enter-room').click(function(e){
	$roomId = (e.target.id);
	accessRoom($roomId);
});


$('#password').keypress(function (e) {
	var key = e.which;
	if(key == 13)  // the enter key code
  	{	
  		login();
	}
});  

$('.create-room').click(function(){
	createRoom();
});

$('.kick-btn').click(function(e){
	$userId = (e.target.id);
	kickUser($userId);
});

$('.leave-btn').click(function(e){
	$userId = (e.target.id);
	leaveRoom($userId);
});


$('.btn-send').click(function () {
	$message = $('.input-message').val();
  	sendMessage($message);
});
$('.input-message').keypress(function (e){
	var key = e.which;
	if(key == 13)  // the enter key code
	{
		$('.btn-send').click();
	}
});


$('.delete-room').click(function (e) {
	$roomId = (e.target.id);
	deleteRoom($roomId);
});  

$('#new-user').keypress(function (e) {
	var key = e.which;
	if(key == 13)  // the enter key code
	{
		$newUser =  $('#new-user').val();
		addUser($newUser);
	}
}); 


function addUser(newUser){
	$.ajax({
	    type: "POST",
	    url: 'room_actions.php',
	    dataType: 'json',
	    data: {
	    	newUser: newUser
	    }
	}).done(function (response) {
		if (response === "Success") {
			swal({
			  title: "Success!",
			  text: "The user was added to your room !",
			  type: "success"
			},function(){
				setTimeout(function(){
				   location.replace("/room.php");
				}, 1000);
			});
		} else if (response === "Error"){
			swal({
			  title: "Error !",
			  text: "There's been a problem. Please try again !",
			  type: "error"
			},function(){
				setTimeout(function(){
				   location.replace("/room.php");
				}, 1000);
			});
		} else if (response === "No_user"){
			swal({
			  title: "Warning !",
			  text: "The user with that username doesn't exists !",
			  type: "warning"
			});
		} else if (response === "Already"){
			swal({
			  title: "Warning !",
			  text: "User already in the room !",
			  type: "warning"
			});
		}
	}).fail(function(data) {
		console.log("Action not allowed !");
	});
}


function deleteRoom(roomId){
	$.ajax({
	    type: "POST",
	    url: 'room_actions.php',
	    dataType: 'json',
	    data: {
	    	roomId: roomId
	    }
	}).done(function (response) {
		if (response === "Success") {
			swal({
			  title: "Success!",
			  text: "The room was successfully deleted !",
			  type: "success"
			},function(){
				setTimeout(function(){
				   location.replace("/dashboard.php");
				}, 1000);
			});
		} else if (response === "Error"){
			swal({
			  title: "Error !",
			  text: "There's been a problem. Please try again !",
			  type: "error"
			},function(){
				setTimeout(function(){
				   location.replace("/room.php");
				}, 1000);
			});
		}
	}).fail(function(data) {
		console.log("Action not allowed !");
	});
}


function sendMessage(message){
	$.ajax({
	    type: "POST",
	    url: 'room_actions.php',
	    dataType: 'json',
	    data: {
	    	message: message
	    }
	}).done(function (response) {
	   	if (response === "Success") {
	   		// $(".messages-container").append('<div class=\"message-box\">'+message+'</div>');
	   		// $(".input-message").val('');
			setTimeout(function(){
			   location.replace("/room.php");
			}, 100);
		} else if (response === "Error"){
			swal({
			  title: "Error !",
			  text: "There's been a problem. Please try again !",
			  type: "error"
			},function(){
				setTimeout(function(){
				   location.replace("/room.php");
				}, 100);
			});
		}
	}).fail(function(data) {
		console.log("Action not allowed !");
	});
}

function leaveRoom(userId) {
	$.ajax({
	    type: "POST",
	    url: 'room_actions.php',
	    dataType: 'json',
	    data: {
	    	action:'leave_room',
	    	userId: userId
	    }
	}).done(function (response) {
	   	if (response === "Success") {
			swal({
			  title: "Success!",
			  text: "You just left the room !",
			  type: "success"
			},function(){
				setTimeout(function(){
				   location.replace("/dashboard.php");
				}, 1000);
			});
		} else if (response === "Error"){
			swal({
			  title: "Error !",
			  text: "There's been a problem. Please try again !",
			  type: "error"
			},function(){
				setTimeout(function(){
				   location.replace("/room.php");
				}, 1000);
			});
		}
	}).fail(function(data) {
		console.log("Action not allowed !");
	});
}



function kickUser(userId){
	$.ajax({
	    type: "POST",
	    url: 'room_actions.php',
	    dataType: 'json',
	    data: {
	    	action:'kick_user',
	    	userId: userId
	    }
	}).done(function (response) {
	   	if (response === "Success") {
			swal({
			  title: "Success!",
			  text: "The user was kicked with success!",
			  type: "success"
			},function(){
				setTimeout(function(){
				   location.replace("/room.php");
				}, 1000);
			});
		} else if (response === "Error"){
			swal({
			  title: "Error !",
			  text: "There's been a problem. Please try again !",
			  type: "error"
			},function(){
				setTimeout(function(){
				   location.replace("/room.php");
				}, 1000);
			});
		}
	}).fail(function(data) {
		console.log("Action not allowed !");
	});
}

function createRoom() {
	$.ajax({
	    type: "POST",
	    url: 'room_access.php',
	    dataType: 'json',
	    data: { 
	    	roomName: $('#room-name').val()
	    }
	}).done(function (response) {
	   	if (response === "Success") {
			swal({
			  title: "Success!",
			  text: "Your room was successfully created !",
			  type: "success"
			},function(){
				setTimeout(function(){
				   location.replace("/room.php");
				}, 1000);
			});
		} else if(response === "Duplicate") {
			swal({
			  title: "Already Used",
			  text: "Room name already used !",
			  type: "warning"
			});
		} 
	}).fail(function(data) {
		console.log("Action not allowed !");
	});
}

function accessRoom(roomId) {
	$.ajax({
	    type: "POST",
	    url: 'room_access.php',
	    dataType: 'json',
	    data: { 
	    	roomId: roomId
	    }
	}).done(function(response){
	   	if (response === "Advance") {
			swal({
			  title: "You exist in this room",
			  text: "In few second you'll join the room !",
			  type: "success"
			},function(){
				setTimeout(function(){
				   location.replace("/room.php");
				}, 1000);
			});
		} else if (response === "Invalid_room") {
			console.log("the response  is ", response);
			swal({
			  title: "Wrong!",
			  text: "You wanted to acess a room you dont belong to !",
			  type: "warning",
			  confirmButtonText: "Ok"
			});
		} else {
		}
	}).fail(function(data) {
		console.log("Action not allowed !");
	});
}

function signup() {
	$.ajax({
	    type: "POST",
	    url: 'register.php',
	    dataType: 'json',
	    data: { 
	    	newuser: $('#newuser').val(), 
	    	newpass: $('#newpass').val()
	    }
	}).done(function(response){
	   	if (response === "Account_Created") {
			swal({
			  title: "Account was created!",
			  text: "Your account was successfully created. We'll redirect you to our login page.",
			  type: "success"
			},function(){
				setTimeout(function(){
				   location.replace("/index.php");
				}, 1000);
			});
		} else if(response === "Duplicate") {
			swal({
			  title: "Already Used",
			  text: "Username already exists!",
			  type: "warning"
			});
		} 
		else {
			console.log("nu merge responseul");
		}
	}).fail(function(data) {
		console.log("Failed somewhere");
	});
}


function login() {
	$.ajax({
	    type: "POST",
	    url: 'login.php',
	    dataType: 'json',
	    data: { 
	    	user: $('#username').val(), 
	    	pass: $('#password').val()
	    }
	}).done(function (response) {
	   	if (response === "Success") {
			swal({
			  title: "Success!",
			  text: "You have successfully logged in.",
			  type: "success"
			},function(){
				setTimeout(function(){
				   location.replace("/dashboard.php");
				}, 1000);
			});
		}
		else if(response === "Wrong_password") {
			swal({
			  title: "Wrong!",
			  text: "You introduced a wrong password!",
			  type: "warning",
			  confirmButtonText: "Ok"
			});
		}
		else if (response === "Account_locked") {
			swal({
			  title: "Wrong!",
			  text: "Your account will be locked for 5 minutes, try again later !",
			  type: "warning",
			  confirmButtonText: "Ok"
			});
		}
		else if(response === "Locked"){
			swal({
			  title: "Locked!",
			  text: "You failed to login too many times, you have to wait !",
			  type: "error",
			  confirmButtonText: "Ok"
			});
		}
		else if(response === "Invalid_information"){
			swal({
			  title: "Invalid Information!",
			  text: "The username or password does not match any account!",
			  type: "error",
			  confirmButtonText: "Ok"
			});
		}
	}).fail(function(data) {
		console.log("Failed somewhere");
	});
}
