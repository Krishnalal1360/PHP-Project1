      <?php
          include("./db_connect.php");
          global $conn;
          session_start();
          //$id = $_SESSION["UID"];
      ?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Cart Page</title>
  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet">
  <!-- Font Awesome -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
  <style>
    .product-image{
      width: 120px;            /* Smaller fixed width */
      height: 120px;           /* Smaller fixed height */
      object-fit: cover;       /* Crops image to fit */
      border-radius: 8px;      /* Optional: rounded corners */
    }
    .quantity-input {
      width: 50px;
      text-align: center;
    }
    .card-header, .card-footer {
      background-color: #f8f9fa;
    }
  </style>
<body>

<!-- Header -->
<header class="bg-info text-white p-3">
  <div class="container d-flex justify-content-center align-items-center">
    <h4 class="mb-0">Cart Store</h4>
  </div>
  <div class="mt-2">
      <a href="http://localhost/E-commerce1/User/user_store.php" class="btn btn-light btn-sm">
        <i class="fa fa-home me-1"></i> Home
      </a>
  </div>
</header>

<!-- Main Content -->
<div class="container my-4">
  <div class="row">
    <!-- Left: Item & Delivery Card -->
    <div class="col-md-8">
      <?php
          //
          $id = $_SESSION["UID"];
          $query = "SELECT * FROM `user_cred` WHERE `ID`='$id'";
          $result = mysqli_query($conn, $query);
          $row = mysqli_fetch_assoc($result);
          $_SESSION["GML"] = $row["Gmail"];
          $gmail = $_SESSION["GML"] ?? '';
          //
          $query1 = "SELECT * FROM `records` WHERE `Gmail`='$gmail' AND `Status`='In Cart'";
          $result1 = mysqli_query($conn, $query1);
          if($result1 && mysqli_num_rows($result1) > 0){
          //
          while($rows = mysqli_fetch_assoc($result1)){
              $title = $rows['Title'];
              $price = $rows['Price'];
              $image = $rows['Image'];
              $quantity = $rows['Quantity'];
              //$_SESSION["RID"] = $rows['ID'];
              //$rid = $_SESSION["RID"] ?? '';
              $rid = $rows["ID"];
      ?>
      <div class="card mb-4">
        <div class="card-header">
          <strong>Order Summary</strong>
        </div>
        <div class="card-body d-flex">
          <img src="../Uploads/<?php echo $image?>" alt="Product" class="product-image me-4">
          <div class="flex-grow-1">
            <h5><?php echo $title?></h5>
            <p>Price: ₹<?php echo $price?></p>
            <div class="d-flex align-items-center mb-2">

  <!-- Minus Button -->
  <form action="http://localhost/E-commerce1/Includes/product_minus.php" method="post" style="display: inline;">
    <input type="hidden" name="rid" value="<?php echo $rid; ?>">
    <button type="submit" class="btn btn-outline-secondary btn-sm">-</button>
  </form>

  <!-- Quantity Display (read-only) -->
  <input type="text" class="form-control quantity-input mx-2" value="<?php echo $quantity; ?>" readonly>

  <!-- Plus Button -->
  <form action="http://localhost/E-commerce1/Includes/product_add.php" method="post" style="display: inline;">
    <input type="hidden" name="rid" value="<?php echo $rid; ?>">
    <button type="submit" class="btn btn-outline-secondary btn-sm">+</button>
  </form>

</div>

<!-- Remove Button -->
<div>
  <form action="http://localhost/E-commerce1/Includes/remove_product.php" method="post">
    <input type="hidden" name="rid" value="<?php echo $rid; ?>">
    <button type="submit" class="btn btn-danger btn-sm mt-1">Remove</button>
  </form>
</div>
          </div>
        </div>
            <!-- Place Order Button Form -->
<div class='card-footer text-end'>
  <form action="http://localhost/E-commerce1/Includes/place_order.php" method="post" style="display: inline;">
    <input type="hidden" name="rid" value="<?php echo $rid; ?>">
    <button type="submit" class="btn btn-primary">Place Order</button>
  </form>
</div>
          </div>
      <?php }
          }
      ?>
    </div>

    <?php
    include("./db_connect.php");
    global $conn;
    $gmail = $_SESSION["GML"] ?? '';
    //
    $query = "SELECT * FROM `records` WHERE `Gmail`='$gmail' AND `Status`='In Cart'";
    $result = mysqli_query($conn, $query);
    $rows = mysqli_fetch_assoc($result);
    $quantity = getItemNumbers();
    if($quantity == 0){
        echo "
        <div class='col-md-4'>
        <div class='card'>
        <div class='card-body text-center'>
        <h5 class='card-title text-danger'>Your Cart is Empty</h5>
        </div>
        </div>
        </div>
        ";
    }else{
      echo "
      <div class='col-md-4'>
      <div class='card'>
        <div class='card-header'>
          <strong>Price Details</strong>
        </div>
        <div class='card-body'>
          <div class='d-flex justify-content-between'>
            <span>Number Of Items</span>
            <span>" . getItemNumbers() . "</span>
          </div>
          <hr>
          <div class='d-flex justify-content-between fw-bold'>
            <span>Total Amount</span>
            <span>₹" . getAmount() . "</span>
          </div>
          <div class='mt-3 text-center'>
  <form action='http://localhost/E-commerce1/Includes/place_all_orders.php' method='post' style='display: inline;'>";
      //
      $gmail = $_SESSION["GML"] ?? '';
      // Get all order IDs in cart for the logged-in user
      $query_ids = "SELECT `ID` FROM `records` WHERE `Gmail`='$gmail' AND `Status`='In Cart'";
      $result_ids = mysqli_query($conn, $query_ids);
      while($row_id = mysqli_fetch_assoc($result_ids)){
          echo '<input type="hidden" name="ids[]" value="' . $row_id['ID'] . '">';
      }
    echo "<button type='submit' class='btn btn-primary'>
      <i class='fas fa-shopping-cart me-1'></i> Place All Orders
    </button>
  </form>
</div>
        </div>
      </div>
    </div>
  </div>
</div>
";
  }
?>

<!-- Footer -->
<footer class="bg-info text-white text-center p-3" style="margin-top:250px;">
  <p class="mb-0">&copy; 2025 WeKart. All rights reserved.</p>
</footer>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

<?php
  function getItemNumbers(){
    //
    global $conn;
    $gmail = $_SESSION["GML"] ?? '';
    //
    $query = "SELECT * FROM `records` WHERE `Gmail`='$gmail' AND `Status`='In Cart'";
    $result = mysqli_query($conn, $query);
    $total_item = 0;
    while($rows = mysqli_fetch_assoc($result)){
      $item = $rows['Quantity'];
      $total_item = $total_item+$item;
    }
    return $total_item;
  }
  //
  function getAmount(){
    //
    global $conn;
    $gmail = $_SESSION["GML"] ?? '';
    //
    $query = "SELECT * FROM `records` WHERE `Gmail`='$gmail' AND `Status`='In Cart'";
    $result = mysqli_query($conn, $query);
    $total_amount = 0;
    while($rows = mysqli_fetch_assoc($result)){
      $quantity = $rows["Quantity"];
      $price = $rows["Price"];
      $total_price = $quantity*$price;
      $total_amount = $total_amount+$total_price;
    }
    return $total_amount;
  }
?>
