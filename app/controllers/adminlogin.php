<?php

class AdminLogin extends Controller{

    protected $auth_user;

    public function __construct(){
        $this->auth_user = $this->model('AuthUser');
    }

    public function index(){

        if( $this->auth_user->auth ){

            $link = Globals::baseUrl()."/public/adminhome/index";
            header("Location: ".$link);
            exit();

        }

        $this->view('admin/login');

    }

    public function login(){

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $user = $this->model('User');
            $user = $user->getByEmail($_POST['email']);

            if( !empty($user) ){
                if( password_verify($_POST['password'], $user[0]['password']) ){
                    $_SESSION['usermail'] = $_POST['email'];
                    $link = Globals::baseUrl()."/public/adminhome/index";
                    header("Location: ".$link);
                    exit();
                }
                else{
                    $status = 406;
                    $status_message = StatusCodes::getCode($status);
                    $message = "Wrong Email or Password";
                    $this->view('admin/login', [
                        'status'=> $status,
                        'status_message' => $status_message,
                        'message' => $message
                    ]);
                }
            }
            else{
                $status = 406;
                $status_message = StatusCodes::getCode($status);
                $message = "Wrong Email or Password";
                $this->view('admin/login', [
                    'status'=> $status,
                    'status_message' => $status_message,
                    'message' => $message
                ]);
            }


        }

    }

}

?>
