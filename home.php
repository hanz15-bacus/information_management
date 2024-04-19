<?php
    include 'connect.php';
?>

<!doctype html>
<html lang="en">
  <head>
  
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">


    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css">

    <title>Cruddddd</title>
  </head>
  <body>
  <nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand" href="#">ShopWise</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
      <a class="nav-link" href="index.php">Home <span class="sr-only">(current)</span></a>

        
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">Link</a>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Dropdown
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="#">Action</a>
          <a class="dropdown-item" href="#">Another action</a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="#">Something else here</a>
        </div>
      </li>
      <li class="nav-item">
        <a class="nav-link disabled" href="#">Disabled</a>
      </li>
    </ul>
    <form class="form-inline my-2 my-lg-0">
      <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
      <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
    </form>
  </div>
</nav>
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