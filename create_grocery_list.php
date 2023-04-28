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
            $username = "ics325sp235003";
            $password = "8989";
            $dbname = "ics325sp235003";

            // $servername = "localhost";
            // $username = "root";
            // $password = "";
            // $dbname = "mealplanningapp_db";
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
            <form action="Grocery_list.php" method="POST">

                <?php
                $sql = "SELECT DISTINCT plan_start_date
                FROM meal_plan 
                WHERE account_id = '$account_id'";

                $result = $conn->query($sql);

                //Create an array of meal plan start dates
                if ($result->num_rows > 0) {
                    echo "<label for='plan_start_date' class='plan_start_date'>Date range: </label>";
                    echo "<select id='plan_start_date' name='plan_start_date' class='meal_type_menu'>";
                    echo "<option value='blank'>Select a start date</option>";
                    while ($row = $result->fetch_assoc()) {
                        echo "<option value=" . $row["plan_start_date"] . ">" . $row["plan_start_date"] . "</option>";
                    }
                } else {
                    echo "No meal plans found.";
                }

                //close connection to database
                $conn->close();
                ?>
                <input type="submit" class="seven_day_plan"></input>
            </form>
        </article>
    </section>
    <!-- Footer-->
    <!-- <footer>
        <p>&copy; 2023 Meal Planning App. All rights reserved.</p>
    </footer> -->
</body>

</html>/