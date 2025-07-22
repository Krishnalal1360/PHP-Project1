<?php
    if(isset($_GET["title"]) && (isset($_GET["icon"]))){
        //
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
<?php if($swalMsg == "Out Of Stock" && $swalType == "error"){?>
Swal.fire({
    icon: '<?= $swalType ?>',
    title: '<?= $swalMsg ?>',
    confirmButtonText: 'OK'
}).then(() => {
    window.location.href = 'http://localhost/E-commerce1/User/user_store.php?gmail=$gmail';
});
<?php } ?>
</script>
</body>
</html>