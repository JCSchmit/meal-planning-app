<!DOCTYPE html>
<html>

<head>
    <style>
        .ingredientsearch {
            background-color: #4CAF50;
            /* Green */
            border: none;
            color: white;
            padding: 15px 32px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            margin: 4px 2px;
            cursor: pointer;
        }
    </style>
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
            <a href="accountUserProfile.php"> <button class="circle-btn">Account</button></a>
        </div>
    </header>
    <!-- Main section -->
    <section>
        <!--Left panel-->
        <aside>
            <?php
            session_start();
            require_once 'recipe.php';

            if (!isset($_SESSION['loggedin'])) {
                header('Location: mealpreplogin.php');
                exit();
            }
            // $servername = "localhost";
            // $username = "ics325sp235003";
            // $password = "8989";
            // $dbname = "ics325sp235003";
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
                <div class="menu-item">
                    <a href="plan.php"> Plan</a>
                </div>
                <div class="menu-item active">
                    <a href="cookpage.php"> Cook</a>
                </div>
                <div class="menu-item">
                    <a href="create_grocery_list.php"> Grocery list</a>
                </div>
            </div>

            <!--To do: add filename for action-->
            <form method="POST">
                <div class=" recipe">
                    <div class="container">
                        <div class="left">
                            <div class="food_image">
                                <?php
                                if (displayimage() == 0) {
                                    echo '<img src="https://placehold.co/300X200" alt="Recipe Image">';
                                }
                                ?>

                            </div>
                            <div class="ingredients">
                                <div>
                                    <label for="ingredient_name">Needed Ingredients </label><br>
                                    <?php
                                    displayIngredientRecipe();
                                    ?>
                                </div>
                            </div>
                        </div>
                        <div class="right">
                            <div class="instructions">
                                <label><strong> Instructions For </strong></label><br>
                                <?php
                                displayRecipeInstruction();
                                // Close the database connection
                                $conn->close();
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </article>
    </section>
    <!-- Footer -->
    <!-- <footer>
        <p>&copy; 2023 Meal Planning App. All rights reserved.</p>
    </footer> -->
</body>

</html>