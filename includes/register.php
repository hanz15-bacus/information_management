<?php

include '../connect.php';

if(isset($_POST['submit'])){
    $acctid = $_POST['acctid'];
    $emailadd = $_POST['emailadd'];
    $username = $_POST['username'];
    $password = $_POST['password'];

    if(empty($acctid) || empty($emailadd) || empty($username) || empty($password)) {
        echo '<script>alert("Must fill all needed information"); window.location.href = "register.php";</script>';
    } else {
        $sql= "insert into tbuseraccount (acctid, emailadd, username, password)
          values('$acctid', '$emailadd', '$username', '$password')";
        $result= mysqli_query($connection, $sql);

        if($result){
            echo '<script>alert("Registered Successfully"); window.location.href = "../dashboard.php";</script>';
        } else {
            echo '<script>alert("Data insertion failed."); window.location.href = "../include/register.php";</script>';
        }
    }
}
?>
<!doctype html>
<html lang="en">
  <head>
    
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" type = "text/css" href = "../css/register.css">
    <title>Registration Form</title>
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
    </div>
    
</nav>
    <div class="container">
      <div class="form-container">
        <h1>Sign Up</h1>
        <form method="post">
          <div class="form-group">
            <label for="acctid">Account ID</label>
            <input type="number" class="form-control" id="acctid" placeholder="Enter number" name="acctid" required autocomplete="off">
          </div>

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

          <button type="submit" class="btn btn-primary" name="submit">Submit</button>
        </form>
      </div>
    </div>
    ?>

<?php	
	if(isset($_POST['btnRegister'])){		
	
		$fname=$_POST['txtfirstname'];		
		$lname=$_POST['txtlastname'];
		$gender=$_POST['txtgender'];
		
	
		$email=$_POST['txtemail'];		
		$uname=$_POST['txtusername'];
		$pword=$_POST['txtpassword'];
		
				
		$sql1 ="Insert into tbluserprofile1(firstname,lastname,gender) values('".$fname."','".$lname."','".$gender."')";
		mysqli_query($connection,$sql1);
		
		$sql2 ="Select * from tbuseraccount where username='".$uname."'";
		$result = mysqli_query($connection,$sql2);
		$row = mysqli_num_rows($result);
		if($row == 0){
			$sql ="Insert into tbuseraccount(emailadd,username,password) values('".$email."','".$uname."','".$pword."')";
			mysqli_query($connection,$sql);
			echo "<script language='javascript'>	
						alert('New record saved.');
				  </script>";
			//header("location: index.php");
		}else{
			echo "<script language='javascript'>
						alert('Username already existing');
				  </script>";
		}
			
		
	}
		

?>


    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"></script>
  </body>
</html>