<?php

class Home extends Controller{

    public function index(){
        $roomtypes = $this->model('RoomType');
        $this->view('index', [
            'roomtypes' => $roomtypes
        ]);

    }

    public function viewRoom(){

    }

}

?>
