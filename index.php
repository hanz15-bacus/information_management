<?php
   include 'connect.php';

if(isset($_POST['submit'])){
    $acctid = $_POST['acctid'];
    $emailadd = $_POST['emailadd'];
    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql= "insert into tbuseraccount (acctid, emailadd, username, password)
          values('$acctid', '$emailadd', '$username', '$password')";
    $result= mysqli_query($connection, $sql);

    
      echo '<script>';
      echo 'if (' . $result . ') {';
      echo '  alert("Data inserted successfully.");';
      echo '  window.location.href = "home.php";'; 
      echo '} else {';
      echo '  alert("Data is unqualified.");';
      echo '}';
      echo '</script>';

}
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css">

    <title>Hello, world!</title>
  </head>
  <body>
 
   <div class = "container my-5">
    <form method = "post">
        <div class="form-group">
          <label>Account ID</label>
          <input type="number" class="form-control" placeholder="Enter number" name = "acctid" autocomplete="off">
        </div>

        <div class="form-group">
          <label>Email Address</label>
          <input type="email" class="form-control" placeholder="Enter email" name = "emailadd" autocomplete="off">
        </div>

        <div class="form-group">
          <label>Username</label>
          <input type="text" class="form-control" placeholder="Enter email" name = "username" autocomplete="off">
        </div>

        <div class="form-group">
          <label>Password</label>
          <input type="password" class="form-control" placeholder="Enter password" name = "password" autocomplete="off">
        </div>

   
   
        <button type="submit" class="btn btn-primary" name = "submit">Submit</button>
</form>
    </div>

  
   
  </body>
</html>