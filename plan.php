<!DOCTYPE html>
<html>

<head>
    <title>Meal Planning App</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700&display=swap" rel="stylesheet">
    <link href="meal_planning_app.css" rel="stylesheet">
</head>

<body>
    <!-- Header -->
    <header>
        <div class="menu">
            <h1>Meal Planning App</h1>
            <a href="index.html"> <button class="circle-btn">Home</button></a>
            <!--Link to user profile page-->
            <a href="accountUserProfile.html"> <button class="circle-btn">Account</button></a>
        </div>
    </header>
    <!-- Main section -->
    <section>
        <!--Left panel-->
        <aside>
            <?php
            session_start();
            if (!isset($_SESSION['loggedin'])) {
                header('Location: mealpreplogin.php');
                exit();
            }
            $account_id = $_SESSION['account_id'];
            require_once 'planback.php';

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
            ?>
            <form method="POST" id="search">
                <label for="mealtypesearch" class="mealtypesearch">Meal type</label><br>
                <select id="mealtypesearch" name="mealtypesearch" class="mealtypesearch">
                    <option value="blank">Select to filter</option>
                    <option value="plantbased">Plant based</option>
                    <option value="animalprotien">Animal protien</option>
                </select><br><br>

                <label for="ingredient_search" class="ingredient">Ingredient</label><br>
                <input type="text" id="ingredient_search" name="ingredient_search" class="ingredient_search_box">
                <input type="submit" id="ingredientsearch" name="ingredientsearch" type="submit">

            </form>
            <?php
            displayRecipeNames();
            ?>
        </aside>
        <article>
            <div class="navigate">
                <div class="menu-item">
                    <a href="addrecipe.php"> Add recipe</a>
                </div>
                <div class="menu-item active">
                    <a href="plan.php"> Plan</a>
                </div>
                <div class="menu-item">
                    <a href="cookpage.php"> Cook</a>
                </div>
                <div class="menu-item">
                    <a href="create_grocery_list.php"> Grocery list</a>
                </div>
            </div>
            <div class="plan">
                <h1>SEE YOUR PAST MEAL PLANS</h1>
                <form method="post">
                    <label for="start_date">Select The Starting Date of The Week:</label>
                    <br><br>
                    <?php
                    planhistory($account_id);
                    ?>
                    <input type="submit" name="Show_Plan" value="Show Plan">
                </form>
                <br><br>
                <h1>ADD NEW MEAL PLAN</h1>
                <form method="POST">
                    <br>
                    <label for="weekstart">Select The Starting Date of The Week:</label>
                    <br><br>
                    <input type="date" name="weekstart">
                    <br><br>
                    <input type="submit" name="submit" value="Generate Meal Plan"></input>
                    <?php
                    generate_random_plan($account_id);
                    ?>
                    <!-- <button id="save" name="save">Choose This Plan</button> -->
                    <?php
                    // save_meal_plan($account_id);
                    ?>
                </form>
            </div>
        </article>
    </section>
    <!-- Footer-->
    <!-- <footer>
        <p>&copy; 2023 Meal Planning App. All rights reserved.</p>
    </footer> -->
</body>

</html>