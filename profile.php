<?php
  include("./db_connect.php");
  session_start();
  $id = $_SESSION['UID'];
  //
  $query = "SELECT * FROM `user_cred` WHERE `ID`='$id'";
  $result = mysqli_query($conn, $query);
  $row = mysqli_fetch_assoc($result);
  $name = $row['Name'];
  $gmail = $row['Gmail'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>User Profile</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
  <div class="container my-5">
    <div class="card shadow p-4 mx-auto" style="max-width: 500px;">
      <div class="card-body text-center">
        <h3 class="card-title mb-3">User Profile</h3>
        <p class="card-text"><strong>Name:</strong> <?php echo htmlspecialchars($name); ?></p>
        <p class="card-text"><strong>Gmail:</strong> <?php echo htmlspecialchars($gmail); ?></p>
        <a href="javascript:history.back()" class="btn btn-secondary mt-3">Go Back</a>
      </div>
    </div>
  </div>
</body>
</html>
