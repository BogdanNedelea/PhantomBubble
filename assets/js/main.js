$('#submit').click(function(){
	login();
});

$('#password').keypress(function (e) {
	var key = e.which;
	if(key == 13)  // the enter key code
  	{	
  		login();
	}
});  


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