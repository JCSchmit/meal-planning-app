<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();

// Database connection details
$servername = "localhost";
$username = "root";
$password = "";
// $dbname = "Mtest";
$dbname = "Mealplanningapp";

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
<style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-size: cover;
            
        }
        header {
            background-color: #F9A826;
            padding: 20px;
            text-align: center;
            color: #fff;
            font-weight: 700;
            font-size: 2rem;
        }

        
        h2 {
            font-size: 2em;
            color: #333;
            text-align: center;
            margin-top: 5px;
        }
        /* form {
            display: inline-block;
            text-align: left;
        } */
        form {
			background-color: #fff;
			border: 1px solid #ccc;
			border-radius: 5px;
			box-shadow: 0px 0px 5px #ccc;
			padding: 10px;
			margin: 5px auto; 
			max-width: 500px;
            position: absolute;
	        top: 160;
	        left: 0;
	        right: 0;
        
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
        button[type="submit"] {
            padding: 5px;
            background-color: #F9A826;
            color: #fff;
            border: none;
            border-radius: 5px;
            font-size: 1em;
            cursor: pointer;
        }
        button[type="submit"]:hover {
            background-color: #FFD580;
        }
        a {
            color: #F9A826;
            text-decoration: none;
        }
.navbar {
  width: 100%;
  background-color:#FDE68A;
  overflow: auto;
}

/* Navigation links */
.navbar a {
  float: left;
  padding: 12px;
  color: white;
  text-decoration: none;
  font-size: 17px;
  width: 25%; 
  text-align: center; 
}

/* Add a background color on mouse-over */
.navbar a:hover {
  background-color: #000;
}

/* Style the current/active link */
/* .navbar a.active {
  background-color: black;
} */


@media screen and (max-width: 500px) {
  .navbar a {
    float: none;
    display: block;
    width: 100%;
    text-align: left; 
  }
}
  
.navbar {
  display: flex;
  justify-content: space-between;
}

.navbar a {
  flex: 1;
  text-align: center;
}

        
         footer {
            position: absolute;
            bottom: 0;
            width: 100%;
            background-color: #F9A826;
            text-align: center;
            color: #fff;
            padding: 5px;
        } 
		
    </style>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <header>Meal Planning App</header>
</head>
<body>
<div class="navbar">
  <a class="active" href="index.html">Home</a>
  <a href="createAccount.html">Create Account</a>
  <a href=" ">PlaceHolder</a>
  <a href=" ">Place your order</a>
</div>
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
