<?php
    $connection = new mysqli('localhost', 'root', '', 'dbbacusf2');

    if(!$connection){
        die (mysqli_error($mysqli));
    }
?>
