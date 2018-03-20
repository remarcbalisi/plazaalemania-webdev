<?php

class Room{

    public $id;
    public $number;
    public $room_type_id;
    public $is_available;

    protected $conn;

    public function save($model){

        $this->createConnection();

        $sql = "INSERT INTO room (number, room_type_id)
        VALUES ('".$model->number."', ".$model->room_type_id.")";

        $result = $this->conn->query($sql);

        if (!$result) {
            trigger_error('Invalid query: ' . $this->conn->error);
        }

        $model->id = $this->conn->insert_id;

        $this->closeConnection();

        return $model;

    }

    public function getWithNoRoomType(){

        $this->createConnection();

        $sql = "SELECT * FROM room WHERE room_type_id IS NULL";
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

    public function getByNumber($number){

        $this->createConnection();

        $sql = "SELECT * FROM room WHERE number='".$number."'";
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
