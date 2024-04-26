<?php
session_start();
include '../connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $username = $_POST['username'];
    $password = $_POST['password'];

    if (empty($username) && empty($password)) {
        echo "<script>alert('Both username and password are required.'); window.location.href = '../index.php';</script>";
        exit();
    }
    elseif (empty($password)) {
        echo "<script>alert('password is required.'); window.location.href = '../index.php';</script>";
        exit();
    }
    elseif (empty($username)) {
        echo "<script>alert('username is required.'); window.location.href = '../index.php';</script>";
        exit();
    }
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

   
    $stmt = $connection->prepare("SELECT * FROM tbuseraccount WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        
        $stmt = $connection->prepare("UPDATE tbuseraccount SET password = ? WHERE username = ?");
        $stmt->bind_param("ss", $hashed_password, $username);
        $stmt->execute();

    
        if (password_verify($password, $hashed_password)) {
            
            $_SESSION['username'] = $username;
           
            echo "<script>alert('You are now Logged In'); window.location.href = '../nextPage.php';</script>";
            exit();
        } else {
          
            echo "<script>alert('Incorrect password.'); window.location.href = '../index.php';</script>";
            exit();
        }
    } else {
        
        $stmt = $connection->prepare("INSERT INTO tbuseraccount (username, password) VALUES (?, ?)");
        $stmt->bind_param("ss", $username, $hashed_password);
       $stmt->execute();

        
        if (password_verify($password, $hashed_password)) {
            // kung sakto password, allow log in
            $_SESSION['username'] = $username;
            
            echo "<script>alert('You are now Logged In'); window.location.href = '../nextPage.php';</script>";
            exit();
        } else {
            // Password is incorrect, don't allow
             $_SESSION['username'] = $username;
            echo "<script>alert('Incorrect password.'); window.location.href = '../index.php';</script>";
            exit();
        }
    }

}
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
        <label for="username">Username:</label>
        <input type="text" id="username" name="username">
        
        <label for="password">Password:</label>
        <input type="password" id="password" name="password">

        <button type="submit" class="login-button">Log in</button>
        <button type="submit" formaction="./includes/register.php" class="register-button">Register</button>
    </form>
</div>
