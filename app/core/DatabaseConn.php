<?php
class DatabaseConn{

    protected $servername = "localhost";
    protected $username = "root";
    protected $password = "";
    protected $dbname = "plazaalemaniawebdev";
    public $connection;

    public function __construct(){
        // Create connection
        $this->connection = new mysqli($this->servername, $this->username, $this->password, $this->dbname);

        // Check connection
        if ($this->connection->connect_error) {
            die("Connection failed: " . $this->connection->connect_error);
        }

    }

}

?>
