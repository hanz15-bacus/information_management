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
            // Password is correct, allow login
            $_SESSION['username'] = $username;
            
            echo "<script>alert('You are now Logged In'); window.location.href = '../nextPage.php';</script>";
            exit();
        } else {
            // Password is incorrect
            echo "<script>alert('Incorrect password.'); window.location.href = '../index.php';</script>";
            exit();
        }
    }

}
?>