<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Forgot Password</title>
    <link rel="stylesheet" href="dashboard.css">
</head>
<body>

<div class="card" style="max-width: 400px; margin: 60px auto;">
    <div class="card-header"><h3>Forgot Password</h3></div>
    <div class="card-body">

        <form method="POST" action="../Controller/forgotPasswordController.php">
            <label>Enter your admin email</label>
            <input type="email" name="email" required>
            <button type="submit">Send Reset Link</button>
        </form>

        <?php if (isset($_GET['error'])): ?>
            <p style="color:red;">No admin found with that email.</p>
        <?php endif; ?>

    </div>
</div>

</body>
</html>