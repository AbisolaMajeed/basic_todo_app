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
    <title>Registeration</title>
    <link rel="stylesheet" href="log.css" />
  </head>
  <body>
    <h1>Registeration Form</h1>
    <p>Fill out this form with the required details</p>

    <form action="intro.php" method="post">
    <?php include 'error.php' ?>
      <fieldset>
        <input
          name="full_name"
          id="full_name"
          type="text"
          placeholder="Enter your full name"
          value = "<?php $fullname ?>"
        />
        <input
          name="email"
          id="email"
          type="email"
          placeholder="Enter your email address"
          value = "<?php $email ?>"
        />
        <input
          name="username"
          id="username"
          type="text"
          placeholder="Create a new username"
          value = "<?php $username ?>"
        />
        <input
          name="password"
          id="password"
          type="password"
          placeholder="Create a new password"
          value = "<?php $password ?>"
        />
        <input
          name="confirm_password"
          id="confirm_password"
          type="password"
          placeholder="Confirm Password"
          value = "<?php $confirmpassword ?>"
        />
      </fieldset>
      <button name="register" type="submit" value="submit">Submit</button>
      <p class="footer">
        Already have an account? <a href="login.php" class="log">Log In</a>
      </p>
    </form>
  </body>
</html>
