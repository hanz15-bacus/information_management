<?php
    include 'connect.php';
?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css">

    <title>Cruddddd</title>
  </head>
  <body>
  <div class="div container">
    <button class = "btn btn-primary my-5"><a href = "index.php" class = "text-light">Add User</a>
    
  </button>
  <table class="table">
  <thead>
    <tr>
      <th scope="col">Account ID</th>
      <th scope="col">Email Address</th>
      <th scope="col">Username</th>
      <th scope="col">Password</th>
    </tr>
  </thead>
  <tbody>

  <?php
  // Assuming $connection is properly initialized
  $sql = "SELECT * FROM tbuseraccount";
  $result = mysqli_query($connection, $sql);

  if ($result) {
    while ($row = mysqli_fetch_assoc($result)) {
      echo '<tr>
              <th scope="row">' . $row['acctid'] . '</th>
              <td>' . $row['emailadd'] . '</td>
              <td>' . $row['username'] . '</td>
              <td>' . $row['password'] . '</td>
              <td>
              <button class="btn btn-primary"><a href="update.php?updateid='.$row['acctid'].'" class="text-light">Update</a></button>
              <button class="btn btn-danger"><a href="delete.php?deleteid='.$row['acctid'].'" class="text-light">Delete</a></button>
              </td>
            </tr>';
    }
  } else {
    // Print any errors if the query fails
    echo "Error: " . mysqli_error($connection);
  }
?>


  
  </tbody>
</table>  
  </div>

   
  </body>
</html>