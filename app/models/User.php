<?php

class User{
    public $id;
    public $fname;
    public $mname;
    public $lname;
    public $email;
    public $password;
    public $image;
    public $role_id;
    public $auth;
    public $contact_id;

    protected $conn;

    public function __construct(){

        if(!isset($_SESSION))
        {
            session_start();
        }

        if(!isset($_SESSION['usermail']) || empty($_SESSION['usermail'])){

            $this->auth = false;

        }
        else{
            $this->auth = true;
        }

    }

    public function getByRole($role){



    }

    public function getByEmail($email){

        $this->createConnection();

        $sql = "SELECT * FROM user WHERE email = '".$email."'";
        $result = $this->conn->query($sql);
        $data = [];

        if (!$result) {
            trigger_error('Invalid query: ' . $this->conn->error);
        }

        if ($result->num_rows > 0) {
            // output data of each row
            while( $row = $result->fetch_assoc() ){
                array_push($data, $row);
            }
            return $data;

        } else {
            $result = [];
            return $result;
        }

        $this->closeConnection();

    }

    public function save($model){

        $this->createConnection();

        $sql = "INSERT INTO user (fname, mname, lname, email, password, address, contact, gender, image, role_id)
        VALUES ('".$model->fname."', '".$model->mname."', '".$model->lname."', '".$model->email."', '".$model->password."', '".$model->address."', '".$model->contact."', '".$model->gender."', '".$model->image."', ".$model->role_id.")";

        $result = $this->conn->query($sql);
        $data = [];

        if (!$result) {
            trigger_error('Invalid query: ' . $this->conn->error);
        }

        $model->id = $this->conn->insert_id;

        $this->closeConnection();

        return $model;

    }

    public function login($email){

    }

    public function createConnection(){

        $database = new DatabaseConn;
        $this->conn = $database->connection;

    }

    public function closeConnection(){
        $this->conn->close();
    }
}

?>
