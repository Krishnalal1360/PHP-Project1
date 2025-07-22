<?php
  include("./db_connect.php");
  //
  session_start();
  //
function getTotalPrice(){
    //
    global $conn;
    $gmail = $_SESSION["GML"] ?? '';
    //
    $query = "SELECT * FROM `records` WHERE `Gmail`='$gmail' AND `Status`='Confirmed'";
    $result = mysqli_query($conn, $query);
    //
    $amount = 0;
    if($result && mysqli_num_rows($result) > 0){
        while($row = mysqli_fetch_assoc($result)){
            $quantity = $row["Quantity"];
            $price = $row["Price"];
            $total_price = $quantity*$price;
            $amount = $amount+$total_price;
        }
    }
    //
    return $amount;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Your Orders</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
  <div class="container my-5">
    <div class="card shadow p-4">
      <div class="card-body">
        <h3 class="card-title mb-4 text-center">Your Orders</h3>
        <?php
        //
        global $conn;
        $gmail = $_SESSION["GML"] ?? '';
        //
        $query = "SELECT * FROM `records` WHERE `Gmail`='$gmail'";
        $result = mysqli_query($conn, $query);
        if($result && mysqli_num_rows($result) > 0){
            //
            $query = "SELECT DISTINCT `Order_Number` FROM `records` WHERE `Gmail`='$gmail' AND `Status` in ('Confirmed', 'Approved')";
            $result = mysqli_query($conn, $query);
            if($result && mysqli_num_rows($result) > 0){
                //
                while($row = mysqli_fetch_assoc($result)){
                    $order_number = $row["Order_Number"];
                    //
                    $query1 = "SELECT * FROM `records` WHERE `Gmail`='$gmail' AND `Order_Number`='$order_number' AND `Status` in ('Confirmed', 'Approved')";  
                    $result1 = mysqli_query($conn, $query1);
                    if($result1 && mysqli_num_rows($result1) == 1){
                        $rows = mysqli_fetch_assoc($result1);
                        $on = $rows["Order_Number"];
                        $pb = $rows["Brand"];
                        $pc = $rows["Category"];
                        $op = $rows["Order_Placed"];
                        $st = $rows["Status"];
                        $tp = $rows["Total_Price"];
                        $pq = $rows["Quantity"];
                        echo "
                        <div class='card mb-3'>
                          <div class='card-body'>
                            <h5 class='card-title'>Order #$on</h5>
                            <p class='card-text'>
                              Product Brand: $pb
                              <br>
                              Product Category: $pc
                              <br>
                              Product Quantity: $pq
                              <br>
                              Order Placed: $op
                              <br>
                              Status: $st
                              <br><br>";
                        echo "Total Price: $tp<br>
                            </p>
                          </div>
                        </div>
                        ";
                    }else{
                      $query2 = "SELECT * FROM `records` WHERE `Gmail`='$gmail' AND `Order_Number`='$order_number' AND `Status` in ('Confirmed', 'Approved')";  
                      $result2 = mysqli_query($conn, $query2);
                      if($result2 && mysqli_num_rows($result2) > 0){
                        $rows = mysqli_fetch_assoc($result2);
                        $on = $rows["Order_Number"];
                        echo "
                              <div class='card mb-3'>
                                <div class='card-body'>
                                <h5 class='card-title'>Order #$on</h5>";
                      $query3 = "SELECT * FROM `records` WHERE `Gmail`='$gmail' AND `Order_Number`='$order_number' AND `Status` in ('Confirmed', 'Approved')";  
                      $result3 = mysqli_query($conn, $query3);
                      if($result3 && mysqli_num_rows($result3) > 0){
                        while($rows = mysqli_fetch_assoc($result3)){       
                                $pb = $rows["Brand"];
                                $pc = $rows["Category"];
                                $op = $rows["Order_Placed"];
                                $st = $rows["Status"];
                                $tp = $rows["Total_Price"];
                                $pq = $rows["Quantity"];
                            echo
                              "
                                <p class='card-text'>
                                Product Brand: $pb
                                <br>
                                Product Category: $pc
                                <br>
                                Product Quantity: $pq
                                <br>
                                Order Placed: $op
                                <br>
                                Status: $st
                                <br>";
                            echo "Price: $tp<br>
                                </p>
                        ";
                        }
                        echo "
                            <br>
                            <p class='card-text'>
                            Total Price: ".getTotalPrice()."
                            </p>
                            </div>
                          </div>
                        ";
                      }
                    }
                    }
                }
            }
            //
        }
        ?>
        <a href="javascript:history.back()" class="btn btn-secondary mt-3">Go Back</a>
      </div>
    </div>
  </div>
</body>
</html>


