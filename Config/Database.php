<?php

class Database
{
    private $host = "localhost";
    private $database = "realestatehomehub";
    private $username = "root";
    private $password = "";
    private $con;

    public function connect()
    {
        $this->con = mysqli_connect(
            $this->host,
            $this->username,
            $this->password,
            $this->database
        );

        if (!$this->con) {
            die("Connection failed: " . mysqli_connect_error());
        }

        return $this->con;
    }
}

?>