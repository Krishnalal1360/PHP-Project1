<?php
    include("./db_connect.php");
    function getProducts(){
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
          // Fetch quantity from order_stock
          $query1 = "SELECT * FROM `order_stock` WHERE `Product`='$pt'";
          $result1 = mysqli_query($conn, $query1);
          $quantity = 0; // Default
          if($result1 && mysqli_num_rows($result1) > 0){
            $row1 = mysqli_fetch_assoc($result1);
            $quantity = $row1["Quantity"];
          }
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
                        <form action='http://localhost/E-commerce1/User/login.php' method='POST' class='w-50'>
                            <button type='submit' class='btn btn-info w-100'>Add to Cart</button>
                        </form>
                        <form action='http://localhost/E-commerce1/User/login.php' method='POST' class='w-50'>
                            <button type='submit' class='btn btn-success w-100'>Buy Now</button>
                        </form>
                    </div>";
                    if($quantity == 0){
                        echo "
                        <p class='mt-2 mb-0 text-center text-danger'>
                            <small><i class='fas fa-box-open me-1'></i>Out of Stock</small>
                        </p>";
                    }else{
                        echo "
                        <p class='mt-2 mb-0 text-center text-danger'>
                            <small><i class='fas fa-box-open me-1'></i>$quantity Left In Stock</small>
                        </p>";
                    }
                    echo "
                    </div>
                </div>
            </div>
            ";
        }
    }
?>