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
            <!--Link to user profile page-->
            <a href="accountUserProfile.html"> <button class="circle-btn">Account</button></a>
        </div>
    </header>
    <!-- Main section -->
    <section>
        <!--Left panel-->
        <aside>
            <?php
            require_once 'add.php';

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
                <select id="meal_type" name="mealt_ype" class="meal_type_menu">
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
                <div class="menu-item active">
                    <a href="addrecipe.php"> Add recipe</a>
                </div>
                <div class="menu-item">
                    <a href="Plan.html"> Plan</a>
                </div>
                <div class="menu-item">
                    <a href="cookpage.php"> Cook</a>
                </div>
                <div class="menu-item">
                    <a href="create_grocery_list.html"> Grocery list</a>
                </div>
            </div>
            <div class="recipe">
                <form method="post" id="addrecipes" name="addrecipes">
                    <div class="container">
                        <div class="left">


                            <!-- <img src="https://placehold.co/300X200" alt="description of the image"><br> -->
                            <form method="POST" enctype="multipart/form-data">
                                <input type="file" name="recipe_img" id="recipe_img">
                                <button type="submit" name="submit">Upload</button><br><br>
                            </form>

                            <label for="recipe_name" class="recipe_name">Recipe name </label><br>
                            <input type="text" id="recipe_name" name="recipe_name" placeholder="recipe name" required><br>

                            <label for="mealtype" class="meal_type">Meal type</label><br>
                            <select id="mealtype" name="mealtype" class="meal_type_menu">
                                <option value="blank"></option>
                                <option value="plantbased">Plant based</option>
                                <option value="animalprotien">Animal protien</option>
                            </select><br><br>
                        </div>
                        <div class="right">
                            <div class="recipe_table">

                                <!-- display the form to add ingredients -->
                                <table>
                                    <tbody>
                                        <tr>
                                            <td><input type="text" name="ingredient_name[]" placeholder="Ingredient Name"></td>
                                            <td><input type="text" name="ingredient_quantity[]" placeholder="Quantity">
                                            </td>
                                            <td><input type="text" name="ingredient_unit[]" placeholder="Unit"></td>
                                        </tr>
                                        <tr>
                                            <td><input type="text" name="ingredient_name[]" placeholder="Ingredient Name"></td>
                                            <td><input type="text" name="ingredient_quantity[]" placeholder="Quantity">
                                            </td>
                                            <td><input type="text" name="ingredient_unit[]" placeholder="Unit"></td>
                                        </tr>
                                        <tr>
                                            <td><input type="text" name="ingredient_name[]" placeholder="Ingredient Name"></td>
                                            <td><input type="text" name="ingredient_quantity[]" placeholder="Quantity">
                                            </td>
                                            <td><input type="text" name="ingredient_unit[]" placeholder="Unit"></td>
                                        </tr>
                                    </tbody>
                                </table>
                                <!-- <input type="submit" name="add_ingredient" value="Add Ingredient"> -->

                                </script>
                            </div>

                            <div class="instruction_entry">
                                <label for="instructions">Instructions</label><br>
                                <textarea name="instructions" id="instructions" rows="10" required></textarea>
                            </div>
                            <div class=submit>
                                <input type="submit" name="submit">
                                <?php
                                addDatatoTable()
                                ?>
                            </div>
                        </div>
                    </div>
                </form>
                <?php
                mysqli_close($conn);
                ?>
        </article>
    </section>
    <!-- Footer -->
    <!-- <footer>
        <p>&copy; 2023 Meal Planning App. All rights reserved.</p>
    </footer> -->
</body>

</html>