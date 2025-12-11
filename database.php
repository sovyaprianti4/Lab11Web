<?php
class Database
{
    protected $host;
    protected $user;
    protected $password;
    protected $db_name;
    protected $conn;

    public function __construct()
    {
        $this->getConfig();

        $this->conn = new mysqli(
            $this->host,
            $this->user,
            $this->password,
            $this->db_name
        );

        if ($this->conn->connect_error) {
            die("Koneksi gagal: " . $this->conn->connect_error);
        }
    }

    private function getConfig()
    {
        include "config.php";
        $this->host = $config['host'];
        $this->user = $config['username'];
        $this->password = $config['password'];
        $this->db_name = $config['db_name'];
    }

    public function query($sql)
    {
        return $this->conn->query($sql);
    }

    public function insert($table, $data)
    {
        foreach ($data as $key => $val) {
            $columns[] = $key;
            $values[]  = "'$val'";
        }

        $c = implode(",", $columns);
        $v = implode(",", $values);

        return $this->conn->query("INSERT INTO $table ($c) VALUES ($v)");
    }

    public function update($table, $data, $where)
    {
        foreach ($data as $key => $val) {
            $updates[] = "$key='$val'";
        }

        $updateQuery = implode(",", $updates);

        return $this->conn->query("UPDATE $table SET $updateQuery WHERE $where");
    }
}
?>