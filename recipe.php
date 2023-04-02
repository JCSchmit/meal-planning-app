<?php
$selectedid = 0;
// Check if form is submitted
if (isset($_POST['ingredientsearch'])) {
    displayRecipeNames();
}

// Function to display recipe names in a list
function displayRecipeNames()
{
    global $conn;
    $mealtype = isset($_POST['mealtype']) ? $_POST['mealtype'] : '';
    $ingredient = isset($_POST['ingredient_search']) ? $_POST['ingredient_search'] : '';

    // Construct SQL query with filters
    $sql = "SELECT DISTINCT recipes.recipe_id, recipes.recipe_name 
        FROM recipes 
        JOIN recipe_ingredients ON recipes.recipe_id = recipe_ingredients.recipe_id 
        JOIN ingredients ON recipe_ingredients.ingredient_id = ingredients.ingredient_id 
        WHERE 1=1 ";
    if (!empty($mealtype) && $mealtype != 'blank') {
        $sql .= " AND recipes.meal_type = '{$mealtype}'";
    }
    if (!empty($ingredient)) {
        $sql .= " AND ingredients.ingredient_name = '{$ingredient}'";
    }
    // Execute query
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        echo "<ul>";
        while ($row = $result->fetch_assoc()) {
            echo "<li><form method='POST'><input type='hidden' name='selected' value='" . $row['recipe_id'] . "'>
            <button type='submit'>" . $row['recipe_name'] . "</button></form></li>";
        }
        echo "</ul>";
    } else {
        echo "No recipes found.";
    }
}
// function searchrecipe(){

// Check if recipe is selected
if (isset($_POST['selected'])) {
    $selectedid = $_POST['selected'];
}

function displayIngredientRecipe()
{
    global $conn;
    global $selectedid;

    $r_id = $selectedid;
    //$i_id = $_GET['i_id'];

    // Retrieve the recipe information using a JOIN query
    $sql = "SELECT ingredients.ingredient_qty, ingredients.qty_type, ingredients.ingredient_name
            FROM ingredients
            JOIN recipe_ingredients ON recipe_ingredients.ingredient_id = ingredients.ingredient_id 
            JOIN recipes ON recipes.recipe_id = recipe_ingredients.recipe_id WHERE 
            recipes.recipe_id = $r_id";

    $result = $conn->query($sql);

    // Output the ingridiant information in HTML format
    if ($result->num_rows > 0) {
        echo "<table>";
        echo "<tr><th>Ingredient</th><th>Quantity</th><th>Measurement</th></tr>";
        while ($row = $result->fetch_assoc()) {
            $ingredientName = $row["ingredient_name"];
            $ingredientQty = $row["ingredient_qty"];
            $qtyType = $row["qty_type"];
            echo "<tr><td>$ingredientName</td><td>$ingredientQty</td><td>$qtyType</td></tr>";
        }
        echo "</table>";
    } else {
        echo "No ingredients found for this recipe.";
    }
}

function displayRecipeInstruction()
{
    global $conn;
    global $selectedid;

    $r_id = $selectedid;

    // Retrieve instructions for selected recipe
    $sql = "SELECT recipe_name, instruction_text FROM recipes WHERE recipe_id='$r_id'";


    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        // Output instructions with line breaks for each step
        $row = $result->fetch_assoc();
        echo "<label><strong>" . $row['recipe_name'] . "</strong></label><br>";
        $instructions = $row["instruction_text"];
        $steps = explode(".", $instructions);
        foreach ($steps as $step) {
            echo $step . "<br>";
        }
    } else {
        echo "Instructions not found for selected recipe.";
    }
}
