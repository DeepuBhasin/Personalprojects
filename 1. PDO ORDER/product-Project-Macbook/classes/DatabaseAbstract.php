<?php

namespace Classes;

abstract class AbstractDatabase
{
    private $host = 'localhost';
    private $user = 'root';
    private $password = '';
    private $dbname = 'products';
    protected $conn = null;

    public function __construct()
    {
        $this->conn = mysqli_connect($this->host, $this->user, $this->password, $this->dbname);
        if (!$this->conn) {
            die("Error : " . mysqli_connect_error());
        }
    }

    abstract public function selectQuery(string $query = ""): array;

    abstract public function insertQuery(string $query = "");

    abstract public function deleteQuery(string $query = "");

    public function __destruct()
    {
        mysqli_close($this->conn);
    }
}
