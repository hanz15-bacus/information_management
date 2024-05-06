<?php
session_start();

// Include connection file with proper path
require_once __DIR__ . '/connect.php';

// Process checkout form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate and sanitize user input
    if (isset($_SESSION['username']) && !empty($_SESSION['username'])) {
    $username = filter_var($_SESSION['username'], FILTER_SANITIZE_STRING);
} else {
    // Handle the case when the 'username' key is not set or is null
}

    $total_price = 0;
    $cart_items = $_SESSION['cart']?? []; // Initialize with empty array if not set

    // Calculate total price
    foreach ($cart_items as $item) {
        $total_price += $item['price'] * $item['quantity'];
    }

    // Insert order into database
    $stmt = $connection->prepare("INSERT INTO checkout1 (username, total_price) VALUES (?,?)");
    if ($stmt === false) {
        // Print an error message if the statement could not be prepared
        echo "Error preparing statement: " . $connection->error;
    } else {
        $stmt->bind_param("sd", $username, $total_price);
        $stmt->execute();

        // Check if the INSERT statement was successful
        if ($connection->affected_rows == 1) {
            $order_id = $connection->insert_id;

            // Insert order items into database
            foreach ($cart_items as $item) {
                $stmt = $connection->prepare("INSERT INTO checkout_items (order_id, product_code, quantity, price) VALUES (?,?,?,?)");
                if ($stmt === false) {
                    // Print an error message if the statement could not be prepared
                    echo "Error preparing statement: " . $connection->error;
                    break;
                }

                $stmt->bind_param("isii", $order_id, $item['code'], $item['quantity'], $item['price']);
                $stmt->execute();
            }

            // Clear cart session
            unset($_SESSION['cart']);

            // Redirect to thank you page
            header('Location: https://example.com/thankyou.php'); // absolute URL
            exit();
        } else {
            // Print an error message if the INSERT statement was not successful
            echo "Error inserting order into database.";
        }

        $stmt->close();
    }

    $connection->close();
}

?>

<!-- HTML remains the same -->
<!DOCTYPE html>
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
                        // Initialize the cart as an empty array if it is not defined or is empty
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
            <input type="submit" value="Place Order" class="btn btn-primary">
        </form>
    </div>
</body>
</html>