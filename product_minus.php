<?php
//
session_start();
include("./db_connect.php");
global $conn;

if(isset($_POST["rid"])){
//
$rid = $_POST["rid"];
//
$_SESSION["RID"] = $rid;
}
//
$rid = $_SESSION["RID"] ?? '';
//
if(!empty($rid)){

$query = "SELECT * FROM `records` WHERE `ID` = '$rid'";
//
$result = mysqli_query($conn, $query);
$row = mysqli_fetch_assoc($result);

$price = $row["Price"];
$quantity = $row["Quantity"];
$total_price = $row["Total_Price"];
$quantity = $quantity-1;

if($quantity == 0){
    $query = "DELETE FROM `records` WHERE `ID` = '$rid'";
    mysqli_query($conn, $query);
}else{
    $total_price1 = $total_price - $price;
    $query = "UPDATE `records` SET `Quantity`='$quantity', `Total_Price`='$total_price1' WHERE `ID`='$rid'";
    mysqli_query($conn, $query);
}

echo "
<script>
window.location.href='http://localhost/E-commerce1/User/cart.php'
</script>
";
}
?>