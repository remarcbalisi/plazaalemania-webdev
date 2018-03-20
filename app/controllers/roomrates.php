<?php

class RoomRates extends Controller{

    public function index(){
        $roomtypes = $this->model('RoomType');
        $this->view('roomrates', [
            'roomtypes' => $roomtypes
        ]);

    }

    public function viewRoom(){

    }

}

?>
