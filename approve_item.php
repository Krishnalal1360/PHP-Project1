<?php
include("./db_connect.php");
//
global $conn;
//
if ($_SERVER["REQUEST_METHOD"] === "POST"){
    if(isset($_POST["ON"])){
        //
        $order_number = $_POST["ON"] ?? '';
        //
        $query = "SELECT * FROM `records` WHERE `Order_Number`='$order_number'";
        $result = mysqli_query($conn, $query);
        $nrs = mysqli_num_rows($result);
        if($nrs == 1){
            //
            $query = "Update `records` SET `Status`='Approved' WHERE `Order_Number`='$order_number'";
            mysqli_query($conn, $query);
            //
            header("Location: http://localhost/E-commerce1/Admin/order_payment.php");
            exit();
        }else if($nrs > 1){
            //
            $query = "Update `records` SET `Status`='Approved' WHERE `Order_Number`='$order_number'";
            mysqli_query($conn, $query);
            //
            header("Location: http://localhost/E-commerce1/Admin/order_payment.php");
            exit();
        }
    }
}
?>