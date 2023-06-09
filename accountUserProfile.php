<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700&display=swap" rel="stylesheet">
    <link href="meal_planning_app.css" rel="stylesheet">
</head>

<body>
    <header>
        <div class="menu">
            <h1>Meal Planning App</h1>
            <!--Link to Add Recipe Page-->
            <a href="index.html"> <button class="circle-btn">Home</button></a>
            <a href="addrecipe.php"> <button class="circle-btn">Add Recipe</button></a>
            <a href="index.html"> <button class="circle-btn">Log out</button></a>
        </div>
    </header>
    <div class="container">
        <div class="user-image">
            <!-- <img src="https://placehold.co/300X300" alt="User Picture"> -->
            <img src="img/user.png" alt="User Picture">
        </div>
        <div class="account-details">
            <br><br>
            <h2>Account Details</h2>
            <!-- <p><strong>Name:</strong> MealPlanner_123</p> -->
            <p><strong>Email Address:</strong>
                <?php echo isset($_SESSION['account_email']) ? $_SESSION['account_email'] : 'Not available'; ?>
            </p>
            <p><strong>Membership Level:</strong> Free Trial</p>
            <!-- <p><strong>Signup Date:</strong> February 27, 2023</p> -->
            <p><strong>Signup Date:</strong>
                <?php echo isset($_SESSION['create_date']) ? date("F d, Y", strtotime($_SESSION['create_date'])) : 'Not available'; ?>
            </p>

            <p><strong>Account Status:</strong> Active</p>
        </div>
    </div>
    <!-- <footer>
    <p>&copy; 2023 Meal Planning App. All rights reserved.</p>
    </footer> -->
</body>

</html>