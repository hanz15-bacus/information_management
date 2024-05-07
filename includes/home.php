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
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <script     src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="../css/home.css">
    <link rel = "stylesheet" href = "https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded:opsz,wght,FILL,GRAD@48,400,0,0">
    <script src = "../js/script.js"></script>
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
                <a class="nav-link" href="../index.php">Log in</a>
            </li> 
            <li class="nav-item">
                <a class="nav-link" href="../dashboard.php">Dashboard</a>
            </li> 
            <li class="nav-item">
                <a class="nav-link" href="../checkout.php">checkout</a>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    More
                </a>
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

<div class="container">
    <h1 class="hot_sale">HOT SALE</h1>
    <div class="container1">
        <div class="image-list1">
            <a href = "jewelry.php"><img src="../images/jewelry.jpg" alt="img-2" class="image-item"></a>
            <img src="../images/basketballshoes.jpg" alt="img-3" class="image-item">
            <img src="../images/rolex.jpg" alt="img-4" class="image-item">
            <img src="../images/men.jpg" alt="img-5" class="image-item">
            <img src="../images/heels.jpg" alt="img-6" class="image-item">
        </div>
    </div>
 
    <h1 class="category">CATEGORIES</h1>
    
    <div class="slider-wrapper">
    <button id="prev-slide" class="slide-button material-symbols-rounded">chevron_left</button>
        <div class="image-list">
            
            <a href = "../includes/home.php"><img src="../images/vidgame.jpg" alt="img-1" class="image-item"></a>
            <a href = "../includes/jewelry.php"><img src="../images/jewelry.jpg" alt="img-2" class="image-item"></a>
            <a href = "../includes/basketballshoes.php"><img src="../images/basketballshoes.jpg" alt="img-3" class="image-item"></a>
            <a href = "../includes/vidgame.php"><img src="../images/vidgame.jpg" alt="img-4" class="image-item"></a>
            <a href = "../includes/gym.php"><img src="../images/gym.jpg" alt="img-5" class="image-item"></a>
            <a href = "../includes/heels.php"><img src="../images/heels.jpg" alt="img-6" class="image-item"></a>
            <a href = "../includes/men.php"><img src="../images/men.jpg" alt="img-7" class="image-item"></a>
            <a href = "../includes/women.php"><img src="../images/women.jpg" alt="img-8" class="image-item"></a>
            <a href = "../includes/rolex.php"><img src="../images/rolex.jpg" alt="img-9" class="image-item"></a>
            <a href = "../includes/eyeglass.php"><img src="../images/eyeglasses.jpg" alt="img-10" class="image-item"></a>
            <a href = "../includes/mobileAcc.php"><img src="../images/mobileAccesories.jpg" alt="img-3" class="image-item"></a>
            <a href = "../includes/laptop.php"><img src="../images/laptop.jpg" alt="img-4" class="image-item"></a>
            <a href = "../includes/appliances.php"><img src="../images/appliances.jpg" alt="img-5" class="image-item"></a>
            <a href = "../includes/book.php"><img src="../images/books.jpg" alt="img-5" class="image-item"></a>
            <a href = "../includes/bag.php"><img src="../images/bag.jpg" alt="img-5" class="image-item"></a>
            <a href = "../includes/babystuff.php"><img src="../images/babystuff.jpg" alt="img-5" class="image-item"></a>
            <a href = "../includes/womenbag.php"><img src="../images/womensbag.jpg" alt="img-5" class="image-item"></a>
            <a href = "../includes/furniture.php"><img src="../images/furniture.webp" alt="img-5" class="image-item"></a>
            <a href = "../includes/sportsgear.php"><img src="../images/sportsgear.jpg" alt="img-5" class="image-item"></a>
            <a href = "../includes/pet.php"><img src="../images/pet.jpg" alt="img-5" class="image-item"></a>
        </div>
        <button id="next-slide" class="slide-button material-symbols-rounded">chevron_right</button>
    </div>
</div>

<div class="slider-scrollbar">
    <div class="scrollbar-track">
        <div class="scrollbar-thumb"></div>
    </div>
</div>
<div class="container-wrapper">
</div>

</body>
</html>
