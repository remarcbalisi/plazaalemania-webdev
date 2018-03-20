<?php

class ViewRoom extends Controller{

    public function index($roomtypename){

        $roomtypes = $this->model('RoomType');

        $roomtypenospace_array = [];
        foreach( $roomtypes->get() as $rt ){

            $roomtypenospace_array[str_replace(' ', '', $rt['name'])][0] = $rt['name'];

        }
        $rooms = $this->model('Room');
        $roomtype = $this->model('RoomType')->getByName($roomtypenospace_array[$roomtypename][0]);
        $this->view('viewroom', [
            'roomtypes' => $roomtypes,
            'roomtype' => $roomtype,
            'rooms' => $rooms
        ]);

    }

    public function viewRoom(){

    }

}

?>
