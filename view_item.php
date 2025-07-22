<?php
    include("./db_connect.php");
    //
    global $conn;
    //
    if(isset($_POST["ON"])){
        $on = $_POST["ON"];
        //
        $query = "SELECT * FROM `records` WHERE `Order_Number` = '$on'";
        $result = mysqli_query($conn, $query);
        //
        $row = mysqli_fetch_assoc($result);
        $image = $row["Image"];
        //
        $name = $row["Name"];
        $brand = $row["Brand"];
        $category = $row["Category"];
        $order_number = $row["Order_Number"];
        $unit_price = $row["Price"];
        $quantity = $row["Quantity"];
        $total_price = $row["Total_Price"];
        $order_date = $row["Order_Placed"];
        if(empty($order_date)){
            $order_date = "NA";
        }
        $status = $row["Status"];
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Order Card</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    .card-img-top {
      width: 150px;
      height: 150px;
      object-fit: cover;
      margin: 20px auto 0;
      border-radius: 10px;
    }
    .card-body .row + .row {
      margin-top: 10px;
    }
    .label {
      font-weight: 600;
      color: #555;
    }
  </style>
</head>
<body>
  <div class="container my-5">
    <div class="card shadow-lg border-0 rounded-4 mx-auto" style="max-width: 450px;">
      <img src="../Uploads/<?php echo $image;?>" class="card-img-top" alt="Product Image">
      <div class="card-body">
        <h5 class="card-title text-center mb-3">Order Details</h5>

        <div class="row">
          <div class="col-6 label">Customer:</div>
          <div class="col-6"><?php echo $name; ?></div>
        </div>
        <div class="row">
          <div class="col-6 label">Brand:</div>
          <div class="col-6"><?php echo $brand; ?></div>
        </div>
        <div class="row">
          <div class="col-6 label">Category:</div>
          <div class="col-6"><?php echo $category; ?></div>
        </div>
        <div class="row">
          <div class="col-6 label">Order Number:</div>
          <div class="col-6"><?php echo $order_number; ?></div>
        </div>
        <div class="row">
          <div class="col-6 label">Unit Price:</div>
          <div class="col-6"><?php echo $unit_price; ?></div>
        </div>
        <div class="row">
          <div class="col-6 label">Quantity:</div>
          <div class="col-6"><?php echo $quantity; ?></div>
        </div>
        <div class="row">
          <div class="col-6 label">Total Price:</div>
          <div class="col-6"><?php echo $total_price; ?></div>
        </div>
        <div class="row">
          <div class="col-6 label">Order Date:</div>
          <div class="col-6"><?php echo $order_date; ?></div>
        </div>
        <div class="row">
          <div class="col-6 label">Status:</div>
          <div class="col-6"><span class="badge bg-warning text-dark"><?php echo $status; ?></span></div>
        </div>
      </div>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
