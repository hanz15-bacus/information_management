<?php
    session_start();    
    include '../connect.php';
    
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Form</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
      
      form {
		width: 300px;
		padding: 20px;
		border-radius: 10px;
		box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
		animation: float 3s ease-in-out infinite;
		margin: 0 auto; /* Add this line to center the form */
}
        label {
            display: block;
            margin-bottom: 5px;
            color: #45a049;
            font-size: 16px;
        }

        input[type="text"],
        input[type="password"] {
            width: 100%;
            padding: 10px;
            border: 1px solid #ced4da;
            border-radius: 5px;
            margin-bottom: 10px;
            box-sizing: border-box;
            background-color: rgba(255, 255, 255, 0.1);
            color: #45a049;
            font-size: 16px;
        }

        button {
            width: 100%;
            padding: 10px;
            background-color: #45a049;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            margin-bottom: 10px;
            transition: all 0.3s ease-in-out;
        }

        button:hover {
            background-color: #357a38;
        }

    </style>
</head>
<body>
    <div class="container">
        <form method="post">
            <h1 class="text-center mb-4">Sign Up</h1>
            <div class="form-group">
                <label for="firstname">Firstname</label>
                <input type="text" class="form-control" id="firstname" name="txtfirstname" placeholder="Enter your firstname">
            </div>
            <div class="form-group">
                <label for="lastname">Lastname</label>
                <input type="text" class="form-control" id="lastname" name="txtlastname" placeholder="Enter your lastname">
            </div>
            <div class="form-group">
                <label for="gender">Gender</label>
                <select class="form-control" id="gender" name="txtgender">
                    <option value="">----</option>
                    <option value="Male">Male</option>
                    <option value="Female">Female</option>
                </select>
            </div>
            <div class="form-group">
                <label for="email">Email Address</label>
                <input type="text" class="form-control" id="email" name="txtemail" placeholder="Enter your email">
            </div>
            <div class="form-group">
                <label for="username">Username</label>
                <input type="text" class="form-control" id="username" name="txtusername" placeholder="Choose a username">
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" class="form-control" id="password" name="txtpassword" placeholder="Create a password">
            </div>
            <button type="submit" class="btn btn-primary" name="btnRegister">Register</button>
        </form>
    </div>
</body>
</html>

<?php	
	if(isset($_POST['btnRegister'])){		
		//retrieve data from form and save the value to a variable
		//for tbluserprofile
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
