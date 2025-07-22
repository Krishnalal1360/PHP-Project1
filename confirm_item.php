<?php
    include("./db_connect.php");
?>

<?php
    //
    if(isset($_GET["gmail"]) && isset($_GET["title"]) && isset($_GET["brand"]) && isset($_GET["category"])){
        $gmail = $_GET["gmail"];
        $title = $_GET["title"];
        $brand = $_GET["brand"];
        $category = $_GET["category"];
        $query = "SELECT * FROM `records` WHERE `Gmail`='$gmail' AND `Title`='$title' AND `Brand`='$brand' AND `Category`='$category'";
        $result = mysqli_query($conn, $query);
        $row = mysqli_fetch_assoc($result);
        if(empty($row['Order_Placed'])){
            echo "<script>
            alert('Item not ordered yet!');
            window.location.href='http://localhost/E-commerce1/Admin/order_payment.php';
            </script>";
            exit();
        }else{
            $query = "UPDATE `records` SET `Status`='Approved For Delivery' WHERE `Gmail`='$gmail' AND `Title`='$title' AND `Brand`='$brand' AND `Category`='$category'";
            $result = mysqli_query($conn, $query);
            if($result){
                echo "<script>
                alert('Item Approved For Delivery!');
                window.location.href='http://localhost/E-commerce1/Admin/order_payment.php';
                </script>";
            }else{
                echo "<script>
                alert('Failed to approved delivery!');
                </script>";
            }
        }
    }
?>