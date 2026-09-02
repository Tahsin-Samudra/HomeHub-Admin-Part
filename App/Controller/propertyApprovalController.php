<?php
require_once __DIR__ . '/../../Config/Database.php';

$db = new Database();
$con = $db->connect();

$propertyId = $_POST['property_id'] ?? null;
$action = $_POST['action'] ?? null;

if ($propertyId && in_array($action, ['approve', 'reject'])) {

    if ($action === 'approve') {
        $newStatus = 'Approved';
    } else {
        $newStatus = 'Rejected';
    }

    $stmt = mysqli_prepare($con, "UPDATE properties SET approval_status = ? WHERE property_id = ?");
    mysqli_stmt_bind_param($stmt, "si", $newStatus, $propertyId);
    mysqli_stmt_execute($stmt);
}

header("Location: ../Views/dashboard.php?panel=panel-approval");
exit;