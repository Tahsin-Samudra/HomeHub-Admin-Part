<?php

class loginController
{
    private $user;


    public function __construct($connection)
    {
        $this->user = new admin($connection);
    }

    public function showLogin()
    {
        require_once "../app/views/auth/login.php";
    }

    public function login()
    {

        $email = trim($_POST['email'] ?? '');

        $password = $_POST['password'] ?? '';


        if ($email === '' || $password === '') {

            $error = "Email and password are required.";

            require_once "../app/views/auth/login.php";

            return;
        }


        $user = $this->user->findByEmail($email);


        if (
            $user &&
            password_verify($password, $user['password'])
        ) {

            session_start();

            $_SESSION['user_id'] = $user['id'];

            $_SESSION['user_name'] = $user['name'];

            $_SESSION['user_email'] = $user['email'];


            header("Location: ../Views/dashboard.php");

        } else {

            $error = "Invalid email or password.";
            header("Location: ../Views/dashboard.php");

            require_once "../app/views/auth/login.php";

        }

    }

}

?>