
<?php

require_once __DIR__ . "/../../Config/Database.php";

$errors = [];

$name = "";
$email = "";
$phone = "";
$address = "";


function emailExists($email)
{
    $db = new Database();
    $con = $db->connect();

    $query = "SELECT Email FROM admintable WHERE Email = ?";

    $stmt = mysqli_prepare($con, $query);
    mysqli_stmt_bind_param($stmt, "s", $email);
    mysqli_stmt_execute($stmt);

    $result = mysqli_stmt_get_result($stmt);

    return mysqli_num_rows($result) > 0;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // ==========================
    // Input Values
    // ==========================

    $name = trim($_POST["name"] ?? "");
    $email = trim($_POST["email"] ?? "");
    $phone = trim($_POST["phone"] ?? "");
    $password = $_POST["password"] ?? "";
    $confirmPassword = $_POST["confirm_password"] ?? "";
    $address = trim($_POST["address"] ?? "");


    // ==========================
    // Name Validation
    // ==========================

    if ($name == "") {

        $errors["name"] = "Name is required.";

    }
    else if (!preg_match("/^[A-Za-z ]+$/", $name)) {

        $errors["name"] = "Only letters are allowed.";

    }


    // ==========================
    // Email Validation
    // ==========================

    /*
    public function emailExists($email)
    {
        $query = "SELECT Email FROM admintable WHERE Email = ?";

        $stmt = $this->db->prepare($query);
        $stmt->bind_param("s", $email);
        $stmt->execute();

        $result = $stmt->get_result();

        return $result->num_rows > 0;
    }
    */

    if ($email == "") {

        $errors["email"] = "Email is required.";

    }
    else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {

        $errors["email"] = "Invalid email address.";

    }
    else if(emailExists($email)) {

        $errors["email"] = "Email already exists.";

    }


    // ==========================
    // Phone Validation
    // ==========================

    if ($phone == "") {

        $errors["phone"] = "Phone number is required.";

    }
    else if (!preg_match("/^01[3-9][0-9]{8}$/", $phone)) {

        $errors["phone"] = "Enter a valid Bangladeshi phone number.";

    }


    // ==========================
    // Password Validation
    // ==========================

    if ($password == "") {

        $errors["password"] = "Password is required.";

    }
    else if (strlen($password) < 6) {

        $errors["password"] = "Password must be at least 6 characters.";

    }


    // ==========================
    // Confirm Password
    // ==========================

    if ($confirmPassword == "") {

        $errors["confirm_password"] =
            "Please confirm your password.";

    }
    else if ($confirmPassword != $password) {

        $errors["confirm_password"] =
            "Passwords do not match.";

    }


    // ==========================
    // Address Validation
    // ==========================

    if ($address == "") {

        $errors["address"] = "Address is required.";

    }
    else if (strlen($address) < 10) {

        $errors["address"] =
            "Address must be at least 10 characters.";

    }


    // ==========================
    // Database
    // ==========================

    if (empty($errors)) {

        $db = new Database();
        $con = $db->connect();


        // Hash password before storing
        $hashedPassword = password_hash(
            $password,
            PASSWORD_DEFAULT
        );


        $sql = "INSERT INTO admintable
                (`Email`, `Password`, `Name`, `PhoneNumber`, `Address`)
                VALUES (?, ?, ?, ?, ?)";


        $stmt = mysqli_prepare($con, $sql);


        if ($stmt) {

            mysqli_stmt_bind_param(
                $stmt,
                "sssss",
                $name,
                $email,
                $phone,
                $hashedPassword,
                $address
            );


            if (mysqli_stmt_execute($stmt)) {

                header("Location: ../Views/success.php");
                exit();

            }
            else {

                $errors["database"] =
                    "Failed to create user.";

            }

        }
        else {

            $errors["database"] =
                "Database query failed.";

        }

    }

}

?>


<!DOCTYPE html>

<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>Create User</title>

    <link rel="stylesheet"
          href="../Views/addAdmin.css">

</head>


<body>

<div class="container">

    <h2>Create User</h2>


    <form method="POST"
          action="./adminRegController.php">


        <!-- Name -->

        <label for="name">
            Full Name
        </label>

        <input
            type="text"
            id="name"
            name="name"
            value="<?= htmlspecialchars($name) ?>"
            placeholder="Enter your full name"
        >

        <small class="error">
            <?= $errors["name"] ?? "" ?>
        </small>


        <!-- Email -->

        <label for="email">
            Email Address
        </label>

        <input
            type="email"
            id="email"
            name="email"
            value="<?= htmlspecialchars($email) ?>"
            placeholder="example@gmail.com"
        >

        <small class="error">
            <?= $errors["email"] ?? "" ?>
        </small>


        <!-- Phone -->

        <label for="phone">
            Phone Number
        </label>

        <input
            type="text"
            id="phone"
            name="phone"
            value="<?= htmlspecialchars($phone) ?>"
            placeholder="e.g. 01712345678"
        >

        <small class="error">
            <?= $errors["phone"] ?? "" ?>
        </small>


        <!-- Password -->

        <label for="password">
            Password
        </label>

        <input
            type="password"
            id="password"
            name="password"
            placeholder="Enter password"
        >

        <small class="error">
            <?= $errors["password"] ?? "" ?>
        </small>


        <!-- Confirm Password -->

        <label for="confirm_password">
            Confirm Password
        </label>

        <input
            type="password"
            id="confirm_password"
            name="confirm_password"
            placeholder="Re-enter password"
        >

        <small class="error">
            <?= $errors["confirm_password"] ?? "" ?>
        </small>


        <!-- Address -->

        <label for="address">
            Address
        </label>

        <textarea
            id="address"
            name="address"
            rows="4"
            placeholder="Enter your address"
        ><?= htmlspecialchars($address) ?></textarea>

        <small class="error">
            <?= $errors["address"] ?? "" ?>
        </small>


        <!-- Database Error -->

        <?php if (isset($errors["database"])): ?>

            <small class="error">
                <?= $errors["database"] ?>
            </small>

        <?php endif; ?>


        <!-- Submit -->

        <button type="submit">
            Submit
        </button>


    </form>

</div>

</body>

</html>

