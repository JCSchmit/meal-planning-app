<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
// Connect to the database

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "mealplanningapp_db";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
function isValidPassword($password)
{
    $commonPasswords = [
        'password', '123456', '123456789', '12345678', '12345', '1234567', '1234567890', 'qwerty', 'abc123'
    ];

    if (strlen($password) < 8 || is_numeric($password) || in_array($password, $commonPasswords)) {
        return false;
    }
    return true;
}
// Get data from the form and apply filters
$user_name = filter_var($_POST['username'], FILTER_SANITIZE_STRING);
$user_email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
$user_password = filter_var($_POST['password'], FILTER_SANITIZE_STRING);
$confirm_password = filter_var($_POST['confirm_password'], FILTER_SANITIZE_STRING);
$create_date = date('Y-m-d');

// Validate email
if (!filter_var($user_email, FILTER_VALIDATE_EMAIL)) {
    echo "<script>
        alert('Invalid email address!');
        window.location.href = 'createAccount.html';
    </script>";
    exit();
}

// Check if passwords match
if ($user_password != $confirm_password) {
    echo "<script>
        alert('Passwords do not match!');
        window.location.href = 'createAccount.html';
    </script>";
    exit();
}

// Check if password is valid
if (!isValidPassword($user_password)) {
    echo "<script>
        alert('Invalid password! Please make sure it meets the requirements.');
        window.location.href = 'createAccount.html';
    </script>";
    exit();
}
// Hash the password before storing it
$hashed_password = password_hash($user_password, PASSWORD_DEFAULT);

// Insert data into the user table
$sql = "INSERT INTO user (user_email, password, create_date) VALUES (?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("sss", $user_email, $hashed_password, $create_date);
$result = $stmt->execute();


if ($result) {
    echo "<script>
        alert('Account created successfully. Please login.');
        window.location.href = 'mealpreplogin.php';
    </script>";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$stmt->close();
$conn->close();
