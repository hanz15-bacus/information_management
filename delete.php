<?php
    include 'connect.php';

    if(isset($_GET['deleteid'])){
        $acctid = $_GET['deleteid'];

        $sql = "DELETE FROM tbuseraccount WHERE acctid = $acctid";
        $result = mysqli_query($connection, $sql);

        if($result){
            echo '<script>alert("Deleted Successfully"); window.location.href = "dashboard.php";</script>';
        } else {
            die(mysqli_error($connection));
        }
    }
?>
