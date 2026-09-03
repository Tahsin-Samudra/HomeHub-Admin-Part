<?php
require_once __DIR__ . '/../../Config/Database.php';

$db = new Database();
$con = $db->connect();

$token = $_POST['token'] ?? null;
$newPassword = $_POST['password'] ?? null;

if (!$token || !$newPassword) {
    die("Invalid request.");
}


$stmt = mysqli_prepare($con, "SELECT * FROM admintable WHERE reset_token = ? AND reset_expiry > NOW()");
mysqli_stmt_bind_param($stmt, "s", $token);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

if (mysqli_num_rows($result) === 0) {
    die("This reset link is invalid or has expired.");
}

$hashedPassword = password_hash($newPassword, PASSWORD_BCRYPT);

$updateStmt = mysqli_prepare($con, "UPDATE admintable SET Password = ?, reset_token = NULL, reset_expiry = NULL WHERE reset_token = ?");
mysqli_stmt_bind_param($updateStmt, "ss", $hashedPassword, $token);
mysqli_stmt_execute($updateStmt);

header("Location: ../Views/login.php?reset=success");
exit;