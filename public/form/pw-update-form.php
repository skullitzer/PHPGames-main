<?php
require_once '../../src/features/session-timeout.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
<link rel="stylesheet" href="/PHPGames-main/public/assets/css/design.css?<?php echo time(); ?>">
    <script type = "text/javascript" src = "/PHPGames-main/public/assets/js/signup-onkeyup/fname-ajax.js"></script>
    <script type = "text/javascript" src = "/PHPGames-main/public/assets/js/signup-onkeyup/lname-ajax.js"></script>
    <script type = "text/javascript" src = "/PHPGames-main/public/assets/js/signup-onkeyup/uname-ajax.js"></script>
    <script type = "text/javascript" src = "/PHPGames-main/public/assets/js/signup-onkeyup/pcode1-ajax.js"></script>
    <script type = "text/javascript" src = "/PHPGames-main/public/assets/js/signup-onkeyup/pcode2-ajax.js"></script>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Document</title>
</head>
<body>

<form id="signupForm" method="post" action="../../src/features/pw-update.php">
	<div class="wrapper">
		<h1>Change Password</h1>

		<?php 
if (!empty($_SESSION['message'])) {
    echo "<div id='signinError'>" . $_SESSION['message'] . "<br></div>";
    unset($_SESSION['message']);  // Correcting the session variable to unset
}
?>
		

		<div class="input-box">
		<input type="text" id="username" name="username" placeholder="Username"
			required onkeyup="validateUserName()">
		<div class="uname" id="usernameMessage"></div>
		</div>


		<div class="input-box">
		<input type="password" id="password" name="password" placeholder="New Password"required onkeyup="validatePassword()">
		<div class="pcode1" id="passwordMessage"></div>
		</div>
		<div class="input-box">
		<input type="password" id="confirmPassword" name="confirmPassword" placeholder="Confirm Password"required onkeyup="validateConfirmPassword()">
		<div id="confirmPasswordMessage"></div>
		</div>
		<button type="submit" class="btn" name="action" value="change_password">Edit</button>
	
		<div class="input-box">
		<button type="button" class="btn" onclick="window.location.href='signin-form.php';">login</button>
		</div>
		<p>Do you want to <a  href="../../src/features/signout.php">signout?</a></p>
	</div>

</form>
</body>
</html>