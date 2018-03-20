<?php

class CustomerReservation extends Controller{

    protected $auth_user;

    public function __construct(){
        $this->auth_user = $this->model('AuthUser');
        if( !$this->auth_user->checkRole($this->auth_user->role_id, "admin") ){
            echo "Unauthorized Access";
            exit();
        }
    }

    public function index($roomtypename){
        $roomtypes = $this->model('RoomType');

        $roomtypenospace_array = [];
        foreach( $roomtypes->get() as $rt ){

            $roomtypenospace_array[str_replace(' ', '', $rt['name'])][0] = $rt['name'];

        }

        $branches = $this->model('Branch');
        $rooms = $this->model('Room');
        $roomtype = $this->model('RoomType')->getByName($roomtypenospace_array[$roomtypename][0]);
        $this->view('customer/reservation', [
            'roomtypes' => $roomtypes,
            'roomtype' => $roomtype,
            'rooms' => $rooms,
            'branches' => $branches
        ]);

    }

    public function checkavailability($roomtypename){

        $roomtypes = $this->model('RoomType');
        $roomtypenospace_array = [];
        foreach( $roomtypes->get() as $rt ){

            $roomtypenospace_array[str_replace(' ', '', $rt['name'])][0] = $rt['name'];

        }

        $data = json_decode($_POST['json']);
        $checkin = $data->checkin;
        $checkout = $data->checkout;

        $new_reservation = $this->model('Reservation')->checkAvailability($checkin, $checkout);
        $room_reservation = $this->model('RoomReservation')->getByReservationId($new_reservation[0]['id']);
        $room = $this->model('Room')->getById($room_reservation[0]['room_id']);
        $roomtype = $this->model('RoomType')->getById($room[0]['room_type_id']);
        if( $new_reservation ){
            if( $roomtype[0]['name'] == $roomtypenospace_array[$roomtypename][0] ){
                echo json_encode(array("available" => false));
            }
            else{
                echo json_encode(array("available" => true));
            }

        }
        else{
            echo json_encode(array("available" => true));
        }

    }

    public function reserve($roomtypename){

        $roomtypes = $this->model('RoomType');

        $roomtypenospace_array = [];
        foreach( $roomtypes->get() as $rt ){

            $roomtypenospace_array[str_replace(' ', '', $rt['name'])][0] = $rt['name'];

        }

        $rooms = $this->model('Room');
        $roomtype = $this->model('RoomType')->getByNameAndBranchId($roomtypenospace_array[$roomtypename][0], $_POST['branch_id']);
        $new_reservation = $this->model('Reservation');
        $new_reservation->checkin = $_POST['from_date'];
        $new_reservation->checkout = $_POST['to_date'];
        $new_reservation->user_id = $this->auth_user->id;
        $new_reservation = $new_reservation->save($new_reservation);

        foreach( $roomtypes->getRooms($roomtype[0]['id'], 'YES') as $key => $r ){

            if( $key < $_POST['room_count'] ){

                $new_roomreservation = $this->model('RoomReservation');
                $new_roomreservation->room_id = $r['id'];
                $new_roomreservation->reservation_id = $new_reservation->id;
                $new_roomreservation->save($new_roomreservation);

            }

        }

    }


}

?>
