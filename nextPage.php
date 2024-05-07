    <?php
session_start();
require_once __DIR__. '../connect.php';

$sql = "SELECT * FROM tblorder_items";
$result = mysqli_query($connection, $sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cruddddd</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css">
</head>
<body>

<div class="container-fluid">
    <div class="row justify-content-center mt-4">
        <div class="col-md-10">
            <table class="table table-bordered table-hover table-striped table-custom">
                <h1 class="text-center">ORDERS</h1>
                <thead>
                <tr>
                    <th scope="col">Quantity</th>
                    <th scope="col">Price</th>
                    <th scope="col">Item</th>
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
                          <td>$' . $row['price'] . '</td>
                          <td>' . $row['item'] . '</td>
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
