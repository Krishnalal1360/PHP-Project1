<?php
include("./db_connect.php");
//
session_start();

    if(isset($_POST["login-submit"])){
        $gmail = $_POST["gmail"];
        $password = $_POST["password"];
        //
    global $conn;
    $query = "SELECT * FROM `user_cred` WHERE `Gmail`='$gmail'";
    $result = mysqli_query($conn, $query);
    //
    if($result && mysqli_num_rows($result) > 0){
            
    $message = $redirect = $icon = "";

    $rows = mysqli_num_rows($result);

    if($rows == 1){
        $row = mysqli_fetch_assoc($result);
        $id = $row["ID"];
        if($row["Password"] != $password){
            $message = "Invalid Password!";
            $icon = "error";
            $redirect = "http://localhost/E-commerce1/User/login.php";
        }else{
            if($row["Gmail"] == $gmail && $row["Password"] == $password){
                $_SESSION["UID"] = $id;
                $message = "Login Successful!";
                $icon = "success";
                $redirect = "http://localhost/E-commerce1/User/otp.php";
            }
        }
    }else{
        $message = "Invalid Gmail!";
        $icon = "error";
        $redirect = "http://localhost/E-commerce1/User/login.php";              
    }    
    }else{
        $message = "Not Registered!";
        $icon = "error";
        $redirect = "http://localhost/E-commerce1/User/login.php";              
    } 
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login Result</title>
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
