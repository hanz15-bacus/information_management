<?php
include 'connect.php';

if(isset($_GET['updateid']) && !empty($_GET['updateid'])) {
    $acctid = $_GET['updateid'];

    if(isset($_POST['submit'])){
        $emailadd = mysqli_real_escape_string($connection, $_POST['emailadd']);
        $username = mysqli_real_escape_string($connection, $_POST['username']);
        $password = mysqli_real_escape_string($connection, $_POST['password']);

        $sql = "UPDATE tbuseraccount SET username = '$username', emailadd = '$emailadd', password = '$password' WHERE acctid = '$acctid'";

        $result = mysqli_query($connection, $sql); 

        if($result){
            echo '<script>alert("Updated Successfully"); window.location.href = "../home.php";</script>';
        } else {
            echo '<script>alert("Failed to update: '. mysqli_error($connection) .'");</script>';
        }
    }
} else {
    echo '<script>alert("Update ID is missing."); window.location.href = "../home.php";</script>';
}

?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">


    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css">

    <link rel="stylesheet" type="text/css" href="../css/register.css?v1">

    <title>Edit Profile</title>
  </head>
  <body>
 
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

      <div class="form-group">
            <label for="password">Password</label>
            <input type="password" class="form-control" id="password" placeholder="Enter password" name="password" required autocomplete="off">
          </div>

          <button type="submit" class="btn btn-primary" name="submit">Update</button>
        </form>
      </div>
   
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"></script>
  </body>
</html>