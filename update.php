<?php
   include 'connect.php';
$acctid=$_GET['updateid'];

if(isset($_POST['submit'])){
    $emailadd = $_POST['emailadd'];
    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql= "update tbuseraccount set username = '$username', emailadd = '$emailadd', username = '$username', password = '$password'";
    $result= mysqli_query($connection, $sql);
    if($result){
<<<<<<< HEAD
        echo '<script>alert("Updated Successfully"); window.location.href = "../home.php";</script>';
=======
        echo '<script>alert("Updated Successfully"); window.location.href = "home.php";</script>';
>>>>>>> 527d4bcd4ad02213f6d470a56a854eecb6c884a6
    }else{
        die(mysqli_error($connection));
    }
    

}
?>



<!doctype html>
<html lang="en">
  <head>
<<<<<<< HEAD
    
=======
   
>>>>>>> 527d4bcd4ad02213f6d470a56a854eecb6c884a6
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">


    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css">

    <link rel="stylesheet" type="text/css" href="../css/register.css">

    <title>Edit Profile</title>
  </head>
  <body>
<<<<<<< HEAD
    <div class="container">
      <div class="form-container">
        <h1>Update Account</h1>
        <form method="post">
          <div class="form-group">
            <label for="emailadd">Email Address</label>
            <input type="email" class="form-control" id="emailadd" placeholder="Enter email" name="emailadd" required autocomplete="off">
          </div>

          <div class="form-group">
            <label for="username">Username</label>
            <input type="text" class="form-control" id="username" placeholder="Enter username" name="username" required autocomplete="off">
          </div>
=======
    <div class = "container my-5">
    <form method = "post">
        <div class="form-group">
          <label>Email Address</label>
          <input type="email" class="form-control" placeholder="Enter email" name = "emailadd" autocomplete="off">
        </div>
>>>>>>> 527d4bcd4ad02213f6d470a56a854eecb6c884a6

          <div class="form-group">
            <label for="password">Password</label>
            <input type="password" class="form-control" id="password" placeholder="Enter password" name="password" required autocomplete="off">
          </div>

          <button type="submit" class="btn btn-primary" name="submit">Update</button>
        </form>
      </div>
    </div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"></script>
  </body>
</html>