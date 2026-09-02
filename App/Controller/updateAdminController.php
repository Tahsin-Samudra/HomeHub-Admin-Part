<?php
require_once __DIR__ . '/../../Config/Database.php';

$db = new Database();
$con = $db->connect();

$originalEmail = $_POST['original_email'] ?? null;
$name          = $_POST['name'] ?? null;
$newEmail      = $_POST['email'] ?? null;
$phone         = $_POST['phone'] ?? null;
$address       = $_POST['address'] ?? null;

if ($originalEmail && $name && $newEmail && $phone && $address) {

    $stmt = mysqli_prepare($con, "UPDATE admintable SET Name = ?, Email = ?, PhoneNumber = ?, Address = ? WHERE Email = ?");
    mysqli_stmt_bind_param($stmt, "sssss", $name, $newEmail, $phone, $address, $originalEmail);
    mysqli_stmt_execute($stmt);
}

header("Location: ../Views/dashboard.php?panel=panel-admins");
exit;