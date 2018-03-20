<?php include_once '../app/views/header/indexwithoutsliderheader.php' ?>
<?php include_once '../app/views/bodywithoutslider.php' ?>

<!-- <link rel="stylesheet" href="<?php echo Globals::baseUrl(); ?>/public/index/css/timetablejs.css">
<script type="text/javascript" src="<?php echo Globals::baseUrl(); ?>/public/index/js/timetable.js"></script> -->

<style media="screen">
    .reserve-rooms{
        margin-top: 5%;
    }

    /* The snackbar - position it at the bottom and in the middle of the screen */
    #snackbar {
        visibility: hidden; /* Hidden by default. Visible on click */
        min-width: 250px; /* Set a default minimum width */
        margin-left: -125px; /* Divide value of min-width by 2 */
        background-color: #333; /* Black background color */
        color: #fff; /* White text color */
        text-align: center; /* Centered text */
        border-radius: 2px; /* Rounded borders */
        padding: 16px; /* Padding */
        position: fixed; /* Sit on top of the screen */
        z-index: 1; /* Add a z-index if needed */
        left: 50%; /* Center the snackbar */
        bottom: 30px; /* 30px from the bottom */
    }

    /* Show the snackbar when clicking on a button (class added with JavaScript) */
    #snackbar.show {
        visibility: visible; /* Show the snackbar */
        margin-bottom: 2%;

    /* Add animation: Take 0.5 seconds to fade in and out the snackbar.
    However, delay the fade out process for 2.5 seconds */
        -webkit-animation: fadein 0.5s, fadeout 0.5s 2.5s;
        animation: fadein 0.5s, fadeout 0.5s 2.5s;
    }

    /* Animations to fade the snackbar in and out */
    @-webkit-keyframes fadein {
        from {bottom: 0; opacity: 0;}
        to {bottom: 30px; opacity: 1;}
    }

    @keyframes fadein {
        from {bottom: 0; opacity: 0;}
        to {bottom: 30px; opacity: 1;}
    }

    @-webkit-keyframes fadeout {
        from {bottom: 30px; opacity: 1;}
        to {bottom: 0; opacity: 0;}
    }

    @keyframes fadeout {
        from {bottom: 30px; opacity: 1;}
        to {bottom: 0; opacity: 0;}
    }
</style>

<div class="content">


    <div class="reserve-rooms">
        <div class="container">

            <h1>Check Room Availability</h1>
            <form method="POST" action="<?php echo Globals::baseUrl(); ?>/public/customerreservation/reserve/<?php echo $data['roomtype'][0]['name'] ?>">
                <label for="branch_id">Select Branch</label>
                <select class="input" id="branch_id" name="branch_id">
                    <?php foreach( $data['branches']->get() as $b ): ?>
                        <option value="<?php echo $b['id']; ?>"><?php echo $b['name']; ?></option>
                    <?php endforeach; ?>
                </select>

                <label for="from_date">From</label>
                <input class="input" type="date" id="from_date" name="from_date">

                <label for="to_date">To</label>
                <input class="input" type="date" id="to_date" name="to_date">

                <br>
                <br>
                <input id="check-btn" onclick="checkAvailability()" class="product-container-button" type="button" value="Check">

                <div style="display:none;" id="reservation-inputs" class="reservation-inputs">

                    <label for="from_date">How many Rooms?</label>
                    <input class="input" type="number" name="room_count">

                    <input class="product-container-button" type="submit" value="Reserve">
                </div>

            </form>

        </div>
    </div>

    <!-- The actual snackbar -->
    <div id="snackbar">Checking room availability..</div>

</div>


<script type="text/javascript">

    $("#room-rates-nav").attr("class", "");
    $("#home-nav").attr("class", "");
    $("#contact-us-nav").attr("class", "");
    $("#room-name-nav").attr("class", "");
    $("#room-name-nav").attr("href", "<?php echo Globals::baseUrl(); ?>/public/viewroom/<?php echo $data['roomtype'][0]['name'] ?>");
    $("#room-name-nav").html(" | <?php echo $data['roomtype'][0]['name'] ?>");
    $("#reservation-nav").attr("class", "active");
    $("#reservation-nav").html(" | Reservation");

</script>


<script type="text/javascript">
    $(function(){
    var dtToday = new Date();

    var month = dtToday.getMonth() + 1;
    var day = dtToday.getDate();
    var year = dtToday.getFullYear();
    if(month < 10)
        month = '0' + month.toString();
    if(day < 10)
        day = '0' + day.toString();

    var maxDate = year + '-' + month + '-' + day;
    $('#txtDate').attr('min', maxDate);
    });
</script>

<script type="text/javascript">

    function checkAvailability(){
        var fromdate = $("#from_date").val();
        var todate = $("#to_date").val();
        var json_data = JSON.stringify( { "checkin":fromdate, "checkout": todate } );
        // Get the snackbar DIV
        var x = document.getElementById("snackbar");
        $.ajax({
        url: 'http://plazaalemania.epizy.com/public/customerreservation/checkavailability/<?php echo $data['roomtype'][0]['name'] ?>',
        data: {
          json : json_data
        },
        beforeSend:function(){

            // Add the "show" class to DIV
            x.className = "show";

        },
        error: function(error) {
              console.log(error);
        },
        dataType: 'json',
        success: function(data) {
            // After 3 seconds, remove the show class from DIV
            setTimeout(function(){
                 x.className = x.className.replace("show", "");
             }, 3000);


          console.log(data);

            if(data.available == true){

                $("#reservation-inputs").show();
                $("#check-btn").hide();
            }

        },
        type: 'POST'
        });

    }

</script>
