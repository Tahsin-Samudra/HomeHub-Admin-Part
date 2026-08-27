<?php

session_start();

require_once __DIR__ . '/../../Config/Database.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $email = trim($_POST["email"]);
    $password = $_POST["password"];

    // Database connection
    $db = new Database();
    $con = $db->connect();

    // Find user by email
    $query = "SELECT * FROM admintable WHERE Email = ?";

    $stmt = mysqli_prepare($con, $query);

    if (!$stmt) {
        die("Query preparation failed: " . mysqli_error($con));
    }

    mysqli_stmt_bind_param($stmt, "s", $email);

    mysqli_stmt_execute($stmt);

    $result = mysqli_stmt_get_result($stmt);

    // Check if user exists
    if (mysqli_num_rows($result) === 1) {

        $user = mysqli_fetch_assoc($result);

        // Your database currently stores plain-text passwords
        if ($password === $user['Password']) {

            // Store user information in session
            $_SESSION['user_email'] = $user['Email'];
            $_SESSION['user_name'] = $user['Name'];
            $_SESSION['user_phone'] = $user['PhoneNumber'];
            $_SESSION['user_address'] = $user['Address'];

            // Login successful
            header("Location: ../Views/dashboard.php");
            exit();

        } else {

            // Wrong password
            header("Location: ../Views/Auth/login.php?error=Invalid password");
            exit();
        }

    } else {

        // Email doesn't exist
        header("Location: ../Views/Auth/login.php?error=User not found");
        exit();
    }
}
?>