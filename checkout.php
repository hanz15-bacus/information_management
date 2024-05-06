<?php
session_start();
require_once __DIR__. '../connect.php';

// Check if the form has been submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Capture the username from the session or form data
    $username = isset($_SESSION['username'])? $_SESSION['username'] : ''; // Assuming username is stored in session

    // Calculate the total price
    $total_price = 0;
    foreach ($_SESSION['cart'] as $item) {
        $subtotal = $item['price'] * $item['quantity'];
        $total_price += $subtotal;
    }

    // Insert order information into tblorder
    $order_query = "INSERT INTO tblorder (username, total_price) VALUES (?,?)";
    $stmt = $connection->prepare($order_query);
    $stmt->bind_param("ss", $username, $total_price);
    $stmt->execute();

    // Get the last inserted order ID
    $order_id = $connection->insert_id;

    // Insert order items into tblorder_item
    foreach ($_SESSION['cart'] as $item) {
        $quantity = $item['quantity'];
        $price = $item['price'];
        $product_code = $item['code'];
        $item_name = $item['name']; // Assuming 'name' is available in the cart item array
    
        $item_query = "INSERT INTO tblorder_item (order_id, product_code, quantity, price, item) VALUES (?,?,?,?,?)";
        $stmt = $connection->prepare($item_query);
        $stmt->bind_param("iisss", $order_id, $product_code, $quantity, $price, $item_name);
        $result = $stmt->execute();
    
        if (!$result) {
            // Log or display the error
            echo "Error inserting item: ". $stmt->error;
        }
    }

    // Clear the cart after successful order placement
    unset($_SESSION['cart']);
    $_SESSION['cart'] = [];

    // Redirect or display success message
    header("Location: nextPage.php"); // Redirect to a success page
    exit;
}
?>

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

