$( document ).ready(function() {
	$("#sam-login").click(function(){
		document.location.href = "./login.php";
	});
	$("#sam-logout").click(function(){
		document.location.href = "ws/logout.php";
	});
	$("#sam-login-tab").click(function(){
		document.getElementById("fw-container").style.backgroundImage="url(./images/bg_4.png)";
	});
	$("#sam-signup-tab").click(function(){
		document.getElementById("fw-container").style.backgroundImage="url(./images/bg_5.png)";
	});
	$("#demo-gotomypets").click(function(){
		//document.location.href = "./crud_mascota.php";
	});

	// LOGIN.PHP
	// ENTER -> SUBMIT
	var enterClick = document.getElementById("txt_pass");
	enterClick.addEventListener("keydown", function(event) {
		if (event.keyCode === 13) {
			console.log('sup?');
			document.getElementById("btnLogIn").click();
		}
	});
	// ENTER -> FOCUS PW INPUT
	var enterFocus = document.getElementById("txt_usu");
	enterFocus.addEventListener("keydown", function(event) {
		if (event.keyCode === 13) {
			console.log('focus pw');
			document.getElementById("txt_pass").value = "";
			document.getElementById("txt_pass").focus();
		}
	});
});