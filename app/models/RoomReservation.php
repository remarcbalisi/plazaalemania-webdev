<?php

class RoomReservation{

    public $id;
    public $room_id;
    public $reservation_id;

    protected $conn;

    public function save($model){

        $this->createConnection();

        $sql = "INSERT INTO room_reservation (room_id, reservation_id)
        VALUES (".$model->room_id.", ".$model->reservation_id.")";

        $result = $this->conn->query($sql);

        if (!$result) {
            trigger_error('Invalid query: ' . $this->conn->error);
        }

        $model->id = $this->conn->insert_id;

        $this->closeConnection();

        return $model;

    }

    public function getByReservationId($reservationid){

        $this->createConnection();

        $sql = "SELECT * FROM room_reservation WHERE reservation_id=".$reservationid;
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
