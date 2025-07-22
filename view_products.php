<?php
  include("./db_connect.php");
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
    <title>View Products</title>
</head>
<body>
<!-- first child-->
<div class="bg-light">
  <div class="mb-3">
      <a href="admin.php" class="btn btn-primary">
        <i class="fas fa-home"></i> Home
      </a>
    </div>
    <h3 class="text-center">View Products</h3>
</div>

<!-- second child-->
<div class="row">
  <!-- item-card-body-->
  <div class="col-md-12">
    <!-- products-->
    <div class="row">
      <?php
        //
        global $conn;
        $qry = "SELECT * FROM `product_details`";
        $res = mysqli_query($conn, $qry);
        $nrs = mysqli_num_rows($res);
        if($nrs == 0){
          echo "<h3 class='text-center'>No products available!</h3>";
          exit();
        }
        while($row=mysqli_fetch_assoc($res)){
          $pt = $row["Title"];
          $pd = $row["Description"];
          //$pk = $row["Keyword"];
          $pb = $row["Brand"];
          $pc = $row["Category"];
          //
          $pi = $row["Image"];
          $pr = $row["Price"];
          //
          echo "
              <div class='col-md-4 mb-4'>
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
            </div>
              ";
        }       
      ?>
      </div>
  </div>
  
</div>

<div class="bg-info p-3 text-center footer mt-5">
  <p>All rights reserved &copy;- Designed by WeKart-2025</p>
</div>

    <!-- Bootstrap JS Link-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js" integrity="sha384-j1CDi7MgGQ12Z7Qab0qlWQ/Qqz24Gc6BM0thvEMVjHnfYGF0rmFCozFSxQBxwHKO" crossorigin="anonymous"></script>
</body>
</html>