<?php
session_start();


// Initialize the game if it's a new session
if (!isset($_SESSION['level'])) {
    $_SESSION['level'] = 1;
}

// Generate random numbers for the game
$randomNumbers = array();
for ($i = 0; $i < 6; $i++) {
    $randomNumbers[] = rand(0, 100);
}
?>
<style>
    body {
        background-image: url('images/cats.jpg'); /* Update this with the actual path to your image */
        background-size: cover;
        background-position: center;
        background-attachment: fixed;
    }
</style>
<?php
require_once '../../public/template/head.php'; 
require_once '../../public/template/header.php'; 



/* Display the game form for level 1
echo "<h1>Level " . $_SESSION['level'] . "</h1>";
echo "<h2>Lives " . $_SESSION['lives']. "</h2>";
echo "<p>Arrange the following numbers in ascending order:</p>";
echo "<p>" . implode(", ", $randomNumbers) . "</p>";

// Display the form for user input
echo "<form method='post'>";
echo "<label for='user_input'>Your Numbers:</label>";
echo "<input type='text' id='user_input' name='user_input'>";
echo "<button type='submit'>Submit</button>";
echo "</form>";
*/

// Display the game form for level 1
echo "<title>Level 1</title>";
echo "<div style='background: rgba(255, 255, 255, 0.8); padding: 20px; border-radius: 10px; text-align: center;'>";
echo "<h1 style='color: #333; font-size: 2em; text-shadow: 1px 1px 2px rgba(0,0,0,0.7);'>Level " . $_SESSION['level'] . "</h1>";
echo "<h2 style='color: #555; font-size: 1.5em; text-shadow: 1px 1px 2px rgba(0,0,0,0.5);'>Lives " . $_SESSION['lives'] . "</h2>";
echo "<p style='font-size: 1.2em;'>Arrange the following numbers in ascending order:</p>";
echo "<p style='font-size: 1.2em; font-weight: bold;'>" . implode(", ", $randomNumbers) . "</p>";


// Display the form for user input
echo "<form method='post' style='margin-top: 20px;'>";
echo "<label for='user_input' style='display: block; font-size: 1.2em;'>Your Numbers:</label>";
echo "<input type='text' id='user_input' name='user_input' style='font-size: 1.2em; margin-bottom: 10px; width: 100%; padding: 5px;'>";
echo "<button type='submit' style='font-size: 1.2em; padding: 10px 20px; margin-top: 5px;'>Submit</button>";
echo "</form>";
echo "</div>";

require_once '../../public/template/footer.php'; 

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check user input and process accordingly
    $userInput = $_POST['user_input'];
    // Validate user input and check if it's correct
    if (validateUserInput($userInput, $randomNumbers)) {
        // User input is correct, move to the next level
        $_SESSION['level']++;
        header("Location: level2_form.php"); // Redirect to the next level
        exit();
    } else {
        // User input is incorrect
        echo "<p>Incorrect input. Please try again.</p>";
        
     // Decrease the number of lives
    $_SESSION['lives']--;
    // Check if the user has any lives left
    $noOflives = $_SESSION['lives'];
    if ($_SESSION['lives'] == 0) {

        echo "<script>         
        alert('Game Over!! You have used all the opportunities. Please try again with a new game');         
        window.location.href='game-form.php';       
        </script>";        
        exit();
        
    }
    else {
        echo "<script>        
         alert('Incorrect – Your numbers were not correctly arranged in ascending order.');        
         window.location.href='level1_form.php';       
         </script>";
    }
    }
}

// Function to validate user input
function validateUserInput($userInput, $randomNumbers) {
    // Split user input into an array and remove any whitespace
    $userNumbers = array_map('trim', explode(",", $userInput));
    
    // Remove any empty elements from the user input array
    $userNumbers = array_filter($userNumbers);
    
    // Check if the number of elements matches
    if (count($userNumbers) !== count($randomNumbers)) {
        return false;
    }
    
    // Convert user input to integers
    $userNumbers = array_map('intval', $userNumbers);
    
    // Check if each number in user input is greater than the previous one
    $prevNumber = -1;
    foreach ($userNumbers as $number) {
        if ($number < $prevNumber) {
            return false; // Input is not in ascending order
        }
        $prevNumber = $number;
    }
    
    return true; // Input is in ascending order
}

