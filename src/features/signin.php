<?php
session_start();  
require_once '../../db/Database.php';
require_once '../../db/Select.php';
require_once '../../config.php';


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';

    $select = new Select('selectKey', $username);
    $result = $select->selectFromTAB();

   
    
    if (!empty($result) && isset($result['row1']['registrationOrder'])) {
        $registrationOrder = $result['row1']['registrationOrder'];

        $selectPass = new Select('selectCode', '', $registrationOrder);
        $resultPass = $selectPass->selectFromTAB();


        if (!empty($resultPass) && isset($resultPass['row1']['passCode'])) {
            $hashedPassword = $resultPass['row1']['passCode'];
            if (password_verify($password, $hashedPassword)) {
            
                header('Location: /PHPGames-main/HomePage.php');
                exit;
            } else {
                $_SESSION['signin-errorMessages'] = ["Sorry, the username or password is incorrect!"];
            }
        } else {
            $_SESSION['signin-errorMessages'] = ["Password record not found."];
        }
    } else {
        $_SESSION['signin-errorMessages'] = ["An unexpected error occurred. Please try again."];
    }


    header('Location: /PHPGames-main/HomePage.php');
    exit;
}
