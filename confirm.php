<?php
    include("./db_connect.php");
    //
    if(isset($_POST["RID"])){
        //
        global $conn;
        //
        $rid = $_POST["RID"];
        //
        $query1 = "SELECT * FROM `records` WHERE `ID`='$rid'";
        $result1 = mysqli_query($conn, $query1);
        //
        if($result1 && mysqli_num_rows($result1) > 0){
            while($rows = mysqli_fetch_assoc($result1)){
                //
                $title = $rows["Title"];
                $quantity1 = $rows["Quantity"];
                //
                $query = "SELECT * FROM `order_stock` WHERE `Product`='$title'";
                $result = mysqli_query($conn, $query);
                if($result && mysqli_num_rows($result) > 0){
                    //
                    $row = mysqli_fetch_assoc($result);
                    $quantity = $row["Quantity"];
                    //
                    if(($quantity == 0) || ($quantity - $quantity1) < 0){
                        $status = "Out Of Stock";
                        $status1 = "Out Of Stock";
                        //
                        $query = "UPDATE `records` SET `Status`='$status1' WHERE `ID`='$rid'";
                        mysqli_query($conn, $query);
                    }else{
                        $status = "In Stock";
                        $status1 = "Confirmed";
                        $quantity = $quantity-$quantity1;
                        //
                        $query = "UPDATE `records` SET `Status`='$status1' WHERE `ID`='$rid'";
                        mysqli_query($conn, $query);
                        //
                        $query = "UPDATE `order_stock` SET `Quantity`='$quantity', `Status`='$status', `User_Quantity`='$quantity1' WHERE `Product`='$title'";
                        mysqli_query($conn, $query);
                    }
                }
            }
        }
        //
        echo "
            <script>
                window.location.href = 'http://localhost/E-commerce1/User/user_store.php';
            </script>
        ";
    }
//
    if(isset($_POST["ON"])){
        //
        global $conn;
        //
        $on = $_POST["ON"];
        //
        $query1 = "SELECT * FROM `records` WHERE `Order_Number`='$on'";
        $result1 = mysqli_query($conn, $query1);
        //
        if($result1 && mysqli_num_rows($result1) > 0){
            while($rows = mysqli_fetch_assoc($result1)){
                //
                $title = $rows["Title"];
                $quantity1 = $rows["Quantity"];
                //
                $query = "SELECT * FROM `order_stock` WHERE `Product`='$title'";
                $result = mysqli_query($conn, $query);
                if($result && mysqli_num_rows($result) > 0){
                    //
                    $row = mysqli_fetch_assoc($result);
                    $quantity = $row["Quantity"];
                    //
                    if(($quantity == 0) || ($quantity - $quantity1) < 0){
                        $status = "Out Of Stock";
                        $status1 = "Out Of Stock";
                        //
                        $query = "UPDATE `records` SET `Status`='$status1' WHERE `Order_Number`='$on'";
                        mysqli_query($conn, $query);
                    }else{
                        $status = "In Stock";
                        $status1 = "Confirmed";
                        $quantity = $quantity-$quantity1;
                        //
                        $query = "UPDATE `records` SET `Status`='$status1' WHERE `Order_Number`='$on'";
                        mysqli_query($conn, $query);
                        //
                        $query = "UPDATE `order_stock` SET `Quantity`='$quantity', `Status`='$status', `User_Quantity`='$quantity1' WHERE `Product`='$title'";
                        mysqli_query($conn, $query);
                    }
                }
            }
        }
        //
        echo "
            <script>
                window.location.href = 'http://localhost/E-commerce1/User/user_store.php';
            </script>
        ";
    }
?>