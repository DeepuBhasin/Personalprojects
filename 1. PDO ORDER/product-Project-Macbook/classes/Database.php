<?php

namespace Classes;

require __DIR__ . '/DatabaseAbstract.php';


class Database extends AbstractDatabase
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

    public function selectQuery(string $query = ""): array
    {
        $c = mysqli_query($this->conn, $query);
        $data = [];
        if (mysqli_num_rows($c) > 0) {
            $data = [];
            while ($a = mysqli_fetch_array($c, MYSQLI_ASSOC)) {
                array_push($data, $a);
            }
        }
        return $data;
    }

    public function insertQuery(string $query = "")
    {
        return mysqli_query($this->conn, $query) ? mysqli_insert_id($this->conn) : mysqli_error($this->conn);
    }

    public function deleteQuery(string $query = "")
    {
        return mysqli_query($this->conn, $query) ? true : false;
    }

    public function __destruct()
    {
        mysqli_close($this->conn);
    }
}

$db = new Database();
