<?php
session_start();
//
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
    //
$query = "SELECT * FROM `records` WHERE `ID`='$rid'";
$result = mysqli_query($conn, $query);
$row = mysqli_fetch_assoc($result);

$price = $row["Price"];
$quantity = $row["Quantity"];
$title = $row["Title"];
$quantity += 1;
$total_price = $price * $quantity;

$query1 = "SELECT * FROM `order_stock` WHERE `Product`='$title'";
$result1 = mysqli_query($conn, $query1);
$row1 = mysqli_fetch_assoc($result1);
$quantity1 = $row1["Quantity"];

if($quantity > $quantity1){
    $swalType = 'error';
    $swalMsg = 'Out Of Stock';
}else{
    $query = "UPDATE `records` SET `Quantity`='$quantity', `Total_Price`='$total_price' WHERE `ID`='$rid'";
    mysqli_query($conn, $query);
    //
    echo "
    <script>
        window.location.href='http://localhost/E-commerce1/User/cart.php'
    </script>
    ";
}
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Updating Cart</title>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>
<script>
<?php if($swalMsg == 'Out Of Stock' && $swalType == 'error'){?>
Swal.fire({
    icon: '<?= $swalType ?>',
    title: '<?= $swalMsg ?>',
    confirmButtonText: 'OK'
}).then(() => {
    window.location.href = 'http://localhost/E-commerce1/User/cart.php';
});
<?php } ?>
</script>
</body>
</html>