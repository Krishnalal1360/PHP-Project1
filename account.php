<?php
include("./db_connect.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Users</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
  <div class="container my-5">
    <h2 class="mb-4">Items List</h2>
    <table class="table table-bordered border-primary">
      <thead class="table-primary">
        <tr>
          <th scope="col">Name</th>
          <th scope="col">Gmail</th>
          <th scope="col">Title</th>
          <th scope="col">Brand</th>
          <th scope="col">Category</th>
          <th scope="col">Image</th>
          <th scope="col">Price</th>
          <th scope="col">Order_Placed</th>
          <th scope="col">Status</th>
          <th scope="col">Order_Received</th>
          <th scope="col">Action</th>
        </tr>
      </thead>
      <tbody>
        <?php
        global $conn;
        //
        if(isset($_GET["gmail"])){
            //
            $gmail = $_GET["gmail"];
            $query = "SELECT * FROM `records` WHERE `Gmail`='$gmail'";
            $result = mysqli_query($conn, $query);
            if(mysqli_num_rows($result) > 0){
                while($row = mysqli_fetch_assoc($result)){
                    echo "<tr>";
                    echo "<td>{$row['Name']}</th>";
                    echo "<td>{$row['Gmail']}</td>";
                    echo "<td>{$row['Title']}</td>";
                    echo "<td>{$row['Brand']}</td>";
                    echo "<td>{$row['Category']}</th>";
                    echo "<td><img src='../Uploads/{$row['Image']}' alt='Product Image' style='width: 80px; height: 80px; object-fit: cover;'></td>";
                    echo "<td>{$row['Price']}</td>";
                    echo "<td>{$row['Order_Placed']}</td>";
                    echo "<td>{$row['Status']}</td>";
                    echo "<td>{$row['Order_Received']}</td>";
                    echo "<td class='text-center'>
                            <div class='d-flex justify-content-center gap-2'>
                              <a href='delete_item.php?gmail=$gmail&title={$row['Title']}&brand={$row['Brand']}&category={$row['Category']}' class='btn btn-danger btn-sm'>Delete</a>
                              <a href='order_item.php?gmail=$gmail&title={$row['Title']}&brand={$row['Brand']}&category={$row['Category']}' class='btn btn-success btn-sm'>Order</a>
                            </div>
                          </td>";
                    echo "</tr>";
                }
            }else{
                echo "<script>
                      alert('No Items Present in the Wishlist Cart!')
                      window.location.href='http://localhost/E-commerce1/User/user_store.php'
                      </script>";
            }
        }
        ?>
      </tbody>
    </table>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
