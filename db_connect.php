<?php
    $conn = mysqli_connect("localhost", "root", "", "ecom");
    if(isset($conn)){
        //echo "Connected to MySQL!";
    }else{
        die(mysqli_error($conn));
    }
?>