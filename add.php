<?php
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
            echo "<li><form><input type='hidden' name='selected' value='" . $row['recipe_id'] . "'>
            <button >" . $row['recipe_name'] . "</button></form></li>";
        }
        echo "</ul>";
    } else {
        echo "No recipes found.";
    }
}

function setimage()
{
    global $conn;
    if (isset($_POST['submit'])) {
        // Check if file was uploaded without errors
        if (isset($_FILES["recipe_img"]) && $_FILES["recipe_img"]["error"] == 0) {
            $allowed = array("jpg" => "image/jpg", "jpeg" => "image/jpeg", "png" => "image/png");
            $filename = $_FILES["recipe_img"]["name"];
            $filetype = $_FILES["recipe_img"]["type"];
            $filesize = $_FILES["recipe_img"]["size"];

            // Verify file extension
            $ext = pathinfo($filename, PATHINFO_EXTENSION);
            if (!array_key_exists($ext, $allowed)) die("Error: Please select a valid file format.");

            // Verify file size - 5MB maximum
            $maxsize = 5 * 1024 * 1024;
            if ($filesize > $maxsize) die("Error: File size is larger than the allowed limit.");

            // Verify MIME type of the file
            if (in_array($filetype, $allowed)) {
                // Upload file to server
                $tmpname = $_FILES["recipe_img"]["tmp_name"];
                $newname = uniqid('', true) . '.' . $ext;
                $filepath = "uploads/" . $newname;
                move_uploaded_file($tmpname, $filepath);

                // Update recipe_img column in the recipe table
                $recipe_id = 1; // Set recipe ID to the appropriate value
                $sql = "UPDATE recipe SET recipe_img = '{$newname}' WHERE recipe_id = '{$recipe_id}'";
                if ($conn->query($sql) === TRUE) {
                    echo "Image uploaded successfully.";
                } else {
                    echo "Error updating image: " . $conn->error;
                }
            } else {
                echo "Error: There was a problem uploading your file. Please try again.";
            }
        } else {
            echo "Error: " . $_FILES["recipe_img"]["error"];
        }
    }
}

function addDatatoTable()
{
    if (isset($_POST['submit'])) {

        global $conn;

        $recipe_name = $_POST['recipe_name'];
        $meal_type = $_POST['mealtype'];
        $instructions = $_POST['instructions'];
        $ingredient_names = $_POST['ingredient_name'];
        $ingredient_quantities = $_POST['ingredient_quantity'];
        $ingredient_units = $_POST['ingredient_unit'];
        // Prepare the recipe insert statement
        $recipe_stmt = $conn->prepare('INSERT INTO recipes (recipe_name, meal_type, instruction_text) VALUES (?, ?, ?)');
        $recipe_stmt->bind_param('sss', $recipe_name, $meal_type, $instructions);

        // Insert the recipe and retrieve its id
        $recipe_stmt->execute();
        $recipe_id = $conn->insert_id;

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
                    $conn->query("INSERT INTO ingredients (ingredient_name, ingredient_qty, qty_type ) 
                    VALUES ('$name', '$quantity', '$unit')");

                    $ingredient_id = $conn->insert_id;
                }

                // Prepare the recipe-ingredient insert statement
                $recipe_ingredient_stmt = $conn->prepare('INSERT INTO recipe_ingredients (recipe_id, ingredient_id) VALUES (?, ?)');
                $recipe_ingredient_stmt->bind_param('ii', $recipe_id, $ingredient_id);

                // Insert the recipe-ingredient relationship
                $recipe_ingredient_stmt->execute();
                $recipe_ingredient_stmt->close();
            }
        }

        // Close the prepared statements and database connection
        $recipe_stmt->close();

        echo "<p><strong>recipe_name is added successfully</strong></p>";
    }
}
