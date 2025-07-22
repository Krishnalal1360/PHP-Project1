<?php
    include("./db_connect.php");
    //
    session_start();
    //
    $id = $_SESSION["UID"];
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
    <title>Search Product</title>
</head>
<body>
<!-- first child-->
<div class="bg-light">
    <h3 class="text-center">Product Search Results</h3>
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
        //
        if(isset($_POST["search_product"])){
             $search_product = $_POST["search_product"];
        }
        //
        $query = "SELECT * FROM `product_details` WHERE `Keyword` like '%$search_product%'";
        $result = mysqli_query($conn, $query);
        $nrs = mysqli_num_rows($result);
        //
        if($nrs == 0){
          echo "<script>
                  window.location.href='http://localhost/E-commerce1/User/user_store.php;
                </script>";
        }
        while($row=mysqli_fetch_assoc($result)){
          $pt = $row["Title"];
          $pd = $row["Description"];
          //
          $pb = $row["Brand"];
          $pc = $row["Category"];
          //
          $pi = $row["Image"];
          $pr = $row["Price"];
          //
          $query1 = "SELECT * FROM `order_stock` WHERE `Product`='$pt'";
          $result1 = mysqli_query($conn, $query1);
          $row = mysqli_fetch_assoc($result1);
          $quantity = $row["Quantity"];
          //
          $title = $pt;
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
                        <div class='d-flex gap-2'>
                        <form action='http://localhost/E-commerce1/Includes/wishlist.php' method='POST' class='d-inline w-50 me-1'>
                        <input type='hidden' name='title' value='$title'>
                        <button type='submit' class='btn btn-info w-100'>Add to Cart</button>
                        </form>

                        <form action='http://localhost/E-commerce1/Includes/buy_now.php' method='POST' class='d-inline w-50'>
                        <input type='hidden' name='title' value='$title'>
                        <button type='submit' class='btn btn-success w-100'>Buy Now</button>
                        </form>
                    </div>
                    ";
                    if($quantity == 0){
                        echo "
                        <p class='mt-2 mb-0 text-center text-danger'>
                            <small><i class='fas fa-box-open me-1'></i>Out of Stock</small>
                        </p>
                        ";
                    }else{
                        echo "
                        <p class='mt-2 mb-0 text-center text-danger'>
                            <small><i class='fas fa-box-open me-1'></i>$quantity Left In Stock</small>
                        </p>
                        ";
                    }
                    echo "</div>
                </div>
            </div>
              ";
        }       
      ?>
      </div>
  </div>
  
</div>

<div class="bg-info p-3 text-center footer" style="margin-top: 150px;">
  <p>All rights reserved &copy;- Designed by WeKart-2025</p>
</div>

    <!-- Bootstrap JS Link-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js" integrity="sha384-j1CDi7MgGQ12Z7Qab0qlWQ/Qqz24Gc6BM0thvEMVjHnfYGF0rmFCozFSxQBxwHKO" crossorigin="anonymous"></script>
</body>
</html>