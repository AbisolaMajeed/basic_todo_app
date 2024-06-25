<?php
include 'connection.php';

$error = isset($_SESSION['error']) ? $_SESSION['error'] : array();
unset($_SESSION['error']);

?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Login</title>
    <link rel="stylesheet" href="log.css" />
  </head>
  <body>
    <h1>User Login</h1>
    <form action= "intro.php" method= "post">
    <?php include 'error.php' ?>
      <fieldset>
        <input
          name="username"
          id="username"
          type="text"
          placeholder="Enter your username"
          value = "<?php $username ?>"
          
        />
        <input
          name="password"
          id="password"
          type="password"
          placeholder="Enter your password"
          value = "<?php $password ?>"
        />
      </fieldset>
      <button type="submit" value="Log In" name= "login">Log In</button>
      <p class="submit">
        Dont have an account?
        <a href="signup.php" class="reg">Sign Up</a>
      </p>
    </form>
  </body>
</html>
