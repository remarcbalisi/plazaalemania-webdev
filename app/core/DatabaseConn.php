<?php
class DatabaseConn{

    protected $servername = getenv("MYSQL_SERVICE_SERVICE_HOST");
    protected $port = getenv("MYSQL_SERVICE_SERVICE_PORT");
    protected $username = getenv("MYSQL_USER");
    protected $password = getenv("MYSQL_ROOT_PASSWORD");
    protected $dbname = getenv("MYSQL_DATABASE");
    public $connection;

    public function __construct(){
        // Create connection
        $this->connection = new mysqli($this->servername.":".$port, $this->username, $this->password, $this->dbname);

        // Check connection
        if ($this->connection->connect_error) {
            die("Connection failed: " . $this->connection->connect_error);
        }

    }

}

?>
