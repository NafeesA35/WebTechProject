<?php
session_start();
if (!isset($_SESSION['attempted'])) {
  $_SESSION['attempted'] = false;
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <base href="http://localhost/WebTechCW/">
  <title>Personal Portfolio Website</title>
  <link rel="stylesheet" href="reset.css">
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <header>
      <section id="NavBar">
        <nav>
          <div class="NavDivA">
            <a href="index.php">Home</a>
          </div>
        </nav>
      </section>
  </header>

  <?php
  if(!isset($_SESSION["email"]) || $_SESSION["email"] == "") {
    if($_SESSION['attempted']) {
      echo "<h1 class='error-msg'> incorrect login information </h1>";
      // Don't set it back to true here
    }
  }
  ?>
  <section id="newsletter">
    <form method="POST" action="processLogin.php">
      <div class="fieldset-div">
        <fieldset>
          <legend> Login to view my blog </legend>
          <label for="email">Email Address:</label>
          <input type="email" id="email" name="email" required>
          <label for="password">Password:</label>
          <input type="password" id="password" name="password" required minlength="8" pattern="^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$" title="Must contain 1 upper and lower case letter 1 number and any of the conventional special characters (@$!%*?&)">
        </fieldset>

      </div>
      <div class="button-style">
        <button type="submit" class="button-itself">  Login  </button>
      </div>
    </form>
  </section>


</body>
</html>