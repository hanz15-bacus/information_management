<?php
    include 'connect.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="../css/home.css">
    <!-- FONT LINK GIKAN GOGOL AND ICONS ATA -->
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

    <h1 class="category">CATEGORIES</h1>
    
    <div class="slider-wrapper">
    <button id="prev-slide" class="slide-button material-symbols-rounded">chevron_left</button>
        <div class="image-list">
            <a href = "../about.php"><img src="../images/sale.png" alt="img-1" class="image-item"></a>
            <img src="../images/jewelry.jpg" alt="img-2" class="image-item">
            <img src="../images/basketballshoes.jpg" alt="img-3" class="image-item">
            <img src="../images/vidgame.jpg" alt="img-4" class="image-item">
            <img src="../images/gym.jpg" alt="img-5" class="image-item">
            <img src="../images/heels.jpg" alt="img-6" class="image-item">
            <img src="../images/men.jpg" alt="img-7" class="image-item">
            <img src="../images/women.jpg" alt="img-8" class="image-item">
            <img src="../images/rolex.jpg" alt="img-9" class="image-item">
            <img src="../images/eyeglasses.jpg" alt="img-10" class="image-item">
            <img src="../images/mobileAccesories.jpg" alt="img-3" class="image-item">
            <img src="../images/laptop.jpg" alt="img-4" class="image-item">
            <img src="../images/appliances.jpg" alt="img-5" class="image-item">
            <img src="../images/books.jpg" alt="img-5" class="image-item">
            <img src="../images/bag.jpg" alt="img-5" class="image-item">
            <img src="../images/babystuff.jpg" alt="img-5" class="image-item">
            <img src="../images/womensbag.jpg" alt="img-5" class="image-item">
            <img src="../images/furniture.webp" alt="img-5" class="image-item">
            <img src="../images/sportsgear.jpg" alt="img-5" class="image-item">
            <img src="../images/pet.jpg" alt="img-5" class="image-item">
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