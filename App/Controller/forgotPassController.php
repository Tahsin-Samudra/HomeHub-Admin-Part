<?php
require_once __DIR__ . '/../../Config/Database.php';

$db = new Database();
$con = $db->connect();

$email = $_POST['email'] ?? null;

if (!$email) {
    header("Location: ../Views/forgotPassword.php?error=1");
    exit;
}

// Check admin exists
$stmt = mysqli_prepare($con, "SELECT * FROM admintable WHERE Email = ?");
mysqli_stmt_bind_param($stmt, "s", $email);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

if (mysqli_num_rows($result) === 0) {
    header("Location: ../Views/forgotPassword.php?error=1");
    exit;
}

// Generate token + 30 min expiry
$token = bin2hex(random_bytes(32));
$expiry = date('Y-m-d H:i:s', strtotime('+30 minutes'));

$updateStmt = mysqli_prepare($con, "UPDATE admintable SET reset_token = ?, reset_expiry = ? WHERE Email = ?");
mysqli_stmt_bind_param($updateStmt, "sss", $token, $expiry, $email);
mysqli_stmt_execute($updateStmt);

// Real email er bodole link ta screen e dekhano hocche (demo purpose)
header("Location: ../Views/resetLinkDisplay.php?token=" . urlencode($token));
exit;