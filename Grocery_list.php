<!DOCTYPE html>
<html>

<head>
    <title>Meal Planning App</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700&display=swap" rel="stylesheet">
    <link href="meal_planning_app.css" rel="stylesheet">
    <style>
    
    label {
    margin: 10px; 
    }
    /* for styling the grocery list */
    ul {
        list-style: none;
        padding: 10px;
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
    </style>
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
            <label for="mealtype" class="meal_type">Meal type</label><br>
            <select id="mealtype" name="mealtype" class="meal_type_menu">
                <option value="blank">Select to filter</option>
                <option value="plantbased">Plant based</option>
                <option value="animalprotien">Animal protien</option>
            </select><br><br>

            <label for="ingredient_search" class="ingredient">Ingredient</label><br>
            <input type="text" id="ingredient_search" name="ingredient_search" value="search"
                class="ingredient_search_box">

            <image-container>
                <img src="https://placehold.co/240X160" alt="description of the image" class="image">
            </image-container>

            <image-container>
                <img src="https://placehold.co/240X160" alt="description of the image" class="image">
            </image-container>

            <image-container>
                <img src="https://placehold.co/240X160" alt="description of the image" class="image">
            </image-container>
        </aside>
        <article>
            <div class="navigate">
                <div class="menu-item">
                    <a href="addrecipe.html"> Add recipe</a>
                </div>
                <div class="menu-item">
                    <a href="Plan.html"> Plan</a>
                </div>
                <div class="menu-item">
                    <a href="cookpage.php"> Cook</a>
                </div>
                <div class="menu-item active">
                    <a href="create_grocery_list.html"> Grocery list</a>
                </div>
            </div>
                <br>
                <label for="grocery_list">Seven day grocery list: </label><br><br>
                <?php
                //create short variable names
                $plan_start_date=$_POST['plan_start_date'];

                //connect to database
                $servername = "localhost";
                $username = "root";
                $password = null;
                $dbname = "mealplanningapp_db";

                //create connection
                @$conn = new mysqli($servername, $username, $password, $dbname);

                //check connection
                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                }

                
                //
                $sql = "SELECT ingredient_name, ingredient_qty, qty_type FROM ingredients JOIN meal_plan ON ingredients.recipe_id=meal_plan.recipe_id WHERE meal_plan.plan_start_date='$plan_start_date'";
                $result = $conn->query($sql);
                
                if ($result->num_rows > 0) {
                    echo "<ul class='grocery_list'>";
                  // output data of each row
                  while($row = $result->fetch_assoc()) {
                    echo  "<li><input type='checkbox'>" . "<strong>" . $row["ingredient_name"] . "</strong>" . ":    " . "(" . $row["ingredient_qty"] . " " .  $row["qty_type"] . ")" . "</li>";
                  }
                } else {
                  echo "No ingredients found.";
                }
                
                //close connection to database
                $conn->close();
                ?>
            </form>
        </article>
    </section>
    <!-- Footer -->
    <footer>
        <p>&copy; 2023 Meal Planning App. All rights reserved.</p>
    </footer>
</body>

</html>