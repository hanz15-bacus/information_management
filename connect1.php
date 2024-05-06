<?php
    $connection = new mysqli('localhost', 'root', '', 'checkout');

    if(!$connection){
        die (mysqli_error($mysqli));
    }
?>
