<?php
session_start();
include("./db_connect.php");
//
if(isset($_POST["title"])){
    //
    global $conn;
    //
    $id = $_SESSION["UID"] ?? '';
    $title = $_POST['title'];
    //
    $query = "SELECT * FROM `user_cred` WHERE `ID`='$id'";
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_assoc($result);
    $gmail = $row["Gmail"];
    //
        $query = "SELECT * FROM `product_details` WHERE `Title`='$title'";
        $result = mysqli_query($conn, $query);
        //
        if($result && mysqli_num_rows($result) > 0){
            $row = mysqli_fetch_assoc($result);
            //
            $brand = $row["Brand"];
            $category = $row["Category"];
            $image = $row["Image"];
            $price = $row["Price"];
        }
        //
        $query = "SELECT * FROM `user_cred` WHERE `Gmail`='$gmail'";
        $result = mysqli_query($conn, $query);
        if($result && mysqli_num_rows($result) > 0){
            $row = mysqli_fetch_assoc($result);    
            //
            //$name = $row["Name"];
            //$address = $row["Address"];
            //$alt_address = $row["Alternative_Address"];
            $_SESSION["NM"] = $row["Name"];
            $_SESSION["GML"] = $row["Gmail"];
            $_SESSION["ADR"] = $row["Address"];
            $_SESSION["ALT_ADR"] = $row["Alternative_Address"];
        }
        //
        $name = $_SESSION["NM"];
        $query = "INSERT INTO `records`(`Name`, `Gmail`, `Title`, `Brand`, `Category`, `Image`, `Price`, `Quantity`, `Total_Price`, `Order_Placed`, `Order_Number`, `Status`)
            VALUES('$name', '$gmail', '$title', '$brand', '$category', '$image', '$price', '1', '$price*1', '', '', 'In Cart')";
        mysqli_query($conn, $query); 
    //
    $query = "SELECT * FROM `records` ORDER BY `ID` DESC LIMIT 1";
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_assoc($result);
    $_SESSION["RID"] = $row["ID"];
    $rid = $_SESSION["RID"];
    $_SESSION["QUANT"] = $row["Quantity"];
    $quantity1 = $_SESSION["QUANT"];
    //
    $query = "SELECT * FROM `order_stock` WHERE `Product`='$title'";
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_assoc($result);
    if($result && mysqli_num_rows($result) > 0){
        $quantity = $row["Quantity"];
    }
    //
    if($quantity1 > $quantity){
    $swalMsg = "Out Of Stock";
    $swalType = "error";
    echo "
    <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            Swal.fire({
                icon: '$swalType',
                title: '$swalMsg',
                confirmButtonText: 'OK'
            }).then(() => {
                window.location.href = 'http://localhost/E-commerce1/User/user_store.php';
            });
        });
    </script>";
    exit(); // stop further PHP/HTML execution
    }else{
        //
        $order_number = uniqid();
        $query = "UPDATE `records` SET `Order_Number`='$order_number', `Order_Placed`=NOW(), `Status`='Order Placed' WHERE `ID`='$rid'";
        mysqli_query($conn, $query);
    }
}
//
if($_SERVER["REQUEST_METHOD"] == "POST"){
    if(isset($_POST["submit_address"]) || isset($_POST["submit_alt_address"])){
      global $conn;
      //session_start();
      $address = $_SESSION["ADR"] ?? '';
      $alt_address = $_SESSION["ALT_ADR"] ?? '';
      $id = $_SESSION["UID"] ?? '';
      if(isset($_POST["submit_address"])){
        $address1 = $_POST["address"];
        if(!empty($address1)){
            $query = "UPDATE `user_cred` SET `Address`='$address1' WHERE `ID`='$id'";
            mysqli_query($conn, $query);
            $_SESSION["ADR"] = $address1;
        }/*else{
            $query = "UPDATE `user_cred` SET `Address`='$address' WHERE  `ID`='$id'";
            mysqli_query($conn, $query);
            $_SESSION["ADR"] = $address1;
        }*/
      }
      if(isset($_POST["submit_alt_address"])){
        $alt_address1 = $_POST["alt_address"];
        if(!empty($alt_address1)){
            $query = "UPDATE `user_cred` SET `Alternative_Address`='$alt_address1' WHERE  `ID`='$id'";
            mysqli_query($conn, $query);
            $_SESSION["ALT_ADR"] = $alt_address1;
        }/*else{
            $query = "UPDATE `user_cred` SET `Alternative_Address`='$alt_address' WHERE  `ID`='$id'";
            mysqli_query($conn, $query);
            $_SESSION["ALT_ADR"] = $alt_address1;
        }*/
      }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Order Summary</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body { background-color: #f8f9fa; }
    .invoice-box { max-width: 800px; margin: auto; padding: 30px; }
    .table th, .table td { vertical-align: middle; }
  </style>
</head>
<body>
  <div class="invoice-box bg-white shadow rounded p-4 my-5">
    <div class="text-center mb-4">
      <h2 class="text-success">Order Confirmation</h2>
      <p class="text-muted">Thank you for your purchase! Below are your order details.</p>
    </div>

    <div class="mb-4">
      <h5>Customer & Shipping Info</h5>
      <p><strong>Name:</strong><?php echo " " . $_SESSION["NM"] ?? ''; ?>
      </p>
      <p><strong>Email:</strong><?php echo " " . $_SESSION["GML"] ?? ''; ?>
      </p>

      <!-- Optional Alternative Shipping Address -->
      <form class="mt-3" action="" method="post">
        <input type="hidden" name="gmail" value="<?php echo $_SESSION["GML"] ?? ''; ?>">
        <div class="mb-2">
          <label for="Shipping" class="form-label"><strong>Shipping Address</strong></label>
          <textarea id="Shipping" class="form-control" rows="2" placeholder="<?php echo $_SESSION["ADR"] ?? '';?>" name="address"></textarea>
        </div>
        <button type="submit" class="btn btn-primary mt-2" name="submit_address">Save Address</button>
      </form>
      <form class="mt-3" action="" method="post">
        <input type="hidden" name="gmail" value="<?php echo $_SESSION["GML"] ?? ''; ?>">
        <div class="mb-2">
          <label for="altShipping" class="form-label"><strong>Alternative Shipping Address</strong></label>
          <textarea id="altShipping" class="form-control" rows="2" placeholder="<?php echo $_SESSION["ALT_ADR"] ?? '';?>" name="alt_address"></textarea>
        </div>
        <button type="submit" class="btn btn-primary mt-2" name="submit_alt_address">Save Alternative Address</button>
      </form>
    </div>

    <div class="mb-4">
      <h5>Order Summary</h5>
      <p><strong>Order Status:</strong> <span class="badge bg-primary">Order Placed</span></p>
      <p><strong>Payment Method:</strong> Cash On Delivery</p>
    </div>

    <div class="mb-4">
      <h5>Ordered Items</h5>
      <table class="table table-bordered">
        <thead class="table-light">
          <tr>
            <th>Product</th>
            <th>Qty</th>
            <th>Unit Price</th>
            <th>Total</th>
          </tr>
        </thead>
        <tbody>
            <?php
            //
             $query = "SELECT * FROM `records` WHERE `ID`='$rid'";
             $result = mysqli_query($conn, $query);
             $rows = mysqli_fetch_assoc($result);
             $title = $rows["Title"];
             $quantity = $rows["Quantity"];
             $price = $rows["Price"];
             $total_price = $quantity*$price;
            ?>
          <tr>
            <td><?=$title?></td>
            <td><?=$quantity?></td>
            <td>₹<?=$price?></td>
            <td>₹<?=$total_price?></td>
          </tr>
        </tbody>
        <tfoot>
          <tr>
            <th colspan="3" class="text-end">Subtotal</th>
            <td>₹<?php echo $price;?></td>
          </tr>
        </tfoot>
      </table>
    </div>
    <div class="text-center pb-5">
    <?php
      echo "
    <form method='post' action='http://localhost/E-commerce1/Includes/confirm.php' style='display: inline-block;'>
    <input type='hidden' name='RID' value='" . htmlspecialchars($rid) . "'>
    <button type='submit' class='btn btn-success px-4 me-2'>
        <i class='fas fa-check me-1'></i> Confirm
    </button>
    </form>

    <form method='post' action='http://localhost/E-commerce1/Includes/cancel.php' style='display: inline-block;'>
    <input type='hidden' name='RID' value='" . htmlspecialchars($rid) . "'>
    <button type='submit' class='btn btn-outline-danger px-4'>
        <i class='fas fa-times me-1'></i> Cancel
    </button>
    </form>
";
    ?>
  </div>
  </div>


  <footer class="text-center text-muted py-3">
    &copy; 2025 WeKart. All rights reserved.
  </footer>
</body>
</html>