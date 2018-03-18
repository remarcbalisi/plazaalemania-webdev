<?php
class DatabaseConn{

    protected $servername = "sql101.epizy.com";
    protected $username = "epiz_21807447";
    protected $password = "win2k2017";
    protected $dbname = "epiz_21807447_plazaalemania";
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
