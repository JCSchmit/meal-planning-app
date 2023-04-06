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
        <h2>Welcome back to the Meal Planning App!</h2>
        <form action="login_handler.php" method="POST">
            <label for="username-email">Username/Email:</label>
            <input type="text" id="username-email" name="username-email" required>
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required>
            <?php
      if (isset($_GET['error'])) {
        echo '<p class="error">Invalid username/email or password</p>';
      }
      ?>
            <button type="submit" name="submit">Sign In</button>

            <button type="button" onclick="location.href='resetPassword.php'">Reset Password</button>


        </form><br>
        <!-- <a href="#">Forgot your password? Reset Password</a> -->
        <p>Don't have an account? <a href="createAccount.html">Sign Up</a></p>
        <p>By logging in, you agree to our <a href="#">Terms and Conditions</a> and <a href="#">Privacy Policy</a>.</p>
    </main>
    <footer>
        <p>&copy; 2023 Meal Planning App. All rights reserved.</p>
    </footer>
</body>

</html>