<?php
if(isset($_GET['title']) && isset($_GET['icon'])){
    $swalMsg = $_GET['title'];
    $swalType = $_GET['icon'];
    //
    $redirect = 'order_payment.php';
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Redirecting...</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>
<?php if(!empty($swalMsg) && !empty($swalType) && !empty($redirect)){?>
<script>
Swal.fire({
    icon: '<?= htmlspecialchars($swalType) ?>',
    title: '<?= htmlspecialchars($swalMsg) ?>',
    confirmButtonText: 'OK'
}).then(() => {
    <?php if(!empty($redirect)){ ?>
    window.location.href = '<?= htmlspecialchars($redirect) ?>';
    <?php }?>
});
</script>
<?php }?>
</body>
</html>