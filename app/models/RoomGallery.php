<?php

class RoomGallery{

    public $id;
    public $image_name;
    public $directory;
    public $dimension;
    public $room_type_id;
    public $meta;

    protected $conn;

    public function save($model){

        $this->createConnection();

        $sql = "INSERT INTO room_gallery (image_name, directory, dimension, room_type_id, meta)
        VALUES ('".$model->image_name."', '".$model->directory."', '".$model->dimension."', ".$model->room_type_id.", '".$model->meta."')";

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

        $sql = "UPDATE room_gallery SET image_name='".$model->image_name."', directory='".$model->directory."',
        dimension='".$model->dimension."', room_type_id=".$model->room_type_id.", meta='".$model->meta."' WHERE id=".$model->id;

        if ($this->conn->query($sql) === TRUE) {
            return $model;
        } else {
            echo "Error updating room gallery: " . $this->conn->error;
        }

        $this->closeConnection();

    }

    public function delete($id){

        $this->createConnection();

        $sql = "DELETE FROM room_gallery WHERE id=".$id;

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

    public function getByMeta($meta, $dimension=null){

        $this->createConnection();

        $sql=null;
        $result=null;
        $data=null;

        if( !$dimension ){
            $sql = "SELECT * FROM room_gallery WHERE meta='".$meta."'";
            $result = $this->conn->query($sql);
            $data = [];
        }
        else{
            $sql = "SELECT * FROM room_gallery WHERE meta='".$meta."' AND dimension='".$dimension."'";
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
