<?php

session_start();

require_once __DIR__ . '/../../Config/Database.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $email = trim($_POST["email"]);
    $password = $_POST["password"];

    
    $db = new Database();
    $con = $db->connect();

    
    $query = "SELECT * FROM admintable WHERE Email = ?";

    $stmt = mysqli_prepare($con, $query);

    if (!$stmt) {
        die("Query preparation failed: " . mysqli_error($con));
    }

    mysqli_stmt_bind_param($stmt, "s", $email);

    mysqli_stmt_execute($stmt);

    $result = mysqli_stmt_get_result($stmt);

    
    if (mysqli_num_rows($result) === 1) {

        $user = mysqli_fetch_assoc($result);

        
        if ($password === $user['Password']) {

            
            $_SESSION['user_email'] = $user['Email'];
            $_SESSION['user_name'] = $user['Name'];
            $_SESSION['user_phone'] = $user['PhoneNumber'];
            $_SESSION['user_address'] = $user['Address'];

            
            header("Location: ../Views/dashboard.php");
            exit();

        } else {

            
            header("Location: ../Views/Auth/login.php?error=Invalid password");
            exit();
        }

    } else {

        
        header("Location: ../Views/Auth/login.php?error=User not found");
        exit();
    }
}
?>