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
    padding: 5px;

}

h1 {
    font-size: 2em;
    /* color: #fff; */
    color: #fff;
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
    color: #F9A826;
    text-decoration: none;
}

footer {
    background-color: #F9A826;
    padding: 10px;
    text-align: center;
    bottom: 0;
    color: #fff;

}

footer p {
    font-size: 0.8em;
}

main {
    flex: 1;
    /* Make the main element stretch to fill the remaining space */
    padding: 20px;
    text-align: center;
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
</style>
<!DOCTYPE html>
<html>

<head>
    <title>Meal Planning App</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700&display=swap" rel="stylesheet">
    <link href="meal_planning_app.css" rel="stylesheet">
    <!-- <title>Meal Planning App - Login</title> -->
    <!-- <link rel="stylesheet" href="Mealprep.css"> -->
</head>

<body>
    <!-- Header -->
    <header>
        <div class="menu">
            <h1>Meal Planning App</h1>

            <a href="index.html"> <button class="circle-btn">Home</button></a>
            <!-- <a href="accountUserProfile.html"> <button class="circle-btn">Account</button></a> -->
        </div>
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

            <button type="button" onclick="location.href='resetPassword.php'">forget Password</button>


        </form><br>
        <!-- <a href="#">Forgot your password? Reset Password</a> -->
        <p>Don't have an account? <a href="createAccount.html" style="color: #F9A826;">Sign Up</a></p>
        <p>By logging in, you agree to our <a href="#" style="color: #F9A826;">Terms and Conditions</a> and <a href="#"
                style="color: #F9A826;">Privacy Policy.</a></p>
    </main>
    <!-- <footer>
        <p>&copy; 2023 Meal Planning App. All rights reserved.</p>
    </footer> -->
</body>

</html>