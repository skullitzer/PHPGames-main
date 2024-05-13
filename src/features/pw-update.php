<?php

require_once "../../db/Database.php";
require_once "../../db/Select.php";
require_once "../../db/Update.php";
require_once "../../config.php";

session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['action']) && $_POST['action'] == 'change_password') {
    $username = trim($_POST['username']);
    $newPassword = trim($_POST['password']);
    $confirmPassword = trim($_POST['confirmPassword']);


    if ($newPassword !== $confirmPassword) {
        $_SESSION['message'] = "Passwords do not match.";
        header('Location: \PHPGames-main\public\form\pw-update-form.php');
        exit;
    }

    if (strlen($newPassword) < 8) {
        $_SESSION['message'] = "Password must contain at least 8 characters.";
        header('Location: \PHPGames-main\public\form\pw-update-form.php');
        exit;
    }

    $database = new Database();
    $conn = $database->getConnection(); 

    $select = new Select('selectKey', $username); 
    $result = $select->selectFromTAB();

    if (empty($result)) {
        $_SESSION['message'] = "User not found.";
        header('Location: \PHPGames-main\public\form\pw-update-form.php');
        exit;
    }
    $registrationOrder = $result['row1']['registrationOrder'] ?? null;

    if ($registrationOrder) {
        $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);

        $update = new Update('updateCode', $hashedPassword, $registrationOrder);
        

        $_SESSION['message'] = "Password successfully updated.";
        header("Location: /PHPGames-main/public/form/pw-update-form.php"); 
        exit;
    } else {
        $_SESSION['message'] = "An unexpected error occurred.";
        header('Location: \PHPGames-main\public\form\pw-update-form.php');
        exit;
    }
}
