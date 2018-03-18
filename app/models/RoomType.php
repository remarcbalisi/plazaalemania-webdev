<?php

class RoomType{

    public $id;
    public $name;
    public $description;
    public $price;
    public $branch_id;
    public $max_person;

    protected $conn;

    public function get(){

        $this->createConnection();

        $sql = "SELECT * FROM room_type";
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

    public function getByName($name){

        $this->createConnection();

        $sql = "SELECT * FROM room_type WHERE name='".$name."'";
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

        $sql = "INSERT INTO room_type (name, description, price, branch_id, max_person)
        VALUES ('".$model->name."', '".mysqli_real_escape_string($this->conn,$model->description)."', ".floatval($model->price).", ".$model->branch_id.", ".$model->max_person.")";

        $result = $this->conn->query($sql);

        if (!$result) {
            trigger_error('Invalid query: ' . $this->conn->error);
        }

        $model->id = $this->conn->insert_id;

        $this->closeConnection();

        return $model;

    }

    public function rooms($room_type_id){

        $this->createConnection();

        $sql = "SELECT * FROM room WHERE room_type_id=".$room_type_id."";
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

    public function createConnection(){

        $database = new DatabaseConn;
        $this->conn = $database->connection;

    }

    public function closeConnection(){
        $this->conn->close();
    }

}
