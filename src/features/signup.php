<?php

require_once "../../db/Database.php"; 
require_once "../../db/Insert.php";
require_once "../../config.php"; 
require_once "../../db/Select.php";

session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['action']) && $_POST['action'] == 'register') {
    $firstName = trim($_POST['firstName']);
    $lastName = trim($_POST['lastName']);
    $username = trim($_POST['username']);
    $password = trim($_POST['password']); 
    $confirmPassword = trim($_POST['confirmPassword']);
    $registrationTime = date('Y-m-d H:i:s'); 

    $isValid = true;
    $errorMessages = [];

    if (empty($firstName) || empty($lastName) || empty($username) || empty($password) || empty($confirmPassword)) {
        $isValid = false;
        $errorMessages[] = "All fields are required.";
    }

    if (!preg_match("/^[a-zA-Z]/", $firstName) || !preg_match("/^[a-zA-Z]/", $lastName) || !preg_match("/^[a-zA-Z]/", $username)) {
        $isValid = false;
        $errorMessages[] = "First Name, Last Name, and Username must begin with a letter.";
    }

    if (strlen($username) < 8){
        $isValid = false;
        $errorMessages[] = "Username must contain at least 8 characters.";
    }


    if (strlen($password) < 8) {
        $isValid = false;
        $errorMessages[] = "Password must contain at least 8 characters.";
    }


    if ($password !== $confirmPassword) {
        $isValid = false;
        $errorMessages[] = "Passwords do not match.";
    }

    // Create a Select object to check if the username already exists
    $select = new Select('selectKey', $username);
    $result = $select->selectFromTAB();

    if (!empty($result)) {
        // Username already exists
        $isValid = false;
        $errorMessages[] = "Username is already taken.";
    }


    $database = new Database();
    $conn = $database->getConnection();

   if ($isValid) {
    new Insert('insertIdentity', $firstName, $lastName, $username, $registrationTime);
    
    $stmt = $conn->prepare("SELECT registrationOrder FROM player WHERE userName = ? ORDER BY registrationOrder DESC LIMIT 1");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();
    
        if ($result && $row = $result->fetch_assoc()) {
            $registrationOrder = $row['registrationOrder'];
        
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

            new Insert('insertCredentials', '', '', '', '', $hashedPassword, $registrationOrder);

            $_SESSION['message'] = "Registration successful!";
            $_SESSION['message_type'] = 'success';

            header('Location: ../../index.php');
            exit;
        } else {
            $_SESSION['message'] = "An error occurred during registration.";
            $_SESSION['message_type'] = 'error';
            header('Location: ../../public/form/signup-form.php');
            exit;
        }
    }else{
        $_SESSION['signup-errorMessages'] = $errorMessages;

        header('Location: ../../public/form/signup-form.php');
        exit();

    }

}   
