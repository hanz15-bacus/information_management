<?php
   session_start();
   require_once __DIR__ . '../connect.php';
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
            <?php
                if(isset($_POST['btnOrder'])){
                    $place_order = $_POST['cart'];


                    $sql1 = "INSERT INTO tblorder_items (order_id, cart) values('".$_SESSION['product_code']."', '".$place_order."')";
                    mysqli_query($connection, $sql1);
                }
            ?>
        </form>
    </div>
</body>
</html>

