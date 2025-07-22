<?php
include("./db_connect.php");
//
session_start();

$message = "";
$redirect = "";
$icon = "";

if (isset($_POST["register-submit"])) {
    $name = $_POST["name"];
    $gmail = $_POST["gmail"];
    $password = $_POST["password"];

    global $conn;

    $checkQuery = "SELECT * FROM `user_cred` WHERE `Gmail`='$gmail'";
    $checkResult = mysqli_query($conn, $checkQuery);
    $rows = mysqli_num_rows($checkResult);

    if ($rows == 0) {
        $insertQuery = "INSERT INTO `user_cred`(`Name`, `Gmail`, `Password`) VALUES ('$name', '$gmail','$password')";
        $insertResult = mysqli_query($conn, $insertQuery);
        //
        $query = "SELECT * FROM `user_cred` WHERE `Gmail`='$gmail'";
        $result = mysqli_query($conn, $query);
        $row = mysqli_fetch_assoc($result);
        $id = $row["ID"];
        //
        $_SESSION["UID"] = $id;
        //
        if ($insertResult) {
            $message = "Registration Successful!";
            $icon = "success";
            $redirect = "http://localhost/E-commerce1/User/login.php";
        } else {
            $message = "Registration Failed!";
            $icon = "error";
            $redirect = "http://localhost/E-commerce1/User/register.php";
        }
    } else {
        $message = "Already Registered!";
        $icon = "warning";
        $redirect = "http://localhost/E-commerce1/User/register.php";
    }
    //
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Registration Status</title>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>
    <script>
        Swal.fire({
            title: '<?php echo $message; ?>',
            icon: '<?php echo $icon; ?>',
            confirmButtonText: 'OK'
        }).then(() => {
            window.location.href = '<?php echo $redirect; ?>';
        });
    </script>
</body>
</html>
