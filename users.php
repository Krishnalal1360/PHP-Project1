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
    <h2 class="mb-4">Users List</h2>
    <div class="mb-3">
      <a href="admin.php" class="btn btn-primary">
        <i class="fas fa-home"></i> Home
      </a>
    </div>
    <table class="table table-bordered table-hover">
      <thead class="table-primary">
        <tr>
          <th scope="col">ID</th>
          <th scope="col">Name</th>
          <th scope="col">Gmail</th>
          <th scope="col">Password</th>
        </tr>
      </thead>
      <tbody>
        <?php
        global $conn;
        $query = "SELECT * FROM `user_cred`";
        $result = mysqli_query($conn, $query);
        if(mysqli_num_rows($result) > 0){
          while($row = mysqli_fetch_assoc($result)){
            echo "<tr>";
            echo "<td>{$row['ID']}</th>";
            echo "<td>{$row['Name']}</td>";
            echo "<td>{$row['Gmail']}</td>";
            echo "<td>{$row['Password']}</td>";
            echo "</tr>";
          }
        }else{
          echo "<tr><td colspan='4' class='text-center'>No users found!</td></tr>";
        }
        ?>
      </tbody>
    </table>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
