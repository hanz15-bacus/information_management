<?php
    $connection = new mysqli('localhost', 'root', '', 'F2Bacus');

    if(!$connection){
        die (mysqli_error($mysqli));
    }
?>
