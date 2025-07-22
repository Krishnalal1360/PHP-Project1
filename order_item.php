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
        $query = "UPDATE `records` SET `Order_Placed`=NOW() WHERE `Gmail`='$gmail' AND `Title`='$title' AND `Brand`='$brand' AND `Category`='$category'";
        $result = mysqli_query($conn, $query);
        if($result){
            echo "<script>
            alert('Order Placed Successfully!');
            window.location.href='http://localhost/E-commerce1/User/cart.php?gmail=$gmail'
            </script>";
        }else{
            echo "<script>
            alert('Failed to placed order!');
            </script>";
        }
    }
?>