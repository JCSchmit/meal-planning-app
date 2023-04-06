<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();
$servername = "localhost";
$username = "ics325sp235003";
$password = "8989";
$dbname = "ics325sp235003";

// Database connection details
// $servername = "localhost";
// $username = "root";
// $password = "";
// // $dbname = "Mtest";
// $dbname = "Mealplanningapp";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_POST['submit'])) {
    $user_email = mysqli_real_escape_string($conn, $_POST['username-email']);
    $user_password = mysqli_real_escape_string($conn, $_POST['password']);


    $sql = "SELECT * FROM user WHERE user_email='$user_email' AND password='$user_password'";



    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $_SESSION['loggedin'] = true;
        header('Location: addrecipe.html');
        exit();
    } else {
        header('Location: Mealpreplogin.php?error=1');
        exit();
    }
}

$conn->close();
