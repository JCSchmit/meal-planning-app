<?php
// Connect to the database
$servername = "localhost";
$username = "ics325sp235003";
$password = "8989";
$dbname = "ics325sp235003";
// $servername = "localhost";
// $username = "root";
// $password = "";
// //  $dbname = "Mtest";
// $dbname = "Mealplanningapp";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get data from the form
$user_name = $_POST['username'];
$user_email = $_POST['email'];
$user_password = $_POST['password'];
$confirm_password = $_POST['confirm_password'];
$create_date = date('Y-m-d');

// Check if passwords match
if ($user_password != $confirm_password) {
    echo "Passwords do not match!";
    exit();
}

// Insert data into the user table
$sql = "INSERT INTO user (user_email, password, create_date) VALUES (?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("sss", $user_email, $user_password, $create_date);
$result = $stmt->execute();


if ($result) {
    echo "<script>
        alert('Account created successfully Please Login');
        window.location.href = 'mealpreplogin.php';
    </script>";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$stmt->close();
$conn->close();
