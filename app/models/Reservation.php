<?php
class Reservation{

    public $id;
    public $checkin;
    public $checkout;
    public $user_id;

    protected $conn;

    public function save($model){

        $this->createConnection();

        $sql = "INSERT INTO reservation (checkin, checkout, user_id)
        VALUES ('".$model->checkin."', '".$model->checkout."', ".$model->user_id.")";

        $result = $this->conn->query($sql);

        if (!$result) {
            trigger_error('Invalid query: ' . $this->conn->error);
        }

        $model->id = $this->conn->insert_id;

        $this->closeConnection();

        return $model;

    }

    public function checkAvailability($checkin, $checkout){

        $this->createConnection();

        $sql = "SELECT *
        FROM reservation
        WHERE checkin <= DATE_SUB('".$checkout."', INTERVAL 0 DAY)
        AND checkout >= DATE_SUB('".$checkin."', INTERVAL 0 DAY)";

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

    public function getRoomType($reservationid){

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
                // array_push($data, $row);

                $sqlroom = "SELECT * FROM room WHERE id=".$row['room_id'];
                $resultroom = $this->conn->query($sqlroom);

                if (!$resultroom) {
                    trigger_error('Invalid query: ' . $this->conn->error);
                }

                if ($resultroom->num_rows > 0) {
                    // output data of each row
                    while( $rowroom = $result->fetch_assoc() ){
                        // array_push($data, $row);

                        $sqlroomtype = "SELECT * FROM room_type WHERE id=".$rowroom['room_type_id'];
                        $resultroomtype = $this->conn->query($sqlroomtype);

                        if (!$resultroom) {
                            trigger_error('Invalid query: ' . $this->conn->error);
                        }

                        if ($resultroom->num_rows > 0) {
                            // output data of each row
                            while( $rowroomtype = $result->fetch_assoc() ){
                                return $rowroomtype;
                                break;
                            }
                        }


                    }
                    // return $data;

                } else {
                    $result = [];
                    return $result;
                }


            }
            return $data;

        } else {
            $result = [];
            return $result;
        }

    }

    public function createConnection(){

        $database = new DatabaseConn;
        $this->conn = $database->connection;

    }

    public function closeConnection(){
        $this->conn->close();
    }

}
