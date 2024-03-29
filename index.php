<?php
session_start();
include 'connect.php';

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width-device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/styles.css">
    <title>Login and Register</title>
  
</head>

<body>

<div class="header">
      
    <a href="Products"><u>Products</u></a>
    <a href="Solutions"><u>Solutions</u></a>
    <a href="Developers"><u>Developers</u></a>
    <a href="Resources"><u>Resources</u></a>
    <a href="Pricing"><u>Pricing</u></a>
    <a href="Contact sales"><u>Contact sales</u></a>
    <a href="Sign in"><u>Hot Sale</u></a>
</div>

<div class="container">
    <form action="./includes/login.php" method="post" id="loginRegisterForm">
        <!-- Combined Form for Login and Registration -->
        <label for="username">Username:</label>
        <input type="text" id="username" name="username">
        
        <label for="password">Password:</label>
        <input type="password" id="password" name="password">

        <button type="submit" class="login-button">Log in</button>
        <button type="submit" formaction="./includes/register.php" class="register-button">Register</button>
    </form>
</div>



</body>
</html>