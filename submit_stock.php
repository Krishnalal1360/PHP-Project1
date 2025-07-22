<?php
    include("./db_connect.php");
    //
    global $conn;
    //
    if($_SERVER["REQUEST_METHOD"] == "POST"){
        //
        $id = $_POST["id"];
        $product_title = $_POST["product_title"];
        $title = $_POST["title"];
        $brand = $_POST["brand"];
        $category = $_POST["category"];
        $quantity = $_POST["quantity"];
        $status = $_POST["status"];
        //
        $query1 = "UPDATE `order_stock` SET `Product`='$title', `Quantity`='$quantity', `Status`='$status' WHERE `ID`='$id'";
        mysqli_query($conn, $query1);
        //
        $query2 = "UPDATE `product_details` SET `Title`='$title', `Brand`='$brand', `Category`='$category' WHERE `Title`='$product_title'";
        mysqli_query($conn, $query2);     
        //
        echo "
            <script>
                window.location.href = 'http://localhost/E-commerce1/Admin/order_stock.php';
            </script>
        ";
    }
?>