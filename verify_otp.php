<?php
session_start();

// Get user input
$user_otp = $_POST['otp'] ?? '';

// Check OTP and expiry
if (
    isset($_SESSION['otp'], $_SESSION['otp_expiry']) &&
    time() <= $_SESSION['otp_expiry']
) {
    if ($user_otp == $_SESSION['otp']) {
        echo "✅ OTP verified successfully!";
        // Optionally: unset OTP after use
        unset($_SESSION['otp'], $_SESSION['otp_expiry']);
    } else {
        echo "❌ Invalid OTP.";
    }
} else {
    echo "⏰ OTP expired. Please request a new one.";
}
?>
