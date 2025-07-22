<?php
include("./db_connect.php");
global $conn;
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Order Review</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
  <div class="container-fluid my-5 text-start">
     <!-- Home Button -->
    <div class="mb-3">
      <a href="admin.php" class="btn btn-primary">
        <i class="fas fa-home"></i> Home
      </a>
    </div>
    <h2 class="mb-4 text-center">Order List</h2>
    <table class="table table-bordered border-primary">
      <thead class="table-primary">
        <tr>
          <th scope="col">ID</th>
          <th scope="col">Gmail</th>
          <th scope="col">Product</th>
          <th scope="col">Product Details</th>
          <th scope="col">Action</th>
        </tr>
      </thead>
      <tbody>
        <?php
        $query = "SELECT * FROM `records`";
        $result = mysqli_query($conn, $query);
        if($result && mysqli_num_rows($result) > 0){
            //
            $query = "SELECT DISTINCT `Order_Number` FROM `records` WHERE `Status`IN ('Confirmed', 'Approved')";
            $result = mysqli_query($conn, $query);
            if($result && mysqli_num_rows($result) > 0){
                //
                while($row = mysqli_fetch_assoc($result)){
                    $order_number = $row["Order_Number"];
                    //
                    $query1 = "SELECT * FROM `records` WHERE `Order_Number`='$order_number' AND `Status`IN ('Confirmed', 'Approved')";  
                    $result1 = mysqli_query($conn, $query1);
                    if($result1 && mysqli_num_rows($result1) == 1){
                        $row1 = mysqli_fetch_assoc($result1);
                        echo "<tr>";
                        echo "<td>{$row1['ID']}</td>";
                        echo "<td>{$row1['Gmail']}</td>";
                        echo "<td>{$row1['Title']}</td>";
                        echo "<td>
                                <form action='view_items.php' method='POST' class='d-inline'>
                                <input type='hidden' name='ON' value='$order_number'>
                                <button type='submit' class='btn btn-info btn-sm'>View</button>
                                </form>
                              </td>";
                        if($row1["Status"] == "Confirmed"){
                          echo "<td class='text-center'>
                            <form action='approve_item.php' method='POST' class='d-inline'>
                            <input type='hidden' name='ON' value='$order_number'>
                            <button type='submit' class='btn btn-success btn-sm'>Approve</button>
                            </form>

                            <form action='reject_item.php' method='POST' class='d-inline'>
                            <input type='hidden' name='ON' value='$order_number'>
                            <button type='submit' class='btn btn-danger btn-sm'>Reject</button>
                            </form>

                          </td>";
                        }else if($row1["Status"] == "Approved"){
                            echo "<td class='text-center'>
                            <form action='reject_item.php' method='POST' class='d-inline'>
                            <input type='hidden' name='ON' value='$order_number'>
                            <button type='submit' class='btn btn-danger btn-sm'>Reject</button>
                            </form>

                          </td>";
                        }
                        echo "</tr>";
                    }else if($result1 && mysqli_num_rows($result1) > 1){
                        $query3 = "SELECT * FROM `records` WHERE `Order_Number`='$order_number' AND `Status` IN ('Confirmed', 'Approved')";  
                        $result3 = mysqli_query($conn, $query3);
                        $row3 = mysqli_fetch_assoc($result3);
                        echo "<tr>";
                        echo "<td>{$row3['ID']}</td>";
                        echo "<td>{$row3['Gmail']}</td>";
                        //
                        echo "<td><table class='table table-borderless mb-0'>";
                        $query2 = "SELECT * FROM `records` WHERE `Order_Number`='$order_number' AND `Status` IN ('Confirmed', 'Approved')";
                        $result2 = mysqli_query($conn, $query2);
                        while ($row2 = mysqli_fetch_assoc($result2)) {
                            echo "<tr><td>{$row2['Title']}</td></tr>";
                        }
                        echo "</table></td>";
                        //
                            echo "<td>
                                <form action='view_items.php' method='POST' class='d-inline'>
                                <input type='hidden' name='ON' value='$order_number'>
                                <button type='submit' class='btn btn-info btn-sm'>View</button>
                                </form>
                              </td>";
                        //
                        $query5 = "SELECT * FROM `records` WHERE `Order_Number`='$order_number' AND `Status`IN ('Confirmed', 'Approved')";  
                        $result5 = mysqli_query($conn, $query5);
                        $row5 = mysqli_fetch_assoc($result5);
                        //
                        if($row5["Status"] == "Confirmed"){
                            echo "<td class='text-center'>
                            <div class='d-flex justify-content-center gap-2 flex-wrap'>
                                <form action='approve_item.php' method='POST' class='d-inline'>
                                <input type='hidden' name='ON' value='$order_number'>
                                <button type='submit' class='btn btn-success btn-sm'>Approve</button>
                                </form>

                                <form action='reject_item.php' method='POST' class='d-inline'>
                                <input type='hidden' name='ON' value='$order_number'>
                                <button type='submit' class='btn btn-danger btn-sm'>Reject</button>
                                </form>
                            </div>
                          </td>";
                        }else if($row5["Status"] == "Approved"){
                            echo "<td class='text-center'>
                            <form action='reject_item.php' method='POST' class='d-inline'>
                            <input type='hidden' name='ON' value='$order_number'>
                            <button type='submit' class='btn btn-danger btn-sm'>Reject</button>
                            </form>
                          </td>";
                        }
                        echo "</tr>";
                    }
                }
            }
            //
        }else{
            echo "<tr><td colspan='5' class='text-center'>No confirmed orders found!</td></tr>";
        }
        ?>
      </tbody>
    </table>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
