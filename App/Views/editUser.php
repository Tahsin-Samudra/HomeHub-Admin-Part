<?php
include(__DIR__ . "/Auth/fetcher.php");

$email = $_GET['email'] ?? null;

if (!$email) {
    header("Location: dashboard.php?panel=panel-users");
    exit;
}

$result = getWhere('login', 'gmail', $email);
$user = mysqli_fetch_assoc($result);

if (!$user) {
    header("Location: dashboard.php?panel=panel-users");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit User</title>
    <link rel="stylesheet" href="dashboard.css">
</head>
<body>

<div class="card" style="max-width: 500px; margin: 40px auto;">
    <div class="card-header"><h3>Edit User</h3></div>
    <div class="card-body">

        <form method="POST" action="../Controller/updateUserController.php">

            <input type="hidden" name="original_email" value="<?= htmlspecialchars($user['gmail']) ?>">

            <label>Name</label>
            <input type="text" name="name" value="<?= htmlspecialchars($user['name']) ?>" required>

            <label>Age</label>
            <input type="number" name="age" value="<?= htmlspecialchars($user['age']) ?>" required>

            <label>Email</label>
            <input type="email" name="email" value="<?= htmlspecialchars($user['gmail']) ?>" required>

            <label>Gender</label>
            <input type="text" name="gender" value="<?= htmlspecialchars($user['gender']) ?>" required>

            <label>Type</label>
            <input type="text" name="type" value="<?= htmlspecialchars($user['type']) ?>" required>

            <button type="submit">Update</button>
            <a href="dashboard.php?panel=panel-users">Cancel</a>

        </form>

    </div>
</div>

</body>
</html>