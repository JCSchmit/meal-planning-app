<!DOCTYPE html>
<html>

<head>
    <title>Meal Planning App</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700&display=swap" rel="stylesheet">
    <style>
        * {
            box-sizing: border-box;
        }

        body {
            font-family: Helvetica, sans-serif;
        }

        /* Style the header */
        header {
            background-color: #F9A826;
            padding: 20px;
            text-align: center;
            color: #fff;
            font-weight: 400;
            font-size: 2rem;
        }

        /*Style the menu*/
        .menu {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 10px;
        }

        /*Style the account button*/
        .circle-btn {
            display: inline-flex;
            justify-content: center;
            align-items: center;
            width: 100px;
            height: 100px;
            border-radius: 50%;
            border: none;
            background-color: #ffffff;
            color: #F9A826;
            font-size: 18px;
            font-weight: bold;
            text-transform: uppercase;
            cursor: pointer;
            transition: transform 0.2s ease-out;
        }

        /*On hover, scale the account button*/
        .circle-btn:hover {
            transform: scale(1.1);
        }

        /* Container for flexboxes */
        section {
            display: -webkit-flex;
            display: flex;
        }

        /* Style left panel */
        aside {
            -webkit-flex: 1;
            -ms-flex: 1;
            flex: 1;
            background: #ccc;
            padding: 20px;
        }

        /*style the Meal type label*/
        .meal_type {
            width: 120px;
            height: 40px;
            color: #000000;
            font-family: "Helvetica";
            font-weight: 400;
            font-size: 26px;
            text-align: left;
        }

        /*style the Meal type dropdown*/
        .meal_type_menu {
            width: 234px;
            height: 34px;
            padding: 4px 8px 4px 8px;
            background: #fff;
            color: #232323;
            border-color: #232323;
            border-width: 1px;
            border-style: solid;
            border-radius: 4px 4px 4px 4px;
            font-family: "Helvetica";
            font-weight: 400;
            font-size: 14px;
            text-align: left;
        }

        /*style the Ingredient label*/
        .ingredient {
            width: 116px;
            height: 36px;
            color: #000000;
            font-family: "Helvetica";
            font-weight: 400;
            font-size: 26px;
            text-align: left;
        }

        /*style the Ingredient search box*/
        .ingredient_search_box {
            width: 239px;
            height: 41px;
            padding: 8px 8px 8px 8px;
            background: #fff;
        }

        /*style the image*/
        /* .image {
            margin-top: 10px;
        } */

        /*style the horizontal menu*/
        .navigate {
            background-color: #FDE68A;
            padding: 10px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        /* Style the menu items */
        .menu-item {
            padding: 10px;
            font-size: 18px;
            font-weight: bold;
            text-transform: uppercase;
            color: #000;
            transition: background-color 0.2s ease-out;
        }

        a {
            color: black;
            text-decoration: none;
        }

        a:hover {
            color: gray;
        }

        /* Style the active menu item */
        .active {
            background-color: #F9A826;
            color: #fff;
        }

        /* Style the content */
        article {
            -webkit-flex: 3;
            -ms-flex: 3;
            flex: 3;
            background-color: #fff;
        }

        /* Style the footer */
        footer {
            background-color: #F9A826;
            color: #fff;
            padding: 20px;
            text-align: center;
            font-size: 1.2rem;
        }

        /* Responsive layout - makes the menu and the content (inside the section) sit on top of each other instead of next to each other */
        @media (max-width: 600px) {
            section {
                -webkit-flex-direction: column;
                flex-direction: column;
            }
        }

        .container {
            display: grid;
            grid-template-columns: 1fr 1fr;
            grid-gap: 20px;
        }

        .ingredients {
            display: grid;
            grid-template-columns: 1fr 1fr 1fr;
            grid-gap: 3px;
            margin-top: 20px;
            align-self: center;
            align-items: center;
        }

        .instructions {
            margin-top: 20px;
        }

        label {
            font-family: "Helvetica";
            font-weight: 400;
            font-size: 26px;
            text-align: left;
            text-decoration: solid;
            padding-left: 20px;
        }


        img {
            height: 300px;
            max-width: 300px;
            display: block;
        }

        table {
            align-self: center;
            align-items: left;
        }
    </style>
</head>

<body>
    <!-- Header -->
    <header>
        <div class="menu">
            <h1>Meal Planning App</h1>
            <!--To do: Update href with account link-->
            <a href="account.html"> <button class="circle-btn">Account</button></a>
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
            <form method="POST" action="xxx.php">
                <div class="container">
                    <div class="left">
                        <div class="food_image">
                            <img src="breackfast toast.avif" alt="Recipe Image">
                        </div>
                        <div class="ingredients">
                            <div>
                                <label>Ingredients:</label>
                                <table>
                                    <thead>
                                        <tr>
                                            <th>Amount</th>
                                            <th>Measure</th>
                                            <th>Ingredient</th>
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

            </form>
        </article>
    </section>
    <!-- Footer -->
    <footer>
        <p>&copy; 2023 Meal Planning App. All rights reserved.</p>
    </footer>
</body>

</html>