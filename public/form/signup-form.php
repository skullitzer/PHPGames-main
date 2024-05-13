
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Sign Up</title>
    <link rel="stylesheet" href="/PHPGames-main/public/assets/css/design.css?<?php echo time(); ?>">
    <script type = "text/javascript" src = "/PHPGames-main/public/assets/js/signup-onkeyup/fname-ajax.js"></script>
    <script type = "text/javascript" src = "/PHPGames-main/public/assets/js/signup-onkeyup/lname-ajax.js"></script>
    <script type = "text/javascript" src = "/PHPGames-main/public/assets/js/signup-onkeyup/uname-ajax.js"></script>
    <script type = "text/javascript" src = "/PHPGames-main/public/assets/js/signup-onkeyup/pcode1-ajax.js"></script>
    <script type = "text/javascript" src = "/PHPGames-main/public/assets/js/signup-onkeyup/pcode2-ajax.js"></script>

</head>
<body>

    <form id="signupForm" method="post" action="../../src/features/signup.php">

       
        <!--
        <label for="firstName">First Name:</label>
        <input type="text" id="firstName" name="firstName" onkeyup="validateFirstName()">
        <div class="fname" id="firstNameMessage"></div>

        <label for="lastName">Last Name:</label>
        <input type="text" id="lastName" name="lastName"  onkeyup="validateLastName()">
        <div class="lname" id="lastNameMessage"></div>

        <label for="username">Username:</label>
        <input type="text" id="username" name="username" onkeyup="validateUserName()">
        <div class="uname" id="usernameMessage"></div>

        <label for="password">Password:</label>
        <input type="password" id="password" name="password"  onkeyup="validatePassword()">
        <div class="pcode1" id="passwordMessage"></div>

        <label for="confirmPassword">Confirm Password:</label>
        <input class="pcode2" type="password" id="confirmPassword" name="confirmPassword" onkeyup="validateConfirmPassword(); validateConfirmPassword()">
        <div id="confirmPasswordMessage"></div>

        <button type="submit" name="action" value="register">Register</button>
        <button type="button" onclick="location.href='signin-form.php';">login</button>
        -->
        
        <div class="wrapper">
        <form action="">
            <h1>Sign Up</h1>

            <?php session_start(); // Start the session at the very beginning 

            if (isset($_SESSION['signup-errorMessages']) && count($_SESSION['signup-errorMessages']) > 0) {
                echo "<div id='signinError'>";
            foreach ($_SESSION['signup-errorMessages'] as $message) {
                echo ($message) . '<br>';
            }
                echo "</div>";

            // Clear the error messages from session after displaying them
                unset($_SESSION['signup-errorMessages']);
            }
            ?>
            <div class="input-box">
            <input type="text" id="firstName" name="firstName" placeholder="First Name"
            required onkeyup="validateFirstName()">
            <div class="fname" id="firstNameMessage"></div>
            </div>
            <div class="input-box">
            <input type="text" id="lastName" name="lastName" placeholder="Last Name"
				required onkeyup="validateLastName()">
            <div class="lname" id="lastNameMessage"></div>
            </div>
            <div class="input-box">
            <input type="text" id="username" name="username" placeholder="Username"
				required onkeyup="validateUserName()">
            <div class="uname" id="usernameMessage"></div>
            </div>
            <div class="input-box">
            <input type="password" id="password" name="password" placeholder="Password"
				required onkeyup="validatePassword()">
            <div class="pcode1" id="passwordMessage"></div>
            </div>
            <div class="input-box">
            <input type="password" id="confirmPassword" name="confirmPassword" placeholder="Confirm Password"
				required onkeyup="validateConfirmPassword()">
            <div id="confirmPasswordMessage"></div>
            </div>
            <button type="submit" class="btn" name="action" value="register">Register</button>
            
            <div class="input-box">
    		    <button type="button" class="btn" onclick="window.location.href='signin-form.php';">login</button>
			</div>

        </form>
    </div>
    </div>
    
    

    </form>
</body>
</html>
