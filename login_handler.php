<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "mealplanningapp_db";
// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
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
if (isset($_POST['submit'])) {
    $user_email = mysqli_real_escape_string($conn, $_POST['username-email']);
    $user_password = mysqli_real_escape_string($conn, $_POST['password']);

    if (isValidPassword($user_password)) {
        $sql = "SELECT * FROM user WHERE user_email='$user_email'";
        $result = $conn->query($sql);

        if ($result && $result->num_rows > 0) {
            $user = $result->fetch_assoc();
            echo $user_password;
            echo $user['password'];
            $storedHashedPassword = $user['password'];

            if (password_verify($user_password, $storedHashedPassword)) {
                $_SESSION['loggedin'] = true;
                $_SESSION['account_id'] = $user['account_id'];
                $_SESSION['account_email'] = $user['user_email'];
                $_SESSION['create_date'] = $user['create_date'];

                header('Location: addrecipe.php');
                exit();
            } else {
                header('Location: mealpreplogin.php?error=1');
                exit();
            }
        } else {
            header('Location: mealpreplogin.php?error=12');
            exit();
        }
    } else {
        header('Location: mealpreplogin.php?error=2');
        exit();
    }
}

$conn->close();
