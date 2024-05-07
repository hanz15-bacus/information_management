<?php

session_start();
require_once __DIR__ . '/../connect.php';

if (isset($_POST['submit'])) {
    // Retrieve form data
    $item = $_POST['item'];
    $price = $_POST['price'];
    $quantity = $_POST['quantity'];

    if (empty($item) || empty($price) || empty($quantity)) {
        echo '<script>alert("Must fill all needed information"); window.location.href = "../nextPage.php";</script>';
    } else {
        // Insert data into tblorder_items
        $sql = "INSERT INTO tblorder_items (item, price, quantity) VALUES ('$item', '$price', '$quantity')";
        $result = mysqli_query($connection, $sql);

        $total_price = $quantity * $price;

        if ($result) {
            // Update the price column in tblorder_items with the total price
            $sql = "UPDATE tblorder_items SET price = '$total_price' WHERE item = '$item' AND quantity = '$quantity'";
            $result = mysqli_query($connection, $sql);

            if ($result) {
                // Insert data into tblorder
                $sql = "INSERT INTO tblorder (username) VALUES ('$username')";
                $result = mysqli_query($connection, $sql);

                if ($result) {
                    echo '<script>alert("Registered Successfully"); window.location.href = "../nextPage.php";</script>';
                } else {
                    echo '<script>alert("Registered Successfully"); window.location.href = "../nextPage.php";</script>';
                }
            } 
        }
    }
}
?>



 <!DOCTYPE html>
  <html>
  <head>
      <meta charset="UTF-8">
      <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
      <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
      <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
      
      <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded:opsz,wght,FILL,GRAD@48,400,0,0">
      <script src="../js/script.js"></script>
      <link rel="stylesheet" href="../css/jewelry.css">
      <title>Login and Register</title>
  </head>
  <body>
  <div class="container">
  <h1>Jewelry Section</h1>
  <!-- Jewelry items -->
  <div class="jewelry-item">
    <div class="item-details">
      <a href="../checkout.php"><img src="../images/jewelry1.jpg" alt="Jewelry 1" aria-label="Gold Necklace"></a>
      <a href="../checkout.php"><h2>Gold Necklace</h2></a>
      <p>Price: $100</p> 
      <p>Quantity: <span id="gold-necklace-quantity">10</span></p> 
    </div>
    <div class="item-details">
      <a href="../checkout.php"><img src="../images/jewelry2.webp" alt="Jewelry 2" aria-label="Silver Bracelet"></a>
      <a href="../checkout.php"><h2>Silver Bracelet</h2></a>
      <p>Price: $80</p> 
      <p>Quantity: <span id="silver-bracelet-quantity">15</span></p> 
    </div>
    <div class="item-details">
      <a href="../checkout.php"><img src="../images/jewelry3.jpg" alt="Jewelry 3" aria-label="Diamond Ring"></a>
      <a href="../checkout.php"><h2>Diamond Ring</h2></a>
      <p>Price: $200</p> 
      <p>Quantity: <span id="diamond-ring-quantity">5</span></p> 
    </div>
  </div>
</div>
<!--ORDER FORM-->

<div class="container">
      <div class="form-container">
        <h1>ORDER FORM</h1>
        <form method="post">
          <div class="form-group">
            <label for="acctid">ITEM NAME</label>
            <input type="text" class="form-control" id="acctid" placeholder="Enter item" name="item" required autocomplete="off">
          </div>

          <div class="form-group">
            <label for="emailadd">PRICE</label>
            <input type="number" class="form-control" id="emailadd" placeholder="Enter price $" name="price" required autocomplete="off">
          </div>

          <div class="form-group">
            <label for="username">QUANTITY</label>
            <input type="number" class="form-control" id="username" placeholder="Enter quantity" name="quantity" required autocomplete="off">
          </div>


          <button type="submit" class="btn btn-primary" name="submit">Submit</button>
        </form>
      </div>
    </div>
  <script>
   
    $('.item-details button').click(function() {
        var itemName = $(this).siblings('input[name="item"]').val();
        var itemPrice = $(this).siblings('input[name="price"]').val();

        
        $.ajax({
            type: "POST",
            url: "../nextPage.php", /
            data: { itemName: itemName, itemPrice: itemPrice },
            success: function(response) {
                console.log(response);
            }
        });
    });
</script>

  </body>
  </html>
