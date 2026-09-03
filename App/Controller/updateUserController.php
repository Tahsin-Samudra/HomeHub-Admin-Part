<?php
require_once __DIR__ . '/../../Config/Database.php';

$db = new Database();
$con = $db->connect();

$originalEmail = $_POST['original_email'] ?? null;
$name          = $_POST['name'] ?? null;
$age           = $_POST['age'] ?? null;
$newEmail      = $_POST['email'] ?? null;
$gender        = $_POST['gender'] ?? null;
$type          = $_POST['type'] ?? null;

if ($originalEmail && $name && $age && $newEmail && $gender && $type) {

    $stmt = mysqli_prepare($con, "UPDATE login SET name = ?, age = ?, gmail = ?, gender = ?, type = ? WHERE gmail = ?");
    mysqli_stmt_bind_param($stmt, "sissss", $name, $age, $newEmail, $gender, $type, $originalEmail);
    mysqli_stmt_execute($stmt);
}

header("Location: ../Views/dashboard.php?panel=panel-users");
exit;