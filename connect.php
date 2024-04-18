<?php
    $connection = new mysqli('localhost', 'root', '', 'f2bacus');

    if(!$connection){
        die (mysqli_error($mysqli));
    }
?>
