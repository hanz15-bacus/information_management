<?php
 include 'connect.php'
 ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cruddddd</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css">
    <!-- Custom CSS -->
    <link rel="stylesheet" type="text/css" href="../css/home.css">
</head>
<body>

<div class="container-fluid">
    <div class="row justify-content-center mt-4">
        <div class="col-md-6 text-center">
            <button class="btn btn-primary"><a href="../includes/register.php" class="text-light">Add User</a></button>
        </div>
    </div>
  
    <div class="row justify-content-center mt-4">
        <div class="col-md-10">
            <table class="table table-bordered">
                <thead>
                <tr>
                    <th scope="col">Account ID</th>
                    <th scope="col">Email Address</th>
                    <th scope="col">Username</th>
                    <th scope="col">Password</th>
                    <th scope="col">Actions</th>
                </tr>
                </thead>
                <tbody>
                <?php
                $sql = "SELECT * FROM tbuseraccount";
                $result = mysqli_query($connection, $sql);

                if ($result) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo '<tr>
                          <td>' . $row['acctid'] . '</td>
                          <td>' . $row['emailadd'] . '</td>
                          <td>' . $row['username'] . '</td>
                          <td>' . $row['password'] . '</td>
                          <td>
                            <button class="btn btn-primary mr-2"><a href="update.php?updateid='.$row['acctid'].'" class="text-light">Update</a></button>
                            <button class="btn btn-danger"><a href="delete.php?deleteid='.$row['acctid'].'" class="text-light">Delete</a></button>
                          </td>
                        </tr>';
                    }
                } else {
                    echo "Error: " . mysqli_error($connection);
                }
                ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"></script>
</body>
</html>
