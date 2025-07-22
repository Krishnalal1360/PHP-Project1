<?php
    if(isset($_GET["gmail"]) && isset($_GET["title"]) && (isset($_GET["icon"]))){
        //
        $gmail = $_GET["gmail"];
        $swalMsg = $_GET["title"];
        $swalType = $_GET["icon"];
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Redirecting...</title>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>
<script>
<?php if($swalMsg == "Already Confirmed For Purchase" && $swalType == "warning" && !empty($gmail)){ ?>
Swal.fire({
    icon: '<?= $swalType ?>',
    title: '<?= $swalMsg ?>',
    confirmButtonText: 'OK'
}).then(() => {
    window.location.href = 'http://localhost/E-commerce1/User/user_store.php?gmail=<?= urlencode($gmail) ?>';
});
<?php } ?>
</script>
</body>
</html>