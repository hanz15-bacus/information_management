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
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="./css/styles.css">
    <title>Login and Register</title>
  
</head>

<body>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="#">ShopWise</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item">
                <a class="nav-link" href="../index.php">Home</a>
            </li> 
            <li class="nav-item dropdown">
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="#">Reports</a>
                    <a class="dropdown-item" href="#">FAQs</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="#">Feedbacks</a>
                </div>
            </li>
        </ul>
        <form class="form-inline my-2 my-lg-0">
            <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
            <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
        </form>
    </div>
</nav>
</body>
</html>