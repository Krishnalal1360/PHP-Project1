<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Logging out...</title>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>
    <script>
        Swal.fire({
            icon: 'success',
            title: 'Logged Out Successfully',
            text: 'You have been logged out.',
            confirmButtonText: 'OK'
        }).then(() => {
            window.location.href = 'http://localhost/E-commerce1/User/store.php';
        });
    </script>
</body>
</html>

<?php
session_start();
unset($_SESSION["UID"]);
session_destroy();
?>