<?php
    session_start();
    include 'connect.php';

    if(isset($_POST['submit'])) {

        $email = $_POST['emailadd'];
        $password = $_POST['password'];

        $stmt = $connection->prepare("SELECT * FROM tbuseraccount WHERE emailadd = ? AND password = ?");
        if (!$stmt) {
            $error = "Database error: " . $connection->error;
        } else {
            $result = mysqli_query($connection, "SELECT * FROM tbuseraccount WHERE emailadd = '$email' AND password = '$password'");

          

            if (!$result) {
                
                $error = "Query execution error: " . $stmt->error;
            } else {
                
         
            
                $row=mysqli_fetch_assoc($result);
             //   $_SESSION['username']= $row['acctid'];
                if($row>0){
                    header("Location: ../includes/home.php");
                    exit();
                } else {
                    $error = "Invalid email or password. Please try again.";
                }
                
            }
            $stmt->close();
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ShopWise</title>;
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="../css/index.css">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  
</head>
<body>
<header>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="#">ShopWise</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item">
                <a class="nav-link" href="../includes/home.php">Log in as Guest</a>
            </li> 
            <li class="nav-item">
                <a class="nav-link" href="../dashboard.php">Dashboard</a>
            </li> 
            <li class="nav-item">
                <a class="nav-link" href="../something.php">Something</a>
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
    </div>
    
</nav>
</header>
<div class="container">
    <div class="form-container">
        <h1>Log In to ShopWise</h1>
        <form method="post">
            <div class="form-group">
                <label for="emailadd">Email Address</label>
                <input type="email" class="form-control" id="emailadd" placeholder="Enter email" name="emailadd" required autocomplete="off">
            </div>
          
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" class="form-control" id="password" placeholder="Enter password" name="password" required autocomplete="off">
            </div>

            <button type="submit" class="btn btn-primary" name="submit">Log In</button>
            <a type="button" class="btn btn-primary btn-green" href= "../includes/register.php">Register</a>
            

            <?php
                // Display error message if set
                if(isset($error)) { 
                    echo '<div class="alert alert-danger mt-3" role="alert">'.$error.'</div>';
                }
            ?>
        </form>
    </div>
</div>
</body>
</html>
