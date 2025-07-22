<?php
session_start();
include("./db_connect.php");

$swalType = "";
$swalMessage = "";
$redirectUrl = "";

if(isset($_POST["title"])){
    //
    $title = $_POST["title"];
    $id = $_SESSION["UID"] ?? '';

    if(empty($id)){
        $swalType = "error";
        $swalMessage = "Session expired. Please log in again.";
        $redirectUrl = "http://localhost/E-commerce1/User/store.php";
    }else{
        $query = "SELECT * FROM `user_cred` WHERE `ID` = '$id'";
        $result = mysqli_query($conn, $query);
        if($result && mysqli_num_rows($result) > 0){
            $row = mysqli_fetch_assoc($result);
            $name = $row["Name"];
            $gmail = $row["Gmail"];
            //
            $query1 = "SELECT * FROM `product_details` WHERE `Title` = '$title'";
            $result1 = mysqli_query($conn, $query1);

            if($result1 && mysqli_num_rows($result1) > 0){
                $rows = mysqli_fetch_assoc($result1);
                $brand = $rows["Brand"];
                $category = $rows["Category"];
                $image = $rows["Image"];
                $price = $rows["Price"];

                $query5 = "SELECT * FROM `order_stock` WHERE `Product`='$title' AND `Quantity`='0'";
                $result5 = mysqli_query($conn, $query5);

                if($result5 && mysqli_num_rows($result5) > 0){
                    $swalType = "error";
                    $swalMessage = "Out Of Stock";
                    $redirectUrl = "http://localhost/E-commerce1/User/user_store.php";
                }else{
                    $insert = "INSERT INTO `records`(`Name`, `Gmail`, `Title`, `Brand`, `Category`, `Image`, `Price`, `Quantity`, `Total_Price`, `Order_Placed`, `Order_Number`, `Status`)
                               VALUES('$name', '$gmail', '$title', '$brand', '$category', '$image', '$price', '1', '$price', '', '', 'In Cart')";
                    //
                    $result4 = mysqli_query($conn, $insert);
                    //
                    /*$query3 = "SELECT * FROM `records` WHERE `Gmail`='$gmail' AND `Title`='$title'";
                    $result3 = mysqli_query($conn, $query3);
                    $row = mysqli_fetch_assoc($result3);
                    $_SESSION["RID"] = $row["ID"];*/
                    //

                    if($result4){
                        $swalType = "success";
                        $swalMessage = "Item Added to Wishlist Cart Successfully";
                        $redirectUrl = "http://localhost/E-commerce1/User/user_store.php";
                    }else{
                        $swalType = "error";
                        $swalMessage = "Database error: " . mysqli_error($conn);
                        $redirectUrl = "http://localhost/E-commerce1/User/user_store.php";
                    }
                }
            }else{
                $swalType = "error";
                $swalMessage = "Product not found.";
                $redirectUrl = "http://localhost/E-commerce1/User/user_store.php";
            }
        }else{
            $swalType = "error";
            $swalMessage = "User not found.";
            $redirectUrl = "http://localhost/E-commerce1/User/store.php";
        }
    }
} else {
    $swalType = "error";
    $swalMessage = "Invalid access.";
    $redirectUrl = "http://localhost/E-commerce1/User/user_store.php";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Redirecting...</title>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>
<script>
document.addEventListener('DOMContentLoaded', function() {
    Swal.fire({
        icon: '<?= htmlspecialchars($swalType, ENT_QUOTES) ?>',
        title: '<?= htmlspecialchars($swalMessage, ENT_QUOTES) ?>',
        confirmButtonText: 'OK'
    }).then(() => {
        window.location.href = '<?= htmlspecialchars($redirectUrl, ENT_QUOTES) ?>';
    });
});
</script>
</body>
</html>
