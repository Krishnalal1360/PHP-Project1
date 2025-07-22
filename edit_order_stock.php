<?php
    include("./db_connect.php");
    //global
    $conn;
    //
    if(isset($_GET["id"])){
        $id = $_GET["id"];
        //
        $query = "SELECT * FROM `order_stock` WHERE `id` = '$id'";
        $result = mysqli_query($conn, $query);
        $row = mysqli_fetch_assoc($result);
        //
        $title = $row["Product"];
        $quantity = $row["Quantity"];
        $status = $row["Status"];
        //
        $query1 = "SELECT * FROM `product_details` WHERE `Title`='$title'";
        $result1 = mysqli_query($conn, $query1);
        $row1 = mysqli_fetch_assoc($result1);   
        //
        $brand = $row1["Brand"];     
        $category = $row1["Category"];
        $image = $row1["Image"];
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Product Stock Form</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  
  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet">
  
  <!-- Font Awesome (Optional for Icons) -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

  <style>
    .card-img-top {
      width: 160px;
      height: 160px;
      object-fit: contain;
      margin: 20px auto 0;
      display: block;
      border: 1px solid #dee2e6;
      border-radius: 10px;
      background-color: #f8f9fa;
    }
    .card {
      max-width: 500px;
      margin: 40px auto;
    }
  </style>
</head>
<body>

<div class="container">
  <div class="card shadow-lg">
    <!-- Product Image -->
    <img src="../Uploads/<?php echo $image; ?>" alt="Product Image" class="card-img-top">

    <div class="card-body">
      <h5 class="card-title text-center mb-4">Update Product Stock</h5>
      
      <!-- Input Form -->
      <form action="submit_stock.php" method="POST">
        <!-- ID -->
        <input type="hidden" name="id" value="<?php echo $id; ?>">

        <!-- Product Title -->
        <input type="hidden" name="product_title" value="<?php echo $title; ?>">

        <!-- Product -->
        <div class="mb-3">
          <label for="product" class="form-label">Product</label>
          <input type="text" id="product" class="form-control" placeholder="<?php echo $title; ?>" required name="title">
        </div>

        <!-- Brand -->
        <div class="mb-3">
          <label for="brand" class="form-label">Brand</label>
          <input type="text" id="brand" class="form-control" placeholder="<?php echo $brand; ?>" required name="brand">
        </div>

        <!-- Category -->
        <div class="mb-3">
          <label for="category" class="form-label">Category</label>
          <input type="text" id="category" class="form-control" placeholder="<?php echo $category; ?>" required name="category">
        </div>

        <!-- Quantity -->
        <div class="mb-3">
          <label for="quantity" class="form-label">Quantity</label>
          <input type="number" id="quantity" class="form-control" placeholder="<?php echo $quantity; ?>" min="0" required name="quantity">
        </div>

        <!-- Status -->
        <div class="mb-4">
          <label for="status" class="form-label">Status</label>
          <select name="status" id="status" class="form-select" required>
            <option value="">Select Status</option>
            <option value="In Stock">In Stock</option>
            <option value="Out Of Stock">Out Of Stock</option>
          </select>
        </div>

        <!-- Submit Button -->
        <div class="d-grid">
            <button type="submit" name="submit_order_stock" class="btn btn-info text-white">Submit</button>
        </div>
      </form>
    </div>
  </div>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
