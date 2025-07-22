<?php 
    include("./db_connect.php");
    //
    global $conn;
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
    <a href="order_payment.php" class="btn btn-primary me-3">
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
        if(isset($_POST["ON"])){
            $on = $_POST["ON"] ?? '';
        }
        //
    $query = "SELECT * FROM `records` WHERE `Order_Number`='$on'";
    $result = mysqli_query($conn, $query);
    //
       if($result && mysqli_num_rows($result) > 0){
       //
            while($row = mysqli_fetch_assoc($result)){
                $pt = $row["Title"];
                $pb = $row["Brand"];
                $pc = $row["Category"];
                $pr = $row["Price"];
                //
                $query1 = "SELECT * FROM `product_details` WHERE `Title` = '$pt'";
                $result1 = mysqli_query($conn, $query1);
                //
                $row1 = mysqli_fetch_assoc($result1);
                $pi = $row1["Image"];
                $pd = $row1["Description"];
                echo "<div class='col-md-4 mb-4'>
                <div class='card h-100'>
                    <img src='../Uploads/$pi' class='card-img-top' alt='$pi' style='height: 200px; object-fit: cover;'>
                    <div class='card-body'>
                        <h5 class='card-title'>$pt</h5>
                        <p class='card-text'>Description: $pd</p>
                        <p class='card-text'>Brand: $pb</p>
                        <p class='card-text'>Category: $pc</p>
                        <p class='card-text fw-bold'>Price: ₹$pr</p>
                    </div>
                </div>
            </div>";
       ?>
      <?php 
      } 
      }?>
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
