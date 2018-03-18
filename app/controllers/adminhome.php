<?php

class AdminHome extends Controller{

    protected $auth_user;

    public function __construct(){
        $this->auth_user = $this->model('AuthUser');
    }

    public function index(){

        if( $this->auth_user->auth ){

            $roles = $this->model('Role')->get();
            $this->view('admin/home', ['roles'=>$roles, 'user'=>$this->auth_user]);

        }
        else{

            $link = Globals::baseUrl()."/public/adminlogin";
            header("Location: ".$link);
            exit();

        }

    }

    public function adduser(){

        if( $this->auth_user->auth ){

            if(isset($_POST["submit"])) {

                $err_msg = "";
                $target_dir = "public/img/prof_pic/";
                $image_name = $_POST['email']."_" .basename($_FILES["prof_pic"]["name"]);
                $target_file = "../".$target_dir . $image_name;
                $uploadOk = 1;
                $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

                if( $_POST['password'] != $_POST['confirm_password'] ){
                    $roles = $this->model('Role')->get();
                    $err_msg =  "Password does not match!";
                    $this->view('admin/home', ['roles'=>$roles, 'user'=>$this->auth_user, 'error_msg'=>$err_msg]);
                    exit;
                }

                $check_email = $this->model('User')->getByEmail($_POST['email']);

                if( !empty($check_email) ){
                    $roles = $this->model('Role')->get();
                    $err_msg =  "Email Already taken!";
                    $this->view('admin/home', ['roles'=>$roles, 'user'=>$this->auth_user, 'error_msg'=>$err_msg]);
                    exit;
                }

                // Check if image file is an actual image or fake image
                $check = getimagesize($_FILES["prof_pic"]["tmp_name"]);
                if($check !== false) {
                    $uploadOk = 1;
                } else {
                    $err_msg =  "File is not an image.";
                    $uploadOk = 0;

                    $roles = $this->model('Role')->get();
                    $this->view('admin/home', ['roles'=>$roles, 'user'=>$this->auth_user, 'error_msg'=>$err_msg]);
                    exit;
                }

                // Check if file already exists
                // if (file_exists($target_file)) {
                //     echo "Sorry, file already exists.";
                //     $uploadOk = 0;
                // }
                // Check file size
                if ($_FILES["prof_pic"]["size"] > 10000000) {
                    $err_msg =  "Sorry, your file is too large.";
                    $uploadOk = 0;
                    $roles = $this->model('Role')->get();
                    $this->view('admin/home', ['roles'=>$roles, 'user'=>$this->auth_user, 'error_msg'=>$err_msg]);
                    exit;
                }
                // Allow certain file formats
                if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
                && $imageFileType != "gif" ) {
                    $err_msg = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
                    $uploadOk = 0;
                    $roles = $this->model('Role')->get();
                    $this->view('admin/home', ['roles'=>$roles, 'user'=>$this->auth_user, 'error_msg'=>$err_msg]);
                    exit;
                }
                // Check if $uploadOk is set to 0 by an error
                if ($uploadOk == 0) {
                    $err_msg = "Sorry, your file was not uploaded.";
                    $roles = $this->model('Role')->get();
                    $this->view('admin/home', ['roles'=>$roles, 'user'=>$this->auth_user, 'error_msg'=>$err_msg]);
                    exit;
                // if everything is ok, try to upload file
                } else {
                    if (move_uploaded_file($_FILES["prof_pic"]["tmp_name"], $target_file)) {
                        //echo "The file ". basename( $_FILES["prof_pic"]["name"]). " has been uploaded.";
                        $new_user = $this->model('User');
                        $new_user->fname = $_POST['fname'];
                        $new_user->mname = $_POST['mname'];
                        $new_user->lname = $_POST['lname'];
                        $new_user->email = $_POST['email'];
                        $hashedpassword = password_hash($_POST['password'], PASSWORD_BCRYPT);
                        $new_user->password = $hashedpassword;
                        $new_user->address = $_POST['address'];
                        $new_user->contact = $_POST['contact'];
                        $new_user->gender = $_POST['gender'];
                        $new_user->prof_pic = $target_dir . $image_name;
                        $new_user->role_id = $_POST['role'];
                        $new_user = $new_user->save($new_user);

                        $succ_msg = "Successfully added " . $new_user->fname;
                        $roles = $this->model('Role')->get();
                        $this->view('admin/home', ['roles'=>$roles, 'user'=>$this->auth_user, 'success_msg'=>$succ_msg]);
                        exit;
                    } else {
                        $err_msg = "Sorry, there was an error uploading your file.";
                        $roles = $this->model('Role')->get();
                        $this->view('admin/home', ['roles'=>$roles, 'user'=>$this->auth_user, 'error_msg'=>$err_msg]);
                        exit;
                    }
                }
            }

        }
        else{

            $link = Globals::baseUrl()."/public/adminlogin";
            header("Location: ".$link);
            exit();

        }

    }

    public function logout(){
        session_unset();
        session_destroy();
        session_write_close();
        setcookie(session_name(),'',0,'/');
        session_regenerate_id(true);

        $link = Globals::baseUrl()."/public/adminlogin";
        header("Location: ".$link);
        exit();

    }

}

?>
