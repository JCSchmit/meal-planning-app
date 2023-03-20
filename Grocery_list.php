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
            <!--To do: Update href with account link-->
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
                    <a href="Grocery_list.php"> Grocery list</a>
                </div>
            </div>
            <form method="POST" action="xxx.php">
                <br>
                <label for="grocery_list">Seven Day Grocery list</label><br>
                <ul class="grocery-list">
                    <li>
                        <input type="checkbox" id="item1" name="item1" value="item1">
                        <label for="item1">Eggs</label>
                    </li>
                    <li>
                        <input type="checkbox" id="item2" name="item2" value="item2">
                        <label for="item2">Milk</label>
                    </li>
                    <li>
                        <input type="checkbox" id="item3" name="item3" value="item3">
                        <label for="item3">Bread</label>
                    </li>
                    <li>
                        <input type="checkbox" id="item4" name="item4" value="item4">
                        <label for="item4">Cheese</label>
                    </li>
                    <li>
                        <input type="checkbox" id="item5" name="item5" value="item5">
                        <label for="item5">Chicken</label>
                    </li>
                </ul>

            </form>
        </article>
    </section>
    <!-- Footer -->
    <footer>
        <p>&copy; 2023 Meal Planning App. All rights reserved.</p>
    </footer>
</body>

</html>