<?php
    include("./db_connect.php");

    // Handle after form submission (placed before HTML)
    $showAlert = false;
    $alertType = "";
    $alertMsg = "";

    if (isset($_POST["pro-insert"])) {
        $pt = $_POST["pro-title"];
        $pd = $_POST["pro-description"];
        $pk = $_POST["pro-keyword"];
        $pb = $_POST["pro-brand"];
        $pc = $_POST["pro-category"];
        $pp = $_POST["pro-price"];
        $pq = $_POST["pro-quantity"];

        $dir = "../Uploads/";
        $ts = time();
        $pi = $_FILES["pro-image"]["name"];
        $pi_tmp = $_FILES["pro-image"]["tmp_name"];
        $pi_file = $ts . '_' . basename($pi);
        $target_path = $dir .  $pi_file;

        if ($pt == '' || $pd == '' || $pk == '' || $pb == '' || $pc == '' || $pi == '' || $pp == '' || $pq == '') {
            $showAlert = true;
            $alertType = "warning";
            $alertMsg = "Field cannot be empty!";
        }else{
            move_uploaded_file($pi_tmp, $target_path);

            $qry = "INSERT INTO `product_details` 
                    (`Title`, `Description`, `Keyword`, `Brand`, `Category`, `Image`, `Price`)
                    VALUES 
                    ('$pt', '$pd', '$pk', '$pb', '$pc', '$pi_file', '$pp')";
            $res = mysqli_query($conn, $qry);
            //
            $query = "INSERT INTO `order_stock`(`Product`, `Quantity`, `Status`, `User_Quantity`) 
            VALUES ('$pt', '$pq', 'In Stock', '1')";
            mysqli_query($conn, $query);
            //
            if($res){
                header("Location: http://localhost/E-commerce1/Admin/admin.php");
                exit();
            }else{
                $showAlert = true;
                $alertType = "error";
                $alertMsg = "Failed to insert!";
            }
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Insert Products</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body class="bg-light">
    <div class="container mt-3">
        <div class="mb-3">
            <a href="admin.php" class="btn btn-primary">
                 <i class="fas fa-home"></i> Home
            </a>
        </div>
        <h1 class="text-center">Insert Products</h1>
        <form action="" method="post" enctype="multipart/form-data">
            <div class="form-outline mb-2 w-50 m-auto">
                <label for="pt" class="form-label">Product Title</label>
                <input type="text" class="form-control" id="pt" name="pro-title" placeholder="Enter product title" required>
            </div>
            <div class="form-outline mb-2 w-50 m-auto">
                <label for="pd" class="form-label">Product Description</label>
                <input type="text" class="form-control" id="pd" name="pro-description" placeholder="Enter product description" required>
            </div>
            <div class="form-outline mb-2 w-50 m-auto">
                <label for="pk" class="form-label">Product Keyword</label>
                <input type="text" class="form-control" id="pk" name="pro-keyword" placeholder="Enter product keyword" required>
            </div>
            <div class="form-outline mb-2 w-50 m-auto">
                <label for="pb" class="form-label">Product Brand</label>
                <input type="text" class="form-control" id="pb" name="pro-brand" placeholder="Enter product brand" required>
            </div>
            <div class="form-outline mb-2 w-50 m-auto">
                <label for="pc" class="form-label">Product Category</label>
                <input type="text" class="form-control" id="pc" name="pro-category" placeholder="Enter product category" required>
            </div>
            <div class="form-outline mb-2 w-50 m-auto">
                <label for="pq" class="form-label">Product Quantity</label>
                <input type="text" class="form-control" id="pq" name="pro-quantity" placeholder="Enter product quantity" required>
            </div>
            <div class="form-outline mb-2 w-50 m-auto">
                <label class="form-label" for="pi">Upload an image</label>
                <input type="file" class="form-control" id="pi" name="pro-image" required>
            </div>
            <div class="form-outline mb-2 w-50 m-auto">
                <label for="pp" class="form-label">Product Price</label>
                <input type="text" class="form-control" id="pp" name="pro-price" placeholder="Enter product price" required>
            </div>
            <div class="form-outline mb-2 w-50 m-auto text-center">
                <input type="submit" class="btn btn-success" name="pro-insert" value="Insert Product">
            </div>
        </form>
    </div>

    <?php if ($showAlert): ?>
    <script>
        Swal.fire({
            icon: '<?= $alertType ?>',
            title: '<?= $alertMsg ?>',
            confirmButtonText: 'OK'
        });
    </script>
    <?php endif; ?>
</body>
</html>
