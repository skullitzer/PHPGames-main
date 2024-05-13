<?php
if (!isset($_SESSION)){
    //Redirect to the login form
    //header('Location: signin-form.php'); 
    header('Location: /PHPGames-main/public/form/signin-form.php'); 
}
else {
    //Redirect to the appropriate game form level
    header('Location: /PHPGames-main/public/form/game-form.php');
}
