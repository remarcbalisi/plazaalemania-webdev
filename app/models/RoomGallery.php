<?php

class RoomGallery{

    public $id;
    public $image_name;
    public $directory;
    public $dimension;
    public $room_type_id;

    protected $conn;

    public function save($model){

        $this->createConnection();

        $sql = "INSERT INTO room_gallery (image_name, directory, dimension, room_type_id)
        VALUES ('".$model->image_name."', '".$model->directory."', '".$model->dimension."', ".$model->room_type_id.")";

        $result = $this->conn->query($sql);

        if (!$result) {
            trigger_error('Invalid query: ' . $this->conn->error);
        }

        $model->id = $this->conn->insert_id;

        $this->closeConnection();

        return $model;

    }

}
