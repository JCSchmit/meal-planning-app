<!DOCTYPE html>
<html>

<head>
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
            margin-bottom: 5px;
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
            background-color: #FDE68A;
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

        .password-requirements {
            margin-bottom: 5px;
        }

        .password-requirements ul {
            padding-left: 20px;
        }

        .password-requirements li {
            list-style-type: disc;
        }
    </style>
    <title>Meal Planning App</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700&display=swap" rel="stylesheet">
    <link href="meal_planning_app.css" rel="stylesheet">
</head>

<body>
    <header>
        <div class="menu">
            <h1>Meal Planning App</h1>
            <a href="index.html"> <button class="circle-btn">Home</button></a>
            <!-- <a href="accountUserProfile.html"> <button class="circle-btn">Account</button></a> -->
        </div>
    </header>
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
    // $dbname = "mealplanningapp_db";

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
        $new_password = mysqli_real_escape_string($conn, $_POST['new-password']);
        $confirm_password = mysqli_real_escape_string($conn, $_POST['confirm-password']);

        if ($new_password !== $confirm_password) {
            echo "<script>
                alert('Passwords do not match!');
                window.location.href = 'resetPassword.php?error=1';
            </script>";
            exit();
        }

        if (!isValidPassword($new_password)) {
            echo "<script>
                alert('Invalid password! Please make sure it meets the requirements.');
                window.location.href = 'resetPassword.php?error=2';
            </script>";
            exit();
        }

        // Hash the password before storing it
        $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);

        $sql = "UPDATE user SET password='$hashed_password' WHERE user_email='$user_email'";
        $result = $conn->query($sql);

        if ($conn->affected_rows > 0) {
            echo "<script>
            alert('Password created successfully');
            window.location.href = 'mealpreplogin.php';
        </script>";
        } else {
            echo "<script>
            alert('Failed to create password. Please try again.');
            window.location.href = 'resetPassword.php?error=3';
        </script>";
        }
    }

    $conn->close();
    ?>
    <h2>Create New Password</h2>
    <form action="resetPassword.php" method="POST">
        <label for="username-email">Username/Email:</label>
        <input type="text" id="username-email" name="username-email" required>
        <label for="new-password">New Password:</label>
        <input type="password" id="new-password" name="new-password" required>
        <label for="confirm-password">Confirm Password:</label>
        <input type="password" id="confirm-password" name="confirm-password" required>

        <button type="submit" name="submit">Reset Password</button>
    </form>
    <!-- <footer>
        <p>&copy; 2023 Meal Planning App. All rights reserved.</p>
    </footer> -->
</body>

</html>