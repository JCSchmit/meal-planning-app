<?php
// Function to display recipe names in a list
function displayRecipeNames()
{
    global $conn;
    $mealtype = isset($_POST['mealtypesearch']) ? $_POST['mealtypesearch'] : '';
    $ingredient = isset($_POST['ingredient_search']) ? $_POST['ingredient_search'] : '';

    $sql = "SELECT DISTINCT recipes.recipe_id, recipes.recipe_name, recipes.recipe_img
        FROM recipes 
        JOIN recipe_ingredients ON recipes.recipe_id = recipe_ingredients.recipe_id 
        JOIN ingredients ON recipe_ingredients.ingredient_id = ingredients.ingredient_id 
        WHERE 1=1 ";
    if (!empty($mealtype) && $mealtype != 'blank') {
        $sql .= " AND recipes.meal_type = '{$mealtype}'";
        // $sql .= " AND (recipes.meal_type  = '{$mealtype}')";
        if (!empty($ingredient)) {
            $sql .= " AND ingredients.ingredient_name = '{$ingredient}'";
        }
    } else {
        if (!empty($ingredient)) {
            $sql .= " AND ingredients.ingredient_name = '{$ingredient}'";
        }
    }
    // Execute query
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        // echo "<ul>";
        // while ($row = $result->fetch_assoc()) {
        //     echo "<li><form><input type='hidden' value='" . $row['recipe_id'] . "'>
        //     <button >" . $row['recipe_name'] . "</button></form></li>";
        // }
        // $row = mysqli_fetch_assoc($result);

        echo "<ul style='overflow-y: scroll; max-height: 800px;list-style-type: none;'>";
        while ($row = $result->fetch_assoc()) {
            $file_path = $row["recipe_img"];
            echo "<li><form><input type='hidden' value='" . $row['recipe_id'] . "'>
            <button> . <div style='position: relative; width: 300px; height: 200px; background-image: url(\"uploads/" . $file_path . "\"); background-size: cover;'>
            <div style='position: absolute; bottom: 0; left: 0; right: 0; background-color: rgba(0, 0, 0, 0.7); color: #fff; padding: 5px;'>
            " . $row['recipe_name']  . "</div>
            </div> </button></form></li>";
        }
        // echo "</ul>";
    } else {
        echo "No recipes found.";
    }
}
$mealplan = array();
$recipeIds = array();
$weekstart = '';
$weekend = '';
function generate_random_plan($account_id)
{
    global $conn, $mealplan, $recipeIds, $weekstart;

    // Check if form is submitted
    if ((isset($_POST['submit']) && (isset($_POST["weekstart"])))) {
        // Get user input
        $weekstart = $_POST['weekstart'];

        //  Select random recipes from the database for each meal of each day
        $days = array("Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday", "Sunday");

        foreach ($days as $day) {
            $breakfast_query = "SELECT recipes.recipe_id,recipes.recipe_name FROM recipes ORDER BY RAND() LIMIT 1";
            $lunch_query = "SELECT recipes.recipe_id,recipes.recipe_name FROM recipes ORDER BY RAND() LIMIT 1";
            $dinner_query = "SELECT recipes.recipe_id,recipes.recipe_name FROM recipes ORDER BY RAND() LIMIT 1";

            $breakfast_result = mysqli_query($conn, $breakfast_query);
            $lunch_result = mysqli_query($conn, $lunch_query);
            $dinner_result = mysqli_query($conn, $dinner_query);

            $breakfast_row = mysqli_fetch_assoc($breakfast_result);
            $lunch_row = mysqli_fetch_assoc($lunch_result);
            $dinner_row = mysqli_fetch_assoc($dinner_result);

            $mealplan[$day] = array($breakfast_row, $lunch_row, $dinner_row);
            // Store the recipe IDs for later use
            $recipeIds[] = $breakfast_row['recipe_id'];
            $recipeIds[] = $lunch_row['recipe_id'];
            $recipeIds[] = $dinner_row['recipe_id'];
        }

        // Print the meal plan
        echo "<h2>Meal Plan for Week Starting on " . date('F d, Y', strtotime($weekstart)) . "</h2>";
        echo "<table>";
        echo "<tr><th></th><th>Breakfast</th><th>Lunch</th><th>Dinner</th></tr>";
        foreach ($mealplan as $day => $meals) {
            echo "<tr><td>$day</td>";
            foreach ($meals as $meal) {
                echo "<td>" . $meal['recipe_name'] . "</td>";
            }
            echo "</tr>";
        }
        echo "</table>";
        // Display the start and end dates on the page
        // echo "<p> Meal plan start date: $weekstart </p>";
        save_meal_plan($account_id);
    }
}
function save_meal_plan($account_id)
{
    global $conn, $mealplan, $recipeIds, $weekstart, $weekend;

    // Retrieve the weekstart and weekend values from the form submission
    $weekstart = $_POST['weekstart'];

    $weekstart = date('Y-m-d', strtotime($weekstart));
    // Add 6 days to the start date for the full 7-day plan
    $weekend = date('Y-m-d', strtotime($weekstart . '+ 6 days'));

    // Convert the meal plan array to JSON format
    $mealplan_json = json_encode($mealplan);

    // Display the start and end dates on the page
    // echo "<p> Meal plan start date: $weekstart </p>";
    // echo "<p> Meal plan end date: $weekend </p>";

    // Prepare the SQL statement
    $insert_query = "INSERT INTO meal_plan (account_id, plan_start_date, plan_end_date, meals) VALUES (?, ?, ?, ?)";
    $meal_plan_stmt = $conn->prepare($insert_query);
    $meal_plan_stmt->bind_param("isss", $account_id, $weekstart, $weekend, $mealplan_json);

    // ...

    // Execute the query to insert the meal plan
    if ($meal_plan_stmt->execute()) {
        $meal_id = $conn->insert_id;

        // Prepare the SQL statement to insert the recipe IDs and meal IDs into the plan_recipe table
        $insert_query_recipe = "INSERT INTO plan_recipe (recipe_id, meal_id) VALUES (?, ?)";
        $stmt_recipe = $conn->prepare($insert_query_recipe);
        // foreach ($recipeIds as $recipe_id) {
        //     $stmt_recipe->bind_param("ii", $recipe_id, $meal_id);
        //     $stmt_recipe->execute();
        // }
        $uniqueRecipeIds = array(); // Initialize an empty array to store unique recipe IDs
        // Bind the parameters and execute the query for each recipe ID
        foreach ($recipeIds as $recipe_id) {
            // Check if the recipe ID has already been processed
            if (!in_array($recipe_id, $uniqueRecipeIds)) {
                // Add the recipe ID to the set of unique recipe IDs
                $uniqueRecipeIds[] = $recipe_id;

                // Perform your desired actions with the recipe ID
                $stmt_recipe->bind_param("ii", $recipe_id, $meal_id);
                $stmt_recipe->execute();
            }
        }
        if ($stmt_recipe->affected_rows > 0) {
            echo "<p>Recipes saved successfully</p>";
        } else {
            echo "<p>An error has occurred while saving recipes, please try again</p>";
        }
        echo "Meal plan saved successfully!";
    } else {
        echo "Error saving meal plan: " . $meal_plan_stmt->error;
    }
}
function planhistory($account_id)
{
    global $conn;
    // Prepare the SQL statement to retrieve distinct start dates
    $select_query = "SELECT DISTINCT plan_start_date FROM meal_plan WHERE account_id = ? ORDER BY plan_start_date ASC";
    $stmt = $conn->prepare($select_query);
    $stmt->bind_param("i", $account_id);
    $stmt->execute();
    $stmt->bind_result($start_date);

    // Fetch the result and generate the dropdown list
    echo "<select name='start_date'>";
    echo "<option value=''>Start Date</option>";
    while ($stmt->fetch()) {
        echo "<option value='$start_date'>$start_date</option>";
    }
    echo "</select>";
    if (isset($_POST['Show_Plan']) && !$_POST['start_date'] == null) {
        $selected_date = $_POST['start_date'];
        retrieve_meal_data($account_id, $selected_date);
    }
}
function retrieve_meal_data($account_id, $selected_date)
{
    global $conn;

    // Prepare the SQL statement to retrieve the meal data
    $select_query = "SELECT meals FROM meal_plan WHERE account_id = ? AND plan_start_date = ?";
    $stmt = $conn->prepare($select_query);
    $stmt->bind_param("is", $account_id, $selected_date);
    $stmt->execute();
    $stmt->bind_result($mealsJson);

    // Fetch the result
    if ($stmt->fetch()) {
        // Decode the JSON data
        $meals = json_decode($mealsJson, true);

        // Check if decoding was successful
        if ($meals !== null) {
            // Print the meal data
            echo "<h2>Meal plan for the week of $selected_date</h2>";
            echo "<table>";
            echo "<tr><th>Day</th><th>Breakfast</th><th>Lunch</th><th>Dinner</th></tr>";

            foreach ($meals as $day => $mealsOfDay) {
                echo "<tr>";
                echo "<td>$day</td>";
                foreach ($mealsOfDay as $meal) {
                    echo "<td>" . $meal['recipe_name'] . "</td>";
                }
                echo "</tr>";
            }

            echo "</table>";
        } else {
            echo "Error decoding JSON data.";
        }
    } else {
        echo "Meal data not found for the selected date.";
    }
}
