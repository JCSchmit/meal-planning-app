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
        echo "<ul style='overflow-y: scroll; max-height: 800px;list-style-type: none;'>";
        while ($row = $result->fetch_assoc()) {
            $file_path = $row["recipe_img"];
            echo "<li><form><input type='hidden' value='" . $row['recipe_id'] . "'>
            <button> . <div style='position: relative; width: 300px; height: 200px; background-image: url(\"uploads/" . $file_path . "\"); background-size: cover;'>
            <div style='position: absolute; bottom: 0; left: 0; right: 0; background-color: rgba(0, 0, 0, 0.7); color: #fff; padding: 5px;'>
            " . $row['recipe_name']  . "</div>
            </div> </button></form></li>";
        }
        echo "</ul>";
    } else {
        echo "No recipes found.";
    }
}

$recipe_id;

function addDatatoTable($account_id)
{
    if (isset($_POST['submit'])) {

        global $conn;

        $recipe_name = isset($_POST['recipe_name']) ? htmlspecialchars($_POST['recipe_name']) : '';
        $meal_type = isset($_POST['mealtype']) ? htmlspecialchars($_POST['mealtype']) : '';
        $instructions = isset($_POST['instructions']) ? htmlspecialchars($_POST['instructions']) : '';
        $ingredient_names = isset($_POST['ingredient_name']) ? $_POST['ingredient_name'] : [];
        $ingredient_quantities = isset($_POST['ingredient_quantity']) ? $_POST['ingredient_quantity'] : [];
        $ingredient_units = isset($_POST['ingredient_unit']) ? $_POST['ingredient_unit'] : [];

        // Validate and sanitize input
        $recipe_name = trim($recipe_name);
        $meal_type = trim($meal_type);
        $instructions = trim($instructions);

        $ingredient_names = array_map('trim', $ingredient_names);
        $ingredient_names = array_map('htmlspecialchars', $ingredient_names);

        $ingredient_quantities = array_map('trim', $ingredient_quantities);
        $ingredient_quantities = array_map('htmlspecialchars', $ingredient_quantities);

        $ingredient_units = array_map('trim', $ingredient_units);
        $ingredient_units = array_map('htmlspecialchars', $ingredient_units);

        // echo "<pre>";
        // print_r($_FILES['recipe-img']);
        // echo "</pre>";
        $img_name = $_FILES['recipe-img']['name'];
        $img_size = $_FILES['recipe-img']['size'];
        $tmp_name = $_FILES['recipe-img']['tmp_name'];

        if ($img_size > 500000) {
            echo "<p> Sorry, your file is too large.</p>";
        } else {
            $img_ex = pathinfo($img_name, PATHINFO_EXTENSION);
            $img_ex_lc = strtolower($img_ex);

            $allowed_exs = array("jpg", "jpeg", "png");

            if (in_array($img_ex_lc, $allowed_exs)) {
                $new_img_name = uniqid("IMG-", true) . '.' . $img_ex_lc;
                $img_upload_path = 'uploads/' . $new_img_name;
                move_uploaded_file($tmp_name, $img_upload_path);
            } else {
                echo "<p>You can't upload files of this type</p>";
            }

            $recipe_result = $conn->query("SELECT recipe_id FROM recipes WHERE 
             recipe_name = '$recipe_name'");
            if ($recipe_result->num_rows > 0) {
                echo "<p>This recipe name already exists.</p>";
            } else {
                global $recipe_stmt;

                // Prepare the recipe insert statement
                $recipe_stmt = $conn->prepare('INSERT INTO recipes (recipe_name, meal_type, instruction_text, account_id, recipe_img) VALUES (?, ?, ?, ?, ?)');
                $recipe_stmt->bind_param('sssis', $recipe_name, $meal_type, $instructions, $account_id, $new_img_name);

                // Insert the recipe and retrieve its id
                $recipe_stmt->execute();
                $recipe_id = $conn->insert_id;
                if ($recipe_stmt) {
                    echo "Image uploaded and saved to database.";
                } else {
                    echo "Error: " . $recipe_stmt . "<br>" . mysqli_error($conn);
                }
            }

            // Counter for filled rows
            $filled_rows = 0;

            // Loop through the form data to validate and count filled rows
            for ($i = 0; $i < count($ingredient_names); $i++) {
                $name = $ingredient_names[$i];
                $quantity = $ingredient_quantities[$i];
                $unit = $ingredient_units[$i];

                // Check if at least one field is filled for the current row
                if (!empty($name) || !empty($quantity)) {
                    $filled_rows++;
                }

                if ($filled_rows > 0) {
                    // Save data to database        
                    // Check if the ingredient already exists in the database            
                    $ingredient_result = $conn->query("SELECT ingredient_id FROM ingredients WHERE 
                ingredient_name = '$name' AND ingredient_qty = '$quantity' AND qty_type = '$unit'");

                    if ($ingredient_result->num_rows > 0) {
                        $ingredient_id = $ingredient_result->fetch_assoc()['ingredient_id'];
                    } else {
                        // Otherwise, insert the ingredient into the database and retrieve its id
                        $ingredient_stmt = $conn->prepare('INSERT INTO ingredients (ingredient_name, ingredient_qty, qty_type ) VALUES (?, ?, ?)');
                        $ingredient_stmt->bind_param('sss', $name, $quantity, $unit);
                        $ingredient_stmt->execute();
                        $ingredient_id = $conn->insert_id;
                        $ingredient_stmt->close();
                    }

                    // Prepare the recipe-ingredient insert statement
                    $recipe_ingredient_stmt = $conn->prepare('INSERT INTO recipe_ingredients (recipe_id, ingredient_id) VALUES (?, ?)');
                    $recipe_ingredient_stmt->bind_param('ii', $recipe_id, $ingredient_id);

                    // Insert the recipe-ingredient relationship
                    $recipe_ingredient_stmt->execute();
                    $recipe_ingredient_stmt->close();
                }
            }
        }
        // Close the prepared statements and database connection
        $recipe_stmt->close();

        echo "<p><strong>$recipe_name is added successfully</strong></p>";
    }
}
