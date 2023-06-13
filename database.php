<?php
class Database
{
    private $host = "localhost";
    private $db_name = "u231198616_temple_db";
    private $username = "u231198616_temple";
    private $password = "S@u028074500";

    private $conn;

    // get the database connection
    public function getConnectDB()
    {
        $this->conn = null;
        try {
            $this->conn =
                new PDO("mysql:host=" . $this->host . "; dbname=" .
                    $this->db_name, $this->username, $this->password);
            $this->conn->exec("set names utf8");
            //echo "Connection ok: ";
        } catch (PDOException $exception) {
            //echo "Connection error: " . $exception->getMessage();
        }
         
        return $this->conn;
    }

    public function closeConnectDB()
    {
        $this->conn = null;
    }
}
