<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap CSS Link-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" crossorigin="anonymous">
    <!-- Font-awesome Link-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- External CSS Link-->
    <link rel="stylesheet" href="../Assets/style-admin.css">
    <!-- Internal CSS Link-->
    <style>
        .profile_pic{
            width: 200px;
            height: 200px;
            object-fit: contain;
            display : block;
        }
    </style>
    <title>Admin Dashboard</title>
</head>
<body>
    <!-- first child -->
     <!-- navbar -->
      <div class="container-fluid p-0">
        <nav class="navbar navbar-expand-lg navbar-light bg-info">
            <div class="container-fluid">
                <img src="../Images/logo.png" alt="Image of logo" class="logo">
                <nav class="navbar navbar-expand-lg">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link" href="">Welcome Admin</a>
                        </li>
                    </ul>
                </nav>
            </div>
        </nav>
      </div>
    <!-- second child -->
     <div class="bg-light">
        <h3 class="text-center p-1">
            Product Details
        </h3>
     </div>
    <!-- third child -->
     <div class="row">
        <div class="col-md-12 bg-secondary p-1 d-flex align-items-center">
            <div>
                <a>
                    <img src="../Images/profile_pic.jpg" alt="Image of Profile Picture" class="profile_pic">
                </a>
                <p class="text-light text-left ps-5">Joseph Stallin</p>
            </div>
                <div class="text-center ms-4">
                <a href="http://localhost/E-commerce1/Admin/insert_product.php" class="btn btn-info text-light my-1 w-100">Insert Product</a>
                <a href="http://localhost/E-commerce1/Admin/view_products.php" class="btn btn-info text-light my-1 w-100">View Products</a>
                <a href="http://localhost/E-commerce1/Admin/order_payment.php" class="btn btn-info text-light my-1 w-100">Order & Payment</a>
                <a href="http://localhost/E-commerce1/Admin/users.php" class="btn btn-info text-light my-1 w-100">Users</a>
                <a href="http://localhost/E-commerce1/Admin/order_stock.php" class="btn btn-info text-light my-1 w-100">Order Stock</a>
            </div>
        </div>
     </div>
    <!-- last child -->
    <div class="bg-info p-3 text-center footer" style="margin-top: 150px;">
        <p>All rights reserved &copy;- Designed by WeKart-2025</p>
    </div>
    <!-- Bootstrap JS Link-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js" integrity="sha384-j1CDi7MgGQ12Z7Qab0qlWQ/Qqz24Gc6BM0thvEMVjHnfYGF0rmFCozFSxQBxwHKO" crossorigin="anonymous"></script>
</body>
</html>