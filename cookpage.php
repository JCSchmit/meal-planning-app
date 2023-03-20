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
            <label for="mealtype" class="meal_type">Meal type</label><br>
            <select id="mealtype" name="mealtype" class="meal_type_menu">
                <option value="blank">Select to filter</option>
                <option value="plantbased">Plant based</option>
                <option value="animalprotien">Animal protien</option>
            </select><br><br>

            <label for="ingredient_search" class="ingredient">Ingredient</label><br>
            <input type="text" id="ingredient_search" name="ingredient_search" value="search" class="ingredient_search_box">

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
                <div class="menu-item active">
                    <a href="cookpage.php"> Cook</a>
                </div>
                <div class="menu-item">
                    <a href="Grocery_list.php"> Grocery list</a>
                </div>
            </div>

            <!--To do: add filename for action-->
            <form method="POST" action="xxx.php">
            <div class="recipe">
                <div class="container">
                    <div class="left">
                        <div class="food_image">
                            <img src="https://placehold.co/300X200" alt="Recipe Image">
                        </div>
                        <div class="ingredients">
                            <div>
                                <label>Ingredients:</label>
                                <table>
                                    <thead>
                                        <tr>
                                            <th>Amount</th>
                                            <th>Measurement</th>
                                            <th id="ingredient">Ingredient</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>1 </td>
                                            <td>cup</td>
                                            <td>Flour</td>
                                        </tr>
                                        <tr>
                                            <td>1/2 </td>
                                            <td>teaspoon</td>
                                            <td>Salt</td>
                                        </tr>
                                        <tr>
                                            <td>1/4 </td>
                                            <td>cup</td>
                                            <td>Sugar</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="right">
                        <div class="instructions">
                            <label>Instructions:</label>
                            <ol>
                                <li>Preheat the oven to 350°F (180°C). Grease a baking sheet with non-stick spray.</li>
                                <li>In a large bowl, combine the flour, salt, and sugar. Mix well.</li>
                                <li>Add the butter and mix until crumbly.</li>
                                <li>Add the egg and vanilla and mix until the dough comes together.</li>
                                <li>Divide the dough into 12 equal pieces and roll each into a ball.</li>
                                <li>Place the balls on the prepared baking sheet, spacing them 2 inches (5 cm) apart.
                                </li>
                                <li>Bake for 12-15 minutes, until the cookies are golden brown.</li>
                                <li>Transfer the cookies to a wire rack and cool completely.</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            </form>
        </article>
    </section>
    <!-- Footer -->
    <footer>
        <p>&copy; 2023 Meal Planning App. All rights reserved.</p>
    </footer>
</body>

</html>