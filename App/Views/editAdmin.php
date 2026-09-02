<?php
include(__DIR__ . "/Auth/fetcher.php");

$email = $_GET['email'] ?? null;

if (!$email) {
    header("Location: dashboard.php?panel=panel-admins");
    exit;
}

$result = getWhere('admintable', 'Email', $email);
$admin = mysqli_fetch_assoc($result);

if (!$admin) {
    header("Location: dashboard.php?panel=panel-admins");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Admin</title>
    <link rel="stylesheet" href="dashboard.css">
</head>
<body>

<div class="card" style="max-width: 500px; margin: 40px auto;">
    <div class="card-header"><h3>Edit Admin</h3></div>
    <div class="card-body">

        <form method="POST" action="../Controller/updateAdminController.php">

            <input type="hidden" name="original_email" value="<?= htmlspecialchars($admin['Email']) ?>">

            <label>Name</label>
            <input type="text" name="name" value="<?= htmlspecialchars($admin['Name']) ?>" required>

            <label>Email</label>
            <input type="email" name="email" value="<?= htmlspecialchars($admin['Email']) ?>" required>

            <label>Phone Number</label>
            <input type="text" name="phone" value="<?= htmlspecialchars($admin['PhoneNumber']) ?>" required>

            <label>Address</label>
            <input type="text" name="address" value="<?= htmlspecialchars($admin['Address']) ?>" required>

            <button type="submit" id="button-updateadmin">Update</button>
            <a href="dashboard.php?panel=panel-admins"><button type="button" id="button-updateadmincancelbtn">Cancel</button></a>

        </form>

    </div>
</div>

</body>
</html>