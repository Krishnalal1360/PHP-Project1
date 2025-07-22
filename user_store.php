<?php
  include("./db_connect.php");
  include("../Includes/user_products.php");
  //
  global $conn;
  //
  session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap CSS Link-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" crossorigin="anonymous">
    <!-- Font-awesome Link-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="../Assets/style-cart.css">
    <title>E-commerce Store</title>
</head>
<body>
    <!-- first child-->
<div class="container-fluid p-0">
    <!-- navbar -->
<nav class="navbar navbar-expand-lg navbar-light bg-info">
  <div class="container-fluid">
    <img src="../Images/logo.png" alt="Image Of Item Cart" class="logo">
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
      aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <form class="d-flex" action="search_product.php" method="post">
      <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search" name="search_product">
      <input type="submit" class="btn btn-outline-light">
    </form>
  </div>
</nav>
</div>

<!-- second child-->
<div class="container-fluid p-0">
    <!-- navbar -->
<nav class="navbar navbar-expand-lg navbar-dark bg-secondary">
      <div class="d-flex align-items-center" style="gap: 15px;">
      <?php
            echo "
                  <a href='http://localhost/E-commerce1/User/cart.php' class='text-white fs-5 text-decoration-none' style='margin-left:10px;'>
                    <i class='fa-solid fa-cart-shopping'></i>
                    <span>Cart</span>
                  </a>
                ";
      ?>
      <div class="dropdown" style="margin-left: 10px;">
      <button class="btn btn-secondary dropdown-toggle text-white fs-5" type="button" id="accountDropdown" data-bs-toggle="dropdown" aria-expanded="false">
        <i class="fa-solid fa-user"></i> Account
      </button>
      <ul class="dropdown-menu" aria-labelledby="accountDropdown">
        <li><a class="dropdown-item" href="http://localhost/E-commerce1/Includes/profile.php">Profile</a></li>
        <li><a class="dropdown-item" href="http://localhost/E-commerce1/Includes/orders.php">Orders</a></li>
        <li><hr class="dropdown-divider"></li>
        <li><a class="dropdown-item text-danger" href="http://localhost/E-commerce1/Includes/logout.php">Logout</a></li>
      </ul>
      </div>
      </div>
</nav>
</div>

<!-- third child-->
<div class="bg-light">
    <h3 class="text-center">E-Commerce Store</h3>
</div>

<!-- fourth child-->
<div class="row">
  <!-- item-card-body-->
  <div class="col-md-10">
    <!-- products-->
    <div class="row">
      <?php
            getUserProducts();
      ?>
      </div>
  </div>
</div>

    <!-- last child-->
    <div class="bg-info p-3 text-center footer mt-3" style="margin-top: 150px;">
        <p>All rights reserved &copy;- Designed by WeKart-2025</p>
    </div>

    <!-- Bootstrap JS Link-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js" integrity="sha384-j1CDi7MgGQ12Z7Qab0qlWQ/Qqz24Gc6BM0thvEMVjHnfYGF0rmFCozFSxQBxwHKO" crossorigin="anonymous"></script>
  </body>
</html>