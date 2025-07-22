<?php 
    include("./db_connect.php");
    //
    global $conn;
    //
    $query = "SELECT * FROM `order_stock`";
    $result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Product Dashboard</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    .card-img-top {
      width: 150px;
      height: 150px;
      object-fit: contain;
      margin: 20px auto 0;
      display: block;
    }
    .label {
      font-weight: 600;
      color: #6c757d;
    }
    footer {
      background-color: #17a2b8;
      color: white;
      padding: 15px 0;
    }
  </style>
</head>
<body>

  <!-- Header -->
  <nav class="navbar navbar-expand-lg navbar-dark bg-info">
  <div class="container-fluid">
    <!-- Home Button -->
    <a href="admin.php" class="btn btn-primary me-3">
      <i class="fas fa-home"></i> Home
    </a>

    <!-- Centered Brand -->
    <a class="navbar-brand mx-auto" href="#">E-commerce Admin</a>
  </div>
</nav>

  <!-- Page Heading -->
  <div class="bg-light py-3 text-center">
    <h2 class="text-dark">Product Overview</h2>
  </div>

  <!-- Product Cards Grid -->
  <div class="container my-4">
    <div class="row g-4">
      <!-- Card 1 -->
       <?php
            while($row = mysqli_fetch_assoc($result)){
                $id = $row["ID"];
                $product = $row["Product"];
                $quantity = $row["Quantity"];
                $status = $row["Status"];
                //
                $query1 = "SELECT * FROM `product_details` WHERE `Title` = '$product'";
                $result1 = mysqli_query($conn, $query1);
                //
                $row1 = mysqli_fetch_assoc($result1);
                $image = $row1["Image"];
       ?>
      <div class="col-md-4">
        <div class="card shadow-sm h-100">
          <img src="../Uploads/<?php echo $image; ?>" class="card-img-top" alt="Product Image">
          <div class="card-body text-center">
            <h5 class="card-title">Product Information</h5>
            <div class="text-start">
              <p><span class="label">ID: </span><?php echo $id; ?></p>
              <p><span class="label">Product: </span><?php echo $product; ?></p>
              <p><span class="label">Quantity: </span><?php echo $quantity; ?></p>
              <p><span class="label">Status: </span> <span class="badge bg-success"><?php echo $status; ?></span></p>
            </div>
            <div class="text-center mt-3">
                <a href="edit_order_stock.php?id=<?php echo $id; ?>" class="btn btn-warning btn-sm">
                  <i class="fas fa-edit"></i> Edit
                </a>
            </div>
          </div>
        </div>
      </div>
      <?php } ?>
        </div>
      </div>
      <!-- Add more cards here similarly -->
    </div>
  </div>

  <!-- Footer -->
  <footer class="text-center">
    <div class="container">
      <p class="mb-0">All rights reserved &copy; WeKart 2025</p>
    </div>
  </footer>

  <!-- Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
