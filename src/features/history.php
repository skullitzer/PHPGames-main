<?php
// Start session
session_start();

// Check if user is logged in, redirect to login page if not
if (!isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit();
}

// Include database configuration
require_once 'db_config.php';

// Check if the game_history table already exists
$table_name = 'game_history';
$sql_check_table = "SHOW TABLES LIKE '$table_name'";
$result_check_table = mysqli_query($conn, $sql_check_table);

if (mysqli_num_rows($result_check_table) == 0) {
    // Table doesn't exist, create it
    $sql_create_table = "CREATE TABLE $table_name (
        id INT AUTO_INCREMENT PRIMARY KEY,
        user_id INT,
        outcome VARCHAR(50),
        lives_used INT,
        date_time DATETIME
    )";
    
    if (mysqli_query($conn, $sql_create_table)) {
        echo "Table $table_name created successfully.";
    } else {
        echo "Error creating table: " . mysqli_error($conn);
    }
} else {
    echo "Table $table_name already exists.";
}
?>
