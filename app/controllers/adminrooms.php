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
                    $path = Globals::baseUrl()."/public/img/rooms/".$filename;

                    // $path = Storage::put('public/rooms', $image, 'public');
                    // $new_gallery = new Gallery;
                    // $new_gallery->image_name = str_replace("public/rooms/", "", $path);
                    // $new_gallery->directory = str_replace("public", "/storage", $path);
                    // $new_gallery->dimension = "original";
                    // $new_gallery->room_id = $new_room->id;
                    // $new_gallery->save();

                    $img = $this->image_manager->make($image["tmp_name"]);
                    echo $image["tmp_name"];
                    move_uploaded_file($img, $path);
                    $new_room_gallery = $this->model('RoomGallery');
                    $new_room_gallery->image_name = $filename;
                    $new_room_gallery->directory = $path;
                    $new_room_gallery->dimension = "original";
                    $new_room_gallery->room_type_id = $new_room_type->id;
                    $new_room_gallery = $new_room_gallery->save($new_room_gallery);

                    // // 800 x 532
                    // $filename  = "800x532_".time() . '.' . $image->getClientOriginalExtension();
                    // $path = public_path('images/rooms/' . $filename);
                    // $img = Image::make($image)->fit(800, 532)->save($path);
                    // $new_gallery_800x532 = new Gallery;
                    // $new_gallery_800x532->image_name = $filename;
                    // $new_gallery_800x532->directory = "images/rooms/".$filename;
                    // $new_gallery_800x532->dimension = "800x532";
                    // $new_gallery_800x532->room_id = $new_room->id;
                    // $new_gallery_800x532->save();
                    //
                    // // 800 x 477
                    // $filename  = "800x477_".time() . '.' . $image->getClientOriginalExtension();
                    // $path = public_path('images/rooms/' . $filename);
                    // $img = Image::make($image)->fit(800, 477)->save($path);
                    // $new_gallery_800x477 = new Gallery;
                    // $new_gallery_800x477->image_name = $filename;
                    // $new_gallery_800x477->directory = "images/rooms/".$filename;
                    // $new_gallery_800x477->dimension = "800x477";
                    // $new_gallery_800x477->room_id = $new_room->id;
                    // $new_gallery_800x477->save();
                    //
                    // // 370 x 305
                    // $filename  = "370x305_".time() . '.' . $image->getClientOriginalExtension();
                    // $path = public_path('images/rooms/' . $filename);
                    // $img = Image::make($image)->fit(370, 305)->save($path);
                    // $new_gallery_370x305 = new Gallery;
                    // $new_gallery_370x305->image_name = $filename;
                    // $new_gallery_370x305->directory = "images/rooms/".$filename;
                    // $new_gallery_370x305->dimension = "370x305";
                    // $new_gallery_370x305->room_id = $new_room->id;
                    // $new_gallery_370x305->save();
                    //
                    // // 370 x 229
                    // $filename  = "370x229_".time() . '.' . $image->getClientOriginalExtension();
                    // $path = public_path('images/rooms/' . $filename);
                    // $img = Image::make($image)->fit(370, 229)->save($path);
                    // $new_gallery_370x229 = new Gallery;
                    // $new_gallery_370x229->image_name = $filename;
                    // $new_gallery_370x229->directory = "images/rooms/".$filename;
                    // $new_gallery_370x229->dimension = "370x229";
                    // $new_gallery_370x229->room_id = $new_room->id;
                    // $new_gallery_370x229->save();
                    //
                    // // 368 x 265
                    // $filename  = "368x265_".time() . '.' . $image->getClientOriginalExtension();
                    // $path = public_path('images/rooms/' . $filename);
                    // $img = Image::make($image)->fit(368, 265)->save($path);
                    // $new_gallery_368x265 = new Gallery;
                    // $new_gallery_368x265->image_name = $filename;
                    // $new_gallery_368x265->directory = "images/rooms/".$filename;
                    // $new_gallery_368x265->dimension = "368x265";
                    // $new_gallery_368x265->room_id = $new_room->id;
                    // $new_gallery_368x265->save();
                    //
                    // // 670 x 265
                    // $filename  = "670x265_".time() . '.' . $image->getClientOriginalExtension();
                    // $path = public_path('images/rooms/' . $filename);
                    // $img = Image::make($image)->fit(670, 265)->save($path);
                    // $new_gallery_670x265 = new Gallery;
                    // $new_gallery_670x265->image_name = $filename;
                    // $new_gallery_670x265->directory = "images/rooms/".$filename;
                    // $new_gallery_670x265->dimension = "670x265";
                    // $new_gallery_670x265->room_id = $new_room->id;
                    // $new_gallery_670x265->save();
                    //
                    // // 122 x 122
                    // $filename  = "122x122_".time() . '.' . $image->getClientOriginalExtension();
                    // $path = public_path('images/rooms/' . $filename);
                    // $img = Image::make($image)->fit(122, 122)->save($path);
                    // $new_gallery_122x122 = new Gallery;
                    // $new_gallery_122x122->image_name = $filename;
                    // $new_gallery_122x122->directory = "images/rooms/".$filename;
                    // $new_gallery_122x122->dimension = "122x122";
                    // $new_gallery_122x122->room_id = $new_room->id;
                    // $new_gallery_122x122->save();
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
