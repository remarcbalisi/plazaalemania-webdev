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

    public function getById($id){

        $this->createConnection();

        $sql = "SELECT * FROM room_type WHERE id='".$id."'";
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

    public function update($model){

        $this->createConnection();

        $sql = "UPDATE room_type SET name='".$model->name."', description='".mysqli_real_escape_string($this->conn,$model->description)."', price=".floatval($model->price).",
        branch_id=".$model->branch_id.", max_person=".$model->max_person." WHERE id=".$model->id."";

        if ($this->conn->query($sql) === TRUE) {
            return $model;

        } else {
            echo "Error updating record: " . $this->conn->error;
        }

        $this->closeConnection();

    }

    public function delete($id){

        $this->createConnection();

        $sql = "DELETE FROM room_type WHERE id=".$id;

        if ($this->conn->query($sql) === TRUE) {
            $this->closeConnection();
            return true;
            exit();
        } else {
            echo "Error deleting record: " . $this->conn->error;
        }
        return false;
        $this->closeConnection();
        exit();

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

    public function getImages($room_type_id, $dimension=null){

        $this->createConnection();
        $sql=null;
        $result=null;
        $data = [];
        if( $dimension ){
            $sql = "SELECT * FROM room_gallery WHERE room_type_id=".$room_type_id." AND dimension='".$dimension."'";
            $result = $this->conn->query($sql);
            $data = [];
        }
        else{
            $sql = "SELECT * FROM room_gallery WHERE room_type_id=".$room_type_id."";
            $result = $this->conn->query($sql);
            $data = [];
        }

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
