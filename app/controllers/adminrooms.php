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

    public function addroomtype(){

        if( !$this->model('RoomType')->getByName($_POST['room_name']) ){

            $new_room_type = $this->model('RoomType');
            $new_room_type->name = $_POST['room_name'];
            $new_room_type->description = $_POST['description'];
            $new_room_type->price = $_POST['price'];
            $new_room_type->branch_id = $_POST['branch_id'];
            $new_room_type->max_person = $_POST['max_person'];
            $new_room_type = $new_room_type->save($new_room_type);

            $status = 200;
            $status_message = StatusCodes::getCode($status);
            $message = "Successfully added " . $new_room_type->name;

            $branches = $this->model('Branch')->get();
            $this->view('admin/rooms', [
                'status'=> $status,
                'status_message' => $status_message,
                'message' => $message,
                'for_form' => 'addroomtype',
                'branches' => $branches
            ]);

            exit();

        }
        else{
            $status = 409;
            $status_message = StatusCodes::getCode($status);
            $message = "Room Type Already Exists!";
            $branches = $this->model('Branch')->get();
            $this->view('admin/rooms', [
                'status'=> $status,
                'status_message' => $status_message,
                'message' => $message,
                'for_form' => 'addroomtype',
                'branches' => $branches
            ]);
            exit();
        }


    }

}
