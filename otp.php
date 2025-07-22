<?php
// Show all errors during development
error_reporting(E_ALL);
ini_set('display_errors', 1);

include("./db_connect.php");
global $conn;
session_start();

// Get user email from DB
$id = $_SESSION["UID"] ?? '';
$gmail = '';
if ($id) {
    $query = "SELECT * FROM `user_cred` WHERE `ID`='$id'";
    $result = mysqli_query($conn, $query);
    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $gmail = $row['Gmail'] ?? '';
    }
}

// Send OTP once
if(!isset($_SESSION['otp_sent'])) {
    $otp = rand(100000, 999999);
    $_SESSION["otp"] = $otp;
    //
    $time1 = time();
    $time2 = $time1 + 30;
    //
    $_SESSION["otp_expiry"] = $time2;

    $headers = "From: user@localhost.com";
    $to = "krishna@localhost.com"; // or use $gmail if testing with real email server
    $subject = "OTP Code Sent";
    $message = "Your OTP Code is: $otp\nIt is valid for 40 seconds.";

    $sent = mail($to, $subject, $message, $headers);

    if ($sent) {
        $query = "INSERT INTO `user_otp`(`Gmail`, `OTP`, `OTP_Creation`, `OTP_Expiration`, `Subject`, `Message`, `Header`)
                  VALUES ('$gmail', '$otp', '$time1', '$time2', '$subject', '$message', '$headers')";
        mysqli_query($conn, $query);
        $_SESSION['otp_sent'] = true;
        $_SESSION['otp_status'] = 'sent';
    } else {
        $_SESSION['otp_status'] = 'fail';
    }
}

// OTP Verification
$flag1 = $flag2 = $flag3 = false;
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["otp"])) {
    $user_otp = $_POST["otp"];
    $stored_otp = $_SESSION["otp"] ?? '';
    $otp_expiry = $_SESSION["otp_expiry"] ?? 0;

    //
    $time3 = time();
    if($time3 <= $otp_expiry) {
        if ($user_otp == $stored_otp) {
            $flag1 = true; // OTP correct
        } else {
            $flag2 = true; // OTP incorrect
        }
    } else {
        $flag3 = true; // OTP expired
    }

    // Reset to allow new OTP after each submission
    unset($_SESSION['otp']);
    unset($_SESSION['otp_expiry']);
    unset($_SESSION['otp_sent']);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>OTP</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body class="bg-light">
<div class="container mt-5">
  <div class="card mx-auto shadow" style="max-width: 400px;">
    <div class="card-body">
      <h5 class="card-title text-center mb-4">OTP Verification</h5>

      <div class="mb-3">
        <label for="gmail" class="form-label">Gmail</label>
        <input type="email" class="form-control" id="gmail" value="<?php echo htmlspecialchars($gmail); ?>" readonly>
      </div>

      <form action="" method="POST">
        <div class="mb-3">
          <label for="otp" class="form-label">Enter OTP</label>
          <input type="text" class="form-control" name="otp" id="otp" placeholder="Enter the OTP" required>
        </div>
        <button type="submit" class="btn btn-primary w-100">Verify OTP</button>
      </form>
    </div>
  </div>
</div>

<!-- SweetAlert -->
<script>
<?php if (isset($_SESSION['otp_status']) && $_SESSION['otp_status'] == 'sent'): ?>
Swal.fire({
    icon: 'success',
    title: 'OTP Sent!',
    text: 'OTP has been sent to <?php echo $gmail; ?>',
    confirmButtonText: 'OK'
});
<?php unset($_SESSION['otp_status']); endif; ?>

<?php if ($flag1): ?>
Swal.fire({
    icon: 'success',
    title: 'OTP Verified!',
    text: 'Your OTP is valid.',
    confirmButtonText: 'Continue'
}).then(() => {
    window.location.href = 'user_store.php';
});
<?php elseif ($flag2): ?>
Swal.fire({
    icon: 'error',
    title: 'Invalid OTP',
    text: 'The OTP you entered is incorrect.',
    confirmButtonText: 'Try Again'
});
<?php elseif ($flag3): ?>
Swal.fire({
    icon: 'warning',
    title: 'OTP Expired',
    text: 'Your OTP has expired. Please request a new one.',
    confirmButtonText: 'OK'
}).then(() => {
    window.location.href = 'otp.php';
});
<?php endif; ?>
</script>
</body>
</html>
