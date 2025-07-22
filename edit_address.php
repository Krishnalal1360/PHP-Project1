<?php
  include("./db_connect.php");
  //
  $gmail = $_GET['gmail'];
  //
  if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $address = $_POST['address'];
    $query = "SELECT * FROM `user_cred` WHERE `Gmail`='$gmail'";
    $result = mysqli_query($conn, $query); 
    $row = mysqli_fetch_assoc($result);
    $address1 = $row['Address'];
    //
    if(empty($address)){
        $address = $address1;
    }
    //
    $query = "UPDATE `user_cred` SET `Address`='$address' WHERE `Gmail`='$gmail'";
    $result = mysqli_query($conn, $query);
    if($result){
    echo "
      <script>
        alert('Address updated successfully!');
        window.location.href = 'http://localhost/E-commerce1/User/cart.php?gmail=$gmail';
      </script>
    ";
    }else{
    echo "
      <script>
        alert('Address updation failed!');
        window.location.href = 'http://localhost/E-commerce1/User/cart.php?gmail=$gmail';
      </script>
    ";
    }
  }
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Edit Address</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

  <div class="container mt-5" style="max-width: 600px;">
    <h4 class="mb-4 text-center">Edit Address</h4>

    <form action="" method="POST">
      <div class="mb-3">
        <label for="address" class="form-label">Address</label>
        <textarea class="form-control" id="address" name="address" rows="10">
          <?php 
            $gmail = $_GET['gmail'];
            $query = "SELECT * FROM `user_cred` WHERE `Gmail`='$gmail'";
            $result = mysqli_query($conn, $query); 
            $row = mysqli_fetch_assoc($result);
            $address1 = $row['Address'];
            echo htmlspecialchars($address1);
          ?>
        </textarea>
      </div>
      <button type="submit" class="btn btn-primary">Save Address</button>
    </form>
  </div>

</body>
</html>
