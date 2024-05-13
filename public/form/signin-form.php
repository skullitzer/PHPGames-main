<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/PHPGames-main/public/assets/css/design.css">
    <title>Sign In</title>
</head>
<body>
<form id="signinForm" method="post" action="../../src/features/signin.php">  
        <div class="wrapper">
            <h2>Sign In</h2>

			<?php session_start(); // Start the session at the very beginning 

            if (isset($_SESSION['signin-errorMessages']) && count($_SESSION['signin-errorMessages']) > 0) {
                echo "<div id='signinError'>";
            foreach ($_SESSION['signin-errorMessages'] as $message) {
                echo ($message) . '<br>';
            }
                echo "</div>";

            // Clear the error messages from session after displaying them
                unset($_SESSION['signin-errorMessages']);
            }
            ?>
            
			<div class="input-box">
                <input type="text" id="username" name="username" placeholder="Username"><br>
            </div>
            <div class="input-box">
                <input type="password" id="password" name="password" placeholder="Password"><br>
            </div>
            <div class="input-box">
                <button type="submit" class="btn">Login</button>
            </div>
            <div class="input-box">
                <button type="button" class="btn" onclick="window.location.href='signup-form.php';">Register</button>
            </div>
            <p>Forgot your password? <a href="pw-update-form.php">Change it.</a></p>
        </div>
    </form>
</body>
</html>
</body>
</html>






