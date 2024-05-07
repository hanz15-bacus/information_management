<?php
session_start();
require_once __DIR__ . '../connect.php';

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (isset($_SESSION['username']) && !empty($_SESSION['username'])) {
            $username = filter_var($_SESSION['username'], FILTER_SANITIZE_STRING);
        } else {
        
        }
    
        $total_price = 0;
        $cart_items = $_SESSION['cart'] ?? [];
    
        foreach ($cart_items as $item) {
            $total_price += $item['price'] * $item['quantity'];
        }
    
    
        $stmt = $connection->prepare("INSERT INTO tblorder (username, total_price) VALUES (?,?)");
        if ($stmt === false) {
            echo "Error preparing statement: " . $connection->error;
        } else {
            $stmt->bind_param("sd", $username, $total_price);
            $stmt->execute();
    
            if ($connection->affected_rows == 1) {
                $order_id = $connection->insert_id;
    
                foreach ($cart_items as $item) {
                    $stmt = $connection->prepare("INSERT INTO tblorder_items (order_id, product_code, quantity, price) VALUES (?,?,?,?)");
                    if ($stmt === false) {
                        echo "Error preparing statement: " . $connection->error;
                        break;
                    }
    
                    $stmt->bind_param("isii", $order_id, $item['code'], $item['quantity'], $item['price']);
                    $stmt->execute();
                }
    
                unset($_SESSION['cart']);
                echo "<script>alert('Thank you.'); window.location.href = '../index.php';</script>";
                exit();
            } else {
                echo "<script>alert('Error inserting order into database.'); window.location.href = '../includes/home.php';</script>";
            }
    
            $stmt->close();
        }
    
        $connection->close();
    }
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
    <link rel="stylesheet" type="text/css" href="../css/dashboard.css">
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
                <a class="nav-link" href="../includes/home.php">Home</a>
            </li> 
            <li class="nav-item">
                <a class="nav-link" href="../index.php">Log in</a>
            </li> 
        </ul>
    </div>
</nav>
<div class="container-fluid">
    <div class="row justify-content-center mt-4">
        <div class="col-md-10">
            <table class="table table-bordered">
                <h1>USERS</h1>
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


<!--sdnasd-->
<div class="container-fluid">
    <div class="row justify-content-center mt-4">
        <div class="col-md-10">
            <table class="table table-bordered">
            <h1>ORDERS</h1>
                <thead>
                <tr>
                    <th scope="col">Quantity</th>
                    <th scope="col">Price</th>
                    <th scope="col">Item</th>
                    <th scope="col">Order ID</th>
                </tr>
                </thead>
                <tbody>
                <?php
                $sql = "SELECT * FROM tblorder_items";
                $result = mysqli_query($connection, $sql);

                if ($result) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo '<tr>
                          <td>' . $row['quantity'] . '</td>
                          <td>' . $row['price'] . '</td>
                          <td>' . $row['item'] . '</td>
                          <td>' . $row['order_id'] . '</td>
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


<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"></script>
</body>
</html>
