<!DOCTYPE html>
<style>
body {
    font-family: Arial, sans-serif;
    margin: 0;
    padding: 0;
    /* background-image: url("img/mealprep.jpg"); */
    background-size: cover;
    /* background-color: #3367D6; */
}

header {
    background-color: #F9A826;
    text-align: center;
    padding: 10px;
}

h1 {
    font-size: 2em;
}

form {
    display: inline-block;
    text-align: left;
}

label {
    display: block;
    margin-bottom: 10px;
}

input[type="text"],
input[type="password"] {
    padding: 10px;
    font-size: 1em;
    border: 1px solid #ccc;
    border-radius: 5px;
    margin-bottom: 20px;
    width: 100%;
}

/* button[type="submit"] {
    padding: 10px;
    background-color: #F9A826;
    color: #fff;
    border: none;
    border-radius: 5px;
    font-size: 1em;
    cursor: pointer;
}

button[type="submit"]:hover {
    background-color: #FDE68A;
} */

button[type="submit"],
button[type="button"] {
    padding: 10px;
    background-color: #F9A826;
    color: #fff;
    border: none;
    border-radius: 5px;
    font-size: 1em;
    cursor: pointer;
}

button[type="submit"]:hover,
button[type="button"]:hover {
    background-color: #FFD580;
}

a {
    color: #FDE68A;
    text-decoration: none;
}

footer {
    background-color: #F9A826;
    padding: 5px;
    text-align: center;
    position: absolute;
    bottom: 0;
    width: 100%;
}

main {
    flex: 1;
    /* Make the main element stretch to fill the remaining space */
    padding: 20px;
    text-align: center;
}
</style>
<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();

// Database connection details
$servername = "localhost";
$username = "ics325sp235003";
$password = "8989";
$dbname = "ics325sp235003";
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
    $new_password = mysqli_real_escape_string($conn, $_POST['new-password']);



    $sql = "UPDATE user SET password='$new_password' WHERE user_email='$user_email'";
    $result = $conn->query($sql);

    // if ($conn->affected_rows > 0) {
    //     header('Location: Mealpreplogin.php?password_reset=1');
    // } else {
    //     header('Location: resetPassword.php?error=1');
    // }
    if ($conn->affected_rows > 0) {
        echo "<script>
            alert('Password created successfully');
            window.location.href = 'mealpreplogin.php'; 
        </script>";
    } else {
        echo "<script>
            alert('Failed to create password. Please try again.');
            window.location.href = 'resetPassword.php?error=1';
        </script>";
    }
}

$conn->close();
?>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700&display=swap" rel="stylesheet">
    <!-- <title>Meal Planning App - Login</title> -->
    <link href="meal_planning_app.css" rel="stylesheet">
</head>
<header>
    <div class="menu">
        <h1>Meal Planning App</h1>
        <a href="index.html"> <button class="circle-btn">Home</button></a>
    </div>
</header>

<body>
    <header>
        <!-- <img src="logo.png" alt="Meal Planning App Logo"> -->
    </header>
    <main>
        <h2>Create New Password</h2>
        <form action="resetPassword.php" method="POST">
            <label for="username-email">Username/Email:</label>
            <input type="text" id="username-email" name="username-email" required>
            <label for="new-password">New Password:</label>
            <input type="password" id="new-password" name="new-password" required>
            <label for="confirm-password">Confirm Password:</label>
            <input type="password" id="confirm-password" name="new-password" required>

            <button type="submit" name="submit">Reset Password</button>
        </form>
        <footer>
            <p>&copy; 2023 Meal Planning App. All rights reserved.</p>
        </footer>
</body>

</html>