<?php
// import the Intervention Image Manager Class
use Intervention\Image\ImageManager;

class AdminRooms extends Controller{


    protected $auth_user;
    protected $image_manager;

    public function __construct(){
        $this->auth_user = $this->model('AuthUser');
        if( !$this->auth_user->checkRole($this->auth_user->role_id, "admin") ){
            echo "Unauthorized Access";
            exit();
        }

        // create an image manager instance with favored driver
        $this->image_manager = new ImageManager(array('driver' => 'gd'));

    }

    public function index(){

        if( $this->auth_user->auth ){

            $branches = $this->model('Branch')->get();
            $roomtypes = $this->model("RoomType");
            $this->view('admin/rooms', [
                'user'=>$this->auth_user,
                'branches' => $branches,
                'roomtypes' => $roomtypes
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



            // IMAGE START

            // $path = Storage::putFile('/avatars', $request->file('profpic'), 'public');
            if( $_FILES['room_img1'] ){
                for( $i=1; $i<=$_POST['image_count']; $i++ ){

                    $image = $_FILES['room_img'.$i];
                    $imageFileType = strtolower(pathinfo($image["name"],PATHINFO_EXTENSION));
                    $filename  = "original_".time() . '.' . $imageFileType;
                    $path_server = $_SERVER['DOCUMENT_ROOT']."/plazaalemaniawebdev/public/img/rooms/".$filename;
                    $path_http = Globals::baseUrl()."/public/img/rooms/".$filename;


                    move_uploaded_file($_FILES['room_img'.$i]["tmp_name"], $path_server);
                    $img = $this->image_manager->make($path_server)->save();
                    $new_room_gallery = $this->model('RoomGallery');
                    $new_room_gallery->image_name = $filename;
                    $new_room_gallery->directory = $path_http;
                    $new_room_gallery->dimension = "original";
                    $new_room_gallery->room_type_id = $new_room_type->id;
                    $new_room_gallery = $new_room_gallery->save($new_room_gallery);

                    // 800 x 532
                    $img = $this->image_manager->make($path_server)->fit(800, 532);

                    $filename  = "800x532_".time() . '.' . $imageFileType;
                    $path_server = $_SERVER['DOCUMENT_ROOT']."/plazaalemaniawebdev/public/img/rooms/".$filename;
                    $path_http = Globals::baseUrl()."/public/img/rooms/".$filename;
                    $img->save($path_server);


                    $new_room_gallery = $this->model('RoomGallery');
                    $new_room_gallery->image_name = $filename;
                    $new_room_gallery->directory = $path_http;
                    $new_room_gallery->dimension = "800x532";
                    $new_room_gallery->room_type_id = $new_room_type->id;
                    $new_room_gallery = $new_room_gallery->save($new_room_gallery);

                    // // 800 x 477

                    $img = $this->image_manager->make($path_server)->fit(800, 477);

                    $filename  = "800x477_".time() . '.' . $imageFileType;
                    $path_server = $_SERVER['DOCUMENT_ROOT']."/plazaalemaniawebdev/public/img/rooms/".$filename;
                    $path_http = Globals::baseUrl()."/public/img/rooms/".$filename;
                    $img->save($path_server);


                    $new_room_gallery = $this->model('RoomGallery');
                    $new_room_gallery->image_name = $filename;
                    $new_room_gallery->directory = $path_http;
                    $new_room_gallery->dimension = "800x477";
                    $new_room_gallery->room_type_id = $new_room_type->id;
                    $new_room_gallery = $new_room_gallery->save($new_room_gallery);

                    // // 370 x 305
                    $img = $this->image_manager->make($path_server)->fit(370, 305);

                    $filename  = "370x305_".time() . '.' . $imageFileType;
                    $path_server = $_SERVER['DOCUMENT_ROOT']."/plazaalemaniawebdev/public/img/rooms/".$filename;
                    $path_http = Globals::baseUrl()."/public/img/rooms/".$filename;
                    $img->save($path_server);


                    $new_room_gallery = $this->model('RoomGallery');
                    $new_room_gallery->image_name = $filename;
                    $new_room_gallery->directory = $path_http;
                    $new_room_gallery->dimension = "370x305";
                    $new_room_gallery->room_type_id = $new_room_type->id;
                    $new_room_gallery = $new_room_gallery->save($new_room_gallery);

                    // // 370 x 229
                    $img = $this->image_manager->make($path_server)->fit(370, 229);

                    $filename  = "370x229_".time() . '.' . $imageFileType;
                    $path_server = $_SERVER['DOCUMENT_ROOT']."/plazaalemaniawebdev/public/img/rooms/".$filename;
                    $path_http = Globals::baseUrl()."/public/img/rooms/".$filename;
                    $img->save($path_server);


                    $new_room_gallery = $this->model('RoomGallery');
                    $new_room_gallery->image_name = $filename;
                    $new_room_gallery->directory = $path_http;
                    $new_room_gallery->dimension = "370x229";
                    $new_room_gallery->room_type_id = $new_room_type->id;
                    $new_room_gallery = $new_room_gallery->save($new_room_gallery);
                    //
                    // // 670 x 265
                    $img = $this->image_manager->make($path_server)->fit(670, 265);

                    $filename  = "670x265_".time() . '.' . $imageFileType;
                    $path_server = $_SERVER['DOCUMENT_ROOT']."/plazaalemaniawebdev/public/img/rooms/".$filename;
                    $path_http = Globals::baseUrl()."/public/img/rooms/".$filename;
                    $img->save($path_server);


                    $new_room_gallery = $this->model('RoomGallery');
                    $new_room_gallery->image_name = $filename;
                    $new_room_gallery->directory = $path_http;
                    $new_room_gallery->dimension = "670x265";
                    $new_room_gallery->room_type_id = $new_room_type->id;
                    $new_room_gallery = $new_room_gallery->save($new_room_gallery);


                    // // 368 x 265
                    $img = $this->image_manager->make($path_server)->fit(368, 265);

                    $filename  = "368x265_".time() . '.' . $imageFileType;
                    $path_server = $_SERVER['DOCUMENT_ROOT']."/plazaalemaniawebdev/public/img/rooms/".$filename;
                    $path_http = Globals::baseUrl()."/public/img/rooms/".$filename;
                    $img->save($path_server);


                    $new_room_gallery = $this->model('RoomGallery');
                    $new_room_gallery->image_name = $filename;
                    $new_room_gallery->directory = $path_http;
                    $new_room_gallery->dimension = "368x265";
                    $new_room_gallery->room_type_id = $new_room_type->id;
                    $new_room_gallery = $new_room_gallery->save($new_room_gallery);

                    //
                    // // 122 x 122
                    $img = $this->image_manager->make($path_server)->fit(122, 122);

                    $filename  = "122x122_".time() . '.' . $imageFileType;
                    $path_server = $_SERVER['DOCUMENT_ROOT']."/plazaalemaniawebdev/public/img/rooms/".$filename;
                    $path_http = Globals::baseUrl()."/public/img/rooms/".$filename;
                    $img->save($path_server);


                    $new_room_gallery = $this->model('RoomGallery');
                    $new_room_gallery->image_name = $filename;
                    $new_room_gallery->directory = $path_http;
                    $new_room_gallery->dimension = "122x122";
                    $new_room_gallery->room_type_id = $new_room_type->id;
                    $new_room_gallery = $new_room_gallery->save($new_room_gallery);
                }
            }

            // IMAGE END



            $branches = $this->model('Branch')->get();
            $roomtypes = $this->model("RoomType");
            $this->view('admin/rooms', [
                'status'=> $status,
                'status_message' => $status_message,
                'message' => $message,
                'for_form' => 'addroomtype',
                'branches' => $branches,
                'roomtypes' => $roomtypes
            ]);

            exit();

        }
        else{
            $status = 409;
            $status_message = StatusCodes::getCode($status);
            $message = "Room Type Already Exists!";
            $branches = $this->model('Branch')->get();
            $roomtypes = $this->model("RoomType");
            $this->view('admin/rooms', [
                'status'=> $status,
                'status_message' => $status_message,
                'message' => $message,
                'for_form' => 'addroomtype',
                'branches' => $branches,
                'roomtypes' => $roomtypes
            ]);
            exit();
        }


    }

    public function deleteroomtype($id){

        $new_room_type = $this->model('RoomType')->delete($id);

        if( $new_room_type ){
            $status = 200;
            $status_message = StatusCodes::getCode($status);
            $message = "Successfully deleted!";
            $branches = $this->model('Branch')->get();
            $roomtypes = $this->model("RoomType");
            $this->view('admin/rooms', [
                'status'=> $status,
                'status_message' => $status_message,
                'message' => $message,
                'for_form' => 'deleteroomtype',
                'branches' => $branches,
                'roomtypes' => $roomtypes
            ]);
            exit();
        }
        else{
            $status = 409;
            $status_message = StatusCodes::getCode($status);
            $message = "Failed to delete this room type";
            $branches = $this->model('Branch')->get();
            $roomtypes = $this->model("RoomType");
            $this->view('admin/rooms', [
                'status'=> $status,
                'status_message' => $status_message,
                'message' => $message,
                'for_form' => 'deleteroomtype',
                'branches' => $branches,
                'roomtypes' => $roomtypes
            ]);
            exit();
        }

    }

}
