<?php
session_start();
require_once __DIR__. '../connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Capture the username from the session or form data
    $username = isset($_SESSION['username'])? $_SESSION['username'] : ''; // Assuming username is stored in session

    // Calculate the total price
    $totalPrice = 0;
    foreach ($_SESSION['cart'] as $item) {
        $subtotal = $item['price'] * $item['quantity'];
        $totalPrice += $subtotal;
    }

    // Insert order information into tblorder_
    $orderQuery = "INSERT INTO tblorder (username, total_price) VALUES (?,?)";
    $stmt = $connection->prepare($orderQuery);
    $stmt->bind_param("ss", $username, $totalPrice);
    $stmt->execute();

    // Get the last inserted order ID using the mysqli_stmt object
    $orderId = $stmt->insert_id;

    // Insert order items into tblorder_items
    foreach ($_SESSION['item'] as $item) {
        $quantity = $item['quantity'];
        $price = $item['price'];
        $productCode = $item['product_code'];
        $itemName = $item['item']; 

        $itemQuery = "INSERT INTO tblorder_item (order_id, product_code, quantity, price, item) VALUES (?,?,?,?,?)";
        $stmt = $connection->prepare($itemQuery);
        $stmt->bind_param("iisss", $orderId, $productCode, $quantity, $price, $itemName);
        $result = $stmt->execute();

        if (!$result) {
            error_log("Error inserting item: ". $stmt->error);
        }
    }

    // Mo clear ang cart after placing the order
    unset($_SESSION['cart']);
    $_SESSION['cart'] = [];

    // Redirect to the next page
    header("Location: nextPage.php");
    exit;
}
?>
  <html lang="en">
<head>
    <title>Checkout</title>
    <link rel= "stylesheet" type = "text/css" href="../css/checkout.css">

    
</head>
<body>
    <div class="container">
        <h1>Checkout</h1>
        <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Product Code</th>
                        <th>Product Name</th>
                        <th>Quantity</th>
                        <th>Price</th>
                        <th>Subtotal</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if (!isset($_SESSION['cart']) || empty($_SESSION['cart'])) {
                        $_SESSION['cart'] = [];
                    }
                    
                    $total_price = 0;
                    foreach ($_SESSION['cart'] as $item) {
                        $subtotal = $item['price'] * $item['quantity'];
                        $total_price += $subtotal;
                ?>
                    <tr>
                        <td><?php echo $item['code'];?></td>
                        <td><?php echo $item['name'];?></td>
                        <td><?php echo $item['quantity'];?></td>
                        <td><?php echo $item['price'];?></td>
                        <td><?php echo $subtotal;?></td>
                    </tr>
                    <?php }?>
                </tbody>
                <tfoot>
                    <tr>
                        <th colspan="4">Total</th>
                        <th><?php echo $total_price;?></th>
                    </tr>
                </tfoot>
            </table>
        
            <input type="submit" value="Place Order" class="btn btn-primary" name ="btnOrder">
        </form>
    </div>
</body>
</html>