<?php
require_once __DIR__ . '/../../Config/Database.php';

$db = new Database();
$con = $db->connect();

$email = $_POST['email'] ?? null;

if ($email) {
    $stmt = mysqli_prepare($con, "DELETE FROM admintable WHERE Email = ?");
    mysqli_stmt_bind_param($stmt, "s", $email);
    mysqli_stmt_execute($stmt);
}

header("Location: ../Views/dashboard.php?panel=panel-admins");
exit;