<?php

class Home extends Controller{

    public function index(){

        $roles = $this->model('Role')->get();
        $this->view('home/index');

    }

}

?>
