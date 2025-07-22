<?php
include("./db_connect.php");

if(isset($_POST["rid"])){
    //
    $rid = $_POST["rid"];

global $conn;
$query = "DELETE FROM `records` WHERE `ID` = '$rid'";
mysqli_query($conn, $query);

echo "
<script>
window.location.href='http://localhost/E-commerce1/User/cart.php'
</script>
";
}
?>