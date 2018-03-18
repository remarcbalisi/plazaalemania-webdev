<?php

class AdminRooms extends Controller{

    protected $auth_user;

    public function __construct(){
        $this->auth_user = $this->model('AuthUser');
        if( !$this->auth_user->checkRole($this->auth_user->role_id, "admin") ){
            echo "Unauthorized Access";
            exit();
        }
    }

    public function index(){

        if( $this->auth_user->auth ){

            $branches = $this->model('Branch')->get();
            $this->view('admin/rooms', [
                'user'=>$this->auth_user,
                'branches' => $branches
            ]);

        }
        else{

            $link = Globals::baseUrl()."/public/adminlogin";
            header("Location: ".$link);
            exit();

        }

    }

}
