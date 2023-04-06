<style>
  body {
    font-family: Arial, sans-serif;
    margin: 0;
    padding: 0;
    /* background-image: url("img/mealprep.jpg"); */
    background-size: cover;
    /* background-color: #3367D6; */
  }
  header {
    background-color: #F9A826;
    text-align: center;
    padding: 5px;

  }
  
  h1 {
    font-size: 2em;
    /* color: #fff; */
    color:#fff;
  }
  form {
    display: inline-block;
    text-align: left;
  }
  label {
    display: block;
    margin-bottom: 10px;
  }
  input[type="text"],
  input[type="password"] {
    padding: 10px;
    font-size: 1em;
    border: 1px solid #ccc;
    border-radius: 5px;
    margin-bottom: 20px;
    width: 100%;
  }
  button[type="submit"],
  button[type="button"] {
    padding: 10px;
    background-color: #F9A826;
    color: #fff;
    border: none;
    border-radius: 5px;
    font-size: 1em;
    cursor: pointer;
  }
  button[type="submit"]:hover,
  button[type="button"]:hover  {
    background-color:#FFD580;
  }
  a {
    color: #F9A826;
    text-decoration: none;
  }
  footer {
    background-color: #F9A826;
    padding: 10px;
    text-align: center;
    bottom: 0;
    color: #fff;

  }
  footer p {
    font-size: 0.8em;
  }
  main {
    flex: 1; /* Make the main element stretch to fill the remaining space */
    padding: 20px;
    text-align: center;
  }
  .navbar {
width: 100%;
background-color:#FDE68A;
overflow: auto;
}

/* Navigation links */
.navbar a {
float: left;
padding: 12px;
color: white;
text-decoration: none;
font-size: 17px;
width: 25%; 
text-align: center; 
}

/* Add a background color on mouse-over */
.navbar a:hover {
background-color: #000;
}

/* Style the current/active link */
/* .navbar a.active {
background-color: black;
} */


@media screen and (max-width: 500px) {
.navbar a {
float: none;
display: block;
width: 100%;
text-align: left; 
}
}

.navbar {
display: flex;
justify-content: space-between;
}

.navbar a {
flex: 1;
text-align: center;
}
</style>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
  
    <!-- <title>Meal Planning App - Login</title> -->
    <!-- <link rel="stylesheet" href="Mealprep.css"> -->
  </head>
  <header>
    <h1>Meal Planning App</h1>
</header>
  <body>
    
    <header>
      <!-- <img src="logo.png" alt="Meal Planning App Logo"> -->
    </header>
    <div class="navbar">
			<a class="active" href="index.html">Home</a>
			<a href="createAccount.html">Create Account</a>
			<a href=" ">PlaceHolder</a>
			<a href=" ">PlaceHolder</a>
		  </div>
    <main>
      <h2>Welcome back to the Meal Planning App!</h2>
     
       <form action="login_handler.php" method="POST" > 
        <label for="username-email">Username/Email:</label>
        <input type="text" id="username-email" name="username-email" required>
        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required>
        <?php
        if (isset($_GET['error'])) {
            echo '<p class="error">Invalid username/email or password</p>';
        }
        ?> 
        <button type="submit" name="submit">Sign In</button>
        
         <button type="button" onclick="location.href='resetPassword.php'">Reset Password</button>

        
      </form><br>
      <!-- <a href="#">Forgot your password? Reset Password</a> -->
      <p>Don't have an account? <a href="createAccount.html">Sign Up</a></p>
      <p>By logging in, you agree to our <a href="#">Terms and Conditions</a> and <a href="#">Privacy Policy</a>.</p>
    </main>
    <footer>
      <p>&copy; 2023 Meal Planning App. All rights reserved.</p>
    </footer>
  </body>
</html> 