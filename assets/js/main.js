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

$('.input-message').keypress(function (e){
	var key = e.which;
	if(key == 13)  // the enter key code
	{
		$('.btn-send').click();
	}
});

$('.btn-send').click(function () {
	$message = $('.input-message').val();
  	sendMessage($message);
});

function sendMessage(message){
	$.ajax({
	    type: "POST",
	    url: 'room_actions.php',
	    dataType: 'json',
	    data: {
	    	message: message
	    }
	}).done(function (response) {
		console.log("The response is", response);
	   	if (response === "Success") {
	   		$(".message-box").append('<div>'+response+'</div>'); 
	   		
	   		
			// setTimeout(function(){
			//    location.replace("/PhantomBubble/room.php");
			// }, 100);
		} else if (response === "Error"){
			swal({
			  title: "Error !",
			  text: "There's been a problem. Please try again !",
			  type: "error"
			},function(){
				setTimeout(function(){
				   location.replace("/PhantomBubble/room.php");
				}, 100);
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
				   location.replace("/PhantomBubble/room.php");
				}, 1000);
			});
		} else if (response === "Error"){
			swal({
			  title: "Error !",
			  text: "There's been a problem. Please try again !",
			  type: "error"
			},function(){
				setTimeout(function(){
				   location.replace("/PhantomBubble/room.php");
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
   		console.log("the response  is ", response);
	   	if (response === "Success") {
			swal({
			  title: "Success!",
			  text: "Your room was successfully created !",
			  type: "success"
			},function(){
				setTimeout(function(){
				   location.replace("/PhantomBubble/room.php");
				}, 1000);
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
				   location.replace("/PhantomBubble/room.php");
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
				   location.replace("/PhantomBubble/index.php");
				}, 1000);
			});
		} else {
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
				   location.replace("/PhantomBubble/dashboard.php");
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
