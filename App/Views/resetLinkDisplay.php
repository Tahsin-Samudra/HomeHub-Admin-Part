<?php
$token = $_GET['token'] ?? '';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Reset Link</title>
    <link rel="stylesheet" href="dashboard.css">
</head>
<body>

<div class="card" style="max-width: 500px; margin: 60px auto;">
    <div class="card-header"><h3>Reset Link Generated</h3></div>
    <div class="card-body">

        

        <a href="resetPassword.php?token=<?= htmlspecialchars($token) ?>">
            Click here to reset your password
        </a>

        <p style="margin-top:20px; font-size:12px; color:#777;">
            Ei link 30 minute er jonno valid.
        </p>

    </div>
</div>

</body>
</html>