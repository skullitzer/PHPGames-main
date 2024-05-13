<?php

// $connectDatabase = connectDatabase();

$hostname = "localhost";
$username = "root";
$password = "";
// 1-CONNECT TO MYSQL SERVER
try {
    $connection = new mysqli($hostname, $username, $password);
} catch (mysqli_sql_exception $error) {
    // If the connection failed, display error message and stop the script
    die("Connection to MySQL failed! <br>" . $error);
}

// 2-SELECT THE DATABASE
try {
    $selectDBUsers = mysqli_select_db($connection, "kidsgames");
} catch (mysqli_sql_exception $error) {
    // If the selection failed, display error message and stop the script
    die("Connection to the Database failed!<br/> " . $error);
} 


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>History Table</title>
    <link rel="stylesheet" href="/PHPGames-main/public/assets/css/table.css">
</head>
<?php
        require_once '../../public/template/head.php'; 
        require_once '../../public/template/header.php';
    ?>  
<body>
    <div class="wrapper">
    <?php
        
        try {
            $sqlCode = "SELECT p.id, p.username, s.result, s.scoreTime 
                        FROM player p
                        INNER JOIN score s ON p.registrationOrder = s.registrationOrder";;
            $selectRecords = $connection->query($sqlCode);
            // Calculate the number of records (or rows) available
            $number_of_rows = $selectRecords->num_rows;
            // Use a loop to display the records one by one in an HTML table
            echo "<table>";
            echo "<tr>
                    <th>ID</th>
                    <th>Username</th>
                    <th>Result</th>
                    <th>Score Time</th>
                </tr>";
            for ($j = 0; $j < $number_of_rows; ++$j) {
                echo "<tr>";
                // Assign the records of each row to an associative array
                $each_row = $selectRecords->fetch_array(MYSQLI_ASSOC);
                // Display each record corresponding to each column
                echo "<td>" . $each_row['id'] . "</td>";
                echo "<td>" . $each_row['username'] . "</td>";
                echo "<td>" . $each_row['result'] . "</td>";
                echo "<td>" . $each_row['scoreTime'] . "</td>";
                echo "</tr>";
            }
            echo "</table>";
        } catch (mysqli_sql_exception $error) {
            // If the selection failed, display error message and stop the script
            die("Data selection from the Table failed!<br/>" . $error);
        }
    ?>
    </div>
</body>
</html>
