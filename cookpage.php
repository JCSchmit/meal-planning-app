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
            <a href="accountUserProfile.html"> <button class="circle-btn">Account</button></a>
        </div>
    </header>
    <!-- Main section -->
    <section>
        <!--Left panel-->
        <aside>
            <?php
            require_once 'recipe.php';

            $servername = "localhost";
            $username = "root";
            $password = null;
            $dbname = "mealplanningapp_db";

            // Create connection
            $conn = new mysqli($servername, $username, $password, $dbname);

            // Check connection
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }
            ?>
            <form method="POST" id="search">
                <label for="mealtype" class="meal_type">Meal type</label><br>
                <select id="mealtype" name="mealtype" class="meal_type_menu">
                    <option value="blank">Select to filter</option>
                    <option value="plantbased">Plant based</option>
                    <option value="animalprotien">Animal protien</option>
                </select><br><br>

                <label for="ingredient_search" class="ingredient">Ingredient</label><br>
                <input type="text" id="ingredient_search" name="ingredient_search" class="ingredient_search_box">
                <botton id="ingredientsearch" name="ingredientsearch" type="submit">
                    Search</botton>
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
                    <a href="Plan.html"> Plan</a>
                </div>
                <div class="menu-item active">
                    <a href="cookpage.php"> Cook</a>
                </div>
                <div class="menu-item">
                    <a href="Grocery_list.php"> Grocery list</a>
                </div>
            </div>

            <!--To do: add filename for action-->
            <form method="POST">
                <div class=" recipe">
                    <div class="container">
                        <div class="left">
                            <div class="food_image">
                                <img src="https://placehold.co/300X200" alt="Recipe Image">
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