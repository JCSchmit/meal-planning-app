<!DOCTYPE html>
<html>

<head>
    <title>Meal Planning App</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700&display=swap" rel="stylesheet">
    <link href="meal_planning_app.css" rel="stylesheet">
    <style>
        /* for styling the grocery list */
        label {
            margin: 10px;
        }

        ul {
            list-style: none;
            padding: 25px;
            padding-left: 30px;
            margin: 0;
        }

        /* for styling the list items */
        li {
            display: flex;
            align-items: center;
            margin-bottom: 10px;
        }

        /* for styling the checkbox */
        input[type="checkbox"] {
            margin-right: 10px;
        }

        .multi-column {
            /* Standard */
            column-count: 2;
            column-width: 150px;
            /* Webkit-based */
            -webkit-column-count: 2;
            -webkit-column-width: 150px;
            /* Gecko-based */
            -moz-column-count: 2;
            -moz-column-width: 150px;
        }
    </style>
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
            <!--start the session-->
            <?php
            session_start();
            if (!isset($_SESSION['loggedin'])) {
                header('Location: mealpreplogin.php');
                exit();
            }

            //Session variable for account id obtained at login
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
                <div class="menu-item">
                    <a href="plan.php"> Plan</a>
                </div>
                <div class="menu-item">
                    <a href="cookpage.php"> Cook</a>
                </div>
                <div class="menu-item active">
                    <a href="create_grocery_list.php"> Grocery list</a>
                </div>
            </div>
            <br>
            <label for="grocery_list">Seven day grocery list: </label><br><br>
            <div class=multi-column>
                <?php

                //create short variable names
                $plan_start_date = $_POST['plan_start_date'];
                //verify the date selected from the drop down is in the expected format. 
                if (preg_match("/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/", $plan_start_date)) {

                    //hardcode account_id for testing
                    //$account_id = $account_id;

                    $sql = "SELECT 
                ingredient_name, 
                SUM(ingredient_qty) as total_qty, 
                qty_type 
                
                FROM ingredients
                INNER JOIN recipe_ingredients on ingredients.ingredient_id=recipe_ingredients.ingredient_id
                INNER JOIN plan_recipe on recipe_ingredients.recipe_id = plan_recipe.recipe_id
                INNER JOIN meal_plan on plan_recipe.meal_id = meal_plan.meal_id
                INNER JOIN user on meal_plan.account_id = user.account_id
                
                WHERE plan_start_date = '$plan_start_date' 
                AND user.account_id = $account_id
                GROUP BY ingredient_name, qty_type";

                    $result = $conn->query($sql);

                    if ($result->num_rows > 0) {
                        $num_rows = mysqli_num_rows($result);
                        //echo "$num_rows";
                        echo "<ul class='grocery_list'>";
                        // output data of each row
                        while ($row = $result->fetch_assoc()) {
                            if ($row["total_qty"] != 0) {
                                echo  "<li><input type='checkbox'>" . "<strong>" . $row["ingredient_name"] . "</strong>" . ":    " . "(" . $row["total_qty"] . " " .  $row["qty_type"] . ")" . "</li>";
                            } else echo "<li><input type='checkbox'>" . "<strong>" . $row["ingredient_name"] . "</strong>"  . "</li>";
                        }
                    } else {
                        echo "No ingredients found.";
                    }

                    //test to check that session account id is set
                    //if (isset($account_id)) {
                    //echo "Account id: $account_id <br>";
                    //}else{
                    //echo "No account id!";
                    //}

                    //close connection to database
                    $conn->close();
                } else {
                    return false;
                    echo "<p>That is not a valid date</p>";
                }
                ?>
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