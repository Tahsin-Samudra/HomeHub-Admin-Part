<?php

// Database.php is:
// HomeHub/Config/Database.php

include(__DIR__ . "/../../../Config/Database.php");


// Create database connection
$db = new Database();
$con = $db->connect();


function getAll($table)
{
    global $con;

    $query = "SELECT * FROM $table";

    $stmt = mysqli_prepare($con, $query);

    if (!$stmt) {
        return false;
    }

    mysqli_stmt_execute($stmt);

    $result = mysqli_stmt_get_result($stmt);

    return $result;
}

function getWhere($table, $column, $value) {
    global $con; 

    $stmt = mysqli_prepare($con, "SELECT * FROM $table WHERE $column = ?");
    mysqli_stmt_bind_param($stmt, "s", $value);
    mysqli_stmt_execute($stmt);
    return mysqli_stmt_get_result($stmt);
}

function redirect($url, $message)
{
    session_start();

    $_SESSION['flash_message'] = $message;

    header("Location: $url");

    exit();
}

?>